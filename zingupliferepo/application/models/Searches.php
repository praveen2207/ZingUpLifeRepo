<?php

/**
 * This class for inserting and updating user activity logs
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:06-08-2015
 * 
 * */
class Searches extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Function to insert user activity log details
     */

    public function store_search_keywords($search_data) {

        if (!empty($search_data)) {
            $this->db->insert('search_keywords', $search_data);
        }
        $search_result = self::search($search_data);
        return $search_result;
    }

    /* Above function ends here */
    /*
     * Function to insert user activity log details
     */

    public function search($search_data) {
		$c = $this->session->userdata('country');
		$p = $this->session->userdata('place');
        $keyword = $search_data['keywords'];
        $location = $search_data['locations'];
        if ($search_data['keywords'] != '' && $search_data['locations'] != '') {

            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
            $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id', 'left');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id', 'left');
            $this->db->where("(services.service_name LIKE '%" . $this->db->escape_like_str($keyword) . "%' || business_details.name LIKE '%" . $this->db->escape_like_str($keyword) . "%' || business_services.services LIKE '%" . $this->db->escape_like_str($keyword) . "%')");
            $this->db->like('business_details.country', $c,'both');
			$this->db->like('business_details.city', $p,'both');
			if (is_numeric($search_data['locations'])) {
                $this->db->where('business_details.zipcode', $location);
            } else {
                $this->db->where("(locations.suburb LIKE '%$location%' || locations.city LIKE '%$location%')");
            }
            //$this->db->where('locations.city', $search_data['city']);
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif ($search_data['keywords'] != '' && $search_data['locations'] == '') {

            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude, services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
            $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id', 'left');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id', 'left');
            $this->db->where("(services.service_name LIKE '%" . $this->db->escape_like_str($keyword) . "%' || business_details.name LIKE '%" . $this->db->escape_like_str($keyword) . "%' || business_services.services LIKE '%" . $this->db->escape_like_str($keyword) . "%')");
            //$this->db->where('locations.city', $search_data['city']);
			$this->db->like('business_details.country', $c,'both');
			$this->db->like('business_details.city', $p,'both');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif ($search_data['keywords'] == '' && $search_data['locations'] != '') {

            if (is_numeric($search_data['locations'])) {
                $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude, services.*');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
                $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
                $this->db->where('business_details.zipcode', $search_data['locations']);
				$this->db->like('business_details.country', $c,'both');
				$this->db->like('business_details.city', $p,'both');
               // $this->db->where('locations.city', $search_data['city']);
                $this->db->group_by('business_details.id');
                $this->db->order_by('business_details.name', 'asc');
            } else {
                $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude, services.*');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
                $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
                $this->db->where("(locations.suburb LIKE '%$location%' || locations.city LIKE '%$location%')");
				$this->db->like('business_details.country', $c,'both');
				$this->db->like('business_details.city', $p,'both');
               // $this->db->where('locations.city', $search_data['city']);
                $this->db->group_by('business_details.id');
                $this->db->order_by('business_details.name', 'asc');
            }
        } else {

            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude, services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
            $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
            $this->db->order_by('business_details.name', 'asc');
			$this->db->like('business_details.country', $c,'both');
			$this->db->like('business_details.city', $p,'both');
        }
        $this->db->where('business_details.status', 'Active');
        $this->db->limit(10);
        $query = $this->db->get();
        $business_provider_details = $query->result();

        foreach ($business_provider_details as $key => $value) {
            $services = array();
            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id', 'left');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id', 'left');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->like('business_services.services', $this->db->escape_like_str($search_data['keywords']));
            $this->db->where('business_programs.business_id', $value->vendor_id);
            $services_query1 = $this->db->get();
            $services_results = $services_query1->result();

            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id', 'left');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id', 'left');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->where('business_programs.business_id', $value->vendor_id);
            // $this->db->limit(3);
            $services_query = $this->db->get();
            $services_results1 = $services_query->result();
            if (!empty($services_results)) {
                $services[] = $services_results;
            } else {
                $services[] = $services_results1;
            }
            $business_provider_details[$key]->offering_service = $services;

            $this->db->select('vendor_ratings.*,users.name');
            $this->db->from('vendor_ratings');
            $this->db->join('users', 'users.id = vendor_ratings.user_id');
            $this->db->where('vendor_ratings.vendor_id', $value->vendor_id);
            $this->db->where('vendor_ratings.status', 'Done');
            $reviewQuery = $this->db->get();
            $reviewQueryResult = $reviewQuery->result();
            $business_provider_details[$key]->review = count($reviewQueryResult);

            $this->db->select_avg('vendor_ratings.rating', 'average_rating');
            $this->db->from('vendor_ratings');
            $this->db->where('vendor_id', $value->vendor_id);
            $ave_query = $this->db->get();
            $ave_query_result = $ave_query->result();

            $business_provider_details[$key]->average_rating = $ave_query_result[0]->average_rating;
        }
//        echo "<pre>";
//        print_r($business_provider_details);
//        exit();
        return $business_provider_details;
    }

    /* Above function ends here */


    /*
     * Function to insert user activity log details
     */

    public function search_keywords($search_data) {
		$c = $this->session->userdata('country');
		$p = $this->session->userdata('place');

        $search_keywords = explode('=', $search_data);


        if (count($search_keywords) == 2) {
            $keyword = $search_keywords[1];

            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            $this->db->where('services.slug', $keyword);
			 $this->db->like('business_details.country', $c,'both');
			$this->db->like('business_details.city', $p,'both');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } else {
            $explode = explode('&', $search_keywords[1]);
            $keyword = $explode[0];

            $location = str_replace("%20", ' ', $search_keywords[2]);

            if ($keyword == 'all') {
                $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
                $this->db->join('services', 'services.id = services_business_mapping.services_id');
                $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
                $this->db->join('business_services', 'business_services.program_id = business_programs.id');
                $this->db->where('locations.suburb', $location);
				$this->db->like('business_details.country', $c,'both');
				$this->db->like('business_details.city', $p,'both');
                $this->db->group_by('business_details.id');
                $this->db->order_by('business_details.name', 'asc');
            } else {
                $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
                $this->db->join('services', 'services.id = services_business_mapping.services_id');
                $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
                $this->db->join('business_services', 'business_services.program_id = business_programs.id');
                $this->db->where('services.slug', $keyword);
                $this->db->where('locations.suburb', $location);
				$this->db->like('business_details.country', $c,'both');
				$this->db->like('business_details.city', $p,'both');
                $this->db->group_by('business_details.id');
                $this->db->order_by('business_details.name', 'asc');
            }
        }
        $this->db->where('business_details.status', 'Active');
        $this->db->limit(10);
        $query = $this->db->get();
        $business_provider_details = $query->result();

        foreach ($business_provider_details as $key => $value) {
            $services = array();
            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->where('business_programs.business_id', $value->vendor_id);
            //$this->db->limit(3);
            $services_query = $this->db->get();
            $services[] = $services_query->result();
            $business_provider_details[$key]->offering_service = $services;

            $this->db->select('vendor_ratings.*,users.name');
            $this->db->from('vendor_ratings');
            $this->db->join('users', 'users.id = vendor_ratings.user_id');
            $this->db->where('vendor_ratings.vendor_id', $value->vendor_id);
            $this->db->where('vendor_ratings.status', 'Done');
            $reviewQuery = $this->db->get();
            $reviewQueryResult = $reviewQuery->result();
            $business_provider_details[$key]->review = count($reviewQueryResult);

            $this->db->select_avg('vendor_ratings.rating', 'average_rating');
            $this->db->from('vendor_ratings');
            $this->db->where('vendor_id', $value->vendor_id);
            $ave_query = $this->db->get();
            $ave_query_result = $ave_query->result();

            $business_provider_details[$key]->average_rating = $ave_query_result[0]->average_rating;
        }
        return $business_provider_details;
    }

    /* Above function ends here */

    public function get_filter_locations($location) {
        $this->db->select('locations.*');
        $this->db->from('locations');
        $this->db->where('locations.city', 'Bangalore');
        $this->db->like('locations.suburb', $location);
        $location_query = $this->db->get();
        $location_result = $location_query->result();
        return $location_result;
    }

    public function get_filter_vendors($vendor) {
        $this->db->select('business_details.name');
        $this->db->from('business_details');
        $this->db->like('business_details.name', $vendor);
        $this->db->where('business_details.status', 'Active');
        $this->db->group_by('business_details.name');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    /* Above function ends here */
    /*
     * Function to insert user activity log details
     */

    public function serach_filter($filter_data) {


        $search_keywords = explode('=', $filter_data['keywords']);

        if (count($search_keywords) == 2) {
            $keyword = $search_keywords[1];
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            $this->db->where('services.slug', $this->db->escape_like_str($keyword));
            if ($filter_data['location'] != '' && $filter_data['vendor'] != '') {
                $this->db->where('locations.suburb', $filter_data['location']);
                $this->db->where('business_details.name', $filter_data['vendor']);
            } elseif ($filter_data['location'] != '' && $filter_data['vendor'] == '') {
                $this->db->where('locations.suburb', $filter_data['location']);
            } elseif ($filter_data['location'] == '' && $filter_data['vendor'] != '') {
                $this->db->where('business_details.name', $filter_data['vendor']);
            } else {
                
            }
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        }
        /* else {

          $explode = explode('&', $search_keywords[1]);
          $keyword = $explode[0];

          $location = str_replace("%20", ' ', $search_keywords[2]);

          if ($keyword == 'all') {
          $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
          $this->db->from('business_details');
          $this->db->join('locations', 'business_details.suburb = locations.id');
          $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
          $this->db->join('services', 'services.id = services_business_mapping.services_id');
          $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
          $this->db->join('business_services', 'business_services.program_id = business_programs.id');
          $this->db->where('locations.suburb', $location);
          if ($filter_data['location'] != '' && $filter_data['vendor'] != '') {
          $this->db->where('locations.suburb', $filter_data['location']);
          $this->db->where('business_details.name', $filter_data['vendor']);
          } elseif ($filter_data['location'] != '' && $filter_data['vendor'] == '') {
          $this->db->where('locations.suburb', $filter_data['location']);
          } elseif ($filter_data['location'] == '' && $filter_data['vendor'] != '') {
          $this->db->where('business_details.name', $filter_data['vendor']);
          } else {

          }
          $this->db->group_by('business_details.id');
          $this->db->order_by('business_details.name', 'asc');
          } else {
          $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
          $this->db->from('business_details');
          $this->db->join('locations', 'business_details.suburb = locations.id');
          $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
          $this->db->join('services', 'services.id = services_business_mapping.services_id');
          $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
          $this->db->join('business_services', 'business_services.program_id = business_programs.id');
          $this->db->where('services.slug', $keyword);
          $this->db->where('locations.suburb', $location);
          if ($filter_data['location'] != '' && $filter_data['vendor'] != '') {
          $this->db->where('locations.suburb', $filter_data['location']);
          $this->db->where('business_details.name', $filter_data['vendor']);
          } elseif ($filter_data['location'] != '' && $filter_data['vendor'] == '') {
          $this->db->where('locations.suburb', $filter_data['location']);
          } elseif ($filter_data['location'] == '' && $filter_data['vendor'] != '') {
          $this->db->where('business_details.name', $filter_data['vendor']);
          } else {

          }
          $this->db->group_by('business_details.id');
          $this->db->order_by('business_details.name', 'asc');
          }
          } */
        $this->db->where('business_details.status', 'Active');
        $query = $this->db->get();
        $business_provider_details = $query->result();



        foreach ($business_provider_details as $key => $value) {
            $services = array();
            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->where('business_programs.business_id', $value->vendor_id);
            $this->db->limit(0, 2);
            $services_query = $this->db->get();
            $services[] = $services_query->result();
            $business_provider_details[$key]->offering_service = $services;

            $this->db->select('vendor_ratings.*,users.name');
            $this->db->from('vendor_ratings');
            $this->db->join('users', 'users.id = vendor_ratings.user_id');
            $this->db->where('vendor_ratings.vendor_id', $value->vendor_id);
            $this->db->where('vendor_ratings.status', 'Done');
            $reviewQuery = $this->db->get();
            $reviewQueryResult = $reviewQuery->result();
            $business_provider_details[$key]->review = count($reviewQueryResult);

            $this->db->select_avg('vendor_ratings.rating', 'average_rating');
            $this->db->from('vendor_ratings');
            $this->db->where('vendor_id', $value->vendor_id);
            $ave_query = $this->db->get();
            $ave_query_result = $ave_query->result();

            $business_provider_details[$key]->average_rating = $ave_query_result[0]->average_rating;
        }

        return $business_provider_details;
    }

    /* Above function ends here */


    /*
     * Function to insert user activity log details
     */

    public function filter($filter_data, $keyword) {

        if ($filter_data['category'] != '' && $filter_data['location'] == '' && $filter_data['vendor'] == '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            $this->db->where('services.slug', $filter_data['category']);
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif ($filter_data['category'] == '' && $filter_data['location'] == '' && $filter_data['vendor'] != '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            $this->db->like('business_details.name', $filter_data['vendor']);
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif ($filter_data['category'] == '' && $filter_data['location'] != '' && $filter_data['vendor'] == '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            if (is_numeric($filter_data['location'])) {
                $this->db->where('business_details.zipcode', $filter_data['location']);
            } else {
                $this->db->like('locations.suburb', $filter_data['location']);
            }
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif ($filter_data['category'] != '' && $filter_data['location'] != '' && $filter_data['vendor'] == '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            $this->db->where('services.slug', $filter_data['category']);
            if (is_numeric($filter_data['location'])) {
                $this->db->where('business_details.zipcode', $filter_data['location']);
            } else {
                $this->db->like('locations.suburb', $filter_data['location']);
            }
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif ($filter_data['category'] == '' && $filter_data['location'] != '' && $filter_data['vendor'] != '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            $this->db->like('business_details.name', $filter_data['vendor']);
            if (is_numeric($filter_data['location'])) {
                $this->db->where('business_details.zipcode', $filter_data['location']);
            } else {
                $this->db->like('locations.suburb', $filter_data['location']);
            }
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif ($filter_data['category'] != '' && $filter_data['location'] == '' && $filter_data['vendor'] != '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            $this->db->where('services.slug', $filter_data['category']);
            $this->db->like('business_details.name', $filter_data['vendor']);
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif ($filter_data['category'] != '' && $filter_data['location'] != '' && $filter_data['vendor'] != '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            $this->db->where('services.slug', $filter_data['category']);
            $this->db->like('business_details.name', $filter_data['vendor']);
            if (is_numeric($filter_data['location'])) {
                $this->db->where('business_details.zipcode', $filter_data['location']);
            } else {
                $this->db->like('locations.suburb', $filter_data['location']);
            }
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } else {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        }
        $this->db->where('business_details.status', 'Active');
        $query = $this->db->get();
        $business_provider_details = $query->result();


        foreach ($business_provider_details as $key => $value) {
            $services = array();
            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->where('business_programs.business_id', $value->vendor_id);
            $this->db->limit(0, 2);
            $services_query = $this->db->get();
            $services[] = $services_query->result();
            $business_provider_details[$key]->offering_service = $services;

            $this->db->select('vendor_ratings.*,users.name');
            $this->db->from('vendor_ratings');
            $this->db->join('users', 'users.id = vendor_ratings.user_id');
            $this->db->where('vendor_ratings.vendor_id', $value->vendor_id);
            $this->db->where('vendor_ratings.status', 'Done');
            $reviewQuery = $this->db->get();
            $reviewQueryResult = $reviewQuery->result();
            $business_provider_details[$key]->review = count($reviewQueryResult);

            $this->db->select_avg('vendor_ratings.rating', 'average_rating');
            $this->db->from('vendor_ratings');
            $this->db->where('vendor_id', $value->vendor_id);
            $ave_query = $this->db->get();
            $ave_query_result = $ave_query->result();

            $business_provider_details[$key]->average_rating = $ave_query_result[0]->average_rating;
        }
        return $business_provider_details;
    }

    /* Above function ends here */

    /*
     * Function to insert user activity log details
     */

    public function filter_search_results($filter_data) {
        $services = array();

        foreach ($filter_data['services'] as $key => $value) {
            $test = "services.slug=" . "'$value'";
            $services [] = $test . ' ';
        }
        $test1 = "|| ";
        $services_conditions = implode($test1, $services);


        if (count($filter_data['services']) != '0' && $filter_data['location'] != '' && $filter_data['vendor'] != '') {
            //$this->db->where('locations.suburb', $filter_data['location']);
            //$this->db->where('business_details.name', $filter_data['vendor']);

            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where("(" . $services_conditions . ")");
            $this->db->where('locations.suburb', $filter_data['location']);
            $this->db->where('business_details.name', $filter_data['vendor']);
            $this->db->where('business_details.status', 'Active');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif (count($filter_data['services']) == '0' && $filter_data['location'] != '' && $filter_data['vendor'] != '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where('locations.suburb', $filter_data['location']);
            $this->db->where('business_details.name', $filter_data['vendor']);
            $this->db->where('business_details.status', 'Active');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif (count($filter_data['services']) != '0' && $filter_data['location'] == '' && $filter_data['vendor'] != '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where("(" . $services_conditions . ")");
            $this->db->where('business_details.name', $filter_data['vendor']);
            $this->db->where('business_details.status', 'Active');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif (count($filter_data['services']) != '0' && $filter_data['location'] != '' && $filter_data['vendor'] == '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where("(" . $services_conditions . ")");
            $this->db->where('locations.suburb', $filter_data['location']);
            $this->db->where('business_details.status', 'Active');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif (count($filter_data['services']) == '0' && $filter_data['location'] == '' && $filter_data['vendor'] != '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where('business_details.name', $filter_data['vendor']);
            $this->db->where('business_details.status', 'Active');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif (count($filter_data['services']) != '0' && $filter_data['location'] == '' && $filter_data['vendor'] == '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where("(" . $services_conditions . ")");
            $this->db->where('business_details.status', 'Active');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif (count($filter_data['services']) == '0' && $filter_data['location'] != '' && $filter_data['vendor'] == '') {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where('locations.suburb', $filter_data['location']);
            $this->db->where('business_details.status', 'Active');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } else {
            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->where('business_details.status', 'Active');
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        }

        $query = $this->db->get();
        $business_provider_details = $query->result();


        foreach ($business_provider_details as $key => $value) {
            $services = array();
            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->where('business_programs.business_id', $value->vendor_id);
            $this->db->limit(0, 2);
            $services_query = $this->db->get();
            $services[] = $services_query->result();
            $business_provider_details[$key]->offering_service = $services;

            $this->db->select('vendor_ratings.*,users.name');
            $this->db->from('vendor_ratings');
            $this->db->join('users', 'users.id = vendor_ratings.user_id');
            $this->db->where('vendor_ratings.vendor_id', $value->vendor_id);
            $this->db->where('vendor_ratings.status', 'Done');
            $reviewQuery = $this->db->get();
            $reviewQueryResult = $reviewQuery->result();
            $business_provider_details[$key]->review = count($reviewQueryResult);

            $this->db->select_avg('vendor_ratings.rating', 'average_rating');
            $this->db->from('vendor_ratings');
            $this->db->where('vendor_id', $value->vendor_id);
            $ave_query = $this->db->get();
            $ave_query_result = $ave_query->result();

            $business_provider_details[$key]->average_rating = $ave_query_result[0]->average_rating;
        }

        return $business_provider_details;
    }

    /* Above function ends here */



    /*
     * Function to insert user activity log details
     */

    public function filter_serach_result_by_row_count($search_data) {
        $keyword = $search_data['keywords'];
        $location = $search_data['locations'];
        $limit = $search_data['row_count'];

        if ($search_data['keywords'] != '' && $search_data['locations'] != '') {

            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
            $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id', 'left');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id', 'left');
            $this->db->where("(services.service_name LIKE '%" . $this->db->escape_like_str($keyword) . "%' || business_details.name LIKE '%" . $this->db->escape_like_str($keyword) . "%' || business_services.services LIKE '%" . $this->db->escape_like_str($keyword) . "%')");
            if (is_numeric($search_data['locations'])) {
                $this->db->where('business_details.zipcode', $location);
            } else {
                $this->db->where("(locations.suburb LIKE '%$location%' || locations.city LIKE '%$location%')");
            }
            $this->db->where('locations.city', $search_data['city']);
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif ($search_data['keywords'] != '' && $search_data['locations'] == '') {

            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude, services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
            $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id', 'left');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id', 'left');
            $this->db->where("(services.service_name LIKE '%" . $this->db->escape_like_str($keyword) . "%' || business_details.name LIKE '%" . $this->db->escape_like_str($keyword) . "%' || business_services.services LIKE '%" . $this->db->escape_like_str($keyword) . "%')");
            $this->db->where('locations.city', $search_data['city']);
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } elseif ($search_data['keywords'] == '' && $search_data['locations'] != '') {

            if (is_numeric($search_data['locations'])) {
                $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude, services.*');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
                $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
                $this->db->where('business_details.zipcode', $search_data['locations']);
                $this->db->where('locations.city', $search_data['city']);
                $this->db->group_by('business_details.id');
                $this->db->order_by('business_details.name', 'asc');
            } else {
                $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude, services.*');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
                $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
                $this->db->where("(locations.suburb LIKE '%$location%' || locations.city LIKE '%$location%')");
                $this->db->where('locations.city', $search_data['city']);
                $this->db->group_by('business_details.id');
                $this->db->order_by('business_details.name', 'asc');
            }
        } else {

            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude, services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
            $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
            $this->db->order_by('business_details.name', 'asc');
        }

        if ($limit != 'all') {
            $this->db->limit($limit);
            $this->db->where('business_details.status', 'Active');
        } else {
            $this->db->where('business_details.status', 'Active');
        }
        $query = $this->db->get();
        $business_provider_details = $query->result();

        foreach ($business_provider_details as $key => $value) {
            $services = array();
            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id', 'left');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id', 'left');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->like('business_services.services', $this->db->escape_like_str($search_data['keywords']));
            $this->db->where('business_programs.business_id', $value->vendor_id);
            $services_query1 = $this->db->get();
            $services_results = $services_query1->result();

            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id', 'left');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id', 'left');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->where('business_programs.business_id', $value->vendor_id);

            $services_query = $this->db->get();
            $services_results1 = $services_query->result();
            if (!empty($services_results)) {
                $services[] = $services_results;
            } else {
                $services[] = $services_results1;
            }
            $business_provider_details[$key]->offering_service = $services;

            $this->db->select('vendor_ratings.*,users.name');
            $this->db->from('vendor_ratings');
            $this->db->join('users', 'users.id = vendor_ratings.user_id');
            $this->db->where('vendor_ratings.vendor_id', $value->vendor_id);
            $this->db->where('vendor_ratings.status', 'Done');
            $reviewQuery = $this->db->get();
            $reviewQueryResult = $reviewQuery->result();
            $business_provider_details[$key]->review = count($reviewQueryResult);

            $this->db->select_avg('vendor_ratings.rating', 'average_rating');
            $this->db->from('vendor_ratings');
            $this->db->where('vendor_id', $value->vendor_id);
            $ave_query = $this->db->get();
            $ave_query_result = $ave_query->result();

            $business_provider_details[$key]->average_rating = $ave_query_result[0]->average_rating;
        }
        return $business_provider_details;
    }

    /* Above function ends here */

    /*
     * Function to insert user activity log details
     */

    public function filter_serach_by_keywords_by_row_count($search_data) {

        $limit = $search_data['row_count'];

        $search_keywords = explode('=', $search_data['keywords']);


        if (count($search_keywords) == 2) {
            $keyword = $search_keywords[1];

            $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
            $this->db->join('services', 'services.id = services_business_mapping.services_id');
            $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
            $this->db->join('business_services', 'business_services.program_id = business_programs.id');
            $this->db->where('services.slug', $keyword);
            $this->db->group_by('business_details.id');
            $this->db->order_by('business_details.name', 'asc');
        } else {
            $explode = explode('&', $search_keywords[1]);
            $keyword = $explode[0];

            $location = str_replace("%20", ' ', $search_keywords[2]);

            if ($keyword == 'all') {
                $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
                $this->db->join('services', 'services.id = services_business_mapping.services_id');
                $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
                $this->db->join('business_services', 'business_services.program_id = business_programs.id');
                $this->db->where('locations.suburb', $location);
                $this->db->group_by('business_details.id');
                $this->db->order_by('business_details.name', 'asc');
            } else {
                $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services.*');
                $this->db->from('business_details');
                $this->db->join('locations', 'business_details.suburb = locations.id');
                $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
                $this->db->join('services', 'services.id = services_business_mapping.services_id');
                $this->db->join('business_programs', 'business_programs.business_id = business_details.id');
                $this->db->join('business_services', 'business_services.program_id = business_programs.id');
                $this->db->where('services.slug', $keyword);
                $this->db->where('locations.suburb', $location);
                $this->db->group_by('business_details.id');
                $this->db->order_by('business_details.name', 'asc');
            }
        }

        if ($limit != 'all') {
            $this->db->limit($limit);
            $this->db->where('business_details.status', 'Active');
        } else {
            $this->db->where('business_details.status', 'Active');
        }


        $query = $this->db->get();
        $business_provider_details = $query->result();

        foreach ($business_provider_details as $key => $value) {
            $services = array();
            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->where('business_programs.business_id', $value->vendor_id);
            // $this->db->limit(3);
            $services_query = $this->db->get();
            $services[] = $services_query->result();
            $business_provider_details[$key]->offering_service = $services;

            $this->db->select('vendor_ratings.*,users.name');
            $this->db->from('vendor_ratings');
            $this->db->join('users', 'users.id = vendor_ratings.user_id');
            $this->db->where('vendor_ratings.vendor_id', $value->vendor_id);
            $this->db->where('vendor_ratings.status', 'Done');
            $reviewQuery = $this->db->get();
            $reviewQueryResult = $reviewQuery->result();
            $business_provider_details[$key]->review = count($reviewQueryResult);

            $this->db->select_avg('vendor_ratings.rating', 'average_rating');
            $this->db->from('vendor_ratings');
            $this->db->where('vendor_id', $value->vendor_id);
            $ave_query = $this->db->get();
            $ave_query_result = $ave_query->result();

            $business_provider_details[$key]->average_rating = $ave_query_result[0]->average_rating;
        }
        return $business_provider_details;
    }

    /* Above function ends here */

    /*
     * Function to insert user activity log details
     */

    public function searching_data() {

        $this->db->select('business_details.*,business_details.id as vendor_id,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude, services.*');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
        $this->db->join('services', 'services.id = services_business_mapping.services_id', 'left');
        $this->db->order_by('business_details.name', 'asc');

        $this->db->where('business_details.status', 'Active');
        //$this->db->limit(10);
        $query = $this->db->get();
        $business_provider_details = $query->result();

        foreach ($business_provider_details as $key => $value) {
            $services = array();
            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id', 'left');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id', 'left');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->where('business_programs.business_id', $value->vendor_id);
            $services_query1 = $this->db->get();
            $services_results = $services_query1->result();

            $this->db->select('business_services.*,business_services_details.price,business_services_details.duration,services.id as base_service_id');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id', 'left');
            $this->db->join('business_programs', 'business_programs.id = business_services.program_id', 'left');
            $this->db->join('services', 'services.id = business_programs.service_id', 'left');
            $this->db->where('business_programs.business_id', $value->vendor_id);
            // $this->db->limit(3);
            $services_query = $this->db->get();
            $services_results1 = $services_query->result();
            if (!empty($services_results)) {
                $services[] = $services_results;
            } else {
                $services[] = $services_results1;
            }
            $business_provider_details[$key]->offering_service = $services;

            $this->db->select('vendor_ratings.*,users.name');
            $this->db->from('vendor_ratings');
            $this->db->join('users', 'users.id = vendor_ratings.user_id');
            $this->db->where('vendor_ratings.vendor_id', $value->vendor_id);
            $this->db->where('vendor_ratings.status', 'Done');
            $reviewQuery = $this->db->get();
            $reviewQueryResult = $reviewQuery->result();
            $business_provider_details[$key]->review = count($reviewQueryResult);

            $this->db->select_avg('vendor_ratings.rating', 'average_rating');
            $this->db->from('vendor_ratings');
            $this->db->where('vendor_id', $value->vendor_id);
            $ave_query = $this->db->get();
            $ave_query_result = $ave_query->result();

            $business_provider_details[$key]->average_rating = $ave_query_result[0]->average_rating;
        }
        return $business_provider_details;
    }

    /* Above function ends here */
}
