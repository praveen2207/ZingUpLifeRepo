<?php

/* 
 * Created By : Vadivel N
 * Created Date : 12 JAN, 2017
 * Description : Manage Assessments
 */
class Sub_theme_test_weightage extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('sub_theme_test_weightage_model');
    }
    
    public function index(){
        $data = array(); 
        $this->load->model('theme_model');
	$data['theme_data'] = $this->theme_model->get_all();
        $data['record']['theme_id'] = '' ;           
        $data['tests_list']         = $this->sub_theme_test_weightage_model->get_test_list();
        $theme_id                   = $this->uri->segment(4);
        $test_id                    = $this->uri->segment(5);
        $data['theme_id']           = $theme_id;
        $data['test_id']            = $test_id;
        if($test_id!=''){
            $data['sub_theme_list'] =$this->sub_theme_test_weightage_model->test_sub_theme_list($test_id,$theme_id); 
            //echo "<pre>";print_r($data['sub_theme_list']);
        }
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    
    public function save_mapping() {         
        $test_id        = $this->input->post('test_id'); 
        $theme_id       = $this->input->post('theme_id'); 
        $sub_theme_list  = $this->input->post('subthemeid'); 
        $this->sub_theme_test_weightage_model->delete($test_id);
        if(count($sub_theme_list)>=1){ 
            $data = array();          
            foreach($sub_theme_list as $key => $values)
            {
                $data['test_id']        = $test_id;
                $weightage              = $this->input->post('order_'.$values);
                $data['sub_theme_id']   = $values;
                $data['mapped_on']      =  date('Y-m-d H:i:s');
                $data['weightage']      =  $weightage;
                //echo "<pre>"; print_r($data);
                $this->sub_theme_test_weightage_model->test_sub_theme_map_insert($data); 
            }
            
            $data['message'] = $this->session->flashdata('message');
        }
        redirect(BASE_MODULE_URL . 'sub_theme_test_weightage/index/'.$theme_id.'/'.$test_id,'refresh');
    }
    public function load_lelvels($theme_id){
        $this->load->model('test_model');
        $data=$this->test_model->get_theme_levels($theme_id);
        print_r(json_encode($data));  
    }
}
