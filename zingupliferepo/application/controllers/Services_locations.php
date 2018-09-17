<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for getting services by location
 * @author Anitha <anitha@nuvodev.com>
 * Date:06-08-2015
 * */
class Services_locations extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Services_location');
    }

    public function index() {
        
    }

    /*
     * Function to get services by location 
     */

    public function get_services_list_by_location() {
        $this->User_activity->insert_user_activity();
        $Location = $this->uri->segment(2);
        $get_services_list_by_location = $this->Services_location->get_services_list_by_location($Location);
        if (!empty($get_services_list_by_location)) {
            echo json_encode($get_services_list_by_location);
        } else {
            echo 'No Data Found';
        }
    }

    /* Above function ends here */
}
