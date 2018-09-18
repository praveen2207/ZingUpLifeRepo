<?php

/* 
 * Created By : Vadivel
 * Created Date : 06th FEB, 2016
 * Description : Index
 */
class Home extends CI_Controller 
{

    public function __construct(){
        parent::__construct();
        
    }
    public function index(){
        redirect('admin/login');
    }

	
}
