<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Event_service_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    //------------------------------------------------------------------------------------------------------
    
    public function insert_event($data) {
	$this->db->insert('events_backup',$data);
    }
    
    public function get_users_event_detail($from_date,$to_date,$user_name,$event_type){
    	//print_r($current_date);exit;
    	$today_date = date("Y-m-d");
    	$this->db->select('eb.*,u.name,u.ip_address_original');
    	$this->db->from('events_backup eb');
    	$this->db->join('users u','eb.user_id=u.id','left');
    	if($from_date!='' && $to_date!=''){
    		$this->db->where('eb.insert_timestamp>=',$from_date." 0:00:00");
    		$this->db->where('eb.insert_timestamp<=',$to_date." 23:59:59");
    	}else{
    		$this->db->where('eb.insert_timestamp>=',$today_date." 0:00:00");
    		$this->db->where('eb.insert_timestamp<=',$today_date." 23:59:59");
    	}
    	if($user_name!=""){
    		$this->db->where('u.name>=',$user_name);
    	}
    	if($event_type!=""){
    		$this->db->where('eb.event_type>=',$event_type);
    	}
    	//$this->db->where('eb.insert_timestamp>=',$date." 0:00:00");
    	//$this->db->limit(0,10);
    	$result=$this->db->get();
    	
    	//print_r($result->result()); exit;
    	return $result->result();
    }
}