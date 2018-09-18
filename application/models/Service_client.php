<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Service_client
 *
 * @author vadivel.n
 */
class Service_client extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->config('db_constants');
        $this->load->library('curl');
    }
    //Get Assessments (type : Init, Null, All) -------------------------------------------
        public function getAssessmentsAPI($url,$type=''){
            
            $authorization = "Authorization: Bearer 201A78C1-46A2-E9BB-299D-17A9603B1DC4";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
            $result = curl_exec($curl);
            curl_close($curl);
            $assessment_array = json_decode($result, true);
           
            return $assessment_array;
        }
    //------------------------------------------------------------------------------------
    public function getAssessmentQuestionsAPI($url){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        curl_close($curl);
        
        // Convert JSON string to Array
        $goals_array = json_decode($result, true);
        return $goals_array;
    }
    //------------------------------------------------------------------------------------
    
    public function getGolsAPI($type,$url){
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        curl_close($curl);
        
        // Convert JSON string to Array
        $goals_array = json_decode($result, true);
        return $goals_array;
    }
    //------------------------------------------------------------------------------------
    
    
    
    
    
}
