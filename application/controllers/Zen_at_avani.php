<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
/**
 * This class for home page of the website or landing page of the  website
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:04-08-2015
 * */
class Zen_at_avani extends CI_Controller {
    
    public function __construct() {
        parent:: __construct();
    }
    
    /*
     * Function for displaying  home page of the website or landing page of the  website
     */
    public function event_page() {
        /* $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $this->load->model('Services');
        $data['services'] = $this->Services->get_services_list();
        $data['services_image_path'] = base_url() . $this->config->item('services_image_path');
        $data['title'] = "Home";
        $data['main_content'] = 'main_page';
        $this->load->view('includes/template', $data); */
        
        $data['title'] = "Home";
        $this->load->view('avani/home', $data);
        
    }
    /* Above function ends here */

}
