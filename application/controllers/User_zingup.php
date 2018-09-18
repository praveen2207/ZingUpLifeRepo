<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for users registration, login and users actions/activities
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:04-08-2015
 * */
class User_zingup extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('PasswordHash');
       // $this->load->model('Business_offering');
       // $this->load->model('Business');
        //$this->load->model('Bookings');
    }
	
	public function check()
	{
		if ($this->session->userdata('is_logged_in'))
		{
			$sme_userid = $this->input->post('sme_userid');
			$this->session->set_userdata('sme_id',$sme_userid);
			$data['referrer'] = $this->input->post('referrer');
			redirect($data['referrer']);
		}
		else
		{
			if( $this->session->userdata("referrer") == '')
			{
				$data['referrer'] = $this->input->post('referrer');
			}
			else
			{
				$data['referrer'] = $this->session->userdata("referrer");
			}
			$data['main_content'] = 'user_login';
			$this->load->view('includes/template',$data);
		}
	}

   
    public function login() {
			
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $referrer = $this->input->post('referrer');
        $user_validation_details = array();
        $this->load->model('User');
        $this->session->set_userdata("referrer", $referrer);
		 

        if ($username != '' && $password != '') {
			
            $validate_user = $this->User->validate_user($username, $password);
            if ($validate_user['validation_status']['status'] == 'Success') {
                $validate_user['user_details']->is_logged_in = '1';
                $this->session->set_userdata("logged_in_user_data", $validate_user['user_details']);
				$this->session->set_userdata(array(
							'type'          => 'user',
                            'is_logged_in'     => true
                    ));
                redirect("user_zingup/signin_success");
            } else {
                $validate_user['validation_status']['username'] = $username;
                $validate_user['validation_status']['password'] = $password;
                $this->session->set_flashdata('login_error_message', $validate_user['validation_status']);
				
                redirect("user_zingup/check");
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
            redirect("user_zingup/check");
        }
    }

    /* Above function ends here */


/*
     *  Function for signin redirect page
     */

    public function signin_success() {
		$this->load->model('User_activity');
        $this->User_activity->insert_user_activity();
        $data['referrer'] = $this->session->userdata('referrer');
        $data['main_content'] = 'signin-redirect';
        $this->load->view('includes/template', $data);
    }
	
	/*public function login() {
        //$this->load->library('user_agent');
        //$data['referrer'] = $this->agent->referrer();
        $data['main_content'] = 'user_login';
        $this->load->view('includes/template', $data);
    }*/
	
}
