<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class using for searching services,programs offered and offering services by name and location
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:25-11-2015
 * */
class Search extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Searches');
    }

    /*
     * Function to get locations by service 
     */

    public function index() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        unset($post_data['submit']);
        $search_result = $this->Searches->store_search_keywords($post_data);
		//print_r($search_result); exit();
        $this->load->model('Services');
        $data['services'] = $this->Services->get_services_list();
        $data['post_data'] = $post_data;
        $data['search_result'] = $search_result;
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['active_url'] = "service_providers";
        $data['title'] = "ZingUpLife | Services & Providers";
        $data['main_content'] = 'searchs';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */
    /*
     * Function to get locations by service 
     */

    public function search() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();

        $keywords = $this->uri->segment(2);
        $search_result = $this->Searches->search_keywords($keywords);

        $this->load->model('Services');
        $data['services'] = $this->Services->get_services_list();
        $data['keywords'] = $keywords;
        $data['search_result'] = $search_result;
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['active_url'] = "service_providers";
        $data['title'] = "ZingUpLife | Services & Providers";
        $data['main_content'] = 'search';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */



    /*
     * Function to get locations by service 
     */

    public function searchs() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();

        $keywords = $this->uri->segment(2);

        $search_result = $this->Searches->search_keywords($keywords);
        $this->load->model('Services');
        $data['services'] = $this->Services->get_services_list();

        $data['search_result'] = $search_result;
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['title'] = "ZingUpLife | Services & Providers";
        $data['main_content'] = 'search';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */


    /*
     * Function to get locations by service 
     */

    public function search_filter() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $filter_data = $this->input->post();
        $this->load->model('Searches');
        $filter_result = $this->Searches->filter($filter_data);
        $filter_result_data = self::serach_filter_result($filter_result);
        return $filter_result_data;
    }

    /* Above function ends here */

    /*
     * Function for displaying  home page of the website or landing page of the  website
     */

    public function serach_filter_result($search_result) {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->load->model('Services');
        $data['services'] = $this->Services->get_services_list();
        $data['search_result'] = $search_result;
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['title'] = "ZingUpLife | Services & Providers";
        $data['main_content'] = 'search_filter_result';
        $this->load->view('search_filter_result', $data);
    }

    /* Above function ends here */

    /*
     * Function to get locations by service 
     */

    public function get_locations() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $location = $this->input->post('location');

        $search_result = $this->Searches->get_filter_locations($location);
        echo json_encode($search_result);
    }

    /* Above function ends here */

    /*
     * Function to get locations by service 
     */

    public function get_vendors() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $vendor = $this->input->post('vendor');

        $search_result = $this->Searches->get_filter_vendors($vendor);
        echo json_encode($search_result);
    }

    /* Above function ends here */
    /*
     * Function to get locations by service 
     */

    public function filter_result() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $filter_data = $this->input->post();

        $this->load->model('Searches');
        $filter_result = $this->Searches->serach_filter($filter_data);
        $filter_result_data = self::serach_filter_result($filter_result);
        return $filter_result_data;
    }

    /* Above function ends here */

    /*
     * Function to get locations by service 
     */

    public function filter_search_results() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $filter_data = $this->input->post();

        $this->load->model('Searches');
        $filter_result = $this->Searches->filter_search_results($filter_data);

        $filter_result_data = self::serach_filter_result($filter_result);
        return $filter_result_data;
    }

    /* Above function ends here */
    /*
     * Function to get locations by service 
     */

    public function search_result_filter() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $filter_data = $this->input->post();
        $this->load->model('Searches');
        $filter_result = $this->Searches->filter_serach_result_by_row_count($filter_data);
        $filter_result_data = self::search_filter_result_display($filter_result, $filter_data);
        return $filter_result_data;
    }

    /* Above function ends here */

    /*
     * Function for displaying  home page of the website or landing page of the  website
     */

    public function search_filter_result_display($search_result, $filter_data) {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->load->model('Services');
        $data['services'] = $this->Services->get_services_list();
        $data['search_result'] = $search_result;
        $data['filter_data'] = $filter_data;
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['title'] = "ZingUpLife | Services & Providers";
        $data['main_content'] = 'searchs_filter_result_display';
        $this->load->view('search_filter_result_display', $data);
    }

    /* Above function ends here */

    /*
     * Function to get locations by service 
     */

    public function search_result_filter_show() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $filter_data = $this->input->post();
        $this->load->model('Searches');
        $filter_result = $this->Searches->filter_serach_by_keywords_by_row_count($filter_data);
        $filter_result_data = self::filter_search_by_keywords_display($filter_result, $filter_data);
        return $filter_result_data;
    }

    /* Above function ends here */

    /*
     * Function for displaying  home page of the website or landing page of the  website
     */

    public function filter_search_by_keywords_display($search_result, $filter_data) {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->load->model('Services');
        $data['services'] = $this->Services->get_services_list();
        $data['search_result'] = $search_result;
        $data['filter_data'] = $filter_data;
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['title'] = "ZingUpLife | Services & Providers";
        $data['main_content'] = 'filter_search_by_keywords_display';
        $this->load->view('filter_search_by_keywords_display', $data);
    }

    /* Above function ends here */


    /*
     * Function to get locations by service 
     */

    public function filtering_search() {
        $post_data = $_POST['checkValues'];
            
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();

        $search_result = $this->Searches->searching_data();

        $filter_result_data = self::test_search($post_data, $search_result);
        echo $filter_result_data;
    }

    /* Above function ends here */

    public function test_search($post_data, $search_result) {
        $this->load->model('Services');
        $data['services'] = $this->Services->get_services_list();
        $data['post_data'] = $post_data;
        $data['search_result'] = $search_result;
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['active_url'] = "service_providers";
        $data['title'] = "ZingUpLife | Services & Providers";
        $data['main_content'] = 'filtering_search';

        $this->load->view('filtering_search', $data);
    }

}
