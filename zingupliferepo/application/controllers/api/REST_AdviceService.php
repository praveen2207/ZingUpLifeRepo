<?php
class REST_AdviceService extends CI_Controller {
	public function useradvice() 
	{
	    $start = microtime(true);
	    log_message('debug', 'Class: REST_AdviceService - useradvice() called');
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
		
		// HEADER: Get the access token from the header
		if (! empty ( $headers )) {
			if (preg_match ( '/Bearer\s(\S+)/', $headers, $matches )) {
				$token = $matches [1];
				$this->db->select ( 'id' );
				$this->db->where ( 'security_token', $token );
				$query = $this->db->get ( 'users' );
				foreach ( $query->result () as $row ) {
					$usrid = $row->id;
					$sql = " select " . " a.advice_id," . " a.goal_id,". " a.advice_type, " . " a.advice_description, " . " b.added_on, " . " b.user_advice_id ". " from " . " zul_advice_master a INNER JOIN zul_user_advice b " . " where " . " a.advice_id= b.advice_id and " . " b.user_id = " . $usrid . "  order by b.added_on desc ";
					// ." LIMIT ".$a;
					$query = mysqli_query ( $con, $sql );
					$json [] = array ();
					
					while ( $row = mysqli_fetch_assoc ( $query ) ) {
						$json [] = array (
								"advice_id" => $row ['advice_id'],
								"goal_id" => $row ['goal_id'],
								"advice_type" => $row ['advice_type'],
								"advice_description" => $row ['advice_description'],
								"added_on" => $row ['added_on'] ,
								"user_advice_id" => $row['user_advice_id']
						);
					}
					$result = $this->db->query ( $sql );
					
					$result_array = array ();
					if ($result) {
						$results = $result->result_array ();
						foreach ( $results as $row ) {
							$result_array [] = array (
									'advice_id' => $row ['advice_id'],
									'goal_id' => $row ['goal_id'],
									'advice_type' => $row ['advice_type'],
									'advice_description' => $row ['advice_description'],
									'added_on' => $row ['added_on'],
									"user_advice_id" => $row['user_advice_id']
							);
						}
						log_message('debug', 'Class: REST_AdviceService - useradvice() $response');
						echo json_encode ( $result_array );
					} else {
					    log_message('debug', 'Class: REST_AdviceService - useradvice() error in fetching');
						echo "error in fetching";
					}
				}
			}
		} else {
		    log_message('debug', 'Class: REST_AdviceService - useradvice() Unauthorized');
			header ( "HTTP/1.1 401 Unauthorized" );
			exit ();
		}
		$time_elapsed_secs = microtime(true) - $start;
		log_message('debug', 'Class: REST_AdviceService - useradvice(). Total execution time: ' . $time_elapsed_secs);
	}
	
}
?>