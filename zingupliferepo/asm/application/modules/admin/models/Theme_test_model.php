<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Assessment Management 
 */

class Theme_test_model extends CI_Model 
{
    private $db;
    private $table = null;
    public $theme_type = null;
    public $theme_name = null;
    public $theme_code = null;
    public $active = 'Y'; // default is active(Y)
    
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table = TBL_THEMES;
        $this->primary_key='theme_id';
        $this->theme_test_table = TBL_THEME_TEST;
        $this->test_table = TBL_TESTS;
        
    }
    
    public function save(){
        $insert_data = array (
            'theme_type'   => $this->theme_type,
            'theme_name'   => $this->theme_name,
            'theme_code'   => $this->theme_code,
            'created_on'        => date('Y-m-d')
        );
        $this->db->writer()->insert($this->table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    
    public function update(){
        $update_data = array (
            'theme_type'   => $this->theme_type,
            'theme_name'   => $this->theme_name,
            'theme_code'   => $this->theme_code,
            'is_active'         => $this->active
        );
        $where = array(
            'theme_id' => $this->theme_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->table,$update_data);
        
        return $this->db->writer()->affected_rows();
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
    public function theme_tests_list($theme_id){
        $displaytype = '';

        //get order type
        $query = $this->db->reader()
                ->select('test_id,test_order_type')
                ->from($this->test_table)
                ->where('theme_id=', $theme_id)
                ->get();
        $this->db->reader()->last_query();
        $display_type_row = $query->row();
        if ($query->num_rows() > 0) {
            $displaytype = $display_type_row->test_order_type;
        }
        
        //get list of tests
        $query = $this->db->reader()
                ->select('test_id,test_name')
                ->from($this->test_table)
                ->where('theme_id =', $theme_id)
                ->where('is_active=', 'Y')
                ->get();
        $data = array();
        $data = $query->result_array();
        
        foreach ($data as $key => $values) {
            
            $maplinglist = array();
            $query = $this->db->reader()
                        ->select('test_id,test_order')
                        ->from($this->test_table)
                        ->where('theme_id =', $theme_id)
                        ->where('test_id =', $values['test_id'])
                        ->get();
            
            $maplinglist = $query->result_array();  // get mapped list and Display order

            if (count($maplinglist) >= 1) {
                if ($maplinglist[0]['test_id'] != '') {
                    $data[$key]['selected'] = 1;
                    $data[$key]['order'] = $maplinglist[0]['test_order'];
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
    public function delete($theme_id){
        $where = array(
            'theme_id' => $theme_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->theme_test_table);
        return $this->db->writer()->affected_rows();
    }
    public function theme_test_map_insert($insert_data){
        $this->db->writer()->insert($this->test_table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    public function theme_test_map_update($update_data,$theme_id,$test_id){
        $where = array(
            'theme_id' => $theme_id,
            'test_id'  => $test_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->test_table,$update_data);
        return $this->db->writer()->affected_rows();
    }
}