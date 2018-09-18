<?php

class Assessmentrestapi_model extends CI_Model {
    
    public $timezone;
    function __construct() {
        parent::__construct();
        $this->load->config('db_constants');
        $this->load->library('Curl');
        $this->timezone = date('Y-m-d\TH:i:s\Z', time());
    }
    
    public function setQuestionResponse($user_id,$data){
        $theme_id   = $data['theme_id'];
        $test_id    = $data['test_id'];
        $total_questions = $data['total_questions'];
        $test_start_date = date('Y-m-d h:m:s');
        $test_end_date   = date('Y-m-d h:m:s');
        
        $zut_where = array('theme_id' => $theme_id,'test_id' => $test_id,'user_id' => $user_id);
        $zut_set   = array('total_answered_questions' => $total_questions,
            'test_start_date' => $test_start_date,
            'test_end_date' => $test_end_date,
            'is_test_completed'        => 'Y');
        
        $getLastResponseTestEndDate =   $this->db->where($zut_where)->from('zul_user_themes')->get();
        $testEndDate = "";
        if(isset($getLastResponseTestEndDate) && $getLastResponseTestEndDate->num_rows() > 0){
            $testEndDate = $getLastResponseTestEndDate->row()->test_end_date;
            $testEndDate = date('Y/m/d H:i:s',strtotime($testEndDate));
        }
        
        $saveZulUserThemes = $this->createOrUpdate('zul_user_themes', $zut_where, $zut_set);
        
        $user_theme_id     = $saveZulUserThemes[0]['user_theme_id'];
        
        
        //===Get and copy record and then insert into zul_user_test_response_history
        $query = $this->db->where('user_theme_id',$user_theme_id)->get('zul_user_test_response');
        foreach ($query->result() as $row) {
            $row->created_on = $testEndDate;
            $this->db->insert('zul_user_test_response_history',$row);
        }
        //Delete Record from the zul_user_test_response
        $this->db->where('user_theme_id',$user_theme_id)->delete('zul_user_test_response');
        for($i=1;$i<=$total_questions;$i++){
            $question_id = $data['question'.$i];
            for($j=0;$j<=count($data['option'.$i]);$j++){
                $answer_id = $data['option'.$i][$j]; //zul_user_test_response
                $where_data = array(
                    'user_theme_id' => $user_theme_id,
                    'question_id' => $question_id,
                );
                $set_data = array('answer_id' => $answer_id);
                if($answer_id!=''){
                    //$this->createOrUpdate('zul_user_test_response', $where_data, $set_data);
                    $all_data = array_merge($where_data, $set_data);
                    $this->db->insert('zul_user_test_response',$all_data);
                }
            }
        }

        $user_score = $this->storeAssessmentResults($user_id, $theme_id, $test_id);
        $user_details = $this->getUserdetails($user_id);
        $user_age   = $user_details[0]->age;
        $user_bmi   = $user_details[0]->bmi;
        $user_gender= strtoupper($user_details[0]->gender);
        
        $dontShowSubThemeId = null;
        if($theme_id == 3){
            
            if($data['question5'] == 115){
                $opt = $data['option5'][0];
                $family = array(469,470,471); //15 family Subtheme
                $parenting    = array(472,473);//43 is parenting Subtheme
                $dontShowSubThemeId = (in_array($opt,$family))? 43: 15;
            }
            
        }
        $score_text = $this->getInterpretationText($user_id, $theme_id,$user_gender,$dontShowSubThemeId);
        
        $events_details['age'] = $user_age;
        $events_details['bmi'] = $user_bmi;
        $events_details['gender'] = $user_details[0]->gender;
        $events_details['bio_age'] = $user_score;
        
        $event_drop = $this->getEventDropThemeDetails($user_id, $theme_id, $events_details);
        if($theme_id == 5){ // user_imgs added when theme id is 5
            $user_imgs  = $this->getBiologicalImages($user_gender, $user_age, $user_bmi);
            $user_results['user_imgs'] = $user_imgs;
        }
        
        //------------------------------Return Array
        $user_results['overall_score'] = $user_score;
        $user_results['user_age'] = $user_age;
        $user_results['score_text'] = $score_text;
        
        return $user_results;
    }
    //--------------------------------------------------------------------------------------
    
    public function getBiologicalImages($gender,$age,$bmi){
        
        $actual_img_result =   $this->db->select('*')
        ->where('gender',$gender)
        ->where('age_from <=', $age)
        ->where('age_to   >=', $age)
        ->where('bmi_from <=', $bmi)
        ->where('bmi_to   >=', $bmi)
        ->from('zul_biological_images')
        ->get()->row()->image_url;
        
        $ideal_img_result =   $this->db->select('*')
        ->where('gender',$gender)
        ->where('age_from <=', $age)
        ->where('age_to   >=', $age)
        ->where('bmi_from'   , 18.600000)
        ->where('bmi_to'     , 23.000000)
        ->from('zul_biological_images')
        ->get()->row()->image_url;
        
        $imgs['actual_img_result'] = base_url('assets/images/bioimgs/'.$actual_img_result);
        $imgs['ideal_img_result']  = base_url('assets/images/bioimgs/'.$ideal_img_result);
        //SELECT *  FROM `zul_biological_images` WHERE `age_from` <= 22 AND age_to >= 22  AND `gender` = 'MALE'
        
        return $imgs;
        
    }
    
    //--------------------------------------------------------------------------------------
    
    public function getInterpretationText($user_id,$theme_id,$user_gender,$doNotShowsub_theme){
        
        $text = "";
        if(!empty($user_id) && !empty($theme_id)){
            
            //ZUT.user_id,ZUT.user_theme_id,ZUT.test_id,ZUT.theme_id,ZUT.marks_scored theme_marks,
            // Z.sub_theme_id,Z.marks_scored sub_theme_marks,
            
                $sql = "SELECT  "
                        ."I.interpretation_text "
                        ."FROM zul_user_themes ZUT,zul_user_sub_theme_score Z, zul_test_score_interpretation I "
                        ."where (I.gender = '' OR I.gender = 'BOTH' OR I.gender = '".$user_gender."') AND ZUT.user_theme_id = Z.user_theme_id AND I.theme_id = ZUT.theme_id AND I.test_id = ZUT.test_id "
                        ."AND I.sub_theme_id = Z.sub_theme_id AND Z.marks_scored between I.score_from AND I.score_to "
                        ."AND ZUT.user_id = ".$user_id." AND ZUT.theme_id = ".$theme_id;
                
                        if($theme_id == 3) $sql .= " AND I.sub_theme_id !=".$doNotShowsub_theme;
    
                        $data_query = $this->db->query($sql);
                        $interpretation      = $data_query->result_array();
                        
                        foreach ($interpretation as $row){
                            $text .= $row['interpretation_text']." ";
                        }
                                
        }
        
        return $text;
    }
    
    //------------------------------------------------------------------------------------------------------------
    
    public function getEventDropThemeDetails($user_id, $theme_id, $events_details){
        
        
        $sql=    "SELECT ".
            "ZUT.user_id,Z.sub_theme_id,Z.marks_scored sub_theme_marks, S.sub_theme_name ".
            "FROM ".
            "zul_user_themes ZUT,zul_user_sub_theme_score Z, zul_sub_themes S ".
            "WHERE ".
            "ZUT.user_theme_id = Z.user_theme_id AND S.sub_theme_id = Z.sub_theme_id ".
            "AND ZUT.user_id = ".$user_id." AND ZUT.theme_id = ".$theme_id;
        
        $theme_query    = $this->db->query($sql);
        $theme_result   = $theme_query->result_array();
        
        if(in_array($theme_id, array(1,2,3,4))){
            $this->theme_group_one($user_id, $theme_id, $theme_result, $events_details);
        }
        
        if(in_array($theme_id, array(5, 6,7))){
            $this->theme_group_two($user_id, $theme_id, $theme_result, $events_details);
        }
        
        
    }
    
    //------------------------------------------------------------------------------------------------------------
    
    public function theme_group_one($user_id, $theme_id, $theme_result, $events_details) {//theme_id = 1,2,3,4,
        
        $strVar = [];
        
        foreach($theme_result as $subTheme_row){
            
            //echo $subTheme_row['sub_theme_id'];
            //---------------------------------------------------------------------------------------------------1
            if($subTheme_row['sub_theme_id'] == 1) $strVar['apptt_score']       = $subTheme_row['sub_theme_marks'];
            //else $strVar['apptt_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 2) $strVar['ergnmc_score']      = $subTheme_row['sub_theme_marks'];
            //else $strVar['ergnmc_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 3) $strVar['phy_act_score']     = $subTheme_row['sub_theme_marks'];
            //else $strVar['phy_act_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 4) $strVar['nutn_score']        = $subTheme_row['sub_theme_marks'];
            //else $strVar['nutn_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 5) $strVar['med_cond_score']    = $subTheme_row['sub_theme_marks'];
            //else $strVar['med_cond_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 6) $strVar['fmly_hstry_score']  = $subTheme_row['sub_theme_marks'];
            //else $strVar['fmly_hstry_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 7) $strVar['slp_score']         = $subTheme_row['sub_theme_marks'];
            //else $strVar['slp_score'] = " ";
            //--------------------------------------------------------------------------------------------------2
            if($subTheme_row['sub_theme_id'] == 12) $strVar['ocd_score']       = $subTheme_row['sub_theme_marks'];
            //else $strVar['ocd_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 9)  $strVar['angr_mgmt_score']      = $subTheme_row['sub_theme_marks'];
            //else $strVar['angr_mgmt_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 10) $strVar['dprsn_score']     = $subTheme_row['sub_theme_marks'];
            //else $strVar['dprsn_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 8)  $strVar['adctn_score']     = $subTheme_row['sub_theme_marks'];
            //else $strVar['adctn_score'] = " ";
            
            //-----------------------------------------------------------------------------------------------------3
            if($subTheme_row['sub_theme_id'] == 13) $strVar['cmmunctn_score']       = $subTheme_row['sub_theme_marks'];
            //else $strVar['cmmunctn_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 14) $strVar['emotnl_stblty_score']      = $subTheme_row['sub_theme_marks'];
            //else $strVar['emotnl_stblty_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 15) $strVar['fmly_dynmcs_score']     = $subTheme_row['sub_theme_marks'];
            //else $strVar['fmly_dynmcs_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 16) $strVar['sxl_hlth_score']        = $subTheme_row['sub_theme_marks'];
            //else $strVar['sxl_hlth_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 17) $strVar['spprt_systm_score']    = $subTheme_row['sub_theme_marks'];
            //else $strVar['spprt_systm_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 43) $strVar['prntng_score']  = $subTheme_row['sub_theme_marks'];
            //else $strVar['prntng_score'] = " ";
            
            //-----------------------------------------------------------------------------------------------------4
            if($subTheme_row['sub_theme_id'] == 19) $strVar['brthng_score']       = $subTheme_row['sub_theme_marks'];
            //else $strVar['brthng_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 20) $strVar['pssn_score']         = $subTheme_row['sub_theme_marks'];
            //else $strVar['pssn_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 23) $strVar['slf_cnnctvty_score'] = $subTheme_row['sub_theme_marks'];
            //else $strVar['slf_cnnctvty_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 21) $strVar['wrklf_blnc_score']   = $subTheme_row['sub_theme_marks'];
            //else $strVar['wrklf_blnc_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 22) $strVar['pstv_thnkng_score']  = $subTheme_row['sub_theme_marks'];
            //else $strVar['pstv_thnkng_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 24) $strVar['snsng_score']  = $subTheme_row['sub_theme_marks'];
            //else $strVar['snsng_score'] = " ";
            
            
        }
        
        if($theme_id == 1){
            //5) EVENT: THEME_ASSMT_TAKEN (Strength and Energy)
            //JSON String:
            $strVar['apptt_score']     = (isset($strVar['apptt_score']))      ? $strVar['apptt_score']     : " ";
            $strVar['ergnmc_score']    = (isset($strVar['ergnmc_score']))     ? $strVar['ergnmc_score']    : " ";
            $strVar['slp_score']       = (isset($strVar['slp_score']))        ? $strVar['slp_score']       : " ";
            $strVar['phy_act_score']   = (isset($strVar['phy_act_score']))    ? $strVar['phy_act_score']   : " ";
            $strVar['nutn_score']      = (isset($strVar['nutn_score']))       ? $strVar['nutn_score']      : " ";
            $strVar['fmly_hstry_score']= (isset($strVar['fmly_hstry_score'])) ? $strVar['fmly_hstry_score']: " ";
            $strVar['med_cond_score']  = (isset($strVar['med_cond_score']))   ? $strVar['med_cond_score']  : " ";
            
            $str =  "event_type=THEME_ASSMT_TAKEN,assmtID=".$theme_id.
            ",level=1,Appetite=".$strVar['apptt_score'].",Ergonomics=".$strVar['ergnmc_score'].",Sleep=".$strVar['slp_score']."".
            ",Physical Activity=".$strVar['phy_act_score'].",Nutrition=".$strVar['nutn_score'].",Family History=".$strVar['fmly_hstry_score'].",".
            "Medical Conditions=".$strVar['med_cond_score'].",timestamp=".$this->timezone.",userID=".$user_id;
            
        }
        
        if($theme_id == 2){
            //6) EVENT: THEME_ASSMT_TAKEN (Thought Control)
            //JSON String:
            
            $strVar['ocd_score']       = (isset($strVar['ocd_score']))      ? $strVar['ocd_score']       : " ";
            $strVar['angr_mgmt_score'] = (isset($strVar['angr_mgmt_score']))? $strVar['angr_mgmt_score'] : " ";
            $strVar['dprsn_score']     = (isset($strVar['dprsn_score']))    ? $strVar['dprsn_score']     : " ";
            $strVar['adctn_score']     = (isset($strVar['adctn_score']))    ? $strVar['adctn_score']     : " ";
            
            
            $str =  "event_type=THEME_ASSMT_TAKEN,assmtID=".$theme_id.
            ",level=1,OCD=".$strVar['ocd_score'].",Anger Management=".$strVar['angr_mgmt_score'].",Depression=".$strVar['dprsn_score'].",".
            "Addiction=".$strVar['adctn_score'].",timestamp=".$this->timezone.",userID=".$user_id;
            
        }
        
        if($theme_id == 3){
            //7) EVENT: THEME_ASSMT_TAKEN (Relationship and Intimacy)
            //JSON String:
            
            // will pull empty space if value is not come
            $strVar['cmmunctn_score']       = (isset($strVar['cmmunctn_score']))      ? $strVar['cmmunctn_score']      : " ";
            $strVar['emotnl_stblty_score']  = (isset($strVar['emotnl_stblty_score'])) ? $strVar['emotnl_stblty_score'] : " ";
            $strVar['sxl_hlth_score']       = (isset($strVar['sxl_hlth_score']))      ? $strVar['sxl_hlth_score']      : " ";
            $strVar['spprt_systm_score']    = (isset($strVar['spprt_systm_score']))   ? $strVar['spprt_systm_score']   : " ";
            
            $fmlyDynmcsScore = (!isset($strVar['fmly_dynmcs_score']) || $strVar['fmly_dynmcs_score'] == null) ? "Family Dynamics= " : "Family Dynamics=".$strVar['fmly_dynmcs_score'];
            $prntng_score    = (!isset($strVar['prntng_score'])      || $strVar['prntng_score']      == null) ? "Parenting= " : "Parenting=".$strVar['prntng_score'];
            $str =  "event_type=THEME_ASSMT_TAKEN,assmtID=".$theme_id.
            ",level=1,Communication=".$strVar['cmmunctn_score'].",Emotional Stability=".$strVar['emotnl_stblty_score'].",".
            $fmlyDynmcsScore.",Sexual Health=".$strVar['sxl_hlth_score'].",Support System=".$strVar['spprt_systm_score'].",".
            $prntng_score.",timestamp=".$this->timezone.",userID=".$user_id;
            
        }
        
        if($theme_id == 4){
            //8) EVENT: THEME_ASSMT_TAKEN (Zest for Life)
            //JSON String:
            // will put empty space if value is not come
            $strVar['brthng_score']       = (isset($strVar['brthng_score']))      ? $strVar['brthng_score']      : " ";
            $strVar['pssn_score']         = (isset($strVar['pssn_score']))        ? $strVar['pssn_score']        : " ";
            $strVar['slf_cnnctvty_score'] = (isset($strVar['slf_cnnctvty_score']))? $strVar['slf_cnnctvty_score']: " ";
            $strVar['wrklf_blnc_score']   = (isset($strVar['wrklf_blnc_score']))  ? $strVar['wrklf_blnc_score']  : " ";
            $strVar['pstv_thnkng_score']  = (isset($strVar['pstv_thnkng_score'])) ? $strVar['pstv_thnkng_score'] : " ";
            $strVar['snsng_score']        = (isset($strVar['snsng_score']))       ? $strVar['snsng_score']       : " ";
            
            $str =  "event_type=THEME_ASSMT_TAKEN,assmtID=".$theme_id.
            ",level=1,Breathing=".$strVar['brthng_score'].",Passion=".$strVar['pssn_score'].",Self Connectivity=".$strVar['slf_cnnctvty_score'].",".
            "Worklife Balance=".$strVar['wrklf_blnc_score'].",Positive Thinking=".$strVar['pstv_thnkng_score'].",Sensing=".$strVar['snsng_score'].",".
            "timestamp=".$this->timezone.",userID=".$user_id;
            
        }
        //echo $str;
        $result = $this->curl->eventDrop_post($str);
        //unset($theme_result); unset($strVar);
    }
    
    //------------------------------------------------------------------------------------------------------------
    
    public function theme_group_two($user_id, $theme_id, $theme_result, $events_details) {//theme_id = 5,6,7
        
        
        //print_r($events_details);
        $str1Var = [];
        //-----------------------------------------------------------------------------------------------Common
        $str1Var['age']     = (isset($events_details['age']))    ? $events_details['age']    : "";
        $str1Var['bmi']     = (isset($events_details['bmi']))    ? $events_details['bmi']    : "";
        $str1Var['gender']  = (isset($events_details['gender'])) ? $events_details['gender'] : "";
        
        //1) EVENT: BMI_COLLECTED
        //JSON String:
        //$str1 = "event_type=BMI_COLLECTED,BMI=".$str1Var['bmi'].",gender=".$str1Var['gender'].",timestamp=".$this->timezone.",userID=".$user_id;
        
        
        foreach($theme_result as $subTheme_row){
            
            //echo $subTheme_row['sub_theme_id'];
            
            //----------------------------------------------------------------------------------------------------5
            //if($subTheme_row['sub_theme_id'] == 12) $str1Var['bio_age']       = $subTheme_row['sub_theme_marks'];
            //if($subTheme_row['sub_theme_id'] == 9)  $strVar['cal_age']      = $subTheme_row['sub_theme_marks'];
            $str1Var['age_diff']     = $events_details['age'] - $events_details['bio_age'];
            
            //-----------------------------------------------------------------------------------------------------6
            if($subTheme_row['sub_theme_id'] == 32) $str1Var['diet_score'] = $subTheme_row['sub_theme_marks'];
            //else $str1Var['diet_score'] = " ";
            
            //-----------------------------------------------------------------------------------------------------7
            if($subTheme_row['sub_theme_id'] == 33) $str1Var['strgth_enrgy_score']  = $subTheme_row['sub_theme_marks'];
            //else echo $str1Var['strgth_enrgy_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 41) $str1Var['zst_fr_lfe_score']    = $subTheme_row['sub_theme_marks'];
            //else $str1Var['zst_fr_lfe_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 39) $str1Var['thgt_ctrl_score']     = $subTheme_row['sub_theme_marks'];
            //else $str1Var['thgt_ctrl_score'] = " ";
            
            if($subTheme_row['sub_theme_id'] == 40) $str1Var['rlnshp_intmcy_score'] = $subTheme_row['sub_theme_marks'];
            //else $str1Var['rlnshp_intmcy_score'] = " ";
            
        }
        
        if($theme_id == 5){
            
            //2) EVENT: INIT_ASSMT_TAKEN (Biological Age Calculator)
            //JSON String:
            $str2 = "event_type=INIT_ASSMT_TAKEN,assmtID=".$theme_id.",level=0,Biological Age=".
                $events_details['bio_age'].",cal_age=".$events_details['age'].",age_diff=".
                $str1Var['age_diff'].",timestamp=".$this->timezone.",userID="
                    .$user_id;
                    
                    
        }
        
        if($theme_id == 6){
            
            //3) EVENT: INIT_ASSMT_TAKEN (Diet Score)
            //JSON String:
            $str1Var['diet_score']     = (isset($str1Var['diet_score'])) ?
            $str1Var['diet_score']    : " ";
            $str2 = "event_type=INIT_ASSMT_TAKEN,assmtID=".$theme_id.",level=0,Diet Score=".
                $str1Var['diet_score'].",timestamp=".$this->timezone.",userID=".
                $user_id;
                
        }
        
        if($theme_id == 7){
            
            $str1Var['strgth_enrgy_score']     = (isset($str1Var['strgth_enrgy_score'])) ?
            $str1Var['strgth_enrgy_score']    : " ";
            $str1Var['thgt_ctrl_score']        = (isset($str1Var['thgt_ctrl_score']))    ?
            $str1Var['thgt_ctrl_score']       : " ";
            $str1Var['rlnshp_intmcy_score']    = (isset($str1Var['rlnshp_intmcy_score']))?
            $str1Var['rlnshp_intmcy_score']   : " ";
            $str1Var['zst_fr_lfe_score']       = (isset($str1Var['zst_fr_lfe_score']))?
            $str1Var['zst_fr_lfe_score']      : " ";
            //4) EVENT: INIT_ASSMT_TAKEN (Wholesomeness Score)
            //JSON String:
            $str2 = "event_type=INIT_ASSMT_TAKEN,assmtID=".$theme_id.",level=0,Strength and Energy=".
                $str1Var['strgth_enrgy_score'].",Zest for Life=".$str1Var['zst_fr_lfe_score'].
                ",Thought Control=".$str1Var['thgt_ctrl_score'].",Relationship and Intimacy=".
                $str1Var['rlnshp_intmcy_score'].",timestamp=".$this->timezone.",userID=".$user_id;
                //print_r($theme_result);
                
        }
        
        
        //echo $str1."<br>".$str2;
        //$result = $this->curl->eventDrop_post($str1);
        $result = $this->curl->eventDrop_post($str2);
        
        
    }
    
    //------------------------------------------------------------------------------------------------------------
    public function storeAssessmentResults($user_id, $theme_id, $test_id){
        $theme_code = $this->getThemeCode($theme_id);
        if($theme_code!= 'BIOLOGICAL_AGE'){
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
        
        $over_all_score = $this->InsertUserResult($arr_result,$user_id,$theme_id,$test_id,$theme_code);
        return $over_all_score;
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
        
        
        $sub_theme_result_qry = '';
        foreach ($result as $record_set) {
            foreach ($record_set as $row) {
                $total_marks += (float) $row['marks_scored'];
                $user_theme_id = $row['user_theme_id'];
                $sub_theme_results[$row['sub_theme_id']]['0'] = isset($sub_theme_results[$row['sub_theme_id']]['0']) ?
                $sub_theme_results[$row['sub_theme_id']]['0'] + (float) $row['marks_scored'] : (float) $row['marks_scored'];
            }
        }
        
        //print_r($sub_theme_results);
        foreach ($sub_theme_results as $sub_theme_key => $sub_dimension_key) {
            
            $zulUstScore_where['user_theme_id'] = $user_theme_id;
            $zulUstScore_where['sub_theme_id']  = $sub_theme_key;
            $zulUstScore_set['marks_scored']    = $sub_dimension_key[0];
            
            $this->createOrUpdate('zul_user_sub_theme_score', $zulUstScore_where, $zulUstScore_set);
            //print_r(array($zulUstScore_where,$zulUstScore_set));
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
        
        $zul_user_themes_where = ['user_id' => $user_id,'theme_id' => $theme_id,'test_id' => $test_id];
        $zul_user_themes_set   = ['marks_scored' => $over_all_score];
        $this->createOrUpdate('zul_user_themes', $zul_user_themes_where, $zul_user_themes_set);
        
        
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
        $this->db->select('gender,age,bmi,date_of_birth');
        $this->db->from('user_details');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }
    //---------------------------------------------------------------------------------------
    public function updateUserDetails($user_data){
        $current_date   = date("Y");
        $dob            = date('Y',strtotime($user_data['dob']));
        $age            = $current_date - $dob;
        $dob_formate    = date("Y-m-d",strtotime($user_data['dob']));
        $height         = $user_data['height'] / 100;
        $bmi_val        = $user_data['weight'] / ($height * $height);
        $new_user_profile_data = array(
            'user_id' 	=> $user_data['user_id'],
            'gender' 	=> $user_data['gender'],
            'age'       => $age,
            'weight' 	=> $user_data['weight'],
            'height' 	=> $user_data['height'],
            'bmi'       => $bmi_val,
            'date_of_birth' =>	$dob_formate
        );
        //->where('user_id',$user_data['user_id'])->update
        $this->db->insert('user_details', $new_user_profile_data);
        $user_tbl_data = array(
            'name'  => $user_data['name'],
            'role'  => 'user',
        );
        $this->db->where('id',$user_data['user_id'])->update('users', $user_tbl_data);
        
    }
    //---------------------------------------------------------------------------------------
    
    
    /**
     *
     * @param type $table
     * @param type $where
     * @param type $set_data
     * @return type $result
     */
    public function createOrUpdate($table,$where,$set_data) {
        $isExist = $this->findRecord($table, $where);
        if ( $isExist->num_rows() > 0 )
        {
            //echo "update";
            $this->db->set($set_data);
            $this->db->where($where)->update($table);
            $result = $this->findRecord($table, $where)->result_array();
        } else {
            $all_data = array_merge($where, $set_data);
            $this->db->insert($table,$all_data);
            $id_where['user_theme_id'] = $this->db->insert_id();
            $result = $this->findRecord($table, $id_where)->result_array();
        }
        return $result;
        
    }
    /**
     *
     * @param type $table
     * @param type $where
     * @return type $result
     */
    public function findRecord($table,$where){
        $result = $this->db->where($where)->from($table)->get();
        //print_r($result[0]['user_theme_id']);
        return $result;
        
    }
    
    
    
    
    
    
    //End of the class
}
