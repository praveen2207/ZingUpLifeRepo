<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for admin section login and users actions/activities
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:01-09-2015
 * */
class Sme extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Sme_admin_users');
    }

    

    /* Above function ends here */

    public function get_all_users() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $all_users = $this->Sme_admin_users->get_all_users();

            $data['all_users'] = $all_users;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/sme_users';
            $data['sub_url'] = 'sme_users';
            $data['title'] = 'Zingup Admin | Sme Users';
            $data['main_content'] = 'admin/sme_users';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
	
	public function user_search()
	{
		$data = $this->input->post();
        $result = $this->Sme_admin_users->search_user($data);
        echo json_encode($result);
	}
	
	/*
     *  Displaying login form 
     */

    public function add_user() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
			$data['main_services'] = $this->Sme_admin_users->getallmainservices();
            $data['url'] = 'admin/sme_users';
            $data['sub_url'] = 'sme_users';
            $data['title'] = 'Zingup Admin | Create SME User';
            $data['main_content'] = 'admin/sme_add_user';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
	
	public function create_users() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();

            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('username', 'Email', 'trim|required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('main_service', 'main service', 'required'); 
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_error_delimiters('<label generated="true" class="error">', '</label>');


            if ($this->form_validation->run() == FALSE) {
                $data['post_data'] = $post_data;
                $data['url'] = 'admin/sme_users';
                $data['sub_url'] = 'sme_users';
                $data['title'] = 'Zingup Admin | Create SME User';
                $data['main_services'] = $this->Sme_admin_users->getallmainservices();
                $data['main_content'] = 'admin/sme_add_user';
                $this->load->view('admin/includes/sme_user_template', $data);
            } else {

                $check_user_exists = $this->Sme_admin_users->check_username_availability($post_data['username']);
                if (!empty($check_user_exists)) {
                    $data['post_data'] = $post_data;
                    $data['url'] = 'admin/sme_users';
                    $data['sub_url'] = 'sme_users';
                    $data['title'] = 'Zingup Admin | Create SME User';
                    $data['error_message'] = 'Email already exists';
                    $data['main_services'] = $this->Sme_admin_users->getallmainservices();
                    $data['main_content'] = 'admin/sme_add_user';
                    $this->load->view('admin/includes/sme_user_template', $data);
                } else {
                    $password = 'testing';
					$this->load->helper('phpass'); 
					$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
					$hashed = $hasher->HashPassword($password);
                   // $hashed = PasswordHash::create_hash($password);
                    $this->Sme_admin_users->create_user($post_data, $hashed);  
                    $this->session->set_flashdata('sme_user_message', 'User Added successfully !!!.'); 
                    redirect("/admin/sme_users");
                }
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
	
	 public function edit_user_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_id = $this->uri->segment(4);
            $user_details = $this->Sme_admin_users->user_details($user_id);

			
            $data['user_details'] = $user_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/sme_users';
            $data['sub_url'] = 'sme_users';
            $data['title'] = 'Zingup Admin | Edit SME User Details';
            $data['main_content'] = 'admin/sme_edit_user_details';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
	
	public function update_user() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $post_data = $this->input->post();
            $update_user_details = $this->Sme_admin_users->update_user_details($post_data);
            if ($update_user_details == 1) {
                $this->session->set_flashdata('profile_update_message', 'success');
            } else {
                $this->session->set_flashdata('profile_update_message', 'error');
            }
            redirect("/admin/sme/edit_user_details/" . $post_data['user_id'] . ""); 
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
	
	public function delete_user() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->Sme_admin_users->delete_user($post_data['user_id']);
        return true;
    }
	
	public function user_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_id = $this->uri->segment(4);
            $user_details = $this->Sme_admin_users->user_details($user_id);

            $data['user_details'] = $user_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/sme_users';
            $data['sub_url'] = 'sme_users';
            $data['title'] = 'Zingup Admin | SME User Details';
            $data['main_content'] = 'admin/sme_users_details';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
    public function get_all_events() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $all_events = $this->Sme_admin_users->get_all_events();

            $data['all_events'] = $all_events;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/sme_events';
            $data['sub_url'] = 'sme_events';
            $data['title'] = 'Zingup Admin | Sme Events';
            $data['main_content'] = 'admin/sme_events';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
    public function event_search()
	{
		$data = $this->input->post();
        $result = $this->Sme_admin_users->search_event($data);
        echo json_encode($result);
	}
	
	public function add_event() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $all_users = $this->Sme_admin_users->get_all_users();

            $data['all_users'] = $all_users;
            $data['url'] = 'admin/sme_events';
            $data['sub_url'] = 'sme_events';
            $data['title'] = 'Zingup Admin | Create SME Event';
            $data['main_content'] = 'admin/sme_add_event';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
    public function create_event() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();

            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sme_user', 'SME User', 'trim|required|xss_clean');
            $this->form_validation->set_rules('location', 'Location', 'trim|required|xss_clean');
            $this->form_validation->set_rules('date', 'Date', 'trim|required');
            $this->form_validation->set_rules('start_time', 'Start Time', 'required');
            $this->form_validation->set_rules('duration', 'Duration', 'required|numeric');
            $this->form_validation->set_rules('total_slots', 'Total Slots', 'required|numeric');
            $this->form_validation->set_rules('slots_available', 'Slots Available', 'required|numeric');
            $this->form_validation->set_rules('joining_fee', 'Joining Fee', 'required|numeric');
            $this->form_validation->set_rules('discount', 'Discount', 'required|numeric');
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_message('numeric', 'This field should contain numeric values');
            $this->form_validation->set_error_delimiters('<label generated="true" class="error">', '</label>');
            

            if ($this->form_validation->run() == FALSE) {
				
				$all_users = $this->Sme_admin_users->get_all_users();

				$data['all_users'] = $all_users;
                $data['post_data'] = $post_data;
                $data['url'] = 'admin/sme_events';
                $data['sub_url'] = 'sme_events';
                $data['title'] = 'Zingup Admin | Create SME Event';
                $data['main_content'] = 'admin/sme_add_event';
                $this->load->view('admin/includes/sme_user_template', $data);
            } else { 
                    $this->Sme_admin_users->create_event($post_data);
                    $this->session->set_flashdata('sme_event_message', 'Event Added successfully!!!.');
                    redirect("/admin/sme_events");
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
     public function edit_event_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $event_id = $this->uri->segment(4);
            $all_users = $this->Sme_admin_users->get_all_users();	
            $event_details = $this->Sme_admin_users->event_details($event_id);
            
			$data['all_users'] = $all_users;
            $data['event_details'] = $event_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/sme_events';
            $data['sub_url'] = 'sme_events';
            $data['title'] = 'Zingup Admin | Edit SME Event Details';
            $data['main_content'] = 'admin/sme_edit_event_details';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
    public function update_event()
    {
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();
				
				$all_users = $this->Sme_admin_users->update_event($post_data,$post_data['event_id']);

				$data['all_users'] = $all_users;
                $data['post_data'] = $post_data;
                $data['url'] = 'admin/sme_events';
                $data['sub_url'] = 'sme_events';
                redirect("/admin/sme/edit_event_details/" . $post_data['event_id'] . ""); 

        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
	}
	
	public function delete_event() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->Sme_admin_users->delete_event($post_data['event_id']);
        return true;
    }
    
    public function event_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $event_id = $this->uri->segment(4);
            $event_details = $this->Sme_admin_users->event_details($event_id);

            $data['event_details'] = $event_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/sme_events';
            $data['sub_url'] = 'sme_events';
            $data['title'] = 'Zingup Admin | SME Event Details';
            $data['main_content'] = 'admin/sme_event_details';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
    public function get_all_articles() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
			$all_users = $this->Sme_admin_users->get_all_users();	
            $all_articles = $this->Sme_admin_users->get_all_articles();

			$data['all_users'] = $all_users;
            $data['all_articles'] = $all_articles;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/sme_articles';
            $data['sub_url'] = 'sme_articles';
            $data['title'] = 'Zingup Admin | Sme Articles';
            $data['main_content'] = 'admin/sme_articles';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
    public function article_search()
    {
		$data = $this->input->post();
        $result = $this->Sme_admin_users->search_article($data);
        echo json_encode($result);
	}
	
	
    
    public function add_article() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $all_users = $this->Sme_admin_users->get_all_users();

            $data['all_users'] = $all_users;
            $data['url'] = 'admin/sme_articles';
            $data['sub_url'] = 'sme_articles';
            $data['title'] = 'Zingup Admin | Create SME Article';
            $data['main_content'] = 'admin/sme_add_article';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
    public function create_article() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();

            $this->form_validation->set_rules('heading', 'Heading', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sme_user', 'SME User', 'trim|required|xss_clean');
            $this->form_validation->set_rules('content', 'Content', 'trim|required|xss_clean');
            
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_message('numeric', 'This field should contain numeric values');
            $this->form_validation->set_error_delimiters('<label generated="true" class="error">', '</label>');
            

            if ($this->form_validation->run() == FALSE) {
				
				$all_users = $this->Sme_admin_users->get_all_users();

				$data['all_users'] = $all_users;
                $data['post_data'] = $post_data;
                $data['url'] = 'admin/sme_articles';
                $data['sub_url'] = 'sme_articles';
                $data['title'] = 'Zingup Admin | Create SME Article';
                $data['main_content'] = 'admin/sme_add_article';
                $this->load->view('admin/includes/sme_user_template', $data);
            } else { 
                    $this->Sme_admin_users->create_article($post_data);
                     $this->session->set_flashdata('sme_article_message', 'Article Added successfully!!!.');
                    redirect("/admin/sme_articles");
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
     public function edit_article_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $all_users = $this->Sme_admin_users->get_all_users();	
            $article_details = $this->Sme_admin_users->article_details($id);
            
			$data['all_users'] = $all_users;
            $data['article_details'] = $article_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/sme_articles';
            $data['sub_url'] = 'sme_articles';
            $data['title'] = 'Zingup Admin | Edit SME Article Details';
            $data['main_content'] = 'admin/sme_edit_article_details';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
    public function update_article()
    {
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();
				
				$all_users = $this->Sme_admin_users->update_article($post_data,$post_data['article_id']);

				$data['all_users'] = $all_users;
                $data['post_data'] = $post_data;
                $data['url'] = 'admin/sme_articles';
                $data['sub_url'] = 'sme_articles';
                redirect("/admin/sme_edit_article_details/" . $post_data['article_id'] . ""); 

        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
	}
	
	public function delete_article() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->Sme_admin_users->delete_article($post_data['article_id']);
        return true;
    }
    
     public function article_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $article_details = $this->Sme_admin_users->article_details($id);

            $data['article_details'] = $article_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/sme_articles';
            $data['sub_url'] = 'sme_articles';
            $data['title'] = 'Zingup Admin | SME Article Details';
            $data['main_content'] = 'admin/sme_article_details';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
	public function get_programs()
	{
		$data = $this->input->post();
		$programs = $this->Sme_admin_users->getprograms($data['service']);
		echo json_encode($programs);
	}
	
	public function get_offerings()
	{
		$data = $this->input->post();
		$offerings = $this->Sme_admin_users->getofferings($data['program_id']);
		echo json_encode($offerings);
	}
	
	public function edit_user_status()
	{
		$status = $this->uri->segment(5);
		$id = $this->uri->segment(4);
		
		$this->Sme_admin_users->change_status($status,$id); 
		redirect('admin/sme_users');
	}
	
	public function sme_amount() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $amount = $this->Sme_admin_users->get_amt();

            $data['amount'] = $amount;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/sme_amount';
            $data['sub_url'] = 'sme_amount';
            $data['title'] = 'Zingup Admin | SME Amount';
            $data['main_content'] = 'admin/sme_amount';
            $this->load->view('admin/includes/sme_user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
	
	public function update_amount()
    {
		$logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();
				
			$this->Sme_admin_users->update_amount($post_data['amount'],$post_data['id']);

			redirect("/admin/sme/sme_amount"); 

        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
	}
}
