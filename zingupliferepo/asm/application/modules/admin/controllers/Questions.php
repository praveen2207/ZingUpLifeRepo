<?php
/* 
 * Created By : Vadivel N
 * Created Date : 16th JAN, 2017
 * Description : Manage Questions
 */
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
class Questions extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->config('admin_constants');
        $this->load->model('questions_model');
        $this->load->model('answer_model');
    }
    
    public function index(){
        $this->load->model('theme_model');
        $data['theme_data'] = $this->theme_model->get_all();
        $data['record']['theme_id'] = '' ;       
		
        $this->load->model('test_model');
        $data['test_data'] = $this->test_model->get_all();
        $data['record']['test_id'] = '' ;
        
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
        $this->load->model('sub_theme_model');
	$data['sub_theme_data'] = $this->sub_theme_model->get_all();
        $data['record']['sub_theme_id'] = '' ;
        $this->load->model('test_model');
	$data['test_data'] = $this->test_model->get_all();
        $data['record']['test_id'] = '' ;
        
        $this->load->template(strtolower(__CLASS__) . '/create', $data  );
        if($this->input->post('btn_save') == 'save'){
            $this->questions_model->question_text        = $this->input->post('question_text');
            $this->questions_model->question_description = $this->input->post('question_description');
            $this->questions_model->answer_type          = $this->input->post('answer_type');
            $this->questions_model->theme_id             = $this->input->post('theme_id');
            $this->questions_model->sub_theme_id         = $this->input->post('sub_theme_id');
            $this->questions_model->test_id              = $this->input->post('test_id');
            $this->questions_model->gender               = $this->input->post('gender');
            $this->questions_model->active               = $this->input->post('active');
            $this->answer_model->question_id             = $this->questions_model->save();
            $this->questions_model->save_sub_theme($this->answer_model->question_id);
            $question_id = $this->answer_model->question_id;
            
            if (isset($_FILES['answer_image']['name'])) {
                $config['upload_path'] = './uploads/questions/'.$question_id."/";
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '0';
                $config['max_width']  = '0';
                $config['max_height']  = '0';
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if(!is_dir($config['upload_path'])){
                    mkdir($config['upload_path'], 0755, TRUE);
                }
                $files = $_FILES;
                $filesCount = count($_FILES['answer_image']['name']);
                for($i=0; $i<$filesCount; $i++){           
                    $_FILES['answer_image']['name']= md5(date('Y-m-d H:i:s:u')) . '_' . $files['answer_image']['name'][$i];;
                    $_FILES['answer_image']['type']= $files['answer_image']['type'][$i];
                    $_FILES['answer_image']['tmp_name']= $files['answer_image']['tmp_name'][$i];
                    $_FILES['answer_image']['error']= $files['answer_image']['error'][$i];
                    $_FILES['answer_image']['size']= $files['answer_image']['size'][$i];   
                    $fileName = md5(date('Y-m-d H:i:s:u')) . '_' . $files['answer_image']['name'][$i];
                    $images[] = $fileName;
                    $config['file_name'] = $fileName;
                    if ($this->upload->do_upload('answer_image')){
                        $file_path_db = base_url().'uploads/questions/'.$question_id."/".$fileName;
                        $answer_file_path[$i] = $file_path_db;
                    }
                }
            }
            /// answer insert
            $answer_details = array();
            if (!empty($_POST['answer_text_multiple'])) {
                $answer_details['answer_text_multiple'] = $_POST['answer_text_multiple'];
            }
            if (!empty($_POST['multiple_answer_index'])) {
                $answer_details['multiple_answer_index'] = $_POST['multiple_answer_index'];
            }
            if (isset($_POST['answer_text']) || isset($_POST['answer_text'])) {
                
                $answer_details['text'] = $_POST['answer_text'];

                if (!empty($answer_file_path)) {
                    $answer_details['image'] = $answer_file_path;
                }

                if (!empty($_POST['answer_order']))
                    $answer_details['answer_order'] = $_POST['answer_order'];


                if (isset($_POST['answer_single'])) {
                    $answer_details['single_answer_index'] = $_POST['single_answer_index'];
                    $answer_details['answer'] = $_POST['answer_single'];
                    $answer_details['answer_single_weightage'] = $_POST['answer_single_weightage'];
                }

                if (!empty($_POST['answer_weightage']))
                    $answer_details['answer_weightage'] = $_POST['answer_weightage'];

                $this->load->model('answer_model');
                $this->answer_model->insert($answer_details, $question_id, $this->questions_model->answer_type);
            }
            //echo "<pre>"; print_r($answer_details);exit;
            $this->session->set_flashdata('message', 'Question created successfully');
            redirect(BASE_MODULE_URL . 'questions/index','refresh');
        }
    }
    
    public function edit(){
        $data   = array();
        $data['action']                     = 'edit';
        $data['title']                      = 'Edit ';
        $data['action_button_text']         = 'Update';
        $this->load->model('theme_model');
	$data['theme_data'] = $this->theme_model->get_all();
        $data['record']['theme_id'] = '' ;    
        $this->load->model('sub_theme_model');
	$data['sub_theme_data'] = $this->sub_theme_model->get_all();
        $data['record']['sub_theme_id'] = '' ;
        $this->load->model('test_model');
	$data['test_data'] = $this->test_model->get_all();
        $data['record']['test_id'] = '' ;
        //get question details
        $this->questions_model->question_id = $this->uri->segment(4);
        $data['question']                   = $this->questions_model->get_edit_record();
        //echo "<pre>";print_r($data['question']);
        //get answers
        $this->load->model('answer_model');
        $question_id    = $this->uri->segment(4);
        $data['answer_details_data']    = $this->answer_model->get_answers($question_id);
       // echo "<pre>";print_r($data['answer_details_data']);        
        
        $this->load->template(strtolower(__CLASS__) . '/edit', $data  );
        
        if($this->input->post('btn_save') == 'save'){
            $this->questions_model->question_id          = $this->input->post('question_id');
            $this->questions_model->question_text        = $this->input->post('question_text');
            $this->questions_model->question_description = $this->input->post('question_description');
            $this->questions_model->theme_id             = $this->input->post('theme_id');
            $this->questions_model->sub_theme_id         = $this->input->post('sub_theme_id');
            $this->questions_model->test_id              = $this->input->post('test_id');
            $this->questions_model->answer_type          = $this->input->post('answer_type');
            $this->questions_model->gender               = $this->input->post('gender');
            $this->questions_model->active               = $this->input->post('active');
            $answer_type                                 = $this->questions_model->answer_type;
            $question_id                                 = $this->questions_model->question_id;
            $this->questions_model->update();
            /// answer update
            $answer_data = array();

            $answer_radio = $this->input->post('answer_radio');
            $category = "";
            $image_url = "";
            $answer_update = '';
            for ($k = 0; $k < $this->input->post('answer_counts') + 1; $k++) {
                $text = 'answer_' . $k . '_text';
                $image = 'answer_' . $k . '_img';
                $order_text = 'answer_' . $k . '_order_text';
                $single_text = 'answer_' . $k . '_single_text';
                $multi_text = 'answer_' . $k . '_multi_text';
                $weightage = 'answer_' . $k . '_weightage';
                $related_weightage = 'answer_' . $k . '_related_weightage';
                $main_category = 'answer_' . $k . '_main_category';
                $sub_category = 'answer_' . $k . '_sub_category';
                $answer_id = 'answer_' . $k . '_id';

                if ($answer_type == 'SINGLE') {
                    if ($answer_radio == $this->input->post($answer_id))
                        $answer = 'Y';
                    else
                        $answer = 'N';
                        $weightage = $single_text;
                }
                
                if ($answer_type == 'MULTIPLE') {

                    if ($this->input->post($multi_text) != "")
                        $answer = 'Y';
                    else
                        $answer = 'N';

                    $weightage = $multi_text;
                }

                if ($answer_type == 'WEIGHTAGE') {
                    $answer = '';
                    $weightage = $weightage;
                }            

                if ($this->input->post($text) != '' || $image_url != '') {

                    $answer_update[$k]['answer_option_text']    = $this->input->post($text);
                    $answer_update[$k]['answer_image_url']      = $image_url;
                    $answer_update[$k]['correct_answer']        = $answer;
                    $answer_update[$k]['answer_weightage']      = $this->input->post($weightage);
                    $answer_update[$k]['question_id']           = $question_id;
                    $answer_update[$k]['answer_id']             = $this->input->post($answer_id);
                    
                }
                $image_url = '';
            }
          // echo "<pre>"; print_r($answer_update); exit;
            if ($answer_update != "") {
                $this->load->model('answer_model');
                $this->answer_model->update_answers($answer_update, $question_id);
            }
            
            
            /* New answer options Insert  */
            
            $answer_details = array();
            if (!empty($_POST['new_answer_text_multiple'])) $answer_details['answer_text_multiple'] = $_POST['new_answer_text_multiple'];
            
            if (!empty($_POST['multiple_answer_index'])) $answer_details['multiple_answer_index'] = $_POST['multiple_answer_index'];
            
            if (isset($_POST['answer_text']) || isset($_POST['answer_text'])) {
                
                $answer_details['text'] = $_POST['answer_text'];
            
                if (!empty($answer_file_path)) $answer_details['image'] = $answer_file_path;
            
                if (!empty($_POST['answer_order'])) $answer_details['answer_order'] = $_POST['answer_order'];
                
                
                if (isset($_POST['answer_single'])) {
                    $answer_details['single_answer_index'] = $_POST['new_single_answer_index'];
                    $answer_details['answer'] = $_POST['answer_single'];
                    $answer_details['answer_single_weightage'] = $_POST['new_answer_single_weightage'];
                }
                
                if (!empty($_POST['new_answer_weightage'])) $answer_details['answer_weightage'] = $_POST['new_answer_weightage'];
                
                $this->answer_model->insert($answer_details, $question_id, $this->questions_model->answer_type);
            }
            
            /* End of insert  */
            
        $this->session->set_flashdata('message', 'Question details updated successfully');
        redirect(BASE_MODULE_URL . 'questions','refresh');
        }
    }    
    public function delete() 
    {
        $this->questions_model->question_id = $this->uri->segment('4');
        $this->questions_model->delete();
        $this->session->set_flashdata('error-message', 'Question is deleted successfully');
        redirect(BASE_MODULE_URL . 'questions/index','refresh');
    }
    /*
     * Load All Tests
     */    
    public function load_questions() 
    {
        $data = array();
        $request_data = $_REQUEST;
        $result = $this->questions_model->get_questions($request_data);

        foreach($result['result'] as $question ) 
        {  
            $nested_data = array(); 
            $nested_data[] = $question->question_id;
            $nested_data[] = $question->theme_name;
            $nested_data[] = $question->test_name;
            $nested_data[] = $question->sub_theme_name;
            $nested_data[] = $question->question_text;
            $nested_data[] = $question->answer_type;    
            $nested_data[] = $question->created_on;
            $delete_url         = BASE_MODULE_URL . 'questions/delete/' . $question->question_id;
            $delete_url         = "'$delete_url'" ;
            $delete_resource    = "'$question->question_text'" ;
            
            $nested_data[] = $question->is_active == 'N' ? '<i class="glyphicon glyphicon-remove"></i>' : '<i class="glyphicon glyphicon-ok"></i>';
            
            $action =  '<span class="action_span">
                            <a href="' . BASE_MODULE_URL . 'questions/edit/' . $question->question_id . '" >
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </span>';  
            
            $action .= '<span class="action_span">
                        <a href="javascript:void(0);" onclick="confirm_model('.$delete_url.','.$delete_resource.')" >
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        </span>';   
            $action .= '<span class="action_span">
                        <a href="javascript:void(0);" title="prerequisite" onclick="prerequisite_model('.$question->question_id.')" >
                                <i class="glyphicon glyphicon-random"></i>
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
    public function unique_check($question_code){
        $this->questions_model->question_id = $this->input->post('question_id');
        $this->questions_model->test_code = $question_code;
        if(!$this->questions_model->unique_check()){
            $this->form_validation->set_message('unique_check', 'Test Code is already exists');
            return false;
        }else{
            return true;
        }
    }
    
    public function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    public function simplify_multi_file_array($files = array()) {
        $sFiles = array();
        if (is_array($files) && count($files) > 0) {
            foreach ($files as $key => $file) {
                foreach ($file as $index => $attr) {
                    $sFiles[$index][$key] = $attr;
                }
            }
        }
        return $sFiles;
    }
    
    public function load_sub_theme($test_id){
        $data=$this->questions_model->loadSubTheme($test_id);
        print_r(json_encode($data));  
    }
    
    public function load_lelvels($theme_id){
        $this->load->model('test_model');
        $data=$this->test_model->get_theme_levels($theme_id);
        print_r(json_encode($data));  
    }
    
    public function load_pre_questions(){
        extract($_POST);
        $data = $this->questions_model->get_pre_questions($theme_id,$test_id,$question_id);
        ?>
        
        <?php $k = 0; $i = 1;  $c = 0; 
                    foreach ($data as $question) {
                        $i++; $k++; $c++; 
                ?>

                <fieldset class='fieldset'>
                    <span class="question">
                        <a href="javascript:void(0);" onclick="show_answers('<?php echo $question['question_id']; ?>');"><h4><?php echo $question['question_text']; ?></h4></a>
                    </span> 
                    <div class="controls" style="display:none;" id="answer_div_<?php echo $question['question_id']; ?>">
                    <?php 
                    if($question['answer_type']=='SINGLE' || $question['answer_type']=='WEIGHTAGE'){ ?>
                    <div class="col-md-12">
                    <?php $j = 0;
                    foreach ($question['answers'] as $option) {
                        $j++; 
                    ?>
                    <div style="float: left;width: 50%;">
                        <input id='radio-<?php echo $k; ?><?php echo $j; ?>' type="radio" name="option<?php echo $k; ?>[]"  value='<?php echo $option['answer_id']; ?>' onclick="selected_value(this.value,'<?php echo $question['question_id']; ?>');"/>

                    <label for="radio-<?php echo $k; ?><?php echo $j; ?>" style="font-size:14px;"><?php echo $option['answer_option_text']; ?></label>
                    </div>
                    <?php } ?>
                    </div>
                    <?php } ?>
                    <?php 
                    if($question['answer_type']=='MULTIPLE'){ ?>
                    <div class="col-md-12">
                    <?php $j = 0;
                    foreach ($question['answers'] as $option) {
                        $j++; 
                    ?>
                    <div style="<?php if ($j == 1 || $j == 2) { ?>margin-top:10px;<?php } else { ?>margin-top:30px;<?php } ?>float: left;width: 50%;">

                        <input id='radio-<?php echo $k; ?><?php echo $j; ?>' type="checkbox"  name="option<?php echo $k; ?>[]" value='<?php echo $option['answer_id']; ?>'/>

                        <label for="radio-<?php echo $k; ?><?php echo $j; ?>" style="font-size:14px;"><?php echo $option['answer_option_text']; ?></label>
                    </div>
                    <?php } ?>
                    </div>
                    <?php } ?>
                </div>     
                <input type='hidden' name='question<?php echo $k;?>' value='<?php echo $question['question_id'];?>' /> 
                </fieldset>

                <?php
                }
                ?>
    <?php }
    
    public function save_pre_questions(){
        print_r($_POST);
    }
}
