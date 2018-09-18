<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for FAQ questions and answers
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:02-09-2015
 * */
class Faqs extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Faq');
    }

    /*
     *  Displaying login form 
     */

    public function index() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $all_faqs = $this->Faq->get_all_faqs();
            $data['all_faqs'] = $all_faqs;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['title'] = 'Zingup Customer Support | FAQs';
            $data['url'] = 'customer_support/faqs';
            $data['main_content'] = 'admin/faqs';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *   faq  filter
     */

    public function faq_filter() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $text = $this->input->post('text');
        $data['faq'] = $faq = $this->Faq->get_faq($text);
        $data['logged_in_user_details'] = $logged_in_user_details;
        echo json_encode($data);
    }

    /* Above function ends here */
}
