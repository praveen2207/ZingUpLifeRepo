<?php
/* 
 * Created By : Vadivel N
 * Created Date : 23 JAN, 2017
 * Description : Setting up weightage based on sub_themes
 */
class Sub_theme_questions extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('sub_theme_questions_model');
    }
    
    public function index(){
        $data = array(); 
        $data['sub_theme_list'] = $this->sub_theme_questions_model->get_sub_theme_list();
        $theme_id               = $this->uri->segment(4);        
        $test_id                = $this->uri->segment(5);
        $sub_theme_id           = $this->uri->segment(6);
        $data['theme_id']       = $theme_id;
        $data['test_id']        = $test_id;
        $data['sub_theme_id']   = $sub_theme_id;
        $this->load->model('theme_model');
	$data['theme_data'] = $this->theme_model->get_all();
        $data['record']['theme_id'] = '' ;    
        $this->load->model('test_model');
	$data['test_data'] = $this->test_model->get_all();
        $data['record']['test_id'] = '' ;
        if($sub_theme_id!=''){
            $data['question_list'] =$this->sub_theme_questions_model->sub_theme_questions_list($sub_theme_id); 
        }
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    
    public function save_mapping() {         
        $sub_theme_id   = $this->input->post('sub_theme_id');
        $theme_id       = $this->input->post('theme_id'); 
        $test_id        = $this->input->post('test_id'); 
        $test_list        = $this->input->post('questionid'); 
        if(count($test_list)>=1){ 
            $data = array();       
            $data['sub_theme_id']   = $sub_theme_id;

            foreach($test_list as $key => $values)
            {
                $data['question_id']    = $values;
                $weightage              = $this->input->post('weightage_'.$values); 
                $data['question_weightage']      = $weightage;
                $this->sub_theme_questions_model->sub_theme_question_update($data); 
            }
            
            $data['message'] = $this->session->flashdata('message');
        }
        redirect(BASE_MODULE_URL . 'sub_theme_questions/index/'.$theme_id.'/'.$test_id.'/'.$sub_theme_id,'refresh');
    }
    public function load_sub_theme($test_id){
        $this->load->model('questions_model');
        $data=$this->questions_model->loadSubTheme($test_id);
        print_r(json_encode($data));  
    }
    public function load_lelvels($theme_id){
        $this->load->model('test_model');
        $data=$this->test_model->get_theme_levels($theme_id);
        print_r(json_encode($data));  
    }
}
