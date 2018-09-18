<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Advice extends REST_Controller
{

    protected $current_user = null;
    function __construct()
    {
        parent::__construct();

        $this->load->model('user');

        $this->load->library('REST_Security');
        $this->current_user = $this->rest_security->getUser();

        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Advice_model');
		$this->load->helper('event_service_helper');
        $this->load->helper('functions');
    }
    
	/* Retrive Advice by Auth User Id */
	public function index_get(){
	    $start = microtime(true);
	    log_message('debug', 'Class : Advice - index_get() called');
	    if (empty($this->current_user)) {
	        log_message('debug', 'Class : Advice - index_get() there is no user details');
    		$this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
    	} else {
    		$id = $this->current_user->id;
			$response = $this->Advice_model->user_retrieve_advice($id);
		    
			$this->Advice_model->update_advice_viewed($id);    //update the advice_view flag as Y, since user woud see it now. 
			
			log_message('debug', 'Class : Advice - index_get() $response for USER ID :'.$id);
    		$this->set_response($response, REST_Controller::HTTP_OK);
    		
    	}
    	$time_elapsed_secs = microtime(true) - $start;
    	log_message('debug', 'Class : Advice - index_get(). Total execution time: ' . $time_elapsed_secs);
	}
    
	/* Retrive Advice by Auth User Id */
	public function new_advices_get(){
	    $start = microtime(true);
	    log_message('debug', 'Class : Advice - new_advices_get() called');
	    if (empty($this->current_user)) {
	        log_message('debug', 'Class : Advice - new_advices_get() there is no user details');
	        $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
	    } else {
		$id = $this->current_user->id;
	        $response = $this->Advice_model->new_adivces($id);
	        log_message('debug', 'Class : Advice - new_advices_get() $response for USER ID :'.$id);
	        $this->set_response($response, REST_Controller::HTTP_OK);
	        
	    }
	    $time_elapsed_secs = microtime(true) - $start;
	    log_message('debug', 'Class : Advice - new_advices_get(). Total execution time: ' . $time_elapsed_secs);
	}
	
    /* Advice shared */
    public function share_post(){
        $start = microtime(true);
        log_message('debug', 'Class : Advice - share_post() called');
    	if (empty($this->current_user)) {
    	    log_message('debug', 'Class : Advice - share_post() there is no user details');
    		$this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
    	} else {
    		$data 		= [];
    		$data 		= $this->request->body;
    		$id = $this->current_user->id;
    		
    		if(empty($data['phone_number']) || empty($data['advice_id'])){
    		    log_message('debug', 'Class : Advice - share_post() Invalid Inputs');
    			$this->set_response([
    					'status' => false,
    					'message' => 'Invalid Inputs'
    			], REST_Controller::HTTP_OK);
    		}else{
    			
    			$response = $this->Advice_model->user_advice_shared($id, $data);
    			$response = ($response == TRUE)?  [
    					'status' => TRUE,
    					'message' => 'User Advice shared successfully.'
    			]:[
    					'status' => FALSE,
    					'message' => 'User Advice share is failed.'
    			];
    			log_message('debug', 'Class : Advice - share_post() $response for USER ID : '.$id);
    			$this->set_response($response, REST_Controller::HTTP_OK);
    			
    		}
    		
    		
    	}
    	$time_elapsed_secs = microtime(true) - $start;
    	log_message('debug', 'Class : Advice - share_post(). Total execution time: ' . $time_elapsed_secs);
    	
    }

    /* advice to goal */
    public function advice_to_goal_post(){
        $start = microtime(true);
        log_message('debug', 'Class : Advice - advice_to_goal_post() called');
    	if (empty($this->current_user)) {
    	    log_message('debug', 'Class : Advice - advice_to_goal_post() there is no user deatail');
    		$this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
    	} else {
    		$data = [];
    		$data = $this->request->body;
    		$id = $this->current_user->id;
    		
    		if(empty($data['advice_id']) || empty($data['user_advice_id'])){
    		    log_message('debug', 'Class : Advice - advice_to_goal_post() Invalid Inputs');
    			$this->set_response([
    					'status' => false,
    					'message' => 'Invalid Inputs'
    			], REST_Controller::HTTP_OK);
    		}else{
    			
    			$response = $this->Advice_model->user_advice_to_goal($id, $data);
    			log_message('debug', 'Class : Advice - advice_to_goal_post() $response for USER ID :'.$id);
    			$this->set_response($response, REST_Controller::HTTP_OK);
    			
    		}
    			 
    	}
    	$time_elapsed_secs = microtime(true) - $start;
    	log_message('debug', 'Class : Advice - advice_to_goal_post(). Total execution time: ' . $time_elapsed_secs);
    }
    /* push advice */
    public function create_advice_post(){
        $start = microtime(true);
        log_message('debug', 'Class : Advice - create_advice_post() called');
        $post_data=$this->request->body;
        $response=$this->Advice_model->create_advice($post_data);
        if($response){
            $this->set_response([
                'status' => true,
                'message' => 'advice added successfully!'
            ],REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'status' => false,
                'message' => 'advice not added.'
            ],REST_Controller::HTTP_OK);
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class : Advice - create_advice_post(). Total execution time: ' . $time_elapsed_secs);
    }
    
    /* sme share advice */
    public function sme_share_advice_post(){
        $start = microtime(true);
        log_message('debug', 'Class : Advice - sme_share_advice_post() called');
        $post_data=$this->request->body;
        $response=$this->Advice_model->sme_share_advice($post_data);
        if($response){
            log_message('debug', 'Class : Advice - sme_share_advice_post() advice shared successfully!');
            $this->set_response([
                'status' => true,
                'message' => 'advice shared successfully!'
            ],REST_Controller::HTTP_OK);
        }else{
            log_message('debug', 'Class : Advice - sme_share_advice_post() advice not shared.');
            $this->set_response([
                'status' => false,
                'message' => 'advice not shared.'
            ],REST_Controller::HTTP_OK);
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class : Advice - sme_share_advice_post(). Total execution time: ' . $time_elapsed_secs);
        
    }
          
}
