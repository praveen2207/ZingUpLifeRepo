<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class  for  listing of business providers, filter listing
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:04-08-2015
 * */
class Business_providers extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Business');
        $this->load->model('Services');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    /*
     * Function to get locations by service
     */

    public function index() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $service_id = $_POST['service_id'];
        $this->User_activity->insert_user_activity();
        $data['services'] = $this->Services->get_service_detail_by_id($service_id);
        $data['locations'] = $this->Business->get_locations_by_service($service_id);
        echo json_encode($data);
    }

    /* Above function ends here */

    /*
     * Function to get business providers list by location and service
     */

    public function get_business_providers_list() {
        $this->User_activity->insert_user_activity();
        $service_id = $_POST['service_id'];
        $location_id = $_POST['location_id'];
        $this->session->set_userdata("service_id", $service_id);
        $data['logged_in_vendor_data'] = $this->session->userdata('logged_in_vendor_data');
        $data['services'] = $this->Services->get_service_detail_by_id($service_id);
        $data['location'] = $this->Services->get_location_by_id($location_id);
        $data['business_providers'] = $this->Business->get_business_providers($service_id, $location_id);
        $data['logo'] = base_url() . $this->config->item('business_providers_logo_path');
        echo json_encode($data);
    }

    /* Above function ends here */

    /*
     * Function to get business providers details by business provider id
     */

    public function show_business_provider_details() {

        $this->User_activity->insert_user_activity();
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
//        $service_id = $this->session->userdata('service_id');
//        $business_provider_id = $this->uri->segment(2);
//        $data['business_provider_id'] = $business_provider_id; 
        $business_provider_id = $this->uri->segment(2);
        $data['business_provider_id'] = $business_provider_id;
        $this->session->set_userdata("business_provider_id", $business_provider_id);
        $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
        //$data['business_provider_packages'] = $this->Business->get_offering_programs($service_id, $business_provider_id);
        $data['views'] = $this->Business->update_vendor_page_views($data['business_provider_details']['details']->business_id);
        $data['offerings'] = $this->Business->get_offering_by_vendor($business_provider_id);
		//echo '<pre>'; print_r($data['offerings']); exit();
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['gallery_path'] = base_url() . $this->config->item('business_providers_gallery_path');
        $data['offering_gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
        $data['reviews'] = $this->Business->get_review_for_vendors($business_provider_id);
        $data['title'] = "ZingUpLife | Provider's Details";
        $data['active_url'] = 'service_providers';
//        echo "<pre>";
//        print_r($data);
//        //  print_r($data['offerings']);
//        exit();
        $data['main_content'] = 'business_providers_details';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */


    /*
     * Function for partner registration
     */

    public function joining_network() {
        $data['title'] = "Partner Registration";
        $data['memberships'] = $this->Business->get_vendor_memberships();
        $data['main_content'] = 'joining_network';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */


    /*
     * Function for partner registration
     */

    public function partner_registration() {

        $data['title'] = "Partner Registration";
        $data['active_url'] = 'partner_reg';
        $data['main_content'] = 'partner_registration';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */


    /*
     * Function for partner registration
     */

    public function business_info() {
        $data['logged_in_vendor_data'] = $this->session->userdata('logged_in_vendor_data');

        $data['title'] = "Partner Registration";
        $data['services'] = $this->Business->get_business_services();
        $data['locations'] = $this->Business->get_locations();
        $data['main_content'] = 'business_info';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */


    /*
     * Function for partner registration
     */

    public function review_submit() {
        $data['title'] = "Partner Registration";
        $post_data = $this->input->post();
        $this->session->set_userdata('business_info', $post_data);
        $business_info = $this->session->userdata['business_info'];
        if (!empty($business_info)) {
            $data['main_content'] = 'review';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/vendor/registration");
        }
    }

    /* Above function ends here */



    /*
     * Function for partner registration
     */

    public function add_partner_registration() {
        $data['title'] = "Partner Registration";
        $post_data = $this->input->post();

        $this->form_validation->set_rules('address1', 'address', 'required');
        $this->form_validation->set_rules('zipcode', 'zipcode', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $this->form_validation->set_rules('business_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('check', 'Check box', 'callback_accept_terms');

        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        if ($this->form_validation->run() == FALSE) {
            $data['services'] = $this->Business->get_business_services();
            $data['locations'] = $this->Business->get_locations();
            $data['main_content'] = 'business_info';
            $this->load->view('includes/partner_template', $data);
        } else {

            $this->session->set_userdata('business_info', $post_data);
            $partner_details = $this->session->userdata('logged_in_vendor_data');

            $business_details = $this->session->userdata('business_info');
            $this->Business->add_partner_registrations($partner_details, $business_details);
            $this->session->set_flashdata('username', $partner_details->username);
            $this->session->set_flashdata('password', $partner_details->password);
            $this->session->unset_userdata('partner_details');
            $this->session->unset_userdata('business_info');

            $data['main_content'] = 'vendor_registration_success';
            $this->load->view('includes/partner_template', $data);
        }
    }

    /* Above function ends here */

    function accept_terms() {
        if (isset($_POST['check']))
            return true;
        $this->form_validation->set_message('accept_terms', 'Please read and accept our terms and conditions.');
        return false;
    }

    /*
     * Function for partner registration
     */

    /*  public function add_partner_registration() {

      $partner_details = $this->session->userdata('partner_details');
      if (!empty($partner_details)) {
      $business_details = $this->session->userdata('business_info');
      $this->Business->add_partner_registrations($partner_details, $business_details);
      $this->session->set_flashdata('username', $partner_details['email']);
      $this->session->set_flashdata('password', $partner_details['password']);
      $this->session->unset_userdata('partner_details');
      $this->session->unset_userdata('business_info');

      $data['main_content'] = 'vendor_registration_success';
      $this->load->view('includes/partner_template', $data);
      } else {
      redirect("/vendor/registration");
      }
      } */

    /* Above function ends here  */





    /*
     * Function for partner login
     */

    public function partner_login() {
        $data['title'] = "Partner login";
        $data['main_content'] = 'partner_login';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */


    /*
     *  Validating partner's credentials and processing login 
     */

    public function do_partner_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user_validation_details = array();
        $this->load->model('Business');
        $this->form_validation->set_rules('username', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');

        if ($this->form_validation->run() == FALSE) {
            if ($username == '' && strlen($username) < 2) {
                $user_validation_details['validation_status']['username_status'] = 'This field is required';
                $user_validation_details['validation_status']['username_error_type'] = 'username';
            }
            if ($password == '') {
                $user_validation_details['validation_status']['password_status'] = 'This field is required';
                $user_validation_details['validation_status']['password_error_type'] = 'password';
            }
            $user_validation_details['validation_status']['username'] = $username;
            $this->session->set_flashdata('login_error_message', $user_validation_details['validation_status']);

            redirect("/partner");
        } else {

            if ($username != '' && $password != '') {
                $validate_partner = $this->Business->validate_partner($username, $password);

                if ($validate_partner['validation_status']['status'] == 'Success') {
                    $validate_partner['partner_details']->is_logged_in = '1';
                    $this->session->set_userdata("logged_in_vendor_data", $validate_partner['partner_details']);
                    redirect("/vendor/dashboard");
                } else {
                    $validate_partner['validation_status']['error_status'] = 'Invalid username or password';
                    $validate_partner['validation_status']['username'] = $username;
                    $validate_partner['validation_status']['password'] = $password;
                    $this->session->set_flashdata('login_error_message', $validate_partner['validation_status']);

                    redirect("/partner");
                }
            }
        }
    }

    /* Above function ends here */




    /*
     *  Function for partner dashboard  page
     */

    public function partner_editprofile() {

        $user_data = $this->session->userdata('logged_in_vendor_data');
        $data['logged_in_user_data'] = $this->Business->get_partner_details_by_username($user_data->username);
        $data['main_content'] = 'partner_editprofile';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */


    /*
     *  Function for partner profile update
     */

    public function update_partnerprofile() {

        $post_data = $this->input->post();
        $data['update_partner'] = $this->Business->update_partner_profile($post_data);
        $user_data = $this->session->userdata('logged_in_vendor_data');
        $username = $user_data->username;
        $vendor_details = $this->Business->get_partner_details_by_username($username);
        $vendor_details->is_logged_in = 1;
        $this->session->set_userdata("logged_in_vendor_data", $vendor_details);
        echo json_encode($data);
    }

    /* Above function ends here */

    /*
     *  Function for partner profile update
     */

    public function packages_treatments() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $data['mapping'] = $this->Business->get_partner_services_mapping($logged_in_user_details->business_id);
            $data['packages'] = $this->Business->get_existing_packages($logged_in_user_details->business_id);
            $data['main_content'] = 'packages_treatments';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */


    /*
     *  Function for adding business services
     */

    public function adding_business_services() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $post_data = $this->input->post();

            $files = $_FILES;
            $this->form_validation->set_rules('packages', 'Package', 'required');
            $this->form_validation->set_rules('service', 'Service', 'required');
            $this->form_validation->set_rules('duration_hour', 'Duration hour', 'required');
            $this->form_validation->set_rules('duration_minutes', 'Duration minutes', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            $this->form_validation->set_rules('service_type', 'Service_type', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
            if ($this->form_validation->run() == FALSE) {
                $data['packages'] = $this->Business->get_existing_packages($logged_in_user_details->business_id);
                $data['main_content'] = 'packages_treatments';
                $this->load->view('includes/partner_template', $data);
            } else {
                $this->Business->insert_business_services($post_data, $files, $logged_in_user_details);
                $data['main_content'] = 'partner_success';
                $this->load->view('includes/partner_template', $data);
            }
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     *  Function for adding business programs
     */

    public function adding_business_programs() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $post_data = $this->input->post();
            $data['programs'] = $this->Business->insert_business_programs($post_data, $logged_in_user_details);
            $this->session->set_userdata('recent_program_id', $data['programs']);
            echo json_encode($data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */


    /*
     *  Function for partner profile update
     */

    public function business_information() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $user_data = $this->session->userdata('logged_in_vendor_data');
            $data['business_info'] = $business_info = $this->Business->get_business_information($user_data->id);
            $data['lat_long'] = $this->Business->getLnt($business_info['business']->zipcode);
            $data['services'] = $this->Business->get_business_services();
            $data['locations'] = $this->Business->get_locations();
            $data['main_content'] = 'business_information';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */


    /*
     *  Function for partner profile update
     */

    public function adding_business_information() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $post_data = $this->input->post();

            $areaid_name = explode('/', $post_data['area']);
            $area_name = $areaid_name[1];

            if ($_FILES['userfile']['name'] != '') {
                unlink("assets/uploads/business_providers/logo/" . $post_data['vendor_id'] . "/" . $post_data['old_logo']);
                if (!is_dir('assets/uploads/business_providers/logo/' . $post_data['vendor_id'] . '/')) {
                    mkdir('assets/uploads/business_providers/logo/' . $post_data['vendor_id'] . '/', 0777, TRUE);
                }
                $logopath = './assets/uploads/business_providers/logo/' . $post_data['vendor_id'] . '/';
                $logofile = $_FILES['userfile']['name'];

                $logoname = $post_data['business_name'] . "_" . $area_name . "_" . time() . "_" . $logofile;
                $logo_name = $post_data['business_name'] . "_" . $area_name . "_" . time() . "_" . $_FILES['userfile']['name'];

                copy($_FILES['userfile']['tmp_name'], $logopath . $logoname);
            } else {

                $logo_name = $post_data['old_logo'];
            }

            $this->Business->update_business_information($post_data, $logo_name);
            $username = $logged_in_user_details->username;

            $vendor_details = $this->Business->get_partner_details_by_username($username);
            $vendor_details->is_logged_in = 1;
            $this->session->set_userdata("logged_in_vendor_data", $vendor_details);
            $data['main_content'] = 'partner_success';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */


    /*
     *  Function for partner profile update
     */

    public function success() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $data['main_content'] = 'success';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */



    /*
     *  Function for business services
     */

    public function business_service_slots() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $data['packages'] = $this->Business->get_existing_packages($logged_in_user_details->business_id);
            $data['main_content'] = 'service_slots';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     *  Function for adding business services slots
     */

    public function adding_business_service_slots() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $post_data = $this->input->post();

            $this->Business->insert_services_slots($post_data);
            $data['main_content'] = 'partner_success';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     *  Function for getting business services by program
     */

    public function get_business_services_by_program() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $post_data = $this->input->post();
            $data['services'] = $this->Business->get_services_by_program($post_data);
            echo json_encode($data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */


    /*
     *  Displaying forgot password form 
     */

    public function partner_forgot_password() {
        $this->User_activity->insert_user_activity();
        $data['main_content'] = 'partner_forgot_password';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */

    /*
     *  Validating user's credentials and sending reset password token to user 
     */

    public function partner_reset_password_request() {
        $this->User_activity->insert_user_activity();
        $username = $this->input->post('username');
        $forgot_password_request = $this->Business->forgot_password_request($username);
        if ($forgot_password_request == 'Failed') {
            $this->session->set_flashdata('email_validation_error_message', 'Email you entered is not registered with Zingup. Please try again.');
            redirect('/vendor/forgot_password');
        } else {
            $data['email_message_heading'] = 'Check Your Email';
            $email = explode('@', $username);
            $email_part1 = $email[0];
            $email_part1_length = strlen($email_part1);
            $email_first = substr($email_part1, 0, 1);
            $email_part2 = $email_first . str_repeat("*", ($email_part1_length - 1)) . '@' . $email[1];
            $data['email_message_heading'] = 'Check Your Email';
            $data['email_message'] = 'Reset password link is sent to your email ID ' . $email_part2 . '';
            $data['main_content'] = 'partner_reset_pasword_check';
            $this->load->view('includes/partner_template', $data);
        }
    }

    /* Above function ends here */

    /*
     *  Function for validating reset password token 
     */

    public function partner_reset_password() {
        $this->User_activity->insert_user_activity();
        $password_token = $this->uri->segment(3);
        $validate_password_token = $this->Business->validate_password_token($password_token);
        $data['reset_password_token'] = $password_token;
        if ($validate_password_token == 'Failed') {
            $this->session->set_flashdata('password_token_error_message', 'Your reset password token is expired or incorrect,' . anchor('vendor/forgot_password', 'please try again', 'class="blue link-small"'));

            $this->session->set_flashdata('username', '');
        } else {
            $this->session->set_flashdata('reset_password_token', $password_token);
            $this->session->set_flashdata('username', $validate_password_token->username);
        }
        $data['main_content'] = 'partner_reset_password';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */


    /*
     *  validating user's data and storing new password for user 
     */

    public function store_partner_new_password() {
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('validation_error', 'Password and  confirm password not matching.');
            $this->session->set_flashdata('username', $post_data['username']);
            $this->session->set_flashdata('reset_password_token', $post_data['reset_password_token']);

            redirect('vendor/reset_password/' . $post_data['reset_password_token']);
        } else {
            $password = PasswordHash::create_hash($post_data['password']);
// echo "<pre>";print_r($password);
            $update_new_password = $this->Business->update_new_password($post_data['username'], $password);
            if ($update_new_password == 1) {
                $data['main_content'] = 'partner_reset_password_success';
                $this->load->view('includes/partner_template', $data);
            } else {

                $this->session->set_flashdata('validation_error', 'please try again.');
                $this->session->set_flashdata('username', $post_data['username']);
                $this->session->set_flashdata('reset_password_token', $post_data['reset_password_token']);

                redirect('vendor/reset_password/' . $post_data['reset_password_token']);
            }
        }
    }

    /* Above function ends here */

    /*
     *  Function for  business services listing
     */

    public function confirm_page() {
        $data['main_content'] = 'confirm';
        $this->load->view('includes/partner_template', $data);
    }

    /*
     *  Function for  business services listing
     */

    public function business_service_list() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $data['services'] = $this->Business->get_all_services_listing($logged_in_user_details);
            $data['main_content'] = 'business_services_list';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     *  Function for  business services listing
     */

    public function business_service_edit() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $service_id = $this->uri->segment(3);
            $data['services'] = $this->Business->get_single_service_detail($service_id);
            $data['main_content'] = 'business_service_edit';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */


    /*
     *  Function for  business services listing
     */

    public function business_package_edit() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $package_id = $this->uri->segment(3);
            $data['packages'] = $this->Business->get_single_package_detail($package_id);
            $data['mapping'] = $this->Business->get_partner_services_mapping($logged_in_user_details->business_id);
            $data['main_content'] = 'business_package_edit';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/vendor/login");
        }
    }

    /* Above function ends here */


    /*
     *  Function for  business services listing
     */

    public function updating_business_services() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $post_data = $this->input->post();
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
            if ($this->form_validation->run() == FALSE) {
                $data['services'] = $this->Business->get_single_service_detail($post_data['service_id']);
                $data['main_content'] = 'business_service_edit';
                $this->load->view('includes/partner_template', $data);
            } else {
                $this->Business->updating_business_services($post_data);
                $data['main_content'] = 'partner_success';
                $this->load->view('includes/partner_template', $data);
            }
//            if (!is_dir('assets/uploads/business_services/gallery/' . $post_data['service_id'] . '/')) {
//                mkdir('assets/uploads/business_services/gallery/' . $post_data['service_id'] . '/', 0777, TRUE);
//            }
//            $path = './assets/uploads/business_services/gallery/' . $post_data['service_id'] . '/';
//            $file = $_FILES['file']['name'];
//            $image_count = count($file);
//
//            if ($image_count > 0) {
//
//                for ($i = 0; $i < $image_count; $i++) {
//                    if ($_FILES['file']['name'][$i]) {
//                        $fname = $logged_in_user_details->name . "_" . $post_data['services'] . "_" . $file[$i];
//
//                        copy($_FILES['file']['tmp_name'][$i], $path . $fname);
//                        $image_name = $logged_in_user_details->name . "_" . $post_data['services'] . "_" . $_FILES['file']['name'][$i];
//                        $this->Business->insert_business_service_gallery($post_data['service_id'], $image_name);
//                    }
//                }
//            }
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */


    /*
     *  Function for  business services listing
     */

    public function updating_business_program() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $post_data = $this->input->post();
            $this->Business->updating_business_programs($post_data);
            $data['main_content'] = 'partner_success';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */


    /*
     *  Function for  business services listing
     */

    public function packages_treatmets_listing() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $data['packages'] = $this->Business->get_existing_packages($logged_in_user_details->business_id);
            $data['main_content'] = 'packages_treatments_listing';
            $this->load->view('includes/partner_template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     *  Function for  business services listing
     */

    public function delete_business_services() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $post_data = $this->input->post();
            $data['result'] = $this->Business->delete_business_service($post_data);
            echo json_encode($data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */



    /*
     *  Function for  business services listing
     */

    public function delete_business_package() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');

        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $post_data = $this->input->post();
            $data['result'] = $this->Business->delete_business_package($post_data);
            echo json_encode($data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     *  Function for login with facebook 
     */

    public function facebook_login() {
        $this->User_activity->insert_user_activity();

        $this->load->library('facebook');
        $user = null;
        $user_profile = null;

// See if there is a user from a cookie
        $user = $this->facebook->getUser();

        if ($user) {
            try {
// Proceed knowing you have a logged in user who's authenticated.
                $user_profile = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                show_error(print_r($e, TRUE), 500);
            }
        }
        $this->data['facebook'] = $this->facebook;
        $this->data['user'] = $user;
        $this->data['user_profile'] = $user_profile;
        echo "<pre>";
        print_r($user_profile);
        print_r($user);

        exit();

        if ($user_profile['email'] == "") {
            $this->session->set_flashdata('login_error_message', 'Looks like your Facebook account is not verified. You cannot use your Facebook login here !!!.');
            redirect("/login");
        }

        $this->load->model('User');
        $check_user_exists = $this->User->get_user_details_by_username($user_profile['email']);

        if (count($check_user_exists) == 0) {
            $facebook_user = $this->User->create_user_by_facebook_details($user_profile);
            $user_details = $this->User->get_user_details_by_username($user_profile['email']);
            if ($facebook_user == 1) {
// send registartion mail
                $user_details->is_logged_in = '1';
                $this->session->set_userdata("logged_in_user_data", $user_details);
//$this->session->set_flashdata('login_success_message', 'You are successfully logged in !!!.');
                redirect("/dashboard");
            } else {
                $this->session->set_flashdata('login_error_message', 'Looks like your Facebook account is not verified. You cannot use your Facebook login here !!!.');
                redirect("/login");
            }
        } else {
            $check_user_exists->is_logged_in = '1';
            $this->session->set_userdata("logged_in_user_data", $check_user_exists);
//$this->session->set_flashdata('login_success_message', 'You are successfully logged in !!!.');
            redirect("/dashboard");
        }
    }

    /* Above function ends here */


    /*
     * Function for partner registration
     */

    public function do_registration() {
        $data['title'] = "Partner Email Verification";
        $post_data = $this->input->post();


        $this->form_validation->set_rules('business_name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[reenter_password]');
        $this->form_validation->set_rules('reenter_password', 'Reenter Password', 'required');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        if ($this->form_validation->run() == FALSE) {

            $data['main_content'] = 'partner_registration';
            $this->load->view('includes/partner_template', $data);
        } else {

            $data['validate_email'] = $validate_email = $this->Business->validate_vendor_email($post_data['email']);
            if (!empty($validate_email)) {
                $this->session->set_flashdata('validation_error', '<label id="vendor_username_errors" for="name" generated="true" class="error">You have already registered with this email address, you can <a href="http://design1.nuvodev.com/client/zinguplife/partner">login</a> and continue.</label>');

                $data['main_content'] = 'partner_registration';
                $this->load->view('includes/partner_template', $data);
            } else {
                $email_verification_code = $this->Business->create_vendor($post_data);
                $post_data['email_verification_code'] = $email_verification_code;
                $data['details'] = $post_data;

                $vendor_registration_email_content = $this->load->view('emails/vendor_email_verification', $data, true);

                //$to = $post_data['email'];
                $to = 'partner@zinguplife.com';
                //$to = 'kushal@nuvodev.com';
                $from = "Zinguplife<info@zinuplife.com>";
                $registration_mail_subject = $post_data['business_name'] . " : Verify Your Email";
                $registration_message = $vendor_registration_email_content;

                $this->Mailing->send_mail($to, $from, $registration_mail_subject, $registration_message);

                redirect('/vendor/email_verification');
            }
        }
    }

    /* Above function ends here */
    /*
     * Function for partner registration
     */

    public function email_verification() {
        $data['title'] = "Partner Email Verification";
        $data['main_content'] = 'partner_email_verification';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */
    /*
     * Function for partner registration
     */

    public function verify_email() {
        $data['title'] = "Partner Email Verification";
        $email_verification_code = $this->uri->segment(3);
        $vendor_details = $this->Business->verify_email($email_verification_code);
        $vendor_details->is_logged_in = '1';
        $this->session->set_userdata("logged_in_vendor_data", $vendor_details);
        $data['vendor_details'] = $vendor_details;
        $data['main_content'] = 'vendor_email_verification_success';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */
    /*
     * Function for partner registration
     */

    public function verify_vendor_email() {

        $post_data = $this->input->post();
        $email_verification_code = $post_data['email_verification_code'];
        $vendor_details = $this->Business->verify_email($email_verification_code);
        if ($vendor_details != 'not matched') {
            $vendor_details->is_logged_in = '1';
            $this->session->set_userdata("logged_in_vendor_data", $vendor_details);

            redirect('vendor/business_info');
        } else {
            $data['verification_error'] = 'Email verification code is wrong.';
            $data['main_content'] = 'partner_email_verification';
            $this->load->view('includes/partner_template', $data);
        }
    }

    /* Above function ends here */

    /* Above function ends here */
    /*
     * Function for partner registration
     */

    public function check_username_availability() {

        $email = $this->input->post('email');
        $availability = $this->Business->validate_vendor_email($email);
        if (!empty($availability)) {
            echo "exist";
        } else {
            echo "not-exist";
        }
    }

    /* Above function ends here */

    /*
     * Function for deleting business gallery images
     */

    public function delete_business_gallery_image() {
        $post_data = $this->input->post();
        $data['result'] = $this->Business->delete_business_gallery($post_data);
        echo json_encode($data);
    }

    /* Above function ends here */


    /*
     * Function for deleting business service gallery images
     */

    public function delete_business_service_gallery_image() {
        $post_data = $this->input->post();
        $data['result'] = $this->Business->delete_business_service_gallery_image($post_data);
        echo json_encode($data);
    }

    /* Above function ends here */

    public function service_slots_delete() {
        $post_data = $this->input->post('id');
        $result = $this->Business->service_slots_delete($post_data);
        echo json_encode('success');
    }

    /*
     * Function to get business providers details by business provider id
     */

    public function service_slots_edit() {

        $this->User_activity->insert_user_activity();
        $data['logged_in_vendor_data'] = $this->session->userdata('logged_in_vendor_data');
        $service_id = $this->uri->segment(3);
        $data['services'] = $this->Business->get_service_slots_by_day($service_id);
        $data['title'] = "Home";
        $data['main_content'] = 'business_service_slots_edit';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */

    public function update_business_services_slots() {

        $this->User_activity->insert_user_activity();
        $data['logged_in_vendor_data'] = $this->session->userdata('logged_in_vendor_data');
        $post_data = $this->input->post();
        $update = $this->Business->update_service_slots($post_data);
        $data['main_content'] = 'partner_success';
        $this->load->view('includes/partner_template', $data);
    }

    /*
     * Function to get business offering services list by program
     */

    public function gallery() {
        $this->User_activity->insert_user_activity();
        $data['logged_in_vendor_data'] = $this->session->userdata('logged_in_vendor_data');
        $id = $this->uri->segment(3);
        $data['details'] = $this->Business->get_business_provider_details($id);
        $data['vendor'] = $id;
        $data['gallery_path'] = base_url() . $this->config->item('business_providers_gallery_path');
        $data['title'] = "Offering Services";
        $data['main_content'] = 'business_gallery';
        $this->load->view('includes/partner_template', $data);
    }

    /* Above function ends here */

    /* Above function ends here */

    public function gallery_delete() {
        $post_data = $this->input->post('id');
        $result = $this->Business->gallery_delete($post_data);
        echo json_encode('success');
    }

    /*
     *  Function for partner profile update
     */

    public function edit_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $id = $this->uri->segment(3);

            $gallery = $this->Business->get_gallery_detail($id);
            $data['details'] = $this->Business->get_business_provider_details($gallery->business_id);
            $data['id'] = $id;
            $data['gallery'] = $gallery;
            $data['gallery_path'] = base_url() . $this->config->item('business_providers_gallery_path');
            $data['title'] = "Offering Services";
            $data['main_content'] = 'edit gallery';
            $this->load->view('includes/template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     * Function for partner registration
     */

    public function update_gallery() {
        $post_data = $this->input->post();
        $this->Business->update_gallery($post_data, $_FILES);
        $this->session->set_flashdata('gallery_updated_message', 'Gallery updated successfully !!!');
        redirect("/vendor/gallery/" . $post_data['vendor_id'] . "");
    }

    /* Above function ends here */

    /*
     *  Function for partner profile update
     */

    public function add_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_vendor_data');
        if (!empty($logged_in_user_details) && $logged_in_user_details->role == 'vendor') {
            $this->User_activity->insert_user_activity();
            $id = $this->uri->segment(3);
            $data['details'] = $this->Business->get_business_provider_details($id);
            $data['id'] = $id;
            $data['gallery_path'] = base_url() . $this->config->item('business_providers_gallery_path');
            $data['title'] = "Offering Services";
            $data['main_content'] = 'add gallery';
            $this->load->view('includes/template', $data);
        } else {
            redirect("/partner");
        }
    }

    /* Above function ends here */

    /*
     * Function for partner registration
     */

    public function create_gallery() {
        $post_data = $this->input->post();
        $this->Business->add_gallery($_FILES);
        $this->session->set_flashdata('gallery_updated_message', 'Gallery added successfully !!!');
        redirect("/vendor/gallery/" . $post_data['vendor_id'] . "");
    }

    /* Above function ends here */

    public function vendor_review() {
        $post_data = $this->input->post();
        $business_provider_id = $post_data['id'];
        $this->form_validation->set_rules('title', 'Review title', 'required');
        $this->form_validation->set_rules('review', 'Your Review', 'required');
        //$this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        if ($this->form_validation->run() == FALSE) {
            $this->User_activity->insert_user_activity();
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');


            $data['business_provider_id'] = $business_provider_id;
            $data['business_provider_details'] = $this->Business->get_business_provider_details($business_provider_id);
            $data['views'] = $this->Business->update_vendor_page_views($data['business_provider_details']['details']->business_id);
            $data['offerings'] = $this->Business->get_offering_by_vendor($business_provider_id);
            $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
            $data['gallery_path'] = base_url() . $this->config->item('business_providers_gallery_path');
            $data['offering_gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
            $data['reviews'] = $this->Business->get_review_for_vendors($business_provider_id);
            $data['title'] = "Home";
            $data['active_url'] = 'service_providers';
            $data['main_content'] = 'business_providers_details';
            $this->load->view('includes/menu_template', $data);
        } else {

            $this->Business->add_vendor_review($post_data);
            $this->session->set_flashdata('review_success', 'Your review successfully submitted !!!.');
            redirect('vendorDetails/' . $business_provider_id . '');
        }
    }

}
