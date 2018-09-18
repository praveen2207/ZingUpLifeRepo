<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This class for admin section login and users actions/activities
 * @author Vikrant <vikrant@nuvodev.com>
 * Date:01-09-2015
 * */
class Users extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('PasswordHash');
        $this->load->model('Admin_users');
    }

    /*
     *  Displaying login form 
     */

    public function login() {
        $data['title'] = 'Zingup Admin | Login';
        $data['main_content'] = 'admin/login';
        $this->load->view('admin/includes/template', $data);
    }

    /* Above function ends here */

    /*
     *  Validating user's credentials and processing login 
     */

    public function do_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user_validation_details = array();

        if ($username != '' && $password != '') {
            $validate_user = $this->Admin_users->validate_user($username, $password);

            if ($validate_user['validation_status']['status'] == 'Success') {
                $validate_user['user_details']->is_logged_in = '1';
                $this->session->set_userdata("logged_in_user_data", $validate_user['user_details']);
                $user_role = $validate_user['user_details']->role;
                if ($user_role == 3) {
                    redirect("/finance/transactions");
                } elseif ($user_role == 2) {
                    redirect("/customer_support/transactions");
                } else {
                    redirect("/admin/transactions");
                }
            } else {
                $validate_user['validation_status']['username'] = $username;
                $validate_user['validation_status']['password'] = $password;
                $this->session->set_flashdata('login_error_message', $validate_user['validation_status']);

                redirect("/admin");
            }
        } else {
            if ($username == '') {
                $user_validation_details['validation_status']['status'] = 'This field is required';
                $user_validation_details['validation_status']['error_type'] = 'username';
            }
            if ($password == '') {
                $user_validation_details['validation_status']['status'] = 'This field is required';
                $user_validation_details['validation_status']['error_type'] = 'password';
            }
            $this->session->set_flashdata('login_error_message', $user_validation_details['validation_status']);

            redirect("/admin");
        }
    }

    /* Above function ends here */



    /*
     *  Function for forgot password
     */

    public function forgot_password() {

        $data['main_content'] = 'admin/forgot_password';
        $data['title'] = 'Zingup Admin | Forgot Password';
        $this->load->view('admin/includes/template', $data);
    }

    /* Above function ends here */


    /*
     *  Validating user's credentials and sending reset password token to admin 
     */

    public function reset_password_request() {
        $username = $this->input->post('username');
        $submit = $this->input->post('send');
        $this->load->model('Admin_users');
        $forgot_password_request = $this->Admin_users->forgot_password_request($username, $submit);
        if ($forgot_password_request == 'Failed') {
            $this->session->set_flashdata('email_validation_error_message', 'Email you entered is not registered with Zingup. Please try again.');
            redirect('admin/forgot_password');
        } else {
            $data['email_message_heading'] = 'Check Your Email';
            $email = explode('@', $username);
            $email_part1 = $email[0];
            $email_part1_length = strlen($email_part1);
            $email_first = substr($email_part1, 0, 1);
            $email_part2 = $email_first . str_repeat("*", ($email_part1_length - 1)) . '@' . $email[1];
            $data['email_message_heading'] = 'Check Your Email';
            $data['email_message'] = 'Reset password link is sent to your email ID ' . $email_part2 . '';
            $data['title'] = 'Zingup Admin | Forgot Password';
            $data['main_content'] = 'admin/reset_pasword_check';
            $this->load->view('includes/template', $data);
        }
    }

    /* Above function ends here */


    /*
     *  Function for validating reset password token 
     */

    public function reset_password() {
        $this->User_activity->insert_user_activity();
        $password_token = $this->uri->segment(3);
        $this->load->model('Admin_users');
        $validate_password_token = $this->Admin_users->validate_password_token($password_token);
        $data['reset_password_token'] = $password_token;
        if ($validate_password_token == 'Failed') {
            $this->session->set_flashdata('password_token_error_message', 'Your reset password token is expired or incorrect,' . anchor('admin/forgot_password', 'please try again', 'class="blue link-small"'));

            $this->session->set_flashdata('username', '');
        } else {
            $this->session->set_flashdata('reset_password_token', $password_token);
            $this->session->set_flashdata('username', $validate_password_token->username);
        }
        $data['title'] = 'Zingup Admin | Reset Password';
        $data['main_content'] = 'admin/reset_password';
        $this->load->view('includes/template', $data);
    }

    /* Above function ends here */


    /*
     *  validating admin user's data and storing new password for admin 
     */

    public function store_new_password() {
        $this->User_activity->insert_user_activity();
        $post_data = $this->input->post();
        $this->load->model('Admin_users');

        $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
        $this->form_validation->set_message('required', 'This field is required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('validation_error', 'Password and  confirm password not matching.');
            $this->session->set_flashdata('username', $post_data['username']);
            $this->session->set_flashdata('reset_password_token', $post_data['reset_password_token']);
            redirect('admin/reset_password/' . $post_data['reset_password_token']);
        } else {
            $password = PasswordHash::create_hash($post_data['password']);
            $update_new_password = $this->Admin_users->update_new_password($post_data['username'], $password);

            if ($update_new_password == 1) {
                $data['main_content'] = 'admin/reset_password_success';
                $this->load->view('includes/template', $data);
            } else {

                $this->session->set_flashdata('validation_error', 'please try again.');
                $this->session->set_flashdata('username', $post_data['username']);
                $this->session->set_flashdata('reset_password_token', $post_data['reset_password_token']);

                redirect('reset_password/' . $post_data['reset_password_token']);
            }
        }
    }

    /* Above function ends here */


    /*
     *  Function for logout
     */

    public function logout() {
        $logged_in_user_data = $this->session->userdata('logged_in_user_data');
        $this->Admin_users->logout($logged_in_user_data);
        $this->session->unset_userdata('logged_in_user_data');
        $this->session->sess_destroy();
        redirect(base_url() . 'admin', 'refresh');
    }

    /* Above function ends here */

    public function get_all_users() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $all_users = $this->Admin_users->get_all_users();
            $user_roles = $this->Admin_users->get_user_roles();

            $data['user_roles'] = $user_roles;

            $data['all_users'] = $all_users;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/users';
            $data['sub_url'] = 'users';
            $data['title'] = 'Zingup Admin | Users';
            $data['main_content'] = 'admin/users';
            $this->load->view('admin/includes/user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /*
     *  customer table search filter
     */

    public function search_user() {
        $data = $this->input->post();
        $result = $this->Admin_users->search_user($data);
        echo json_encode($result);
    }

    /*
     *  Displaying login form 
     */

    public function user_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_id = $this->uri->segment(3);
            $user_details = $this->Admin_users->user_details($user_id);

            $data['user_details'] = $user_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/users';
            $data['sub_url'] = 'users';
            $data['title'] = 'Zingup Admin | User Details';
            $data['main_content'] = 'admin/users_details';
            $this->load->view('admin/includes/user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /*
     *  Displaying login form 
     */

    public function get_user_roles() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_roles = $this->Admin_users->get_user_roles();

            $data['user_roles'] = $user_roles;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/users';
            $data['sub_url'] = 'roles';
            $data['title'] = 'Zingup Admin | User Roles';
            $data['main_content'] = 'admin/user_roles';
            $this->load->view('admin/includes/user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    public function delete_user_roles() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->Admin_users->delete_user_roles($post_data['role_id']);
        return true;
    }

    /*
     *  Displaying login form 
     */

    public function edit_user_details() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_id = $this->uri->segment(3);
            $user_details = $this->Admin_users->user_details($user_id);

            $data['user_details'] = $user_details;
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'admin/users';
            $data['sub_url'] = 'users';
            $data['title'] = 'Zingup Admin | Edit User Details';
            $data['main_content'] = 'admin/edit_user_details';
            $this->load->view('admin/includes/user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    public function update_user() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $post_data = $this->input->post();
            $update_user_details = $this->Admin_users->update_user_details($post_data);
            if ($update_user_details == 1) {
                $this->session->set_flashdata('profile_update_message', 'success');
            } else {
                $this->session->set_flashdata('profile_update_message', 'error');
            }
            redirect("/admin/edit_user_details/" . $post_data['user_id'] . "");
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    public function delete_user() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        $post_data = $this->input->post();
        $this->Admin_users->delete_user($post_data['user_id']);
        return true;
    }

    /*
     *  Displaying login form 
     */

    public function add_user() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $user_roles = $this->Admin_users->get_user_roles();

            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['user_roles'] = $user_roles;
            $data['url'] = 'admin/users';
            $data['sub_url'] = 'users';
            $data['title'] = 'Zingup Admin | Create User';
            $data['main_content'] = 'admin/add_user';
            $this->load->view('admin/includes/user_template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    public function create_users() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $post_data = $this->input->post();

            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('username', 'Email', 'trim|required');
            $this->form_validation->set_rules('role', 'Role', 'required');
            $this->form_validation->set_rules('gender', 'Gender', 'required');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required|numeric');
            $this->form_validation->set_rules('age', 'Age', 'required|numeric');
            $this->form_validation->set_message('required', 'This field is required');
            $this->form_validation->set_error_delimiters('<label generated="true" class="error">', '</label>');


            if ($this->form_validation->run() == FALSE) {
                $user_roles = $this->Admin_users->get_user_roles();
                $data['post_data'] = $post_data;
                $data['user_roles'] = $user_roles;
                $data['url'] = 'admin/users';
                $data['sub_url'] = 'users';
                $data['title'] = 'Zingup Admin | Create User';
                $data['main_content'] = 'admin/add_user';
                $this->load->view('admin/includes/user_template', $data);
            } else {

                $check_user_exists = $this->Admin_users->check_username_availability($post_data['username']);
                if (!empty($check_user_exists)) {
                    $user_roles = $this->Admin_users->get_user_roles();
                    $data['post_data'] = $post_data;
                    $data['user_roles'] = $user_roles;
                    $data['url'] = 'admin/users';
                    $data['sub_url'] = 'users';
                    $data['title'] = 'Zingup Admin | Create User';
                    $data['error_message'] = 'username already exists';
                    $data['main_content'] = 'admin/add_user';
                    $this->load->view('admin/includes/user_template', $data);
                } else {
                    $password = 'testing';
                    $hashed = PasswordHash::create_hash($password);
                    $this->Admin_users->create_user($post_data, $hashed);
                    redirect("/admin/users");
                }
            }
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /*
     *  reset password
     */

    public function admin_reset_password() {
        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if ($logged_in_user_details->is_logged_in == 1) {
            $data['logged_in_user_details'] = $logged_in_user_details;
            $data['url'] = 'reset password';
            $data['title'] = 'Zingup Admin | Reset password';
            $data['main_content'] = 'admin/admin_reset_password';
            $this->load->view('admin/includes/template', $data);
        } else {
            $this->session->set_flashdata('login_required_message', 'Please login to continue !!!.');
            redirect("/admin");
        }
    }

    /* Above function ends here */


    /*
     *  reset password
     */

    public function admin_new_password() {
        $post_data = $this->input->post();
        $username = $post_data['username'];

        $logged_in_user_details = $this->session->userdata('logged_in_user_data');
        if (!empty($logged_in_user_details)) {
            $validate_password = PasswordHash::validate_password($post_data['old_password'], $logged_in_user_details->password);
            if ($validate_password == 1 || $validate_password == true) {
                $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
                $this->form_validation->set_message('required', 'This field is required');
                $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('validation_error', 'Password and  confirm password not matching.');
                    $this->session->set_flashdata('username', $post_data['username']);
                    redirect('admin/reset_password/');
                } else {
                    $password = PasswordHash::create_hash($post_data['password']);
                    $update_new_password = $this->Admin_users->reset_new_password($post_data['username'], $password);

                    if ($update_new_password == 1) {
                        $data['main_content'] = 'admin/reset_password_success';
                        $this->load->view('includes/template', $data);
                    } else {

                        $this->session->set_flashdata('validation_error', 'please try again.');
                        $this->session->set_flashdata('username', $post_data['username']);
                        $this->session->set_flashdata('reset_password_token', $post_data['reset_password_token']);

                        redirect('reset_password/' . $post_data['reset_password_token']);
                    }
                }
            } else {
                $this->session->set_flashdata('validation_error', 'Your old password is not matching.');
                $this->session->set_flashdata('username', $post_data['username']);

                redirect('admin/reset_password');
            }
        } else {
            redirect("/admin");
        }
    }

    /* Above function ends here */
}
