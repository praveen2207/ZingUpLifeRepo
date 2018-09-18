<?php

/**
 * This class used for admin users login and users actions/activities
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:03-09-2015
 * 
 * */
class Vendor extends CI_Model {

    function __construct() {
// Call the Model constructor
        parent::__construct();
        $this->load->library('PasswordHash');
    }

    /*
     *  Function to get user details by given username  
     */

    public function get_all_vendors() {
        $this->db->select('business_details.*,locations.suburb as area_name');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    /*
     *  Function to get user details by given username  
     */

    public function get_vendors_by_service($service_id) {
        $this->db->select('business_details.*,locations.suburb as area_name');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
        $this->db->join('services', 'services_business_mapping.services_id = services.id');
        $this->db->where('services.slug', $service_id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    public function get_vendors_details_and_transactions($id) {
        $this->db->select('business_details.*,business_details.updated_at as business_updated_at,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_details.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $vendor_details = array();
        $vendor_details['vendor_details'] = $query_result[0];

        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.provider_id', $id);
        $this->db->order_by('booking_info.booking_date', 'desc');
        $transaction_query = $this->db->get();
        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $vendor_details['transactions'][$key] = $value;

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $value->user_id);
            $user_query = $this->db->get();
            $mark_attend = $user_query->result();
            if (!empty($mark_attend)) {
                $vendor_details['transactions'][$key]->mark_attend = $mark_attend[0]->status;
            }
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_query_result = $user_query->result();
            $vendor_details['transactions'][$key]->user_details = $user_query_result[0];
        }
        return $vendor_details;
    }

    public function get_vendors_batch_payments($id) {
        $date = date('Y-m-d');
        $date_range = self::week_range($date);



        $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_details.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $vendor_details = array();
        $vendor_details['vendor_details'] = $query_result[0];

        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.provider_id', $id);
        $this->db->order_by('booking_info.booking_date', 'desc');
        $transaction_query = $this->db->get();
        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $vendor_details['transactions'][$key] = $value;

            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_query_result = $user_query->result();
            $vendor_details['transactions'][$key]->user_details = $user_query_result[0];
        }
        return $vendor_details;
    }

    /* Above function ends here */

    public function get_vendors_transactions_by_date_range($id, $start_date, $end_date) {

        $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_details.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $vendor_details = array();
        $vendor_details['vendor_details'] = $query_result[0];
        $vendor_details['transactions'] = array();

        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.provider_id', $id);
        $this->db->where('booking_info.booking_date <', $start_date);
        $this->db->where('booking_info.booking_date >', $end_date);
        $this->db->order_by('booking_info.booking_date', 'desc');
        $transaction_query = $this->db->get();

        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $vendor_details['transactions'][$key] = $value;

            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_query_result = $user_query->result();
            if (!empty($user_query_result)) {
                $vendor_details['transactions'][$key]->user_details = $user_query_result[0];
            } else {
                $vendor_details['transactions'][$key]->user_details = '';
            }
        }
        return $vendor_details;
    }

    /*
     *  Function to delete customer data in database
     */

    public function delete_vendor($vendor_id) {



        $this->db->select('business_details.*');
        $this->db->from('business_details');
        $this->db->where('business_details.business_id', $vendor_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $partner_details = array();
        if (count($query_result) == 0) {
            $partner_details = $query_result;
        } else {
            $partner_details = $query_result[0];
        }

        $this->db->where('business_id', $partner_details->id);
        $this->db->delete('business_gallery');


        $this->db->where('business_id', $vendor_id);
        $this->db->delete('business_details');

        $this->db->where('id', $vendor_id);
        $this->db->delete('vendors');

        return true;
    }

    /*
     *  Function to delete customer data in database
     */

    public function update_vendor_notes($vendor_notes_data) {
        if (isset($vendor_notes_data['customer_support_notes'])) {
            $notes = array(
                'customer_support_notes' => $vendor_notes_data['customer_support_notes'],
            );
        } elseif (isset($vendor_notes_data['finance_notes'])) {
            $notes = array(
                'finance_notes' => $vendor_notes_data['finance_notes'],
            );
        } elseif (isset($vendor_notes_data['admin_notes'])) {
            $notes = array(
                'admin_notes' => $vendor_notes_data['admin_notes'],
            );
        } else {
            
        }

        $this->db->where('id', $vendor_notes_data['vendor_id']);
        $this->db->update('business_details', $notes);

        return true;
    }

    /* Above function ends here */
    /*
     *  Function to get search results for vendors
     */

    public function get_vendors_search($category, $data) {
        if ($category == 'all') {
            if ($data['vr_name'] == '' && $data['vr_loc'] == '' && $data['vr_ph'] == '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] == '' && $data['vr_ph'] == '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.name like "%' . $data['vr_name'] . '%"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] != '' && $data['vr_ph'] == '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.suburb = "' . $data['vr_loc'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] == '' && $data['vr_ph'] != '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.phone = "' . $data['vr_ph'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] == '' && $data['vr_ph'] == '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] != '' && $data['vr_ph'] == '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.name like "%' . $data['vr_name'] . '%" and bd.suburb = "' . $data['vr_loc'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] == '' && $data['vr_ph'] != '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.name like "%' . $data['vr_name'] . '%" and bd.phone = "' . $data['vr_ph'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] == '' && $data['vr_ph'] == '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.name like "%' . $data['vr_name'] . '%" and bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] != '' && $data['vr_ph'] != '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.name like "%' . $data['vr_name'] . '%" and bd.suburb = "' . $data['vr_loc'] . '" and bd.phone = "' . $data['vr_ph'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] != '' && $data['vr_ph'] != '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.name like "%' . $data['vr_name'] . '%" and bd.suburb = "' . $data['vr_loc'] . '" and bd.phone = "' . $data['vr_ph'] . '" and bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] == '' && $data['vr_ph'] != '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.name like "%' . $data['vr_name'] . '%" and bd.phone = "' . $data['vr_ph'] . '" and bd.email like "%' . $data['vr_email'] . '"');
            }

            if ($data['vr_name'] == '' && $data['vr_loc'] != '' && $data['vr_ph'] == '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where  bd.suburb = "' . $data['vr_loc'] . '" and bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] != '' && $data['vr_ph'] != '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.suburb = "' . $data['vr_loc'] . '" and bd.phone = "' . $data['vr_ph'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] != '' && $data['vr_ph'] != '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where  bd.suburb = "' . $data['vr_loc'] . '" and bd.phone = "' . $data['vr_ph'] . '" and bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] == '' && $data['vr_ph'] != '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											where bd.phone = "' . $data['vr_ph'] . '" and bd.email like "%' . $data['vr_email'] . '"');
            }
        } else {
            if ($data['vr_name'] != '' && $data['vr_loc'] != '' && $data['vr_ph'] != '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and bd.name like "%' . $data['vr_name'] . '%" and l.id = "' . $data['vr_loc'] . '" and 
											bd.phone = "' . $data['vr_ph'] . '" and bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] == '' && $data['vr_ph'] == '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] == '' && $data['vr_ph'] == '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and bd.name like "%' . $data['vr_name'] . '%"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] != '' && $data['vr_ph'] == '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and l.id = "' . $data['vr_loc'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] == '' && $data['vr_ph'] != '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and bd.phone = "' . $data['vr_ph'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] == '' && $data['vr_ph'] == '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] != '' && $data['vr_ph'] == '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and bd.name like "%' . $data['vr_name'] . '%" and l.id = "' . $data['vr_loc'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] != '' && $data['vr_ph'] != '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and bd.name like "%' . $data['vr_name'] . '%" and l.id = "' . $data['vr_loc'] . '" and 
											bd.phone = "' . $data['vr_ph'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] != '' && $data['vr_ph'] != '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and l.id = "' . $data['vr_loc'] . '" and bd.phone = "' . $data['vr_ph'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] != '' && $data['vr_ph'] == '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and l.id = "' . $data['vr_loc'] . '" and bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] == '' && $data['vr_loc'] == '' && $data['vr_ph'] != '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and bd.phone = "' . $data['vr_ph'] . '" and bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] == '' && $data['vr_ph'] != '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and bd.name like "%' . $data['vr_name'] . '%" and 
											bd.phone = "' . $data['vr_ph'] . '" and bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] == '' && $data['vr_ph'] == '' && $data['vr_email'] != '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and bd.name like "%' . $data['vr_name'] . '%" and bd.email like "%' . $data['vr_email'] . '"');
            }
            if ($data['vr_name'] != '' && $data['vr_loc'] == '' && $data['vr_ph'] != '' && $data['vr_email'] == '') {
                $query = $this->db->query('select bd.name,bd.id,l.suburb as area_name from business_details bd left join locations l on l.id = bd.suburb
											left join services_business_mapping sbm on sbm.business_id = bd.id left join services s on s.id = sbm.services_id
											where s.slug = "' . $category . '" and bd.name like "%' . $data['vr_name'] . '%" and 
											bd.phone = "' . $data['vr_ph'] . '"');
            }
        }
        return $query->result();
    }

    /* Above function ends here */

    public function get_vendors_details_and_transactions_for_admin($id, $start_date, $end_date) {
        $this->db->select('business_details.*,business_details.updated_at as business_updated_at,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_details.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $vendor_details = array();
        $vendor_details['vendor_details'] = $query_result[0];

        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.provider_id', $id);
        $this->db->where('booking_info.booking_date <', $end_date);
        $this->db->where('booking_info.booking_date >', $start_date);
        $this->db->order_by('booking_info.booking_date', 'desc');
        $transaction_query = $this->db->get();
        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $vendor_details['transactions'][$key] = $value;

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $value->user_id);
            $user_query = $this->db->get();
            $mark_attend = $user_query->result();
            if (!empty($mark_attend)) {
                $vendor_details['transactions'][$key]->mark_attend = $mark_attend[0]->status;
            }
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_query_result = $user_query->result();
            $vendor_details['transactions'][$key]->user_details = $user_query_result[0];
        }
        return $vendor_details;
    }

    public function filter_vendors_details_and_transactions_for_admin($data) {
        $id = $data['vendor_id'];
        $service = $data['service'];
        $start_date = $data['end_date'];
        $end_date = $data['start_date'];


        $this->db->select('business_details.*,business_details.updated_at as business_updated_at,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_details.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $vendor_details = array();
        $vendor_details['vendor_details'] = $query_result[0];
        if ($service != '') {
            $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->join('services_business_mapping', 'booking_info.provider_id = services_business_mapping.business_id');
            $this->db->where('booking_info.provider_id', $id);
            $this->db->where('services_business_mapping.services_id', $service);
            $this->db->where('booking_info.booking_date <', $end_date);
            $this->db->where('booking_info.booking_date >', $start_date);
            $this->db->order_by('booking_info.booking_date', 'desc');
        } else {

            $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->where('booking_info.provider_id', $id);
            $this->db->where('booking_info.booking_date <', $end_date);
            $this->db->where('booking_info.booking_date >', $start_date);
            $this->db->order_by('booking_info.booking_date', 'desc');
        }
        $transaction_query = $this->db->get();
        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $vendor_details['transactions'][$key] = $value;

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $value->user_id);
            $user_query = $this->db->get();
            $mark_attend = $user_query->result();
            if (!empty($mark_attend)) {
                $vendor_details['transactions'][$key]->mark_attend = $mark_attend[0]->status;
            }
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_query_result = $user_query->result();
            $vendor_details['transactions'][$key]->user_details = $user_query_result[0];
        }
        if (!empty($vendor_details['transactions'])) {
            return $vendor_details;
        } else {
            $vendor_details['transactions'] = '';
            return $vendor_details;
        }
        return $vendor_details;
    }

    public function filter_vendors_details_and_transactions_for_cs($data) {
        $id = $data['vendor_id'];
        $service = $data['service'];

        $this->db->select('business_details.*,business_details.updated_at as business_updated_at,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_details.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $vendor_details = array();
        $vendor_details['vendor_details'] = $query_result[0];
        if ($service != '') {
            $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->join('services_business_mapping', 'booking_info.provider_id = services_business_mapping.business_id');
            $this->db->where('booking_info.provider_id', $id);
            $this->db->where('services_business_mapping.services_id', $service);
            $this->db->order_by('booking_info.booking_date', 'desc');
        } else {

            $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->where('booking_info.provider_id', $id);
            $this->db->order_by('booking_info.booking_date', 'desc');
        }
        $transaction_query = $this->db->get();
        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $vendor_details['transactions'][$key] = $value;

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $value->user_id);
            $user_query = $this->db->get();
            $mark_attend = $user_query->result();
            if (!empty($mark_attend)) {
                $vendor_details['transactions'][$key]->mark_attend = $mark_attend[0]->status;
            }
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_query_result = $user_query->result();
            $vendor_details['transactions'][$key]->user_details = $user_query_result[0];
        }
        if (!empty($vendor_details['transactions'])) {
            return $vendor_details;
        } else {
            $vendor_details['transactions'] = '';
            return $vendor_details;
        }
        return $vendor_details;
    }

    public function filter_vendors_details_and_transactions_for_finance($data) {
        $id = $data['vendor_id'];
        $service = $data['service'];

        $this->db->select('business_details.*,business_details.updated_at as business_updated_at,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_details.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $vendor_details = array();
        $vendor_details['vendor_details'] = $query_result[0];
        if ($service != '') {
            $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->join('services_business_mapping', 'booking_info.provider_id = services_business_mapping.business_id');
            $this->db->where('booking_info.provider_id', $id);
            $this->db->where('services_business_mapping.services_id', $service);
            $this->db->order_by('booking_info.booking_date', 'desc');
        } else {
            $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
            $this->db->from('transaction_details');
            $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
            $this->db->join('business_services', 'booking_info.service_id = business_services.id');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
            $this->db->where('booking_info.provider_id', $id);
            $this->db->order_by('booking_info.booking_date', 'desc');
        }
        $transaction_query = $this->db->get();
        $transaction_query_result = $transaction_query->result();


        foreach ($transaction_query_result as $key => $value) {
            $vendor_details['transactions'][$key] = $value;

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $value->user_id);
            $user_query = $this->db->get();
            $mark_attend = $user_query->result();
            if (!empty($mark_attend)) {
                $vendor_details['transactions'][$key]->mark_attend = $mark_attend[0]->status;
            }
            $this->db->select('user_details.*,users.*');
            $this->db->from('user_details');
            $this->db->join('users', 'user_details.user_id = users.id');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_query_result = $user_query->result();
            $vendor_details['transactions'][$key]->user_details = $user_query_result[0];
        }
        if (!empty($vendor_details['transactions'])) {
            return $vendor_details;
        } else {
            $vendor_details['transactions'] = '';
            $vendor_details['vendor_details'] = '';
            return $vendor_details;
        }
    }

    /*
     *  Function to delete customer data in database
     */

    public function update_vendor_status($vendor_data) {
        if ($vendor_data['status'] == 'Activate') {
            $notes = array(
                'status' => 'Active',
            );
        } else {
            $notes = array(
                'status' => 'De-active',
            );
        }

        $this->db->where('id', $vendor_data['id']);
        $this->db->update('business_details', $notes);

        return true;
    }

    /* Above function ends here */



    /*
     *  Function to get business services  
     */

    public function get_business_services() {
        $this->db->select('*');
        $this->db->from('services');
        $query = $this->db->get();
        $query_result = $query->result();

        return $query_result;
    }

    /* Above function ends here */

    /*
     *  Function to get locations  
     */

    public function get_locations() {
        $this->db->select('*');
        $this->db->from('locations');
        $query = $this->db->get();
        $query_result = $query->result();

        return $query_result;
    }

    /* Above function ends here */


    /*
     * Function to insert partner details 
     */

    public function add_partner_registrations($post_data) {
        $hashed = PasswordHash::create_hash('zingup123');

        $partner_details_data = array(
            'username' => $post_data['username'],
            'password' => $hashed,
            'status' => 'De-active',
            'role' => 'vendor',
            'email_verification_status' => 1,
        );
        $this->db->insert('vendors', $partner_details_data);
        $vendor_id = $this->db->insert_id();



        $business_details_data = array(
            'business_id' => $vendor_id,
            'name' => $post_data['business_name'],
            'street1' => $post_data['address1'],
            'street2' => $post_data['address2'],
            'suburb' => $post_data['area'],
            'city' => $post_data['city'],
            'state' => $post_data['state'],
            'country' => $post_data['country'],
            'zipcode' => $post_data['zipcode'],
            'website' => $post_data['website'],
            'email' => $post_data['business_email'],
            'landline' => $post_data['landline'],
            'phone' => $post_data['mobile'],
            'facebook_page' => $post_data['fb_page'],
            'twitter_handle' => $post_data['tw_page'],
            'instagram' => $post_data['instagram'],
            'payment_option' => $post_data['payment_option'],
            'role' => '',
            'status' => 'De-active',
        );
        $this->db->insert('business_details', $business_details_data);


        foreach ($post_data['business_type'] as $type) {

            $business_type = explode('/', $type);
            $business_type_id = $business_type[0];

            $business_mapping = array(
                'services_id' => $business_type_id,
                'business_id' => $vendor_id
            );
            $this->db->insert('services_business_mapping', $business_mapping);
        }

        return true;
    }

    /* Above function ends here */


    /*
     *  Function to get partner details by given username  
     */

    public function get_partner_details_by_username($username) {

        $this->db->select('vendors.*,business_details.id as business_id,business_details.name,business_details.suburb,services_business_mapping.services_id');
        $this->db->from('vendors');
        $this->db->join('business_details', 'business_details.business_id = vendors.id');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
        $this->db->where('vendors.username', $username);

        $query = $this->db->get();
        $query_result = $query->result();

        $partner_details = array();
        if (count($query_result) == 0) {
            $partner_details = $query_result;
        } else {
            $partner_details = $query_result[0];
        }
        return $partner_details;
    }

    /* Above function ends here */


    /*
     *  Function to get partner details by given username  
     */

    public function get_vendor_business_details($partnerid) {
        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->where('id', $partnerid);
        $query = $this->db->get();
        $query_result = $query->result();
        $partner_details = array();
        if (count($query_result) == 0) {
            $partner_details['partner'] = $query_result;
        } else {
            $partner_details['partner'] = $query_result[0];
        }

        $this->db->select('*');
        $this->db->from('business_details');
        $this->db->where('business_id', $partner_details['partner']->id);
        $query1 = $this->db->get();
        $query_result1 = $query1->result();
        if (count($query_result1) == 0) {
            $partner_details['business'] = $query_result1;
        } else {
            $partner_details['business'] = $query_result1[0];
        }
        $this->db->select('*');
        $this->db->from('business_gallery');
        $this->db->where('business_id', $partner_details['business']->id);
        $query2 = $this->db->get();
        $query_result2 = $query2->result();
        //echo "<pre>";print_r($query_result2);exit();

        $partner_details['gallery'] = $query_result2;
        return $partner_details;
    }

    /* Above function ends here */


    /*
     *  Function to get vendor memberships  
     */

    public function get_existing_packages($business_id) {
        $this->db->select('*');
        $this->db->from('business_programs');
        $this->db->where('business_id', $business_id);
        $query = $this->db->get();
        $query_result = $query->result();

        return $query_result;
    }

    /* Above function ends here */



    /*
     *  Function to insert business programs  
     */

    public function insert_business_programs($postdata) {
        $business_details = $this->Vendor->get_business_details_by_id($postdata['business_id']);
        $program_details = array(
            'service_id' => $business_details->services_id,
            'business_id' => $business_details->business_id,
            'program' => $postdata['package'],
            'type' => $postdata['type']
        );

        $this->db->insert('business_programs', $program_details);
        return $this->db->insert_id();
    }

    /* Above function ends here */




    /*
     *  Function to get partner details by id  
     */

    public function get_business_details_by_id($business_id) {

        $this->db->select('business_details.id as business_id,business_details.name,business_details.suburb,services_business_mapping.services_id');
        $this->db->from('business_details');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.business_id');
        $this->db->where('business_details.id', $business_id);

        $query = $this->db->get();
        $query_result = $query->result();
        $partner_details = array();
        if (count($query_result) == 0) {
            $partner_details = $query_result;
        } else {
            $partner_details = $query_result[0];
        }
        return $partner_details;
    }

    /* Above function ends here */


    /*
     *  Function to insert business services  
     */

    public function insert_business_services($postdata, $files) {
        if (!empty($postdata['packages']) && !empty($postdata['service'])) {
            $service_data = array(
                'program_id' => $postdata['packages'],
                'services' => $postdata['service']
            );
        } else
            return false;

        $this->db->insert('business_services', $service_data);
        $service_id = $this->db->insert_id();
        $business_details = $this->Vendor->get_business_details_by_id($postdata['business_id']);
        if (!is_dir('assets/uploads/business_services/gallery/' . $service_id . '/')) {
            mkdir('assets/uploads/business_services/gallery/' . $service_id . '/', 0777, TRUE);
        }
        $path = './assets/uploads/business_services/gallery/' . $service_id . '/';

        $file = $files['file']['name'];
        $count = count($file);
        if ($count > 0) {
            $this->Vendor->delete_business_service_gallery($service_id);
            for ($i = 0; $i < $count; $i++) {
                if ($files['file']['name'][$i]) {
                    $fname = $business_details->name . "_" . $postdata['service'] . "_" . $file[$i];

                    copy($files['file']['tmp_name'][$i], $path . $fname);
                    $image_name = $business_details->name . "_" . $postdata['service'] . "_" . $files['file']['name'][$i];
                    $this->Vendor->insert_business_service_gallery($service_id, $image_name);
                }
            }
        }

        $service_details_data = array(
            'service_id' => $service_id,
            'description' => $postdata['description'],
            'duration' => $postdata['duration'],
            'price' => $postdata['price'],
            'service_type' => $postdata['service_type']
        );

        $this->db->insert('business_services_details', $service_details_data);
        return true;
    }

    /*
     *  Function to delete business service gallery  
     */

    /*
     *  Function to delete business service gallery  
     */

    public function delete_business_service_gallery($service_id) {
        $this->db->where('service_id', $service_id);
        $this->db->delete('business_service_gallery');
    }

    /*
     *  Function to insert business service gallery  
     */

    public function insert_business_service_gallery($service_id, $image_name) {


        $gallery_details = array(
            'service_id' => $service_id,
            'images' => $image_name
        );
        $this->db->insert('business_service_gallery', $gallery_details);
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function delete_business_package($post_data) {
        $this->db->where('id', $post_data['package_id']);
        $this->db->delete('business_programs');

        return true;
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function get_single_package_detail($package_id) {

        $this->db->select('*');
        $this->db->from('business_programs');
        $this->db->where('id', $package_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $package_details = array();
        if (!empty($query_result)) {
            $package_details['package'] = $query_result[0];
        } else {
            $package_details['package'] = $query_result;
        }
        $this->db->select('*');
        $this->db->from('business_services');
        $this->db->where('program_id', $package_id);
        $query2 = $this->db->get();
        $query_result2 = $query2->result();
        if (!empty($query_result2)) {
            $package_details['service'] = $query_result2;
        }
        return $package_details;
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function updating_business_programs($post_data) {
        $updated_data = array(
            'program' => $post_data['package_name']
        );
        $this->db->where('id', $post_data['service_id']);
        $this->db->update('business_programs', $updated_data);



        return true;
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function delete_business_service($post_data) {
        $this->db->where('id', $post_data['service_id']);
        $this->db->delete('business_services');

        return true;
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function get_all_services_listing($business_id) {
        $this->db->select('*');
        $this->db->from('business_programs');
        $this->db->where('business_id', $business_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $details = array();
        foreach ($query_result as $result) {
            $this->db->select('*');
            $this->db->from('business_services');
            $this->db->where('program_id', $result->id);
            $query1 = $this->db->get();
            $query_result1 = $query1->result();
            array_push($details, $query_result1);
        }
        return $details;
    }

    /* Above function ends here */


    /*
     *  Function to update business info  
     */

    public function update_business_information($data, $logoname) {

        $updated_business_data = array(
            'name' => $data['business_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'website' => $data['website'],
            'description' => $data['description'],
            'logo' => $logoname,
            'street1' => $data['address1'],
            'street2' => $data['address2'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'suburb' => $data['area'],
            'zipcode' => $data['zipcode'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude']
        );
        $this->db->where('id', $data['id']);
        $this->db->update('business_details', $updated_business_data);
    }

    /* Above function ends here */

    /*
     *  Function to insert business gallery  
     */

    public function insert_business_gallery($business_id, $image_name) {


        $gallery_details = array(
            'business_id' => $business_id,
            'images' => $image_name
        );

        $this->db->insert('business_gallery', $gallery_details);
    }

    /* Above function ends here */


    /*
     * 
     * 
     * 
     * 
     * **** Added By Vikrant *****
     * 
     * 
     * 
     * 
     */

    /*
     *  Function to get user details by given username  
     */

    public function get_all_packages_by_vendor($id) {
        $this->db->select('business_programs.*');
        $this->db->from('business_programs');
        $this->db->where('business_id', $id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    /*
     * Function to insert partner details 
     */

    public function add_packages($post_data) {
        $package_data = array(
            'service_id' => $post_data['service_id'],
            'business_id' => $post_data['id'],
            'program' => $post_data['name'],
            'type' => $post_data['type'],
        );
        $this->db->insert('business_programs', $package_data);
        return true;
    }

    /* Above function ends here */

    /*
     *  Function to  business services listing  
     */

    public function delete_package($id) {
        $this->db->where('id', $id);
        $this->db->delete('business_programs');
        return true;
    }

    /* Above function ends here */

    /*
     * Function to insert partner details 
     */

    public function get_package_details($id) {
        $this->db->select('business_programs.*,business_details.business_id as partner_id');
        $this->db->from('business_programs');
        $this->db->join('business_details', 'business_details.id = business_programs.business_id');
        $this->db->where('business_programs.id', $id);

        $query = $this->db->get();
        $query_result = $query->result();
        $package_details = array();
        if (!empty($query_result)) {
            $package_details = $query_result[0];
        } else {
            $package_details = $query_result;
        }

        return $package_details;
    }

    /* Above function ends here */



    /*
     * Function to insert partner details 
     */

    public function update_package($post_data) {
        $package_data = array(
            'service_id' => $post_data['service_id'],
            'program' => $post_data['package_name'],
            'type' => $post_data['type']
        );

        $this->db->where('id', $post_data['program_id']);
        $this->db->update('business_programs', $package_data);

        $this->db->select('business_programs.*');
        $this->db->from('business_programs');
        $this->db->where('id', $post_data['program_id']);

        $query = $this->db->get();
        $query_result = $query->result();
        $package_details = array();
        if (!empty($query_result)) {
            $package_details = $query_result[0];
        } else {
            $package_details = $query_result;
        }

        return $package_details->business_id;
    }

    /* Above function ends here */

    /*
     * Function to get services by program id
     */

    public function get_all_offerings_by_vendor($vendor_id) {
        $this->db->select('business_services.*,business_services.id as business_service_id,business_services_details.*,business_programs.*');
        $this->db->from('business_services');
        $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id');
        $this->db->join('business_programs', 'business_services.program_id = business_programs.id');
        $this->db->where('business_programs.business_id', $vendor_id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */


    /*
     * Function to insert partner details 
     */

    public function add_offerings($post_data) {
        $service_data = array(
            'program_id' => $post_data['program_id'],
            'services' => $post_data['services']
        );
        $this->db->insert('business_services', $service_data);
        $service_id = $this->db->insert_id();

        $business_services_details_data = array(
            'service_id' => $service_id,
            'description' => $post_data['description'],
            'duration' => $post_data['duration_hour'] . ':' . $post_data['duration_minutes'],
            'price' => $post_data['price'],
            'service_type' => $post_data['service_type'],
        );
        $this->db->insert('business_services_details', $business_services_details_data);

        return true;
    }

    /* Above function ends here */

    /*
     *  Function to  business services listing  
     */

    public function delete_offerings($id) {
        $this->db->where('id', $id);
        $this->db->delete('business_services');

        $this->db->where('service_id', $id);
        $this->db->delete('business_services_details');


        $this->db->where('service_id', $id);
        $this->db->delete('services_slots');

        return true;
    }

    /* Above function ends here */

    /*
     * Function to get services by program id
     */

    public function get_offering_details($id) {
        $this->db->select('business_services.*,business_services.id as business_service_id,business_services_details.*,business_programs.*');
        $this->db->from('business_services');
        $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id');
        $this->db->join('business_programs', 'business_services.program_id = business_programs.id');
        $this->db->where('business_services.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $service_details = array();
        if (!empty($query_result)) {
            $service_details = $query_result[0];
        } else {
            $service_details = $query_result;
        }

        return $service_details;
    }

    /* Above function ends here */

    /*
     * Function to insert partner details 
     */

    public function update_offerings($post_data) {



        $service_data = array(
            'program_id' => $post_data['program_id'],
            'services' => $post_data['services']
        );
        $this->db->where('id', $post_data['service_id']);
        $this->db->update('business_services', $service_data);

        $business_services_details_data = array(
            'description' => $post_data['description'],
            'duration' => $post_data['duration_hour'] . ':' . $post_data['duration_minutes'],
            'price' => $post_data['price'],
            'service_type' => $post_data['service_type'],
        );
        $this->db->where('service_id', $post_data['service_id']);
        $this->db->update('business_services_details', $business_services_details_data);







        $package_data = array(
            'program' => $post_data['name'],
            'type' => $post_data['type']
        );

        $this->db->where('id', $post_data['id']);
        $this->db->update('business_programs', $package_data);

        $this->db->select('business_programs.*');
        $this->db->from('business_programs');
        $this->db->where('id', $post_data['id']);

        $query = $this->db->get();
        $query_result = $query->result();
        $package_details = array();
        if (!empty($query_result)) {
            $package_details = $query_result[0];
        } else {
            $package_details = $query_result;
        }

        return $package_details->business_id;
    }

    /* Above function ends here */

    /*
     * Function to get services by program id
     */

    public function offerings_filter($search_data) {
        $this->db->select('business_services.*,business_services.id as business_service_id,business_services_details.*,business_programs.*');
        $this->db->from('business_services');
        $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id');
        $this->db->join('business_programs', 'business_services.program_id = business_programs.id');
        $this->db->where('business_programs.business_id', $search_data['id']);
        $this->db->like('business_services.services', $search_data['offering_name']);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    public function get_partner_services_mapping($id) {

        $this->db->select('services_business_mapping.*,services.service_name');
        $this->db->from('services_business_mapping');
        $this->db->join('services', 'services.id = services_business_mapping.services_id', 'right');
        $this->db->where('services_business_mapping.business_id', $id);
        $mapping_query = $this->db->get();
        $mapping_quer_result = $mapping_query->result();
        //echo $this->db->last_query();
        return $mapping_quer_result;
    }

    public function service_slots($service_id) {
        $slot_query = $this->db->get_where('services_slots', array('service_id' => $service_id));
        $slot_query_result = $slot_query->result();
        $slots = array();
        foreach ($slot_query_result as $key => $value) {
            $check_date = date('D', strtotime($value->date));
            if ($check_date == 'Mon') {
                $slots['1'][] = $value;
            } elseif ($check_date == 'Tue') {
                $slots['2'][] = $value;
            } elseif ($check_date == 'Wed') {
                $slots['3'][] = $value;
            } elseif ($check_date == 'Thu') {
                $slots['4'][] = $value;
            } elseif ($check_date == 'Fri') {
                $slots['5'][] = $value;
            } elseif ($check_date == 'Sat') {
                $slots['6'][] = $value;
            } elseif ($check_date == 'Sun') {
                $slots['7'][] = $value;
            }
        }
        ksort($slots);
        return $slots;
    }

}
