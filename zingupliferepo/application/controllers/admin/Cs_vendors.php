<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for Vendors listing, filter vendors by services and vendor's details
 * @author Anitha <anitha@nuvodev.com>
 * Date:31-03-2016
 * */
class Cs_vendors extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Cs_vendor');
    }

    

    /*
     *  Function to register partner
     */

    public function partner_registration() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['title'] = "Zinguplife Customer Support|Partner Registration";
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['services'] = $this->Cs_vendor->get_business_services();
            $data['main_content'] = 'admin/cs/partner_registration';
            $data['locations'] = $this->Cs_vendor->get_locations();
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     * Function for partner registration
     */

    public function add_partner_registration() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['title'] = "Zinguplife Customer Support|Partner Registration";
            $data['url'] = 'customer_support/vendors';
            $post_data = $this->input->post();
            $data['logged_in_user_details'] = $logged_in_user_details;
            $this->form_validation->set_rules('username', 'username', 'required|valid_email');
            $this->form_validation->set_rules('business_name', 'business_name', 'required');
            $this->form_validation->set_rules('address1', 'address', 'required');
            $this->form_validation->set_rules('area', 'area', 'required');
            $this->form_validation->set_rules('zipcode', 'zipcode', 'required|numeric');
            $this->form_validation->set_rules('mobile', 'mobile', 'required|numeric|exact_length[10]');
            $this->form_validation->set_rules('business_email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('check', 'Check box', 'callback_accept_terms');



            $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
            if ($this->form_validation->run() == FALSE) {
                $data['services'] = $this->Cs_vendor->get_business_services();
                $data['locations'] = $this->Cs_vendor->get_locations();
                $data['main_content'] = 'admin/cs/partner_registration';
                $this->load->view('admin/includes/template', $data);
            } else {
                $validate_details = $this->Cs_vendor->get_partner_details_by_username($post_data['username']);

                if (!empty($validate_details)) {


                    $data['services'] = $this->Cs_vendor->get_business_services();
                    $data['locations'] = $this->Cs_vendor->get_locations();
                    $this->session->set_flashdata('validate_email_error_message', 'Email Already Registered with Zinguplife');
                    $data['main_content'] = 'admin/cs/partner_registration';
                    $this->load->view('admin/includes/template', $data);
                } else {

                    $this->Cs_vendor->add_partner_registrations($post_data);
                    $this->session->set_flashdata('vendor_registration_message', 'Vendor Registered Successfully');
                    redirect('/customer_support/vendors');
                }
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
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
     *  Function to edit business information
     */

    public function business_information() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
          
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['title'] = "Zinguplife Customer Support|Business information";
            $data['url'] = 'customer_support/vendors';
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['business_id'] = $business_id = $this->uri->segment(3);
 
            $data['business_info'] = $this->Cs_vendor->get_business_vendor_details($business_id);
            $data['sub_url'] = 'customer_support/business_info';
            $data['vendor_id'] = $data['business_info']['business']->business_id;
            $data['locations'] = $this->Cs_vendor->get_locations();
            $data['services'] = $this->Cs_vendor->get_business_services();
            $data['main_content'] = 'admin/cs/business_information';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */



    /*
     *  Function for partner profile update
     */

    public function adding_business_information() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['title'] = "Zinguplife Customer Support|Business information";
            $post_data = $this->input->post();
            $data['url'] = 'customer_support/vendors';
            $data['business_id'] = $post_data['id'];
            $data['sub_url'] = 'customer_support/business_info';
            $data['vendor_id'] = $post_data['vendor_id'];
            $data['logged_in_user_details'] = $logged_in_user_details;
            
         $this->form_validation->set_rules('business_name', 'business name', 'required');
            $this->form_validation->set_rules('phone', 'phone', 'required|numeric|exact_length[10]');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
             $this->form_validation->set_rules('area', 'area', 'required');
            $this->form_validation->set_rules('zipcode', 'zipcode', 'numeric');
            $this->form_validation->set_rules('latitude', 'latitude', 'numeric');
            $this->form_validation->set_rules('longitude', 'longitude', 'numeric');
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
            if ($this->form_validation->run() == FALSE) {
            $data['business_info'] = $this->Cs_vendor->get_business_vendor_details($post_data['id']);
          
            $data['sub_url'] = 'customer_support/business_info';
            $data['vendor_id'] = $data['business_info']['business']->business_id;
            $data['locations'] = $this->Cs_vendor->get_locations();
            $data['services'] = $this->Cs_vendor->get_business_services();
            $data['main_content'] = 'admin/cs/business_information';
            $this->load->view('admin/includes/cs_vendor_template', $data);	
            	
            	            
            }
            
            else{
            	
            $areaid_name = explode('/', $post_data['area']);
            $area_name = $areaid_name[1];
            if ($_FILES['userfile']['name'] != '') {
                unlink("assets/uploads/business_providers/logo/" . $post_data['vendor_id'] . "/" . $post_data['old_logo']);
                if (!is_dir('assets/uploads/business_providers/logo/' . $post_data['vendor_id'] . '/')) {
                    mkdir('assets/uploads/business_providers/logo/' . $post_data['vendor_id'] . '/', 0777, TRUE);
                }
                $logopath = './assets/uploads/business_providers/logo/' . $post_data['vendor_id'] . '/';
                $logofile = $_FILES['userfile']['name'];

                $logoname = $post_data['business_name'] . "_" . $area_name . "_" .time()."_". $logofile;
                $logo_name = $post_data['business_name'] . "_" . $area_name . "_"  .time()."_".$_FILES['userfile']['name'];
                copy($_FILES['userfile']['tmp_name'], $logopath . $logoname);
            } else {

                $logo_name = $post_data['old_logo'];
            }
           
                $this->Cs_vendor->update_business_information($post_data, $logo_name);
                $this->session->set_flashdata('business_info_success_message', 'Information Updated Successfully');
                redirect('/cs/business_information/' . $data['business_id']);
            }
            }
        else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     * Function for deleting business gallery images
     */    
    
    
    /*
     * Function for deleting business gallery images
     */

    public function delete_business_gallery_image() {

        $post_data = $this->input->post();
        $data['result'] = $this->Cs_vendor->delete_business_gallery($post_data);
        echo json_encode($data);
    }

    /* Above function ends here */



    /*
     *  Function for  business packages listing
     */

    public function packages_treatmets_listing() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['title'] = "Zinguplife Customer Support|Packages Treatments";
            $data['logged_in_user_details'] = $logged_in_user_details;
            $vendor_id = $this->uri->segment(3);
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/packages_treatments';
            $vendor_det = $this->Cs_vendor->get_vendorid_by_businessid($vendor_id);
            $data['vendor_id'] = $vendor_det[0]->business_id;
            $data['business_id'] = $vendor_id;
            $data['packages'] = $this->Cs_vendor->get_existing_packages($vendor_id);
            $data['main_content'] = 'admin/cs/packages_treatments_listing';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Function for partner profile update
     */

    public function adding_package_service() {
       $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['title'] = "Zinguplife Customer Support|Packages Treatments";
            $data['logged_in_user_details'] = $logged_in_user_details;
            $vendor_id = $this->uri->segment(3);
            $data['url'] = 'customer_support/vendors';
            $data['business_id'] = $vendor_id;
            $data['sub_url'] = 'customer_support/packages_treatments';
            $vendor_det = $this->Cs_vendor->get_vendorid_by_businessid($vendor_id);
            $data['vendor_id'] = $vendor_det[0]->business_id;
            $data['packages'] = $this->Cs_vendor->get_existing_packages($vendor_id);
            $data['mapping'] = $this->Cs_vendor->get_partner_services_mapping($data['business_id']);
            $data['main_content'] = 'admin/cs/add_packages_service';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Function for adding business programs
     */

    public function adding_business_programs() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();
            $data['url'] = 'customer_support/vendors';
            $data['programs'] = $this->Cs_vendor->insert_business_programs($post_data);
            $this->session->set_userdata('recent_program_id', $data['programs']);
            echo json_encode($data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Function for adding business services
     */

    public function adding_business_services() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['title'] = "Zinguplife Customer Support|Packages Treatments";
            $post_data = $this->input->post();
            $data['url'] = 'customer_support/vendors';
            $data['logged_in_user_details'] = $logged_in_user_details;
            $this->form_validation->set_rules('packages', 'Package', 'required');
            $this->form_validation->set_rules('service', 'Service', 'required');
            $this->form_validation->set_rules('hours', 'hours', 'required');
             $this->form_validation->set_rules('minutes', 'minutes', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            $this->form_validation->set_rules('service_type', 'Service_type', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
            if ($this->form_validation->run() == FALSE) {
            	$vendor_id = $this->uri->segment(3);
            $data['url'] = 'customer_support/vendors';
            $data['business_id'] = $post_data['business_id'];
            $data['sub_url'] = 'customer_support/packages_treatments';
                $data['packages'] = $this->Cs_vendor->get_existing_packages($post_data['business_id']);
                $data['business_id'] = $post_data['business_id'];
                $data['main_content'] = 'admin/cs/add_packages_service';
                $this->load->view('admin/includes/cs_vendor_template', $data);
            } else {
                $this->Cs_vendor->insert_business_services($post_data, $files);
                $this->session->set_flashdata('business_service_success_message', 'Information Updated Successfully');
                redirect('/cs/business_services/' . $post_data['business_id']);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Function for  business services listing
     */

    public function delete_business_package() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();
            $data['url'] = 'customer_support/vendors';
            $data['result'] = $this->Cs_vendor->delete_business_package($post_data);
            echo json_encode($data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */



    /*
     *  Function for  business services listing
     */

    public function business_package_edit() {
         $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['title'] = "Zinguplife Customer Support|Packages Treatments";
            $package_id = $this->uri->segment(3);
            $data['sub_url'] = 'customer_support/packages_treatments';
            $vendor_det = $this->Cs_vendor->get_vendorid_businessid_by_packageid($package_id);
            $data['vendor_id'] = $vendor_det[0]->business_id;
            $data['business_id'] = $vendor_det[0]->id;
            $data['url'] = 'customer_support/vendors';
            $data['packages'] = $this->Cs_vendor->get_single_package_detail($package_id);
            $data['mapping'] = $this->Cs_vendor->get_partner_services_mapping($data['business_id']);
            $data['main_content'] = 'admin/cs/business_package_edit';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Function for  business services listing
     */

    public function updating_business_program() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['title'] = "Zinguplife Customer Support|Packages Treatments";
            $data['url'] = 'customer_support/vendors';
            $post_data = $this->input->post();
            $this->form_validation->set_rules('service', 'Service', 'required');
            $this->form_validation->set_rules('package_name', 'package_name', 'required');
            $this->form_validation->set_rules('type', 'Type', 'required');
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
            if ($this->form_validation->run() == FALSE) {
            	$vendor_det = $this->Cs_vendor->get_vendorid_businessid_by_packageid($post_data['service_id']);
            $data['vendor_id'] = $vendor_det[0]->business_id;
            $data['business_id'] = $vendor_det[0]->id;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/packages_treatments';
            $data['packages'] = $this->Cs_vendor->get_single_package_detail($post_data['service_id']);
            $data['main_content'] = 'admin/cs/business_package_edit';
            $this->load->view('admin/includes/cs_vendor_template', $data);
            	}
            	else{
            		
            $this->Cs_vendor->updating_business_programs($post_data);
            $this->session->set_flashdata('business_program_success_message', 'Updated Successfully');
            redirect('/cs/business_package_edit/' . $post_data['service_id']);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Function for  business services listing
     */

    public function delete_business_services() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();
            $data['url'] = 'customer_support/vendors';
            $data['result'] = $this->Cs_vendor->delete_business_service($post_data);
            echo json_encode($data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Function for  business services listing
     */

    public function business_services() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['title'] = "Zinguplife Customer Support|Packages Treatments";
            $data['business_id'] = $business_id = $this->uri->segment(3);
            $data['sub_url'] = 'customer_support/business_services';
            $vendor_det = $this->Cs_vendor->get_vendorid_by_businessid($business_id);
            $data['vendor_id'] = $vendor_det[0]->business_id;
            $data['url'] = 'customer_support/vendors';
            $data['services'] = $this->Cs_vendor->get_all_services_listing($business_id);
            $data['main_content'] = 'admin/cs/business_services_list';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Function for  business services listing
     */

    public function business_service_edit() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');

        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['service_id'] = $service_id = $this->uri->segment(3);
            $data['sub_url'] = 'customer_support/business_services';
            $vendor_det = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($service_id);
            $data['vendor_id'] = $vendor_det[0]->business_id;
            $data['business_id'] = $vendor_det[0]->id;
            $data['title'] = "Zinguplife Customer Support|Business Services";
            $data['url'] = 'customer_support/vendors';
            $data['services'] = $this->Cs_vendor->get_single_service_detail($service_id);
            $data['main_content'] = 'admin/cs/business_service_edit';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */
    
    /*
     * Function to get business providers details by business provider id
     */

    public function service_slots_edit() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {

            $data['logged_in_user_details'] = $logged_in_user_details;
            $service_id = $this->uri->segment(3);
            $data['sub_url'] = 'customer_support/business_services';
            $vendor_det = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($service_id);
            $data['vendor_id'] = $vendor_det[0]->business_id;
            $data['business_id'] = $vendor_det[0]->id;

            $service_key = explode('_', $service_id);
            $data['key_id'] = $service_key[1];
            $data['services'] = $this->Cs_vendor->get_service_slots_by_day($service_id);
            $data['title'] = "Zinguplife Customer Support|Business Services";
            $data['url'] = 'customer_support/vendors';
            $data['main_content'] = 'admin/cs/business_service_slots_edit';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    public function update_business_services_slots() {

        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {

            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();
            $update = $this->Cs_vendor->update_service_slots($post_data);
            $data['title'] = "Zinguplife Customer Support|Business Services";
            $this->session->set_flashdata('service_slot_success_message', 'Information Updated Successfully');
            redirect('/cs/business_service_edit/' . $post_data['service_id']);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    public function service_slots_delete() {
        $post_data = $this->input->post('id');
        $result = $this->Cs_vendor->service_slots_delete($post_data);
        echo json_encode('success');
    }

    /*
     *  Function for business services
     */

    public function business_service_slots() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['title'] = 'Zinguplife customer support |business hours';
            $data['business_id'] = $business_id = $this->uri->segment(3);
            $data['sub_url'] = 'customer_support/business_services_slots';
            $vendor_det = $this->Cs_vendor->get_vendorid_by_businessid($business_id);
            $data['vendor_id'] = $vendor_det[0]->business_id;

            $data['packages'] = $this->Cs_vendor->get_existing_packages($business_id);
            $data['main_content'] = 'admin/cs/service_slots';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Function for adding business services slots
     */

    public function adding_business_service_slots() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['title'] = 'Zinguplife customer support |business hours';
            $post_data = $this->input->post();
            $this->Cs_vendor->insert_services_slots($post_data);
            $this->session->set_flashdata('service_slot_success_message', 'Slots Added Successfully');
            redirect('/cs/business_service_slots/' . $post_data['business_id']);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Function for getting business services by program
     */

    public function get_business_services_by_program() {
        $post_data = $this->input->post();
        $data['services'] = $this->Cs_vendor->get_services_by_program($post_data);
        echo json_encode($data);
    }

    /* Above function ends here */


    /*
     * Function for deleting business service gallery images
     */

    public function delete_business_service_gallery_image() {
        $post_data = $this->input->post();
        $data['result'] = $this->Cs_vendor->delete_business_service_gallery_image($post_data);
        echo json_encode($data);
    }

    /* Above function ends here */


    /*
     *  Function for  business services listing
     */

    public function updating_business_services() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['title'] = 'Zinguplife customer support |business hours';
            $post_data = $this->input->post();
            $this->form_validation->set_rules('service_name', 'service name', 'required');
            $this->form_validation->set_rules('hours', 'hours', 'required');
             $this->form_validation->set_rules('minutes', 'minutes', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');
            $this->form_validation->set_rules('service_type', 'Service_type', 'required');
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
            if ($this->form_validation->run() == FALSE) {
              $data['services'] = $this->Cs_vendor->get_single_service_detail($post_data['service_id']);
            $data['main_content'] = 'admin/cs/business_service_edit';
            $this->load->view('admin/includes/cs_vendor_template', $data);
            }
            else{
            	$this->Cs_vendor->updating_business_services($post_data);
            $this->session->set_flashdata('service_success_message', 'Information Updated Successfully');
            redirect('/cs/business_service_edit/' . $post_data['service_id']);
            	}
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     * Function for view business gallery images
     */

    public function view_business_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['business_id'] = $business_id = $this->uri->segment(3);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_info';
            $data['title'] = 'Zinguplife customer support | Vendors';
            $data['business_gallery'] = $this->Cs_vendor->view_business_gallery($business_id);
            $data['main_content'] = 'admin/cs/business_gallery';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     * Function for view business gallery images
     */

    public function business_gallery_edit() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $gallery_id = $this->uri->segment(3);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_info';
            $data['title'] = 'Zinguplife customer support | Vendors';
            $data['gallery_info'] = $this->Cs_vendor->business_gallery_info($gallery_id);
            $data['business_id'] = $data['gallery_info'][0]->business_id;
            $data['main_content'] = 'admin/cs/business_gallery_edit';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */




    /*
     * Function for view business gallery images
     */

    public function updating_business_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $gallery_id = $this->uri->segment(3);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_info';
            $data['title'] = 'Zinguplife customer support | Vendors';
            $post_data = $this->input->post();
            $business_info = $this->Cs_vendor->get_business_info_by_id($post_data['business_id']);
            if ($_FILES['userfile']['name'] != '') {
                unlink("assets/uploads/business_providers/gallery/" . $post_data['business_id'] . "/" . $post_data['old_gallery_image']);
                if (!is_dir('assets/uploads/business_providers/gallery/' . $post_data['business_id'] . '/')) {
                    mkdir('assets/uploads/business_providers/gallery/' . $post_data['business_id'] . '/', 0777, TRUE);
                }
                $logopath = './assets/uploads/business_providers/gallery/' . $post_data['business_id'] . '/';
                $logofile = $_FILES['userfile']['name'];

                $imagename = $business_info->name . "_" . $business_info->suburb . "_" .time()."_". $logofile;
                $image_name = $business_info->name . "_" . $business_info->suburb . "_" .time()."_". $_FILES['userfile']['name'];
                copy($_FILES['userfile']['tmp_name'], $logopath . $imagename);
            } else {

                $image_name = $post_data['old_gallery_image'];
            }
            $data['gallery_info'] = $this->Cs_vendor->updating_business_gallery($image_name, $post_data['business_id'], $gallery_id);
            $this->session->set_flashdata('gallery_update_success_message', 'Information Updated Successfully');
            redirect('/cs/business_gallery_edit/'.$gallery_id);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */



    /*
     * Function for view business gallery images
     */

    public function delete_business_gallery() {
        $post_data = $this->input->post();
        $data['result'] = $this->Cs_vendor->delete_business_gallery_image($post_data);

        echo json_encode($data);
    }

    /* Above function ends here */


    /*
     * Function for view business gallery images
     */

    public function add_business_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['business_id'] = $business_id = $this->uri->segment(3);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_info';
            $data['title'] = 'Zinguplife customer support | Vendors';
            $data['business_gallery'] = $this->Cs_vendor->view_business_gallery($business_id);
            $data['main_content'] = 'admin/cs/add_business_gallery';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */




    /*
     * Function for view business gallery images
     */

    public function adding_business_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_info';
            $data['title'] = 'Zinguplife customer support | Vendors';
            $post_data = $this->input->post();
            $business_info = $this->Cs_vendor->get_business_info_by_id($post_data['id']);
            $count = count($_FILES['file']['name']);
            for ($i = 0; $i <= $count; $i++) {
                if ($_FILES['file']['name'][$i] != '') {
                    if (!is_dir('assets/uploads/business_providers/gallery/' . $post_data['id'] . '/')) {
                        mkdir('assets/uploads/business_providers/gallery/' . $post_data['id'] . '/', 0777, TRUE);
                    }
                    $logopath = './assets/uploads/business_providers/gallery/' . $post_data['id'] . '/';
                    $logofile = $_FILES['file']['name'][$i];

                    $imagename = $business_info->name . "_" . $business_info->suburb . "_" .time().$i."_". $logofile;
                    $image_name = $business_info->name . "_" . $business_info->suburb . "_" .time().$i."_". $_FILES['file']['name'][$i];
                    copy($_FILES['file']['tmp_name'][$i], $logopath . $imagename);
                    $this->Cs_vendor->adding_business_gallery($post_data, $image_name);
                }
            } 
            $this->session->set_flashdata('gallery_adding_success_message', 'Gallery Added Successfully');
            redirect('/cs/view_business_gallery/' . $post_data['id']);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */
    
    
    
    
     /*
     * Function for view business gallery images
     */

    public function business_service_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['service_id']=$service_id = $this->uri->segment(3);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_services';
            $data['title'] = 'Zinguplife customer support | Vendors';
            $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($service_id);
            $data['business_id']= $data['business_info'][0]->id;
            $data['business_service_gallery'] = $this->Cs_vendor->view_business_service_gallery($service_id);
            $data['main_content'] = 'admin/cs/view_business_service_gallery';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     * Function for view business gallery images
     */

    public function edit_business_service_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $service_id = $this->uri->segment(3);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_services';
            $data['title'] = 'Zinguplife customer support | Vendors';
            $data['business_info'] = $this->Cs_vendor->get_businessid_by_serviceid($service_id);
            $data['service_info'] = $this->Cs_vendor->business_service_info($service_id);
            $data['business_id'] = $data['business_info'][0]->business_id;
            $data['main_content'] = 'admin/cs/business_service_gallery_edit';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */
    
    
    
    
     /*
     * Function for view business gallery images
     */

    public function updating_business_service_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $service_id = $this->uri->segment(3);
            $post_data = $this->input->post();
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_services';
            $data['title'] = 'Zinguplife customer support | Vendors';
            $data['business_info'] = $this->Cs_vendor->get_businessid_by_serviceid($service_id);
            $business_info = $this->Cs_vendor->get_business_info_by_id($data['business_info'][0]->business_id);
            if ($_FILES['userfile']['name'] != '') {
                unlink("assets/uploads/business_services/gallery/" . $post_data['service_id'] . "/" . $post_data['old_gallery_image']);
                if (!is_dir('assets/uploads/business_services/gallery/' . $post_data['service_id'] . '/')) {
                    mkdir('assets/uploads/business_services/gallery/' . $post_data['service_id'] . '/', 0777, TRUE);
                }
                $logopath = './assets/uploads/business_services/gallery/' . $post_data['service_id'] . '/';
                $logofile = $_FILES['userfile']['name'];

                $imagename = $business_info->name . "_" . $business_info->suburb . "_" .time()."_". $logofile;
                $image_name = $business_info->name . "_" . $business_info->suburb . "_" .time()."_". $_FILES['userfile']['name'];
                copy($_FILES['userfile']['tmp_name'], $logopath . $imagename);
            } else {

                $image_name = $post_data['old_gallery_image'];
            }
            $data['service_info'] = $this->Cs_vendor->updating_business_service_gallery($image_name,$post_data,$service_id);
            $this->session->set_flashdata('gallery_update_success_message', 'Information Updated Successfully');
            redirect('/cs/business_service_gallery_edit/'.$service_id);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    
      /*
     * Function for view business gallery images
     */

    public function business_service_gallery_delete() {
        $post_data = $this->input->post();
        $data['result'] = $this->Cs_vendor->delete_business_service_gallery_edit($post_data);

        echo json_encode($data);
    }

    /* Above function ends here */
    
    
     /*
     * Function for view business gallery images
     */

    public function add_business_service_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['service_id'] = $service_id = $this->uri->segment(3);
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_services';
            $data['title'] = 'Zinguplife customer support | Vendors';
            $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($service_id);
            $data['business_id']= $data['business_info'][0]->id;
            $data['business_service_gallery'] = $this->Cs_vendor->view_business_service_gallery($service_id);
            $data['main_content'] = 'admin/cs/add_business_service_gallery';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    
    /*
     * Function for view business gallery images
     */

    public function adding_business_services_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_services';
            $data['title'] = 'Zinguplife customer support | Vendors';
            $post_data = $this->input->post();
            $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($post_data['service_id']);
            $business_info = $this->Cs_vendor->get_business_info_by_id($data['business_info'][0]->id);
            $count = count($_FILES['file']['name']);
            for ($i = 0; $i <= $count; $i++) {
                if ($_FILES['file']['name'][$i] != '') {
                    if (!is_dir('assets/uploads/business_services/gallery/' . $post_data['service_id'] . '/')) {
                        mkdir('assets/uploads/business_services/gallery/' . $post_data['service_id'] . '/', 0777, TRUE);
                    }
                    $logopath = './assets/uploads/business_services/gallery/' . $post_data['service_id'] . '/';
                    $logofile = $_FILES['file']['name'][$i];

                    $imagename = $business_info->name . "_" . $business_info->suburb . "_" .time()."_". $logofile;
                    $image_name = $business_info->name . "_" . $business_info->suburb . "_" .time()."_". $_FILES['file']['name'][$i];
                    copy($_FILES['file']['tmp_name'][$i], $logopath . $imagename);
                    $this->Cs_vendor->adding_business_service_gallery($post_data,$i,$image_name);
                }
            } 
            
            $this->session->set_flashdata('gallery_adding_success_message', 'Gallery Added Successfully');
            redirect('/cs/business_service_gallery/' . $post_data['service_id']);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

/*
     * Function to get business providers details by business provider id
     */

    public function service_search_filter() {

        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
         $post_data = $this->input->post();
         $result = $this->Cs_vendor->service_search_filter($post_data);
        echo json_encode($result);
} else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


 /*
     * Function to get business providers details by business provider id
     */

    public function one_time_service_slots_edit() {

        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
        	$data['logged_in_user_details'] = $logged_in_user_details;
        $service_slot_id = explode('_',$this->uri->segment(3));
        $service_id = $service_slot_id[0];
        $data['slot_id'] = $service_slot_id[1];
        $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($service_id);
        $data['business_id']= $data['business_info'][0]->id;
        $data['services'] = $this->Cs_vendor->get_slot_details($service_id);
        $data['title'] = "Zinguplife Customer support | Vendors";
        $data['url'] = 'customer_support/vendors';
        $data['sub_url'] = 'customer_support/business_services';
        $data['main_content'] = 'admin/cs/one_time_slot_edit';
        $this->load->view('admin/includes/cs_vendor_template', $data);
} else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


 /*
     * Function to get business providers details by business provider id
     */

    public function update_one_time_slots() {

        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
         $post_data = $this->input->post();
         $result = $this->Cs_vendor->update_one_time_service_slot($post_data);
         $this->session->set_flashdata('service_success_message', 'Information Updated Successfully');
            redirect('/cs/business_service_edit/' . $post_data['service_id']);
} else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


 public function one_time_service_slots_delete() {
        $post_data = $this->input->post();
        $result = $this->Cs_vendor->one_time_service_slots_delete($post_data);
        echo json_encode('success');
    }


    /*
     *  Function for partner profile update
     */

    public function edit_offerings_memberships() {
         $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $id = $this->uri->segment(3);
            $data['title'] = "Zinguplife Customer support | Vendors";
            $data['url'] = 'customer_support/vendors';
            $data['sub_url'] = 'customer_support/business_services';
            $data['membership'] = $membership = $this->Cs_vendor->get_membership_details($id);
            $data['service_id'] = $service_id = $membership->business_service_id;
            $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($service_id);
            $data['business_id']= $data['business_info'][0]->id;
            $data['services'] = $this->Cs_vendor->get_single_service_detail($service_id);
 
            $data['main_content'] = 'admin/cs/edit_membership';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */



/*
     * Function for partner registration
     */

    public function update_offerings_memberships() {
        $data['title'] = "Zinguplife Customer support | Vendors";
        $post_data = $this->input->post();

        $this->form_validation->set_rules('membership', 'Membership', 'required');
        $this->form_validation->set_rules('duration', 'Duration', 'required');
        $this->form_validation->set_rules('fees', 'Price', 'required|numeric');
        $this->form_validation->set_rules('max_number_of_members', 'Maximum Number Of Members', 'numeric');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        $id = $post_data['id'];

        if ($this->form_validation->run() == FALSE) {
            $membership = $this->Cs_vendor->get_membership_details($id);
            $data['membership'] = $membership;
            $service_id = $membership->business_service_id;
            $data['service_id'] = $service_id;
            $data['services'] = $this->Cs_vendor->get_single_service_detail($service_id);
            $data['main_content'] = 'admin/cs/edit_membership';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->Cs_vendor->update_membership($post_data);
            $this->session->set_flashdata('service_success_message', 'Memebership successfully updated for service  "' . $post_data['service_name'] . '"!!!');
            redirect("/cs/business_service_edit/" . $post_data['service_id'] . "");
        }
    }

    /* Above function ends here */

 public function delete_offerings_memberships() {
        $post_data = $this->input->post('member_id');
        $result = $this->Cs_vendor->membership_delete($post_data);
        echo json_encode('success');
    }
    



 /*
     * Function to get business providers details by business provider id
     */

    public function one_day_packages() {

        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
        	$data['logged_in_user_details'] = $logged_in_user_details;
        $data['business_id'] = $business_id = $this->uri->segment(3);
        $vendor_det = $this->Cs_vendor->get_vendorid_by_businessid($business_id);
        $vendor_id = $vendor_det[0]->business_id;
        $data['title'] = "Zinguplife Customer support | Vendors";
        $data['url'] = 'customer_support/vendors';
        $data['sub_url'] = 'customer_support/one_day_packages';
        $data['one_day_packages'] = $this->Cs_vendor->get_one_day_packages($vendor_id);
        $data['main_content'] = 'admin/cs/one_day_packages';
        $this->load->view('admin/includes/cs_vendor_template', $data);
} else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */
    
    
    public function delete_one_day_package() {
        $post_data = $this->input->post('package_id');
        $result = $this->Cs_vendor->delete_one_day_package($post_data);
        echo json_encode('success');
    }


 /*
     *  Function for business services
     */

    public function add_one_day_package() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
        	$data['logged_in_user_details'] = $logged_in_user_details;
         $data['business_id'] = $business_id = $this->uri->segment(3);
         $vendor_det = $this->Cs_vendor->get_vendorid_by_businessid($business_id);
            $data['vendor_id'] = $vendor_det[0]->business_id;
        $data['title'] = "Zinguplife Customer support | Vendors";
        $data['url'] = 'customer_support/vendors';
        $data['sub_url'] = 'customer_support/one_day_packages';
        $data['all_services'] = $this->Cs_vendor->get_all_services_listing($business_id);
        $data['main_content'] = 'admin/cs/add_one_day_packages';
        $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */
    
    /*
     *  Function for business services
     */
    
        public function create_one_day_package() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
        	$data['logged_in_user_details'] = $logged_in_user_details;
        $post_data = $this->input->post();
            $this->Cs_vendor->add_one_day_package($post_data);
            $this->session->set_flashdata('one_day_package_success_message', 'Added successfully !!!');
            redirect("/cs/one_day_packages/".$post_data['business_id']);
 } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
     /* Above function ends here */
    
    
      /*
     *  Function for business services
     */

    public function business_service_add_slot() {
              
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
        	$data['logged_in_user_details'] = $logged_in_user_details;
         $service_id = $this->uri->segment(3);
        $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($service_id);
        $data['business_id']= $data['business_info'][0]->id;
        $data['title'] = "Zinguplife Customer support | Vendors";
        $data['url'] = 'customer_support/vendors';
        $data['sub_url'] = 'customer_support/one_time_slots';
        $data['service_details'] = $this->Cs_vendor->get_single_service_detail($service_id);
        $data['main_content'] = 'admin/cs/one_time_slot';
        $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */
    
    
     public function business_service_adding_slot() {
       
         $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
        	$data['logged_in_user_details'] = $logged_in_user_details;
         $post_data = $this->input->post();
        $this->form_validation->set_rules('no_slots', 'No. of slots', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        if ($this->form_validation->run() == FALSE) {
            $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($post_data['service_id']);
        $data['business_id']= $data['business_info'][0]->id;
        $data['title'] = "Zinguplife Customer support | Vendors";
        $data['url'] = 'customer_support/vendors';
        $data['sub_url'] = 'customer_support/one_time_slots';
            $data['service_details'] = $this->Cs_vendor->get_single_service_detail($post_data['service_id']);
            $data['main_content'] = 'admin/cs/one_time_slot';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->Cs_vendor->add_one_time_slot($post_data);
            $this->session->set_flashdata('service_success_message', 'Slot added successfully !!!');
            redirect("cs/business_service_edit/" . $post_data['service_id'] . "");
        }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

 /*
     *  Function for partner profile update
     */

    public function offerings_memberships() {
             $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
        	$data['logged_in_user_details'] = $logged_in_user_details;
         $service_id = $this->uri->segment(3);
        $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($service_id);
        $data['business_id']= $data['business_info'][0]->id;
        $data['title'] = "Zinguplife Customer support | Vendors";
        $data['url'] = 'customer_support/vendors';
        $data['sub_url'] = 'customer_support/business_services';
        $data['service_details'] = $this->Cs_vendor->get_single_service_detail($service_id);
        $data['main_content'] = 'admin/cs/add_membership';
        $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */
    
    
    /*
     * Function for partner registration
     */

    public function create_offerings_memberships() {
        
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
        	$data['logged_in_user_details'] = $logged_in_user_details;
         $post_data = $this->input->post();
         $this->form_validation->set_rules('membership', 'Membership', 'required');
        $this->form_validation->set_rules('duration', 'Duration', 'required');
        $this->form_validation->set_rules('fees', 'Price', 'required|numeric');
        $this->form_validation->set_rules('max_number_of_members', 'Maximum Number Of Members', 'numeric');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        if ($this->form_validation->run() == FALSE) {
        $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($post_data['service_id']);
        $data['business_id']= $data['business_info'][0]->id;
        $data['title'] = "Zinguplife Customer support | Vendors";
        $data['url'] = 'customer_support/vendors';
        $data['sub_url'] = 'customer_support/business_services';
            $data['service_details'] = $this->Cs_vendor->get_single_service_detail($post_data['service_id']);
            $data['main_content'] = 'admin/cs/add_membership';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        }
            
        else {
            $this->Cs_vendor->create_membership($post_data);
            $this->session->set_flashdata('service_success_message', 'Memebership successfully added for service  "' . $post_data['service_name'] . '"!!!');
            redirect("cs/business_service_edit/" . $post_data['service_id'] . "");
        }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        } 
        
    }

    /* Above function ends here */
    
    
    
     public function one_day_package_edit() {
                $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
        	$data['logged_in_user_details'] = $logged_in_user_details;
        $ids = explode('_',$this->uri->segment(3));
        $one_day_package_id = $ids[0];
        $service_id = $ids[1];
        $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($service_id);
        $data['business_id']= $data['business_info'][0]->id;
        $data['services'] = $this->Cs_vendor->get_one_day_package_details($one_day_package_id);
        $data['title'] = "Zinguplife Customer support | Vendors";
        $data['url'] = 'customer_support/vendors';
        $data['sub_url'] = 'customer_support/one_day_packages';
        $data['main_content'] = 'admin/cs/one_day_pacakge_edit';
        $this->load->view('admin/includes/cs_vendor_template', $data);
} else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    
    
    
    public function update_one_day_packages() {
        $post_data = $this->input->post();
        $data['business_info'] = $this->Cs_vendor->get_vendorid_businessid_by_serviceid($post_data['service_id']);
        $data['business_id']= $data['business_info'][0]->id;
        $data['title'] = "Zinguplife Customer support | Vendors";
        $data['url'] = 'customer_support/vendors';
        $data['sub_url'] = 'customer_support/one_day_packages';
            $this->Cs_vendor->update_one_day_packages($post_data);
            $this->session->set_flashdata('one_day_pacakge_success_message', 'Package updated successfully !!!');
            redirect("/cs/one_day_package_edit/".$post_data['package_id'].'_'.$post_data['service_id']);
        
    }
}
