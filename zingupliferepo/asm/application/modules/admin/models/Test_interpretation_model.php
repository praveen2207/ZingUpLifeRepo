<?php
/* 
 * Developer : Vadivel N
 * Date : 08 FEB, 2017
 * Description : Assessment Interpretation 
 */

class Test_interpretation_model extends CI_Model 
{
    private $db;
    private $table = null;
    public $active = 'Y'; // default is active(Y)
    
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table = TBL_THEMES;
        $this->primary_key='theme_id';
        $this->test_table = TBL_TESTS;
        $this->theme_table = TBL_THEMES;
        $this->sub_theme_table = TBL_SUB_THEMES;
        $this->interpretation_table = TBL_TEST_INTERPRETATION;
    }
    
    public function save(){
        $insert_data = array (
            'theme_id'         => $this->theme_id,
            'test_id'               => $this->test_id,
            'sub_theme_id'          => $this->sub_theme_id,
            'gender'                => $this->gender,
            'score_from'            => $this->score_from,
            'score_to'              => $this->score_to,
            'interpretation_text'   => $this->interpretation_text,
            'ideal_image'           => $this->ideal_image_url,
            'score_image'           => $this->score_image_url,
            'is_active'             => $this->active,
            'created_on'            => date('Y-m-d H:i:s'),
        );
        $this->db->writer()->insert($this->interpretation_table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    public function update(){
        $update_data = array (
            'theme_id'         => $this->theme_id,
            'test_id'               => $this->test_id,
            'sub_theme_id'          => $this->sub_theme_id,
            'gender'                => $this->gender,
            'score_from'            => $this->score_from,
            'score_to'              => $this->score_to,
            'interpretation_text'   => $this->interpretation_text,
            'is_active'             => $this->active
        );
        $where = array(
            'interpretation_id' => $this->interpretation_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->interpretation_table,$update_data);
        
        return $this->db->writer()->affected_rows();
    }
    public function update_ideal_image(){
        $update_data = array (
            'ideal_image'           => $this->ideal_image_url
        );
        $where = array(
            'interpretation_id' => $this->interpretation_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->interpretation_table,$update_data);
        
        return $this->db->writer()->affected_rows();
    }
    public function update_score_image(){
        $update_data = array (
            'score_image'           => $this->score_image_url
        );
        $where = array(
            'interpretation_id' => $this->interpretation_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->interpretation_table,$update_data);
        
        return $this->db->writer()->affected_rows();
    }
    function get_edit_record(){
        $where = array(
            'interpretation_id' => $this->interpretation_id
        );
        $query = $this->db->reader()
                ->select('*')
                ->from($this->interpretation_table)
                ->where($where)
                ->get();
        
        return $query->result();
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
    
    public function test_list($theme_id = ''){
        //get list of tests mapped to this assessment
        $this->db->reader()->select($this->test_table.'.test_id,'.$this->theme_table.'.theme_name,'.$this->test_table.'.test_name');
        $this->db->reader()->from($this->test_table."");
        $this->db->reader()->join($this->theme_table, $this->theme_table.'.theme_id ='.$this->test_table.'.theme_id') ;
        if($theme_id!=''){
            $this->db->reader()->where($this->theme_table.'.theme_id=', $theme_id);
        }
        $this->db->reader()->order_by($this->test_table.'.test_id');
        $query = $this->db->reader()->get();
        
        
        $data = array();
        $data = $query->result_array();
        return $data;
    }
    public function get_interpretations($request_data){
        $boards = array();
        $columns = array( 
            // datatable column index  => database column name
            0 =>    'interpretation_id', 
            1 =>    'sub_theme_id', 
            2 =>    'gender', 
            3 =>    'score_from', 
            4 =>    'score_to', 
            5 =>    'interpretation_text', 
            6 =>    'is_active'
        );
        
        // get and set the total records count without filter
        $count_query = $this->db->reader()
                        ->select('COUNT(interpretation_id) AS tot_records')
                        ->from($this->interpretation_table)
                        ->get();
        
        $result_set                 = $count_query->row();
        $boards['total_data']       = $result_set->tot_records;
        $boards['total_filtered']   = $boards['total_data'];
        $theme_id                   = $request_data['theme_id'];
        $test_id                    = $request_data['test_id'];
        // get and set the total filtered record counts after applied filter
        if( !empty($request_data['search']['value']) ) 
        {   
            $query = $this->db->reader()
                ->select('COUNT(interpretation_id) AS tot_records')
                ->from($this->interpretation_table)
                ->where(" theme_id = ". $theme_id)    
                ->where(" test_id = ". $test_id)    
                ->where(" interpretation_text LIKE '". $request_data['search']['value'] ."%'")    
                ->get();
            
            $result_set = $count_query->row();
            $boards['total_filtered'] = $result_set->tot_records;
            
            $data_query = $this->db->reader()
                ->select('*')
                ->from($this->interpretation_table)
                ->where(" interpretation_text LIKE '". $request_data['search']['value'] ."%'")     
                ->where(" theme_id = ". $theme_id)    
                ->where(" test_id = ". $test_id)    
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
        } 
        else {
            $data_query = $this->db->reader()
                ->select('*')
                ->from($this->interpretation_table)
                ->where(" theme_id = ". $theme_id)    
                ->where(" test_id = ". $test_id)    
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
        }
        
        $boards['result'] = $data_query->result();
        return $boards;
    }
    
    public function loadSubTheme($test_id) {
        $sql = "SELECT sub_theme.sub_theme_id,sub_theme.sub_theme_name FROM ".TBL_SUB_THEMES." as sub_theme "
                    . " LEFT JOIN zul_test_sub_theme_mapping d ON d.sub_theme_id = sub_theme.sub_theme_id "
                    . " WHERE d.test_id='$test_id'";
        
        $query = $this->db->reader()->query($sql,FALSE);   
        $result_data = $query->result();
        return $result_data;
    }
    
    
    
    function get_sub_theme_name($interpretation_id){
        $where = array(
            'interpretation_id' => $interpretation_id
        );
        $query = $this->db->reader()
                ->select($this->sub_theme_table.'.sub_theme_name')
                ->from($this->interpretation_table)
                ->join($this->sub_theme_table, $this->sub_theme_table.'.sub_theme_id ='.$this->interpretation_table.'.sub_theme_id') 
                ->where($where)
                ->get();
        //$this->db->reader()->last_query();
        return $query->result();
    }
    
    function get_theme_name($theme_id){
        $where = array(
            'theme_id' => $theme_id
        );
        $query = $this->db->reader()
                ->select('theme_name')
                ->from($this->theme_table)
                ->where($where)
                ->get();
        $theme_arr = $query->result();
        return $theme_arr[0]->theme_name;
    }
    
    function get_test_name($test_id){
        $where = array(
            'test_id' => $test_id
        );
        $query = $this->db->reader()
                ->select('test_name')
                ->from($this->test_table)
                ->where($where)
                ->get();
        $test_arr = $query->result();
        return $test_arr[0]->test_name;
    }
    
}