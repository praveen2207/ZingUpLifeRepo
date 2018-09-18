<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Answer Management 
 */

class Answer_model extends CI_Model 
{
    private $db;
    private $table = null;
    public $active = 'Y'; 
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table = TBL_ANSWERS;
        $this->primary_key='answer_id';
    }
    //-----------------------------------------------------------------------------------------------
    public function insert($data,$question_id,$answer_type) {
        if(!empty($data['text']) || !empty($data['image'])){
            $text='';
            $answer="N";    
            $single_value='';
            $answer_weightage=''; 
            $answer_check_multiple='';
            $multiple_answer_index='0';
            $image='';
            $answer_category='';
	    for ($i=0; $i < count($data['text']) ; $i++) {
                if($data['text'][$i]!=''){
                    $text=$data['text'][$i];
                }
                if(!empty($data['image'])){
                    foreach ($data['image'] as $keys => $answer_imgage){
                      if($keys==$i){
                          $image=$answer_imgage;break;}
                      else{
                         $image="";   
                      }
                    }  
                }
                if($answer_type=='SINGLE'){
                    $selected_data = $data['single_answer_index']; 
                    if(!empty($data['single_answer_index'][$i])){
                        $index_single_index=$data['single_answer_index'][$i];
                    } 
                    if(!empty($data['answer_single_weightage'][$i])){
                        $answer_weightage=$data['answer_single_weightage'][$i];
                        $answer='Y';
                    } 
                    if($selected_data==$i){
                        $answer='Y'; 
                    }
                }
                if($answer_type=='MULTIPLE'){ 
                    if(!empty($data['answer_text_multiple'][$i]) || $data['answer_text_multiple'][$i] == 0) {
                        $answer_weightage= $data['answer_text_multiple'][$i];
                        $answer='Y';
                    } 
                    if(!empty($data['multiple_answer_index'][$i])){
                        $multiple_answer_index=$data['multiple_answer_index'][$i];
                        $answer='Y';
                    }
                } 	
                if($answer_type=='WEIGHTAGE'){ 
                    if(!empty($data['answer_weightage'][$i])) {
                        $answer_weightage= $data['answer_weightage'][$i];
                    } 
                }
                if(trim($text)!='' ||  ($image!=NULL && $image!="NULL" && $image!='')){
                    $insert_data[]=array('question_id' => $question_id,
                    'answer_option_text' => $text,
                    'answer_image_url' =>$image,
                    'correct_answer' => $answer=='' ? 'N' : $answer,
                    'answer_weightage' => $answer_weightage
                    );
                }
                $single_value="";
                $answer="";
                $answer_weightage="";
                $text="";
            
            }
            if(isset($data['multiple_answer_index']) && $data['multiple_answer_index']!=""){
                $split=explode(",",$data['multiple_answer_index']);
                $index_count=count($split);
                if(isset($split)){
                    foreach ($split as $key => $value) {
                        $insert_data[$value]['correct_answer']='Y';
                    }
                }
            }
            //echo "<pre>"; print_r($insert_data);//exit;
            if(!empty($insert_data)){   
                foreach($insert_data as $insert_single){
                   $this->db->writer()->insert($this->table,$insert_single);
                }
            } 
        }
    }
    //-----------------------------------------------------------------------------------------------
    public function save(){
        
        $answer_text            = $this->answer_text;
        $answer_image           = $this->answer_image;
        $answer_weightage       = $this->answer_weightage;
        $question_id            = $this->question_id;
        $ans_count              = count($answer_text);
        
        for($i=0; $i<$ans_count; $i++){
            if($answer_text[$i]!=''){
                $insert_data = array (
                    'question_id'           => $question_id,
                    'answer_option_text'    => $answer_text[$i],
                    'answer_weightage'      => $answer_weightage[$i],
                    'created_on'            => date('Y-m-d h:m:s'),
                    'is_active'             => $this->active
                );
                $this->db->writer()->insert($this->table,$insert_data);
            }
        }
        return true;
    }
    //-----------------------------------------------------------------------------------------------
    public function update(){
        $update_data = array (
            'question_text'             => $this->question_text,
            'question_description'      => $this->question_description,
            'answer_type'               => $this->answer_type,
            'answer_interaction_type'   => $this->answer_interaction_type,
            'question_weightage'        => $this->question_weightage,
            'updated_on'                => date('Y-m-d'),
            'is_active'                 => $this->active
        );
        $where = array(
            'question_id' => $this->question_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->table,$update_data);
        
        return $this->db->writer()->affected_rows();
    }
    //-----------------------------------------------------------------------------------------------
    public function delete(){
        $where = array(
            'question_id' => $this->question_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->table);
        return $this->db->writer()->affected_rows();
    }
    //-----------------------------------------------------------------------------------------------
    public function get_questions($request_data) 
    {
        $boards = array();
        
        $columns = array( 
            // datatable column index  => database column name
            0 =>    'question_id', 
            1 =>    'question_text', 
            2 =>    'answer_type', 
            3 =>    'answer_interaction_type', 
            4 =>    'question_weightage', 
            5 =>    'created_on', 
            6 =>    'is_active'
        );
        
        
        // get and set the total records count without filter
        $count_query = $this->db->reader()
                        ->select('COUNT(question_id) AS tot_records')
                        ->from($this->table)
                        ->get();
        
        $result_set = $count_query->row();
        $boards['total_data'] = $result_set->tot_records;
        $boards['total_filtered'] = $boards['total_data'];
        
        // get and set the total filtered record counts after applied filter
        if( !empty($request_data['search']['value']) ) 
        {   
            $query = $this->db->reader()
                ->select('COUNT(question_id) AS tot_records')
                ->from($this->table)
                ->where(" question_name LIKE '". $request_data['search']['value'] ."%'")    
                ->get();
            
            $result_set = $count_query->row();
            $boards['total_filtered'] = $result_set->tot_records;
            
            $data_query = $this->db->reader()
                ->select('*')
                ->from($this->table)
                ->where(" question_name LIKE '". $request_data['search']['value'] ."%'")        
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
        } 
        else {
            $data_query = $this->db->reader()
                ->select('*')
                ->from($this->table)
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
        }
        
        $boards['result'] = $data_query->result();
        return $boards;
    }    
    //-----------------------------------------------------------------------------------------------
    public function get_record($id)
    {
        $query = $this->db->reader()
                    ->select('*')
                    ->from($this->table)
                    -> where($this->primary_key,$id)
                    ->get();
        return $query->result_array();
    }
    //-----------------------------------------------------------------------------------------------
    function get_edit_record(){
        $where = array(
            'question_id' => $this->question_id
        );
        $query = $this->db->reader()
                ->select('*')
                ->from($this->table)
                ->where($where)
                ->get();
        
        return $query->result();
    }
    //-----------------------------------------------------------------------------------------------
    public function unique_check() 
    {
        $num_rows = $this->db->reader()
                    ->select('question_id')
                    ->from($this->table)
                    ->where('question_code',$this->question_code)
                    ->where('question_id !=', $this->question_id)
                    ->limit(1)->get()->num_rows();
        if($num_rows)
        {
            return false;
        }
        return true;
    }
    //-----------------------------------------------------------------------------------------------
    public function get_answers($question_id)
    {
        $query = $this->db->reader()
            ->select('answer_id,answer_option_text,answer_image_url,answer_weightage,correct_answer')
            ->from($this->table)
            -> where('question_id',$question_id)
            -> where('is_active','Y')
            ->order_by($this->primary_key)
            ->get();
        return $query->result_array();
    }
    //-----------------------------------------------------------------------------------------------
    public function update_answers($data,$question_id){
        
        foreach ($data as $key => $value){
            
            if(isset($value['answer_option_text']) ||  isset($value['answer_image_url'])){
                $update_data = array(
                    'answer_option_text'=>$value['answer_option_text'],
                    'correct_answer'=>!empty($value['correct_answer']) ? $value['correct_answer']: '',
                    'answer_weightage'=>!empty($value['answer_weightage']) ? $value['answer_weightage']: ''
                );
                if($value['answer_image_url']!=""){
                    $update_data['answer_image_url'] =$value['answer_image_url'];
                    $value['answer_image_url']=!empty($value['answer_image_url']) ? $value['answer_image_url']: '';
                }
                $this->db->writer()
                        ->where('question_id', $value['question_id'])
                        ->where('answer_id',$value['answer_id'])
                        ->update($this->table,$update_data);
            }
        }
    }
    //-----------------------------------------------------------------------------------------------
}