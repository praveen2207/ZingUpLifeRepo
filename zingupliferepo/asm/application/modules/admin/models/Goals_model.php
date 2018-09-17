<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Assessment Management 
 */

class Goals_model extends CI_Model 
{
    private $db;
    private $table = null;
    public $goal_name = null;
    public $segment_desctiption = null;
    public $active = 'Y'; // default is active(Y)
    
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table                = TBL_GOALS;
        $this->segment_table        = TBL_GOAL_SEGMENTS;
        $this->goal_activity_table  = TBL_GOAL_ACTIVITY_MAPPING;

        $this->primary_key='goal_id';
    }
    
    public function save(){
        $insert_data = array (
            'goal_name'             => $this->goal_name,
            'goal_segment_id'       => $this->goal_segment_id,
            'goal_description'      => $this->goal_description,
            'gender'                => $this->gender,
            'goal_icon'             => $this->goal_image
        );
        $this->db->writer()->insert($this->table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    
    public function update(){
        $update_data = array (
            'goal_name'             => $this->goal_name,
            'goal_segment_id'       => $this->goal_segment_id,
            'goal_description'      => $this->goal_description,
            'gender'                => $this->gender,
            'is_active'             => $this->active
        );
        $where = array(
            'goal_id' => $this->goal_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->table,$update_data);
        
        return $this->db->writer()->affected_rows();
    }

    public function delete(){
        $where = array(
            'goal_id' => $this->goal_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->table);
        return $this->db->writer()->affected_rows();
    }
    
    public function update_goal_image(){
        $update_data = array (
            'goal_icon'           => $this->goal_image_url
        );
        $where = array(
            'goal_id' => $this->goal_id
        );
        $this->db->writer()
                ->where($where)
                ->update($this->table,$update_data);
        
        return $this->db->writer()->affected_rows();
    }
    
    public function get_goals($request_data) 
    {
        $boards = array();
        
        $columns = array( 
            // datatable column index  => database column name
            0 =>    'goal_id', 
            1 =>    'segment_name', 
            2 =>    'goal_name', 
            3 =>    'gender', 
            4 =>    'created_on', 
            5 =>    'is_active'
        );
        // get and set the total records count without filter
       // print_r($request_data);
        if(isset($request_data['goal_segment_id']) && $request_data['goal_segment_id']!=''){
            $where_sql = $this->table.'.goal_segment_id = '.$request_data['goal_segment_id'];
            $count_query = $this->db->reader()
                            ->select('COUNT(goal_id) AS tot_records')
                            ->from($this->table)
                            ->where($where_sql)
                            ->get();
        }else{
            $count_query = $this->db->reader()
                        ->select('COUNT(goal_id) AS tot_records')
                        ->from($this->table)
                        ->get();
             
        }
         
        $result_set = $count_query->row();
        $boards['total_data'] = $result_set->tot_records;
        $boards['total_filtered'] = $boards['total_data'];
        
        // get and set the total filtered record counts after applied filter
        if( !empty($request_data['search']['value']) ) 
        {   
            
            if(isset($request_data['goal_segment_id']) && $request_data['goal_segment_id']!=''){
                $where_sql = $this->table.'.goal_segment_id = '.$request_data['goal_segment_id'];
                $query = $this->db->reader()
                    ->select('COUNT(goal_id) AS tot_records')
                    ->from($this->table)
                    ->join($this->segment_table, $this->segment_table.'.goal_segment_id ='.$this->table.'.goal_segment_id')                    
                    ->where($where_sql)    
                    ->where(" goal_name LIKE '". $request_data['search']['value'] ."%'")    
                    ->get();
            }else{
                 $query = $this->db->reader()
                ->select('COUNT(goal_id) AS tot_records')
                ->from($this->table)
                ->join($this->segment_table, $this->segment_table.'.goal_segment_id ='.$this->table.'.goal_segment_id')                    
                ->where(" goal_name LIKE '". $request_data['search']['value'] ."%'")    
                ->get();
            }
            
            $result_set = $count_query->row();
            $boards['total_filtered'] = $result_set->tot_records;
            
            if(isset($request_data['goal_segment_id']) && $request_data['goal_segment_id']!=''){
                $where_sql = $this->table.'.goal_segment_id = '.$request_data['goal_segment_id'];
                $data_query = $this->db->reader()
                    ->select('*')
                    ->from($this->table)
                    ->join($this->segment_table, $this->segment_table.'.goal_segment_id ='.$this->table.'.goal_segment_id')
                    ->where($where_sql)  
                    ->where(" goal_name LIKE '". $request_data['search']['value'] ."%'")        
                    ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                    ->limit($request_data['length'],$request_data['start'])
                    ->get();
            }else{
                $data_query = $this->db->reader()
                    ->select('*')
                    ->from($this->table)
                    ->join($this->segment_table, $this->segment_table.'.goal_segment_id ='.$this->table.'.goal_segment_id')
                    ->where(" goal_name LIKE '". $request_data['search']['value'] ."%'")        
                    ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                    ->limit($request_data['length'],$request_data['start'])
                    ->get();
            }
        } 
        else {
            if(isset($request_data['goal_segment_id']) && $request_data['goal_segment_id']!=''){
                $where_sql = $this->table.'.goal_segment_id = '.$request_data['goal_segment_id'];
                $data_query = $this->db->reader()
                    ->select('*')
                    ->from($this->table)
                    ->join($this->segment_table, $this->segment_table.'.goal_segment_id ='.$this->table.'.goal_segment_id')
                    ->where($where_sql)   
                    ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                    ->limit($request_data['length'],$request_data['start'])
                    ->get();
            }else{
                $data_query = $this->db->reader()
                    ->select('*')
                    ->from($this->table)
                    ->join($this->segment_table, $this->segment_table.'.goal_segment_id ='.$this->table.'.goal_segment_id')
                    ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                    ->limit($request_data['length'],$request_data['start'])
                    ->get();
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
            'goal_id' => $this->goal_id
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
                    ->select('goal_id')
                    ->from($this->table)
                    ->where('goal_name',$this->goal_name)
                    ->where('goal_segment_id',$this->goal_segment_id)
                    ->where('goal_id !=', $this->goal_id)
                    ->limit(1)->get()->num_rows();
        if($num_rows)
        {
            return false;
        }
        return true;
    }
    
    public function get_goal_activities(){
        $where = array(
            'goal_id' => $this->goal_id
        );
        $query = $this->db->reader()
                ->select('*')
                ->from($this->goal_activity_table)
                ->where($where)
                ->get();
        return $query->result();
    }
    
    
}