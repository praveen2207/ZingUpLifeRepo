<?php
/* 
 * Created By : Vadivel N
 * Created Date : 08 FEB, 2017
 * Description : Manage Assessment Test Interpretation
 */
class Test_interpretation extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('Test_interpretation_model');
    }
    
    public function index(){
        $data = array(); $theme_id = '';
        $data['assessment_list']    = $this->Test_interpretation_model->get_theme_list();
        $theme_id                   = $this->uri->segment(4);
        $data['theme_id']           = $theme_id;
        if($theme_id!=''){
            $data['test_list'] = $this->Test_interpretation_model->test_list($theme_id); 
        }
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    
    public function save_mapping() {         
        $test_id        = $this->input->post('test_id'); 
        $question_list  = $this->input->post('questionid'); 
        $this->Test_interpretation_model->delete($test_id);
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
                $this->Test_interpretation_model->test_questions_map_insert($data); 
            }
           
            $data['message'] = $this->session->flashdata('message');
        }
        redirect(BASE_MODULE_URL . 'test_interpretation/index/'.$test_id,'refresh');
    }
    
    public function view(){
        $data = array(); 
        $data['theme_id']       = $this->uri->segment(4);
        $data['test_id']        = $this->uri->segment(5);
        $theme_id               = $data['theme_id'];
        $test_id                = $data['test_id'];
        $data['theme_name']      = $this->Test_interpretation_model->get_theme_name($theme_id);
        $data['test_name']       = $this->Test_interpretation_model->get_test_name($test_id);
        $data['message']        = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/view',$data);
    }
    public function add(){
        $data 					= array();
        $data['action'] 			= 'add';
        $data['title'] 				= 'Add ';
        $data['action_button_text']             = 'Add';
        $data['theme_id']                       = $this->uri->segment(4);
        $data['test_id']                        = $this->uri->segment(5);
        $theme_id                               = $data['theme_id'];
        $test_id                                = $data['test_id'];
        $data['sub_theme_data'] = $this->Test_interpretation_model->loadSubTheme($test_id);
        $data['record']['sub_theme_id'] = '' ;
        
        $ideal_image_file_path = $score_image_file_path = '';
        
        if($this->input->post('btn_save') == 'Save'){
            $this->Test_interpretation_model->theme_id           = $this->input->post('theme_id');
            $this->Test_interpretation_model->test_id            = $this->input->post('test_id');
            $this->Test_interpretation_model->gender            = $this->input->post('gender');
            $this->Test_interpretation_model->sub_theme_id       = $this->input->post('sub_theme_id');
            $this->Test_interpretation_model->score_from         = $this->input->post('score_from');
            $this->Test_interpretation_model->score_to           = $this->input->post('score_to');
            $this->Test_interpretation_model->interpretation_text= $this->input->post('interpretation_text');
            $this->Test_interpretation_model->active             = $this->input->post('active');
            
            $ideal_image_file_path = $this->upload_image('ideal_image');
            $score_image_file_path = $this->upload_image('score_image');
            $this->Test_interpretation_model->ideal_image_url   = $ideal_image_file_path;
            $this->Test_interpretation_model->score_image_url   = $score_image_file_path;
            $this->Test_interpretation_model->save();
            $this->session->set_flashdata('message', 'Interpretation added successfully');
            redirect(BASE_MODULE_URL . 'test_interpretation/view/'.$this->Test_interpretation_model->theme_id."/".$this->Test_interpretation_model->test_id,'refresh');
        }else{
            $this->load->template(strtolower(__CLASS__) . '/add', $data  );
        }
    }
    public function upload_image($image_name){
        //Upload Image
        $image_file_path = '';
        $config['upload_path']      = './uploads/interpretation/';
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
            if(!is_dir('./uploads/interpretation/')){
                mkdir('./uploads/interpretation/', 0755, TRUE);
            }
            
            
            
            
            if ($this->upload->do_upload($image_name)){
                $img_data       =   $this->upload->data();
                $new_imgname    =   $image_name."_".md5(time()).$img_data['file_ext'];
                $new_imgpath    =   $img_data['file_path'].$new_imgname;
                rename($img_data['full_path'], $new_imgpath);
                $file_path_db = base_url().'uploads/interpretation/'.$new_imgname;
                $image_file_path = $file_path_db;
            }
            return $image_file_path;
        }
    }
    public function edit(){
        $data 					= array();
        $data['action'] 			= 'edit';
        $data['title'] 				= 'Edit';
        $data['action_button_text']             = 'Update';
        $data['theme_id']                       = $this->uri->segment(4);
        $data['test_id']                        = $this->uri->segment(5);
        $theme_id                               = $data['theme_id'];
        $test_id                                = $data['test_id'];
        $data['sub_theme_data'] = $this->Test_interpretation_model->loadSubTheme($test_id);
        $data['record']['sub_theme_id'] = '' ;
        if($this->input->post('btn_save') == 'Save'){
            $this->Test_interpretation_model->interpretation_id  = $this->input->post('interpretation_id');
            $this->Test_interpretation_model->theme_id      = $this->input->post('theme_id');
            $this->Test_interpretation_model->test_id            = $this->input->post('test_id');
            $this->Test_interpretation_model->gender            = $this->input->post('gender');
            $this->Test_interpretation_model->sub_theme_id       = $this->input->post('sub_theme_id');
            $this->Test_interpretation_model->score_from         = $this->input->post('score_from');
            $this->Test_interpretation_model->score_to           = $this->input->post('score_to');
            $this->Test_interpretation_model->interpretation_text= $this->input->post('interpretation_text');
            $this->Test_interpretation_model->active             = $this->input->post('active');
            $remove_ideal = $this->input->post('removed_ideal');
            $remove_score = $this->input->post('removed_score');
            if($remove_ideal == 1) {
               $this->Test_interpretation_model->ideal_image_url = '';
               $this->Test_interpretation_model->ideal_image_url = $this->upload_image('ideal_image');
               $this->Test_interpretation_model->update_ideal_image();
            }else{
                $this->Test_interpretation_model->ideal_image_url = $this->upload_image('ideal_image');
                if($this->Test_interpretation_model->ideal_image_url!='') $this->Test_interpretation_model->update_ideal_image();
            }
            if($remove_score == 1) {
               $this->Test_interpretation_model->score_image_url = '';
               $this->Test_interpretation_model->score_image_url = $this->upload_image('score_image');
               $this->Test_interpretation_model->update_score_image();
            }else{
                $this->Test_interpretation_model->score_image_url = $this->upload_image('score_image');
                if($this->Test_interpretation_model->score_image_url!='') $this->Test_interpretation_model->update_score_image();
            }
            
            $this->Test_interpretation_model->update();
            $this->session->set_flashdata('message', 'Interpretation updated successfully');
            redirect(BASE_MODULE_URL . 'test_interpretation/view/'.$this->Test_interpretation_model->theme_id."/".$this->Test_interpretation_model->test_id,'refresh');
        }else{
            $this->Test_interpretation_model->interpretation_id    = $this->uri->segment('6');
            $data['interpretation'] = $this->Test_interpretation_model->get_edit_record();
            $data['theme_id']                  = $data['interpretation'][0]->theme_id;
            $data['test_id']                        = $data['interpretation'][0]->test_id;
            $this->load->template(strtolower(__CLASS__) . '/add', $data  );
        }
    }
    
    public function load_interpretations(){
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->Test_interpretation_model->get_interpretations($request_data);

        foreach($result['result'] as $interpretations ) 
        {  
            $nested_data = array(); 
            $data_array = $this->Test_interpretation_model->get_sub_theme_name($interpretations->interpretation_id);
            $nested_data[] = $interpretations->interpretation_id;
            if(isset($data_array[0])) { 
                $nested_data[] = $data_array[0]->sub_theme_name;
            }else{
                $nested_data[] = '';   
            }
            $nested_data[] = $interpretations->gender;
            $nested_data[] = $interpretations->score_from;
            $nested_data[] = $interpretations->score_to;
            $nested_data[] = $interpretations->interpretation_text;
            $delete_url  = BASE_MODULE_URL . 'test_interpretation/delete/' . $interpretations->interpretation_id;
            $delete_url  = "'$delete_url'" ;
            $delete_resource  = "'$interpretations->interpretation_text'" ;
            $nested_data[] = $interpretations->is_active == 'N' ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>';
            
            $action =  '<span class="action_span">
                            <a href="' . BASE_MODULE_URL . 'test_interpretation/edit/'.$interpretations->theme_id.'/'.$interpretations->test_id.'/'.$interpretations->interpretation_id.'" >
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
}
