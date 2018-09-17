<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sme extends CI_Controller {

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
        $this->load->model('sme_user');
        if (!$this->session->userdata('is_logged_in')) {
            // Allow some methods?
            $allowed = array(
                'index',
                'register',
                'login',
                'signin',
                'forgot_password',
                'send_mail',
                'reset_password',
                'update_password',
                'get_programs',
                'get_offerings'
            );
            if (!in_array($this->router->fetch_method(), $allowed)) {
                redirect('sme/login');
            }
        }
    }

    /*public function index() {

        if ($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme') {
            redirect('experts/dashboard');
        } else {
            $data['services'] = $this->sme_user->getServices();
			
            $data['main_content'] = 'sme_home';
            $this->load->view('includes/sme_template', $data);
        }
    }*/

    public function index() {
        //        if ($this->session->userdata('is_logged_in') == true && $this->session->userdata('type') == 'sme') {
//            redirect('sme/dashboard');
        //} else {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $data['services'] = $this->sme_user->getServices();
        $data['sme_users'] = $this->sme_user->get_sme_users_for_home_page();
        $data['sme_users_by_service'] = $this->sme_user->get_sme_users_for_home_page();

//        echo "<pre>";
//        print_r($data['services']);
//        exit();
        $data['main_content'] = 'experts/sme_home';
        $this->load->view('experts/includes/experts_template', $data);
        // }
    }

    public function register() {

        $data = $this->input->post();
        $today = date('m/d/Y');
        //form validation
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean|callback_customAlpha');

        // callback function
        // custom error message
        $this->form_validation->set_message('customAlpha', 'Name field should contain only alphabets and spaces');


        //$this->form_validation->set_rules('address','Address','required|xss_clean');
        //$this->form_validation->set_rules('last_name','Last Name','required|xss_clean|alpha');
        $this->form_validation->set_rules('password', 'Password', 'required');

        //$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email|is_unique[sme_users.username]');
        //$this->form_validation->set_rules('about','About','required');
 
        $this->form_validation->set_rules('service', 'Service', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|max_length[10]|min_length[8]|regex_match[/^[0-9 +]+$/]');

        $this->form_validation->set_message('is_unique', 'You have already registered with this Email Id');


        if ($this->form_validation->run() == FALSE) {
            $data['services'] = $this->sme_user->getallmainservices();
            $data['main_content'] = 'sme_registration';
             $this->load->view('includes/sme_template', $data);
        } else {
            $password = $this->input->post('password');
            $this->load->helper('phpass');
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $hash_password = $hasher->HashPassword($password);
            $login_data = array(
                'username' => $this->input->post('email'),
                'password' => $hash_password,
                'active' => 'n'
            );

            $smeuser_id = $this->sme_user->user_register($login_data);
			$smeuser_id2 = $smeuser_id;

            $offering = array('sme_userid' => $smeuser_id, 'offerings_id' => $data['service']);
            $this->sme_user->assign_offering($offering);
			
			 $profile_data = array(
                'sme_userid' => $smeuser_id2,
                'first_name' => $this->input->post('name'),
                //'last_name'    	=> $this->input->post('last_name'),
                //'address'       => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'dob' => $dob,
                'gender' => $this->input->post('gender'),
                'callback_time' => $this->input->post('callbk_time'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'country' => $this->input->post('country'),
				'pincode' => $this->input->post('pincode'),
                'about' => $this->input->post('about'),
                'expertise' => $this->input->post('expertise')
                    //'photo'    		=> $data['file_name']
            );
            //$this->PasswordHash->CheckPassword($password, $actualPassword);
            $this->sme_user->user_profile($profile_data);

            $config['upload_path'] = './sme_users/' . $smeuser_id;
            $config['allowed_types'] = 'gif|jpg|png';

            if (!is_dir('sme_users/' . $smeuser_id)) {
                mkdir('./sme_users/' . $smeuser_id, 0777, true);
            }

            $this->load->library('upload', $config);


            //if ( ! $this->upload->do_upload())
            //{
            //$data['errors'] = array('error' => $this->upload->display_errors());
            //$data['main_content'] = 'registration'; 
            //$this->load->view('includes/sme_template',$data);
            //}

            $data = $this->upload->data();
            $dob = date('Y-m-d', strtotime($this->input->post('dob')));
           // $v_sd = date('Y-m-d', strtotime($this->input->post('start_date')));
           // $v_ed = date('Y-m-d', strtotime($this->input->post('end_date')));
           
            $data['content'] = 'Registration was successfull';
            $data['main_content'] = 'sme_success';
            $this->load->view('includes/sme_template', $data);
        }
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
        $data['main_content'] = 'sme_login';
        $this->load->view('includes/sme_template', $data);
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

    public function dashboard() {
        $username = $this->session->userdata('username');
        $sme_userid = $this->session->userdata('sme_userid');
        $data['user'] = $this->sme_user->getalldetails($username);
        $data['follow_cnt'] = $this->sme_user->getfollowerscount($sme_userid);
        $data['feedback'] = $this->sme_user->getallfeedback($sme_userid);
        $data['pos_fb_per'] = $this->sme_user->cal_pos_fb($sme_userid);
        $data['pos_fb'] = $this->sme_user->get_pos_fb($sme_userid);
        $data['neu_fb'] = $this->sme_user->get_neu_fb($sme_userid);
        $data['neg_fb'] = $this->sme_user->get_neg_fb($sme_userid);
        $data['questions'] = $this->sme_user->getallquestions($sme_userid);
        $data['events'] = $this->sme_user->getallevents($sme_userid);

        $data['ansque'] = $this->sme_user->getallansquestions($sme_userid);
        $data['unansque'] = $this->sme_user->getallunansquestions($sme_userid);
        $data['articles'] = $this->sme_user->getallarticles($sme_userid);
        $data['fb_rating'] = $this->sme_user->getrating($sme_userid);
        $data['ur_questions'] = $this->sme_user->geturgquestions($sme_userid);
        $data['offset'] = 8;
        $data['fboffset'] = 5;
        $data['aroffset'] = 4;
        $data['main_content'] = 'sme_dashboard';
        $this->load->view('includes/sme_template', $data);
    }

    public function profile() {
        $username = $this->session->userdata('username');
        $sme_userid = $this->session->userdata('sme_userid');
        $data['user'] = $this->sme_user->getalldetails($username);
        $data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
        $data['main_content'] = 'sme_edit_profile';
        $this->load->view('includes/sme_template', $data);
    }

    public function update_profile() {
        $data = $this->input->post();
        $smeuser_id = $this->session->userdata('sme_userid');
        $username = $this->session->userdata('username');
        $data['user'] = $this->sme_user->getalldetails($username);
        $user_details = $this->sme_user->getalldetails($username);
        $password = $this->input->post('password');
        $passconf = $this->input->post('passconf2');
        //form validation
        $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
        //$this->form_validation->set_rules('last_name','Last Name','required|xss_clean|alpha');
        //$this->form_validation->set_rules('password','Password','required|matches[passconf2]');
        //$this->form_validation->set_rules('passconf2', 'Password Confirmation', 'required');
        //$this->form_validation->set_rules('gender','Gender','required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        //$this->form_validation->set_rules('about','About','required');
        //$this->form_validation->set_rules('expertise','Expertise','required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|min_length[10]|regex_match[/^[0-9 +]+$/]');



        if ($this->form_validation->run() == FALSE || ($password != $passconf)) {
            $data['passerror'] = 'Password and Password Confirmation fields dont not match';
            $data['main_content'] = 'sme_edit_profile';
            $this->load->view('includes/sme_template', $data);
        } else {

            $password = $this->input->post('password');
            if ($password != '') {
                $this->load->helper('phpass');
                $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
                $hash_password = $hasher->HashPassword($password);
                $data = array(
                    'password' => $hash_password
                );

                $this->sme_user->update_password($smeuser_id, $data);
            }


            if ($_FILES['header_image']['name'] != '') {
                $config['upload_path'] = './sme_users/' . $smeuser_id;
                $config['allowed_types'] = 'png|jpeg|jpg|PNG|JPEG|JPG';
                $this->load->library('upload', $config);
                $this->upload->do_upload('header_image');
                $upload_data21 = $this->upload->data();
                $header_image = $upload_data21['file_name'];

                $profile_data = array(
                    'header_image' => $header_image
                );
                $this->sme_user->user_profile_update($profile_data, $smeuser_id);
            }

            if (!(empty($_FILES['userfile']['name']))) {

                $config['upload_path'] = './sme_users/' . $smeuser_id;
                $config['allowed_types'] = 'gif|jpg|png';

                if (!is_dir('sme_users/' . $smeuser_id)) {
                    mkdir('./sme_users/' . $smeuser_id, 0777, true);
                }

                $this->load->library('upload', $config);


                if (!$this->upload->do_upload()) {
                    $data['errors'] = array('error' => $this->upload->display_errors());

                    $data['main_content'] = 'sme_edit_profile';
                    $data['main_content'] = 'sme_edit_profile';
                    $this->load->view('includes/sme_template', $data);
                }

                $data = $this->upload->data();
                $photo = $data['file_name'];
                $this->session->set_userdata(array(
                    'photo' => $photo
                ));
            }
            $dob = date('Y-m-d', strtotime($this->input->post('dob')));
            $v_sd = date('Y-m-d', strtotime($this->input->post('start_date')));
            $v_ed = date('Y-m-d', strtotime($this->input->post('end_date')));
            if (!(empty($_FILES['userfile']['name']))) {

                $profile_data = array(
                    'first_name' => $this->input->post('first_name'),
                    //'last_name'    	=> $this->input->post('last_name'),
                    'address' => $this->input->post('address'),
                    'phone' => $this->input->post('phone'),
                    'dob' => $dob,
                    //'gender'    	=> $this->input->post('gender'),
                    'callback_time' => $this->input->post('callbk_time'),
                    'vac_start_date' => $v_sd,
                    'vac_end_date' => $v_ed,
                    'about' => $this->input->post('about'),
                    'expertise' => $this->input->post('expertise'),
                    'photo' => $photo
                );

                $this->session->set_userdata(array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $user_details->last_name,
                    'username' => $user_details->username,
                    'photo' => $photo,
                ));
            } else {
                $profile_data = array(
                    'first_name' => $this->input->post('first_name'),
                    //'last_name'    	=> $this->input->post('last_name'),
                    'address' => $this->input->post('address'),
                    'phone' => $this->input->post('phone'),
                    'dob' => $dob,
                    //'gender'    	=> $this->input->post('gender'),
                    'callback_time' => $this->input->post('callbk_time'),
                    'vac_start_date' => $v_sd,
                    'vac_end_date' => $v_ed,
                    'about' => $this->input->post('about'),
                    'expertise' => $this->input->post('expertise')
                );

                $this->session->set_userdata(array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $user_details->last_name,
                    'username' => $user_details->username
                ));
            }
            $this->sme_user->user_profile_update($profile_data, $smeuser_id);
            $this->session->set_flashdata('msg', 'Profile is updated Successfully');
            redirect('sme/profile');
        }
    }

    public function forgot_password() {
        $data['main_content'] = 'sme_forgot_password';
        $this->load->view('includes/sme_template', $data);
    }

    public function send_mail() {
        $useremail = $this->input->post('email');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|valid_email');
        if ($this->form_validation->run() == false) {
            $data['main_content'] = 'sme_forgot_password';
            $this->load->view('includes/sme_template', $data);
        } else {
            $checkemail = $this->sme_user->check_mail($useremail);
            if ($checkemail == false) {
                $data['errors'] = 'You have not registered with this email ID';
                $data['main_content'] = 'sme_forgot_password';
                $this->load->view('includes/sme_template', $data);
            } else {
                $this->load->helper('date');
                $this->load->helper('rand_helper');

                date_default_timezone_set('Asia/Kolkata');
                $newFormat = date("Y-m-d H:i:s");
                $randomString = generateRandomString();
                $data = array('reset_string' => $randomString, 'reset_time' => $newFormat);
                $this->sme_user->save_random_string($useremail, $data);
                $user_details = $this->sme_user->getalldetails($useremail);
                $reset_link = $this->config->base_url() . 'sme/reset_password/' . $randomString;


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
                $data['main_content'] = 'sme_forgot_password';
                $this->load->view('includes/sme_template', $data);
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
            $data['main_content'] = 'sme_reset_password';
            $this->load->view('includes/sme_template', $data);
        } else if ($curdatetime > $expiredate) {
            $data['error'] = 'Sorry this link has been expired';
            $data['main_content'] = 'error';
            $this->load->view('includes/sme_template', $data);
        } else {
            $data['error'] = 'Sorry this link has been expired';
            $data['main_content'] = 'error';
            $this->load->view('includes/sme_template', $data);
        }
    }

    public function update_password() {
        $string = $this->input->post('random_key');
        $id = $this->sme_user->check_random($string);

        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['main_content'] = 'sme_reset_password';
            $this->load->view('includes/sme_template', $data);
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
            $data['main_content'] = 'success';
            $this->load->view('includes/sme_template', $data);
        }
    }

    public function logout() {
        $smeuserid = $this->session->userdata('sme_userid');
        $login_data = array(
            'active' => 'n'
        );

        $smeuser_id = $this->sme_user->update_smeuser_table($login_data, $smeuserid);
        $this->session->sess_destroy();
        redirect('sme/index');
    }

    public function settings() {
        $username = $this->session->userdata('username');
        $sme_userid = $this->session->userdata('sme_userid');
        $data['user'] = $this->sme_user->getalldetails($username);
        $data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
        $data['main_content'] = 'settings';
        $this->load->view('includes/sme_template', $data);
    }

    public function update_settings() {
        $data = $this->input->post();
        $smeuser_id = $this->session->userdata('sme_userid');
        $username = $this->session->userdata('username');
        $data['user'] = $this->sme_user->getalldetails($username);
        $user_details = $this->sme_user->getalldetails($username);
        $password = $this->input->post('password');
        $passconf = $this->input->post('passconf');
        if ($password != $passconf) {
            $data['passerror'] = 'Password and Password Confirmation fields dont not match';
            $data['main_content'] = 'settings';
            $this->load->view('includes/sme_template', $data);
        } else {
            $password = $this->input->post('password');
            if ($password != '' || ($password != $passconf)) {
                $this->load->helper('phpass');
                $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
                $hash_password = $hasher->HashPassword($password);
                $data = array(
                    'password' => $hash_password
                );

                $this->sme_user->update_password($smeuser_id, $data);
            }


            $profile_data = array(
                'first_name' => $this->input->post('first_name'),
                //'last_name'    	=> $this->input->post('last_name'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                    //'dob'   		=> $dob,
                    //'gender'    	=> $this->input->post('gender'),
                    //'callback_time' => $this->input->post('callbk_time'),
                    //'vac_start_date'=> $v_sd,
                    //'vac_end_date'  => $v_ed,
                    //'about'    		=> $this->input->post('about'),
                    //'expertise'    	=> $this->input->post('expertise')
            );

            $this->sme_user->user_profile_update($profile_data, $smeuser_id);
            $this->session->set_userdata(array(
                'first_name' => $user_details->first_name,
                'last_name' => $user_details->last_name,
                'username' => $user_details->username,
                    // 'photo'         => $user_details->photo,
            ));
			$this->session->set_flashdata('msg', 'Settings is updated Successfully');
            redirect('sme/settings');
        }
    }

    public function get_programs() {
        $data = $this->input->post();
        $programs = $this->sme_user->getprograms($data['service']);
        echo json_encode($programs);
    }

    public function get_offerings() {
        $data = $this->input->post();
        $offerings = $this->sme_user->getofferings($data['program_id']);
        echo json_encode($offerings);
    }

}
