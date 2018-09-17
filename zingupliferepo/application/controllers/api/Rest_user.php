<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_user extends REST_Controller
{
    // Rest API user type to handle guest/registered user
    const REST_USER_TYPES = [
        'GUEST' => 'guest',
        'REGISTERED' => 'registered'
    ];

    const REST_ALLOWED_USER_PROFILE_DATA_UPDATE = [
        'name' => [
            'min' => 3,
            'max' => 60,
            'type' => 'string',
            'table' => 'users',
            'field' => 'name'
        ],
        'gender' => [
            'min' => 3,
            'max' => 60,
            'type' => 'string',
            'table' => 'user_details',
            'field' => 'gender'
        ],
        'weight' => [
            'type' => 'float',
            'table' => 'user_details',
            'field' => 'weight'
        ],
        'height' => [
            'type' => 'float',
            'table' => 'user_details',
            'field' => 'height'
        ],
        'date_of_birth' => [
            'type' => 'date',
            'table' => 'user_details',
            'field' => 'date_of_birth'
        ],
        'phone_number' => [
            'min' => 10,
            'max' => 10,
            'type' => 'string',
            'table' => 'users',
            'field' => 'phone_number'
        ],
        'email' => [
            'type' => 'string',
            'table' => 'users',
            'field' => 'email'
        ],
        'fcm_token' => [
            'min' => 1,
            'type' => 'string',
            'table' => 'users',
            'field' => 'phone_number'
        ]
    ];


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

        $this->load->library('SMSGateway');

        $this->load->library('REST_Security');
        $this->load->library('FCM');
        $this->current_user = $this->rest_security->getUser();
	    $this->timezone = date('Y-m-d\TH:i:s\Z', time());//new MongoDate(time());//date("Y-m-d\TH:i:s\Z");//2017-03-14T21:16:00Z
	    $this->load->helper('event_service_helper');
    }

    //--------------------------------------------------------------------------------------


    /**
     * Get user profile data
     */
    public function index_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Rest_user - index_get() called');
        $user = $this->current_user;
        if ($user) {
            log_message('debug', 'Class: Rest_user - index_get() $response for USER ID :'.$user->id);
            $this->set_response([
                'status' => true,
                'result' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'token' => $user->security_token,
                    'user_type' => $user->user_type,
                    'email' => $user->email,
                    'gender' => $user->gender,
                    'weight' => $user->weight,
                    'height' => $user->height,
                    'bmi' => $user->bmi,
                    'date_of_birth' => $user->date_of_birth,
                    'phone_number' => $user->phone_number,
                    'fcm_token' => $user->fcm_token,
                    'is_verified_phone_number' => $user->is_verified_phone_number,
                    'is_verified_email' => $user->is_verified_email,
                    'mobile_otp' => $user->mobile_otp, // Todo - remove after development
                    'email_otp' => $user->email_otp
                ]
            ], REST_Controller::HTTP_OK);

        } else {
            log_message('debug', 'Class: Rest_user - index_get() Failed to fetch user profile data');
            $this->set_response([
                'status' => false,
                'message' => 'Failed to fetch user profile data'
            ], REST_Controller::HTTP_OK);
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_user - index_get(). Total execution time: ' . $time_elapsed_secs);
    }

    /**
     * Session post
     */
    public function session_post()
    {
        $start = microtime(true);
        $user = null;
        $post_data = $this->request->body;
        $device_id=$post_data['device_id'];
        $headers = null;
        if (isset ( $_SERVER ['Authorization'] )) {
            $headers = trim ( $_SERVER ["Authorization"] );
        } else if (isset ( $_SERVER ['HTTP_AUTHORIZATION'] )) {
            $headers = trim ( $_SERVER ["HTTP_AUTHORIZATION"] );
        } elseif (function_exists ( 'apache_request_headers' )) {
            $requestHeaders = apache_request_headers ();
            
        } else {
            // Logged in user
            $user = $this->user->get_rest_user_by_id($this->current_user->id);
        }
        
        // HEADER: Get the access token from the header
        if (! empty ( $headers )) {
            if (preg_match ( '/Bearer\s(\S+)/', $headers, $matches )) {
                $token = $matches [1];
            }
        }
         
        if($device_id != null){
        
            $this->db->select ( 'id');
            $this->db->where ( 'device_id', $device_id );
            $query = $this->db->get( 'users' );
            $user = $query->result(); 
            $user_id = $user[0]->id;
            if($query->num_rows() > 0){
                $user=$this->User->get_rest_user_by_id($user_id);
                }else{
                $user_type = self::REST_USER_TYPES['GUEST'];
                $security_token = $this->rest_security->generateSecurityToken();
                $new_user_data = array(
                        'security_token' => $this->rest_security->generateSecurityToken(),
                        'security_token_expire' => $this->rest_security->getSecurityTokenExpire(45),
                        'device_id' => $device_id,
                        'user_type' => $user_type
                );
                $user = $this->user->create_rest_user($new_user_data);
            }
            
            
            if ($user) {
                log_message('debug', 'Class: Rest_user - session_get() $response for USER ID :'.$user->id);

              
                $this->set_response([
                    'status' => true,
                    'result' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'token' => $user->security_token,
                        'user_type' => $user->user_type
                    ]
                ], REST_Controller::HTTP_OK);
            } else {
                log_message('debug', 'Class: Rest_user - session_get() Unable to create session.');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Unable to create session.'
                ], REST_Controller::HTTP_OK);
            }
        }else{
            log_message('debug', 'Class: Rest_user - session_get() Unable to create session.');
            $this->set_response([
                'status' => FALSE,
                'message' => 'Unable to create session.'
            ], REST_Controller::HTTP_OK);
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_user - session_get(). Total execution time: ' . $time_elapsed_secs);
    }
    

    /**
     * Update user profile
     */
    public function update_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Rest_user - update_post() called');
	//print_r($this->current_user);
        $user = null;
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Rest_user - update_post() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            // Login user
            $post_data = $this->request->body;
            // Data validation
	    $id = $this->current_user->id;
	    
            $has_errors = $this->validate_profile_data($post_data);
            if (count($has_errors) > 0) {
                // errors
                log_message('debug', 'Class: Rest_user - update_post() there are some errors.');
                $this->set_response([
                    'status' => false,
                    'message' => implode(',', $has_errors)
                ], REST_Controller::HTTP_OK);
            } else {

                $user_data = [];
                $user_details_data = [];
                $definedKey = self::REST_ALLOWED_USER_PROFILE_DATA_UPDATE;
                foreach ($post_data as $key => $value) {
                    if (isset($definedKey[$key])) {
                        if ($definedKey[$key]['table'] == 'users') {
                            $user_data[$key] = $value;
                        } else if ($definedKey[$key]['table'] == 'user_details') {
                            $user_details_data[$key] = $value;
                        }
                    }
                }
                $isExitPhoneNumber = $this->db->where('phone_number',$post_data['phone_number'])->from('users')->get()->num_rows();
                
                if($isExitPhoneNumber > 0 && $this->current_user->phone_number != $post_data['phone_number']){
                    log_message('debug', 'Class: Rest_user - update_post() record Update request failed for USER ID :'.$id);
                    $this->set_response([
                        'status' => false,
                        'message' => 'This phone number is already used.'
                    ], REST_Controller::HTTP_OK);
                }else{
                    
                    $new_phone_number = (isset($post_data['phone_number']) && ($this->current_user->phone_number != $post_data['phone_number']));
                    $new_email = (isset($post_data['email']) && ($this->current_user->email != $post_data['email']));
                    
                    if ($new_phone_number) {
                        $user_registered_string = 'event_type=USER_REGISTERED,timestamp='.$this->timezone.',userID='.$id;
                        event_service($user_registered_string);
                        // todo Send OTP for verification
                        $user_data['is_verified_phone_number'] = !$new_phone_number;
                        $user_data['mobile_otp'] = $this->rest_security->generateOTPTokenForUser("mobile_otp");
                        $user_data['mobile_otp_expire'] = $this->rest_security->getSecurityTokenExpire(1);
                    }
                    
                    if ($new_email) {
                        // todo Send email for verification
                        $user_data['is_verified_email'] = !$new_email;
                        $user_data['email_otp'] = $this->rest_security->generateOTPTokenForUser("email_otp");
                        $user_data['email_otp_expire'] = $this->rest_security->getSecurityTokenExpire(1);
                    }
                    
                    $user = $this->user->update_rest_user_profile(
                        $this->current_user->id, $user_data,
                        $user_details_data
                        );
                    
                    if ($user) {
                        if ($new_phone_number) {
                            //Send OTP for verification
                            $this->sendMobileVerificationOTP($user->phone_number, $user_data['mobile_otp']);
                        }
                        if ($new_email) {
                            // todo Send email for verification
                        }
                        log_message('debug', 'Class: Rest_user - update_post() record Updated successfully for USER ID :'.$id);
                        $this->set_response([
                            'status' => true,
                            'message' => 'Updated successfully!',
                            'result' => [
                                'id' => $user->id,
                                'name' => $user->name,
                                'token' => $user->security_token,
                                'user_type' => $user->user_type,
                                'email' => $user->email,
                                'gender' => $user->gender,
                                'weight' => $user->weight,
                                'height' => $user->height,
                                'date_of_birth' => $user->date_of_birth,
                                'phone_number' => $user->phone_number,
                                'fcm_token' => $user->fcm_token,
                                'is_verified_phone_number' => $user->is_verified_phone_number,
                                'is_verified_email' => $user->is_verified_email,
                                'mobile_otp' => $user->mobile_otp, // Todo - remove after development
                                'email_otp' => $user->email_otp
                            ]
                        ], REST_Controller::HTTP_OK);
                        
                    } else {
                        log_message('debug', 'Class: Rest_user - update_post() record Update request failed for USER ID :'.$id);
                        $this->set_response([
                            'status' => false,
                            'message' => 'Update request failed'
                        ], REST_Controller::HTTP_OK);
                    }
                    
                }
                

            }

        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_user - update_post(). Total execution time: ' . $time_elapsed_secs);
    }

    /**
     * @param $post_data
     * @return array
     */
    private function validate_profile_data($post_data)
    {
        $start = microtime(true);
        log_message('debug', 'Class: Rest_user - validate_profile_data() called');
        $errors = [];
        foreach ($post_data as $key => $value) {
            if (!in_array($key, array_keys(self::REST_ALLOWED_USER_PROFILE_DATA_UPDATE))) {
                $errors[] = "$key is not valid data.";
            } else {
                $rest_allowed_user_profile = self::REST_ALLOWED_USER_PROFILE_DATA_UPDATE;
                $definedKey = $rest_allowed_user_profile[$key];
                if ($key == 'email') {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "$key is invalid.";
                        continue;
                    }
                }
                $type_method = 'is_' . $definedKey['type'];
                if (
                    empty($value)
                    || isset($definedKey['min']) && strlen($value) < $definedKey['min']
                    || isset($definedKey['max']) && strlen($value) > $definedKey['max']
                    || !$type_method($value)
                ) {
                    $errors[] = "$key is invalid!";
                }
            }
        }
        log_message('debug', 'Class: Rest_user - validate_profile_data() $responce');
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_user - validate_profile_data(). Total execution time: ' . $time_elapsed_secs);
        return $errors;

    }

    /**
     * Send OTP
     * @param $phoneNumber
     * @param $otp
     * @return mixed
     */
    private function sendMobileVerificationOTP($phoneNumber, $otp)
    {
        $start = microtime(true);
        log_message('debug', 'Class: Rest_user - sendMobileVerificationOTP() called');
        $sms = "Verification code for ZingUpLife is: $otp";
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_user - sendMobileVerificationOTP(). Total execution time: ' . $time_elapsed_secs);
        return $this->Mailing->send_sms($phoneNumber,
            $sms
        );
    }

    /**
     * Resend OTP
     */
    public function resend_otp_get()
    {   
        $start = microtime(true);
        log_message('debug', 'Class: Rest_user - resend_otp_get() called');
        $queryString = $this->_get_args;
        if (!isset($queryString['phone_number']) || strlen($queryString['phone_number']) != 10) {
            log_message('debug', 'resend_otp_get() Invalid phone number');
            $this->set_response([
                'status' => false,
                'message' => 'Invalid phone number'
            ], REST_Controller::HTTP_OK);
        } else {

            $user = $this->user->get_user_by("phone_number", $queryString['phone_number']);
            if ($user) {

                $user_data = [];
                $user_data['mobile_otp'] = $this->rest_security->generateOTPTokenForUser("mobile_otp");
                $user_data['mobile_otp_expire'] = $this->rest_security->getSecurityTokenExpire(1);

                $user = $this->user->update_rest_user_profile($user->id, $user_data, []);

                // Send OTP via SMS
                $smsGatewayResponse = $this->sendMobileVerificationOTP($user->phone_number, $user_data['mobile_otp']);
                log_message('debug', 'Class: Rest_user - resend_otp_get() OTP sent successfully!');
                $this->set_response([
                    'status' => true,
                    'message' => 'OTP sent successfully!',
                    'result' => [
                        'phone_number' => $user->phone_number,
                        'mobile_otp' => $user->mobile_otp, // Todo - remove after development
                    ]
                ], REST_Controller::HTTP_OK);

            } else {
                log_message('debug', 'Class: Rest_user - resend_otp_get() Resent otp request failed');
                $this->set_response([
                    'status' => false,
                    'message' => 'Resent otp request failed'
                ], REST_Controller::HTTP_OK);
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_user - resend_otp_get(). Total execution time: ' . $time_elapsed_secs);
    }

    /**
     * Verify OTP
     */
    public function verify_otp_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Rest_user - verify_otp_post() called');
        $post_data = $this->request->body;
        if (!isset($post_data['phone_number']) || strlen($post_data['phone_number']) != 10) {
            log_message('debug', 'Class: Rest_user - verify_otp_post() Invalid phone number');
            $this->set_response([
                'status' => false,
                'message' => 'Invalid phone number'
            ], REST_Controller::HTTP_OK);
        } else if (!isset($post_data['otp']) || strlen($post_data['otp']) != 4) {
            log_message('debug', 'Class: Rest_user - verify_otp_post() Invalid OTP');
            $this->set_response([
                'status' => false,
                'message' => 'Invalid OTP'
            ], REST_Controller::HTTP_OK);
        } else {


            $user = $this->user->get_user_by("phone_number", $post_data['phone_number']);

            if ($user) {

                $now = new DateTime('now');
                $token_valid_datetime = new DateTime($user->mobile_otp_expire);
                if ($user->mobile_otp != $post_data['otp'] || $now > $token_valid_datetime) {
                    log_message('debug', 'Class: Rest_user - verify_otp_post() Invalid OTP');
                    $this->set_response([
                        'status' => false,
                        'message' => 'Invalid otp'
                    ], REST_Controller::HTTP_OK);
                } else {
                    $user_data = [];
                    $user_data['mobile_otp'] = null;
                    $user_data['mobile_otp_expire'] = null;
                    $user_data['is_verified_phone_number'] = 1;
                    // If user is verifying phone number first time them make it registered used
                    if($user->user_type == self::REST_USER_TYPES['GUEST']){
                        $user_data['user_type'] = self::REST_USER_TYPES['REGISTERED'];
                    }

                    $user = $this->user->update_rest_user_profile($user->id, $user_data, []);

                    // Update contacts system user id for current user mobile number
                    $this->user->update_contact_system_user_id($user->phone_number, $user->id);
                    log_message('debug', 'Class: Rest_user - verify_otp_post() OTP verified!');
                    $this->set_response([
                        'status' => true,
                        'message' => 'OTP verified!',
                        'result' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'token' => $user->security_token,
                            'is_verified_phone_number' => $user->is_verified_phone_number,
                        ]
                    ], REST_Controller::HTTP_OK);
                }

            } else {
                log_message('debug', 'Class: Rest_user - verify_otp_post() Resent otp request failed');
                $this->set_response([
                    'status' => false,
                    'message' => 'Resent otp request failed'
                ], REST_Controller::HTTP_OK);
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_user - verify_otp_post(). Total execution time: ' . $time_elapsed_secs);
    }

    /**
     * Upload profile image
     */
    public function profile_image_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Rest_user - profile_image_post() called');
        $post_data = $this->request->body;
        if (!isset($post_data['profile_image']) && !empty($post_data['profile_image'])) {
            log_message('debug', 'Class: Rest_user - profile_image_post() Invalid profile image!');
            $this->set_response([
                'status' => false,
                'message' => 'Invalid profile image!'
            ], REST_Controller::HTTP_OK);
        } else {

            $user = $this->current_user;
            if ($user) {

                // Todo Upload image

                $user_data['profile_image'] = '';

                $user = $this->user->update_rest_user_profile($user->id, $user_data, []);
                log_message('debug', 'Class: Rest_user - profile_image_post() Profile picture updated successfully!');
                $this->set_response([
                    'status' => true,
                    'message' => 'Profile picture updated successfully!',
                    'result' => [
                        'id' => $user->id,
                        'profile_image' => $user->profile_image
                    ]
                ], REST_Controller::HTTP_OK);

            } else {
                log_message('debug', 'Class: Rest_user - profile_image_post() Failed to upload image');
                $this->set_response([
                    'status' => false,
                    'message' => 'Failed to upload image'
                ], REST_Controller::HTTP_OK);
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_user - profile_image_post(). Total execution time: ' . $time_elapsed_secs);

    }

    /*-----------------add contact------------------*/

    public function add_contacts_post()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Rest_user - add_contacts_post() called');
        if (empty($this->current_user)) {
            log_message('debug', 'Class: Rest_user - add_contacts_post() there is no user details');
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $con_id = $this->current_user->id;

            $post_data = $this->request->body;
            $contacts = isset($post_data['contacts'])?$post_data['contacts']:null;

            if (!empty($contacts) && is_array($contacts)) {

                $response = false;
                foreach ($contacts as $contact) {
                    $response = $this->User->addcontact($contact, $con_id);
                }

                if ($response) {
                    log_message('debug', 'Class: Rest_user - add_contacts_post() contact added successfully!');
                    $this->set_response([
                        'status' => TRUE,
                        'message' => 'CONTACT ADDED SUCCESSFULLY'
                    ], REST_Controller::HTTP_OK); //OK (200) being the HTTP response code
                } else {
                    log_message('debug', 'Class: Rest_user - add_contacts_post() sorry your contact did not added');
                    $this->set_response([
                        'status' => FALSE,
                        'message' => 'SORRY YOUR CONTACT DIDN\'T ADDED'
                    ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                }
            } else {
                log_message('debug', 'Class: Rest_user - add_contacts_post() contact is empty');
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'CONTACTS IS EMPTY'
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_user - add_contacts_post(). Total execution time: ' . $time_elapsed_secs);
    }

    /*-----------------contacts of user------------------*/

    public function my_contacts_get()
    {
        $start = microtime(true);
        log_message('debug', 'Class: Rest_user - my_contacts_get() called');
        if (empty($this->current_user)) {
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            $con_user_id = $this->current_user->id;
            $response = $this->User->usercontacts($con_user_id);
            log_message('debug', 'Class: Rest_user - my_contacts_get() $response for USER ID : '.$con_user_id);
            $this->set_response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code

        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: Rest_user - my_contacts_get(). Total execution time: ' . $time_elapsed_secs);
    }
}
