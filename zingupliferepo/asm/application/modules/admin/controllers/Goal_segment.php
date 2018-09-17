<?php

/* 
 * Created By : Vadivel N
 * Created Date : 27th OCT, 2016
 * Description : Manage Goals
 */
class Goal_segment extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('goal_segment_model');
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
        $this->form_validation->set_rules('segment_name', 'Segment Name', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }
        else{
            $this->goal_segment_model->segment_description  = $this->input->post('segment_description');
            $this->goal_segment_model->segment_name         = $this->input->post('segment_name');
            $this->goal_segment_model->active               = $this->input->post('active');
            $this->goal_segment_model->save();
            $this->session->set_flashdata('message', 'Segement created successfully');
            redirect(BASE_MODULE_URL . 'goal_segment/index','refresh');
        }
    }
    public function edit(){
        $data   = array();
        $data['action']             = 'edit';
        $data['title']              = 'Edit ';
        $data['action_button_text'] = 'Update';
        $id                         = $this->uri->segment(4);
        $this->form_validation->set_rules('segment_name', 'Segement Name', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->goal_segment_model->goal_segment_id  = $this->uri->segment('4');
            $data['segment']                     = $this->goal_segment_model->get_edit_record();
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }else{
            $this->goal_segment_model->goal_segment_id     = $this->input->post('goal_segment_id');
            $this->goal_segment_model->segment_description  = $this->input->post('segment_description');
            $this->goal_segment_model->segment_name         = $this->input->post('segment_name');
           
            $this->goal_segment_model->active               = $this->input->post('active');
            $this->goal_segment_model->update();
            
            $this->session->set_flashdata('message', 'Segement updated successfully');
            redirect(BASE_MODULE_URL . 'goal_segment/index','refresh');
        }
    }    
    public function delete() 
    {
        $this->goal_segment_model->goal_segment_id = $this->uri->segment('4');
        $this->goal_segment_model->delete();
        $this->session->set_flashdata('error-message', 'Segement is deleted successfully');
        redirect(BASE_MODULE_URL . 'goal_segment/index','refresh');
    }
    /*
     * Load All Segements
     */    
    public function load_segments() 
    {
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->goal_segment_model->get_segments($request_data);

        foreach($result['result'] as $segment ) 
        {  
            $nested_data = array(); 
            $nested_data[] = $segment->goal_segment_id;
            $nested_data[] = $segment->segment_name;
            $nested_data[] = $segment->created_on;
            $delete_url  = BASE_MODULE_URL . 'goal_segment/delete/' . $segment->goal_segment_id;
            $delete_url  = "'$delete_url'" ;
            $delete_resource  = "'$segment->segment_name'" ;
            $nested_data[] = $segment->is_active == 'N' ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>';
            
            $action =  '<span class="action_span">
                            <a href="' . BASE_MODULE_URL . 'goal_segment/edit/' . $segment->goal_segment_id . '" >
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
    public function unique_check($segment_name){
        $this->goal_segment_model->goal_segment_id = $this->input->post('goal_segment_id');
        $this->goal_segment_model->test_code = $segment_name;
        if(!$this->goal_segment_model->unique_check()){
            $this->form_validation->set_message('unique_check', 'Segement Name is already exists');
            return false;
        }else{
            return true;
        }
    }
}
