<?php

/*
 * To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

class Org_access_code_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	//------------------------------------------------------------------------------------------------------

	public function check_availability_of_access_code($access_code) {
		$this->db->select("access_code");
		$this->db->from("organisation_access_code");
		$this->db->where("access_code",$access_code);
		$this->db->where("access_code_status","Y");
		$ans=$this->db->get();
		if($ans->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	public function add_access_code($access_codes,$company_name) {
		$noac=count($access_codes);
		//print_r($access_codes); exit; //no of access	code
		for($i=0;$i<$noac;$i++){
			$array=array(
					"access_code"=>$access_codes[$i],
					"organisation"=>$company_name
			);
			$this->db->insert('organisation_access_code',$array);
		}
		return true;
	}
	
	public function get_org_logo($company_name) {
	    $this->db->select("org_logo");
	    $this->db->from("organisation_access_code");
	    $this->db->where("organisation",$company_name);
	    $this->db->limit(1);
	    $ans=$this->db->get();
	    return $ans->result();
	}
}