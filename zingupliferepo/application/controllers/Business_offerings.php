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
class Business_offerings extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Business_offering');
        $this->load->model('Business');
        $this->load->helper('text');
        $this->load->model ( 'User' );
    }

    /*
     * Function to get business offering program list by business provider id
     */

    public function get_offering_programs_list() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $service_id = $this->session->userdata('service_id');
        $this->User_activity->insert_user_activity();
        $business_provider_id = $this->uri->segment(2);
        $this->session->set_userdata("business_provider_id", $business_provider_id);
        $data['business_provider_id'] = $business_provider_id;
        $data['offering_programs'] = $this->Business->get_offering_programs($service_id, $business_provider_id);

        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['slug'] = $this->Business->get_service_slug($data['business_provider_details']['details']->services_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['main_content'] = 'offering_programs';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     * Function to get business offering services list by program
     */

    public function get_business_offering_services_list() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $program = $this->uri->segment(2);
        $business_provider_id = $this->session->userdata('business_provider_id');
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['offering_services'] = $this->Business_offering->get_offering_services_list($program);
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $data['title'] = "Offering Services";
        $data['main_content'] = 'services_list';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */


    /*
     * Function to get  business offering service's details by business service id
     */

    public function get_business_offering_services_details() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $business_service_id = $this->uri->segment(2);
        $this->session->unset_userdata('booking_duration');
        $this->session->set_userdata("business_service_id", $business_service_id);
        $data['logged_in_user_details'] = $this->session->userdata('logged_in_user_data');

        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);

        $business_provider_id = $data['get_offering_service_details']['details']->business_id;
        $this->session->set_userdata("business_provider_id", $business_provider_id);
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);

        $data['memberships'] = $this->Business_offering->get_memberships($data['business_provider_details']['details']->services_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['service_gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
        $data['title'] = $data['get_offering_service_details']['details']->services;
        $data['review_details'] = $this->Business_offering->get_user_service_review_details($business_service_id, $data['logged_in_user_details']->user_id);

        $data['provider_id'] = $business_provider_id;
        $data['service_id'] = $business_service_id;

        $data['main_content'] = 'business_offering_service_details';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     *  Validating user's credentials and sending reset password token to user 
     */

    public function review_service() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');

        $post_data = $this->input->post();
        if (!empty($logged_in_user_details)) {
            $this->load->model('Business');
            $review_status = $this->Business->update_review_details($post_data);
            redirect('/offeringServiceDetails/' . $post_data['service_id'] . '');
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to write review !!!.');
            redirect('/offeringServiceDetails/' . $post_data['service_id'] . '');
        }
    }

    /* Above function ends here */
    /*
     *  Function for partner profile update
     */

    public function offerings_memberships() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $user_data = $this->session->userdata('logged_in_vendor_data');
            $service_id = $this->uri->segment(3);
            $data['service_id'] = $service_id;
            $data['services'] = $this->Business->get_single_service_detail($service_id);
            $data['main_content'] = 'add_membership';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     * Function for partner registration
     */

    public function create_offerings_memberships() {
        $data['title'] = "Partner Registration";
        $post_data = $this->input->post();

        $this->form_validation->set_rules('membership', 'Membership', 'required');
        $this->form_validation->set_rules('duration', 'Duration', 'required');
        $this->form_validation->set_rules('fees', 'Price', 'required|numeric');
        $this->form_validation->set_rules('max_number_of_members', 'Maximum Number Of Members', 'required|numeric');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        $service_id = $post_data['business_service_id'];
        if ($this->form_validation->run() == FALSE) {
            $data['service_id'] = $service_id;
            $data['services'] = $this->Business->get_single_service_detail($service_id);
            $data['main_content'] = 'add_membership';
            $this->load->view('includes/partner_template', $data);
        } else {
            $this->Business_offering->create_membership($post_data);
            $this->session->set_flashdata('membership_added_message', 'Memebership successfully added for service  "' . $post_data['service_name'] . '"!!!');
            redirect("/vendor/business_service_list");
        }
    }

    /* Above function ends here */

    public function delete_offerings_memberships() {
        $post_data = $this->input->post('id');
        $result = $this->Business_offering->membership_delete($post_data);
        echo json_encode('success');
    }

    /*
     *  Function for partner profile update
     */

    public function edit_offerings_memberships() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $id = $this->uri->segment(3);
            $membership = $this->Business_offering->get_membership_details($id);

            $data['membership'] = $membership;
            $service_id = $membership->business_service_id;
            $data['service_id'] = $service_id;
            $data['services'] = $this->Business->get_single_service_detail($service_id);

            $data['main_content'] = 'edit_membership';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     * Function for partner registration
     */

    public function update_offerings_memberships() {
        $data['title'] = "Partner Registration";
        $post_data = $this->input->post();

        $this->form_validation->set_rules('membership', 'Membership', 'required');
        $this->form_validation->set_rules('duration', 'Duration', 'required');
        $this->form_validation->set_rules('fees', 'Price', 'required|numeric');
        $this->form_validation->set_rules('max_number_of_members', 'Maximum Number Of Members', 'required|numeric');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        $id = $post_data['id'];

        if ($this->form_validation->run() == FALSE) {
            $membership = $this->Business_offering->get_membership_details($id);
            $data['membership'] = $membership;
            $service_id = $membership->business_service_id;
            $data['service_id'] = $service_id;
            $data['services'] = $this->Business->get_single_service_detail($service_id);
            $data['main_content'] = 'edit_membership';
            $this->load->view('includes/partner_template', $data);
        } else {
            $this->Business_offering->update_membership($post_data);
            $this->session->set_flashdata('membership_updated_message', 'Memebership successfully updated for service  "' . $post_data['service_name'] . '"!!!');
            redirect("/vendor/business_service_edit/" . $post_data['business_service_id'] . "");
        }
    }

    /* Above function ends here */


    /*
     * Function to get business offering services list by program
     */

    public function offerings_gallery() {
        $this->User_activity->insert_user_activity();
        $id = $this->uri->segment(3);
        $data['gallery'] = $this->Business->get_single_service_detail($id);
        $data['service_id'] = $id;
        $data['gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
        $data['title'] = "Offering Services";
        $data['main_content'] = 'business_services_gallery';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */


    /* Above function ends here */

    public function offerings_gallery_delete() {
        $post_data = $this->input->post('id');
        $result = $this->Business_offering->offering_gallery_delete($post_data);
        echo json_encode('success');
    }

    /*
     *  Function for partner profile update
     */

    public function offerings_gallery_edit() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $id = $this->uri->segment(3);
            $service_gallery = $this->Business_offering->get_gallery_detail($id);
            $data['service_gallery'] = $service_gallery;
            $data['gallery'] = $this->Business->get_single_service_detail($service_gallery->service_id);
            $data['gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
            $data['title'] = "Offering Services";
            $data['main_content'] = 'edit offering_gallery';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     * Function for partner registration
     */

    public function update_offerings_gallery() {
        $data['title'] = "Partner Registration";
        $post_data = $this->input->post();
//        $this->form_validation->set_rules('caption', 'Caption', 'required');
//        $this->form_validation->set_rules('description', 'Description', 'required');
//        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
//        $id = $post_data['id'];
//        if ($this->form_validation->run() == FALSE) {
//            echo "rtgtr";
//            exit();
//            $service_gallery = $this->Business_offering->get_gallery_detail($id);
//            $data['service_gallery'] = $service_gallery;
//            $data['gallery'] = $this->Business->get_single_service_detail($service_gallery->service_id);
//            $data['gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
//            $data['title'] = "Offering Services";
//            $data['main_content'] = 'edit offering_gallery';
//            $this->load->view('includes/partner_template', $data);
//        } else {

        $this->Business_offering->update_gallery($post_data, $_FILES);
        $this->session->set_flashdata('gallery_updated_message', 'Gallery updated successfully !!!');
        redirect("/vendor/offerings_gallery/" . $post_data['service_id'] . "");
        // }
    }

    /* Above function ends here */

    /*
     *  Function for partner profile update
     */

    public function add_offerings_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $id = $this->uri->segment(3);
            $data['gallery'] = $this->Business->get_single_service_detail($id);
            $data['service_id'] = $id;
            $data['gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
            $data['title'] = "Offering Services";
            $data['main_content'] = 'add_offering_gallery';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     * Function for partner registration
     */

    public function create_offerings_gallery() {
        $data['title'] = "Partner Registration";
        $post_data = $this->input->post();
//        $this->form_validation->set_rules('caption', 'Caption', 'required');
//        $this->form_validation->set_rules('description', 'Description', 'required');
//        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
//        $id = $post_data['service_id'];
//        if ($this->form_validation->run() == FALSE) {
//            echo "rtgtr";
//            exit();
//            $data['gallery'] = $this->Business->get_single_service_detail($id);
//            $data['service_id'] = $id;
//            $data['gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
//            $data['title'] = "Offering Services";
//            $data['main_content'] = 'add_offering_gallery';
//            $this->load->view('includes/partner_template', $data);
//        } else {

        $this->Business_offering->add_gallery($post_data, $_FILES);
        $this->session->set_flashdata('gallery_updated_message', 'Gallery added successfully !!!');
        redirect("/vendor/offerings_gallery/" . $post_data['service_id'] . "");
        // }
    }

    /* Above function ends here */
    /*
     *  Function for business services
     */

    public function business_service_add_slot() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $id = $this->uri->segment(3);
            $data['service_details'] = $this->Business->get_single_service_detail($id);
            $data['service_id'] = $id;
            $data['main_content'] = 'one_time_slot';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    public function business_service_adding_slot() {
        $data['title'] = "Partner Registration";
        $post_data = $this->input->post();
        $this->form_validation->set_rules('no_slots', 'No. of slots', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        $id = $post_data['service_id'];
        if ($this->form_validation->run() == FALSE) {
            $this->User_activity->insert_user_activity();
            $data['service_details'] = $this->Business->get_single_service_detail($id);
            $data['service_id'] = $id;
            $data['main_content'] = 'one_time_slot';
            $this->load->view('includes/partner_template', $data);
        } else {
            $this->Business_offering->add_one_time_slot($post_data);
            $this->session->set_flashdata('membership_updated_message', 'Slot added successfully !!!');
            redirect("/vendor/business_service_edit/" . $post_data['service_id'] . "");
        }
    }

    public function one_time_service_slots_delete() {
        $post_data = $this->input->post('id');
        $result = $this->Business_offering->one_time_service_slots_delete($post_data);
        echo json_encode('success');
    }

    /*
     * Function to get business providers details by business provider id
     */

    public function one_time_service_slots_edit() {

        $this->User_activity->insert_user_activity();
        $data['logged_in_vendor_data'] = $this->session->userdata('logged_in_vendor_data');
        $service_id = $this->uri->segment(3);
        $data['services'] = $this->Business_offering->get_slot_details($service_id);
        $data['title'] = "Home";
        $data['main_content'] = 'one_time_slot_edit';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */

    public function update_one_time_slots() {
        $this->User_activity->insert_user_activity();
        $data['logged_in_vendor_data'] = $this->session->userdata('logged_in_vendor_data');
        $post_data = $this->input->post();
        $update = $this->Business_offering->update_service_slots($post_data);
        $this->session->set_flashdata('membership_updated_message', 'Slot updated successfully !!!');
        redirect("/vendor/business_service_edit/" . $post_data['service_id'] . "");
    }

    /*
     *  Function for partner profile update
     */

    public function one_day_packages() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $vendor_id = $logged_in_user_details->business_id;
            $data['one_day_packages'] = $this->Business_offering->get_one_day_packages($vendor_id);
            $data['main_content'] = 'one_day_packages';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    public function delete_one_day_package() {
        $post_data = $this->input->post('id');
        $result = $this->Business_offering->delete_one_day_package($post_data);
        echo json_encode('success');
    }

    /*
     *  Function for business services
     */

    public function add_one_day_package() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $id = $this->uri->segment(3);
            $data['all_services'] = $this->Business->get_all_services_listing($logged_in_user_details);
            $data['service_id'] = $id;
            $data['main_content'] = 'add_one_day_package';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    public function create_one_day_package() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        $data['title'] = "Partner Registration";
        $post_data = $this->input->post();
//        $this->form_validation->set_rules('name', 'Name', 'required');
//        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
//        $id = $post_data['service_id'];
//        if ($this->form_validation->run() == FALSE) {
        $data['all_services'] = $this->Business->get_all_services_listing($logged_in_user_details);
        $data['service_id'] = $id;
        $data['main_content'] = 'add_one_day_package';
        $this->load->view('includes/partner_template', $data);
//        } else {
        $this->Business_offering->add_one_day_package($post_data);
        $this->session->set_flashdata('membership_updated_message', 'Added successfully !!!');
        redirect("/vendor/one_day_packages/");
        //}
    }

    public function all_offerings() {
        $this->User_activity->insert_user_activity();
        //$data['logged_in_vendor_data'] = $this->session->userdata('logged_in_vendor_data');
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $business_provider_id = $this->uri->segment(2);
        $data['business_provider_id'] = $business_provider_id;
        $this->session->set_userdata("business_provider_id", $business_provider_id);
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        $data['views'] = $this->Business->update_vendor_page_views($data['business_provider_details']['details']->business_id);
        $data['offerings'] = $this->Business->get_all_offerings_by_vendor($business_provider_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['gallery_path'] = base_url() . $this->config->item('business_providers_gallery_path');
        $data['offering_gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
        $data['title'] = "ZingUpLife | Provider's Offerings";
        $data['active_url'] = 'service_providers';
//        echo "<pre>";
//        print_r($data['offerings']);
//        exit();
        $data['main_content'] = 'all_offerings';
        $this->load->view('includes/menu_template', $data);
    }

    public function offering_memberships() {
        $this->User_activity->insert_user_activity();
        $business_service_id = $this->uri->segment(2);
        $this->session->set_userdata("business_service_id", $business_service_id);
        $data['logged_in_user_details'] = $this->session->userdata('logged_in_user_data');
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');

        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);

        $business_provider_id = $data['get_offering_service_details']['details']->business_id;
        $this->session->set_userdata("business_provider_id", $business_provider_id);
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);

        $data['memberships'] = $this->Business_offering->get_memberships($business_service_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['service_gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
        $data['title'] = "ZingUpLife | Provider's Offering's Details";
        $data['review_details'] = $this->Business_offering->get_user_service_review_details($business_service_id, $data['logged_in_user_details']->user_id);

        $data['provider_id'] = $business_provider_id;
        $data['service_id'] = $business_service_id;
        $data['active_url'] = 'service_providers';

        $data['main_content'] = 'memberships_offering';
        $this->load->view('includes/menu_template', $data);
    }

    /*
     * Function to get  business offering service's details by business service id
     */

    public function offering_details() {
        $this->User_activity->insert_user_activity();
        $business_service_id = $this->uri->segment(2);
        $this->session->set_userdata("business_service_id", $business_service_id);
        $data['logged_in_user_details'] = $this->session->userdata('logged_in_user_data');
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');

        $data['get_offering_service_details'] = $this->Business_offering->get_business_offering_service_details($business_service_id);

        $business_provider_id = $data['get_offering_service_details']['details']->business_id;
        $this->session->set_userdata("business_provider_id", $business_provider_id);
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);

        $data['memberships'] = $this->Business_offering->get_memberships_for_offering($data['business_provider_details']['details']->services_id);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['service_gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
        $data['title'] = "ZingUpLife | Provider's Offering's Details";
        $data['review_details'] = $this->Business_offering->get_user_service_review_details($business_service_id, $data['logged_in_user_details']->user_id);

        $data['provider_id'] = $business_provider_id;
        $data['service_id'] = $business_service_id;
        $data['active_url'] = 'service_providers';

        $data['main_content'] = 'offering_details';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */
    /*
     * Function to enable partner booking facality
     */
    public function partner_bookings() {
    	$logged_in_user_details = $this->session->userdata ( 'logged_in_vendor_data' );
    	if (! empty ( $logged_in_user_details ) && $logged_in_user_details->role == 'vendor') {
    		$this->User_activity->insert_user_activity ();
    		$vendor_id = $logged_in_user_details->business_id;
    		$data ['main_content'] = 'partner_bookings';
    		$this->load->view ( 'includes/partner_template', $data );
    	} else {
    		redirect ( "/partner" );
    	}
    }
    /* Above function ends here */
    
    /*
     * Function to spa search city,outlet,package
     */
    public function spa_search() {
    	$logged_in_user_details = $this->session->userdata ( 'logged_in_vendor_data' );
    	if (! empty ( $logged_in_user_details ) && $logged_in_user_details->role == 'vendor') {
    		$this->User_activity->insert_user_activity ();
    		$vendor_id = $logged_in_user_details->business_id;
    		$id = $logged_in_user_details->id;
    		$data ['spa_search'] = $this->Business_offering->get_spa_search ( $id );
    		$data ['locations'] = $this->Business->get_locations ();
    		$data ['main_content'] = 'spa_search';
    		$this->load->view ( 'includes/partner_template', $data );
    	} else {
    		redirect ( "/partner" );
    	}
    }
    /* Above function ends here */
    
    /*
     * Function to spa search partner booking slots
     */
    public function spa_search_slots() {
    	$logged_in_user_details = $this->session->userdata ( 'logged_in_vendor_data' );
    	if (! empty ( $logged_in_user_details ) && $logged_in_user_details->role == 'vendor') {
    		$city = $this->input->post ( 'spa_city' );
    		$date = date ( "Y-m-d", strtotime ( $this->input->post ( 'date' ) ) );
    		$spa_outlets = $this->input->post ( 'spa_outlets' );
    		$spa_package = $this->input->post ( 'spa_package' );
    		$this->User_activity->insert_user_activity ();
    		$vendor_id = $logged_in_user_details->business_id;
    		$id = $logged_in_user_details->id;
    		$data ['spa_search'] = $this->Business_offering->get_spa_search ( $id );
    		$data ['spa_search_slots'] = $this->Business_offering->get_spa_search_slots ( $id, $spa_outlets, $city, $date, $spa_package );
    		$showDate = date ( "m/d/Y", strtotime ( $this->input->post ( 'date' ) ) );
    		$data ['showDate'] = $showDate;
    		$data ['selecteddate'] = $showDate;
    		$data ['city'] = $city;
    		$data ['spaoutlets'] = $spa_outlets;
    		$data ['spapackage'] = $spa_package;
    			
    		$data ['locations'] = $this->Business->get_locations ();
    		$data ['main_content'] = 'spa_search';
    		$this->load->view ( 'includes/partner_template', $data );
    	} else {
    		redirect ( "/partner" );
    	}
    }
    public function member_book_slot() {
    	$logged_in_user_details = $this->session->userdata ( 'logged_in_vendor_data' );
    	$userid = "";
    	if (! empty ( $logged_in_user_details ) && $logged_in_user_details->role == 'vendor') {
    		$name = $this->input->get ( 'membername' );
    		$contact = $this->input->get ( 'membercontact' );
    		$email = $this->input->get ( 'memberemail' );
    		$age = "25";
    		$password = "password";
    		$slot_id = $this->input->get ( 'slot_id' );
    		$slot_count = $this->input->get ( 'slot_count' );
    			
    		$_POST ['username'] = $email;
    		$_POST ['name'] = $name;
    		$_POST ['password'] = $password;
    		$_POST ['gender'] = 'N';
    		$_POST ['phone'] = $contact;
    		$_POST ['age'] = $age;
    			
    		$check_user_exists = $this->User->check_username_availability ( $email );
    		if (! empty ( $check_user_exists )) {
    			$user_details = $this->User->get_user_details_by_username ( $email );
    			$userid = $user_details->user_id;
    		} else {
    			$post_data = $_POST;
    			$hashed = PasswordHash::create_hash ( $post_data ['password'] );
    			$this->User->create_user ( $post_data, $hashed );
    			$validate_user = $this->User->validate_user ( $post_data ['username'], $post_data ['password'] );
    
    			if ($validate_user ['validation_status'] ['status'] == 'Success') {
    				$validate_user ['user_details']->is_logged_in = '1';
    				$this->session->set_userdata ( "logged_in_user_data", $validate_user ['user_details'] );
    					
    				$registration_email_content = $this->load->view ( 'emails/registration_success', $validate_user, true );
    					
    				$to = $validate_user ['user_details']->username;
    				$from = "Zinguplife<info@zinguplife.com>";
    				$registration_mail_subject = "You have sucessfully registered with Zingup !!!";
    				$registration_message = $registration_email_content;
    					
    				$this->Mailing->send_mail ( $to, $from, $registration_mail_subject, $registration_message );
    					
    				$messgae_to = '+91' . $validate_user ['user_details']->phone;
    				// $messgae_to = '+919902956083';
    				$sms_content = 'Congratulations! You have successfully registered with Zingup';
    					
    				$this->Mailing->send_sms ( $messgae_to, $sms_content );
    				$userid = $validate_user ['user_details']->user_id;
    			}
    			// Update Slots tables (services_slots && services_booked_slots)
    		}
    		if ($userid != null && $userid != "") {
    			if ($user_details != null && $user_details != "") {
    				$result = $this->Business_offering->insert_booking_data ( $user_details, $slot_id );
    			} else {
    				$result = $this->Business_offering->insert_booking_data ( $validate_user ['user_details'], $slot_id );
    			}
    			if ($result) {
    				$result_slot = $this->Business_offering->insert_slot_data ( $slot_id, $slot_count );
    			}
    		}
    		return true;
    	} else {
    		redirect ( "/partner" );
    	}
    }
    public function spa_booked_slots_detail() {
    	$logged_in_user_details = $this->session->userdata ( 'logged_in_vendor_data' );
    	if (! empty ( $logged_in_user_details ) && $logged_in_user_details->role == 'vendor') {
    		$slot_id = $this->input->get ( 'slot_id' );
    		$date = date ( "m/d/Y", strtotime ( $this->input->get ( 'bookeddate' ) ) );
    		$stime = $this->input->get ( 'stime' );
    		$etime = $this->input->get ( 'etime' );
    		$data ['booking'] = $this->Business_offering->get_booked_slots_detail_booking_id_details ( $slot_id, $stime, $etime );
    		$data ['spa_booked_slots'] = $this->Business_offering->get_booked_slots_detail_user_other_details ( $slot_id );
    		$data ['contant_data'] = $this->Business_offering->get_booked_slots_detail_user_contact_details ( $slot_id, $stime, $etime );
    		$data ['main_content'] = 'spa_booked_slots';
    		$data ['date'] = $date;
    		$data ['stime'] = $stime;
    		$data ['etime'] = $etime;
    		$data['slot_id'] =  $slot_id;
    		$city = $this->input->get ( 'city' );
    		$spa_outlets = $this->input->get ( 'spaoutlets' );
    		$spa_package = $this->input->get ( 'spapackage' );
    		$data ['city'] = $city;
    		$data ['spaoutlets'] = $spa_outlets;
    		$data ['spapackage'] = $spa_package;
    		$this->load->view ( 'includes/partner_template', $data );
    	} else {
    		redirect ( "/partner" );
    	}
    }
    public function cancel_slot_data() {
    	$logged_in_user_details = $this->session->userdata ( 'logged_in_vendor_data' );
    	if (! empty ( $logged_in_user_details ) && $logged_in_user_details->role == 'vendor') {
    		$slot_id = $this->input->post ('slot_id');
    		$bookingid =$this->input->get ('bookingid');
    		$date = date ( "m/d/Y", strtotime ( $this->input->post ( 'date' ) ) );
    		$stime = $this->input->post ( 'stime' );
    		$etime = $this->input->post ( 'etime' );
    		$city = $this->input->post ( 'spa_city' );
    		$spa_outlets = $this->input->post ( 'spa_outlets' );
    		$spa_package = $this->input->post ( 'spa_package' );
    		$data ['city'] = $city;
    		$data ['spaoutlets'] = $spa_outlets;
    		$data ['spapackage'] = $spa_package;
    		$data ['contant_data'] = $this->Business_offering->get_booked_slots_detail_user_contact_details ( $slot_id, $stime, $etime );
    		$slot_count = $this->Business_offering->get_slot_count ( $slot_id );
    		$slot_count_add = $slot_count[0]->number_of_slots+1;
    		$this->Business_offering->cancel_slot_data ( $slot_id, $slot_count_add);
    		$this->Business_offering->delete_user_detail ($bookingid);
    		$data ['booking'] = $this->Business_offering->get_booked_slots_detail_booking_id_details ( $slot_id, $stime, $etime );
    		$data ['spa_booked_slots'] = $this->Business_offering->get_booked_slots_detail_user_other_details ( $slot_id );
    		$data ['main_content'] = 'spa_booked_slots';
    		$data ['date'] = $date;
    		$data ['stime'] = $stime;
    		$data ['etime'] = $etime;
    		$data['slot_id'] =  $slot_id;
    		$this->load->view ( 'includes/partner_template', $data );
    			
    	} else {
    		redirect ( "/partner" );
    	}
    }
    
}
