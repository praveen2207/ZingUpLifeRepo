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

class Upload_controller extends CI_Controller {

    public function __construct() {
        parent:: __construct();
	$this->load->model('upload_model');
        
    }
    public function view_upload_landing_page(){
//        $data['title']          = "Get your personalized wellbeing score now";
//        $data['main_content']   = 'assessment/index';
        $this->load->view('upload_landing_page');
    }
    public function upload_file(){
	$post_data = $_POST;
	$config['upload_path']	    = APPPATH.'views/landing_pages/';
	$config['allowed_types']    = '*';
	$config['max_size']         = 200000;   //16777215
	$config['file_name']        = $_FILES['name_of_file']['name'];
	
	$this->load->library('upload', $config);
	$this->upload->initialize($config);
	
	$detail=$this->upload->data();
	if ( ! $this->upload->do_upload('name_of_file'))
	    {
	    $error = array('error' => $this->upload->display_errors());
	    }
	else
	    {
		//echo 'file uploaded successfully';
	    }
	$data=array(
	    'page_name' => $post_data['page_name'],
	    'file_name' => $detail['file_name']
		);
	$this->upload_model->insert_uploaded_file($data);
	    
	
    }
    
}
