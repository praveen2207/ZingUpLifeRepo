<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for cutomer support section login and users actions/activities
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:01-09-2015
 * */
class Events extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Event_service_model');
   	}
   
    public function get_users_event_detail(){
    	$logged_in_user_details = $this->session->userdata('logged_in_user_data');
    	if ($logged_in_user_details->is_logged_in == 1) {
    		$post_data=$this->input->post();
    		if($post_data==0){
    			$event_type='';
    			$user_name='';
    			$from_date='';
    			$to_date='';
    		}else{
    			$event_type=$post_data['event_type'];
    			$user_name=$post_data['user_name'];
    			$date=explode(',',$post_data['selected_date']);
    			$from_date=$date[0];
    			$to_date=$date[1];
    		}
    		$defullt_date=date("Y-m-d");
    		$data['event_details'] = $this->Event_service_model->get_users_event_detail($from_date,$to_date,$user_name,$event_type);
    		
    		if($from_date!='' && $to_date!=''){
    			$data['dates']=date('F  d, Y',strtotime($from_date)).' - '.date('F  d, Y',strtotime($to_date));
    			$data['idate']=date('Y-m-d',strtotime($from_date)).','.date('Y-m-d',strtotime($to_date));
    		}else{
    			$data['dates']=date('F  d, Y',strtotime($defullt_date)).' - '.date('F  d, Y',strtotime($defullt_date));
    			$data['idate']=date('Y-m-d',strtotime($defullt_date)).','.date('Y-m-d',strtotime($defullt_date));
    		}
    		
    		if($post_data['user_name']!=''){
    			$data['user_name']=$post_data['user_name'];
    		}
    		
    		if($post_data['event_type']!=''){
    			$data['event_type']=$post_data['event_type'];
    		}
    		
	    	//print_r($data['event_details']); exit;
	    	$data['logged_in_user_details'] = $logged_in_user_details;
	    	$data['url']="admin/Events/get_users_event_detail";
	    	$data['title'] = 'Zingup Events | Events_detail';
	    	$data['main_content'] = 'admin/events_view';
	    	$this->load->view('admin/includes/template', $data);
    	} else {
    		$this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
    		redirect("/admin");
    	}
    }
}