<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rest_business_provider extends REST_Controller
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
		$this->load->model('Business');
		$this->load->model('Searches');
		$this->current_user = $this->rest_security->getUser();
		$this->timezone = date('Y-m-d\TH:i:s\Z', time());//new MongoDate(time());//date("Y-m-d\TH:i:s\Z");//2017-03-14T21:16:00Z
	}
	public function business_provider_detail_get() {
		$start = microtime(true);
		log_message('debug', 'Class: Rest_business_provider - business_provider_details_get() called');
		if (empty($this->current_user)) {
			log_message('debug', 'Class: Rest_business_provider - business_provider_details_get() there is no user details');
			$this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$business_provider_id = $this->get('business_provider_id');
			$response = $this->Business->get_business_provider_details($business_provider_id);
			if(!empty($response['details'])){
				log_message('debug', 'Class: Rest_business_provider - business_provider_details_get() $response');
				$this->set_response([
						'business_provider_id' => $response['details']->id,
						'logo' => $response['details']->logo,
						'name' => $response['details']->name,
						'description' => $response['details']->description,
						'phone' => $response['details']->phone,
						'landline' => $response['details']->landline,
						'address' => $response['details']->street1,
						'city' => $response['details']->city,
						'state' => $response['details']->state,
						'country' => $response['details']->country,
						'email' => $response['details']->email,
						'website' => $response['details']->website
				], REST_Controller::HTTP_OK);
			}else{
				log_message('debug', 'Class: Rest_business_provider - business_provider_details_get() there is no sme user detail.');
				$this->set_response([
						'status'=> false,
						'message'=> 'There is no service provider details'
				], REST_Controller::HTTP_OK);
			}
		}
		$time_elapsed_secs = microtime(true) - $start;
		log_message('debug', 'Class: REST_expert - business_provider_details_get(). Total execution time: ' . $time_elapsed_secs);
	}
	
	public function business_providers_get() {
		$start = microtime(true);
		log_message('debug', 'Class: Rest_business_provider - business_providers_get() called');
		if (empty($this->current_user)) {
			log_message('debug', 'Class: Rest_business_provider - business_providers_get() there is no user details');
			$this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$response = $this->Business->get_all_business_providers();
			if(!empty($response)){
				log_message('debug', 'Class: Rest_business_provider - business_providers_get() $response');
				$this->set_response($response, REST_Controller::HTTP_OK);
			}else{
				log_message('debug', 'Class: Rest_business_provider - business_providers_get() there is no sme user detail.');
				$this->set_response([
						'status'=> false,
						'message'=> 'There are no service providers'
				], REST_Controller::HTTP_OK);
			}
		}
		$time_elapsed_secs = microtime(true) - $start;
		log_message('debug', 'Class: REST_expert - business_providers_get(). Total execution time: ' . $time_elapsed_secs);
	}
	
	public function filter_business_provider_get() {
		$start = microtime(true);
		log_message('debug', 'Class: Rest_business_provider - filter_business_provider_get() called');
		if (empty($this->current_user)) {
			log_message('debug', 'Class: Rest_business_provider - filter_business_provider_get() there is no user details');
			$this->set_response(null, REST_Controller::HTTP_FORBIDDEN);
		} else {
			$post_data=[];
			$post_data['keywords'] = $this->get('keyword');
			$post_data['locations'] = $this->get('location');
			$response = $this->Searches->store_search_keywords($post_data);
			if(!empty($response)){
				log_message('debug', 'Class: Rest_business_provider - filter_business_provider_get() $response');
				$this->set_response($response, REST_Controller::HTTP_OK);
			}else{
				log_message('debug', 'Class: Rest_business_provider - filter_business_provider_get() there is no sme user detail.');
				$this->set_response([
						'status'=> false,
						'message'=> 'There are no service providers'
				], REST_Controller::HTTP_OK);
			}
		}
		$time_elapsed_secs = microtime(true) - $start;
		log_message('debug', 'Class: REST_expert - filter_business_provider_get(). Total execution time: ' . $time_elapsed_secs);
	}
}
