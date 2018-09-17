<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Assessment Management 
 */

class Questions_model extends CI_Model 
{
    private $db;
    private $table                  = null;
    public $question_text           = null;
    public $question_desctiption    = null;
    public $answer_type             = null;
    public $active = 'Y'; 
    
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table = TBL_QUESTIONS;
        $this->primary_key='question_id';
        $this->table_sub_theme_questions = TBL_SUB_THEME_QUESTIONS;
        $this->table_sub_theme = TBL_SUB_THEMES;
        $this->table_test = TBL_TESTS;
        $this->table_theme = TBL_THEMES;
    }
    
    public function save(){
        $insert_data = array (
            'question_text'             => $this->question_text,
            'question_description'      => $this->question_description,
            'answer_type'               => $this->answer_type,
            'theme_id'                  => $this->theme_id,
            'sub_theme_id'              => $this->sub_theme_id,
            'test_id'                   => $this->test_id,
            'gender'                    => $this->gender,
            'created_on'                => date('Y-m-d H:i:s'),
            'is_active'                 => $this->active
        );
        $this->db->writer()->insert($this->table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    
    public function update(){
        $update_data = array (
            'question_text'             => $this->question_text,
            'question_description'      => $this->question_description,
            'answer_type'               => $this->answer_type,
            'theme_id'                  => $this->theme_id,
            'sub_theme_id'              => $this->sub_theme_id,
            'test_id'                   => $this->test_id,
            'gender'                    => $this->gender,
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
    public function save_sub_theme($question_id){
        $insert_data = array (
            'question_id'                => $question_id,
            'sub_theme_id'               => $this->sub_theme_id,
            'mapped_on'                  => date('Y-m-d H:i:s')
        );
        $this->db->writer()->insert($this->table_sub_theme_questions,$insert_data);
        return $this->db->writer()->insert_id();
    }
    public function delete(){
        $where = array(
            'question_id' => $this->question_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->table);
        return $this->db->writer()->affected_rows();
    }
    
    public function get_questions($request_data) 
    {
        $boards = array();
        
        $columns = array( 
            // datatable column index  => database column name
            0 =>    'question_id', 
            1 =>    'theme_name',                        
            2 =>    'test_name',             
            3 =>    'sub_theme_name', 
            4 =>    'question_text', 
            5 =>    'answer_type', 
            6 =>    'created_on', 
            7 =>    'is_active'
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
                ->where(" question_text LIKE '%". $request_data['search']['value'] ."%'")    
                ->get();
            
                $result_set = $query->row();
                $boards['total_filtered'] = $result_set->tot_records;
            
            $data_query = $this->db->reader()
                ->select('*')
                ->from($this->table)
                ->where(" question_text LIKE '%". $request_data['search']['value'] ."%'") 
                ->join($this->table_theme, $this->table_theme.'.theme_id ='.$this->table.'.theme_id')
                ->join($this->table_sub_theme, $this->table_sub_theme.'.sub_theme_id ='.$this->table.'.sub_theme_id')      
                ->join($this->table_test, $this->table_test.'.test_id ='.$this->table.'.test_id')     
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
            
        } 
        else {
            
            if((isset($request_data['theme_id']) && $request_data['theme_id']!='') || (isset($request_data['test_id']) && $request_data['test_id']!='') || (isset($request_data['sub_theme_id']) && $request_data['sub_theme_id']!='')){
                
                //Total Query
                $this->db->reader()->select('*');
                $this->db->reader()->from($this->table);
                $this->db->reader()->join($this->table_theme, $this->table_theme.'.theme_id ='.$this->table.'.theme_id');
                $this->db->reader()->join($this->table_sub_theme, $this->table_sub_theme.'.sub_theme_id ='.$this->table.'.sub_theme_id');
                $this->db->reader()->join($this->table_test, $this->table_test.'.test_id ='.$this->table.'.test_id');
                if(isset($request_data['theme_id']) && $request_data['theme_id']!=''){
                    $this->db->reader()->where($this->table.'.theme_id = '.$request_data['theme_id'].'');
                }
                if(isset($request_data['test_id']) && $request_data['test_id']!=''){
                    $this->db->reader()->where($this->table.'.test_id = '.$request_data['test_id'].'');
                }
                if(isset($request_data['sub_theme_id']) && $request_data['sub_theme_id']!=''){
                    $this->db->reader()->where($this->table.'.sub_theme_id = '.$request_data['sub_theme_id'].'');
                }
                
                $this->db->reader()->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir']);
                $total_data_query =  $this->db->reader()->get();
                
                
                
                
                $this->db->reader()->select('*');
                $this->db->reader()->from($this->table);
                $this->db->reader()->join($this->table_theme, $this->table_theme.'.theme_id ='.$this->table.'.theme_id');
                $this->db->reader()->join($this->table_sub_theme, $this->table_sub_theme.'.sub_theme_id ='.$this->table.'.sub_theme_id');
                $this->db->reader()->join($this->table_test, $this->table_test.'.test_id ='.$this->table.'.test_id');
                if(isset($request_data['theme_id']) && $request_data['theme_id']!=''){
                    $this->db->reader()->where($this->table.'.theme_id = '.$request_data['theme_id'].'');
                }
                if(isset($request_data['test_id']) && $request_data['test_id']!=''){
                    $this->db->reader()->where($this->table.'.test_id = '.$request_data['test_id'].'');
                }
                if(isset($request_data['sub_theme_id']) && $request_data['sub_theme_id']!=''){
                    $this->db->reader()->where($this->table.'.sub_theme_id = '.$request_data['sub_theme_id'].'');
                }
                
                $this->db->reader()->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir']);
                $this->db->reader()->limit($request_data['length'],$request_data['start']);
                $data_query =  $this->db->reader()->get();
                
                
                
                
                
                
                //totlal Numners
                
                $tot_records = $total_data_query->num_rows();
                $boards['total_data'] = $tot_records;
                $boards['total_filtered'] = $boards['total_data'];
                
            }else{
           
                $this->db->reader()->select('*');
                $this->db->reader()->from($this->table);
                $this->db->reader()->join($this->table_theme, $this->table_theme.'.theme_id ='.$this->table.'.theme_id');
                $this->db->reader()->join($this->table_sub_theme, $this->table_sub_theme.'.sub_theme_id ='.$this->table.'.sub_theme_id');
                $this->db->reader()->join($this->table_test, $this->table_test.'.test_id ='.$this->table.'.test_id');
                $this->db->reader()->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir']);
                $this->db->reader()->limit($request_data['length'],$request_data['start']);
                $data_query =  $this->db->reader()->get();
                

                
                //totlal Numners
                /*$tot_records = $data_query->num_rows();
                $boards['total_data'] = $tot_records;
                $boards['total_filtered'] = $boards['total_data']; */
            }
                
                
                
        }
        
        $boards['result'] = $data_query->result();
        return $boards;
    }    
    public function get_record($id)
    {
        $query = $this->db->reader()
                    ->select('*')
                    ->from($this->table)
                    -> where($this->primary_key,$id)
                    ->get();
        return $query->result_array();
    }
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
    public function loadSubTheme($test_id) {
        $sql = "SELECT sub_theme.sub_theme_id,sub_theme.sub_theme_name FROM ".TBL_SUB_THEMES." as sub_theme "
                    . " LEFT JOIN zul_test_sub_theme_mapping d ON d.sub_theme_id = sub_theme.sub_theme_id "
                    . " WHERE d.test_id='$test_id'";
        
        $query = $this->db->reader()->query($sql,FALSE);    
        $data=array(); 
        foreach($query->result_array() as $row){  
            $data[$row['sub_theme_id']]=$row['sub_theme_name'];  
        } 
        return $data;
    }
    
    public function get_pre_questions($theme_id,$test_id,$question_id){
        $sql = "SELECT Q.question_id,Q.question_text,Q.question_description,Q.answer_type,A.answer_id,A.answer_option_text FROM ".TBL_QUESTIONS." as Q "
                    . " LEFT JOIN ".TBL_ANSWERS." A ON A.question_id = Q.question_id "
                    . " WHERE Q.theme_id='".$theme_id."' AND Q.test_id = '".$test_id."' AND Q.question_id!= '".$question_id."' AND Q.is_active ='Y' AND A.is_active = 'Y' ";
        $data_query = $this->db->reader()->query($sql,FALSE);    
        $questions = $data_query->result_array();
       
        $result = array();
        $i=0;
        foreach($questions as $row) {
            $question_id    = $row['question_id'];
            $answer_id      = $row['answer_id'];
            $result[$question_id]['question_id']            = $row['question_id'];
            $result[$question_id]['question_text']          = $row['question_text'];            
            $result[$question_id]['question_description']   = $row['question_description'];
            $result[$question_id]['answer_type']            = $row['answer_type'];

            if(!isset($result[$question_id]['answers'])) {
                $result[$question_id]['answers'] = array();
            }
            
            if($answer_id && !isset($result[$question_id]['answers'][$i])) {
                $answer_array = array(
                    'answer_id'             => $row['answer_id'],
                    'answer_option_text'    => $row['answer_option_text'],
                );
                $result[$question_id]['answers'][$i] = $answer_array;
            }
            $i++; 
        }
        return $result;
    }
    
    
}