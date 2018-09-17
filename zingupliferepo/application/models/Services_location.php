<?php

/**
 * This class gives location  details for services
 * 
 * @author Anitha <anitha@nuvodev.com>
 * 
 * Date:06-08-2015
 * 
 * */
class Services_location extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Function to get services by location id
     */

    public function get_services_list_by_location($location_id) {
        $this->db->select('services_business_mapping.services_id');
        $this->db->from('services_business_mapping');
        $this->db->join('business_details', 'business_details.id = services_business_mapping.business_id');
        $this->db->join('locations', 'locations.id = business_details.suburb');
        $this->db->where('locations.id', $location_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $service_result = array();
        if (!empty($query_result)) {
            foreach ($query_result as $value) {
                $this->db->select('id,service_name');
                $this->db->from('services');
                $this->db->where('id', $value->services_id);
                $query2 = $this->db->get();
                $query_result2 = $query2->result();
                $service_result[] = $query_result2[0];
            }
        }
        return $service_result;
    }

    /* Above function ends here */
}
