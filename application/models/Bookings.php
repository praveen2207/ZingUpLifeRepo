<?php

/**
 * This class gives transactions and bookings details for user
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:04-08-2015
 * 
 * */
class Bookings extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Function to get transactions list by user id 
     */

    public function get_transactions_list_by_user_id($id) {
        $this->db->select('transaction_details.*,booking_info.booking_status,booking_info.provider_id');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->where('transaction_details.paid_by', $id);
        $this->db->order_by('transaction_details.transaction_date', 'desc');


        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();
        foreach ($query_result as $key => $value) {
            $transaction_details[$key]['transactions'] = $value;

            $this->db->select('business_details.name,services.service_name');
            $this->db->from('business_details');
            $this->db->join('services_business_mapping', 'business_details.id = services_business_mapping.business_id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $transaction_details[$key]['vendor_details'] = $vendor_result[0];
        }

        return $transaction_details;
    }

    /* Above function ends here */

    /*
     * Function to get bookings list by user id 
     */

    public function get_order_details($id) {

        $this->db->select('transaction_details.*,booking_info.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'booking_info.id = transaction_details.booking_id');
        $this->db->where('transaction_details.booking_id', $id);
        $service_type_query = $this->db->get();
        $service_type_result = $service_type_query->result();
        if (count($service_type_result) == 0) {
            $service_type_result_details = $service_type_result;
        } else {
            $service_type_result_details = $service_type_result[0];
        }

        if ($service_type_result_details->membership_type == '0') {
            $this->db->select('booking_info.*,transaction_details.booking_id,transaction_details.transaction_id,transaction_details.payment_mode,business_services_details.*,transaction_details.transaction_date,business_services.services,services_slots.date,services_slots.start_time,services_slots.end_time');
            $this->db->from('booking_info');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->join('transaction_details', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services_details', 'business_services_details.service_id = booking_info.service_id');
            $this->db->where('booking_info.id', $id);
        } else {
            $this->db->select('booking_info.*,transaction_details.booking_id,transaction_details.transaction_id,transaction_details.payment_mode,business_services_details.*,transaction_details.transaction_date,business_services.services,,memberships.*,users_membership_details.*,users_membership_details.id as user_membership_id');
            $this->db->from('booking_info');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('transaction_details', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services_details', 'business_services_details.service_id = booking_info.service_id');
            $this->db->join('memberships', 'memberships.id = booking_info.membership_type');
            $this->db->join('users_membership_details', 'users_membership_details.booking_id = booking_info.id');
            $this->db->where('booking_info.id', $id);
        }

        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $order_details = $query_result;
        } else {
            $order_details = $query_result[0];
        }
        return $order_details;
    }

    /* Above function ends here */

    /*
     * Function to get user details by user id 
     */

    public function get_user_details($user_id) {

        $this->db->select('user_details.phone,users.*');
        $this->db->from('users');
        $this->db->join('user_details', 'user_details.user_id = users.id');
        $this->db->where('users.id', $user_id);
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $user_details = $query_result;
        } else {
            $user_details = $query_result[0];
        }
        return $user_details;
    }

    /* Above function ends here */


    /*
     * Function to update order date and time 
     */

    public function update_order($data) {

        $booked_old_slots_status_update = array(
            'active' => 'enable',
        );

        $this->db->where('id', $data['old_slot_id']);
        $this->db->update('services_slots', $booked_old_slots_status_update);


        $booked_slots_status_update = array(
            'active' => 'disable',
        );

        $this->db->where('id', $data['new_slot_id']);
        $this->db->update('services_slots', $booked_slots_status_update);



        $this->db->where('id', $data['old_slot_id']);
        $this->db->delete('services_booked_slots');

        $booked_slots_details = array(
            'user_id' => $data['user_id'],
            'slot_id' => $data['new_slot_id'],
        );

        $this->db->insert('services_booked_slots', $booked_slots_details);

        $booked_slot_id = array(
            'slot_id' => $data['new_slot_id'],
        );

        $this->db->where('id', $data['booking_id']);
        $this->db->update('booking_info', $booked_slot_id);

        return true;
    }

    /* Above function ends here */


    /*
     * Function to get slot id by date and time 
     */

    public function get_slot_id($service_id, $booking_date, $start_time, $end_time) {
        $this->db->select('id');
        $this->db->from(' services_slots');
        $this->db->where('service_id', $service_id);
        $this->db->where('date', $booking_date);
        $this->db->where('start_time', $start_time);
        $this->db->where('active', 'enable');
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $slot_id = $query_result;
        } else {
            $slot_id = $query_result[0];
        }
        return $slot_id;
    }

    /* Above function ends here */




    /*
     * Function to get bookings list by user id 
     */

    public function get_transactions_details_by_transaction_id($id) {
        $this->db->select('transaction_details.*,booking_info.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'booking_info.id = transaction_details.booking_id');
        $this->db->where('booking_info.id', $id);
        $service_type_query = $this->db->get();
        $service_type_result = $service_type_query->result();
        if (count($service_type_result) == 0) {
            $service_type_result_details = $service_type_result;
        } else {
            $service_type_result_details = $service_type_result[0];
        }

        if ($service_type_result_details->membership_type == '0') {
            $this->db->select('transaction_details.transaction_date,transaction_details.transaction_id,transaction_details.booking_id,transaction_details.payment_mode,booking_info.*,business_services_details.*,business_services.services,services_slots.date,services_slots.start_time,services_slots.end_time');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'booking_info.id = transaction_details.booking_id');
            $this->db->join('business_services', 'business_services.id = booking_info.service_id');
            $this->db->join('business_services_details', 'business_services_details.service_id = booking_info.service_id');
            $this->db->join('services_slots', 'services_slots.id = booking_info.slot_id');
            $this->db->where('booking_info.id', $id);
        } else {

            $this->db->select('transaction_details.transaction_date,transaction_details.transaction_id,transaction_details.booking_id,transaction_details.payment_mode,booking_info.*,business_services_details.*,business_services.services,memberships.*,users_membership_details.*');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'booking_info.id = transaction_details.booking_id');
            $this->db->join('business_services', 'business_services.id = booking_info.service_id');
            $this->db->join('business_services_details', 'business_services_details.service_id = booking_info.service_id');
            $this->db->join('memberships', 'memberships.id = booking_info.membership_type');
            $this->db->join('users_membership_details', 'users_membership_details.booking_id = booking_info.id');
            $this->db->where('booking_info.id', $id);
        }
        $query = $this->db->get();

        $query_result = $query->result();
//        echo "<pre>";
//        print_r($query_result);
//        exit();
        if (count($query_result) == 0) {
            $transaction_details = $query_result;
        } else {
            $transaction_details = $query_result[0];
        }
        return $transaction_details;
    }

    /* Above function ends here */

    public function insert_booking_details($booking_details) {
        $slot_id = $booking_details['choosed_booking_time'];
        $slot_details = self::get_slot_details($slot_id);

        $booking_id = $booking_details['booking_id'];
        $order_id = $booking_details['order_id'];
        $transaction_details_data = array(
            'booking_id' => $booking_id,
            'service_type' => $booking_details['service_type'],
            'transaction_id' => $booking_details['transaction_id'],
            'transaction_status' => $booking_details['order_status'],
            'transaction_date' => date('Y-m-d H:i:s'),
            'paid_by' => $booking_details['logged_in_user_details']->user_id,
            'payment_mode' => $booking_details['payment_mode'],
            'amount' => $booking_details['total_amount'],
            'other_information' => $booking_details['other_information'],
        );

        $this->db->insert('transaction_details', $transaction_details_data);


        $booked_slots_details = array(
            'user_id' => $booking_details['logged_in_user_details']->user_id,
            'slot_id' => $booking_details['choosed_booking_time'],
        );

        $this->db->insert('services_booked_slots', $booked_slots_details);



        $remaning_slots = ($slot_details->number_of_slots) - 1;
        if ($remaning_slots > 0) {
            $booked_slots_status_update = array(
                'number_of_slots' => $remaning_slots,
            );
        } else {
            $booked_slots_status_update = array(
                'number_of_slots' => $remaning_slots,
                'active' => 'disable',
            );
        }
        $this->db->where('id', $slot_id);
        $this->db->update('services_slots', $booked_slots_status_update);

        $booking_status_update = array(
            'booking_status' => 'Success',
        );

        $this->db->where('order_id', $order_id);
        $this->db->update('booking_info', $booking_status_update);

        return $order_id;
    }

    public function time_difference($time1, $time2) {

        $difference = (strtotime($time1) - strtotime($time2));
        $minutes = round(((($difference % 604800) % 86400) % 3600) / 60);
        $sec = round((((($difference % 604800) % 86400) % 3600) % 60));
        if ($minutes > 0) {
            $time = ($minutes - 1) . 'm' . $sec . 's';
        } else {
            $time = '';
        }
        return $time;
    }

    /*
     * Function to get business details 
     */

    public function get_business_details($id) {
        $this->db->select('business_details.*');
        $this->db->from('business_details');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $business_details = $query_result;
        } else {
            $business_details = $query_result[0];
        }
        return $business_details;
    }

    /* Above function ends here */

    /*
     * Function to change slot status 
     */

    public function slot_status_change($id) {
        $selected_slots_status_update = array(
            'active' => 'disable',
        );

        $this->db->where('id', $id);
        $this->db->update('services_slots', $selected_slots_status_update);
        return true;
    }

    /* Above function ends here */

    /* Above function ends here */

    public function insert_membership_booking_details($booking_details) {
        $booking_id = $booking_details['booking_id'];
        $order_id = $booking_details['order_id'];
        if ($booking_details['membership_details']->duration == '1 Month') {
            $membership_end_date = date('Y-m-d', (strtotime('+30 days', strtotime($booking_details['choosed_booking_date']))));
        } elseif ($booking_details['membership_details']->duration == '3 Months') {
            $membership_end_date = date('Y-m-d', (strtotime('+90 days', strtotime($booking_details['choosed_booking_date']))));
        } elseif ($booking_details['membership_details']->duration == '6 Months') {
            $membership_end_date = date('Y-m-d', (strtotime('+180 days', strtotime($booking_details['choosed_booking_date']))));
        } else {
            $membership_end_date = date('Y-m-d', (strtotime('+365 days', strtotime($booking_details['choosed_booking_date']))));
        }

        $membership_booking_details_data = array(
            'user_id' => $booking_details['logged_in_user_details']->user_id,
            'membership_id' => $booking_details['membership_plan_id'],
            'booking_id' => $booking_id,
            'membership_start_date' => $booking_details['choosed_booking_date'],
            'membership_end_date' => $membership_end_date,
        );

        $this->db->insert('users_membership_details', $membership_booking_details_data);


        $transaction_details_data = array(
            'booking_id' => $booking_id,
            'service_type' => $booking_details['service_type'],
            'transaction_id' => $booking_details['transaction_id'],
            'transaction_status' => $booking_details['order_status'],
            'transaction_date' => date('Y-m-d H:i:s'),
            'paid_by' => $booking_details['logged_in_user_details']->user_id,
            'payment_mode' => $booking_details['payment_mode'],
            'amount' => $booking_details['total_amount'],
            'other_information' => $booking_details['other_information'],
        );

        $this->db->insert('transaction_details', $transaction_details_data);
        $booked_slots_status_update = array(
            'max_number_of_members' => (($booking_details['membership_details']->max_number_of_members) - 1),
        );

        $this->db->where('id', $booking_details['membership_plan_id']);
        $this->db->update('memberships', $booked_slots_status_update);


        $booking_status_update = array(
            'booking_status' => 'Success',
        );

        $this->db->where('order_id', $order_id);
        $this->db->update('booking_info', $booking_status_update);

        return $order_id;
    }

    /*
     * Function to update order date and time 
     */

    public function update_membership_order($data) {

        $this->db->select('memberships.*');
        $this->db->from('memberships');
        $this->db->where('memberships.id', $data['membership_id']);
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $memberships_details = $query_result;
        } else {
            $memberships_details = $query_result[0];
        }

        if ($memberships_details->duration == '1 Month') {
            $membership_end_date = date('Y-m-d', (strtotime('+30 days', strtotime($data['booking_date']))));
        } elseif ($memberships_details->duration == '3 Months') {
            $membership_end_date = date('Y-m-d', (strtotime('+90 days', strtotime($data['booking_date']))));
        } elseif ($memberships_details->duration == '6 Months') {
            $membership_end_date = date('Y-m-d', (strtotime('+180 days', strtotime($data['booking_date']))));
        } else {
            $membership_end_date = date('Y-m-d', (strtotime('+365 days', strtotime($data['booking_date']))));
        }


        $memberships_details_update = array(
            'membership_start_date' => $data['booking_date'],
            'membership_end_date' => $membership_end_date
        );

        $this->db->where('id', $data['user_membership_id']);
        $this->db->update('users_membership_details', $memberships_details_update);


        return true;
    }

    /* Above function ends here */
    /*
     * Function to cancel order 
     */

    public function cancel_booking($id) {
        $order_status_update = array(
            'booking_status' => 'Canceled'
        );

        $this->db->where('id', $id);
        $this->db->update('booking_info', $order_status_update);
        return true;
    }

    /* Above function ends here */

    /*
     * Function to get transactions list by user id 
     */

    public function my_upcoming_bookings($id) {
        $today = date('Y-m-d');
        $this->db->select('transaction_details.*,booking_info.booking_status,booking_info.provider_id');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('transaction_details.paid_by', $id);
        $this->db->where('services_slots.date >', $today);
        $this->db->order_by('transaction_details.transaction_date', 'desc');


        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();
        foreach ($query_result as $key => $value) {
            $transaction_details[$key]['transactions'] = $value;

            $this->db->select('business_details.name,services.service_name');
            $this->db->from('business_details');
            $this->db->join('services_business_mapping', 'business_details.id = services_business_mapping.business_id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $transaction_details[$key]['vendor_details'] = $vendor_result[0];
        }

        return $transaction_details;
    }

    /* Above function ends here */

    /*
     * Function to get transactions list by user id 
     */

    public function my_past_bookings($id) {
        $today = date('Y-m-d');
        $this->db->select('transaction_details.*,booking_info.booking_status,booking_info.provider_id');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('transaction_details.paid_by', $id);
        $this->db->where('services_slots.date <', $today);
        $this->db->order_by('transaction_details.transaction_date', 'desc');


        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();
        foreach ($query_result as $key => $value) {
            $transaction_details[$key]['transactions'] = $value;

            $this->db->select('business_details.name,services.service_name');
            $this->db->from('business_details');
            $this->db->join('services_business_mapping', 'business_details.id = services_business_mapping.business_id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $transaction_details[$key]['vendor_details'] = $vendor_result[0];
        }

        return $transaction_details;
    }

    /* Above function ends here */

    public function generate_order($order_details) {
        $prefix = 'ORD';
        $order_id = $prefix . uniqid();
        $order_details_data = array(
            'order_id' => $order_id,
            'user_id' => $order_details['user_id'],
            'provider_id' => $order_details['provider_id'],
            'service_id' => $order_details['service_id'],
            'slot_id' => $order_details['slot_id'],
            'booking_date' => date('Y-m-d H:i:s'),
            'amount' => $order_details['total_price'],
            'comments' => '',
            'booking_status' => 'Pending'
        );
        $this->db->insert('booking_info', $order_details_data);
        $booking_id = $this->db->insert_id();
        $ids = $booking_id . '-' . $order_id;

        return $ids;
    }

    /*
     *  Function to  business services listing  
     */

    public function get_slot_details($slot_id) {
        $this->db->select('services_slots.*');
        $this->db->from('services_slots');
        $this->db->where('services_slots.id', $slot_id);
        $query = $this->db->get();

        $query_result = $query->result();
        if (count($query_result) == 0) {
            $slot_details = $query_result;
        } else {
            $slot_details = $query_result[0];
        }
        return $slot_details;
    }

    /* Above function ends here */

    public function generate_membership_order($order_details) {

        $prefix = 'ORD';
        $order_id = $prefix . uniqid();
        $order_details_data = array(
            'order_id' => $order_id,
            'user_id' => $order_details['user_id'],
            'membership_type' => $order_details['membership_plan_id'],
            'provider_id' => $order_details['business_provider_id'],
            'service_id' => $order_details['business_service_id'],
            'booking_date' => date('Y-m-d H:i:s'),
            'amount' => $order_details['total_price'],
            'comments' => $order_details['comments'],
            'booking_status' => 'Pending'
        );
        $this->db->insert('booking_info', $order_details_data);
        $booking_id = $this->db->insert_id();
        $ids = $booking_id . '-' . $order_id;

        return $ids;
    }

    /*
     * Function to get transactions list by user id 
     */

    public function get_user_bookings($id) {
        $this->db->select('transaction_details.*,booking_info.booking_status,booking_info.provider_id');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->where('booking_info.booking_status <>', 'Canceled');
        $this->db->where('transaction_details.paid_by', $id);
        $this->db->order_by('transaction_details.transaction_date', 'desc');


        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();
        foreach ($query_result as $key => $value) {
            $transaction_details[$key]['transactions'] = $value;

            if ($value->service_type == 'Monthly') {
                $this->db->select('booking_info.*,business_services_details.*,business_services_details.description as desc,business_services.services,users_membership_details.*,business_service_gallery.*');
                $this->db->from('booking_info');
                $this->db->join('business_services', 'booking_info.service_id = business_services.id');
                $this->db->join('business_services_details', 'business_services_details.service_id = booking_info.service_id');
                $this->db->join('business_service_gallery', 'business_service_gallery.service_id = business_services.id', 'left');
                $this->db->join('users_membership_details', 'booking_info.id = users_membership_details.booking_id');
                $this->db->join('transaction_details', 'transaction_details.booking_id = booking_info.id');
                $this->db->where('booking_info.id', $value->booking_id);
                $booking_query = $this->db->get();
            } else {

                $this->db->select('booking_info.*,business_services_details.*,business_services_details.description as desc,business_services.services,services_slots.date,services_slots.start_time,services_slots.end_time,business_service_gallery.*');
                $this->db->from('booking_info');
                $this->db->join('business_services', 'booking_info.service_id = business_services.id');
                $this->db->join('business_services_details', 'business_services_details.service_id = booking_info.service_id');
                $this->db->join('business_service_gallery', 'business_service_gallery.service_id = business_services.id', 'left');
                $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
                $this->db->join('transaction_details', 'transaction_details.booking_id = booking_info.id');
                $this->db->where('booking_info.id', $value->booking_id);
                $booking_query = $this->db->get();
            }

            $booking_result = $booking_query->result();
            $transaction_details[$key]['booking_details'] = $booking_result[0];


            $this->db->select('business_details.*,services.service_name,locations.suburb as area_name,');
            $this->db->from('business_details');
            $this->db->join('services_business_mapping', 'business_details.id = services_business_mapping.business_id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $transaction_details[$key]['vendor_details'] = $vendor_result[0];
        }

        return $transaction_details;
    }

    /* Above function ends here */

    /*
     * Function to get transactions list by user id 
     */

    public function get_user_upcoming_bookings($id) {
        $today = date('Y-m-d');
        $this->db->select('transaction_details.*,booking_info.booking_status,booking_info.provider_id');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('transaction_details.paid_by', $id);
        $this->db->where('services_slots.date >', $today);
        $this->db->order_by('transaction_details.transaction_date', 'desc');

        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();
        foreach ($query_result as $key => $value) {
            $transaction_details[$key]['transactions'] = $value;



            $this->db->select('booking_info.*,business_services_details.*,business_services.services,services_slots.date,services_slots.start_time,services_slots.end_time');
            $this->db->from('booking_info');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services_details.service_id = booking_info.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->join('transaction_details', 'transaction_details.booking_id = booking_info.id');
            $this->db->where('booking_info.id', $value->booking_id);
            $booking_query = $this->db->get();
            $booking_result = $booking_query->result();
            $transaction_details[$key]['booking_details'] = $booking_result[0];


            $this->db->select('business_details.*,services.service_name,locations.suburb as area_name');
            $this->db->from('business_details');
            $this->db->join('services_business_mapping', 'business_details.id = services_business_mapping.business_id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $transaction_details[$key]['vendor_details'] = $vendor_result[0];
        }

        return $transaction_details;
    }

    /* Above function ends here */


    /*
     * Function to get transactions list by user id 
     */

    public function get_user_advisors($id) {
        $this->db->select('sme_quesns.*,sme_user_profiles.*,');
        $this->db->from('sme_quesns');
        $this->db->join('sme_user_profiles', 'sme_user_profiles.sme_userid = sme_quesns.sme_userid');
        $this->db->where('sme_quesns.userid', $id);


        $query = $this->db->get();
        $query_result = $query->result();
        $sme_details = array();
        foreach ($query_result as $key => $value) {
            $sme_details[$key]['sme_details'] = $value;

            $this->db->select('sme_fb.*');
            $this->db->from('sme_fb');
            $this->db->where('sme_fb.sme_userid', $value->sme_userid);
            $feedback = $this->db->get();
            $feedback_result = $feedback->result();
            $sme_details[$key]['likes'] = count($feedback_result);


            $this->db->select('sme_fb_comments.*');
            $this->db->from('sme_fb_comments');
            $this->db->join('sme_fb', 'sme_fb.id = sme_fb_comments.fb_id');
            $this->db->where('sme_fb.sme_userid', $value->sme_userid);
            $followers = $this->db->get();
            $followers_result = $followers->result();
            $sme_details[$key]['followers'] = count($followers_result);
        }

        return $sme_details;
    }

    public function get_user_memberships($id) {
        $this->db->select('users_membership_details.*,,memberships.*,booking_info.*');
        $this->db->from('users_membership_details');
        $this->db->join('memberships', 'memberships.id = users_membership_details.membership_id');
        $this->db->join('booking_info', 'booking_info.id = users_membership_details.booking_id');
        $this->db->where('users_membership_details.user_id', $id);
        $this->db->where('booking_info.booking_status !=', 'Canceled');

        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();
        foreach ($query_result as $key => $value) {
            $transaction_details[$key]['details'] = $value;

            $this->db->select('business_details.*,services.service_name,locations.suburb as area_name,');
            $this->db->from('business_details');
            $this->db->join('services_business_mapping', 'business_details.id = services_business_mapping.business_id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $transaction_details[$key]['vendor_details'] = $vendor_result[0];
        }

        return $transaction_details;
    }

    public function get_user_reviews($id) {
        $this->db->select('vendor_ratings.*,vendor_ratings.created_on as posted,user_details.*,users.name');
        $this->db->from('vendor_ratings');
        $this->db->join('user_details', 'user_details.user_id = vendor_ratings.user_id');
        $this->db->join('users', 'users.id = user_details.user_id');
        $this->db->where('vendor_ratings.user_id', $id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    public function insert_transaction_details($booking_details) {
        $slot_id = $booking_details['payment_data']['slot_id'];
        $slot_details = self::get_slot_details($slot_id);

        $booking_id = $booking_details['booking_id'];
        $order_id = $booking_details['order_id'];
        $transaction_details_data = array(
            'booking_id' => $booking_id,
            'service_type' => $booking_details['service_type'],
            'transaction_id' => $booking_details['transaction_id'],
            'transaction_status' => $booking_details['order_status'],
            'transaction_date' => date('Y-m-d H:i:s'),
            'paid_by' => $booking_details['payment_data']['user_id'],
            'payment_mode' => $booking_details['payment_data']['payment_mode'],
            'amount' => $booking_details['payment_data']['total_price'],
            'other_information' => $booking_details['other_information'],
        );

        $this->db->insert('transaction_details', $transaction_details_data);

        if ($booking_details['membership_plan_id'] == '' || $booking_details['membership_plan_id'] == 0) {
            $booked_slots_details = array(
                'user_id' => $booking_details['payment_data']['user_id'],
                'slot_id' => $slot_id,
            );

            $this->db->insert('services_booked_slots', $booked_slots_details);




            $remaning_slots = ($slot_details->number_of_slots) - 1;
            if ($remaning_slots > 0) {
                $booked_slots_status_update = array(
                    'number_of_slots' => $remaning_slots,
                );
            } else {
                $booked_slots_status_update = array(
                    'number_of_slots' => $remaning_slots,
                    'active' => 'disable',
                );
            }
            $this->db->where('id', $slot_id);
            $this->db->update('services_slots', $booked_slots_status_update);
        }
        if ($booking_details['membership_plan_id'] != '' && $booking_details['membership_plan_id'] != 0) {
            if ($booking_details['membership_details']->duration == '1 Month') {
                $membership_end_date = date('Y-m-d', (strtotime('+30 days', strtotime($booking_details['choosed_booking_date']))));
            } elseif ($booking_details['membership_details']->duration == '3 Months') {
                $membership_end_date = date('Y-m-d', (strtotime('+90 days', strtotime($booking_details['choosed_booking_date']))));
            } elseif ($booking_details['membership_details']->duration == '6 Months') {
                $membership_end_date = date('Y-m-d', (strtotime('+180 days', strtotime($booking_details['choosed_booking_date']))));
            } else {
                $membership_end_date = date('Y-m-d', (strtotime('+365 days', strtotime($booking_details['choosed_booking_date']))));
            }

            $membership_booking_details_data = array(
                'user_id' => $booking_details['payment_data']['user_id'],
                'membership_id' => $booking_details['membership_plan_id'],
                'booking_id' => $booking_id,
                'membership_start_date' => $booking_details['payment_data']['date'],
                'membership_end_date' => $membership_end_date,
            );

            $this->db->insert('users_membership_details', $membership_booking_details_data);

            $booked_slots_status_update = array(
                'max_number_of_members' => (($booking_details['membership_details']->max_number_of_members) - 1),
            );

            $this->db->where('id', $booking_details['membership_plan_id']);
            $this->db->update('memberships', $booked_slots_status_update);
        }
        $booking_status_update = array(
            'booking_status' => 'Success',
        );

        $this->db->where('order_id', $order_id);
        $this->db->update('booking_info', $booking_status_update);

        return $order_id;
    }
	
	public function get_usercall_bookings($id)
	{
		$today = date('Y-m-d');
		$this->db->select('ub.*,sbs.date,sbs.time_from,sbs.time_to,sup.first_name,sup.photo,cp.book_type');
		$this->db->from('user_sme_book_call ub');
		$this->db->join('sme_users su','su.id = ub.sme_userid','left');
		$this->db->join('sme_user_profiles sup','sup.sme_userid = su.id','left');
		$this->db->join('sme_book_slots sbs','sbs.id = ub.smebookcallid','left');
		$this->db->join('user_chat_pay_trans cp','cp.order_id = ub.order_id','left');
		$this->db->where('ub.userid',$id);
		$this->db->where('sbs.date >=',$today);
		
		$q  = $this->db->get();
		return $q->result();
	}

}
