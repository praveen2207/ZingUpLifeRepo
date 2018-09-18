<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for home page of the website or landing page of the  website
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:04-08-2015
 * */
class Page_not_found extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $this->output->set_status_header('404');
        $data['title'] = "ZingUpLife | Page Not Found";
        $data['main_content'] = 'error_page';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */
}
