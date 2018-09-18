<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for getting locations by service and city,near by locations
 * @author Anitha <anitha@nuvodev.com>
 * Date:05-08-2015
 * */
class Locations extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Location');
    }

    /*
     * Function to get locations by service 
     */

    public function get_locations_by_service() {
        $this->User_activity->insert_user_activity();
        $service = $this->uri->segment(2);
        $get_locations_by_service = $this->Location->get_locations_by_service_id($service);
        if (!empty($get_locations_by_service)) {
            echo json_encode($get_locations_by_service);
        } else {
            echo 'No Data Found';
        }
    }

    /* Above function ends here */



    /*
     * Function to get locations by city 
     */

    public function get_locations_by_city() {
        $this->User_activity->insert_user_activity();
        $service = $this->uri->segment(2);
        $city = $this->uri->segment(3);
        $get_locations_by_city = $this->Location->get_locations_by_city($service, $city);
        if (!empty($get_locations_by_city)) {
            echo json_encode($get_locations_by_city);
        } else {
            echo 'No Data Found';
        }
    }

    /* Above function ends here */


    /*
     * Function to get near by locations 
     */

    public function get_near_by_locations() {
        $this->User_activity->insert_user_activity();
        $lat = 12.9558381;
        $lng = 77.7141518;
        $get_near_by_locations = $this->Location->get_near_by_locations($lat, $lng);
        $get_near_by_locations_details_array = array();
        if (!empty($get_near_by_locations)) {
            foreach ($get_near_by_locations as $value) {
                $get_near_by_locations_details = $this->Location->get_near_by_locations_details($value->latitude, $value->longitude);
                if (!empty($get_near_by_locations_details)) {
                    $get_near_by_locations_details_array[] = $get_near_by_locations_details;
                }
            }
            if (!empty($get_near_by_locations_details_array)) {
                echo json_encode($get_near_by_locations_details_array);
            } else {
                echo 'No Data Found';
            }
        }
    }

    /* Above function ends here */
	
	 //localization
   public function set_country()
    {
		$data = $this->input->post();
		$c = $data['country'];
		$data['cities'] = $this->Location->getCities($c);
		$this->session->set_userdata('country',$c);
		$this->session->set_userdata('place',$data['cities'][0]->city);
		
		$data=$this->load->view('update_cities',$data, TRUE);
			return $this->output
                ->set_header("HTTP/1.0 200 OK")
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
	}
	
	public function set_city()
    {
		$data = $this->input->post();
		$city = $data['city'];
		if($data['city'] != 'all')
		{
			$this->session->set_userdata('place',$city);
		}
		else{
			$this->session->set_userdata('place2','All Cities');
			$this->session->set_userdata('place','');
		}
	}
}
