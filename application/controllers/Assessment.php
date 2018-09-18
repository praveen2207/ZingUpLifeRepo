<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.

 * Description of Assessment
 *
 * @author vadivel.n
 */
require APPPATH . 'third_party/PHPMailer/PHPMailerAutoload.php';

class Assessment extends CI_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('Service_client');
        $this->load->model('User'); 
        $this->load->library('encryption');
		$this->load->model('Assessment_model');
		$this->load->model('Utilitiesmodel');
	}
    //--------------------------------------------------------------------------
    public function intro(){
        $data['title']          = "Get your personalized wellbeing score now";
        $data['main_content']   = 'assessment/index';
        $this->load->view('assessment/includes/template', $data);
    }
    //--------------------------------------------------------------------------
    public function index(){
    	error_log("index");
    	if(($this->input->cookie('theme_id')) && ($this->input->cookie('level_id')) && $this->input->cookie('theme_name') && 
    	    $this->input->cookie('web_banner') && $this->input->cookie('mobile_web_banner')){//Mani
    	    
    	    //echo "Theme ID: ".$this->input->cookie('theme_id').",Level ID: ".$this->input->cookie('level_id');
    	    $user_gender = $this->input->cookie('asse_gender');
    	    $data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');
    	    if (isset($data['logged_in_user_data']->is_logged_in) == 1) {
    	        $data['user_id'] = $data['logged_in_user_data']->user_id;
    	    }else{
    	        $data['user_id'] = 0;
    	    }
    	    $data['title']          		= "Get your personalized wellbeing score now";
    	    $data['main_content']   		= 'assessment/testpage';
    	    $theme_id 				= $this->input->cookie('theme_id');
    	    $level_id 				= $this->input->cookie('level_id');
    	    
    	    $data['theme_name']     		= $this->input->cookie('theme_name');
    	    $data['web_banner']     		= $this->input->cookie('web_banner');
    	    $data['mobile_web_banner']      = $this->input->cookie('mobile_web_banner');
    	    $question_api_url       		= base_url().'api/assessment/questions/id/'.$theme_id.'/level_id/'.$level_id.'/user_gender/'.$user_gender;
    	    $data['questions']      		= $this->Service_client->getAssessmentQuestionsAPI($question_api_url);
    	    $data['prerequisite_data'] 		= $this->Assessment_model->match_question_answer();
    	    $data['toal_questions'] 		= count($data['questions']);
    	    $data['active_url'] 			= '';
    	    
    	    $this->load->view('assessment/includes/template', $data);
    	    
    	}else{
    	    redirect(base_url(), 'refresh');
    	}
        
    }
    //--------------------------------------------------------------------------
    public function getAllAssessments(){
        $this->Service_client->getAssessmentsAPI($url);
    }
    //--------------------------------------------------------------------------
    public function getGoals(){
        $this->Service_client->getGolsAPI($url);
    }
    //--------------------------------------------------------------------------
    public function info(){
        
        
        error_log("info");
        if(($this->input->cookie('theme_id')) && ($this->input->cookie('level_id'))){//Mani
            //echo "<h3>Theme ID: ".$this->input->cookie('theme_id').",Level ID: ".$this->input->cookie('level_id')."</h3>";
            $data['title']          	= "Get your personalized wellbeing score now";
            $data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');
            
            if ($data['logged_in_user_data']->is_logged_in == 1) {
                $theme_id	= $this->input->cookie('theme_id');
                $test_id	= $this->input->cookie('level_id');
                $theme_data = $this->Assessment_model->getThemeName($theme_id);
                $theme_name     = $theme_data[0]->theme_name;
                $web_banner_img = $theme_data[0]->web_banner_img;
                $data	= array('theme_id'=>$theme_id,'test_id'=>$test_id,'theme_name'=>$theme_name,'web_banner'=>$web_banner_img);
                $this->session->set_userdata('data',$data);
                redirect('assessment/index');
            } else {
                $key_name="org_access_code_enable";
                $data['switch_flag']	= $this->Utilitiesmodel->flag_checking($key_name);
                $data['theme_id']       = $this->input->cookie('theme_id');
                $data['level_id']       = $this->input->cookie('level_id');//exit;
                $theme_data             = $this->Assessment_model->getThemeName($data['theme_id']);
                $data['theme_name']     = $theme_data[0]->theme_name;
                $data['web_banner']     = $theme_data[0]->web_banner_img;
                $data['mobile_web_banner'] = $theme_data[0]->mobile_web_banner;
                $this->input->set_cookie('theme_id',$data['theme_id'],'86500');
                $this->input->set_cookie('theme_name',$data['theme_name'],'86500');
                $this->input->set_cookie('web_banner',$data['web_banner'],'86500');
                $this->input->set_cookie('mobile_web_banner',$data['mobile_web_banner'],'86500');
                $data['main_content']   = 'assessment/assess_user_info';
                $this->load->view('assessment/includes/template', $data);
            }
            
        }else{
            redirect(base_url(), 'refresh');
        }
        
    	
        
   	}
    //--------------------------------------------------------------------------
    public function report(){
    	error_log("report");
	    $theme_id			= $this->input->cookie('theme_id');
        $test_id			= $this->input->cookie('level_id');
	    $data['theme_id']               = $theme_id;
        $data['level_id']               = $test_id;
        $theme_data                     = $this->Assessment_model->getThemeName($theme_id);
        $data['theme_name']             = $theme_data[0]->theme_name;
	    $data['theme_code']     	    = $theme_data[0]->theme_code;
        $data['web_banner']             = $theme_data[0]->web_banner_img; 
        $data['mobile_web_banner']      = $theme_data[0]->mobile_web_banner;
        $data['title']                  = "Get your personalized wellbeing score now";
        
        $data['logged_in_user_data'] 	= $this->session->userdata("logged_in_user_data");
        $user_id			= $data['logged_in_user_data']->user_id;  
        $data['percentage']             = $this->User->GetUserPercentage($user_id,$theme_id,$test_id);
        $score 				= $data['percentage'][0]->marks_scored;
        
        $data['sub_theme_list']			= $this->User->GetUserSubthemeScore($user_id,$theme_id,$test_id);
        $data['sub_themes']				= $this->User->GetUserSubtheme($user_id,$theme_id,$test_id);

        $sub_theme_interpretaion = array();
        $i=0;
        foreach ($data['sub_theme_list'] as $subtheme) {


        	$interpretation =  $this->Assessment_model->get_subtheme_interpretataion($theme_id,$subtheme->sub_theme_id, $test_id,$subtheme->marks_scored);
        	$interpretation_text = $interpretation[0]->interpretation_text;
        	$sub_theme_interpretaion[$i]['sub_theme'] = $subtheme->sub_theme_name;
        	$sub_theme_interpretaion[$i]['marks_scored'] = $subtheme->marks_scored;
        	$sub_theme_interpretaion[$i]['interpretation_text'] = $interpretation_text;

        	$i++;
        }
        $data['interpretation'] = $sub_theme_interpretaion;



	$user_data			= $this->User->get_user_details($user_id);
        $data['user_age']		= $user_data->age;
	$data['main_content']   	= 'assessment/assessment_report';
        $this->load->view('assessment/includes/template', $data);
    }
    //--------------------------------------------------------------------------
    public function home(){
	$data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');
        if ($data['logged_in_user_data']->is_logged_in == 1) {
	$user_id			= $data['logged_in_user_data']->user_id;
		    $user_data			= $this->User->get_user_details($user_id);
	        $data['user_age']	= $user_data->age;
		    $theme_id			= $this->input->cookie('theme_id');
            $test_id			= $this->input->cookie('level_id');		
			$data['percentage'] = $this->User->GetUserPercentage($user_id,$theme_id,$test_id);
	$data['taken_asses']		= $this->Assessment_model->get_asses_taken($user_id);
        }
        
	$api_url			= base_url().'api/assessments?type=init';
        $data['init_themes']		= $this->Service_client->getAssessmentsAPI($api_url);
        $api_url			= base_url().'api/assessments?type=null';
        $data['other_themes']		= $this->Service_client->getAssessmentsAPI($api_url);
       
        $data['main_content']   	= 'assessment/assessment_home';
        $this->load->view('assessment/includes/template', $data);
        
    }
    //--------------------------------------------------------------------------
    
    public function bio_asses_theme(){
    	error_log("bio_asses_theme");
	$data=$_POST;
	$this->input->set_cookie('theme_id',$data['theme_id'],'86500');
	$this->input->set_cookie('level_id',$data['test_id'],'86500');

        $theme_data             = $this->Assessment_model->getThemeName($data['theme_id']);
        $data['theme_name']     = $theme_data[0]->theme_name;
        $data['web_banner']     = $theme_data[0]->web_banner_img; 
        $data['mobile_web_banner'] = $theme_data[0]->mobile_web_banner; 
        $this->input->set_cookie('theme_name',$data['theme_name'],'86500');
        $this->input->set_cookie('web_banner',$data['web_banner'],'86500');
        $this->input->set_cookie('mobile_web_banner',$data['mobile_web_banner'],'86500');

        $data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');

        if ($data['logged_in_user_data']->is_logged_in == 1) {
	   $user_status='logged in';
	} else {
	   $user_status='not logged in'; 
	}
		error_log("bio_asses_theme: ".$user_status);
	echo json_encode($user_status);
	
    }
    //--------------------------------------------------------------------------
    
    public function diet_asses_theme(){
    	error_log("diet_asses_theme");
	$data=$_POST;
	$this->input->set_cookie('theme_id',$data['theme_id'],'86500');
	$this->input->set_cookie('level_id',$data['test_id'],'86500');
        
        $theme_data             = $this->Assessment_model->getThemeName($data['theme_id']);
        $data['theme_name']     = $theme_data[0]->theme_name;
        $data['web_banner']     = $theme_data[0]->web_banner_img; 
        $data['mobile_web_banner'] = $theme_data[0]->mobile_web_banner; 
        $this->input->set_cookie('theme_name',$data['theme_name'],'86500');
        $this->input->set_cookie('web_banner',$data['web_banner'],'86500');
        $this->input->set_cookie('mobile_web_banner',$data['mobile_web_banner'],'86500');
        
	$data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');

        if ($data['logged_in_user_data']->is_logged_in == 1) {
	   $user_status='logged in';
	} else {
	   $user_status='not logged in'; 
	}
		error_log("diet_asses_theme: ".$user_status);
	echo json_encode($user_status);
	
    }
    
    //--------------------------------------------------------------------------
    
    public function wholesomeness_asses_theme(){
    	error_log("wholesomeness_asses_theme");
	$data=$_POST;
	$this->input->set_cookie('theme_id',$data['theme_id'],'86500');
	$this->input->set_cookie('level_id',$data['test_id'],'86500');
        
        $theme_data             = $this->Assessment_model->getThemeName($data['theme_id']);
        $data['theme_name']     = $theme_data[0]->theme_name;
        $data['web_banner']     = $theme_data[0]->web_banner_img; 
        $data['mobile_web_banner'] = $theme_data[0]->mobile_web_banner; 
        $this->input->set_cookie('theme_name',$data['theme_name'],'86500');
        $this->input->set_cookie('web_banner',$data['web_banner'],'86500');
        $this->input->set_cookie('mobile_web_banner',$data['mobile_web_banner'],'86500');
        
	$data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');

        if ($data['logged_in_user_data']->is_logged_in == 1) {
	   $user_status='logged in';
	} else {
	   $user_status='not logged in'; 
	}

		error_log("wholesomeness_asses_theme: ".$user_status);

	echo json_encode($user_status);
	
    }
     //--------------------------------------------------------------------------
    
    public function strength_asses_theme(){
    	error_log("strength_asses_theme");

	$data=$_POST;
	$this->input->set_cookie('theme_id',$data['theme_id'],'86500');
	$this->input->set_cookie('level_id',$data['test_id'],'86500');
        
        $theme_data             = $this->Assessment_model->getThemeName($data['theme_id']);
        $data['theme_name']     = $theme_data[0]->theme_name;
        $data['web_banner']     = $theme_data[0]->web_banner_img; 
        $data['mobile_web_banner'] = $theme_data[0]->mobile_web_banner; 
        $this->input->set_cookie('theme_name',$data['theme_name'],'86500');
        $this->input->set_cookie('web_banner',$data['web_banner'],'86500');
        $this->input->set_cookie('mobile_web_banner',$data['mobile_web_banner'],'86500');
        
	$data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');

        if ($data['logged_in_user_data']->is_logged_in == 1) {
	   $user_status='logged in';
	} else {
	   $user_status='not logged in'; 
	}

		error_log("strength_asses_theme: ".$user_status);
	echo json_encode($user_status);
	
    }
     //--------------------------------------------------------------------------
    
    public function thought_asses_theme(){
    	error_log("thought_asses_theme");

	$data=$_POST;
	$this->input->set_cookie('theme_id',$data['theme_id'],'86500');
	$this->input->set_cookie('level_id',$data['test_id'],'86500');
        
        $theme_data             = $this->Assessment_model->getThemeName($data['theme_id']);
        $data['theme_name']     = $theme_data[0]->theme_name;
        $data['web_banner']     = $theme_data[0]->web_banner_img; 
        $data['mobile_web_banner'] = $theme_data[0]->mobile_web_banner; 
        $this->input->set_cookie('theme_name',$data['theme_name'],'86500');
        $this->input->set_cookie('web_banner',$data['web_banner'],'86500');
        $this->input->set_cookie('mobile_web_banner',$data['mobile_web_banner'],'86500');
        
	$data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');

        if ($data['logged_in_user_data']->is_logged_in == 1) {
	   $user_status='logged in';
	} else {
	   $user_status='not logged in'; 
	}
		error_log("thought_asses_theme: ".thought_asses_theme);
	echo json_encode($user_status);
	
    }
     //--------------------------------------------------------------------------
    
    public function relationship_asses_theme(){
    	error_log("relationship_asses_theme");
	$data=$_POST;
	$this->input->set_cookie('theme_id',$data['theme_id'],'86500');
	$this->input->set_cookie('level_id',$data['test_id'],'86500');
        
        $theme_data             = $this->Assessment_model->getThemeName($data['theme_id']);
        $data['theme_name']     = $theme_data[0]->theme_name;
        $data['web_banner']     = $theme_data[0]->web_banner_img; 
        $data['mobile_web_banner'] = $theme_data[0]->mobile_web_banner; 
        $this->input->set_cookie('theme_name',$data['theme_name'],'86500');
        $this->input->set_cookie('web_banner',$data['web_banner'],'86500');
        $this->input->set_cookie('mobile_web_banner',$data['mobile_web_banner'],'86500');
        
	$data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');

        if ($data['logged_in_user_data']->is_logged_in == 1) {
	   $user_status='logged in';
	} else {
	   $user_status='not logged in'; 
	}
		error_log("relationship_asses_theme: ".thought_asses_theme);
	echo json_encode($user_status);
	
    }
     //--------------------------------------------------------------------------
    
    public function zest_asses_theme(){
    	error_log("zest_asses_theme");
	$data=$_POST;
	$this->input->set_cookie('theme_id',$data['theme_id'],'86500');
	$this->input->set_cookie('level_id',$data['test_id'],'86500');
        
        $theme_data             = $this->Assessment_model->getThemeName($data['theme_id']);
        $data['theme_name']     = $theme_data[0]->theme_name;
        $data['web_banner']     = $theme_data[0]->web_banner_img; 
        $data['mobile_web_banner'] = $theme_data[0]->mobile_web_banner; 
        $this->input->set_cookie('theme_name',$data['theme_name'],'86500');
        $this->input->set_cookie('web_banner',$data['web_banner'],'86500');
        $this->input->set_cookie('mobile_web_banner',$data['mobile_web_banner'],'86500');
        
	$data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');

        if ($data['logged_in_user_data']->is_logged_in == 1) {
	   $user_status='logged in';
	} else {
	   $user_status='not logged in'; 
	}
		error_log("zest_asses_theme: ".zest_asses_theme);
	echo json_encode($user_status);
	
    }
    //--------------------------------------------------------------------------
    public function assessment_pdf_download(){
    error_log("assessment_pdf_download");
	$data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');
	$user_id = $data['logged_in_user_data']->user_id;
	$theme_id = $this->uri->segment(3);
	$test_id = $this->uri->segment(4);
	
	$loadViewFile = 'assessment_pdf_report';
	
	if($theme_id == 1 || $theme_id == 9){
	    $theme_image='img/pdf/strength_and_energy.png';
	    $loadViewFile = 'strength_and_energy_pdf_report';
	}else if($theme_id == 2){
	    $theme_image='img/pdf/thought_control.png';
	    $loadViewFile = 'thought_control_pdf_report';
	}else if($theme_id == 3 || $theme_id == 10){
	    $theme_image='img/pdf/relationship_and_intimacy.png';
	    $loadViewFile = 'relationship_and_intimacy_pdf_report';
	}else if($theme_id == 4){
	    $theme_image='img/pdf/zest_for_life.png'; 
	    $loadViewFile = 'zest_for_life_pdf_report';
	}
	
	$data['themes']	= $this->Assessment_model->get_theme_name_by_id($theme_id);
	$theme_name = $data['themes'][0]->theme_name;
	$data['theme_details']     = $this->User->GetUserPercentage($user_id,$theme_id,$test_id);
	//print_r($data['theme_details']); exit;
	$score = $data['theme_details'][0]->marks_scored;

	$data['sub_theme_list']			= $this->User->GetUserSubthemeScore($user_id,$theme_id,$test_id);
	$data['sub_themes']			= $this->User->GetUserSubtheme($user_id,$theme_id,$test_id);


	$sub_theme_interpretaion = array();
	$i=0;
	foreach ($data['sub_theme_list'] as $subtheme) {


		 $interpretation =  $this->Assessment_model->get_subtheme_interpretataion($theme_id,$subtheme->sub_theme_id, $test_id,$subtheme->marks_scored);
		 $interpretation_text = $interpretation[0]->interpretation_text;
		 $sub_theme_interpretaion[$i]['sub_theme'] = $subtheme->sub_theme_name;
		 $sub_theme_interpretaion[$i]['marks_scored'] = $subtheme->marks_scored;
		 $sub_theme_interpretaion[$i]['interpretation_text'] = $interpretation_text;

		$i++;
	}
	$data['interpretation'] = $sub_theme_interpretaion;

	//echo "<pre>";print_r($data['interpretation']);exit;
	//$data['interpretation'] = '';
	    
	$data['GoalsAndSegment']	= $this->Assessment_model->get_goals_goalsEngagements($user_id,$theme_id,$test_id);
	$this->load->helper('pdf_helper');
	tcpdf();
	$obj_pdf = new PTCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "";
	$obj_pdf->SetTitle($title);
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	//$obj_pdf->SetHeaderMargin(10);
	$obj_pdf->SetFooterMargin(10);
	$obj_pdf->SetMargins(20,30,20);
	$obj_pdf->SetAutoPageBreak(TRUE, 10);
	$obj_pdf->SetFont('helvetica', '', 12);
	//$obj_pdf->setFontSubsetting(false);
	$obj_pdf->SetPrintHeader(true);
	$obj_pdf->SetPrintFooter(true);
	
	$obj_pdf->AddPage();
    $img_file = base_url().'assets/assessment/'.$theme_image;
    
    //$obj_pdf->Image($img_file, 8,10, 400, 530, '', '', '', false, 0, '', false, false, 0);
    $obj_pdf->Image($img_file, 8,10, 400, 530, '', '', '', false, 0, '', false, false, 0);
    //$obj_pdf->Image($img_file, left, top, width, height, '', '', '', false, 0, '', false, false, 0);//15, 28, 170
    
	$obj_pdf->AddPage();
	
	//ob_start();
    $content = $this->load->view('assessment/'.$loadViewFile,$data,true);
    //$content = $this->load->view('assessment/assessment_pdf_report_org',$data,true);
	//we can have any view part here like HTML, PHP etc
	//$content = ob_get_contents();
	//ob_end_clean();
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	
		
	//$lastPage = $obj_pdf->getPage();
	$obj_pdf->Output($theme_name.'.pdf', 'D');
    }
    
    
    public function assessment_pdf_send_mail(){
        error_log("assessment_pdf_send_mail");
        
        $post_data=$_GET;
        
        
        $data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');
        $user_id = $data['logged_in_user_data']->user_id;
        $theme_id = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        if($theme_id == 1 || $theme_id == 9){
            $theme_image='strength_and_energy.jpg';
        }else if($theme_id == 2){
            $theme_image='thought_control.jpg';
        }else if($theme_id == 3 || $theme_id == 10){
            $theme_image='relationship_and_intimacy.jpg';
        }else if($theme_id == 4){
            $theme_image='zest_for_life.jpg';
        }
        
        $data['themes']	= $this->Assessment_model->get_theme_name_by_id($theme_id);
        $theme_name = $data['themes'][0]->theme_name;
        $data['theme_details']     = $this->User->GetUserPercentage($user_id,$theme_id,$test_id);
        //print_r($data['theme_details']); exit;
        $score = $data['theme_details'][0]->marks_scored;
        
        $data['sub_theme_list']			= $this->User->GetUserSubthemeScore($user_id,$theme_id,$test_id);
        $data['sub_themes']			= $this->User->GetUserSubtheme($user_id,$theme_id,$test_id);
        
        if(isset($post_data["check_accept"])){
        
        $sub_theme_interpretaion = array();
        $i=0;
        foreach ($data['sub_theme_list'] as $subtheme) {
            
            
            $interpretation =  $this->Assessment_model->get_subtheme_interpretataion($theme_id,$subtheme->sub_theme_id, $test_id,$subtheme->marks_scored);
            $interpretation_text = $interpretation[0]->interpretation_text;
            $sub_theme_interpretaion[$i]['sub_theme'] = $subtheme->sub_theme_name;
            $sub_theme_interpretaion[$i]['marks_scored'] = $subtheme->marks_scored;
            $sub_theme_interpretaion[$i]['interpretation_text'] = $interpretation_text;
            
            $i++;
        }
        $data['interpretation'] = $sub_theme_interpretaion;
        
        //echo "<pre>";print_r($data['interpretation']);exit;
        //$data['interpretation'] = '';
        
        $data['GoalsAndSegment']	= $this->Assessment_model->get_goals_goalsEngagements($user_id,$theme_id,$test_id);
        $this->load->helper('pdf_helper');
        tcpdf();
        $obj_pdf = new PTCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = "";
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetHeaderMargin(10);
        $obj_pdf->SetFooterMargin(10);
        $obj_pdf->SetMargins(20,30,20);
        $obj_pdf->SetAutoPageBreak(TRUE, 10);
        $obj_pdf->SetFont('helvetica', '', 12);
        //$obj_pdf->setFontSubsetting(false);
        $obj_pdf->SetPrintFooter(false);
        
        $obj_pdf->AddPage();
        $img_file = base_url().'assets/assessment/'.$theme_image;
        $obj_pdf->Image($img_file, 12, 25, 186, 0, '', '', '', false, 0, '', false, false, 0);
        $obj_pdf->AddPage();
        //ob_start();
        $content = $this->load->view('assessment/assessment_pdf_report',$data,true);
        //we can have any view part here like HTML, PHP etc
        //$content = ob_get_contents();
        //ob_end_clean();
        $obj_pdf->writeHTML($content, true, false, true, false, '');
        //$lastPage = $obj_pdf->getPage();
        $pdfOutput = $obj_pdf->Output($theme_name.'.pdf', 'S');
        
        
        /* ====================================================== */
        
        $mail = new PHPMailer();
        
        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        /*
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'systems@zinguplife.com';                 // SMTP username
        $mail->Password = 'zinguplife01$';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        */
        $mail->setFrom($data['logged_in_user_data']->username);
        $mail->addAddress('aravind.kurushev@zinguplife.com');     // Add a recipient
        //$mail->addAddress('sambit@zinguplife.com');               // Name is optional
        $mail->addReplyTo($data['logged_in_user_data']->username);
        //$mail->addCC('sambit@zinguplife.com');
        //$mail->addBCC('bcc@example.com');
        
        $mail->AddStringAttachment($pdfOutput,$theme_name.'.pdf');         // Add attachments
        //$mail->AddAttachment(base_url("images/Strength__Energy.pdf"));      // some attached files
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Subject = 'Employee report';
        $mail->Body = '<html><body>';
        $mail->Body .= '<p>Hi Doctor,</p>';
        $mail->Body .= '<p>This is the detailed report of "'.$data["logged_in_user_data"]->name.'" for "' .$theme_name. '". Kindly review and contact the employee within 48 hours.</p>';
        $mail->Body .= '<p>Employee Phone: '.$data["logged_in_user_data"]->phone.'<br/>';
        $mail->Body .= 'Employee Email: "'.$data["logged_in_user_data"]->username.'"</p>';
        $mail->Body .= '<p>Regards,<br/>';
        $mail->Body .= 'Zinguplife</p>';
        $mail->Body .= '</body></html>';
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->send()) {
            $this->session->set_flashdata('error_message',"Report hasn't sent to general practitioner.");
            //'Mailer Error: ' . $mail->ErrorInfo;
            $data["mail"]="failed";
            $data["theme"]=$theme_id;
            echo json_encode($data);
        } else {
            $this->session->set_flashdata('error_message',"Report has been sent to general practitioner.");
            $data["mail"]="success";
            $data["theme"]=$theme_id;
            //echo $theme_name;
            echo json_encode($data);
            
        }
        }else{
            $this->session->set_flashdata('checkbox_error_message',"Before accept please tick chekbox!");
            $data["check_fail"]="failed_checkbox";
            $data["theme"]=$theme_id;
            echo json_encode($data);
        }
       
        
        
        /* ====================================================== */
        
        
    }
    
    public function dashboard_pdf_send_mail(){
        
        
        $post_data=$_GET;
        
        
        $data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');
        $user_id = $data['logged_in_user_data']->user_id;
        $theme_id = $this->uri->segment(3);
        $test_id = $this->uri->segment(4);
        if($theme_id == 1 || $theme_id == 9){
            $theme_image='strength_and_energy.jpg';
        }else if($theme_id == 2){
            $theme_image='thought_control.jpg';
        }else if($theme_id == 3 || $theme_id == 10){
            $theme_image='relationship_and_intimacy.jpg';
        }else if($theme_id == 4){
            $theme_image='zest_for_life.jpg';
        }
        
        $data['themes']	= $this->Assessment_model->get_theme_name_by_id($theme_id);
        $theme_name = $data['themes'][0]->theme_name;
        $data['theme_details']     = $this->User->GetUserPercentage($user_id,$theme_id,$test_id);
        //print_r($data['theme_details']); exit;
        $score = $data['theme_details'][0]->marks_scored;
        
        $data['sub_theme_list']			= $this->User->GetUserSubthemeScore($user_id,$theme_id,$test_id);
        $data['sub_themes']			= $this->User->GetUserSubtheme($user_id,$theme_id,$test_id);
        
     
            
            $sub_theme_interpretaion = array();
            $i=0;
            foreach ($data['sub_theme_list'] as $subtheme) {
                
                
                $interpretation =  $this->Assessment_model->get_subtheme_interpretataion($theme_id,$subtheme->sub_theme_id, $test_id,$subtheme->marks_scored);
                $interpretation_text = $interpretation[0]->interpretation_text;
                $sub_theme_interpretaion[$i]['sub_theme'] = $subtheme->sub_theme_name;
                $sub_theme_interpretaion[$i]['marks_scored'] = $subtheme->marks_scored;
                $sub_theme_interpretaion[$i]['interpretation_text'] = $interpretation_text;
                
                $i++;
            }
            $data['interpretation'] = $sub_theme_interpretaion;
            
            //echo "<pre>";print_r($data['interpretation']);exit;
            //$data['interpretation'] = '';
            
            $data['GoalsAndSegment']	= $this->Assessment_model->get_goals_goalsEngagements($user_id,$theme_id,$test_id);
            $this->load->helper('pdf_helper');
            tcpdf();
            $obj_pdf = new PTCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
            $obj_pdf->SetCreator(PDF_CREATOR);
            $title = "";
            $obj_pdf->SetTitle($title);
            $obj_pdf->SetDefaultMonospacedFont('helvetica');
            $obj_pdf->SetHeaderMargin(10);
            $obj_pdf->SetFooterMargin(10);
            $obj_pdf->SetMargins(20,30,20);
            $obj_pdf->SetAutoPageBreak(TRUE, 10);
            $obj_pdf->SetFont('helvetica', '', 12);
            //$obj_pdf->setFontSubsetting(false);
            $obj_pdf->SetPrintFooter(false);
            
            $obj_pdf->AddPage();
            $img_file = base_url().'assets/assessment/'.$theme_image;
            $obj_pdf->Image($img_file, 12, 25, 186, 0, '', '', '', false, 0, '', false, false, 0);
            $obj_pdf->AddPage();
            //ob_start();
            $content = $this->load->view('assessment/assessment_pdf_report',$data,true);
            //we can have any view part here like HTML, PHP etc
            //$content = ob_get_contents();
            //ob_end_clean();
            $obj_pdf->writeHTML($content, true, false, true, false, '');
            //$lastPage = $obj_pdf->getPage();
            $pdfOutput = $obj_pdf->Output($theme_name.'.pdf', 'S');
            
            
            /* ====================================================== */
            
            $mail = new PHPMailer();
            
            //$mail->SMTPDebug = 3;                               // Enable verbose debug output
           
             $mail->isSMTP();                                      // Set mailer to use SMTP
             $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
             $mail->SMTPAuth = true;                               // Enable SMTP authentication
             $mail->Username = 'systems@zinguplife.com';                 // SMTP username
             $mail->Password = 'zinguplife01$';                           // SMTP password
             $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
             $mail->Port = 587;                                    // TCP port to connect to
             
            $mail->setFrom($data['logged_in_user_data']->username);
            //$mail->addAddress('aravind.kurushev@zinguplife.com');  
            $mail->addAddress('shakti.chouhan@pratian.com');
            $mail->addAddress('hemavathi.jn@pratian.com');// Add a recipient
            //$mail->addAddress('sambit@zinguplife.com');               // Name is optional
            $mail->addReplyTo($data['logged_in_user_data']->username);
            //$mail->addCC('sambit@zinguplife.com');
            //$mail->addBCC('bcc@example.com');
            
            $mail->AddStringAttachment($pdfOutput,$theme_name.'.pdf');         // Add attachments
            //$mail->AddAttachment(base_url("images/Strength__Energy.pdf"));      // some attached files
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $mail->isHTML(true);                                  // Set email format to HTML
            
            $mail->Subject = 'Employee report';
            $mail->Body = '<html><body>';
            $mail->Body .= '<p>Hi Doctor,</p>';
            $mail->Body .= '<p>This is the detailed report of "'.$data["logged_in_user_data"]->name.'" for "' .$theme_name. '". Kindly review and contact the employee within 48 hours.</p>';
            $mail->Body .= '<p>Employee Phone: '.$data["logged_in_user_data"]->phone.'<br/>';
            $mail->Body .= 'Employee Email: "'.$data["logged_in_user_data"]->username.'"</p>';
            $mail->Body .= '<p>Regards,<br/>';
            $mail->Body .= 'Zinguplife</p>';
            $mail->Body .= '</body></html>';
            
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            if(!$mail->send()) {
                $this->session->set_flashdata('error_message',"Report hasn't sent to general practitioner.");
                //'Mailer Error: ' . $mail->ErrorInfo;
                $data["mail"]="failed";
                $data["theme"]=$theme_id;
                //echo json_encode($data);
            } else {
                $this->session->set_flashdata('error_message',"Report has been sent to general practitioner.");
                $data["mail"]="success";
                $data["theme"]=$theme_id;
                //echo $theme_name;
                //echo json_encode($data);
                
            }
            redirect("/dashboard");
        
        
        
        
        /* ====================================================== */
        
        
    }
    
//END of the Class
}
