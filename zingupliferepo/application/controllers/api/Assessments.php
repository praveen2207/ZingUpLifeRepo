<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Assessments extends REST_Controller {

    function __construct(){
        parent::__construct();

        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Apiassessment_model');
        
        $this->load->model('user');
        $this->load->model('Advice_model');
        $this->load->library('REST_Security');
        $this->load->library('FCM');
        $this->current_user = $this->rest_security->getUser();
        $this->timezone = date('Y-m-d\TH:i:s\Z', time());
        $user = $this->current_user;
    }
    //--------------------------------------------------------------------------------------
    public function index_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Assessments - index_get() called');
        $this->Apiassessment_model->assessment_type  = $this->get('type');
        $type = $this->Apiassessment_model->assessment_type;
        $assessments = $this->Apiassessment_model->getAssessments();
        
        //update FCM
        if (!isset($_GET['fcm_token']) && trim($_GET['fcm_token'])!=''){
         $fcm_update = $this->user->updateFCMToken($this->current_user->id, $_GET['fcm_token']);
        }
        //get new advice for user, if any.
        $response = $this->Advice_model->new_adivces($this->current_user->id);
        
        $assessments[0]->new_advices = $response[0]->new_advices;
        
        
        if ($type != NULL ){
            if ($type !='init' && $type!='null')
            {
                log_message('debug', 'Class: Assessments - index_get() null');
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }else{
                if (!empty($assessments)){
                    log_message('debug', 'Class: Assessments - index_get() $response');
                    $this->set_response($assessments, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                }
                else
                {
                    log_message('debug', 'Class: Assessments - index_get() User could not be found');
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'User could not be found'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }
        }else{
            if (!empty($assessments)){
                log_message('debug', 'Class: Assessments - index_get() $response');
                $this->set_response($assessments, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Assessments - index_get(). Total execution time: ' . $time_elapsed_secs);
        
    }
    //--------------------------------------------------------------------------------------
}
