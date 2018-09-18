<?php

/**
 * This class gives business offerings services and details
 * 
 * @author Anitha <anitha@nuvodev.com>
 * 
 * Date:04-08-2015
 * 
 * */
class Business_offering extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Function to get services by program id
     */

    public function get_offering_services_list($program_id) {
        $this->db->select('business_services.*,business_services.id as business_service_id,business_programs.*');
        $this->db->from('business_services');
        $this->db->join('business_programs', 'business_services.program_id = business_programs.id');
        $this->db->where('business_services.program_id', $program_id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */


    /*
     * Function to get services details by service id
     */

    public function get_business_offering_service_details($business_service_id) {
        $this->db->select('business_services_details.*,business_services.services,business_programs.business_id');
        $this->db->from('business_services_details');
        $this->db->join('business_services', 'business_services_details.service_id = business_services.id');
        $this->db->join('business_programs', 'business_programs.id = business_services.program_id');
        $this->db->where('business_services_details.service_id', $business_service_id);
        $query = $this->db->get();
        $query_result = $query->result();
        $business_offering_service_details = array();
        if (!empty($query_result)) {
            $business_offering_service_details['details'] = $query_result[0];
        } else {
            $business_offering_service_details['details'] = $query_result;
        }
        $gallery_query = $this->db->get_where('business_service_gallery', array('service_id' => $business_service_id));
        $gallery_query_result = $gallery_query->result();
        $business_offering_service_details['gallery'] = $gallery_query_result;


        $slotQuery = $this->db->get_where('services_slots', array('service_id' => $business_service_id, 'services_slots.active' => 'enable'));
        $slotQueryResult = $slotQuery->result();
        $business_offering_service_details['slots'] = $slotQueryResult;


        $this->db->select('vendor_ratings.*,users.name');
        $this->db->from('vendor_ratings');
        $this->db->join('users', 'users.id = vendor_ratings.user_id');
        $this->db->where('vendor_ratings.service_id', $business_service_id);
        $this->db->where('vendor_ratings.status', 'Done');
        $reviewQuery = $this->db->get();
        $reviewQueryResult = $reviewQuery->result();
        $business_offering_service_details['review'] = $reviewQueryResult;

        $this->db->select_avg('vendor_ratings.rating', 'average_rating');
        $this->db->from('vendor_ratings');
        $this->db->where('service_id', $business_service_id);
        $ave_query = $this->db->get();
        $ave_query_result = $ave_query->result();

        $business_offering_service_details['average_rating'] = $ave_query_result[0];

        return $business_offering_service_details;
    }

    /* Above function ends here */

    /*
     * Function to get transactions list by user id 
     */

    public function get_program_details($service_id, $business_id) {
        $this->db->select('business_programs.*');
        $this->db->from('business_programs');
        $this->db->where('business_programs.service_id', $service_id);
        $this->db->where('business_programs.business_id', $business_id);
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    /*
     * Function to get business services slots business service id 
     */

    public function get_business_services_slots($business_service_id, $choosed_booking_date) {
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');

        if ($choosed_booking_date != $current_date) {
            $this->db->select('services_slots.*');
            $this->db->from('services_slots');
            $this->db->where('services_slots.service_id', $business_service_id);
            $this->db->where('services_slots.date', $choosed_booking_date);
            $this->db->where('services_slots.active', 'enable');
            $query = $this->db->get();
        } else {
            $this->db->select('services_slots.*');
            $this->db->from('services_slots');
            $this->db->where('services_slots.service_id', $business_service_id);
            $this->db->where('services_slots.date', $choosed_booking_date);
            $this->db->where('services_slots.active', 'enable');
            $this->db->where('services_slots.start_time >', $current_time);
            $query = $this->db->get();
        }
        $query_result = $query->result();
        return $query_result;
    }

    /* Above function ends here */

    /*
     * Function to get transaction details
     */

    public function get_transaction_details($booking_id) {
        $this->db->select('transaction_details.*');
        $this->db->from('transaction_details');
        $this->db->where('transaction_details.booking_id', $booking_id);
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $transaction_details = $query_result;
        } else {
            $transaction_details = $query_result[0];
        }
        return $transaction_details;
    }

    /* Above function ends here */


    /*
     * Function to get memberships
     */

    public function get_memberships($service_id) {
        $this->db->select('memberships.*');
        $this->db->from('memberships');
        $this->db->where('memberships.max_number_of_members !=', 0);
        $this->db->where('business_service_id', $service_id);
        //$this->db->group_by('memberships.id');
        $query = $this->db->get();
        $query_result = $query->result();
        $memberships = $query_result;

        return $memberships;
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

    public function get_user_service_review_details($business_service_id, $user_id) {
        $this->db->select('vendor_ratings.*');
        $this->db->from('vendor_ratings');
        $this->db->where('service_id', $business_service_id);
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'Pending');
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

    public function create_membership($post_data) {
        $membership = array(
            'business_service_id' => $post_data['business_service_id'],
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

    public function membership_delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('memberships');
        return true;
    }

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
     *  Function to  business services listing  
     */

    public function offering_gallery_delete($id) {
        $this->db->select('business_service_gallery.*');
        $this->db->from('business_service_gallery');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            $details = $query_result;
        } else {
            $details = $query_result[0];
        }

        $path = $this->config->item('business_services_gallery_path');

        unlink($path . $details->service_id . "/" . $details->images);

        $this->db->where('id', $id);
        $this->db->delete('business_service_gallery');
        return true;
    }

    /*
     *  Function to  business services listing  
     */

    public function get_gallery_detail($id) {
        $this->db->select('business_service_gallery.*');
        $this->db->from('business_service_gallery');
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

            $path = $this->config->item('business_services_gallery_path');
            unlink($path . $post_data['service_id'] . "/" . $post_data['image_name']);

            $files = $image_data;
            $file = $files['file']['name'];

            $count = count($file);
            if ($count > 0) {
                $new_path = $path . $post_data['service_id'] . "/";
                if ($files['file']['name']) {
                    $fname = $business_details->name . "_" . $post_data['service_name'] . "_" . time() . '_' . $file;
                    $img_name = str_replace('', '_', $fname);
                    copy($files['file']['tmp_name'], $new_path . $img_name);
                    $image_name = $business_details->name . "_" . $post_data['service_name'] . "_" . time() . '_' . $files['file']['name'];
                    $gallery = array(
                        'caption' => '',
                        'description' => '',
                        'images' => $image_name,
                    );
                }
            }
        } else {
            $gallery = array(
                'caption' => $post_data['caption'],
                'description' => $post_data['description'],
            );
        }
        $this->db->where('id', $post_data['id']);
        $this->db->update('business_service_gallery', $gallery);
        return true;
    }

    /* Above function ends here */

    public function add_gallery($post_data, $image_data) {
        $business_details = $this->session->userdata('logged_in_vendor_data');

        $path = $this->config->item('business_services_gallery_path');
        $files = $image_data;
        $file = $files['file']['name'];

        $count = count($file);
        if ($count > 0) {
            $new_path = $path . $post_data['service_id'] . "/";
            if ($files['file']['name']) {
                $fname = $business_details->name . "_" . $post_data['service_name'] . "_" . time() . '_' . $file;
                $img_name = str_replace('', '_', $fname);
                copy($files['file']['tmp_name'], $new_path . $img_name);
                $image_name = $business_details->name . "_" . $post_data['service_name'] . "_" . time() . '_' . $files['file']['name'];
                $gallery = array(
                    'service_id' => $post_data['service_id'],
                    'caption' => '',
                    'description' => '',
                    'images' => $image_name,
                );
                $this->db->insert('business_service_gallery', $gallery);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
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

    /*
     *  Function to delete business service gallery image  
     */

    public function one_time_service_slots_delete($id) {
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

    public function update_service_slots($post_data) {
        $old_timings = explode('-', $post_data['slots_time']);
        $start_time = date('H:i:s', strtotime($old_timings[0]));
        $end_time = date('H:i:s', strtotime($old_timings[1]));

        $slots_details_data = array(
            'start_time' => $post_data['new_start_time'],
            'end_time' => $post_data['new_end_time'],
            'number_of_slots' => $post_data['number_of_slots'],
            'active' => $post_data['slots_status'],
        );

        $this->db->where('date', $post_data['date']);
        $this->db->where('start_time', $start_time);
        $this->db->where('end_time', $end_time);
        $this->db->where('service_id', $post_data['service_id']);
        $this->db->update('services_slots', $slots_details_data);
        return true;
    }

    /*
     *  Function to  business services listing  
     */

    public function get_one_day_packages($vendor_id) {
        $this->db->select('one_day_package_offerings.*,business_services.services as service_name,business_services_details.service_type,business_services_details.duration as service_duration,business_services_details.price');
        $this->db->from('one_day_package_offerings');
        $this->db->join('business_services', 'business_services.id = one_day_package_offerings.service_id');
        $this->db->join('business_services_details', 'business_services.id = business_services_details.service_id');
        $this->db->where('one_day_package_offerings.vendor_id', $vendor_id);
        //$this->db->group_by('one_day_package_offerings.service_id'); 
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

    public function add_one_day_package($post_data) {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        $vendor_id = $logged_in_user_details->business_id;
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
                'vendor_id' => $vendor_id,
                'service_id' => $post_data['service_id'],
                'name' => $values['name'],
                'description' => $values['description'],
                'duration' => $values['duration_hour'] . ':' . $values['duration_minutes'],
            );
            $this->db->insert('one_day_package_offerings', $service_slots);
        }
        return true;
    }

    /*
     * Function to get memberships
     */

    public function get_memberships_for_offering($service_id) {
        $this->db->select('memberships.*');
        $this->db->from('memberships');
        $this->db->where('memberships.max_number_of_members !=', 0);
        $this->db->where('business_service_id', $service_id);
        //$this->db->group_by('memberships.id');
        $query = $this->db->get();
        $query_result = $query->result();
        $memberships = $query_result;

        return $memberships;
    }

    /* Above function ends here */

    public function get_slots_by_date($data) {
        $this->db->select('services_slots.*,business_services_details.service_type');
        $this->db->from('services_slots');
        $this->db->join('business_services_details', 'services_slots.service_id = business_services_details.service_id','left');
        $this->db->where('services_slots.date', $data['selected_date']);
         $this->db->where('services_slots.service_id', $data['service_id']);
        $this->db->where('services_slots.active', 'enable');
        $query = $this->db->get();

        $query_result = $query->result();
        return $query_result;
    }

}
