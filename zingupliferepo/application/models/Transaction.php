<?php

/**
 * This class used for admin users login and users actions/activities
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:01-09-2015
 * 
 * */
class Transaction extends CI_Model {

    function __construct() {
// Call the Model constructor
        parent::__construct();
    }

    /*
     *  Function to get user details by given username  
     */

    public function get_all_transactions($start_date, $end_date) {
        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.booking_date <=', date('Y-m-d', strtotime($end_date)));
        $this->db->where('booking_info.booking_date >=', date('Y-m-d', strtotime($start_date)));

        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();
        foreach ($query_result as $key => $value) {
            $transaction_details[$key]['transactions'] = $value;

            $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $transaction_details[$key]['vendor_details'] = $vendor_result[0];

            $current_date = date('Y-m-d');
            if ($value->date < $current_date) {
                $transaction_details[$key]['transactions']->expiry = 'yes';
            } else {
                $transaction_details[$key]['transactions']->expiry = 'no';
            }

            $this->db->select('users.id,users.name,users.username');
            $this->db->from('users');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_result = $user_query->result();
            $transaction_details[$key]['user_details'] = $user_result[0];

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $value->user_id);
            $slot_query = $this->db->get();
            $mark_attend = $slot_query->result();
            if (!empty($mark_attend)) {
                $transaction_details[$key]['mark_attend'] = $mark_attend[0];
            }
        }
        return $transaction_details;
    }

    /* Above function ends here */

    /*
     *  Function to confirm order  
     */

    public function confirm_order($booking_id) {
        $data = array(
            'booking_status' => 'Success',
        );
        $this->db->where('id', $booking_id);
        $this->db->update('booking_info', $data);
        return true;
    }

    /* Above function ends here */

    /*
     *  Function to confirm order  
     */

    public function admin_confirm_order($booking_id) {
        $data = array(
            'booking_status' => 'Success',
        );
        $this->db->where('id', $booking_id);
        $this->db->update('booking_info', $data);
        return true;
    }

    /* Above function ends here */

    /*
     *  Function to mark as attend  
     */

    public function mark_as_attend($user_id, $slot_id) {
        $data = array(
            'status' => 'Attended',
        );
        $this->db->where('user_id', $user_id);
        $this->db->where('slot_id', $slot_id);
        $this->db->update('services_booked_slots', $data);
        return true;
    }

    /* Above function ends here */


    /*
     *  Function to mark as attend  
     */

    public function admin_mark_as_attend($user_id, $slot_id) {
        $data = array(
            'status' => 'Attended',
        );
        $this->db->where('user_id', $user_id);
        $this->db->where('slot_id', $slot_id);
        $this->db->update('services_booked_slots', $data);
        return true;
    }

    /* Above function ends here */


    /*
     *  Function to remind customer   
     */

    public function remind_customer($user_id, $booking_id, $slot_id) {
        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.id', $booking_id);
        $query = $this->db->get();
        $query_result = $query->result();

        $order_details = array();

        $data['transaction_details'] = $order_details['transactions'] = $query_result[0];


        $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_details.id', $order_details['transactions']->provider_id);
        $vendor_query = $this->db->get();
        $vendor_result = $vendor_query->result();
        $data['vendor_details'] = $order_details['vendor_details'] = $vendor_result[0];


        $this->db->select('users.id,users.name,users.username,user_details.phone');
        $this->db->from('users');
        $this->db->join('user_details', 'user_details.user_id = users.id');
        $this->db->where('users.id', $order_details['transactions']->paid_by);
        $user_query = $this->db->get();
        $user_result = $user_query->result();
        $data['user_details'] = $order_details['user_details'] = $user_result[0];
        $current_time = strtotime(date('Y-m-d h:i'));
        $slot_time = strtotime($data['transaction_details']->date . '' . date("g:i", strtotime($data['transaction_details']->start_time)));
        $time_difference = abs($slot_time - $current_time);
        $remaining_time = floor($time_difference / 3600);
        $data['remaining_time'] = $remaining_time;
        $email_content = $this->load->view('admin/emails/remind_customer_email', $data, true);
        $to = $order_details['user_details']->username;
        $from = "Zingup";
        $subject = "Zingup Reminder.";
        $message = $email_content;

        $this->Mailing->send_mail($to, $from, $subject, $message);
        if ($data['transaction_details']->start_time >= 12) {
            $meridian = 'PM';
        } else {
            $meridian = 'AM';
        }
        $time = date('H:i', strtotime($data['transaction_details']->start_time)) . ' ' . $meridian;

        $messgae_to = '+91' . $order_details['user_details']->phone;
        $sms_content = 'This is to remind,You have left ' . $remaining_time . ' hrs to attend ' . $data['transaction_details']->services . ' Programme '
                . 'at ' . $data['vendor_details']->name . ', ' . $data['vendor_details']->area_name . ' '
                . 'on Date: ' . date("l, F j, Y", strtotime($data['transaction_details']->booking_date)) . ', '
                . 'Time: ' . $time . ' Cost: ' . $data['transaction_details']->amount . '';
        $this->Mailing->send_sms($messgae_to, $sms_content);
        return true;
    }

    /* Above function ends here */

    /*
     *  Function to remind customer   
     */

    public function admin_remind_customer($user_id, $booking_id, $slot_id) {
        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.id', $booking_id);
        $query = $this->db->get();
        $query_result = $query->result();

        $order_details = array();

        $data['transaction_details'] = $order_details['transactions'] = $query_result[0];


        $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_details.id', $order_details['transactions']->provider_id);
        $vendor_query = $this->db->get();
        $vendor_result = $vendor_query->result();
        $data['vendor_details'] = $order_details['vendor_details'] = $vendor_result[0];


        $this->db->select('users.id,users.name,users.username,user_details.phone');
        $this->db->from('users');
        $this->db->join('user_details', 'user_details.user_id = users.id');
        $this->db->where('users.id', $order_details['transactions']->paid_by);
        $user_query = $this->db->get();
        $user_result = $user_query->result();
        $data['user_details'] = $order_details['user_details'] = $user_result[0];
        $current_time = strtotime(date('Y-m-d h:i'));
        $slot_time = strtotime($data['transaction_details']->date . '' . date("g:i", strtotime($data['transaction_details']->start_time)));
        $time_difference = abs($slot_time - $current_time);
        $remaining_time = floor($time_difference / 3600);
        $data['remaining_time'] = $remaining_time;
        $email_content = $this->load->view('admin/emails/admin_remind_customer_email', $data, true);
        $to = $order_details['user_details']->username;
        $from = "Zingup";
        $subject = "Zingup Reminder.";
        $message = $email_content;

        $this->Mailing->send_mail($to, $from, $subject, $message);
        if ($data['transaction_details']->start_time >= 12) {
            $meridian = 'PM';
        } else {
            $meridian = 'AM';
        }
        $time = date('H:i', strtotime($data['transaction_details']->start_time)) . ' ' . $meridian;

        $messgae_to = '+91' . $order_details['user_details']->phone;
        $sms_content = 'This is to remind,You have left ' . $remaining_time . ' hrs to attend ' . $data['transaction_details']->services . ' Programme '
                . 'at ' . $data['vendor_details']->name . ', ' . $data['vendor_details']->area_name . ' '
                . 'on Date: ' . date("l, F j, Y", strtotime($data['transaction_details']->booking_date)) . ', '
                . 'Time: ' . $time . ' Cost: ' . $data['transaction_details']->amount . '';
        $this->Mailing->send_sms($messgae_to, $sms_content);
        return true;
    }

    /* Above function ends here */


    /*
     *  Function to get order details by booking id   
     */

    public function get_order_details($booking_id) {
        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('booking_info.id', $booking_id);
        $query = $this->db->get();
        $query_result = $query->result();

        $order_details = array();
        if (count($query_result) == 0) {
            $order_details['transactions'] = $query_result;
        } else {
            $order_details['transactions'] = $query_result[0];
        }

        $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_details.id', $order_details['transactions']->provider_id);
        $vendor_query = $this->db->get();
        $vendor_result = $vendor_query->result();
        $order_details['vendor_details'] = $vendor_result[0];


        $this->db->select('users.id,users.name,users.username,user_details.phone');
        $this->db->from('users');
        $this->db->join('user_details', 'user_details.user_id = users.id');
        $this->db->where('users.id', $order_details['transactions']->paid_by);
        $user_query = $this->db->get();
        $user_result = $user_query->result();
        $order_details['user_details'] = $user_result[0];

        $this->db->select('services_booked_slots.status');
        $this->db->from('services_booked_slots');
        $this->db->where('services_booked_slots.slot_id', $order_details['transactions']->slot_id);
        $this->db->where('services_booked_slots.user_id', $order_details['user_details']->id);
        $user_query = $this->db->get();
        $mark_attend = $user_query->result();
        if (!empty($mark_attend)) {
            $order_details['mark_attend'] = $mark_attend[0];
        }
        return $order_details;
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
            'status' => 'Not-attended'
        );

        $this->db->insert('services_booked_slots', $booked_slots_details);

        $booked_slot_id = array(
            'slot_id' => $data['new_slot_id'],
        );

        $this->db->where('id', $data['booking_id']);
        $this->db->update('booking_info', $booked_slot_id);

        $this->session->unset_userdata('selected_date');
        $this->session->unset_userdata('selected_time');
        return true;
    }

    /* Above function ends here */

    /*
     *  Function to get search results for customer support transactions
     */

    public function get_transactions_search($data) {
	if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['ph_no'] == '' && $data['email_id'] == '') {
            $query = $this->db->query("select  td.booking_id,u.id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id");
        }
        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['ph_no'] == '' && $data['email_id'] == '') {
            $query = $this->db->query("select  td.booking_id,u.id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '" . $data['ord_id'] . "'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['ph_no'] == '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '" . $data['cus_id'] . "'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['ph_no'] == '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name LIKE '%" . $data['cus_name'] . "%'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['ph_no'] != '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where ud.phone LIKE '%" . $data['ph_no'] . "%'");
        }
        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['ph_no'] == '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.username LIKE '%" . $data['email_id'] . "%'");
        }

        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['ph_no'] == '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '" . $data['ord_id'] . "' and u.id = '" . $data['cus_id'] . "'");
        }

        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['ph_no'] == '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '" . $data['ord_id'] . "' and u.name LIKE '%" . $data['cus_name'] . "%'");
        }

        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['ph_no'] != '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '" . $data['ord_id'] . "' and ud.phone LIKE '%" . $data['ph_no'] . "%'");
        }

        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['ph_no'] == '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '" . $data['ord_id'] . "' and u.username LIKE '%" . $data['email_id'] . "%'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['ph_no'] == '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '" . $data['cus_id'] . "' and u.name LIKE '%" . $data['cus_name'] . "%'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['ph_no'] != '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '" . $data['cus_id'] . "' and ud.phone LIKE '%" . $data['ph_no'] . "%'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['ph_no'] == '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '" . $data['cus_id'] . "' and u.username LIKE '%" . $data['email_id'] . "%'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['ph_no'] != '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name LIKE '%" . $data['cus_name'] . "%' and ud.phone LIKE '%" . $data['ph_no'] . "%'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['ph_no'] == '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name LIKE '%" . $data['cus_name'] . "%' and u.username LIKE '%" . $data['email_id'] . "%'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['ph_no'] != '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where ud.phone LIKE '%" . $data['ph_no'] . "%' and u.username LIKE '%" . $data['email_id'] . "%'");
        }

        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['ph_no'] == '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '" . $data['ord_id'] . "' and u.id = '" . $data['cus_id'] . "' and u.name LIKE '%" . $data['cus_name'] . "%'");
        }

        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['ph_no'] != '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '" . $data['ord_id'] . "' and ud.phone LIKE '%" . $data['ph_no'] . "%' and u.name LIKE '%" . $data['cus_name'] . "%'");
        }

        if ($data['ord_id'] != '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['ph_no'] != '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '" . $data['ord_id'] . "' and ud.phone LIKE '%" . $data['ph_no'] . "%' and  u.username LIKE '%" . $data['email_id'] . "%'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] == '' && $data['ph_no'] == '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['ph_no'] != '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '" . $data['cus_id'] . "' and u.name LIKE '%" . $data['cus_name'] . "%' and ud.phone LIKE '%" . $data['ph_no'] . "%'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] == '' && $data['ph_no'] != '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '" . $data['cus_id'] . "' and u.username LIKE '%" . $data['email_id'] . "%' and ud.phone LIKE '%" . $data['ph_no'] . "%'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] == '' && $data['cus_name'] != '' && $data['ph_no'] != '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name LIKE '%" . $data['cus_name'] . "%' and u.username LIKE '%" . $data['email_id'] . "%' and ud.phone LIKE '%" . $data['ph_no'] . "%'");
        }

        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['ph_no'] != '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name LIKE '%" . $data['cus_name'] . "%' and u.username LIKE '%" . $data['email_id'] . "%' and ud.phone LIKE '%" . $data['ph_no'] . "%' and td.booking_id = '" . $data['ord_id'] . "' and  u.id = '" . $data['cus_id'] . "'");
        }

        if ($data['ord_id'] == '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['ph_no'] != '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name LIKE '%" . $data['cus_name'] . "%' and u.username LIKE '%" . $data['email_id'] . "% and ud.phone LIKE '%" . $data['ph_no'] . "%' and  u.id = '" . $data['cus_id'] . "'");
        }

        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['ph_no'] != '' && $data['email_id'] == '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name LIKE '%" . $data['cus_name'] . "%'  and ud.phone LIKE '%" . $data['ph_no'] . "%' and td.booking_id = '" . $data['ord_id'] . "' and  u.id = '" . $data['cus_id'] . "'");
        }

        if ($data['ord_id'] != '' && $data['cus_id'] != '' && $data['cus_name'] != '' && $data['ph_no'] == '' && $data['email_id'] != '') {
            $query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,bi.booking_status,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,ss.id as slot_id,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name LIKE '%" . $data['cus_name'] . "%' and u.username LIKE '%" . $data['email_id'] . "%  and td.booking_id = '" . $data['ord_id'] . "' and  u.id = '" . $data['cus_id'] . "'");
        }
        $query_result = $query->result();
        $transaction_details = array();
        foreach ($query_result as $key => $value) {
            $transaction_details[$key]['transactions'] = $value;

            $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $transaction_details[$key]['vendor_details'] = $vendor_result[0];

            $current_date = date('Y-m-d');
            if ($value->date < $current_date) {
                $transaction_details[$key]['transactions']->expiry = 'yes';
            } else {
                $transaction_details[$key]['transactions']->expiry = 'no';
            }

            $this->db->select('users.id,users.name,users.username');
            $this->db->from('users');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_result = $user_query->result();
            $transaction_details[$key]['user_details'] = $user_result[0];

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $value->paid_by);
            $slot_query = $this->db->get();
            $mark_attend = $slot_query->result();
            if (!empty($mark_attend)) {
                $transaction_details[$key]['mark_attend'] = $mark_attend[0];
            }
        }
        return $transaction_details;
    }

    /* Above function ends here */

    /*
     *  Function to get search results for customer support transactions
     */

    public function finance_transactions_listing_filter($search_data) {
        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        //$this->db->where('booking_info.booking_date ', $start_date);


        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();

        foreach ($query_result as $key => $value) {

            if ($search_data['service'] == '' && $search_data['vendor'] == '' && $search_data['location'] == '') {
                $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->where('business_details.id', $value->provider_id);
            } elseif ($search_data['service'] != '' && $search_data['vendor'] == '' && $search_data['location'] == '') {
                $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'business_details.id = services_business_mapping.business_id');
                $this->db->where('business_details.id', $value->provider_id);
                $this->db->where('services_business_mapping.services_id', $search_data['service']);
            } elseif ($search_data['service'] == '' && $search_data['vendor'] != '' && $search_data['location'] == '') {
                $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->where('business_details.id', $value->provider_id);
                $this->db->where('business_details.id', $search_data['vendor']);
            } elseif ($search_data['service'] == '' && $search_data['vendor'] == '' && $search_data['location'] != '') {
                $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->where('business_details.id', $value->provider_id);
                $this->db->where('business_details.suburb', $search_data['location']);
            } elseif ($search_data['service'] != '' && $search_data['vendor'] != '' && $search_data['location'] == '') {
                $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'business_details.id = services_business_mapping.business_id');
                $this->db->where('business_details.id', $value->provider_id);
                $this->db->where('services_business_mapping.services_id', $search_data['service']);
                $this->db->where('business_details.id', $search_data['vendor']);
            } elseif ($search_data['service'] != '' && $search_data['vendor'] == '' && $search_data['location'] != '') {
                $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'business_details.id = services_business_mapping.business_id');
                $this->db->where('business_details.id', $value->provider_id);
                $this->db->where('services_business_mapping.services_id', $search_data['service']);
                $this->db->where('business_details.suburb', $search_data['location']);
            } elseif ($search_data['service'] == '' && $search_data['vendor'] != '' && $search_data['location'] != '') {
                $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->where('business_details.id', $value->provider_id);
                $this->db->where('business_details.id', $search_data['vendor']);
                $this->db->where('business_details.suburb', $search_data['location']);
            } elseif ($search_data['service'] != '' && $search_data['vendor'] != '' && $search_data['location'] != '') {
                $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'business_details.id = services_business_mapping.business_id');
                $this->db->where('business_details.id', $value->provider_id);
                $this->db->where('services_business_mapping.services_id', $search_data['service']);
                $this->db->where('business_details.id', $search_data['vendor']);
                $this->db->where('business_details.suburb', $search_data['location']);
            } else {
                $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->where('business_details.id', $value->provider_id);
            }

            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            if (!empty($vendor_result)) {
                $transaction_details[$key]['transactions'] = $value;
                $transaction_details[$key]['vendor_details'] = $vendor_result[0];

                $current_date = date('Y-m-d');
                if ($value->date < $current_date) {
                    $transaction_details[$key]['transactions']->expiry = 'yes';
                } else {
                    $transaction_details[$key]['transactions']->expiry = 'no';
                }

                $this->db->select('users.id,users.name,users.username');
                $this->db->from('users');
                $this->db->where('users.id', $value->paid_by);
                $user_query = $this->db->get();
                $user_result = $user_query->result();
                $transaction_details[$key]['user_details'] = $user_result[0];

                $this->db->select('services_booked_slots.status');
                $this->db->from('services_booked_slots');
                $this->db->where('services_booked_slots.slot_id', $value->slot_id);
                $this->db->where('services_booked_slots.user_id', $value->user_id);
                $slot_query = $this->db->get();
                $mark_attend = $slot_query->result();
                if (!empty($mark_attend)) {
                    $transaction_details[$key]['mark_attend'] = $mark_attend[0];
                }
            }
        }
        if (!empty($transaction_details)) {
            return $transaction_details;
        } else {
            //$transaction_details['transactions'] = '';
            return '';
        }
    }

    /* Above function ends here */

    /*
     *  Function to get user details by given username  
     */

    public function get_all_transactions_for_finance($start_date) {
        $date = date('Y-m-d', strtotime($start_date));
        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->like('booking_info.booking_date', $date);


        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();
        foreach ($query_result as $key => $value) {
            $transaction_details[$key]['transactions'] = $value;

            $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();

            if (count($vendor_result) != 0) {
                $transaction_details[$key]['vendor_details'] = $vendor_result[0];
            } else {
                $transaction_details[$key]['vendor_details'] = '';
            }

            $current_date = date('Y-m-d');
            if ($value->date < $current_date) {
                $transaction_details[$key]['transactions']->expiry = 'yes';
            } else {
                $transaction_details[$key]['transactions']->expiry = 'no';
            }

            $this->db->select('users.id,users.name,users.username');
            $this->db->from('users');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_result = $user_query->result();
            $transaction_details[$key]['user_details'] = $user_result[0];

            $this->db->select('services_booked_slots.status');
            $this->db->from('services_booked_slots');
            $this->db->where('services_booked_slots.slot_id', $value->slot_id);
            $this->db->where('services_booked_slots.user_id', $value->user_id);
            $slot_query = $this->db->get();
            $mark_attend = $slot_query->result();
            if (!empty($mark_attend)) {
                $transaction_details[$key]['mark_attend'] = $mark_attend[0];
            }
        }
        return $transaction_details;
    }

    /* Above function ends here */
}
