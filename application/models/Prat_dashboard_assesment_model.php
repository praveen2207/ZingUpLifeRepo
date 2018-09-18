<?php

/**
* Contains function for fetching dashboard assesment 
*
* @author     meShakti
* @version    v1.0
* @createdOn 05/01/2018
* 
*/
class Prat_dashboard_assesment_model extends CI_Model {

    function __construct() {
       // Call the Model constructor
        parent::__construct();
        $this->load->config('db_constants');
    }
    
    /*
     * prat_get_assesment_reports
     *
     *Returns the assesment report array. 
     *
     * @param none
     * @return Assesment Reports array
     * @author meShakti
     * @createdOn 05/01/2018
     */
    public function prat_get_assesment_reports($userId){
        $reportResult = array();
        $assesmentReports = array();       
        $assesmentCodeTitleMapping = array(
           "STRENGTH_ENERGY" => "Strength & Energy",
            "THOUGHT_CONTROL"=>"Thought Control",
            //"RELATION_INTIMACY"=>"Relational Intimacy",
            "R&I-A01"=>"Relational Intimacy",
            "ZEST_FORLIFE"=>"Zest for Life"
        );
        //Getting assement results
        $index = 0;
        $hasReports = false;
        foreach ($assesmentCodeTitleMapping as $key => $value){
            $assesmentReports[$index] = $this->prat_fetch_report($userId,$key,$value);
            if($assesmentReports[$index]["isReportGenerated"]){
                $hasReports = true;
            }
            $index++;
        }
        
        $reportResult["assesment_report"] = $assesmentReports;
        $reportResult["hasReports"] = $hasReports;
        return $reportResult;
    }
    
    /*
     * prat_get_assesment_results
     *
     *Returns the assesment results.
     *This method will return assesment results for 7 assesment. If the User has not taken the assesment ,then '-' will be returned
     *All the necessary sanity checks are performed in this method only . It can be used without any checks in consumer code.
     *
     * @param none
     * @return Assesment Results
     * @author meShakti
     * @createdOn 05/01/2018
     */
    public function prat_get_assesment_results($userId){
       
        $assesmentResults = array("Wholesomeness"=>"35",
            "BiologicalAge"=>"37",
            "DietScore"=>"43",
            "StrenghtNEnergy"=>"-",
            "ThoughtControl"=>"77",
            "RelationNIntimacy"=>"67",
            "ZestForLife"=>"97"
        );
        //Getting assement results
        foreach ($assesmentResults as $key => $value){
            $assesmentResults[$key] = $this->prat_fetch_theme_scores($userId,$key);
        }
        
        //Getting BMI Results
        $assesmentResults["BMI"] = $this->prat_fetch_bmi($userId);
        
        return $assesmentResults;
    }

    
    
    /*
     * prat_get_assesment_standard_result
     *
     *Returns the assesment Standard results.
     *Fetches the standard industrial standard according to Gender, age and country 
     *
     * @param none
     * @return Assesment Standard Scores 
     * @author meShakti
     * @createdOn 05/01/2018
     */
    public function prat_get_assesment_standard_result($userInfo){
        $assesmentResults = array("Wholesomeness"=>"70",
            "BiologicalAge"=>"25",
            "DietScore"=>"70",
            "StrenghtNEnergy"=>"65",
            "ThoughtControl"=>"70",
            "RelationNIntimacy"=>"90",
            "ZestForLife"=>"75",
            "BMI"=>"21.5"
        );
        $assesmentResults["BiologicalAge"] = $userInfo->age;
        
        //Getting assement standards
       // foreach ($assesmentResults as $key => $value){
       //     $assesmentResults[$key] = $this->prat_fetch_assesment_standard($userInfo,$key);
        //}
        //Getting BMI standards
       // $assesmentResults["BMI"] = $this->prat_fetch_bmi_standard($userInfo);
        
        return $assesmentResults;
    }
    
    
    /*
     * prat_get_assesment_access
     *
     *Returns which of the assesment user has an access on.
     *
     *
     * @param none
     * @return assesment access  array
     * @author meShakti
     * @createdOn 05/01/2018
     */
    public function prat_get_assesment_access($userId){
        $assesmentAccessArray = array("Wholesomeness"=>true,
            "BiologicalAge"=>true,
            "DietScore"=>true,
            "StrenghtNEnergy"=>true,
            "ThoughtControl"=>true,
            "RelationNIntimacy"=>true,
            "ZestForLife"=>true,
            "BMI"=>true
        );
        //Getting assement results
        foreach ($assesmentAccessArray as $key => $value){
            $assesmentAccessArray[$key] = $this->prat_fetch_assesment_access($userId,$key);
        }
        return $assesmentAccessArray;
    }
    /*
     * prat_get_assesment_goals
     *
     *Returns the assesment goals array.
     *
     * @param none
     * @return Assesment Goals array
     * @author meShakti
     * @createdOn 05/01/2018
     */
    public function prat_get_assesment_goals($userId){
        $reportResult = array();
        $assesmentReports = array();
        $assesmentCodeTitleMapping = array(
            "STRENGTH_ENERGY" => "Strength & Energy",
            "THOUGHT_CONTROL"=>"Thought Control",
            //"RELATION_INTIMACY"=>"Relational Intimacy",
            "R&I-A01"=>"Relational Intimacy",
            "ZEST_FORLIFE"=>"Zest for Life"
        );
        //Getting assement results
        $index = 0;
        $hasReports = false;
        foreach ($assesmentCodeTitleMapping as $key => $value){
            $assesmentReports[$index] = $this->prat_fetch_goal($userId,$key,$value);
            if($assesmentReports[$index]["isReportGenerated"]){
                $hasReports = true;
            }
            
            $index++;
        }
       // die();
        $reportResult["assesment_goals"] = $assesmentReports;
        $reportResult["hasGoals"] = $hasReports;
        //print_r($reportResult);
        //die();
        return $reportResult;
    }
    /*
     * prat_fetch_assesment_access
     *
     *Accepts userId and theme code and fetch the theme score of users.
     *
     *
     * @param userId : int , theme_code string
     * @return theme_access : boolean . If user has filled the assesment,till 15 days the result will be false  otherwise true will be returned
     * @author meShakti
     * @createdOn 08/01/2018
     */
    private function prat_fetch_assesment_access($userId,$assesmentTitle){
        $result = false;
        $assesmentCodeMapping = array(
            "Wholesomeness"=>"WHOLESOMENESS_SCORE",
            "BiologicalAge"=>"BIOLOGICAL_AGE",
            "DietScore"=>"DIET_SCORE",
            "StrenghtNEnergy"=>"STRENGTH_ENERGY",
            "ThoughtControl"=>"THOUGHT_CONTROL",
            //"RelationNIntimacy"=>"RELATION_INTIMACY",
            "RelationNIntimacy"=>"R&I-A01",
            "ZestForLife"=>"ZEST_FORLIFE"
        );
       
        //Building Query Item
        $Select = "SELECT marks_scored,test_end_date,NOW() as curr_date  FROM zul_user_themes WHERE is_test_completed = 'Y'";
        $OrderByNLimit = " ORDER BY test_end_date DESC LIMIT 1 ;";
      
        //Fetching theme data from db
        $Where = " AND user_id=".$userId." AND theme_id = (SELECT theme_id from zul_themes where theme_code='".$assesmentCodeMapping[$assesmentTitle]."' )";
        $queryString = $Select.$Where.$OrderByNLimit;
        $query = $this->db->query($queryString);
        
        if( $query->num_rows() > 0){
            $rowData = $query->row(); 
            $date1 = new DateTime($rowData->curr_date);
            $date2 = new DateTime($rowData->test_end_date);
            $interval = $date1->diff($date2);
            if($interval->y >=1){
                $result = true;
            }else if($interval->m >=1){
                $result = true;
            }else if($interval->d>=15){
                $result = true;
            }
            else{
                $result = false;
            }
        }else{
            //TODO: Add 15 days condition
            $result = true;
        }
        
        return $result;
    }
    /*
     * prat_fetch_bmi
     * 
     * @param userId : int
     * @return bmi : String If user has filled the bmi assesment , assesmnet result will be returned otherwise - will be returned
     * @author: meShakti
     * @createdOn 08/01/2018
     */
    private function prat_fetch_bmi($userId){
        $results = "-";
        $Select = "SELECT bmi  FROM user_details WHERE ";
        $Where = " user_id = ".$userId." ;";
        $queryString = $Select.$Where;
        $query = $this->db->query($queryString);
        if( $query ->num_rows() > 0){
            $results =number_format((float)$query->row()->bmi, 2, '.', '');
            if(is_null($results) || empty($results)){
                $results = '-';
            }
        }else{
            $results = '-';
        }
        return $results;
    }
    /*
     * prat_fetch_theme_scores
     *
     *Accepts userId and theme code and fetch the theme score of users.
     *
     *
     * @param userId : int , theme_code string
     * @return theme_scores : String . If user has filled the assesment , assesmnet result will be returned otherwise - will be returned
     * @author meShakti
     * @createdOn 06/01/2018
     */
    private function prat_fetch_theme_scores($userId,$assesmentTitle){
        $results = "-";
        $assesmentCodeMapping = array(
            "Wholesomeness"=>"WHOLESOMENESS_SCORE",
            "BiologicalAge"=>"BIOLOGICAL_AGE",
            "DietScore"=>"DIET_SCORE",
            "StrenghtNEnergy"=>"STRENGTH_ENERGY",
            "ThoughtControl"=>"THOUGHT_CONTROL",
            //"RelationNIntimacy"=>"RELATION_INTIMACY",
            "RelationNIntimacy"=>"R&I-A01",
            "ZestForLife"=>"ZEST_FORLIFE"
        );
        //Building Query Item
        $Select = "SELECT marks_scored  FROM zul_user_themes WHERE is_test_completed = 'Y'";
        $OrderByNLimit = " ORDER BY test_end_date ASC LIMIT 1 ;";
        
        //Fetching theme score data from db
        $Where = " AND user_id=".$userId." AND theme_id = (SELECT theme_id from zul_themes where theme_code='".$assesmentCodeMapping[$assesmentTitle]."' )";
        $queryString = $Select.$Where.$OrderByNLimit;
        $query = $this->db->query($queryString);
        if( $query ->num_rows() > 0){
            $results =floor($query->row()->marks_scored);
        }else{
            $results = '-';
        }
        
        return $results;
    }
    
    /*
     *  prat_fetch_report
     *  takes in theme_code and return the report of user 
     * @param userId : int , theme_name string, theme_code string
     * @returns report object
     * @author meShakti
     * @createdOn 10/01/2017
     */
    private function  prat_fetch_report($userId ,$theme_code,$theme_name){
        $report = array();
        $report["isReportGenerated"] = false;
        
        /*For fetching theme id and level id in order to generate report */
        /*Will be changed during refactoring sprint */
        $themeCodeThemeIdMapping = array(
            "STRENGTH_ENERGY"=> 1,
            "THOUGHT_CONTROL"=> 2,
            "R&I-A01"=> 10,
            "ZEST_FORLIFE"=> 4
            
        );
        $themeCodeLevelIdMapping = array(
            "STRENGTH_ENERGY"=> 1,
            "THOUGHT_CONTROL"=> 4,
            "R&I-A01"=> 17,
            "ZEST_FORLIFE"=> 8
            
        );
        //Building Query Item
        $Select = "SELECT marks_scored,test_end_date  FROM zul_user_themes WHERE is_test_completed = 'Y'";
        $OrderByNLimit = " ORDER BY test_end_date ASC LIMIT 1 ;";
               
        //Fetching theme score data from db          
        $Where = " AND user_id=".$userId." AND theme_id = (SELECT theme_id from zul_themes where theme_code='".$theme_code."' )";
        $queryString = $Select.$Where.$OrderByNLimit;
        $query = $this->db->query($queryString);
        if( $query ->num_rows() > 0){
            $report["marks_scored"]=floor($query->row()->marks_scored);
            $report["test_end_date"]=substr($query->row()->test_end_date,0,10);
            $report["theme_name"]=$theme_name;
            //Fetching Theme_id and level id in order to generate report pdf
            //This code is subject to refactoring
            $report["theme_id"]=$themeCodeThemeIdMapping[$theme_code];
            $report["level_id"]=$themeCodeLevelIdMapping[$theme_code];
            //End of fetching theme id and level id code
            $report["isReportGenerated"] = true;
        }else{
            $report["isReportGenerated"] = false;
        }
        
        return $report;
    }
    
    /*
     *  prat_fetch_goal
     *  takes in theme_code and return the report of user
     * @param userId : int , theme_name string, theme_code string
     * @returns report object
     * @author meShakti
     * @createdOn 10/01/2017
     */
    private function  prat_fetch_goal($userId ,$theme_code,$theme_name){
        $report = array();
        $report["isReportGenerated"] = false;
        
        /*For fetching theme id and level id in order to generate report */
        /*Will be changed during refactoring sprint */
        $themeCodeThemeIdMapping = array(
            "STRENGTH_ENERGY"=> 1,
            "THOUGHT_CONTROL"=> 2,
            //"R&I-A01"=> 3,
            "R&I-A01"=> 10,
            "ZEST_FORLIFE"=> 4
            
        );
        $themeCodeLevelIdMapping = array(
            "STRENGTH_ENERGY"=> 1,
            "THOUGHT_CONTROL"=> 4,
            //"R&I-A01"=> 7,
            "R&I-A01"=> 17,
            "ZEST_FORLIFE"=> 8
            
        );
        
        $goalList = $this->get_goals_goalsEngagements($userId,$themeCodeThemeIdMapping[$theme_code],$themeCodeLevelIdMapping[$theme_code]);
        if( sizeof($goalList)> 0){
            try {
                $report["goals_0"] = $goalList[0]["segment_name"];
                $prevSegment =$goalList[0]["segment_name"];
                $i=0;
                while($i<sizeof($goalList)){
                    if(strcmp($prevSegment,$goalList[$i]["segment_name"])!=0){
                        $prevSegment =$goalList[$i]["segment_name"];
                        break;
                    }
                    $i++;
                }
                $report["goals_1"] =$prevSegment;
                while($i<sizeof($goalList)){
                    if(strcmp($prevSegment,$goalList[$i]["segment_name"])!=0){
                        $prevSegment =$goalList[$i]["segment_name"];
                        break;
                    }
                    $i++;
                }
                $report["goals_2"] = $prevSegment;
            }                    
            catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
           
            $report["theme_name"]=$theme_name;
//             print_r($goalList);
//             echo "yo!<br>";
            //Fetching Theme_id and level id in order to generate report pdf
            //This code is subject to refactoring
            $report["theme_id"]=$themeCodeThemeIdMapping[$theme_code];
            $report["level_id"]=$themeCodeLevelIdMapping[$theme_code];
            //End of fetching theme id and level id code
            $report["isReportGenerated"] = true;
        }else{
            $report["isReportGenerated"] = false;
        }
        
        return $report;
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
    
    /*
     * gets standard results 
     * @author meShakti
     * @createdOn 12th Feb 2018
     * 
     */
    private function prat_fetch_assesment_standard($userInfo,$assesmentTitle){
        $results = "-";
        $assesmentCodeMapping = array(
            "Wholesomeness"=>"WHOLESOMENESS_SCORE",
            "BiologicalAge"=>"BIOLOGICAL_AGE",
            "DietScore"=>"DIET_SCORE",
            "StrenghtNEnergy"=>"STRENGTH_ENERGY",
            "ThoughtControl"=>"THOUGHT_CONTROL",
            "RelationNIntimacy"=>"RELATION_INTIMACY",
            "ZestForLife"=>"ZEST_FORLIFE"
        );
        //Building Query Item
        $Select = "SELECT AVG(marks_scored) as avg FROM zul_user_themes WHERE is_test_completed = 'Y'";
        $OrderByNLimit = " ORDER BY test_end_date DESC LIMIT 1 ;";
        
        //Fetching theme score data from db
        $Where = " AND theme_id = (SELECT theme_id from zul_themes where theme_code='".$assesmentCodeMapping[$assesmentTitle]."' )";//" AND user_id=".$userInfo->user_id.
        $queryString = $Select.$Where;//.$OrderByNLimit;
        $query = $this->db->query($queryString);
        if( $query ->num_rows() > 0){
            $results =floor($query->row()->avg);
        }else{
            $results = '-';
        }
        
        return $results;
    }
    
    /*
     * prat_fetch_bmi_standard
     *
     * @param user object
     * @return bmi : String If user has filled the bmi assesment , assesmnet average result will be returned otherwise - will be returned
     * @author: meShakti
     * @createdOn 08/01/2018
     */
    private function prat_fetch_bmi_standard($userInfo){
        $results = "-";
        $Select = "SELECT avg(bmi) as bmi_avg  FROM user_details ";
        $Where = "where age = ".$userInfo->age." ;";
        $queryString = $Select.$Where;
        $query = $this->db->query($queryString);
        if( $query ->num_rows() > 0){
            $results =number_format((float)$query->row()->bmi_avg, 2, '.', '');
            if(is_null($results) || empty($results)){
                $results = '-';
            }
        }else{
            $results = '-';
        }
        return $results;
    }
}