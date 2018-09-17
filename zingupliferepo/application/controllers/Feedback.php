<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

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
		$this->load->helper('text');
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
		
	//sme View for feedback listing
	public function index()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$data['feedback'] = $this->sme_user->getallfeedback($sme_userid);
		$data['main_content'] = 'feedback';
		$this->load->view('includes/sme_template',$data);
	}
	
	//user view for feedback listing
	public function user()
	{
		$sme_userid = $this->uri->segment(3);
		$data['feedback'] = $this->sme_user->getallfeedback($sme_userid);
		$data['offset'] = 5;
		//echo '<pre>'; print_r($this->session->userdata("logged_in_user_data"));exit();
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$data['main_content'] = 'user_feedback';
		$this->load->view('includes/sme_template',$data);
	}
	
	
	
	public function add_respond()
	{
		$fbid = $this->input->post('fb_id');
		$msg = $this->input->post('message');
		$data = array(
				'fb_id'  => $fbid,
				'response'  => $msg
				);
		$this->sme_user->add_feedback($data);
		$this->session->set_flashdata('msg', 'Response is sent successfully');
		redirect('feedback');
	} 
	
	public function add()
	{
		
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
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
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$this->session->set_userdata("smeuserid",$sme_userid);
		
		//$check_package = $this->sme_user->check_user_package($userid);
		//$check_package = $this->sme_user->check_user_payment($userid);
		
		//echo 'test'; exit();
		//$data['package'] = $check_package;
		
		//if($check_package->fb_no >= $check_package->no_fb)
		//{
		//	$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		//	$data['main_content'] = 'user_buy_package';
		//	$this->load->view('includes/sme_template',$data);
		//}
		//else
		//{
		//	$data['packages'] = $this->sme_user->getallpackages();	
			$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
			$data['main_content'] = 'user_add_feedback';
			$this->load->view('includes/sme_template',$data);
		//}
	}
	
	//SME reply feedback
	public function reply()
	{
		$data['main_content'] = 'sme_reply_feedback';
		$this->load->view('includes/sme_template',$data);
	}
	
	//user feedback add form submit
	public function publish()
	{
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data = $this->input->post();
		$sme_userid = $data['smeuserid'];
		$smeuerdetails = $this->sme_user->getsmedetails($sme_userid);
		$this->form_validation->set_rules('subject','Subject','required|xss_clean');
		$this->form_validation->set_rules('feedback','Feedback','required|xss_clean');
		$this->form_validation->set_rules('fb_type','Feedback Type','required|xss_clean');
		//$this->form_validation->set_rules('score','Rating','required|xss_clean');
		$this->session->set_userdata("smeuserid",$data['smeuserid']);
		if($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'user_add_feedback'; 
			$this->load->view('includes/sme_template',$data);
		}
		else
		{
			$filter = $this->sme_user->getfilter();
			$i=0;
			if(count($filter > 0))
			{
				
				foreach($filter as $f){
					 if (strpos($data['feedback'], $f->word) !== false) {
						 $i++;
							$this->session->set_flashdata('msg','Feedback given by you is not proper');
							redirect('feedback/add/'.$data['smeuserid'].'');
						}
						else{
							$i = 0;
						}
				}
					if($i==0){
					$datarray = array(
								'subject'    =>  $data['subject'],
								'sme_userid' =>  $data['smeuserid'],
								'feedback'   =>  $data['feedback'],
								'fb_score'   =>  $data['score'],
								'type'		 =>  $data['fb_type'],
								'userid'     =>  $userid
					);
					//$fb_no = $this->sme_user->getfb_no($data['transaction_id']);
					
					$this->sme_user->add_user_feedback($datarray);
					
					/*to send  email*/
					$emailfrom = $this->session->userdata("logged_in_user_data")->username;
					$name = $this->session->userdata("logged_in_user_data")->name;
					$username = $smeuerdetails->username;
					$this->load->library('email');
					$this->email->set_newline("\r\n");
					$this->email->set_mailtype("html");
					$this->email->from(	$emailfrom, $name);
					$this->email->to($username);
					$this->email->subject('Feedback Received');
					$this->email->message('Hello '.$smeuerdetails->first_name.'  '.$smeuerdetails->last_name.' 
					<br/><br/>
					You have got a Feedback. Please login to Zinguplife SME Portal to view it. 
					<br/><br/><br/><br/>
					
					Regards<br/>
					Zingup Admin');
					$this->email->send();
					
					
					$this->session->set_flashdata('msg', 'Feedback is added successfully');
					redirect('feedback/add/'.$data['smeuserid'].'');
				}
			
			}
			else if($i==0){
				$datarray = array(
							'subject'    =>  $data['subject'],
							'sme_userid' =>  $data['smeuserid'],
							'feedback'   =>  $data['feedback'],
							'fb_score'   =>  $data['score'],
							'type'		 =>  $data['fb_type'],
							'userid'     =>  $userid
				);
				
				$this->sme_user->add_user_feedback($datarray);
				$this->session->set_flashdata('msg', 'Feedback is added successfully');
				redirect('feedback/add/'.$data['smeuserid'].'');
			}
		}
		
	}
	
	//user feedback add form submit
	public function update()
	{
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data = $this->input->post();
		$sme_userid = $data['smeuserid'];
		$id = $data['fb_id'];
		$smeuerdetails = $this->sme_user->getsmedetails($sme_userid);
		$this->form_validation->set_rules('subject','Subject','required|xss_clean');
		$this->form_validation->set_rules('feedback','Feedback','required|xss_clean');
		$this->form_validation->set_rules('score','Rating','required|xss_clean');
		$this->session->set_userdata("smeuserid",$data['smeuserid']);
		if($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'user_add_feedback'; 
			$this->load->view('includes/sme_template',$data);
		}
		else
		{
			$filter = $this->sme_user->getfilter();
			$i=0;
			if(count($filter > 0))
			{
				
				foreach($filter as $f){
					 if (strpos($data['feedback'], $f->word) !== false) {
						 $i++;
							$this->session->set_flashdata('msg','Feedback given by you is not proper');
							redirect('feedback/edit/'.$data['smeuserid'].'/'.$id.'');
						}
						else{
							$i = 0;
						}
				}
					if($i==0){
					$datarray = array(
								'subject'    =>  $data['subject'],
								'sme_userid' =>  $data['smeuserid'],
								'feedback'   =>  $data['feedback'],
								'fb_score'   =>  $data['score'],
								'type'		 =>  $data['fb_type'],
								'userid'     =>  $userid
					);
					//$fb_no = $this->sme_user->getfb_no($data['transaction_id']);
					
					$this->sme_user->update_user_feedback($datarray,$id);
					
					/*to send  email*/
					$emailfrom = $this->session->userdata("logged_in_user_data")->username;
					$name = $this->session->userdata("logged_in_user_data")->name;
					$username = $smeuerdetails->username;
					$this->load->library('email');
					$this->email->set_newline("\r\n");
					$this->email->set_mailtype("html");
					$this->email->from(	$emailfrom, $name);
					$this->email->to($username);
					$this->email->subject('Feedback Received');
					$this->email->message('Hello '.$smeuerdetails->first_name.'  '.$smeuerdetails->last_name.' 
					<br/><br/>
					You have got a Feedback. Please login to Zinguplife SME Portal to view it. 
					<br/><br/><br/><br/>
					
					Regards<br/>
					Zingup Admin');
					$this->email->send();
					
					
					$this->session->set_flashdata('msg', 'Feedback is updated successfully');
					redirect('feedback/edit/'.$data['smeuserid'].'/'.$id.'');
				}
			
			}
			else if($i==0){
				$datarray = array(
							'subject'    =>  $data['subject'],
							'sme_userid' =>  $data['smeuserid'],
							'feedback'   =>  $data['feedback'],
							'fb_score'   =>  $data['score'],
							'type'		 =>  $data['fb_type'],
							'userid'     =>  $userid
				);
				
				$this->sme_user->update_user_feedback($datarray,$id);
				$this->session->set_flashdata('msg', 'Feedback is updated successfully');
				redirect('feedback/edit/'.$data['smeuserid'].'/'.$id.'');
			}
		}
		
	}
	
	
	
	
	
	public function detail()
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
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['questions'] = $this->sme_user->getallansquestions($id);
		$data['events'] = $this->sme_user->getallevents($sme_userid);
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$fb_id= $this->uri->segment(4);
		$data['feedback'] = $this->sme_user->getfb($fb_id);
		$data['main_content'] = 'feedback_detail'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function edit()
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
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$fb_id= $this->uri->segment(4);
		$data['feedback'] = $this->sme_user->getfb($fb_id);
		$data['main_content'] = 'user_edit_feedback'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function add_reply()
	{
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data = $this->input->post();
		$array = array(
				'userid'   	=>  $userid,
				'fb_id'   	=>  $data['fb_id'],
				'comment'   =>  $data['comment']
				);
		$this->sme_user->add_user_feedback_reply($array);
		redirect('feedback/detailpage/'.$data['sme_userid'].'/'.$data['fb_id'].'');
	}
	
	public function loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['feedback']  = $this->sme_user->getfeedbackdata($offset,$limit,$sme_userid);
		$data['offset'] =$offset+5;
		$data['limit'] =$limit;
		$data=$this->load->view('user_feedback_load_more',$data, TRUE);

		$this->output->set_output($data); 
		
	}
	
	public function loadmorefbtype()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$type = $this->input->get('type');
		$data['sme_userid'] = $sme_userid;
		$data['feedback']  = $this->sme_user->getfeedbackdatatype($offset,$limit,$sme_userid,$type);
		$data['offset'] =$offset+5;
		$data['limit'] =$limit;
		$data=$this->load->view('user_feedback_load_more',$data, TRUE);

		$this->output->set_output($data); 
		
	}
	
	
	
	//sme view for feedback listing
	public function listing()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$data['feedback'] = $this->sme_user->getallfeedback($sme_userid);
		$data['offset'] = 5;
		//echo '<pre>'; print_r($this->session->userdata("logged_in_user_data"));exit();
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['main_content'] = 'user_feedback';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function addsme_reply()
	{
		$userid = $this->session->userdata("sme_userid");
		$data = $this->input->post();
		$array = array(
				'sme_userid'   	=>  $userid,
				'fb_id'   	=>  $data['fb_id'],
				'comment'   =>  $data['comment']
				);
		$this->sme_user->add_smeuser_feedback_reply($array);
		redirect('feedback/detail/'.$userid.'/'.$data['fb_id'].'');
	}
	
	public function sme_fb_loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['feedback']  = $this->sme_user->getsmefeedbackdata($offset,$limit,$sme_userid);
		$data['offset'] =$offset+5;
		$data['limit'] =$limit;
		$data=$this->load->view('sme_feedback_load_more',$data, TRUE);

		$this->output->set_output($data); 
		
	}
	
	//sme view for feedback listing
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
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['questions'] = $this->sme_user->getallansquestions($id);
		$data['events'] = $this->sme_user->getallevents($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['feedback'] = $this->sme_user->getallfeedback($sme_userid);
		$data['offset'] = 5;
		//echo '<pre>'; print_r($this->session->userdata("logged_in_user_data"));exit();
		$data['main_content'] = 'sme_user_feedback';
		$this->load->view('includes/sme_template',$data);
	}
	
		//sme view for feedback listing
	public function type()
	{
		$sme_userid = $this->uri->segment(3);
		$type = $this->uri->segment(4);
		
		$data['profile'] = $this->sme_portal->getprofile($sme_userid);
		$data['fb_rating'] = $this->sme_user->getrating($sme_userid);
		$data['rating_total'] = $this->sme_user->getratingtot($sme_userid);
		$data['pos_fb'] = $this->sme_user->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->sme_user->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->sme_user->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->sme_user->cal_pos_fb($sme_userid);
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['questions'] = $this->sme_user->getallansquestions($id);
		$data['events'] = $this->sme_user->getallevents($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$this->session->set_userdata("smeuserid",$sme_userid);
		if($type == 'positive')
		{
			$data['feedback'] = $this->sme_user->getallposfeedback($sme_userid);
		}
		else if($type == 'neutral')
		{
			$data['feedback'] = $this->sme_user->getallneufeedback($sme_userid);
		}
		else
		{
			$data['feedback'] = $this->sme_user->getallnegfeedback($sme_userid);
		}
		$data['offset'] = 5;
		//echo '<pre>'; print_r($this->session->userdata("logged_in_user_data"));exit();
		$data['main_content'] = 'sme_user_feedback';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function detailpage()
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
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['questions'] = $this->sme_user->getallansquestions($id);
		$data['events'] = $this->sme_user->getallevents($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$fb_id= $this->uri->segment(4);
		$data['feedback'] = $this->sme_user->getfb($fb_id);
		$data['main_content'] = 'sme_user_feedback_detail'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function delete_feedback()
	{
		$id = $this->input->post('id');
		$this->sme_user->delete_fb($id);
		return true;
	}
	
	
	
	
	
	
}
