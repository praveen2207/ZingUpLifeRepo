<?php

/**
 * This class gives services and details
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:04-08-2015
 * 
 * */
class Services extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Function to get all Services 
     */

    public function get_services_list() {
        $query = $this->db->get('services');
        $query_result = $query->result();
        foreach ($query_result as $key => $value) {
            $this->load->model('Business');
            $locations = $this->Business->get_locations_by_service($value->id);
            if (empty($locations)) {
                unset($query_result[$key]);
            }
        }
        return $query_result;
    }

    /* Above function ends here */

    /*
     * Function to get service details by service id
     */

    public function get_service_detail_by_id($service_id) {
        $this->db->select('*');
        $this->db->from('services');
        $this->db->where('id', $service_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $service_details = array();
        if (!empty($query_result)) {
            $service_details = $query_result[0];
        } else {
            $service_details = $query_result;
        }
        return $service_details;
    }

    /* Above function ends here */



    /*
     * Function to get location details by id
     */

    public function get_location_by_id($location_id) {
        $this->db->select('id,suburb');
        $this->db->from('locations');
        $this->db->where('id', $location_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $location_details = array();
        if (!empty($query_result)) {
            $location_details = $query_result[0];
        } else {
            $location_details = $query_result;
        }
        return $location_details;
    }

    /* Above function ends here */
}
