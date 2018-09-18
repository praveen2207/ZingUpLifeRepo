<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Assessment extends REST_Controller {

    function __construct(){
        parent::__construct();

        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Apiassessment_model');
    }
    //--------------------------------------------------------------------------------------
    public function questions_get(){
        $start = microtime(true);
        log_message('debug', 'Class:Assessment - questions_get() called');
        $id          =  $this->get('id');
        $level_id    =  $this->get('level_id');
        $user_gender =  $this->get('user_gender');
        
        
        $this->Apiassessment_model->theme_id = $id;
        $this->Apiassessment_model->level_id = $level_id;
        $this->Apiassessment_model->user_gender = $user_gender;
        
        $questions = $this->Apiassessment_model->getQuestions();
        //echo "<pre>";
        //print_r($questions);
        if ($id === NULL){
            log_message('debug', 'Class:Assessment - questions_get() No questions were found');
            $this->response([
                'status' => FALSE,
                'message' => 'No questions were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        if ($id != NULL ){
            $id = (int) $id;
            if ($id <= 0){
                log_message('debug', 'Class:Assessment - questions_get() theme id is not valid');
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            if (!empty($questions)){
                log_message('debug', 'Class:Assessment - questions_get() $response');
                $this->set_response($questions, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }else{
                log_message('debug', 'Class:Assessment - questions_get() questions could not be found');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'questions could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class:Assessment - questions_get(). Total execution time: ' . $time_elapsed_secs);
    }
    //--------------------------------------------------------------------------------------
    public function question_response_post(){
        $start = microtime(true);
        log_message('debug', 'Class:Assessment - question_response_post() called');
        $data = $_POST;
        $theme_id = $this->input->cookie('theme_id');
        $level_id = $this->input->cookie('level_id');
        $response = $this->Apiassessment_model->setQuestionResponse($data);
        if($response == TRUE){
            log_message('debug', 'Class:Assessment - question_response_post() Question details are updated successfully!');
            $this->set_response([
                'theme_id' => $theme_id,
				'level_id' => $level_id,
                'status' => TRUE,
                'message' => 'Question details are updated successfully'
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
        }else{
            log_message('debug', 'Class:Assessment - question_response_post() Question details are Not Updated');
            $this->set_response([
                'status' => FALSE,
                'message' => 'Not Updated'
            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class:Assessment - question_response_post(). Total execution time: ' . $time_elapsed_secs);
    }
    //--------------------------------------------------------------------------------------
    public function result_get(){
        $start = microtime(true);
        log_message('debug', 'Class:Assessment - result_get() called');
        $id    =  $this->get('id');
        $assessment_result = $this->Apiassessment_model->getAssessmentResult();

        if ($id === NULL){
            log_message('debug', 'Class:Assessment - result_get() No results were found');
            $this->response([
                'status' => FALSE,
                'message' => 'No results were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        if ($id != NULL ){
            $id = (int) $id;
            
            if ($id <= 0){
                log_message('debug', 'Class:Assessment - result_get() theme id is not valid');
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
            if (!empty($assessment_result)){
                log_message('debug', 'Class:Assessment - result_get() $response');
                $this->set_response($assessment_result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }else{
                log_message('debug', 'Class:Assessment - result_get() Assessment could not be found');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Assessment could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class:Assessment - result_get(). Total execution time: ' . $time_elapsed_secs);
    }
    //--------------------------------------------------------------------------------------
}
