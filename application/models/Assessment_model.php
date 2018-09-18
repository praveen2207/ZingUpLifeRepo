<?php
/**
 * This class used for assessment users 
 * @author Vadivel N <vadicse@gmail.com>
 * Date:07-12-2016
 */
class Assessment_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->config('db_constants');
        $this->survey_history_table = TBL_USER_SURVEY_HISTORY;
        $this->interpretation_users = TBL_INTERPRETATION_USERS;	
    }
    //------------------------------------------------------------------------------------------------------
    public function get_all_interpretation_users() {
    	$current_date = '2016-12-24';
    	$date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $current_date)));
        $user_fields            = 'users.id,users.username,users.name';
        $user_detials_fields    = 'user_details.gender,user_details.phone,user_details.age,user_details.created_on';
        $this->db->select($user_fields.','.$user_detials_fields.','.$this->survey_history_table.".*");
        $this->db->from('user_details');
        $this->db->join('users', 'user_details.user_id = users.id');
        $this->db->join($this->survey_history_table, 'users.id ='.$this->survey_history_table.'.user_id');
        $this->db->where($this->survey_history_table.'.is_survey_completed','Y');
        $this->db->where('users.id NOT IN (SELECT userid FROM `user_sme_book_call` WHERE cancel="n")', NULL, FALSE);
        $this->db->order_by($this->survey_history_table.'.survey_end_date', 'desc');
        $query          = $this->db->get();

        foreach ($query->result() as $key) {
            $this->db->select('count(userid) as missed_count');
		$this->db->from('user_sme_book_call');
                $this->db->where('cancel','y');
		$this->db->where('userid',$key->user_id);
                $q = $this->db->get();
                $key->missedcount = $q->result();
        }
        $query_result   = $query->result();
        return $query_result;
    }
    //------------------------------------------------------------------------------------------------------
    public function get_all_consultation_users($joining_date) {
        $user_fields            = 'users.id,users.username,users.name';
        $user_detials_fields    = 'user_details.gender,user_details.phone,user_details.age,user_details.created_on';
        $survey_history         = $this->survey_history_table.".*";
        $sme_data               = "user_sme_book_call.*";
        $this->db->select($user_fields.','.$user_detials_fields.','.$survey_history.','.$sme_data);
        $this->db->from('user_details');
        $this->db->join('users', 'user_details.user_id = users.id');
        $this->db->join($this->survey_history_table, 'users.id ='.$this->survey_history_table.'.user_id');
        $this->db->join('user_sme_book_call', 'users.id =`user_sme_book_call`.userid','left');
        $this->db->where($this->survey_history_table.'.is_survey_completed','Y');
        $this->db->where('user_sme_book_call.cancel','n');
        $this->db->where('user_sme_book_call.user_type','gp');
        $this->db->order_by('user_sme_book_call.added_on', 'desc');
        $query          = $this->db->get();
        $this->db->last_query(); 
        $query_result   = $query->result();
        return $query_result;
    }
    //------------------------------------------------------------------------------------------------------
    //Last Update 13-12-2016 by VN
    public function getGPsaddedslots($gp_ids){
        $today = date('Y-m-d');
        $this->db->select('date');
        $this->db->from('sme_book_slots');
        $this->db->where("sme_userid IN ($gp_ids)", NULL, FALSE);
        $this->db->where('status','available');
        $this->db->where('date >=',$today);
        $this->db->order_by('date',"desc");
        $q = $this->db->get();
        return $q->result();
    }
    //-------------------------------------------------------------------------------------------------
    public function getGPSlot($date,$gp_ids){
        $this->db->select('sme_userid,id,time_from,time_to,date as sel_date,status');
        $this->db->where('date',$date);
        $this->db->where("sme_userid IN ($gp_ids)", NULL, FALSE);
        $this->db->where("status",'available');
        $this->db->from('sme_book_slots');
        $this->db->group_by('time_from,time_to');
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return $q->result();
        }else{
            return false;
        }
    }
    //-------------------------------------------------------------------------------------------------
    public function b_det($slot_id){
        $this->db->select('*');
        $this->db->from('sme_book_slots');
        $this->db->where('id',$slot_id);
        $r = $this->db->get();
        $r = $r->result();
        return $r[0]; 
    }
    //-------------------------------------------------------------------------------------------------
    public function getAvaliableGPS($slot_id,$gp_ids){
       /* $slot_details   = $this->b_det($slot_id);
        $date           = $slot_details->date;
        $time_from      = $slot_details->time_from;
        $time_to        = $slot_details->time_to; 
        $this->db->select('distinct(sme_userid)');
        $this->db->from('sme_book_slots');
        $this->db->where('date',$date);
        $this->db->where('time_from',$time_from);
        $this->db->where('time_to',$time_to);
        $this->db->where("sme_userid IN ($gp_ids)", NULL, FALSE);
        $this->db->where("status",'available');
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return $q->result();
        }else{
            return false;
        }*/
        $slot_details   = $this->b_det($slot_id);
        $date           = $slot_details->date;
        $time_from      = $slot_details->time_from;
        $time_to        = $slot_details->time_to; 
        $this->db->select('sme_book_slots.sme_userid,sme_users.name');
        $this->db->from('sme_book_slots');
        $this->db->join('sme_users', 'sme_users.id = sme_book_slots.sme_userid');
        $this->db->where('sme_book_slots.date',$date);
        $this->db->where('sme_book_slots.time_from',$time_from);
        $this->db->where('sme_book_slots.time_to',$time_to);
        $this->db->where("sme_book_slots.sme_userid IN ($gp_ids)", NULL, FALSE);
        $this->db->where("sme_book_slots.status",'available');
        $this->db->group_by('sme_book_slots.sme_userid');
        $q = $this->db->get();
        if($q->num_rows() > 0){
            return $q->result();
        }else{
            return false;
        }
        
    }
    //-------------------------------------------------------------------------------------------------
    public function userBookSlot($data){
        $slot_id    = $data['slot_id'];
        $sme_userid = $data['sme_id'];
        $user_id    = $data['user_id'];
        $booked_on  = date('Y-m-d H:i:s');
        $this->db->select('id');
        $this->db->from('sme_book_slots');
        $this->db->where('id',$slot_id);
        $this->db->where('sme_userid',$sme_userid);
        $this->db->where("status",'available');
        $q = $this->db->get();
        
        if($q->num_rows() > 0){
            $updatedata = array('status' =>'blocked');
            $this->db->where('id',$slot_id);
            $this->db->where('sme_userid',$sme_userid);
            $this->db->update('sme_book_slots', $updatedata);
            $insert_data    = array('userid' =>$user_id,'smebookcallid' =>$slot_id,'sme_userid'=>$sme_userid,'user_type'=>'gp');
            $this->db->insert('user_sme_book_call', $insert_data);
            return true;
        }else{
            return false;
        }
    }
    //-------------------------------------------------------------------------------------------------
    //Update for existing assessment users
    public function UpdateSurveyHistroy(){
        $this->db->select('count(ques_id) as total,userid,added_on');
        $this->db->from('survey_cat_user_options');
        $this->db->group_by('userid');
        $g = $this->db->get();
        $t = $g->result();  
        foreach($t as $users){
            if($users->total== 80){
                if($users->added_on=='NULL' || $users->added_on=='0000-00-00 00:00:00.000000'){
                    $users->added_on = date('Y-m-d H:i:s');
                }
                $user_data = array('user_id'=>$users->userid,
                    'survey_start_date'=>$users->added_on,
                    'survey_end_date'=>$users->added_on,
                    'is_survey_completed' =>'Y'
                    );
                $this->db->select('user_id');
            $this->db->from($this->survey_history_table);
            $this->db->where('user_id',$user_id);
            $qqs = $this->db->get();
            if($qqs->num_rows() == 0){
                $this->db->insert('user_survey_history', $user_data);
            }

            }
        }
    }
    //-------------------------------------------------------------------------------------------------
    public function get_asses_taken($user_id){
	$this->db->select('theme_id,test_id,marks_scored');
        $this->db->from('zul_user_themes');
        $this->db->where('user_id',$user_id);
        $this->db->where('is_test_completed','Y');
        $q = $this->db->get();
	$res=$q->result();
	return $res;
    }
    //----------------------------------------------------------------------------------------------------
    public function getThemeName($theme_id){
        $this->db->select('theme_name,web_banner_img,mobile_web_banner,theme_code');
        $this->db->from('zul_themes');
        $this->db->where('theme_id', $theme_id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        $query_result = $query->result();
        //print_r($query_result);
        return $query_result;
    }
    //--------------------------------------------------------------------------------------
    public function get_asses_interpretataion($theme_id,$test_id,$score){
	$this->db->select('interpretation_text');
        $this->db->from('zul_test_score_interpretation');
        $this->db->where('theme_id',$theme_id);
	$this->db->where('test_id',$test_id);
	$this->db->where('score_from<=',$score);
	$this->db->where('score_to>=',$score);
        $q = $this->db->get();
	$res = $q->result();
	return $res;
    }
    //--------------------------------------------------------------
    public function get_subtheme_interpretataion($theme_id,$subtheme, $test_id,$score){
    	$this->db->select('interpretation_text');
    	$this->db->from('zul_test_score_interpretation');
    	$this->db->where('theme_id',$theme_id);
    	$this->db->where('sub_theme_id',$subtheme);
    	$this->db->where('test_id',$test_id);
    	$this->db->where('score_from<=',$score);
    	$this->db->where('score_to>=',$score);
    	$q = $this->db->get();
    	$res = $q->result();
    	return $res;
    }
    //-------------------------------------------------------------------------------------------------
    public function get_theme_name_by_id($theme_id){
	$this->db->select('theme_name');
        $this->db->from('zul_themes');
        $this->db->where('theme_id',$theme_id);
	$q = $this->db->get();
	$res=$q->result();
	return $res;
    }
	 //-------------------------------------------------------------------------------------------------
    public function get_goals_goalsEngagements($user_id,$theme_id,$test_id){
    	
    	
    	$this->db->select('DISTINCT(D.goal_name), E.segment_name'); 
    	
    	$this->db->from('zul_goal_segments E');
    	
    	$this->db->join('zul_goals D', 'E.goal_segment_id = D.goal_segment_id' );
    	$this->db->join('zul_goal_mapping C', 'D.goal_id = C.goal_id' );
    	$this->db->join('zul_user_sub_theme_score B','C.score_from  <= B.marks_scored AND C.score_to  >= B.marks_scored AND C.sub_theme_id = B.sub_theme_id');
    	$this->db->join('zul_user_themes A','A.user_theme_id = B.user_theme_id');
    	
    	$this->db->where('A.user_id', $user_id);
    	$this->db->where('A.theme_id',$theme_id);
    	$this->db->where('A.test_id', $test_id);
    	$this->db->order_by('E.segment_name');
    	
    	$q = $this->db->get();
    	$res=$q->result_array();
    	return $res;
    	
    	
    }
	//-------------------------------------------------------------------------------------------------
    public function match_question_answer(){
	$this->db->select('question_id,answer_id');
        $this->db->from('zul_question_prerequisite');
        $q = $this->db->get();
	$res = $q->result();
	return $res;
    }
    
}