<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UtilitiesController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		
		$result['list']=$this->model->getCountry();
		
	}
	
	public function loadData()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];

		$this->load->model('UtilitiesModel');
		
		$result=$this->UtilitiesModel->getData($loadType,$loadId);
		$HTML="";
		
		if(sizeof($result) > 0){
			foreach($result as $list){
				$HTML.="<option value='".$list->id."'>".$list->name."</option>";
			}
		}
		echo $HTML;
	}
}