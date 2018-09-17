<?php

/* 
 * Created By : Vadivel N
 * Created Date : 27th OCT, 2016
 * Description : Manage Tests
 */
class Test extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('test_model');
    }
    public function index(){
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    public function create(){
        $data 					= array();
        $data['action'] 			= 'create';
        $data['title'] 				= 'Create ';
        $data['action_button_text']             = 'Save';
        $this->load->model('theme_model');
	$data['theme_data'] = $this->theme_model->get_all();
        $data['record']['theme_id'] = '' ;        
        $this->form_validation->set_rules('test_code', 'test code', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }
        else{
            $this->test_model->test_description     = $this->input->post('test_description');
            $this->test_model->theme_id             = $this->input->post('theme_id');
            $this->test_model->test_name            = $this->input->post('test_name');
            $this->test_model->test_code            = $this->input->post('test_code');
            $this->test_model->active               = $this->input->post('active');
            $this->test_model->save();
            $this->session->set_flashdata('message', 'Test created successfully');
            redirect(BASE_MODULE_URL . 'test/index','refresh');
        }
    }
    public function edit(){
        $data   = array();
        $data['action']             = 'edit';
        $data['title']              = 'Edit ';
        $data['action_button_text'] = 'Update';
        $this->load->model('theme_model');
	$data['theme_data'] = $this->theme_model->get_all();
        $data['record']['theme_id'] = '' ;         
        $id                         = $this->uri->segment(4);
        $this->form_validation->set_rules('test_code', 'test code', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->test_model->test_id  = $this->uri->segment('4');
            $data['test']                     = $this->test_model->get_edit_record();
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }else{
            $this->test_model->test_id              = $this->input->post('test_id');
            $this->test_model->theme_id             = $this->input->post('theme_id');
            $this->test_model->test_description     = $this->input->post('test_description');
            $this->test_model->test_name            = $this->input->post('test_name');
            $this->test_model->test_code            = $this->input->post('test_code');
            $this->test_model->active               = $this->input->post('active');
            $this->test_model->update();
            
            $this->session->set_flashdata('message', 'Test updated successfully');
            redirect(BASE_MODULE_URL . 'test/index','refresh');
        }
    }    
    public function delete() 
    {
        $this->test_model->test_id = $this->uri->segment('4');
        $this->test_model->delete();
        $this->session->set_flashdata('error-message', 'Test is deleted successfully');
        redirect(BASE_MODULE_URL . 'test/index','refresh');
    }
    /*
     * Load All Tests
     */    
    public function load_tests() 
    {
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->test_model->get_tests($request_data);

        foreach($result['result'] as $test ) 
        {  
            $nested_data = array(); 
            $nested_data[] = $test->test_id;
            $nested_data[] = $test->theme_name;            
            $nested_data[] = $test->test_name;
            $nested_data[] = $test->test_code;
            $nested_data[] = $test->created_on;
            $delete_url         = BASE_MODULE_URL . 'test/delete/' . $test->test_id;
            $delete_url         = "'$delete_url'" ;
            $delete_resource    = "'$test->test_name'" ;
            
            $nested_data[] = $test->is_active == 'N' ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>';
            
            $action =  '<span class="action_span">
                            <a href="' . BASE_MODULE_URL . 'test/edit/' . $test->test_id . '" >
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </span>';  
            
            $action .= '<span class="action_span">
                        <a href="javascript:void(0);" onclick="confirm_model('.$delete_url.','.$delete_resource.')" >
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        </span>';   
            
            $nested_data[] 	= $action;
            $data[] 		= $nested_data;
        }

        /*
         * Param : draw             //  for every request/draw by clientside , 
         *                              they send a number as a parameter, when they recieve a response/data they first check the draw number, 
         *                              so we are sending same number in draw.  
         * Param : recordsTotal     //  total number of records
         * Param : recordsFiltered  //  total number of records after searching, if there is no searching then totalFiltered = totalData
         * Param :                  //  total data array
         */
        $json_data = array(
                        "draw"            => intval( $request_data['draw'] ),   
                        "recordsTotal"    => intval( $result['total_data'] ),  
                        "recordsFiltered" => intval( $result['total_filtered'] ), 
                        "data"            => $data    
                    );

        echo json_encode($json_data);  
        
    }
    public function unique_check($test_code){
        $this->test_model->test_id = $this->input->post('test_id');
        $this->test_model->test_code = $test_code;
        if(!$this->test_model->unique_check()){
            $this->form_validation->set_message('unique_check', 'Test Code is already exists');
            return false;
        }else{
            return true;
        }
    }
}
