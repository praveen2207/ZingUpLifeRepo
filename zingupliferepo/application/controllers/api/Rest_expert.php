<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_expert extends REST_Controller
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

		$this->load->library('REST_Security');
		$this->load->library('FCM');
		$this->load->model('Expert');
		$this->current_user = $this->rest_security->getUser();
		$this->timezone = date('Y-m-d\TH:i:s\Z', time());//new MongoDate(time());//date("Y-m-d\TH:i:s\Z");//2017-03-14T21:16:00Z
	}
	
	public function sme_profile_get(){
		$start = microtime(true);
		log_message('debug', 'Class: REST_expert - sme_profile_get() called');
		if (empty($this->current_user)) {
			log_message('debug', 'Class: REST_expert - sme_profile_get() there is no user details');
			$this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$sme_id = $this->get("sme_id");
			$response = $this->Expert->getprofile2($sme_id);
			if(!empty($response)){
				log_message('debug', 'Class: REST_expert - sme_profile_get() $response');
				$this->set_response($response, REST_Controller::HTTP_OK);
			}else{
				log_message('debug', 'Class: REST_expert - sme_profile_get() there is no sme user detail.');
				$this->set_response([
						'status'=> false,
						'message'=> 'There is no sme user details'
				], REST_Controller::HTTP_OK);
			}
		}
		$time_elapsed_secs = microtime(true) - $start;
		log_message('debug', 'Class: REST_expert - sme_profile_get(). Total execution time: ' . $time_elapsed_secs);
	}
}