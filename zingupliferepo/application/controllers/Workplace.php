<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
/**
 * This class for home page of the website or landing page of the  website
 * @author manikandan <manikandan@zinguplife.com>
 * Date:20-08-2018
 * */
class Workplace extends CI_Controller {
    
    public function __construct() {
        parent:: __construct();
    }
    
    /*
     * Function for displaying  workplace offering page
     */
    public function index() {
        
        $data['title'] = "ZingUpLife | Home";
        //$data['main_content'] = 'workplace_offerings';
        //$data['active_url'] = 'home_page';
        /* $this->load->view('includes/new_menu_template', $data); */
        $this->load->view('workplace_offerings',$data);
        
    }
    
    
    /* Above function ends here */

}
