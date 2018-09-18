<?php
/* 
 * Created By : Vadivel N
 * Created Date : 24 MAR, 2017
 * Description :  Manage question order
 */
class Question_order extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('question_order_model');
    }
    
    public function index(){
        $data = array(); 
        $data['theme_data'] = $this->question_order_model->get_theme_list();
        $theme_id           = $this->uri->segment(4);
        $level_id           = $this->uri->segment(5);
        $gender             = $this->uri->segment(6);
        $data['theme_id']   = $theme_id;
        $data['level_id']   = $level_id;
        $data['gender']     = $gender;
        if($theme_id!=''){
            $data['question_list'] =$this->question_order_model->theme_questions_list($theme_id,$level_id,$gender); 
        }
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    
    public function save_mapping() {         
        $theme_id       = $this->input->post('theme_id'); 
        $level_id       = $this->input->post('test_id');
        $gender         = $this->input->post('gender');
        $displaytype    = $this->input->post('displaytype'); 
        $question_list  = $this->input->post('questionid'); 
         
        if(count($question_list)>=1){ 
            $data = array();          
            foreach($question_list as $key => $values)
            {
                $order_numer            = $this->input->post('order_'.$values);
                $question_id            = $values;
                $question_order_type    = $displaytype;
                if($displaytype != 'ORDER') {
                    $question_order = 0;
                }else {
                    $question_order = $order_numer;
                }
                $update_data = array (
                    'question_order_type'   => $question_order_type,
                    'question_order'        => $question_order,
                );
               
                $this->question_order_model->theme_test_map_update($update_data,$theme_id,$level_id,$question_id); 
                // exit;
            }
            $data['message'] = $this->session->flashdata('message');
        }
        redirect(BASE_MODULE_URL . 'question_order/index/'.$theme_id.'/'.$level_id.'/'.$gender,'refresh');
    }
    
    public function load_lelvels($theme_id){
        $this->load->model('test_model');
        $data=$this->test_model->get_theme_levels($theme_id);
        print_r(json_encode($data));  
    }
    
    
}
