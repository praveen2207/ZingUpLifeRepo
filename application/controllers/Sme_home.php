<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sme_home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sme_portal');
		$this->load->model('sme_user');
	}
		
	
	
	public function user()
	{
		$this->load->model('sme_user');
		$id = $this->uri->segment(3);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['profile'] = $this->sme_portal->getprofile($id);
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($id);
		$data['feedback'] =$this->sme_user->getallfeedback($id);
		$data['questions'] = $this->sme_user->getallansquestions($id);
		$data['events'] = $this->sme_user->getallevents($id);
		$data['fb_rating'] = $this->sme_user->getrating($id);
		$data['rating_total'] = $this->sme_user->getratingtot($id);
		$data['pos_fb'] = $this->sme_user->get_pos_fb($id);
		$data['neu_fb'] = $this->sme_user->get_neu_fb($id);
		$data['neg_fb'] = $this->sme_user->get_neg_fb($id);
		$data['pos_fb_per'] = $this->sme_user->cal_pos_fb($id);
		$data['articles'] = $this->sme_user->getallarticles($id);
		$data['following'] =  $this->sme_user->checkfollow($userid,$id);
		$data['offset'] = 8;
		$data['fboffset'] = 5;
		$data['aroffset'] = 4;
		$data['main_content'] = 'sme_user'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	
	
	
	
}
