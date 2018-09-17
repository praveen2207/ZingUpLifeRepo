<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Landing_page_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    //------------------------------------------------------------------------------------------------------
    public function landing_page_details($page_name) {
	$this->db->select('*');
	$this->db->from('landing_page');
	$this->db->where('page_name',$page_name);
	$result = $this->db->get();
	$landing_detail=$result->result();
	return $landing_detail;
    }
     
}