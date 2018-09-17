<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for users registration, login and users actions/activities
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:04-08-2015
 * */
class Users extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('PasswordHash');
        $this->load->model('Business_offering');
        $this->load->model('User');
        $this->load->model('Business');
        $this->load->model('Bookings');
        $this->load->model('Expert');
        $this->load->model('sme_user');
        $this->load->model('Mailing');
        $this->load->model('Utilitiesmodel');
        
	}

    /*
     *  Displaying user registration form 
     */

    public function register() {
		
        $this->User_activity->insert_user_activity();
        $data['title'] = "ZingUpLife | Register";
        $data['main_content'] = 'register';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */


    /*
     *  validating user's data and creating new user 
     */

    public function do_registration() {
		if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		  $this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();

        $this->load->model('User');


        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('username', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');


        if ($this->form_validation->run() == FALSE) {
            if ($post_data['check_signup'] == 'check_signup') {
                $data['post_data'] = $post_data;
                $data['main_content'] = 'register';
                $this->load->view('includes/template', $data);
            } else {
                $booking_time = $this->session->userdata('booking_time');
                $booking_timings = explode('/', $booking_time);
                $choosed_booking_time = $booking_timings[0];
                $choosed_booking_timings = $booking_timings[1];
                $choosed_booking_date = $this->session->userdata('choosed_booking_date');
                $business_provider_id = $this->session->userdata('business_provider_id');
                $business_service_id = $this->session->userdata('business_service_id');
                $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
                $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
                $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
                $data['choosed_booking_date'] = $choosed_booking_date;
                $data['choosed_booking_time'] = $choosed_booking_time;
                $data['choosed_booking_timings'] = $choosed_booking_timings;
                $data['post_data'] = $post_data;
                $data['main_content'] = 'signup';
                $this->load->view('includes/template', $data);
            }
        } else {

            $hashed = PasswordHash::create_hash($post_data['password']);

            $check_user_exists = $this->User->check_username_availability($post_data['username']);


            if (!empty($check_user_exists)) {

                $booking_time = $this->session->userdata('booking_time');
                $booking_timings = explode('/', $booking_time);
                $choosed_booking_time = $booking_timings[0];
                $choosed_booking_timings = $booking_timings[1];
                $choosed_booking_date = $this->session->userdata('choosed_booking_date');
                $business_provider_id = $this->session->userdata('business_provider_id');
                $business_service_id = $this->session->userdata('business_service_id');
                $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
                $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
                $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
                $data['choosed_booking_date'] = $choosed_booking_date;
                $data['choosed_booking_time'] = $choosed_booking_time;
                $data['choosed_booking_timings'] = $choosed_booking_timings;
                $data['error_message'] = 'username already exists';
                $data['post_data'] = $post_data;
                if ($post_data['check_signup'] == 'check_signup') {
                    $data['main_content'] = 'register';
                } else {
                    $data['main_content'] = 'signup';
                }
                $this->load->view('includes/template', $data);
            } else {

                $this->User->create_user($post_data, $hashed);
                $validate_user = $this->User->validate_user($post_data['username'], $post_data['password']);

                if ($validate_user['validation_status']['status'] == 'Success') {
                    $validate_user['user_details']->is_logged_in = '1';
                    $this->session->set_userdata("logged_in_user_data", $validate_user['user_details']);

                    $registration_email_content = $this->load->view('emails/registration_success', $validate_user, true);

                    $to = $validate_user['user_details']->username;
                    $from = "Zinguplife<info@zinguplife.com>";
                    $registration_mail_subject = "You have sucessfully registered with Zingup !!!";
                    $registration_message = $registration_email_content;

                    $this->Mailing->send_mail($to, $from, $registration_mail_subject, $registration_message);

                    $messgae_to = '+91' . $validate_user['user_details']->phone;
                    //$messgae_to = '+919902956083';
                    $sms_content = 'Congratulations! You have successfully registered with Zingup';

                    $this->Mailing->send_sms($messgae_to, $sms_content);
                    $membership_plan_id = $this->session->userdata('membership_plan_id');
                    if ($post_data['check_signup'] == 'check_signup') {
                        redirect("/register_success");
                    } else {
                        if ($membership_plan_id) {
                            redirect("/review_membership_details");
                        } else {
                            redirect("/review_booking_details");
                        }
                    }
                } else {
                    if ($post_data['check_signup'] == 'check_signup') {
                        redirect("/register");
                    } else {
                        redirect("/signup");
                    }
                }
            }
        }
    }

    /* Above function ends here */

    /*
     *  Function for activate user account 
     */

    public function activate_account() {
        $this->User_activity->insert_user_activity();
        $this->load->view('activate_account');

        $activation_code = $this->uri->segment(2);
        $this->load->model('User');
        $validate_user = $this->User->validate_user_account($activation_code);
        $is_mobile = '0';
        if ($validate_user == 1) {
            $this->session->set_flashdata('account_activation_success_message', 'Your account sucessfully activated. Please login to continue !!!.');
            if ($is_mobile == '1') {
                $account_activation_success_message = $this->session->flashdata('account_activation_success_message');
                echo json_encode($account_activation_success_message);
            } else {
                redirect("/login");
            }
        } else {
            $this->session->set_flashdata('account_activation_error_message', 'Oops, You are not authorized to activate this account !!!.');
            if ($is_mobile == '1') {
                $account_activation_error_message = $this->session->flashdata('account_activation_error_message');
                echo json_encode($account_activation_error_message);
            }
        }
    }

    /* Above function ends here */

    /*
     *  Displaying forgot password form 
     */

    public function forgot_password() {
        $this->User_activity->insert_user_activity();
        $data['main_content'] = 'forgot_password';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */


    /*
     *  Displaying enter otp form 
     */

    public function enter_otp() {
        $this->User_activity->insert_user_activity();
        $data['main_content'] = 'enter_otp';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */


    /*
     *  Validating user's credentials and sending reset password token to user 
     */

    public function reset_password_request() {
        $this->User_activity->insert_user_activity();
        $username = $this->input->post('username');
        $submit = $this->input->post('send');
        $this->load->model('User');
        $forgot_password_request = $this->User->forgot_password_request($username, $submit);
        if ($forgot_password_request == 'Failed') {
            $this->session->set_flashdata('email_validation_error_message', 'Email you entered is not registered with Zinguplife. Please try again.');
            redirect('/forgot_password');
        } else {
            if ($this->input->post('send') == 'Send OTP to Mobile Number') {
                $this->session->set_flashdata('otp_validation_success_message', 'One time password is succesfully sent to your registered mobile number. ');

                redirect('/enter_otp');
            } else {
                //$this->session->set_flashdata('email_validation_success_message', 'Reset password link has been successfully sent to your registered email. !!!.');
                $data['email_message_heading'] = 'Check Your Email';
                $email = explode('@', $username);
                $email_part1 = $email[0];
                $email_part1_length = strlen($email_part1);
                $email_first = substr($email_part1, 0, 1);
                $email_part2 = $email_first . str_repeat("*", ($email_part1_length - 1)) . '@' . $email[1];
                $data['email_message_heading'] = 'Check Your Email';
                $data['email_message'] = 'Reset password link is sent to your email ID ' . $email_part2 . '';
                $data['main_content'] = 'reset_pasword_check';
                $this->load->view('includes/template', $data);
            }
        }
    }

    /* Above function ends here */

    /*
     *  Validating  reset password otp token to user 
     */

    public function enter_otp_check() {
        $this->User_activity->insert_user_activity();
        $otp = $this->input->post('otp');
        $this->load->model('User');
        $otp_check = $this->User->reset_password_otp_check($otp);
        if ($otp_check == 'Failed') {
            $this->session->set_flashdata('otp_validation_error_message', ' Your one time password is expired or incorrect,' . anchor('forgot_password', 'please try again', 'class="blue link-small"'));

            redirect('/enter_otp');
        } else {
            $this->session->set_flashdata('username', $otp_check->username);
            $this->session->set_flashdata('reset_password_token', $otp_check->reset_password_token);
            $this->session->set_flashdata('reset_password_otp_token', $otp_check->otp_token);
            redirect('/reset_password');
        }
    }

    /* Above function ends here */

    /*
     *  Function for validating reset password token 
     */

    public function reset_password() {
        $this->User_activity->insert_user_activity();
        $password_token = $this->uri->segment(2);
        $this->load->model('User');
        $validate_password_token = $this->User->validate_password_token($password_token);
        $data['reset_password_token'] = $password_token;
        if ($validate_password_token == 'Failed') {
            $this->session->set_flashdata('password_token_error_message', 'Your reset password token is expired or incorrect,' . anchor('forgot_password', 'please try again', 'class="blue link-small"'));

            $this->session->set_flashdata('username', '');
        } else {
            $this->session->set_flashdata('reset_password_token', $password_token);
            $this->session->set_flashdata('username', $validate_password_token->username);
        }
        $data['main_content'] = 'reset_password';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     *  Function for validating reset password token 
     */

    public function reset_password_otp() {
        $this->User_activity->insert_user_activity();

        $data['main_content'] = 'reset_password';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     *  validating user's data and storing new password for user 
     */

    public function store_new_password() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        $this->load->model('User');

        $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('validation_error', 'Password and  confirm password not matching.');
            $this->session->set_flashdata('username', $post_data['username']);
            $this->session->set_flashdata('reset_password_token', $post_data['reset_password_token']);
            if ($post_data['reset_password_otp_token'] != '') {
                redirect('/reset_password');
            } else {
                redirect('reset_password/' . $post_data['reset_password_token']);
            }
        } else {
            $password = PasswordHash::create_hash($post_data['password']);
            $update_new_password = $this->User->update_new_password($post_data['username'], $password);

            if ($update_new_password == 1) {
                $data['main_content'] = 'reset_password_success';
                $this->load->view('includes/template', $data);
            } else {

                $this->session->set_flashdata('validation_error', 'please try again.');
                $this->session->set_flashdata('username', $post_data['username']);
                $this->session->set_flashdata('reset_password_token', $post_data['reset_password_token']);
                if ($post_data['reset_password_otp_token'] != '') {
                    redirect('/reset_password');
                } else {
                    redirect('reset_password/' . $post_data['reset_password_token']);
                }
            }
        }
    }

    /* Above function ends here */


    /*
     *  Displaying login form 
     */

    public function login() {
        $this->load->library('user_agent');
        $data['referrer'] = $this->agent->referrer();

        $this->User_activity->insert_user_activity();
        $data['title'] = "ZingUpLife | Login";
        $data['active_url'] = "login";
        $data['main_content'] = 'login';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */

    /*
     *  Validating user's credentials and processing login 
     */
        
    public function do_login() { 
        if($this->session->userdata('country')){
        }else{
            $this->session->set_userdata('country','india');
            $this->session->set_userdata('place','bangalore'); 
        }
        $theme_id = $this->input->cookie('theme_id');
	$test_id = $this->input->cookie('level_id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $referrer = $this->input->post('referrer');
        $post_data = $this->input->post();
        $user_validation_details = array();
        $this->session->set_userdata("referrer", $referrer);
        if ($post_data['submit'] == 'Login') {
            if ($username != '' && $password != '') {
                
                $expert_login = $this->Expert->expertsignin($username, $password);
                if($expert_login ==0){
               
                $validate_user = $this->User->validate_user($username, $password);
                /*
                 * set gener of the user in session. This will be used for assessment modules to fetch the relevent questions
                 */
                
                  $this->session->set_userdata('user_gender',$validate_user['user_details']->gender);

                if ($validate_user['validation_status']['status'] == 'Success') {
				
                    $validate_user['user_details']->is_logged_in = '1';
                    $this->session->set_userdata("logged_in_user_data", $validate_user['user_details']);
					$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
					$userid = $data['logged_in_user_data']->user_id;
                    $business_provider_id = $this->session->userdata('business_provider_id');
                    //print_r($validate_user['user_details']);die();
                    if ($validate_user['user_details']->first_logged_in == 'n') {

                        $uid = $validate_user['user_details']->user_id;
                        $array = array('first_logged_in' => 'y');
                        $this->User->update_first_logged($array, $uid);
                    }
                    $new_referrer = 'checkout';
                    if ($business_provider_id != '') {
                        $this->session->set_userdata("referrer", $new_referrer);
                    } else {
                        $this->session->set_userdata("referrer", $referrer);
                    }

                    if($this->session->userdata('survey'))
					{
						$temp_id = $this->session->userdata('surveytempuser');
						$page_visitor_id = $this->User->get_add_page_visitor($temp_id);
						$this->User->update_survey_userid($page_visitor_id,$userid,$bmi);
					}
					$checkuserattempted = $this->User->checkUserAttemptedhome($userid); 
					if($checkuserattempted !='new' && $checkuserattempted)
					{

						$this->session->set_userdata('surveyuserid',$userid);
						$p = $this->User->get_logged_page($userid);
						$this->session->set_userdata('pagevisitorid',$p);
						$checkpromo = $this->User->checkpromothere($p);
						if($checkpromo)
						{
							$this->session->set_userdata('promocode','1');
						}
						$this->session->set_userdata('assessment','on');
						$data['surveys'] = $this->User->getSurveyfromques($checkuserattempted);
						$data['main_content'] = 'survey/assesment2';
						$this->load->view('survey/includes/new_template', $data); 
					}
					else{
						if($this->session->userdata('from') =='chat')
						{
							$this->load->model('Expert');
							
							$smeid = $this->session->userdata('smeid');
							
							$c = $this->Expert->checkprevDues($smeid,$userid);
							 $de = $this->Expert->getlivesessionde($smeid,$userid);
							 if($c)
							 {
								 $url = $this->config->base_url() . 'experts/user/' . $smeid;
								  $this->session->set_userdata('chat_userid',$userid); 
								 $this->session->set_userdata('referrer',$url);
								 $this->session->set_userdata('direct','yes');
								 //echo json_encode('cleared');
							 }
							 else
							 {
								 $url = $this->config->base_url() . 'experts/new_payment_checkout/';
								 $this->session->set_userdata('referrer',$url);
								 $this->session->set_userdata('chat_userid',$userid); 
								 $this->session->set_userdata('smebookcallid',$de->smebookcallid); 
								 $this->session->set_userdata('book_type',$de->book_type);  
								 $this->session->set_userdata('sme_userid',$smeid);
								 $this->session->set_userdata('paypackage_amt',$de->amount);
								 $this->session->set_userdata('order_id',$de->order_id);
								// echo json_encode('dues');
							 }
						}
                                                else if($theme_id && $test_id){
						    $this->User->UpdateAssessmentUserId($username);
						    $this->load->model('Apiassessment_model');
						    $this->Apiassessment_model->storeAssessmentResults($userid, $theme_id, $test_id);
						    redirect(base_url().'assessment/report/'.$theme_id.'/'.$test_id);
						}
						redirect("/signin_success");
					}
                
                } else {
                    $user_validation_details['validation_status']['status'] = 'Username or password is invalid';
                    $validate_user['validation_status']['username'] = $username;
                    $validate_user['validation_status']['common_error'] = 'common_error';
                    $this->session->set_flashdata('login_error_message', $validate_user['validation_status']);

                    redirect("/login");
                }
                }else{
                    $user_validation_details['validation_status']['username_error_type'] = 'We could not validate youe credentials';
                }
            } else {
                if ($username == '') {
                    $user_validation_details['validation_status']['username_status'] = 'This field is required';
                    $user_validation_details['validation_status']['username_error_type'] = 'username';
                }
                if ($password == '') {
                    $user_validation_details['validation_status']['password_status'] = 'This field is required';
                    $user_validation_details['validation_status']['password_error_type'] = 'password';
                }
                $this->session->set_flashdata('login_error_message', $user_validation_details['validation_status']);

                redirect("/login");
            }
        } else {
           redirect("/login");
        }
    }

    /* Above function ends here */



    /*
     *  Function for signin redirect page
     */

    public function signin_success() {
        $this->User_activity->insert_user_activity();

        $data['referrer'] = $this->session->userdata('referrer');
//        $data['main_content'] = 'signin-redirect';
//        $this->load->view('includes/template', $data);
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $data['title'] = "Sign In Redirect";
        $data['active_url'] = "";
        $data['main_content'] = 'signin-redirect';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */


    /*
     *  Function for login with facebook 
     */

    public function facebook_login() {
        $this->User_activity->insert_user_activity();

        $this->load->library('facebook');
        $user = null;
        $user_profile = null;

// See if there is a user from a cookie
        $user = $this->facebook->getUser();

        if ($user) {
            try {
// Proceed knowing you have a logged in user who's authenticated.
                $user_profile = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                show_error(print_r($e, TRUE), 500);
            }
        }
        $this->data['facebook'] = $this->facebook;
        $this->data['user'] = $user;
        $this->data['user_profile'] = $user_profile;
        echo "<pre>";
        print_r($user_profile);
        print_r($user);
        exit();
        if ($user_profile['email'] == "") {
            $this->session->set_flashdata('login_error_message', 'Looks like your Facebook account is not verified. You cannot use your Facebook login here !!!.');
            redirect("/login");
        }

        $this->load->model('User');
        $check_user_exists = $this->User->get_user_details_by_username($user_profile['email']);

        if (count($check_user_exists) == 0) {
            $facebook_user = $this->User->create_user_by_facebook_details($user_profile);
            $user_details = $this->User->get_user_details_by_username($user_profile['email']);
            if ($facebook_user == 1) {
// send registartion mail
                $user_details->is_logged_in = '1';
                $this->session->set_userdata("logged_in_user_data", $user_details);
                //$this->session->set_flashdata('login_success_message', 'You are successfully logged in !!!.');
                redirect("/dashboard");
            } else {
                $this->session->set_flashdata('login_error_message', 'Looks like your Facebook account is not verified. You cannot use your Facebook login here !!!.');
                redirect("/login");
            }
        } else {
            $check_user_exists->is_logged_in = '1';
            $this->session->set_userdata("logged_in_user_data", $check_user_exists);
            //$this->session->set_flashdata('login_success_message', 'You are successfully logged in !!!.');
            redirect("/dashboard");
        }
    }

    /* Above function ends here */

    /*
     * Function for login with google 
     */

    public function google_login() {
        $this->User_activity->insert_user_activity();
        $this->load->library('Http_class');
        $this->load->library('oauth_client_class');
        $this->config->load('google');
        $client = new oauth_client_class;
        $client->server = 'Google';

        // set the offline access only if you need to call an API
        // when the user is not present and the token may expire
        $client->offline = true;

        $client->debug = false;
        $client->debug_http = true;
        $client->redirect_uri = $this->config->item('redirectUrl');
        $client->client_id = $this->config->item('clientId');
        $application_line = __LINE__;
        $client->client_secret = $this->config->item('clientSecret');

        if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
            die('Please go to Google APIs console page ' .
                    'http://code.google.com/apis/console in the API access tab, ' .
                    'create a new client ID, and in the line ' . $application_line .
                    ' set the client_id to Client ID and client_secret with Client Secret. ' .
                    'The callback URL must be ' . $client->redirect_uri . ' but make sure ' .
                    'the domain is valid and can be resolved by a public DNS.');

        /* API permissions
         */
        $client->scope = 'https://www.googleapis.com/auth/userinfo.email ' .
                'https://www.googleapis.com/auth/userinfo.profile';

        if (($success = $client->Initialize())) {
            if (($success = $client->Process())) {
                if (strlen($client->authorization_error)) {
                    $client->error = $client->authorization_error;
                    $success = false;
                } elseif (strlen($client->access_token)) {
                    $success = $client->CallAPI(
                            'https://www.googleapis.com/oauth2/v1/userinfo', 'GET', array(), array('FailOnAccessError' => true), $user);
                }
            }
            $success = $client->Finalize($success);
            $auth_url = "login";
            if (isset($user)) {
                $auth_url = "";
                if ($user->email == "") {
                    $page = 'login';
                }
                $this->load->model('User');
                $check_user_exists = $this->User->get_user_details_by_username($user->email);

                if (count($check_user_exists) == 0) {
                    $gmail_user = $this->User->create_user_by_google_details($user);
                    $user_details = $this->User->get_user_details_by_username($user->email);
                    if ($gmail_user == 1) {
                        $user_details->is_logged_in = '1';
                        // send registartion mail
                        $this->session->set_userdata("logged_in_user_data", $user_details);
                        $page = 'dashboard';
                    } else {
                        $page = 'login';
                    }
                } else {
                    $check_user_exists->is_logged_in = '1';
                    $this->session->set_userdata("logged_in_user_data", $check_user_exists);
                    $page = 'dashboard';
                }
                $data['parent_url'] = $page;
                $data['authUrl'] = $auth_url;
                $this->load->view('google', $data);
            } else {

                $data['authUrl'] = $auth_url;
                $this->load->view('google', $data);
            }
        }
    }

    /* Above function ends here */


    /*
     *  Function for logout
     */

    public function logout() {
        $this->load->helper('cookie');
        $this->User_activity->insert_user_activity();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        $this->load->model('User');
        $this->User->logout($logged_in_user_data);
        $this->session->unset_userdata('logged_in_user_data');
        $this->session->unset_userdata('logged_in_vendor_data');
        delete_cookie('theme_id');
        delete_cookie('level_id');
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

    /* Above function ends here */

    /*
     *  Displaying user dashboard page
     */

    public function dashboard() {
        $this->User_activity->insert_user_activity();
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');

      
        if ($data['logged_in_user_data']->is_logged_in == 1) {
            $is_mobile = '0';
            if ($is_mobile == '1') {
                echo json_encode($data);
            } else {
                $this->load->view('user_dashboard', $data);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying my profile page
     */

    public function my_profile() {

        $this->User_activity->insert_user_activity();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        $data['logged_in_user_data'] = $logged_in_user_data;
        if ($logged_in_user_data->is_logged_in == 1) {
            //redirect('/survey');
            $this->load->model('Bookings');
            $memberships = $this->Bookings->get_user_memberships($logged_in_user_data->user_id);
            $data['memberships'] = $memberships;
            $path = base_url() . $this->config->item('user_profile_image_path');
            $data['path'] = $path;
            $data['title'] = "ZingUpLife | My Profile";
            $data['main_content'] = 'my_profile';
            $this->load->view('includes/menu_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying edit user profile page
     */

    public function edit_profile() {
        $this->User_activity->insert_user_activity();
        $user_data = $this->session->userdata('logged_in_user_data');
        if ($user_data->is_logged_in == 1) {
            $this->load->model('Services');
            $this->load->model('User');
            $all_services = $this->Services->get_services_list();
            $services = array();
            $services[''] = 'Please Select';
            foreach ($all_services as $key => $value) {
                $services[$value->id] = $value->service_name;
            }
            $data['services'] = $services;

            $data['logged_in_user_data'] = $this->User->get_user_details_by_username($user_data->username);
            $is_mobile = '0';
            if ($is_mobile == '1') {
                echo json_encode($data);
            } else {
                $data['main_content'] = 'edit_profile';
                $this->load->view('includes/template', $data);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */

    /*
     *  validating user's data and updating user's profile 
     */

    public function update_profile() {
        $this->User_activity->insert_user_activity();
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        if ($data['logged_in_user_data']->is_logged_in == 1) {
            $post_data = $this->input->post();

            $this->load->model('User');
            $this->load->model('Services');

            $all_services = $this->Services->get_services_list();
            $services = array();
            $services[0] = 'Please Select';
            foreach ($all_services as $key => $value) {
                $services[$value->id] = $value->service_name;
            }
            $data['services'] = $services;

            if (isset($post_data['name']) && $post_data['name'] == '') {
                $data['name_validation_error'] = 'This field is Required';
                echo json_encode($data);
            } elseif (isset($post_data['gender']) && $post_data['gender'] == '') {
                $data['gender_validation_error'] = 'This field is Required';
                echo json_encode($data);
            } elseif (isset($post_data['age']) && $post_data['age'] == '') {
                $data['age_validation_error'] = 'This field is Required';
                echo json_encode($data);
            } elseif (isset($post_data['phone']) && $post_data['phone'] == '') {
                $data['phone_validation_error'] = 'This field is Required';
                echo json_encode($data);
            } elseif (isset($post_data['phone']) && strlen($post_data['phone']) < 10) {
                $data['phone_length_validation_error'] = 'Length shoube be more than 10';
                echo json_encode($data);
            } else {
                $data['name_validation_error'] = '';
                $data['gender_validation_error'] = '';
                $data['age_validation_error'] = '';
                $data['phone_validation_error'] = '';
                $data['phone_length_validation_error'] = '';
                $data['update_user'] = $this->User->update_user_profile($post_data);
                $logged_in_user_data = $this->session->userdata('logged_in_user_data');
                $username = $logged_in_user_data->username;
                $user_details = $this->User->get_user_details_by_username($username);
                $user_details->is_logged_in = 1;
                $this->session->set_userdata("logged_in_user_data", $user_details);
                echo json_encode($data);
            }
        }
    }

    /* Above function ends here */


    /*
     * Function to get booking slots for selected service and choosed date
     */

    public function signup() {
        $this->User_activity->insert_user_activity();
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');

        $post_data = $_POST;

        if (!empty($post_data)) {
            if ($post_data['submit'] == 'Continue') {
                $booking_time = $_POST['booking_time'];
                $booking_timings = explode('/', $booking_time);
                $choosed_booking_time = $booking_timings[0];
                $choosed_booking_timings = $booking_timings[1];
                $this->session->set_userdata('booking_time', $booking_time);
                $selected_slot = $post_data['booking_time'];
                $slot_id = $selected_slot[0];
                $slot_status_change = $this->Bookings->slot_status_change($slot_id);
                if (isset($logged_in_user_details)) {
                    if ($logged_in_user_details->is_logged_in == '1') {
                        redirect('/review_booking_details');
                    }
                }
            } else {
                redirect('/chooseBookingDate');
            }
        }

        $current_time = date('H:i:s');
        $booking_duration = $this->session->userdata('booking_duration');
        $booking_time_duration_length = $this->Bookings->time_difference($booking_duration, $current_time);


        $data['logged_in_user_details'] = $logged_in_user_details;
        $choosed_booking_date = $this->session->userdata('choosed_booking_date');
        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['choosed_booking_date'] = $choosed_booking_date;
        $data['choosed_booking_time'] = $choosed_booking_time;
        $data['choosed_booking_timings'] = $choosed_booking_timings;
        $data['booking_time_duration_length'] = $booking_time_duration_length;
        $data['main_content'] = 'signup';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */


    /*
     * Function to get bookimg slots for selected service and choosed date
     */

    public function signin() {
        $this->User_activity->insert_user_activity();
        $booking_time = $this->session->userdata('booking_time');
        $booking_timings = explode('/', $booking_time);
        $choosed_booking_time = $booking_timings[0];
        $choosed_booking_timings = $booking_timings[1];
        $this->session->set_userdata('booking_time', $booking_time);

        $current_time = date('H:i:s');
        $booking_duration = $this->session->userdata('booking_duration');
        $booking_time_duration_length = $this->Bookings->time_difference($booking_duration, $current_time);

        $data['logged_in_user_details'] = $this->session->userdata('logged_in_user_data');
        $choosed_booking_date = $this->session->userdata('choosed_booking_date');
        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['choosed_booking_date'] = $choosed_booking_date;
        $data['choosed_booking_time'] = $choosed_booking_time;
        $data['choosed_booking_timings'] = $choosed_booking_timings;
        $data['booking_time_duration_length'] = $booking_time_duration_length;
        $data['main_content'] = 'signin';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     *  Validating user's credentials and processing login 
     */

    public function sign_in() {
        $this->User_activity->insert_user_activity();
        $username = $this->input->post('email');
        $password = $this->input->post('password');
        $user_validation_details = array();
        $this->load->model('User');
        $membership_plan_id = $this->session->userdata('membership_plan_id');

        if ($username != '' && $password != '') {
            $validate_user = $this->User->validate_user($username, $password);
            if ($validate_user['validation_status']['status'] == 'Success') {
                $validate_user['user_details']->is_logged_in = '1';
                $this->session->set_userdata("logged_in_user_data", $validate_user['user_details']);
                if ($membership_plan_id) {
                    redirect("/review_membership_details");
                } else {
                    redirect("/review_booking_details");
                }
            } else {
//                $validate_user['validation_status']['username'] = $username;
//                $validate_user['validation_status']['password'] = $password;
//                $this->session->set_flashdata('login_error_message', $validate_user['validation_status']);

                $user_validation_details['validation_status']['status'] = 'Username or password is invalid';
                $validate_user['validation_status']['username'] = $username;
                $validate_user['validation_status']['common_error'] = 'common_error';
                $this->session->set_flashdata('login_error_message', $validate_user['validation_status']);
                redirect("/signin");
            }
        } else {
            if ($username == '') {
                $user_validation_details['validation_status']['status'] = 'This field is required';
                $user_validation_details['validation_status']['error_type'] = 'username';
            }
            if ($password == '') {
                $user_validation_details['validation_status']['status'] = 'This field is required';
                $user_validation_details['validation_status']['error_type'] = 'password';
            }
            $this->session->set_flashdata('login_error_message', $user_validation_details['validation_status']);

            redirect("/signin");
        }
    }

    /* Above function ends here */


    /*
     *  Displaying user registration form 
     */

    public function notifications() {
        $this->User_activity->insert_user_activity();
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $this->load->model('Notifications');
        $notifications = $this->Notifications->get_user_notifications($logged_in_user_details->user_id);
        $data['notifications'] = $notifications;
        $data['main_content'] = 'notifications';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     *  function for changing slot status 
     */

    public function change_slot_status() {
        $slot_id = $this->input->post(slot_id);
        $this->load->model('User');
        $slot_status = $this->User->change_slot_status($slot_id);
        $this->session->unset_userdata('choosed_booking_date');
        $this->session->unset_userdata('booking_time');
    }

    /* Above function ends here */


    /*
     *  reset password
     */

    public function admin_reset_password() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $data['logged_in_user_details'] = $logged_in_user_details;
        $data['url'] = 'reset password';
        $data['title'] = 'Zingup admin | Reset password';
        $data['main_content'] = 'admin/admin_reset_password';
        $this->load->view('admin/includes/template', $data);
    }

    /* Above function ends here */




    /*
     *  reset password
     */

    public function admin_new_password() {
        $post_data = $this->input->post();
        $username = $post_data['username'];

        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if (!empty($logged_in_user_details)) {
            $validate_password = PasswordHash::validate_password($post_data['old_password'], $logged_in_user_details->password);
            if ($validate_password == 1 || $validate_password == true) {
                $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
                $this->form_validation->set_message('required', 'This field is required');
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('validation_error', 'Password and  confirm password not matching.');
                    $this->session->set_flashdata('username', $post_data['username']);
                    redirect('admin/reset_password/');
                } else {
                    $password = PasswordHash::create_hash($post_data['password']);
                    $update_new_password = $this->Admin_users->reset_new_password($post_data['username'], $password);

                    if ($update_new_password == 1) {
                        $data['main_content'] = 'admin/reset_password_success';
                        $this->load->view('includes/template', $data);
                    } else {

                        $this->session->set_flashdata('validation_error', 'please try again.');
                        $this->session->set_flashdata('username', $post_data['username']);
                        $this->session->set_flashdata('reset_password_token', $post_data['reset_password_token']);

                        redirect('reset_password/' . $post_data['reset_password_token']);
                    }
                }
            } else {
                $this->session->set_flashdata('validation_error', 'Your old password is not matching.');
                $this->session->set_flashdata('username', $post_data['username']);

                redirect('admin/reset_password');
            }
        } else {
            redirect("/admin");
        }
    }

    /* Above function ends here */
    /*
     * Function to get booking slots for selected service and choosed date
     */

//    public function membership_signup() {
//        $this->User_activity->insert_user_activity();
//        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
//
//        $post_data = $_POST;
//        $choosed_booking_date = $post_data['booking_date'];
//        $this->session->set_userdata("choosed_booking_date", $choosed_booking_date);
//
//        $current_time = date('H:i:s');
//        $booking_duration = $this->session->userdata('booking_duration');
//        $booking_time_duration_length = $this->Bookings->time_difference($booking_duration, $current_time);
//        if (!empty($post_data)) {
//            if (isset($logged_in_user_details)) {
//                if ($logged_in_user_details->is_logged_in == '1') {
//                    redirect('/review_membership_details');
//                }
//            }
//        } else {
//            redirect('/chooseMembershipBookingDate');
//        }
//
//
//        $data['logged_in_user_details'] = $logged_in_user_details;
//
//        $business_provider_id = $this->session->userdata('business_provider_id');
//        $business_service_id = $this->session->userdata('business_service_id');
//        $membership_plan_id = $this->session->userdata('membership_plan_id');
//        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
//        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
//        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
//        $data['choosed_booking_date'] = $choosed_booking_date;
//        $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
//        $data['booking_time_duration_length'] = $booking_time_duration_length;
//        $data['main_content'] = 'membership_signup';
//        $this->load->view('includes/template', $data);
//    }

    /* Above function ends here */




    /*
     * Function to get booking slots for selected service and choosed date
     */

    public function user_signup() {
		$data = $this->input->post();
		$this->session->set_userdata('business_service_id',$data['offering_id']);
		
        $this->User_activity->insert_user_activity();
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');

        $data['logged_in_user_details'] = $logged_in_user_details;
        $post_data = $_POST;
        if (!empty($post_data)) {
            $membership_plan_id = $post_data['membership_plan_id'];
            $this->session->set_userdata("membership_plan_id", $post_data['membership_plan_id']);
        }
        $membership_plan_id = $this->session->userdata('membership_plan_id');

        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');

        if ($logged_in_user_details->is_logged_in == 1) {
            redirect("/checkout");
        } else {
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
            $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
            $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
            $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
            $data['title'] = "ZingUpLife | Sign Up";
            $data['main_content'] = 'membership_signup';
            $this->load->view('includes/menu_template', $data);
        }
    }

    /* Above function ends here */




    /*
     *  validating user's data and creating new user 
     */

    public function user_registration() {
		if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		$this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        $bmidata = explode(' ',$post_data['asse_bmi']);
        $post_data['bmi'] = $bmidata[1];

//        echo "<pre>";
//        print_r($post_data);
//        exit();


        $this->load->model('User');


        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('username', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
        $this->form_validation->set_rules('check', 'Terms and conditions', 'required');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<label generated="true" class="error">', '</label>');


        if ($this->form_validation->run() == FALSE) {
            if ($post_data['register_type'] == 'booking_signup') {
                $membership_plan_id = $this->session->userdata('membership_plan_id');

                $business_provider_id = $this->session->userdata('business_provider_id');
                $business_service_id = $this->session->userdata('business_service_id');

                $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
                $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
                $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
                $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
                $data['validation_message'] = 'validation_error';
                $data['main_content'] = 'membership_signup';
                $this->load->view('includes/menu_template', $data);
            } else {
                $data['validation_message'] = 'validation_error';
                $data['main_content'] = 'register';
                $this->load->view('includes/menu_template', $data);
            }
        } else {

            $hashed = PasswordHash::create_hash($post_data['password']);

            $check_user_exists = $this->User->check_username_availability($post_data['username']);


            if (!empty($check_user_exists)) {
                if ($post_data['register_type'] == 'booking_signup') {
                    $membership_plan_id = $this->session->userdata('membership_plan_id');

                    $business_provider_id = $this->session->userdata('business_provider_id');
                    $business_service_id = $this->session->userdata('business_service_id');

                    $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
                    $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
                    $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
                    $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
                    $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
                    $data['validation_message'] = 'user_exist';
                    $data['main_content'] = 'membership_signup';
                    $this->load->view('includes/menu_template', $data);
                } else {
                    $data['validation_message'] = 'user_exist';
                    $data['main_content'] = 'register';
                    $this->load->view('includes/menu_template', $data);
                }
            } else {

                $this->User->create_user($post_data, $hashed);
                $validate_user = $this->User->validate_user($post_data['username'], $post_data['password']);

                if ($validate_user['validation_status']['status'] == 'Success') {
                    $validate_user['user_details']->is_logged_in = '1';
                    $this->session->set_userdata("logged_in_user_data", $validate_user['user_details']);

                    $registration_email_content = $this->load->view('emails/registration_success', $validate_user, true);

                    $to = $validate_user['user_details']->username;
                    $from = "Zinguplife<info@zinguplife.com>";
                    $registration_mail_subject = "You have sucessfully registered with Zinguplife !!!";
                    $registration_message = $registration_email_content;

                    $this->Mailing->send_mail($to, $from, $registration_mail_subject, $registration_message);

                    $messgae_to = '+91' . $validate_user['user_details']->phone;
                    //$messgae_to = '+919902956083';
                    $sms_content = 'Congratulations! You have successfully registered with Zinguplife';

                    $this->Mailing->send_sms($messgae_to, $sms_content);
                    if ($post_data['register_type'] == 'booking_signup') {
                        redirect("/checkout");
                    } else {
                        redirect("/register_success");
                    }
                } else {
                    redirect("/register");
                }
            }
        }
    }

    /* Above function ends here */












    /*
     * Function to get bookimg slots for selected service and choosed date
     */

    public function membership_signin() {
        $this->User_activity->insert_user_activity();

        $current_time = date('H:i:s');
        $booking_duration = $this->session->userdata('booking_duration');
        $booking_time_duration_length = $this->Bookings->time_difference($booking_duration, $current_time);

        $data['logged_in_user_details'] = $this->session->userdata('logged_in_user_data');
        $choosed_booking_date = $this->session->userdata('choosed_booking_date');
        $business_provider_id = $this->session->userdata('business_provider_id');
        $business_service_id = $this->session->userdata('business_service_id');
        $membership_plan_id = $this->session->userdata('membership_plan_id');
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['choosed_booking_date'] = $choosed_booking_date;
        $data['membership_details'] = $this->Business_offering->get_membership_details($membership_plan_id);
        $data['booking_time_duration_length'] = $booking_time_duration_length;
        $data['main_content'] = 'membership_signin';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    public function register_success() {
        $data['main_content'] = 'register_success';
        $this->load->view('includes/menu_template', $data);
    }

    /*
     *  @depricated
     *  Please use prat_inidiviual_dashboard instead
     *  Now this function is for referrence purpose onl
     *  Original Purpose : To show the transaction data
     */

    public function user_dashboard() {


        $this->User_activity->insert_user_activity();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        // echo "<pre>";print_r($logged_in_user_data);exit();


        if ($logged_in_user_data->is_logged_in == 1) {
            $this->load->model('Bookings');
            $all_bookings = $this->Bookings->get_user_bookings($logged_in_user_data->user_id);
			$allcall_bookings = $this->Bookings->get_usercall_bookings($logged_in_user_data->user_id);
            $my_advisors = $this->Bookings->get_user_advisors($logged_in_user_data->user_id);
            $my_reviews = $this->Bookings->get_user_reviews($logged_in_user_data->user_id);
            $data['transactions'] = $all_bookings;
			$data['call_transactions'] = $allcall_bookings;
            $data['my_advisors'] = $my_advisors;
            $data['my_reviews'] = $my_reviews;
            $data['offering_gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');

            $upcoming_booking = array();
            foreach ($all_bookings as $key => $value) {
                if ($value['booking_details']->date > date('Y-m-d')) {
                    $upcoming_booking[] = $value['booking_details']->date;
                }
            }
            $upcoming_booking_dates = implode(',', $upcoming_booking);
			$userid = $logged_in_user_data->user_id;
			$data['livechat'] = $this->User->checkChatSchedule($userid);
			$data['survey_det'] = $this->User->getUserAllSurveyReport($logged_in_user_data->user_id);
			$data['survey'] = $this->User->checksurveydate2($logged_in_user_data->user_id);
            $data['upcoming_booking_dates'] = $upcoming_booking_dates;
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $data['title'] = "ZingUpLife | User Dashboard";
            $data['main_content'] = 'new_dashboard';

            $this->load->view('includes/newuser_menu_template', $data);
//            $this->load->view('individual_dashboard/dashboard');
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */

    /*
     *  validating user's data and updating user's profile 
     */

    public function update_user_profile() {
        $this->User_activity->insert_user_activity();
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        if ($data['logged_in_user_data']->is_logged_in == 1) {
            $post_data = $this->input->post();

            $this->load->model('User');
            			
            $logged_in_user_data = $this->session->userdata('logged_in_user_data');
            $post_data['user_id'] = $logged_in_user_data->user_id;
            $this->User->save_user_profile($post_data);
            $username = $logged_in_user_data->username;
           	$user_details = $this->User->get_user_details_by_username($username);
            $user_details->is_logged_in = 1;
           	$this->session->set_userdata("logged_in_user_data", $user_details);
            $this->session->set_flashdata("errors",1);
            redirect("/my_profile");
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
    }
}
    /* Above function ends here */

    /*
     *  Displaying user registration form 
     */

    public function change_password() {
        $this->User_activity->insert_user_activity();

        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        if ($data['logged_in_user_data']->is_logged_in == 1) {
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $path = base_url() . $this->config->item('user_profile_image_path');
            $data['path'] = $path;
            $data['title'] = "ZingUpLife | Change Password";
            $data['main_content'] = 'change_password';
            $this->load->view('includes/menu_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    /* Above function ends here */

    public function update_new_password() {
        $this->User_activity->insert_user_activity();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $password = $logged_in_user_data->password;
        $validate_password = PasswordHash::validate_password($post_data['old_password'], $password);
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');

        $this->load->model('User');

        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<div class="error change_password_error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $path = base_url() . $this->config->item('user_profile_image_path');
            $data['path'] = $path;
            $data['old_data'] = $post_data;
            $data['main_content'] = 'change_password';
            $this->load->view('includes/menu_template', $data);
        } elseif ($validate_password != 1) {
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $path = base_url() . $this->config->item('user_profile_image_path');
            $data['path'] = $path;
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $data['old_data'] = $post_data;
            $data['validation_error'] = 'Old password is wrong.';
            $data['main_content'] = 'change_password';
            $this->load->view('includes/menu_template', $data);
        } elseif (strlen($post_data['new_password']) < 6) {
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $path = base_url() . $this->config->item('user_profile_image_path');
            $data['path'] = $path;
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $data['old_data'] = $post_data;
            $data['validation_error'] = 'Password should be minimum 6 characters.';
            $data['main_content'] = 'change_password';
            $this->load->view('includes/menu_template', $data);
        } elseif ($post_data['new_password'] !== $post_data['confirm_password']) {
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $path = base_url() . $this->config->item('user_profile_image_path');
            $data['path'] = $path;
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $data['old_data'] = $post_data;
            $data['validation_error'] = 'New password and confirm password are not matching.';
            $data['main_content'] = 'change_password';
            $this->load->view('includes/menu_template', $data);
        } else {

            $new_password = PasswordHash::create_hash($post_data['new_password']);
            $update_new_password = $this->User->update_new_password($logged_in_user_data->username, $new_password);
            $this->session->set_flashdata('success_message', 'success');
            redirect("/change_password");
        }
    }

    /* Above function ends here */

    public function upload_user_image() {
        $this->User_activity->insert_user_activity();
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        $data['logged_in_user_data'] = $logged_in_user_data;
        $user_id = $logged_in_user_data->user_id;
        $this->load->model('User');
        if ($data['logged_in_user_data']->is_logged_in == 1) {
            $post_data = $_FILES;
            $this->User->upload_user_image($post_data, $user_id, $logged_in_user_data);
            $username = $logged_in_user_data->username;
            $user_details = $this->User->get_user_details_by_username($username);
            $user_details->is_logged_in = 1;
            $this->session->set_userdata("logged_in_user_data", $user_details);
            $this->session->set_flashdata('image_uploaded', 'Uploaded Succesfully !!!.');
            redirect("/my_profile");
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
    }

    public function twitter() {
        $app_path = APPPATH;
        echo $app_path . 'twiiter/login-with-twitter/login.php';
        include($app_path . 'twiiter/login-with-twitter/login.php');
    }

    public function twitter_response() {
        $app_path = APPPATH;
        // include_once("config.php");
        $app_path . 'twiiter/config.php';
        $app_path . 'twiiter/inc/twitteroauth.php';
        //include_once("inc/twitteroauth.php");

        if (isset($_REQUEST['oauth_token']) && $_SESSION['token'] !== $_REQUEST['oauth_token']) {

            // if token is old, distroy any session and redirect user to index.php
            session_destroy();
            redirect('/twitter');
        } elseif (isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

            // everything looks good, request access token
            //successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'], $_SESSION['token_secret']);
            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
            if ($connection->http_code == '200') {
                //redirect user to twitter
                $_SESSION['status'] = 'verified';
                $_SESSION['request_vars'] = $access_token;

                // unset no longer needed request tokens
                unset($_SESSION['token']);
                unset($_SESSION['token_secret']);
                redirect('/twitter');
            } else {
                die("error, try again later!");
            }
        } else {

            if (isset($_GET["denied"])) {
                redirect('/twitter');
                die();
            }

            //fresh authentication
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
            $request_token = $connection->getRequestToken(OAUTH_CALLBACK);

            //received token info from twitter
            $_SESSION['token'] = $request_token['oauth_token'];
            $_SESSION['token_secret'] = $request_token['oauth_token_secret'];

            // any value other than 200 is failure, so continue only if http code is 200
            if ($connection->http_code == '200') {
                //redirect user to twitter
                $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
                header('Location: ' . $twitter_url);
            } else {
                die("error connecting to twitter! try again later!");
            }
        }
    }

    /* social login functions */

    public function socialogin() {
         $provider = $this->uri->segment(2);
     
        $config = array("base_url" => "http://zinguplife.com/Users/redirect",
            "providers" => array(
                "Google" => array(
                    "enabled" => true,
                    "keys" => array("id" => "593987694813-9ai10ld6v6slhp3jfvktcrv5f4t2vhdr.apps.googleusercontent.com", "secret" => "Hd-QuJO5jB6RjZXwuO1cMdSR"),
                ),
                "Facebook" => array(
                    "enabled" => true,
                    "keys" => array("id" => "1407275962912681", "secret" => "f51ce8ab586d9e721ab3a2da70caa028"),
                    "includeEmail" => true,
                    "scope" => "email, user_about_me, user_birthday, user_hometown"  //optional.              
                ),
                "Twitter" => array(
                    "enabled" => true,
                    "keys" => array("key" => "B4mWtYQOi4pV863jKJUdMmAuI", "secret" => "W7F0RF0n28aN81Sx6CPiAa8DoSvEPbNFhGgR3CxCZ9wXBWZNau"),
                    "includeEmail" => true,
                    "scope" => "email"  //optional. 
                ),
                "LinkedIn" => array(
                    "enabled" => true,
                    "keys" => array("key" => "", "secret" => "")
                ),
            ),
            // if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
            "debug_mode" => true,
            "debug_file" => "debug.log",
        );
        include('Hybrid/Auth.php');
        if ($provider != '') {

            try {


                $hybridauth = new Hybrid_Auth($config);

                $authProvider = $hybridauth->authenticate($provider);

                $user_profile = $authProvider->getUserProfile();
                $this->load->model('User');
                if ($user_profile && isset($user_profile->identifier)) {
                    $profile_id = $this->User->check_user_exist($user_profile->identifier);
                    if ($user_profile->email != '') {
                        $email_id = $this->User->check_useremail_exist($user_profile->email);
                    } else {
                        $email_id = array();
                    }
                    if (empty($profile_id) && empty($email_id)) {
                        $insertdata = array('username' => $user_profile->email,
                            'name' => $user_profile->displayName,
                            'status' => 'Active',
                            'role' => 'user');
                        $userid = $this->User->insert_user_social_login($insertdata);
                        if ($userid != '') {
                            $profiledata = array('userid' => $userid,
                                'profileid' => $user_profile->identifier);
                            $this->User->insert_user_profileid($profiledata);
                            if ($user_profile->birthYear != '' && $user_profile->birthMonth != '' && $user_profile->birthDay != '') {
                                $dob = $user_profile->birthYear . '-' . $user_profile->birthMonth . '-' . $user_profile->birthDay;
                            } else {
                                $dob = "";
                            }
                            $detailsdata = array('user_id' => $userid,
                                'gender' => $user_profile->gender,
                                'age' => '',
                                'date_of_birth' => '',
                                'phone' => '',
                                'address' => '',
                                'city' => '',
                                'country' => '',
                                'zipcode' => '');
                            $this->User->insert_user_socail_logindetails($detailsdata);
                            $data['details'] = $this->User->get_user_logindetails_byid($userid);
                            //echo "if"."<pre>";print_r($data['details']);exit();
                            $data['details']->is_logged_in = '1';
                            $this->session->set_userdata("logged_in_user_data", $data['details']);
                            $business_provider_id = $this->session->userdata('business_provider_id');
                            $referrer = base_url();
                            $new_referrer = 'checkout';
                            if ($business_provider_id != '') {
                                $this->session->set_userdata("referrer", $new_referrer);
                            } else {
                                $this->session->set_userdata("referrer", $referrer);
                            }



                            echo "
            <script type=\"text/javascript\">
             var url = 'http://zinguplife.com/signin_success';
             window.opener.location.href= url;
            self.close();
            </script>
        ";
                        }
                    } elseif (empty($profile_id) && !empty($email_id)) {
                        $data['details'] = $this->User->get_user_details_by_username($user_profile->email);
                        //echo "elseif"."<pre>";print_r($data['details']);exit();
                        $data['details']->is_logged_in = '1';
                        $profiledata = array('userid' => $data['details']->user_id,
                            'profileid' => $user_profile->identifier);
                        $this->User->insert_user_profileid($profiledata);
                        $this->session->set_userdata("logged_in_user_data", $data['details']);
                        $business_provider_id = $this->session->userdata('business_provider_id');
                        $referrer = base_url();
                        $new_referrer = 'checkout';
                        if ($business_provider_id != '') {
                            $this->session->set_userdata("referrer", $new_referrer);
                        } else {
                            $this->session->set_userdata("referrer", $referrer);
                        }
                        echo "
            <script type=\"text/javascript\">
             var url = 'http://zinguplife.com/signin_success';
             window.opener.location.href= url;
            self.close();
            </script>
        ";
                    } else {
                        $data['details'] = $this->User->get_user_logindetails($profile_id->profileid);
                        // echo "else"."<pre>";print_r($data['details']);exit();
                        $data['details']->is_logged_in = '1';
                        $this->session->set_userdata("logged_in_user_data", $data['details']);
                        $business_provider_id = $this->session->userdata('business_provider_id');
                        $referrer = base_url();
                        $new_referrer = 'checkout';
                        if ($business_provider_id != '') {
                            $this->session->set_userdata("referrer", $new_referrer);
                        } else {
                            $this->session->set_userdata("referrer", $referrer);
                        }
                        echo "
            <script type=\"text/javascript\">
             var url = 'http://zinguplife.com/signin_success';
             window.opener.location.href= url;
            self.close();
            </script>
        ";
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                switch ($e->getCode()) {
                    case 0 : echo "Unspecified error.";
                        break;
                    case 1 : echo "Hybridauth configuration error.";
                        break;
                    case 2 : echo "Provider not properly configured.";
                        break;
                    case 3 : echo "Unknown or disabled provider.";
                        break;
                    case 4 : echo "Missing provider application credentials.";
                        break;
                    case 5 : echo "Authentication failed The user has canceled the authentication or the provider refused the connection.";
                        break;
                    case 6 : echo "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
                        $authProvider->logout();
                        break;
                    case 7 : echo "User not connected to the provider.";
                        $authProvider->logout();
                        break;
                    case 8 : echo "Provider does not support this feature.";
                        break;
                }
            }
        }
    }

    public function redirect() {
        
    }

    /*created after 8th may*/
	
	public function signin_first_success() {
        $this->User_activity->insert_user_activity();

        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $data['title'] = "Sign In Redirect";
        $data['active_url'] = "";
        $data['main_content'] = 'signin-survey-redirect';
        $this->load->view('includes/menu_template', $data);
    }
	
	public function survey()
	{
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');

        if ($data['logged_in_user_data']->is_logged_in == 1) {
			$id = $data['logged_in_user_data']->user_id;
			$data['details'] = $this->User->getbasicDetails($id);
			$data['surveys'] = $this->User->getSurvey();
			$data['title'] = "Wellness Survey";
			$data['active_url'] = "";
			$data['main_content'] = 'survey_form';
			$this->load->view('includes/menu_template', $data);
		} else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
	}
	

	/*
	 * prat_individual_dashboard
	 *
	 *Show the individual dashboard to user or redirect to login in case of session logout
	 *
	 * @param none
	 * @return Dashboard Page
	 * @author meShakti
	 * @createdOn 05/01/2018 
	 */
	public function prat_individual_dashboard(){
	    //Inserts user activity
	    $this->User_activity->insert_user_activity();
	    
	    //Checking if user is logged in
	    $logged_in_user_data = $this->session->userdata('logged_in_user_data');
	   
	    	    
	    if ($logged_in_user_data->is_logged_in == 1) {
	        //Get the dashboard data
	        $this->load->model('Prat_dashboard_assesment_model');
	        $data['assesment_results'] = $this->Prat_dashboard_assesment_model->prat_get_assesment_results($logged_in_user_data->user_id);
	        	        
	        //Get Dashboard Reports
	        $data['assesment_reports'] = $this->Prat_dashboard_assesment_model->prat_get_assesment_reports($logged_in_user_data->user_id);
	        
	        //Get Dashboard Industrial Standaard
	        $data['assesment_standards'] = $this->Prat_dashboard_assesment_model->prat_get_assesment_standard_result($logged_in_user_data);
	        
	        //Get Assesment Access variable
	        $data['assesment_access'] = $this->Prat_dashboard_assesment_model->prat_get_assesment_access($logged_in_user_data->user_id);
            
	        //Get Assesment Goal variable
	        $data['assesment_goals'] = $this ->Prat_dashboard_assesment_model->prat_get_assesment_goals($logged_in_user_data->user_id);
	        
	        /*Session Related information*/
	        $userid = $logged_in_user_data->user_id;	        
	        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
	        $data['title'] = "ZingUpLife | User Dashboard";
	        
	        $this->load->view('includes/newuser_menu_template', $data);
	        
	        
	    } else {
	        //User not logged in
	        //Redirect to login Page
	        $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
	        redirect("/login");
	    }
	}
	

	/*created after 8th may*/
	
		/*live chat*/
	
	public function update_session_link()
	{
		$data = $this->input->post();
		$lin2k ='https://appear.in/'. $data['roomName'];
		$link = $this->User->update_session_link($data['id'],$lin2k);
		$this->session->set_userdata('live_session',$link);
		$this->session->set_userdata('booked_id',$data['id']);
		echo json_encode($link);
	}
	
	/**
	 *  Getting user notification to show in popup
	 */
	public function user_notifications() {
		$this->User_activity->insert_user_activity();
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		$this->load->model('Notifications');
		$limit = 10;// collect latest 10 records.
		$notifications = $this->Notifications->get_user_notifications($logged_in_user_details->user_id, $limit);
		$data['notifications'] = $notifications;
	echo 'here';
		//Once recent notifications viewed by user. making flag as viewed.
		$this->Notifications->update_user_notifications($logged_in_user_details->user_id);
	echo 'after';
		echo json_encode($data['notifications']);
	}
	
	/*text chat code*/
	public function chat()
	{
		$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');

        if ($data['logged_in_user_data']->is_logged_in == 1) {
			//$data['main_content'] = 'experts/new_text_chat';
			$this->load->view('experts/new_text_chat');
		}
		else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/login");
        }
	}
	
	public function asm_registration() {
            $this->session->set_userdata('country','india');
            $this->session->set_userdata('place','bangalore');
            $this->User_activity->insert_user_activity();
            $post_data 	= $_POST;
            $this->load->model('User');
            $post_data['name'] = $this->input->cookie('asse_name');
            $post_data['gender'] = $this->input->cookie('asse_gender');
            $post_data['dob'] = $this->input->cookie('asse_dob');
            $post_data['weight'] = $this->input->cookie('asse_height');
            $post_data['height'] = $this->input->cookie('asse_weight');
            $post_data['bmi'] = $this->input->cookie('asse_bmi');
            $post_data['org_access_code'] = $this->input->cookie('asse_org_access_code');
            $post_data['job_location'] = $this->input->cookie('job_location');
            $post_data['job_role'] = $this->input->cookie('job_role');
            $accesscode = $post_data['accesscode'];
	    	$phone = $post_data['phone'];
	    	$code = $phone[0] . $phone[strlen($phone) - 1] . date("d");
            //$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('username', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        if ($this->form_validation->run() == FALSE) {
            $data['error_message']  = 'Please fill all the mandatory fields';
            $data['error_type']     = 'failed';
        } else {
			$hashed = PasswordHash::create_hash($post_data['password']);
			$check_user_exists = $this->User->check_username_availability($post_data['username']);
			
			if (!empty($check_user_exists) || $accesscode != $code) {
				
				if(!empty($check_user_exists)){
					$data['user_error_message'] 	= 'Username already exist';
					$data['error_type']     	= 'failed';
				}
				
				if($accesscode != $code){
					$data['access_error']  		= 'yes';
					$data['access_error_message']  	= 'Your access code is not matching.';
				}
			} else {
        		$this->User->create_user($post_data, $hashed);
				$validate_user = $this->User->validate_user($post_data['username'], $post_data['password']);
                if ($validate_user['validation_status']['status'] == 'Success') {
                    $assessment_user_id = $this->User->UpdateAssessmentUserId($post_data['username']);
                    $user_themes = $this->User->GetUserThemesByUserId($assessment_user_id);
                    $user_theme_id = $user_themes[0]->theme_id;
                    $user_test_id = $user_themes[0]->test_id;
                    $this->load->model('Apiassessment_model');
                    $this->Apiassessment_model->storeAssessmentResults($assessment_user_id, $user_theme_id, $user_test_id);
                    $validate_user['user_details']->is_logged_in = '1';
                    //print_r($validate_user);
                    $this->session->set_userdata("logged_in_user_data", $validate_user['user_details']);
                    $registration_email_content = $this->load->view('emails/registration_success', $validate_user, true);
                    $to = $validate_user['user_details']->username;
                    $from = "Zinguplife<info@zinguplife.com>";
                    $registration_mail_subject = "You have sucessfully registered with Zingup !!!";
                    $registration_message = $registration_email_content;
                    $this->Mailing->send_mail($to, $from, $registration_mail_subject, $registration_message);
                    $messgae_to = '+91' . $validate_user['user_details']->phone;
                    $sms_content = 'Congratulations! You have successfully registered with Zingup';
                    $this->Mailing->send_sms($messgae_to, $sms_content);
                    $data['theme_id']	= $user_theme_id;
		    $data['test_id']	= $user_test_id;
                    $data['error_message']  = 'Your account created successfully';
                    $data['error_type']     = 'success';
                    //redirect("/register_success");
                }else {
                    $data['error_message'] = 'Something went wrong while creating the account';
                    $data['error_type']    = 'failed';
                }
        	}
        }
        echo json_encode($data);
    }
    
    
    public function set_access_code(){
    
    	$post_data=$_POST;
	    $phone = $post_data['mobile_no'];
	    $code = $phone[0] . $phone[strlen($phone) - 1] . date("d"); //first and last character of phone number + todays date is the code.
	    $messgae_to = '+91' . $post_data['mobile_no'];
	    $sms_content = "Verification code for ZingUpLife is: ".$code;
	    $this->Mailing->send_sms($messgae_to, $sms_content);
	    echo json_encode(true);
    }
    
    public function basic_user_detail(){
    	$this->load->helper('cookie');
        $this->session->set_userdata('country','india');
        $this->session->set_userdata('place','bangalore');
        $this->User_activity->insert_user_activity();
        $post_data 	= $_POST;
        delete_cookie(asse_org_access_code);
        $bmidata = explode(' ',$post_data['asse_bmi']);
        $bmi = $bmidata[1];
        $key_name="org_access_code_enable";
        $data['switch_flag']	= $this->Utilitiesmodel->flag_checking($key_name);
        if($data['switch_flag']){
        	if(!empty($post_data['org_access_code'])){
        		$verified_result=$this->User->varify_org_access_code($post_data['org_access_code']);
        		if($verified_result==true){
        		    $this->input->set_cookie('job_role',$post_data['job_role'],'86400');
        		    $this->input->set_cookie('job_location',$post_data['job_location'],'86400');
        			$this->input->set_cookie('asse_org_access_code',$post_data['org_access_code'],'86400');
        			$this->input->set_cookie('asse_name',$post_data['name'],'86400');
        			$this->input->set_cookie('asse_gender',$post_data['gender'],'86400');
        			$this->input->set_cookie('asse_dob',$post_data['dob'],'86400');
        			$this->input->set_cookie('asse_height',$post_data['height'],'86400');
        			$this->input->set_cookie('asse_weight',$post_data['weight'],'86400');
        			$this->input->set_cookie('asse_bmi',$bmi,'86400');
        			$this->input->set_cookie($cookie);
        			echo json_encode(true);
        		}else{
        			echo json_encode(false);
        		}
        	}else{
        		$this->input->set_cookie('asse_name',$post_data['name'],'86400');
        		$this->input->set_cookie('asse_gender',$post_data['gender'],'86400');
        		$this->input->set_cookie('asse_dob',$post_data['dob'],'86400');
        		$this->input->set_cookie('asse_height',$post_data['height'],'86400');
        		$this->input->set_cookie('asse_weight',$post_data['weight'],'86400');
        		$this->input->set_cookie('asse_bmi',$bmi,'86400');
        		$this->input->set_cookie($cookie);
        		echo json_encode(true);
        	}
        }else{
        	$this->input->set_cookie('asse_name',$post_data['name'],'86400');
        	$this->input->set_cookie('asse_gender',$post_data['gender'],'86400');
        	$this->input->set_cookie('asse_dob',$post_data['dob'],'86400');
        	$this->input->set_cookie('asse_height',$post_data['height'],'86400');
        	$this->input->set_cookie('asse_weight',$post_data['weight'],'86400');
        	$this->input->set_cookie('asse_bmi',$bmi,'86400');
        	$this->input->set_cookie($cookie);
        	echo json_encode(true);
        }
        
    }
		
}
