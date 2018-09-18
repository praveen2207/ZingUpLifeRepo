<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for Vendors listing, filter vendors by services and vendor's details
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:03-09-2015
 * */
class Vendors extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Vendor');
    }

    /*
     *  Displaying login form 
     */

    public function customer_support_vendors() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $all_vendors = $this->Vendor->get_all_vendors();
            $data['service_type'] = 'all';
            $data['all_vendors'] = $all_vendors;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['locations'] = $this->Vendor->get_locations();
            $data['title'] = 'Zingup Customer Support | Vendors';
            $data['main_content'] = 'admin/customer_support_vendors';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Displaying login form 
     */

    public function customer_support_vendors_filter() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $service_category = $this->uri->segment(3);
            $all_vendors = $this->Vendor->get_vendors_by_service($service_category);

            $data['service_type'] = $service_category;
            $data['all_vendors'] = $all_vendors;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['title'] = 'Zingup Customer Support | Vendors';
            $data['main_content'] = 'admin/customer_support_vendors';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying search result
     */

    public function customer_support_vendors_search_filter() {
        $data = $this->input->post();
        if ($data['category'] == '') {
            $service_type = 'all';
        } else {
            $service_type = $data['category'];
        }
        $result = $this->Vendor->get_vendors_search($service_type, $data);
        echo json_encode($result);
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function customer_support_vendors_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $vendor_id = $this->uri->segment(3);
            $this->load->model('Services');
            $data['services'] = $this->Services->get_services_list();
            $vendor_details = $this->Vendor->get_vendors_details_and_transactions($vendor_id);

            $data['vendor_details'] = $vendor_details;
            $data['vendor_id'] = $vendor_id;
            $data['vendor_id'] = $vendor_details['vendor_details']->business_id;
            $data['business_id'] = $vendor_id;
            $data['sub_url'] = 'customer_support/business_info';
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['title'] = 'Zingup Customer Support | Vendor Details';
            $data['main_content'] = 'admin/customer_support_vendor_details';
            $this->load->view('admin/includes/cs_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Displaying login form 
     */

    public function finance_vendors() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $all_vendors = $this->Vendor->get_all_vendors();
            $data['service_type'] = 'all';
            $data['all_vendors'] = $all_vendors;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'finance/vendors';
            $data['title'] = 'Zingup Finance | Vendors';
            $data['main_content'] = 'admin/finance_vendors';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function finance_vendors_filter() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $service_category = $this->uri->segment(3);
            $all_vendors = $this->Vendor->get_vendors_by_service($service_category);

            $data['service_type'] = $service_category;
            $data['all_vendors'] = $all_vendors;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'finance/vendors';
            $data['title'] = 'Zingup Finance | Vendors';
            $data['main_content'] = 'admin/finance_vendors';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function finance_vendors_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $vendor_id = $this->uri->segment(3);
            $this->load->model('Services');
            $data['services'] = $this->Services->get_services_list();
            $vendor_details = $this->Vendor->get_vendors_details_and_transactions($vendor_id);
            $data['vendor_details'] = $vendor_details;
            $data['vendor_id'] = $vendor_id;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'finance/vendors';
            $data['title'] = 'Zingup Finance | Vendor Details';
            $data['main_content'] = 'admin/finance_vendor_details';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Displaying login form 
     */

    public function batch_payment_for_vendor() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $vendor_id = $this->uri->segment(3);
            $vendor_payment_details = $this->Vendor->get_vendors_details_and_transactions($vendor_id);
            $data['vendor_details'] = $vendor_payment_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'finance/vendors';
            $data['title'] = 'Zingup Finance | Vendor Batch Payments';
            $data['main_content'] = 'admin/vendor_batch_payments';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function batch_payment_details_for_vendor() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $vendor_id = $this->uri->segment(3);
            $date_range = $this->uri->segment(4);
            $date = explode('_', $date_range);
            $start_date = $date[0];
            $end_date = $date[1];

            $vendor_payment_details = $this->Vendor->get_vendors_transactions_by_date_range($vendor_id, $start_date, $end_date);

            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['vendor_details'] = $vendor_payment_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'finance/vendors';
            $data['title'] = 'Zingup Finance | Vendor Batch Payments';
            $data['main_content'] = 'admin/vendor_batch_payments_details';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Displaying login form 
     */

    public function admin_vendors() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $all_vendors = $this->Vendor->get_all_vendors();
            $data['locations'] = $this->Vendor->get_locations();
            $data['service_type'] = 'all';
            $data['all_vendors'] = $all_vendors;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['title'] = 'Zingup Admin | Vendors';
            $data['main_content'] = 'admin/admin_vendors';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  Displaying login form 
     */

    public function admin_vendors_filter() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $service_category = $this->uri->segment(3);
            $all_vendors = $this->Vendor->get_vendors_by_service($service_category);

            $data['service_type'] = $service_category;
            $data['all_vendors'] = $all_vendors;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['title'] = 'Zingup Admin | Vendors';
            $data['main_content'] = 'admin/admin_vendors';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function admin_vendors_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $vendor_id = $this->uri->segment(3);
            $data['current_date'] = date("Y/m/d");
            $data['end_date'] = date('Y/m/d', strtotime('-30 days'));
            $end_date = $data['current_date'];
            $start_date = $data['end_date'];
            $this->load->model('Services');
            $data['services'] = $this->Services->get_services_list();

            $data['start_date'] = $end_date;
            $data['end_date'] = $start_date;
            $vendor_details = $this->Vendor->get_vendors_details_and_transactions_for_admin($vendor_id, $start_date, $end_date);
            $data['vendor_id'] = $vendor_id;
            $data['business_id'] = $vendor_id;
            $data['vendor_details'] = $vendor_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'admin/business_info';
            $data['title'] = 'Zingup Admin | Vendor Details';
            $data['main_content'] = 'admin/admin_vendor_details';
            $this->load->view('admin/includes/admin_vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Function to delete vendor data in database
     */

    public function delete_vendor() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->Vendor->delete_vendor($post_data['vendor_id']);
        return true;
    }

    /* Above function ends here */

    /*
     *  Function to delete vendor data in database
     */

    public function update_vendor_notes() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->Vendor->update_vendor_notes($post_data);
        return true;
    }

    /* Above function ends here */

    /*
     *  Displaying search result
     */

    public function admin_vendors_search_filter() {
        $data = $this->input->post();
        if ($data['category'] == '') {
            $service_type = 'all';
        } else {
            $service_type = $data['category'];
        }
        $result = $this->Vendor->get_vendors_search($service_type, $data);
        echo json_encode($result);
    }

    /* Above function ends here */

    /*
     *  customer details transactions table  filter
     */

    public function vendor_transactions_sorting() {
        $data = $this->input->post();
        $result = $this->Vendor->filter_vendors_details_and_transactions_for_admin($data);
        echo json_encode($result);
    }

    /*
     *  customer details transactions table  filter
     */

    public function cs_vendor_transactions_sorting() {
        $data = $this->input->post();
        $result = $this->Vendor->filter_vendors_details_and_transactions_for_cs($data);
        echo json_encode($result);
    }

    /*
     *  Displaying search result
     */

    public function finance_vendors_search_filter() {
        $data = $this->input->post();
        if ($data['category'] == '') {
            $service_type = 'all';
        } else {
            $service_type = $data['category'];
        }
        $result = $this->Vendor->get_vendors_search($service_type, $data);
        echo json_encode($result);
    }

    /* Above function ends here */

    /*
     *  customer details transactions table  filter
     */

    public function finance_vendor_transactions_sorting() {
        $data = $this->input->post();
        $result = $this->Vendor->filter_vendors_details_and_transactions_for_finance($data);
        echo json_encode($result);
    }

    /*
     *  Function to delete vendor data in database
     */

    public function update_vendor_status() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->Vendor->update_vendor_status($post_data);
        return true;
    }

    /* Above function ends here */


    /*
     *  Function to register partner
     */

    public function partner_registration() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['title'] = "Zinguplife Customer Support|Partner Registration";
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'customer_support/vendors';
            $data['services'] = $this->Vendor->get_business_services();
            $data['main_content'] = 'admin/partner_registration';
            $data['locations'] = $this->Vendor->get_locations();
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
            $this->form_validation->set_rules('zipcode', 'zipcode', 'required');
            $this->form_validation->set_rules('mobile', 'mobile', 'required');
            $this->form_validation->set_rules('business_email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('check', 'Check box', 'callback_accept_terms');

            $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
            if ($this->form_validation->run() == FALSE) {
                $data['services'] = $this->Vendor->get_business_services();
                $data['locations'] = $this->Vendor->get_locations();
                $data['main_content'] = 'admin/partner_registration';
                $this->load->view('admin/includes/template', $data);
            } else {
                $validate_details = $this->Vendor->get_partner_details_by_username($post_data['username']);

                if (!empty($validate_details)) {


                    $data['services'] = $this->Vendor->get_business_services();
                    $data['locations'] = $this->Vendor->get_locations();
                    $this->session->set_flashdata('validate_email_error_message', 'Email Already Registered with Zinguplife');
                    $data['main_content'] = 'admin/partner_registration';
                    $this->load->view('admin/includes/template', $data);
                } else {

                    $this->Vendor->add_partner_registrations($post_data);
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
     *  Function to edit partner
     */


    /*
     *  Function to edit business information
     */

    public function business_information() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['title'] = "Zinguplife Customer Support|Business information";
            $data['url'] = 'customer_support/vendors';
            $data['logged_in_user_details'] = $logged_in_user_details;
            $vendor_id = $this->uri->segment(3);
            $data['business_info'] = $this->Vendor->get_vendor_business_details($vendor_id);

            $data['locations'] = $this->Vendor->get_locations();
            $data['main_content'] = 'admin/business_information';
            $this->load->view('admin/includes/template', $data);
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
            $data['logged_in_user_details'] = $logged_in_user_details;
            $areaid_name = explode('/', $post_data['area']);
            $area_name = $areaid_name[1];
            if ($_FILES['userfile']['name'] != '') {
                unlink("assets/uploads/business_providers/logo/" . $post_data['vendor_id'] . "/" . $post_data['old_logo']);
                if (!is_dir('assets/uploads/business_providers/logo/' . $post_data['vendor_id'] . '/')) {
                    mkdir('assets/uploads/business_providers/logo/' . $post_data['vendor_id'] . '/', 0777, TRUE);
                }
                $logopath = './assets/uploads/business_providers/logo/' . $post_data['vendor_id'] . '/';
                $logofile = $_FILES['userfile']['name'];

                $logoname = $post_data['business_name'] . "_" . $area_name . "_" . $logofile;
                $logo_name = $post_data['business_name'] . "_" . $area_name . "_" . $_FILES['userfile']['name'];
                copy($_FILES['userfile']['tmp_name'], $logopath . $logoname);
            } else {

                $logo_name = $post_data['old_logo'];
            }

            if (!is_dir('assets/uploads/business_providers/gallery/' . $post_data['id'] . '/')) {
                mkdir('assets/uploads/business_providers/gallery/' . $post_data['id'] . '/', 0777, TRUE);
            }
            $path = './assets/uploads/business_providers/gallery/' . $post_data['id'] . '/';
            $file = $_FILES['file']['name'];
            $count = count($file);
            {
                if ($count > 0) {
                    for ($i = 0; $i < $count; $i++) {
                        if ($_FILES['file']['name'][$i]) {
                            $fname = $post_data['business_name'] . "_" . $area_name . "_" . $file[$i];

                            copy($_FILES['file']['tmp_name'][$i], $path . $fname);
                            $image_name = $post_data['business_name'] . "_" . $area_name . "_" . $_FILES['file']['name'][$i];
                            $this->Vendor->insert_business_gallery($post_data['id'], $image_name);
                        }
                    }
                }
                $this->Vendor->update_business_information($post_data, $logo_name);
                $this->session->set_flashdata('business_info_success_message', 'Information Updated Successfully');
                redirect('/customer_support/business_information/' . $post_data['vendor_id']);
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     * Function for deleting business gallery images
     */

    public function delete_business_gallery_image() {

        $post_data = $this->input->post();
        $data['result'] = $this->Vendor->delete_business_gallery($post_data);
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
            $data['business_id'] = $vendor_id;
            $data['packages'] = $this->Vendor->get_existing_packages($vendor_id);
            $data['main_content'] = 'admin/packages_treatments_listing';
            $this->load->view('admin/includes/template', $data);
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
            $data['packages'] = $this->Vendor->get_existing_packages($vendor_id);

            $data['main_content'] = 'admin/add_packages_service';
            $this->load->view('admin/includes/template', $data);
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
            $data['programs'] = $this->Vendor->insert_business_programs($post_data);
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
            $files = $_FILES;
            $this->form_validation->set_rules('packages', 'Package', 'required');
            $this->form_validation->set_rules('service', 'Service', 'required');
            $this->form_validation->set_rules('duration', 'Duration', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
            $this->form_validation->set_rules('service_type', 'Service_type', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
            if ($this->form_validation->run() == FALSE) {
                $data['packages'] = $this->Vendor->get_existing_packages($post_data['business_id']);
                $data['business_id'] = $post_data['business_id'];
                $data['main_content'] = 'admin/add_packages_service';
                $this->load->view('admin/includes/template', $data);
            } else {
                $this->Vendor->insert_business_services($post_data, $files);
                $this->session->set_flashdata('business_service_success_message', 'Information Updated Successfully');
                redirect('/customer_support/adding_package_service/' . $post_data['business_id']);
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
            $data['result'] = $this->Vendor->delete_business_package($post_data);
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
            $data['url'] = 'customer_support/vendors';
            $data['packages'] = $this->Vendor->get_single_package_detail($package_id);
            $data['main_content'] = 'admin/business_package_edit';
            $this->load->view('admin/includes/template', $data);
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
            $this->Vendor->updating_business_programs($post_data);
            $this->session->set_flashdata('business_program_success_message', 'Updated Successfully');
            redirect('/customer_support/business_package_edit/' . $post_data['service_id']);
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
            $data['result'] = $this->Vendor->delete_business_service($post_data);
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
            $business_id = $this->uri->segment(3);
            $data['url'] = 'customer_support/vendors';
            $data['services'] = $this->Vendor->get_all_services_listing($business_id);
            $data['main_content'] = 'admin/business_services_list';
            $this->load->view('admin/includes/template', $data);
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
            $service_id = $this->uri->segment(3);
            $data['url'] = 'customer_support/vendors';
            $data['services'] = $this->Vendor->get_single_service_detail($service_id);
            $data['main_content'] = 'admin/business_service_edit';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */




    /*
     *  Function to register partner
     */

    public function add_vendor() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['services'] = $this->Vendor->get_business_services();
            $data['locations'] = $this->Vendor->get_locations();
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['title'] = 'Zingup Admin | Vendors';
            $data['main_content'] = 'admin/admin_add_vendor';
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

    public function do_vendor_registration() {
        $data['title'] = "Vendor Registration";
        $post_data = $this->input->post();

        $this->form_validation->set_rules('username', 'username', 'required|valid_email');
        $this->form_validation->set_rules('business_name', 'business_name', 'required');
        $this->form_validation->set_rules('address1', 'address', 'required');
        $this->form_validation->set_rules('zipcode', 'zipcode', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $this->form_validation->set_rules('business_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('payment_option', 'Payment Option', 'required');
        $this->form_validation->set_rules('check', 'Check box', 'callback_accept_terms');

        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        if ($this->form_validation->run() == FALSE) {
            $data['services'] = $this->Vendor->get_business_services();
            $data['locations'] = $this->Vendor->get_locations();
            $data['main_content'] = 'admin/admin_add_vendor';
            $this->load->view('admin/includes/template', $data);
        } else {
            $validate_details = $this->Vendor->get_partner_details_by_username($post_data['username']);
            if (!empty($validate_details)) {
                $data['services'] = $this->Vendor->get_business_services();
                $data['locations'] = $this->Vendor->get_locations();
                $this->session->set_flashdata('validate_email_error_message', 'Email Already Registered with Zinguplife');
                $data['main_content'] = 'admin/admin_add_vendor';
                $this->load->view('admin/includes/template', $data);
            } else {
                $this->session->set_flashdata('success_message', 'Vendor successfully added !!!.');
                $this->Vendor->add_partner_registrations($post_data);
                redirect("/admin/vendors");
            }
        }
    }

    /* Above function ends here */
    /*
     *  Displaying login form 
     */

    public function vendor_packages() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $vendor_details = $this->Vendor->get_vendors_details_and_transactions($id);
            $data['vendor_id'] = $id;
            $all_packages = $this->Vendor->get_all_packages_by_vendor($id);

            $data['all_packages'] = $all_packages;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'vendor_packages';
            $data['title'] = 'Zingup Admin | Vendor Packages';
            $data['main_content'] = 'admin/admin_vendor_packages';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Function to register partner
     */

    public function add_new_package() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $vendor_details = $this->Vendor->get_vendors_details_and_transactions($id);
            $vendor_id = $vendor_details['vendor_details']->business_id;
            $data['mapping'] = $this->Vendor->get_partner_services_mapping($vendor_id);
            $data['id'] = $id;
            $data['vendor_id'] = $id;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'vendor_packages';
            $data['title'] = 'Zingup Admin |Add Vendor Packages';
            $data['main_content'] = 'admin/admin_add_vendor_packages';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     * Function for partner registration
     */

    public function create_new_package() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        $id = $post_data['id'];
        if ($this->form_validation->run() == FALSE) {

            $vendor_details = $this->Vendor->get_vendors_details_and_transactions($id);
            $vendor_id = $vendor_details['vendor_details']->business_id;
            $data['mapping'] = $this->Vendor->get_partner_services_mapping($vendor_id);
            $data['id'] = $id;
            $data['vendor_id'] = $id;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'vendor_packages';
            $data['title'] = 'Zingup Admin |Add Vendor Packages';
            $data['main_content'] = 'admin/admin_add_vendor_packages';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->Vendor->add_packages($post_data);
            $this->session->set_flashdata('success_message', 'Successfully added !!!.');
            redirect("/admin/vendor_packages/" . $id . "");
        }
    }

    /* Above function ends here */

    function delete_package() {
        $id = $this->input->post('id');
        $this->Vendor->delete_package($id);
        echo json_encode('success');
    }

    /* Above function ends here */

    /*
     *  Function to register partner
     */

    public function edit_package() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $program_id = $this->uri->segment(3);
            $package_details = $this->Vendor->get_package_details($program_id);
            $vendor_id = $package_details->partner_id;
            $data['mapping'] = $this->Vendor->get_partner_services_mapping($vendor_id);
            $data['id'] = $program_id;
            $data['vendor_id'] = $package_details->business_id;
            $data['program_id'] = $program_id;
            $data['package_details'] = $package_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'vendor_packages';
            $data['title'] = 'Zingup Admin |Edit Vendor Packages';
            $data['main_content'] = 'admin/admin_edit_vendor_packages';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     * Function for partner registration
     */

    public function update_package() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->form_validation->set_rules('package_name', 'package_name', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        $vendor_id = $post_data['vendor_id'];
        $program_id = $post_data['program_id'];
        if ($this->form_validation->run() == FALSE) {
            $package_details = $this->Vendor->get_package_details($vendor_id);
            $vendor_id = $package_details->partner_id;
            $data['mapping'] = $this->Vendor->get_partner_services_mapping($vendor_id);
            $data['id'] = $vendor_id;
            $data['program_id'] = $program_id;
            $data['package_details'] = $package_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'vendor_packages';
            $data['title'] = 'Zingup Admin |Edit Vendor Packages';
            $data['main_content'] = 'admin/admin_edit_vendor_packages';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->Vendor->update_package($post_data);
            $this->session->set_flashdata('success_message', 'Successfully updated !!!.');
            redirect("/admin/vendor_packages/" . $vendor_id . "");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function offering_services() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $vendor_details = $this->Vendor->get_vendors_details_and_transactions($id);
            $data['id'] = $id;
            $vendor_id = $vendor_details['vendor_details']->business_id;
            $data['vendor_id'] = $id;
            $all_offerings = $this->Vendor->get_all_offerings_by_vendor($id);
            $data['all_offerings'] = $all_offerings;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'offering_services';
            $data['title'] = 'Zingup Admin | Vendor Offerings';
            $data['main_content'] = 'admin/admin_vendor_offerings';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Function to register partner
     */

    public function add_new_offerings() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $data['id'] = $id;
            $all_packages = $this->Vendor->get_all_packages_by_vendor($id);

            $data['all_packages'] = $all_packages;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'offering_services';
            $data['title'] = 'Zingup Admin | Vendor Offerings';
            $data['main_content'] = 'admin/admin_add_offerings';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     * Function for partner registration
     */

    public function create_offerings() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $data['title'] = 'Zingup Admin | Vendor Offerings';
        $post_data = $this->input->post();
        $this->form_validation->set_rules('program_id', 'Program', 'required');
        $this->form_validation->set_rules('services', 'Service', 'required');
        $this->form_validation->set_rules('duration_hour', 'Hours', 'required');
        $this->form_validation->set_rules('duration_minutes', 'Minutes', 'required');
        $this->form_validation->set_rules('price', 'Price   ', 'required');
        $this->form_validation->set_rules('service_type', 'Booking Type', 'required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        $vendor_id = $post_data['vendor_id'];

        if ($this->form_validation->run() == FALSE) {
            $data['id'] = $vendor_id;
            $all_packages = $this->Vendor->get_all_packages_by_vendor($vendor_id);
            $data['all_packages'] = $all_packages;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'offering_services';
            $data['title'] = 'Zingup Admin | Vendor Offerings';
            $data['main_content'] = 'admin/admin_add_offerings';
        } else {
            $this->Vendor->add_offerings($post_data);
            $this->session->set_flashdata('success_message', 'Successfully added !!!.');
            redirect("/admin/offering_services/" . $vendor_id . "");
        }
    }

    /* Above function ends here */

    function delete_offerings() {
        $id = $this->input->post('id');
        $this->Vendor->delete_offerings($id);
        echo json_encode('success');
    }

    /* Above function ends here */

    /*
     *  Function to register partner
     */

    public function edit_offering() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $offering_details = $this->Vendor->get_offering_details($id);
            $vendor_id = $offering_details->business_id;
            $business_id = $offering_details->id;
            $all_packages = $this->Vendor->get_all_packages_by_vendor($vendor_id);
            $data['id'] = $id;
            $data['vendor_id'] = $vendor_id;
            $data['all_packages'] = $all_packages;
            $data['offering_details'] = $offering_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'offering_services';
            $data['title'] = 'Zingup Admin | Vendor Offerings';
            $data['main_content'] = 'admin/admin_edit_offerings';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */



    /*
     * Function for partner registration
     */

    public function update_offering() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $data['title'] = 'Zingup Admin | Vendor Offerings';
        $post_data = $this->input->post();
        $this->form_validation->set_rules('program_id', 'program_id', 'required');
        $this->form_validation->set_rules('services', 'services', 'required');
        $this->form_validation->set_rules('duration_hour', 'Hours', 'required');
        $this->form_validation->set_rules('duration_minutes', 'Minutes', 'required');
        $this->form_validation->set_rules('price', 'price   ', 'required');
        $this->form_validation->set_rules('service_type', 'service_type', 'required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        $data['id'] = $post_data['service_id'];
        $vendor_id = $post_data['vendor_id'];

        $data['vendor_id'] = $post_data['vendor_id'];
        if ($this->form_validation->run() == FALSE) {

            $all_packages = $this->Vendor->get_all_packages_by_vendor($vendor_id);
            $data['all_packages'] = $all_packages;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'offering_services';
            $data['title'] = 'Zingup Admin | Vendor Offerings';
            $data['main_content'] = 'admin/admin_edit_offerings';
        } else {
            $this->Vendor->update_offerings($post_data);
            $this->session->set_flashdata('success_message', 'Successfully updated !!!.');
            redirect("/admin/offering_services/" . $vendor_id . "");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function business_hours() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $offering_details = $this->Vendor->get_offering_details($id);
            $vendor_id = $offering_details->business_id;
            $data['vendor_id'] = $vendor_id;
            $data['id'] = $id;
//            echo "<pre>";
//            print_r($offering_details);
//            //print_r($slots);
//            exit();
            $slots = $this->Vendor->service_slots($id);
//            echo "<pre>";
//            print_r($offering_details);
//            print_r($slots);
//            exit();
            $data['slots_details_array'] = $slots;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'business_hours';
            $data['title'] = 'Zingup Admin |Offering Business Hours';
            $data['main_content'] = 'admin/admin_business_hours';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Function to register partner
     */

    public function add_business_hours() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $data['id'] = $id;
            $offering_details = $this->Vendor->get_offering_details($id);
            $vendor_id = $offering_details->id;
            $data['vendor_id'] = $vendor_id;
            $data['offering_details'] = $offering_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'business_hours';
            $data['title'] = "Zingup Admin | Offering's Business Hours";
            $data['main_content'] = 'admin/admin_add_slots';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     * Function for partner registration
     */

    public function create_slots() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $data['title'] = 'Zingup Admin | Vendor Offerings';
        $post_data = $this->input->post();
        echo "<pre>";
        print_r($post_data);
        exit();
        $this->form_validation->set_rules('program_id', 'program_id', 'required');
        $this->form_validation->set_rules('services', 'services', 'required');
        $this->form_validation->set_rules('duration', 'duration', 'required');
        $this->form_validation->set_rules('price', 'price   ', 'required');
        $this->form_validation->set_rules('service_type', 'service_type', 'required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');
        $vendor_id = $post_data['vendor_id'];

        if ($this->form_validation->run() == FALSE) {
            $data['id'] = $vendor_id;
            $all_packages = $this->Vendor->get_all_packages_by_vendor($vendor_id);
            $data['all_packages'] = $all_packages;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'offering_services';
            $data['title'] = 'Zingup Admin | Vendor Offerings';
            $data['main_content'] = 'admin/admin_add_offerings';
        } else {
            $this->Vendor->add_offerings($post_data);
            redirect("/admin/offering_services/" . $vendor_id . "");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function view_offerings_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $offering_details = $this->Vendor->get_offering_details($id);

            $vendor_id = $offering_details->id;
            $data['vendor_id'] = $vendor_id;
            $data['id'] = $id;
            $gallery = $this->Vendor->offering_gallery($id);
            $data['gallery'] = $gallery;
            $data['service_gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'offering_services';
            $data['title'] = 'Zingup Admin |Offering Business Hours';
            $data['main_content'] = 'admin/admin_offerings_gallery';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Function to register partner
     */

    public function add_offerings_gallery() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $id = $this->uri->segment(3);
            $offering_details = $this->Vendor->get_offering_details($id);

            $vendor_id = $offering_details->id;
            $data['vendor_id'] = $vendor_id;
            $data['id'] = $id;
            $gallery = $this->Vendor->offering_gallery($id);
            $data['gallery'] = $gallery;
            $data['service_gallery_path'] = base_url() . $this->config->item('business_services_gallery_path');
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/vendors';
            $data['sub_url'] = 'offering_services';
            $data['title'] = 'Zingup Admin |Offering Gallery';
            $data['main_content'] = 'admin/admin_add_offerings_gallery';
            $this->load->view('admin/includes/vendor_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */

    /*
     *  Displaying login form 
     */

    public function offerings_search() {
        $search_data = $this->input->post();
        $result = $this->Vendor->offerings_filter($search_data);
        echo json_encode($result);
    }

    /* Above function ends here */
}
