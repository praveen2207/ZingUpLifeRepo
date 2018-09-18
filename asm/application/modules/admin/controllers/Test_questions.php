<?php

/* 
 * Created By : Vadivel N
 * Created Date : 12 JAN, 2017
 * Description : Manage Assessments
 */
class Test_questions extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('Test_questions_model');
    }
    
    public function index(){
        $data = array(); 
        $data['tests_list']         = $this->Test_questions_model->get_test_list();
        //$data['dimension_list']    = $this->Test_questions_model->get_dimension_list();
        $test_id                    = $this->uri->segment(4);
        //$dimension_id               = $this->uri->segment(5);
        $data['test_id']            = $test_id;
       // $data['dimension_id']       = $dimension_id;
        if($test_id!=''){
            $data['questions_list'] =$this->Test_questions_model->test_questions_list($test_id); 
        }
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    
    public function save_mapping() {         
        $test_id        = $this->input->post('test_id'); 
        $question_list  = $this->input->post('questionid'); 
        $this->Test_questions_model->delete($test_id);
        if(count($question_list)>=1){ 
            $data = array();          
            foreach($question_list as $key => $values)
            {
                $order_numer = $this->input->post('order_'.$values);
                $data['test_id']            = $test_id;
                $data['question_weightage'] = $order_numer;
                $data['question_id']        = $values;
                $data['mapped_on']          =  date('Y-m-d H:i:s');
                $dimention_id               = $this->input->post('dimension_'.$values);
                $data['dimension_id']       = $dimention_id;
                $this->Test_questions_model->test_questions_map_insert($data); 
            }
           
            $data['message'] = $this->session->flashdata('message');
        }
        redirect(BASE_MODULE_URL . 'test_questions/index/'.$test_id,'refresh');
    }
    
}
