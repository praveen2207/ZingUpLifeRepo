<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller {

    function __construct()
    {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('AssessmentApi_model');

    }
    public function login_post(){
        $start = microtime(true);
        log_message('debug', 'Class: Auth - login_post() called');
        $id    =  $this->post('id');
        // Users from a data store e.g. database
        $questions = $this->AssessmentApi_model->getQuestions();

        if ($id === NULL){
                // Set the response and exit
                log_message('debug', 'Class: Auth - login_post() No users were found');
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        // Find and return a single record for a particular user.
        if ($id != NULL ){
            $id = (int) $id;

            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                log_message('debug', 'Class: Auth - login_post() Invalid id');
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            if (!empty($questions))
            {   
                log_message('debug', 'Class: Auth - login_post() $response');
                $this->set_response($questions, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                log_message('debug', 'Class: Auth - login_post() User could not be found');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class : Advice - index_get(). Total execution time: ' . $time_elapsed_secs);
    }
    public function ra_put(){
        $start = microtime(true);
        log_message('debug', 'Class: Auth - ra_put() called');
        echo "hgjhgjhg";
        echo $id    =  $this->put('countryCode');
        
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Auth - login_post(). Total execution time: ' . $time_elapsed_secs);
    }
    
}
