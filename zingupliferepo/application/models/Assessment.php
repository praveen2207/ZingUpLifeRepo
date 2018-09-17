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

class Assessment extends CI_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('Service_client');
        $this->load->model('User'); 
        $this->load->library('encryption');
	$this->load->model('Assessment_model');
        
    }
    //--------------------------------------------------------------------------
    public function intro(){
        $data['title']          = "Get your personalized wellbeing score now";
        $data['main_content']   = 'assessment/index';
        $this->load->view('assessment/includes/template', $data);
    }
    //--------------------------------------------------------------------------
    public function index(){
        $this->load->model('Apiassessment_model');
        $this->Apiassessment_model->storeAssessmentResults(545, 6, 10);exit;
        $data['title']          = "Get your personalized wellbeing score now";
        $data['main_content']   = 'assessment/testpage';
        
	$theme_id = $this->input->cookie('theme_id');
        $level_id = $this->input->cookie('level_id');
        $data['theme_name']     = $this->input->cookie('theme_name'); 
        $data['web_banner']     = $this->input->cookie('web_banner');
	$data['mobile_web_banner']      = $this->input->cookie('mobile_web_banner');
        $question_api_url       = base_url().'api/assessment/questions/id/'.$theme_id.'/level_id/'.$level_id;
        $data['questions']      = $this->Service_client->getAssessmentQuestionsAPI($question_api_url);
	
	$data['toal_questions'] = count($data['questions']);
        $data['active_url'] = '';
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        
	if (isset($data['logged_in_user_data']->is_logged_in) == 1) {
            $data['user_id'] = $data['logged_in_user_data']->user_id;
        }else{
            $data['user_id'] = 0; 
        }
        $this->load->view('assessment/includes/template', $data);
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
        
    }
    //--------------------------------------------------------------------------
    public function report(){
	$theme_id			= $this->input->cookie('theme_id');
        $test_id			= $this->input->cookie('level_id');
        $theme_data                     = $this->Assessment_model->getThemeName($theme_id);
        $data['theme_name']             = $theme_data[0]->theme_name;
        $data['web_banner']             = $theme_data[0]->web_banner_img; 
        $data['mobile_web_banner']      = $theme_data[0]->mobile_web_banner;
        $data['title']                  = "Get your personalized wellbeing score now";
        $data['logged_in_user_data'] 	= $this->session->userdata("logged_in_user_data");
        $user_id			= $data['logged_in_user_data']->user_id;  
        $data['percentage']             = $this->User->GetUserPercentage($user_id,$theme_id,$test_id);
	$data['main_content']           = 'assessment/assessment_report';
        $this->load->view('assessment/includes/template', $data);
    }
    //--------------------------------------------------------------------------
    public function home(){
	$data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');
        if ($data['logged_in_user_data']->is_logged_in == 1) {
	$user_id			= $data['logged_in_user_data']->user_id;
	$data['taken_asses']		= $this->Assessment_model->get_asses_taken($user_id);
	//print_r($data['taken_asses']); exit;
        $api_url			= base_url().'api/assessments?type=init';
        $data['init_themes']		= $this->Service_client->getAssessmentsAPI($api_url);
        //echo "<pre>"; print_r($data['init_themes']);echo "</pre>";
        $api_url		= base_url().'api/assessments?type=null';
        $data['other_themes']	= $this->Service_client->getAssessmentsAPI($api_url);
        //echo "<pre>"; print_r($data['other_themes']); 
        //echo "</pre>"; exit;
        $data['main_content']   = 'assessment/home';
        $this->load->view('assessment/includes/template', $data);
        }else{
	    redirect("/login");
	}
    }
    //--------------------------------------------------------------------------
    
    public function bio_asses_theme(){
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
	echo json_encode($user_status);
	
    }
    //--------------------------------------------------------------------------
    
    public function diet_asses_theme(){
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
	echo json_encode($user_status);
	
    }
    
    //--------------------------------------------------------------------------
    
    public function wholesomeness_asses_theme(){
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
	echo json_encode($user_status);
	
    }
     //--------------------------------------------------------------------------
    
    public function strength_asses_theme(){
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
	echo json_encode($user_status);
	
    }
     //--------------------------------------------------------------------------
    
    public function thought_asses_theme(){
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
	echo json_encode($user_status);
	
    }
     //--------------------------------------------------------------------------
    
    public function relationship_asses_theme(){
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
	echo json_encode($user_status);
	
    }
     //--------------------------------------------------------------------------
    
    public function zest_asses_theme(){
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
	echo json_encode($user_status);
	
    }
    //--------------------------------------------------------------------------
    public function assessment_pdf_download(){
	
	$data['logged_in_user_data'] 	= $this->session->userdata('logged_in_user_data');
	$user_id = $data['logged_in_user_data']->user_id;
	$theme_id = $this->uri->segment(3);
	$test_id = $this->uri->segment(4);
	if($theme_id == 1){
	   $theme_image='strength_and_energy.jpg'; 
	}else if($theme_id == 2){
	    $theme_image='thought_control.jpg'; 
	}else if($theme_id == 3){
	    $theme_image='relationship_and_intimacy.jpg'; 
	}else if($theme_id == 4){
	    $theme_image='zest_for_life.jpg'; 
	}
	$data['themes']	= $this->Assessment_model->get_theme_name_by_id($theme_id);
	$theme_name = $data['themes'][0]->theme_name;
	$data['theme_details']     = $this->User->GetUserPercentage($user_id,$theme_id,$test_id);
	//print_r($data['theme_details']); exit;
	$score = $data['theme_details'][0]->marks_scored;
	$data['interpretation']	= $this->Assessment_model->get_asses_interpretataion($theme_id,$test_id,$score);
	//print_r($data['interpretation']); exit;
	//$this->load->view('assessment/assessment_pdf_report',$data);
	

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
        $img_file = base_url().'/assets/assessment/'.$theme_image;
	$obj_pdf->Image($img_file, 12, 25, 186, 0, '', '', '', false, 0, '', false, false, 0);
	$obj_pdf->AddPage();
	//ob_start();
	
	$content = $this->load->view('assessment/assessment_pdf_report',$data,true);
	
	//we can have any view part here like HTML, PHP etc
	//$content = ob_get_contents();
	//ob_end_clean();
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	//$lastPage = $obj_pdf->getPage();
	$obj_pdf->Output($theme_name.'.pdf', 'D');
    }
    
    
//END of the Class
}
