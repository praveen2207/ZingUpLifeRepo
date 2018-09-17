<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wellness_tips extends CI_Controller {

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
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent:: __construct();
        $this->load->library('PasswordHash');
        $this->load->model('Admin_users');
    }
	
		/* Wellness Tips */
	public function tips()
	{
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_roles = $this->Admin_users->get_user_roles();

            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['user_roles'] = $user_roles;
            $data['url'] = 'admin/tips';
            $data['sub_url'] = 'tips';
            $data['title'] = 'Zingup Admin | Daily Wellness Tips';
            $data['main_content'] = 'admin/add_wellness_tips';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
	}
	
	public function add_wellness_tip()
	{
		if (!(empty($_FILES['userfile']['name']))) {
			if (!file_exists('./wellness_tips/'.$id)) {
						mkdir('./wellness_tips/'.$id, 0777, true);
					}
						
				$config['upload_path'] = './wellness_tips/';
				$config['allowed_types'] = 'gif|jpg|png|PNG|JPG|jpeg|JPEG|GIF';
				
				
				$this->load->library('upload', $config);
				$this->upload->do_upload();
				$file = $this->upload->data();
				
				$logged_in_user_details = $this->session->userdata('logged_in_user_data');
				$this->Admin_users->add_wellness_tip($file['file_name'],$logged_in_user_details->user_id);
				$this->session->set_flashdata('message', 'Image is uploaded successfully');
				redirect('/admin/Wellness_tips/tips');
			}
	}

}
