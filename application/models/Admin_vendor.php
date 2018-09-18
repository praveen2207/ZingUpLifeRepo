<?php

/**
 * This class used for admin users login and users actions/activities
 * 
 * @author Anitha <anitha@nuvodev.com>
 * 
 * Date:5-04-2016
 * 
 * */
class Admin_vendor extends CI_Model {

    function __construct() {
// Call the Model constructor
        parent::__construct();
        $this->load->library('PasswordHash');
    }

    

       /*
     *  Function to get business services  
     */

    public function get_business_services() {
        $this->db->select('*');
        $this->db->from('services');
        $query = $this->db->get();
        $query_result = $query->result();

        return $query_result;
    }

    /* Above function ends here */

    /*
     *  Function to get locations  
     */

    public function get_locations() {
        $this->db->select('*');
        $this->db->from('locations');
        $query = $this->db->get();
        $query_result = $query->result();

        return $query_result;
    }

    /* Above function ends here */


    /*
     * Function to insert partner details 
     */

    public function add_partner_registrations($post_data) {
        $hashed = PasswordHash::create_hash('zingup123');

        $partner_details_data = array(
            'username' => $post_data['username'],
            'password' => $hashed,
            'status' => 'De-active',
            'role' => 'vendor',
            'email_verification_status' => 1,
        );
        $this->db->insert('vendors', $partner_details_data);
        $vendor_id = $this->db->insert_id();



        $business_details_data = array(
            'business_id' => $vendor_id,
            'name' => $post_data['business_name'],
            'street1' => $post_data['address1'],
            'street2' => $post_data['address2'],
            'suburb' => $post_data['area'],
            'city' => $post_data['city'],
            'state' => $post_data['state'],
            'country' => $post_data['country'],
            'zipcode' => $post_data['zipcode'],
            'website' => $post_data['website'],
            'email' => $post_data['business_email'],
            'landline' => $post_data['landline'],
            'phone' => $post_data['mobile'],
            'facebook_page' => $post_data['fb_page'],
            'twitter_handle' => $post_data['tw_page'],
            'instagram' => $post_data['instagram'],
            'status' => 'De-active'
        );
        $this->db->insert('business_details', $business_details_data);


        foreach ($post_data['business_type'] as $type) {
            
            $business_type = explode('/', $type);
            $business_type_id = $business_type[0];

            $business_mapping = array(
                'services_id' => $business_type_id,
                'business_id' => $vendor_id
            );
            $this->db->insert('services_business_mapping', $business_mapping);
        }

        return true;
    }

    /* Above function ends here */


    /*
     *  Function to get partner details by given username  
     */

    public function get_partner_details_by_username($username) {

        $this->db->select('vendors.*,business_details.id as business_id,business_details.name,business_details.suburb,services_business_mapping.services_id');
        $this->db->from('vendors');
        $this->db->join('business_details', 'business_details.business_id = vendors.id');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
        $this->db->where('vendors.username', $username);

        $query = $this->db->get();
        $query_result = $query->result();

        $partner_details = array();
        if (count($query_result) == 0) {
            $partner_details = $query_result;
        } else {
            $partner_details = $query_result[0];
        }
        return $partner_details;
    }

    /* Above function ends here */


    /*
     *  Function to get partner details by given username  
     */

    public function get_business_vendor_details($businessid) {
        $this->db->select('*');
        $this->db->from('business_details');
        $this->db->where('id', $businessid);
        $query = $this->db->get();
        $query_result = $query->result();
        $partner_details = array();
        if (count($query_result) == 0) {
            $partner_details['business'] = $query_result;
        } else {
            $partner_details['business'] = $query_result[0];
        }

        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->where('id', $partner_details['business']->business_id);
        $query1 = $this->db->get();
        $query_result1 = $query1->result();
        if (count($query_result1) == 0) {
            $partner_details['partner'] = $query_result1;
        } else {
            $partner_details['partner'] = $query_result1[0];
        }
        $this->db->select('*');
        $this->db->from('business_gallery');
        $this->db->where('business_id', $partner_details['business']->id);
        $query2 = $this->db->get();
        $query_result2 = $query2->result();

        $partner_details['gallery'] = $query_result2;
      
         $this->db->select('*');
        $this->db->from('services_business_mapping');
        $this->db->where('business_id', $partner_details['business']->id);
        $query3 = $this->db->get();
        $query_result3 = $query3->result();
        $partner_details['mapping'] = $query_result3;
  
        return $partner_details;
    }

    /* Above function ends here */


    /*
     *  Function to get vendor memberships  
     */

    public function get_existing_packages($business_id) {
        $this->db->select('*');
        $this->db->from('business_programs');
        $this->db->where('business_id', $business_id);
        $query = $this->db->get();
        $query_result = $query->result();

        return $query_result;
    }

    /* Above function ends here */



    /*
     *  Function to insert business programs  
     */

    public function insert_business_programs($postdata) {
        $business_details = $this->Admin_vendor->get_business_details_by_id($postdata['business_id']);
        $program_details = array(
            'service_id' => $business_details->services_id,
            'business_id' => $business_details->business_id,
            'program' => $postdata['package'],
            'type' => $postdata['type']
        );

        $this->db->insert('business_programs', $program_details);
        return $this->db->insert_id();
    }

    /* Above function ends here */




    /*
     *  Function to get partner details by id  
     */

    public function get_business_details_by_id($business_id) {

        $this->db->select('business_details.id as business_id,business_details.name,business_details.suburb,services_business_mapping.services_id');
        $this->db->from('business_details');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.business_id');
        $this->db->where('business_details.id', $business_id);

        $query = $this->db->get();
        $query_result = $query->result();
        $partner_details = array();
        if (count($query_result) == 0) {
            $partner_details = $query_result;
        } else {
            $partner_details = $query_result[0];
        }
        return $partner_details;
    }

    /* Above function ends here */


    /*
     *  Function to insert business services  
     */

    public function insert_business_services($postdata, $files) {
        if (!empty($postdata['packages']) && !empty($postdata['service'])) {
            $service_data = array(
                'program_id' => $postdata['packages'],
                'services' => $postdata['service']
            );
        } else
            return false;

        $this->db->insert('business_services', $service_data);
        $service_id = $this->db->insert_id();
       

        $service_details_data = array(
            'service_id' => $service_id,
            'description' => $postdata['description'],
            'duration' => $postdata['hours'] . ':' . $postdata['minutes'],
            'price' => $postdata['price'],
            'discount' => $postdata['discount'],
            'discount_start_date' => $postdata['discount_start_date'],
            'discount_end_date' => $postdata['discount_end_date'],
            'service_type' => $postdata['service_type']
        );

        $this->db->insert('business_services_details', $service_details_data);
        return true;
    }

    /*
     *  Function to delete business service gallery  
     */

    /*
     *  Function to delete business service gallery  
     */

    public function delete_business_service_gallery($service_id) {
        $this->db->where('service_id', $service_id);
        $this->db->delete('business_service_gallery');
    }

    /*
     *  Function to  business services listing  
     */

    public function delete_business_package($post_data) {
        $this->db->where('id', $post_data['package_id']);
        $this->db->delete('business_programs');

        return true;
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function get_single_package_detail($package_id) {

        $this->db->select('*');
        $this->db->from('business_programs');
        $this->db->where('id', $package_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $package_details = array();
        if (!empty($query_result)) {
            $package_details['package'] = $query_result[0];
        } else {
            $package_details['package'] = $query_result;
        }
        $this->db->select('*');
        $this->db->from('business_services');
        $this->db->where('program_id', $package_id);
        $query2 = $this->db->get();
        $query_result2 = $query2->result();
        if (!empty($query_result2)) {
            $package_details['service'] = $query_result2;
        }
        return $package_details;
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function updating_business_programs($post_data) {
        $updated_data = array(
            'service_id' => $post_data['service'], 
            'program' => $post_data['package_name'],
            'type' => $post_data['type']
        );
        $this->db->where('id', $post_data['service_id']);
        $this->db->update('business_programs', $updated_data);



        return true;
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function delete_business_service($post_data) {
        $this->db->where('id', $post_data['service_id']);
        $this->db->delete('business_services');

        return true;
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function get_all_services_listing($business_id) {
        $this->db->select('*');
        $this->db->from('business_programs');
        $this->db->where('business_id', $business_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $details = array();
        foreach ($query_result as $result) {
            $this->db->select('business_services.id as service_id,business_services.services,business_services_details.duration,business_services_details.price,business_services_details.service_type,business_services_details.description');
            $this->db->from('business_services');
            $this->db->join('business_services_details','business_services_details.service_id = business_services.id');
            $this->db->where('business_services.program_id', $result->id);
            $query1 = $this->db->get();
            $query_result1 = $query1->result();
            
            array_push($details, $query_result1);
             
        }
        return $details;
    }

    /* Above function ends here */


    /*
     *  Function to update business info  
     */

    public function update_business_information($data, $logoname) {

        $updated_business_data = array(
            'name' => $data['business_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'website' => $data['website'],
            'description' => $data['description'],
            'logo' => $logoname,
            'street1' => $data['address1'],
            'street2' => $data['address2'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'suburb' => $data['area'],
            'zipcode' => $data['zipcode'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude']
        );
        $this->db->where('id', $data['id']);
        $this->db->update('business_details', $updated_business_data);
        
        $this->db->where('business_id', $data['id']);
        $this->db->delete('services_business_mapping');

        foreach ($data['business_type']as $key => $value) {
            $mapping_array = array(
                'services_id' => $value,
                'business_id' => $data['id']
            );
            $this->db->insert('services_business_mapping', $mapping_array);
            }
    }

    /* Above function ends here */

    /*
     *  Function to insert business gallery  
     */

    public function insert_business_gallery($business_id, $image_name) {


        $gallery_details = array(
            'business_id' => $business_id,
            'images' => $image_name
        );

        $this->db->insert('business_gallery', $gallery_details);
    }

    /* Above function ends here */



    /*
     *  Function to  business services listing  
     */

    public function get_single_service_detail($service_id) {
        $this->db->select('business_services.*,business_services_details.description,business_services_details.duration,business_services_details.price,business_services_details.service_type,business_services_details.discount,business_services_details.discount_start_date,business_services_details.discount_end_date');
        $this->db->from('business_services');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->where('business_services.id', $service_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $business_service_details = array();
        if (!empty($query_result)) {
            $business_service_details['details'] = $query_result[0];
        } else {
            $business_service_details['details'] = $query_result;
        }


        $gallery_query = $this->db->get_where('business_service_gallery', array('service_id' => $service_id));
        $gallery_query_result = $gallery_query->result();
        $business_service_details['gallery'] = $gallery_query_result;

       $membership_query = $this->db->get_where('memberships', array('business_service_id' => $service_id));
        $membership_query_result = $membership_query->result();
        $business_service_details['memberships'] = $membership_query_result;

        $slot_query = $this->db->get_where('services_slots', array('service_id' => $service_id));
	  $slot_query_result = $slot_query->result();
        $slots = array();
        foreach ($slot_query_result as $key => $value) {
            $check_date = date('D', strtotime($value->date));
            if ($check_date == 'Mon') {
                $slots['1'][] = $value;
            } elseif ($check_date == 'Tue') {
                $slots['2'][] = $value;
            } elseif ($check_date == 'Wed') {
                $slots['3'][] = $value;
            } elseif ($check_date == 'Thu') {
                $slots['4'][] = $value;
            } elseif ($check_date == 'Fri') {
                $slots['5'][] = $value;
            } elseif ($check_date == 'Sat') {
                $slots['6'][] = $value;
            } elseif ($check_date == 'Sun') {
                $slots['7'][] = $value;
            }
            asort($slots);
        }
        $business_service_details['slots'] = $slots;
		
		return $business_service_details;

    }

    /* Above function ends here */




    /*
     *  Function to  business services listing  
     */

    public function get_service_slots_by_day($service_id) {
        $ids = explode('_', $service_id);
        $this->db->select('business_services.*,business_services_details.description,business_services_details.duration,business_services_details.price');
        $this->db->from('business_services');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->where('business_services.id', $ids[0]);
        $query = $this->db->get();
        $query_result = $query->result();
        $business_service_details = array();
        if (!empty($query_result)) {
            $business_service_details['details'] = $query_result[0];
        } else {
            $business_service_details['details'] = $query_result;
        }



        $slot_query = $this->db->get_where('services_slots', array('service_id' => $service_id));
        $slot_query_result = $slot_query->result();
        $slots = array();

        if ($ids[1] == 1) {
            $day = 'Mon';
        } elseif ($ids[1] == 2) {
            $day = 'Tue';
        } elseif ($ids[1] == 3) {
            $day = 'Wed';
        } elseif ($ids[1] == 4) {
            $day = 'Thu';
        } elseif ($ids[1] == 5) {
            $day = 'Fri';
        } elseif ($ids[1] == 6) {
            $day = 'Sat';
        } elseif ($ids[1] == 7) {
            $day = 'Sun';
        }



        foreach ($slot_query_result as $key => $value) {
            $check_date = date('D', strtotime($value->date));
            if ($check_date == $day) {
                $slots[] = $value;
            }
            asort($slots);
        }
        $business_service_details['slots'] = $slots;

        return $business_service_details;
    }

    /* Above function ends here */

    public function update_service_slots($post_data) {
        $old_timings = explode('-', $post_data['slots_time']);
        $start_time = date('H:i:s', strtotime($old_timings[0]));
        $end_time = date('H:i:s', strtotime($old_timings[1]));

        foreach ($post_data['slots_date'] as $key => $value) {
            $slots_details_data = array(
                'start_time' => $post_data['new_start_time'],
                'end_time' => $post_data['new_end_time'],
                'number_of_slots' => $post_data['number_of_slots'],
                'active' => $post_data['slots_status'],
            );
            $this->db->where('date', $value);
            $this->db->where('start_time', $start_time);
            $this->db->where('end_time', $end_time);
            $this->db->update('services_slots', $slots_details_data);
        }
        return true;
    }

    public function service_slots_delete($id) {
        $ids = explode(',', $id);
        foreach ($ids as $key => $value) {
            $this->db->where('id', $value);
            $this->db->delete('services_slots');
        }
        return true;
    }

    /*
     *  Function to insert business services slots  
     */

    public function insert_services_slots($postdata) {
        $weekdays_timings = array();
        foreach ($postdata['weekdays']['start_time'] as $key => $value) {
            $weekdays_timings[$key]['start_time'] = $value;
        }
        foreach ($postdata['weekdays']['end_time'] as $key => $value) {
            $weekdays_timings[$key]['end_time'] = $value;
        }
        $i = 60;
        $current_date = date('Y-m-d');
        for ($z = 0; $z <= $i; $z++) {
            foreach ($postdata['weekdays']['day'] as $key => $value) {
                foreach ($weekdays_timings as $keys => $values) {
                    $date = date('Y-m-d', strtotime($current_date . ' + ' . $z . ' days'));
                    $check_date = date('D', strtotime($date));
                    if ($check_date == $value) {
                        $service_slots = array(
                            'service_id' => $postdata['services'],
                            'date' => $date,
                            'start_time' => $values['start_time'],
                            'end_time' => $values['end_time'],
                            'number_of_slots' => $postdata['no_slots'],
                            'active' => 'enable'
                        );
                        $this->db->insert('services_slots', $service_slots);
                    }
                }
            }
        }
        $weekend_timings = array();
        foreach ($postdata['weekends']['start_time'] as $key => $value) {
            $weekend_timings[$key]['start_time'] = $value;
        }
        foreach ($postdata['weekends']['end_time'] as $key => $value) {
            $weekend_timings[$key]['end_time'] = $value;
        }

        $j = 60;
        for ($z = 0; $z <= $j; $z++) {
            foreach ($postdata['weekends']['day'] as $key => $value) {
                foreach ($weekend_timings as $keys => $values) {
                    $date = date('Y-m-d', strtotime($current_date . ' + ' . $z . ' days'));
                    $check_date = date('D', strtotime($date));
                    if ($check_date == $value) {

                        $service_slots = array(
                            'service_id' => $postdata['services'],
                            'date' => $date,
                            'start_time' => $values['start_time'],
                            'end_time' => $values['end_time'],
                            'number_of_slots' => $postdata['no_slots'],
                            'active' => 'enable'
                        );
                        $this->db->insert('services_slots', $service_slots);
                    }
                }
            }
        }

        return true;
    }

    /* Above function ends here */


    /*
     *  Function to get business services by program  
     */

    public function get_services_by_program($postdata) {

        $this->db->select('*');
        $this->db->from('business_services');
        $this->db->where('program_id', $postdata['program_id']);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    /*
     *  Function to get business services by program  
     */

    public function get_vendorid_by_businessid($id) {

        $this->db->select('business_id');
        $this->db->from('business_details');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    /*
     *  Function to get business services by program  
     */

    public function get_vendorid_businessid_by_packageid($id) {

        $this->db->select('business_details.*');
        $this->db->from('business_programs');
        $this->db->join('business_details', 'business_details.id =business_programs.business_id');

        $this->db->where('business_programs.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */


    /*
     *  Function to get business services by program  
     */

    public function get_vendorid_businessid_by_serviceid($id) {

        $this->db->select('business_details.*');
        $this->db->from('business_services');

        $this->db->join('business_programs', 'business_programs.id =business_services.program_id');
        $this->db->join('business_details', 'business_details.id =business_programs.business_id');

        $this->db->where('business_services.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    /*
     *  Function to delete business service gallery image  
     */

    public function delete_business_service_gallery_image($postdata) {

        $this->db->where('images', $postdata['name']);
        $this->db->where('service_id', $postdata['service_id']);
        $this->db->delete('business_service_gallery');
        unlink("assets/uploads/business_services/gallery/" . $postdata['service_id'] . "/" . $postdata['name']);
        return true;
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function updating_business_services($post_data) {
        $updated_data = array(
            'services' => $post_data['service_name']
        );
        $this->db->where('id', $post_data['service_id']);
        $this->db->update('business_services', $updated_data);


        $updated_data1 = array(
            'description' => $post_data['description'],
            'duration' => $post_data['hours'].":".$post_data['minutes'],
            'price' => $post_data['price'],
            'discount' => $post_data['discount'],
            'discount_start_date' => $post_data['discount_start_date'],
            'discount_end_date' => $post_data['discount_end_date'],
            'service_type' => $post_data['service_type']
        );
        $this->db->where('service_id', $post_data['service_id']);
        $this->db->update('business_services_details', $updated_data1);
    }

    /* Above function ends here */



    /*
     *  Function to get business services by program  
     */

    public function view_business_gallery($businessid) {

        $this->db->select('*');
        $this->db->from('business_gallery');
        $this->db->where('business_id', $businessid);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */
    
    
    
    
    /*
     *  Function to get business services by program  
     */

    public function business_gallery_info($galleryid) {

        $this->db->select('*');
        $this->db->from('business_gallery');
        $this->db->where('id', $galleryid);
        $query = $this->db->get();
        $query_result = $query->result();
        if (!empty($query_result)) {
            $gallery_details = $query_result[0];
        } else {
            $gallery_details = $query_result;
        }

        return $query_result;
    }

    /* Above function ends here */
    
    
    
     /*
     *  Function to get business services by program  
     */

    public function updating_business_gallery($imagename,$businessid,$galleryid) {
        
        $updated_data = array(
            'images' => $imagename
        );
        $this->db->where('business_id', $businessid);
        $this->db->where('id', $galleryid);
        $this->db->update('business_gallery', $updated_data);
    }

    /* Above function ends here */
    
    
    /*
     *  Function to get partner details by id  
     */

    public function get_business_info_by_id($business_id) {

        $this->db->select('business_details.name,locations.suburb');
        $this->db->from('business_details');
        $this->db->join('locations', 'locations.id = business_details.suburb');
        $this->db->where('business_details.id', $business_id);

        $query = $this->db->get();
        $query_result = $query->result();
        $partner_details = array();
        if (count($query_result) == 0) {
            $partner_details = $query_result;
        } else {
            $partner_details = $query_result[0];
        }
        return $partner_details;
    }

    /* Above function ends here */


/*
     *  Function to get partner details by id  
     */

    public function delete_business_gallery_image($postdata) {

        $this->db->where('id', $postdata['gallery_id']);
        $this->db->delete('business_gallery'); 
        unlink("assets/uploads/business_providers/gallery/" . $postdata['business_id'] . "/" . $postdata['business_name']);
        return true;
    }

    /* Above function ends here */
    
    
      /*
     *  Function to get business services by program  
     */

    public function adding_business_gallery($post_data,$image_name) {
        
        $insert_data = array(
            'business_id' => $post_data['id'],
            'images' => $image_name
        );
        $this->db->insert('business_gallery', $insert_data);
    }

    /* Above function ends here */
    
    
    
    
    
     /*
     *  Function to get business services by program  
     */

    public function view_business_service_gallery($service_id) {
        
       $this->db->select('*');
        $this->db->from('business_service_gallery');
        $this->db->where('service_id', $service_id);

        $query = $this->db->get();
        $query_result = $query->result();
       
        return $query_result;
    }

    /* Above function ends here */
    
    
    
     /*
     *  Function to get business services by program  
     */

    public function get_businessid_by_serviceid($service_id) {
        
       $this->db->select('*');
        $this->db->from('business_service_gallery');
        $this->db->where('id', $service_id);

        $query = $this->db->get();
        $query_result = $query->result();
        
        $this->db->select('business_programs.*');
        $this->db->from('business_services');
       $this->db->join('business_programs', 'business_services.program_id = business_programs.id');
        $this->db->where('business_services.id', $query_result[0]->service_id);

        $query1 = $this->db->get();
        $query_result1 = $query1->result();
        return $query_result1;
    }

    /* Above function ends here */
    
    
     /*
     *  Function to get business services by program  
     */

    public function business_service_info($service_id) {
        
       $this->db->select('*');
        $this->db->from('business_service_gallery');
        $this->db->where('id', $service_id);

        $query = $this->db->get();
        $query_result = $query->result();
       
        return $query_result;
    }

    /* Above function ends here */
    
    
    
    
    
    /*
     *  Function to get business services by program  
     */

    public function updating_business_service_gallery($imagename,$postdata,$service_id) {
        
        $updated_data = array(
            'caption' => $postdata['caption'],
            'description' => $postdata['description'],
            'images' => $imagename
        );
        $this->db->where('id', $service_id);
        $this->db->update('business_service_gallery', $updated_data);
    }

    /* Above function ends here */
    
    
    /*
     *  Function to delete business service gallery  
     */

    public function delete_business_service_gallery_edit($post_data) {
        $this->db->where('id', $post_data['service_id']);
        $this->db->delete('business_service_gallery');
        return true;
    }
    
    
     /*
     *  Function to get business services by program  
     */

    public function adding_business_service_gallery($post_data,$i,$image_name) {
        $insert_data = array(
            'caption' => $post_data['caption'][$i],
            'description' => $post_data['description'][$i],
            'service_id' => $post_data['service_id'],
            'images' => $image_name
        );
        $this->db->insert('business_service_gallery', $insert_data);
    }

    /* Above function ends here */
    
    
    /*
     *  Function to get user details by given username  
     */

    public function get_business_info_by_serviceid($service_id) {
        $this->db->select('business_details.*,locations.suburb as area_name');
        $this->db->from('business_details');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->where('business_services.id', $service_id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    
/*
     *  Function to get user details by given username  
     */

    public function service_search_filter($post_data) {
       
 if ($post_data['service_name'] != '') {
        $this->db->select('business_services.*,business_services_details.duration,business_services_details.price,business_services_details.service_type');
        $this->db->from('business_programs');
        $this->db->join('business_services', 'business_services.program_id = business_programs.id');
        $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id');
        $this->db->where('business_programs.business_id', $post_data['business_id']);
        $this->db->like('business_services.services', $post_data['service_name'],'both');
        
        
            }
else{
   $this->db->select('business_services.*,business_services_details.duration,business_services_details.price,business_services_details.service_type');
        $this->db->from('business_programs');
        $this->db->join('business_services', 'business_services.program_id = business_programs.id');
        $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id');
        $this->db->where('business_programs.business_id', $post_data['business_id']);
}
     $query = $this->db->get();
        $query_result = $query->result();
          return $query_result;
    }

    /* Above function ends here */


/*
     *  Function to  business services listing  
     */

    public function get_slot_details($service_id) {
        $ids = explode('_', $service_id);
        $this->db->select('business_services.*,business_services_details.description,business_services_details.duration,business_services_details.price');
        $this->db->from('business_services');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->where('business_services.id', $ids[0]);
        $query = $this->db->get();
        $query_result = $query->result();
        $business_service_details = array();
        if (!empty($query_result)) {
            $business_service_details['details'] = $query_result[0];
        } else {
            $business_service_details['details'] = $query_result;
        }



        $slot_query = $this->db->get_where('services_slots', array('service_id' => $service_id));
        $slot_query_result = $slot_query->result();


        foreach ($slot_query_result as $key => $value) {

            $slots[] = $value;

            asort($slots);
        }
        $business_service_details['slots'] = $slots;
        return $business_service_details;
    }

    /* Above function ends here */
    
    
    
    
     /*
     *  Function to get business services by program  
     */

    public function update_one_time_service_slot($post_data) {
        
        $insert_data = array(
            'date' => $post_data['one_time_date'],
            'start_time' => $post_data['one_time_start_time'],
            'end_time' => $post_data['one_time_end_time'],
            'number_of_slots' => $post_data['no_of_slots'],
            'active' => $post_data['slots_status']
        );
        $this->db->where('service_id', $post_data['service_id']);
        $this->db->where('id', $post_data['service_slot_id']);
        $this->db->update('services_slots', $insert_data);
    }

    /* Above function ends here */
    
    
     /*
     *  Function to delete business service gallery  
     */

    public function one_time_service_slots_delete($post_data) {
        $this->db->where('id', $post_data['slot_id']);
        $this->db->delete('services_slots');
        return true;
    }
    /* Above function ends here */
    
    
/*
     * Function to get membership details by id
     */

    public function get_membership_details($membership_id) {
        $this->db->select('memberships.*');
        $this->db->from('memberships');
        $this->db->where('memberships.id', $membership_id);
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $memberships_details = $query_result;
        } else {
            $memberships_details = $query_result[0];
        }
        return $memberships_details;
    }

    /* Above function ends here */


    
  /*
     * Function to get membership details by id
     */  
 public function update_membership($post_data) {
        $membership = array(
            'membership' => $post_data['membership'],
            'description' => $post_data['description'],
            'duration' => $post_data['duration'],
            'fees' => $post_data['fees'],
            'max_number_of_members' => $post_data['max_number_of_members']
        );
        $this->db->where('id', $post_data['id']);
        $this->db->update('memberships', $membership);
        return true;
    }
 /* Above function ends here */


 
 
/*
     * Function to get membership details by id
     */
    public function membership_delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('memberships');
        return true;
    }
/* Above function ends here */


 /*
     *  Function to  business services listing  
     */

    public function get_one_day_packages($vendor_id) {
        $this->db->select('one_day_package_offerings.*,business_services.services as service_name,business_services_details.service_type,business_services_details.duration as service_duration,business_services_details.price');
        $this->db->from('one_day_package_offerings');
        $this->db->join('business_services', 'business_services.id = one_day_package_offerings.service_id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->where('one_day_package_offerings.vendor_id', $vendor_id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */


       /*
     *  Function to delete business service gallery image  
     */

    public function delete_one_day_package($id) {
        $this->db->where('id', $id);
        $this->db->delete('one_day_package_offerings');

        return true;
    }

    /* Above function ends here */
    
    
       /*
     *  Function to delete business service gallery image  
     */
    
    public function add_one_day_package($post_data) {
        $package_array = array();
        foreach ($post_data['name'] as $key => $value) {
            $package_array[$key]['name'] = $value;
        }
        foreach ($post_data['description'] as $key => $value) {
            $package_array[$key]['description'] = $value;
        }
        foreach ($post_data['duration_hour'] as $key => $value) {
            $package_array[$key]['duration_hour'] = $value;
        }
        foreach ($post_data['duration_minutes'] as $key => $value) {
            $package_array[$key]['duration_minutes'] = $value;
        }



        foreach ($package_array as $keys => $values) {
            $service_slots = array(
                'vendor_id' => $post_data['vendor_id'],
                'service_id' => $post_data['service_id'],
                'name' => $values['name'],
                'description' => $values['description'],
                'duration' => $values['duration_hour'] . ':' . $values['duration_minutes'],
            );
            $this->db->insert('one_day_package_offerings', $service_slots);
        }
        return true;
    }
/* Above function ends here */
    

   public function add_one_time_slot($post_data) {
        $slots_timings = array();
        foreach ($post_data['slot']['start_time'] as $key => $value) {
            $slots_timings[$key]['start_time'] = $value;
        }
        foreach ($post_data['slot']['end_time'] as $key => $value) {
            $slots_timings[$key]['end_time'] = $value;
        }
        foreach ($slots_timings as $keys => $values) {
            $date = $post_data['date'];
            $service_slots = array(
                'service_id' => $post_data['service_id'],
                'date' => $date,
                'start_time' => $values['start_time'],
                'end_time' => $values['end_time'],
                'number_of_slots' => $post_data['no_slots'],
                'active' => 'enable'
            );
            $this->db->insert('services_slots', $service_slots);
        }
        return true;
    }
 public function create_membership($post_data) {
        $membership = array(
            'business_service_id' => $post_data['service_id'],
            'membership' => $post_data['membership'],
            'description' => $post_data['description'],
            'duration' => $post_data['duration'],
            'fees' => $post_data['fees'],
            'max_number_of_members' => $post_data['max_number_of_members']
        );
        $this->db->insert('memberships', $membership);
        return true;
    } 
    
    
    
    /*
     *  Function to  business services listing  
     */

    public function get_one_day_package_details($one_day_package_id) {
        $this->db->select('*');
        $this->db->from('one_day_package_offerings');
        $this->db->where('one_day_package_offerings.id', $one_day_package_id); 
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */
    
    public function update_one_day_packages($post_data) {
       
        $pacakge_details_data = array(
            'name' => $post_data['package_name'],
            'description' => $post_data['description'],
            'duration' => $post_data['hours'].':'.$post_data['minutes']
        );

        $this->db->where('id', $post_data['package_id']);
        $this->db->update('one_day_package_offerings', $pacakge_details_data);
        return true;
    }

public function get_partner_services_mapping($id) {

        $this->db->select('services_business_mapping.*,services.service_name');
        $this->db->from('services_business_mapping');
        $this->db->join('services', 'services.id = services_business_mapping.services_id');
        $this->db->where('services_business_mapping.business_id', $id);
        $mapping_query = $this->db->get();
        $mapping_quer_result = $mapping_query->result();
        return $mapping_quer_result;
    }
}
