<?php

/* 
 * Created By : Vadivel N
 * Created Date : 06th FEB, 2016
 * Description : Admin Login
 */
class Logout extends CI_Controller 
{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
       
    }
    public function index() {

        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('institute_data');
        session_destroy();
        redirect(base_url());
    }
    
    
    

}
