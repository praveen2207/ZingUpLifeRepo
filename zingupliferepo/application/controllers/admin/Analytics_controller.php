<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for customer support section login and users actions/activities
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:01-09-2015
 * */
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
class Analytics_controller extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Analytic_model');
    }
    /**
     * 
     * This mothod gets the uniques IP addresses that came to system for the first time.
     * It retricts the data to last 7 days.
     */
    public function page_visitors_view() {
	$logged_in_user_details = $this->session->userdata('logged_in_user_data');
	
	
	$data=$this->input->post();

	if (sizeof($data) ==0){ 				//when first time loading the page checking the post data are there or not
		$page_name= '';
		$from_date='';
		$to_date='';
		$default_date = date('Y-m-d');
	}else {
		$page_name=$data['url_pages'];
		$date=explode(',',$data['selected_date']);
		$from_date=$date[0];
		$to_date=$date[1];
		
	}
	$end_date= date('Y-m-d');
		
		if ($logged_in_user_details->is_logged_in == 1) { 		// Constructing the menu bar when user is logged in.
			//$end_date= date('Y-m-d', strtotime('-7 days'));		// getting the data for last seven days.
			
			$data['analyticlist']=$this->Analytic_model->getvisitors($end_date,$page_name,$from_date,$to_date);
			$data['pagenamelist']=$this->Analytic_model->getall_page_name();     //get all visited url page name
			$data['page_url']=$page_name;
			
				/*
				 * when loading page first time checking from date & to date
				 * if there is no from date & to then it will display current date 
				 */
				if($from_date!='' && $to_date!=''){
					$data['dates']=date('F  d, Y',strtotime($from_date)).' - '.date('F  d, Y',strtotime($to_date));
					$data['idate']=date('Y-m-d',strtotime($from_date)).','.date('Y-m-d',strtotime($to_date));
				}else{
					$data['dates']=date('F  d, Y',strtotime($default_date)).' - '.date('F  d, Y',strtotime($default_date));
					$data['idate']=date('Y-m-d',strtotime($default_date)).','.date('Y-m-d',strtotime($default_date));
				}	//end if from date and to date
				
			$data['title'] = 'Zingup Admin | Analytic';
			$data['logged_in_user_details'] = $logged_in_user_details;
			$data['url'] = 'admin/Analytics_controller/page_visitors_view';
			$data['main_content'] = 'admin/analytics_view';
			$this->load->view('admin/includes/template', $data);
			
		}//end if
    } //end page_visitors_view
    
 /**
     * 
     * This mothod gets the uniques IP addresses that came to system for the first time.
     * It retricts the data to last 7 days.
     */
   
    public function view_details(){
    	$data = $this->input->post();
        $data['res'] = $this->Analytic_model->get_details($data['ip_address'],$data['page_name'],$data['selected_date']);
        $data=$this->load->view('admin/add_details_data',$data, TRUE);
                return $this->output
                ->set_header("HTTP/1.0 200 OK")
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
    }
    
}




