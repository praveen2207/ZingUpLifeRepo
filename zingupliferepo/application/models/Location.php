<?php

/**
 * This class gives locaions details and location filter
 * 
 * @author Anitha <anitha@nuvodev.com>
 * 
 * Date:05-08-2015
 * 
 * */
class Location extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Function to get locations by service id
     */

    public function get_locations_by_service_id($service_id) {
        $this->db->select('business_details.*,locations.suburb as area_name');
        $this->db->from('business_details');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('services_business_mapping.services_id', $service_id);
        $this->db->group_by('business_details.suburb');
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */


    /*
     * Function to get locations by service 
     */

    public function get_locations_by_city($service_id, $city) {
        $this->db->select('business_details.*');
        $this->db->from('business_details');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
        $this->db->where('services_business_mapping.services_id', $service_id);
        $this->db->where('business_details.city', $city);
        $this->db->group_by('business_details.suburb');
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */


    /*
     * Function to get near locations 
     */

    public function get_near_by_locations($lat, $lng) {
        $lat1 = $lat;
        $lon1 = $lng;
        $d = 5;

        $r = 3959;
        $latN = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(0))));
        $latS = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(180))));
        $lonE = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(90)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
        $lonW = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(270)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
        $query = "SELECT * FROM locations WHERE (latitude <= $latN AND latitude >= $latS AND longitude <= $lonE AND longitude >= $lonW) limit 5";
        $list_lat_long = $this->db->query($query);
        return $list_lat_long->result();
    }

    /* Above function ends here */


    /*
     * Function to get near locations details
     */

    public function get_near_by_locations_details($lat, $long) {
        $this->db->select('*');
        $this->db->from('business_details');
        $this->db->where('latitude', $lat);
        $this->db->where('longitude', $long);
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $location_details = $query_result;
        } else {
            $location_details = $query_result[0];
        }
        return $location_details;
    }

    /* Above function ends here */
	
	//localization
	public function getCities($c)
	{
		$this->db->select('city');
		$this->db->from('locations');
		$this->db->like('country',$c,'both');
		$this->db->group_by('city');
		$q = $this->db->get();
		
		return $q->result();
	}
}
