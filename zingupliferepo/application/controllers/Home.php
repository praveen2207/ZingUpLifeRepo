<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
/**
 * This class for home page of the website or landing page of the  website
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:04-08-2015
 * */
class Home extends CI_Controller {
    /*
     * Function for displaying  home page of the website or landing page of the  website
     */
    public function __construct() {
        parent:: __construct();
        $this->load->model('Service_client');
        $this->load->library('encryption');
        $this->load->model('Org_access_code_model');
    }
    public function index() {
        
         $get_data=$_GET;
         $company_logo=$this->Org_access_code_model->get_org_logo($get_data["company_name"]);
         $org_logo=$company_logo[0]->org_logo;
         
         if($org_logo){
             $this->input->set_cookie("org_assessment",true,"86400");
             $data["org_assessment"]=$this->input->cookie("org_assessment");
             $data["org_logo"]=$org_logo;
         }else{
             delete_cookie("org_assessment");
         }
         //To get Init Assessments
        $api_url            = base_url().'api/assessments?type=init';
        $data['assessments']  = $this->Service_client->getAssessmentsAPI($api_url);
	if(isset($data['assessments'][0])){
            $data['assessment_1'] = $data['assessments'][0];
           //print_r($data['assessment_1']);
            $data['assessment_1_theme_id'] = $data['assessment_1']['theme_id'];
            $data['assessment_1_level_id'] = $data['assessment_1']['level_id'];
        }
        if(isset($data['assessments'][1])){
            $data['assessment_2'] = $data['assessments'][1];
            $data['assessment_2_theme_id'] = $data['assessment_2']['theme_id'];
            $data['assessment_2_level_id'] = $data['assessment_2']['level_id'];
        }
        if(isset($data['assessments'][2])){
            $data['assessment_3'] = $data['assessments'][2];
            $data['assessment_3_theme_id'] = $data['assessment_3']['theme_id'];
            $data['assessment_3_level_id'] = $data['assessment_3']['level_id'];
        }
        if(isset($data['assessments'][3])){
            $data['assessment_4'] = $data['assessments'][3];
            $data['assessment_4_theme_id'] = $data['assessment_4']['theme_id'];
            $data['assessment_4_level_id'] = $data['assessment_4']['level_id'];
        }
        //exit;
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        if(!($data['logged_in_user_data'])){
            $this->session->unset_userdata('surveyuserid');
            $this->session->unset_userdata('survey_data');
            $this->session->unset_userdata('surveytempuser');
            $this->session->unset_userdata('promocode');
            $this->session->unset_userdata('pagevisitorid');
            $this->session->unset_userdata('surveycookieid');
        }else{
            $this->load->model('User');
            $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
            $userid = $data['logged_in_user_data']->user_id;
            $checkuserattempted = $this->User->checkUserAttempted($userid); 
            if($checkuserattempted)
            {
                    $data['test'] = 'new';
            }
            else if($checkuserattempted == 'new')
            {

                    $data['test'] = 'new';
            }
            else{
                    $pid = $this->User->getPage($userid);
                    $this->session->set_userdata('pagevisitorid',$pid);
                    $this->session->set_userdata('surveyuserid',$userid);
                    $data['test'] = 'old';
            }
        }
        if($this->session->userdata('country')){
        }else{
            $this->session->set_userdata('country','india');
            $this->session->set_userdata('place','bangalore'); 
        }
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $this->load->model('Services');
        $this->load->model('Sme_user');
        $data['services'] = $this->Services->get_services_list();
        $data['services_image_path'] = base_url() . $this->config->item('services_image_path');
        $data['sme_user'] = $this->Sme_user->get_sme_users_for_home_page();
        $data['title'] = "ZingUpLife | Home";
        $data['main_content'] = 'new_home';
        $data['active_url'] = 'home_page';
        
       
            $this->load->view('includes/new_menu_template', $data);
        
    }

    /* Above function ends here */

    /*
     * Function for displaying  home page of the website or landing page of the  website
     */

    public function coming_soon() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $this->load->model('Services');
        $data['services'] = $this->Services->get_services_list();
        $data['services_image_path'] = base_url() . $this->config->item('services_image_path');
        $data['title'] = "Coming Soon";
        $data['main_content'] = 'coming_soon';
        $this->load->view('includes/menu_template', $data);
    }

    /* Above function ends here */

    /*
     * Function for displaying  home page of the website or landing page of the  website
     */

    public function subscription() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $data['title'] = "Zingup Subscription";
        $this->load->view('subscription', $data);
    }

    /* Above function ends here */

    /*
     *  Validating user's credentials and sending reset password token to user 
     */

    public function subscription_success() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<span for="email" generated="true" class="subscription_error">', '</span><br/>');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Zingup Subscription";
            $this->load->view('subscription', $post_data);
        } else {
            $this->load->model('User');
            $subscribe = $this->User->subscribe($post_data);
            $to = $post_data['email'];
            $from = "Zinguplife<info@zinguplife.com>";

            $subject = "ZingUpLife Subscription";
            $message = $this->load->view('emails/subscription_success', $post_data, true);

            // $message = "You have successfully subscribed Zinguplife";

            $this->Mailing->send_mail($to, $from, $subject, $message);

            $admin_to = 'Zinguplife<subscriptions@zinguplife.com>';
            $admin_from = $to;

            $admin_subject = "Zinguplife User Subscription";
            $admin_message = $post_data['email'] . " subscribed zinguplife";

            $this->Mailing->send_mail($admin_to, $admin_from, $admin_subject, $admin_message);
            $data['title'] = "Zingup Subscription Success";
            $this->load->view('subscription_success', $data);
        }
    }

    /* Above function ends here */
    /*
     * Function for displaying  home page of the website or landing page of the  website
     */

    public function home_page() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $this->load->model('Services');
        $data['services'] = $this->Services->get_services_list();
        $data['services_image_path'] = base_url() . $this->config->item('services_image_path');
        $data['title'] = "Home";
        $data['main_content'] = 'main_page';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     *  Validating user's credentials and sending reset password token to user 
     */

    public function subscribe() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo "email error";
        } else {
            $this->load->model('User');
            $subscribe = $this->User->subscribe($post_data);
            if ($subscribe == 'subscribed') {
                echo "subscribed";
            } else {
                $to = $post_data['email'];
                $from = "Zinguplife<info@zinguplife.com>";

                $subject = "Zinguplife Subscription";
                $message = $this->load->view('emails/subscription_success', $post_data, true);

                $this->Mailing->send_mail($to, $from, $subject, $message);

                $admin_to = 'Zinguplife<subscriptions@zinguplife.com';
                $admin_from = $to;

                $admin_subject = "Zinguplife User Subscription";
                $admin_message = $post_data['email'] . " subscribed zinguplife";

                $this->Mailing->send_mail($admin_to, $admin_from, $admin_subject, $admin_message);
                echo "success";
            }
        }
    }

    /* Above function ends here */
    /*
     * Function for displaying  home page of the website or landing page of the  website
     */

    public function review() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $review_code = $this->uri->segment(2);
        $this->load->model('Business');
        $review_details = $this->Business->review_and_rating_details($review_code);
        $data['review_code'] = $review_code;
        $data['title'] = "Review";
        $rating_details = $this->Business->get_review_details($review_code);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['review_details'] = $rating_details;
        if ($review_details->status == 'Done') {
            $data['main_content'] = 'already_rated';
        } else {

            $data['main_content'] = 'feedback';
        }
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */

    /*
     *  Validating user's credentials and sending reset password token to user 
     */

    public function review_submitted() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        $review_code = $this->uri->segment(2);
        $this->load->model('Business');
        $review_status = $this->Business->review_and_rating($post_data, $review_code);
        $rating_details = $this->Business->get_review_details($review_code);
        $data['logo_path'] = base_url() . $this->config->item('business_providers_logo_path');
        $data['review_details'] = $rating_details;
        $data['title'] = "Zingup Review Submitted";
        $data['main_content'] = 'review_success';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */


    /*
     * Function for displaying  home page of the website or landing page of the  website
     */

    public function ask_for_review() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $this->load->model('Business');
        $review_details = $this->Business->get_details_to_send_for_review();
        return true;
    }

    /* Above function ends here */

    /*
     * Function for displaying  corporate offerings
     */

//     public function workplace() {
//         $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
//         $this->User_activity->insert_user_activity();
//         $data['title'] = "ZingUpLife | Corporate Offerings";
//         $data['active_url'] = "workplace";
//         $data['main_content'] = 'workplaces';
//         $this->load->view('includes/workplaces_template', $data);
//     }

    public function workplace() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $data['title'] = "ZingUpLife | Corporate Offerings";
        $data['active_url'] = "workplace";
        $data['main_content'] = 'workplaces';
        $this->load->view('includes/workplaces_template', $data);
    }
    /* Above function ends here */

    
    public function workplace_offerings() {
        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $data['title'] = "ZingUpLife | Workplase Offerings";
        $data['active_url'] = "workplace";
        $data['main_content'] = 'workplace_offerings_two';
        $this->load->view('includes/workplaces_template', $data);
    }
    
    
    /*
     * Function for displaying  sitemap
     */
    
    public function sitemap() {
    	$data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
    	$this->User_activity->insert_user_activity();
    	$data['title'] = "ZingUpLife | Sitemap";
    	$data['active_url'] = "sitemap";
    	$data['main_content'] = 'sitemap';
    	$this->load->view('includes/template', $data);
    }
    
    /* Above function ends here */
    
 public function workplace_enquiry() {

        $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();

        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('number', 'Contact Number', 'required|numeric|xss_clean');
        $this->form_validation->set_rules('company', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Company Address', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<label for="name" generated="true" class="error">', '</label>');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "ZingUpLife | Corporate Offerings";
            $data['active_url'] = "workplace";
            $data['main_content'] = 'workplaces';
            $this->load->view('includes/workplaces_template', $data);
        } else {
            $data['post_data'] = $post_data;
            $email_content = $this->load->view('emails/workplace_enquiry', $data, true);

            $to = 'info@zinguplife.com';
            $from = "Zinguplife<info@zinguplife.com>";
            $mail_subject = "Zinguplife corporate offerings enquiry !!!";
            $message = $email_content;

            $this->Mailing->send_mail($to, $from, $mail_subject, $message);

            $this->session->set_flashdata('success_message', 'success');
            redirect("/workplace");
        }
    }
}
