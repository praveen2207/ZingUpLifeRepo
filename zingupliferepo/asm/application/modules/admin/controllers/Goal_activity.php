<?php
/* 
 * Created By : Vadivel N
 * Created Date : 11 Jan, 2017
 * Description : Manage Goal Activities
 */
class Goal_activity extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('goal_activity_model');
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
        $this->load->model('goal_segment_model');
	$data['goal_segment_data'] = $this->goal_segment_model->get_all();
        $data['record']['goal_segment_id'] = '' ;
        $this->form_validation->set_rules('goal_activity_name', 'Goal Activity Name', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }
        else{
            $this->goal_activity_model->goal_activity_name          = $this->input->post('goal_activity_name');
            $this->goal_activity_model->goal_activity_description   = $this->input->post('goal_activity_description');
            $this->goal_activity_model->active                      = $this->input->post('active');
            $this->goal_activity_model->save();
            $this->session->set_flashdata('message', 'Goal Activity created successfully');
            redirect(BASE_MODULE_URL . 'goal_activity/index','refresh');
        }
    }
    
    public function edit(){
        $data   = array();
        $data['action']             = 'edit';
        $data['title']              = 'Edit ';
        $data['action_button_text'] = 'Update';
        $id                         = $this->uri->segment(4);

        $this->form_validation->set_rules('goal_activity_name', 'Goal Activity Name', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->goal_activity_model->goal_activity_id  = $this->uri->segment('4');
            $data['goal_activity']  = $this->goal_activity_model->get_edit_record();
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }else{
            $this->goal_activity_model->goal_activity_description    = $this->input->post('goal_activity_description');
            $this->goal_activity_model->goal_segment_id     = $this->input->post('goal_segment_id');
            $this->goal_activity_model->goal_activity_name  = $this->input->post('goal_activity_name');
            $this->goal_activity_model->active              = $this->input->post('active');
            $this->goal_activity_model->update();
            $this->session->set_flashdata('message', 'Goal Activity updated successfully');
            redirect(BASE_MODULE_URL . 'goal_activity/index','refresh');
        }
    }   
    
    public function delete() 
    {
        $this->goal_activity_model->goal_activity_id = $this->uri->segment('4');
        $this->goal_activity_model->delete();
        $this->session->set_flashdata('error-message', 'Goal Activity is deleted successfully');
        redirect(BASE_MODULE_URL . 'goal_activity/index','refresh');
    }
    
    /*
     * Load All Goal actvities
     */    
    public function load_goal_activities() 
    {
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->goal_activity_model->get_goals_activities($request_data);
        foreach($result['result'] as $goal_activity ) 
        {  
            $nested_data = array(); 
            $nested_data[] = $goal_activity->goal_activity_id;
            $nested_data[] = $goal_activity->activity_name;
            $nested_data[] = $goal_activity->created_on;
            $delete_url     = BASE_MODULE_URL . 'goal_activity/delete/' . $goal_activity->goal_activity_id;
            $delete_url     = "'$delete_url'" ;
            $delete_resource  = "'$goal_activity->activity_name'" ;
            $nested_data[] = $goal_activity->is_active == 'N' ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>';
            
            $action =  '<span class="action_span">
                            <a href="' . BASE_MODULE_URL . 'goal_activity/edit/' . $goal_activity->goal_activity_id . '" >
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
    
    public function unique_check($goal_activity_name){
        $this->goal_activity_model->goal_activity_id = $this->input->post('goal_activity_id');
        $this->goal_activity_model->goal_activity_name = $goal_activity_name;
        if(!$this->goal_activity_model->unique_check()){
            $this->form_validation->set_message('unique_check', 'Goal activity is already exists');
            return false;
        }else{
            return true;
        }
    }
    public function load_goal($segment_id){
        $data=$this->goal_activity_model->loadGoal($segment_id);
        print_r(json_encode($data));   
    }
    
}
