<?php

class Apiassessment_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->config('db_constants');
    }
    //--------------------------------------------------------------------------------------
    public function getAssessments(){
    	$headers = null;
    	if (isset ( $_SERVER ['Authorization'] )) {
    		$headers = trim ( $_SERVER ["Authorization"] );
    	} else if (isset ( $_SERVER ['HTTP_AUTHORIZATION'] )) {
    		$headers = trim ( $_SERVER ["HTTP_AUTHORIZATION"] );
    	} elseif (function_exists ( 'apache_request_headers' )) {
    		$requestHeaders = apache_request_headers ();
    		
    		$requestHeaders = array_combine ( array_map ( 'ucwords', array_keys ( $requestHeaders ) ), array_values ( $requestHeaders ) );
    		
    		if (isset ( $requestHeaders ['Authorization'] )) {
    			$headers = trim ( $requestHeaders ['Authorization'] );
    			
    		}
    	}
    	
    	// HEADER: Get the access token from the header
    	if (! empty ( $headers )) {
    		if (preg_match ( '/Bearer\s(\S+)/', $headers, $matches )) {
    			$token = $matches [1];
    			$this->db->select ( 'id' );
    			$this->db->where ( 'security_token', $token );
    			$query = $this->db->get ( 'users' );
    			foreach ( $query->result () as $row ) {
    				$usrid = $row->id;
    				
    			}
    		}
    	}
    	
        $where = $type = '';
        $this->db->select('theme_id,theme_name,bg_image');
        $this->db->from(ASSESSMENTS);
        $jj=$this->assessment_type;
        if($this->assessment_type == 'init'){ 
            $this->db->where('theme_type',$this->assessment_type);
        }
        if($this->assessment_type == 'null'){ 
           $this->db->where('theme_type','');  
        }
        
        $this->db->where('is_active','Y'); 
        $q = $this->db->get();
        //echo $this->db->last_query();
        foreach($q->result() as $k){
            
            $this->db->select('test_order_type');
            $this->db->from(TESTS);
            $this->db->where('theme_id',$k->theme_id);
            $g = $this->db->get();
            $t = $g->result();
            $this->db->select('theme_type');
            $this->db->from(ASSESSMENTS);
            $this->db->where('theme_id',$k->theme_id);
            $res = $this->db->get();
            $r = $res->result();
            
            
            $display_type = $t[0]->test_order_type; 
            $theme_type = $r[0]->theme_type;
          
            
            if($display_type!= ''){
                if($display_type == 'ORDER'){
                    $this->db->select('test_id,test_name');
                    $this->db->from(TESTS);
                    $this->db->where('theme_id',$k->theme_id);
                    $this->db->order_by('test_order','ASC');
                    $this->db->limit(1);
                    $o = $this->db->get();
                    $t = $o->result();
                    $k->level_id = $t[0]->test_id;
                    $k->theme_completed = $this->get_theme_completed($k->theme_id,$usrid);
                    $k->theme_type= $theme_type;
                    
                }
                else if($display_type == 'SHUFFLE'){
                    $this->db->select('test_id,test_name');
                    $this->db->from(TESTS);
                    $this->db->where('theme_id',$k->theme_id);
                    $this->db->order_by('RAND()');
                    $this->db->limit(1);
                    $o = $this->db->get();
                    $t = $o->result();
                    $k->level_id = $t[0]->test_id;
                    $k->theme_completed = $this->get_theme_completed($k->theme_id,$usrid);
                    $k->theme_type= $theme_type;
                }
                $test_completed = $this->get_test_completed($theme_id);
            }else{
            	$k->level_id = "";
            	$k->theme_completed = $this->get_theme_completed($k->theme_id,$usrid);
                $k->theme_type= $theme_type;
            }
        }
       
        return $q->result();
    }
    public function get_test_completed($theme_id){
        
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $userid = $data['logged_in_user_data']->user_id;
        $this->db->select('question_id,question_text,question_description,answer_type');
        $this->db->from(QUESTIONS);
        $this->db->where('test_id',$this->level_id);
        $this->db->where('theme_id',$this->theme_id);  
        $this->db->where('is_active','Y'); 
        $q = $this->db->get();
    }
    
    public function get_theme_completed($theme_id,$usrid){
    	
    	$this->db->select('is_test_completed,theme_id');
    	$this->db->from('zul_user_themes');
    	$this->db->where('user_id',$usrid);
    	$query = $this->db->get();
    	foreach ($query->result() as $r){
    		
    		if($theme_id == $r->theme_id){
    			$theme_comp = $r-> is_test_completed;
    			return $theme_comp;
    		}
    		else {
    			$theme_comp = 'N';
    		}
    	}
    	
    	return $theme_comp;
    }
    
    //--------------------------------------------------------------------------------------
    public function getQuestions(){
        $where = $type = '';
        //to get Display Type
        $this->db->select('question_order_type');
        $this->db->from(QUESTIONS);
        $this->db->where('test_id',$this->level_id);
        $this->db->where('theme_id',$this->theme_id); 
        $this->db->where('is_active','Y'); 
        $this->db->limit('1');
        $q = $this->db->get();
        $this->db->last_query();
        $res = $q->result();  // this returns an object of all results
        $question_order_type = $res[0]->question_order_type;
        
        $this->user_gender = strtoupper($this->user_gender);
        //$this->user_gender."tseting";exit;
        $this->db->select('question_id,question_text,question_description,answer_type');
        $this->db->from(QUESTIONS);
        $this->db->where('test_id',$this->level_id);
        $this->db->where('theme_id',$this->theme_id);  
        if($this->user_gender =='MALE'){
        	error_log('It is male');
            $where = '(gender="MALE" or gender = "BOTH")';
             $this->db->where($where);  
        }else if($this->user_gender =='FEMALE'){
        	error_log('It is female');
            $where = '(gender="FEMALE" or gender = "BOTH")';
            $this->db->where($where);  
        }else{
        	error_log('It is both');
        	$where = '(gender = "BOTH")';
        	$this->db->where($where);
        }
        if($question_order_type == 'ORDER'){
            $this->db->order_by("question_order","ASC");
        }
        $this->db->where('is_active','Y'); 
        $q = $this->db->get();
        //echo $this->db->last_query();
        foreach($q->result() as $k){
            
            $this->db->select('test_name');
            $this->db->from(TESTS);
            $this->db->where('test_id',$this->level_id);
            $g = $this->db->get();
            $t = $g->result();
            //print_r($k);
            $k->question_text = strip_tags($k->question_text); 
            $k->question_description = strip_tags($k->question_description);
            $k->test_name = $t[0]->test_name; 
            $k->level_id = $this->level_id; 
            $k->theme_id = $this->theme_id; 
            if($k->answer_type == 'WEIGHTAGE' || $k->answer_type == 'SINGLE'){
                $k->answer_interaction_type = 'radio';
            }
            if($k->answer_type == 'MULTIPLE'){
                $k->answer_interaction_type = 'checkbox';
            }
            
            $requsite_answers = $this->get_pre_requsite_answers($k->question_id);
            $k->show_if = $requsite_answers;
            $k->not_show_if = [];
            
            
            $this->db->select('answer_id,answer_option_text');
            $this->db->from(ANSWERS);
            $this->db->where('question_id',$k->question_id);
            $answer_query = $this->db->get();
            $result_ans = $answer_query->result();
            $k->answer_options = $result_ans;
        }
        return $q->result();
    }
    //--------------------------------------------------------------------------------------
    public function get_pre_requsite_answers($question_id){
        $this->db->select('answer_id');
        $this->db->from('zul_question_prerequisite');
        $this->db->where('question_id',$question_id);
        $g = $this->db->get();
        $pre_re = array();
        foreach($g->result() as $k){
            $pre_re[] = $k->answer_id;
        }
        return $pre_re;
    }
    //--------------------------------------------------------------------------------------
    public function setQuestionResponse($data){
        $theme_id        = $data['theme_id'];
        $test_id         = $data['test_id'];
        $session_id      = session_id();
        $user_id         = $data['user_id'];
        if($user_id!= 0) { $session_id = ''; }
        $total_questions = $data['total_questions'];
        $test_start_date = date('Y-m-d h:m:s');
        $test_end_date   = date('Y-m-d h:m:s');
        $user_theme_data = array(
            'theme_id' => $theme_id,
            'test_id' => $test_id,
            'user_id' => $user_id,
            'total_answered_questions' => $total_questions,
            'test_start_date' => $test_start_date,
            'test_end_date' => $test_end_date,
            'is_test_completed' => 'Y',
            'session_id'    => $session_id
        );
        $this->db->insert('zul_user_themes', $user_theme_data);
        $user_theme_id = $this->db->insert_id();
        for($i=1;$i<=$total_questions;$i++){
            $question_id = $data['question'.$i];
             for($j=0;$j<=count($data['option'.$i]);$j++){
                $answer_id = $data['option'.$i][$j]; //zul_user_test_response
                $insert_data = array(
                    'user_theme_id' => $user_theme_id,
                    'question_id' => $question_id,
                    'answer_id' => $answer_id,
                );
                if($answer_id!=''){
                    $this->db->insert('zul_user_test_response', $insert_data); 
                }
             }
        }
        $this->storeAssessmentResults($user_id, $theme_id, $test_id);
        return TRUE;
    }
    //For APP
    public function setUserQuestionResponse($data){
        $theme_id        = $data['theme_id'];
        $test_id         = $data['test_id'];
        $session_id      = session_id();
        $user_id         = $data['user_id'];
        if($user_id!= 0) { $session_id = ''; }
        $total_questions = $data['total_questions'];
        $test_start_date = date('Y-m-d h:m:s');
        $test_end_date   = date('Y-m-d h:m:s');
        $user_theme_data = array(
            'theme_id' => $theme_id,
            'test_id' => $test_id,
            'user_id' => $user_id,
            'total_answered_questions' => $total_questions,
            'test_start_date' => $test_start_date,
            'test_end_date' => $test_end_date,
            'is_test_completed' => 'Y',
            'session_id'    => $session_id
        );
        $this->db->insert('zul_user_themes', $user_theme_data);
        $user_theme_id = $this->db->insert_id();
        for($i=1;$i<=$total_questions;$i++){
             $question_id = $data['question'.$i];
             for($j=0;$j<=count($data['option'.$i]);$j++){
                $answer_id = $data['option'.$i][$j]; //zul_user_test_response
                $insert_data = array(
                    'user_theme_id' => $user_theme_id,
                    'question_id' => $question_id,
                    'answer_id' => $answer_id,
                );
                if($answer_id!=''){
                    $this->db->insert('zul_user_test_response', $insert_data); 
                }
             }
        }
        $this->storeAssessmentResults($user_id, $theme_id, $test_id);
        return TRUE;
    }

    
    //--------------------------------------------------------------------------------------
    public function getAssessmentResult(){
        $this->user_id;
        $this->assessment_id;
        $sql = "SELECT percentage FROM ".USER_TEST_RESPONSE." WHERE user_assessment_id ='".$this->assessment_id."'";
        $ideal_image_url    = "<img src=".base_url()."assets/images/11.png/>";
        $user_image_url     = "<img src=".base_url()."assets/images/12.png/>";
        $assessment_result_array = array(
            'ideal_image'       => $ideal_image_url,
            'user_image_url'    => $user_image_url,
        );
        return $assessment_result_array;
    }
    //--------------------------------------------------------------------------------------
    public function storeAssessmentResults($user_id, $theme_id, $test_id){
        $theme_code = $this->getThemeCode($theme_id);
        if($theme_code!= 'BIOLOGICAL_AGE'){
            //Weightage Answers
            $result = $this->getAnswerTypeWeightageResult($user_id, $theme_id, $test_id);
            if (count($result) > 0) {
               $arr_result[] = $result;
            } 
           //  echo "<br>";
            //Multiple with weightages
            $result = $this->getAnswerTypeMultipleWeightageResult($user_id, $theme_id, $test_id);
            if (count($result) > 0) {
                $arr_result[] = $result;
            }

            //Sing Answer with weightages
            $result = $this->getAnswerTypeSingleWeightageResult($user_id, $theme_id, $test_id);
            if (count($result) > 0) {
                $arr_result[] = $result;
            }
        }
        if($theme_code == 'BIOLOGICAL_AGE'){
            
            //Weightage Answers
            $result = $this->getBioAnswerTypeWeightageResult($user_id, $theme_id, $test_id,'WEIGHTAGE');
            if (count($result) > 0) {
               $arr_result[] = $result;
            } 
           
            //Multiple with weightages
            $result = $this->getBioAnswerTypeWeightageResult($user_id, $theme_id, $test_id,'MULTIPLE');
            if (count($result) > 0) {
                $arr_result[] = $result;
            }

            //Sing Answer with weightages
            $result = $this->getBioAnswerTypeWeightageResult($user_id, $theme_id, $test_id,'SINGLE');
            if (count($result) > 0) {
                $arr_result[] = $result;
            }
        }
        
        //echo "<pre>";print_r($arr_result);exit;
        $over_all_score = $this->InsertUserResult($arr_result,$user_id,$theme_id,$test_id,$theme_code);
    } 
    //--------------------------------------------------------------------------------------
    public function getAnswerTypeWeightageResult($user_id, $theme_id, $test_id) {
       $sql = "SELECT Q.question_id,CPR.user_theme_id,ifnull(Q.sub_theme_id, 0) AS sub_theme_id,"
              . " A.answer_weightage, STQM.question_weightage, SUM(ROUND((question_weightage/100 * answer_weightage),2)) as marks_scored"
      //echo $sql = "SELECT Q.question_id,CPR.user_theme_id,ifnull(Q.sub_theme_id, 0) AS sub_theme_id,"
              // . " A.answer_weightage, STQM.question_weightage, (question_weightage/100 * answer_weightage) as marks_scored"
                . " FROM zul_user_themes CPR"
                . " INNER JOIN zul_user_test_response CTQ "
                . "     ON CPR.user_theme_id = CTQ.user_theme_id "
                . " INNER JOIN zul_sub_theme_question_mapping STQM "
                . "     ON STQM.question_id = CTQ.question_id"
                . " INNER JOIN zul_questions Q"
                . "     ON Q.question_id = STQM.question_id "
                . "     AND UPPER(Q.answer_type) = 'WEIGHTAGE'"
                . " INNER JOIN zul_answers A "
                . "     ON A.answer_id = CTQ.answer_id"
                . " WHERE CPR.user_id = " . $user_id
                . "     AND CPR.theme_id = " . $theme_id
                . "     AND CPR.test_id = " . $test_id
                . " GROUP BY Q.sub_theme_id";
        $result = $this->db->query($sql);
        $result_array = array();
        if ($result) {
            $results = $result->result_array();
            foreach($results as $row){
                $result_array[] = array('user_theme_id' => $row['user_theme_id'], 'sub_theme_id' => $row['sub_theme_id'], 'marks_scored' => $row['marks_scored']);
            }
        }
        return $result_array;
    }
    //--------------------------------------------------------------------------------------
    public function getAnswerTypeMultipleWeightageResult($user_id, $theme_id, $test_id) {
       $sql = "SELECT Q.question_id,CPR.user_theme_id,ifnull(Q.sub_theme_id, 0) AS sub_theme_id,"
          . " CTQ.answer_id, A.answer_weightage, STQM.question_weightage, SUM(answer_weightage) as marks_scored"
        
   // $sql = "SELECT Q.question_id,CPR.user_theme_id,ifnull(Q.sub_theme_id, 0) AS sub_theme_id,"
           // . " A.answer_weightage, STQM.question_weightage, SUM(ROUND((question_weightage/100 * answer_weightage),2)) as marks_scored "
                . " FROM zul_user_themes CPR"
                . " INNER JOIN zul_user_test_response CTQ "
                . "     ON CPR.user_theme_id = CTQ.user_theme_id "
                . " INNER JOIN zul_questions Q"
                . "     ON Q.question_id = CTQ.question_id "
                . "     AND UPPER(Q.answer_type) = 'MULTIPLE'"
                . " INNER JOIN zul_answers A "
                . "     ON A.answer_id = CTQ.answer_id"
                . " INNER JOIN zul_sub_theme_question_mapping STQM "
                . "     ON STQM.question_id = CTQ.question_id"
                . " WHERE CPR.user_id = " . $user_id
                . "     AND CPR.theme_id = " . $theme_id
                . "     AND CPR.test_id = " . $test_id
                . " GROUP BY Q.question_id";
        $result = $this->db->query($sql);
        $result_array = array();
        if ($result) {
            $results = $result->result_array();
            foreach($results as $row){
                if($row['marks_scored']>100){
                    $answer_weightage = 100;
                }else{
                    $answer_weightage = $row['marks_scored'];
                }
                $marks_scored = round($row['question_weightage']/100 * $answer_weightage);
                
                $result_array[] = array('user_theme_id' => $row['user_theme_id'], 'sub_theme_id' => $row['sub_theme_id'], 'marks_scored' => $marks_scored);
            }
        }
        
        return $result_array;
    }
    //---------------------------------------------------------------------------------------
    public function getAnswerTypeSingleWeightageResult($user_id, $theme_id, $test_id) {
        $sql = "SELECT Q.question_id,CPR.user_theme_id,ifnull(Q.sub_theme_id, 0) AS sub_theme_id,"
          . " A.answer_weightage, STQM.question_weightage, SUM(ROUND((question_weightage/100 * answer_weightage),2)) as marks_scored"
       //$sql = "SELECT Q.question_id,CPR.user_theme_id,ifnull(Q.sub_theme_id, 0) AS sub_theme_id,"
             // . " A.answer_weightage, STQM.question_weightage, (question_weightage/100 * answer_weightage) as marks_scored"
                . " FROM zul_user_themes CPR"
                . " INNER JOIN zul_user_test_response CTQ "
                . "     ON CPR.user_theme_id = CTQ.user_theme_id "
                . " INNER JOIN zul_questions Q"
                . "     ON Q.question_id = CTQ.question_id "
                . "     AND UPPER(Q.answer_type) = 'SINGLE'"
                . " INNER JOIN zul_answers A "
                . "     ON A.answer_id = CTQ.answer_id"
                . " INNER JOIN zul_sub_theme_question_mapping STQM "
                . "     ON STQM.question_id = CTQ.question_id"
                . " WHERE CPR.user_id = " . $user_id
                . "     AND CPR.theme_id = " . $theme_id
                . "     AND CPR.test_id = " . $test_id
                . " GROUP BY Q.sub_theme_id";
        $result = $this->db->query($sql);
        $result_array = array();
        if ($result) {
            $results = $result->result_array();
            foreach($results as $row){
                $result_array[] = array('user_theme_id' => $row['user_theme_id'], 'sub_theme_id' => $row['sub_theme_id'], 'marks_scored' => $row['marks_scored']);
            }
        }
        return $result_array;
    }
    //--------------------------------------------------------------------------------------
    public function InsertUserResult($result,$user_id,$theme_id,$test_id,$theme_code) {
        $total_marks = 0;
        $user_theme_id = 0;
        $over_all_score = 0;
        $sub_theme_results = array();
        $sql = "INSERT INTO zul_user_sub_theme_score(user_theme_id,
                                         sub_theme_id,
                                         marks_scored) VALUES";

        $sub_theme_result_qry = '';
        foreach ($result as $record_set) {
            foreach ($record_set as $row) {
                $total_marks += (float) $row['marks_scored'];
                $user_theme_id = $row['user_theme_id'];
                $sub_theme_results[$row['sub_theme_id']]['0'] = isset($sub_theme_results[$row['sub_theme_id']]['0']) ?
                $sub_theme_results[$row['sub_theme_id']]['0'] + (float) $row['marks_scored'] : (float) $row['marks_scored'];
            }
        }
        
            foreach ($sub_theme_results as $sub_theme_key => $sub_dimension_key) {
                   $sub_theme_result_qry .= "(" . $user_theme_id . "," . $sub_theme_key . "," . $sub_dimension_key[0]."),";
                    if($theme_code!= 'BIOLOGICAL_AGE'){
                        $sub_theme_weightage = $this->getSubThemeWeightage($sub_theme_key,$test_id);
                        $sub_theme_weightage_raw =  (float) $sub_theme_weightage/100;
                        $final_score = ($sub_dimension_key[0] * $sub_theme_weightage_raw);
                        $over_all_score = $final_score + $over_all_score;
                    }
                    if($theme_code== 'BIOLOGICAL_AGE'){
                        $user_details = $this->getUserdetails($user_id);
                        //print_r($user_details);
                        $user_age = $user_details[0]->age;
                        $user_bmi = $user_details[0]->bmi;
                        if($user_bmi <= 18.5){  $bmi_add_value = 1; }
                        if($user_bmi > 18.6 && $user_bmi < 22.9){ $bmi_add_value = -2; }
                        if($user_bmi > 23 && $user_bmi < 24.9){ $bmi_add_value = 2;}
                        if($user_bmi > 25){ $bmi_add_value = 10;}
                        $final_bmi_value = round(((25/100) * $bmi_add_value),2);
                        $over_all_score = round($final_bmi_value + $user_age + $total_marks);
                    }
            }
        $sub_theme_result_qry = substr($sub_theme_result_qry, 0, strlen($sub_theme_result_qry) - 1);
        if ($sub_theme_result_qry != '') {
            $sql = $sql . $sub_theme_result_qry;
            $this->db->query($sql);
        }
        //. " SET marks_scored = ifnull(marks_scored,0) +" . $over_all_score . ""
        
        $this->db->select('marks_scored');
        $this->db->from('zul_user_themes');	
        $this->db->where('user_id',$user_id);
        $this->db->where('theme_id',$theme_id);
        $this->db->where('test_id',$test_id);
        $q = $this->db->get();
        if($q->num_rows() > 0){
            $row = $q->result();
            $marks_scored = $row[0]->marks_scored; 
            if($marks_scored == 0){
                $sql_result_update = "UPDATE zul_user_themes "
                    . " SET marks_scored = ".$over_all_score.""
                    . " WHERE user_id = ".$user_id." "
                    . " AND theme_id = ".$theme_id.""
                    . " AND test_id = ".$test_id."";
                $this->db->query($sql_result_update);
            }
        }
        return $over_all_score;
    }
    //--------------------------------------------------------------------------------------
    
    public function getBioAnswerTypeWeightageResult($user_id, $theme_id, $test_id,$answer_type) {
       //$sql = "SELECT Q.question_id,CPR.user_theme_id,ifnull(Q.sub_theme_id, 0) AS sub_theme_id,"
           //   . " A.answer_weightage, STQM.question_weightage,(question_weightage/100 * answer_weightage) as marks_scored"
      $sql = "SELECT Q.question_id,CPR.user_theme_id,ifnull(Q.sub_theme_id, 0) AS sub_theme_id,"
               . " A.answer_weightage, STQM.question_weightage, SUM(ROUND((question_weightage/100 * answer_weightage),2))as marks_scored"
                . " FROM zul_user_themes CPR"
                . " INNER JOIN zul_user_test_response CTQ "
                . "     ON CPR.user_theme_id = CTQ.user_theme_id "
                . " INNER JOIN zul_sub_theme_question_mapping STQM "
                . "     ON STQM.question_id = CTQ.question_id"
                . " INNER JOIN zul_questions Q"
                . "     ON Q.question_id = STQM.question_id "
                . "     AND UPPER(Q.answer_type) = '".$answer_type."'"
                . " INNER JOIN zul_answers A "
                . "     ON A.answer_id = CTQ.answer_id"
                . " WHERE CPR.user_id = " . $user_id
                . "     AND CPR.theme_id = " . $theme_id
                . "     AND CPR.test_id = " . $test_id
                . " GROUP BY Q.sub_theme_id";
        $result = $this->db->query($sql);
        $result_array = array();
        if ($result) {
            $results = $result->result_array();
            foreach($results as $row){
                $result_array[] = array('user_theme_id' => $row['user_theme_id'], 'sub_theme_id' => $row['sub_theme_id'], 'marks_scored' => $row['marks_scored']);
            }
        }
        return $result_array;
    }
    //--------------------------------------------------------------------------------------
    public function getSubThemeWeightage($sub_theme_id,$test_id){
        $sub_theme_weightage = '';
        $this->db->select('weightage');
        $this->db->from('zul_test_sub_theme_mapping');
        $this->db->where('test_id', $test_id);
        $this->db->where('sub_theme_id', $sub_theme_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $sub_theme_weightage = $query_result[0]->weightage;
        return $sub_theme_weightage;
    }
    //--------------------------------------------------------------------------------------
    public function getThemeCode($theme_id){
        $this->db->select('theme_code');
        $this->db->from('zul_themes');
        $this->db->where('theme_id', $theme_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $theme_code = $query_result[0]->theme_code;
        return $theme_code;
    }
    //--------------------------------------------------------------------------------------
    public function getUserdetails($user_id){
        $this->db->select('age,bmi,date_of_birth');
        $this->db->from('user_details');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }
    
    
    
    
    
 //End of the class
}
