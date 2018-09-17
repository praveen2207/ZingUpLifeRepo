<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Assessment Management 
 */

class Activity_goal_model extends CI_Model 
{
    private $db;
    private $assessment_goal_table = null;
    private $table = null;
    
    public function __construct() 
    {
        parent::__construct();
        $this->db                       = & get_instance()->db_mgr;
        $this->primary_key              = 'goal_segment_id';
        $this->activity_table           = TBL_GOAL_ACTIVITY;
        $this->goals_table              = TBL_GOALS;
        $this->segment_table            = TBL_GOAL_SEGMENTS;
        $this->goal_activity_table      = TBL_GOAL_ACTIVITY_MAPPING;
    }
    //--------------------------------------------------------------------------
    public function get_goal_segments(){
        $query = $this->db->reader()
                    ->select('*')
                    ->from($this->segment_table)
                    ->where('is_active','Y')
                    ->order_by($this->primary_key)
                    ->get();
        return $query->result();
    }
    //--------------------------------------------------------------------------
    public function goal_list($segment_id){
        $query = $this->db->reader()
                    ->select('goal_id,goal_name')
                    ->from($this->goals_table)
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
    public function goal_activity_list($goal_id){
        //get list of goals
        $query = $this->db->reader()
                ->select('goal_activity_id,activity_name,activity_description')
                ->from($this->activity_table)
                ->where('is_active=', 'Y')
                ->get();
        $data = array();
        $data = $query->result_array();
        
        foreach ($data as $key => $values) {
            
            $maplinglist = array();
            $query = $this->db->reader()
                        ->select('goal_activity_id')
                        ->from($this->goal_activity_table)
                        ->where('goal_id =', $goal_id)
                        ->where('activity_id =', $values['goal_activity_id'])
                        ->get();
            
            $maplinglist = $query->result_array();  // get mapped list and Display order

            if (count($maplinglist) >= 1) {
                if ($maplinglist[0]['goal_activity_id'] != '') {
                    $data[$key]['selected'] = 1;
                } else {
                    $data[$key]['selected'] = '';
                }
            } else {
                $data[$key]['selected'] = '';
            }
        }
        // the fetching data from database is return
        return $data;
        
    }
    //--------------------------------------------------------------------------
    public function delete($goal_id){
        $where = array(
            'goal_id' => $goal_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->goal_activity_table);
        return $this->db->writer()->affected_rows();
    }
    //--------------------------------------------------------------------------
    public function activity_goal_map_insert($insert_data){
        $this->db->writer()->insert($this->goal_activity_table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    //--------------------------------------------------------------------------
    public function goal_activity_mapping($activity_list,$goal_id){
        $this->activity_goal_model->delete($goal_id);  
        if(count($activity_list)>=1){ 
            $data = array();          
            foreach($activity_list as $key => $values){
                $data['goal_id']        = $goal_id;
                $data['activity_id']    = $values;
                $this->activity_goal_map_insert($data); 
            }
            
        }
    }
    //--------------------------------------------------------------------------
}