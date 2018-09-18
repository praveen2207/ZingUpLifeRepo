<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Assessment Management 
 */

class Advice_model extends CI_Model 
{
    private $db;
    private $table = null;
    public $advice_type = null;
    public $advice_description = null;
    public $assessment_code = null;
    public $active = 'Y'; // default is active(Y)
    
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table = TBL_ADVICE_MASTER;
        $this->goal_table = TBL_GOALS;
        $this->primary_key='advice_id';
    }
    
    public function save(){
        $insert_data = array (
            'advice_type'           => $this->advice_type,
            'advice_source'         => $this->advice_source,
            'advice_description'    => $this->advice_description,
            'goal_id'               => $this->goal_id,
            'is_active'             => $this->active
        );
        $this->db->writer()->insert($this->table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    
    public function update(){
        $update_data = array (
            'advice_type'           => $this->advice_type,
            'advice_source'         => $this->advice_source,
            'advice_description'    => $this->advice_description,
            'goal_id'               => $this->goal_id,
            'is_active'             => $this->active
        );
        $where = array(
            'advice_id' => $this->advice_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->table,$update_data);
        
        return $this->db->writer()->affected_rows();
    }

    public function delete(){
        $where = array(
            'advice_id' => $this->advice_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->table);
        return $this->db->writer()->affected_rows();
    }
    
    public function get_advice($request_data) 
    {
        $boards = array();
        
        $columns = array( 
            // datatable column index  => database column name
            0 =>    'advice_id', 
            1 =>    'advice_source', 
            2 =>    'advice_type', 
            3 =>    'goal_name', 
            4 =>    'advice_description', 
            5 =>    'added_on', 
            6 =>    'is_active'
        );
        
        
        // get and set the total records count without filter
        $count_query = $this->db->reader()
                        ->select('COUNT(advice_id) AS tot_records')
                        ->from($this->table)
                        ->get();
        
        $result_set = $count_query->row();
        $boards['total_data'] = $result_set->tot_records;
        $boards['total_filtered'] = $boards['total_data'];
        
        // get and set the total filtered record counts after applied filter
        if( !empty($request_data['search']['value']) ) 
        {   
            $query = $this->db->reader()
                ->select('COUNT(advice_id) AS tot_records')
                ->from($this->table)
                ->join($this->goal_table, $this->goal_table.'.goal_id ='.$this->table.'.goal_id')
                ->where(" advice_description LIKE '". $request_data['search']['value'] ."%'")    
                ->get();
            
            $result_set = $count_query->row();
            $boards['total_filtered'] = $result_set->tot_records;
            
            $data_query = $this->db->reader()
                ->select('*,"'.$this->goal_table.'",goal_name')
                ->from($this->table)
                ->join($this->goal_table, $this->goal_table.'.goal_id ='.$this->table.'.goal_id','left')
                ->where(" advice_description LIKE '". $request_data['search']['value'] ."%'")        
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
        } 
        else {
            $data_query = $this->db->reader()
                ->select('*,"'.$this->goal_table.'",goal_name')
                ->from($this->table)
                ->join($this->goal_table, $this->goal_table.'.goal_id ='.$this->table.'.goal_id','left')
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
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
            'advice_id' => $this->advice_id
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
                    ->select('advice_id')
                    ->from($this->table)
                    ->where('assessment_code',$this->assessment_code)
                    ->where('advice_id !=', $this->advice_id)
                    ->limit(1)->get()->num_rows();
        if($num_rows)
        {
            return false;
        }
        return true;
    }
    //--------------------------------------------------------------------------
    public function goal_list($segment_id){
        $query = $this->db->reader()
                    ->select('goal_id,goal_name')
                    ->from($this->goal_table)
                    ->where('goal_segment_id',$segment_id)
                    ->order_by('goal_id')
                    ->get();
        $data=array(); 
        foreach($query->result_array() as $row){  
        $data[$row['goal_id']]=$row['goal_name'];  
        } 
        return $data;
    }
    //--------------------------------------------------------------------------
    public function get_goal_data($segment_id){
        $where = array(
            'goal_segment_id'          => $segment_id
        );
        $query = $this->db->reader()
                ->select('*')
                ->from($this->goal_table)
                ->where($where)
                ->get();
        return $query->result();
    }
    //--------------------------------------------------------------------------
    public function get_segment_id($goal_id){
        $where = array(
            'goal_id'          => $goal_id
        );
        $query = $this->db->reader()
                ->select('goal_segment_id')
                ->from($this->goal_table)
                ->where($where)
                ->get();
        $row = $query->result();
        return $row[0]->goal_segment_id;
    }
    //--------------------------------------------------------------------------
}