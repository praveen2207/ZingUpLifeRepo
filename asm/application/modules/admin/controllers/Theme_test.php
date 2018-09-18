<?php

/* 
 * Created By : Vadivel N
 * Created Date : 12 JAN, 2017
 * Description :  Manage Themes with theme mapping
 */
class Theme_test extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('theme_test_model');
    }
    
    public function index(){
        $data = array(); 
        $data['theme_list'] = $this->theme_test_model->get_theme_list();
        $theme_id           = $this->uri->segment(4);
        $data['theme_id']   = $theme_id;
        if($theme_id!=''){
            $data['tests_list'] =$this->theme_test_model->theme_tests_list($theme_id); 
        }
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    
    public function save_mapping() {         
        $theme_id    = $this->input->post('theme_id'); 
        $displaytype      = $this->input->post('displaytype'); 
        $test_list        = $this->input->post('testid'); 
        //$this->theme_test_model->delete($theme_id);   
        if(count($test_list)>=1){ 
            $data = array();          
            foreach($test_list as $key => $values)
            {
                $order_numer        = $this->input->post('order_'.$values);
                $test_id            = $values;
                $test_order_type    = $displaytype;
                if($displaytype != 'ORDER') {
                    $test_order = 0;
                }else {
                    $test_order = $order_numer;
                }
                $update_data = array (
                    'test_order_type'   => $test_order_type,
                    'test_order'        => $test_order,
                );
                //$this->theme_test_model->theme_test_map_insert($data); 
                $this->theme_test_model->theme_test_map_update($update_data,$theme_id,$test_id); 
            }
            $data['message'] = $this->session->flashdata('message');
        }
        redirect(BASE_MODULE_URL . 'theme_test/index/'.$theme_id,'refresh');
    }
    
}
