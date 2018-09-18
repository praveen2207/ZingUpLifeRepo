<?php
class Utilitiesmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function getCountry(){
		$query = $this->db->query('select id,country_name from country order by country_name asc');
		
		return $query->result();; 
	}
	
	function getData($loadType,$loadId){
		
		if($loadType=="state"){
			$query = $this->db->query('select id,state_name as name from state where country_id = "' . $loadId . '" order by state_name asc');
			return $query->result();
									
		}else{
			$query = $this->db->query('select id,city_name as name from city where state_id = "' . $loadId . '" order by city_name asc');
			return $query->result();
		}
	}
	function getStatelist($country){
		$query = $this->db->query('select id,state_name from state where country_id = "' . $country . '" order by state_name asc');
		return $query->result(); 
	}
	
	function getCitylist($state){
		$query = $this->db->query('select id,city_name from city where state_id = "' . $state . '" order by city_name asc');
		return $query->result(); 
	}
	public function flag_checking($key_name){
		$this->db->select('key_value');
		$this->db->from("config_param");
		$this->db->where("key_name",$key_name);
		$this->db->where("key_value","enable");
		$ans=$this->db->get();
		if($ans->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
}
?>