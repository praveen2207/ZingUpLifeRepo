<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Assessment Management 
 */

class Sub_theme_test_weightage_model extends CI_Model 
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
        $this->sub_theme_table = TBL_SUB_THEMES;
        $this->questions_table = TBL_QUESTIONS;
        $this->test_sub_theme_table = TBL_TEST_SUB_THEME_MAPPING;
        //zul_sub_theme_question_mapping
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
    
    public function get_assessment_list(){
        $query = $this->db->reader()
                    ->select('*')
                    ->from($this->table)
                    ->where('is_active','Y')
                    ->order_by($this->primary_key)
                    ->get();
        return $query->result();
    }
    public function test_sub_theme_list($test_id,$theme_id){
        //get list of goals
        $query = $this->db->reader()
                ->select('sub_theme_id,sub_theme_name')
                ->from($this->sub_theme_table)
                ->where('theme_id=', $theme_id)
                ->where('is_active=', 'Y')
                ->get();
        $data = array();
        $data = $query->result_array();
        
        foreach ($data as $key => $values) {
            
            $maplinglist = array();
            $query = $this->db->reader()
                        ->select('test_sub_theme_id,weightage')
                        ->from($this->test_sub_theme_table)
                        ->where('test_id =', $test_id)
                        ->where('sub_theme_id =', $values['sub_theme_id'])
                        ->get();
            
            $maplinglist = $query->result_array();  // get mapped list and Display order

            if (count($maplinglist) >= 1) {
                if ($maplinglist[0]['test_sub_theme_id'] != '') {
                    $data[$key]['selected'] = 1;
                    $data[$key]['weightage'] = $maplinglist[0]['weightage'];
                } else {
                    $data[$key]['selected'] = '';
                    $data[$key]['weightage'] = '';
                }
            } else {
                $data[$key]['selected'] = '';
                $data[$key]['weightage'] = '';
            }
        }
        // the fetching data from database is return
        return $data;
        
    }
    public function delete($test_id){
        $where = array(
            'test_id' => $test_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->test_sub_theme_table);
        return $this->db->writer()->affected_rows();
    }
    
    public function test_sub_theme_map_insert($insert_data){
        $this->db->writer()->insert($this->test_sub_theme_table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    
    public function get_sub_theme_name($sub_theme_id){
        $where = array(
            'sub_theme_id' => $sub_theme_id
        );
        $query = $this->db->reader()
                ->select('sub_theme_name')
                ->from($this->sub_theme_table)
                ->where($where)
                ->get();
        $result = $query->result_array();
        return $result[0]['sub_theme_name'];
    }
}