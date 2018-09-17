<?php
 //error_reporting(E_ALL);
//ini_set('display_errors', 1);
class Expert extends CI_Model {

    public function getallfeedback($id) {
		$this->db->select('f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on,fr.response,fr.added_on as res_added ');
		$this->db->from('sme_fb f');
		$this->db->join('users u','u.id = f.userid','left');
		$this->db->join('sme_fb_response fr','fr.fb_id = f.id','left');
		$this->db->where('f.sme_userid',$id);
		$this->db->order_by('f.added_on','desc');
        $query = $this->db->get();
		
        foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name,d.image,d.user_id');
			$this->db->from('sme_fb_comments c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->join('user_details d','d.user_id = u.id','left');
			$this->db->where('c.fb_id',$key->id);
			$this->db->order_by('c.added_on','asc');
            $q = $this->db->get();
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function getallposfeedback($id) {
		$this->db->select('f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on,fr.response,fr.added_on as res_added');
		$this->db->from('sme_fb f');
		$this->db->join('users u','u.id = f.userid','left');
		$this->db->join('sme_fb_response fr','fr.fb_id = f.id','left');
		$this->db->where('f.sme_userid',$id);
		$this->db->where('f.type',"positive");
		$this->db->order_by('f.fb_score','desc');
        $query = $this->db->get();
		
        foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name');
			$this->db->from('sme_fb_comments c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->where('c.fb_id',$key->id);
			$this->db->order_by('c.added_on','asc');
            $q = $this->db->get();
			
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function getallneufeedback($id) {
		$this->db->select('f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on,fr.response,fr.added_on as res_added');
		$this->db->from('sme_fb f');
		$this->db->join('users u','u.id = f.userid','left');
		$this->db->join('sme_fb_response fr','fr.fb_id = f.id','left');
		$this->db->where('f.sme_userid',$id);
		$this->db->where('f.type',"neutral");
		$this->db->order_by('f.fb_score','desc');
        $query = $this->db->get();
		
        foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name');
			$this->db->from('sme_fb_comments c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->where('c.fb_id',$key->id);
			$this->db->order_by('c.added_on','asc');
            $q = $this->db->get();
            
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function getallnegfeedback($id) {
		$this->db->select('f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on,fr.response,fr.added_on as res_added');
		$this->db->from('sme_fb f');
		$this->db->join('users u','u.id = f.userid','left');
		$this->db->join('sme_fb_response fr','fr.fb_id = f.id','left');
		$this->db->where('f.sme_userid',$id);
		$this->db->where('f.type',"negative");
		$this->db->order_by('f.fb_score','desc');
		
        $query = $this->db->get();
		
        foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name');
			$this->db->from('sme_fb_comments c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->where('c.fb_id',$key->id);
			$this->db->order_by('c.added_on','asc');
            $q = $this->db->get();
            //$q = $this->db->query('select c.*,u.name from sme_fb_comments c left join users u on u.id = c.userid where c.fb_id = "' . $key->id . '" order by c.added_on asc');
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function add_feedback($data) {
        $this->db->insert('sme_fb_response', $data);
    }

    public function getallquestions($id) {
		$this->db->select('sq.*,u.name,d.image');
		$this->db->from('sme_quesns sq');
		$this->db->join('users u','u.id = sq.userid','left');
		$this->db->join('user_details d','d.user_id = sq.userid','left');
		$this->db->where('sq.sme_userid',$id);
		$this->db->order_by('sq.added_on','desc');
        $query = $this->db->get();
		
        foreach ($query->result() as $key) {
			$this->db->select('c.*,s.name');
			$this->db->from('sme_quesns_replies c');
			$this->db->join('users s','s.id = c.userid','left');
			$this->db->where('c.qid',$key->id);
			$this->db->order_by('c.added_on','asc');
            $q = $this->db->get();
            $key->comments = $q->result();
        }
        return $query->result();
    }

    public function getallansquestions($id) {
		$this->db->select('q.question,q.answer,q.id,u.name,q.added_on,d.image,d.user_id,q.sme_userid,sp.photo');
		$this->db->from('sme_quesns q');
		$this->db->join('users u','u.id = q.userid','left');
		$this->db->join('user_details d','d.user_id = q.userid','left');
		$this->db->join('sme_users se','se.id = q.sme_userid','left');
		$this->db->join('sme_user_profiles sp','sp.sme_userid = se.id','left');
		$this->db->where('q.sme_userid',$id);
		//$this->db->where('answer != " "');
		$this->db->order_by('q.added_on','desc');
        $query = $this->db->get();
		
        
        foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name,d.image,d.user_id');
			$this->db->from('sme_quesns_replies c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->join('user_details d','d.user_id = u.id','left');
			$this->db->where('c.qid',$key->id);
			$this->db->order_by('c.added_on','asc');
            $q = $this->db->get();
            $key->comments = $q->result();
        }
        return $query->result();
    }

    public function getallunansquestions($id) {
		$this->db->select('q.question,q.answer,q.id,u.name,q.userid,q.added_on');
		$this->db->from('sme_quesns q');
		$this->db->join('users u','u.id = q.userid','left');
		$this->db->where('q.sme_userid',$id);
		$this->db->where('q.answer', '');
		$this->db->order_by('q.added_on','desc');
        $query = $this->db->get();
		
        foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name');
			$this->db->from('sme_quesns_replies c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->join('user_details d','d.user_id = u.id','left');
			$this->db->where('c.qid',$key->id);
			$this->db->order_by('c.added_on','asc');
            $q = $this->db->get();
            $key->comments = $q->result();
        }
        return $query->result();
    }

    public function add_ans($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sme_quesns', $data);
    }

    public function getuser($uid, $qid) {
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('sme_quesns q','q.userid = u.id','left');
		$this->db->where('u.id',$uid);
		$this->db->where('q.id',$qid);
        $query = $this->db->get();
        $res = $query->result();  // this returns an object of all results
        $row = $res[0];
        return $row;
    }

    public function getquestiondetail($qid) {
		$this->db->select('q.question,up.first_name,up.last_name,q.question,u.username,u.name,s.username as smeuser');
		$this->db->from('sme_quesns q');
		$this->db->join('users u','u.id = q.userid','left');
		$this->db->join('sme_users s','s.id = q.sme_userid','left');
		$this->db->join('sme_user_profiles up','up.sme_userid = s.id','left');
		$this->db->where('q.id',$qid);
        $query = $this->db->get();
        $res = $query->result();  // this returns an object of all results
        $row = $res[0];
        return $row;
    }

    /*public function getallarticles($id) {
        $query = $this->db->query('select * from sme_articles where sme_userid = "' . $id . '" and publish ="y" order by added_on desc');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select count(c.id) as count from sme_article_comments c left join users u on u.id = c.userid where c.article_id = "' . $key->id . '"');
            $key->comments = $q->result();
            
            $l = $this->db->query('select * from sme_fb sf join sme_fb_smeuser_comments sfc on sfc.sme_userid = sf.sme_userid join sme_articles sa on sa.sme_userid = sf.sme_userid where sa.id = "' . $key->id . '" and sf.type ="positive"');
            $ul = $this->db->query('select * from sme_fb sf join sme_fb_smeuser_comments sfc on sfc.sme_userid = sf.sme_userid join sme_articles sa on sa.sme_userid = sf.sme_userid where sa.id = "' . $key->id . '" and sf.type ="negative"');
            
            $key->likes = $l->result();
            $key->unlikes = $ul->result();
        }
        return $query->result();
    }*/

    public function update_article($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('sme_articles', $data);
        return true;
    }

    public function deleteImage($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sme_articles', $data);
        return true;
    }

    public function add_article($array) {
        $this->db->insert('sme_articles', $array);
        $id = $this->db->insert_id('');
        return $id;
    }

    public function getallevents($id) {
        $p = 'y';
		$this->db->select('*');
		$this->db->from('sme_events');
		$this->db->where('sme_userid',$id);
		$this->db->order_by('date','desc');
        $query = $this->db->get();
		
        foreach ($query->result() as $key) {
			$this->db->select('*');
			$this->db->from('sme_ev_photos');
			$this->db->where('ev_id',$key->id);
            $q = $this->db->get();
            $key->photo = $q->result();
        }
        return $query->result();
    }

    public function getevent($id) {
		$this->db->select('*');
		$this->db->from('sme_events');
		$this->db->where('id',$id);
        $query = $this->db->get();
		
        foreach ($query->result() as $key) {
			$this->db->select('*');
			$this->db->from('sme_ev_photos');
			$this->db->where('ev_id',$key->id);
            $q = $this->db->get();
            $key->photos = $q->result();
        }
        $res = $query->result();
        return $res[0];
    }
   public function getrating($id) {
	    $this->db->select('round(avg(fb_score)) as rating');
		$this->db->from('sme_fb');
		$this->db->where('sme_userid',$id);
        $q = $this->db->get();
		
        $res = $q->result();
        return $res[0];
    }
   public function getratingtot($id) {
	    $this->db->select('round(sum(fb_score)) as rating');
		$this->db->from('sme_fb');
		$this->db->where('sme_userid',$id);
        $q = $this->db->get();
		
        $res = $q->result();
        return $res[0];
    }
    
    public function cal_pos_fb($id) {
        $type = 'positive';
		$this->db->select('Count(id) as score');
		$this->db->from('sme_fb');
		$this->db->where('sme_userid',$id);
        $q = $this->db->get();
		
        $res = $q->result();
        if(!empty($res)){
        return $res[0];
		}else{
		   return $res;
		}
    }

    public function get_pos_fb($id) {
        $type = 'positive';
		$this->db->select('*');
		$this->db->from('sme_fb');
		$this->db->where('sme_userid',$id);
		$this->db->where('type',$type);
        $q = $this->db->get();
        return $q->result();
    }

    public function get_neu_fb($id) {
        $type = 'neutral';
		$this->db->select('*');
		$this->db->from('sme_fb');
		$this->db->where('sme_userid',$id);
		$this->db->where('type',$type);
        $q = $this->db->get();
        return $q->result();
    }

    public function get_neg_fb($id) {
        $type = 'negative';
		$this->db->select('*');
		$this->db->from('sme_fb');
		$this->db->where('sme_userid',$id);
		$this->db->where('type',$type);
        $q = $this->db->get();
    
        return $q->result();
    }
    
    public function checkfollow($userid, $sme_userid) {
		$this->db->select('id');
		$this->db->from('sme_followers');
		$this->db->where('sme_userid',$sme_userid);
		$this->db->where('user_id',$userid);
        $q = $this->db->get();

        if ($q->num_rows() > 0) {
            $row = $q->result();
            return $row[0]->id;
        } else {
            return false;
        }
    }
    
      public function getprofile($id) {
		$this->db->select('*');
		$this->db->from('sme_user_profiles p');
		$this->db->join('sme_users u','u.id = p.sme_userid','left');
		$this->db->where('p.sme_userid',$id);
        $query = $this->db->get();
		
        $res = $query->result();
        if(!empty($res)){
        return $res[0];
		  }else{
			 return $res; 
		  }
    }
    
     public function getfollowcnt($id) {
		$this->db->select('count(id) as fo_cnt');
		$this->db->from('sme_followers');
		$this->db->where('sme_userid',$id);
        $followers = $this->db->get();
        $fo = $followers->result();
        return $fo[0]->fo_cnt;
    }
    
    public function getalldetails($username) {
		$this->db->select('p.chat_pricing,video_pricing,audio_pricing,inperson_pricing,p.callback_time,p.vac_start_date,p.vac_end_date,p.about,p.expertise,p.header_image,u.gender,p.phone,u.username,p.first_name,p.last_name,p.photo,u.id,p.city,p.state,p.country,p.cert_edu,u.title,o.offerings_id');
		$this->db->from('sme_users u');
		$this->db->join('sme_user_profiles p','p.sme_userid = u.id','left');
		$this->db->join('sme_user_offerings o','o.sme_userid = u.id','left');
		$this->db->where('u.username',$username);
        $query = $this->db->get();
        $res = $query->result();  // this returns an object of all results
        $row = $res[0];
        return $row;
    }
    
	public function getsmedetails($id) {
		$this->db->select('*');
		$this->db->from('sme_users u');
		$this->db->join('sme_user_profiles p','p.sme_userid = u.id','left');
		$this->db->where('u.id',$id);
        $q = $this->db->get();
        $res = $q->result();
        if(!empty($res)){
        return $res[0];
        }
		else
		{
			return $res;
		}
    }
    
    public function getfollowerscount($sme_userid) {
		$this->db->select('count(id) as count');
		$this->db->from('sme_followers');
		$this->db->where('sme_userid',$sme_userid);
        $query = $this->db->get();
        $res = $query->result();  // this returns an object of all results
        $row = $res[0];
        return $row->count;
    }
    
    public function geturgquestions($sme_userid) {
        $status = 'urgent';
		$this->db->select(' sq.id,sq.question,u.name');
		$this->db->from('sme_quesns sq');
		$this->db->join('users u','u.id = sq.userid','left');
		$this->db->where('sq.sme_userid',$sme_userid);
		$this->db->where('sq.answer',"");
		$this->db->where('sq.status',$status);
		$this->db->order_by('sq.added_on',"desc");
        $q = $this->db->get();
        return $q->result();
    }
    
     public function getallpackages() {
		$this->db->select('*');
		$this->db->from('user_packages');
        $q = $this->db->get();
        return $q->result();
    }
    
    public function update_password($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sme_users', $data);
    }
	
    public function user_profile_update($data, $id) {
        $this->db->where('sme_userid', $id);
        $this->db->update('sme_user_profiles', $data);
        return true;
    }
    
    public function sme_user_update($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('sme_users', $data);
        return true;
    }
    
   /* public function getavailabledates($data) {
       $q = $this->db->query('select callback_time from sme_user_profiles where sme_userid = "'.$data['id'].'" and  
     '.$data['date'].' NOT BETWEEN vac_start_date and vac_end_date');     
       return $q->result();  
    }*/
    
    public function getavailabledates($data) {
       $q = $this->db->query('select time_from,time_to from sme_book_slots where sme_userid = "'.$data['id'].'" and  date = "'.$data['date'].'"');     
       return $q->result();  
    }
    
    /* public function insertbookedcalls($data,$id) {
     	$call_data = array(
                    'sme_userid' => $data['id'],
                    'date' => $data['date'],
                    'time' => $data['time'],
                    'userid' => $id
                );
        $this->db->insert('user_sme_book_call', $call_data);
        return true;  
    }*/
    
    public function insertbookedcalls($data,$id) {
     	
        $this->db->insert('user_sme_book_call', $data);
        return true;  
    }


public function add_user_feedback($data) {
        $this->db->insert('sme_fb', $data);
        return true;
    }
    
    
    public function sort_questions_by_dates($data,$id) {
		$this->db->select('sq.*,u.name');
		$this->db->from('sme_quesns sq');
		$this->db->join('users u','u.id = sq.userid','left');
		$this->db->where('sq.sme_userid',$data['id']);
		$this->db->like('sq.added_on',$data['sortdate'],'after');
		$this->db->order_by('sq.added_on',"desc");
		
        $query = $this->db->get();
       
        foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name');
			$this->db->from('sme_quesns_replies c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->where('c.qid',$key->id);
			$this->db->order_by('c.added_on',"asc");
            $q = $this->db->get(); 
            $key->comments = $q->result();
        }
        return $query->result();
    }
    
    
    
    
    public function getallfollowers($sme_userid) {
		$this->db->select('u.name,u.username,d.user_id,d.image,d.state,d.city,d.country,d.gender,d.age,u.id');
		$this->db->from('sme_followers f');
		$this->db->join('users u','u.id = f.user_id','left');
		$this->db->join('user_details d','d.user_id = u.id','left');
		$this->db->where('f.sme_userid',$sme_userid);
		
        $query = $this->db->get();
        return $query->result();
    }
    
    
    public function getfollowersdata($offset, $limit, $id) {
		$this->db->select('u.name,u.username,d.state,d.city,d.country,d.gender,d.age,u.id');
		$this->db->from('sme_followers f');
		$this->db->join('users u','u.id = f.user_id','left');
		$this->db->join('user_details d','d.user_id = u.id','left');
		$this->db->where('f.sme_userid',$sme_userid);
		$this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result();
    }
    
     public function getuserdetails($id) {
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->where('user_id',$id);
        $query = $this->db->get();
        $row = $query->result();
        return $row[0];
    }
    
     public function create_order($id) {
        $array = array('order_id' => $id);
        $this->db->insert('user_package_transaction_details', $array);
    }
    
      public function create_pay_order($id) {
        $array = array('order_id' => $id);
        $this->db->insert('user_chat_pay_trans', $array);
    }
    
    public function get_amount() {
		$this->db->select('amount');
		$this->db->from('user_packages');
        $q = $this->db->get();
        $amt = $q->result();
        $amt = $amt[0]->amount;
        return $amt;
    }
    
     public function insert_payment_details($data, $id) {
        $this->db->where('order_id', $id);
        $this->db->update('user_package_transaction_details', $data);
        return true;
    }
    
    public function add_user_question_no($data) {
        $this->db->insert('user_questions_asked', $data);
    }
    
     public function add_question($data) {
        $this->db->insert('sme_quesns', $data);
        return true;
    }
    
    public function getcalls($id) {
        $today = date('Y-m-d');
        $this->db->select('b.added_on,b.address,bs.date,bs.time_from,bs.time_to,u.name,cp.book_type,b.id,u.name,ud.phone,b.userid');
        $this->db->from('user_sme_book_call b');
        $this->db->join('users u','u.id = b.userid','left');
        $this->db->join('sme_book_slots bs','bs.id = b.smebookcallid','left');
        $this->db->join('user_chat_pay_trans cp','cp.order_id = b.order_id','left');
        $this->db->join('user_details ud','ud.user_id = u.id');
        $this->db->where('b.sme_userid',$id);
        $this->db->where('bs.date >=',$today);
        $this->db->where('b.cancel','n');
        $this->db->order_by('date','desc');
        $query = $this->db->get();
        $results = $query->result();
        
        foreach ($results as $key=>$row){
            $report_array = $this->User->getUserAllSurveyReport($row->userid);
            $results[$key]->report_id = $report_array[0]->id;
        }
        return $query->result();
		
        /*$this->db->select('b.date,b.time,u.name');
        $this->db->from('user_sme_book_call b');
        $this->db->join('users u','u.id = b.userid','left');
        $this->db->where('b.sme_userid',$id);
        $this->db->order_by('date',"desc");
        $q = $this->db->get();
        return $q->result();*/
    }
    
    public function getquestions($data) {
		$this->db->select('sq.*,u.name');
		$this->db->from('sme_quesns sq');
		$this->db->join('users u','u.id = sq.userid','left');
		$this->db->where('sq.sme_userid',$data['smeuserid']);
		$this->db->like('sq.question',$data['question'],'both');
		$this->db->order_by('sq.added_on',"desc");
		$query = $this->db->get();
 
      foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name');
			$this->db->from('sme_quesns_replies c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->where('c.qid',$key->id);
			$this->db->order_by('c.added_on',"asc");
            $q = $this->db->get();
            $key->comments = $q->result();
        }
          return $query->result();
    }


	public function getquestions_reply($id) {
		$this->db->select('sq.id as questionid,sq.question,sq.sme_userid,sq.userid,sq.added_on,u.name,sq.userid,d.image,d.user_id');
		$this->db->from('sme_quesns sq');
		$this->db->join('users u','u.id = sq.userid','left');
		$this->db->join('user_details d','d.user_id = sq.userid','left');
		$this->db->where('sq.id',$id);
        $query = $this->db->get();
        $row = $query->result();
        if(!empty($row)){
			return $row[0];
        }else{
			return $row;
        }
    }
    
    
    public function insert_sme_reply($data) {
        $this->db->insert('sme_quesns_replies', $data);
        return true;
    }
    
  public function save_notes($id,$insertdata) {
		$this->db->where('id',$id);
        $this->db->update('user_sme_book_call', $insertdata);
		
		$this->db->select('smebookcallid');
		$this->db->from('user_sme_book_call');
		$this->db->where('id',$id);
        $id = $this->db->get();
		$id = $id->result();
       
        return $id[0]->smebookcallid;
    }

  public function get_smeidfrom($id) {

		$this->db->select('smebookcallid,sme_userid');
		$this->db->from('user_sme_book_call');
		$this->db->where('id',$id);
        $id = $this->db->get();
		$id = $id->result();
       
        return $id[0]->sme_userid;
    }

	
   public function getarticle_detail($id) {
	   
		$this->db->select('*');
		$this->db->where('publish', "y");
		$this->db->where_not_in('id', $id);
		$this->db->order_by("added_on","desc");
		$query = $this->db->get('sme_articles');
		
		foreach ($query->result() as $key) {
			
            $this->db->select('count(c.id) as count');
			$this->db->from('sme_article_comments c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->where('c.article_id = "' . $key->id . '"');
			$q = $this->db->get();
			$key->comments = $q->result();
			
			$this->db->select('*');
			$this->db->where('article_id',$key->id);
			$this->db->from('sme_article_likes');
			
			$l = $this->db->get();
			
			$this->db->select('*');
			$this->db->where('article_id',$key->id);
			$this->db->from('sme_article_unlikes');
			
			$ul = $this->db->get();
			
			// $l = $this->db->query('select * from sme_fb sf join sme_fb_smeuser_comments sfc on sfc.sme_userid = sf.sme_userid join sme_articles sa on sa.sme_userid = sf.sme_userid where sa.id = "' . $key->id . '" and sf.type ="positive"');
            //$ul = $this->db->query('select * from sme_fb sf join sme_fb_smeuser_comments sfc on sfc.sme_userid = sf.sme_userid join sme_articles sa on sa.sme_userid = sf.sme_userid where sa.id = "' . $key->id . '" and sf.type ="negative"');
            
            $key->likes = $l->result();
            $key->unlikes = $ul->result();
			
			
        }
        $row = $query->result();
        return $row;
    }

	public function getarticle($id,$userid) {
			$this->db->select('s.*,su.first_name,su.last_name');
			$this->db->from('sme_articles s');
			$this->db->join('sme_user_profiles su','su.sme_userid = s.sme_userid','left');
			$this->db->where('s.id',$id);
			$query = $this->db->get();
			
        foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name');
			$this->db->from('sme_article_comments c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->join('user_details up','up.user_id = u.id','left');
			$this->db->where('c.article_id',$key->id);
			$this->db->order_by('c.added_on',"desc");
            $q = $this->db->get();
            $key->comments = $q->result();
       
			$this->db->select('*');
			$this->db->where('article_id',$key->id);
			$this->db->where('userid',$userid);
			$this->db->from('sme_article_likes');
			
			$userlikes = $this->db->get();
			
			if($userlikes->num_rows() > 0)
			{
				$key->liked = 'y';
			}
			else{
				$key->liked = 'n';
			}
			
			$this->db->select('*');
			$this->db->where('article_id',$key->id);
			$this->db->where('userid',$userid);
			$this->db->from('sme_article_unlikes');
			
			$userunlikes = $this->db->get();
			
			if($userunlikes->num_rows() > 0)
			{
				$key->unliked = 'y';
			}
			else{
				$key->unliked = 'n';
			}

	   }
        $res = $query->result();
        return $res[0];
    }
    
    
    
    public function getanswers($id) {
         $this->db->select('sme_quesns.question,sme_quesns.sme_userid,users.name,sme_quesns.added_on,user_details.image,user_details.user_id');
         $this->db->from('sme_quesns');
         $this->db->join('users','sme_quesns.userid = users.id');
		  $this->db->join('user_details','users.id = user_details.user_id');
		$this->db->where('sme_quesns.id',$id);
		$query = $this->db->get(); 
		$row = $query->result();
		 $q = array(); 
		if(!empty($row)){
			$q['question'] = $row[0]; 
			}
			else{
				$q['question'] = $row; 
				}
				
		$this->db->select('sqr.comment,sqr.added_on,u.name,d.image,d.user_id');
         $this->db->from('sme_quesns_replies sqr');
         $this->db->join('users u','sqr.userid = u.id');
		  $this->db->join('user_details d','d.user_id = u.id');
		$this->db->where('sqr.qid',$id);
		$this->db->order_by('sqr.added_on',"desc");
        $query2 = $this->db->get();
        $q['answers'] = $query2->result();
       
        return $q;
     
    }
    
     public function insert_sme_event($data) {
        $this->db->insert('sme_events', $data);
        $insertid = $this->db->insert_id();
        return $insertid;
    }	
    
     public function insert_event_image($data) {
        $this->db->insert('sme_ev_photos', $data);
        return true;
    }	
    
    
    public function insert_sme_article($data) {
        $this->db->insert('sme_articles', $data);
        $insertid = $this->db->insert_id();
        return $insertid;
    }	
    
     public function update_articles_image($data,$id) {
        $this->db->update('sme_articles', $data);
        $this->db->where('id',$id);
        return true;
    }	
	
	
	/* added newly*/
	public function getallarticles($id) {
		$this->db->select('*');
		$this->db->where('sme_userid',$id);
		$this->db->where('publish', "y");
		$this->db->order_by("added_on","desc");
		$query = $this->db->get('sme_articles');
		
		foreach ($query->result() as $key) {
			
            $this->db->select('count(c.id) as count');
			$this->db->from('sme_article_comments c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->where('c.article_id = "' . $key->id . '"');
			$q = $this->db->get();
			$key->comments = $q->result();
			
			// $l = $this->db->query('select * from sme_fb sf join sme_fb_smeuser_comments sfc on sfc.sme_userid = sf.sme_userid join sme_articles sa on sa.sme_userid = sf.sme_userid where sa.id = "' . $key->id . '" and sf.type ="positive"');
           // $ul = $this->db->query('select * from sme_fb sf join sme_fb_smeuser_comments sfc on sfc.sme_userid = sf.sme_userid join sme_articles sa on sa.sme_userid = sf.sme_userid where sa.id = "' . $key->id . '" and sf.type ="negative"');
           
		   $this->db->select('*');
			$this->db->where('article_id',$key->id);
			$this->db->from('sme_article_likes');
			
			$l = $this->db->get();
			
			$this->db->select('*');
			$this->db->where('article_id',$key->id);
			$this->db->from('sme_article_unlikes');
			
			$ul = $this->db->get();


		   
            $key->likes = $l->result();
            $key->unlikes = $ul->result();
        }
        return $query->result();
    }
	
	/*added newly*/
	
	
	public function getfeedbackdata($offset, $limit, $id) {
		$this->db->select('f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on');
        $this->db->from('sme_fb f');
        $this->db->join('users u','u.id = f.userid');
		$this->db->where('f.sme_userid',$id);
		$this->db->order_by('f.added_on','desc');
		$this->db->limit($limit,$offset);
        $query = $this->db->get();
        foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name');
			$this->db->from('sme_fb_comments c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->where('c.fb_id',$key->id);
            $q = $this->db->get();
            $key->comments = $q->result();
        }

        return $query->result();
    }
	
	public function getServices() {
        $status = 'enable';
		$this->db->select('*');
		$this->db->from('services');
        $query = $this->db->get();
        foreach ($query->result() as $key) {
			$this->db->select('round(avg(fb_score)) as rating');
			$this->db->from('sme_fb');
			$this->db->group_by('sme_userid');
            $top_sme = $this->db->get();
            $row = $top_sme->result();
            $key->score = $row[0]->rating;
        }
        foreach ($query->result() as $key) {
			$this->db->select('round(avg(sf.fb_score)) as rating,up.sme_userid,up.first_name,up.last_name,up.photo');
			$this->db->from('sme_user_offerings uo');
			$this->db->join('sme_user_profiles up','up.sme_userid = uo.sme_userid','left');
			$this->db->join('business_services bs','bs.id = uo.offerings_id','left');
			$this->db->join('business_programs bp','bp.id = bs.program_id','left');
			$this->db->join('sme_fb sf','sf.sme_userid = uo.sme_userid','left');
			$this->db->join('sme_users u','u.id = up.sme_userid','left');
			$this->db->where('bp.service_id',$key->id);
			$this->db->where('u.status',$status);
			$this->db->where('u.ranking !=0');
			$this->db->group_by('sme_userid');
			$this->db->order_by('u.ranking','asc');
			$this->db->limit(5);
            $q = $this->db->get();
			
            foreach ($q->result() as $k) {
				$this->db->select('count(*) as count');
				$this->db->from('sme_followers');
				$this->db->where('sme_userid',$k->sme_userid);
                $res = $this->db->get();
                $row = $res->result();
                $k->followers_cnt = $row[0]->count;
            }
            $key->sme_users = $q->result();
        }
        return $query->result();
    }
	
	public function getuserca($user,$smeid)
	{
		$today = date('Y-m-d');
		$this->db->select('b.added_on,b.address,bs.date,bs.time_from,bs.time_to,u.name,cp.book_type');
		$this->db->from('user_sme_book_call b');
		$this->db->join('users u','u.id = b.userid','left');
		$this->db->join('sme_book_slots bs','bs.id = b.smebookcallid','left');
		$this->db->join('user_chat_pay_trans cp','cp.order_id = b.order_id','left');
		$this->db->where('b.sme_userid',$smeid);
		$this->db->where('userid',$user);
		$this->db->where('bs.date >=',$today);
		$this->db->order_by('date','desc');
		$q = $this->db->get();
        return $q->result();
	}
	
	//newly added for new design1
	  public function get_questions($data,$id) {
		$this->db->select('sq.*,u.name,d.image');
		$this->db->from('sme_quesns sq');
		$this->db->join('users u','u.id = sq.userid','left');
		$this->db->join('user_details d','d.user_id = sq.userid','left');
		$this->db->where('sq.sme_userid',$id);
		$this->db->like('sq.question',$data,'both');
		$this->db->order_by('sq.added_on','desc');
        $query = $this->db->get();
       
        foreach ($query->result() as $key) {
			$this->db->select('c.*,u.name');
			$this->db->from('sme_quesns_replies c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->where('c.qid',$key->id);
			$this->db->order_by('c.added_on','asc');
            $q = $this->db->get();
            $key->comments = $q->result();
        }
        return $query->result();
    }
	//newly added for new design1
	public function sort_articles_by_dates($date,$id)
	{
		$this->db->select('*');
		$this->db->where('sme_userid',$id);
		$this->db->like('added_on',$date,'both');
		$this->db->where('publish', "y");
		$this->db->order_by("added_on","desc");
		$query = $this->db->get('sme_articles');
		
		foreach ($query->result() as $key) {
			
            $this->db->select('count(c.id) as count');
			$this->db->from('sme_article_comments c');
			$this->db->join('users u','u.id = c.userid','left');
			$this->db->where('c.article_id = "' . $key->id . '"');
			$q = $this->db->get();
			$key->comments = $q->result();
			
			// $l = $this->db->query('select * from sme_fb sf join sme_fb_smeuser_comments sfc on sfc.sme_userid = sf.sme_userid join sme_articles sa on sa.sme_userid = sf.sme_userid where sa.id = "' . $key->id . '" and sf.type ="positive"');
           // $ul = $this->db->query('select * from sme_fb sf join sme_fb_smeuser_comments sfc on sfc.sme_userid = sf.sme_userid join sme_articles sa on sa.sme_userid = sf.sme_userid where sa.id = "' . $key->id . '" and sf.type ="negative"');
            
			$this->db->select('*');
			$this->db->where('article_id',$key->id);
			$this->db->from('sme_article_likes');
			
			$l = $this->db->get();
			
			$this->db->select('*');
			$this->db->where('article_id',$key->id);
			$this->db->from('sme_article_unlikes');
			
			$ul = $this->db->get();
			
			
            $key->likes = $l->result();
            $key->unlikes = $ul->result();
        }
        return $query->result();
	}
	
	public function getfb_reply($id)
	{
		$this->db->select('*');
		$this->db->from('sme_fb');
		$this->db->where('id',$id);
		$q = $this->db->get();
		$set =  $q->result();
		return $set[0];
	}
	
	public function insert_fb_sme_reply($data)
	{
			$this->db->insert('sme_fb_comments',$data);
	}
	
	 public function sme_follow($userid, $sme_userid) {
        $data = array('sme_userid' => $sme_userid, 'user_id' => $userid);
        $this->db->insert('sme_followers', $data);
		return $this->db->insert_id();
    }
	
	public function removefollow($id) {
        $this->db->where('id', $id);
        $this->db->delete('sme_followers');
    }
	
	public function article_like($ar_id,$userid)
	{
		$data = array('article_id' => $ar_id, 'userid' => $userid);
        $this->db->insert('sme_article_likes', $data);
		return $this->db->insert_id();
	}
	
	public function article_unlike($ar_id,$userid)
	{
		$data = array('article_id' => $ar_id, 'userid' => $userid);
        $this->db->insert('sme_article_unlikes', $data);
		return $this->db->insert_id();
	}
	
	public function add_article_comment($data)
	{
		$this->db->insert('sme_article_comments',$data);
	}
	
	public function getartcomments($offset,$limit,$id)
	{
		$this->db->select('c.*,u.name,d.image');
		$this->db->from('sme_article_comments c');
		$this->db->join('users u','u.id = c.userid','left');
		$this->db->join('user_details d','d.user_id = u.id','left');
		$this->db->where('c.article_id',$id);
		$this->db->order_by('c.added_on',"desc");
		$this->db->limit($limit,$offset);
		$q = $this->db->get();
		return $q->result();
	}
	
	public function searchExpert($search_phrase,$tab)
	{
		$c = $this->session->userdata('country');
		$p = $this->session->userdata('place');
		if($tab == 0)
		{
		
			$this->db->distinct();
			$this->db->select('sme_users.*,sme_user_profiles.*,services.service_name');
			$this->db->from('sme_users');
			$this->db->join('sme_user_profiles', 'sme_user_profiles.sme_userid = sme_users.id');
			$this->db->join('sme_user_offerings', 'sme_user_offerings.sme_userid = sme_users.id');
			$this->db->join('services', 'services.id = sme_user_offerings.offerings_id');
			$this->db->where('sme_users.status', 'enable');
			$this->db->like('sme_user_profiles.first_name', $search_phrase,'both');
			//$this->db->like('sme_user_profiles.city', $p,'both');
			//$this->db->like('sme_user_profiles.country', $c,'both');
			$this->db->order_by('sme_users.ranking', 'desc');
			

			$query = $this->db->get();
			$query_result = $query->result();
			$this->db->last_query();
			$sme_details = array();

			foreach ($query_result as $key => $value) {
				$sme_details[$key]['sme_details'] = $value;

				$this->db->select('sme_fb.*');
				$this->db->from('sme_fb');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$feedback = $this->db->get();
				$feedback_result = $feedback->result();
				$sme_details[$key]['likes'] = $feedback_result;


				$this->db->select('AVG(sme_fb.fb_score) as avg_rating');
				$this->db->from('sme_fb');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$feedback_avg = $this->db->get();
				$feedback_avg_result = $feedback_avg->result();
				$sme_details[$key]['avg_likes'] = $feedback_avg_result[0];




				$this->db->select('sme_fb_comments.*');
				$this->db->from('sme_fb_comments');
				$this->db->join('sme_fb', 'sme_fb.id = sme_fb_comments.fb_id');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$followers = $this->db->get();
				
				 $this->db->select('*');
				$this->db->from('sme_followers');
				$this->db->where('sme_userid', $value->sme_userid);
				$followers = $this->db->get();
				
				$followers_result = $followers->result();
				$sme_details[$key]['followers'] = count($followers_result);
			}
			
			

			
		}
		else{
			
			$this->db->distinct();
			$this->db->select('sme_users.*,sme_user_profiles.*,services.service_name');
			$this->db->from('sme_users');
			$this->db->join('sme_user_profiles', 'sme_user_profiles.sme_userid = sme_users.id');
			$this->db->join('sme_user_offerings', 'sme_user_offerings.sme_userid = sme_users.id');
			$this->db->join('services', 'services.id = sme_user_offerings.offerings_id');
			$this->db->where('sme_user_offerings.offerings_id', $tab);
			$this->db->where('sme_users.status', 'enable');
			//$this->db->like('sme_user_profiles.city', $loc,'both');
			//$this->db->or_like('sme_user_profiles.state', $loc,'both');
			//$this->db->or_like('sme_user_profiles.country', $loc,'both');
			$this->db->like('sme_user_profiles.first_name', $search_phrase,'both');
			//$this->db->like('sme_user_profiles.city', $p,'both');
			//$this->db->like('sme_user_profiles.country', $c,'both');
			$this->db->order_by('sme_users.ranking', 'desc');

			$query = $this->db->get();
			$query_result = $query->result();

			$sme_details = array();

			foreach ($query_result as $key => $value) {
				$sme_details[$key]['sme_details'] = $value;

				$this->db->select('sme_fb.*');
				$this->db->from('sme_fb');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$feedback = $this->db->get();
				$feedback_result = $feedback->result();
				$sme_details[$key]['likes'] = $feedback_result;


				$this->db->select('AVG(sme_fb.fb_score) as avg_rating');
				$this->db->from('sme_fb');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$feedback_avg = $this->db->get();
				$feedback_avg_result = $feedback_avg->result();
				$sme_details[$key]['avg_likes'] = $feedback_avg_result[0];




				$this->db->select('sme_fb_comments.*');
				$this->db->from('sme_fb_comments');
				$this->db->join('sme_fb', 'sme_fb.id = sme_fb_comments.fb_id');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$followers = $this->db->get();
				
				 $this->db->select('*');
				$this->db->from('sme_followers');
				$this->db->where('sme_userid', $value->sme_userid);
				$followers = $this->db->get();
				
				$followers_result = $followers->result();
				$sme_details[$key]['followers'] = count($followers_result);
			}

		}
		
		return $sme_details;
	}
	
	public function searchExpert2($tab)
	{
		$c = $this->session->userdata('country');
		$p = $this->session->userdata('place');
		if($tab == 0)
		{
		
			$this->db->distinct();
			$this->db->select('sme_users.*,sme_user_profiles.*,services.service_name');
			$this->db->from('sme_users');
			$this->db->join('sme_user_profiles', 'sme_user_profiles.sme_userid = sme_users.id');
			$this->db->join('sme_user_offerings', 'sme_user_offerings.sme_userid = sme_users.id');
			$this->db->join('services', 'services.id = sme_user_offerings.offerings_id');
			$this->db->where('sme_users.status', 'enable');
			//$this->db->like('sme_user_profiles.first_name', $search_phrase,'both');
			//$this->db->like('sme_user_profiles.city', $p,'both');
			//$this->db->like('sme_user_profiles.country', $c,'both');
			$this->db->order_by('sme_users.ranking', 'desc');

			$query = $this->db->get();
			$query_result = $query->result();
			$this->db->last_query();
			$sme_details = array();

			foreach ($query_result as $key => $value) {
				$sme_details[$key]['sme_details'] = $value;

				$this->db->select('sme_fb.*');
				$this->db->from('sme_fb');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$feedback = $this->db->get();
				$feedback_result = $feedback->result();
				$sme_details[$key]['likes'] = $feedback_result;


				$this->db->select('AVG(sme_fb.fb_score) as avg_rating');
				$this->db->from('sme_fb');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$feedback_avg = $this->db->get();
				$feedback_avg_result = $feedback_avg->result();
				$sme_details[$key]['avg_likes'] = $feedback_avg_result[0];




				$this->db->select('sme_fb_comments.*');
				$this->db->from('sme_fb_comments');
				$this->db->join('sme_fb', 'sme_fb.id = sme_fb_comments.fb_id');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$followers = $this->db->get();
				
				 $this->db->select('*');
				$this->db->from('sme_followers');
				$this->db->where('sme_userid', $value->sme_userid);
				$followers = $this->db->get();
				
				$followers_result = $followers->result();
				$sme_details[$key]['followers'] = count($followers_result);
			}
			
			

			
		}
		else{
			
			$this->db->distinct();
			$this->db->select('sme_users.*,sme_user_profiles.*,services.service_name');
			$this->db->from('sme_users');
			$this->db->join('sme_user_profiles', 'sme_user_profiles.sme_userid = sme_users.id');
			$this->db->join('sme_user_offerings', 'sme_user_offerings.sme_userid = sme_users.id');
			$this->db->join('services', 'services.id = sme_user_offerings.offerings_id');
			$this->db->where('sme_user_offerings.offerings_id', $tab);
			$this->db->where('sme_users.status', 'enable');
			//$this->db->like('sme_user_profiles.city', $loc,'both');
			//$this->db->or_like('sme_user_profiles.state', $loc,'both');
			//$this->db->or_like('sme_user_profiles.country', $loc,'both');
			//$this->db->like('sme_user_profiles.first_name', $search_phrase,'both');
			//$this->db->like('sme_user_profiles.city', $p,'both');
			//$this->db->like('sme_user_profiles.country', $c,'both');
			$this->db->order_by('sme_users.ranking', 'desc');

			$query = $this->db->get();
			$query_result = $query->result();

			$sme_details = array();

			foreach ($query_result as $key => $value) {
				$sme_details[$key]['sme_details'] = $value;

				$this->db->select('sme_fb.*');
				$this->db->from('sme_fb');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$feedback = $this->db->get();
				$feedback_result = $feedback->result();
				$sme_details[$key]['likes'] = $feedback_result;


				$this->db->select('AVG(sme_fb.fb_score) as avg_rating');
				$this->db->from('sme_fb');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$feedback_avg = $this->db->get();
				$feedback_avg_result = $feedback_avg->result();
				$sme_details[$key]['avg_likes'] = $feedback_avg_result[0];




				$this->db->select('sme_fb_comments.*');
				$this->db->from('sme_fb_comments');
				$this->db->join('sme_fb', 'sme_fb.id = sme_fb_comments.fb_id');
				$this->db->where('sme_fb.sme_userid', $value->sme_userid);
				$followers = $this->db->get();
				
				 $this->db->select('*');
				$this->db->from('sme_followers');
				$this->db->where('sme_userid', $value->sme_userid);
				$followers = $this->db->get();
				
				$followers_result = $followers->result();
				$sme_details[$key]['followers'] = count($followers_result);
			}

		}
		
		return $sme_details;
	}
	
	public function add_expert_slot($slots)
	{
		$this->db->insert('sme_book_slots',$slots);
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function check_expert_slot($smeuserid,$dates,$from,$to)
	{
		$this->db->select('*');
		$this->db->where('sme_userid',$smeuserid);
		$this->db->where('date',$dates);
		$this->db->where('time_from',$from);
		$this->db->where('time_to',$to);
		$this->db->from('sme_book_slots');
		$q = $this->db->get();
		if($q->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function getaddedslots($id)
	{
		$today = date('Y-m-d');
		$this->db->select('date');
		$this->db->from('sme_book_slots');
		$this->db->where('sme_userid',$id);
		$this->db->where('status','available');
		$this->db->where('date >=',$today);
		$this->db->order_by('date',"desc");
		$q = $this->db->get();
		
		return $q->result();
	}
	
	
	
	public function getaddedslots2($id)
	{
		$today = date('Y-m-d');
		$this->db->select('date');
		$this->db->from('sme_book_slots');
		$this->db->where('sme_userid',$id);
		//$this->db->where('status','available');
		$this->db->where('date >=',$today);
		$this->db->order_by('date',"desc");
		$q = $this->db->get();
		
		return $q->result();
	}
	
	public function getblockedslots($id)
	{
		$today = date('Y-m-d');
		$two = array();
		$this->db->select('s.date as dt');
		$this->db->where('s.date >=',$today);
		$this->db->where('s.sme_userid',$id);
		$this->db->order_by('s.date',"desc");
		$this->db->group_by('s.date');
		$this->db->from('sme_book_slots s');
		$all = $this->db->get();
		
		foreach($all->result() as $k=>$v)
		{
			$this->db->select('s.date');
			
			$this->db->where('s.status','blocked');
			$this->db->where('s.sme_userid',$id);
			$this->db->where('s.date',$v->dt);
			
			$this->db->from('sme_book_slots s');
			$r = $this->db->get();
			$ro = $r->result();
			if($r->num_rows() > 0)
			{
				$this->db->select('s.date');
				
				$this->db->where('s.status','available');
				$this->db->where('s.sme_userid',$id);
				$this->db->where('s.date',$v->dt);
				$this->db->from('sme_book_slots s');
				$av = $this->db->get();
				if($av->num_rows() == 0)
				{
					array_push($two,$ro[0]->date);
				}
			}
		}
		
		return $two;
	}
	
	
	public function checkSlot($date,$id)
	{
		$this->db->select('id');
		$this->db->where('date',$date);
		$this->db->where('sme_userid',$id);
		$this->db->from('sme_book_slots');
		
		$q = $this->db->get();
		
		if($q->num_rows() > 0)
		{
			$this->db->where('date',$date);
			$this->db->where('sme_userid',$id);
			$this->db->update('sme_book_slots',array('status' => 'blocked' ));
			
			$this->db->select('u.date,s.date');
			$this->db->from('user_sme_book_call u');
			$this->db->join('sme_book_slots s','u.sme_userid = s.sme_userid','left');
			$this->db->where('u.sme_userid',$id);
			$this->db->where('s.status','blocked');
			$this->db->order_by('u.date',"desc");
			$q = $this->db->get();
		
			//return $q->result();
			return true;
			
		}
		else
		{
			return false;
		}
	}
	
	public function blocksmesSlot($slotid)
	{
		$this->db->where('id',$slotid);
		$this->db->from('sme_book_slots');
		$s = $this->db->get();
		$s = $s->result();
		$status = $s[0]->status;
		if($status == 'blocked')
		{
			$data = array('status'=> 'available');
		}
		else if($status == 'available')
		{
			$data = array('status'=> 'blocked');
		}

		$this->db->where('id',$slotid);
		$this->db->update('sme_book_slots',$data);
		return true;
	}
	
	public function getSlot($date,$id)
	{
		$i=0;
		$this->db->select('id,time_from,time_to,date as sel_date,status');
		$this->db->where('date',$date);
		$this->db->where('sme_userid',$id);
		//$this->db->where('status','available');
		$this->db->from('sme_book_slots');
		$q = $this->db->get();
		
		foreach($q->result() as $r)
		{
			$this->db->select('id');
			$this->db->where('smebookcallid',$r->id);
			$this->db->where('cancel','n');
			$this->db->from('user_sme_book_call');
			$s = $this->db->get();
			$ss = $s->result();
			if($s->num_rows() > 0)
			{
				$r->status = 'booked';
				$r->booked_id = $ss[0]->id;
			}
			
			
			$this->db->select('id');
			$this->db->where('smebookcallid',$r->id);
			$this->db->where('cancel','y');
			$this->db->from('user_sme_book_call');
			$s2 = $this->db->get();
			$ss2 = $s->result();
			if($s2->num_rows() > 0)
			{
				$r->show = 'no';
				
			}
			else{
				$r->show = 'yes';
			}
			
			
			if($r->status == 'available')
			{
				$i++;
			}
			$r->available = $i;
		}
		
		if($q->num_rows() > 0)
		{
			return $q->result();
		}
		else
		{
			return false;
		}
	}
	
		public function getSlot2($date,$id)
	{
		$i=0;
		$this->db->select('id,time_from,time_to,date as sel_date,status');
		$this->db->where('date',$date);
		$this->db->where('sme_userid',$id);
		$this->db->where('status','available');
		$this->db->from('sme_book_slots');
		$q = $this->db->get();
		
		
		
		if($q->num_rows() > 0)
		{
			return $q->result();
		}
		else
		{
			return false;
		}
	}
	
	public function getUserEmail($id)
	{
		$this->db->select('u.username,u.name');
		$this->db->where('u.id',$id);
		$this->db->from('users u');
		$q = $this->db->get();
		$r = $q->result();
		return $r[0];
	}
	
	public function getSmeEmail($id)
	{
		$this->db->select('u.username,d.first_name,d.last_name');
		$this->db->where('u.id',$id);
		$this->db->from('sme_users u');
		$this->db->join('sme_user_profiles d','u.id = d.sme_userid','left');
		$q = $this->db->get();
		$r = $q->result();
		return $r[0];
	}
	
	public function getpayPacakges()
	{
		$this->db->select('*');
		$this->db->from('sme_chat_payment');
		$q = $this->db->get();
		return $q->result();
	}
	
	 public function insert_call_payment_details($data, $id) {
        $this->db->where('order_id', $id);
        $this->db->update('user_chat_pay_trans', $data);
        return true;
    }
    
    public function checkvacdates($date,$id)
    {
		$q = $this->db->query('select * from sme_user_profiles where sme_userid = "'.$id.'" and  '.$date.'  BETWEEN vac_start_date and vac_end_date');  
		if($q->num_rows() > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function checkCoupon($coupon,$userid,$new_amt)
	{
		$today = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('gift_cards');
		$this->db->where('gift_card_id',$coupon);
		$this->db->where('expiry_date >=', $today);
		$q = $this->db->get();
		$r = $q->result();
		$amount = $r[0]->amount;
		$id = $r[0]->id;
		
		if($q->num_rows() > 0)
		{
			$this->db->select('sum(amount) as used_amount');
			$this->db->from('gift_card_users');
			$this->db->where('gift_id',$id);
			$this->db->group_by('gift_id');
			$g = $this->db->get();
			if($g->num_rows() > 0)
			{
				$o = $g->result();
				$used_amount = $o[0]->used_amount;
				if($used_amount < $amount)
				{
					$rem_amt = $amount - $used_amount;
					if($rem_amt !=0)
					{
						$new_rem_amt = abs($rem_amt - $new_amt); 
						$array = array('user_id' => $userid, 'amount' => $rem_amt,'gift_id' => $id );
						$this->db->insert('gift_card_users',$array);
						return $rem_amt;
					}
					else
					{
						return false;
					}
					
				}
			}
			else
			{
				if($new_amt > $amount)
				{
					$inser_amt = $amount;
				}
				else
				{
					$inser_amt = $new_amt;
				}
				
				$array = array('user_id' => $userid, 'amount' => $inser_amt,'gift_id' => $id );
				$this->db->insert('gift_card_users',$array);
				return $amount;
			}	
		}
		else{
			return false;
		}
	}
	
	public function getChatPayments()
	{
		$this->db->select('name,amount');
		$this->db->from('sme_chat_payment');
		$q = $this->db->get();
		
		return $q->result();
	}
	
	public function getBookeddate($id)
	{
		$this->db->select('date');
		$this->db->where('id',$id);
		$this->db->from('sme_book_slots');
		$q = $this->db->get();
		$r = $q->result();
		return $r[0]->date;
	}
	
	public function getBookedtimefrom($id)
	{
		$this->db->select('time_from');
		$this->db->where('id',$id);
		$this->db->from('sme_book_slots');
		$q = $this->db->get();
		$r = $q->result();
		return $r[0]->time_from;
	}
	
	public function getBookedtimeto($id)
	{
		$this->db->select('time_to');
		$this->db->where('id',$id);
		$this->db->from('sme_book_slots');
		$q = $this->db->get();
		$r = $q->result();
		return $r[0]->time_to;
	}
	
	public function updatebooked($id)
	{
		$this->db->where('id',$id);
		$this->db->update('sme_book_slots',array('status' => 'blocked'));
	}
	
	public function checkChatSchedule($id)
	{
		$today = date('Y-m-d');
		$this->db->select('s.id,sb.date,sb.time_from,sb.time_to,s.video_link,cp.book_type,s.userid');
		$this->db->from('user_sme_book_call s');
		$this->db->join('sme_book_slots sb','sb.id = s.smebookcallid','left');
		$this->db->join('user_chat_pay_trans cp','cp.order_id = s.order_id','left');
		$this->db->where('s.sme_userid',$id);
		$this->db->where('sb.status =','blocked');
		$this->db->where('sb.date',$today);
		$q = $this->db->get();
		
		

		if($q->num_rows() > 0)
		{
			return $q->result();
		}
		else
		{
			return false;
		}
	}
	
	public function update_session_link($id,$link)
	{
		$this->db->select('video_link');
		$this->db->where('id',$id);
		$this->db->from('user_sme_book_call');
		$q = $this->db->get();
		$r = $q->result();
		if($r[0]->video_link == '')
		{
			$this->db->where('id',$id);
			$this->db->update('user_sme_book_call',array('video_link' => $link));
			
		}
		else
		{
			$link = $r[0]->video_link;
		}
		
		return $link;
	}
	
	public function getSMEuserid($id)
	{
		$this->db->select('sme_userid');
		$this->db->from('user_sme_book_call');
		$this->db->where('id',$id);
		$q = $this->db->get();
		$r = $q->result();
		
		return $r[0]->sme_userid;
	}
	
	public function reschedule_call($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('user_sme_book_call',$data);
	}
	
	
	public function getBookedtype($id)
	{
		$this->db->select('u.book_type');
		$this->db->where('s.id',$id);
		$this->db->from('user_sme_book_call s');
		$this->db->join('user_chat_pay_trans u','u.order_id = s.order_id','left');
		$q = $this->db->get();
		$r = $q->result();
		return $r[0]->book_type; 
	}
	
	public function getBookedid($id)
	{
		$this->db->select('smebookcallid');
		$this->db->where('id',$id);
		$this->db->from('user_sme_book_call');
		$q = $this->db->get();
		$r = $q->result();
		return $r[0]->smebookcallid;
	}
	
	public function getBookedsmeid($id)
	{
		$this->db->select('sme_userid');
		$this->db->where('id',$id);
		$this->db->from('user_sme_book_call');
		$q = $this->db->get();
		$r = $q->result();
		return $r[0]->sme_userid;
	}
	
	public function removeavail($id)
	{
		$this->db->where('id',$id);
		$this->db->update('sme_book_slots',array('status' => 'blocked' ));
	}
	
	public function removeBlocked($id)
	{
		$this->db->where('id',$id);
		$this->db->update('sme_book_slots',array('status' => 'available' ));
	}
	
	public function getTodaySessions()
	{
		$today = date('Y-m-d');
		date_default_timezone_set("Asia/Kolkata"); 
		$currentime = date('h:i A'); 
		$this->db->select('u.*,s.*,su.phone as sme_phone,us.phone as user_phone,uc.book_type,usr.username,usr.name,u.sme_userid');
		$this->db->from('user_sme_book_call u');
		$this->db->join('sme_book_slots s','s.id = u.smebookcallid','left');
		$this->db->join('sme_user_profiles su','su.sme_userid = u.sme_userid','left');
		$this->db->join('user_details us','us.user_id = u.userid','left');
		$this->db->join('users usr','usr.id = u.userid','left');
		$this->db->join('user_chat_pay_trans uc','uc.order_id = u.order_id','left');
		$this->db->where('s.date',$today);
		$sessions = $this->db->get();
		
		if($sessions->num_rows() > 0)
		{
			foreach($sessions->result() as $key => $value)
			{
				
				$time_from = strtotime($value->time_from);
				$minutes = $time_from - strtotime($currentime);
				$time_to = strtotime($value->time_to);
				$spent = strtotime($currentime) - $time_to;
				$diff = abs($minutes); 
				$diff2 = abs($spent); 
				$thirtymins = $time_to + 1800;
				
				if(($diff <= 600 && $time_to > strtotime($currentime) && strtotime($currentime) < $time_from))
				{
					$messgae_to = '+91' . $value->sme_phone;
					$sms_content = 'Hello You have a Live session starting in next 10 minutes. Please Login to Zinguplife.com and go to dashboard to Start/Join Session.';

					$this->Mailing->send_sms($messgae_to, $sms_content);
					
					$messgae_to = '+91' . $value->user_phone;
					$sms_content = 'Hello You have a Live session starting in next 10 minutes. Please Login to Zinguplife.com and go to dashboard to Start/Join Session.';

					$this->Mailing->send_sms($messgae_to, $sms_content);
				}
				
				if(strtotime($currentime) > $time_to &&  $diff2 >= 1800)
				{
					$to = $value->username;
					$from = "Zinguplife<info@zinuplife.com>";
					$registration_mail_subject = "Adding Review/Rating for Expert";
					$data['name'] = $value->name;
					$data['sme_userid'] = $value->sme_userid;
					$review_reminder = $this->load->view('emails/sme_review_reminder', $data, true);
					
					$registration_message = $review_reminder;
        	
					$this->Mailing->send_mail($to, $from, $registration_mail_subject, $registration_message);
				}
				
			
			}
		}
	}
	
	public function getCalldetails($id)
	{
		$this->db->select('u.*,s.*,s.date as s_date,su.photo,su.first_name,su.phone as sme_phone,us.phone as user_phone,uc.book_type,usr.username,usr.name,u.sme_userid');
		$this->db->from('user_sme_book_call u');
		$this->db->join('sme_book_slots s','s.id = u.smebookcallid','left');
		$this->db->join('sme_user_profiles su','su.sme_userid = u.sme_userid','left');
		$this->db->join('user_details us','us.user_id = u.userid','left');
		$this->db->join('users usr','usr.id = u.userid','left');
		$this->db->join('user_chat_pay_trans uc','uc.order_id = u.order_id','left');
		$this->db->where('u.id',$id);
		$q = $this->db->get();
		$r = $q->result();
		return $r[0];
	}
	
	public function user_profile_username($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('sme_users',$data);
	}

	/**
	 * Get all expertise of a SME user
	 * @param unknown $id
	 */
	public function get_all_expertise_for_user($id) {
	
		$query = $this->db->query('SELECT A.expertise_desc from expertise_master A, sme_expertise_rel B WHERE A.expertise_id=B.expertise_id AND B.sme_user_id= "' . $id . '"');
	
	
		return  $query->result();
	
	}
	
	//newly added for new design
	public function delete_event($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('sme_events');
	}
	
	public function getExpertSlots($id)
	{
		$today = strtotime(date('Y-m-d'));
		$t = date('Y-m-d');
		
		$days = array();
		$this->db->select('date,DAYNAME(date) as day,time_from,time_to');
		$this->db->from('sme_book_slots');
		$this->db->where('sme_userid',$id);
		$this->db->where('date >',$t);
		$this->db->where('time_from !=','');
		$this->db->where('time_to !=','');

		$dates = $this->db->get();
		$dates = $dates->result();
		$days = array();
		$montimes = array();
		$tuetimes = array();
		$wedtimes = array();
		$thutimes = array();
		$fritimes = array();
		$sattimes = array();
		$suntimes = array();
		foreach($dates as $d)
		{
			if($d->day == 'Monday')
			{
				$times = $d->time_from;
				$t = $d->time_to;
				$total = $d->day . '+' .$times . '-' . $t;
				array_push($montimes,$total);
			}
			else if($d->day == 'Tuesday')
			{
				$times = $d->time_from;
				$t = $d->time_to;
				$total = $d->day . '+' .$times . '-' . $t;
				array_push($tuetimes,$total);
			}
			else if($d->day == 'Wednesday')
			{
				$times = $d->time_from;
				$t = $d->time_to;
				$total = $d->day . '+' .$times . '-' . $t;
				array_push($wedtimes,$total);
			}
			else if($d->day == 'Thursday')
			{
				$times = $d->time_from;
				$t = $d->time_to;
				$total = $d->day . '+' .$times . '-' . $t;
				array_push($thutimes,$total);
			}
			else if($d->day == 'Friday')
			{
				$times = $d->time_from;
				$t = $d->time_to;
				$total = $d->day . '+' .$times . '-' . $t;
				array_push($fritimes,$total);
			}
			else if($d->day == 'Saturday')
			{
				$times = $d->time_from;
				$t = $d->time_to;
				$total = $d->day . '+' .$times . '-' . $t;
				array_push($sattimes,$total);
			}
			else if($d->day == 'Sunday')
			{
				$times = $d->time_from;
				$t = $d->time_to;
				$total = $d->day . '+' . $times . '-' . $t;
				array_push($suntimes,$total);
			}
		}
		
		$montimes = array_unique($montimes);
		$tuetimes = array_unique($tuetimes);
		$wedtimes = array_unique($wedtimes);
		$thutimes = array_unique($thutimes);
		$fritimes = array_unique($fritimes);
		$sattimes = array_unique($sattimes);
		$suntimes = array_unique($suntimes);
		
		array_push($days,$montimes);
		array_push($days,$tuetimes);
		array_push($days,$wedtimes);
		array_push($days,$thutimes);
		array_push($days,$fritimes);
		array_push($days,$sattimes);
		array_push($days,$suntimes);
		
		return $days;
		
		//echo '<pre>';
		//print_r($days);  
		//exit();
		
	}
	
	public function cancel_booked_call($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('user_sme_book_call',$data);
		
		$this->db->select('*');
		$this->db->from('user_sme_book_call');
		$this->db->where('id',$id);
		$res = $this->db->get();
		return $res->result();
		
		
	}
	
	public function getSMename($id)
	{
		$this->db->select('s.*,u.*');
		$this->db->from('sme_users s');
		$this->db->join('sme_user_profiles u','u.sme_userid = s.id','left');
		$this->db->where('s.id',$id);
		$n = $this->db->get();
		$n = $n->result();
		return $n;
	}
	
	public function getAppDetails($id)
	{
		$this->db->select('s.*,us.name as user_name,us.username as user_email,d.phone as phone');
		$this->db->from('user_sme_book_call u');
		$this->db->join('sme_book_slots s','u.smebookcallid = s.id','left');
		$this->db->join('users us','us.id = u.userid','left');
		$this->db->join('user_details d','d.user_id = u.id','left');
		$this->db->where('u.id',$id);
		$n = $this->db->get();
		$n = $n->result();
		return $n;
	}
	
	public function create_pay_order2($array) {
       $this->db->insert('user_chat_pay_trans', $array);
    }
	
	public function add_user_book_call($arr)
	{
		$this->db->insert('user_sme_book_call', $arr);
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function checkprevDues($smeid,$userid)
	{
		$this->db->select('*');
		$this->db->from('user_sme_book_call s');
		$this->db->join('user_chat_pay_trans t','t.order_id = s.order_id','left');
		$this->db->where('s.sme_userid',$smeid);
		$this->db->where('s.userid',$userid);
		$this->db->where('t.pay_status !=','free'); 
		$this->db->order_by('t.added_on','desc');
		$n = $this->db->get();
		$n = $n->result();
		
		if(((int)$n[0]->amount - (int)$n[0]->amount_paid) == 0)
		{
			return true;
		}
		else
		{
			
			return false;
		}
	}
	
	public function getlivesessionde($smeid,$userid)
	{
		$this->db->select('*');
		$this->db->from('user_sme_book_call s');
		$this->db->join('user_chat_pay_trans t','t.order_id = s.order_id','left');
		$this->db->where('s.sme_userid',$smeid);
		$this->db->where('s.userid',$userid);
		$this->db->order_by('t.added_on','desc');
		$n = $this->db->get();
		$n = $n->result();
		
		return $n[0];
	}
	
	
	public function changesmestatus($bid,$ar)
	{
		$this->db->where('id',$bid);
		$this->db->update('sme_book_slots',$ar);
	}
	
	public function update_create_pay_order2($ar,$id)
	{
		$this->db->where('order_id',$id);
		$this->db->update('user_chat_pay_trans',$ar);
	}
	
	public function update_rating($smebookcallid,$ar)
	{
		$this->db->where('smebookcallid',$smebookcallid);
		$this->db->update('user_sme_book_call',$ar);
	}
	
	public function add_chat($data)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->db->insert('chat_main',$data);
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function closechat($chatid,$ar2)
	{
		$this->db->where('id',$chatid);
		$this->db->update('chat_main',$ar2);
	}
	
	public function closechatsme($smeuserid,$ar2)
	{
		$this->db->where('sme_id',$smeuserid);
		$this->db->update('chat_main',$ar2);
	}
	
	public function checkChat($id,$last_id = NULL,$smeid,$type)
	{
		 
		if($type == 'user')
		{
			$this->db->select('*');
			$this->db->from('chat_main');
			$this->db->where('status','ongoing');
			$this->db->where('user_id',$id);
			$this->db->where('sme_id',$smeid);
			$n = $this->db->get();
		}
		else
		{
			$this->db->select('*');
			$this->db->from('chat_main');
			$this->db->where('status','ongoing');
			$this->db->where('sme_id',$smeid);
			$n = $this->db->get();
		}
		
		foreach($n->result() as $key)
		{
			//date_default_timezone_set('Asia/Kolkata');
			$this->db->select('c.*,TIME_FORMAT(c.added_on, "%h:%i:%s %p" ) as timesss');
			$this->db->from('chat_messages c');
			$this->db->where('c.chat_id',$key->id);
			$this->db->where('c.id >',$last_id);
			$this->db->order_by('c.added_on','asc');
			$q = $this->db->get();
			
			
			foreach($q->result() as $k)
			{
				
				$k->times = $k->timesss;
				if($k->user_type == 'user')
				{
					$this->db->select('name');
					$this->db->from('users');
					$this->db->where('id',$k->user_id);
					$u = $this->db->get();
					$u = $u->result();
					$k->name = $u[0]->name;
				}
				else{
					$this->db->select('name');
					$this->db->from('sme_users');
					$this->db->where('id',$k->user_id);
					$u = $this->db->get();
					$u = $u->result();
					$k->name = $u[0]->name;
				}
			}
			
		
			$key->messages = $q->result();
		}
		return $n->result();
	}
	
	
	public function addChat($arr,$id)
	{
		$this->db->select('*');
		$this->db->from('chat_main');
		$this->db->where('id',$id);
		$this->db->where('status','ongoing');
        $id = $this->db->get();
		if($id->num_rows() > 0)
		{
			$this->db->insert('chat_messages',$arr);
			$id = $this->db->insert_id();
			return $id;
		}
	}
	
	public function updateChat($a,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('chat_main',$a);
	}
	
	public function getbookedidfr($id)
	{
		$this->db->select('smebookcallid');
		$this->db->from('user_sme_book_call');
		$this->db->where('id',$id);
        $id = $this->db->get();
		$id = $id->result();
       
        return $id[0]->smebookcallid;
	}
	
	public function getConsultationHistory($id)
	{
		$this->db->select('us.id,s.date,s.time_from,s.time_to,us.sme_notes,u.name');
		$this->db->from('user_sme_book_call us');
		$this->db->join('sme_book_slots s','us.smebookcallid = s.id','left');
		$this->db->join('users u','u.id = us.userid','left');
		$this->db->where('us.sme_userid',$id);
		$this->db->where('s.status','closed');
		$c = $this->db->get();
		return $c->result();
	}
	
	public function getPaymentHistory($id)
	{
		$this->db->select('t.pay_status,t.amount,t.amount_paid,u.name');
		$this->db->from('user_sme_book_call us');
		$this->db->join('user_chat_pay_trans t','us.order_id = t.order_id','left');
		$this->db->join('sme_book_slots s','us.smebookcallid = s.id','left');
		$this->db->join('users u','u.id = us.userid','left');
		$this->db->where('us.sme_userid',$id);
		$this->db->where('s.status','closed');
		$c = $this->db->get();
		return $c->result();
	}
	
	public function getuserbookedslots($id)
	{
		$today = date('Y-m-d');
		$this->db->select('s.date');
		$this->db->from('user_sme_book_call u');
		$this->db->join('sme_book_slots s','s.id = u.smebookcallid','left');
		$this->db->where('u.sme_userid',$id);
		$this->db->where('s.date >',$today);
		$dates = $this->db->get();
		
		return $dates->result();
		
	}
	
	public function checkUserReg($email)
	{
		$this->db->select('s.id,s.name,u.gender');
		$this->db->from('users s');
		$this->db->join('user_details u','u.user_id = s.id','left');
		$this->db->where('s.username',$email);
		$c = $this->db->get();
		$co = $c->result();

		if($c->num_rows() > 0)
		{
			return $co[0];
		}
		else
		{
			return false;
		}
	}
	
	public function create_new_user($email,$name,$gender,$password)
	{
		$array = array('username'=>$email,'password'=>$password,'name'=>$name,'status'=> 'Active');
		
		$this->db->insert('users',$array);
		$id = $this->db->insert_id();
		
		$d = array('gender'=>$gender,'user_id'=>$id);
		$this->db->insert('user_details',$d);
		
		return $id;
	}
	
	public function booksmeuser($b,$slot_id)
	{
		$this->db->where('id',$id);
		$this->db->update('sme_book_slots',$b);
	}
	
	public function create_userpay_order($pay)
	{
		$this->db->insert('user_chat_pay_trans',$pay);
	}
	
	public function create_smebook($sme_book)
	{
		$this->db->insert('user_sme_book_call',$sme_book);
	}
	
	public function b_det($slot_id)
	{
		$this->db->select('*');
		$this->db->from('sme_book_slots');
		$this->db->where('id',$slot_id);
		$r = $this->db->get();
		$r = $r->result();
		return $r[0]; 
	}
	
	public function getSessionAmount($id)
	{
		$this->db->select('c.amount,s.smebookcallid,c.order_id,c.book_type,s.sme_userid');
		$this->db->from('user_sme_book_call s');
		$this->db->join('user_chat_pay_trans c','c.order_id = s.order_id','left');
		$this->db->where('s.id',$id);
		$r = $this->db->get();
		$r = $r->result();
		return $r[0]; 
	}
	
	public function checkPaid($id)
	{
		$this->db->select('transaction_status');
		$this->db->from('user_chat_pay_trans');
		$this->db->where('order_id',$id);
		$r = $this->db->get();
		$r = $r->result();
		if($r[0]->transaction_status == 'Success')
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
public function expertsignin($username,$password) {
        $expert_login_status = 0;
        $this->load->library('PasswordHash');
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $actualPassword = $this->sme_user->getpassword($username);
            if ($actualPassword != false) {
                $res = $hasher->CheckPassword($password, $actualPassword);
                if ($res == true) {
                    $user_details = $this->sme_user->getalldetails($username);
                    $login_data = array('active' => 'y');
                    $this->sme_user->update_smeuser_table($login_data,  $user_details->id);
                    $this->session->set_userdata(array(
                        'sme_userid' => $user_details->id,
                        'first_name' => $user_details->first_name,
                        'last_name' => $user_details->last_name,
                        'username' => $user_details->username,
                        'photo' => $user_details->photo,
                        'type' => 'sme',
                        'header_image' => $user_details->header_image,
                        'is_logged_in' => true
                    ));
                    $login_data = array(
                        'active' => 'y'
                    );
                    $smeuser_id = $this->sme_user->update_smeuser_table($login_data, $user_details->id);
                    redirect('experts/dashboard');
                } else {
                    return $expert_login_status;
                }
            } else {
                return $expert_login_status;
            }
    }
	public function getState($state){
		$this->db->select('state_name');
		$this->db->from('state');
		$this->db->where('id',$state);
		$r = $this->db->get();
		$r = $r->result();
		
		//$query = $this->db->query('select country_name from country where id='.$country);
		
		return $r[0];
	}
	public function getCity($city){
		$this->db->select('city_name');
		$this->db->from('city');
		$this->db->where('id',$city);
		$r = $this->db->get();
		$r = $r->result();
		
		//$query = $this->db->query('select country_name from country where id='.$country);
		
		return $r[0];
	}
	public function sme_service_update($service_data, $smeuser_id){
	    $this->db->where('sme_userid',$smeuser_id);
	    $this->db->update('sme_user_offerings',$service_data);
	}
	
	public function getprofile2($sme_id) {
		$this->db->select('su.id as sme_id,sup.photo,sup.first_name,sup.last_name,sup.address,sup.phone,sup.about,sup.expertise,sup.cert_edu,sup.chat_pricing,sup.video_pricing,sup.audio_pricing,sup.inperson_pricing');
		$this->db->from('sme_users su');
		$this->db->join('sme_user_profiles sup','su.id = sup.sme_userid','left');
		$this->db->where('su.id',$sme_id);
		$query = $this->db->get();
		$results = $query->result();
		if($results[0]->photo=="" || $results[0]->photo==null){
			$results[0]->photo="";
		}else{
			$results[0]->photo = base_url()."sme_users/".$results[0]->sme_id."/".$results[0]->photo;
		}
		foreach ($results as $result){
			$this->db->select('bd.logo,bd.id as business_provider_id');
			$this->db->from('business_details bd');
			$this->db->join('sme_provider_relationship spr','bd.id = spr.provider_id','left');
			$this->db->where('spr.sme_id',$result->sme_id);
			$this->db->group_by(['spr.sme_id','spr.provider_id']);
			$query = $this->db->get();
			$answers=$query->result();
			foreach ($answers as $answer){
				if($answer->logo=="" || $answer->logo==null){
					$answer->logo="";
					$result->business_provider_details[]=$answer;
				}else{
					$answer->logo=base_url()."assets/uploads/business_providers/logo/".$answer->business_provider_id."/".$answer->logo;
					$result->business_provider_details[]=$answer;
				}
			}	
		}
		return $results;
	}
}
