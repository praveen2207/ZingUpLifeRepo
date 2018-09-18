<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class REST_notification extends REST_Controller
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
        $this->load->library('FCM');
        $this->current_user = $this->rest_security->getUser();
        $this->timezone = date('Y-m-d\TH:i:s\Z', time());
    }

  

    //--------------------------------------------------------------------------------------
    /**
     * Update post results
     */
    
    public function send_notification_post(){
        $start = microtime(true);
        $post_data = $this->request->body;
        $fcm_token = $post_data['fcm_token'];
        $title = $post_data['title'];
        $bodyMessage = $post_data['bodyMessage'];
        log_message('debug', 'Class: REST_notification - send_notification_post() called');
        
        $user = $this->current_user;
        if (empty($this->current_user)) {
            $this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
        } else {
            
            $this->fcm->send($fcm_token, $title, $bodyMessage, $notifPayload=array() );
            
        }
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: REST_notification - send_notification_post(). Total execution time: ' . $time_elapsed_secs);
    }

    //--------------------------------------------------------------------------------------
    /**
     * Update post results
     */
    
    public function save_fcm_token_get(){
        $start = microtime(true);
        log_message('debug', 'Class: REST_notification - save_fcm_token_get() called');
        //update FCM
        if (isset($_GET['fcm_token']) && trim($_GET['fcm_token'])!=''){
            $fcm_update = $this->user->updateFCMToken($this->current_user->id, $_GET['fcm_token']);
        }
        $this->set_response($fcm_update, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        $time_elapsed_secs = microtime(true) - $start;
        log_message('debug', 'Class: REST_notification - save_fcm_token_get(). Total execution time: ' . $time_elapsed_secs);
    }
    
    
}
