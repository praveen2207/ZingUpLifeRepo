<?php
/* 
 * Created By : Vadivel N
 * Created Date : 18 JAN, 2017
 * Description : Manage Assessments and goal mapping
 */
class Assessment_goal extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('assessment_goal_model');
    }
    
    public function create(){
        $data = array(); 
        $data['assessment_list'] = $this->assessment_goal_model->get_assessment_list();
        $assessment_id           = $this->uri->segment(4);
        $test_id                 = $this->uri->segment(5);
        $data['assessment_id']   = $assessment_id;
        $data['test_id']         = $test_id;
        $this->load->model('goal_segment_model');
	$data['goal_segment_data'] = $this->goal_segment_model->get_all();
        $data['record']['goal_segment_id'] = '' ;
        $data['goal_segment_id'] = '';
        //$this->assessment_goal_model->getMapping();
       // print_r($POST); exit;
        /*if(isset($_POST['btn_save']) == 'Save'){
            echo "<pre>";print_r($this->input->post());
            for ($i=1; $i < 6 ; $i++) {
                if($_POST['sub_theme_id_'.$i] != '' &&  $_POST['score_from_'.$i] != '' && $_POST['score_to_'.$i]!= ''){
                    $save_data = array(
                        'theme_id'      => $this->input->post('theme_id'),
                        'test_id'       => $this->input->post('test_id'),
                        'goal_id'       => $this->input->post('goal_id'),
                        'sub_theme_id'  => $_POST['sub_theme_id_'.$i],
                        'score_from'    => $_POST['score_from_'.$i],
                        'score_to'      => $_POST['score_to_'.$i],
                        'score_level'   => $_POST['score_level_'.$i]
                    );
                    $this->assessment_goal_model->save($save_data);
            }
            }
            exit;
            $this->session->set_flashdata('message', 'Goal mapping created successfully');
            redirect(BASE_MODULE_URL . 'assessment_goal/index','refresh');
        }*/
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/create',$data);
    }
    
    function save(){
        for ($i=1; $i < 6 ; $i++) {
            if($_POST['sub_theme_id_'.$i] != '' &&  $_POST['score_from_'.$i] != '' && $_POST['score_to_'.$i]!= ''){
                $save_data = array(
                    'theme_id'      => $this->input->post('theme_id'),
                    'test_id'       => $this->input->post('test_id'),
                    'goal_id'       => $this->input->post('goal_id'),
                    'sub_theme_id'  => $_POST['sub_theme_id_'.$i],
                    'score_from'    => $_POST['score_from_'.$i],
                    'score_to'      => $_POST['score_to_'.$i],
                    'score_level'   => $_POST['score_level_'.$i]
                );
                $this->assessment_goal_model->save($save_data);
        }
        }
        $this->session->set_flashdata('message', 'Goal mapping created successfully');
        redirect(BASE_MODULE_URL . 'assessment_goal/index','refresh');
    }
    
    public function load_assessment_test($theme_id){
        $this->load->model('test_model');
        $data=$this->test_model->get_theme_levels($theme_id);
        print_r(json_encode($data));    
    }
    
    public function load_test_sub_themes($test_id){
        $data=$this->assessment_goal_model->test_sub_theme_list($test_id);
        print_r(json_encode($data));   
    }
    
    public function load_goals($segment_id){
        $this->load->model('goal_activity_model');
        $data=$this->goal_activity_model->loadGoal($segment_id);
        print_r(json_encode($data));   
    }
    
    public function save_mapping() {         
        $assessment_id  = $this->input->post('assessment_id'); 
        $test_id        = $this->input->post('test_id_val'); 
        $goal_list      = $this->input->post('goal_id'); 
        echo "<pre>"; print_r($goal_list);exit;
        
        $this->assessment_goal_model->delete($assessment_id,$test_id);   
        if(count($goal_list)>=1){ 
            $data = array();          
            foreach($goal_list as $key => $values){
                $data['assessment_id']  = $assessment_id;
                $data['test_id']        = $test_id;
                $data['goal_id']        = $values;
                $this->assessment_goal_model->assessment_goal_map_insert($data); 
            }
            $data['message'] = $this->session->flashdata('message');
        }
        redirect(BASE_MODULE_URL . 'assessment_goal/index/'.$assessment_id.'/'.$test_id,'refresh');
    }
    public function index(){
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    function load_goal_mapping(){
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->assessment_goal_model->get_goal_mapping($request_data);
        foreach($result['result'] as $goal_activity ) 
        {  
            $nested_data = array(); 
            $nested_data[]  = $goal_activity->goal_mapping_id;
            $nested_data[]  = $goal_activity->theme_name;
            $nested_data[]  = $goal_activity->sub_theme_name;
            $nested_data[]  = $goal_activity->test_name;
            $nested_data[]  = $goal_activity->goal_name;
            $nested_data[]  = $goal_activity->score_from;
            $nested_data[]  = $goal_activity->score_to;
            $nested_data[]  = $goal_activity->score_level;
            $delete_url     = BASE_MODULE_URL . 'assessment_goal/delete/' . $goal_activity->goal_mapping_id;
            $delete_url     = "'$delete_url'" ;
            $delete_resource  = "'$goal_activity->score_level'" ;
            $action = '<span class="action_span">
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
    public function delete() 
    {
        $this->assessment_goal_model->goal_mapping_id = $this->uri->segment('4');
        $this->assessment_goal_model->delete();
        $this->session->set_flashdata('error-message', 'Goal mapping is deleted successfully');
        redirect(BASE_MODULE_URL . 'assessment_goal/index','refresh');
    }
}
