<?php

/**
* Contains function for fetching goal list for user 
*
* @author     meShakti
* @version    v1.0
* @createdOn 18/01/2018
* 
*/
class Prat_goals_model extends CI_Model {

    function __construct() {
       // Call the Model constructor
        parent::__construct();
        $this->load->config('db_constants');
    }
    
    public function get_goals($user_id){
        $goals_mapping =[];
        $themeCodeThemeIdMapping = array(
            "STRENGTH_ENERGY"=> 1,
            "THOUGHT_CONTROL"=> 2,
            "RELATION_INTIMACY"=> 10,
            "ZEST_FORLIFE"=> 4
            
        );
        $themeCodeLevelIdMapping = array(
            "STRENGTH_ENERGY"=> 1,
            "THOUGHT_CONTROL"=> 4,
            "RELATION_INTIMACY"=> 17,
            "ZEST_FORLIFE"=> 8
            
        );
        
        foreach ($themeCodeThemeIdMapping as $key => $value){
            $goals_mapping[$key] = $this->get_goals_goalsEngagements($user_id,$value,$themeCodeLevelIdMapping[$key]);    
        }
        
        return $goals_mapping;
        
    }
    
    /***
     *
     * gets goals and Engagment lists
     * @author meShakti
     * @createdOn 16th Jan 2018
     *
     *
     *
     */
    //-------------------------------------------------------------------------------------------------
    private function get_goals_goalsEngagements($user_id,$theme_id,$test_id){
        
        $goalResult = array();
        $segmentArray =$this->get_goal_segment($user_id,$theme_id,$test_id);
        
        foreach($segmentArray as $key => $value){
        $this->db->select('DISTINCT(D.goal_name)');
        
        $this->db->from('zul_goal_segments E');
        
        $this->db->join('zul_goals D', 'E.goal_segment_id = D.goal_segment_id' );
        $this->db->join('zul_goal_mapping C', 'D.goal_id = C.goal_id' );
        $this->db->join('zul_user_sub_theme_score B','C.score_from  <= B.marks_scored AND C.score_to  >= B.marks_scored AND C.sub_theme_id = B.sub_theme_id');
        $this->db->join('zul_user_themes A','A.user_theme_id = B.user_theme_id');
        
        $this->db->where('A.user_id', $user_id);
        $this->db->where('A.theme_id',$theme_id);
        $this->db->where('A.test_id', $test_id);
        $this->db->where('E.segment_name',$value ["segment_name"]);
        $this->db->order_by('E.segment_name');
        
        $q = $this->db->get();
        
        $res=$q->result_array();
        $goalResult[$value["segment_name"]] = $res;
        }
        
//         print_r($goalResult);
//         die();
        return $goalResult;
        
        
    }
    private function get_goal_segment($user_id,$theme_id,$test_id){
         $this->db->select('DISTINCT( E.segment_name)');
        
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
}