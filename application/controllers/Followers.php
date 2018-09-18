<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Followers extends CI_Controller {

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
		$this->load->model('sme_user');
		$this->load->model('sme_portal');
		 if ( ! $this->session->userdata('is_logged_in'))
			{ 
				// Allow some methods?
				$allowed = array(
					'register',
					'login',
					'signin'
					
				);
				if ( ! in_array($this->router->fetch_method(), $allowed))
				{
					redirect('sme/login');
				}
			}
	}
		
	 
	public function index()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$data['followers'] = $this->sme_user->getallfollowers($sme_userid);
		$data['offset'] = 8;
		$data['main_content'] = 'followers';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function message()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$data['main_content'] = 'sme_follower_send_message';
		$this->load->view('includes/sme_template',$data);
	}
	
	
	
	public function send_message()
	{
		$data = $this->input->post();
		$sme_userid = $this->session->userdata('sme_userid');
		if($data['type'] == 'ind')
		{
			$msg = array(
						'sme_userid'  =>  $sme_userid,
						'userid'      =>  $data['user_id'],
						'message'     =>  $data['message']
			);
			
			$msg_id = $this->sme_user->add_msg($msg);
			$status = array(
					'msg_id' => $msg_id,
					'read_status' => 'n'
			);
			$this->sme_user->add_msgstatus($status);
			$this->session->set_flashdata('msg', 'Message is sent Successfully');
			redirect('followers/message/'.$data['user_id']);
		}
		else if($data['type'] == 'all')
		{
			$foll_ids = $this->sme_user->getallfollowers($sme_userid);
			foreach($foll_ids as $foll_id)
			{
				$msg = array(
							'sme_userid'  =>  $sme_userid,
							'userid'      =>  $foll_id->id,
							'message'     =>  $data['message']
				);
				
				$msg_id = $this->sme_user->add_msg($msg);
				$status = array(
						'msg_id' => $msg_id,
						'read_status' => 'n'
				);
				$this->sme_user->add_msgstatus($status);
			}
			$this->session->set_flashdata('msg', 'Message is sent Successfully');
			redirect('followers/message/all');
		}
		
	}
	
	public function mail()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$data['main_content'] = 'sme_follower_send_mail';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function send_email()
	{
		$data = $this->input->post();
		$userid = $data['user_id'];
		$sme_userid = $this->session->userdata('sme_userid');
		$username = $this->session->userdata('username');
		$first_name = $this->session->userdata('first_name');
		$last_name = $this->session->userdata('last_name');
		$user_name = $this->sme_user->getusername($userid);
		$name = $first_name . ' ' . $last_name;

		
		if($data['type'] == 'ind')
		{
			/* to send  email*/
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->set_mailtype("html");
			$this->email->from(	$username, $name);
			$this->email->to($user_name->username);
			$this->email->subject($data['subject']);
			$this->email->message('Hello '.$user_name->name.' 
			<br/><br/>
			
			<span style="font-weight:bold">'.$data['message'].'</span>');
			$this->email->send();
			$this->session->set_flashdata('msg', 'Mail is sent Successfully');
			redirect('followers/mail/'.$data['user_id']);
		}
		else if($data['type'] == 'all')
		{
			$emails = $this->sme_user->getallfollowers($sme_userid);
			foreach($emails as $email)
			{
				/* to send  email*/
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from(	$username, $name);
				$this->email->to($email->username);
				$this->email->subject('Thank you for following');
				$this->email->message('Hello '.$email->name.' 
				<br/><br/>
				
				<span style="font-weight:bold">'.$data['message'].'</span>');
				$this->email->send();
			
			}
			$this->session->set_flashdata('msg', 'Mail is sent Successfully');
			redirect('followers/mail/all');
		}
	}
	
	public function loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['followers']  = $this->sme_user->getfollowersdata($offset,$limit,$sme_userid);
		$data['offset'] =$offset+8;
		$data['limit'] =$limit;
		
		if($this->session->userdata('type') == 'sme')
		{
			$data=$this->load->view('followers_load_more',$data, TRUE);
		}
		else
		{
			$data=$this->load->view('sme_user_followers_load_more',$data, TRUE);
		}

		$this->output->set_output($data); 
		
	}
	
	public function lists()
	{
		$sme_userid = $this->uri->segment(3);
		
		$data['profile'] = $this->sme_portal->getprofile($sme_userid);
		$data['fb_rating'] = $this->sme_user->getrating($sme_userid);
		$data['rating_total'] = $this->sme_user->getratingtot($sme_userid);
		$data['pos_fb'] = $this->sme_user->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->sme_user->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->sme_user->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->sme_user->cal_pos_fb($sme_userid);
		$data['feedback'] =$this->sme_user->getallfeedback($sme_userid);
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['questions'] = $this->sme_user->getallansquestions($id);
		$data['events'] = $this->sme_user->getallevents($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		
		$data['followers'] = $this->sme_user->getallfollowers($sme_userid);
		$data['offset'] = 8;
		$data['main_content'] = 'sme_user_followers';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function follow()
	{
		$sme_userid = $this->uri->segment(3);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$check_followed = $this->sme_user->checkfollow($userid,$sme_userid);
		if($check_follwed == false)
		{
			$this->sme_user->sme_follow($userid,$sme_userid);
			$this->session->set_flashdata('followmsg', 'Following');
			redirect('sme_home/user/'.$sme_userid);
		}
		else
		{
			//$this->session->set_userdata('followmsg', 'Following');
			//redirect('sme_home/user/'.$sme_userid);
		}
	}
	
	public function unfollow()
	{
		$sme_userid = $this->uri->segment(3);
		$followid = $this->uri->segment(4);
		$this->sme_user->removefollow($followid);
		//echo $this->uri->uri_string();exit();
		redirect('sme_home/user/'.$sme_userid);

		//$this->sme_user->sme_follow($userid,$sme_userid);
		//$this->session->set_flashdata('followmsg', 'Following');
		//redirect('sme_home/user/'.$sme_userid);
		
	}
	
	
}
