<?php

/* 
 * Developer : Vadivel N
 * Date : 31 JAN, 2016
 * Description : Auth Lib
 */

class Auth_lib  
{
    private $CI = null;
    public function __construct()
    {   
        $CI =& get_instance();
        if( $CI->uri->segment(1) ) {
            $module = $CI->uri->segment(1);
            if($CI->uri->segment(2) != 'logout') {
                $this->$module();
            }
        }
    }
    private function admin() {
        $CI =& get_instance();
        $user = $CI->session->userdata('logged_in');
        if(is_array($user) && count($user) > 0) {
           $user_data  = array(
                                'admin_user_id'         => $user['user_id'], 
                                'admin_username'        => $user['username'], 
                                'admin_name'            => $user['name'],
                                'user_type'             => $user['user_type'],
                            );
            $CI->session->set_userdata($user_data);
            if( $CI->uri->segment(2) == 'login'  ) {
                redirect($CI->uri->segment(1).'/dashboard/', 'refresh');
            }
        }elseif( $CI->uri->segment(2) != 'login' ) {
            
            redirect($CI->uri->segment(1).'/login/', 'refresh');
            
        } 
    }
    private function assessment() {
        $CI =& get_instance();
        $user = $CI->session->userdata('logged_in');
        if(is_array($user) && count($user) > 0) {
           $user_data  = array(
                                'admin_user_id'         => $user['user_id'], 
                                'admin_username'        => $user['username'], 
                                'admin_name'            => $user['name'],
                                'user_type'             => $user['user_type'],
                            );
            $CI->session->set_userdata($user_data);
            if( $CI->uri->segment(2) == 'login'  ) {
                redirect($CI->uri->segment(1).'/dashboard/', 'refresh');
            }
        }elseif( $CI->uri->segment(2) != 'login' ) {
            
            redirect($CI->uri->segment(1).'/login/', 'refresh');
            
        } 
    }
}