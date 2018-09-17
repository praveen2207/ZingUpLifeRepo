<?php

/* 
 * Created By : Vadivel N
 * Created Date : 12th JAN, 2017
 * Description : Manage Sub themes
 */
class Sub_theme extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('sub_theme_model');
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
        $this->form_validation->set_rules('sub_theme_name', 'Sub Theme Name', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }
        else{
            $this->sub_theme_model->theme_id        = $this->input->post('theme_id');
            $this->sub_theme_model->sub_theme_name  = $this->input->post('sub_theme_name');
            $this->sub_theme_model->active          = $this->input->post('active');
            $this->sub_theme_model->save();
            $this->session->set_flashdata('message', 'Sub Theme Name created successfully');
            redirect(BASE_MODULE_URL . 'sub_theme/index','refresh');
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
        $this->form_validation->set_rules('sub_theme_name', 'Sub theme Name', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->sub_theme_model->sub_theme_id  = $this->uri->segment('4');
            $data['sub_theme']                     = $this->sub_theme_model->get_edit_record();
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }else{
            $this->sub_theme_model->sub_theme_id    = $this->input->post('sub_theme_id');
            $this->sub_theme_model->theme_id        = $this->input->post('theme_id');
            $this->sub_theme_model->sub_theme_name  = $this->input->post('sub_theme_name');
            $this->sub_theme_model->active          = $this->input->post('active');
            $this->sub_theme_model->update();
            $this->session->set_flashdata('message', 'Sub Theme updated successfully');
            redirect(BASE_MODULE_URL . 'sub_theme/index','refresh');
        }
    }    
    public function delete() 
    {
        $this->sub_theme_model->sub_theme_id = $this->uri->segment('4');
        $this->sub_theme_model->delete();
        $this->session->set_flashdata('error-message', 'Sub Theme Name is deleted successfully');
        redirect(BASE_MODULE_URL . 'sub_theme/index','refresh');
    }
    /*
     * Load All Segements
     */    
    public function load_subthemes() 
    {
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->sub_theme_model->get_subthemes($request_data);

        foreach($result['result'] as $sub_theme ) 
        {  
            $nested_data = array(); 
            $nested_data[] = $sub_theme->sub_theme_id;
            $nested_data[] = $sub_theme->theme_name;
            $nested_data[] = $sub_theme->sub_theme_name;
            $nested_data[] = $sub_theme->created_on;
            $delete_url  = BASE_MODULE_URL . 'sub_theme/delete/' . $sub_theme->sub_theme_id;
            $delete_url  = "'$delete_url'" ;
            $delete_resource  = "'$sub_theme->sub_theme_name'" ;
            $nested_data[] = $sub_theme->is_active == 'N' ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>';
            
            $action =  '<span class="action_span">
                            <a href="' . BASE_MODULE_URL . 'sub_theme/edit/' . $sub_theme->sub_theme_id . '" >
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
    public function unique_check($sub_theme_name){
        $this->sub_theme_model->theme_id = $this->input->post('theme_id');
        $this->sub_theme_model->sub_theme_id = $this->input->post('sub_theme_id');
        $this->sub_theme_model->sub_theme_name = $this->input->post('sub_theme_name');
        if(!$this->sub_theme_model->unique_check()){
            $this->form_validation->set_message('unique_check', 'Sub Theme is already exists in the same theme');
            return false;
        }else{
            return true;
        }
    }
}
