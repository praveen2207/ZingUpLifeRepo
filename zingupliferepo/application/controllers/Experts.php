<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Experts extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Expert');
		$this->load->model('sme_user');
		$this->load->model('Utilitiesmodel');
		 if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		  $this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }
            $this->load->model('User');

       
    }
	
	public function home() {
       //echo 'test'; exit();
	   if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		  $this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $data['services'] = $this->sme_user->getServices();
        $data['sme_users'] = $this->sme_user->get_sme_users_for_home_page();
        $data['sme_users_by_service'] = $this->sme_user->get_sme_users_for_home_page(); 
        $data['title']='zinguplife |  Experts';
        $data['active_url'] = 'experts';
        $data['main_content'] = 'experts/new_sme_home';
        $this->load->view('experts/includes/new_experts_template', $data);
    }
	
	
	
	public function forgot_password() {
        $data['main_content'] = 'experts/forgot_password';
        $this->load->view('experts/includes/experts_template', $data);
    }

    public function send_mail() {
        $useremail = $this->input->post('email');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
        if ($this->form_validation->run() == false) {
            $data['main_content'] = 'experts/forgot_password';
            $this->load->view('experts/includes/experts_template', $data);
        } else {
            $checkemail = $this->sme_user->check_mail($useremail);
            if ($checkemail == false) {
                $data['errors'] = 'You have not registered with this email ID';
                $data['main_content'] = 'experts/forgot_password';
                $this->load->view('experts/includes/experts_template', $data);
            } else {
                $this->load->helper('date');
                $this->load->helper('rand_helper');

                date_default_timezone_set('Asia/Kolkata');
                $newFormat = date("Y-m-d H:i:s");
                $randomString = generateRandomString();
                $data = array('reset_string' => $randomString, 'reset_time' => $newFormat);
                $this->sme_user->save_random_string($useremail, $data);
                $user_details = $this->sme_user->getalldetails($useremail);
                $reset_link = $this->config->base_url() . 'experts/reset_password/' . $randomString;


                /* to send  email */
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $this->email->from('admin@zinguplife.com', 'Zingup Support');
                $this->email->to($useremail);
                $this->email->subject('Reset Password link');
                $this->email->message('Hello ' . $user_details->first_name . ' ' . $user_details->last_name . '
				<br/><br/>
				please click on the link below to reset your password within 2 hours as the link will get expired.
				<br/><br/>
				<a href=' . $reset_link . '>' . $reset_link . '</a>');
                $this->email->send();
                $data['errors'] = 'Please check your email to reset the password';
                $data['main_content'] = 'experts/forgot_password';
                $this->load->view('experts/includes/experts_template', $data);
            }
        }
    }

    public function reset_password() {
        $data['string'] = $this->uri->segment(3);
        $id = $this->sme_user->check_random($data['string']);
        $resetdatetime = $this->sme_user->get_datetime($data['string']);
        $newdate = strtotime('+2 hours', strtotime($resetdatetime));
        $expiredate = date('Y-m-d H:i:s', $newdate);


        date_default_timezone_set('Asia/Kolkata');
        $curdatetime = date("Y-m-d H:i:s");


        if ($id != false && $curdatetime < $expiredate) {
            $data['main_content'] = 'experts/reset_password';
            $this->load->view('experts/includes/experts_template', $data);
        } else if ($curdatetime > $expiredate) {
            $data['error'] = 'Sorry this link has been expired';
            $data['main_content'] = 'experts/error';
            $this->load->view('experts/includes/experts_template', $data);
        } else {
            $data['error'] = 'Sorry this link has been expired';
            $data['main_content'] = 'experts/error';
            $this->load->view('experts/includes/experts_template', $data);
        }
    }

    public function update_password() {
        $string = $this->input->post('random_key');
        $id = $this->sme_user->check_random($string);

        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['main_content'] = 'experts/reset_password';
            $this->load->view('experts/includes/experts_template', $data);
        } else {
            $password = $this->input->post('password');
            $this->load->helper('phpass');
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $hash_password = $hasher->HashPassword($password);

            $data = array(
                'password' => $hash_password,
                'reset_string' => ''
            );

            $this->sme_user->update_password($id, $data);
            $data['content'] = 'Password is Updated Successfully';
            $data['main_content'] = 'experts/success';
            $this->load->view('experts/includes/experts_template', $data);
        }
    }

    public function logout() {
        $smeuserid = $this->session->userdata('sme_userid');
        $login_data = array(
            'active' => 'n'
        );

        $smeuser_id = $this->sme_user->update_smeuser_table($login_data, $smeuserid);
        $this->session->sess_destroy();
        redirect('experts/home');
    }
	
	/**
     * Register SME in disable state. Send verification code in email
     */
	public function register() {
		
        $data = $this->input->post();
        $data['title']='zinguplife |  Experts Registration';
        $today = date('m/d/Y');
        //form validation
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cpassword', 'Password', 'required');
        $this->form_validation->set_rules('service', 'Service', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email|is_unique[sme_users.username]');

        // callback function
        // custom error message
        $this->form_validation->set_message('customAlpha', 'Name field should contain only alphabets and spaces');
        $this->form_validation->set_message('is_unique', 'You have already registered with this Email Id');

   
        
        $hashed = password_hash($data['password'], PASSWORD_BCRYPT);
        
        if ($this->form_validation->run() == FALSE) {
        	//print_r($data);
				$data['services'] = $this->sme_user->getallmainservices();
				$data['main_content'] = 'experts/sme_registration';
				
				
				$this->load->view('experts/includes/experts_template', $data);
        } else {
        	$post_data['active'] = 'n';
        	$post_data['status'] = 'disable';
        	$email_verification_code = $this->sme_user->create_sme($data,$hashed);
        	$post_data['email_verification_code'] = $email_verification_code;
        	$data['details'] = $post_data;
        	
        	$vendor_registration_email_content = $this->load->view('emails/vendor_email_verification', $data, true);
        	
        	//$to = $post_data['email'];
        	//$to = 'partner@zinguplife.com';
        	$to = $data['email'];
        	$from = "Zinguplife<info@zinuplife.com>";
        	//$registration_mail_subject = $post_data['business_name'] . " : Verify Your Email";
			$registration_mail_subject = "Your OTP for registration at ZingUpLife";
        	$registration_message = $vendor_registration_email_content;
        	
        	$this->Mailing->send_mail($to, $from, $registration_mail_subject, $registration_message);
        	
        	$data['main_content'] = 'experts/sme_email_verification';
        	$this->load->view('experts/includes/experts_template', $data);
        	
        }
    }
    /**
     * Verify email verificaiton code
     */
    public function verifySmeEmail() {
    	
    	$post_data = $this->input->post();
    	$email_verification_code = $post_data['email_verification_code'];
    	$sme_details = $this->sme_user->verify_email($email_verification_code);
    	if ($sme_details != 'not matched') {
    		$sme_details->is_logged_in = '1';
    		$this->session->set_userdata("logged_in_vendor_data", $sme_details);
    		$data['main_content'] = 'experts/sme_detail_registration';
    		$data['smeuser_id'] =  $sme_details->id;
    		$data['name'] =  $sme_details->name;
    		$data['list'] =  $this->Utilitiesmodel->getCountry();
    		$data['expertise'] =  $this->sme_user->get_all_expertise();
    		$data['services'] = $this->sme_user->getallmainservices();
    		$this->load->view('experts/includes/experts_template', $data);
    		
    	} else {
    		$data['verification_error'] = 'Email verification code is wrong.';
    		$data['main_content'] = 'experts/sme_email_verification';
        	$this->load->view('experts/includes/experts_template', $data);
    	}
    }
    /**
     * After Initial registration and email verification for SME done then offer to enter other details.
     */
    public function registerDetail() {
    	
    	$data = $this->input->post();
    	$today = date('m/d/Y');
    	//form validation
    	$this->form_validation->set_rules('phone', 'Phone', 'required');
    	$this->form_validation->set_rules('city_dropdown', 'City', 'required');
    	$this->form_validation->set_rules('state_dropdown', 'State', 'required');
    	$this->form_validation->set_rules('country_dropdown', 'Country', 'required');
    	$this->form_validation->set_rules('about', 'About', 'required');
    	$this->form_validation->set_rules('expertise', 'Expertise', 'required');
    	
    	
    
    	if ($this->form_validation->run() == FALSE) {
    		
    		$data['main_content'] = 'experts/sme_detail_registration';
    		$data['list'] =  $this->Utilitiesmodel->getCountry();
    		$data['services'] = $this->sme_user->getallmainservices();
    		
    		$this->load->view('experts/includes/experts_template', $data);
    	} else {
 
    		//$dob = date('Y-m-d', strtotime($this->input->post('dob')));
    		$smeuser_id = $this->input->post('smeuser_id');
    		if ($_FILES['userfile']['name'] != '')
    		{
    			$config['upload_path'] = './sme_users/' . $smeuser_id;
    			$config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
    
    			if (!is_dir('sme_users/' . $smeuser_id)) {
    				mkdir('./sme_users/' . $smeuser_id, 0777, true);
    			}
    
    			$this->load->library('upload', $config);
    
    
    			if ( ! $this->upload->do_upload())
    			{
    				$data['errors'] = array('error' => $this->upload->display_errors());
    				$data['main_content'] = 'experts/sme_detail_registration';
    				$this->load->view('experts/includes/experts_template', $data);
    			}
    
    			$data = $this->upload->data();
    			$photo = $data['file_name'];
    		}
    		else
    		{
    			$photo = '';
    		}
    		$profile_data = array(
    				'sme_userid'    => $smeuser_id,
    				'phone'         => $this->input->post('phonefull'),
    				'city'          => $this->input->post('city_dropdown'),
    				'state'         => $this->input->post('state_dropdown'),
    				'country'       => $this->input->post('country_dropdown'),
    				'expertise'     => $this->input->post('expertise'),
    				'about'       	=> $this->input->post('about'),
    				'cert_edu'      => $this->input->post('cert_edu'),
    				'photo'    		=> $photo
    		);
    	
    		// Add data to user_profile table
    		$this->sme_user->user_profile_update($profile_data,$smeuser_id);
    		//START 2016-12017 by Alok Sharma
		    		/** Making the change to keep Expertise as free flow text instead of dropdown
		    		//Add expertise data to expertise SME relationship table
		    		$selectedOptionAll = $this->input->post('expertiseMulti');
		    	
		    		foreach ($selectedOptionAll as $selectedOption => $value) {
		    			$this->sme_user->add_sme_expertise_all($smeuser_id, $selectedOption);
		    		}
		    	
		    		 
		    		//add expertise to expertise master table.
		    		$other_expertise = $this->input->post('otherExpertise');
		    		$service_id = $this->sme_user->getsmeservice($smeuser_id); //get the service id for which the new expertise need to be added.
		    		// Assumption here that the SME will belong to only one service.
		    	
		    		if (!empty($other_expertise)) {
		    			$other_expertise_all = explode(",", $other_expertise);
		    			 
		    			foreach ($other_expertise_all as $other_expertise_desc => $value) {
		    				$new_expertise_id =  $this->sme_user->add_new_expertise($value,$service_id[0]->offerings_id,$smeuser_id);
		    				//get the ID of newly added expertise and add it into sme expertise relationship table.
		    				$this->sme_user->add_sme_expertise_all($smeuser_id, $new_expertise_id[0]->expertise_id);
		    	
		    	
		    			}
		    		}
    		*/
    		//END 2016-12017
    		$data['content'] = 'Registration was successfull';
    		$data['main_content'] = 'experts/sme_success';
    		$this->load->view('experts/includes/experts_template', $data);
    	}
    }
	
  private function sendSMERegistrationEmail(){
    	 
    	$this->load->library('email');
    	$this->email->set_newline("\r\n");
    	$this->email->set_mailtype("html");
    	$this->email->from('admin@zinguplife.com', 'Zingup Support');
    	$this->email->to($useremail);
    	$this->email->subject('Welcome to ZingUpLife!');
    	$this->email->message('Dear ‘<?php echo $user_details->name; ?>’ ' . $user_details->first_name . ' ' . $user_details->last_name . '
	   <br/><br/>
       <p>It is a pleasure to have you as part of our network of over 380 experts, therapists and coaches.</p>
       <p>We look forward to providing you with the best possible tools and technologies, help simplify your practice ecosystem and multiply your reach.</p>		
       <p>Please start with accessing and updating your professional profile at <a href=‘https://zinguplife.com/experts/login’>https://zinguplife.com/experts/login</a>.</p>
       <p>Your username is<?php echo $user_details->username; ?>, and you can reset your password here <a href=‘https://zinguplife.com/experts/login’>https://zinguplife.com/experts/login</a>.</p>
       <p>We’re super excited that you decided to join us. </p>
       <p>Because this means that you realize that traditional methods of evangelizing health and wellness are outdated, and that technology is the best way to transform individual wellbeing.</p>			
       <p>You can now showcase your expertise, consult with users (using chat, audio and video integration), publish content, answer questions and do much more, seamlessly!</p>
       <p>This quick video explains how you can access and benefit from our platform <a href="https://zinguplife.com/about_us">https://zinguplife.com/about_us</a> </p>
       <p>If there’s anything we can help you with, simply drop in a line at <a href="mailto:support@zinguplife.com">support@zinguplife.com</a>, or call us at +91 98181 13345. </p>
       <p>Once again, welcome to the community!</p>
       <p>
       Best wishes,<br/></p>
       <p>
       Team ZingUpLife
       </p>		
    			
		<br/><br/>
		<a href=' . $reset_link . '>' . $reset_link . '</a>');
    	$this->email->send();
    }
    
    
    public function customAlpha($str) {
        if (!preg_match('/^[a-z \-]+$/i', $str)) {
            return false;
        }
    }

    public function validate_time($str) {
        //Assume $str SHOULD be entered as HH:MM

        list($hh, $mm) = split('[:]', $str);

        if (!is_numeric($hh) || !is_numeric($mm)) {
            $this->form_validation->set_message('validate_time', 'Please enter the time in the format HH:MM (24 hour format) ex:13:00');
            return FALSE;
        } else if ((int) $hh > 24 || (int) $mm > 59) {
            $this->form_validation->set_message('validate_time', 'Invalid time');
            return FALSE;
        } else if (mktime((int) $hh, (int) $mm) === FALSE) {
            $this->form_validation->set_message('validate_time', 'Invalid time');
            return FALSE;
        }

        return TRUE;
    }

    public function login() {
        $data['main_content'] = 'experts/sme_login';
        $this->load->view('experts/includes/experts_template', $data);
    }

    public function signin() {
        $data = $this->input->post();

        //validation
        $this->form_validation->set_rules('username', 'Username', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $data['main_content'] = 'experts/sme_login';
            $this->load->view('experts/includes/experts_template', $data);
        } else {
            $this->load->helper('phpass');

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            //echo $hash_password = $hasher->HashPassword($password); exit(); 

            $actualPassword = $this->sme_user->getpassword($username);
            if ($actualPassword != false) {
                $res = $hasher->CheckPassword($password, $actualPassword);
                if ($res == true) {
                    $user_details = $this->sme_user->getalldetails($username);
                     $login_data = array(
							'active' => 'y'
						);

					$this->sme_user->update_smeuser_table($login_data,  $user_details->id);
                    $this->session->set_userdata(array(
                        'sme_userid' => $user_details->id,
                        'first_name' => $user_details->first_name,
                        'last_name' => $user_details->last_name,
                        'username' => $user_details->username,
                        'photo' => $user_details->photo,
                        'type' => 'sme',
                        'header_image' => $user_details->header_image,
                        'is_logged_in' => true
                    ));
                    $login_data = array(
                        'active' => 'y'
                    );

                    $smeuser_id = $this->sme_user->update_smeuser_table($login_data, $user_details->id);
                    redirect('experts/dashboard');
                } else {
                    $data['error'] = 'The password entered is wrong';
                    $data['main_content'] = 'experts/sme_login';
                    $this->load->view('experts/includes/experts_template', $data);
                }
            } else {
                $data['error'] = 'You have not registered with this Email ID';
                $data['main_content'] = 'experts/sme_login';
                $this->load->view('experts/includes/experts_template', $data);
            }
        }
    }

	
	/*public function index() {

        if ($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme') {
            redirect('experts/dashboard');
        } else {
            $data['services'] = $this->Expert->getServices();
            $data['main_content'] = 'experts/expert_home';
            $this->load->view('experts/includes/experts_template',$data);
        }
    }*/ 
    
    public function user() {
		$this->session->unset_userdata('from');
        $data['title']='zinguplife | User-sme-view';
        $data['userid']=$id = $this->uri->segment(3);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['profile'] = $this->Expert->getprofile($id);
		$data['chat_payment'] = $this->Expert->getChatPayments();
		$data['added_slots'] = $this->Expert->getaddedslots($id);
		$data['blocked_slots'] = $this->Expert->getblockedslots($id);
		$data['follow_cnt'] = $this->Expert->getfollowcnt($id);
		$data['feedback'] =$this->Expert->getallfeedback($id);
		$data['questions'] = $this->Expert->getallansquestions($id);
		$data['events'] = $this->Expert->getallevents($id);
		$data['fb_rating'] = $this->Expert->getrating($id);
		$data['rating_total'] = $this->Expert->getratingtot($id);
		$data['pos_fb'] = $this->Expert->get_pos_fb($id);
		$data['neu_fb'] = $this->Expert->get_neu_fb($id);
		$data['neg_fb'] = $this->Expert->get_neg_fb($id);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($id);
		$data['articles'] = $this->Expert->getallarticles($id);
		$data['following'] =  $this->Expert->checkfollow($userid,$id);
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		 if (!empty($logged_in_user_details)) {
                                    $data['is_logged_in'] = $logged_in_user_details->is_logged_in;
                                } else {
                                    $data['is_logged_in'] = '';
                                }
		$data['offset'] = 8;
		$data['fboffset'] = 5;
		$data['aroffset'] = 4;
		
		 $user = $data['user'] = $logged_in_user_details->user_id;
		$data['transaction_id'] = $this->sme_user->gettrans($user);
		$data['calls'] = $this->Expert->getuserca($user,$data['userid']);
		 $data['c'] = $this->Expert->checkprevDues($id,$user);
		 if($this->session->userdata('from') && $this->session->userdata('from') == 'chat')
		 {
			 $this->session->unset_userdata('from');
			if($data['c'])
			{
				$de = $this->Expert->getlivesessionde($id,$user);
					$this->session->set_userdata('chat_userid',$user); 
					 $this->session->set_userdata('smebookcallid',$de->smebookcallid); 
					 $this->session->set_userdata('book_type',$de->book_type);  
					 $this->session->set_userdata('sme_userid',$id);
					 $this->session->set_userdata('paypackage_amt',$de->amount);
					 $this->session->set_userdata('order_id',$de->order_id);
				 $this->session->set_userdata('direct','yes');
			}
			else
			{
				
					$de = $this->Expert->getlivesessionde($id,$user);
					$this->session->set_userdata('chat_userid',$user); 
					 $this->session->set_userdata('smebookcallid',$de->smebookcallid); 
					 $this->session->set_userdata('book_type',$de->book_type);  
					 $this->session->set_userdata('sme_userid',$id);
					 $this->session->set_userdata('paypackage_amt',$de->amount);
					 $this->session->set_userdata('order_id',$de->order_id);
					 redirect('/experts/new_payment_checkout');
			}
		 }
		//$data['main_content'] = 'experts/experts_user_view'; 
		//$this->load->view('experts/includes/experts_template',$data);
		
		$data['main_content'] = 'experts/new_experts_user_view'; 
		$this->load->view('experts/includes/new_experts_template',$data);
    }
	
	 public function user_book() {
		 $this->session->set_userdata('from','book');
		 
        $data['title']='zinguplife | User-sme-view';
        $data['userid']=$id = $this->uri->segment(3);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['profile'] = $this->Expert->getprofile($id);
		$data['chat_payment'] = $this->Expert->getChatPayments();
		$data['added_slots'] = $this->Expert->getaddedslots($id);
		$data['blocked_slots'] = $this->Expert->getblockedslots($id);
		$data['follow_cnt'] = $this->Expert->getfollowcnt($id);
		$data['feedback'] =$this->Expert->getallfeedback($id);
		$data['questions'] = $this->Expert->getallansquestions($id);
		$data['events'] = $this->Expert->getallevents($id);
		$data['fb_rating'] = $this->Expert->getrating($id);
		$data['rating_total'] = $this->Expert->getratingtot($id);
		$data['pos_fb'] = $this->Expert->get_pos_fb($id);
		$data['neu_fb'] = $this->Expert->get_neu_fb($id);
		$data['neg_fb'] = $this->Expert->get_neg_fb($id);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($id);
		$data['articles'] = $this->Expert->getallarticles($id);
		$data['following'] =  $this->Expert->checkfollow($userid,$id);
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		 if (!empty($logged_in_user_details)) {
                                    $data['is_logged_in'] = $logged_in_user_details->is_logged_in;
                                } else {
                                    $data['is_logged_in'] = '';
                                }
		$data['offset'] = 8;
		$data['fboffset'] = 5;
		$data['aroffset'] = 4;
		
		 $user = $data['user'] = $logged_in_user_details->user_id;
		$data['transaction_id'] = $this->sme_user->gettrans($user);
		$data['calls'] = $this->Expert->getuserca($user,$data['userid']);
		 $data['c'] = $this->Expert->checkprevDues($id,$user);
		 if($this->session->userdata('from') && $this->session->userdata('from') == 'chat')
		 {
			 $this->session->unset_userdata('from');
			if($data['c'])
			{
				$de = $this->Expert->getlivesessionde($id,$user);
					$this->session->set_userdata('chat_userid',$user); 
					 $this->session->set_userdata('smebookcallid',$de->smebookcallid); 
					 $this->session->set_userdata('book_type',$de->book_type);  
					 $this->session->set_userdata('sme_userid',$id);
					 $this->session->set_userdata('paypackage_amt',$de->amount);
					 $this->session->set_userdata('order_id',$de->order_id);
				 $this->session->set_userdata('direct','yes');
			}
			else
			{
				
					$de = $this->Expert->getlivesessionde($id,$user);
					$this->session->set_userdata('chat_userid',$user); 
					 $this->session->set_userdata('smebookcallid',$de->smebookcallid); 
					 $this->session->set_userdata('book_type',$de->book_type);  
					 $this->session->set_userdata('sme_userid',$id);
					 $this->session->set_userdata('paypackage_amt',$de->amount);
					 $this->session->set_userdata('order_id',$de->order_id);
					 //echo $de->order_id; exit();
					 redirect('/experts/new_payment_checkout');
			}
		 }
		//$data['main_content'] = 'experts/experts_user_view'; 
		//$this->load->view('experts/includes/experts_template',$data);
		
		$data['main_content'] = 'experts/new_experts_user_view'; 
		$this->load->view('experts/includes/new_experts_template',$data);
    }
	
	 public function user_chat() {
		 $this->session->set_userdata('from','chat');
		 
        $data['title']='zinguplife | User-sme-view';
        $data['userid']=$id = $this->uri->segment(3);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['profile'] = $this->Expert->getprofile($id);
		$data['chat_payment'] = $this->Expert->getChatPayments();
		$data['added_slots'] = $this->Expert->getaddedslots($id);
		$data['blocked_slots'] = $this->Expert->getblockedslots($id);
		$data['follow_cnt'] = $this->Expert->getfollowcnt($id);
		$data['feedback'] =$this->Expert->getallfeedback($id);
		$data['questions'] = $this->Expert->getallansquestions($id);
		$data['events'] = $this->Expert->getallevents($id);
		$data['fb_rating'] = $this->Expert->getrating($id);
		$data['rating_total'] = $this->Expert->getratingtot($id);
		$data['pos_fb'] = $this->Expert->get_pos_fb($id);
		$data['neu_fb'] = $this->Expert->get_neu_fb($id);
		$data['neg_fb'] = $this->Expert->get_neg_fb($id);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($id);
		$data['articles'] = $this->Expert->getallarticles($id);
		$data['following'] =  $this->Expert->checkfollow($userid,$id);
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		 if (!empty($logged_in_user_details)) {
                                    $data['is_logged_in'] = $logged_in_user_details->is_logged_in;
                                } else {
                                    $data['is_logged_in'] = '';
                                }
		$data['offset'] = 8;
		$data['fboffset'] = 5;
		$data['aroffset'] = 4;
		
		 $user = $data['user'] = $logged_in_user_details->user_id;
		$data['transaction_id'] = $this->sme_user->gettrans($user);
		$data['calls'] = $this->Expert->getuserca($user,$data['userid']);
		 $data['c'] = $this->Expert->checkprevDues($id,$user);
		 if($this->session->userdata('from') && $this->session->userdata('from') == 'chat')
		 {
			 $this->session->unset_userdata('from');
			if($data['c'])
			{
				$de = $this->Expert->getlivesessionde($id,$user);
					$this->session->set_userdata('chat_userid',$user); 
					 $this->session->set_userdata('smebookcallid',$de->smebookcallid); 
					 $this->session->set_userdata('book_type',$de->book_type);  
					 $this->session->set_userdata('sme_userid',$id);
					 $this->session->set_userdata('paypackage_amt',$de->amount);
					 $this->session->set_userdata('order_id',$de->order_id);
				 $this->session->set_userdata('direct','yes');
			}
			else
			{
				
					$de = $this->Expert->getlivesessionde($id,$user);
					$this->session->set_userdata('chat_userid',$user); 
					 $this->session->set_userdata('smebookcallid',$de->smebookcallid); 
					 $this->session->set_userdata('book_type',$de->book_type);  
					 $this->session->set_userdata('sme_userid',$id);
					 $this->session->set_userdata('paypackage_amt',$de->amount);
					 $this->session->set_userdata('order_id',$de->order_id);
					 //echo $de->order_id; exit();
					 redirect('/experts/new_payment_checkout');
			}
		 }
		//$data['main_content'] = 'experts/experts_user_view'; 
		//$this->load->view('experts/includes/experts_template',$data);
		
		$data['main_content'] = 'experts/new_experts_user_view'; 
		$this->load->view('experts/includes/new_experts_template',$data);
    }
    
    public function dashboard() {
		/* if($this->session->userdata('country'))
	   {
		
	   }
	   else{
		  $this->session->set_userdata('country','india');
		$this->session->set_userdata('place','bangalore'); 
	   }*/
		if ($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme') {
		    $data['title']='zinguplife |  sme-dashboard';
	        $username = $this->session->userdata('username');
	        $sme_userid = $this->session->userdata('sme_userid');
			
	        //$data['user'] = $this->Expert->getalldetails($username);
	        $data['profile'] = $this->Expert->getprofile($sme_userid);
			
	        //START 2016-12017 by Alok Sharma
			 /** Making the change to keep Expertise as free flow text instead of dropdown
			    
	        $all_expertise_array = $this->Expert->get_all_expertise_for_user($sme_userid);
	        
	        foreach ($all_expertise_array as $key => $value) {
	        	$all_expertise_string .= ",$value->expertise_desc";
	        }
	        
	        $all_expertise_string = substr($all_expertise_string, 1); // remove leading ","
	        */
	        $data['livechat'] = $this->Expert->checkChatSchedule($sme_userid); // dev comment
	        $data['follow_cnt'] = $this->Expert->getfollowerscount($sme_userid);
	        $data['feedback'] = $this->Expert->getallfeedback($sme_userid);
	        $data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
	        $data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
	        $data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
	        $data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
	        $data['questions'] = $this->Expert->getallquestions($sme_userid);
	        $data['events'] = $this->Expert->getallevents($sme_userid);
			$data['added_slots'] = $this->Expert->getaddedslots2($sme_userid); // dev comment
			$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);// dev comment
			$data['user_booked_slots'] = $this->Expert->getuserbookedslots($sme_userid);// dev comment
	
	        $data['ansque'] = $this->Expert->getallansquestions($sme_userid);
	        $data['unansque'] = $this->Expert->getallunansquestions($sme_userid);
	        $data['articles'] = $this->Expert->getallarticles($sme_userid);
	        $data['fb_rating'] = $this->Expert->getrating($sme_userid);
	        $data['ur_questions'] = $this->Expert->geturgquestions($sme_userid);
	        $data['booked_calls'] = $this->Expert->getcalls($sme_userid);
	        $data['offset'] = 8;
	        $data['fboffset'] = 5;
	        $data['aroffset'] = 4;
	
	        
	        $data['bookedsmeslots'] = $this->Expert->getExpertSlots($sme_userid);
			$data['consultation'] = $this->Expert->getConsultationHistory($sme_userid);
			$data['payment'] = $this->Expert->getPaymentHistory($sme_userid);
			
	        
	        $data['main_content'] = 'experts/new_experts_sme_view';
	        $this->load->view('experts/includes/new_experts_template', $data);
		}
		else{
			 redirect("experts/login");
		}
    }    
    
    
    
    public function add_question() {
        $data = $this->input->post();
		$sme_userid = $data['smeuserid'];
		$this->session->set_userdata("smeuserid",$sme_userid);
		$this->session->set_userdata("question",$data['question']);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$emailfrom = $this->session->userdata("logged_in_user_data")->username;
		$name = $this->session->userdata("logged_in_user_data")->name;
		$smeuerdetails = $this->Expert->getsmedetails($sme_userid);
		$profile = $this->Expert->getprofile($sme_userid);
		
    }
    
    
		public function profile() {
		$data['title']='zinguplife | sme-edit-profile';
        $username = $this->session->userdata('username');
        $sme_userid = $this->session->userdata('sme_userid');
		$data['user'] = $this->Expert->getalldetails($username);
		$data['service']=$this->sme_user->getallmainservices();
		$user_details = $this->Expert->getalldetails($username);
		$country = $user_details->country;
		$state = $user_details->state;
		$data['smeuerdetails'] = $this->Expert->getsmedetails($sme_userid);
		$data['list'] =  $this->Utilitiesmodel->getCountry();
		$data['statelist'] =  $this->Utilitiesmodel->getStatelist($country);
		$data['citylist'] =  $this->Utilitiesmodel->getCitylist($state);
        $data['main_content'] = 'experts/sme_edit_profile';
		$this->load->view('experts/includes/experts_template', $data);
    }
    
    
    public function add_feedback() {
	    $data['title']='zinguplife | add-feedback';
		$data['userid']= $this->uri->segment(3);
		$id = $this->uri->segment(3);
		$data['profile'] = $this->Expert->getprofile($id);
		$data['added_slots'] = $this->Expert->getaddedslots($id);
		$data['blocked_slots'] = $this->Expert->getblockedslots($id);
        //$data['main_content'] = 'experts/add_feedback';
        //$this->load->view('experts/includes/experts_template', $data);
		
		$data['main_content'] = 'experts/new_add_feedback';
        $this->load->view('experts/includes/new_experts_template', $data);
    }
    
    
	 public function getpackages() {
		$data = $this->input->post();
		$check_user_paid = $this->sme_user->check_user_payment($data['smeuserid'],$data['userid']);
		//$check = $this->Expert->checkpackageexp($data['smeuserid'],$data['userid']);
		$smeuerdetails = $this->sme_user->getsmedetails($data['smeuserid']);
		//echo json_encode($check_user_paid); exit();
		if($check_user_paid != true)
		{
			$data['packages'] = $this->Expert->getallpackages(); 
		}
		else{
				$q_no = $this->sme_user->getq_no($data['trans']);
				if(count($q_no) !=0 )
						{
							$new_no = $q_no->no + 1;
							$package = array(
											'no'          => $new_no
										);
							$this->sme_user->update_user_question_no($package,$data['trans']);		
						}
						else{
							$package = array(
											'userid'         =>  $userid,
											'no'          => 1,
											'transaction_id' => $data['trans']
										);
							$this->sme_user->add_user_question_no($package);	
						}
					$array = array(
							'question'  =>  $data['question'],
							'sme_userid' => $data['smeuserid'],
							'status'      => 'urgent',
							'userid'      => $userid,
							'answer'      =>  ''
						);	
					$this->sme_user->add_question($array);
					
					/*to send  email*/
				$emailfrom = $this->session->userdata("logged_in_user_data")->username;
				$name = $this->session->userdata("logged_in_user_data")->name;
				$username = $smeuerdetails->username;
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from(	$emailfrom, $name);
				$this->email->to($username);
				$this->email->subject('User asked a Question');
				$this->email->message('Hello '.$smeuerdetails->first_name.'  '.$smeuerdetails->last_name.' 
				<br/><br/>
				A User have an urgent query. Please login to Zinguplife SME Portal answer the query within 24 hours of time
				<br/><br/><br/><br/>
				
				Regards<br/>
				Zingup Admin');
				$this->email->send();
				
				$data['packages'] = '';
				
				/* $messgae_to = '+91' . $profile->phone;
				$sms_content = 'testHello you have received an enquiry from the user :  ' . $name . ' expecting the reply within 24 hours. '
				. 'Please reply at the earliest';

				$this->mailing->send_sms($messgae_to, $sms_content);
					*/
					
		}
		  echo json_encode($data['packages']); 
		}
    
	public function check_userlogin() {
 	     $logged_in_user_details = $this->session->userdata('logged_in_user_data');
                                if (!empty($logged_in_user_details)) {
                                    $data['is_logged_in'] = $logged_in_user_details->is_logged_in;
                                } else {
                                    $data['is_logged_in'] = '';
                                }
                echo json_encode($data);                
                                
    }
	
	
public function update_profile() {
        $data = $this->input->post();
        $smeuser_id = $this->session->userdata('sme_userid');
        $username = $this->session->userdata('username');
        $data['user'] = $this->Expert->getalldetails($username);
        $data['service']=$this->sme_user->getallmainservices();
		$user_details = $this->Expert->getalldetails($username);
		$country = $user_details->country;
		$state = $user_details->state;
		$data['list'] =  $this->Utilitiesmodel->getCountry();
		$data['statelist'] =  $this->Utilitiesmodel->getStatelist($country);
		$data['citylist'] =  $this->Utilitiesmodel->getCitylist($state);
		$password = $this->input->post('password');
        $passconf = $this->input->post('passconf2');
        
	//form validation
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
		//$this->form_validation->set_rules('cert_edu', 'Education & Certificate', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'matches[passconf2]');
		$this->form_validation->set_rules('passconf2', 'Confirm Password', 'xss_clean');
		$this->form_validation->set_rules('callbk_time','Callback Time','xss_clean');
        $this->form_validation->set_rules('inperson_pricing','Inperson Pricing','numeric');
        $this->form_validation->set_rules('audio_pricing', 'Audio Pricing', 'numeric');
        $this->form_validation->set_rules('video_pricing', 'Video Pricing', 'numeric');
		$this->form_validation->set_rules('chat_pricing', 'Chat Pricing', 'numeric');
		$this->form_validation->set_rules('state_dropdown','State Dropdown','required');
		$this->form_validation->set_rules('city_dropdown','City Dropdown','required');
		$this->form_validation->set_rules('country_dropdown','Country Dropdown','required');
		//$this->form_validation->set_rules('start_date','Vacation start date','regex_match[^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])]');
		//$this->form_validation->set_rules('end_date','Vacation end date','');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|integer|min_length[10]');
		//($timestamp1>$timestamp2)? "$date1 is greater than the $date2": "$date2 is greater than the $date1";
		$vac_str_date = $this->input->post('start_date');
		$vac_end_date = $this->input->post('end_date');
	
		$str=strtotime($vac_str_date);
        $end=strtotime($vac_end_date);


        if ($this->form_validation->run() == FALSE) {
	    $data['errors']='Please enter field correctly';
	    $data['main_content'] = 'experts/sme_edit_profile';
	    $this->load->view('experts/includes/experts_template', $data);
        } elseif($str > $end) {
	     $data['errors']='Please enter field correctly';
	     $data['errordate']="end date must greater than start date";
	    $data['main_content'] = 'experts/sme_edit_profile';
	    $this->load->view('experts/includes/experts_template', $data);
	} else {
		$password = $this->input->post('password');
            if ($password != '') {
                $this->load->helper('phpass');
                $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
                $hash_password = $hasher->HashPassword($password);
                $data = array(
                    'password' => $hash_password
                );

                $this->Expert->update_password($smeuser_id, $data);
            }
	    
	    $vac_str_date = $this->input->post('start_date');
	    $vac_end_date = $this->input->post('end_date');
            
	    if($vac_str_date!='' && $vac_str_date!=''){
		
            $v_sd = date('Y-m-d', strtotime($vac_str_date));
            $v_ed = date('Y-m-d', strtotime($vac_end_date));
	    }
	    else{
		$v_sd =null;
		$v_ed =null;
	    }
                $profile_data = array(
		   			'cert_edu' 		=> $this->input->post('cert_edu'),
		    		'first_name' 	=> $this->input->post('first_name'),
                    'phone' 		=> $this->input->post('phonefull'),
                    'gender' 		=>  $this->input->post('gender'),
		    		'country' 		=>  $this->input->post('country_dropdown'),
                    'state' 		=> $this->input->post('state_dropdown'),
		    		'city' 			=> $this->input->post('city_dropdown'),
		    		'expertise' 	=> $this->input->post('expertise'),
                    'callback_time' => $this->input->post('callbk_time'),
                    'vac_start_date' => $v_sd,
                    'vac_end_date' 	=> $v_ed,
                    'about' 		=> $this->input->post('about'),
                    'chat_pricing' 	=> $this->input->post('chat_pricing'),
				    'video_pricing' => $this->input->post('video_pricing'),
				    'audio_pricing' => $this->input->post('audio_pricing'),
				    'inperson_pricing' => $this->input->post('inperson_pricing'),
		    
		    
                );
		$sme_data=array(
		  'title' => $this->input->post('title'),
		  'gender' => $this->input->post('gender'),
		);
		$service_data= array(
		    'offerings_id' => $this->input->post('service'),
		);

                $this->session->set_userdata(array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $user_details->last_name,
                    'username' => $user_details->username
                ));
	
	    $this->Expert->sme_service_update($service_data, $smeuser_id);
	    $this->Expert->sme_user_update($sme_data, $smeuser_id);
            $this->Expert->user_profile_update($profile_data, $smeuser_id);
            $this->session->set_flashdata('msg', 'Profile is updated Successfully');
            redirect('experts/profile');
        }
    }
    
    public function upload_sme_photo() {
    	 $smeuser_id = $this->session->userdata('sme_userid');
 	      if ($_FILES['sme_photo']['name'] != '') {
                $config['upload_path'] = './sme_users/' . $smeuser_id;
				
				if (!is_dir('sme_users/' . $smeuser_id)) {
    				mkdir('./sme_users/' . $smeuser_id, 0777, true);
    			}
				
                $config['allowed_types'] = 'png|jpeg|jpg|PNG|JPEG|JPG';
                $this->load->library('upload', $config);
                $this->upload->do_upload('sme_photo');
                $upload_data21 = $this->upload->data();
                $sme_image = $upload_data21['file_name'];

                $profile_data = array(
                    'photo' => $sme_image
                );
                $this->Expert->user_profile_update($profile_data, $smeuser_id);
                 $this->session->set_userdata('photo',$sme_image);
                $this->session->set_flashdata('upload_photo_msg', 'Uploaded Successfully !!');
                redirect('experts/profile');
            }
            else{
            	$this->session->set_flashdata('failure_photo_msg', 'No image is selected !!');
                redirect('experts/profile');
            	}
    }
    
    
    public function upload_dashbaord_photo() {
    	 $smeuser_id = $this->session->userdata('sme_userid');
 	      if ($_FILES['sme_photo']['name'] != '') {
                $config['upload_path'] = './sme_users/' . $smeuser_id;
                $config['allowed_types'] = 'png|jpeg|jpg|PNG|JPEG|JPG';
                $this->load->library('upload', $config);
                $this->upload->do_upload('sme_photo');
                $upload_data21 = $this->upload->data();
                $sme_image = $upload_data21['file_name'];

                $profile_data = array(
                    'photo' => $sme_image
                );
                $this->Expert->user_profile_update($profile_data, $smeuser_id);
                 $this->session->set_userdata('photo',$sme_image);
                $this->session->set_flashdata('upload_photo_msg', 'Uploaded Successfully !!');
                redirect('experts/dashboard');
            }
            else{
            	$this->session->set_flashdata('failure_photo_msg', 'No image is selected !!');
                redirect('experts/dashboard');
            	}
    }
    
    
    public function get_available_dates() {
 	    $data = $this->input->post(); 
      $data['availability'] = $this->Expert->getavailabledates($data); 
 	  echo json_encode($data['availability']);
    }
    
     public function user_booked_calls() {
 	    $data = $this->input->post();
 	     $userid = $this->session->userdata("logged_in_user_data")->user_id;
 	     $user_details = $this->Expert->getUserEmail($userid);
 	     $smeuser_details = $this->Expert->getSmeEmail($data['id']);
      //$data['book_call'] = $this->Expert->insertbookedcalls($data,$userid); 
      
   
      /* to send  email */
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $this->email->from('admin@zinguplife.com', 'Zingup Support');
                $this->email->to($user_details->username);
                $this->email->subject('Your appointment is confirmed! '.$data['date'].' at '.$data['time'].'');
                $this->email->message('Hello ' . $user_details->name . '
				<br/><br/>
				Dear ‘<?php echo $user_details->username; ?>’
               <p>Thanks for scheduling with ZingUpLife! This email confirms your '.$data['time'].' appointment scheduled at '.$data['time'].'  on '.$data['date'].'</p>
		       <p>You may use the following link to view your appointment details, and login to your account prior to the scheduled slot: <a href=‘https://zinguplife.com/login’>https://zinguplife.com/login</a></p>
               <p>You may reschedule or cancel your appointment up to'.$data['time'].' before the appointment start time at this link: <a href=https://zinguplife.com/experts/home>https://zinguplife.com/experts/home</a></p>
		       <p>Also, do note that your appointment will auto-lapse if you are not logged in within 10 minutes of scheduled time – this may lead to a cancellation fee.</p>
               <p>If there’s anything we can help you with, simply drop in a line at <a href="mailto:support@zinguplife.com">support@zinguplife.com</a>, or call us at +91 98181 13345.</p>
               <p>
		       Best wishes,<br/></p>
			   <p>
               Team ZingUpLife
		       </p>
			   <br/><br/>
			   ');
                $this->email->send();
				
		 /* to send  email */
			$this->email->set_newline("\r\n");
			$this->email->set_mailtype("html");
			$this->email->from('admin@zinguplife.com', 'Zingup Support');
			$this->email->to($smeuser_details->username);
			$this->email->subject('Your appointment is confirmed! '.$data['date'].' at '.$data['time'].'');
			$this->email->message('Hello ' . $smeuser_details->first_name . ' ' . $smeuser_details->last_name . '
			<br/><br/>
			Dear ‘<?php echo $user_details->username; ?>’
            <p>Thanks for scheduling with ZingUpLife! This email confirms your '.$data['time'].' appointment scheduled at '.$data['time'].'  on '.$data['date'].'</p>
		    <p>You may use the following link to view your appointment details, and login to your account prior to the scheduled slot: <a href=‘https://zinguplife.com/login’>https://zinguplife.com/login</a></p>
            <p>You may reschedule or cancel your appointment up to'.$data['time'].' before the appointment start time at this link: <a href=https://zinguplife.com/experts/home>https://zinguplife.com/experts/home</a></p>
			<p>Also, do note that your appointment will auto-lapse if you are not logged in within 10 minutes of scheduled time – this may lead to a cancellation fee.</p>
            <p>If there’s anything we can help you with, simply drop in a line at <a href="mailto:support@zinguplife.com">support@zinguplife.com</a>, or call us at +91 98181 13345.</p>
            <p>
		    Best wishes,<br/></p>
			<p>
            Team ZingUpLife
		    </p>
			<br/><br/>
			');
			$this->email->send();
      
 	  echo json_encode($data['book_call']);
    }


 public function feedback_publish() {
 	    $data = $this->input->post();
 	    $inserdata = array('sme_userid'=>$data['smeuserid'],
 	                        'subject'=>$data['subject'],
 	                        'feedback'=>$data['feedback'],
 	                        'userid'=>$data['userid'],
 	                        'fb_score'=>$data['score'] 
 	                     );
      $data['fb'] = $this->Expert->add_user_feedback($inserdata); 
 	  $this->session->set_flashdata('feedback_success_msg', 'Feedback Added Successfully !!');
      //redirect('experts/add_feedback/'.$data['smeuserid']);
	  redirect('experts/user/'.$data['smeuserid']);
    }
    
    


public function sort_questions_by_dates() {
 	    $data = $this->input->post();
 	     $userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['questions'] = $this->Expert->sort_questions_by_dates($data,$userid);
		if($data['questions'] != ''){
       	 if($this->session->userdata('sme_userid') !=''){
           $data=$this->load->view('experts/sme_questions_by_date',$data, TRUE);
           }else{
           	$data=$this->load->view('experts/questions_by_date',$data, TRUE);
           	}

		 echo json_encode($data);
         } 
    }
	
	public function sort_articles_by_dates()
	{
		$data = $this->input->post();
 	     $userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['articles'] = $this->Expert->sort_articles_by_dates($data['sortdate'],$data['id']);
		if($data['articles'] != ''){
       	 if($this->session->userdata('sme_userid') !=''){
           $data=$this->load->view('experts/sme_articles_by_date',$data, TRUE);
           }else{
           	$data=$this->load->view('experts/sme_articles_by_date',$data, TRUE);
           	}

		 echo json_encode($data);
         } 
	}
    
  public function followers()
	{
		$data['title']='zinguplife | followers';
		$sme_userid = $this->uri->segment(3);
		$data['profile'] = $this->Expert->getprofile($sme_userid);
		$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
		$data['followers'] = $this->Expert->getallfollowers($sme_userid);
		$data['offset'] = 8;
		$data['main_content'] = 'experts/followers';
		$this->load->view('experts/includes/experts_template',$data);
	} 
	
	public function expert_followers()
	{
		$data['title']='zinguplife | followers';
		$sme_userid = $this->session->userdata('sme_userid');
		$data['profile'] = $this->Expert->getprofile($sme_userid);
		$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
		$data['followers'] = $this->Expert->getallfollowers($sme_userid);
		$data['offset'] = 8;
		$data['main_content'] = 'experts/followers';
		$this->load->view('experts/includes/experts_template',$data);
	} 
	
	
	public function followers_loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['followers']  = $this->Expert->getfollowersdata($offset,$limit,$sme_userid);
		$data['offset'] =$offset+8;
		$data['limit'] =$limit;
		
			$data=$this->load->view('sme_user_followers_load_more',$data, TRUE);
		
		$this->output->set_output($data); 
		
	} 
	
	public function allfeedback()
	{
		 $data['title']='zinguplife | All Feedbacks';
		 if($this->session->userdata('type') == 'sme')
		 {
			$data['smeuserid']=$sme_userid = $this->session->userdata('sme_userid');
		 }
		 else{
			$data['smeuserid']=$sme_userid = $this->uri->segment(3); 
		 }
		$data['profile'] = $this->Expert->getprofile($sme_userid);
		$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
		$data['feedback'] = $this->Expert->getallfeedback($sme_userid);
		$data['offset'] = 5;
		$data['main_content'] = 'experts/all_feedback';
		$this->load->view('experts/includes/experts_template',$data);
	} 
	
	
        
    public function insert_session_amount()
	{
		 $data = $this->input->post();
 	     $data['amt'] = $this->session->set_userdata("package_amt",$data['sme_amt']); 
 	  echo json_encode($data['amt']);
	}
	
	
        
	public function checkout()
	{
		$data['title']='zinguplife | Checkout';
		$sme_userid = $this->session->userdata('sme_userid');
		$data['sme_userid'] = $sme_userid;
		$data['amount'] = $this->session->userdata('package_amt');
		$this->session->unset_userdata('package_amt');
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$data['user'] = $this->session->userdata("logged_in_user_data");

		$data['profile'] = $this->Expert->getprofile($sme_userid);
		$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
		$data['fb_rating'] = $this->Expert->getrating($sme_userid);
		$data['rating_total'] = $this->Expert->getratingtot($sme_userid);
		$data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
		$data['feedback'] =$this->Expert->getallfeedback($sme_userid);
		$data['articles'] = $this->Expert->getallarticles($sme_userid);
		//$data['questions'] = $this->Expert->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['follow_cnt'] = $this->Expert->getfollowcnt($sme_userid);
		$data['following'] =  $this->Expert->checkfollow($userid,$sme_userid);
		$data['packages'] = $this->Expert->getallpackages();
		$data['user_detail'] = $this->Expert->getuserdetails($userid);
		$data['main_content'] = 'experts/checkout';
		$this->load->view('experts/includes/experts_template',$data);	
	}
	
	
	
        
        
        public function payment()
	{
                 
		$data['title']='zinguplife | payment';
		$data = $this->input->post();
		
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$prefix = 'ORD';
        $order_id = $prefix . uniqid();
        
		$data['order_id'] = $order_id;
		$this->Expert->create_order($order_id);
		$data['amount'] = $data['amount'];
		$data['logged_in_user_details'] = $this->session->userdata("logged_in_user_data");
		$data['main_content'] = 'experts/payment';
		$this->load->view('experts/includes/experts_template',$data);	
	}
	
	public function call_payment()
	{
                 
		$data['title']='zinguplife | payment';
		$data = $this->input->post();
		
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$prefix = 'ORD';
        $order_id = $prefix . uniqid();
        
		$data['order_id'] = $order_id;
		$this->Expert->create_pay_order($order_id);
		$data['amount'] = $data['amount'];
		$data['logged_in_user_details'] = $this->session->userdata("logged_in_user_data");
		$data['main_content'] = 'experts/call_payment';
		$this->load->view('experts/includes/experts_template',$data);	
	}
		
        
    public function payment_process() {
         $data['title']='zinguplife | payment process';
        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        $data['main_content'] = 'experts/payment_process';
        $this->load->view('experts/includes/experts_template', $data);
    }
    
    
    
    public function payment_success() {
                $data['title']='zinguplife | payment success';
		$sme_userid = $this->session->userdata('sme_userid'); 
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		$userid = $logged_in_user_details->user_id;
		
		$data['profile'] = $this->Expert->getprofile($sme_userid);
		$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
		$profile = $this->Expert->getprofile($sme_userid);
		$data['fb_rating'] = $this->Expert->getrating($sme_userid);
		$data['rating_total'] = $this->Expert->getratingtot($sme_userid);
		$data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
		$data['feedback'] =$this->Expert->getallfeedback($sme_userid);
		$data['articles'] = $this->Expert->getallarticles($sme_userid);
		//$data['questions'] = $this->Expert->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['follow_cnt'] = $this->Expert->getfollowcnt($sme_userid);
		$data['following'] =  $this->Expert->checkfollow($userid,$sme_userid);
		$smeuerdetails = $this->Expert->getsmedetails($sme_userid);
		$data['user_detail'] = $this->Expert->getuserdetails($userid);
		
        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        $workingKey = '3C095C0C179A18E2823E067C3D17CE98';  //orginal Working Key.
        //$workingKey = '79AAB7ED2DAB322205432E3FB981231A';  //test Working Key.
		
		//$workingKey = '79AAB7ED2DAB322205432E3FB981231A';
        $encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server
        $rcvdString = decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        //echo '<pre>'; print_r($decryptValues);  exit();
        $dataSize = sizeof($decryptValues);

		      
       $data['transaction_response'] = $decryptValues; 
       
       $orderid = explode('=', $decryptValues[0]);
		
   

        $transaction_id_array = explode('=', $decryptValues[1]);
		$transaction_payment_array = explode('=', $decryptValues[5]);
		$transaction_amount = explode('=', $decryptValues[10]);
        
        $data['transaction_id'] = $transaction_id_array[1];
		$data['payment_mode'] = $transaction_payment_array[1];
		$data['amount'] = $transaction_amount[1];

		$payment_array = array('package_id' => 1,
								'transaction_id'  => $data['transaction_id'],
								'transaction_status'  => 'Success',
								'transaction_date'    =>  date('Y-m-d H:i:s'),
								'paid_by' => $this->session->userdata("logged_in_user_data")->user_id,
								'payment_mode' => $data['payment_mode'],
								'amount'       => $data['amount'],
								'amount_paid'       => $data['amount'],
							  );
		$this->Expert->insert_payment_details($payment_array,$orderid[1]);
		$questions_asked = array(
							'userid'   =>   $userid,
							'transaction_id'  => $data['transaction_id'],
							'no'              => 1	
		);
		$this->Expert->add_user_question_no($questions_asked);
		$array = array(
							'question'  =>  $this->session->userdata('question'),
							'sme_userid' => $sme_userid,
							'status'      => 'urgent',
							'userid'      => $userid,
							'answer'      =>  ''
						);
		$this->Expert->add_question($array);
		
		/*to send  email*/
			$emailfrom = $this->session->userdata("logged_in_user_details")->username;
			$name = $this->session->userdata("logged_in_user_details")->name;
			$username = $smeuerdetails->username;
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from(	$emailfrom, $name);
				$this->email->to($username);
				$this->email->subject('User asked a Question');
				$this->email->message('Hello '.$smeuerdetails->first_name.'  '.$smeuerdetails->last_name.' 
				<br/><br/>
				A User have an urgent query. Please login to Zinguplife SME Portal answer the query within 24 hours of time
				<br/><br/><br/><br/>
				
				Regards<br/>
				Zingup Admin');
				$this->email->send();
				//echo 'send';
				//$data['main_content'] = 'experts/checkout';
				//$this->load->view('experts/includes/experts_template',$data);	
				//$this->session->set_flashdata('msg', 'Question is added successfully');
               // redirect('experts');
				
				/* $messgae_to = '+91' . $profile->phone;
					$sms_content = 'testHello you have received an enquiry from the user :  ' . $name . ' expecting the reply within 24 hours. '
                    . 'Please reply at the earliest';
 
					$this->mailing->send_sms($messgae_to, $sms_content);*/
			
				//$this->session->set_flashdata('msg', 'Question is added successfully');
              //  redirect('experts/user/'.$this->session->userdata("sme_userid"));
				//$this->session->set_flashdata('msg', 'Question is added successfully');
				//redirect('questions/ask/'.$this->session->userdata("smeuserid"));
				
		$data['title']='zinguplife | User-sme-view';
        $data['userid']=$id = $this->session->userdata("sme_userid");
		$data['profile'] = $this->Expert->getprofile($id);
		$data['added_slots'] = $this->Expert->getaddedslots($id);
		$data['blocked_slots'] = $this->Expert->getblockedslots($id);
		$data['follow_cnt'] = $this->Expert->getfollowcnt($id);
		$data['feedback'] =$this->Expert->getallfeedback($id);
		$data['questions'] = $this->Expert->getallansquestions($id);
		$data['events'] = $this->Expert->getallevents($id);
		$data['fb_rating'] = $this->Expert->getrating($id);
		$data['rating_total'] = $this->Expert->getratingtot($id);
		$data['pos_fb'] = $this->Expert->get_pos_fb($id);
		$data['neu_fb'] = $this->Expert->get_neu_fb($id);
		$data['neg_fb'] = $this->Expert->get_neg_fb($id);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($id);
		$data['articles'] = $this->Expert->getallarticles($id);
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		 if (!empty($logged_in_user_details)) {
        $data['is_logged_in'] = $logged_in_user_details->is_logged_in;
        } else {
        $data['is_logged_in'] = '';
        }
		$data['offset'] = 8;
		$data['fboffset'] = 5;
		$data['aroffset'] = 4;

		$user = $data['user'] = $logged_in_user_details->user_id;
		$data['calls'] = $this->Expert->getuserca($user,$data['userid']);
		$data['transaction_id'] = $this->sme_user->gettrans($user);
		$data['submitted'] = 'Question is submitted successfully';
		$data['main_content'] = 'experts/experts_user_view'; 
		$this->load->view('experts/includes/experts_template',$data);


    }
    
   
	
	/* Above function ends here */

    public function payment_canceled() {
        $data['title']='zinguplife | payment canceled'; 
        $data['main_content'] = 'experts/payment_cancel';
        $this->load->view('experts/includes/experts_template', $data);
    }
    
     public function getquestions() {
         $data = $this->input->post();
         $data['questions'] = $this->Expert->getquestions($data);
         if($data['questions'] != ''){
           $data=$this->load->view('experts/questions_search',$data, TRUE);

		 echo json_encode($data);
         }
    }
    
    
    public function sme_reply() {
    	 $data['title']='zinguplife | Sme Reply';
    	  $data['quesid']= $this->uri->segment(3);
    	  $data['sme_userid'] = $sme_userid = $this->session->userdata('sme_userid');
    	  $data['profile'] = $this->Expert->getprofile($sme_userid);
		  $data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
        $data['follow_cnt'] = $this->Expert->getfollowerscount($sme_userid);
        $data['feedback'] = $this->Expert->getallfeedback($sme_userid);
        $data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
        $data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
        $data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
        $data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
        $data['events'] = $this->Expert->getallevents($sme_userid);

        $data['ansque'] = $this->Expert->getallansquestions($sme_userid);
        $data['unansque'] = $this->Expert->getallunansquestions($sme_userid);
        $data['articles'] = $this->Expert->getallarticles($sme_userid);
        $data['fb_rating'] = $this->Expert->getrating($sme_userid);
        $data['ur_questions'] = $this->Expert->geturgquestions($sme_userid);
        $data['booked_calls'] = $this->Expert->getcalls($sme_userid);
    	  $data['questions'] = $this->Expert->getquestions_reply($data['quesid']);
        $data['main_content'] = 'experts/experts_sme_reply';
        $this->load->view('experts/includes/experts_template', $data);
    }
	
	public function feedback_reply()
	{
		$data['title']='zinguplife | Sme Reply';
    	  $data['quesid']= $this->uri->segment(3);
    	  $data['sme_userid'] = $sme_userid = $this->session->userdata('sme_userid');
    	  $data['profile'] = $this->Expert->getprofile($sme_userid);
		  $data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
        $data['follow_cnt'] = $this->Expert->getfollowerscount($sme_userid);
        $data['feedback'] = $this->Expert->getallfeedback($sme_userid);
        $data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
        $data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
        $data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
        $data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
        $data['events'] = $this->Expert->getallevents($sme_userid);

        $data['ansque'] = $this->Expert->getallansquestions($sme_userid);
        $data['unansque'] = $this->Expert->getallunansquestions($sme_userid);
        $data['articles'] = $this->Expert->getallarticles($sme_userid);
        $data['fb_rating'] = $this->Expert->getrating($sme_userid);
        $data['ur_questions'] = $this->Expert->geturgquestions($sme_userid);
        $data['booked_calls'] = $this->Expert->getcalls($sme_userid);
    	  $data['questions'] = $this->Expert->getfb_reply($data['quesid']);
        $data['main_content'] = 'experts/experts_feedback_sme_reply';
        $this->load->view('experts/includes/experts_template', $data);
	}
	
	public function insert_fb_sme_reply() {
    	  $data = $this->input->post();
     	  $insertdata =array('fb_id'=>$data['quesid'],
    	                     'comment'=>$data['answer'],
    	                     'userid'=>$data['userid']
    	  );
    	  $data['result'] = $this->Expert->insert_fb_sme_reply($insertdata);
    	  $this->session->set_flashdata('msg', 'Reply is added successfully');
    	  redirect('/experts/dashboard');
    }
    
    
     public function insert_sme_reply() {
    	  $data = $this->input->post();
     	  $insertdata =array('qid'=>$data['quesid'],
    	                     'comment'=>$data['answer'],
    	                     'userid'=>$data['userid']
    	  );
    	  $data['result'] = $this->Expert->insert_sme_reply($insertdata);
    	  $this->session->set_flashdata('msg', 'Reply is added successfully');
    	  redirect('/experts/dashboard');
    }
    
    public function article_detail() {
    	 $data['title']='zinguplife | Sme Article Details';
    	  $data['articleid']= $this->uri->segment(3);
		  $data['userid'] = $this->session->userdata("logged_in_user_data")->user_id;
    	  $data['sme_userid'] = $sme_userid = $this->session->userdata('sme_userid');
    	  $data['profile'] = $this->Expert->getprofile($sme_userid);
		  $data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
        $data['follow_cnt'] = $this->Expert->getfollowerscount($sme_userid);
        $data['feedback'] = $this->Expert->getallfeedback($sme_userid);
        $data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
        $data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
        $data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
        $data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
        $data['events'] = $this->Expert->getallevents($sme_userid);

        $data['ansque'] = $this->Expert->getallansquestions($sme_userid);
        $data['unansque'] = $this->Expert->getallunansquestions($sme_userid);
        $data['articles'] = $this->Expert->getallarticles($sme_userid);
        $data['fb_rating'] = $this->Expert->getrating($sme_userid);
        $data['ur_questions'] = $this->Expert->geturgquestions($sme_userid);
        $data['booked_calls'] = $this->Expert->getcalls($sme_userid);
		$data['article'] = $this->Expert->getarticle($data['articleid'],$data['userid']);
    	 $data['recent_articles'] = $this->Expert->getarticle_detail($data['articleid']);
		 $data['offset'] = 5;
        $data['main_content'] = 'experts/experts_articles_detail';
        $this->load->view('experts/includes/experts_template', $data);
    }
    
    public function answers() {
    	 $data['title']='zinguplife | Sme Answers ';
    	  $data['quesid']= $this->uri->segment(3);
    	    $data['userid']=$id = $this->uri->segment(4);
		  $data['smeuserid'] = $this->uri->segment(4);
		  $sme_userid = $this->session->userdata('sme_userid');
		$data['profile'] = $this->Expert->getprofile($id);
		$data['added_slots'] = $this->Expert->getaddedslots($id);
		$data['blocked_slots'] = $this->Expert->getblockedslots($id);
		$data['follow_cnt'] = $this->Expert->getfollowcnt($id);
		$data['feedback'] =$this->Expert->getallfeedback($id);
		$data['questions'] = $this->Expert->getallansquestions($id);
		$data['events'] = $this->Expert->getallevents($id);
		$data['fb_rating'] = $this->Expert->getrating($id);
		$data['rating_total'] = $this->Expert->getratingtot($id);
		$data['pos_fb'] = $this->Expert->get_pos_fb($id);
		$data['neu_fb'] = $this->Expert->get_neu_fb($id);
		$data['neg_fb'] = $this->Expert->get_neg_fb($id);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($id);
		$data['articles'] = $this->Expert->getallarticles($id);
		$data['offset'] = 8;
		$data['fboffset'] = 5;
		$data['aroffset'] = 4;
    	  $data['answers'] = $this->Expert->getanswers($data['quesid']);
        $data['main_content'] = 'experts/experts_answer';
        $this->load->view('experts/includes/experts_template', $data);
    }
    
    
    
    
    
    
    
    public function insert_sme_article() {
    	  $data = $this->input->post();
$insertdata =array('sme_userid'=>$data['sme_userid'],
    	                     'heading'=>$data['article_title'],
    	                     'content'=>$data['article_description']
    	  );
           $articleid= $this->Expert->insert_sme_article($insertdata);   
    	   if ($_FILES['article_image']['name'] != '') {
    	   	
                $config['upload_path'] = './sme_users/articles/'. $articleid;
                if (!is_dir('./sme_users/articles/' . $articleid))
				{
					mkdir('./sme_users/articles/' . $articleid, 0777, true);
				}
                $config['allowed_types'] = 'png|jpeg|jpg|PNG|JPEG|JPG';
                $this->load->library('upload', $config);
                $this->upload->do_upload('article_image');
                $upload_data21 = $this->upload->data();
                $article_image = $upload_data21['file_name'];
                $image_data = array(
                    'photo' => $article_image
                );
            }
            $this->Expert->update_articles_image($image_data,$articleid);
  
            $this->session->set_flashdata('msg', 'Article is added successfully');
			redirect('experts/dashboard');
    	  
    }
		
	/**newly added */
	public function articles()
	{
		$data['title']='zinguplife | Sme-Articles';
		$sme_userid = $this->session->userdata('sme_userid');
		$data['profile'] = $this->Expert->getprofile($sme_userid);
		$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
		$data['articles'] = $this->Expert->getallarticles($sme_userid);
		$data['fb_rating'] = $this->Expert->getrating($sme_userid);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
		$data['follow_cnt'] = $this->Expert->getfollowerscount($sme_userid);
		$data['offset'] = 8;
		$data['main_content'] = 'experts/experts_articles';
		$this->load->view('experts/includes/experts_template', $data);
	}
	
	public function viewarticles()
	{
		$data['title']='zinguplife | Sme-Articles';
		$sme_userid = $this->session->userdata('sme_userid');
		$data['profile'] = $this->Expert->getprofile($sme_userid);
		$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
		$data['articles'] = $this->Expert->getallarticles($sme_userid);
		$data['fb_rating'] = $this->Expert->getrating($sme_userid);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
		$data['follow_cnt'] = $this->Expert->getfollowerscount($sme_userid);
		$data['offset'] = 8;
		$data['main_content'] = 'experts/experts_view_articles';
		$this->load->view('experts/includes/experts_template', $data);
	}
	
	/**newly added */
	
	public function allevents()
	{
	$data['title']='zinguplife | Sme-Events';
	$sme_userid = $this->session->userdata('sme_userid');
	$data['follow_cnt'] = $this->Expert->getfollowerscount($sme_userid);
	 $data['profile'] = $this->Expert->getprofile($sme_userid);

        $data['feedback'] = $this->Expert->getallfeedback($sme_userid);
        $data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
        $data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
        $data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
        $data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
        $data['questions'] = $this->Expert->getallquestions($sme_userid);
        $data['events'] = $this->Expert->getallevents($sme_userid);

        $data['ansque'] = $this->Expert->getallansquestions($sme_userid);
        $data['unansque'] = $this->Expert->getallunansquestions($sme_userid);
        $data['articles'] = $this->Expert->getallarticles($sme_userid);
        $data['fb_rating'] = $this->Expert->getrating($sme_userid);
        $data['ur_questions'] = $this->Expert->geturgquestions($sme_userid);
        $data['booked_calls'] = $this->Expert->getcalls($sme_userid);
	$data['booked_calls'] = $this->Expert->getcalls($sme_userid);
	$data['profile'] = $this->Expert->getprofile($sme_userid);
	$data['events'] = $this->Expert->getallevents($sme_userid);
	$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
	$data['profile'] = $this->Expert->getprofile($sme_userid);
	$data['main_content'] = 'experts/experts_events';
		$this->load->view('experts/includes/experts_template', $data);
	}
	
	
	public function bookedcalls()
	{
	$data['title']='zinguplife | Sme-Booked Calls';
	$sme_userid = $this->session->userdata('sme_userid');
	$data['follow_cnt'] = $this->Expert->getfollowerscount($sme_userid);
	 $data['profile'] = $this->Expert->getprofile($sme_userid);
	 $data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);

        $data['feedback'] = $this->Expert->getallfeedback($sme_userid);
        $data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
        $data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
        $data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
        $data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
        $data['questions'] = $this->Expert->getallquestions($sme_userid);
        $data['events'] = $this->Expert->getallevents($sme_userid);

        $data['ansque'] = $this->Expert->getallansquestions($sme_userid);
        $data['unansque'] = $this->Expert->getallunansquestions($sme_userid);
        $data['articles'] = $this->Expert->getallarticles($sme_userid);
        $data['fb_rating'] = $this->Expert->getrating($sme_userid);
        $data['ur_questions'] = $this->Expert->geturgquestions($sme_userid);
        $data['booked_calls'] = $this->Expert->getcalls($sme_userid);
	$data['booked_calls'] = $this->Expert->getcalls($sme_userid);
	$data['profile'] = $this->Expert->getprofile($sme_userid);
	$data['main_content'] = 'experts/experts_bookedcalls';
		$this->load->view('experts/includes/experts_template', $data);
	}
	
	
public function allquestions()
	{
	$data['title']='zinguplife | Sme-All Questions';
	
	$sme_userid = $this->session->userdata('sme_userid');
	$data['questions'] = $this->Expert->getallquestions($sme_userid);
	$data['profile'] = $this->Expert->getprofile($sme_userid);
	$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
	$data['offset'] = 5;
	$data['main_content'] = 'experts/experts_allquestions';
		$this->load->view('experts/includes/experts_template', $data);
	}
	

	public function feedback_loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['feedback']  = $this->Expert->getfeedbackdata($offset,$limit,$sme_userid);
		$data['offset'] =$offset+5;
		$data['limit'] =$limit;
		$data=$this->load->view('experts/user_feedback_load_more',$data, TRUE);

		$this->output->set_output($data); 
		
	}
	
	public function get_questions()
	{
		$data = $this->input->post();
		$data['questions'] = $this->Expert->get_questions($data['ques'],$data['id']);
		if($data['questions'] != ''){
       	 if($this->session->userdata('sme_userid') !=''){
           $data=$this->load->view('experts/sme_questions_by_date',$data, TRUE);
           }else{
           	$data=$this->load->view('experts/questions_by_date',$data, TRUE);
           	}

		 echo json_encode($data);
         } 
	}
	
	public function questions_loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$type = $this->input->get('type');
		$data['sme_userid'] = $sme_userid;
		if($type == 'all') 
		{
			$data['questions']  = $this->sme_user->getquestionsdata($offset,$limit,$sme_userid);
		}
		else if($type == 'unanswered') 
		{
			$data['questions']  = $this->sme_user->getunquestionsdata($offset,$limit,$sme_userid);
		}
		else if($type == 'answered') 
		{
			$data['questions']  = $this->sme_user->getanquestionsdata($offset,$limit,$sme_userid);
		}
		else if($type == 'expedited') 
		{
			$data['questions']  = $this->sme_user->geturgquestionsdata($offset,$limit,$sme_userid);
		}
		$data['offset'] =$offset+5;
		$data['limit'] =$limit;
		$data=$this->load->view('experts/user_question_load_more',$data, TRUE);

		$this->output->set_output($data); 
		
	}
	 
	public function sme_article_loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['articles']  = $this->sme_user->getsmearticles($offset,$limit,$sme_userid);
		$data['offset'] =$offset+4;
		$data['limit'] =$limit;
		$data=$this->load->view('experts/sme_articles_load_more',$data, TRUE);

		$this->output->set_output($data); 
	}
	
	public function follow()
	{
		$data = $this->input->post();
		$sme_userid = $data['expert'];
		$userid =$data['user'];
		
		$id = $this->Expert->sme_follow($userid,$sme_userid);
		echo json_encode($id);

	}
	
	public function unfollow()
	{
		$data = $this->input->post();
		$followid = $data['follow_id'];
		$this->Expert->removefollow($followid);
		
		echo json_encode(true);

		//$this->sme_user->sme_follow($userid,$sme_userid);
		//$this->session->set_flashdata('followmsg', 'Following');
		//redirect('sme_home/user/'.$sme_userid);
		
	}
	
	public function article_like()
	{
		$data = $this->input->post();
		$ar_id = $data['article_id'];
		$userid = $data['userid'];
		
		$id = $this->Expert->article_like($ar_id,$userid);
		echo json_encode(true);
	}
	
	public function article_unlike()
	{
		$data = $this->input->post();
		$ar_id = $data['article_id'];
		$userid = $data['userid'];
		
		$id = $this->Expert->article_unlike($ar_id,$userid);
		echo json_encode(true);
	}
	
	public function add_article_comment()
	{
		$arid = $this->input->post('ar_id');
		$smeuser_id = $this->input->post('smeuser_id');
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$comment = $this->input->post('comment');
		$data = array(
				'article_id'  => $arid,
				'userid'    => $userid,
				'comment'  => $comment
				);
		$this->Expert->add_article_comment($data);

		redirect('experts/article_detail/'.$arid.'/'.$smeuser_id);
	} 
	
	public function articles_loadmore()
	{
		$art_id = $this->input->get('art_id');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['comments']  = $this->Expert->getartcomments($offset,$limit,$art_id);
		$data['offset'] =$offset+5;
		$data['limit'] =$limit;
		$data=$this->load->view('experts/article_comments_load_more',$data, TRUE);

		$this->output->set_output($data); 
	}
	
	public function search()
	{
		$location = $this->input->post('location');		
		$tab = $this->input->post('tab');		if($tab == 'POPULAR EXPERTS')		
		{			$tab = 0;		}		
		else if($tab == 'MIND BODY INTERVENTIONS')		
		{			$tab = 1;		}		else if($tab == 'YOGA')		{			$tab = 3;		}		else if($tab == 'INTEGRATIVE HEALTH & MEDICINE')		{			$tab = 2;		}		
		else if($tab == 'PHYSICAL & NUTRITIONAL')		{			$tab = 4;		}		
	$data['sme_users'] = $this->Expert->searchExpert($location,$tab);				$data=$this->load->view('experts/experts_search',$data, TRUE);		$this->output->set_output($data); 
	}		
	
	
	public function search2()	{		$location = $this->input->post('location');		$tab = $this->input->post('tab');		
	if($tab == 'POPULAR EXPERTS')		
		{			$tab = 0;		}		
		else if($tab == 'MIND BODY INTERVENTIONS')		
		{			$tab = 1;		}		else if($tab == 'YOGA')		{			$tab = 3;		}		else if($tab == 'INTEGRATIVE HEALTH & MEDICINE')		{			$tab = 2;		}		
		else if($tab == 'PHYSICAL & NUTRITIONAL')		{			$tab = 4;		}			
	$data['sme_users'] = $this->Expert->searchExpert($location,$tab);				$data=$this->load->view('experts/new_experts_search',$data, TRUE);		$this->output->set_output($data); 	}
	
	
	public function listi()
	{	
		$tab = $this->input->post('tab');		
		if($tab == 'POPULAR EXPERTS')		
		{			$tab = 0;		}		
		else if($tab == 'MIND BODY INTERVENTIONS')		
		{			$tab = 1;		}		else if($tab == 'YOGA')		{			$tab = 3;		}		else if($tab == 'INTEGRATIVE HEALTH & MEDICINE')		{			$tab = 2;		}		
		else if($tab == 'PHYSICAL & NUTRITIONAL')		{			$tab = 4;		}		
		$data['sme_users'] = $this->Expert->searchExpert2($tab);				
		$data=$this->load->view('experts/new_experts_search',$data, TRUE);		
		$this->output->set_output($data); 
	}
	
	
	
	
	public function check_slot()
	{
		$data = $this->input->post();
		$smeuserid = $data['smeuserid'];
		$res = $this->Expert->checkSlot($data['seldate'],$smeuserid);
		echo json_encode($res);
	}
	
	public function block_slot()
	{
		$data = $this->input->post();
		$dat = $data['arr'];
		if(sizeof($dat) > 1 )
		{
			for($i=0;$i<sizeof($dat);$i++)
			{ 
				$slotid = $dat[$i]; 
				$res = $this->Expert->blocksmesSlot($slotid);
			}
			
		}
		else
		{
			$slotid = $data['slotid'];
			$res = $this->Expert->blocksmesSlot($slotid);
		}
		echo json_encode(true);
	}
	
	public function get_slot()
	{
		$data = $this->input->post();
		$smeuserid = $data['smeuserid'];
		$res = $this->Expert->getSlot($data['seldate'],$smeuserid);
		if($res)
		{
			$data['res'] = $this->Expert->getSlot($data['seldate'],$smeuserid);
			$data=$this->load->view('experts/add_sme_slots',$data, TRUE);
			return $this->output
                ->set_header("HTTP/1.0 200 OK")
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
		}
		else
		{
			echo json_encode($res);
		}
	}
	
	public function get_slot2()
	{
		$data = $this->input->post();
		$smeuserid = $data['smeuserid'];
		$res = $this->Expert->getSlot2($data['seldate'],$smeuserid);
		if($res)
		{
			$data['res'] = $this->Expert->getSlot2($data['seldate'],$smeuserid);
			$data=$this->load->view('experts/add_user_sme_slots',$data, TRUE);
			return $this->output
                ->set_header("HTTP/1.0 200 OK")
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
		}
		else
		{
			echo json_encode($res);
		}
	}
	
	public function insert_paysession_amount()
	{
		 $data = $this->input->post();
 	     $data['amt'] = $this->session->set_userdata("paypackage_amt",$data['sme_amt2']); 
 	     $data['dateid'] = $this->session->set_userdata("smebookcallid",$data['id']); 
		 $this->session->unset_userdata("from"); 
		 $this->session->set_userdata("book_type",$data['type']); 
		 $this->session->set_userdata('sme_userid',$data['smeuserid']);
		 echo json_encode($data['amt']);
	}
	
	public function payment_checkout()
	{
		$data['title']='zinguplife | Checkout';
		$smebookcallid = $this->session->userdata('smebookcallid'); 
		$smebooktype = $this->session->userdata('book_type');  
		$sme_userid = $this->session->userdata('sme_userid');
		$data['sme_userid'] = $sme_userid;
		$data['amount'] = $this->session->userdata('paypackage_amt');
		$this->session->unset_userdata('paypackage_amt');
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$data['user'] = $this->session->userdata("logged_in_user_data");

		$data['profile'] = $this->Expert->getprofile($sme_userid);
		//$data['questions'] = $this->Expert->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['user_detail'] = $this->Expert->getuserdetails($userid);
		$data['dateid'] = $this->session->set_userdata("smebookcallid",$smebookcallid); 
		$data['main_content'] = 'experts/payment_checkout';
		$this->load->view('experts/includes/experts_template',$data);	
	}
	
	public function get_pay_packages()
	{
		$data = $this->Expert->getpayPacakges();
		echo json_encode($data);
	}
	
	public function call_payment_success() {
        $data['title']='zinguplife | payment success';
		$sme_userid = $this->session->userdata('sme_userid'); 
		 $smebookcallid = $this->session->userdata('smebookcallid'); 
		$smebooktype = $this->session->userdata('book_type');  		
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		$userid = $logged_in_user_details->user_id;
		
		$data['profile'] = $this->Expert->getprofile($sme_userid);
		$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
		$profile = $this->Expert->getprofile($sme_userid);
		$data['fb_rating'] = $this->Expert->getrating($sme_userid);
		$data['rating_total'] = $this->Expert->getratingtot($sme_userid);
		$data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
		$data['feedback'] =$this->Expert->getallfeedback($sme_userid);
		$data['articles'] = $this->Expert->getallarticles($sme_userid);
		//$data['questions'] = $this->Expert->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['follow_cnt'] = $this->Expert->getfollowcnt($sme_userid);
		$data['following'] =  $this->Expert->checkfollow($userid,$sme_userid);
		$smeuerdetails = $this->Expert->getsmedetails($sme_userid);
		$data['user_detail'] = $this->Expert->getuserdetails($userid);
		$user_details = $this->Expert->getUserEmail($userid);
 	     $smeuser_details = $this->Expert->getSmeEmail($sme_userid);
 	     
        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        $workingKey = '3C095C0C179A18E2823E067C3D17CE98';  //orginal Working Key.
        //$workingKey = '79AAB7ED2DAB322205432E3FB981231A';  //test Working Key.
		
		//$workingKey = '79AAB7ED2DAB322205432E3FB981231A';
        $encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server
        $rcvdString = decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        //echo '<pre>'; print_r($encResponse);  exit();
        $dataSize = sizeof($decryptValues);

		      
       $data['transaction_response'] = $decryptValues; 
       // echo '<pre>'; $data['transaction_response']; exit();
       $orderid = explode('=', $decryptValues[0]);
		
   

        $transaction_id_array = explode('=', $decryptValues[1]);
		$transaction_payment_array = explode('=', $decryptValues[5]);
		$transaction_amount = explode('=', $decryptValues[10]);
        
        $data['transaction_id'] = $transaction_id_array[1];
		$data['payment_mode'] = $transaction_payment_array[1];
		$data['amount'] = $transaction_amount[1];

		$payment_array = array('package_id' => 1,
								'transaction_id'  => $data['transaction_id'],
								'transaction_status'  => 'Success',
								'transaction_date'    =>  date('Y-m-d H:i:s'),
								'paid_by' => $this->session->userdata("logged_in_user_data")->user_id,
								'payment_mode' => $data['payment_mode'],
								'amount'       => $data['amount'],
								'amount_paid'       => $data['amount'],
								'book_type'    => $smebooktype
							  );
		$this->Expert->insert_call_payment_details($payment_array,$orderid[1]);
		
		$call_data = array(
                    'sme_userid' => $sme_userid,
                    'smebookcallid' => $smebookcallid,
					'order_id' =>$orderid[1],
                    'userid' => $userid
                );
		if($smebooktype == 'Text Chat')		
		{
			$chat = array('user_id' =>$userid,'sme_id'=>$sme_userid,'status'=>'ongoing');
			$chatid = $this->Expert->add_chat($chat);
		}
                
		$data['book_call'] = $this->Expert->insertbookedcalls($call_data,$userid); 
		$data['date'] = $this->Expert->getBookeddate($smebookcallid);
		$data['timefrom'] = $this->Expert->getBookedtimefrom($smebookcallid);
		$data['timeto'] = $this->Expert->getBookedtimeto($smebookcallid);
		
		$this->Expert->updatebooked($smebookcallid);
   
      /* to send  email */
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->set_mailtype("html");
                $this->email->from('admin@zinguplife.com', 'Zingup Support');
                $this->email->to($user_details->username);
                $this->email->subject('SME Chat/Call Schedule');
                $this->email->message('Hello ' . $user_details->name . '
				<br/><br/>
				Your  '.$smebooktype.' has been booked on '.$data['date'].' and time '.$data['timefrom'].' - '.$data['timeto'].'
				<br/>
				<br/>
				please check your dashboard page "Join session" button appears on booked date and 10 minutes before booked time to initiate the '.$smebooktype.'.
				<br/><br/>
				');
                $this->email->send();
                
		 /* to send  email */
			$this->email->set_newline("\r\n");
			$this->email->set_mailtype("html");
			$this->email->from('admin@zinguplife.com', 'Zingup Support');
			$this->email->to($smeuser_details->username);
			$this->email->subject('SME Chat/Call Schedule');
			$this->email->message('Hello ' . $smeuser_details->first_name . ' ' . $smeuser_details->last_name . '
			<br/><br/>
			The '.$smebooktype.' has been booked on '.$data['date'].' and time '.$data['timefrom'].' - '.$data['timeto'].' by '.$user_details->name.'
			<br/>
			<br/>
			please check your dashboard page "Join session" button appears on booked date and 10 minutes before booked time to initiate the '.$smebooktype.'.
			<br/><br/>
			');
			$this->email->send();
      
      
      
 	 
		
		
		$data['chat_payment'] = $this->Expert->getChatPayments();
		$data['title']='zinguplife | User-sme-view';
        $data['userid']=$id = $this->session->userdata("sme_userid");
		$data['profile'] = $this->Expert->getprofile($id);
		$data['added_slots'] = $this->Expert->getaddedslots($id);
		$data['blocked_slots'] = $this->Expert->getblockedslots($id);
		$data['follow_cnt'] = $this->Expert->getfollowcnt($id);
		$data['feedback'] =$this->Expert->getallfeedback($id);
		$data['questions'] = $this->Expert->getallansquestions($id);
		$data['events'] = $this->Expert->getallevents($id);
		$data['fb_rating'] = $this->Expert->getrating($id);
		$data['rating_total'] = $this->Expert->getratingtot($id);
		$data['pos_fb'] = $this->Expert->get_pos_fb($id);
		$data['neu_fb'] = $this->Expert->get_neu_fb($id);
		$data['neg_fb'] = $this->Expert->get_neg_fb($id);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($id);
		$data['articles'] = $this->Expert->getallarticles($id);
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		 if (!empty($logged_in_user_details)) {
                                    $data['is_logged_in'] = $logged_in_user_details->is_logged_in;
                                } else {
                                    $data['is_logged_in'] = '';
                                }
		$data['offset'] = 8;
		$data['fboffset'] = 5;
		$data['aroffset'] = 4;

		$user = $data['user'] = $logged_in_user_details->user_id;
		$data['calls'] = $this->Expert->getuserca($user,$data['userid']);
		$data['transaction_id'] = $this->sme_user->gettrans($user);
		
		 $this->session->set_flashdata('call_success_msg', 'Call is booked successfully !!');
         redirect('experts/user/'.$sme_userid);
		//$data['submitted'] = 'Call is booked successfully';
		//$data['main_content'] = 'experts/experts_user_view'; 
		//$this->load->view('experts/includes/experts_template',$data);


    }
	
	public function apply_coupon()
	{
		$coupon = $this->input->post('coupon');
		$new_amt = $this->input->post('new_amt');
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		$userid = $logged_in_user_details->user_id;
		$check = $this->Expert->checkCoupon($coupon,$userid,$new_amt);
		echo json_encode($check);
	}
	
	public function update_session_link()
	{
		$data = $this->input->post();
		$lin2k ='https://appear.in/'. $data['roomName'];
		$link = $this->Expert->update_session_link($data['id'],$lin2k);
		$smeuserid = $this->session->userdata("sme_userid");
		 $login_data = array(
            'active' => 'b'
        );

        $smeuser_id = $this->sme_user->update_smeuser_table($login_data, $smeuserid);
		$this->session->set_userdata('live_session',$link);
		$this->session->set_userdata('booked_id',$data['id']);
		$this->session->set_userdata('sme_userid',$smeuserid);
		echo json_encode($link);
	}
	
	//newly added for new design1
	
	public function add_slots()
	{
		
		$data = $this->input->post();
		$day = $data['day'];
		$eachday = explode(",",$day);
		$from = $data['starttime'];
		$to = $data['endtime'];
		$smeuserid = $this->session->userdata('sme_userid');
		$today = date('Y-m-d');
		$dates = array();
		
		$this_month = mktime(0, 0, 0, date('m'), 1, date('Y'));
		$firsty =  date("Y", strtotime("+0 month", $this_month));
		$firstm =  date("m", strtotime("+0 month", $this_month));
		$secondy =  date("Y", strtotime("+1 month", $this_month));
		$secondm =  date("m", strtotime("+1 month", $this_month));
		$thirdy =  date("Y", strtotime("+2 month", $this_month));
		$thirdm =  date("m", strtotime("+2 month", $this_month));
		
		$y = 2010;
		$m = 11;
		
		for($i=0;$i<sizeof($eachday);$i++)
		{
			$date =  new DatePeriod(
				new DateTime("first $eachday[$i] of $firsty-$firstm"),
				DateInterval::createFromDateString("next $eachday[$i]"),
				new DateTime("last day of $firsty-$firstm")
			);
			
			$secondate = new DatePeriod(
				new DateTime("first $eachday[$i] of $secondy-$secondm"),
				DateInterval::createFromDateString("next $eachday[$i]"),
				new DateTime("last day of $secondy-$secondm")
			);
			
			$thirdate = new DatePeriod(
				new DateTime("first $eachday[$i] of $thirdy-$thirdm"),
				DateInterval::createFromDateString("next $eachday[$i]"),
				new DateTime("last day of $thirdy-$thirdm")
			);
			
			foreach ($date as $day) {
				array_push($dates,$day->format("Y-m-d")) ;
			}
			
			foreach ($secondate as $day1) {
				array_push($dates,$day1->format("Y-m-d")) ;
			}
			
			foreach ($thirdate as $day2) {
				array_push($dates,$day2->format("Y-m-d")) ;
			}
			
			
		
		}

		for($i=0; $i<sizeof($dates);$i++)
		{
			if($dates[$i] > $today)
			{
				$vac_check = $this->Expert->checkvacdates($dates[$i],$smeuserid);
				if($vac_check)
				{
					$slots = array(
								'sme_userid'  =>  $smeuserid,
								'date'        =>  $dates[$i],
								'time_from'   =>  $from,
								'time_to'     =>  $to,
							);
					$check = $this->Expert->check_expert_slot($smeuserid,$dates[$i],$from,$to);
					if($check) 
					{
						$this->Expert->add_expert_slot($slots);
					}
				}
			}
		}
		 $data['bookedsmeslots'] = $this->Expert->getExpertSlots($smeuserid);
		 $data=$this->load->view('experts/new_add_sme_slots',$data, TRUE);
			//$this->output->set_output($data); 
			return $this->output 
					->set_header("HTTP/1.0 200 OK")
					->set_content_type('application/json')
					->set_output(json_encode($data));
		//echo json_encode(true);
	
	}
	
	public function add_ques_replies()
	{
		$data = $this->input->post();
		$insertdata =array(
						'qid'=>$data['qid'],
    	                'comment'=>$data['ans'],
    	                'userid'=>$data['uid']
			);
			
    	  $data['result'] = $this->Expert->insert_sme_reply($insertdata);
    	  $this->session->set_flashdata('msg', 'Reply is added successfully');
    	  echo json_encode(true);
	}
	
	public function new_get_questions()
	{
		$data = $this->input->post();
		$data['questions'] = $this->Expert->get_questions($data['ques'],$data['id']);
		if($data['questions'] != ''){
       	 if($this->session->userdata('sme_userid') !=''){
           $data=$this->load->view('experts/new_sme_questions_by_date',$data, TRUE);
           }else{
           	$data=$this->load->view('experts/new_questions_by_date',$data, TRUE);
           	}

		 echo json_encode($data);
         } 
	}
	
	public function insert_sme_event() {
    	  $data = $this->input->post();
     	  $insertdata =array('sme_userid'=>$data['sme_userid'],
    	                     'title'=>$data['event_title'],
    	                     'description'=>$data['event_description'],
    	                     'location'=>$data['event_address'],
    	                     'date'=>$data['start_date'],
							 'end_date'=>$data['end_date']
    	  );
    	  $eventid = $this->Expert->insert_sme_event($insertdata);
    	   if ($_FILES['event_photo']['name'] != '') {
    	   	
                $config['upload_path'] = './sme_users/events/'. $eventid;
           if (!is_dir('./sme_users/events/'. $eventid))
				{
					mkdir('./sme_users/events/'. $eventid, 0777, true);
				}
                $config['allowed_types'] = 'png|jpeg|jpg|PNG|JPEG|JPG';
                $this->load->library('upload', $config);
                $this->upload->do_upload('event_photo');
                $upload_data21 = $this->upload->data();
                $event_image = $upload_data21['file_name'];
               
                $profile_data = array(
                    'name' => $event_image,
                    'ev_id' => $eventid
                );
                $this->Expert->insert_event_image($profile_data);
            }
            $this->session->set_flashdata('msg', 'Event is added successfully');
			redirect('experts/dashboard');
    	  
    }
	
	public function delete_event()
	{
		$data = $this->input->post();
		$this->Expert->delete_event($data['id']);
		echo json_encode(true);
	}
	
	public function cancel_call_booking()
	{
		$data = $this->input->post();
		$array = array('cancel' => 'y','cancel_message'=>$data['message'],'status'=>'cancelled');
		$res = $this->Expert->cancel_booked_call($array,$data['id']);
		$smedetails = $this->Expert->getSMename($res[0]->sme_userid);
		$appdetails = $this->Expert->getAppDetails($data['id']);
		
		 /* to send  email  to admin*/
		 $useremail = 'shilpa.r08@gmail.com';
		 $from = $smedetails[0]->username;
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
		$this->email->from($from, 'Zingup Booked Call Appointment');
		$this->email->to($useremail);
		$this->email->subject('Cancellation of Booked Call by SME/Expert');
		$this->email->message('Hello Admin
		<br/><br/>
		The SME '.$smedetails[0]->name.'  has cancelled an appointment. Please find the appointment details below
		<br/><br/>
		Date : '.$appdetails[0]->date.'
		<br/>
		Time : '.$appdetails[0]->time_from.' - '.$appdetails[0]->time_to.'
		<br/>
		User : '. $appdetails[0]->user_name .'
		<br/>
		Reason : '.$data['message']);
		$this->email->send();
		
		/* to send  email  to User*/
		$useremail = $appdetails[0]->user_email;
		 $from = $smedetails[0]->username;
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
		$this->email->from('admin@zinguplife.com', 'Zingup Booked Call Appointment');
		$this->email->to($useremail);
		$this->email->subject('Cancellation of Booked Call by SME/Expert');
		$this->email->message('Hello '.$appdetails[0]->user_name.'
		<br/><br/>
		This is to inform that the  SME '.$smedetails[0]->name.'  has cancelled an appointment and the amount will be refunded shortly. Please find the appointment details below
		<br/><br/>
		Date : '.$appdetails[0]->date.'
		<br/>
		Time : '.$appdetails[0]->time_from.' - '.$appdetails[0]->time_to.'
		<br/>
		SME/Expert : '. $smedetails[0]->name .'
		<br/>
		reason : '.$data['message']
		);
		$this->email->send();
		
		/* to send  email  to SME*/
		$useremail = $smedetails[0]->username;
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
		$this->email->from('admin@zinguplife.com', 'Zingup Booked Call Confirmation');
		$this->email->to($useremail);
		$this->email->subject('Cancellation of Booked Call');
		$this->email->message('Hello '.$smedetails[0]->name.'
		<br/><br/>
		This is to inform that the Appointment is cancelled successfully. Please find the appointment details below
		<br/><br/>
		Date : '.$appdetails[0]->date.'
		<br/>
		Time : '.$appdetails[0]->time_from.' - '.$appdetails[0]->time_to.'
		<br/>
		User : '. $appdetails[0]->user_name
		);
		$this->email->send();
		
					
		//sms to sme
		$messgae_to = '+91' . $smedetails[0]->phone;
		$sms_content = 'Hello Appointment is cancelled successfully';

		$this->Mailing->send_sms($messgae_to, $sms_content);
					
		//sms to user
		$messgae_to = '+91' . $appdetails[0]->phone;
		$sms_content = 'Hello Appointment booked by you is cancelled by an Expert reason being '.$data['message'] .'';

		$this->Mailing->send_sms($messgae_to, $sms_content);
					
		echo json_encode(true);
	}
	
	public function live_session()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		
        $data['livechat'] = $this->Expert->checkChatSchedule($sme_userid);
		//print_r($data['livechat']); exit();
		$user= $data['livechat'][0]->userid;
		$data['c'] = $this->Expert->checkprevDues($sme_userid,$user); 

		
		if($data['c'])
		{
			$de = $this->Expert->getlivesessionde($sme_userid,$user);

				$this->session->set_userdata('chat_userid',$user); 
				 $this->session->set_userdata('smebookcallid',$de->smebookcallid); 
				 $this->session->set_userdata('book_type',$de->book_type);  
				 $this->session->set_userdata('sme_userid',$sme_userid);
				 $this->session->set_userdata('paypackage_amt',$de->amount);
				 $this->session->set_userdata('order_id',$de->order_id);
			 $this->session->set_userdata('direct','yes');
		}
		

		if($data['livechat'][0]->video_link !='')
		{
			$today = date('Y-m-d');
			date_default_timezone_set("Asia/Kolkata"); 
			 $currentime = date('h:i A'); 
			 $minutes = strtotime($data['livechat'][0]->time_from) - strtotime($currentime);
			$diff = abs($minutes);  
			if(($data['livechat'][0]->date == $today && $diff <= 600 && strtotime($data['livechat'][0]->time_from) > strtotime($currentime)) || ($data['livechat'][0]->date == $today && strtotime($data['livechat'][0]->time_from) < strtotime($currentime) && strtotime($data['livechat'][0]->time_to) > strtotime($currentime)) )
			{
				$data['link'] = $data['livechat'][0]->video_link;
				$data['id'] = $data['livechat'][0]->id;
			}
		}
		else
		{
			
			$data['link'] = $this->session->userdata('live_session');
			$data['id'] = $this->session->userdata('booked_id');
			$this->session->unset_userdata('live_session');
			$this->session->unset_userdata('booked_id');
		}
		$data['book_type'] = $this->session->userdata('book_type'); 
		$data['main_content'] = 'experts/new_live_consulting'; 
		$this->load->view('experts/includes/new_experts_template',$data);
	}
	
	public function user_live_session()
	{
		
		$data['link'] = $this->session->userdata('live_session');
		$data['id'] = $this->session->userdata('booked_id'); 
		$d = $this->Expert->getSessionAmount($data['id']);

		$this->session->set_userdata('paypackage_amt',$d->amount);
		$this->session->set_userdata('smebookcallid',$d->smebookcallid);
		$this->session->set_userdata('order_id',$d->order_id);
		$this->session->set_userdata('smeuser',$d->sme_userid);
		$this->session->set_userdata('sme_userid',$d->sme_userid);
		if($this->session->userdata('book_type'))
		{
			$data['book_type'] = $this->session->userdata('book_type');  
		}
		else{
			$this->session->set_userdata('book_type',$d->book_type);
			$data['book_type'] = $this->session->userdata('book_type');  
		}
		$this->session->userdata('book_type');  
		//$this->session->unset_userdata('live_session');
		//$this->session->unset_userdata('booked_id');
		
		$data['main_content'] = 'experts/new_user_live_consulting'; 
		$this->load->view('experts/includes/new_experts_template',$data);
	}
	
	
	public function save_notes() {
    	  $data = $this->input->post();
			$id = $data['sid'];  
          $insertdata =array('sme_notes'=>$data['comment']);
    	  $bid = $this->Expert->save_notes($id,$insertdata);
		  $smeuserid = $this->Expert->get_smeidfrom($id);
		 $login_data = array(
            'active' => 'y'
        );

        $this->sme_user->update_smeuser_table($login_data, $smeuserid);
		
		$ar = array('status' => 'closed');
		$this->Expert->changesmestatus($bid,$ar);
		$ar2 = array('status' => 'ended');
		$chatid = $this->session->userdata('live_chat_id');
		$this->Expert->closechat($chatid,$ar2);
		
    	  $this->session->set_flashdata('msg', 'note is added successfully');
		  $this->session->set_userdata('sme_userid',$smeuserid);
			redirect('experts/dashboard');
    	  
    }
	
	public function end_live_session() {
    	  $data = $this->input->post();
			$id = $data['sid'];  
			$bid = $this->Expert->getbookedidfr($id);
		  $smeuserid = $this->Expert->get_smeidfrom($id);
		 $login_data = array(
            'active' => 'y'
        );

        $this->sme_user->update_smeuser_table($login_data, $smeuserid);
		
		$ar = array('status' => 'closed');
		$this->Expert->changesmestatus($bid,$ar);
		
		$ar2 = array('status' => 'ended');
		$chatid = $this->session->userdata('live_chat_id');
		$this->Expert->closechatsme($smeuserid,$ar2);
		
    	  $this->session->set_flashdata('msg', 'note is added successfully');
		  $this->session->set_userdata('sme_userid',$smeuserid);
			redirect('experts/dashboard');
    	  
    }
	
	public function check_user_logged()
	{
		$data = $this->input->post();
		$logged_in_user_details = $this->session->userdata('logged_in_user_data'); 
		$url = $this->config->base_url() . 'experts/user/' . $data['smeid'];
		
		 if (empty($logged_in_user_details)) {
			 $this->session->set_userdata('referrer',$url);
			 $this->session->set_userdata('from','chat');
			  $this->session->set_userdata('smeid',$data['smeid']);
			 echo json_encode('login');
		 }
		 else{
			 $userid = $logged_in_user_details->user_id;
			 $smeid = $data['smeid'];
			 $c = $this->Expert->checkprevDues($smeid,$userid);
			 $de = $this->Expert->getlivesessionde($smeid,$userid);
			 if($c)
			 {
				  $this->session->set_userdata('chat_userid',$userid); 
				 $this->session->set_userdata('referrer',$url);
				 $this->session->set_userdata('direct','yes');
				 echo json_encode('cleared');
			 }
			 else
			 {
				 $this->session->set_userdata('chat_userid',$userid); 
				 $this->session->set_userdata('smebookcallid',$de->smebookcallid); 
				 $this->session->set_userdata('book_type',$de->book_type);  
				 $this->session->set_userdata('sme_userid',$smeid);
				 $this->session->set_userdata('paypackage_amt',$de->amount);
				 $this->session->set_userdata('order_id',$de->order_id);
				 echo json_encode('dues');
			 }
			 //echo json_encode('logged');
		 }
		 
                                    
	}
	
	
	public function book_check_user_logged()
	{
		$data = $this->input->post();
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		$url = $this->config->base_url() . 'experts/user_book/' . $data['smeid'];

		 if (empty($logged_in_user_details)) {
			 $this->session->set_userdata('referrer',$url);
			 $this->session->set_userdata('from','book');
			 echo json_encode('login');
		 }

		 
                                    
	}
	
	public function create_sme_slot()
	{
		date_default_timezone_set("Asia/Kolkata"); 
		 $data = $this->input->post();
		 $today = date('Y-m-d');
		 $time_from = date("h:i A", strtotime("now"));
		 $time_to = date("h:i A", strtotime("+30 minutes"));
 	      $data['amt'] = $this->session->set_userdata("paypackage_amt",$data['sme_amt2']); 
		 
		 $slots = array('sme_userid' => $data['smeuserid'], 'date' => $today, 'time_from' => $time_from, 'time_to' => $time_to, 'status' =>'blocked');
		 $id = $this->Expert->add_expert_slot($slots);
		 
		 $data['amt'] = $this->session->set_userdata("paypackage_amt",$data['sme_amt2']); 
		 
		 $logged_in_user_details = $this->session->userdata('logged_in_user_data');
		 $userid = $logged_in_user_details->user_id;
		 $prefix = 'ORD';
         $order_id = $prefix . uniqid();
		 $array = array('order_id' => $order_id,'book_type' => $data['type'], 'paid_by' => $userid,'amount' => $data['sme_amt2'],'amount_paid' => '0','pay_status' => 'free' );
		 $this->Expert->create_pay_order2($array);
		 
		 $this->load->helper('string');
		 $roomName = random_string('alnum',16);
		 $roomName = 'Zinguplife' . $roomName;
		 $chat_url =' https://appear.in/'. $roomName;
		 $ar = array('smebookcallid' =>$id, 'order_id' => $order_id,'userid' => $userid, 'sme_userid' => $data['smeuserid'],'video_link' => $chat_url);
		$addid =  $this->Expert->add_user_book_call($ar);
	
		 $this->session->set_userdata("order_id",$order_id); 
		 $this->session->set_userdata('live_session',$chat_url); 
		 $this->session->set_userdata('booked_id',$addid);
		 $this->session->set_userdata('sme_userid',$data['smeuserid']);
		  $this->session->set_userdata('initiate_chat','yes');
		  $this->session->set_userdata('book_type',$data['type']);
		  $u =  $this->config->base_url() . 'experts/live_session';
		  $message = 'A User has Initiated a Live' .$data['type'] . '. Refresh(ctrl+f5) the screen and click on Live session button in your dashboard to start the chat.';
		  $type = 'sme';
			$this->load->library('ci_pusher');
			$pusher = $this->ci_pusher->get_pusher();
			$pusher->trigger('test_channel', 'my_event', array('message' => $message,'id'=> $data['smeuserid'],'type' => $type));
			
		 $smeuserid = $data['smeuserid'];
		 $login_data = array(
            'active' => 'b'
        );

        $smeuser_id = $this->sme_user->update_smeuser_table($login_data, $smeuserid);
		
		$chat = array('user_id' =>$userid,'sme_id'=>$data['smeuserid'],'status'=>'ongoing');
		$chatid = $this->Expert->add_chat($chat);
		 $this->session->set_userdata('live_chat_id',$chatid);
		 echo json_encode(true);
	}
	
	public function check_chat_initiate()
	{
		if($this->session->userdata('initiate_chat'))
		{
			$this->session->unset_userdata('initiate_chat');
			echo json_encode(true);
		}
	}
	
	public function new_payment_checkout()
	{
		$data['title']='zinguplife | Checkout';
		$smebookcallid = $this->session->userdata('smebookcallid'); 
		$smebooktype = $this->session->userdata('book_type');  
		 $sme_userid = $this->session->userdata('sme_userid'); 
		$data['sme_userid'] = $sme_userid;
		$data['amount'] = $this->session->userdata('paypackage_amt');
		$this->session->unset_userdata('paypackage_amt');
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$data['user'] = $this->session->userdata("logged_in_user_data");

		$data['profile'] = $this->Expert->getprofile($sme_userid);
		//$data['questions'] = $this->Expert->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['user_detail'] = $this->Expert->getuserdetails($userid);
		$data['dateid'] = $this->session->set_userdata("smebookcallid",$smebookcallid); 
		$data['main_content'] = 'experts/new_payment_checkout';
		$this->load->view('experts/includes/experts_template',$data);	
	}
	
	public function new_call_payment()
	{
                 
		$data['title']='zinguplife | payment';
		$data = $this->input->post();
		
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$prefix = 'ORD';
        $order_id = $this->session->userdata('order_id');
        
		$data['order_id'] = $order_id;
		$data['amount'] = $data['amount'];
		$data['logged_in_user_details'] = $this->session->userdata("logged_in_user_data");
		$data['main_content'] = 'experts/new_call_payment';
		$this->load->view('experts/includes/experts_template',$data);	
	}
	
	public function new_call_payment_success() {
        $data['title']='zinguplife | payment success';
		$sme_userid = $this->session->userdata('sme_userid'); 
		 $smebookcallid = $this->session->userdata('smebookcallid'); 
		$smebooktype = $this->session->userdata('book_type');  		
		$order_id = $this->session->userdata('order_id');
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		$userid = $logged_in_user_details->user_id;
		
		$data['profile'] = $this->Expert->getprofile($sme_userid);
		$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
		$profile = $this->Expert->getprofile($sme_userid);
		$data['fb_rating'] = $this->Expert->getrating($sme_userid);
		$data['rating_total'] = $this->Expert->getratingtot($sme_userid);
		$data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
		$data['feedback'] =$this->Expert->getallfeedback($sme_userid);
		$data['articles'] = $this->Expert->getallarticles($sme_userid);
		//$data['questions'] = $this->Expert->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['follow_cnt'] = $this->Expert->getfollowcnt($sme_userid);
		$data['following'] =  $this->Expert->checkfollow($userid,$sme_userid);
		$smeuerdetails = $this->Expert->getsmedetails($sme_userid);
		$data['user_detail'] = $this->Expert->getuserdetails($userid);
		$user_details = $this->Expert->getUserEmail($userid);
 	     $smeuser_details = $this->Expert->getSmeEmail($sme_userid);
 	     
        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        //$workingKey = '3C095C0C179A18E2823E067C3D17CE98';  //original Working Key.
        $workingKey = '79AAB7ED2DAB322205432E3FB981231A';  //test Working Key.
		
		//$workingKey = '79AAB7ED2DAB322205432E3FB981231A';
        $encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server
        $rcvdString = decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        //echo '<pre>'; print_r($decryptValues);  exit();
        $dataSize = sizeof($decryptValues);

		      
       $data['transaction_response'] = $decryptValues; 
       
       $orderid = explode('=', $decryptValues[0]);
		
   

        $transaction_id_array = explode('=', $decryptValues[1]);
		$transaction_payment_array = explode('=', $decryptValues[5]);
		$transaction_amount = explode('=', $decryptValues[10]);
        
        $data['transaction_id'] = $transaction_id_array[1];
		$data['payment_mode'] = $transaction_payment_array[1];
		$data['amount'] = $transaction_amount[1];

		$payment_array = array('package_id' => 1,
								'transaction_id'  => $data['transaction_id'],
								'transaction_status'  => 'Success',
								'transaction_date'    =>  date('Y-m-d H:i:s'),
								'paid_by' => $this->session->userdata("logged_in_user_data")->user_id,
								'payment_mode' => $data['payment_mode'],
								'amount'       => $data['amount'],
								'amount_paid'       => $data['amount'],
								'book_type'    => $smebooktype
							  );
		$this->Expert->insert_call_payment_details($payment_array,$orderid[1]);
		
		
		$this->Expert->updatebooked($smebookcallid);
   
		 $this->session->set_userdata('chat_userid',$userid); 	
		 $this->session->set_userdata('direct','yes');
		 if($this->session->userdata('payment'))
		 {
			 $this->session->unset_userdata('direct','yes');
			 $message = 'Please go back to live session screen and continue from where it was left';
			 $status = 'paid';
			$this->load->library('ci_pusher');
			$pusher = $this->ci_pusher->get_pusher();
			$pusher->trigger('test_channel', 'my_event', array('message' => $message,'id'=> $user,'type' => 'user','status' => $status));
		 }
		 else
		 {
			redirect('experts/user/'.$sme_userid);
		 }
		
		 
		//$data['main_content'] = 'experts/experts_user_view'; 
		//$this->load->view('experts/includes/experts_template',$data);


    }
	
	public function ask_payment()
	{
		$data = $this->input->post();
		$user = $data['user'];
		$orderid = $this->session->userdata('order_id');
		$array = array('pay_status' => 'pay' );
		 $this->Expert->update_create_pay_order2($array,$orderid);
		 $this->session->set_userdata('payment','yes');
		
		$message = 'To Continue Live session. Please make the payment';
		$status = 'unpaid';
		$this->load->library('ci_pusher');
		$pusher = $this->ci_pusher->get_pusher();
		$pusher->trigger('test_channel', 'my_event', array('message' => $message,'id'=> $user,'type' => 'user','status' => $status));
		echo json_encode(true);
	}
	
	public function new_chat_payment_checkout()
	{
		$data['title']='zinguplife | Checkout';
		$smebookcallid = $this->session->userdata('smebookcallid'); 
		$smebooktype = $this->session->userdata('book_type');  
		 $sme_userid = $this->session->userdata('sme_userid'); 
		$data['sme_userid'] = $sme_userid;
		$data['amount'] = $this->session->userdata('paypackage_amt');
		$this->session->unset_userdata('paypackage_amt');
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$data['user'] = $this->session->userdata("logged_in_user_data");

		$data['profile'] = $this->Expert->getprofile($sme_userid);
		//$data['questions'] = $this->Expert->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['user_detail'] = $this->Expert->getuserdetails($userid);
		$data['dateid'] = $this->session->set_userdata("smebookcallid",$smebookcallid); 
		$data['main_content'] = 'experts/new_chat_payment_checkout';
		$this->load->view('experts/includes/experts_template',$data);	
	}
	
	public function new_chat_call_payment()
	{
                 
		$data['title']='zinguplife | payment';
		$data = $this->input->post();
		
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$prefix = 'ORD';
        $order_id = $this->session->userdata('order_id');
        
		$data['order_id'] = $order_id;
		$data['amount'] = $data['amount'];
		$data['logged_in_user_details'] = $this->session->userdata("logged_in_user_data");
		$data['main_content'] = 'experts/new_chat_call_payment';
		$this->load->view('experts/includes/experts_template',$data);	
	}
	
	public function new_chat_call_payment_success() {
        $data['title']='zinguplife | payment success';
		$sme_userid = $this->session->userdata('sme_userid'); 
		 $smebookcallid = $this->session->userdata('smebookcallid'); 
		$smebooktype = $this->session->userdata('book_type');  		
		$order_id = $this->session->userdata('order_id');
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		$userid = $logged_in_user_details->user_id;
		
		$data['profile'] = $this->Expert->getprofile($sme_userid);
		$data['added_slots'] = $this->Expert->getaddedslots($sme_userid);
		$data['blocked_slots'] = $this->Expert->getblockedslots($sme_userid);
		$profile = $this->Expert->getprofile($sme_userid);
		$data['fb_rating'] = $this->Expert->getrating($sme_userid);
		$data['rating_total'] = $this->Expert->getratingtot($sme_userid);
		$data['pos_fb'] = $this->Expert->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->Expert->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->Expert->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->Expert->cal_pos_fb($sme_userid);
		$data['feedback'] =$this->Expert->getallfeedback($sme_userid);
		$data['articles'] = $this->Expert->getallarticles($sme_userid);
		//$data['questions'] = $this->Expert->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['follow_cnt'] = $this->Expert->getfollowcnt($sme_userid);
		$data['following'] =  $this->Expert->checkfollow($userid,$sme_userid);
		$smeuerdetails = $this->Expert->getsmedetails($sme_userid);
		$data['user_detail'] = $this->Expert->getuserdetails($userid);
		$user_details = $this->Expert->getUserEmail($userid);
 	     $smeuser_details = $this->Expert->getSmeEmail($sme_userid);
 	     
        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        //$workingKey = '3C095C0C179A18E2823E067C3D17CE98';  //original Working Key.
        $workingKey = '79AAB7ED2DAB322205432E3FB981231A';  //test Working Key.
		
		//$workingKey = '79AAB7ED2DAB322205432E3FB981231A';
        $encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server
        $rcvdString = decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        //echo '<pre>'; print_r($decryptValues);  exit();
        $dataSize = sizeof($decryptValues);

		      
       $data['transaction_response'] = $decryptValues; 
       
       $orderid = explode('=', $decryptValues[0]);
		
   

        $transaction_id_array = explode('=', $decryptValues[1]);
		$transaction_payment_array = explode('=', $decryptValues[5]);
		$transaction_amount = explode('=', $decryptValues[10]);
        
        $data['transaction_id'] = $transaction_id_array[1];
		$data['payment_mode'] = $transaction_payment_array[1];
		$data['amount'] = $transaction_amount[1];

		$payment_array = array('package_id' => 1,
								'transaction_id'  => $data['transaction_id'],
								'transaction_status'  => 'Success',
								'transaction_date'    =>  date('Y-m-d H:i:s'),
								'paid_by' => $this->session->userdata("logged_in_user_data")->user_id,
								'payment_mode' => $data['payment_mode'],
								'amount'       => $data['amount'],
								'amount_paid'       => $data['amount'],
								'book_type'    => $smebooktype
							  );
		$this->Expert->insert_call_payment_details($payment_array,$orderid[1]);
		
		
		//$this->Expert->updatebooked($smebookcallid);
   
		 $this->session->set_userdata('chat_userid',$userid); 	
		 $this->session->unset_userdata('direct');
		
			 $message = 'Please go back to live session screen and continue from where it was left';
			 $status = 'paid';
			$this->load->library('ci_pusher');
			$pusher = $this->ci_pusher->get_pusher();
			$pusher->trigger('test_channel', 'my_event', array('message' => $message,'id'=> $user,'type' => 'user','status' => $status));
		 
		 if($this->session->userdata('live_session_c'))
		 {
			 $this->session->unset_userdata('live_session');
			 //redirect('experts/user_live_session');
			//redirect('dashboard');
			redirect('experts/add_feedback/'.$sme_userid);
		 }
		 else{
			 redirect('experts/user_live_session');
		 }
		
		 
		//$data['main_content'] = 'experts/experts_user_view'; 
		//$this->load->view('experts/includes/experts_template',$data);


    }
	
	
	
	public function user_make_payment()
	{
		$this->session->unset_userdata('direct');
		$data = $this->input->post();
		$user = $data['user'];
		$orderid = $this->session->userdata('order_id'); 
		
		
		$checkpaid = $this->Expert->checkPaid($orderid); 
		if($checkpaid)
		{
			$ar = array('status' => 'closed');
			$this->Expert->changesmestatus($data['bookid'],$ar);
			
			$this->session->set_userdata('payment','yes');
			$this->session->set_userdata('live_session_c','completed');
			
			$ar2 = array('status' => 'ended');
			$chatid = $this->session->userdata('live_chat_id');
			$this->Expert->closechat($chatid,$ar2);
			echo json_encode(false);
		}
		else
		{
			$array = array('pay_status' => 'pay' );
			$this->Expert->update_create_pay_order2($array,$orderid);
			 
			 $this->session->set_userdata('payment','yes');
			 
			$ar = array('status' => 'closed');
			$this->Expert->changesmestatus($data['bookid'],$ar);
			
			$this->session->set_userdata('live_session_c','completed');
			
			$ar2 = array('status' => 'ended');
			$chatid = $this->session->userdata('live_chat_id');
			$this->Expert->closechat($chatid,$ar2);
			
			//$this->session->unset_userdata('live_chat_id');
			//$this->session->unset_userdata('direct');
			echo json_encode(true);
		}
		
	}
	
	public function sme_rating()
	{
		$data = $this->input->post();
		$ar = array('sme_rating' => $data['rating'], 'rating_message' => $data['fb'] );
		$this->Expert->update_rating($data['smebookcallid'],$ar);
		redirect('dashboard');
	}
	
	public function chat()
	{
		if($this->session->userdata('sme_userid'))
		{
			$sme_userid = $this->session->userdata('sme_userid');
			$data['profile'] = $this->Expert->getprofile($sme_userid);
		}
		$this->load->view('experts/new_text_chat');	
		
	}
	
	public function check_chat()
	{
		$data = $this->input->post();

		$details = $this->Expert->checkChat($data['id'],$data['last_chat_id'],$data['sme_id'],$data['type']);
		
		echo json_encode($details);
	}
	
	public function update_chat()
	{
		$data = $this->input->post();
		$data['created'] =  date('Y-m-d H:i:s');
		if($data['type'] == 'user')
		{
			$id = $data['userid'];
		}
		else
		{
			$id = $data['sme_id'];
		}
		date_default_timezone_set('Asia/Kolkata');
		$ar = array('chat_id' => $data['chat'], 'message' => $data['message'],'user_type'=>$data['type'],'user_id'=> $id,'added_on' =>  $data['daytime']); 
		$d = array('last_update_on' => $data['created']);
		$nid = $this->Expert->addChat($ar,$data['chat']);
		$this->Expert->updateChat($d,$data['chat']);
		echo json_encode($nid);
	}
	
	public function check_user_reg()
	{
		$data = $this->input->post();
		$email = $data['email'];
		$check = $this->Expert->checkUserReg($email);
		echo json_encode($check);
	}
	
	public function reg_new_user()
	{
		$this->load->library('PasswordHash');
		$data = $this->input->post();
		$email = $data['email'];
		$name = $data['name'];
		$gender = $data['gender'];
		$slot_id = $data['slot_id'];
		$type = $data['type'];
		$amount = $data['amount'];
		$sme_userid = $this->session->userdata('sme_userid');
		
		$this->load->helper('string');
		$password = random_string('alnum', 5);

		//$this->load->helper('phpass');
		//$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		$hash_password = PasswordHash::create_hash($post_data['password']);
		
		$userid = $this->Expert->create_new_user($email,$name,$gender,$hash_password);
		$b = array('status' => 'blocked');
		$this->Expert->booksmeuser($b,$slot_id);
		
		$prefix = 'ORD';
        $order_id = $prefix . uniqid();
        
		$pay = array('order_id'=> $order_id,'book_type'=>$type,'paid_by' =>$userid,'amount'=> $amount,'amount_paid' => 0,'pay_status'=> 'free' );
		$this->Expert->create_userpay_order($pay);
		
	
		
		$sme_book = array('sme_userid'=> $sme_userid,'smebookcallid'=>$slot_id,'order_id' =>$order_id,'userid'=> $userid);
		$this->Expert->create_smebook($sme_book);
		
		$booking_details = $this->Expert->b_det($slot_id);
		
		/* to send  email */
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->set_mailtype("html");
			$this->email->from('admin@zinguplife.com', 'Zingup Support');
			$this->email->to($email);
			$this->email->subject('Chat Booking From ZingupLife');
			$this->email->message('Hello ' . $name . '
			<br/><br/>
			SME/Experts has registered with your email id and Booked for chat. Please find the details of your login and booked data.
			<br/><br/>
			Login Details
			<br/>
			username : ' . $email . '
			<br/>
			password : ' . $password . '
			<br/><br/>
			Booking Details
			<br/>
			Date : '.$booking_details->date.'
			<br/>
			Time : '.$booking_details->time_from.' - '.$booking_details->time_to.'
			<br/>
			Chat Mode : '.$type.'
			<br/><br/>
			');
			$this->email->send();
		/* to send  email */
		
		echo json_encode(true);
		
	}
	
	public function add_exis_user_book()
	{
		$data = $this->input->post();
		$email = $data['email'];
		$userid = $data['id'];
		$slot_id = $data['slot_id'];
		$type = $data['type'];
		$amount = $data['amount'];
		$name = $data['name'];
		$sme_userid = $this->session->userdata('sme_userid');
		
		$b = array('status' => 'blocked');
		$this->Expert->booksmeuser($b,$slot_id);
		
		$prefix = 'ORD';
        $order_id = $prefix . uniqid();
        
		$pay = array('order_id'=> $order_id,'book_type'=>$type,'paid_by' =>$userid,'amount'=> $amount,'amount_paid' => 0,'pay_status'=> 'free' );
		$this->Expert->create_userpay_order($pay);
		
		$sme_book = array('sme_userid'=> $sme_userid,'smebookcallid'=>$slot_id,'order_id' =>$order_id,'userid'=> $userid);
		$this->Expert->create_smebook($sme_book);
		
		$booking_details = $this->Expert->b_det($slot_id);
		
		/* to send  email */
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->set_mailtype("html");
			$this->email->from('admin@zinguplife.com', 'Zingup Support');
			$this->email->to($email);
			$this->email->subject('Chat Booking From ZingupLife');
			$this->email->message('Hello ' . $name . '
			<br/><br/>
			SME/Experts has Booked for chat. Please find the details below.
			<br/><br/>
			Booking Details
			<br/>
			Date : '.$booking_details->date.'
			<br/>
			Time : '.$booking_details->time_from.' - '.$booking_details->time_to.'
			<br/>
			Chat Mode : '.$type.'
			<br/><br/>
			');
			$this->email->send();
		/* to send  email */
		
		echo json_encode(true);
		
		
	}
	
		public function ques_check_user_logged()
	{
		$data = $this->input->post();
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
		$url = $this->config->base_url() . 'experts/user/' . $data['smeid'];

		 if (empty($logged_in_user_details)) {
			 $this->session->set_userdata('referrer',$url);
			 $this->session->set_userdata('ques','ask');
			 echo json_encode('login');
		 }
		 else
		 {
			  echo json_encode('logged');
		 }

		 
                                    
	}
	
	 public function ask_question() {
        $data = $this->input->post();
		$sme_userid = $data['smeuserid'];
		$question = $data['question'];
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$this->session->unset_userdata('ques');
		 date_default_timezone_set("Asia/Kolkata");
		 $time = date('Y-m-d H:i:s');
		$array = array('question' => $question,'sme_userid' =>$sme_userid , 'userid' => $userid,'added_on' =>  $time,'answer' => '' );
		$this->Expert->add_question($array);
		redirect('experts/user/'.$sme_userid);
    }
	
	public function test() 
	{
		echo 'test';
		$payment_array = array('package_id' => 1,
								'transaction_id'  => '105087316747',
								'transaction_status'  => 'Success',
								'transaction_date'    =>  date('Y-m-d H:i:s'),
								'paid_by' => $this->session->userdata("logged_in_user_data")->user_id,
								'payment_mode' => 'Credit Card',
								'amount'       => '2000',
								'book_type'    => 'Text Chat'
							  );
		$this->Expert->insert_call_payment_details($payment_array,'ORD5844ebd739179');
	}

}
