<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Mangage Sub Theme
 */

class Sub_theme_model extends CI_Model 
{
    private $db;
    private $table = null;
    public $sub_theme_name = null;
    public $active = 'Y'; // default is active(Y)
    
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table = TBL_SUB_THEMES;
        $this->primary_key='sub_theme_id';
        $this->theme_table = TBL_THEMES;
    }
    
    public function save(){
        $insert_data = array (
            'theme_id'          => $this->theme_id,
            'sub_theme_name'    => $this->sub_theme_name,
            'created_on'        => date('Y-m-d H:i:s'),
        );
        $this->db->writer()->insert($this->table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    
    public function update(){
        $update_data = array (
            'theme_id'          => $this->theme_id,
            'sub_theme_name'    => $this->sub_theme_name,
            'is_active'         => $this->active
        );
        $where = array(
            'sub_theme_id' => $this->sub_theme_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->table,$update_data);
        
        return $this->db->writer()->affected_rows();
    }

    public function delete(){
        $where = array(
            'sub_theme_id' => $this->sub_theme_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->table);
        return $this->db->writer()->affected_rows();
    }
    
    public function get_subthemes($request_data) 
    {
        $boards = array();
        
        $columns = array( 
            // datatable column index  => database column name
            0 =>    'sub_theme_id', 
            1 =>    'theme_name',
            2 =>    'sub_theme_name', 
            3 =>    'created_on', 
            4 =>    'is_active'
        );
        
        
        // get and set the total records count without filter
        $count_query = $this->db->reader()
                        ->select('COUNT(sub_theme_id) AS tot_records')
                        ->from($this->table)
                        ->get();
        
        $result_set = $count_query->row();
        $boards['total_data'] = $result_set->tot_records;
        $boards['total_filtered'] = $boards['total_data'];
        
        // get and set the total filtered record counts after applied filter
        if( !empty($request_data['search']['value']) ) 
        {   
            $query = $this->db->reader()
                ->select('COUNT(sub_theme_id) AS tot_records')
                ->from($this->table)
                ->join($this->theme_table, $this->theme_table.'.theme_id ='.$this->table.'.theme_id')                          ->where(" sub_theme_name LIKE '". $request_data['search']['value'] ."%'")    
                ->get();
            
            $result_set = $count_query->row();
            $boards['total_filtered'] = $result_set->tot_records;
            
            $data_query = $this->db->reader()
                ->select($this->table.'.*,'.$this->theme_table.".theme_name")
                ->from($this->table)
                ->join($this->theme_table, $this->theme_table.'.theme_id ='.$this->table.'.theme_id')                          ->where(" sub_theme_name LIKE '". $request_data['search']['value'] ."%'")        
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
        } 
        else {
            $data_query = $this->db->reader()
                ->select($this->table.'.*,'.$this->theme_table.".theme_name")
                ->from($this->table)
                ->join($this->theme_table, $this->theme_table.'.theme_id ='.$this->table.'.theme_id')                          ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
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
            'sub_theme_id' => $this->sub_theme_id
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
                    ->select('sub_theme_id')
                    ->from($this->table)
                    ->where('sub_theme_name',$this->sub_theme_name)
                    ->where('theme_id',$this->theme_id)
                    ->where('sub_theme_id !=', $this->sub_theme_id)
                    ->limit(1)->get()->num_rows();
        if($num_rows)
        {
            return false;
        }
        return true;
    }
    
    public function get_all(){
        $query = $this->db->reader()
                        ->select('*')
                        ->from($this->table)
                        ->order_by('sub_theme_name')
                        ->get();
        return $query->result();
    }
    
}