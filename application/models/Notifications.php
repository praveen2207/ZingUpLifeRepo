<?php

/**
 * This class gives services and details
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:31-08-2015
 * 
 * */
class Notifications extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Function to get user's notifications 
     */

    public function get_user_notifications($user_id) {
        $this->db->select('*');
        $this->db->from('notifications');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $notifications = $query->result();
        return $notifications;
    }
    
    public function update_user_notifications($user_id, $limit = null) {
    	$data = array(
    			'viewed' => 1
    	);
    
    	$this->db->where(array('user_id'=>$user_id, 'viewed'=>0));
    	$this->db->update('notifications', $data);
    }

    /* Above function ends here */
}
