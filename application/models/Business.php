<?php

/**
 * This class gives vendors list and vendors details
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:04-08-2015
 * 
 * */
class Business extends CI_Model {

    function __construct() {
// Call the Model constructor
        parent::__construct();
        $this->load->library('PasswordHash');
    }

    /*
     * Function to get locations by service id
     */

    public function get_locations_by_service($service_id) {
        $this->db->select('locations.id,business_details.suburb,locations.suburb as area_name');
        $this->db->from('business_details');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->join('services', 'services_business_mapping.services_id = services.id');
        $this->db->where('services.id', $service_id);
        $this->db->group_by('business_details.suburb');
        $query = $this->db->get();
        $query_result = $query->result();
        foreach ($query_result as $key => $value) {
            $vendors = self::get_business_providers($service_id, $value->id);
            if (empty($vendors)) {
                unset($query_result[$key]);
            }
        }
        return $query_result;
    }

    /* Above function ends here */

    /*
     * Function to get business providers list by service id and location
     */

    public function get_business_providers($service_id, $location_id) {
        $this->db->select('business_details.*,locations.suburb as area_name');
        $this->db->from('business_details');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->join('services', 'services_business_mapping.services_id = services.id');
        $this->db->where('services.id', $service_id);
        $this->db->where('business_details.suburb', $location_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $business_providers = array();

        foreach ($query_result as $key => $value) {
            $business_providers[$key]['details'] = $value;
            $gallery_query = $this->db->get_where('business_gallery', array('business_id' => $value->id));
            $gallery_query_result = $gallery_query->result();
            $business_providers[$key]['gallery'] = $gallery_query_result;
        }


        return $business_providers;
    }

    /* Above function ends here */

    /*
     * Function to get business provider details by id 
     */

    public function get_business_provider_details($id) {
        $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude,services_business_mapping.services_id');
        $this->db->from('business_details');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
        $this->db->join('locations', 'business_details.suburb = locations.id');
        $this->db->join('services', 'services_business_mapping.services_id = services.id');
        $this->db->where('business_details.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();

        $business_provider_details = array();
        if (!empty($query_result)) {
            $business_provider_details['details'] = $query_result[0];
        } else {
            $business_provider_details['details'] = $query_result;
        }
        $this->db->select('vendor_ratings.*,users.name');
        $this->db->from('vendor_ratings');
        $this->db->join('users', 'users.id = vendor_ratings.user_id');
        $this->db->where('vendor_ratings.vendor_id', $id);
        $this->db->where('vendor_ratings.status', 'Done');
        $reviewQuery = $this->db->get();
        $reviewQueryResult = $reviewQuery->result();
        $business_provider_details['details']->review = count($reviewQueryResult);

        $this->db->select_avg('vendor_ratings.rating', 'average_rating');
        $this->db->from('vendor_ratings');
        $this->db->where('vendor_id', $id);
        $ave_query = $this->db->get();
        $ave_query_result = $ave_query->result();

        $business_provider_details['details']->average_rating = $ave_query_result[0]->average_rating;

        $gallery_query = $this->db->get_where('business_gallery', array('business_id' => $id));
        $gallery_query_result = $gallery_query->result();
        $business_provider_details['gallery'] = $gallery_query_result;

//
//        $this->db->select('business_services.*,business_services_details.price,business_services_details.duration');
//        $this->db->from('business_services');
//        $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id', 'left');
//        $this->db->join('business_programs', 'business_programs.id = business_services.program_id', 'left');
//        $this->db->where('business_programs.business_id', $id);
//        $this->db->group_by('business_programs.type');
//        $services_query = $this->db->get();
//        $services_results = $services_query->result();
//        // $services = array();
//        foreach ($services_results as $key => $value) {
//            $this->db->select('business_service_gallery.*');
//            $this->db->from('business_service_gallery');
//            $this->db->where('business_service_gallery.service_id', $value->id);
//            $gallery_query = $this->db->get();
//            $gallery_result = $gallery_query->result();
//            $services[] = $value;
//            $services[$key]->offering_gallery = $gallery_result;
//        }
//
//
//
//        $business_provider_details['offering_service'] = $services;


        return $business_provider_details;
    }

    /* Above function ends here */

    /*
     * Function to get offering programs by business provider id
     */

    public function get_offering_programs($service_id, $business_provider_id) {
        $this->db->select('*');
        $this->db->from('business_programs');
// $this->db->where('business_programs.service_id', $service_id);
        $this->db->where('business_programs.business_id', $business_provider_id);
        $query = $this->db->get();

        $query_result = $query->result();

        $query_result_array = array();
        foreach ($query_result as $key => $value) {

            if ($value->type == 'Packages') {
                $query_result_array['Packages'][] = $value;
            } elseif ($value->type == 'Offerings') {
                $query_result_array['Offerings'][] = $value;
            } else {
                $query_result_array['Sessions'][] = $value;
            }
        }
        return $query_result_array;
    }

    /* Above function ends here */

    /*
     * Function to get all business providers list 
     */

    public function get_all_business_providers() {
        $this->db->select('business_details.*');
        $this->db->from('business_details');
        $this->db->order_by('business_details.name', 'asc');
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */


    /*
     *  Function to get vendor memberships  
     */

    public function get_vendor_memberships() {
        $this->db->select('*');
        $this->db->from('vendor_membership');
        $query = $this->db->get();
        $query_result = $query->result();

        return $query_result;
    }

    /* Above function ends here */


    /*
     * Function to insert partner details 
     */

    public function add_partner_registrations($partner_details, $business_details) {

        $business_details_data = array(
            'street1' => $business_details['address1'],
            'street2' => $business_details['address2'],
            'suburb' => $business_details['area'],
            'city' => $business_details['city'],
            'state' => $business_details['state'],
            'country' => $business_details['country'],
            'zipcode' => $business_details['zipcode'],
            'website' => $business_details['website'],
            'email' => $business_details['business_email'],
            'landline' => $business_details['landline'],
            'phone' => $business_details['mobile'],
            'facebook_page' => $business_details['fb_page'],
            'twitter_handle' => $business_details['tw_page'],
            'instagram' => $business_details['instagram'],
            'status' => 'De-active'
        );
        $this->db->where('id', $partner_details->id);
        $this->db->update('business_details', $business_details_data);

        foreach ($business_details['business_type'] as $type) {

            $business_type = explode('/', $type);
            $business_type_id = $business_type[0];

            $business_mapping = array(
                'services_id' => $business_type_id,
                'business_id' => $partner_details->id
            );
            $this->db->insert('services_business_mapping', $business_mapping);
        }



        $vendor_details['details'] = self::get_partner_details_by_username($partner_details->username);

        $vendor_registration_email_content = $this->load->view('emails/vendor_registration_success', $vendor_details, true);
//$to = $partner_details->username;
// $to = 'vikrant@nuvodev.com';
        $to = 'partner@zinguplife.com';
        $from = "info@zinguplife.com";
        $registration_mail_subject = "ZingUpLife Partner Registration confirmation !!!";
        $registration_message = $vendor_registration_email_content;

        $this->Mailing->send_mail($to, $from, $registration_mail_subject, $registration_message);


// $admin_vendor_registration_email_content = $this->load->view('emails/admin_vendor_registration_success', $vendor_details, true);

        /* $to = 'partner@zinguplife.com';
          //$to = 'vikrant@nuvodev.com';

          $from = "info@zinguplife.com";
          $registration_mail_subject = "Partner registration success mail";
          $registration_message = $admin_vendor_registration_email_content;

          $this->Mailing->send_mail($to, $from, $registration_mail_subject, $registration_message); */

        $messgae_to = '+91' . $business_details['mobile'];
        $sms_content = 'Congratulations! You have successfully registered with Zinguplife';

        $this->Mailing->send_sms($messgae_to, $sms_content);
        return true;
    }

    /* Above function ends here */

    /*
     *  Function to get partner details by given username  
     */

    public function get_partner_details_by_username($username) {
//        $this->db->select('vendors.*,business_details.id as business_id,business_details.name,business_details.suburb,services_business_mapping.services_id');
//        $this->db->from('vendors');
//        $this->db->join('business_details', 'business_details.business_id = vendors.id');
//        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
//        $this->db->where('vendors.username', $username);
//        $this->db->select('vendors.*,business_details.id as business_id,business_details.name,business_details.suburb');
//        $this->db->from('vendors');
//        $this->db->join('business_details', 'business_details.business_id = vendors.id');
////$this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id');
//        $this->db->where('vendors.username', $username);

        $this->db->select('vendors.*,business_details.id as business_id,business_details.name,business_details.suburb');
        $this->db->from('vendors');
        $this->db->join('business_details', 'business_details.business_id = vendors.id');
        $this->db->join('services_business_mapping', 'services_business_mapping.business_id = business_details.id', 'left');
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
     *  Function to validate partner credentials  
     */

    public function validate_partner($username, $password) {
        $partner_validation_details = array();
        $partner_details = self::get_partner_details_by_username($username);

        $partner_validation_details['partner_details'] = $partner_details;
        if (!empty($partner_details)) {
            $validate_password = PasswordHash::validate_password($password, $partner_details->password);
            if ($validate_password == 1 || $validate_password == true) {
                $partner_validation_details['validation_status']['status'] = 'Success';
                $partner_validation_details['validation_status']['error_type'] = '';
            } else {
                $partner_validation_details['validation_status']['status'] = 'Invalid username or password';
                $partner_validation_details['validation_status']['error_type'] = '';
            }
        } else {
            $partner_validation_details['validation_status']['status'] = 'Invalid username or password';
            $partner_validation_details['validation_status']['error_type'] = '';
        }
        return $partner_validation_details;
    }

    /* Above function ends here */



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
     *  Function to partner's profile data in database
     */

    public function update_partner_profile($user_data) {

        $partner_id = $user_data['vendor_id'];
        if (isset($user_data['name']) && $user_data['name'] != '') {
            $updated_user_data = array(
                'first_name' => $user_data['name'],
            );
            $this->db->where('id', $partner_id);
            $this->db->update('vendors', $updated_user_data);
            return $updated_user_data;
        }


        if (isset($user_data['lastname']) && $user_data['lastname'] != '') {

            $updated_user_data = array(
                'last_name' => $user_data['lastname'],
            );
            $this->db->where('id', $partner_id);
            $this->db->update('vendors', $updated_user_data);
            return $updated_user_data;
        }
    }

    /* Above function ends here */

    /*
     *  Function to get partner details by given username  
     */

    public function get_business_information($partnerid) {
        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->where('id', $partnerid);
        $query = $this->db->get();
        $query_result = $query->result();
        $partner_details = array();
        if (count($query_result) == 0) {
            $partner_details['partner'] = $query_result;
        } else {
            $partner_details['partner'] = $query_result[0];
        }

        $this->db->select('*');
        $this->db->from('business_details');
        $this->db->where('business_id', $partner_details['partner']->id);
        $query1 = $this->db->get();
        $query_result1 = $query1->result();
        if (count($query_result1) == 0) {
            $partner_details['business'] = $query_result1;
        } else {
            $partner_details['business'] = $query_result1[0];
        }
        $this->db->select('*');
        $this->db->from('services_business_mapping');
        $this->db->where('business_id', $partner_details['business']->id);
        $mapping_query = $this->db->get();
        $mapping_quer_result = $mapping_query->result();
        $partner_details['mapping'] = $mapping_quer_result;

        $this->db->select('*');
        $this->db->from('business_gallery');
        $this->db->where('business_id', $partner_details['business']->id);
        $query2 = $this->db->get();
        $query_result2 = $query2->result();
        $partner_details['gallery'] = $query_result2;

        return $partner_details;
    }

    /* Above function ends here */

    /*
     *  Function to delete business gallery  
     */

    public function delete_business_gallery($postdata) {

        $this->db->where('business_id', $postdata['business_id']);
        $this->db->where('images', $postdata['name']);
        $this->db->delete('business_gallery');

        unlink("assets/uploads/business_providers/gallery/" . $postdata['business_id'] . "/" . $postdata['name']);
        return true;
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
            'longitude' => $data['longitude'],
            'payment_option' => $data['payment_option']
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

    public function insert_business_programs($postdata, $business_details) {
        $program_details = array(
            'service_id' => $postdata['service_id'],
            'business_id' => $business_details->business_id,
            'program' => $postdata['package'],
            'type' => $postdata['type']
        );

        $this->db->insert('business_programs', $program_details);
        return $this->db->insert_id();
    }

    /* Above function ends here */

    /*
     *  Function to insert business services  
     */

    public function insert_business_services($postdata, $files, $business_details) {
        if (!empty($postdata['packages']) && !empty($postdata['service'])) {
            $service_data = array(
                'program_id' => $postdata['packages'],
                'services' => $postdata['service']
            );
        } else
            return false;

        $this->db->insert('business_services', $service_data);
        $service_id = $this->db->insert_id();
//echo $service_id;exit();
        if (!is_dir('assets/uploads/business_services/gallery/' . $service_id . '/')) {
            mkdir('assets/uploads/business_services/gallery/' . $service_id . '/', 0777, TRUE);
        }
        $path = './assets/uploads/business_services/gallery/' . $service_id . '/';
//echo "<pre>";print_r($business_details->name);exit();
        $file = $files['file']['name'];
// print_r($file);exit();
        $count = count($file);
        if ($count > 0) {
            $this->Business->delete_business_service_gallery($service_id);
            for ($i = 0; $i < $count; $i++) {
                if ($files['file']['name'][$i]) {
                    $fname = $business_details->name . "_" . $postdata['service'] . "_" . $file[$i];

                    copy($files['file']['tmp_name'][$i], $path . $fname);
                    $image_name = $business_details->name . "_" . $postdata['service'] . "_" . $files['file']['name'][$i];
                    $this->Business->insert_business_service_gallery($service_id, $image_name);
                }
            }
        }

        $service_details_data = array(
            'service_id' => $service_id,
            'description' => $postdata['description'],
            'duration' => $postdata['duration_hour'] . ':' . $postdata['duration_minutes'],
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

    public function delete_business_service_gallery($service_id) {

        $this->db->where('service_id', $service_id);
        $this->db->delete('business_service_gallery');
    }

    /* Above function ends here */

    /*
     *  Function to insert business service gallery  
     */

    public function insert_business_service_gallery($service_id, $image_name) {


        $gallery_details = array(
            'service_id' => $service_id,
            'images' => $image_name
        );

        $this->db->insert('business_service_gallery', $gallery_details);
    }

    /* Above function ends here */


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
     *  Validating user's credentials and sending reset password token to user 
     */

    public function forgot_password_request($username) {
        $user_details = $data['user_details'] = self::get_partner_details_by_username($username);
// echo "<pre>";print_r($user_details);exit();
        if (count($user_details) == 0) {
            return 'Failed';
        } else {

            $hashed = PasswordHash::create_hash($username);
            $hashed_data = explode(':', $hashed);
            $reset_password_token = str_replace('/', '', $hashed_data[2]);

            $reset_password_token_time = date('Y-m-d H:i:s');
            $data['reset_password_token_data'] = $reset_password_token_data = array(
                'reset_password_token' => $reset_password_token,
                'reset_password_time' => $reset_password_token_time
            );

            $this->db->where('username', $username);
            $this->db->update('vendors', $reset_password_token_data);

            $email_content = $this->load->view('emails/partner_forgot_password_email', $data, true);
            $to = $username;
            $from = "info@zinguplife.com";
            $subject = "Zinguplife account reset password request.";
            $message = $email_content;

            $this->Mailing->send_mail($to, $from, $subject, $message);
        }

        return 'Success';
    }

    /* Above function ends here */

    /*
     *  Function for validating password token
     */

    public function validate_password_token($passwordToken) {
        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->where('reset_password_token', $passwordToken);
        $query = $this->db->get();
        $query_result = $query->result();
//echo $this->db->last_query();exit();
//echo "<pre>";print_r($query_result);exit();
        if (count($query_result) == 0) {
            return 'Failed';
        } else {
            $user_details = $query_result[0];
            $to_time = strtotime(date('Y-m-d H:i:s'));
            $from_time = strtotime($user_details->reset_password_time);
            $time_difference = abs($to_time - $from_time);

            if ($time_difference >= 7200) {
                return 'Failed';
            } else {
                return $user_details;
            }
        }
    }

    /* Above function ends here */


    /*
     *  updating new password for user 
     */

    public function update_new_password($username, $password) {
        $reset_password = array(
            'password' => $password,
            'reset_password_token' => '',
            'reset_password_time' => ''
        );

        $this->db->where('username', $username);
        $this->db->update('vendors', $reset_password);

        $data['user_details'] = $user_details = self::get_partner_details_by_username($username);
        $email_content = $this->load->view('emails/change_password_success', $data, true);
        $to = $username;
        $from = "info@zinguplife.com";
//$headers = "From: " . $from . "\r\n";
        $subject = "Zinguplife account password changed successfully.";
        $message = $email_content;

        $this->Mailing->send_mail($to, $from, $subject, $message);
        $messgae_to = '+91' . $user_details->phone;
        $sms_content = 'Your Zinguplife account password has been changed successfully.';
        $this->Mailing->send_sms($messgae_to, $sms_content);
        return TRUE;
    }

    /* Above function ends here */


    /*
     *  Function to update views  
     */

    public function update_vendor_page_views($business_id) {

        $this->db->select('views');
        $this->db->from('business_details');
        $this->db->where('business_id', $business_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $count = $query_result[0]->views;
        $count = $count + 1;

        $updated_data = array(
            'views' => $count,
        );
        $this->db->where('business_id', $business_id);
        $this->db->update('business_details', $updated_data);
        return $updated_user_data;
    }

    /* Above function ends here */

    /*
     *  Function to  business services listing  
     */

    public function validate_vendor_email($vendor_email) {
        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->where('username', $vendor_email);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */


    /*
     *  Function to  business services listing  
     */

    public function get_all_services_listing($data) {
        $this->db->select('*');
        $this->db->from('business_programs');
        $this->db->where('business_id', $data->business_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $details = array();
        foreach ($query_result as $result) {
            $this->db->select('business_services.*,business_services_details.*');
            $this->db->from('business_services');
            $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
            $this->db->where('business_services.program_id', $result->id);
            $query1 = $this->db->get();
            $query_result1 = $query1->result();
            array_push($details, $query_result1);
        }

        return $details;
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

    public function updating_business_services($post_data) {
        $updated_data = array(
            'services' => $post_data['service_name']
        );
        $this->db->where('id', $post_data['service_id']);
        $this->db->update('business_services', $updated_data);


        $updated_data = array(
            'description' => $post_data['description'],
            'duration' => $post_data['duration_hour'].':'.$post_data['duration_minutes'],
            'price' => $post_data['price'],
            'discount' => $post_data['discount'],
            'discount_start_date' => $post_data['discount_start_date'],
            'discount_end_date' => $post_data['discount_end_date'],
            'service_type' => $post_data['service_type']
        );
        $this->db->where('service_id', $post_data['service_id']);
        $this->db->update('business_services_details', $updated_data);
        return true;
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
//echo "<pre>";print_r($data);exit();
        $this->db->where('id', $post_data['service_id']);
        $this->db->delete('business_services');

        return true;
    }

    /* Above function ends here */



    /*
     *  Function to  business services listing  
     */

    public function delete_business_package($post_data) {
//echo "<pre>";print_r($data);exit();
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
        $this->db->select('business_services.*,business_services_details.*');
        $this->db->from('business_services');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->where('business_services.program_id', $package_details['package']->id);
        $query1 = $this->db->get();
        $query_result1 = $query1->result();

        if (!empty($query_result1)) {
            $package_details['service'] = $query_result1;
        }
        return $package_details;
    }

    /* Above function ends here */

    public function getLnt($zip) {
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=
" . urlencode($zip) . "&sensor=false";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);
        $result1[] = $result['results'][0];
        $result2[] = $result1[0]['geometry'];
        $result3[] = $result2[0]['location'];
        return $result3[0];
    }

    public function create_vendor($post_data) {
        $digits = 6;
        $email_verification_code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

        $hashed = PasswordHash::create_hash($post_data['password']);
        $partner_details_data = array(
            'username' => $post_data['email'],
            'password' => $hashed,
            'first_name' => $post_data['first_name'],
            'last_name' => $post_data['last_name'],
            'membership_type' => $post_data['plan_id'],
            'status' => 'De-active',
            'role' => 'vendor',
            'email_verification_code' => $email_verification_code,
            'email_verification_status' => '0'
        );



        $this->db->insert('vendors', $partner_details_data);
        $vendorid = $this->db->insert_id();

        $business_details_data = array(
            'business_id' => $vendorid,
            'name' => $post_data['business_name'],
            'street1' => '',
            'street2' => '',
            'suburb' => '',
            'city' => '',
            'state' => '',
            'country' => '',
            'zipcode' => '',
            'phone' => '',
            'status' => 'De-active'
        );

        $this->db->insert('business_details', $business_details_data);
        return $email_verification_code;
    }

    /*
     * Function to cancel order 
     */

    public function verify_email($code) {
        $this->db->select('*');
        $this->db->from('vendors');
        $this->db->join('business_details', 'business_details.business_id = vendors.id');
        $this->db->where('vendors.email_verification_code', $code);
        $query = $this->db->get();
        $query_result = $query->result();
        if (!empty($query_result)) {
            $order_status_update = array(
                'email_verification_status' => '1'
            );

            $this->db->where('email_verification_code', $code);
            $this->db->update('vendors', $order_status_update);


            $partner_details = array();
            if (count($query_result) == 0) {
                $partner_details = $query_result;
            } else {
                $partner_details = $query_result[0];
            }
            return $partner_details;
        } else {
            return "not matched";
        }
    }

    /* Above function ends here */



    /*
     * Function to get all business providers list 
     */

    public function get_service_slug($service_id) {
        $this->db->select('slug');
        $this->db->from('services');
        $this->db->where('id', $service_id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    public function review_and_rating($rating_data, $code) {
        $review_and_rating_data = array(
            'rating' => $rating_data['rating'],
            'title' => $rating_data['title'],
            'review' => $rating_data['review'],
            'status' => 'Done',
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->where('rating_code', $code);
        $this->db->update('vendor_ratings', $review_and_rating_data);
        return true;
    }

    /*
     * Function to get all business providers list 
     */

    public function review_and_rating_details($code) {
        $this->db->select('vendor_ratings.status');
        $this->db->from('vendor_ratings');
        $this->db->where('rating_code', $code);
        $query = $this->db->get();
        $query_result = $query->result();

        $details = array();
        if (count($query_result) == 0) {
            $details = $query_result;
        } else {
            $details = $query_result[0];
        }
        return $details;
    }

    /* Above function ends here */

    public function get_details_to_send_for_review() {
        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->where('services_slots.date =', date('Y-m-d'));

        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();

        foreach ($query_result as $key => $value) {
            $transaction_details[$key]['transactions'] = $value;

            $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $transaction_details[$key]['vendor_details'] = $vendor_result[0];

            $current_date = date('Y-m-d');
            if ($value->date < $current_date) {
                $transaction_details[$key]['transactions']->expiry = 'yes';
            } else {
                $transaction_details[$key]['transactions']->expiry = 'no';
            }

            $this->db->select('users.id,users.name,users.username');
            $this->db->from('users');
            $this->db->where('users.id', $value->paid_by);
            $user_query = $this->db->get();
            $user_result = $user_query->result();
            $transaction_details[$key]['user_details'] = $user_result[0];
        }

        foreach ($transaction_details as $key => $value) {
            $booking_date_time = $value['transactions']->date . ' ' . $value['transactions']->end_time;

            $current_time = date('Y-m-d H:i:s');
            $timediff = strtotime($current_time) - strtotime($booking_date_time);

            if ($timediff > 7200) {

                $review_data = array(
                    'rating_code' => md5($value['transactions']->booking_id),
                    'booking_id' => $value['transactions']->booking_id,
                    'vendor_id' => $value['transactions']->provider_id,
                    'user_id' => $value['transactions']->user_id,
                    'service_id' => $value['transactions']->service_id,
                    'rating' => '',
                    'title' => '',
                    'review' => '',
                    'status' => 'Pending'
                );
                $this->db->insert('vendor_ratings', $review_data);
                $value['code'] = $review_data['rating_code'];
                $review_email_content = $this->load->view('emails/review', $value, true);
                $to = $value['user_details']->username;
// $to = 'kushal@nuvodev.com';
                $from = "Zinguplife<info@zinguplife.com>";

                $review_mail_subject = "Zinguplife- tell us more about your recent booking";
                $review_message = $review_email_content;
                $this->Mailing->send_mail($to, $from, $review_mail_subject, $review_message);
            }
        }


        return true;
    }

    /* Above function ends here */

    public function get_review_details($code) {
        $this->db->select('transaction_details.*,booking_info.*,business_services.*,business_services_details.duration,business_services_details.price,services_slots.*');
        $this->db->from('transaction_details');
        $this->db->join('booking_info', 'transaction_details.booking_id = booking_info.id');
        $this->db->join('business_services', 'booking_info.service_id = business_services.id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->join('services_slots', 'booking_info.slot_id = services_slots.id');
        $this->db->join('vendor_ratings', 'vendor_ratings.booking_id = booking_info.id');


        $query = $this->db->get();
        $query_result = $query->result();
        $transaction_details = array();

        foreach ($query_result as $key => $value) {
            $transaction_details['transactions'] = $value;

            $this->db->select('business_details.*,locations.suburb as area_name, locations.latitude as area_latitude, locations.longitude as area_longitude');
            $this->db->from('business_details');
            $this->db->join('locations', 'business_details.suburb = locations.id');
            $this->db->where('business_details.id', $value->provider_id);
            $vendor_query = $this->db->get();
            $vendor_result = $vendor_query->result();
            $transaction_details['vendor_details'] = $vendor_result[0];
        }


        return $transaction_details;
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
     *  Function to delete business service gallery image  
     */

    public function service_slots_delete($id) {
        $ids = explode(',', $id);
        foreach ($ids as $key => $value) {
            $this->db->where('id', $value);
            $this->db->delete('services_slots');
        }
        return true;
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

    /*
     *  Function to  business services listing  
     */

    public function gallery_delete($id) {
        $this->db->select('business_gallery.*');
        $this->db->from('business_gallery');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $details = $query_result;
        } else {
            $details = $query_result[0];
        }

        $path = $this->config->item('business_providers_gallery_path');

        unlink($path . $details->business_id . "/" . $details->images);

        $this->db->where('id', $id);
        $this->db->delete('business_gallery');
        return true;
    }

    /*
     *  Function to  business services listing  
     */

    public function get_gallery_detail($id) {
        $this->db->select('business_gallery.*');
        $this->db->from('business_gallery');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $details = $query_result;
        } else {
            $details = $query_result[0];
        }

        return $details;
    }

    public function update_gallery($post_data, $image_data) {
        $business_details = $this->session->userdata('logged_in_vendor_data');
        if ($image_data['file']['name'] != '') {

            $path = $this->config->item('business_providers_gallery_path');
            unlink($path . $post_data['vendor_id'] . "/" . $post_data['image_name']);

            $files = $image_data;
            $file = $files['file']['name'];

            $count = count($file);
            if ($count > 0) {
                $new_path = $path . $post_data['vendor_id'] . "/";
                if ($files['file']['name']) {
                    $fname = $post_data['vendors_name'] . "_" . time() . '_' . $file;
                    $img_name = str_replace('', '_', $fname);
                    copy($files['file']['tmp_name'], $new_path . $img_name);
                    $image_name = $post_data['vendors_name'] . "_" . time() . '_' . $files['file']['name'];
                    $gallery = array(
                        'images' => $image_name,
                    );
                }
            }
            $this->db->where('id', $post_data['id']);
            $this->db->update('business_gallery', $gallery);
        }

        return true;
    }

    /* Above function ends here */

    public function add_gallery($image_data) {
        $business_details = $this->session->userdata('logged_in_vendor_data');

        if ($image_data['file']['name'] != '') {

            $path = $this->config->item('business_providers_gallery_path');
            $files = $image_data;
            $file = $files['file']['name'];

            $count = count($file);
            if ($count > 0) {
                $new_path = $path . $business_details->business_id . "/";
                if ($files['file']['name']) {
                    $fname = $business_details->name . "_" . time() . '_' . $file;
                    $img_name = str_replace('', '_', $fname);
                    copy($files['file']['tmp_name'], $new_path . $img_name);
                    $image_name = $business_details->name . "_" . time() . '_' . $files['file']['name'];
                    $gallery = array(
                        'business_id' => $business_details->business_id,
                        'images' => $image_name
                    );
                }
            }
            $this->db->insert('business_gallery', $gallery);
        }

        return true;
    }

    /* Above function ends here */

    public function get_partner_services_mapping($id) {

        $this->db->select('services_business_mapping.*,services.service_name');
        $this->db->from('services_business_mapping');
        $this->db->join('services', 'services.id = services_business_mapping.services_id');
        $this->db->where('services_business_mapping.business_id', $id);
        $mapping_query = $this->db->get();
        $mapping_quer_result = $mapping_query->result();
        return $mapping_quer_result;
    }

    /*
     * Function to get offerings by business provider id
     */

    public function get_offering_by_vendor($id) {
        $this->db->select('business_services.*,business_services_details.service_type,business_services_details.description,business_services_details.price,business_services_details.duration,business_programs.type');
        $this->db->from('business_services');
        $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id', 'left');
        $this->db->join('business_programs', 'business_programs.id = business_services.program_id', 'left');
        $this->db->where('business_programs.business_id', $id);
        $services_query = $this->db->get();
        $services_results = $services_query->result();

        foreach ($services_results as $key => $value) {
            $this->db->select('business_service_gallery.*');
            $this->db->from('business_service_gallery');
            $this->db->where('business_service_gallery.service_id', $value->id);
            $gallery_query = $this->db->get();
            $gallery_result = $gallery_query->result();

            if ($value->type == 'Packages') {
                $services['Packages'][] = $value;
                $services['Packages'][$key]->gallery = $gallery_result;
            } elseif ($value->type == 'Offerings') {
                $services['Offerings'][] = $value;
                $services['Offerings'][$key]->gallery = $gallery_result;
            } else {
                $services['Sessions'][] = $value;
                $services['Sessions'][$key]->gallery = $gallery_result;
            }
        }

        return $services;
    }

    /* Above function ends here */

    /*
     * Function to get offerings by business provider id
     */

    public function get_all_offerings_by_vendor($id) {
        $date = date('Y-m-d', strtotime(' +1 day'));

        $this->db->select('business_services.*,business_services_details.description,business_services_details.price,business_services_details.service_type,business_services_details.duration,business_programs.type');
        $this->db->from('business_services');
        $this->db->join('business_services_details', 'business_services_details.service_id = business_services.id', 'left');
        $this->db->join('business_programs', 'business_programs.id = business_services.program_id', 'left');
        $this->db->where('business_programs.business_id', $id);
        $services_query = $this->db->get();
        $services_results = $services_query->result();

        foreach ($services_results as $key => $value) {
            $this->db->select('business_service_gallery.*');
            $this->db->from('business_service_gallery');
            $this->db->where('business_service_gallery.service_id', $value->id);
            $gallery_query = $this->db->get();
            $gallery_result = $gallery_query->result();
            $services[] = $value;
            if ($value->type == 'Packages') {

                $services[$key]->gallery = $gallery_result;
            } elseif ($value->type == 'Offerings') {
                $services[$key]->gallery = $gallery_result;
            } else {
                $services[$key]->gallery = $gallery_result;
            }
            if ($value->service_type == 'hourly') {
                $this->db->select('services_slots.*');
                $this->db->from('services_slots');
                $this->db->where('services_slots.service_id', $value->id);
                $this->db->where('services_slots.date >', $date);
                $this->db->where('services_slots.active', 'enable');
                $slotQuery = $this->db->get();
                $slotQueryResult = $slotQuery->result();
                $services[$key]->slots = $slotQueryResult;
            } else {
                $this->db->select('memberships.*');
                $this->db->from('memberships');
                $this->db->where('memberships.max_number_of_members !=', 0);
                $this->db->where('memberships.business_service_id', $value->id);
                $mem_query = $this->db->get();
                $mem_query_result = $mem_query->result();
                $memberships = $mem_query_result;
                $services[$key]->slots = $memberships;
            }
        }

        return $services;
    }

    /* Above function ends here */

    public function get_review_for_vendors($id) {
        $this->db->select('vendor_ratings.*,users.name,user_details.image');
        $this->db->from('vendor_ratings');
        $this->db->join('users', 'users.id = vendor_ratings.user_id');
        $this->db->join('user_details', 'user_details.user_id = users.id');
        $this->db->where('vendor_ratings.vendor_id', $id);
        $this->db->where('vendor_ratings.status', 'Done');
        $reviewQuery = $this->db->get();
        $reviewQueryResult = $reviewQuery->result();
        return $reviewQueryResult;
    }

    public function add_vendor_review($post_data) {
        $review_data = array(
            'rating_code' => '',
            'booking_id' => '',
            'vendor_id' => $post_data['id'],
            'user_id' => $post_data['user_id'],
            'service_id' => '',
            'rating' => $post_data['rating'],
            'title' => $post_data['title'],
            'review' => $post_data['review'],
            'status' => 'Done'
        );
        $this->db->insert('vendor_ratings', $review_data);

        return true;
    }

}
