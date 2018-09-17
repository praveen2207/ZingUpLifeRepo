<?php

/* 
 * Created By : Vadivel N
 * Created Date : 27th OCT, 2016
 * Description : Manage Goals
 */
class Goals extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('goals_model');
    }
    public function index(){
        $this->load->model('goal_segment_model');
	$data['goal_segment_data'] = $this->goal_segment_model->get_all();
        $data['record']['goal_segment_id'] = '' ;
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
        
        
        $this->load->model('goal_activity_model');
	$data['goal_activity_data'] = $this->goal_activity_model->get_all();
        $data['record']['goal_activity_id'] = '' ;
        
        
        $this->form_validation->set_rules('goal_name', 'Goal Name', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }
        else{
            $this->goals_model->goal_description    = $this->input->post('goal_description');
            $this->goals_model->goal_segment_id     = $this->input->post('goal_segment_id');
            $this->goals_model->goal_name           = $this->input->post('goal_name');
            $this->goals_model->gender              = $this->input->post('gender');
            $this->goals_model->active              = $this->input->post('active');
            $image_file_path                        = $this->upload_image('goal_image');
            $this->goals_model->goal_image          = $image_file_path; 
            $goal_id                                = $this->goals_model->save();
            $activity_list                          = $this->input->post('goal_activities');
            $this->load->model('activity_goal_model');
            $this->activity_goal_model->goal_activity_mapping($activity_list,$goal_id);

            $this->session->set_flashdata('message', 'Goal created successfully');
            redirect(BASE_MODULE_URL . 'goals/index','refresh');
        }
    }
    public function edit(){
        $data   = array();
        $data['action']             = 'edit';
        $data['title']              = 'Edit ';
        $data['action_button_text'] = 'Update';
        $id                         = $this->uri->segment(4);
        $this->load->model('goal_segment_model');
	$data['goal_segment_data'] = $this->goal_segment_model->get_all();
        $data['record']['goal_segment_id'] = '' ;
        
        $this->load->model('goal_activity_model');
	$data['goal_activity_data'] = $this->goal_activity_model->get_all();
        $data['record']['goal_activity_id'] = '' ;
        
        $this->form_validation->set_rules('goal_name', 'Goal Name', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->goals_model->goal_id  = $this->uri->segment('4');
            $data['goal']                     = $this->goals_model->get_edit_record();
            $data['goal_activities']           = $this->goals_model->get_goal_activities($this->goals_model->goal_id);
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }else{
            $this->goals_model->goal_id             = $this->input->post('goal_id');
            $this->goals_model->goal_segment_id     = $this->input->post('goal_segment_id');
            $this->goals_model->goal_description    = $this->input->post('goal_description');
            $this->goals_model->goal_name           = $this->input->post('goal_name');
            $this->goals_model->gender              = $this->input->post('gender');
            $this->goals_model->active              = $this->input->post('active');
            $remove_images = $this->input->post('removed_image');
            if($remove_images == 1) {
               $this->goals_model->goal_image_url = '';
               $this->goals_model->goal_image_url = $this->upload_image('goal_image');
               $this->goals_model->update_goal_image();
            }else{
                $this->goals_model->goal_image_url = $this->upload_image('goal_image');
                if($this->goals_model->goal_image_url!='') $this->goals_model->update_goal_image();
            }
            
            $this->goals_model->update();
            $activity_list                          = $this->input->post('goal_activities');
            $this->load->model('activity_goal_model');
            $this->activity_goal_model->goal_activity_mapping($activity_list,$this->goals_model->goal_id);

            $this->session->set_flashdata('message', 'Goal updated successfully');
            redirect(BASE_MODULE_URL . 'goals/index','refresh');
        }
    }    
    public function delete() 
    {
        $this->goals_model->goal_id = $this->uri->segment('4');
        $this->goals_model->delete();
        $this->session->set_flashdata('error-message', 'Goal is deleted successfully');
        redirect(BASE_MODULE_URL . 'goals/index','refresh');
    }
    /*
     * Goal image upload -------------------------------------------------------- 
    */
    public function upload_image($image_name){
        //Upload Image
        $image_file_path = '';
        $config['upload_path']      = './uploads/goal_images/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = '0';
        $config['max_width']        = '0';
        $config['max_height']       = '0';
        $config['encrypt_name']     = TRUE;
        $config['remove_spaces']    = TRUE;
        if (isset($_FILES[$image_name]['name'])) {
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if(!is_dir('./uploads/')){
                mkdir('./uploads/', 0755, TRUE);
            }
            if(!is_dir('./uploads/goal_images/')){
                mkdir('./uploads/goal_images/', 0755, TRUE);
            }
            if ($this->upload->do_upload($image_name)){
                $img_data       =   $this->upload->data();
                $new_imgname    =   $image_name."_".md5(time()).$img_data['file_ext'];
                $new_imgpath    =   $img_data['file_path'].$new_imgname;
                rename($img_data['full_path'], $new_imgpath);
                $file_path_db = base_url().'uploads/goal_images/'.$new_imgname;
                $image_file_path = $file_path_db;
            }
            return $image_file_path;
        }
    }
    
    /*
     * Load All Goals
     */    
    public function load_goals() 
    {
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->goals_model->get_goals($request_data);

        foreach($result['result'] as $goal ) 
        {  
            $nested_data = array(); 
            $nested_data[] = $goal->goal_id;
            $nested_data[] = $goal->segment_name;
            $nested_data[] = $goal->goal_name;
            $nested_data[] = $goal->gender;
            $nested_data[] = $goal->created_on;
            $delete_url         = BASE_MODULE_URL . 'goals/delete/' . $goal->goal_id;
            $delete_url         = "'$delete_url'" ;
            $delete_resource    = "'$goal->goal_name'" ;
            $nested_data[] = $goal->is_active == 'N' ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>';
            
            $action =  '<span class="action_span">
                            <a href="' . BASE_MODULE_URL . 'goals/edit/' . $goal->goal_id . '" >
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
    public function unique_check($goal_name){
        $this->goals_model->goal_id         = $this->input->post('goal_id');
        $this->goals_model->goal_segment_id = $this->input->post('goal_segment_id');
        $this->goals_model->goal_name       = $goal_name;
        if(!$this->goals_model->unique_check()){
            $this->form_validation->set_message('unique_check', 'Goal Name is already exists');
            return false;
        }else{
            return true;
        }
    }

}
