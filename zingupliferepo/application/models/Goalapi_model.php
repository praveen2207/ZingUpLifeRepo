<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GoalApi_model extends CI_Model {

    public $timezone;
    function __construct() {
        parent::__construct();
        $this->load->config('db_constants');
        $this->load->library('Curl');
        $this->timezone = date('Y-m-d\TH:i:s\Z', time());
    }

    //---------------------------------------------------------------------------------------------
    public function getGoals(){
        

        $this->db->select('goal_id,goal_name,goal_description,gender, goal_icon,goal_segment_id');
        $this->db->from('zul_goals');
        $this->db->where('is_active', 'Y');
        $q = $this->db->get();
        //echo $this->db->last_query();
        foreach ($q->result() as $k) {

            $this->db->select('goal_segment_id,segment_name,segment_description');
            $this->db->from('zul_goal_segments');
            $this->db->where('goal_segment_id', $k->goal_segment_id);
            $g = $this->db->get();
            $t = $g->result();
            $k->segment_name = $t[0]->segment_name;
            $k->segment_description = $t[0]->segment_description;

            if ($k->gender == NULL) {
                $k->gender = 'BOTH';
            }

            $this->db->select('a.goal_activity_id,a.activity_name');
            $this->db->from('zul_goal_activity as a');
            $this->db->join('zul_goal_activity_mapping', 'zul_goal_activity_mapping.activity_id = a.goal_activity_id');
            $this->db->where('zul_goal_activity_mapping.goal_id = ', $k->goal_id);
            $answer_query = $this->db->get();
            $result_ans = $answer_query->result();
            $k->activities = $result_ans;
        }
        
        $result = $this->_goals_group_by($q->result_array());
        return $result;
    }

    //--------------------------------------------------------------------------
    public function getGoal(){
        

        $this->db->select('goal_id,goal_name,goal_description,gender, goal_icon,goal_segment_id');
        $this->db->from('zul_goals');
        $this->db->where('is_active', 'Y');
        $this->db->where('goal_id', $this->goal_id);
        $q = $this->db->get();
        //echo $this->db->last_query();
        foreach($q->result() as $k){

            $this->db->select('segment_name,segment_description');
            $this->db->from('zul_goal_segments');
            $this->db->where('goal_segment_id',$k->goal_segment_id);
            $g = $this->db->get();
            $t = $g->result();
            $k->segment_name        = $t[0]->segment_name; 
            $k->segment_description = $t[0]->segment_description; 

            if($k->gender == NULL){
                $k->gender = 'BOTH';
            }
            
            $this->db->select('a.goal_activity_id,a.activity_name');
            $this->db->from('zul_goal_activity as a');
            $this->db->join('zul_goal_activity_mapping', 'zul_goal_activity_mapping.activity_id = a.goal_activity_id');
            $this->db->where('zul_goal_activity_mapping.goal_id = ',$k->goal_id);
            $answer_query = $this->db->get();
            $result_ans = $answer_query->result();
            $k->activities = $result_ans;
            
        }
        //echo "<pre>";
        //print_r($q->result());
        return $q->result();
        
        
    }
    //---------------------------------------------------------------------------------------------
    public function getRecommendedGoals($user_id , $theme_id){

        $this->load->model('User');
    	$userDetails = $this->User->getbasicDetails($user_id); //print_r($userDetails);
    	$gender = $userDetails[0]->gender;
        $goals          = [];
        if(isset($gender)){
           
        /*$query = "SELECT ZUT.user_id,ZUT.test_id,ZUT.theme_id,ZUT.marks_scored theme_marks,".
                "Z.sub_theme_id,Z.marks_scored sub_theme_marks,G.goal_id,GM.goal_name,".
                "GM.goal_description,GM.gender,GM.goal_icon,".
                "GSM.segment_name,GSM.goal_segment_id,GSM.segment_description FROM zul_user_themes ZUT,zul_user_sub_theme_score Z,".
                "zul_goal_mapping G, zul_goals GM,zul_goal_segments GSM WHERE ".
                "ZUT.user_theme_id = Z.user_theme_id AND G.theme_id = ZUT.theme_id AND ".
                "G.test_id = ZUT.test_id AND G.sub_theme_id = Z.sub_theme_id AND Z.marks_scored ".
                "BETWEEN G.score_from and G.score_to AND GM.goal_id = G.goal_id AND ".
                "GM.goal_segment_id = GSM.goal_segment_id AND ZUT.user_id = ".$user_id." AND ZUT.theme_id = ".$theme_id." AND ".
                "GM.gender IN('".$gender."', 'BOTH')  ORDER BY GSM.segment_name ";*/
		
		
	if($theme_id == 3){
	        
	        $isFamilyOrParent = "SELECT UTR.answer_id FROM zul_user_themes UT,zul_user_test_response UTR where  UT.user_id = ".$user_id." and UT.theme_id = 3 and UT.user_theme_id = UTR.user_theme_id
	    and UTR.question_id = 115";
	        $answer   = $this->db->query($isFamilyOrParent)->row()->answer_id;
	        $family = array(469,470,471); //15 family Subtheme
	        $parenting    = array(472,473);//43 is parenting Subtheme
	        $dontShowSubThemeId = (in_array($answer,$family))? 43: 15;
	        
	        $query = "SELECT ZUT.user_id,GSM.goal_segment_id,GSM.segment_name,GSM.segment_description,G.goal_id,
                    GM.goal_name,GM.goal_description,GM.gender,GM.goal_icon, count(*) FROM
                    zul_user_themes ZUT,zul_user_sub_theme_score Z,zul_goal_mapping G, zul_goals GM,zul_goal_segments GSM WHERE
                    ZUT.user_theme_id = Z.user_theme_id AND G.theme_id = ZUT.theme_id AND G.test_id = ZUT.test_id AND
                    G.sub_theme_id = Z.sub_theme_id AND Z.marks_scored BETWEEN G.score_from and G.score_to AND GM.goal_id = G.goal_id AND
                    GM.goal_segment_id = GSM.goal_segment_id AND ZUT.user_id = ".$user_id." AND ZUT.theme_id = ".$theme_id." AND GM.gender IN('".$gender."', 'BOTH') AND
                    G.sub_theme_id != ".$dontShowSubThemeId." GROUP BY goal_segment_id, goal_id ORDER BY GSM.segment_name";
	        
	    }else{
	        $query = "SELECT ZUT.user_id,GSM.goal_segment_id,GSM.segment_name,GSM.segment_description,G.goal_id,
                    GM.goal_name,GM.goal_description,GM.gender,GM.goal_icon, count(*) FROM
                    zul_user_themes ZUT,zul_user_sub_theme_score Z,zul_goal_mapping G, zul_goals GM,zul_goal_segments GSM WHERE
                    ZUT.user_theme_id = Z.user_theme_id AND G.theme_id = ZUT.theme_id AND G.test_id = ZUT.test_id AND
                    G.sub_theme_id = Z.sub_theme_id AND Z.marks_scored BETWEEN G.score_from and G.score_to AND GM.goal_id = G.goal_id AND
                    GM.goal_segment_id = GSM.goal_segment_id AND ZUT.user_id = ".$user_id." AND ZUT.theme_id = ".$theme_id." AND GM.gender IN('".$gender."', 'BOTH')
                    GROUP BY goal_segment_id, goal_id ORDER BY GSM.segment_name";
	    }
		
        $goalsExQuery   = $this->db->query($query);
        $goals_details  = $goalsExQuery->result_array();
        $goal_row_id    = 0;
        
        if(!empty($goals_details)){
            foreach ($goals_details as $row){
                $goals[$goal_row_id]['goal_id'] = $row['goal_id'];
                $goals[$goal_row_id]['goal_name'] = $row['goal_name'];
                $goals[$goal_row_id]['goal_description'] = $row['goal_description'];
                $goals[$goal_row_id]['gender'] = $row['gender'];
                $goals[$goal_row_id]['goal_icon'] = $row['goal_icon'];
                $goals[$goal_row_id]['segment_name'] = $row['segment_name'];
                $goals[$goal_row_id]['goal_segment_id'] = $row['goal_segment_id'];
                $goals[$goal_row_id]['segment_description'] = $row['segment_description'];
                $goals[$goal_row_id]['activities']  = [];
                //goal_id,goal_name,goal_description,gender, goal_icon,goal_segment_id
                $goal_row_id++;
            }
        }
            
            
        }
        
        $grouping = $this->_goals_group_by($goals);        
        return $grouping;

    }

    //--------------------------------------------------------------------------
    /*
     * This function use to rearragne group php-array items based on common values
     */
    function _goals_group_by($goals = []) {
        //print_r($goals);
        $main = [];
        $segAsc = array();
        foreach ($goals as $key => $row)
        {
            $segAsc[$key] = $row['goal_segment_id'];
        }
        array_multisort($segAsc, SORT_ASC, $goals);        
        $uniqueSegment = array_values(array_unique($segAsc));
        
        foreach ($uniqueSegment as $key => $value) {
            foreach ($goals as $row) {
                if($row['goal_segment_id'] == $value){
                    if(!isset($main[$key]['goal_segment_id'])){
                        
                        
                        $main[$key]['goal_segment_id']     = $row['goal_segment_id'];
                        $main[$key]['segment_name']        = $row['segment_name'];
                        $main[$key]['segment_description'] = $row['segment_description'];
                        $main[$key]['goal_list'][] = ['goal_id' => $row['goal_id'], 'goal_name' => $row['goal_name'],
                                       'goal_description' => $row['goal_description'], 'gender' => $row['gender'],
                                       'goal_icon' => base_url('assets/images/segment-icons/'.$row['goal_icon']),'activities' => []];
                        
                        
                
                    }else{
                        
                        $main[$key]['goal_list'][] = ['goal_id' => $row['goal_id'], 'goal_name' => $row['goal_name'],
                                       'goal_description' => $row['goal_description'], 'gender' => $row['gender'],
                                       'goal_icon' => base_url('assets/images/segment-icons/'.$row['goal_icon']),'activities' => []];
                    }
                    
                }
            }
        }        
        //print_r($main);
        return $main;
        
    }  
    
    
    //---------------------------------------------------------------------------------------------
    public function setUserGoal(){
        $insert_data = array(
            'user_id' => $this->user_id,
            'goal_id' => $this->goal_id,
            'shared_status' => $this->shared_status,
        );
        $user_goal_exist = $this->getUserGoalExist();
        if ($user_goal_exist) {
            $this->db->where('user_id', $this->user_id);
            $this->db->where('user_id', $this->goal_id);
            $this->db->update('zul_user_diary', array('shared_status' => $this->shared_status));
            return true;
        } else {
            $this->db->insert('zul_user_diary', $insert_data);
            return true;
        }
    }

    //---------------------------------------------------------------------------------------------
    public function getUserGoalExist(){
        $this->db->select('user_diary_id');
        $this->db->from('zul_user_diary');
        $this->db->where('user_id', $this->user_id);
        $this->db->where('goal_id', $this->goal_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //---------------------------------------------------------------------------------------------
    public function getMyGoals(){
        echo $this->goal_type;
    }

    //---------------------------------------------------------------------------------------------
    /* //fetching user goles based on user
      public function MyGoals($Id){

         $this->db->select('goal_name,goal_description,gender, goal_icon,goal_segment_id');
         $this->db->from('zul_goals');
         $this->db->join('add_goals','zul_goals.goal_id = add_goals.goal_id','inner');
        // $this->db->where('is_active','Y');
         $this->db->where('user_id', $Id );
         $q = $this->db->get();
        // var_dump($this->db->last_query()); exit;

         //echo $this->db->last_query();
         foreach($q->result() as $k){

             $this->db->select('segment_name,segment_description');
             $this->db->from('zul_goal_segments');
             $this->db->where('goal_segment_id',$k->goal_segment_id);
             $g = $this->db->get();
             $t = $g->result();
             $k->segment_name        = $t[0]->segment_name;
             $k->segment_description = $t[0]->segment_description;

             if($k->gender == NULL){
                 $k->gender = 'BOTH';
             }

             $this->db->select('a.goal_activity_id,a.activity_name');
             $this->db->from('zul_goal_activity as a');
             $this->db->join('zul_goal_activity_mapping', 'zul_goal_activity_mapping.activity_id = a.goal_activity_id');
             $this->db->where('zul_goal_activity_mapping.goal_id = ',$k->goal_id);
             $answer_query = $this->db->get();
             $result_ans = $answer_query->result();
             $k->activities = $result_ans;
         }

         //echo "<pre>";print_r($q->result());
         return $q->result();
     }*/
    /*--------------------------------adding goals--------------------------------*/
    public function goal_adding($goal_id, $id, $shareable,$post_data)
    {
        
        //It is check goal to already added or not.
        $isaddedOrNot = $this->isAgreeAddGoalToUserDiary($goal_id, $id);
        
        if(!$isaddedOrNot){
            
            return FALSE;
            
        }else{
            
            if($shareable == "") $shareable= 'Y';
            
            $size = sizeOf($post_data["goal_activity_ids"]);
            $sql = "INSERT INTO zul_user_diary (user_id,goal_id,is_shareable) VALUES (".$id.",".$goal_id.",'".$shareable."')";
            $this->db->query($sql);
            $user_diary_id = $this->db->insert_id();
            for($i=0;$i<$size;$i++){
                $data = array(
                    'user_diary_id' => $user_diary_id,
                    'goal_id' => $goal_id,
                    'goal_activity_id' => $post_data['goal_activity_ids'][$i]
                );
                $this->db->insert('zul_user_goal_activity',$data);
            }
            return TRUE;
            
        }
        
        
    }

    /*--------------------------------users goals--------------------------------*/
    public function MyGoals($con_user_id)
    {
        $this->db->select('zul_goals.goal_id, zul_goals.goal_name, zul_goals.goal_description, zul_goals.gender, zul_goals.goal_icon, zul_goals.goal_segment_id, zul_user_diary.is_completed, zul_user_diary.percentage_completed, zul_user_diary.user_diary_id');
        $this->db->from('zul_goals');
        $this->db->join('zul_user_diary', 'zul_goals.goal_id = zul_user_diary.goal_id', 'inner');
	$this->db->where(['zul_user_diary.is_completed !=' => 'Y','zul_user_diary.removed_incomplete !=' => 1 ]);    
        $this->db->where('user_id', $con_user_id);
        $query = $this->db->get();
        $outputData = array();
        foreach ($query->result() as $row) {
            $outputData[] = $row;
        }
        return $outputData;
    }

   

    /*--------------------------------users my_shared_goals_list from his account--------------------------------*/
    public function my_shared_goals_list($con_user_id)
    {

        $this->db->select('zul_goals.goal_id, zul_goals.goal_name, zul_goals.goal_description, zul_user_diary.is_completed, zul_user_diary.percentage_completed, 
                            zul_my_circle.reciever_diary_id, zul_my_circle.receiver_user_id,zul_my_circle.sender_user_id,zul_user_contacts.name');
        $this->db->from('zul_my_circle');
        $this->db->join('zul_user_diary', 'zul_my_circle.reciever_diary_id = zul_user_diary.user_diary_id', 'left');
        $this->db->join('zul_goals', 'zul_my_circle.goal_id= zul_goals.goal_id', 'left');
        $this->db->join('zul_user_contacts','zul_my_circle.receiver_user_id = zul_user_contacts.contact_system_user_id','left');
        $this->db->join('zul_user_contacts zuc','zul_my_circle.sender_user_id = zul_user_contacts.added_by','left');
        $this->db->where('zul_my_circle.sender_user_id', $con_user_id);
        $this->db->group_by(['zul_my_circle.goal_id', 'zul_my_circle.receiver_user_id']);
        $query = $this->db->get();
        $outputData = array();
        foreach ($query->result() as $row) {
            $outputData[] = $row;
        }
        return $outputData;
    }

    /*--------------------------------goals has shared by someone to me--------------------------------*/
    public function goals_shared_with_me($con_user_id)
    {
        $this->db->select('zul_goals.goal_id, zul_goals.goal_name, zul_goals.goal_description, zul_user_diary.is_completed, zul_user_diary.percentage_completed,
                            zul_my_circle.sender_diary_id, zul_my_circle.sender_user_id,zul_my_circle.receiver_user_id,zul_my_circle.circle_id,zul_my_circle.reciever_diary_id,zul_user_contacts.name');
        $this->db->from('zul_my_circle');
        $this->db->join('zul_user_diary', 'zul_my_circle.sender_diary_id = zul_user_diary.user_diary_id', 'left');
        $this->db->join('zul_goals', 'zul_my_circle.goal_id = zul_goals.goal_id ', 'left');
        $this->db->join('zul_user_contacts','zul_my_circle.sender_user_id = zul_user_contacts.contact_system_user_id','left');
        $this->db->join('zul_user_contacts zuc','zul_my_circle.receiver_user_id = zul_user_contacts.added_by','left');
        $this->db->where('zul_my_circle.receiver_user_id', $con_user_id);
        $this->db->group_by(['zul_my_circle.goal_id', 'zul_my_circle.sender_user_id']);
        $query = $this->db->get();
        $outputData = array();
        foreach ($query->result() as $row) {
            $outputData[] = $row;
        }
        return $outputData;
    }

    /*----------------search_food_item based on item-----------------*/
    public function search_food_item($Item_Name)
    {
        $this->db->select('id,Item_Name,Calorie,Quantity,types');
        $this->db->from('zul_food_calories');
        $this->db->where("Item_Name LIKE '%$Item_Name%'");
        $query = $this->db->get();
        $outputData = array();
        foreach ($query->result() as $row) {
            $outputData[] = $row;
        }
        return $outputData;
    }

    /*----------------selecting item from the list-----------------*/
    public function selecting_item($Item_id)
    {
        $this->db->select('id,Item_Name,Calorie,Quantity,types');
        $this->db->from('zul_food_calories');
        $this->db->where('id', $Item_id);
        $query = $this->db->get();
        $outputData = array();
        foreach ($query->result() as $row) {
            $outputData[] = $row;
        }
        return $outputData;
    }

    /*----------------search_food_item based on item-----------------*/
    public function search_activity($Activity_Name)
    {
        $this->db->select('id,Activity,Duration,Calories');
        $this->db->from('zul_activity_calorie');
        $this->db->where("Activity LIKE '%$Activity_Name%'");
        $query = $this->db->get();
        $outputData = array();
        foreach ($query->result() as $row) {
            $outputData[] = $row;
        }
        return $outputData;
    }

    /*----------------selecting item from the list-----------------*/
    public function selecting_activity($Activity_id)
    {
        $this->db->select('id,Activity,Duration,Calories');
        $this->db->from('zul_activity_calorie');
        $this->db->where('id', $Activity_id);
        $query = $this->db->get();
        $outputData = array();
        foreach ($query->result() as $row) {
            $outputData[] = $row;
        }
        return $outputData;
    }

    /*--------------------------------TRACKING FOOD INTAKE--------------------------------*/
    public function tracking_food_intake($con_user_id, $Item_id, $Item_Name, $Item_Calories, $Item_Quantity, $Meal)
    {
//        date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
        $now = date('d-m-Y-H-i-s');
        $sql = "INSERT INTO tracking_food_intake (user_id,food_tem_id,food_name,food_calorie,food_quantity,meals,date_of_adding) VALUES ('$con_user_id','$Item_id','$Item_Name','$Item_Calories','$Item_Quantity','$Meal','$now')";
        $this->db->query($sql);
        return TRUE;
    }

    /*--------------------------------TRACKING ACTIVITY --------------------------------*/
    public function tracking_activity($con_user_id, $Activity_id, $Activity_Name, $Activity_Calories, $Activity_Duration)
    {
//        date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
        $now = date('d-m-Y-H-i-s');
        $sql = "INSERT INTO tracking_activity (user_id,activity_id,activity_name,activity_calorie,activity_duration,date_of_activity) VALUES ('$con_user_id','$Activity_id','$Activity_Name','$Activity_Calories','$Activity_Duration','$now')";
        $this->db->query($sql);
        return TRUE;
    }

    /**
     * Update database zul_user_daily_tracking_details
     * @param $data
     * @return bool
     */
    public function update_user_daily_tracking_details($data)
    {

        $fields = implode(', ', array_keys($data));
        if(empty($data["impact_score"])) {
            $data["impact_score"] = null;
        }
        if(empty($data["ease_of_doing_score"])) {
            $data["ease_of_doing_score"] = null;
        }
        if(empty($data["ease_of_doing_score"])) {
            $data["ease_of_doing_score"] = 0;
        }

        if(empty($data["impact_score"])) {
            $data["impact_score"] = 0;
        }

        if(empty($data["goal_completed_flag"])) {
            $data["goal_completed_flag"] = 0;
        }

        $goal_id = $data["goal_id"];
        $user_dairy_id = $data["user_diary_id"];
        $goal_completed_flag = $data["goal_completed_flag"];
        $ease_of_doing_score = $data["ease_of_doing_score"];
        $impact_score = $data["impact_score"];
        $user_id = $data["user_id"];

        if($ease_of_doing_score && $ease_of_doing_score > 0 && $ease_of_doing_score <= 10){
            $data['ease_of_doing_score'] = ($ease_of_doing_score * 10);
        }

        if($impact_score && $impact_score > 0 && $impact_score <= 10){
            $data['impact_score'] = ($impact_score * 10);
        }

		unset($data['goal_completed_flag']);
		$insert = $this->db->insert('zul_user_daily_tracking_details',$data);
        if($insert) $this->goal_progress_calculate_new($user_dairy_id, $user_id, $goal_id,$goal_completed_flag);
        return TRUE;
    }

    /**
     * Update removed_incomplete
     * @param $user_diary_id
     * @param $user_id
     * @param $goal_id
     * @param $removed_incomplete
     * @return bool
     */
    public function update_removed_incomplete($user_diary_id, $user_id, $goal_id, $removed_incomplete)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('goal_id', $goal_id);
        $this->db->where('user_diary_id', $user_diary_id);
        $this->db->update('zul_user_diary', array(
                'removed_incomplete' => $removed_incomplete
            )
        );
        
        //delete the goal from zul_my_circle also.
      
        $this->db->where('reciever_diary_id', $user_diary_id);
        $this->db->delete('zul_my_circle');
       
        return TRUE;
    }


    public function goal_progress_calculate_new($user_diary_id, $user_id, $goal_id,$goal_completed_flag) {
        $goal_added_date = $this->db->where(['user_diary_id' => $user_diary_id,
            'goal_id' => $goal_id,'user_id' => $user_id])->from('zul_user_diary')->get()->row()->added_on;
        
        $startDate = $goal_added_date;
        $today   = date('Y-m-d H:i:s');
        $goal_type       = $this->db->where(['goal_id' => $goal_id])->from('zul_goals')->get()->row()->tracking_frequency;
        switch ($goal_type) {
            //-----------------------Progress by daily
            case "Daily":
                //echo "D";
                $goal_added_date = (isset($goal_added_date)) ? date('Y-m-d H:i:s',strtotime($goal_added_date)): null;
                $start_date =  ($goal_added_date != null && $goal_added_date > $start_date)? $goal_added_date: $start_date;
                $today      =  date('Y-m-d H:i:s'); //echo "<br>";
                $no_of_days =  dateDiff($start_date,$today); //echo "<br>";
                
                $sql_query = "SELECT AVG( tb2.ease_of_doing_score ) AS avg_ease_of_doing_score,"
                    . "AVG( tb2.impact_score ) AS avg_impact_score,COUNT(*) AS no_of_tracking_event FROM "
                        . "(SELECT *,DATE(tb1.created_at) DateOnly FROM "
                            . "(SELECT * FROM zul_user_daily_tracking_details WHERE `user_diary_id` = ".$user_diary_id." AND "
                                . "`goal_id` = ".$goal_id." AND `user_id` = '".$user_id."' AND `created_at` >= '".$start_date."' AND "
                                    . "`created_at` <= '".$today."' order by created_at desc) tb1 "
                                        . "group by DateOnly) tb2";
                                        
                $goal_tracking = $this->db->query($sql_query)->row();
                //print_r($goal_tracking);
                $no_of_tracking_event = $goal_tracking->no_of_tracking_event; //echo "<br>";
                $regularity = ($no_of_tracking_event != 0) ? (( $no_of_tracking_event/$no_of_days )    *   100): 0;
                
                $no_of_days_since_goal_added = dateDiff($goal_added_date,$today);
                $maturity_score          = ($no_of_days_since_goal_added/21);
                $maturity_score          = ($maturity_score > 1)? 1: $maturity_score;
                break;
            //-----------------------Progress by month   
            case "Monthly":
                //echo "M";
                if(isSunday($goal_added_date) == FALSE){
                    $start_date = date('Y-m-d H:i:s',strtotime($goal_added_date.' first day of this month')); //last
                }
                $no_of_months = count_months($start_date, $today);
                                        
                $sql_query = "SELECT AVG( TB3.ease_of_doing_score ) AS avg_ease_of_doing_score,AVG( TB3.impact_score ) AS avg_impact_score,COUNT(*) AS no_of_tracking_event
                                FROM (
                                SELECT * FROM(
                                SELECT * FROM zul_user_daily_tracking_details TB,
                                (SELECT max(created_at) AS last_record_date FROM zul_user_daily_tracking_details where `user_diary_id` = ".$user_diary_id." AND
                                `goal_id` = ".$goal_id." AND `user_id` = ".$user_id." AND `created_at` >= '".$start_date."' AND `created_at` <= '".$today."'
                                group by MONTH(created_at)) TB2 WHERE `user_diary_id` = ".$user_diary_id." AND
                                `goal_id` = ".$goal_id." AND `user_id` = ".$user_id." AND `created_at` >= '".$start_date."' AND `created_at` <= '".$today."' AND
                                TB.created_at = TB2.last_record_date
                                ) TB0 GROUP BY MONTH(DATE(created_at))
                                ) TB3 ";
                
                                        $goal_tracking = $this->db->query($sql_query)->row();
                                        $no_of_tracking_event = $goal_tracking->no_of_tracking_event; //echo "<br>";
                                        $regularity = ($no_of_tracking_event != 0) ? (( $no_of_tracking_event/$no_of_months )    *   100): 0;
                                        $maturity_score          = ($no_of_months/12);
                                        $maturity_score          = ($maturity_score > 1)? 1: $maturity_score;
                break;
            //-----------------------Progress by week
            case "Weekly":
                //echo "W";
                if(isSunday($goal_added_date) == FALSE){
                    $start_date = date('Y-m-d H:i:s',strtotime($goal_added_date.' midnight last sunday')); //last
                }
                if(isSunday($today) == FALSE){
                    $end_date = date('Y-m-d H:i:s',strtotime($today.' midnight next sunday')); //last
                }
                $no_of_weeks = datediffCombo('ww', $start_date, $end_date, false);
                $sql_query = "SELECT AVG( TB3.ease_of_doing_score ) AS avg_ease_of_doing_score,AVG( TB3.impact_score ) AS avg_impact_score,COUNT(*) AS no_of_tracking_event 
                                FROM (
                                SELECT * FROM(
                                SELECT * FROM zul_user_daily_tracking_details TB,
                                (SELECT max(created_at) AS last_record_date FROM zul_user_daily_tracking_details where `user_diary_id` = ".$user_diary_id." AND 
                                `goal_id` = ".$goal_id." AND `user_id` = ".$user_id." AND `created_at` >= '".$start_date."' AND `created_at` <= '".$today."'
                                group by DATE(created_at)) TB2 WHERE `user_diary_id` = ".$user_diary_id." AND 
                                `goal_id` = ".$goal_id." AND `user_id` = ".$user_id." AND `created_at` >= '".$start_date."' AND `created_at` <= '".$today."' AND 
                                TB.created_at = TB2.last_record_date
                                ) TB0 GROUP BY WEEK(DATE(created_at))
                                ) TB3 ";
                $goal_tracking = $this->db->query($sql_query)->row();
                $no_of_tracking_event = $goal_tracking->no_of_tracking_event; //echo "<br>";
                $regularity = ($no_of_tracking_event != 0) ? (( $no_of_tracking_event/$no_of_weeks )    *   100): 0;
                $maturity_score          = ($no_of_weeks/12);
                $maturity_score          = ($maturity_score > 1)? 1: $maturity_score;
                break;
                
            default:
                echo "Default";
                break;
        }
        
        
        
        $avg_ease_of_doing_score = (isset($goal_tracking->avg_ease_of_doing_score))? $goal_tracking->avg_ease_of_doing_score : 0;
        $avg_impact_score        = (isset($goal_tracking->avg_impact_score))       ? $goal_tracking->avg_impact_score        : 0;
        $progress_score          = (($regularity*0.5)+
            ($avg_ease_of_doing_score*0.2)+
            ($avg_impact_score*0.3))*$maturity_score;
            $response = array('regularity'    => $regularity,
                'avg_ease_of_doing_score' => $avg_ease_of_doing_score,
                'avg_impact_score'        => $avg_impact_score,
                'maturity_score'          => $maturity_score,
                'progress_score'          => $progress_score);
            //print_r($response);
            $str = "event_type=GOAL_TRACKED,goalID=".$goal_id.",user_diary_id=".$user_diary_id.","
                ."progress_score=".$progress_score.",timestamp=".$this->timezone.",userID=".$user_id;
                
                $curlPost = $this->curl->eventDrop_post($str);
                
                $progress_score_update = $this->update_goal_progress($user_diary_id, $user_id, $goal_id, $progress_score,$goal_completed_flag);
                
                if($progress_score_update == true && $progress_score == 100 && $goal_completed_flag == 1){
                    $str1 = "event_type=GOAL_COMPLETED,goalID=".$goal_id.",user_diary_id=".$user_diary_id.",timestamp=".$this->timezone.",userID=".$user_id;
                    $curlPost = $this->curl->eventDrop_post($str1);
                }
                
                return $response;
        
    }
    
    public function goal_progress_calculate($user_diary_id, $user_id, $goal_id,$goal_completed_flag) {
            
            $start_date = date('Y-m-d H:i:s', strtotime('midnight -21 days'));
            $goal_added_date      = $this->db->where(['user_diary_id' => $user_diary_id,
                'goal_id' => $goal_id,'user_id' => $user_id])->from('zul_user_diary')->get()->row()->added_on;
            $goal_added_date = (isset($goal_added_date)) ? date('Y-m-d H:i:s',strtotime($goal_added_date)): null;
            $start_date =  ($goal_added_date != null && $goal_added_date > $start_date)? $goal_added_date: $start_date;
            $today      =  date('Y-m-d H:i:s'); //echo "<br>";
            $no_of_days =  dateDiff($start_date,$today); //echo "<br>";
            
            $sql_query = "SELECT AVG( tb2.ease_of_doing_score ) AS avg_ease_of_doing_score,"
                    . "AVG( tb2.impact_score ) AS avg_impact_score,COUNT(*) AS no_of_tracking_event FROM "
                    . "(SELECT *,DATE(tb1.created_at) DateOnly FROM "
                    . "(SELECT * FROM zul_user_daily_tracking_details WHERE `user_diary_id` = ".$user_diary_id." AND "
                    . "`goal_id` = ".$goal_id." AND `user_id` = '".$user_id."' AND `created_at` >= '".$start_date."' AND "
                    . "`created_at` <= '".$today."' order by created_at desc) tb1 "
                    . "group by DateOnly) tb2";
            
            $goal_tracking = $this->db->query($sql_query)->row();
            //print_r($goal_tracking);
            $no_of_tracking_event = $goal_tracking->no_of_tracking_event; //echo "<br>";
            $regularity = ($no_of_tracking_event != 0) ? (( $no_of_tracking_event/$no_of_days )    *   100): 0;
            
            //echo $no_of_tracking_event."/".$no_of_days."<br>";
            $avg_ease_of_doing_score = (isset($goal_tracking->avg_ease_of_doing_score))? $goal_tracking->avg_ease_of_doing_score : 0;
            $avg_impact_score        = (isset($goal_tracking->avg_impact_score))       ? $goal_tracking->avg_impact_score        : 0;
            $no_of_days_since_goal_added = dateDiff($goal_added_date,$today);
           
            $maturity_score          = ($no_of_days_since_goal_added/21);
            $maturity_score          = ($maturity_score > 1)? 1: $maturity_score;
            $progress_score          = (($regularity*0.5)+
                    ($avg_ease_of_doing_score*0.2)+
                    ($avg_impact_score*0.3))*$maturity_score;
            $response = array('regularity'    => $regularity,
                    'avg_ease_of_doing_score' => $avg_ease_of_doing_score,
                    'avg_impact_score'        => $avg_impact_score,
                    'maturity_score'          => $maturity_score,
                    'progress_score'          => $progress_score);
            //print_r($response);
            $str = "event_type=GOAL_TRACKED,goalID=".$goal_id.",user_diary_id=".$user_diary_id.","
                    ."progress_score=".$progress_score.",timestamp=".$this->timezone.",userID=".$user_id;
            
            $curlPost = $this->curl->eventDrop_post($str);
            
            $progress_score_update = $this->update_goal_progress($user_diary_id, $user_id, $goal_id, $progress_score,$goal_completed_flag);
            
            if($progress_score_update == true && $progress_score == 100 && $goal_completed_flag == 1){
                $str1 = "event_type=GOAL_COMPLETED,goalID=".$goal_id.",user_diary_id=".$user_diary_id.",timestamp=".$this->timezone.",userID=".$user_id;
                $curlPost = $this->curl->eventDrop_post($str1);
            }
            
            return $response;
    }
    
    
    
    /**
     * Update update_goal_progress
     * @param $user_dairy_id
     * @param $user_id
     * @param $goal_id
     * @param $goalProgress
     * @return bool
     */
    public function update_goal_progress($user_dairy_id, $user_id, $goal_id, $goalProgress, $goalCompletedFlag = null)
    {

            $this->db->where('user_id', $user_id);
            $this->db->where('goal_id', $goal_id);
            $this->db->where('user_diary_id', $user_dairy_id);
            if($goalCompletedFlag == null){
            	$this->db->update('zul_user_diary', array(
            			'percentage_completed' => $goalProgress,
            			'is_completed' => (is_numeric($goalProgress) && $goalProgress < 100 )? 'N':'Y' )
            			);
            }else{
            	$this->db->update('zul_user_diary', array(
            			'percentage_completed' => $goalProgress,
            			'is_completed' => (is_numeric($goalProgress) && $goalProgress >= 100 && $goalCompletedFlag == 1)? 'Y':'N' )
            			);
            }
        return TRUE;
    }
    /**
     *  User goal completed entry
     */
    public function update_user_daily_tracking_details_post()
    {
        if (empty($this->current_user)) {
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $data = [];
            
            $data = $this->request->body;
            $data['user_id'] = $this->current_user->id;
            
            if (empty($data['goal_id']) || empty($data['user_diary_id'])) {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Some post data missing!'
                ], REST_Controller::HTTP_OK);
            } else {
                $response = $this->Goalapi_model->update_user_daily_tracking_details($data);
                
                //                $goalProgress = $this.userGoalProgressCalculator($data['user_dairy_id'], $data['user_id'], $data['goal_id'] );
                //                $this->Goalapi_model->update_goal_progress($data['user_dairy_id'], $data['user_id'], $data['goal_id'], $goalProgress);
                
                if ($response == TRUE) {
                    $this->set_response([
                        'status' => TRUE,
                        'message' => 'Record update'
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'Failed to add record'
                    ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }
    }
        /**
         *  getting user diary id
         */
        public function get_user_diary_id($goal_id, $id)
        {
                $this->db->select('user_diary_id');
                $this->db->from('zul_user_diary');
                $this->db->where('goal_id', $goal_id);
                $this->db->where('user_id', $id);
                $query = $this->db->get();
                $query_result = $query->result();
                return $query_result;
         }
		 /*
		  *	 Inserted Shared data
		  */
		  
		public function share($user_id,$data){
		    
    	$isExists = $this->db->where('phone_number',$data['phone_number'])->from('users')->get();
    	
    	if($isExists->num_rows() > 0){
    		
    		$reciver_details = $isExists->row();
    		$zul_my_circle	= [];
    		$zul_my_circle['sender_user_id']   = $user_id;
    		$zul_my_circle['receiver_user_id'] = $reciver_details->id;
    		$zul_my_circle['goal_id']          = $data['goal_id'];
    		$zul_my_circle['sender_diary_id']  = $data['sender_diary_id'];
    		
    		$isShared = $this->db->where($zul_my_circle)->from('zul_my_circle')->get();
    		if($isShared->num_rows() > 0 ) $circle_id =  $isShared->row()->circle_id;
    		else{
    		$insert = $this->db->insert('zul_my_circle', $zul_my_circle); // insert data into `zul_my_circle` 
    		$circle_id = $this->db->insert_id();
    		}
    		if(!empty($data['goal_id'])){
    		    $shareStr = "event_type=GOAL_SHARED,goalID=".$zul_my_circle['goal_id'].",shared_with_user_id= ".$zul_my_circle['receiver_user_id'].
    		    ",shared_with_phn_no=".$data['phone_number'].",user_diary_id=".$data['sender_diary_id'].",timestamp=".$this->timezone.",userID=".$zul_my_circle['sender_user_id'];
    			$curlPost = $this->curl->eventDrop_post($shareStr);
    			$response = ['status' => TRUE, 'message' => 'Goal Shared Successfully.'];
    		}
    		if(!empty($zul_my_circle['receiver_user_id'])){
    		    $shareStr = "event_type=SHARED_GOAL_RECEIVED,goalID=".$zul_my_circle['goal_id'].",sender_user_id=".$user_id.
    		    ",user_diary_id=".$data['sender_diary_id'].",circle_id=".$circle_id.",timestamp=".$this->timezone.",userID=".$zul_my_circle['receiver_user_id'];
    		    $curlPost = $this->curl->eventDrop_post($shareStr);
    		    $response = ['status' => TRUE, 'message' => 'Shared Goal Received.'];
    		}
    	}else {
    		$response = ['status' => FALSE, 'message' => 'User does not exist.'];
    	}
    	
    	return $response;
    	
    }
		 
    /**
      *  update reciever_diary_id in my circle
      */
     public function update_shared_goal_accept_status($circle_id,$receiver_diary_id)
     {
         $this->db->where('circle_id', $circle_id);
         $this->db->update('zul_my_circle', array(
             'reciever_diary_id' => $receiver_diary_id
             ));
         return TRUE;
     }
     /**
      *  reject shared goal in my circle
      */
     public function reject_shared_goal($circle_id)
     {
         $this->db->where('circle_id', $circle_id);
         $this->db->delete('zul_my_circle');
         return TRUE;
     }
     /**
      *  insert new accepted shared goal to mydiary
      */
     public function store_new_goal_to_mydiary($goal_id,$user_id)
     {
         $data = array(
                'user_id' => $user_id,
                'goal_id' => $goal_id,
                'percentage_completed' => 0
         );
         
         $this->db->insert('zul_user_diary', $data);
         return $this->db->insert_id();
     }

     /**
      *  display friends shareable goals
      */
     public function friends_shareable_goals_list($friends_user_id){
         $this->db->distinct('goal_id');
         $this->db->select('zg.goal_id,zg.goal_segment_id,zg.goal_name,zg.goal_description,zg.gender,zg.goal_icon,zg.is_active,zud.is_completed,zud.percentage_completed');
         $this->db->from('zul_goals zg');
         $this->db->join('zul_user_diary zud', 'zg.goal_id = zud.goal_id', 'Right');
         $this->db->where('user_id', $friends_user_id);
         $this->db->where('is_shareable', 'Y');
         $this->db->where('is_completed', 'N');
         $this->db->where('removed_incomplete', '0');
         $query = $this->db->get();
         return $query->result();
     }
     /**
      *  display user choosen activity of goals
      */
     public function my_choosen_goal_activities($user_id){
         
         $this->db->select('zg.goal_id,zg.goal_name,zg.goal_description,zg.gender,zg.goal_icon,zg.goal_segment_id,zud.user_diary_id');
         $this->db->from('zul_goals zg');
	 	 $this->db->join('zul_user_diary zud', 'zud.goal_id = zg.goal_id');
	 	 $this->db->where('zud.user_id',$user_id);
         $this->db->where('zg.is_active', 'Y');
         $this->db->where('zud.is_completed', 'N');
         $this->db->where('zud.removed_incomplete', 0);
	 	 $this->db->where('zud.goal_id', $this->goal_id);
         $q = $this->db->get();
         foreach($q->result() as $k){
             
             $this->db->select('segment_name,segment_description');
             $this->db->from('zul_goal_segments');
             $this->db->where('goal_segment_id',$k->goal_segment_id);
             $g = $this->db->get();
             $t = $g->result();
             $k->segment_name        = $t[0]->segment_name;
             $k->segment_description = $t[0]->segment_description;
             
             if($k->gender == NULL){
                 $k->gender = 'BOTH';
             }
             
             $this->db->select('a.goal_activity_id,a.activity_name');
             $this->db->from('zul_goal_activity as a');
	     $this->db->join('zul_user_goal_activity', 'zul_user_goal_activity.goal_activity_id = a.goal_activity_id');
	     $this->db->where('zul_user_goal_activity.user_diary_id',$k->user_diary_id);
	     $answer_query = $this->db->get();
             $result_ans = $answer_query->result();
             $k->activities = $result_ans;
             
         }
         return $q->result();
     }
     
     /**
      *  It is check to goal already added or not in zul_user_diary table.
      */
     public function isAgreeAddGoalToUserDiary($goal_id,$user_id) {
         $result = $this->db->where(['user_id' => $user_id,'goal_id' => $goal_id,'is_completed' => "N",'removed_incomplete' => 0])->from('zul_user_diary')->get();
         return ($result->num_rows() > 0) ? FALSE : $result; 
     }
     
     
     /**
      *  It is check to goal already Exists in zul_user_diary table.
      */
     public function isAlreadyExistsGoal($goal_id,$user_id) {
         $isExists = $this->db->where(['user_id' => $user_id,'goal_id' => $goal_id,'is_completed' => "N",'removed_incomplete' => 0])->from('zul_user_diary')->get();
         return ($isExists->num_rows() > 0) ? $isExists : FALSE;
     }
     
     /**
      *  sme list for a perticular goal.
      */
     public function sme_list_for_goal($goal_id) {
         $this->db->select('su.id as sme_id,sup.first_name,sup.last_name,sup.phone,sup.city,sup.chat_pricing,sup.video_pricing,sup.audio_pricing,sup.inperson_pricing');
         $this->db->from('zul_goal_sme_relationship zgsr');
         $this->db->join('sme_users su', 'zgsr.sme_id = su.id');
         $this->db->join('sme_user_profiles sup', 'zgsr.sme_id = sup.sme_userid');
         $this->db->where('zgsr.goal_id',$goal_id);
         $this->db->where('zgsr.active','Y');
         $this->db->group_by(['zgsr.goal_id', 'zgsr.sme_id']);
         $answer_query = $this->db->get();
         $result_ans = $answer_query->result();
         foreach ($result_ans as $result){
         	$this->db->select('photo');
         	$this->db->from('sme_user_profiles');
         	$this->db->where('sme_userid',$result->sme_id);
         	$answer_query = $this->db->get();
         	$answer=$answer_query->result();
         	if($answer[0]->photo=="" || $answer[0]->photo==null){
         		$result->photo="";
         	}else{
         		$result->photo = base_url()."sme_users/".$result->sme_id."/".$answer[0]->photo;
         	}
         }
         //print_r($result_ans); exit;
         return $result_ans;
     }
}
