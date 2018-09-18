<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

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
					'signin',
					'forgot_password',
					'send_mail',
					'reset_password',
					'update_password'
					
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
		$data['events'] = $this->sme_user->getallevents($sme_userid);
		$data['offset'] = '5';
		$data['main_content'] = 'events';
		$this->load->view('includes/sme_template',$data);
	}

	
	public function edit_event()
	{
		$id = $this->uri->segment(3);
		$data['event'] = $this->sme_user->getevent($id);
		$data['images'] = $this->sme_user->geteventimages($id);
		$data['main_content'] = 'edit_event'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function update_event()
	{
		$input = $this->input->post();
		
		$this->form_validation->set_rules('title','Title','required|xss_clean');
		$this->form_validation->set_rules('description','Description','required|xss_clean');
		$this->form_validation->set_rules('location','Location','required|xss_clean');
		$this->form_validation->set_rules('date','Date','required|xss_clean');
		$this->form_validation->set_rules('start_time','Start Time','required|xss_clean');
		$this->form_validation->set_rules('duration','Duration','required|xss_clean');
		$this->form_validation->set_rules('total_slots','Total Slots','required|xss_clean');
		$this->form_validation->set_rules('slots_available','Slots Available','required|xss_clean');
		$this->form_validation->set_rules('joining_fee','Joining Fee','required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['event'] = $this->sme_user->getevent($input['id']);
			$data['main_content'] = 'edit_event'; 
			$this->load->view('includes/sme_template',$data);
		}
		else
		{
			$input['date'] = date('Y-m-d',strtotime($input['date']));
			$array = array(
						'title'  		 	=> $input['title'],
						'description'   	=> $input['description'],
						'location'   		=> $input['location'],
						'date'   			=> $input['date'],
						'start_time'  	 	=> $input['start_time'],
						'duration'  	 	=> $input['duration'],
						'total_slots'   	=> $input['total_slots'],
						'slots_available'   => $input['slots_available'],
						'joining_fee'   	=> $input['joining_fee'],
						'discount'   		=> $input['discount']
					);
			$this->sme_user->update_event($array,$input['id']);
			
			$count = count($_FILES['userfile']['size']);
			
			foreach($_FILES as $key=>$value)
				for($s=0; $s<=$count-1; $s++) {
					$_FILES['userfile']['name']=$value['name'][$s];
					$_FILES['userfile']['type']    = $value['type'][$s];
					$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
					$_FILES['userfile']['error']       = $value['error'][$s];
					$_FILES['userfile']['size']    = $value['size'][$s];
					
					if($_FILES['userfile']['name'] != '')
					{
						$config['upload_path'] = './sme_users/events/'. $input['id'];
						$config['allowed_types'] = 'gif|jpg|png|PNG';
						
						if($s == 0) $p='y'; else $p = 'n';
						
							$this->load->library('upload', $config);
							$this->upload->do_upload();
							$data = $this->upload->data();
							$image = array
										(
											'name'   	=>  $_FILES['userfile']['name'],
											'ev_id'  	=>  $input['id'],
											'main_image'	=> 	$p
										);
						$this->sme_user->add_event_image($image);
					}
				}
			
			
			
			$this->session->set_flashdata('msg', 'Event is updated successfully');
			redirect('events');
		}
	}
	
	public function add_event()
	{
		$data['main_content'] = 'add_event'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function insert_event()
	{
		$input = $this->input->post();
		
		$this->form_validation->set_rules('title','Title','required|xss_clean');
		$this->form_validation->set_rules('description','Description','required|xss_clean');
		$this->form_validation->set_rules('location','Location','required|xss_clean');
		$this->form_validation->set_rules('date','Date','required|xss_clean');
		$this->form_validation->set_rules('start_time','Start Time','required|xss_clean');
		$this->form_validation->set_rules('duration','Duration','required|xss_clean');
		$this->form_validation->set_rules('total_slots','Total Slots','required|xss_clean');
		$this->form_validation->set_rules('slots_available','Slots Available','required|xss_clean');
		$this->form_validation->set_rules('joining_fee','Joining Fee','required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'add_event'; 
			$this->load->view('includes/sme_template',$data);
		}
		else
		{
			$input['date'] = date('Y-m-d',strtotime($input['date']));
			
			
			$array = array(
						'title'  		 	=> $input['title'],
						'description'   	=> $input['description'],
						'location'   		=> $input['location'],
						'date'   			=> $input['date'],
						'start_time'  	 	=> $input['start_time'],
						'duration'  	 	=> $input['duration'],
						'total_slots'   	=> $input['total_slots'],
						'slots_available'   => $input['slots_available'],
						'joining_fee'   	=> $input['joining_fee'],
						'discount'   		=> $input['discount'],
						'sme_userid'        => $this->session->userdata('sme_userid')
					);
					
			$ev_id = $this->sme_user->add_event($array);
			
			
			
			if (!is_dir('./sme_users/events/'. $ev_id))
				{
					mkdir('./sme_users/events/' . $ev_id, 0777, true);
				}
			$count = count($_FILES['userfile']['size']);
			
			foreach($_FILES as $key=>$value)
				for($s=0; $s<=$count-1; $s++) {
					$_FILES['userfile']['name']=$value['name'][$s];
					$_FILES['userfile']['type']    = $value['type'][$s];
					$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
					$_FILES['userfile']['error']       = $value['error'][$s];
					$_FILES['userfile']['size']    = $value['size'][$s];
					
					if($_FILES['userfile']['name'] != '')
					{
						$config['upload_path'] = './sme_users/events/'. $ev_id;
						$config['allowed_types'] = 'gif|jpg|png|PNG';
						
						if($s == 0) $p='y'; else $p = 'n';
						
							$this->load->library('upload', $config);
							$this->upload->do_upload();
							$data = $this->upload->data();
							$image = array
										(
											'name'   	=>  $_FILES['userfile']['name'],
											'ev_id'  	=>  $ev_id,
											'main_image'	=> 	$p
										);
						$this->sme_user->add_event_image($image);
					}
				}

			$this->session->set_flashdata('msg', 'Event is added successfully');
			redirect('events');
		}
	}
	
	public function delete_event()
	{
		$id = $this->uri->segment(3);
		$this->sme_user->delete_event($id);
		$this->session->set_flashdata('msg', 'Event is deleted successfully');
		redirect('events');
	}
	
	public function view_event()
	{
		$id = $this->uri->segment(3);
		$data['event'] = $this->sme_user->getevent($id);
		$data['main_content'] = 'view_event'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function delete_ev_image()
	{
		$data = $this->input->post();
		$this->sme_user->delete_ev_image($data['id']);
	}
	
	public function loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['events']  = $this->sme_user->geteventdata($offset,$limit,$sme_userid);
		$data['offset'] =$offset+5;
		$data['limit'] =$limit;
		$data=$this->load->view('event_load_more',$data, TRUE);

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
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['neg_fb'] = $this->sme_user->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->sme_user->cal_pos_fb($sme_userid);
		$data['questions'] = $this->sme_user->getallansquestions($sme_userid);
		$data['events'] = $this->sme_user->getallevents($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$data['feedback'] =$this->sme_user->getallfeedback($sme_userid);
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['offset'] = 8;
		$data['main_content'] = 'sme_user_events';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function sme_event_loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['articles']  = $this->sme_user->getsmeevents($offset,$limit,$sme_userid);
		$data['offset'] =$offset+4;
		$data['limit'] =$limit;
		$data=$this->load->view('sme_events_load_more',$data, TRUE);

		$this->output->set_output($data); 
	}
	
	public function detailpage()
	{
		$ar_id = $this->uri->segment(4);
		
		$sme_userid = $this->uri->segment(3);
		
		$data['profile'] = $this->sme_portal->getprofile($sme_userid);
		$data['fb_rating'] = $this->sme_user->getrating($sme_userid);
		$data['rating_total'] = $this->sme_user->getratingtot($sme_userid);
		$data['pos_fb'] = $this->sme_user->get_pos_fb($sme_userid);
		$data['neu_fb'] = $this->sme_user->get_neu_fb($sme_userid);
		$data['neg_fb'] = $this->sme_user->get_neg_fb($sme_userid);
		$data['pos_fb_per'] = $this->sme_user->cal_pos_fb($sme_userid);
		$data['feedback'] =$this->sme_user->getallfeedback($sme_userid);
		$data['follow_cnt'] = $this->sme_portal->getfollowcnt($sme_userid);
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['questions'] = $this->sme_user->getallansquestions($sme_userid);
		$data['events'] = $this->sme_user->getallevents($sme_userid);
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$data['following'] =  $this->sme_user->checkfollow($userid,$sme_userid);
		$data['event'] = $this->sme_user->getevent($ar_id);
		$data['offset'] = 5;
		$data['main_content'] = 'sme_user_event_detail'; 
		$this->load->view('includes/sme_template',$data);
	}
	
}
