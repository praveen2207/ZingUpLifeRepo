<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Assessment Management 
 */

class Test_questions_model extends CI_Model 
{
    private $db;
    private $table = null;
    public $assessment_type = null;
    public $assessment_name = null;
    public $assessment_code = null;
    public $active = 'Y'; // default is active(Y)
    
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table = TBL_THEMES;
        $this->primary_key='test_id';
        $this->test_questions = TBL_TEST_QUESTIONS;
        $this->test_table = TBL_TESTS;
        $this->dimension_table = TBL_DIMENSIONS;
        $this->questions_table = TBL_QUESTIONS;
    }
    
    public function get_test_list(){
        $query = $this->db->reader()
                    ->select('*')
                    ->from($this->test_table)
                    ->where('is_active','Y')
                    ->order_by($this->primary_key)
                    ->get();
        return $query->result();
    }
    public function get_dimension_list(){
        $query = $this->db->reader()
                    ->select('*')
                    ->from($this->dimension_table)
                    ->where('is_active','Y')
                    ->order_by('dimension_id')
                    ->get();
        return $query->result();
    }
    public function test_questions_list($test_id,$dimension_id = ''){
        //get list of questions available for this dimensions
        $query = $this->db->reader()
                ->select('questions.question_id, questions.question_text,dimension.dimension_name,,dimension.dimension_id')
                ->from($this->questions_table." as questions")
                ->join($this->dimension_table." as dimension", 'dimension.dimension_id = questions.dimension_id')
                //->where('dimension_id=', $dimension_id)
                ->where('questions.is_active=', 'Y')
                ->order_by('questions.dimension_id')
                ->get();
        //echo $this->db->reader()->last_query();    
        $data = array();
        $data = $query->result_array();
        
        foreach ($data as $key => $values) {
            
            $maplinglist = array();
            $query = $this->db->reader()
                        ->select('test_question_id,question_weightage')
                        ->from($this->test_questions)
                        ->where('test_id =', $test_id)
                        ->where('question_id =', $values['question_id'])
                        ->get();
            
            $maplinglist = $query->result_array();  // get mapped list and Display order

            if (count($maplinglist) >= 1) {
                if ($maplinglist[0]['test_question_id'] != '') {
                    $data[$key]['selected'] = 1;
                    $data[$key]['question_weightage'] = $maplinglist[0]['question_weightage'];
                } else {
                    $data[$key]['selected'] = '';
                    $data[$key]['question_weightage'] = '';
                }
            } else {
                $data[$key]['selected'] = '';
                $data[$key]['question_weightage'] = '';
            }
        }
        // the fetching data from database is return
        return $data;
        
    }
    public function delete($test_id,$dimension_id = ''){
        $where = array(
            'test_id' => $test_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->test_questions);
        return $this->db->writer()->affected_rows();
    }
    public function test_questions_map_insert($insert_data){
        $this->db->writer()->insert($this->test_questions,$insert_data);
        return $this->db->writer()->insert_id();
    }
    
}