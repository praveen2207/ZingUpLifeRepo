<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for Vendors listing, filter vendors by services and vendor's details
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:03-09-2015
 * */
class Customers extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Customer');
    }

    /*
     *  Displaying login form 
     */

    public function get_all_customers() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['customer_joining_date'] = date('Y/m/d', strtotime('-30 days'));
            $all_customers = $this->Customer->get_all_customers($data['customer_joining_date']);
            $data['all_customers'] = $all_customers;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/customers';
            $data['title'] = 'Zingup Customer Support | Customers';
            $data['main_content'] = 'admin/customer_support_customers';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    public function customers_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_id = $this->uri->segment(3);
            $data['current_date'] = date("Y/m/d");
            $data['end_date'] = date('Y/m/d', strtotime('-30 days'));
            $end_date = $data['current_date'];
            $start_date = $data['end_date'];
            $this->load->model('Services');
            $data['services'] = $this->Services->get_services_list();

            $customer_details = $this->Customer->get_customer_details_and_transactions($user_id, $start_date, $end_date);
            $data['start_date'] = $end_date;
            $data['end_date'] = $start_date;
            $data['customer_details'] = $customer_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/customers';
            $data['title'] = 'Zingup Customer Support | Customers Details';
            $data['main_content'] = 'admin/customer_support_customer_details';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /*
     *  Displaying login form 
     */

    public function customers_filter() {
        $post_data = $_POST;
        $data['joining_date'] = $post_data['joining_date'];
        $joining_date = $data['joining_date'];
        $all_customers = $this->Customer->get_all_customers($joining_date);
        echo json_encode($all_customers);
    }

    /* Above function ends here */

    /*
     *  customer table search filter
     */

    public function get_customer_filter_search() {
        $data = $this->input->post();
        $result = $this->Customer->get_customer_search($data);
        echo json_encode($result);
    }

    /*
     *  Displaying login form 
     */

    public function get_all_customers_for_finance() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['customer_joining_date'] = date('Y/m/d', strtotime('-30 days'));
            $all_customers = $this->Customer->get_all_customers($data['customer_joining_date']);
            $data['all_customers'] = $all_customers;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'finance/customers';
            $data['title'] = 'Zingup Finance | Customers';
            $data['main_content'] = 'admin/finance_customers';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    public function customers_details_for_finance() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_id = $this->uri->segment(3);
            $data['current_date'] = date("Y/m/d");
            $data['end_date'] = date('Y/m/d', strtotime('-30 days'));
            $end_date = $data['current_date'];
            $start_date = $data['end_date'];
            $this->load->model('Services');
            $data['services'] = $this->Services->get_services_list();

            $customer_details = $this->Customer->get_customer_details_and_transactions_for_finance($user_id);

            $data['start_date'] = $end_date;
            $data['end_date'] = $start_date;
            $data['customer_details'] = $customer_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'finance/customers';
            $data['title'] = 'Zingup Finance | Customers Details';
            $data['main_content'] = 'admin/finance_customer_details';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /*
     *  Displaying login form 
     */

    public function get_all_customers_for_admin() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['customer_joining_date'] = date('Y/m/d', strtotime('-30 days'));
            $all_customers = $this->Customer->get_all_customers($data['customer_joining_date']);
            $data['all_customers'] = $all_customers;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/customers';
            $data['title'] = 'Zingup Admin | Customers';
            $data['main_content'] = 'admin/admin_customers';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    public function admin_customers_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_id = $this->uri->segment(3);

            $data['current_date'] = date("Y/m/d");
            $data['end_date'] = date('Y/m/d', strtotime('-30 days'));
            $end_date = $data['current_date'];
            $start_date = $data['end_date'];

            $this->load->model('Services');
            $data['services'] = $this->Services->get_services_list();

            $customer_details = $this->Customer->get_customer_details_and_transactions($user_id, $start_date, $end_date);
            $data['customer_details'] = $customer_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['start_date'] = $end_date;
            $data['end_date'] = $start_date;
            $data['url'] = 'admin/customers';
            $data['title'] = 'Zingup Admin | Customers Details';
            $data['main_content'] = 'admin/admin_customer_details';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    public function edit_customers_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_id = $this->uri->segment(3);

            $data['current_date'] = date("Y/m/d");
            $data['end_date'] = date('Y/m/d', strtotime('-30 days'));
            $end_date = $data['current_date'];
            $start_date = $data['end_date'];


            $customer_details = $this->Customer->get_customer_details_and_transactions($user_id, $start_date, $end_date);
            $data['customer_details'] = $customer_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['start_date'] = $end_date;
            $data['end_date'] = $start_date;
            $data['url'] = 'admin/customers';
            $data['title'] = 'Zingup Admin | Edit Customer Details';
            $data['main_content'] = 'admin/edit_customer_details';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    public function update_customer() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();

        $update_customer_details = $this->Customer->update_customer_details($post_data);
        if ($update_customer_details == 1) {
            $this->session->set_flashdata('profile_update_message', 'success');
        } else {
            $this->session->set_flashdata('profile_update_message', 'error');
        }
        redirect("/admin/edit_customer_details/" . $post_data['user_id'] . "");
    }

    public function delete_customer() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->Customer->delete_customer($post_data['customer_id']);
        return true;
    }

    /*
     *  customer details transactions table  filter
     */

    public function customer_transactions_filter() {
        $data = $this->input->post();
        $result = $this->Customer->customer_transations_filter($data);
        echo json_encode($result);
    }

    /*
     *  customer details transactions table  filter
     */

    public function customer_transactions_sorting() {
        $data = $this->input->post();
        $result = $this->Customer->customer_transactions_sorting($data);
        echo json_encode($result);
    }

}
