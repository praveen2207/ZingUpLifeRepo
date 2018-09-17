<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_assessment extends REST_Controller
{
    protected $REST_Security;
    protected $current_user = null;

    function __construct()
    {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('Assessmentrestapi_model');

        $this->load->library('REST_Security');
        $this->current_user = $this->rest_security->getUser();
    }

    //--------------------------------------------------------------------------------------
    /**
     * Update assessment results
     */
    
    public function question_response_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Rest_assessment - question_response_post() called');
        $user = null;
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Rest_assessment - question_response_post() there is no user detail');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $post_data      = $this->request->body;
            $user           = $this->current_user;
            
            if(isset($post_data['name']) && isset($post_data['gender']) && isset($post_data['weight'])
            		&& isset($post_data['height']) && isset($post_data['dob'])){
            		    log_message('debug', 'Class: Rest_assessment - question_response_post() Invalid Inputs');
            			$this->set_response([
            					'status' => false,
            					'message' => 'Invalid Inputs'
            			], REST_Controller::HTTP_OK);
            }else{
            	$user_results   = $this->Assessmentrestapi_model->setQuestionResponse($user->id,$post_data);
            	if($user_results){
            	    log_message('debug', 'Class: Rest_assessment - question_response_post() User result updated successfully!');
            		$this->set_response([
            				'status' => true,
            				'message' => 'Updated successfully!',
            				'result' => [
            						'user_score' => $user_results['overall_score'],
            						'user_age'  => $user_results['user_age'],
            						'user_score_text' => $user_results['score_text'],
            						'user_image' => $user_results['user_imgs'],
            				]
            		], REST_Controller::HTTP_OK);
            		
            	} else {
            	    log_message('debug', 'Class: Rest_assessment - question_response_post() User result update request failed');
            		$this->set_response([
            				'status' => false,
            				'message' => 'Update request failed'
            		], REST_Controller::HTTP_OK);
            	}
            }
        }
          $time_elapsed_secs = microtime(true) - $start;
          log_message('debug', 'Class: Rest_assessment - question_response_post(). Total execution time: ' . $time_elapsed_secs);
    }
//--

   


   
}
