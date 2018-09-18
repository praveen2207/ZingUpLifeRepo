<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class  for  listing static pages
 * @author Anitha <anitha@nuvodev.com>
 * Date:20-08-2015
 * */
class Static_pages extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Static_page');
    }

    /*
     *  Displaying static pages 
     */

    public function get_static_pages() {
        $this->User_activity->insert_user_activity();
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $static_page_name = $this->uri->segment(1);
        $data['static_pages_content'] = $this->Static_page->get_static_pages_content($static_page_name);
        $data['static_pages_gallery_path'] = base_url() . $this->config->item('static_pages_gallery_path');
        $data['main_content'] = 'static_page';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     *  Displaying customer support page 
     */

    public function customer_support() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $static_page_name = $this->uri->segment(1);
        $data['static_pages_content'] = $this->Static_page->get_static_pages_content($static_page_name);
        $data['static_pages_gallery_path'] = base_url() . $this->config->item('static_pages_gallery_path');

        $data['main_content'] = 'customer_support';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */


    /*
     *  Displaying terms of use  page
     */

    public function terms() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $static_page_name = $this->uri->segment(1);
        $data['static_pages_content'] = $this->Static_page->get_terms_privacy_content($static_page_name);

        $data['main_content'] = 'terms';
        $data['active_url'] = "terms";
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */



    /*
     *  Displaying privacy policy  page
     */

    public function privacy() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $static_page_name = $this->uri->segment(1);

        $data['static_pages_content'] = $this->Static_page->get_terms_privacy_content($static_page_name);

        $data['main_content'] = 'privacy';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     * Function for displaying  about us page
     */

    public function about_us() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $data['title'] = "ZingUpLife | About Us";
        $data['active_url'] = "about_us";
        $data['main_content'] = 'new_about_us';
        $this->load->view('includes/new_about_page_template', $data);
    }

    /* Above function ends here */

    /*
     *  Displaying faq  page
     */

    public function faq() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $this->load->model('Faq');
        $faqs = $this->Faq->get_all_faqs();
        
        //Segregate FAQ data into different arrays based on their section type.
       
        $customerfaqs 	= array();
        $smefaqs 		= array();
        $providerfaqs 	= array();
        
        foreach ($faqs as $tempfaq){
        	if ($tempfaq->section == 'C'){
        		$customerfaqs[] = $tempfaq;
        	}else  if ($tempfaq->section  == 'S') {
        		$smefaqs[] = $tempfaq;
        	}if ($tempfaq->section  == 'P'){
        		$providerfaqs[] = $tempfaq;
        	}
        	
        }
        $data['customerfaqs'] 	= $customerfaqs;
        $data['smefaqs'] 		= $smefaqs;
        $data['providerfaqs'] 	= $providerfaqs;
        
        $data['title'] = "ZingUpLife | Faqs";
        $data['main_content'] = 'faq';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */

    /*
     *  Displaying contact us  page
     */

    public function contact_us() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $data['title'] = "ZingUpLife | Contact Us";
        $data['active_url'] = "contact_us";
        $data['main_content'] = 'contact_us';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */

/*
     * Function contact us page enquiry process
     */
    public function contact_us_enquiry() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();

        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Contact Us";
            $data['active_url'] = "contact_us";
            $data['main_content'] = 'contact_us';
            $this->load->view('includes/menu_template', $data);
        } else {
            $this->session->set_flashdata('success_message', 'success');
            redirect("/contact_us");
        }
    }

    /*
     *  Displaying Careers  page
     */

    public function careers() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $this->load->model('Faq');
        $data['title'] = "ZingUpLife | Careers";
        $data['main_content'] = 'contact_us';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */
    /*
     *  Displaying customer support page
     */

    public function customersupport() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $data['title'] = "ZingUpLife | Customer Support";
        $data['main_content'] = 'contact_us';  // Change it right page when customer support page is done
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */

    /*
     *  Displaying partner support page
     */

    public function partnersupport() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $data['title'] = "ZingUpLife | Patner Support";
        $data['main_content'] = 'contact_us';           // Change it right page when partner support page is done
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */
}
