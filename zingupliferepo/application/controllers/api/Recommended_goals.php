<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Recommended_goals extends REST_Controller
{
    protected $REST_Security;
    protected $current_user = null;

    function __construct()
    {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('GoalApi_model');

        $this->load->library('REST_Security');
        $this->current_user = $this->rest_security->getUser();
    }

    //--------------------------------------------------------------------------------------
    
    public function index_get(){
        $start = microtime(true);
        log_message('debug', 'Class: Recommended_goals - index_get() called');
        $user = null;
        if(empty($this->current_user)){
            log_message('debug', 'Class: Recommended_goals - index_get() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        }else{
            $theme_id      = $this->get('theme_id');
            $user           = $this->current_user;
            if(isset($theme_id) && $theme_id > 0 && $theme_id < 5){
                //echo $user->id."=".$theme_id;
                $response = $this->GoalApi_model->getRecommendedGoals($user->id, $theme_id);
                if(!empty($response)){
                    log_message('debug', 'Class: Recommended_goals - index_get() $response');
                    $this->response($response, REST_Controller::HTTP_OK);   // OK (200) being the HTTP response code
                }else{
                    log_message('debug', 'Class: Recommended_goals - index_get() No reccommended goal were found');
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No reccommended goal were found'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
                
            }else{
                log_message('debug', 'Class: Recommended_goals - index_get() Invalid Input');
                $this->response([
                    'status' => FALSE,
                    'message' => 'Invalid Input'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Recommended_goals - index_get(). Total execution time: ' . $time_elapsed_secs);
    }


   
}