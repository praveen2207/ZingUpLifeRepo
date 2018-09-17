<?php

/* 
 * Created By : Vadivel N
 * Created Date : 27th OCT, 2016
 * Description : Manage Users
 */
class User extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('user_model');
    }
    public function index(){
        $data['message'] = $this->session->flashdata('message');
        $this->load->template(strtolower(__CLASS__) . '/index',$data  );
    }
    public function create(){
        $data 					= array();
        $data['action'] 			= 'create';
        $data['title'] 				= 'Create ';
        $data['action_button_text']             = 'Save';
        $this->form_validation->set_rules('username', 'user name', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }
        else{
            $this->user_model->user_id          = $this->input->post('user_id');
            $this->user_model->username         = $this->input->post('username');
            $this->user_model->first_name       = $this->input->post('first_name');
            $this->user_model->last_name        = $this->input->post('last_name');
            $this->user_model->user_email       = $this->input->post('user_email');
            $this->user_model->user_type        = $this->input->post('user_type');
            $this->user_model->user_contact_no  = $this->input->post('user_contact_no');
            $this->user_model->active           = $this->input->post('active');
            $this->user_model->password_text    = $this->input->post('user_password');
            $this->user_model->password         = password_hash($this->user_model->password_text,1);
            $this->user_model->save();
            $this->session->set_flashdata('message', 'user is created successfully');
            redirect(BASE_MODULE_URL . 'user/index','refresh');
        }
    }
    public function edit(){
        $data   = array();
        $data['action']             = 'edit';
        $data['title']              = 'Edit ';
        $data['action_button_text'] = 'Update';
        $id                         = $this->uri->segment(4);
        $this->form_validation->set_rules('username', 'user name', 'required|callback_unique_check');
        if ($this->form_validation->run() === FALSE){
            $this->user_model->user_id 	= $this->uri->segment('4');
            $data['user']                        = $this->user_model->get_edit_record();
            $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        }else{
            $this->user_model->user_id          = $this->input->post('user_id');
            $this->user_model->state            = $this->input->post('person_state');
            $this->user_model->district         = $this->input->post('person_district');
            $this->user_model->username         = $this->input->post('username');
            $this->user_model->first_name       = $this->input->post('first_name');
            $this->user_model->last_name        = $this->input->post('last_name');
            $this->user_model->user_email       = $this->input->post('user_email');
            $this->user_model->user_type        = $this->input->post('user_type');
            $this->user_model->user_contact_no  = $this->input->post('user_contact_no');
            $this->user_model->active           = $this->input->post('active');
            $this->user_model->update();
            
            $this->session->set_flashdata('message', 'user is updated successfully');
            redirect(BASE_MODULE_URL . 'user/index','refresh');
        }
    }    
    public function delete() 
    {
        $this->user_model->user_id = $this->uri->segment('4');
        $this->user_model->delete();
        $this->session->set_flashdata('error-message', 'user is deleted successfully');
        redirect(BASE_MODULE_URL . 'user/index','refresh');
    }
    /*
     * Load All subcategory
     */    
    public function load_users() 
    {
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->user_model->get_users($request_data);
        
        
        foreach($result['result'] as $user ) 
        {  
            $nested_data = array(); 
            $full_name = $user->first_name." ".$user->last_name; 
            $nested_data[] = $user->user_id;
            $nested_data[] = $full_name;
            $nested_data[] = $user->username;
            $nested_data[] = $user->email;
            if($user->user_type ==0) { $usert_type = "Admin"; }
            if($user->user_type ==1) { $usert_type = "Content Writer"; }
            if($user->user_type ==2) { $usert_type = "Data Upload"; }
            $nested_data[]      = $usert_type;
            $delete_url         = BASE_MODULE_URL . 'user/delete/' . $user->user_id;
            $delete_url         = "'$delete_url'" ;
            $delete_resource    = "'$user->username'" ;
            
            $nested_data[] = $user->active == '0' ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>';
            
            $action =  '<span class="action_span">
                            <a href="' . BASE_MODULE_URL . 'user/edit/' . $user->user_id . '" >
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
    public function unique_check($user_name){
        $this->user_model->user_id = $this->input->post('user_id');
        $this->user_model->username = $user_name; //$this->input->post('board_name');
        if(!$this->user_model->unique_check()){
            $this->form_validation->set_message('unique_check', 'Username is already exists');
            return false;
        }else{
            return true;
        }
    }
    public function load_district($district_id){
        $this->load->model('Persons_model');
        $data=$this->Persons_model->loadDistrict($district_id);
        print_r(json_encode($data));   
    }
}
