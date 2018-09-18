<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_call extends CI_Controller {

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
		
		
	}
		
	 
	//user view for questions listing
	public function user()
	{
		if($this->session->userdata('is_logged_in') && $this->session->userdata('type') != 'sme')
		{
			$sme_userid = $this->uri->segment(3);
			$this->session->set_userdata("smeuserid",$sme_userid);
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
			$data['email'] = $this->session->userdata("logged_in_user_data")->username;
			$data['name'] = $this->session->userdata("logged_in_user_data")->name;
			$data['phone'] = $this->session->userdata("logged_in_user_data")->phone;
			$data['address'] = $this->session->userdata("logged_in_user_data")->address;
			
			$data['services'] = $this->sme_user->getsmeservices($sme_userid);
			$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
			$data['main_content'] = 'user_book_call';
			$this->load->view('includes/sme_template',$data);
		}
		else
		{
			$data['main_content'] = 'user_login';
			$this->load->view('includes/sme_template',$data);
		}
	}
	
	public function book()
	{
		$data = $this->input->post();
		$this->form_validation->set_rules('date','Date','required|xss_clean');
		$this->form_validation->set_rules('service','Service','required|xss_clean');
		
		$this->session->set_userdata("smeuserid",$data['smeuserid']);
		
		if($this->form_validation->run() == FALSE)
		{
			$data['services'] = $this->sme_user->getsmeservices($sme_userid);
			$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
			$data['main_content'] = 'user_book_call'; 
			$this->load->view('includes/sme_template',$data);
		}
		else
		{
			$date = date('Y-m-d',strtotime($data['date']));
			$userid = $this->session->userdata("logged_in_user_data")->user_id;
			$data['smeuerdetails'] = $this->sme_user->getsmedetails($data['smeuserid']);
			$array = array(
						'service_id'  =>   $data['service'],
						'sme_userid'  =>   $data['smeuserid'],
						'date'        =>   $date,
						'userid'      =>   $userid,
						'time'        =>   $data['time'],
						'fax'         =>   $data['fax'],
						'address'     =>   $data['address']
					);
			$this->sme_user->book_call($array);
			
			$service = $this->sme_user->getservicename($data['service']);
			
			 $username = $data['smeuerdetails']->username;
			 $from = $data['email']; 
			 $name = $data['name'];
			/* to send  email*/
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->set_mailtype("html");
			$this->email->from($from, $name);
			$this->email->to($username);
			$this->email->subject('Appointment Notification on ZingUpLife: '.$data['date'].' at '.$data['time'].');
			$this->email->message(Dear ‘<?php echo $user_details->name; ?>’ '.$smeuserdetails->first_name.'  '.$smeuserdetails->last_name.' 
			<br/><br/>			
		
            <p>Your available schedule on ZingUpLife has been booked for an online appointment with ‘<?php echo $user_details->name; ?>’ at '.$data['time'].', on '.$data['date'].'</p> 
			<p>Please confirm the appointment, by logging in to your account here: <a href=‘https://zinguplife.com/experts/login’>https://zinguplife.com/experts/login</a>.</p>
            <p>If there’s anything we can help you with, simply drop in a line at <a href="mailto:support@zinguplife.com">support@zinguplife.com</a> , or call us at +91 98181 13345.</p>
			<br/><br/>
            
			Service = '.$service.'
			<br/><br/>
			Date = '.$data['date'].'
			<br/><br/>
			Time = '.$data['time'].'
			<br/><br/>
			Name = '.$data['name'].'
			<br/><br/>
			Phone = '.$data['phone'].'
			<br/><br/>
			Fax = '.$data['fax'].'
			<br/><br/>
			Address = '.$data['address'].'
			<br/><br/><br/><br/>
			<p><br>
			Best wishes,
            </br></p>
			<p>
			Team ZingUpLife
			</p>');
			$this->email->send();
			
			$this->session->set_flashdata('msg', 'Call booked  successfully');
			redirect('book_call/user/'.$data['smeuserid'].'');
		}
	}
	
	public function calls()
	{
		if($this->session->userdata('is_logged_in') && $this->session->userdata('type') == 'sme')
		{
			$sme_userid = $this->session->userdata('sme_userid');
			$data['calls'] = $this->sme_user->getcalls($sme_userid);
			$data['offset'] = 8;
			$data['main_content'] = 'booked_calls'; 
			$this->load->view('includes/sme_template',$data);
		}
		else
		{
			redirect('sme/login');
		}
	}
	
	public function loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['calls']  = $this->sme_user->getsmecalls($offset,$limit,$sme_userid);
		$data['offset'] =$offset+8;
		$data['limit'] =$limit;
		$data=$this->load->view('booked_calls_load_more',$data, TRUE);

		$this->output->set_output($data); 
	}
	
	
	
	
}
