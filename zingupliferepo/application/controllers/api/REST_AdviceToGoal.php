<?php
class REST_AdviceToGoal extends CI_Controller {
	
	public function useradvice($adviceid = NULL) {
	    $start = microtime(true);
	    log_message('debug', 'Class: REST_AdviceToGoal - useradvice() called');
		$advice_id = $adviceid;
		
		// getting goal id from table 'zul_advice_master'
		$this->db->select ( 'goal_id' );
		$this->db->where ( 'advice_id', $advice_id );
		$query = $this->db->get ( 'zul_advice_master' );
		foreach ( $query->result () as $row ) {
			$goal_id = $row->goal_id;
		}
		
		// getting userid from table 'users' using the bearer token
		$headers = null;
		if (isset ( $_SERVER ['Authorization'] )) {
			$headers = trim ( $_SERVER ["Authorization"] );
		} else if (isset ( $_SERVER ['HTTP_AUTHORIZATION'] )) {
			$headers = trim ( $_SERVER ["HTTP_AUTHORIZATION"] );
		} elseif (function_exists ( 'apache_request_headers' )) {
			$requestHeaders = apache_request_headers ();
			
			$requestHeaders = array_combine ( array_map ( 'ucwords', array_keys ( $requestHeaders ) ), array_values ( $requestHeaders ) );
			
			if (isset ( $requestHeaders ['Authorization'] )) {
				$headers = trim ( $requestHeaders ['Authorization'] );
			}
		}
		
		if (! empty ( $headers )) {
			if (preg_match ( '/Bearer\s(\S+)/', $headers, $matches )) {
				$token = $matches [1];
				$this->db->select ( 'id' );
				$this->db->where ( 'security_token', $token );
				$query = $this->db->get ( 'users' );
				foreach ( $query->result () as $row ) {
					$usrid = $row->id;
				}
			}
			// insertion of data to table 'zul_user_diary'
			$data = array (
					'user_id' => $usrid,
					'goal_id' => $goal_id
			);
			$timezone = date('Y-m-d\TH:i:s\Z', time());
			$this->load->library('Curl');
			$this->db->insert ( 'zul_user_diary', $data );
			$user_diary_id = $this->db->insert_id();
			
		    $dropEventStr = "event_type=ADVICE_TO_GOAL,advice_id=".$advice_id.",goalID=".$goal_id.",user_diary_id=".$user_diary_id.",timestamp=".$timezone.",userID=".$usrid;
			$curlPost = $this->curl->eventDrop_post($dropEventStr);
		} else {
		    log_message('debug', 'Class: REST_AdviceToGoal - useradvice() Unauthorized');
			header ( "HTTP/1.1 401 Unauthorized" );
			exit ();
		}
		$time_elapsed_secs = microtime(true) - $start;
		log_message('debug', 'Class: REST_AdviceToGoal - useradvice(). Total execution time: ' . $time_elapsed_secs);
	}
}

?>