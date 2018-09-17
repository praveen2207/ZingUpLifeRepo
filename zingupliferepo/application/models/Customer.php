<?php

/**
 * This class used for admin users login and users actions/activities
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:03-09-2015
 * 
 * */
class Customer extends CI_Model {

    function __construct() {
// Call the Model constructor
        parent::__construct();
    }

    /*
     *  Function to get user details by given username  
     */

    public function get_all_customers($joining_date) {
        $this->db->select('user_details.*,users.*');
        $this->db->from('user_details');
        $this->db->join('users', 'user_details.user_id = users.id');
        $this->db->where('user_details.created_on >', $joining_date);
        $this->db->order_by('user_details.created_on', 'desc');
        $query = $this->db->get();
        $query_result = $query->result();
        $users_details = array();


        foreach ($query_result as $key => $value) {
            $users_details[$key] = $value;
            $this->db->select('booking_info.id');
            $this->db->from('booking_info');
            $this->db->where('booking_info.user_id', $value->user_id);

            $orders_query = $query = $this->db->get();
            $orders_query_result = $orders_query->result();
            if (count($orders_query_result) == 0) {
                $users_details[$key]->orders = '-';
            } elseif (count($orders_query_result) == 1) {
                $users_details[$key]->orders = $orders_query_result[0]->id;
            } else {
                $order_ids = array();
                foreach ($orders_query_result as $keys => $order) {
                    $order_ids[] = $order->id;
                }
                $users_details[$key]->orders = implode(',', $order_ids);
            }
        }
        return $users_details;
    }

    /* Above function ends here */

    public function get_customer_details_and_transactions($id, $start_date, $end_date) {
        $this->db->select('user_details.*,users.*');
        $this->db->from('user_details');
        $this->db->join('users', 'user_details.user_id = users.id');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $users_details = array();
        $users_details['user_details'] = $query_result[0];

        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.user_id', $id);
        $this->db->where('booking_info.booking_date <', $end_date);
        $this->db->where('booking_info.booking_date >', $start_date);
        $this->db->order_by('booking_info.booking_date', 'desc');
        $transaction_query = $this->db->get();
        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $users_details['transactions'][$key] = $value;

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $users_details['user_details']->id);
            $user_query = $this->db->get();
            $mark_attend = $user_query->result();
            if (!empty($mark_attend)) {
                $users_details['transactions'][$key]->mark_attend = $mark_attend[0]->status;
            }

            $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $users_details['transactions'][$key]->vendor_details = $vendor_result[0];
        }

        $this->db->select('booking_info.*,business_services.*,business_services_details.duration,services_slots.*,COUNT(booking_info.slot_id) as total');
        $this->db->from('booking_info');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.user_id', $id);
        $this->db->group_by('booking_info.slot_id');
        $this->db->order_by('total', 'desc');
        $services_count_query = $this->db->get();
        $services_count_query_result = $services_count_query->result();
        if (!empty($services_count_query_result)) {
            $users_details['services'] = $services_count_query_result[0];
        }
        return $users_details;
    }

    /*
     *  Function to update customer's profile data in database
     */

    public function update_customer_details($user_data) {
        $user_id = $user_data['user_id'];
        unset($user_data['user_id']);
        unset($user_data['submit']);

        $updated_user_data = array(
            'name' => $user_data['name'],
        );
        $this->db->where('id', $user_id);
        $this->db->update('users', $updated_user_data);
        unset($user_data['name']);

        $this->db->where('user_id', $user_id);
        $this->db->update('user_details', $user_data);
        return TRUE;
    }

    /* Above function ends here */


    /*
     *  Function to delete customer data in database
     */

    public function delete_customer($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('user_details');

        $this->db->where('id', $user_id);
        $this->db->delete('users');

        return TRUE;
    }

    /* Above function ends here */

    public function get_customer_search($data) {
	if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['email'] == '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('user_details.user_id', $data['cus_id']);
            $this->db->like('users.name', $data['cus_name']);
			$this->db->like('user_details.phone', $data['ph']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['email'] == '' && $data['ph'] == '') {
            //$query = $this->db->query('select u.*,ud.*,bi.id from users u left join user_details ud on ud.user_id = u.id left join booking_info bi on bi.user_id = ud.user_id');
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['email'] != '' && $data['ph'] != '') {

            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);
            $this->db->where('user_details.user_id', $data['cus_id']);
            $this->db->like('users.name', $data['cus_name']);
            $this->db->like('users.username', $data['email']);
            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['email'] == '' && $data['ph'] == '') {
		//settype($data['ord_id'], "integer");
		//echo $data['ord_id'];
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id',$data['ord_id']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
			//print_r($this->db->last_query()); exit(); 
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['email'] == '' && $data['ph'] == '') {

            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('user_details.user_id', $data['cus_id']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);


                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['email'] == '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->like('users.name', $data['cus_name']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['email'] != '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');

            $this->db->like('users.username', $data['email']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['email'] == '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');

            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['email'] == '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);
            $this->db->where('user_details.user_id', $data['cus_id']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['email'] == '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);
            $this->db->where('user_details.user_id', $data['cus_id']);
            $this->db->like('users.name', $data['cus_name']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['email'] != '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);
            $this->db->where('user_details.user_id', $data['cus_id']);
            $this->db->like('users.name', $data['cus_name']);
            $this->db->like('users.username', $data['email']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['email'] == '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);

            $this->db->like('users.name', $data['cus_name']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['email'] != '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);


            $this->db->like('users.username', $data['email']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['email'] == '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);



            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['email'] == '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);
            $this->db->where('user_details.user_id', $data['cus_id']);
            $this->db->like('users.name', $data['cus_name']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['email'] != '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);

            $this->db->like('users.name', $data['cus_name']);
            $this->db->like('users.username', $data['email']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['email'] == '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);

            $this->db->like('users.name', $data['cus_name']);

            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['email'] != '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);


            $this->db->like('users.username', $data['email']);
            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['email'] != '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);
            $this->db->where('user_details.user_id', $data['cus_id']);

            $this->db->like('users.username', $data['email']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['email'] == '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);
            $this->db->where('user_details.user_id', $data['cus_id']);


            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['email'] == '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->join('booking_info', 'booking_info.user_id = users.id');
            $this->db->where('booking_info.id', $data['ord_id']);



            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['email'] == '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('user_details.user_id', $data['cus_id']);
            $this->db->like('users.name', $data['cus_name']);


            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['email'] != '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('user_details.user_id', $data['cus_id']);
            $this->db->like('users.name', $data['cus_name']);
            $this->db->like('users.username', $data['email']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['email'] != '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('user_details.user_id', $data['cus_id']);
            $this->db->like('users.name', $data['cus_name']);
            $this->db->like('users.username', $data['email']);
            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['email'] != '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->like('users.username', $data['email']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['email'] == '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('user_details.user_id', $data['cus_id']);


            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['email'] == '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('user_details.user_id', $data['cus_id']);


            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['email'] != '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('user_details.user_id', $data['cus_id']);

            $this->db->like('users.username', $data['email']);
            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['email'] != '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->like('users.name', $data['cus_name']);
            $this->db->like('users.username', $data['email']);
            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['email'] == '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->like('users.name', $data['cus_name']);

            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['email'] != '' && $data['ph'] == '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->like('users.name', $data['cus_name']);
            $this->db->like('users.username', $data['email']);

            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }
        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['email'] != '' && $data['ph'] != '') {
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->like('users.username', $data['email']);
            $this->db->like('user_details.phone', $data['ph']);
            $this->db->order_by('user_details.created_on', 'desc');
            $query = $this->db->get();
            $query_result = $query->result();
            $users_details = array();

            foreach ($query_result as $key => $value) {
                $users_details[$key] = $value;
                $this->db->select('booking_info.id');
                $this->db->from('booking_info');
                $this->db->where('booking_info.user_id', $value->user_id);

                $orders_query = $query = $this->db->get();
                $orders_query_result = $orders_query->result();
                if (count($orders_query_result) == 0) {
                    $users_details[$key]->orders = '-';
                } elseif (count($orders_query_result) == 1) {
                    $users_details[$key]->orders = $orders_query_result[0]->id;
                } else {
                    $order_ids = array();
                    foreach ($orders_query_result as $keys => $order) {
                        $order_ids[] = $order->id;
                    }
                    $users_details[$key]->orders = implode(',', $order_ids);
                }
            }
        }

        return $users_details;
    }

    public function customer_transations_filter($data) {
        $id = $data['cs_id'];
        $service = $data['service'];
        $start_date = $data['end_date'];
        $end_date = $data['start_date'];



        $this->db->select('user_details.*,users.*');
        $this->db->from('user_details');
        $this->db->join('users', 'user_details.user_id = users.id');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $users_details = array();
        $users_details['user_details'] = $query_result[0];


        if ($service != '') {
            $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*,services_business_mapping.services_id as offering_service_id');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->join('services_business_mapping', 'booking_info.provider_id = services_business_mapping.business_id');
            $this->db->where('booking_info.user_id', $id);
            $this->db->where('services_business_mapping.services_id', $service);
            $this->db->where('booking_info.booking_date <', $end_date);
            $this->db->where('booking_info.booking_date >', $start_date);
            // $this->db->order_by('booking_info.booking_date', 'desc');
        } else {
            $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*,services_business_mapping.services_id as offering_service_id');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->join('services_business_mapping', 'booking_info.provider_id = services_business_mapping.business_id');
            $this->db->where('booking_info.user_id', $id);
            $this->db->where('booking_info.booking_date <', $end_date);
            $this->db->where('booking_info.booking_date >', $start_date);
            // $this->db->order_by('booking_info.booking_date', 'desc');
        }
        $transaction_query = $this->db->get();
        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $users_details['transactions'][$key] = $value;

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $users_details['user_details']->id);
            $user_query = $this->db->get();
            $mark_attend = $user_query->result();
            if (!empty($mark_attend)) {
                $users_details['transactions'][$key]->mark_attend = $mark_attend[0]->status;
            }

            $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $users_details['transactions'][$key]->vendor_details = $vendor_result[0];
        }

        $this->db->select('booking_info.*,business_services.*,business_services_details.duration,services_slots.*,COUNT(booking_info.slot_id) as total');
        $this->db->from('booking_info');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.user_id', $id);
        $this->db->group_by('booking_info.slot_id');
        $this->db->order_by('total', 'desc');
        $services_count_query = $this->db->get();
        $services_count_query_result = $services_count_query->result();
        if (!empty($services_count_query_result)) {
            $users_details['services'] = $services_count_query_result[0];
        }
        if (!empty($users_details['transactions'])) {
            return $users_details;
        } else {
            $users_details['transactions'] = '';
            return $users_details;
        }
    }

    public function customer_transactions_sorting($data) {
        $id = $data['cs_id'];
        $service = $data['service'];


        $this->db->select('user_details.*,users.*');
        $this->db->from('user_details');
        $this->db->join('users', 'user_details.user_id = users.id');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $users_details = array();
        $users_details['user_details'] = $query_result[0];


        if ($service != '') {
            $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*,services_business_mapping.services_id as offering_service_id');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->join('services_business_mapping', 'booking_info.provider_id = services_business_mapping.business_id');
            $this->db->where('booking_info.user_id', $id);
            $this->db->where('services_business_mapping.services_id', $service);
            $this->db->order_by('booking_info.booking_date', 'desc');
        } else {
            $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*,services_business_mapping.services_id as offering_service_id');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->join('services_business_mapping', 'booking_info.provider_id = services_business_mapping.business_id');
            $this->db->where('booking_info.user_id', $id);
            $this->db->order_by('booking_info.booking_date', 'desc');
        }
        $transaction_query = $this->db->get();
        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $users_details['transactions'][$key] = $value;

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $users_details['user_details']->id);
            $user_query = $this->db->get();
            $mark_attend = $user_query->result();
            if (!empty($mark_attend)) {
                $users_details['transactions'][$key]->mark_attend = $mark_attend[0]->status;
            }

            $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $users_details['transactions'][$key]->vendor_details = $vendor_result[0];
        }

        $this->db->select('booking_info.*,business_services.*,business_services_details.duration,services_slots.*,COUNT(booking_info.slot_id) as total');
        $this->db->from('booking_info');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.user_id', $id);
        $this->db->group_by('booking_info.slot_id');
        $this->db->order_by('total', 'desc');
        $services_count_query = $this->db->get();
        $services_count_query_result = $services_count_query->result();
        if (!empty($services_count_query_result)) {
            $users_details['services'] = $services_count_query_result[0];
        }
        if (!empty($users_details['transactions'])) {
            return $users_details;
        } else {
            $users_details['transactions'] = '';
            return $users_details;
        }
    }

  public function get_customer_details_and_transactions_for_finance($id) {
        $this->db->select('user_details.*,users.*');
        $this->db->from('user_details');
        $this->db->join('users', 'user_details.user_id = users.id');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $users_details = array();
        $users_details['user_details'] = $query_result[0];

        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.user_id', $id);
        $this->db->order_by('booking_info.booking_date', 'desc');
        $transaction_query = $this->db->get();
        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $users_details['transactions'][$key] = $value;

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $users_details['user_details']->id);
            $user_query = $this->db->get();
            $mark_attend = $user_query->result();
            if (!empty($mark_attend)) {
                $users_details['transactions'][$key]->mark_attend = $mark_attend[0]->status;
            }

            $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $users_details['transactions'][$key]->vendor_details = $vendor_result[0];
        }

        $this->db->select('booking_info.*,business_services.*,business_services_details.duration,services_slots.*,COUNT(booking_info.slot_id) as total');
        $this->db->from('booking_info');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.user_id', $id);
        $this->db->group_by('booking_info.slot_id');
        $this->db->order_by('total', 'desc');
        $services_count_query = $this->db->get();
        $services_count_query_result = $services_count_query->result();
        if (!empty($services_count_query_result)) {
            $users_details['services'] = $services_count_query_result[0];
        }
        return $users_details;
    }


}
