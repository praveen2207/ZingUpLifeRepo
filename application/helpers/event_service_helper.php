<?php 
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');





if ( ! function_exists('event_service'))
{
	function event_service($var)
	{
	    $CI = get_instance();
	    $CI->load->model('Event_service_model');
	    $array=explode(",",$var);
	    foreach ($array as $value) {
	    	if (strpos($value, 'event_type') !== false) { $results[] = $value; }
	    	if (strpos($value, 'userID') !== false) { $results[] = $value; }
	    }
	    $event_type_string = $results[0];
	    $event = explode("=",$event_type_string);
	    $event_type = $event[1];
	    
	    $user_id_string = $results[1];
	    $user = explode("=",$user_id_string);
	    $user_id = $user[1];
	     
	    $data = array(
	    		'user_id'=>$user_id,
	    		'event_type'=>$event_type,
	        	'event_string'=>$var
	    );
	    
	    $CI->Event_service_model->insert_event($data);
	    
	    log_message('debug', 'inserted into event backup table ');
	    
	    
	    log_message('debug', 'event_service called !');
	    
	    $service_url = 'http://ec2-35-166-83-81.us-west-2.compute.amazonaws.com:8080/ZULServices/zul/DropEventService/dropevent'; //STAGING 
	    //$service_url = 'http://54.191.29.141:8080/ZULServices/zul/DropEventService/dropevent'; //PRODUCTION
		$curl = curl_init($service_url);
		log_message('debug', '$service_url'.$service_url);
		log_message('debug', 'String $var'.$var);
		$curl_post_data =  $var;
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		curl_setopt($curl, CURLOPT_HTTPHEADER,  array('Content-type: application/json'));
		log_message('debug', 'event_service calling !');
		$curl_response = curl_exec($curl);
		error_log(print_r($curl_response,true));
		log_message('debug', 'closing service!');
		
		curl_close($curl);
	}
}