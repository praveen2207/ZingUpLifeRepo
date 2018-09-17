<?php

/**
 * This class used for admin users login and users actions/activities
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:01-09-2015
 * 
 * */
class Admin_users extends CI_Model {

    function __construct() {
// Call the Model constructor
        parent::__construct();
    }

    /*
     *  Function to get user details by given username  
     */

    public function get_user_details_by_username($username) {
        $this->db->select('admin_users.*,admin_users_details.*');
        $this->db->from('admin_users');
        $this->db->join('admin_users_details', 'admin_users.id = admin_users_details.user_id', 'left');
        $this->db->where('admin_users.username', $username);
        $query = $this->db->get();
        $query_result = $query->result();
        $user_details = array();
        if (count($query_result) == 0) {
            $user_details = $query_result;
        } else {
            $user_details = $query_result[0];
        }
        return $user_details;
    }

    /* Above function ends here */

    /*
     *  Function to validate user credentials  
     */

    public function validate_user($username, $password) {
        $user_validation_details = array();
        $user_details = self::get_user_details_by_username($username);
        $user_validation_details['user_details'] = $user_details;
        if (!empty($user_details)) {
            $validate_password = PasswordHash::validate_password($password, $user_details->password);
            if ($validate_password == 1 || $validate_password == true) {
                $user_validation_details['validation_status']['status'] = 'Success';
                $user_validation_details['validation_status']['error_type'] = '';
            } else {
                $user_validation_details['validation_status']['status'] = 'Invalid password';
                $user_validation_details['validation_status']['error_type'] = 'password';
            }
        } else {
            $user_validation_details['validation_status']['status'] = 'Invalid username';
            $user_validation_details['validation_status']['error_type'] = 'username';
        }
        return $user_validation_details;
    }

    /* Above function ends here */



    /*
     *  Validating user's credentials and sending reset password token to user 
     */

    public function forgot_password_request($username, $submit) {
        $user_details = $data['user_details'] = self::get_user_details_by_username($username);
        if (count($user_details) == 0) {
            return 'Failed';
        } else {
            $hashed = PasswordHash::create_hash($username);
            $hashed_data = explode(':', $hashed);
            $reset_password_token = str_replace('/', '', $hashed_data[2]);

            $reset_password_token_time = date('Y-m-d H:i:s');
            $data['reset_password_token_data'] = $reset_password_token_data = array(
                'reset_password_token' => $reset_password_token,
                'reset_password_time' => $reset_password_token_time
            );

            $this->db->where('username', $username);
            $this->db->update('admin_users', $reset_password_token_data);

            $email_content = $this->load->view('admin/emails/forgot_password_email', $data, true);
            $to = $username;
            $from = "Zingup";
            $subject = "Zingup account reset password request.";
            $message = $email_content;

            $this->Mailing->send_mail($to, $from, $subject, $message);


            return 'Success';
        }
    }

    /* Above function ends here */


    /*
     *  Function for validating password token
     */

    public function validate_password_token($passwordToken) {
        $this->db->select('admin_users.*');
        $this->db->from('admin_users');
        $this->db->where('admin_users.reset_password_token', $passwordToken);
        $query = $this->db->get();
        $query_result = $query->result();

        if (count($query_result) == 0) {
            return 'Failed';
        } else {
            $user_details = $query_result[0];
            $to_time = strtotime(date('Y-m-d H:i:s'));
            $from_time = strtotime($user_details->reset_password_time);
            $time_difference = abs($to_time - $from_time);

            if ($time_difference >= 7200) {
                return 'Failed';
            } else {
                return $user_details;
            }
        }
    }

    /* Above function ends here */


    /*
     *  updating new password for admin user 
     */

    public function update_new_password($username, $password) {
        $reset_password = array(
            'password' => $password,
            'reset_password_token' => '',
            'reset_password_time' => ''
        );

        $this->db->where('username', $username);
        $this->db->update('admin_users', $reset_password);

        $data['user_details'] = $user_details = self::get_user_details_by_username($username);
        $email_content = $this->load->view('admin/emails/change_password_success', $data, true);
        $to = $username;
        $from = "Zingup";
        $subject = "Zingup account password changed successfully.";
        $message = $email_content;

        $this->Mailing->send_mail($to, $from, $subject, $message);
        $messgae_to = '+91' . $user_details->phone;
        $sms_content = 'Your Zingup account password has been changed successfully.';
        $this->Mailing->send_sms($messgae_to, $sms_content);
        return TRUE;
    }

    /* Above function ends here */

    /*
     *  Function for validating activation code and activate user account
     */

    public function logout($user_data) {
        $current_time = date('Y-m-d H:i:s');
        $ip = $this->input->ip_address();
        $logout_data = array(
            'last_logged_in' => $current_time,
            'ip_address' => $ip,
        );

        $this->db->where('username', $user_data->username);
        $this->db->update('admin_users', $logout_data);
        return TRUE;
    }

    public function get_all_users() {
        $this->db->select('admin_users.*, user_roles.role as user_role');
        $this->db->from('admin_users');
        $this->db->join('user_roles', 'admin_users.role = user_roles.id');
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    public function user_details($id) {
        $this->db->select('admin_users.*,admin_users_details.*, user_roles.role as user_role');
        $this->db->from('admin_users');
        $this->db->join('admin_users_details', 'admin_users.id = admin_users_details.user_id', 'left');
        $this->db->join('user_roles', 'admin_users.role = user_roles.id');
        $this->db->where('admin_users.id', $id);
        $query = $this->db->get();
        $query_result = $query->result();
        $user_details = array();
        if (count($query_result) == 0) {
            $user_details = $query_result;
        } else {
            $user_details = $query_result[0];
        }
        return $user_details;
    }

    public function get_user_roles() {
        $this->db->select('user_roles.*');
        $this->db->from('user_roles');
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }

    /*
     *  Function to delete customer data in database
     */

    public function delete_user_roles($role_id) {
        $this->db->where('id', $role_id);
        $this->db->delete('user_roles');

        return TRUE;
    }

    /* Above function ends here */

    /*
     *  Function to update user's profile data in database
     */

    public function update_user_details($user_data) {
        $user_id = $user_data['user_id'];
        unset($user_data['user_id']);
        unset($user_data['submit']);

        $updated_user_data = array(
            'name' => $user_data['name'],
        );
        $this->db->where('id', $user_id);
        $this->db->update('admin_users', $updated_user_data);
        unset($user_data['name']);

        $this->db->where('user_id', $user_id);
        $this->db->update('admin_users_details', $user_data);
        return TRUE;
    }

    /* Above function ends here */

    /*
     *  Function to delete customer data in database
     */

    public function delete_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('admin_users_details');

        $this->db->where('id', $user_id);
        $this->db->delete('admin_users');
		
		$this->db->where('paid_by', $user_id);
        $this->db->delete('transaction_details');

        return TRUE;
    }

    /* Above function ends here */

    /*
     *  Function to check if user already exist with given username in database 
     */

    public function check_username_availability($username) {
        $query = $this->db->get_where('admin_users', array('username' => $username));
        return $query->result();
    }

    /* Above function ends here */


    /*
     *  Function to create a new user ans store user's data in database
     */

    public function create_user($user_data, $hashed) {
        //create_user

        $hashed_data = explode(':', $hashed);
        $salt = $hashed_data[2];
        $password = $hashed;


        $new_user_data = array(
            'username' => $user_data['username'],
            'password' => $password,
            'role' => $user_data['role'],
            'name' => $user_data['name'],
            'status' => 'active',
            'salt' => $salt
        );
        $this->db->insert('admin_users', $new_user_data);
        $user_id = $this->db->insert_id();


        $new_user_profile_data = array(
            'user_id' => $user_id,
            'gender' => $user_data['gender'],
            'phone' => $user_data['phone'],
            'age' => $user_data['age'],
        );
        $this->db->insert('admin_users_details', $new_user_profile_data);

        return true;
    }

    /* Above function ends here */


    /*
     *  updating new password for admin user 
     */

    public function reset_new_password($username, $password) {
        $reset_password = array(
            'password' => $password,
            'reset_password_token' => '',
            'reset_password_time' => ''
        );

        $this->db->where('username', $username);
        $this->db->update('admin_users', $reset_password);

        $data['user_details'] = $user_details = self::get_user_details_by_username($username);
        $email_content = $this->load->view('admin/emails/change_password_success', $data, true);
        $to = $username;
        $from = "Zingup";
        $subject = "Zingup account password changed successfully.";
        $message = $email_content;

        $this->Mailing->send_mail($to, $from, $subject, $message);
        $messgae_to = '+91' . $user_details->phone;
        $sms_content = 'Your Zingup account password has been changed successfully.';
        $this->Mailing->send_sms($messgae_to, $sms_content);
        return TRUE;
    }

    /* Above function ends here */

    public function search_user($search_data) {
        if ($search_data['name'] == '' && $search_data['role'] == '') {
            $this->db->select('admin_users.*, user_roles.role as user_role');
            $this->db->from('admin_users');
            $this->db->join('user_roles', 'admin_users.role = user_roles.id');
        } elseif ($search_data['name'] != '' && $search_data['role'] != '') {
            $this->db->select('admin_users.*, user_roles.role as user_role');
            $this->db->from('admin_users');
            $this->db->join('user_roles', 'admin_users.role = user_roles.id');
            $this->db->like('admin_users.name', $search_data['name']);
            $this->db->where('admin_users.role', $search_data['role']);
        } elseif ($search_data['name'] != '' && $search_data['role'] == '') {
            $this->db->select('admin_users.*, user_roles.role as user_role');
            $this->db->from('admin_users');
            $this->db->join('user_roles', 'admin_users.role = user_roles.id');
            $this->db->like('admin_users.name', $search_data['name']);
        } elseif ($search_data['name'] == '' && $search_data['role'] != '') {
            $this->db->select('admin_users.*, user_roles.role as user_role');
            $this->db->from('admin_users');
            $this->db->join('user_roles', 'admin_users.role = user_roles.id');
            $this->db->where('admin_users.role', $search_data['role']);
        } else {
            $this->db->select('admin_users.*, user_roles.role as user_role');
            $this->db->from('admin_users');
            $this->db->join('user_roles', 'admin_users.role = user_roles.id');
        }
        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }
	
	public function add_wellness_tip($name,$id)
	{
		$arr = array('image' => $name,'added_by' => $id );
		$this->db->insert('daily_wellness_tips',$arr);
	}
	
	public function send_wellness_tips()
	{
		$today = date('Y-m-d');
	
		
		$this->db->select('*');
		$this->db->from('daily_wellness_tips');
		$exists = $this->db->get();
		
		if($exists->num_rows() != 0) 
		{
			
			$this->db->select('*');
			$this->db->from('daily_wellness_tips');
			$this->db->where('sent','0');
			$nt_sent = $this->db->get();
			
			if($nt_sent->num_rows() == 0)
			{
				$this->db->select('*');
				$this->db->from('daily_wellness_tips');
				$this->db->where('sent','1');
				$sent = $this->db->get();

				foreach($sent->result() as $s)
				{
					$ts1 = strtotime($today);
					$ts2 = strtotime($s->sent_on);

					$year1 = date('Y', $ts1);
					$year2 = date('Y', $ts2);

					$month1 = date('m', $ts1);
					$month2 = date('m', $ts2);

					$diff = abs((($year2 - $year1) * 12) + ($month2 - $month1));
					
					if($diff > 12)
					{
						
						
						$this->db->select('username,name,id');
						$this->db->from('users');
						$this->db->where('status','Active');
						$this->db->where('date_sent !=',$today);
						$users = $this->db->get();
						
						foreach($users->result() as $user)
						{
							
								$arr = array('sent' => '1','date_sent' => $today );
								$this->db->where('id',$user->id);
								$this->db->update('users',$arr);
								
								$sent_update = array('sent' => '1', 'sent_on' => $today);
								$this->db->where('id',$s->id);
								$this->db->update('daily_wellness_tips',$sent_update);
								
								$to = $user->username;
								$from = "Zinguplife<info@zinuplife.com>";
								$registration_mail_subject = "Daily Wellness Tips";
								$data['name'] = $user->name;
								$data['image'] = $s->image;
								$review_reminder = $this->load->view('emails/daily_wellness_tips', $data, true);
								
								$registration_message = $review_reminder;
						
								$this->Mailing->send_mail($to, $from, $registration_mail_subject, $registration_message);
						
							
						}
						
						break;
					}
				}
			}
			else
			{
				foreach($nt_sent->result() as $s)
				{
					
					
					$this->db->select('username,name,id');
					$this->db->from('users');
					$this->db->where('status','Active'); 
					$this->db->where('date_sent !=',$today);
					$users = $this->db->get(); 
					
					foreach($users->result() as $user)
					{
						
							$arr = array('sent' => '1','date_sent' => $today );
							$this->db->where('id',$user->id);
							$this->db->update('users',$arr);
							
							$sent_update = array('sent' => '1', 'sent_on' => $today);
							$this->db->where('id',$s->id);
							$this->db->update('daily_wellness_tips',$sent_update);
								
							$to = $user->username;
							$from = "Zinguplife<info@zinuplife.com>";
							$registration_mail_subject = "Daily Wellness Tips";
							$data['name'] = $user->name;
							$data['image'] = $s->image;
							$review_reminder = $this->load->view('emails/daily_wellness_tips', $data, true);
							
							$registration_message = $review_reminder;
					
							$this->Mailing->send_mail($to, $from, $registration_mail_subject, $registration_message);
							
						
					}
					
					break;
				}
			}
		}
	}
    
    

}
