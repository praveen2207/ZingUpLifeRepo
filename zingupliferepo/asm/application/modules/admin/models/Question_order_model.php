<?php
/* 
 * Developer : Vadivel N
 * Created Date : 24 MAR, 2017
 * Description :  Manage question order
 */

class Question_order_model extends CI_Model 
{
    private $db;
    private $table = null;
    
    public function __construct() 
    {
        parent::__construct();
        $this->db               = & get_instance()->db_mgr;
        $this->table            = TBL_THEMES;
        $this->primary_key      ='theme_id';
        $this->theme_test_table = TBL_THEME_TEST;
        $this->test_table       = TBL_TESTS;
        $this->question_table   = TBL_QUESTIONS;
    }
    
    public function get_theme_list(){
        $query = $this->db->reader()
                    ->select('*')
                    ->from($this->table)
                    ->where('is_active','Y')
                    ->order_by($this->primary_key)
                    ->get();
        return $query->result();
    }
    
    public function theme_questions_list($theme_id,$level_id,$gender){
        $displaytype = '';

        //get order type
        $this->db->reader()->select('question_id,question_order_type');
        $this->db->reader()->from($this->question_table);
        $this->db->reader()->where('theme_id=', $theme_id);
        $this->db->reader()->where('test_id=', $level_id);
        if($gender == 'BOTH'){
            $this->db->reader()->where('gender=', $gender);
        }else{
            $this->db->reader()->where('(gender="'.$gender.'" OR gender = "BOTH")');
        }
        $this->db->reader()->where('is_active=', 'Y');
        $query =  $this->db->reader()->get();
        //echo $this->db->reader()->last_query(); exit;
        $display_type_row = $query->row();
        if ($query->num_rows() > 0) {
            $displaytype = $display_type_row->question_order_type;
        }
        
        //get list of questions
        $this->db->reader()->select('question_id,question_text,gender');
        $this->db->reader()->from($this->question_table);
        $this->db->reader()->where('theme_id=', $theme_id);
        $this->db->reader()->where('test_id=', $level_id);
        if($gender == 'BOTH'){
            $this->db->reader()->where('gender=', $gender);
        }else{
            $this->db->reader()->where('(gender="'.$gender.'" OR gender = "BOTH")');
        }        
        $this->db->reader()->where('is_active=', 'Y');
        if($displaytype=='ORDER'){
            $this->db->reader()->order_by('question_order','ASC');
        }
        $query = $this->db->reader()->get();
        
        $data = array();
        $data = $query->result_array();
        
        foreach ($data as $key => $values) {
            
            $maplinglist = array();
            $query = $this->db->reader()
                        ->select('question_id,question_order')
                        ->from($this->question_table)
                        ->where('theme_id=', $theme_id)
                        ->where('test_id=', $level_id)
                        ->where('question_id =', $values['question_id'])
                        ->get();
            
            $maplinglist = $query->result_array();  // get mapped list and Display order

            if (count($maplinglist) >= 1) {
                if ($maplinglist[0]['question_id'] != '') {
                    $data[$key]['selected'] = 1;
                    $data[$key]['order'] = $maplinglist[0]['question_order'];
                } else {
                    $data[$key]['selected'] = '';
                    $data[$key]['order'] = '';
                }
            } else {
                $data[$key]['selected'] = '';
                $data[$key]['order'] = '';
            }
            $data[$key]['displaytype'] = $displaytype;
        }
        // the fetching data from database is return
        
        return $data;
        
    }

    public function theme_test_map_update($update_data,$theme_id,$test_id,$question_id){
        $where = array(
            'theme_id'      => $theme_id,
            'test_id'       => $test_id,
            'question_id'   => $question_id,
        );
        //echo "<pre>";
       // print_r($update_data);exit;
        $this->db->writer()
                ->where($where)
                ->update($this->question_table,$update_data);
       return $this->db->writer()->affected_rows();
    }
}