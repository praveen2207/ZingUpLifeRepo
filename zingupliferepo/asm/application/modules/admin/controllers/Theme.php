<?php
/* 
 * Created By : Vadivel N
 * Created Date : 12th DEC, 2017
 * Description : Manage Themes
 */
class Theme extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('theme_model');
    }
    /*
     * List all themes index page --------------------------------------------------------
    */
    public function index(){
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data);
    }
    /*
     * Add a theme ----------------------------------------------------------------------
    */
    public function create(){
        $data 					= array();
        $data['action'] 			= 'create';
        $data['title'] 				= 'Create ';
        $data['action_button_text']             = 'Save';
        $this->form_validation->set_rules('theme_code', 'assessment code', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }
        else{
            $this->theme_model->theme_type  = $this->input->post('theme_type');
            $this->theme_model->theme_name  = $this->input->post('theme_name');
            $this->theme_model->theme_code  = $this->input->post('theme_code');
            $this->theme_model->active      = $this->input->post('active');
            $image_file_path                = $this->upload_image('theme_image');
            $this->theme_model->theme_image = $image_file_path; 
            $this->theme_model->save();
            $this->session->set_flashdata('message', 'Theme created successfully');
            redirect(BASE_MODULE_URL . 'theme/index','refresh');
        }
    }
    /*
     * Edit a theme  ----------------------------------------------------------------------
    */
    public function edit(){
        $data   = array();
        $data['action']             = 'edit';
        $data['title']              = 'Edit ';
        $data['action_button_text'] = 'Update';
        $id                         = $this->uri->segment(4);
        $this->form_validation->set_rules('theme_code', 'theme_code code', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->theme_model->theme_id  = $this->uri->segment('4');
            $data['assessment']                     = $this->theme_model->get_edit_record();
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }else{
            $this->theme_model->theme_id    = $this->input->post('theme_id');
            $this->theme_model->theme_type  = $this->input->post('theme_type');
            $this->theme_model->theme_name  = $this->input->post('theme_name');
            $this->theme_model->theme_code  = $this->input->post('theme_code');
            $this->theme_model->active      = $this->input->post('active');
            $remove_images = $this->input->post('removed_image');
            if($remove_images == 1) {
               $this->theme_model->theme_image_url = '';
               $this->theme_model->theme_image_url = $this->upload_image('theme_image');
               $this->theme_model->update_theme_image();
            }else{
                $this->theme_model->theme_image_url = $this->upload_image('theme_image');
                if($this->theme_model->theme_image_url!='') $this->theme_model->update_theme_image();
            }
            $this->theme_model->update();
            
            $this->session->set_flashdata('message', 'Theme updated successfully');
            redirect(BASE_MODULE_URL . 'theme/index','refresh');
        }
    }  
    /*
     * Theme image upload -------------------------------------------------------- 
    */
    public function upload_image($image_name){
        //Upload Image
        $image_file_path = '';
        $config['upload_path']      = './uploads/theme_images/';
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
            if(!is_dir('./uploads/theme_images/')){
                mkdir('./uploads/theme_images/', 0755, TRUE);
            }
            if ($this->upload->do_upload($image_name)){
                $img_data       =   $this->upload->data();
                $new_imgname    =   $image_name."_".md5(time()).$img_data['file_ext'];
                $new_imgpath    =   $img_data['file_path'].$new_imgname;
                rename($img_data['full_path'], $new_imgpath);
                $file_path_db = base_url().'uploads/theme_images/'.$new_imgname;
                $image_file_path = $file_path_db;
            }
            return $image_file_path;
        }
    }
    /*
     * Delete a theme --------------------------------------------------------------- 
    */ 
    public function delete() 
    {
        $this->theme_model->theme_id = $this->uri->segment('4');
        $this->theme_model->delete();
        $this->session->set_flashdata('error-message', 'Theme is deleted successfully');
        redirect(BASE_MODULE_URL . 'theme/index','refresh');
    }
    /*
     * Load All Themes ----------------------------------------------------------- 
    */    
    public function load_themes() 
    {
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->theme_model->get_themes($request_data);

        foreach($result['result'] as $theme ) 
        {  
            $nested_data = array(); 
            $nested_data[] = $theme->theme_id;
            $nested_data[] = $theme->theme_name;
            $nested_data[] = $theme->theme_code;
            $nested_data[] = $theme->theme_type;
            $nested_data[] = $theme->created_on;
            $delete_url  = BASE_MODULE_URL . 'theme/delete/' . $theme->theme_id;
            $delete_url  = "'$delete_url'" ;
            $delete_resource  = "'$theme->theme_name'" ;
            $nested_data[] = $theme->is_active == 'N' ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>';
            
            $action =  '<span class="action_span">
                            <a href="' . BASE_MODULE_URL . 'theme/edit/' . $theme->theme_id . '" >
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
    /*
     * Theme name uqiquness check-------------------------------------------------- 
    */
    public function unique_check($theme_code){
        $this->theme_model->theme_id = $this->input->post('theme_id');
        $this->theme_model->theme_code = $theme_code;
        if(!$this->theme_model->unique_check()){
            $this->form_validation->set_message('unique_check', 'Theme Code is already exists');
            return false;
        }else{
            return true;
        }
    }
    
    
}
