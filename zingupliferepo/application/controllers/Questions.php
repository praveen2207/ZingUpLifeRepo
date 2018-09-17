<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller {

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
		$this->load->model('mailing');
		$this->load->model('User_activity');
		/* if ( ! $this->session->userdata('is_logged_in'))
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
			}*/
	}
		
	 
	public function index()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$data['ans_questions'] = $this->sme_user->getallansquestions($sme_userid);
		$data['unans_questions'] = $this->sme_user->getallunansquestions($sme_userid);
		$data['main_content'] = 'questions';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function add_answer()
	{
		$qid = $this->input->post('ques_id');
		$ans = $this->input->post('answer');
		$data  = array('answer' => $ans);
		$this->sme_user->add_ans($qid,$data);
		$this->session->set_flashdata('msg', 'Question is answered successfully');
		
		$user = $this->sme_user->getquestiondetail($qid);
		
		/* to send  email*/
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
		$this->email->from(	$user->smeuser, $user->name);
		$this->email->to($user->username);
		$this->email->subject('Answer to Your Question');
		$this->email->message('Hello '.$user->name.' 
		<br/><br/>
		Your query has been answered by SME for the question asked : <br/><br/>'.$user->question.'
		<br/><br/>
		
		<br/></br/>
		Regards
		Zingup Admin');
		$this->email->send();
		
		redirect('questions/listing');
	}
	
	public function mail()
	{
		$data['userid'] = $this->uri->segment(3);
		$data['qid'] = $this->uri->segment(4);
		$data['main_content'] = 'question_mail'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function send_ans_email()
	{
		$uid = $this->input->post('userid');
		$qid =$this->input->post('quesid');
		$ans = $this->input->post('answer');
		
		$user = $this->sme_user->getquestiondetail($qid);
		
		/* to send  email*/
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
		$this->email->from(	$user->smeuser, $user->name);
		$this->email->to($user->username);
		$this->email->subject('Answer to Your Question');
		$this->email->message('Hello '.$user->name.' 
		<br/><br/>
		Please Find the answer below to the question : <br/><br/>'.$user->question.'
		<br/><br/>
		
		<br/></br/>
		Regards
		Zingup Admin');
		$this->email->send();
		$this->session->set_flashdata('msg', 'Mail is sent Successfully');
		redirect('questions/mail/'.$uid.'/'.$qid);
		
		
	}
	
	//user view for questions listing
	public function user()
	{
		$sme_userid = $this->uri->segment(3);
		$data['questions'] = $this->sme_user->getallquestions($sme_userid);
		$data['questionscount'] = $this->sme_user->getallquestions($sme_userid);
		$data['unquestionscount'] = $this->sme_user->getallunansquestions($sme_userid);
		$data['anquestionscount'] = $this->sme_user->getallansquestions($sme_userid);
		$data['offset'] = 5;
		//echo '<pre>'; print_r($this->session->userdata("logged_in_user_data"));exit();
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$data['main_content'] = 'user_questions';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function unanswered()
	{
		$sme_userid = $this->uri->segment(3);
		$data['questions'] = $this->sme_user->getallunansquestions($sme_userid);
		  
		$data['questionscount'] = $this->sme_user->getallquestions($sme_userid);
		$data['unquestionscount'] = $this->sme_user->getallunansquestions($sme_userid);
		$data['anquestionscount'] = $this->sme_user->getallansquestions($sme_userid);
		$data['offset'] = 5;
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$data['main_content'] = 'user_questions';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function expedited()
	{
		$sme_userid = $this->session->userdata("sme_userid");
		$data['questions'] =  $this->sme_user->geturgquestions($sme_userid);

		$data['questionscount'] = $this->sme_user->getallquestions($sme_userid);
		$data['unquestionscount'] = $this->sme_user->getallunansquestions($sme_userid);
		$data['anquestionscount'] = $this->sme_user->getallansquestions($sme_userid);
		$data['offset'] = 5;
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$data['main_content'] = 'user_questions';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function answered()
	{
		$sme_userid = $this->uri->segment(3);
		$data['questions'] = $this->sme_user->getallansquestions($sme_userid);
		
		$data['questionscount'] = $this->sme_user->getallquestions($sme_userid);
		$data['unquestionscount'] = $this->sme_user->getallunansquestions($sme_userid);
		$data['anquestionscount'] = $this->sme_user->getallansquestions($sme_userid);
		$data['offset'] = 5;
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$data['main_content'] = 'user_questions';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function ask()
	{
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
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
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['questions'] = $this->sme_user->getallansquestions($id);
		$data['events'] = $this->sme_user->getallevents($id);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['transaction_id'] = $this->sme_user->gettrans($userid);
		
		
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$data['main_content'] = 'user_ask_questions';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function publish()
	{
		$data = $this->input->post();
		$this->form_validation->set_rules('question','Question','required|xss_clean');
		$sme_userid = $data['smeuserid'];
		$this->session->set_userdata("smeuserid",$sme_userid);
		$this->session->set_userdata("question",$data['question']);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$emailfrom = $this->session->userdata("logged_in_user_data")->username;
		$name = $this->session->userdata("logged_in_user_data")->name;
		$smeuerdetails = $this->sme_user->getsmedetails($sme_userid);
		$profile = $this->sme_portal->getprofile($sme_userid);
		
		if($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'user_ask_questions'; 
			$this->load->view('includes/sme_template',$data);
		}
		else
		{
			if($data['ans_flag'] == 'urgent') $ans = "With In 24 hours from now"; else $ans= "Later";
			
			
			if($data['ans_flag'] == 'later')
			{
				$array = array(
							'question'  =>  $data['question'],
							'sme_userid' => $data['smeuserid'],
							'status'      => 'later',
							'userid'      => $userid,
							'answer'      =>  ''
						);
				/*$q_no = $this->sme_user->getq_no($data['transaction_id']);
						if(count($q_no) !=0 )
						{
							$new_no = $q_no->no + 1;
							$package = array(
											'no'          => $new_no
										);
							$this->sme_user->update_user_question_no($package,$data['transaction_id']);		
						}
						else{
							$package = array(
											'userid'         =>  $userid,
											'no'          => 1,
											'transaction_id' => $data['transaction_id']
										);
							$this->sme_user->add_user_question_no($package);	
						}
					*/		
					
					/*to send  email*/
					$emailfrom = $this->session->userdata("logged_in_user_data")->username;
					$name = $this->session->userdata("logged_in_user_data")->name;
					$username = $smeuerdetails->username;
					$this->load->library('email');
					$this->email->set_newline("\r\n");
					$this->email->set_mailtype("html");
					$this->email->from(	$emailfrom, $name);
					$this->email->to($username);
					$this->email->subject('User asked a Question');
					$this->email->message('Hello '.$smeuerdetails->first_name.'  '.$smeuerdetails->last_name.' 
					<br/><br/>
					You have got an query to be answered. Please login to Zinguplife SME Portal to answer the query 
					<br/><br/><br/><br/>
					
					Regards<br/>
					Zingup Admin');
					$this->email->send();
				$this->sme_user->add_question($array);	
			}
			else
			{
				$check_user_paid = $this->sme_user->check_user_payment($userid);
				if($check_user_paid != true)
				{
					redirect('questions/checkout');	
				}
				else
				{
					$q_no = $this->sme_user->getq_no($data['transaction_id']);
						if(count($q_no) !=0 )
						{
							$new_no = $q_no->no + 1;
							$package = array(
											'no'          => $new_no
										);
							$this->sme_user->update_user_question_no($package,$data['transaction_id']);		
						}
						else{
							$package = array(
											'userid'         =>  $userid,
											'no'          => 1,
											'transaction_id' => $data['transaction_id']
										);
							$this->sme_user->add_user_question_no($package);	
						}
					$array = array(
							'question'  =>  $data['question'],
							'sme_userid' => $data['smeuserid'],
							'status'      => 'urgent',
							'userid'      => $userid,
							'answer'      =>  ''
						);	
					$this->sme_user->add_question($array);
					
					/*to send  email*/
				$emailfrom = $this->session->userdata("logged_in_user_data")->username;
				$name = $this->session->userdata("logged_in_user_data")->name;
				$username = $smeuerdetails->username;
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from(	$emailfrom, $name);
				$this->email->to($username);
				$this->email->subject('User asked a Question');
				$this->email->message('Hello '.$smeuerdetails->first_name.'  '.$smeuerdetails->last_name.' 
				<br/><br/>
				A User have an urgent query. Please login to Zinguplife SME Portal answer the query within 24 hours of time
				<br/><br/><br/><br/>
				
				Regards<br/>
				Zingup Admin');
				$this->email->send();
				
				 $messgae_to = '+91' . $profile->phone;
					$sms_content = 'Hello you have received an enquiry. Expecting the reply within 24 hours. '
                    . 'Please reply at the earliest';
 
					$this->mailing->send_sms($messgae_to, $sms_content);	
						
					
				}
			}
	
				$this->session->set_flashdata('msg', 'Question is added successfully');
				redirect('questions/ask/'.$this->session->userdata("smeuserid"));
		}
	}
	
	public function detail()
	{
		$sme_userid = $this->uri->segment(3);
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$q_id= $this->uri->segment(4);
		$data['question'] = $this->sme_user->getquestion($q_id);
		$data['main_content'] = 'question_detail'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function add_reply()
	{
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data = $this->input->post();
		$array = array(
				'userid'   	=>  $userid,
				'qid'   	=>  $data['q_id'],
				'comment'   =>  $data['comment']
				);
		$this->sme_user->add_user_question_reply($array);
		redirect('questions/detail/'.$data['sme_userid'].'/'.$data['q_id'].'');
	}
	
	public function loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$type = $this->input->get('type');
		$data['sme_userid'] = $sme_userid;
		if($type == 'all') 
		{
			$data['questions']  = $this->sme_user->getquestionsdata($offset,$limit,$sme_userid);
		}
		else if($type == 'unanswered') 
		{
			$data['questions']  = $this->sme_user->getunquestionsdata($offset,$limit,$sme_userid);
		}
		else if($type == 'answered') 
		{
			$data['questions']  = $this->sme_user->getanquestionsdata($offset,$limit,$sme_userid);
		}
		else if($type == 'expedited') 
		{
			$data['questions']  = $this->sme_user->geturgquestionsdata($offset,$limit,$sme_userid);
		}
		$data['offset'] =$offset+5;
		$data['limit'] =$limit;
		$data=$this->load->view('user_question_load_more',$data, TRUE);

		$this->output->set_output($data); 
		
	}
	
	//SME user view for questions listing
	public function listing()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$data['questions'] = $this->sme_user->getallquestions($sme_userid);
		$data['questionscount'] = $this->sme_user->getallquestions($sme_userid);
		$data['unquestionscount'] = $this->sme_user->getallunansquestions($sme_userid);
		$data['anquestionscount'] = $this->sme_user->getallansquestions($sme_userid);
		$data['offset'] = 5;
		$data['main_content'] = 'user_questions';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function listing_unanswered()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$data['questions'] = $this->sme_user->getallunansquestions($sme_userid);
		  
		$data['questionscount'] = $this->sme_user->getallquestions($sme_userid);
		$data['unquestionscount'] = $this->sme_user->getallunansquestions($sme_userid);
		$data['anquestionscount'] = $this->sme_user->getallansquestions($sme_userid);
		$data['offset'] = 5;
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$data['main_content'] = 'user_questions';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function listing_answered()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$data['questions'] = $this->sme_user->getallansquestions($sme_userid);
		
		$data['questionscount'] = $this->sme_user->getallquestions($sme_userid);
		$data['unquestionscount'] = $this->sme_user->getallunansquestions($sme_userid);
		$data['anquestionscount'] = $this->sme_user->getallansquestions($sme_userid);
		$data['offset'] = 5;
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$data['main_content'] = 'user_questions';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function loadmore_sme_unansques()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		
		$data['unansque']  = $this->sme_user->getsmeunquestionsdata($offset,$limit,$sme_userid);
		
		$data['offset'] =$offset+8;
		$data['limit'] =$limit;
		$data=$this->load->view('sme_unans_question_load_more',$data, TRUE);

		$this->output->set_output($data); 
	}
	
	//SME user view for questions listing
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
		$data['questions'] = $this->sme_user->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;

		$data['events'] = $this->sme_user->getallevents($sme_userid);
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$data['anquestionscount'] = $this->sme_user->getallansquestions($sme_userid);
		$data['offset'] = 5;
		$data['main_content'] = 'sme_user_questions';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function detailpage()
	{
		$sme_userid = $this->uri->segment(3);
		$this->session->set_userdata("smeuserid",$sme_userid);
		$data['smeuerdetails'] = $this->sme_user->getsmedetails($sme_userid);
		$q_id= $this->uri->segment(4);
		$data['question'] = $this->sme_user->getquestion($q_id);
		
		
		$data['profile'] = $this->sme_portal->getprofile($sme_userid);
		$data['fb_rating'] = $this->sme_user->getrating($sme_userid);
		$data['rating_total'] = $this->sme_user->getratingtot($sme_userid);
		$data['pos_fb'] = $this->sme_user->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->sme_user->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->sme_user->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->sme_user->cal_pos_fb($sme_userid);
		$data['feedback'] =$this->sme_user->getallfeedback($sme_userid);
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$data['main_content'] = 'sme_user_question_detail'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function add_user_reply()
	{
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data = $this->input->post();
		$array = array(
				'userid'   	=>  $userid,
				'qid'   	=>  $data['q_id'],
				'comment'   =>  $data['comment']
				);
		$this->sme_user->add_user_question_reply($array);
		redirect('questions/detailpage/'.$data['sme_userid'].'/'.$data['q_id'].'');
	}
	
	
	public function checkout()
	{
		
		$sme_userid = $this->session->userdata('sme_userid');
		$data['sme_userid'] = $this->session->userdata('smeuserid');
		$data['amount'] = $this->sme_user->get_amount();
		
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$data['user'] = $this->session->userdata("logged_in_user_data");

		$data['profile'] = $this->sme_portal->getprofile($sme_userid);
		$data['fb_rating'] = $this->sme_user->getrating($sme_userid);
		$data['rating_total'] = $this->sme_user->getratingtot($sme_userid);
		$data['pos_fb'] = $this->sme_user->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->sme_user->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->sme_user->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->sme_user->cal_pos_fb($sme_userid);
		$data['feedback'] =$this->sme_user->getallfeedback($sme_userid);
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['questions'] = $this->sme_user->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$data['packages'] = $this->sme_user->getallpackages();
		$data['user_detail'] = $this->sme_user->getuserdetails($userid);

		$data['main_content'] = 'sme_checkout';
		$this->load->view('includes/sme_template',$data);	
	}
	
	public function payment()
	{
		
		$data = $this->input->post();
		
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$prefix = 'ORD';
        $order_id = $prefix . uniqid();
        
		$data['order_id'] = $order_id;
		$this->sme_user->create_order($order_id);
		$data['amount'] = $this->sme_user->get_amount();
		$data['logged_in_user_details'] = $this->session->userdata("logged_in_user_data");
		$data['email'] = $data['email'];
		$data['main_content'] = 'sme_payment';
		$this->load->view('includes/sme_template',$data);	
	}
	
	public function payment_process() {

        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        $data['main_content'] = 'payment_process';
        $this->load->view('includes/sme_template', $data);
    }
    
    public function payment_success() {
		$sme_userid = $this->session->userdata('smeuserid'); 
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		
		$data['profile'] = $this->sme_portal->getprofile($sme_userid);
		$profile = $this->sme_portal->getprofile($sme_userid);
		$data['fb_rating'] = $this->sme_user->getrating($sme_userid);
		$data['rating_total'] = $this->sme_user->getratingtot($sme_userid);
		$data['pos_fb'] = $this->sme_user->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->sme_user->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->sme_user->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->sme_user->cal_pos_fb($sme_userid);
		$data['feedback'] =$this->sme_user->getallfeedback($sme_userid);
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['questions'] = $this->sme_user->getanquestions($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$smeuerdetails = $this->sme_user->getsmedetails($sme_userid);
		$data['user_detail'] = $this->sme_user->getuserdetails($userid);
		
        $app_path = APPPATH;
        include($app_path . 'payment/Crypto.php');
        $workingKey = '3C095C0C179A18E2823E067C3D17CE98';  //Working Key should be provided here.
		
		//$workingKey = '79AAB7ED2DAB322205432E3FB981231A';
        $encResponse = $_POST["encResp"]; //This is the response sent by the CCAvenue Server
        $rcvdString = decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        //echo '<pre>'; print_r($decryptValues);  exit();
        $dataSize = sizeof($decryptValues);

		
        $this->User_activity->insert_user_activity();
      
       $data['transaction_response'] = $decryptValues; 
       
       $orderid = explode('=', $decryptValues[0]);
		
   

        $transaction_id_array = explode('=', $decryptValues[1]);
		$transaction_payment_array = explode('=', $decryptValues[5]);
		$transaction_amount = explode('=', $decryptValues[10]);
        
        $data['transaction_id'] = $transaction_id_array[1];
		$data['payment_mode'] = $transaction_payment_array[1];
		$data['amount'] = $transaction_amount[1];

		$payment_array = array('package_id' => 1,
								'transaction_id'  => $data['transaction_id'],
								'transaction_status'  => 'Success',
								'transaction_date'    =>  date('Y-m-d H:i:s'),
								'paid_by' => $this->session->userdata("logged_in_user_data")->user_id,
								'payment_mode' => $data['payment_mode'],
								'amount'       => $data['amount']
							  );
		$this->sme_user->insert_payment_details($payment_array,$orderid[1]);
		$questions_asked = array(
							'userid'   =>   $userid,
							'transaction_id'  => $data['transaction_id'],
							'no'              => 1	
		);
		$this->sme_user->add_user_question_no($questions_asked);
		$array = array(
							'question'  =>  $this->session->userdata('question'),
							'sme_userid' => $sme_userid,
							'status'      => 'urgent',
							'userid'      => $userid,
							'answer'      =>  ''
						);
		$this->sme_user->add_question($array);
		
		/*to send  email*/
			$emailfrom = $this->session->userdata("logged_in_user_data")->username;
			$name = $this->session->userdata("logged_in_user_data")->name;
			$username = $smeuerdetails->username;
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from(	$emailfrom, $name);
				$this->email->to($username);
				$this->email->subject('User asked a Question');
				$this->email->message('Hello '.$smeuerdetails->first_name.'  '.$smeuerdetails->last_name.' 
				<br/><br/>
				A User have an urgent query. Please login to Zinguplife SME Portal answer the query within 24 hours of time
				<br/><br/><br/><br/>
				
				Regards<br/>
				Zingup Admin');
				$this->email->send();
				
				 $messgae_to = '+91' . $profile->phone;
					$sms_content = 'testHello you have received an enquiry from the user :  ' . $name . ' expecting the reply within 24 hours. '
                    . 'Please reply at the earliest';
 
					$this->mailing->send_sms($messgae_to, $sms_content);
					
				$this->session->set_flashdata('msg', 'Question is added successfully');
				$data['main_content'] = 'user_ask_questions';
				$this->load->view('includes/sme_template',$data);
				//$this->session->set_flashdata('msg', 'Question is added successfully');
				//redirect('questions/ask/'.$this->session->userdata("smeuserid"));


    }
	
	/* Above function ends here */

    public function payment_canceled() {
        $this->User_activity->insert_user_activity();
        $data['main_content'] = 'booking_cancel';
        $this->load->view('includes/sme_template', $data);
    }
}
