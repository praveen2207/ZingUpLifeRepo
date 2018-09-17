<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class gives business offerings services and details
 * 
 * @author Anitha <anitha@nuvodev.com>
 * 
 * Date:04-08-2015
 * 
 * */
class BusinessOfferings extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('BusinessOffering');
        $this->load->helper('text');
    }

    /*
     * Function to get business offering services list by program
     */

    public function getBusinessOfferingServicesList() {
        $this->UserActivity->insertUserActivity();
        $program = $this->uri->segment(2);
        $data['getOfferingServicesList'] = $this->BusinessOffering->getOfferingServicesList($program);
        $data['loggedInUserData'] = $this->session->userdata('logged_in_user_data');
        $data['title'] = "Offering Services";
        $this->load->view('services_list', $data);
    }

    /* Above function ends here */


    /*
     * Function to get  business offering service's details by service id
     */

    public function getBusinessOfferingServicesDetails() {
        $this->UserActivity->insertUserActivity();
        $serviceId = $this->uri->segment(2);
        $data['getServicesDetails'] = $this->BusinessOffering->getServicesDetails($serviceId);
        $data['path'] = base_url() . $this->config->item('business_services_gallery_path');
        $data['loggedInUserData'] = $this->session->userdata('logged_in_user_data');
        $data['title'] = $data['getServicesDetails']['details']->services;
        $this->load->view('services_details', $data);
    }

    /* Above function ends here */
}
