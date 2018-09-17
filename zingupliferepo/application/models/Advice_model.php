<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advice_model extends CI_Model {

    public $timezone;
    function __construct() {
        parent::__construct();
        $this->load->config('db_constants');
        $this->load->library('Curl');
        $this->timezone = date('Y-m-d\TH:i:s\Z', time());
    }
    
    /*
     *	 Retrive advice details by user id
     */
	 public function user_retrieve_advice($user_id){
	  	
	    $this->db->select('a.advice_id,a.goal_id,a.advice_type,a.advice_description,b.added_on,b.user_advice_id,b.share_by_user_id');
	    $this->db->from('zul_advice_master a');
	    $this->db->join('zul_user_advice b','a.advice_id = b.advice_id','inner');
	    $this->db->where('b.user_id',$user_id);
	    $result = $this->db->get();
	    foreach($result->result() as $ans){
	        
	        $this->db->select('name');
	        $this->db->from('zul_user_contacts');
	        $this->db->where('contact_system_user_id', $ans->share_by_user_id);
	        $this->db->where('added_by', $user_id);
	        $g = $this->db->get();
	        $t = $g->result();
	        if($ans->share_by_user_id == null){
	            $ans->name = null;
	        }else{
	            $ans->name = $t[0]->name;
	        }
	        
	    }    
		$result_array = array ();
		if ($result) {
			$results = $result->result_array ();
			foreach ( $results as $row ) {
				$result_array[] = array (
						'advice_id' => $row ['advice_id'],
						'goal_id' => ($row ['goal_id'] == 0)? NULL: $row ['goal_id'],
						'advice_type' => $row ['advice_type'],
						'advice_description' => $row ['advice_description'],
						'added_on' => $row ['added_on'],
						"user_advice_id" => $row['user_advice_id'],
				        "share_by_user_id"=> $row['share_by_user_id'],
				        "name"=> $row['name']
				    
				);
			}
			
		} else {
			$result_array = [];
		}
		return $result_array;
			
	 }
	
    /*
     *	 shared user advice  details inserted on zul_user_advice table
     */
    public function user_advice_shared($user_id,$data){
    	
    	$isExists = $this->db->where('phone_number',$data['phone_number'])->from('users')->get();
    	
    	if($isExists->num_rows() > 0){
    		
    		$reciver_details = $isExists->row();
    		$zul_user_advice= [];
    		$zul_user_advice['share_by_user_id']   = $user_id;
    		$zul_user_advice['user_id'] 		   = $reciver_details->id;
    		$zul_user_advice['advice_id'] 	       = $data['advice_id'];
    		$zul_user_advice['added_on']           = date("Y-m-d H:i:s", time());
    		
    		$insert = $this->db->insert('zul_user_advice', $zul_user_advice); // insert data into `zul_user_advice`
    		
    		if($insert){
    			$insert_id = $this->db->insert_id();
    			
    			$zulUserAdvice_details = $this->db->where('user_advice_id',$insert_id)->from('zul_user_advice')->get()->row();
    			//----------------
    		    $shareStr = "event_type=ADVICE_SHARED,user_advice_id=".$zulUserAdvice_details->user_advice_id.",advice_id=".$zulUserAdvice_details->advice_id.
    			",rcpntUserID=".$zulUserAdvice_details->user_id.",rcpntPhNo=".$data['phone_number'].",timestamp=".$this->timezone.",userID=".$user_id;
    			$curlPost = $this->curl->eventDrop_post($shareStr);
    			//----------------
    			$response = TRUE;
    			
    		}else $response = FALSE;
    		
    		
    	}else {
    		$response = FALSE;
    	}
    	
    	return $response;
    }
    
    /* user advice to goal */
    public function user_advice_to_goal($user_id,$data){
    	
    	$isExists = $this->db->where('advice_id',$data['advice_id'])->from('zul_advice_master')->get();
    	if($isExists->num_rows() > 0){
    		
    		$row_details 	= $isExists->row();
    		$zul_user_diary	= [];
    		$zul_user_diary['user_id']   = $user_id;
    		$zul_user_diary['goal_id'] 	 = $row_details->goal_id;
    		
    		
    		//It is check goal to already added or not.
    		$isaddedOrNot = $this->db->where(['user_id' => $user_id,'goal_id' => $row_details->goal_id,'is_completed' => "N",'removed_incomplete' => 0])->from('zul_user_diary')->get();
    		if($isaddedOrNot && $isaddedOrNot->num_rows() > 0 ){
    		    $user_diary_id =  $isaddedOrNot->row()->user_diary_id;
    		    $response = [
    		        'status' => FALSE,
    		        'message' => 'Goal already exsits in your diary.'
    		    ];
    		}
    		else{
    		    $insert = $this->db->insert('zul_user_diary', $zul_user_diary); // insert data into `zul_user_diary`
    		    $user_diary_id= $this->db->insert_id();
    		    $response = [
    		        'status' => TRUE,
    		        'message' => 'Advice Added To Diary Successfully.'
    		    ];
    		}
    		
    		
    		//----------------
    		$dropEventStr = "event_type=ADVICE_TO_GOAL,advice_id=".$data['advice_id'].",goalID=".$row_details->goal_id.",user_diary_id=".
    		$user_diary_id.",user_advice_id=".$data['user_advice_id'].",timestamp=".$this->timezone.",userID=".$user_id;
    		$curlPost = $this->curl->eventDrop_post($dropEventStr);
    		//----------------
    		
    		
    		
    	}else {
    	    $response = [
    	        'status' => FALSE,
    	        'message' => 'Failed To Add Advice To Diary.'
    	    ];
    	}
    	
    	return $response;
    	
    	
    }
    
    public function create_advice($post_data){    
        $data=array(
            'advice_source'         =>$post_data['advice_source'],
            'advice_type'           =>$post_data['advice_type'],
            'goal_id'               =>$post_data['goal_id'],
            'advice_description'    =>$post_data['advice_description'],
            'is_active'             =>$post_data['is_active'],
            'sme_user_id'           =>$post_data['sme_user_id']
        );
        $qry=$this->db->insert("zul_advice_master",$data);
        if($qry){
            return true;
        }else{
            return false;
        }
   }
     /**
     * param @userid
     * return void
     */
    public function update_advice_viewed($user_id)
    {
        //Get all the advices which have not been viewed by seen by user yet.
        $this->db->select('advice_id,user_advice_id');
        $this->db->from('zul_user_advice');
        $this->db->where('advice_viewed', 'N');
        $this->db->where('user_id', $user_id);
        $q = $this->db->get();
        
        //Update all these advice as Y
        $this->db->where('user_id', $user_id);
        $this->db->where('advice_viewed', 'N');
        $update = $this->db->update('zul_user_advice', array(
            'advice_viewed' => 'Y'
        ));
  
       //Drop event for each of theh advice.
        foreach ($q->result() as $k) {
             $dropEventStr = "event_type=ADVICE_TAB_VIEW,advice_id=".$k->advice_id.",user_advice_id=".$k->user_advice_id.",timestamp=".$this->timezone.",userID=".$user_id;
            $curlPost = $this->curl->eventDrop_post($dropEventStr);
            
        }
        
    }
    
    public function sme_share_advice($post_data){
        $length = sizeOf($post_data['user_ids']);
        for($i=0;$i<$length;$i++){
            
            $data=array(
                'user_id'           =>$post_data['user_ids'][$i],
                'advice_id'         =>$post_data['advice_id'],
            );
            
            $qry=$this->db->insert("zul_user_advice",$data);
        }
        if($qry){
            return true;
        }else{
            return false;
        }
    }
    
    /*--------------------------------users goals--------------------------------*/
    public function new_adivces($user_id)
    {
        $this->db->select('count(*) AS new_advices');
        $this->db->from('zul_user_advice');
        $this->db->where('user_id', $user_id);
        $this->db->where('advice_viewed', 'N');
        $query = $this->db->get();
      
        return $query->result();
    }
    
}
