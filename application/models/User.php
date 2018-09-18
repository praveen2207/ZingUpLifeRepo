<?php

/**
 * This class used for users registration, login and users actions/activities
 *
 * @author Vikrant <vikrant@nuvodev.com>
 *
 * Date:04-08-2015
 *
 * */
class User extends CI_Model
{
//     const REST_USER_TYPES = [
//         'GUEST' => 'guest',
//         'REGISTERED' => 'registered'
//     ];

    function __construct()
    {
// Call the Model constructor
        parent::__construct();
    }

    /*
     *  Function to check if user already exist with given username in database 
     */

    public function check_username_availability($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->result();
    }



    /* Above function ends here */

    /*
     *  Function to create a new user ans store user's data in database
     */

    public function create_user($user_data, $hashed)
    {
        //create_user

        $hashed_data = explode(':', $hashed);
        $salt = $hashed_data[2];
        $password = $hashed;
        $activation_code = $salt;
        $current_date = date("Y");
        $dob = date('Y', strtotime($user_data['dob']));
        $age = $current_date - $dob;
        $dob_formate = date("Y-m-d", strtotime($user_data['dob']));
        $ip_original = $this->input->ip_address();
        if ($user_data['org_access_code']=="") {
        	$user_data['org_access_code'] = NULL;
        }else{
        	$updated_user_data = array(
        			'access_code_status' => 'N'
        	);
        	$this->db->where('access_code', $user_data['org_access_code']);
        	$this->db->update('organisation_access_code', $updated_user_data);
        }
        $new_user_data = array(
            'username' => $user_data['username'],
            'password' => $password,
            'name' => $user_data['name'],
            'status' => 'Active',
            'role' => 'user',
            'activation_token' => $salt,
            'salt' => $salt,
            'ip_address_original' => $ip_original,
        	'org_access_id' => $user_data['org_access_code'],
            'job_location' => $user_data['job_location'],
            'job_role' => $user_data['job_role']
        );
        $this->db->insert('users', $new_user_data);
        $user_id = $this->db->insert_id();
        if (!(isset($user_data['weight']))) {
            $user_data['weight'] = '';
        }

        $new_user_profile_data = array(
            'user_id' => $user_id,
            'gender' => $user_data['gender'],
            'age' => $age,
            'weight' => $user_data['weight'],
            'height' => $user_data['height'],
            'body_type' => $user_data['body_type'],
            'bmi' => $user_data['bmi'],
            'phone' => $user_data['phone'],
            'organization' => $user_data['organization'],
            'date_of_birth' => $dob_formate
        );
        $this->db->insert('user_details', $new_user_profile_data);

        return true;
    }

    /* Above function ends here */

    /*
     *  Function to get user details by given username  
     */

    public function validate_user($username, $password)
    {
        $user_validation_details = array();
        $user_details = self::get_user_details_by_username($username);
        $user_validation_details['user_details'] = $user_details;
        if (!empty($user_details)) {
            $validate_password = PasswordHash::validate_password($password, $user_details->password);
            if ($validate_password == 1 || $validate_password == true) {
                $user_validation_details['validation_status']['status'] = 'Success';
                $user_validation_details['validation_status']['error_type'] = '';
            } else {
                $user_validation_details['validation_status']['status'] = 'Username or password is invalid';
                $user_validation_details['validation_status']['error_type'] = 'password';
            }
        } else {
            $user_validation_details['validation_status']['status'] = 'Username or password is invalid';
            $user_validation_details['validation_status']['error_type'] = 'username';
        }
        return $user_validation_details;
    }

    /* Above function ends here */

    /*
     *  Function to validate user credentials  
     */

    public function get_user_details_by_username($username)
    {
        $this->db->select('users.*,user_details.*');
        $this->db->from('users');
        $this->db->join('user_details', 'users.id = user_details.user_id');
        $this->db->where('users.username', $username);
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
     *  Function for creating new user by facebook details
     */

    public function create_user_by_facebook_details($facebook_user_data)
    {
        $user_data = array(
            'username' => $facebook_user_data['email'],
            'name' => $facebook_user_data['name'],
            'status' => 'Active',
        );
        $this->db->insert('users', $user_data);
        $user_id = $this->db->insert_id();

        if ($facebook_user_data['gender'] == 'male') {
            $gender = 'Male';
        } elseif ($facebook_user_data['gender'] == 'female') {
            $gender = 'Female';
        } else {
            $gender = '';
        }
        $user_profile_data = array(
            'user_id' => $user_id,
            'gender' => $gender,
            'area_of_interest' => 3,
            'facebook_id' => $facebook_user_data['id']
        );


        $this->db->insert('user_details', $user_profile_data);
        return true;
    }

    /* Above function ends here */

    /* function for creating new user by google details */

    public function create_user_by_google_details($gmail_user_data)
    {
        $user_data = array(
            'username' => $gmail_user_data->email,
            'name' => $gmail_user_data->name,
            'status' => 'Active',
        );
        $this->db->insert('users', $user_data);
        $user_id = $this->db->insert_id();

        if ($gmail_user_data->gender == 'male') {
            $gender = 'Male';
        } elseif ($gmail_user_data->gender == 'female') {
            $gender = 'Female';
        } else {
            $gender = '';
        }
        $user_profile_data = array(
            'user_id' => $user_id,
            'gender' => $gender,
            'area_of_interest' => 3,
            'google_id' => $gmail_user_data->id
        );


        $this->db->insert('user_details', $user_profile_data);
        return true;
    }

    /* Above function ends here */

    /*
     *  Function to user's profile data in database
     */

    public function update_user_profile($user_data)
    {
        $user_id = $user_data['user_id'];
        if (isset($user_data['name']) && $user_data['name'] != '') {
            $updated_user_data = array(
                'name' => $user_data['name'],
            );
            $this->db->where('id', $user_id);
            $this->db->update('users', $updated_user_data);
            return $updated_user_data;
        }

        if (isset($user_data['gender']) && $user_data['gender'] != '') {
            $updated_user_data = array(
                'gender' => $user_data['gender'],
            );
        } elseif (isset($user_data['age']) && $user_data['age'] != '') {
            $updated_user_data = array(
                'age' => $user_data['age'],
            );
        } elseif (isset($user_data['phone']) && $user_data['phone'] != '') {
            $updated_user_data = array(
                'phone' => $user_data['phone'],
            );
        }
        $this->db->where('user_id', $user_id);
        $this->db->update('user_details', $updated_user_data);
        return $updated_user_data;
    }

    /* Above function ends here */

    /*
     *  Function for validating activation code and activate user account
     */

    public function validate_user_account($activation_code)
    {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->where('users.activation_token', $activation_code);
        $query = $this->db->get();
        $query_result = $query->result();

        if (count($query_result) == 0) {
            return FALSE;
        } else {
            $user_details = $query_result[0];
            $userId = $user_details->id;

            $activattion_data = array(
                'activation_token' => '',
                'status' => 'Active',
            );

            $this->db->where('id', $userId);
            $this->db->update('users', $activattion_data);
            return TRUE;
        }
    }

    /* Above function ends here */

    /*
     *  Validating user's credentials and sending reset password token to user 
     */

    public function forgot_password_request($username, $submit)
    {
        $user_details = $data['user_details'] = self::get_user_details_by_username($username);
        if (count($user_details) == 0) {
            return 'Failed';
        } else {
            if ($submit == 'Send OTP to Mobile Number') {
                $otp_token = time();
                $reset_password_otp_token_data = array(
                    'otp_token' => $otp_token,
                    'otp_token_time' => date('Y-m-d H:i:s'),
                );
                $this->db->where('username', $username);
                $this->db->update('users', $reset_password_otp_token_data);
                $messgae_to = '+91' . $user_details->phone;
                //$messgae_to = '+919902956083';
                //$sms_content = 'You have requested for reset password for your Zingup account.Your one time password is ' . $otp_token . 'This will valid for next 5 minutes';
                $sms_content = 'You have requested for reset password for your Zingup account. Your one time password is ' . $otp_token . '. This will valid for next 5 minutes';

                $this->Mailing->send_sms($messgae_to, $sms_content);
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
                $this->db->update('users', $reset_password_token_data);

                $email_content = $this->load->view('emails/forgot_password_email', $data, true);
                $to = $username;
                $from = "Zinguplife<info@zinguplife.com>";
                $subject = "Zingup account reset password request.";
                $message = $email_content;

                $this->Mailing->send_mail($to, $from, $subject, $message);
            }

            return 'Success';
        }
    }

    /* Above function ends here */


    /*
     *  Function for validating rest password otp token
     */

    public function reset_password_otp_check($otp)
    {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->where('users.otp_token', $otp);
        $query = $this->db->get();
        $query_result = $query->result();
        if (count($query_result) == 0) {
            return 'Failed';
        } else {
            $user_details = $query_result[0];
            $to_time = strtotime(date('Y-m-d H:i:s'));
            $from_time = strtotime($user_details->otp_token_time);

            $time_difference = abs($to_time - $from_time);
            if ($time_difference >= 300) {
                return 'Failed';
            } else {
                return $user_details;
            }
        }
    }

    /* Above function ends here */

    /*
     *  Function for validating password token
     */

    public function validate_password_token($passwordToken)
    {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->where('users.reset_password_token', $passwordToken);
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
     *  updating new password for user 
     */

    public function update_new_password($username, $password)
    {
        $reset_password = array(
            'password' => $password,
            'reset_password_token' => '',
            'reset_password_time' => '',
            'otp_token' => '',
            'otp_token_time' => ''
        );

        $this->db->where('username', $username);
        $this->db->update('users', $reset_password);

        $data['user_details'] = $user_details = self::get_user_details_by_username($username);
        $email_content = $this->load->view('emails/change_password_success', $data, true);
        $to = $username;
        $from = "Zinguplife<info@zinguplife.com>";
        $subject = "Zingup account password changed successfully.";
        $message = $email_content;

        $this->Mailing->send_mail($to, $from, $subject, $message);
        $messgae_to = '+91' . $user_details->phone;
        //$messgae_to = '+919902956083';
        $sms_content = 'Your Zingup account password has been changed successfully.';
        $this->Mailing->send_sms($messgae_to, $sms_content);
        return TRUE;
    }

    /* Above function ends here */

    /*
     * Function to change slot status 
     */

    public function change_slot_status($id)
    {
        $selected_slots_status_update = array(
            'active' => 'enable',
        );

        $this->db->where('id', $id);
        $this->db->update('services_slots', $selected_slots_status_update);


        return true;
    }

    /* Above function ends here */

    /*
     *  Function for validating activation code and activate user account
     */

    public function logout($user_data)
    {
        $current_time = date('Y-m-d H:i:s');
        $ip = $this->input->ip_address();
        $logout_data = array(
            'last_logged_in' => $current_time,
            'ip_address' => $ip,
        );

        $this->db->where('username', $user_data->username);
        $this->db->update('users', $logout_data);
        return TRUE;
    }

    /*
     *  Function to create a new user ans store user's data in database
     */

    public function subscribe($post_data)
    {
        $this->db->select('*');
        $this->db->from('users_subscriptions');
        $this->db->where('email', $post_data['email']);
        $query = $this->db->get();
        $query_result = $query->result();
        //echo count($query_result);
        //  exit();
        if (count($query_result) > 0) {
            return "subscribed";
        } else {
            $this->db->insert('users_subscriptions', $post_data);
            return 'success';
        }
    }

    /* Above function ends here */

    /*
     *  Function to user's profile data in database
     */

    public function save_user_profile($user_data)
    {
        $user_id = $user_data['user_id'];
        $updated_user_data = array(
            'name' => $user_data['name'],
        );

        $this->db->where('id', $user_id);
        $this->db->update('users', $updated_user_data);

        $updated_user_profile_data = array(
            'age' => $user_data['age'],
            'phone' => $user_data['phone'],
            'city' => $user_data['city'],
        );

        $this->db->where('user_id', $user_id);
        $this->db->update('user_details', $updated_user_profile_data);
        return true;
    }

    /* Above function ends here */

    public function upload_user_image($image_data, $user_id, $user_data)
    {
        $path = $this->config->item('user_profile_image_path');
        $files = $image_data;
        $img_name = $files['image']['name'];

        $image_temp_name = $files['image']['tmp_name'];

        $count = count($files);
        if ($count > 0) {
            $new_path = $path . $user_id . "/";
            unlink($new_path . $user_data->image);
            if (!is_dir($path . $user_id . '/')) {
                mkdir($path . $user_id . '/', 0777, TRUE);
            }

            if (copy($image_temp_name, $new_path . $img_name)) {
                $updated_user_profile_data = array(
                    'image' => $img_name,
                );

                $this->db->where('user_id', $user_id);
                $this->db->update('user_details', $updated_user_profile_data);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /* Above function ends here */

    /*added on 6th june*/
    public function check_user_exist($profileid)
    {
        $q = $this->db->query('select profileid from social_login_users where profileid="' . $profileid . '"');
        $set = $q->result();
        if (!empty($set)) {
            return $set[0];
        } else {
            return $set;
        }

    }

    public function check_useremail_exist($emailid)
    {
        $q = $this->db->query('select * from users where username="' . $emailid . '"');
        $set = $q->result();
        if (!empty($set)) {
            return $set[0];
        } else {
            return $set;
        }

    }

    public function insert_user_social_login($data)
    {

        $this->db->insert('users', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function insert_user_profileid($data)
    {

        $this->db->insert('social_login_users', $data);
        return true;
    }

    public function insert_user_socail_logindetails($data)
    {

        $this->db->insert('user_details', $data);
        return true;
    }


    public function get_user_logindetails($profileid)
    {

        $this->db->select('users.*,user_details.*');
        $this->db->from('users');
        $this->db->join('user_details', 'user_details.user_id = users.id');
        $this->db->join('social_login_users', 'social_login_users.userid = users.id');
        $this->db->where('social_login_users.profileid', $profileid);
        $query = $this->db->get();
        $query_result = $query->result();
        if (!empty($query_result)) {
            return $query_result[0];
        } else {
            return $query_result;
        }

    }


    public function get_user_logindetails_byid($userid)
    {

        $this->db->select('users.*,user_details.*');
        $this->db->from('users');
        $this->db->join('user_details', 'user_details.user_id = users.id');
        $this->db->join('social_login_users', 'social_login_users.userid = users.id');
        $this->db->where('users.id', $userid);
        $query = $this->db->get();
        $query_result = $query->result();
        if (!empty($query_result)) {
            return $query_result[0];
        } else {
            return $query_result;
        }

    }

    /*created after 8th may*/

    public function update_first_logged($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function getbasicDetails($id)
    {
        $this->db->select('user_details.age,user_details.gender,user_details.user_id,users.name,users.username,user_details.weight,user_details.height,user_details.body_type,user_details.bmi');
        $this->db->where('user_id', $id);
        $this->db->from('user_details');
        $this->db->join('users', 'users.id = user_details.user_id', 'left');
        $q = $this->db->get();

        return $q->result();
    }

    public function update_age($age, $weight, $id, $gender)
    {
        $this->db->where('user_id', $id);
        $this->db->update('user_details', array('age' => $age, 'weight' => $weight, 'gender' => $gender));
    }

    public function add_basic_info($data, $bmi, $id)
    {

        $this->db->insert('survey_bmi', $data);
        $this->db->select('user_input');
        $this->db->where('bmi_from <=', $bmi);
        $this->db->where('bmi_to >=', $bmi);
        $this->db->from('survey_bmi_inputs');
        $q = $this->db->get();
        $row = $q->result();
        $row = $row[0];
        return $row->user_input;
    }

    public function getSurvey()
    {
        /*$this->db->select('id');
        $this->db->from('survey_categories');
        $c = $this->db->get();

        foreach($c->result() as $k)
        {
            $this->db->select('id as q_id,cat_id,question');
            $this->db->from('survey_cat_ques');
            $this->db->where('cat_id',$k->id);
            $q = $this->db->get();

            $this->db->select('option,id as option_id');
            $this->db->from('survey_cat_ques_options');
            $o = $this->db->get();

            $k->options = $o->result();
            $k->questions = $q->result();
        }*/

        $this->db->select('q.id as q_id,q.cat_id,q.question,c.category,q.q_no,c.slug');
        $this->db->from('survey_cat_ques q');
        $this->db->join('survey_categories c', 'c.id = q.cat_id', 'left');
        $q = $this->db->get();

        foreach ($q->result() as $k) {
            $this->db->select('count(id) as total');
            $this->db->from('survey_cat_ques');
            $this->db->where('cat_id', $k->cat_id);
            $g = $this->db->get();
            $t = $g->result();
            $tot = $t[0]->total;

            $this->db->select('option,id as option_id');
            $this->db->from('survey_cat_ques_options');
            $o = $this->db->get();

            $k->options = $o->result();
            $k->group = $tot;

        }

        return $q->result();
    }

    public function getSurveyfromques($id)
    {
        if ($id == 1) {
            $id = 0;
        }
        $this->db->select('q.id as q_id,cat_id,q.question,c.category,q.q_no,c.slug');
        $this->db->from('survey_cat_ques q');
        $this->db->limit(10000, $id);
        $this->db->join('survey_categories c', 'c.id = q.cat_id', 'left');
        $q = $this->db->get();

        foreach ($q->result() as $k) {
            $this->db->select('count(id) as total');
            $this->db->from('survey_cat_ques');
            $this->db->where('cat_id', $k->cat_id);
            $g = $this->db->get();
            $t = $g->result();
            $tot = $t[0]->total;

            $this->db->select('option,id as option_id');
            $this->db->from('survey_cat_ques_options');
            $o = $this->db->get();
            $k->options = $o->result();
            $k->group = $tot;
        }

        return $q->result();
    }

    public function addSurveyUser($q, $o, $u, $data)
    {
        $this->db->select('*');
        $this->db->from('survey_cat_user_options');
        $this->db->where('ques_id', $q);
        $this->db->where('survey_page_visitor_id', $u);
        $qqs = $this->db->get();
        if ($qqs->num_rows() == 0) {
            $this->db->insert('survey_cat_user_options', $data);
        } else {
            $this->db->where('ques_id', $q);
            $this->db->where('survey_page_visitor_id', $u);
            $this->db->update('survey_cat_user_options', array('option_id' => $o));
        }
    }

    public function addtempSurveyUser($q, $o, $u, $data)
    {
        $this->db->select('*');
        $this->db->from('survey_cat_user_options');
        $this->db->where('ques_id', $q);
        $this->db->where('survey_page_visitor_id', $u);
        $qqs = $this->db->get();
        if ($qqs->num_rows() == 0) {
            $this->db->insert('survey_cat_user_options', $data);
        } else {
            $this->db->where('ques_id', $q);
            $this->db->where('survey_page_visitor_id', $u);
            $this->db->update('survey_cat_user_options', array('option_id' => $o));
        }
    }

    public function addFirstuser($ip, $t, $userid)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $userid);
        $q = $this->db->get();
        $r = $q->result();
        if ($q->num_rows() > 0) {
            return $r[0]->id;

        } else {
            $data = array('ip_address' => $ip, 'temp_cookie_id' => $t, 'user_id' => $userid);
            $this->db->insert('survey_page_visitors', $data);
            return $this->db->insert_id();
        }


    }

    public function addFirstuser2($ip, $t, $userid)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $userid);
        $this->db->order_by('added_on', 'desc');
        $q = $this->db->get();
        $r = $q->result();
        if ($q->num_rows() > 0) {
            $data = array('ip_address' => $ip, 'temp_cookie_id' => $t);
            $this->db->where('id', $r[0]->id);
            $this->db->update('survey_page_visitors', $data);
            return $r[0]->id;

        } else {
            $data = array('ip_address' => $ip, 'temp_cookie_id' => $t, 'user_id' => $userid);
            $this->db->insert('survey_page_visitors', $data);
            return $this->db->insert_id();
        }


    }

    public function updateaddFirstuser($survey_page, $temp_id)
    {
        $this->db->where('id', $survey_page);
        $this->db->update('survey_page_visitors', array('temp_cookie_id' => $temp_id));
    }

    public function addnonuseriduser($ip, $t)
    {

        $data = array('ip_address' => $ip, 'temp_cookie_id' => $t, 'temp_address' => $t);
        $this->db->insert('survey_page_visitors', $data);
        return $this->db->insert_id();


    }

    public function get_page_visitor_id($t)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $t);
        $q = $this->db->get();
        $r = $q->result();
        return $r[0]->id;
    }

    public function get_user_id($temp_id)
    {
        $this->db->select('user_id,id');
        $this->db->from('survey_page_visitors');
        $this->db->where('temp_cookie_id', $temp_id);
        $q = $this->db->get();
        $r = $q->result();
        return $r[0]->user_id;
    }

    public function get_page_id($temp_id)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('temp_cookie_id', $temp_id);
        $q = $this->db->get();
        $r = $q->result();
        return $r[0]->id;
    }

    public function get_page_idadd($temp_id)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('temp_address', $temp_id);
        $q = $this->db->get();
        $r = $q->result();
        return $r[0]->id;
    }

    public function checkUserAttempted($userid)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $userid);
        $this->db->order_by('added_on', 'desc');
        $q = $this->db->get();
        $r = $q->result();
        //echo $r[0]->id; exit();
        if (isset($r[0]->id)) {
            $pid = $r[0]->id;

            $this->db->select('ques_id');
            $this->db->from('survey_cat_user_options');
            $this->db->where('userid', $userid);
            $this->db->where('survey_page_visitor_id', $pid);
            $this->db->order_by('ques_id', 'desc');
            $qs = $this->db->get();
            $r = $qs->result();

            if ($qs->num_rows() > 0 && $qs->num_rows() < 80) {

                return $r[0]->ques_id;
            } else if ($qs->num_rows() == 0) {
                $id = 1;
                return $id;
            } else {
                return false;
            }
        } else {
            return 'new';
        }
    }

    public function checkUserAttemptedhome($userid)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $userid);
        $this->db->order_by('added_on', 'desc');
        $q = $this->db->get();
        $r = $q->result();
        //echo $r[0]->id; exit();
        if ($r[0]->id) {
            $pid = $r[0]->id;

            $this->db->select('ques_id');
            $this->db->from('survey_cat_user_options');
            $this->db->where('userid', $userid);
            $this->db->where('survey_page_visitor_id', $pid);
            $this->db->order_by('ques_id', 'desc');
            $qs = $this->db->get();
            $r = $qs->result();

            if ($qs->num_rows() > 0 && $qs->num_rows() < 80) {

                return $r[0]->ques_id;
            } else if ($qs->num_rows() == 0) {
                $id = 1;
                return $id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkUserAttempted2($userid, $page_id)
    {
        $this->db->select('ques_id');
        $this->db->from('survey_cat_user_options');
        $this->db->where('userid', $userid);
        $this->db->where('survey_page_visitor_id', $page_id);
        $this->db->order_by('ques_id', 'desc');
        $q = $this->db->get();
        $r = $q->result();
        if ($q->num_rows() > 0) {
            return $r[0]->ques_id;
        } else {
            return false;
        }
    }

    public function checkUserpageAttempted($pageid)
    {
        $this->db->select('ques_id');
        $this->db->from('survey_cat_user_options');
        $this->db->where('survey_page_visitor_id', $pageid);
        $this->db->order_by('ques_id', 'desc');
        $q = $this->db->get();
        $r = $q->result();
        if ($q->num_rows() > 0) {
            return $r[0]->ques_id;
        } else {
            return false;
        }
    }

    public function getSurveyReport($type, $id)
    {
        $resu = array();
        $this->db->select('sum(o.option_value) as total');
        $this->db->where('q.cat_id', $type);
        $this->db->where('u.survey_page_visitor_id', $id);
        $this->db->from('survey_cat_user_options u');
        $this->db->join('survey_cat_ques q', 'u.ques_id = q.id', 'left');
        $this->db->join('survey_cat_ques_options o', 'u.option_id = o.id', 'left');
        $s = $this->db->get();

        $r = $s->result();
        $t = $r[0]->total;
        array_push($resu, $t);

        if ($t == NULL) {
            $t = 0;
        }

        $this->db->select('report');
        $this->db->where('min_score <=', $t);
        $this->db->where('cat_id', $type);
        $this->db->where('max_score >=', $t);
        $this->db->from('survey_reports');
        $report = $this->db->get();
        $rs = $report->result();

        array_push($resu, $rs[0]->report);
        return $resu;
    }

    public function getAllSurveyReport($id)
    {
        $this->db->select('id as vi_id');
        $this->db->where('temp_cookie_id', $id);
        $this->db->from('survey_page_visitors');
        $visitor_id = $this->db->get();
        $id = $visitor_id->result();

        $this->db->select('id,category');
        $this->db->from('survey_categories');
        $cat = $this->db->get();

        foreach ($cat->result() as $c) {
            $this->db->select('sum(o.option_value) as total');
            $this->db->where('q.cat_id', $c->id);
            $this->db->where('u.survey_page_visitor_id', $id[0]->vi_id);
            $this->db->from('survey_cat_user_options u');
            $this->db->join('survey_cat_ques q', 'u.ques_id = q.id', 'left');
            $this->db->join('survey_cat_ques_options o', 'u.option_id = o.id', 'left');
            $s = $this->db->get();
            $r = $s->result();
            $t = $r[0]->total;
            $c->score = $t;
            if ($t) {
                $this->db->select('report');
                $this->db->where('min_score <=', $t);
                $this->db->where('cat_id', $c->id);
                $this->db->where('max_score >=', $t);
                $this->db->from('survey_reports');
                $report = $this->db->get();
                $rs = $report->result();
                $c->report = $rs[0]->report;
            } else {
                $c->report = '';
            }
        }
        return $cat->result();

    }

    public function deleteSurvey($id)
    {
        $this->db->select('user_id');
        $this->db->where('temp_cookie_id', $id);
        $this->db->from('survey_page_visitors');
        $visitor_id = $this->db->get();
        $pid2 = $visitor_id->result();
        $pid = $pid2[0]->vi_id;

        $this->db->where('temp_cookie_id', $id);

        $this->db->where('temp_cookie_id', $id);
        $this->db->delete('survey_page_visitors');

        $this->db->where('userid', $pid);
        $this->db->delete('survey_cat_user_options');
    }


    public function update_reset_pwd($email, $reset_password_token_data)
    {
        $this->db->where('username', $email);
        $this->db->update('users', $reset_password_token_data);

    }

    public function getAllUserSurveyReport($id, $pageid = NULL)
    {

        $this->db->select('id,bmi');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $id);
        $this->db->where('id', $pageid);
        $this->db->order_by('added_on', 'desc');
        $q = $this->db->get();
        $q = $q->result();


        $today = date('Y-m-d');
        $this->db->select('sum(option_id) as total');
        $this->db->where('userid', $id);
        $this->db->where('survey_page_visitor_id', $pageid);
        $this->db->from('survey_cat_user_options');
        $grand = $this->db->get();
        $grandt = $grand->result();
        $gtot = $grandt[0]->total;
        if ($gtot) {
            $this->db->select('id,category');
            $this->db->from('survey_categories');
            $cat = $this->db->get();

            foreach ($cat->result() as $c) {

                $this->db->select('user_input,category');
                $this->db->from('survey_bmi_inputs');
                $this->db->where('bmi_from <=', $q[0]->bmi);
                $this->db->where('bmi_to >=', $q[0]->bmi);
                $report = $this->db->get();
                $bmi = $report->result();
                $c->bmi_report = $bmi[0]->user_input;
                $c->bmi_cat = $bmi[0]->category;
                $c->bmi_value = $q[0]->bmi;

                $this->db->select('sum(o.option_value) as total');
                $this->db->where('q.cat_id', $c->id);
                $this->db->where('u.userid', $id);
                $this->db->from('survey_cat_user_options u');
                $this->db->where('u.survey_page_visitor_id', $pageid);
                $this->db->join('survey_cat_ques q', 'u.ques_id = q.id', 'left');
                $this->db->join('survey_cat_ques_options o', 'u.option_id = o.id', 'left');
                $s = $this->db->get();
                $r = $s->result();
                $t = $r[0]->total;
                $c->score = $t;
                if ($t) {

                } else {
                    $t = 0;
                }
                if ($t) {
                    $this->db->select('report');
                    $this->db->where('min_score <=', $t);
                    $this->db->where('cat_id', $c->id);
                    $this->db->where('max_score >=', $t);
                    $this->db->from('survey_reports');
                    $report = $this->db->get();
                    $rs = $report->result();
                    $c->report = $rs[0]->report;
                } else {
                    $c->report = '';
                }
                $c->grand_total = $gtot;
            }
            //echo '<pre>'; print_r($cat->result());
            return $cat->result();
        }
    }

    public function getAllUserSurveyReportdown($id)
    {
        $this->db->select('sum(option_id) as total');
        $this->db->where('survey_page_visitor_id', $id);
        $this->db->from('survey_cat_user_options');
        $grand = $this->db->get();
        $grandt = $grand->result();
        $gtot = $grandt[0]->total;
        if ($gtot) {
            $this->db->select('id,category,description');
            $this->db->from('survey_categories');
            $cat = $this->db->get();

            foreach ($cat->result() as $c) {
                $this->db->select('sum(o.option_value) as total');
                $this->db->where('q.cat_id', $c->id);
                $this->db->from('survey_cat_user_options u');
                $this->db->where('u.survey_page_visitor_id', $id);
                $this->db->join('survey_cat_ques q', 'u.ques_id = q.id', 'left');
                $this->db->join('survey_cat_ques_options o', 'u.option_id = o.id', 'left');
                $s = $this->db->get();
                $r = $s->result();
                $t = $r[0]->total;
                $c->score = $t;
                if ($t) {

                } else {
                    $t = 0;
                }
                if ($t) {
                    $this->db->select('report');
                    $this->db->where('min_score <=', $t);
                    $this->db->where('cat_id', $c->id);
                    $this->db->where('max_score >=', $t);
                    $this->db->from('survey_reports');
                    $report = $this->db->get();
                    $rs = $report->result();
                    $c->report = $rs[0]->report;
                } else {
                    $c->report = '';
                }
                $c->grand_total = $gtot;
            }
            return $cat->result();
        }
    }

    public function getUserAllSurveyReport($id)
    {

        $this->db->select('id,added_on,promo_code_valid');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $id);
        $q = $this->db->get();

        foreach ($q->result() as $res) {
            $this->db->select('id');
            $this->db->from('survey_cat_user_options');
            $this->db->where('userid', $id);
            $this->db->where('survey_page_visitor_id', $res->id);
            $count = $this->db->get();
            $c = $count->result();

            if ($res->promo_code_valid == '1' || $res->promo_code_valid == 1) {
                if (count($c) >= 80) {
                    $this->db->select('sum(option_id) as total');
                    $this->db->from('survey_cat_user_options');
                    $this->db->where('userid', $id);
                    $this->db->where('survey_page_visitor_id', $res->id);

                    $grand = $this->db->get();
                    $grandt = $grand->result();
                    $gtot = $grandt[0]->total;
                    if ($gtot) {
                        $this->db->select('id,category');
                        $this->db->from('survey_categories');
                        $cat = $this->db->get();

                        foreach ($cat->result() as $c) {
                            $this->db->select('sum(o.option_value) as total');
                            $this->db->where('q.cat_id', $c->id);
                            $this->db->where('u.userid', $id);
                            $this->db->from('survey_cat_user_options u');
                            $this->db->where('u.survey_page_visitor_id', $res->id);
                            $this->db->join('survey_cat_ques q', 'u.ques_id = q.id', 'left');
                            $this->db->join('survey_cat_ques_options o', 'u.option_id = o.id', 'left');
                            $s = $this->db->get();
                            $r = $s->result();
                            $t = $r[0]->total;
                            $c->score = $t;
                            if ($t) {

                            } else {
                                $t = 0;
                            }
                            if ($t) {
                                $this->db->select('report');
                                $this->db->where('min_score <=', $t);
                                $this->db->where('cat_id', $c->id);
                                $this->db->where('max_score >=', $t);
                                $this->db->from('survey_reports');
                                $report = $this->db->get();
                                $rs = $report->result();
                                $c->report = $rs[0]->report;
                            } else {
                                $c->report = '';
                            }
                            $c->grand_total = $gtot;
                        }
                        $res->reports = $cat->result();
                    }

                } else {
                    $res->reports = 0;
                    $res->promo = 1;
                }
            } else if (($res->promo_code_valid == '0' || $res->promo_code_valid == 0) && (count($c) >= 80)) {
                $res->reports = 0;
                $res->promo = 0;
            } else {
                $res->reports = 0;
                $res->promo = 1;
            }
        }
        return $q->result();
    }

    public function get_logged_page($id)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $id);
        $this->db->order_by('added_on', 'desc');
        $q = $this->db->get();
        $q = $q->result();
        return $q[0]->id;
    }

    public function check_survey_taken($userid)
    {
        $this->db->select('*');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $userid);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkpromothere($id)
    {
        $this->db->select('promo_code_valid');
        $this->db->from('survey_page_visitors');
        $this->db->where('id', $id);
        $q = $this->db->get();
        $q = $q->result();
        if ($q[0]->promo_code_valid == 1 || $q[0]->promo_code_valid == '1') {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUserSurvey($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('survey_page_visitors');

        $this->db->where('userid', $id);
        $this->db->delete('survey_cat_user_options');
    }

    public function checkChatSchedule($id)
    {
        $today = date('Y-m-d');
        $this->db->select('s.id,sb.date,sb.time_from,sb.time_to,s.video_link,cp.book_type');
        $this->db->from('user_sme_book_call s');
        $this->db->join('sme_book_slots sb', 'sb.id = s.smebookcallid', 'left');
        $this->db->join('user_chat_pay_trans cp', 'cp.order_id = s.order_id', 'left');
        $this->db->where('s.userid', $id);
        $this->db->where('sb.status =', 'blocked');
        $this->db->where('sb.date', $today);
        $q = $this->db->get();

        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    public function update_session_link($id, $link)
    {
        $this->db->select('video_link');
        $this->db->where('id', $id);
        $this->db->from('user_sme_book_call');
        $q = $this->db->get();
        $r = $q->result();
        if ($r[0]->video_link == '') {
            $this->db->where('id', $id);
            $this->db->update('user_sme_book_call', array('video_link' => $link));

        } else {
            $link = $r[0]->video_link;
        }

        return $link;
    }

    public function getBmiReport($id)
    {
        $this->db->select('bmi');
        $this->db->from('survey_page_visitors');
        $this->db->where('id', $id);
        $q = $this->db->get();
        $q = $q->result();

        $this->db->select('user_input,category');
        $this->db->from('survey_bmi_inputs');
        $this->db->where('bmi_from <=', $q[0]->bmi);
        $this->db->where('bmi_to >=', $q[0]->bmi);
        $report = $this->db->get();
        $bmi = $report->result();
        return $bmi;


    }

    public function getBmiReportin($id)
    {
        $this->db->select('bmi');
        $this->db->from('survey_page_visitors');
        $this->db->where('id', $id);
        $q = $this->db->get();
        $q = $q->result();

        return $q[0]->bmi;
    }

    public function saveSurveygraph($id, $graph)
    {
        $this->db->where('user_id', $id);
        $this->db->update('user_details', array('graph' => $graph));
    }

    public function getSurveyImg($id)
    {
        $this->db->select('graph');
        $this->db->where('user_id', $id);
        $this->db->from('user_details');
        $r = $this->db->get();
        $ro = $r->result();
        return $ro[0]->graph;
    }

    public function resetdata($id)
    {
        $this->db->where('user_id', $id);
        $this->db->update('user_details', array('bmi' => '', 'height' => '', 'weight' => '', 'graph' => ''));
    }

    public function getmaxsurvey($userid, $pageid = NULL)
    {
        $this->db->select('o.*,c.wellness_element,c.weightage_rank,c.cat_id');
        $this->db->from('survey_cat_user_options o');
        $this->db->join('survey_cat_ques c', 'c.id = o.ques_id', 'left');
        $this->db->where('o.userid', $userid);
        $this->db->where('o.survey_page_visitor_id', $pageid);
        $this->db->where('o.option_id', 3);
        $this->db->or_where('o.option_id', 4);
        $this->db->where('o.survey_page_visitor_id', $pageid);
        $this->db->order_by('o.option_id', 'desc');
        $this->db->order_by('c.weightage_rank', 'asc');
        $this->db->limit(10);
        $c = $this->db->get();
        return $c->result();
    }

    public function gettempmaxsurvey($tempid)
    {

        $this->db->select('o.*,c.wellness_element,c.weightage_rank,c.cat_id');
        $this->db->from('survey_cat_user_options o');
        $this->db->join('survey_cat_ques c', 'c.id = o.ques_id', 'left');
        $this->db->where('o.survey_page_visitor_id', $tempid);
        $this->db->where('o.option_id', 3);
        $this->db->or_where('o.option_id', 4);
        $this->db->where('o.survey_page_visitor_id', $tempid);
        $this->db->order_by('o.option_id', 'desc');
        $this->db->order_by('c.weightage_rank', 'asc');
        $this->db->limit(10);
        $c = $this->db->get();
        return $c->result();
    }

    public function getminsurvey($userid, $pageid = NULL)
    {
        $this->db->select('o.*,c.wellness_element,c.weightage_rank,c.cat_id');
        $this->db->from('survey_cat_user_options o');
        $this->db->join('survey_cat_ques c', 'c.id = o.ques_id', 'left');
        $this->db->where('o.userid', $userid);
        $this->db->where('o.survey_page_visitor_id', $pageid);
        $this->db->where('o.option_id', 1);
        $this->db->or_where('o.option_id', 2);
        $this->db->where('o.survey_page_visitor_id', $pageid);
        $this->db->order_by('o.option_id', 'asc');
        $this->db->order_by('c.weightage_rank', 'desc');
        $this->db->limit(10);
        $c = $this->db->get();
        return $c->result();
    }

    public function gettempminsurvey($tempid)
    {
        $this->db->select('o.*,c.wellness_element,c.weightage_rank,c.cat_id');
        $this->db->from('survey_cat_user_options o');
        $this->db->join('survey_cat_ques c', 'c.id = o.ques_id', 'left');
        $this->db->where('o.survey_page_visitor_id', $tempid);
        $this->db->where('o.option_id', 1);
        $this->db->or_where('o.option_id', 2);
        $this->db->where('o.survey_page_visitor_id', $tempid);
        $this->db->order_by('o.option_id', 'asc');
        $this->db->order_by('c.weightage_rank', 'desc');
        $this->db->limit(10);
        $c = $this->db->get();
        return $c->result();
    }

    public function getMaxs($id)
    {
        $total = array();
        $this->db->select('organization');
        $this->db->from('user_details');
        $this->db->where('user_id', $id);
        $r = $this->db->get();
        $ro = $r->result();
        $org = $ro[0]->organization;

        $this->db->select('u.user_id,v.id');
        $this->db->from('user_details u');
        $this->db->join('survey_page_visitors v', 'u.user_id = v.user_id');
        $this->db->like('organization', $org, 'both');
        $u = $this->db->get();
        foreach ($u->result() as $us) {
            $this->db->select('sum(option_id) as total');
            $this->db->where('survey_page_visitor_id', $us->id);
            $this->db->where('userid !=', $id);
            $this->db->from('survey_cat_user_options');
            $grand = $this->db->get();
            //echo '<pre>'; print_r($grand->result());
            //$grandt = max($grand->result());
            $gr = $grand->result();
            $gra = $gr[0]->total;
            array_push($total, $gra);
        }
        //echo '<pre>';
        //print_r($total);
        return max($total);
    }

    public function getservices()
    {
        $this->db->select('*');
        $this->db->from('business_details');
        $this->db->limit(3);

        $c = $this->db->get();
        return $c->result();
    }

    public function getsme()
    {
        $this->db->select('*');
        $this->db->from('sme_user_profiles');
        $this->db->limit(3);

        $c = $this->db->get();
        return $c->result();
    }

    public function getSdet($id)
    {
        $this->db->select('d.*,u.name,u.username');
        $this->db->from('user_details d');
        $this->db->join('users u', 'u.id = d.user_id', 'left');
        $this->db->where('u.id', $id);
        $c = $this->db->get();
        $c = $c->result();
        return $c[0];
    }

    public function update_usersurveydetails($data, $id)
    {
        $this->db->where('user_id', $id);
        $this->db->update('user_details', $data);
    }

    public function get_username_availability($email)
    {
        $this->db->select('id');
        $this->db->from('users');
        $this->db->where('username', $email);
        $c = $this->db->get();
        $c = $c->result();
        return $c[0]->id;
    }

    public function add_page_visitor($temp, $temp_address)
    {
        $this->db->select('*');
        $this->db->from('survey_page_visitors');
        $this->db->where('temp_address', $temp_address);
        $res = $this->db->get();
        if ($res->num_rows() == 0) {
            $this->db->insert('survey_page_visitors', $temp);
            $id = $this->db->insert_id();
            return $id;
        }
    }

    public function add_page_visitornew($temp)
    {
        $this->db->insert('survey_page_visitors', $temp);
        $id = $this->db->insert_id();
        return $id;
    }

    public function get_add_page_visitor($temp_address)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('temp_address', $temp_address);
        $res = $this->db->get();
        $r = $res->result();
        return $r[0]->id;
    }

    public function update_survey_userid($page_visitor_id, $userid, $bmi = NULL)
    {
        $this->db->where('survey_page_visitor_id', $page_visitor_id);
        $this->db->update('survey_cat_user_options', array('userid' => $userid));

        $this->db->where('id', $page_visitor_id);
        $this->db->update('survey_page_visitors', array('user_id' => $userid, 'bmi' => $bmi));
    }

    public function checkvalidpromoCode($code)
    {
        $this->db->select('id');
        $this->db->from('user_wellness_promo_code');
        $this->db->where('code', $code);
        $this->db->where('used', 'n');
        $r = $this->db->get();
        if ($r->num_rows() > 0) {
            if ($code == 'zingupbeta') {
                $this->db->where('code', $code);
                $this->db->update('user_wellness_promo_code', array('used' => 'n'));
            } else if ($code == 'ZINGUPBETA') {
                $this->db->where('code', $code);
                $this->db->update('user_wellness_promo_code', array('used' => 'n'));
            } else {
                $this->db->where('code', $code);
                $this->db->update('user_wellness_promo_code', array('used' => 'y'));
            }

            return true;
        } else {
            return false;
        }
    }

    public function updatePromostatus($code)
    {
        if ($code == 'zingupbeta') {
            $this->db->where('code', $code);
            $this->db->update('user_wellness_promo_code', array('used' => 'n'));
        } else if ($code == 'ZINGUPBETA') {
            $this->db->where('code', $code);
            $this->db->update('user_wellness_promo_code', array('used' => 'n'));
        } else {
            $this->db->where('code', $code);
            $this->db->update('user_wellness_promo_code', array('used' => 'y'));
        }

    }

    public function updatepromo($promo, $userid)
    {
        $this->db->where('user_id', $userid);
        $this->db->update('survey_page_visitors', array('promo_code_valid' => $promo));
    }

    public function checkPromovalidornot($userid = NULL, $pageid = NULL)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('promo_code_valid', '1');
        $this->db->where('id', $pageid);
        $this->db->where('user_id', $userid);
        $r = $this->db->get();
        if ($r->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkPromovalidornot2($pageid)
    {
        $this->db->select('promo_code_valid');
        $this->db->from('survey_page_visitors');
        $this->db->where('id', $pageid);
        $r = $this->db->get();
        $rs = $r->result();
        return $rs[0]->promo_code_valid;

    }

    public function checkSurveytaken($userid)
    {
        $this->db->select('id');
        $this->db->from('survey_cat_user_options');
        $this->db->where('userid', $userid);
        $r = $this->db->get();
        if ($r->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function add_page_visitoruserid($userid)
    {
        $this->db->insert('survey_page_visitors', array('user_id' => $userid));
        $id = $this->db->insert_id();
        return $id;
    }

    public function insertSurveyUser($data)
    {
        $this->db->insert('survey_page_visitors', $data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function updatePromo2($vistid, $val)
    {
        $this->db->where('id', $vistid);
        $this->db->update('survey_page_visitors', array('promo_code_valid' => $val));
    }

    public function getloggedvisitorid($userid)
    {
        $today = date('Y-m-d');
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $userid);
        $this->db->where('DATE(added_on)', $today);
        $res = $this->db->get();
        $r = $res->result();
        return $r[0]->id;
    }

    public function checksurveydate($userid)
    {
        $today = date('Y-m-d');
        $this->db->select('DATE(added_on) as date');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $userid);
        $this->db->order_by('DATE', 'desc');
        $res = $this->db->get();

        if ($res->num_rows() > 0) {

            $r = $res->result();
            $r[0]->date;
            $your_date = strtotime($r[0]->date);
            $datediff = $today - $your_date;

            $days = round(abs(strtotime($today) - $your_date) / 86400);
            if ($days >= 7) {

                return true;
            } else if ($days == 0) {

                return false;
            } else {

                return false;
            }
        } else {

            return true;
        }
    }

    public function checksurveydate2($userid)
    {
        $today = date('Y-m-d');
        $this->db->select('DATE(added_on) as date');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $userid);
        $this->db->order_by('DATE', 'desc');
        $res = $this->db->get();

        if ($res->num_rows() > 0) {
            $r = $res->result();
            $r[0]->date;
            $your_date = strtotime($r[0]->date);
            $datediff = $today - $your_date;

            $days = round(abs(strtotime($today) - $your_date) / 86400);
            if ($days >= 7) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function unspromocode($code)
    {

        $this->db->where('code', $code);
        $this->db->update('user_wellness_promo_code', array('used' => 'n'));
    }

    public function page_id($temp_id)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('temp_address', $temp_id);
        $r = $this->db->get();
        $ro = $r->result();
        return $ro[0]->id;
    }

    public function update_userfortemp($tempid, $userid, $bmi = NULL)
    {
        $this->db->where('temp_address', $tempid);
        $this->db->update('survey_page_visitors', array('user_id' => $userid, 'promo_code_valid' => 1, 'bmi' => $bmi));

        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('temp_address', $tempid);
        $r = $this->db->get();
        $ro = $r->result();
        $id = $ro[0]->id;

        $this->db->where('survey_page_visitor_id', $id);
        $this->db->update('survey_cat_user_options', array('userid' => $userid));

    }

    public function addusercookie($cookie, $userid, $bmi, $id)
    {
        $this->db->where('temp_cookie_id', $cookie);
        $this->db->update('survey_page_visitors', array('user_id' => $userid, 'bmi' => $bmi));

        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('temp_cookie_id', $cookie);
        $r = $this->db->get();
        $ro = $r->result();
        $id = $ro[0]->id;

        $this->db->where('survey_page_visitor_id', $id);
        $this->db->update('survey_cat_user_options', array('userid' => $userid));
    }

    public function insertCode($code)
    {
        $this->db->insert('user_wellness_promo_code', array('corporate' => 'Zinguplife', 'code' => $code, 'used' => 'n'));
    }

    public function getPage($id)
    {
        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $id);
        $this->db->order_by('added_on', 'desc');
        $r = $this->db->get();
        $ro = $r->result();
        return $ro[0]->id;
    }

    public function Updatenewcookie($new_temp_id, $temp_id)
    {
        $this->db->where('temp_cookie_id', $temp_id);
        $this->db->update('survey_page_visitors', array('temp_cookie_id' => $new_temp_id));

        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('temp_cookie_id', $new_temp_id);
        $r = $this->db->get();
        $ro = $r->result();
        return $ro[0]->id;
    }

    public function getUserId($id)
    {
        $this->db->select('user_id');
        $this->db->from('survey_page_visitors');
        $this->db->where('id', $id);
        $r = $this->db->get();
        $ro = $r->result();
        return $ro[0]->user_id;

    }

    public function getSurveyStartDate($pageid)
    {
        $this->db->select('added_on as start_date');
        $this->db->from('survey_page_visitors');
        $this->db->where('id', $pageid);
        $r = $this->db->get();
        $ro = $r->result();
        return $ro[0]->start_date;

    }

    public function addSurveyComp($survey_comp)
    {
        $this->db->insert('user_survey_history', $survey_comp);
        return true;
    }

    public function getSurveryCompletedDate($id)
    {
        $this->db->select('DATE_FORMAT(survey_end_date, "%d/%m/%Y") as end_date');
        $this->db->from('user_survey_history');
        $this->db->where('user_id', $id);
        $c = $this->db->get();
        $c = $c->result();
        return $c[0];
    }

    public function get_user_details($id)
    {
        $this->db->select('*');
        $this->db->from('user_details');
        $this->db->where('user_id', $id);
        $c = $this->db->get();
        $c = $c->result();
        return $c[0];
    }

    public function get_lastsurvey_details($id)
    {
        $this->db->select('id,category');
        $this->db->from('survey_categories');
        $this->db->limit(4);
        $cat = $this->db->get();

        $this->db->select('id');
        $this->db->from('survey_page_visitors');
        $this->db->where('user_id', $id);
        $this->db->order_by('added_on', 'desc');
        $su = $this->db->get();
        $su = $su->result();
        $sid = $su[0]->id;

        foreach ($cat->result() as $c) {
            $this->db->select('sum(o.option_value) as total');
            $this->db->where('q.cat_id', $c->id);
            $this->db->where('u.survey_page_visitor_id', $sid);
            $this->db->from('survey_cat_user_options u');
            $this->db->join('survey_cat_ques q', 'u.ques_id = q.id', 'left');
            $this->db->join('survey_cat_ques_options o', 'u.option_id = o.id', 'left');
            $s = $this->db->get();
            $r = $s->result();
            $t = $r[0]->total;
            $c->score = $t;
            if ($t) {
                $this->db->select('report');
                $this->db->where('min_score <=', $t);
                $this->db->where('cat_id', $c->id);
                $this->db->where('max_score >=', $t);
                $this->db->from('survey_reports');
                $report = $this->db->get();
                $rs = $report->result();
                $c->report = $rs[0]->report;
            } else {
                $c->report = '';
            }
        }
        return $cat->result();
    }

    public function UpdateAssessmentUserId($username)
    {
        $user_details = self::get_user_details_by_username($username);
        $session_id = session_id();
        $updated_user_data = array(
            'user_id' => $user_details->user_id,
            'session_id' => '',
        );
        $this->db->where('session_id', $session_id);
        $this->db->update('zul_user_themes', $updated_user_data);
        return $user_details->user_id;
    }

    public function GetUserThemesByUserId($user_id)
    {
        $this->db->select('theme_id,test_id');
        $this->db->where('user_id', $user_id);
        $this->db->from('zul_user_themes');
        $results = $this->db->get();
        $user_theme_details = $results->result();
        return $user_theme_details;
    }

    public function GetUserPercentage($user_id, $theme_id, $test_id)
    {
        $this->db->select('marks_scored,DATE(test_end_date) as test_end_date');
        $this->db->where('user_id', $user_id);
        $this->db->where('theme_id', $theme_id);
        $this->db->where('test_id', $test_id);
        $this->db->from('zul_user_themes');
        $results = $this->db->get();
        $user_theme_details = $results->result();
        return $user_theme_details;
    }

    public function GetUserAge($user_id)
    {

        $this->db->select('age');
        $this->db->from('user_details');
        $this->db->where('user_id', $user_id);
        $su = $this->db->get();
        $su = $su->result();
        $age = $su[0]->age;
        return $age;
    }
      public function GetUserSubtheme($user_id,$theme_id,$test_id){

    	$this->db->select('B.sub_theme_name' );
    	$this->db->from('zul_sub_themes B');
    	$this->db->join('zul_user_sub_theme_score  A', 'A.sub_theme_id = B.sub_theme_id' );
    	$this->db->join('zul_user_themes C', 'A.user_theme_id = C.user_theme_id ' );

    	$this->db->where('C.user_id',$user_id);
    	$this->db->where('C.theme_id',$theme_id);
    	
    	$q = $this->db->get();
    	$res=$q->result_array();
    	 
    	return $res;
    }
    public function GetUserSubthemeScore($user_id,$theme_id,$test_id){
    	
    	$this->db->select('B.sub_theme_name, A.marks_scored,B.sub_theme_id' );
    	$this->db->from('zul_sub_themes B');
    	$this->db->join('zul_user_sub_theme_score  A', 'A.sub_theme_id = B.sub_theme_id' );
    	$this->db->join('zul_user_themes C', 'A.user_theme_id = C.user_theme_id ' );
    	 
    	$this->db->where('C.user_id',$user_id);
    	$this->db->where('C.theme_id',$theme_id);
    	
    	 
    	$results = $this->db->get();
    	 
    	$user_subthemes = $results->result();
    	return $user_subthemes;
    }

    //    ========================= REST APIs Related methods ============================== //
    /*
     *  Function to get user by security token
     */
    public function get_user_by_security_token($security_token)
    {

        $this->db->select('user_details.* , users.*');
        $this->db->from('users');
        $this->db->join('user_details', 'users.id = user_details.user_id', 'left');
        $this->db->where('users.security_token', $security_token);
        $query = $this->db->get();
        return $query->row();

    }


    /*
     *  Function to get user by OTP
     */
    public function get_user_by_otp($otp, $field)
    {
        $query = $this->db->get_where('users', array($field => $otp));
        return $query->row();
    }


    /*
     *  Function to get user by field
     */
    public function get_user_by($field, $value)
    {
        $query = $this->db->get_where('users', array($field => $value));
        return $query->row();
    }

    /**
     * Create Rest User
     * @param $user_data
     * @return bool
     */
    public function create_rest_user($user_data)
    {
        $this->db->insert('users', $user_data);
        $user_id = $this->db->insert_id();

        if ($user_id) {
            return $this->get_rest_user_by_id($user_id);
        }
        return false;
    }

    /**
     * Get user by Id
     * @param $id
     * @return mixed
     */
    public function get_rest_user_by_id($id)
    {
        $this->db->select('user_details.* , users.*');
        $this->db->from('users');
        $this->db->join('user_details', 'users.id = user_details.user_id', 'left');
        $this->db->where('users.id', $id);
        $query = $this->db->get();
        return $query->row();

    }

    /**
     * User profile update
     * @param $user_id
     * @param array $user_data
     * @param array $user_details_data
     * @return mixed
     */
    public function update_rest_user_profile($user_id, $user_data = [], $user_details_data = [])
    {

        if (count($user_data) > 0) {
            $this->db->where('id', $user_id);
            $this->db->update('users', $user_data);
        }

        if (count($user_details_data) > 0) {
            $this->db->where('user_id', $user_id);
            $this->db->update('user_details', $user_details_data);
        }

        return $this->get_rest_user_by_id($user_id);

    }

    /*-----------------add contact-------------------*/

    public function addcontact($contact, $con_id)
    {
        $this->db->select('id, name, phone_number');
        $this->db->from('users');
        $this->db->where('phone_number', $contact['phone_number']);
        $this->db->where('user_type', 'registered'); //self::REST_USER_TYPES['REGISTERED']);
        $query = $this->db->get();
        $the_data = $query->row();

        $contact_system_user_id = null;
        if ($query->num_rows() > 0) {
            $contact_system_user_id = $the_data->id;
        }

        // Check if contact already exist
        $this->db->select('id');
        $this->db->from('zul_user_contacts');
        $this->db->where('phone_number', $contact['phone_number']);
        $this->db->where('added_by', $con_id);
        $queryExist = $this->db->get();

        if ($queryExist->num_rows() == 0) {

            $data = array(
                'name' => $contact['name'],
                'phone_number' => $contact['phone_number'],
                'contact_system_user_id' => $contact_system_user_id,
                'added_by' => $con_id,
            );

            $sql = $this->db->insert('zul_user_contacts', $data);
        }
        return true;

    }

    /**
     * Update user contact system user id make contact association with user table
     * @param $phoneNumber
     * @param $contactSysUserId
     * @return bool
     */

    public function update_contact_system_user_id($phoneNumber, $contactSysUserId){
        $this->db->where('phone_number', $phoneNumber);
        $this->db->update('zul_user_contacts', array('contact_system_user_id'=>$contactSysUserId));
        return true;
    }

    /*---------------user all contacts list----------------*/
    public function usercontacts($con_user_id)
    {
        $this->db->select('name,phone_number,contact_system_user_id');
        $this->db->from('zul_user_contacts');
        $this->db->where('added_by', $con_user_id);
        $this->db->where('contact_system_user_id is NOT NULL', NULL, FALSE);
        $query = $this->db->get();
        
        foreach ($query->result() as $value) {
            $this->db->select('count(user_id) as no_of_goals');
            $this->db->from('zul_user_diary');
            $this->db->where('is_shareable','Y');
            $this->db->where('is_completed','N');
            $this->db->where('removed_incomplete','0'); 
            $this->db->where('user_id',$value->contact_system_user_id);
            $q=$this->db->get();
            $t=$q->result();
            $value->no_of_goals = $t[0]->no_of_goals;
            
        }
        
        $outputData = array();
        foreach ($query->result() as $row) {
            $outputData[] = $row;
        }

        return $outputData;

    }
    
    /*------------- It is very easy custom to create or update -----------*/
    /**
     * 
     * @param type $table
     * @param type $where
     * @param type $set_data
     * @return type $result
     */
    public function create_or_update($table,$where,$set_data,$option = "user_id") {
        //print_r(array($table,$where,$set_data));
        //exit;
        $isExist = $this->findRecord($table, $where);
        if ( $isExist->num_rows() > 0 ) 
        {
           //echo "update";
           $this->db->set($set_data);
           $this->db->where($where)->update($table);
           $result = $this->findRecord($table, $where)->result_array();
        } else {
           $all_data = array_merge($where, $set_data);
           //echo "insert";
           //print_r($all_data); exit;
           $this->db->insert($table,$all_data);
           $id_where[$option] = $this->db->insert_id();
           $result = $this->findRecord($table, $id_where)->result_array();
        }
        return $result;
        
    }
    /**
     * 
     * @param type $table
     * @param type $where
     * @return type $result
     */
    public function findRecord($table,$where){
        //print_r(array($table,$where));
        $result = $this->db->where($where)->from($table)->get();
        //print_r($result[0]['user_theme_id']);
        return $result;
        
    }
    /**
     * @param $user_id
     * @param $fcm_token
     */
    public function updateFCMToken($user_id, $fcm_token){
        $updated_user_data = array(
            'fcm_token' => $fcm_token
        );
        
        $this->db->where('id', $user_id);
        $this->db->update('users', $updated_user_data);
        
        return true;
    }
   
    public function varify_org_access_code($org_access_code){
    	$this->db->select('access_code');
    	$this->db->from('organisation_access_code');
    	$this->db->where('access_code',$org_access_code);
    	$this->db->where('access_code_status','Y');
    	$ans=$this->db->get();
    	if($ans->num_rows()>0){
    		return true;
    	}else{
    		return false;
    	}
    	
    }

}
