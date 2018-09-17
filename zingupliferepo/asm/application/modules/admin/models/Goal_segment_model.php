<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Assessment Management 
 */

class Goal_segment_model extends CI_Model 
{
    private $db;
    private $table = null;
    public $segment_name = null;
    public $segment_desctiption = null;
    public $active = 'Y'; // default is active(Y)
    
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table = TBL_GOAL_SEGMENTS;
        $this->primary_key='goal_segment_id';
    }
    //---------------------------------------------------------------------------------------
    public function save(){
        $insert_data = array (
            'segment_name'             => $this->segment_name,
            'segment_description'      => $this->segment_description,
        );
        $this->db->writer()->insert($this->table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    //---------------------------------------------------------------------------------------
    public function update(){
        $update_data = array (
            'segment_name'             => $this->segment_name,
            'segment_description'      => $this->segment_description,
            'is_active'                => $this->active
        );
        $where = array(
            'goal_segment_id' => $this->goal_segment_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->table,$update_data);
        
        return $this->db->writer()->affected_rows();
    }
    //---------------------------------------------------------------------------------------
    public function delete(){
        $where = array(
            'goal_segment_id' => $this->goal_segment_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->table);
        return $this->db->writer()->affected_rows();
    }
    //---------------------------------------------------------------------------------------
    public function get_segments($request_data) 
    {
        $boards = array();
        
        $columns = array( 
            // datatable column index  => database column name
            0 =>    'goal_segment_id', 
            1 =>    'segment_name', 
            2 =>    'created_on', 
            3 =>    'is_active'
        );
        
        
        // get and set the total records count without filter
        $count_query = $this->db->reader()
                        ->select('COUNT(goal_segment_id) AS tot_records')
                        ->from($this->table)
                        ->get();
        
        $result_set = $count_query->row();
        $boards['total_data'] = $result_set->tot_records;
        $boards['total_filtered'] = $boards['total_data'];
        
        // get and set the total filtered record counts after applied filter
        if( !empty($request_data['search']['value']) ) 
        {   
            $query = $this->db->reader()
                ->select('COUNT(goal_segment_id) AS tot_records')
                ->from($this->table)
                ->where(" segment_name LIKE '". $request_data['search']['value'] ."%'")    
                ->get();
            
            $result_set = $count_query->row();
            $boards['total_filtered'] = $result_set->tot_records;
            
            $data_query = $this->db->reader()
                ->select('*')
                ->from($this->table)
                ->where(" segment_name LIKE '". $request_data['search']['value'] ."%'")        
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
    //---------------------------------------------------------------------------------------
    public function get_record($id)
    {
        $query = $this->db->reader()
                    ->select('*')
                    ->from($this->table)
                    -> where($this->primary_key,$id)
                    ->get();
        return $query->result_array();
    }
    //---------------------------------------------------------------------------------------
    function get_edit_record(){
        $where = array(
            'goal_segment_id' => $this->goal_segment_id
        );
        $query = $this->db->reader()
                ->select('*')
                ->from($this->table)
                ->where($where)
                ->get();
        
        return $query->result();
    }
    //---------------------------------------------------------------------------------------
    public function unique_check() 
    {
        $num_rows = $this->db->reader()
                    ->select('goal_segment_id')
                    ->from($this->table)
                    ->where('segment_name',$this->segment_name)
                    ->where('goal_segment_id !=', $this->goal_segment_id)
                    ->limit(1)->get()->num_rows();
        if($num_rows)
        {
            return false;
        }
        return true;
    }
    //---------------------------------------------------------------------------------------
    public function get_all(){
        $query = $this->db->reader()
                        ->select('*')
                        ->from($this->table)
                        ->order_by('goal_segment_id')
                        ->get();
        return $query->result();
    }
    //---------------------------------------------------------------------------------------
}