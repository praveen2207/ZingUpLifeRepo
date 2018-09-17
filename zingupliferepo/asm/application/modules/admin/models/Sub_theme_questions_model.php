<?php
/* 
 * Developer : Vadivel N
 * Date : 23 JAN, 2017
 * Description : Setting up weightage based on sub_themes
 */

class Sub_theme_questions_model extends CI_Model 
{
    private $db;
    private $table = null;
    
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table = TBL_QUESTIONS;
        $this->primary_key='sub_theme_id';
        $this->sub_theme_table = TBL_SUB_THEMES;
        $this->table_sub_theme_questions =  TBL_SUB_THEME_QUESTIONS;
        
    }
    public function get_sub_theme_list(){
        $query = $this->db->reader()
                    ->select('*')
                    ->from($this->sub_theme_table)
                    ->where('is_active','Y')
                    ->order_by($this->primary_key)
                    ->get();
        return $query->result();
    }
    public function sub_theme_questions_list($sub_theme_id){
        //get list of questions as per sub_themes
        $query = $this->db->reader()
                ->select('question_id,question_text')
                ->from($this->table)
                ->where('sub_theme_id =', $sub_theme_id)
                ->where('is_active=', 'Y')
                ->get();
        $data = array();
        $data = $query->result_array();
        
        foreach ($data as $key => $values) {
            
            $maplinglist = array();
            $query = $this->db->reader()
                        ->select('sub_theme_question_id,question_weightage')
                        ->from($this->table_sub_theme_questions)
                        ->where('sub_theme_id =', $sub_theme_id)
                        ->where('question_id =', $values['question_id'])
                        ->get();
            //$this->db->reader()->last_query();
            $maplinglist = $query->result_array();  // get mapped list  

            if (count($maplinglist) >= 1) {
                if ($maplinglist[0]['sub_theme_question_id'] != '') {
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
    public function sub_theme_question_update($data){
        $sub_theme_id = $data['sub_theme_id'];
        $question_id = $data['question_id'];
        $update_data = array('question_weightage' => $data['question_weightage']);
        
        $where = array(
            'sub_theme_id' => $sub_theme_id,
            'question_id' => $question_id
        );
        $query = $this->db->reader()
                        ->select('sub_theme_question_id')
                        ->from($this->table_sub_theme_questions)
                        ->where('sub_theme_id =', $sub_theme_id)
                        ->where('question_id =', $question_id)
                        ->get();
        
        if($query->num_rows()==0){
            $insert_data = array (
                'sub_theme_id'             => $sub_theme_id,
                'question_id'       => $question_id,
                'question_weightage'      => $data['question_weightage'],
            );
            $this->db->writer()->insert($this->table_sub_theme_questions,$insert_data);
        }else{
            $this->db->writer()
                ->where($where)
                ->update($this->table_sub_theme_questions,$update_data);
        }
        return true;
    }
    
}