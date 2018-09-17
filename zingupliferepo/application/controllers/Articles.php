<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {

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
					'update_password',
					'detailpage'
					
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
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['offset'] = 8;
		$data['main_content'] = 'articles';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function edit_article()
	{
		$id = $this->uri->segment(3); 
		$data['article'] = $this->sme_user->getarticle($id);
		$data['main_content'] = 'edit_article';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function submit_article()
	{
		$data = $this->input->post();
		
		if (!(empty($_FILES['userfile']['name']))) {
				$config['upload_path'] = './sme_users/articles/'. $data['id'];
				$config['allowed_types'] = 'gif|jpg|png|PNG';
			
				if (!is_dir('sme_users/articles/' . $data['id']))
				{
					mkdir('./sme_users/articles/' . $data['id'], 0777, true);
				}
				
				$this->load->library('upload', $config);
				
				
				if ( ! $this->upload->do_upload())
				{
					$data['errors'] = array('error' => $this->upload->display_errors());

					$data['main_content'] = 'edit_article'; 
					$this->load->view('includes/sme_template',$data);
				}
				
				$photo = $this->upload->data();
			}
		
			
		if (!(empty($_FILES['userfile']['name']))) 
		{
			$array = array(
					'heading'  =>  $data['heading'],
					'content'  =>  $data['content'],
					'photo'    => $photo['file_name'],
					'added_on' =>  date('Y-m-d H:i:s')
				);
		}
		else
		{
			$array = array(
					'heading'  =>  $data['heading'],
					'content'  =>  $data['content'],
					'added_on' =>  date('Y-m-d H:i:s')
				);
		}
		$this->sme_user->update_article($array,$data['id']);
		$this->session->set_flashdata('msg', 'Article is updated successfully');
		redirect('articles');
	}
	
	public function delete_image()
	{
		$id = $this->input->post('id');
		$data = array('photo' => '');
		$this->sme_user->deleteImage($id,$data);
	}
	
	public function add_article()
	{
		$sme_userid = $this->session->userdata('sme_userid');
		$data['articles'] = $this->sme_user->getallarticles($sme_userid);
		$data['main_content'] = 'add_article';
		$this->load->view('includes/sme_template',$data);
	}
	
	public function delete_article()
	{
		$id = $this->uri->segment(3);
		$this->sme_user->delete_article($id);
		$this->session->set_flashdata('msg', 'Article is deleted successfully');
		redirect('articles');
	}
	
	public function article_add()
	{
		//form validation
		$this->form_validation->set_rules('heading','Heading','required|xss_clean');
		$this->form_validation->set_rules('content','Content','required|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'add_article'; 
			$this->load->view('includes/sme_template',$data);
		}
		else
		{
			$data = $this->input->post();
			$username = $this->session->userdata('username');
			$first_name = $this->session->userdata('first_name');
			$last_name = $this->session->userdata('last_name');
			$user_name = $this->sme_user->getusername($userid);
			$name = $first_name . ' ' . $last_name;
			$sme_userid = $this->session->userdata('sme_userid');
			$array = array(
						'heading'   => $data['heading'],
						'content'   => $data['content'],
						'sme_userid' => $sme_userid
						//'photo'     => $photo['file_name']
					);
			$id = $this->sme_user->add_article($array);
			
			if (!(empty($_FILES['userfile']['name']))) {
				$config['upload_path'] = './sme_users/articles/'. $id;
				$config['allowed_types'] = 'gif|jpg|png|PNG';
			
				if (!is_dir('sme_users/articles/' . $id))
				{
					mkdir('./sme_users/articles/' . $id, 0777, true);
				}
				
				$this->load->library('upload', $config);
				
				
				if ( ! $this->upload->do_upload())
				{
					$data['errors'] = array('error' => $this->upload->display_errors());

					$data['main_content'] = 'edit_article'; 
					$this->load->view('includes/sme_template',$data);
				}
				
				$photo = $this->upload->data();
				$array = array(
						'photo'     => $photo['file_name']
					);
				
			}
			$id = $this->sme_user->update_article($array,$id);
			$followers = $this->sme_user->getallfollowers($sme_userid);
			foreach($followers as $follower)
			{
				
				/* to send  email*/
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from(	$username, $name);
				$this->email->to($follower->username);
				$this->email->subject($data['subject']);
				$this->email->message('Hello '.$user_name->name.' 
				<br/><br/>
				
				<span >'.$name.' SME has published an article recently on <span style="font-weight:bold">"'.$data['heading'].'"</span> .<br/><br/> Please visit SME Portal to check above Article.</span>');
				$this->email->send();
			}
			
			redirect('articles');
		}
	}
	
	public function detail()
	{
		$ar_id = $this->uri->segment(3);
		$data['article'] = $this->sme_user->getarticle($ar_id);
		$data['offset'] = 5;
		$data['main_content'] = 'sme_article_detail'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function loadmore()
	{
		$art_id = $this->input->get('art_id');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['comments']  = $this->sme_user->getartcomments($offset,$limit,$art_id);
		$data['offset'] =$offset+5;
		$data['limit'] =$limit;
		$data=$this->load->view('comments_load_more',$data, TRUE);

		$this->output->set_output($data); 
	}
	
	public function sme_article_loadmore()
	{
		$sme_userid = $this->input->get('sme_userid');
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$data['sme_userid'] = $sme_userid;
		$data['articles']  = $this->sme_user->getsmearticles($offset,$limit,$sme_userid);
		$data['offset'] =$offset+4;
		$data['limit'] =$limit;
		$data=$this->load->view('sme_articles_load_more',$data, TRUE);

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
		$data['article'] = $this->sme_user->getarticle($ar_id);
		$data['offset'] = 5;
		$data['main_content'] = 'sme_user_article_detail'; 
		$this->load->view('includes/sme_template',$data);
	}
	
	public function add_comment()
	{
		$arid = $this->input->post('ar_id');
		$smeuser_id = $this->input->post('smeuser_id');
		$userid = $this->session->userdata("logged_in_user_data")->user_id;
		$comment = $this->input->post('comment');
		$data = array(
				'article_id'  => $arid,
				'userid'    => $userid,
				'comment'  => $comment
				);
		$this->sme_user->add_article_comment($data);

		redirect('articles/detailpage/'.$smeuser_id.'/'.$arid);
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
		$data['main_content'] = 'sme_user_articles';
		$this->load->view('includes/sme_template',$data);
	}
	
}
