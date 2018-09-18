<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Goal extends REST_Controller {
    
    protected $current_user = null;

    function __construct(){
        parent::__construct();
        
        $this->load->model('User');
        $this->load->library('REST_Security');
        $this->current_user = $this->rest_security->getUser();
        
        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('GoalApi_model');
        $this->load->helper('functions');
    }
    //--------------------------------------------------------------------------------------------
    public function details_get(){
        $start = microtime(true);
        log_message('debug', 'Class: Goal - details_get() called');
        $id    =  $this->get('id');
        $this->GoalApi_model->goal_id = $id;
        $goal = $this->GoalApi_model->getGoal();
        
        if ($id === NULL){
                log_message('debug', 'Class: Goal - details_get() No goal were found');
                $this->response([
                    'status' => FALSE,
                    'message' => 'No goal were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        if ($id != NULL ){
            $id = (int) $id;
            if ($id <= 0){
                log_message('debug', 'Class: Goal - details_get() invalid gaol id');
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            if (!empty($goal)){
                log_message('debug', 'Class: Goal - details_get() $response');
                $this->set_response($goal, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }else{
                log_message('debug', 'Class: Goal - details_get() Goal could not be found');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Goal could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goal - details_get(). Total execution time: ' . $time_elapsed_secs);
    }
    //--------------------------------------------------------------------------------------------
    public function add_put(){
        $start = microtime(true);
        log_message('debug', 'Class: Goal - add_put() called');
        $this->GoalApi_model->user_id         =  $this->put('user_id');
        $this->GoalApi_model->goal_id         =  $this->put('goal_id');
        $this->GoalApi_model->shared_status   =  $this->put('shared_status');
        if($this->GoalApi_model->user_id!= '' && $this->GoalApi_model->goal_id!=''){
            $response = $this->GoalApi_model->setUserGoal();
            if($response == true){
                log_message('debug', 'Class: Goal - add_put() Goal details added succesfully');
                $this->set_response([
                    'status' => true,
                    'message' => 'Goal details added succesfully'
                ], REST_Controller::HTTP_OK); //OK (200) being the HTTP response code
            }else{
                log_message('debug', 'Class: Goal - add_put() Goal Not added');
                $this->set_response([
                    'status' => false,
                    'message' => 'Not added'
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
        }else{
            log_message('debug', 'Class: Goal - add_put() Invalid Request');
            $this->set_response([
                'status' => FALSE,
                'message' => 'Invalid Request'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goal - add_put(). Total execution time: ' . $time_elapsed_secs);
    }
    //--------------------------------------------------------------------------------------------
    public function goal_progress_calculate_get(){
        $start = microtime(true);
        log_message('debug', 'Class: Goal - goal_progress_calculate_get() called');
        $user_id = $this->get('user_id');
        $user_diary_id = $this->get('user_diary_id');
        $goal_id = $this->get('goal_id');
             
        if($user_id != "" || $user_diary_id != "" || $goal_id != ""){
            $response = $this->Goalapi_model->goal_progress_calculate($user_dairy_id, $user_id, $goal_id);
            log_message('debug', 'Class: Goal - goal_progress_calculate_get() $response for USER ID :'.$user_id);
            $this->set_response([
                'status' => TRUE,
                'result' => $response
            ], REST_Controller::HTTP_OK);
            
        }else{
            log_message('debug', 'Class: Goal - goal_progress_calculate_get() Input Values are an invalid.');
            $this->response([
                    'status' => FALSE,
                    'message' => 'Input Values are an invalid.'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Goal - goal_progress_calculate_get(). Total execution time: ' . $time_elapsed_secs);
    }
    //--------------------------------------------------------------------------------------------
    public function choosen_goal_activity_details_get(){
        $start = microtime(true);
        log_message('debug', 'Class: Goal - choosen_goal_activity_details_get() called');
    	if (empty($this->current_user)) {
    	   $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
    		$goal_id    =  $this->get('id');
    		$user_id = $this->current_user->id;
    		$this->GoalApi_model->goal_id = $goal_id;
    		$goal = $this->GoalApi_model->my_choosen_goal_activities($user_id);
    
    		if ($goal_id === NULL){
    		    log_message('debug', 'Class: Goal - choosen_goal_activity_details_get() No goal were found');
    		    $this->response([
    			'status' => FALSE,
    			'message' => 'No goal were found'
    		    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    		}
    		if ($goal_id != NULL ){
    		    $goal_id = (int) $goal_id;
    		    if ($goal_id <= 0){
    			log_message('debug', 'Class: Goal - choosen_goal_activity_details_get() invalid gaol id');
    			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
    		    }
    		    if (!empty($goal)){
    			log_message('debug', 'Class: Goal - choosen_goal_activity_details_get() $response');
    			$this->set_response($goal, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    		    }else{
    			log_message('debug', 'Class: Goal - choosen_goal_activity_details_get() Goal could not be found');
    			$this->set_response([
    			    'status' => FALSE,
    			    'message' => 'Goal could not be found'
    			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    		    }
    		}
        }
    	$time_elapsed_secs = microtime(true) - $start;
    	log_message('debug', 'Class: Goal - choosen_goal_activity_details_get(). Total execution time: ' . $time_elapsed_secs);
    }
}
