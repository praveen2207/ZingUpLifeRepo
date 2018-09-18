<?php

class AssessmentApi_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->config('db_constants');
    }
    //--------------------------------------------------------------------------------------
    public function getAssessments(){
        $where = $type = '';
        if($this->assessment_type == 'init' || $this->assessment_type == 'null'){
            if($this->assessment_type == 'init'){ 
                $type =  $this->assessment_type;
                $where = " WHERE theme_type='".$type."'";
            }else{
                $where = " WHERE theme_type IS NULL";
            }
        }
        
        $sql = "SELECT theme_id,theme_name,theme_code,theme_type FROM ".ASSESSMENTS." $where";
        $data_query = $this->db->query($sql);    
        $assessments = $data_query->result_array();
        return $assessments;
    }
    //--------------------------------------------------------------------------------------
    public function getQuestions(){
        $test_id = '1';
        $sql = "SELECT Q.question_id,Q.question_text,Q.question_description,Q.answer_type,A.answer_id,A.answer_option_text,A.answer_image_url,T.test_id,T.test_name FROM ".QUESTIONS." Q "
                . " INNER JOIN ".TESTS." T ON T.test_id = Q.test_id "
                . " INNER JOIN ".ANSWERS." A ON Q.question_id = A.question_id "
                . " WHERE Q.test_id ='1' AND Q.theme_id=1 ORDER BY Q.question_id";
        $data_query = $this->db->query($sql,FALSE);    
        $questions = $data_query->result_array();
       
        $result = array();
        $i=0;
        foreach($questions as $row) {
            $question_id    = $row['question_id'];
            $answer_id      = $row['answer_id'];
            $result[$question_id]['question_id']            = $row['question_id'];
            $result[$question_id]['question_text']          = $row['question_text'];            
            $result[$question_id]['question_description']   = $row['question_description'];
            $result[$question_id]['answer_type']            = $row['answer_type'];
            $result[$question_id]['theme_id']               = 1;
            $result[$question_id]['test_id']                = $row['test_id'];
            $result[$question_id]['test_name']              = $row['test_name'];

            if(!isset($result[$question_id]['answers'])) {
                $result[$question_id]['answers'] = array();
            }
            
            if($answer_id && !isset($result[$question_id]['answers'][$i])) {
                $answer_array = array(
                    'answer_id'             => $row['answer_id'],
                    'answer_option_text'    => $row['answer_option_text'],
                    'answer_image_url'      => $row['answer_image_url'],
                );
                $result[$question_id]['answers'][$i] = $answer_array;
            }
            $i++; 
        }
        return $result;
    }
    //--------------------------------------------------------------------------------------
    public function setQuestionResponse($data){
        $theme_id        = $data['theme_id'];
        $test_id         = $data['test_id'];
        $session_id      = session_id();
        $user_id         = $data['user_id'];
        if($user_id!= 0) { $session_id = ''; }
        $total_questions = $data['length'];
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
        for($i=1;$i<=$data['length'];$i++){
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
        //Weightage Answers
        $result = $this->getAnswerTypeWeightageResult($user_id, $theme_id, $test_id);
        if (count($result) > 0) {
           $arr_result[] = $result;
        } 
        //Multiple with weightages
        $result = $this->getAnswerTypeMultipleWeightageResult($user_id, $theme_id, $test_id);
        if (count($result) > 0) {
            $arr_result[] = $result;
        }
        
        $this->InsertUserResult($arr_result,$user_id,$theme_id,$test_id); exit;
    } 
    //--------------------------------------------------------------------------------------
    public function getAnswerTypeWeightageResult($user_id, $theme_id, $test_id) {
        $sql = "SELECT Q.question_id,CPR.user_theme_id,ifnull(Q.sub_theme_id, 0) AS sub_theme_id,"
                . " A.answer_weightage, STQM.question_weightage, SUM(ROUND((question_weightage/100 * answer_weightage),2)) as marks_scored"
                . " FROM zul_user_themes CPR"
                . " INNER JOIN zul_user_test_response CTQ "
                . "     ON CPR.user_theme_id = CTQ.user_theme_id "
                . " INNER JOIN zul_questions Q"
                . "     ON Q.question_id = CTQ.question_id "
                . "     AND UPPER(Q.answer_type) = 'WEIGHTAGE'"
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
    public function getAnswerTypeMultipleWeightageResult($user_id, $theme_id, $test_id) {
        $sql = "SELECT Q.question_id,CPR.user_theme_id,ifnull(Q.sub_theme_id, 0) AS sub_theme_id,"
                . " CTQ.answer_id, A.answer_weightage, STQM.question_weightage, SUM(ROUND((question_weightage/100 * answer_weightage),2)) as marks_scored"
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
    public function InsertUserResult($result,$user_id,$theme_id,$test_id) {
        $total_marks = 0;
        $user_theme_id = 0;
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
               $sub_theme_weightage = $this->getSubThemeWeightage($sub_theme_key,$test_id);
               $sub_theme_weightage_raw =  (float) $sub_theme_weightage/100;
               $final_score = ($sub_dimension_key[0] * $sub_theme_weightage_raw);
               $over_all_score = $final_score + $over_all_score;
        }
        $sub_theme_result_qry = substr($sub_theme_result_qry, 0, strlen($sub_theme_result_qry) - 1);
        if ($sub_theme_result_qry != '') {
            $sql = $sql . $sub_theme_result_qry;
            $this->db->query($sql);
        }
        //. " SET marks_scored = ifnull(marks_scored,0) +" . $over_all_score . ""
        $sql_result_update = "UPDATE zul_user_themes "
                . " SET marks_scored = ".$over_all_score.""
                . " WHERE user_id = ".$user_id." "
                . " AND theme_id = ".$theme_id.""
                . " AND test_id = ".$test_id."";
        $this->db->query($sql_result_update);
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

    
 //End of the class
}