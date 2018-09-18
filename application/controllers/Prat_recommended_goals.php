<?php


class Prat_recommended_goals extends CI_Controller {
    
    public function __construct() {
        parent:: __construct();
        $this->load->model('Prat_goals_model');
        if($this->session->userdata('country'))
        {
            
        }
        else{
            $this->session->set_userdata('country','india');
            $this->session->set_userdata('place','bangalore');
        }
        $this->load->model('User');
	}
	public function index(){
	    //echo 'test'; exit();
	    if($this->session->userdata('country'))
	    {
	        
	    }
	    else{
	        $this->session->set_userdata('country','india');
	        $this->session->set_userdata('place','bangalore');
	    }
	    $data['logged_in_user_data'] = $this->session->userdata('logged_in_user_data');
	    $data['goals'] = $this->Prat_goals_model->get_goals($data['logged_in_user_data']->user_id);
	    $data['title']='zinguplife |  Goals';
	    $data['active_url'] = 'goals';
	    $data['main_content'] = 'goals/includes/goal_list';
// 	    print_r($data['goals']);
// 	    die();
	    $this->load->view('goals/includes/goal_index', $data);
	}
}