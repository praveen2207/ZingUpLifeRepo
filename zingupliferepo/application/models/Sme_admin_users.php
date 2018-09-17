<?php

/**
 * This class used for admin users login and users actions/activities
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:01-09-2015
 * 
 * */
class Sme_admin_users extends CI_Model {

    function __construct() {
// Call the Model constructor
        parent::__construct();
    }

    public function get_all_users() {
        $query = $this->db->query('select * from sme_users u left join sme_user_profiles p on p.sme_userid = u.id ORDER BY u.ranking = 0, u.ranking');
        return $query->result();
    }
	
	 public function search_user($search_data) {
        if ($search_data['name'] == '') {
            $query = $this->db->query('select * from sme_users u left join sme_user_profiles p on p.sme_userid = u.id');
			
        } elseif ($search_data['name'] != '') {
            $query = $this->db->query('select * from sme_users u left join sme_user_profiles p on p.sme_userid = u.id where p.first_name like "%'.$search_data['name'].'%"');
			
        } 
        $query_result = $query->result();
        return $query_result;
    }
	
	public function check_username_availability($username)
	{
		$query = $this->db->query('select * from sme_users where username="'.$username.'"');
		return $query->result();
	}
	
	public function create_user($user_data, $hashed) {
        //create_user

        $new_user_data = array(
            'username' => $user_data['username'],
            'password' => $hashed,
            'active' => 'n'
        );
        $this->db->insert('sme_users', $new_user_data);
        $user_id = $this->db->insert_id();


        $new_user_profile_data = array(
            'sme_userid' => $user_id,
			'first_name' => $user_data['name'],
            'gender' => $user_data['gender'],
            'phone' => $user_data['phone']
        );
        $this->db->insert('sme_user_profiles', $new_user_profile_data);
		
		$offering = array('sme_userid' => $user_id,'offerings_id' => $user_data['offering']);    
		$this->db->insert('sme_user_offerings', $offering);

        return true;
    }
	
	public function user_details($id) {
        $query = $this->db->query('select * from sme_users u left join sme_user_profiles p on p.sme_userid = u.id where u.id="'.$id.'"');
		$row = $query->result();
        return $row[0];
    }
	
	public function update_user_details($user_data) {
        $user_id = $user_data['user_id'];
        unset($user_data['user_id']);
        unset($user_data['submit']);
		
		$ranking = array('ranking' => $user_data['ranking'] );
		 $this->db->where('id', $user_id);
        $this->db->update('sme_users', $ranking);

        $updated_user_data = array(
            'first_name' => $user_data['name'],
			'phone'      => $user_data['phone'],
			'gender'     => $user_data['gender'], 
        );
        $this->db->where('sme_userid', $user_id);
        $this->db->update('sme_user_profiles', $updated_user_data);
       
        return TRUE;
    }
	
	 public function delete_user($user_id) {
        $this->db->where('sme_userid', $user_id);
        $this->db->delete('sme_user_profiles');

        $this->db->where('id', $user_id);
        $this->db->delete('sme_users');
		
        return TRUE;
    }
    
    public function get_all_events() {
        $query = $this->db->query('select e.*,p.first_name,p.last_name from sme_events e left join sme_user_profiles p on p.sme_userid = e.sme_userid order by e.date desc');
        return $query->result();
    }
    
    public function search_event($search_data) {
        if ($search_data['name'] == '') {
            $query = $this->db->query('select e.*,p.first_name,p.last_name from sme_events e left join sme_user_profiles p on p.sme_userid = e.sme_userid');
			
        } elseif ($search_data['name'] != '') {
            $query = $this->db->query('select e.*,p.first_name,p.last_name from sme_events e left join sme_user_profiles p on p.sme_userid = e.sme_userid where e.title like "%'.$search_data['name'].'%"');
			
        } 
        $query_result = $query->result();
        return $query_result;
    }
    
    public function create_event($data)
    {
		$date = str_replace('/', '-', $data['date']);
		$date =  date('Y-m-d', strtotime($date));


		$dataarray = array(
					'sme_userid'      =>  $data['sme_user'],
					'title'           =>  $data['title'],
					'description'     =>  $data['description'],
					'location'        =>  $data['location'],
					'date'            =>  $date,
					'start_time'      =>  $data['start_time'],
					'duration'        =>  $data['duration'],
					'total_slots'     =>  $data['total_slots'],
					'slots_available' =>  $data['slots_available'],
					'joining_fee'     =>  $data['joining_fee'],
					'discount'        =>  $data['discount']  
					);
					
		$this->db->insert('sme_events',$dataarray);
		return true;
	}
	
	public function event_details($id)
	{
		$query = $this->db->query('select e.*,p.first_name,p.last_name from sme_events e left join sme_user_profiles p on p.sme_userid = e.sme_userid where e.id ="'.$id.'"');
		$row = $query->result();
		return $row[0];
	}
	
	public function update_event($data,$id)
	{
		$date = str_replace('/', '-', $data['date']);
		$date =  date('Y-m-d', strtotime($date));


		$dataarray = array(
					'sme_userid'      =>  $data['sme_user'],
					'title'           =>  $data['title'],
					'description'     =>  $data['description'],
					'location'        =>  $data['location'],
					'date'            =>  $date,
					'start_time'      =>  $data['start_time'],
					'duration'        =>  $data['duration'],
					'total_slots'     =>  $data['total_slots'],
					'slots_available' =>  $data['slots_available'],
					'joining_fee'     =>  $data['joining_fee'],
					'discount'        =>  $data['discount']  
					);
		$this->db->where('id',$id);
		$this->db->update('sme_events',$dataarray);
		return true;
	}
	
	public function delete_event($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('sme_events');
	}

	public function get_all_articles()
	{
		$query = $this->db->query('select a.*,p.first_name,p.last_name from sme_articles a left join sme_user_profiles p on p.sme_userid = a.sme_userid order by  a.added_on desc');
		return $query->result();
	}
	
	public function search_article($search_data)
	{
		 if ($search_data['article'] == '') {
            $query = $this->db->query('select a.*,p.first_name,p.last_name from sme_articles a left join sme_user_profiles p on p.sme_userid = a.sme_userid');
			
        } elseif ($search_data['article'] != '') {
            $query = $this->db->query('select a.*,p.first_name,p.last_name from sme_articles a left join sme_user_profiles p on p.sme_userid = a.sme_userid where a.heading like "%'.$search_data['article'].'%"');
			
        } 
        $query_result = $query->result();
        return $query_result;
	}
	
	public function create_article($data)
    {

		$dataarray = array(
					'sme_userid'      =>  $data['sme_user'],
					'heading'         =>  $data['heading'],
					'content'         =>  $data['content']
					);
					
		$this->db->insert('sme_articles',$dataarray);
		return true;
	}
	
	public function article_details($id)
	{
		$query = $this->db->query('select e.*,p.first_name,p.last_name from sme_articles e left join sme_user_profiles p on p.sme_userid = e.sme_userid where e.id ="'.$id.'"');
		$row = $query->result();
		return $row[0];
	}
	
	public function update_article($data,$id)
	{
		$dataarray = array(
					'sme_userid'  =>  $data['sme_user'],
					'heading'     =>  $data['heading'],
					'content'     =>  $data['content']
					);
		$this->db->where('id',$id);
		$this->db->update('sme_articles',$dataarray);
		return true;
	}
	
	public function delete_article($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('sme_articles');
	}
	
	public function getallmainservices()
	{
		$query = $this->db->query('select * from services');
		return $query->result();
	}
	
	public function getprograms($id)
	{
		$query = $this->db->query('select * from business_programs where service_id ="'.$id.'"');
		return $query->result();
	}
	
	public function getofferings($id)
	{
		$query = $this->db->query('select * from business_services where program_id ="'.$id.'"');
		return $query->result();
	}
	
	public function change_status($status,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('sme_users',array('status' => $status));
	}

	public function get_amt()
	{
		$q = $this->db->query('select * from user_packages');
		return $q->result();
	}
	
	public function update_amount($amount,$id)
	{
		$dataarray = array(
					'amount'  =>  $amount
					);
		$this->db->where('id',$id);
		$this->db->update('user_packages',$dataarray);
	}

}
