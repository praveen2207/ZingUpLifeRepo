<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * This class for Assessment users listing for customer support
 * @author vadivel <vadivel@zinguplife.com>
 * Date:07-12-2016
 * error_reporting(E_ALL);
 * ini_set('display_errors', 1);
 */
class Assessment extends CI_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('Assessment_model');
    }
    //-------------------------------------------------------------------------------------------------
    public function interpretation_users() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $all_customers                  = $this->Assessment_model->get_all_interpretation_users();
            $data['all_customers']          = $all_customers;
            $gp_ids                         = GP_IDS; 
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['added_slots']            = $this->Assessment_model->getGPsaddedslots($gp_ids);
            $data['url']                    = 'customer_support/customers';
            $data['title']                  = 'Zingup Assessment Users';
            $data['main_content']           = 'admin/assessment/interpretation_users';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    //-----------------------------------------------------------------------------------------------------
    public function consultation_users() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $all_customers                  = $this->Assessment_model->get_all_consultation_users();
            $data['all_customers']          = $all_customers;
            $sme_userid                     = 155;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url']                    = 'customer_support/customers';
            $data['title']                  = 'Zingup Assessment Users';
            $data['main_content']           = 'admin/assessment/consultation_users';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }
    //-------------------------------------------------------------------------------------------------
    public function user_filter_search() {
        $data = $this->input->post();
        $result = $this->Assessment_model->get_customer_search($data);
        echo json_encode($result);
    }
    //-------------------------------------------------------------------------------------------------
    //Last Update 13-12-2016 by VN
    public function get_gp_slot(){
        $data = $this->input->post();
        $gp_ids = GP_IDS; 
        $res = $this->Assessment_model->getGPSlot($data['seldate'],$gp_ids);
        if($res){
                $data['res'] = $this->Assessment_model->getGPSlot($data['seldate'],$gp_ids);
                $data=$this->load->view('admin/assessment/add_sme_slots',$data, TRUE);
                return $this->output
                ->set_header("HTTP/1.0 200 OK")
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
        }
        else{
            echo json_encode($res);
        }
    }    
    //----------------------------------------------------------------------------------------------------
    public function get_available_gps(){
        $gp_ids =  GP_IDS; ; 
        $data = $this->input->post();
        $res = $this->Assessment_model->getAvaliableGPS($data['id'],$gp_ids);
        if($res){
            $data['res'] = $this->Assessment_model->getAvaliableGPS($data['id'],$gp_ids);
            $data=$this->load->view('admin/assessment/select_gps',$data, TRUE);
            return $this->output
            ->set_header("HTTP/1.0 200 OK")
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
        }
    }
    //----------------------------------------------------------------------------------------------------
    public function user_book_slot(){
         $data = $this->input->post();
         $this->Assessment_model->userBookSlot($data);
         echo json_encode(true);
    }
    //----------------------------------------------------------------------------------------------------
    public function update_assessment_users(){
         $this->Assessment_model->UpdateSurveyHistroy();
         echo json_encode(true);
    }
    //----------------------------------------------------------------------------------------------------
    
}
