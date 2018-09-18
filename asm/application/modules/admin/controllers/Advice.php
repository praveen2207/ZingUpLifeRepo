<?php

/* 
 * Created By : Vadivel N
 * Created Date : 13th Jan 2017
 * Description : Manage Advice
 */
class Advice extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('advice_model');
    }
    //-----------------------------------------------------------------------------------
    public function index(){
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    //-----------------------------------------------------------------------------------
    public function create(){
        $data 					= array();
        $data['action'] 			= 'create';
        $data['title'] 				= 'Create ';
        $data['action_button_text']             = 'Save';
        $this->load->model('goal_segment_model');
        $data['segment_list']                   = $this->goal_segment_model->get_all();
        $data['segment_id']                     = '';
        if(isset($_POST['btn_save']) == 'create'){
            $this->advice_model->advice_type            = $this->input->post('advice_type');
            $this->advice_model->advice_source          = $this->input->post('advice_source');
            $this->advice_model->advice_description     = $this->input->post('advice_description');
            $this->advice_model->goal_id                = $this->input->post('goal_id');
            $this->advice_model->active                 = $this->input->post('active');
            $this->advice_model->save();
            $this->session->set_flashdata('message', 'Advice created successfully');
            redirect(BASE_MODULE_URL . 'advice/index','refresh');
        }else{
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }
    }
    //-----------------------------------------------------------------------------------
    public function edit(){
        $data   = array();
        $data['action']             = 'edit';
        $data['title']              = 'Edit ';
        $data['action_button_text'] = 'Update';
        $this->load->model('goal_segment_model');
	$data['segment_list']               = $this->goal_segment_model->get_all();
        $data['record']['goal_segment_id']  = '' ;
        if(isset($_POST['btn_save']) == 'edit'){
            $this->advice_model->advice_id              = $this->input->post('advice_id');
            $this->advice_model->advice_type            = $this->input->post('advice_type');
            $this->advice_model->advice_source          = $this->input->post('advice_source');
            $this->advice_model->advice_description     = $this->input->post('advice_description');
            $this->advice_model->goal_id                = $this->input->post('goal_id');
            $this->advice_model->active                 = $this->input->post('active');
            $this->advice_model->update();
            $this->session->set_flashdata('message', 'Advice details successfully');
            redirect(BASE_MODULE_URL . 'advice/index','refresh');
        }else{
            $this->advice_model->advice_id      = $this->uri->segment('4');
            $data['advice']                     = $this->advice_model->get_edit_record();
            $goal_id                            = $data['advice'][0]->goal_id;
            $segment_id                         = $this->advice_model->get_segment_id($goal_id);
            $data['goal_id']                    = $goal_id;
            $data['segment_id']                 = $segment_id;
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }
    }  
    //-----------------------------------------------------------------------------------
    public function delete() 
    {
        $this->advice_model->advice_id = $this->uri->segment('4');
        $this->advice_model->delete();
        $this->session->set_flashdata('error-message', 'Advice is deleted successfully');
        redirect(BASE_MODULE_URL . 'advice/index','refresh');
    }
    //--------------------------------------------------------------------------
    public function load_goals($segment_id){
        $data=$this->advice_model->goal_list($segment_id);
        print_r(json_encode($data));   
    }
    //--------------------------------------------------------------------------
    /*
     * Load All Assessments
     */    
    public function load_advice() 
    {
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->advice_model->get_advice($request_data);
        foreach($result['result'] as $advice ) 
        {  
            $nested_data = array(); 
            $nested_data[] = $advice->advice_id;
            $nested_data[] = $advice->advice_source;
            $nested_data[] = $advice->advice_type;
            $nested_data[] = $advice->goal_name;
            $nested_data[] = $advice->advice_description;
            $nested_data[] = $advice->added_on;
            $delete_url  = BASE_MODULE_URL . 'advice/delete/' . $advice->advice_id;
            $delete_url  = "'$delete_url'" ;
            $delete_resource  = "'$advice->advice_description'" ;
            $nested_data[] = $advice->is_active == 'N' ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>';
            
            $action =  '<span class="action_span">
                            <a href="' . BASE_MODULE_URL . 'advice/edit/' . $advice->advice_id . '" >
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
    //-----------------------------------------------------------------------------------
    public function unique_check($advice_code){
        $this->advice_model->assessment_id = $this->input->post('assessment_id');
        $this->advice_model->assessment_code = $advice_code;
        if(!$this->advice_model->unique_check()){
            $this->form_validation->set_message('unique_check', 'Assessment Code is already exists');
            return false;
        }else{
            return true;
        }
    }
    //-----------------------------------------------------------------------------------
}
