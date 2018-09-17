<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_register extends REST_Controller
{
    protected $REST_Security;
    protected $current_user = null;
	public $timezone;
    function __construct()
    {
        parent::__construct();

        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('user');

        $this->load->library('REST_Security');
        $this->load->library('Curl');
        $this->current_user = $this->rest_security->getUser();
        $this->timezone = date('Y-m-d\TH:i:s\Z', time());
    }

    public function guest_user_info_get(){
        $start = microtime(true);
        log_message('debug', 'Class: Rest_register - guest_user_info_get() called');
        $user = $this->current_user;
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Rest_register - guest_user_info_get() there is no user detail');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            
           
            
            // Logged in user
            $user = $this->user->get_rest_user_by_id($this->current_user->id);
            if($user->gender == null || $user->weight == null || $user->height == null ||
                    $user->date_of_birth == null || $user->bmi == null){
                    log_message('debug', 'Class: Rest_register - guest_user_info_get() BMI is not collected');
                    $this->set_response([
                        'status'        => false,
                        'BMI-Collected' => 'N'
                    ]);
                
            } else {
                log_message('debug', 'Class: Rest_register - guest_user_info_get() BMI is collected');
                    $this->set_response([
                    'status' => true,
                    'BMI-Collected' => 'Y',
                    'result' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'gender' => $user->gender,
                        'weight' => $user->weight,
                        'height' => $user->height,
                        'date_of_birth' => $user->date_of_birth,
                        'fcm_token' => $user->fcm_token,
                    ]
                ], REST_Controller::HTTP_OK);
                
            }
            
            
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_register - guest_user_info_get(). Total execution time: ' . $time_elapsed_secs);
    }

    //--------------------------------------------------------------------------------------
    /**
     * Update post results
     */
    
    public function guest_user_info_post(){
        $start = microtime(true);
        log_message('debug', 'Class: Rest_register - guest_user_info_post() called');
        $user = $this->current_user;
        if (empty($this->current_user)) {
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            
            $post_data = $this->request->body;
            if(isset($post_data['dob'])){
                $current_date = date("Y");
                $dob = date('Y', strtotime($post_data['dob']));
                $age = $current_date - $dob;
                $dob_formate = date("Y-m-d", strtotime($post_data['dob']));
                $user_details_data['age']    = $age;
                $user_details_data['date_of_birth'] = $dob_formate;
            }
            
            $user_details_data['weight'] = $post_data['weight'];
            $user_details_data['height'] = $post_data['height'];
            $user_details_data['gender'] = $post_data['gender'];
            
            $user_details_data['bmi']        = $this->convert_bmi($post_data['weight'],$post_data['height']);
            $user_details_data['created_on'] = date('Y-m-d H:i:s');
            $user_details_data['updated_at'] = date('Y-m-d H:i:s');
            $user_data['name']               = $post_data['name'];
            
            if(isset($post_data['email'])){
                $user_data['email']               = $post_data['email'];
            }
            
            if(isset($post_data['fcm_token'])){
                $user_data['fcm_token']          = $post_data['fcm_token'];
            }
            
            $user_where['id']               = $this->current_user->id;
            $user_details_where['user_id']  = $this->current_user->id;
            $this->user->create_or_update('users',        $user_where,        $user_data);
            $this->user->create_or_update('user_details', $user_details_where,$user_details_data);
            $user = $this->user->get_rest_user_by_id($this->current_user->id);
            if ($user) {
            	
            	$str = "event_type=BMI_COLLECTED,BMI=".$user->bmi.",gender=".$user->gender.",age=".$user->age.",timestamp=".$this->timezone.",userID=".$user->id;
            	$curlPost = $this->curl->eventDrop_post($str);
            	log_message('debug', 'Class: Rest_register - guest_user_info_post() BMI data is Updated successfully!');
                $this->set_response([
                    'status' => true,
                    'message' => 'Updated successfully!',
                    'result' => [
                        'id' => $user->id,
                        'email' => $user->email,
                        'gender' => $user->gender,
                        'weight' => $user->weight,
                        'height' => $user->height,
                        'date_of_birth' => $user->date_of_birth,
                    	'age' => $user->age,
                        'fcm_token' => $user->fcm_token,
                        
                    ]
                ], REST_Controller::HTTP_OK);

                } else {
                    log_message('debug', 'Class: Rest_register - guest_user_info_post() BMI update request failed');
                    $this->set_response([
                        'status' => false,
                        'message' => 'Update request failed'
                    ], REST_Controller::HTTP_OK);
                }
            
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_register - guest_user_info_post(). Total execution time: ' . $time_elapsed_secs);
    }

    public function convert_bmi($weight = 0,$height = 0){
        $start = microtime(true);
        log_message('debug', 'Class: Rest_register - convert_bmi() called');
        $bmi_val = null;
        if($weight != '' && $height != '')
        {
            $height = $height/100;
            $bmi_val = $weight / ($height * $height);	 
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_register - convert_bmi(). Total execution time: ' . $time_elapsed_secs);
        return $bmi_val;
        
    }
    

   
}
