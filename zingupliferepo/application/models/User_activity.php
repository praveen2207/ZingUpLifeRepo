<?php

/**
 * This class for inserting and updating user activity logs
 * 
 * @author Anitha <anitha@nuvodev.com>
 * 
 * Date:06-08-2015
 * 
 * */
class User_activity extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Function to insert user activity log details
     */

    public function insert_user_activity() {
        $session_id = session_id();

        $this->db->select('id,start_time');
        $this->db->from('user_activity_log_details');
        $this->db->where('session_id', $session_id);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(1, 0);
        $query = $this->db->get();

        $query_result = $query->result();

        if (count($query_result) == 0) {
            $user_activity_log_details = $query_result;
        } else {
            $user_activity_log_details = $query_result[0];
        }

        if (!empty($user_activity_log_details)) {

            $current_time = date('H:i:s');
            $start_time = $user_activity_log_details->start_time;
            $duration = abs(strtotime($current_time) - strtotime($start_time));

            $user_activity_data = array(
                'end_time' => $current_time,
                'duration' => $duration
            );
            $this->db->where('id', $user_activity_log_details->id);
            $this->db->update('user_activity_log_details', $user_activity_data);
        }

        $ip = $this->input->ip_address();
        $current_url = current_url();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');

        if (!empty($logged_in_user_data)) {
            $user_id = $this->session->userdata('logged_in_user_data')->id;
            $role = $this->session->userdata('logged_in_user_data')->role;
            $user_activity_data = array(
                'user_id' => $user_id,
                'url_visited' => $current_url,
                'user_agent' => $user_agent,
                'session_id' => $session_id,
                'date' => $current_date,
                'start_time' => $current_time,
                'user_type' => $role,
                'ip_address' => $ip
            );
        } else {
            $user_activity_data = array(
            	'user_id' => 'guest',
                'url_visited' => $current_url,
                'user_agent' => $user_agent,
                'session_id' => $session_id,
                'date' => $current_date,
                'start_time' => $current_time,
                'ip_address' => $ip
            );
        }
		
		$this->db->insert('user_activity_log_details', $user_activity_data);
		return true;
    }

    /* Above function ends here */
}
