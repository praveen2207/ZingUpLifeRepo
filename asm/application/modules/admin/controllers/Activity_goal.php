<?php
/* 
 * Created By : Vadivel N
 * Created Date : 18 JAN, 2017
 * Description : Manage Assessments and goal mapping
 */
class Activity_goal extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('activity_goal_model');
    }
    //--------------------------------------------------------------------------
    public function index(){
        $data = array(); 
        $data['segment_list']   = $this->activity_goal_model->get_goal_segments();
        $segment_id             = $this->uri->segment(4);
        $goal_id                = $this->uri->segment(5);
        $data['segment_id']     = $segment_id;
        $data['goal_id']        = $goal_id;
        if($segment_id!='' && $goal_id!=''){
            $data['activity_list'] =$this->activity_goal_model->goal_activity_list($goal_id); 
        }
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    //--------------------------------------------------------------------------
    public function load_goals($segment_id){
        $data=$this->activity_goal_model->goal_list($segment_id);
        print_r(json_encode($data));   
    }
    //--------------------------------------------------------------------------
    public function save_mapping() {         
        $segment_id  = $this->input->post('segment_id'); 
        $goal_id        = $this->input->post('goal_id_val'); 
        $activity_list      = $this->input->post('activity_id'); 
        $this->activity_goal_model->delete($goal_id);   
        if(count($activity_list)>=1){ 
            $data = array();          
            foreach($activity_list as $key => $values){
                $data['goal_id']        = $goal_id;
                $data['activity_id']    = $values;
                $this->activity_goal_model->activity_goal_map_insert($data); 
            }
            
        }
        $this->session->set_flashdata('message', 'Activities are mapped to goal successfully !');
        redirect(BASE_MODULE_URL . 'activity_goal/index/'.$segment_id.'/'.$goal_id,'refresh');
    }
    //--------------------------------------------------------------------------
}
