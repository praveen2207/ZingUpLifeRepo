<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 //error_reporting(E_ALL);
 //ini_set('display_errors', 1);
/**
 * This class for users registration, login and users actions/activities
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:04-08-2015
 * */
class Survey extends CI_Controller {

    public function __construct() {
        parent:: __construct();
		//$this->output->enable_profiler(TRUE);
		$this->load->model('User'); 
		$this->load->helper('cookie');		
    }

    /*
     *  Displaying user registration form 
     */

    public function home() {
		
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		
		//Flow Starts  If user is logged in
		if ($data['logged_in_user_data']->is_logged_in == 1) {
			$userid = $data['logged_in_user_data']->user_id;
			$this->session->set_userdata('surveyuserid',$userid);
			if($this->input->cookie('zingup_wellness_survey')== '') //Check from Cookie if there is any ongoing survey
			{
				//Check if user has taken the assessment and it was taken within last 7 days.
				$survey_taken = $this->User->checksurveydate($userid);
				if(!($survey_taken))
				{
					
					//redirect('dashboard');
					$checkuserattempted = $this->User->checkUserAttempted($userid); // Check if there is an ongoing assessment for this user.
					if($checkuserattempted) //If there is an ongoing assessment for this user, let user complete the surey first.
					{
						$this->session->set_userdata('assessment','on');
						$data['surveys'] = $this->User->getSurveyfromques($checkuserattempted);
						$data['main_content'] = 'survey/assesment2';
						$this->load->view('survey/includes/new_template', $data); 
					}
					else{
						redirect('dashboard');
					}
				}
				else // If there has not been any assessment taken in last seen days then show the surey home page.
				{
					$data['title'] = "Wellness Survey";
					$data['active_url'] = "survey_page";
					$data['main_content'] = 'survey/index';
					$this->load->view('survey/includes/new_template', $data);
				}
			}else  // There is an on going survey as stored in cookie.
			{
				
				$temp_id = $this->input->cookie('zingup_wellness_survey');
				$userid2 = $this->User->get_user_id($temp_id); 
			
				if($userid2 == $userid)// If logged in user Id and user ID in cookies are same.
				{
					$this->session->set_userdata('surveyuserid',$userid);
					 $checkuserattempted = $this->User->checkUserAttempted($userid); 
					if($checkuserattempted)// If user is having an existing assessment which is not complete.
					{
						$data['surveys'] = $this->User->getSurveyfromques($checkuserattempted);
						$data['main_content'] = 'survey/assesment2';
						$this->load->view('survey/includes/new_template', $data); 
					}
					else// Start the new surey
					{
						$data['surveys'] = $this->User->getSurvey();
						$data['main_content'] = 'survey/assesment2';
						$this->load->view('survey/includes/new_template', $data); 
					}
				}//end if 
				if($userid2 != $userid){ // If logged in user Id and user ID in cookies are not same.
					$survey_taken = $this->User->checksurveydate($userid); 
					if(!($survey_taken))// If assessment was taken within 7 days then show the dashboard
					{
						redirect('dashboard');
					}
					else // If assessment was taken before 7 days then show the dashboard
					{
						$data['title'] = "Wellness Survey";
						$data['active_url'] = "survey_page";
						$data['main_content'] = 'survey/index';
						$this->load->view('survey/includes/new_template', $data);
					}
				}//end if
			} // end else of cookie check
		}//Flow Ends  If user is logged in
		
		if ($data['logged_in_user_data']->is_logged_in != 1) {			// User in not logged in.
				
				$this->session->unset_userdata('surveyuserid');
				$this->session->unset_userdata('survey_data');
				$this->session->unset_userdata('surveytempuser');
				$this->session->unset_userdata('promocode');
				$this->session->unset_userdata('pagevisitorid');
				$this->session->unset_userdata('surveycookieid');
				$this->session->unset_userdata('survey');

				if($this->input->cookie('zingup_wellness_survey')== '') // Check if there is an ongoing 
				{                                                       // assessment in cookie if not then start a new assessment
					$data['title'] = "Wellness Survey";
					$data['active_url'] = "survey_page";
					$data['main_content'] = 'survey/index';
					$this->load->view('survey/includes/new_template', $data);
				}
				else													//If there is an ongoing assessment stored in cookie
				{                                                       // 
					$temp_id = $this->input->cookie('zingup_wellness_survey');
					$userid = $this->User->get_user_id($temp_id);
					if($userid == 0)			// If user is not a registered 
					{
						$pageid = $this->User->get_page_id($temp_id);
						$checkuserattempted = $this->User->checkUserpageAttempted($pageid);
					}else { //if user is registered
						$this->session->set_userdata('surveyuserid',$userid);
						$checkuserattempted = $this->User->checkUserAttempted($userid);
					}		
						
					if($checkuserattempted)
					{
						$data['surveys'] = $this->User->getSurveyfromques($checkuserattempted);
						$data['main_content'] = 'survey/assesment2';
						$this->load->view('survey/includes/new_template', $data);
					}
					else
					{
						$data['surveys'] = $this->User->getSurvey();
						$data['main_content'] = 'survey/assesment2';
						$this->load->view('survey/includes/new_template', $data);
					}
				}
			} // end ID When user is not logged in.
    }

/*
 * This function is called after every section (i.e. dimension) in asssessment flow.
 */
public function record_users_assessment_steps(){
	  $dimension =  $this->uri->segment(3);
	  $this->User_activity->insert_user_activity();
}
    
public function assessment() {
		 //$this->output->enable_profiler(TRUE);
		 $this->User_activity->insert_user_activity();
		 $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		 if ($data['logged_in_user_data']->is_logged_in == 1) 
		 {
			 $userid = $data['logged_in_user_data']->user_id;
			 
			 if($this->input->cookie('zingup_wellness_survey') == '')
			 {
				$data['survey_det'] = $this->User->getAllUserSurveyReport($userid);
				if(count($data['survey_det']) == 0)
				 {
					$array = array('user_id' => $userid );
					$id = $this->User->insertSurveyUser($array);
					$this->session->set_userdata('pagevisitorid',$id);
					$data['details'] = $this->User->getSdet($userid);
					$data['title'] = "Wellness Survey";
					$data['active_url'] = "survey_page";
					$data['surveys'] = $this->User->getSurvey();
					$data['visitor_id'] = $id;
					$data['main_content'] = 'survey/assesment2';
					$this->load->view('survey/includes/new_template', $data);
				 }
				 else
				 {
					$this->session->set_userdata('surveyuserid',$userid);
					$data['survey_det'] = $this->User->getAllUserSurveyReport($userid);
					$data['main_content'] = 'survey/healthprofile1';
					$this->load->view('survey/includes/new_template', $data);
				 }
			 }
			 else
			 {
				 $temp_id = $this->input->cookie('zingup_wellness_survey');
				 $userid2 = $this->User->get_user_id($temp_id); 
				 if($userid2 == $userid)
				 {
					 $userid = $userid2;
					$this->session->set_userdata('surveyuserid',$userid);
					$checkuserattempted = $this->User->checkUserAttempted($userid); 
					if($checkuserattempted)
					{
						$data['surveys'] = $this->User->getSurveyfromques($checkuserattempted);
						$data['main_content'] = 'survey/assesment2';
						$this->load->view('survey/includes/new_template', $data); 
					}
					else
					{
						$data['surveys'] = $this->User->getSurvey();
						$data['main_content'] = 'survey/assesment2';
						$this->load->view('survey/includes/new_template', $data); 
					} 
				 }
				 else
				 {
					 $data['survey_det'] = $this->User->getAllUserSurveyReport($userid);
					 //echo '<pre>'; print_r($data['survey_det']); exit();
					 if(count($data['survey_det']) == 0)
					 {
						$this->session->set_userdata('surveyuserid',$userid);
						$data['details'] = $this->User->getSdet($userid);
						$data['title'] = "Wellness Survey";
						$data['active_url'] = "survey_page";
						$data['main_content'] = 'survey/assesment1';
						$this->load->view('survey/includes/new_template', $data);
					 }
					 else
					 {
						 $this->session->set_userdata('surveyuserid',$userid);
						 $checkuserattempted = $this->User->checkUserAttempted($userid); 
						 if($checkuserattempted)
						 {
							
							$data['surveys'] = $this->User->getSurveyfromques($checkuserattempted);
							if(count($data['surveys']) == 0)
							{
								$this->session->set_userdata('surveyuserid',$userid);
								$data['survey_det'] = $this->User->getAllUserSurveyReport($userid);
								$data['main_content'] = 'survey/healthprofile1';
								$this->load->view('survey/includes/new_template', $data);
							}
							else
							{
								$this->session->set_userdata('surveyuserid',$userid);
								$data['main_content'] = 'survey/assesment2';
								$this->load->view('survey/includes/new_template', $data); 
							}
						 }
						 else
						 {
							$data['surveys'] = $this->User->getSurvey();
							$data['main_content'] = 'survey/assesment2';
							$this->load->view('survey/includes/new_template', $data); 
						 }
						
					 }
				 }
			 }
			 
		 }
		 else
		 {
			 //code added by shilpa (30/12/2016)
			 $this->load->helper('string'); //optional not necessary was using for save for later button 
			 $temp_id = random_string('alnum', 9); //optional not necessary was using for save for later button 
			 $temp_address = $temp_id; //optional not necessary was using for save for later button 
			 $this->session->set_userdata('surveytempuser',$temp_address); //optional not necessary was using for save for later button 
			 $temp_id = $this->session->userdata('surveytempuser'); //optionl not necessary was using for save for later button 
			 $temp = array('temp_address' => $temp_address,'user_id' =>0, 'bmi'=>'','promo_code_valid' => '1' );
			 $page_visitor_id = $this->User->add_page_visitornew($temp);
			 $this->session->set_userdata('pagevisitorid',$page_visitor_id);
			 //code added by shilpa (30/12/2016)			
							
			 $data['title'] = "Wellness Survey";
			 $data['active_url'] = "survey_page";
			 $data['surveys'] = $this->User->getSurvey();
			 $data['main_content'] = 'survey/assesment2';
			 $this->load->view('survey/includes/new_template', $data);
		 }
	 }
	 
	 public function assessment1()
	 {
			$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
			if ($data['logged_in_user_data']->is_logged_in == 1) 
			{ 
				$userid = $data['logged_in_user_data']->user_id;
				$data['details'] = $this->User->getSdet($userid);
			}
			
				$data['main_content'] = 'survey/assesment1';
				$this->load->view('survey/includes/new_template', $data);
			
	 }
	 
	 public function checkcode()
	 {
		 $data = $this->input->post();
		 $code= $data['code'];
		 
		 $checkvalid = $this->User->checkvalidpromoCode($code);
		 if($checkvalid)
		 {
			 $id = $this->session->userdata('pagevisitorid');
			 $this->User->updatePromo2($id,'1');
			 $this->session->set_userdata('promocode',$code);
			 echo json_encode(true);
		 }
		 else
		 {
			 echo json_encode(false);
		 }
	 }
	 
	 public function checkpromoadded()
	 {
		 if($this->session->userdata('promocode'))
		 {
			 echo json_encode(true);
		 }
		 else{
			 echo json_encode(false);
		 }
	 }
	 
	  public function checkloggedcode()
	 {
		 $data = $this->input->post();
		 $code= $data['code'];
		 $vistid= $data['vistid'];
		 $checkvalid = $this->User->checkvalidpromoCode($code);
		 if($checkvalid)
		 {
			 
			 $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
			 $userid = $data['logged_in_user_data']->user_id;
			 $this->session->set_userdata('surveyuserid',$userid);

			 $this->User->updatePromostatus($code);
			 $this->session->set_userdata('pagevisitorid',$vistid);
			 $id = $this->session->userdata('pagevisitorid');
			 $this->User->updatePromo2($vistid,'1');
			 echo json_encode($id);
		 }
		 else
		 {
			 echo json_encode(false);
		 }
	 }
	 
	 public function checkemailregistered()
	 {
		 $data = $this->input->post();
		 $check_user_exists = $this->User->check_username_availability($data['email']);
		 if(empty($check_user_exists))
		 {
			 echo json_encode(false);
		 }
		 else
		 {
			 $this->session->set_userdata('survey','on');
			 echo json_encode(true);
		 }
	 }
	 
	 /*
	  public function register()
	{ 
		
		$this->load->library('PasswordHash');
		$data = $this->input->post();
		
		$name = $data['user_name'];
		$email = $data['email'];
		$gender = $data['gender'];
        $phone = $data['phone'];                
		$pass = $data['password'];	
		$age = $data['age'];
		$weight = $data['weight'];
		$height = $data['height'];
		$bmi = $data['bmi'];
		$body_type = $data['body_type'];
		$org = $data['organization'];
		$promo = $data['promocode'];
		$link = $data['link'];
		$pro = $this->session->userdata('promocode');
		$code = $data['access'];
		
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		 if ($data['logged_in_user_data']->is_logged_in == 1) {
			 $userid = $data['logged_in_user_data']->user_id;
			 $post_data = array(
							'age' => $age,
							'weight' => $weight,
							'height' => $height,
							'body_type' => $body_type, 
							'bmi' => $bmi,
							'organization' => $org
						);
			$this->User->update_usersurveydetails($post_data,$userid);
			if($this->session->userdata('promocode'))
			{
				$temp_id = $this->session->userdata('surveytempuser');
				$page_visitor_id = $this->User->get_add_page_visitor($temp_id); 
				$this->User->updatepromo2($page_visitor_id,'1');
			}
		
			if(!($this->session->userdata('surveytempuser')))
						{
							$this->load->helper('string');
							$temp_id = random_string('alnum', 9);
							$temp_address = $temp_id;
							$this->session->set_userdata('surveytempuser',$temp_address);
							$temp_id = $this->session->userdata('surveytempuser');
							$temp = array('temp_address' => $temp_address,'user_id' =>$userid, 'bmi'=>$bmi,'promo_code_valid' => '1' );
							$page_visitor_id = $this->User->add_page_visitornew($temp);
							$this->session->set_userdata('pagevisitorid',$page_visitor_id);
						}
						else
						{
							$temp_id = $this->session->userdata('surveytempuser');
						
						}
		
			if($data['btntype'] == 'later')
			{
				if($this->input->cookie('zingup_wellness_survey')== '')
				{
					$this->load->helper('string');
					$temp_id = random_string('alnum', 9);
					$ip = $this->input->ip_address();
					$personal_id = $this->User->addFirstuser($ip,$temp_id,$userid);
					$cookie= array(
						'name'   => 'zingup_wellness_survey',
						'value'  => $temp_id,
						'expire' => 1.572e+7
						);
						
					$this->input->set_cookie($cookie);
					redirect('/dashboard');
				}
			}
			else
			{
				$this->session->set_userdata('surveyuserid',$userid);
				$data['surveys'] = $this->User->getSurvey();
				$data['main_content'] = 'survey/assesment2';
				$this->load->view('survey/includes/new_template', $data); 
			}
		 }
		 else{
				$check_user_exists = $this->User->check_username_availability($email);
				if(empty($check_user_exists))
				{
					
					 $checkvalid = $this->User->checkvalidpromoCode($code);
					 if($checkvalid)
					 {
						
						 $this->session->set_userdata('promocode',$code);
					
						 
						$hashed = PasswordHash::create_hash($pass);
						$post_data = array(
								'username' =>$email, 
								'name' => $name,
								'gender' => $gender,
                                                                'phone'=> $phone,
								'age' => $age,
								'weight' => $weight,
								'height' => $height,
								'body_type' => $body_type, 
								'bmi' => $bmi,
								'organization' => $org
							);
						$this->User->create_user($post_data, $hashed);
						$validate_user = $this->User->validate_user($email, $pass);
						if ($validate_user['validation_status']['status'] == 'Success') {
							$validate_user['user_details']->is_logged_in = '1';
							$this->session->set_userdata("logged_in_user_data", $validate_user['user_details']);
						}
						$this->session->set_userdata('surveyuserid',$userid);
						$user_details = $this->User->get_user_details_by_username($email);
						$userid = $user_details->user_id;
						
						
						if(!($this->session->userdata('surveytempuser')))
						{
							$this->load->helper('string');
							$temp_id = random_string('alnum', 9);
							$temp_address = $temp_id;
							$this->session->set_userdata('surveytempuser',$temp_address);
							$temp_id = $this->session->userdata('surveytempuser');
							$temp = array('temp_address' => $temp_address,'user_id' =>$userid, 'bmi'=>$bmi,'promo_code_valid' => '1' );
							$page_visitor_id = $this->User->add_page_visitornew($temp);
							$this->session->set_userdata('pagevisitorid',$page_visitor_id);
						}
						else
						{
							$temp_id = $this->session->userdata('surveytempuser');
							
						}
						
						
						if($this->session->userdata('pagevisitorid'))
						{
							
						}
						else
						{
							$this->session->set_userdata('pagevisitorid',$page_visitor_id);
						}
						
						if($this->session->userdata('surveycookieid'))
						{
							$cookie = $this->session->userdata('surveycookieid');
							
						}
						
						if($data['btntype'] == 'later')
						{
							if($this->input->cookie('zingup_wellness_survey')== '')
							{
								$this->load->helper('string');
								$temp_id = random_string('alnum', 9);
								$ip = $this->input->ip_address();
								$personal_id = $this->User->addFirstuser($ip,$temp_id,$userid);
							
								$cookie= array(
									'name'   => 'zingup_wellness_survey',
									'value'  => $temp_id,
									'expire' => 1.572e+7
									);
									
								$this->input->set_cookie($cookie);
								redirect('/dashboard');
							}
						}
						else
						{
							$this->session->set_userdata('surveyuserid',$userid);
							$checkuserattempted = $this->User->checkUserAttempted($userid); 
							if($checkuserattempted)
							{
								$data['surveys'] = $this->User->getSurveyfromques($checkuserattempted);
								$data['main_content'] = 'survey/assesment2';
								$this->load->view('survey/includes/new_template', $data); 
							}
							else
							{
								
								$data['surveys'] = $this->User->getSurvey();
								$data['main_content'] = 'survey/assesment2';
								$this->load->view('survey/includes/new_template', $data); 
								
							}
						}
						
						if($this->session->userdata('surveycookieid'))
						{
							redirect('/dashboard');
						}
					}
					else{
						$this->session->set_flashdata('user_name', $name);
						$this->session->set_flashdata('username', $email);
						$this->session->set_flashdata('gender', $gender);
						$this->session->set_flashdata('age', $age);
						$this->session->set_flashdata('weight', $weight);
						$this->session->set_flashdata('height', $height);
						$this->session->set_flashdata('bmi', $bmi);
						$this->session->set_flashdata('body_type', $body_type);
						$this->session->set_flashdata('organization', $org);
						$this->session->set_flashdata('terms', 'checked');
						$this->session->set_flashdata('message', 'The Access Code is already been used');
						redirect('survey/assessment1');
					}
				}
				else
				{
					$this->User->updatePromostatus($pro);
					$userid = $this->User->get_username_availability($email);
					$checksurveyd = $this->User->checksurveydate($userid); 
					if($checksurveyd)
					{
						$post_data = array(
								'age' => $age,
								'weight' => $weight,
								'height' => $height,
								'body_type' => $body_type, 
								'bmi' => $bmi,
								'organization' => $org
							);
						$this->User->update_usersurveydetails($post_data,$userid);
						$tempid = $this->session->userdata('surveytempuser');
						$this->User->update_userfortemp($tempid,$userid,$bmi);
						$page_id = $this->User->get_page_idadd($tempid);
						$this->session->set_userdata('surveyuserid',$userid);
						$this->session->set_userdata('pagevisitorid',$page_id);
							 if($data['btntype'] == 'later')
							{
								if($this->input->cookie('zingup_wellness_survey')== '')
								{
									$this->load->helper('string');
									$temp_id = random_string('alnum', 9);
									$ip = $this->input->ip_address();
									$personal_id = $this->User->addFirstuser($ip,$temp_id,$userid);
									$cookie= array(
										'name'   => 'zingup_wellness_survey',
										'value'  => $temp_id,
										'expire' => 1.572e+7
										);
										
									$this->input->set_cookie($cookie);
									redirect('/login');
								}
							}
							else
							{
								$this->session->set_userdata('surveyuserid',$userid);
								$checkuserattempted = $this->User->checkUserAttempted2($userid,$page_id); 
								if($checkuserattempted)
								{
									$data['msg'] = 'You have already registered before. Please use the old password to login';
									$data['surveys'] = $this->User->getSurveyfromques($checkuserattempted);
									$data['main_content'] = 'survey/assesment2';
									$this->load->view('survey/includes/new_template', $data); 
								}
								else
								{
									$data['surveys'] = $this->User->getSurvey();
									$data['main_content'] = 'survey/assesment2';
									$this->load->view('survey/includes/new_template', $data); 
								}
							}
					}
					else
					{
						$code = $this->session->userdata('promocode');
						$this->User->unspromocode($code);
						$this->session->set_flashdata('message', 'You have already taken the survey Please login to view the report. You can take survey once in a week');
						redirect('survey/survey_already_taken');
					}
				}
		 }
		 
		
	}
	*/

	 /**
	  * Register User at the end of the 
	  */
	 
public function register()
	{ 
		$data 	= $this->input->post();
		$name 	= $data['user_name'];
		$email 	= $data['email'];
		$gender = $data['gender'];
        $phone 	= $data['phone'];                
		$pass 	= $data['phone'];  
		$age 	= $data['age'];
		$weight = $data['weight'];
		$height = $data['height'];
		$bmi 	= $data['bmi'];
		$otp  	= $data['otp'];
		
		$check_otp = $this->validate_access_code();
		
		if (!$check_otp){
						$this->session->set_flashdata('user_name', $name);
						$this->session->set_flashdata('email', $email);
						$this->session->set_flashdata('phone', $phone);
						$this->session->set_flashdata('gender', $gender);
						$this->session->set_flashdata('age', $age);
						$this->session->set_flashdata('weight', $weight);
						$this->session->set_flashdata('height', $height);
						$this->session->set_flashdata('bmi', $bmi);
						$this->session->set_flashdata('otp', $otp);
						$this->session->set_flashdata('terms', 'checked');			
						$this->session->set_flashdata('otp_error', "Invalid access code.");
				$data['main_content'] = 'survey/assesment1';
				$this->load->view('survey/includes/new_template', $data);
				return ;
		}
		$this->load->library('PasswordHash');
		$hashed = PasswordHash::create_hash($phone);
		
		$check_user_exists = $this->User->check_username_availability($email);
		if(empty($check_user_exists)){
			
					 $post_data = array(
									'username' 	=> $email, 
					 				'password' 	=> $phone,
									'name' 		=> $name,
									'gender' 	=> $gender,
	                 				'phone'		=> $phone,
									'age' 		=> $age,
									'weight' 	=> $weight,
									'height' 	=> $height,
									'bmi' 		=> $bmi
								);
					$this->User->create_user($post_data, $hashed);
					
					$validate_user = $this->User->validate_user($email, $pass);
					
					if ($validate_user['validation_status']['status'] == 'Success') {
						$validate_user['user_details']->is_logged_in = '1';
						$this->session->set_userdata("logged_in_user_data", $validate_user['user_details']);
					}
					$user_details = $this->User->get_user_details_by_username($email);
					$userid = $user_details->user_id;
					$this->session->set_userdata('surveyuserid',$userid);
					$this->setup_password_email($user_details);
				}
				$user_details = $this->User->get_user_details_by_username($email);
				$userid = $user_details->user_id;
				
				/*added on 26th december*/
				//$survey_start_date = $this->User->getSurveyStartDate($pageid);
				$survey_end_date = date('Y-m-d h:m:s');
				$survey_start_date = date('Y-m-d h:m:s');
				$survey_comp = array('user_id' => $userid,'survey_start_date' =>$survey_start_date, 'survey_end_date' => $survey_end_date,'is_survey_completed' => 'Y' );
				
				$this->User->addSurveyComp($survey_comp);
				/*added on 26th december*/
						
				
				//code added by shilpa(30/12/2016)
				$this->session->set_userdata('surveyuserid',$userid);
				$pageid = $this->session->userdata('pagevisitorid');  
				$this->User->update_survey_userid($pageid,$userid);
				
				redirect('survey/healthprofile1');
				
		
	}
	
	public function retake()
	{
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		if ($data['logged_in_user_data']->is_logged_in == 1) {
			
				$id = $data['logged_in_user_data']->user_id;
			}
			$this->User->resetdata($id);
		$this->load->helper('cookie');
		$temp_id = $this->input->cookie('zingup_wellness_survey');
		$this->User->deleteSurvey($temp_id);
		$this->User->deleteUserSurvey($id);
		$cookie = array(
				'name'   => 'zingup_wellness_survey',
				'value'  => '',
				'expire' => '0'
				);
		delete_cookie($cookie);
		redirect('survey/home');
	}
	
	public function survey_taken()
	{
		/*$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		if ($data['logged_in_user_data']->is_logged_in == 1) {
			
				$id = $data['logged_in_user_data']->user_id;
			}
			else
			{
				$id = $this->uri->segment(3);
			}
		$data['survey_det'] = $this->User->getAllUserSurveyReport($id);
		$data['bmi_report'] = $this->User->getBmiReport($id);
		$data['main_content'] = 'survey_before_taken';
		$this->load->view('includes/menu_new_template', $data);*/
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		if ($data['logged_in_user_data']->is_logged_in == 1) {
			
				$id = $data['logged_in_user_data']->user_id;
			}
			else
			{
				$id = $this->session->userdata('surveyuserid');
			}
		
		$data['survey_det'] = $this->User->getAllUserSurveyReport($id);
		$data['bmi_report'] = $this->User->getBmiReport($id);
		$data['main_content'] = 'survey/healthprofile1';
		$this->load->view('survey/includes/new_template', $data); 
	}
	
	public function survey_already_taken()
	{
		/*$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		if ($data['logged_in_user_data']->is_logged_in == 1) {
			
				$id = $data['logged_in_user_data']->user_id;
			}
		$data['id'] = $id = $data['logged_in_user_data']->user_id;	
		$data['survey_det'] = $this->User->getAllUserSurveyReport($id);
		$data['bmi_report'] = $this->User->getBmiReport($id);
		$data['main_content'] = 'survey_taken';
		$this->load->view('includes/menu_new_template', $data);*/
		$data['title'] = "Wellness Survey";
	    $data['active_url'] = "";
	    $data['main_content'] = 'survey/assesment1';
	    $this->load->view('survey/includes/new_template', $data);
	}
	
	public function again()
	{
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		$id = $data['logged_in_user_data']->user_id;
		$this->User->deleteUserSurvey($id);
		redirect('survey/home');
	}
	
	public function download()
	{
		$id = $this->uri->segment(3);
		$data['survey_det'] = $this->User->getAllUserSurveyReport($id);
		$data['bmi_report'] = $this->User->getBmiReport($id);
		$data['img'] = $this->User->getSurveyImg($id); 
		
		//$this->load->view('survey_report_download',$data);
		//$data['main_content'] = 'survey_report_download';
		//$this->load->view('includes/menu_new_template', $data);
		
		
		$this->load->helper('pdf_helper');
        tcpdf();
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $title = "Wellness Assessment Report";
        $obj_pdf->SetTitle($title);
        $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('helvetica', '', 9);
        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        //ob_start();
        // we can have any view part here like HTML, PHP etc
        $content = $this->load->view('survey_report_download',$data,  true);

        //ob_end_clean();
        $obj_pdf->writeHTML($content, true, false, true, false, '');
        $obj_pdf->Output('Wellness_Assessment_Report.pdf', 'D');
        //$this->sendWellnessReport($id);
		
	}
	
	public function report()
	{
                $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
			 $id = $this->uri->segment(3);
			 $userid = $this->User->getUserId($id);
                         if($data['logged_in_user_data']->user_id){
                            $user_id = $data['logged_in_user_data']->user_id;
                         }
			
				$data['id'] = $this->uri->segment(3);
				$data['check'] = $this->User->checkPromovalidornot2($id);
				if( file_exists(FCPATH . 'survey_images/healthprofile1/'.$id.'/healthprofile1.png'))
				{
					$data['file'] = 'y';
				}
				else{
					$data['file'] = 'n';
				}
				$data['survey_det'] = $this->User->getAllUserSurveyReportdown($id);
                                
				
				$data['max'] = $this->User->gettempmaxsurvey($id); 
				$data['min'] = $this->User->gettempminsurvey($id); 
				$data['bmi_report'] = $this->User->getBmiReport($id);
				$data['bmi'] = $this->User->getBmiReportin($id);
                $data['user_details']     = $this->User->getSdet($user_id);
                $data['survey_date']     = $this->User->getSurveryCompletedDate($user_id);
			
				
				$this->load->helper('pdf_helper');
				tcpdf();
				$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$obj_pdf->SetCreator(PDF_CREATOR);
				$title = "PESONAL WELLBEING BLUEPRINT";
				$obj_pdf->SetTitle($title);
				$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
				$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
				$obj_pdf->SetDefaultMonospacedFont('helvetica');
				$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				$obj_pdf->SetFont('helvetica', '', 9);
				$obj_pdf->setFontSubsetting(false);
				$obj_pdf->AddPage();
				//ob_start();
				// we can have any view part here like HTML, PHP etc
				$content = $this->load->view('survey/survey_report_download',$data,  true);
				
				//if(getenv('REMOTE_ADDR') == "122.172.36.201")  {echo $content; exit; }
				
				//ob_end_clean();
				$obj_pdf->writeHTML($content, true, false, true, false, '');
				$lastPage = $obj_pdf->getPage();
				//$obj_pdf->deletePage($lastPage);
				$obj_pdf->Output('Wellness_Assessment_Report.pdf', 'D');
			
		
		
	}
	
	public function savecharts()
	{
		$data = str_replace(' ', '+', $_POST['data2']);
		$id = $_POST['id'];
		$data = base64_decode($data);
		$fileName = date('ymdhis').'.png';
		$im = imagecreatefromstring($data);
		 
		 $this->User->saveSurveygraph($id,$fileName);
		if ($im !== false) {
			// Save image in the specified location
			imagepng($im, "./graph/".$fileName."");
			imagedestroy($im);
			echo $fileName;
		}
		
	}
	
	public function next_survey_info_submit()
	{
		$data = $this->input->post();
		//echo '<pre>'; print_r($data);
		//$this->session->set_userdata('surveyuserid',$data['userid']);
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		if ($data['logged_in_user_data']->is_logged_in == 1) {
			$userid = $data['logged_in_user_data']->user_id;
			$this->session->set_userdata('surveyuserid',$userid);
			$page_visitor_id = $this->session->userdata('pagevisitorid');
		
			for($i=1;$i<=$data['length'];$i++)
			{
				if($data['option'.$i] != '')
				{
					$array = array(
								'ques_id'   =>  $data['question' . $i],
								'option_id' =>  $data['option' . $i],
								'userid'    =>  $userid,
								'survey_page_visitor_id' => $page_visitor_id
							);
					$this->User->addSurveyUser($data['question' . $i],$data['option' . $i],$page_visitor_id, $array);
				}
			}
			echo json_encode(true);
		}
		else
		{
			if($this->session->userdata('surveyuserid'))
			{
				$userid = $this->session->userdata('surveyuserid');
				$temp_id = $this->session->userdata('surveytempuser');
				$page_visitor_id = $this->User->page_id($temp_id);
				 $this->session->set_userdata('pagevisitorid',$page_visitor_id);
			}
			else
			{
				$userid = 0;
				if(!($this->session->userdata('surveytempuser')))
				{
					$this->load->helper('string');
					$temp_id = random_string('alnum', 9);
					$temp_address = $temp_id;
					$this->session->set_userdata('surveytempuser',$temp_address);
					
					$temp = array('temp_address' => $temp_address);
					$page_visitor_id = $this->User->add_page_visitor($temp,$temp_address);
					 $this->session->set_userdata('pagevisitorid',$page_visitor_id);
				}
				else
				{
					$temp_id = $this->session->userdata('surveytempuser');
					$page_visitor_id = $this->User->get_add_page_visitor($temp_id); 
					 $this->session->set_userdata('pagevisitorid',$page_visitor_id);
				}
				
				
			}
			
			for($i=1;$i<=$data['length'];$i++)
			{
				if($data['option'.$i] != '')
				{
					
					$array = array(
								'ques_id'   =>  $data['question' . $i],
								'option_id' =>  $data['option' . $i],
								'userid'    =>  $userid,
								'survey_page_visitor_id' => $page_visitor_id
							);
					$this->User->addtempSurveyUser($data['question' . $i],$data['option' . $i],$page_visitor_id, $array);
				}
			}
			$this->session->set_userdata('pagevisitorid',$page_visitor_id);
			$c= $this->session->userdata('pagevisitorid');
			echo json_encode(true);
		}
	}
	
	public function survey_info_submit()
	{
		$data = $this->input->post();
		
		
		if($this->input->cookie('zingup_wellness_survey') == '')
		{
			if($this->session->userdata('surveyuserid'))
			{
				
				$data['userid'] = $this->session->userdata('surveyuserid');
				$this->load->helper('string');
				$temp_id = random_string('alnum', 9);
				$ip = $this->input->ip_address();
				if($this->session->userdata('pagevisitorid'))
				{
					$survey_page =$this->session->userdata('pagevisitorid');
					$this->User->updateaddFirstuser($survey_page,$temp_id);
					
				}
				else{
						$personal_id = $this->User->addFirstuser2($ip,$temp_id,$data['userid']);
					$survey_page = $personal_id;
					
				}
				$cookie= array(
					'name'   => 'zingup_wellness_survey',
					'value'  => $temp_id,
					'expire' => 1.572e+7
					);
				$this->input->set_cookie($cookie);
			}
			else
			{
				$this->load->helper('string');
				$temp_id = random_string('alnum', 9);
				$ip = $this->input->ip_address();
				$survey_page = $this->User->addnonuseriduser($ip,$temp_id);
				$cookie= array(
					'name'   => 'zingup_wellness_survey',
					'value'  => $temp_id,
					'expire' => 1.572e+7
					);
				$this->input->set_cookie($cookie);
				$this->session->set_userdata('pagevisitorid',$survey_page);
				$this->session->set_userdata('surveycookieid',$temp_id );
			}
			
		}
		else
		{

			$survey_page = 0;
			$temp_id = $this->input->cookie('zingup_wellness_survey');
			delete_cookie("zingup_wellness_survey");
			$this->load->helper('string');
			$new_temp_id = random_string('alnum', 9);
			$ip = $this->input->ip_address();
			$survey_page_id = $this->User->Updatenewcookie($new_temp_id,$temp_id);
			if($survey_page_id)
			{
				$survey_page = $survey_page_id;
				$this->session->set_userdata('pagevisitorid',$survey_page );
			}
			else{
				$survey_page = 0;
			}
			$cookie= array(
				'name'   => 'zingup_wellness_survey',
				'value'  => $new_temp_id,
				'expire' => 1.572e+7
				);
			$this->input->set_cookie($cookie);
			$temp_id = $new_temp_id;
			$this->session->set_userdata('surveycookieid',$new_temp_id );
			
			
			//$personal_id = $this->User->get_page_visitor_id($temp_id);
			$personal_id = $this->User->get_page_visitor_id($data['userid']);
		}
		
		$this->session->set_userdata('surveyuserid',$data['userid']);
		
		for($i=1;$i<=$data['length'];$i++)
		{
			if($data['option'.$i] != '')
			{
				$array = array(
							'ques_id'   =>  $data['question' . $i],
							'option_id' =>  $data['option' . $i],
							'userid'    =>  $data['userid'],
							'survey_page_visitor_id' => $survey_page
						);
				if($this->session->userdata('surveyuserid'))
				{
					$this->User->addSurveyUser($data['question' . $i],$data['option' . $i],$data['userid'], $array);
				}
				else{
					$this->User->addtempSurveyUser($data['question' . $i],$data['option' . $i],$survey_page, $array);
				}
			}
		}
	
		echo json_encode(true);
	}
	
	public function healthprofile1()
	{
		
		if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		  $this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }
		$userid = $this->session->userdata('surveyuserid');
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		if ($data['logged_in_user_data']->is_logged_in == 1) {
			$userid = $data['logged_in_user_data']->user_id;
		}
		else{
			if($this->session->userdata('surveyuserid'))
			{
				$userid = $this->session->userdata('surveyuserid');
			}
			else
			{
				$userid = 0;
			}
		}
		$pageid = $this->session->userdata('pagevisitorid');
		$data['survey_det'] = $this->User->getAllUserSurveyReport($userid,$pageid);
		
		/*added on 26th december*/
		//$survey_start_date = $this->User->getSurveyStartDate($pageid);
		//$survey_end_date = date('Y-m-d h:m:s');
		//$survey_comp = array('user_id' => $userid,'survey_start_date' =>$survey_start_date, 'survey_end_date' => $survey_end_date,'is_survey_completed' => 'Y' );		
		//$this->User->addSurveyComp($survey_comp);
		/*added on 26th december*/
		
		delete_cookie('zingup_wellness_survey');
		$data['survey_det'] = $this->User->getAllUserSurveyReport($userid,$pageid);
		$data['main_content'] = 'survey/healthprofile1';
		$this->load->view('survey/includes/new_template', $data); 
			
			
		/*$pageid = $this->session->userdata('pagevisitorid');
		$check = $this->User->checkPromovalidornot($userid,$pageid);
		if($check)
		{
			
			$data['survey_det'] = $this->User->getAllUserSurveyReport($userid,$pageid);
			delete_cookie('zingup_wellness_survey');
			$data['main_content'] = 'survey/healthprofile1';
			$this->load->view('survey/includes/new_template', $data); 
		}
		else
		{
			redirect('survey/healthprofile2');
		}*/
	}
	
	public function healthprofile2()
	{
		
		if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		  $this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }
	   
		$pageid = $this->session->userdata('pagevisitorid');
		if($this->session->userdata('surveytempuser'))
		{
			
			$tempid = $this->session->userdata('surveytempuser');
			$id = $this->User->page_id($tempid);
			$data['right'] = $this->User->gettempmaxsurvey($id); 
			$data['left'] = $this->User->gettempminsurvey($id); 
			if(count($data['right']) == 0)
			{
				
				redirect('survey/healthprofile3');
			}
		}
		else
		{
			
			$userid = $this->session->userdata('surveyuserid');
			$this->session->set_userdata('surveyuserid',$userid);
			$data['right'] = $this->User->getmaxsurvey($userid,$pageid);
			$data['left'] = $this->User->getminsurvey($userid,$pageid);
			
			$check = $this->User->checkPromovalidornot($userid,$pageid);
			$data['right'] = $this->User->gettempminsurvey($pageid); 
			if(count($data['right']) == 0)
			{
				$data['health3'] = 'skip';
			}
			else{
				$data['health3'] = 'add';
				
			}
				if($check)
				{
					$data['register'] = 'yes';
					delete_cookie('zingup_wellness_survey');
				}
				else{
					$data['register'] = 'no';
					//$this->session->unset_userdata('surveyuserid');
					//$this->session->unset_userdata('survey_data');
					//$this->session->unset_userdata('surveytempuser');
				}
				
			if(count($data['right']) == 0)
			{
				redirect('survey/healthprofile3');
			}
		}
		$data['main_content'] = 'survey/healthprofile2';
		$this->load->view('survey/includes/new_template', $data);
	}
	
	public function prev_healthprofile2()
	{
		
		if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		  $this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }
	   
		$pageid = $this->session->userdata('pagevisitorid');
		if($this->session->userdata('surveytempuser'))
		{
			$tempid = $this->session->userdata('surveytempuser');
			$id = $this->User->page_id($tempid);
			$data['right'] = $this->User->gettempmaxsurvey($id); 
			$data['left'] = $this->User->gettempminsurvey($id); 
			if(count($data['right']) == 0)
			{
				redirect('survey/healthprofile1');
			}
		}
		else
		{
			
			$userid = $this->session->userdata('surveyuserid');
			$this->session->set_userdata('surveyuserid',$userid);
			$data['right'] = $this->User->getmaxsurvey($userid,$pageid);
			$data['left'] = $this->User->getminsurvey($userid,$pageid);
			if(count($data['right']) == 0)
			{
				redirect('survey/healthprofile1');
			}
		}
		$data['main_content'] = 'survey/healthprofile2';
		$this->load->view('survey/includes/new_template', $data);
	}
	
	public function healthprofile3()
	{
		
		if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		  $this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }
	   
		 $pageid = $this->session->userdata('pagevisitorid');
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		if ($data['logged_in_user_data']->is_logged_in == 1) {
			$userid = $data['logged_in_user_data']->user_id;
			 $check = $this->User->checkPromovalidornot($userid,$pageid);
			$data['right'] = $this->User->getminsurvey($userid,$pageid);
			if($check)
			{
				$data['register'] = 'yes';
				delete_cookie('zingup_wellness_survey');
				
			}
			else{
				$data['register'] = 'no';
				//$this->session->unset_userdata('surveyuserid');
				//$this->session->unset_userdata('survey_data');
				//$this->session->unset_userdata('surveytempuser');
			}
		}
		else
		{
			if($this->session->userdata('surveytempuser') && !($this->session->userdata('surveyuserid')))
			{
				$tempid = $this->session->userdata('surveytempuser');
				$id = $this->User->page_id($tempid);
				$data['right'] = $this->User->gettempminsurvey($id); 
				$data['register'] = 'no';
				//$this->session->unset_userdata('surveyuserid');
				//$this->session->unset_userdata('survey_data');
				//$this->session->unset_userdata('surveytempuser');
			}
			else
			{
				$userid = $this->session->userdata('surveyuserid');
				$this->session->set_userdata('surveyuserid',$userid);
				$data['right'] = $this->User->getminsurvey($userid,$pageid);
				$check = $this->User->checkPromovalidornot($userid,$pageid);
				if($check)
				{
					$data['register'] = 'yes';
					delete_cookie('zingup_wellness_survey');
				}
				else{
					$data['register'] = 'no';
					//$this->session->unset_userdata('surveyuserid');
					//$this->session->unset_userdata('survey_data');
					//$this->session->unset_userdata('surveytempuser');
				}
			}
			}
			
			if(count($data['right']) == 0)
			{
				redirect('survey/healthprofile4');
			}
			else{
			$data['main_content'] = 'survey/healthprofile3';
			$this->load->view('survey/includes/new_template', $data); 
			}
		
	}
	
	public function prev_healthprofile3()
	{
		
		if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		  $this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }
	   
	   
		 $pageid = $this->session->userdata('pagevisitorid');
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		if ($data['logged_in_user_data']->is_logged_in == 1) {
			$userid = $data['logged_in_user_data']->user_id;
			 $check = $this->User->checkPromovalidornot($userid,$pageid);
			$data['right'] = $this->User->getminsurvey($userid,$pageid);
			if($check)
			{
				$data['register'] = 'yes';
				delete_cookie('zingup_wellness_survey');
				
			}
			else{
				$data['register'] = 'no';
				//$this->session->unset_userdata('surveyuserid');
				//$this->session->unset_userdata('survey_data');
				//$this->session->unset_userdata('surveytempuser');
			}
		}
		else
		{
			if($this->session->userdata('surveytempuser') && !($this->session->userdata('surveyuserid')))
			{
				$tempid = $this->session->userdata('surveytempuser');
				$id = $this->User->page_id($tempid);
				$data['right'] = $this->User->gettempminsurvey($id); 
				$data['register'] = 'no';
				//$this->session->unset_userdata('surveyuserid');
				//$this->session->unset_userdata('survey_data');
				//$this->session->unset_userdata('surveytempuser');
			}
			else
			{
				$userid = $this->session->userdata('surveyuserid');
				$this->session->set_userdata('surveyuserid',$userid);
				$data['right'] = $this->User->getminsurvey($userid,$pageid);
				$check = $this->User->checkPromovalidornot($userid,$pageid);
				if($check)
				{
					$data['register'] = 'yes';
					delete_cookie('zingup_wellness_survey');
				}
				else{
					$data['register'] = 'no';
					//$this->session->unset_userdata('surveyuserid');
					//$this->session->unset_userdata('survey_data');
					//$this->session->unset_userdata('surveytempuser');
				}
			}
			}
			
			if(count($data['right']) == 0)
			{
				redirect('survey/healthprofile2');
			}
			else{
			$data['main_content'] = 'survey/healthprofile3';
			$this->load->view('survey/includes/new_template', $data); 
			}
	}
	
	public function healthprofile4()
	{
		if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		  $this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }
		
		 $this->session->userdata('surveyuserid');  
		 $data['pageid'] = $this->session->userdata('pagevisitorid');
			$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
		if ($data['logged_in_user_data']->is_logged_in == 1) {
			$userid = $data['logged_in_user_data']->user_id;
		}
		else{
			if($this->session->userdata('surveyuserid'))
			{
				$userid = $this->session->userdata('surveyuserid');
			}
			else{
				$userid= 0;
			}
		}
		$data['survey_det'] = $this->User->getAllUserSurveyReport($userid,$data['pageid']);
		//print_r($data['survey_det']);
		$data['maxscore'] = $this->User->getMaxs($userid);
		$data['services'] = $this->User->getservices();
		$data['sme'] = $this->User->getsme();
		//$this->session->unset_userdata('surveyuserid');
		//$this->session->unset_userdata('survey_data');
		//$this->session->unset_userdata('surveytempuser');
		delete_cookie('zingup_wellness_survey');
		$data['main_content'] = 'survey/healthprofile4';
		$this->load->view('survey/includes/new_template', $data); 
	}
	
	/**
	 * 
	 * Sends verification code in phone number to verify the phone number.
	 */
	
	public function get_access_code()
	{
		$data = $this->input->post();
		$phone = $data['phone'];
		
		$code = $phone[0] . $phone[strlen($phone) - 1] . date("d"); //first and last character of phone number + todays date is the code.
		
		$message_to = '+91' . $phone;
		$sms_content = "Verification code for ZingUpLife is: ".$code;
		
	    $this->Mailing->send_sms($message_to, $sms_content); 
		echo json_encode(true);
		
	}
	
	/**
	 * 
	 * Validate the access code entered by user.
	 */
	
	public function validate_access_code()
	{
		$data = $this->input->post();
		$phone = $data['phone'];
		
		$code = $phone[0] . $phone[strlen($phone) - 1] . date("d"); //first and last character of phone number + todays date is the code.
		
		$entered_code = $data['otp'];
		
		if ($entered_code ==  $code){
			return true;
		} else{
        
			return false;
		}
		
	}
/**
 * Sends email to user who are registered during the assessment.
 * We dont ask for the password so user should be sent reset passoword link, so when they come for 
 * the first time, they reset the password and then login.
 */	
   public function setup_password_email($user_details){
   	
   	 		$hashed = PasswordHash::create_hash($user_details->username);
                $hashed_data = explode(':', $hashed);
                $reset_password_token = str_replace('/', '', $hashed_data[2]);

                $reset_password_token_time = date('Y-m-d H:i:s');
                $data['reset_password_token_data'] = $reset_password_token_data = array(
                    'reset_password_token' => $reset_password_token,
                    'reset_password_time' => $reset_password_token_time
                );

                $this->db->where('username', $user_details->username);
                $this->db->update('users', $reset_password_token_data);
					
                $data['user_details'] = $user_details;
				
                $email_content = $this->load->view('emails/registration_success_assessment', $data, true);					   
                $to = $username;
                $from = "Zinguplife<info@zinguplife.com>";
                $subject = "Zingup account reset password request.";
                $message = $email_content;
				log_message('error', 'registration_success_assessment email sent to '.$user_details->username );
                $this->Mailing->send_mail($to, $from, $subject, $message);
   }
	
	public function update_access_code()
	{
		$data = $this->input->post();
		$access = $data['access'];
		$id = $this->session->userdata('pagevisitorid');
		$this->User->updatePromo2($id,'1');
		$this->session->set_userdata('promocode',$access);
		$check = $this->User->checkvalidpromoCode($access);
		if($check)
		{
			echo json_encode(true);
		}
		else{
			echo json_encode(false);
		}
		
	}
	
	public function update_access_code2()
	{
		$data = $this->input->post();
		$access = $data['access'];
		$id = $this->session->userdata('pagevisitorid');
		$this->User->updatePromo2($id,'1');
		$this->session->set_userdata('promocode',$access);
		$check = $this->User->checkvalidpromoCode($access);
		if($check)
		{
			echo json_encode($id);
		}
		else{
			echo json_encode(false);
		}
		
	}
	
	public function save_healthprofile2image()
	{
		$data = $this->input->post();
		$imgBase64 = $data['imgBase64'];
		//$encodedData = str_replace(' ','+',$imgBase64);

        //$decodedData = base64_decode($encodedData);
		$img = str_replace('data:image/png;base64,', '', $imgBase64);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$id = $this->session->userdata('pagevisitorid');
		
		if (!is_dir('./survey_images/healthprofile2/' . $id)) {
			mkdir('./survey_images/healthprofile2/' . $id, 0777, true); 
		}
		
		file_put_contents('./survey_images/healthprofile2/'. $id .'/healthprofile2.png', $data);

	
		echo json_encode(true);
	}
	
	public function save_healthprofile3image()
	{
		$data = $this->input->post();
		$imgBase64 = $data['imgBase64'];
		//$encodedData = str_replace(' ','+',$imgBase64);

        //$decodedData = base64_decode($encodedData);
		$img = str_replace('data:image/png;base64,', '', $imgBase64);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$id = $this->session->userdata('pagevisitorid');
		
		if (!is_dir('./survey_images/healthprofile3/' . $id)) {
			mkdir('./survey_images/healthprofile3/' . $id, 0777, true); 
		}
		
		file_put_contents('./survey_images/healthprofile3/'. $id .'/healthprofile3.png', $data);

	
		echo json_encode(true);
	}
	
	public function save_healthprofile4image()
	{
		$data = $this->input->post();
		$imgBase64 = $data['imgBase64'];
		//$encodedData = str_replace(' ','+',$imgBase64);

        //$decodedData = base64_decode($encodedData);
		$img = str_replace('data:image/png;base64,', '', $imgBase64);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$id = $this->session->userdata('pagevisitorid');
		
		if (!is_dir('./survey_images/healthprofile4/' . $id)) {
			mkdir('./survey_images/healthprofile4/' . $id, 0777, true); 
		}
		
		file_put_contents('./survey_images/healthprofile4/'. $id .'/healthprofile4.jpg', $data);

	
		echo json_encode(true);
	}
	
	public function save_healthprofile1image()
	{
		$data = $this->input->post();
		$imgBase64 = $data['imgBase64'];
		//$encodedData = str_replace(' ','+',$imgBase64);

        //$decodedData = base64_decode($encodedData);
		$img = str_replace('data:image/png;base64,', '', $imgBase64);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$id = $this->session->userdata('pagevisitorid');
		
		if (!is_dir('./survey_images/healthprofile1/' . $id)) {
			mkdir('./survey_images/healthprofile1/' . $id, 0777, true); 
		}
		
		file_put_contents('./survey_images/healthprofile1/'. $id .'/healthprofile1.png', $data);

	
		echo json_encode(true);
	}
	
	

}
 
