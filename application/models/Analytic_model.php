<?php
 //error_reporting(E_ALL);
//ini_set('display_errors', 1);
class Analytic_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function getvisitors($end_date,$page_name='',$from_date='',$to_date='') {

	$this->db->select('uald.ip_address,uald.created_at,uald.user_agent,pum.page_name,users.username,COUNT(uald.url_visited) as page_visited_count');
	$this->db->from('user_activity_log_details uald');
	$this->db->join('page_url_mapping pum', 'pum.page_url = uald.url_visited', 'left');
	$this->db->join('users', 'users.id = uald.user_id', 'left');
	//$this->db->where('created_at>=',$end_date);

	if($page_name!=''){
			$this->db->where('uald.url_visited=',$page_name);
		}
	if($from_date!='' && $to_date!=''){							//get records between from date & to date if condition true
			$this->db->where('DATE(uald.created_at)>=',$from_date);
			$this->db->where('DATE(uald.created_at)<=',$to_date);
		}else{													//get records of current date if condition false
			$this->db->where('DATE(uald.created_at)>=',$end_date);
		}
	$this->db->group_by('ip_address');
	$this->db->order_by('created_at asc');

	$query = $this->db->get();
    return $query->result();  // this returns an object of all results
   }

    /*
    * to get all page name of the websites
    */
public function getall_page_name() {
    $this->db->select('page_url,page_name');
	$this->db->from('page_url_mapping');
	$this->db->order_by('page_name asc');

	$query = $this->db->get();
	// echo = $query->result();
    return $query->result();  // this returns an object of all results
   }
   public function get_details($ip_address,$page_name='',$selected_date){
		$date=explode(',',$selected_date);
		$from_date=$date[0];
		$to_date=$date[1];
   		$this->db->select('uald.ip_address,uald.created_at,uald.user_agent,pum.page_name,users.username');
		$this->db->from('user_activity_log_details uald');
		$this->db->join('page_url_mapping pum', 'pum.page_url = uald.url_visited', 'left');
		$this->db->join('users', 'users.id = uald.user_id', 'left');
		if($page_name!=''){
		$this->db->where('uald.url_visited' ,$page_name);
		}
		$this->db->where('uald.ip_address' ,$ip_address);
		$this->db->where('DATE(created_at)>=',$from_date);
		$this->db->where('DATE(created_at)<=',$to_date);
		$this->db->order_by('created_at asc');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		//echo = $query->result();
	    return $query->result();  // this returns an object of all results
   }
}
