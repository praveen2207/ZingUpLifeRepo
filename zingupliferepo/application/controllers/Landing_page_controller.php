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

class Landing_page_controller extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Landing_page_model');
    }
    
    public function get_landing_page(){
       
        
    error_log('debug', 'get_landing_page ');
    $page_name=$this->uri->uri_string;
	log_message('debug', 'get_landing_page $page_name '.$page_name);
	$data['landing_page_details'] = $this->Landing_page_model->landing_page_details($page_name);
	log_message('debug', 'get_landing_page $data[landing_page_details]'.$data['landing_page_details'] );
	$phpfile = $data['landing_page_details'][0]->file_name;
	log_message('debug', 'get_landing_page $phpfile  '.$phpfile);
	$viewfile = explode(".", $phpfile);
	log_message('debug', '$viewfile[0] '.$viewfile[0]);
	
	$this->load->view('landing_pages/'.$viewfile[0]);
    }  
}