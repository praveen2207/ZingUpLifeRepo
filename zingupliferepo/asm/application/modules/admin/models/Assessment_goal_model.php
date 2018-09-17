<?php
/* 
 * Developer : Vadivel N
 * Date : 06 JAN, 2017
 * Description : Assessment Management 
 */

class Assessment_goal_model extends CI_Model 
{
    private $db;
    private $table = null;
    
    public function __construct() 
    {
        parent::__construct();
        $this->db                       = & get_instance()->db_mgr;
        $this->table                    = TBL_THEMES;
        $this->primary_key              = 'theme_id';
        $this->test_table               = TBL_TESTS;
        $this->assessment_test_table    = TBL_THEME_TEST;
        $this->goals_table              = TBL_GOALS;
        $this->sub_theme_table          = TBL_SUB_THEMES;
        $this->test_sub_theme_table     = TBL_TEST_SUB_THEME_MAPPING;
        $this->goal_mapping_table       = TBL_GOAL_MAPPING;
        $this->goal_table               = TBL_GOALS;
                
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
    
    public function assessment_test_list($theme_id){
        $query = $this->db->reader()
                    ->select($this->test_table.".test_id,".$this->test_table.".test_name")
                    ->from($this->test_table)
                    ->join($this->assessment_test_table, $this->assessment_test_table.'.test_id ='.$this->test_table.'.test_id')
                    ->where($this->assessment_test_table.'.theme_id',$theme_id)
                    ->order_by($this->assessment_test_table.'.theme_test_id')
                    ->get();
        $data=array(); 
        foreach($query->result_array() as $row){  
        $data[$row['test_id']]=$row['test_name'];  
        } 
        return $data;
    }
    
    public function test_sub_theme_list($test_id){
        $query = $this->db->reader()
                    ->select($this->sub_theme_table.".sub_theme_id,".$this->sub_theme_table.".sub_theme_name")
                    ->from($this->sub_theme_table)
                    ->join($this->test_sub_theme_table, $this->test_sub_theme_table.'.sub_theme_id ='.$this->sub_theme_table.'.sub_theme_id')
                    ->where($this->test_sub_theme_table.'.test_id',$test_id)
                    ->order_by($this->sub_theme_table.'.sub_theme_name')
                    ->get();
        $data=array(); 
        foreach($query->result_array() as $row){  
        $data[$row['sub_theme_id']]=$row['sub_theme_name'];  
        } 
        return $data;
    }
    
    
    public function save($insert_data){
        $this->db->writer()->insert('zul_goal_mapping',$insert_data);
        return $this->db->writer()->insert_id();
    }
    public function getMapping(){
        
        $sql = "SELECT goal_id,themes.theme_name,sub_themes.sub_theme_name,tests.test_name,GM.score_from,GM.score_to,GM.score_level FROM zul_goal_mapping GM "
                . " INNER JOIN ".TBL_THEMES." themes ON themes.theme_id = GM.theme_id "
                . " INNER JOIN ".TBL_SUB_THEMES." sub_themes ON sub_themes.sub_theme_id = GM.sub_theme_id "
                . " INNER JOIN ".TBL_TESTS." tests ON tests.test_id = GM.test_id "
                . " ORDER BY GM.goal_id";
       
        $data_query = $this->db->reader()->query($sql,FALSE);    
        $questions = $data_query->result_array();
       
        $result = array();
        $i=0;
        
        foreach($questions as $row) {
            $question_id                                    = $row['goal_id'];
            $result[$question_id]['goal_id']                = $row['goal_id'];
            $test_id                                        = $row['test_name'];
            
            if(!isset($result[$question_id]['theme_ids'])) {
                $result[$question_id]['theme_ids'] = array();
            }
            if($question_id && !isset($result[$question_id]['theme_ids'][$i])) {
                $answer_array = array(
                    'theme_id'        => $row['theme_name'],
                );
                $result[$question_id]['theme_ids'][$i] = $answer_array;
            }
            
            if(!isset($result[$question_id][$test_id]['sub_theme_ids'])) {
                $result[$question_id][$test_id]['sub_theme_ids'] = array();
            }
            
            if($question_id && $test_id && !isset($result[$question_id][$test_id]['sub_theme_ids'][$i])) {
                $answer_array = array(
                    'score_from'        => $row['score_from'],
                    'score_from'        => $row['score_from'],
                    'score_level'       => $row['score_level']
                );
                $result[$question_id][$test_id]['sub_theme_ids'][$i] = $answer_array;
            }
           
            
            
            /*$result[$question_id]['test_name']              = $row['test_name'];
            $result[$question_id]['theme_name']             = $row['theme_name'];
            $result[$question_id]['sub_theme_name']         = $row['sub_theme_name'];
            
            if(!isset($result[$question_id]['score_levels'])) {
                $result[$question_id]['score_levels'] = array();
            }
            
            if($question_id && !isset($result[$question_id]['score_levels'][$i])) {
                $answer_array = array(
                    'score_from'        => $row['score_from'],
                    'score_from'        => $row['score_from'],
                    'score_level'       => $row['score_level']
                );
                $result[$question_id]['score_levels'][$i] = $answer_array;
            }*/
            $i++; 
        }
        
        //$xml = new SimpleXMLElement('<root/>');
        //$this->array2XML($xml, $result);
        
        //echo (($xml->asXML('data.xml')) ? 'Your XML file has been generated successfully!' : 'Error generating XML file!');
        
        
        echo "<pre>"; 
        print_r($result);
        exit;
    }
    public function array2XML($obj, $array) 
    {
        foreach ($array as $key => $value)
        {
            if(is_numeric($key))
                $key = 'goal' . $key;

            if (is_array($value))
            {
                $node = $obj->addChild($key);
                $this->array2XML($node, $value);
            }
            else
            {
                $obj->addChild($key, htmlspecialchars($value));
            }
        }
    }
    
    public function get_goal_mapping($request_data) 
    {
        $boards = array();
        
        $columns = array( 
            // datatable column index  => database column name
            0 =>    'goal_mapping_id', 
            1 =>    'theme_name', 
            2 =>    'test_name', 
            3 =>    'sub_theme_name', 
            4 =>    'goal_name', 
            5 =>    'score_from', 
            6 =>    'score_to', 
            7 =>    'score_level' 
        );
        
        
        // get and set the total records count without filter
        $count_query = $this->db->reader()
                        ->select('COUNT(goal_mapping_id) AS tot_records')
                        ->from($this->goal_mapping_table)
                        ->get();
        
        $result_set = $count_query->row();
        $boards['total_data'] = $result_set->tot_records;
        $boards['total_filtered'] = $boards['total_data'];
        
        // get and set the total filtered record counts after applied filter
        if( !empty($request_data['search']['value']) ) 
        {   
            $query = $this->db->reader()
                ->select('COUNT(goal_mapping_id) AS tot_records')
                ->from($this->goal_mapping_table)
                ->where(" score_level LIKE '". $request_data['search']['value'] ."%'")    
                ->get();
            
            $result_set = $count_query->row();
            $boards['total_filtered'] = $result_set->tot_records;
            
            $data_query = $this->db->reader()
            ->select('*')
            ->from($this->goal_mapping_table)
            ->where(" score_level LIKE '". $request_data['search']['value'] ."%'")        
            ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
            ->limit($request_data['length'],$request_data['start'])
            ->get();
        } 
        else {
            $data_query = $this->db->reader()
                ->select('goal_mapping_id,theme_name,sub_theme_name,goal_name,test_name,score_from,score_to,score_level')
                ->from($this->goal_mapping_table)
                ->join($this->goal_table, $this->goal_table.'.goal_id ='.$this->goal_mapping_table.'.goal_id')
                ->join($this->test_table, $this->test_table.'.test_id ='.$this->goal_mapping_table.'.test_id')                ->join($this->table, $this->table.'.theme_id ='.$this->goal_mapping_table.'.theme_id')
                ->join($this->sub_theme_table, $this->sub_theme_table.'.sub_theme_id ='.$this->goal_mapping_table.'.sub_theme_id')
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
        }
        //echo $this->db->reader()->last_query();
        $boards['result'] = $data_query->result();
        return $boards;
    }    
    public function delete(){
        $where = array(
            'goal_mapping_id' => $this->goal_mapping_id
        );
        $this->db->writer()
                ->where($where)
                ->delete($this->goal_mapping_table);
        return $this->db->writer()->affected_rows();
    }
    
}