<?php

class Sme_user extends CI_Model {

    public function user_register($data) {
        $this->db->insert('sme_users', $data);
        $userid = $this->db->insert_id();
        return $userid;
    }

    public function user_profile($data) {
        $this->db->insert('sme_user_profiles', $data);
        return true;
    }

    public function user_profile_update($data, $id) {
        $this->db->where('sme_userid', $id);
        $this->db->update('sme_user_profiles', $data);
        return true;
    }

    public function getpassword($username) {
        $result = $this->db->query('select password from sme_users where username="' . $username . '"');
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
                return $row->password;
            }
        } else {
            return false;
        }
    }

    public function getalldetails($username) {
        $query = $this->db->query('select p.phone,p.address,p.callback_time,p.vac_start_date,p.vac_end_date,p.about,p.expertise,p.header_image,p.gender,p.dob,u.username,p.first_name,p.last_name,p.photo,u.id from sme_users u left join sme_user_profiles p on p.sme_userid = u.id where u.username="' . $username . '"');
        $res = $query->result();  // this returns an object of all results
        $row = $res[0];
        return $row;
    }

    public function getfollowerscount($sme_userid) {
        $query = $this->db->query('select count(id) as count from sme_followers where sme_userid = "' . $sme_userid . '"');
        $res = $query->result();  // this returns an object of all results
        $row = $res[0];
        return $row->count;
    }

    public function getallfollowers($sme_userid) {
        $query = $this->db->query('select u.name,u.username,d.state,d.city,d.country,d.gender,d.age,u.id from sme_followers f left join users u on u.id = f.user_id left join user_details d on d.user_id = u.id where f.sme_userid = "' . $sme_userid . '"');
        return $query->result();
    }

    public function add_msg($msgs) {
        $this->db->insert('sme_messages', $msgs);
        $msgid = $this->db->insert_id('');
        return $msgid;
    }

    public function add_msgstatus($data) {
        $this->db->insert('sme_msg_status', $data);
        return true;
    }

    public function check_mail($email) {
        $query = $this->db->query('select username from sme_users where username="' . $email . '"');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function save_random_string($useremail, $data) {
        $this->db->where('username', $useremail);
        $this->db->update('sme_users', $data);
    }

    public function check_random($string) {
        $query = $this->db->query('select id from sme_users where reset_string="' . $string . '"');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->id;
            }
        } else {
            return false;
        }
    }

    public function get_datetime($string) {
        $query = $this->db->query('select reset_time from sme_users where reset_string="' . $string . '"');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->reset_time;
            }
        } else {
            return false;
        }
    }

    public function update_password($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sme_users', $data);
    }

    public function getallfeedback($id) {
        $query = $this->db->query('select f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on,fr.response,fr.added_on as res_added from sme_fb f left join users u on u.id = f.userid left join sme_fb_response fr on fr.fb_id = f.id where f.sme_userid ="' . $id . '" order by f.added_on desc');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_fb_comments c left join users u on u.id = c.userid where c.fb_id = "' . $key->id . '" order by c.added_on asc');
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function getallposfeedback($id) {
        $query = $this->db->query('select f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on,fr.response,fr.added_on as res_added from sme_fb f left join users u on u.id = f.userid left join sme_fb_response fr on fr.fb_id = f.id where f.sme_userid ="' . $id . '" and f.type="positive" order by f.fb_score desc');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_fb_comments c left join users u on u.id = c.userid where c.fb_id = "' . $key->id . '" order by c.added_on asc');
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function getallneufeedback($id) {
        $query = $this->db->query('select f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on,fr.response,fr.added_on as res_added from sme_fb f left join users u on u.id = f.userid left join sme_fb_response fr on fr.fb_id = f.id where f.sme_userid ="' . $id . '" and f.type="neutral" order by f.fb_score desc');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_fb_comments c left join users u on u.id = c.userid where c.fb_id = "' . $key->id . '" order by c.added_on asc');
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function getallnegfeedback($id) {
        $query = $this->db->query('select f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on,fr.response,fr.added_on as res_added from sme_fb f left join users u on u.id = f.userid left join sme_fb_response fr on fr.fb_id = f.id where f.sme_userid ="' . $id . '" and f.type="negative" order by f.fb_score desc');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_fb_comments c left join users u on u.id = c.userid where c.fb_id = "' . $key->id . '" order by c.added_on asc');
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function add_feedback($data) {
        $this->db->insert('sme_fb_response', $data);
    }

    public function getallquestions($id) {
        $query = $this->db->query('select sq.*,u.name from sme_quesns sq left join users u on u.id = sq.userid  where sq.sme_userid ="' . $id . '" order by sq.added_on desc');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_quesns_replies c left join users u on u.id = c.userid where c.qid = "' . $key->id . '" order by c.added_on asc');
            $key->comments = $q->result();
        }
        return $query->result();
    }

    public function getallansquestions($id) {
        $query = $this->db->query('select q.question,q.answer,q.id,u.name,q.added_on from sme_quesns q left join users u on u.id = q.userid  where sme_userid ="' . $id . '" and answer != " " order by q.added_on desc');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_quesns_replies c left join users u on u.id = c.userid where c.qid = "' . $key->id . '" order by c.added_on asc');
            $key->comments = $q->result();
        }
        return $query->result();
    }

    public function getallunansquestions($id) {
        $query = $this->db->query('select q.question,q.answer,q.id,u.name,q.userid,q.added_on from sme_quesns q left join users u on u.id = q.userid  where q.sme_userid ="' . $id . '" and q.answer = " "  order by q.added_on desc');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_quesns_replies c left join users u on u.id = c.userid where c.qid = "' . $key->id . '" order by c.added_on asc');
            $key->comments = $q->result();
        }
        return $query->result();
    }

    public function add_ans($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sme_quesns', $data);
    }

    public function getuser($uid, $qid) {
        $query = $this->db->query('select * from users u left join sme_quesns q on q.userid = u.id where u.id="' . $uid . '" and q.id = "' . $qid . '"');
        $res = $query->result();  // this returns an object of all results
        $row = $res[0];
        return $row;
    }

    public function getquestiondetail($qid) {
        $query = $this->db->query('select q.question,up.first_name,up.last_name,q.question,u.username,u.name,s.username as smeuser from sme_quesns q left join users u on u.id = q.userid left join sme_users s on s.id = q.sme_userid left join sme_user_profiles up on up.sme_userid = s.id where q.id = "' . $qid . '"');
        $res = $query->result();  // this returns an object of all results
        $row = $res[0];
        return $row;
    }

    public function getallarticles($id) {
        $query = $this->db->query('select * from sme_articles where sme_userid = "' . $id . '" and publish ="y" order by added_on desc');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select count(c.id) as count from sme_article_comments c left join users u on u.id = c.userid where c.article_id = "' . $key->id . '"');
            $key->comments = $q->result();
        }
        return $query->result();
    }

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
        $query = $this->db->query('select * from sme_events where sme_userid = "' . $id . '" order by date desc');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select * from sme_ev_photos where main_image = "y" and ev_id = "' . $key->id . '"');
            $key->photo = $q->result();
        }
        return $query->result();
    }

    public function getevent($id) {
        $query = $this->db->query('select * from sme_events where id = "' . $id . '"');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select * from sme_ev_photos where ev_id = "' . $key->id . '"');
            $key->photos = $q->result();
        }
        $res = $query->result();
        return $res[0];
    }

    public function update_event($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('sme_events', $data);
    }

    public function add_event($data) {
        $this->db->insert('sme_events', $data);
        $id = $this->db->insert_id('');
        return $id;
    }

    public function delete_event($id) {
        $this->db->where('id', $id);
        $this->db->delete('sme_events');

        $this->db->where('ev_id', $id);
        $this->db->delete('sme_ev_photos');
    }

    public function delete_article($id) {
        $this->db->where('id', $id);
        $this->db->delete('sme_articles');
    }

    public function add_event_image($data) {
        $this->db->insert('sme_ev_photos', $data);
        return true;
    }

    public function geteventimages($id) {
        $query = $this->db->query('select * from sme_ev_photos where ev_id = "' . $id . '"');
        return $query->result();
    }

    public function delete_ev_image($id) {
        $this->db->where('id', $id);
        $this->db->delete('sme_ev_photos');
    }

    public function getrating($id) {
        $q = $this->db->query('select round(avg(fb_score)) as rating from sme_fb where sme_userid = "' . $id . '"');
        $res = $q->result();
        return $res[0];
    }

    public function getratingtot($id) {
        $q = $this->db->query('select round(sum(fb_score)) as rating from sme_fb where sme_userid = "' . $id . '"');
        $res = $q->result();
        return $res[0];
    }

    public function cal_pos_fb($id) {
        $type = 'positive';
        $q = $this->db->query('select round((Count(id)* 100 / (Select Count(*) From sme_fb where sme_userid = "' . $id . '"))) as score  from sme_fb where sme_userid = "' . $id . '" and type="' . $type . '"');
        $res = $q->result();
        return $res[0];
    }

    public function get_pos_fb($id) {
        $type = 'positive';
        $q = $this->db->query('select * from sme_fb where sme_userid = "' . $id . '" and type="' . $type . '"');
        return $q->result();
    }

    public function get_neu_fb($id) {
        $type = 'neutral';
        $q = $this->db->query('select * from sme_fb where sme_userid = "' . $id . '" and type="' . $type . '"');
        return $q->result();
    }

    public function get_neg_fb($id) {
        $type = 'negative';
        $q = $this->db->query('select * from sme_fb where sme_userid = "' . $id . '" and type="' . $type . '"');
        return $q->result();
    }

    public function add_user_feedback($data) {
        $this->db->insert('sme_fb', $data);
        return true;
    }

    public function getsmedetails($id) {
        $q = $this->db->query('select * from sme_users u left join sme_user_profiles p on p.sme_userid = u.id where u.id = "' . $id . '"');
        $res = $q->result();
        return $res[0];
    }

    public function add_question($data) {
        $this->db->insert('sme_quesns', $data);
        return true;
    }

    public function getsmeservices($id) {
        $query = $this->db->query('select bs.services,o.offerings_id from sme_user_offerings o left join business_services bs on bs.id = o.offerings_id where o.sme_userid = "' . $id . '"');
        return $query->result();
    }
    public function getsmeservice($id) {
    	$query = $this->db->query('select offerings_id from sme_user_offerings  where sme_userid = "' . $id . '"');
    	return $query->result();
    }
    
    
    public function book_call($data) {
        $this->db->insert('user_sme_book_call', $data);
        return true;
    }

    public function getservicename($id) {
        $q = $this->db->query('select * from business_services where id="' . $id . '"');
        $res = $q->result();
        return $res[0]->services;
    }

    public function getfb($fb_id) {
        $query = $this->db->query('select f.type,f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on,fr.response,fr.added_on as res_added from sme_fb f left join users u on u.id = f.userid left join sme_fb_response fr on fr.fb_id = f.id where f.id ="' . $fb_id . '" ');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_fb_comments c left join users u on u.id = c.userid where c.fb_id = "' . $key->id . '" order by c.added_on desc');
            $key->comments = $q->result();
            $s = $this->db->query('select * from sme_fb_smeuser_comments c where c.fb_id = "' . $key->id . '" order by c.added_on desc');
            $key->smecomments = $s->result();
        }

        return $query->result();
    }

    public function add_user_feedback_reply($data) {
        $this->db->insert('sme_fb_comments', $data);
        return true;
    }

    public function add_user_question_reply($data) {
        $this->db->insert('sme_quesns_replies', $data);
        return true;
    }

    public function getquestion($qid) {
        $query = $this->db->query('select q.answer,q.question,up.first_name,up.last_name,q.question,u.username,u.name,s.username  as smeuser,q.id,up.photo,up.sme_userid,q.userid from sme_quesns q left join users u on u.id = q.userid left join sme_users s on s.id = q.sme_userid left join sme_user_profiles up on up.sme_userid = s.id where q.id = "' . $qid . '"');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_quesns_replies c left join users u on u.id = c.userid where c.qid = "' . $key->id . '" order by c.added_on asc');
            $key->comments = $q->result();
        }
        return $query->result();
    }

    public function update_smeuser_table($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('sme_users', $data);
    }

    public function getfilter() {
        $q = $this->db->query('select * from sme_fb_filter');
        return $q->result();
    }

    public function getfeedbackdata($offset, $limit, $id) {
        $query = $this->db->query('select f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on from sme_fb f left join users u on u.id = f.userid  where f.sme_userid ="' . $id . '" order by f.added_on desc  LIMIT ' . $limit . ' offset ' . $offset . '');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_fb_comments c left join users u on u.id = c.userid where c.fb_id = "' . $key->id . '"');
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function getfeedbackdatatype($offset, $limit, $id, $type) {
        $query = $this->db->query('select f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on from sme_fb f left join users u on u.id = f.userid  where f.sme_userid ="' . $id . '" and f.type="' . $type . '" order by f.added_on desc  LIMIT ' . $limit . ' offset ' . $offset . '');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_fb_comments c left join users u on u.id = c.userid where c.fb_id = "' . $key->id . '"');
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function getquestionsdata($offset, $limit, $id) {
        $query = $this->db->query('select sq.*,u.name from sme_quesns sq left join users u on u.id = sq.userid  where sq.sme_userid ="' . $id . '" order by sq.added_on desc LIMIT ' . $limit . ' offset ' . $offset . '');
        return $query->result();
    }

    public function getunquestionsdata($offset, $limit, $id) {
        $query = $this->db->query('select q.question,q.answer,q.id,u.name,q.userid,q.added_on from sme_quesns q left join users u on u.id = q.userid  where q.sme_userid ="' . $id . '" and q.answer = " "  order by q.added_on desc LIMIT ' . $limit . ' offset ' . $offset . '');
        return $query->result();
    }

    public function getanquestions($id) {
        $query = $this->db->query('select q.question,q.answer,q.id,u.name,q.added_on from sme_quesns q left join users u on u.id = q.userid  where sme_userid ="' . $id . '" and answer != " " order by q.added_on desc LIMIT 5');
        return $query->result();
    }

    public function getanquestionsdata($offset, $limit, $id) {
        $query = $this->db->query('select q.question,q.answer,q.id,u.name,q.added_on from sme_quesns q left join users u on u.id = q.userid  where sme_userid ="' . $id . '" and answer != "" order by q.added_on desc LIMIT ' . $limit . ' offset '. $offset.'');
        return $query->result();
    }

    public function getfb_no($id) {
        $q = $this->db->query('select * from user_feedback_added where transaction_id = "' . $id . '"');
        $res = $q->result();
        return $res[0];
    }

    public function getq_no($id) {
        $q = $this->db->query('select * from user_questions_asked where transaction_id = "' . $id . '"');
        $res = $q->result();
        return $res[0];
    }

    public function update_user_feedback_no($data, $id) {
        $this->db->where('transaction_id', $id);
        $this->db->update('user_feedback_added', $data);
    }

    public function add_user_feedback_no($data) {
        $this->db->insert('user_feedback_added', $data);
    }

    public function update_user_question_no($data, $id) {
        $this->db->where('transaction_id', $id);
        $this->db->update('user_questions_asked', $data);
    }

    public function add_user_question_no($data) {
        $this->db->insert('user_questions_asked', $data);
    }

    public function getallpackages() {
        $q = $this->db->query('select * from user_packages');
        return $q->result();
    }

    public function getfollowersdata($offset, $limit, $id) {
        $query = $this->db->query('select u.name,u.username,d.state,d.city,d.country,d.gender,d.age,u.id from sme_followers f left join users u on u.id = f.user_id left join user_details d on d.user_id = u.id where f.sme_userid = "' . $id . '" LIMIT ' . $limit . ' offset ' . $offset . '');
        return $query->result();
    }

    public function getarticle($id) {
        $query = $this->db->query('select * from sme_articles where id = "' . $id . '"');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select * from sme_article_comments c left join users u on u.id = c.userid where c.article_id = "' . $key->id . '"');
            $key->comments = $q->result();
        }
        $res = $query->result();
        return $res[0];
    }

    public function getartcomments($offset, $limit, $id) {
        $q = $this->db->query('select * from sme_article_comments c left join users u on u.id = c.userid where c.article_id = "' . $id . '" LIMIT ' . $limit . ' offset ' . $offset . '');
        return $q->result();
    }

    public function add_smeuser_feedback_reply($data) {
        $this->db->insert('sme_fb_smeuser_comments', $data);
        return true;
    }

    public function getsmeunquestionsdata($offset, $limit, $id) {
        $query = $this->db->query('select q.question,q.answer,q.id,u.name,q.userid,q.added_on from sme_quesns q left join users u on u.id = q.userid  where q.sme_userid ="' . $id . '" and q.answer = " "  order by q.added_on desc LIMIT ' . $limit . ' offset ' . $offset . '');
        return $query->result();
    }

    public function getsmefeedbackdata($offset, $limit, $id) {
        $query = $this->db->query('select f.fb_score,f.userid,f.id,f.subject,f.feedback,f.added_on,u.name,f.added_on from sme_fb f left join users u on u.id = f.userid  where f.sme_userid ="' . $id . '" order by f.added_on desc  LIMIT ' . $limit . ' offset ' . $offset . '');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select c.*,u.name from sme_fb_comments c left join users u on u.id = c.userid where c.fb_id = "' . $key->id . '"');
            $key->comments = $q->result();
        }

        return $query->result();
    }

    public function getsmearticles($offset, $limit, $id) {
        $query = $this->db->query('select * from sme_articles where sme_userid = "' . $id . '" and publish ="y" order by added_on desc LIMIT ' . $limit . ' offset ' . $offset . '');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select count(c.id) as count from sme_article_comments c left join users u on u.id = c.userid where c.article_id = "' . $key->id . '"');
            $key->comments = $q->result();
        }
        return $query->result();
    }

    public function getusername($id) {
        $query = $this->db->query('select name,username from users where id = "' . $id . '"');
        $row = $query->result();
        return $row[0];
    }

    public function geteventdata($offset, $limit, $sme_userid) {
        $query = $this->db->query('select * from sme_events where sme_userid = "' . $sme_userid . '" order by date desc LIMIT ' . $limit . ' offset ' . $offset . '');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select * from sme_ev_photos where main_image = "y" and ev_id = "' . $key->id . '"');
            $key->photo = $q->result();
        }
        return $query->result();
    }


    public function getServices() {
        $status = 'enable';
        $query = $this->db->query('select * from services');
        foreach ($query->result() as $key) {
            $top_sme = $this->db->query('select round(avg(fb_score)) as rating from sme_fb group by sme_userid');
            $row = $top_sme->result();
            $key->score = $row[0]->rating;
        }
        foreach ($query->result() as $key) {
            $q = $this->db->query('select round(avg(sf.fb_score)) as rating,up.sme_userid,up.first_name,up.last_name,up.photo from sme_user_offerings uo left join sme_user_profiles up on up.sme_userid = uo.sme_userid left join business_services bs on bs.id = uo.offerings_id left join business_programs bp on bp.id = bs.program_id left join sme_fb sf on sf.sme_userid = uo.sme_userid left join sme_users u on u.id = up.sme_userid where bp.service_id =  "' . $key->id . '" and u.status = "' . $status . '" and u.ranking !=0 group by sme_userid  order by u.ranking asc limit 5');
            foreach ($q->result() as $k) {
                $res = $this->db->query('select count(*) as count from sme_followers where sme_userid = "' . $k->sme_userid . '"');
                $row = $res->result();
                $k->followers_cnt = $row[0]->count;
            }
            $key->sme_users = $q->result();
        }
        return $query->result();
    }

    public function getallmainservices() {
        $query = $this->db->query('select * from services');
        return $query->result();
    }

    public function getprograms($id) {
        $query = $this->db->query('select * from business_programs where service_id ="' . $id . '"');
        return $query->result();
    }

    public function getofferings($id) {
        $query = $this->db->query('select * from business_services where program_id ="' . $id . '"');
        return $query->result();
    }

    public function assign_offering($data) {
        $this->db->insert('sme_user_offerings', $data);
    }

    public function add_article_comment($data) {
        $this->db->insert('sme_article_comments', $data);
    }

    public function getcalls($id) {
        $q = $this->db->query('select * from user_sme_book_call b left join users u on u.id = b.userid where b.sme_userid = "' . $id . '" order by date desc');
        return $q->result();
    }

    public function getsmecalls($offset, $limit, $id) {
        $q = $this->db->query('select * from user_sme_book_call b left join users u on u.id = b.userid where b.sme_userid = "' . $id . '" order by date desc LIMIT ' . $limit . ' offset ' . $offset . '');
        return $q->result();
    }

    public function checkfollow($userid, $sme_userid) {
        $q = $this->db->query('select id from sme_followers where sme_userid = "' . $sme_userid . '" and user_id = "' . $userid . '"');

        if ($q->num_rows() > 0) {
            $row = $q->result();
            return $row[0]->id;
        } else {
            return false;
        }
    }

    public function sme_follow($userid, $sme_userid) {
        $data = array('sme_userid' => $sme_userid, 'user_id' => $userid);
        $this->db->insert('sme_followers', $data);
    }

    public function getuserdetails($id) {
        $query = $this->db->query('select * from user_details where user_id = "' . $id . '"');
        $row = $query->result();
        return $row[0];
    }

    public function check_user_payment($smeid,$id) {
        $query = $this->db->query('select transaction_id,amount from user_package_transaction_details where paid_by = "' . $id . '"  and transaction_status = "success" order by added_on desc limit 1');
        $trans_id = $query->result();
        $trans_id2 = $trans_id[0]->transaction_id;
		//return $query->num_rows();
        if ($query->num_rows() == 0) {
            return false;
        } else if ($query->num_rows() > 0) {
            $no_of_qsns = $this->db->query('select no from user_questions_asked where transaction_id = "' . $trans_id2 . '"');
            $nos = $no_of_qsns->result();
            $no = $nos[0]->no;
			$amt = floor($trans_id[0]->amount);
			$getno = $this->db->query('select * from user_packages where amount="'.$amt.'" limit 1');
			$getno =$getno->result();
			$getno = $getno[0]->max_number_of_questions;
            if ($no >= $getno) {
                return false;
            } else if ($no < $getno) {
                return true;
            }
        }
    }

    public function get_amount() {
        $q = $this->db->query('select amount from user_packages');
        $amt = $q->result();
        $amt = $amt[0]->amount;
        return $amt;
    }

    public function insert_payment_details($data, $id) {
        $this->db->where('order_id', $id);
        $this->db->update('user_package_transaction_details', $data);
        return true;
    }

    public function gettrans($userid) {
        $q = $this->db->query('select transaction_id from user_package_transaction_details where transaction_status = "Success" and paid_by ="' . $userid . '" order by transaction_date desc');
        $id = $q->result();
        $id = $id[0]->transaction_id;
        return $id;
    }

    public function geturgquestions($sme_userid) {
        $status = 'urgent';
        $q = $this->db->query('select sq.id,sq.question,u.name from sme_quesns sq left join users u on u.id = sq.userid where sq.sme_userid = "' . $sme_userid . '" and sq.answer ="" and sq.status="' . $status . '" order by sq.added_on desc');
        return $q->result();
    }

    public function geturgquestionsdata($offset, $limit, $id) {
        $status = 'urgent';
        $query = $this->db->query('select q.question,q.answer,q.id,u.name,q.added_on from sme_quesns q left join users u on u.id = q.userid  where sme_userid ="' . $id . '" and answer = " " and q.status="' . $status . '"  order by q.added_on desc LIMIT ' . $limit . ' offset ' . $offset . '');
        return $query->result();
    }

    public function removefollow($id) {
        $this->db->where('id', $id);
        $this->db->delete('sme_followers');
    }

    public function delete_fb($id) {
        $this->db->where('id', $id);
        $this->db->delete('sme_fb');

        $this->db->where('fb_id', $id);
        $this->db->delete('sme_fb_comments');
    }

    public function update_user_feedback($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('sme_fb', $data);
    }

    public function getsmeevents($offset, $limit, $id) {
        $p = 'y';
        $query = $this->db->query('select * from sme_events where sme_userid = "' . $id . '" order by date desc LIMIT ' . $limit . ' offset ' . $offset . '');
        foreach ($query->result() as $key) {
            $q = $this->db->query('select * from sme_ev_photos where main_image = "y" and ev_id = "' . $key->id . '"');
            $key->photo = $q->result();
        }
        return $query->result();
    }

    public function create_order($id) {
        $array = array('order_id' => $id);
        $this->db->insert('user_package_transaction_details', $array);
    }

   /* public function get_sme_users_for_home_page() {
//        $query = $this->db->query('select * from sme_users u left join sme_user_profiles p on p.sme_userid = u.id WHERE p.photo <>"" ORDER BY u.ranking');
//        return $query->result();


        $this->db->distinct();
        $this->db->select('sme_users.*,sme_user_profiles.*');
        $this->db->from('sme_users');
        $this->db->join('sme_user_profiles', 'sme_user_profiles.sme_userid = sme_users.id');
        $this->db->where('sme_user_profiles.photo <>', '');
        $this->db->order_by('sme_users.ranking', 'desc');


        $query = $this->db->get();
        $query_result = $query->result();
        return $query_result;
    }*/

    public function get_sme_users_for_home_page() {
//        $query = $this->db->query('select * from sme_users u left join sme_user_profiles p on p.sme_userid = u.id WHERE p.photo <>"" ORDER BY u.ranking');
//        return $query->result();


        $this->db->distinct();
        $this->db->select('sme_users.*,sme_user_profiles.*,services.service_name');
        $this->db->from('sme_users');
        $this->db->join('sme_user_profiles', 'sme_user_profiles.sme_userid = sme_users.id');
		 $this->db->join('sme_user_offerings', 'sme_user_offerings.sme_userid = sme_users.id');
		 $this->db->join('services', 'services.id = sme_user_offerings.offerings_id');
        // $this->db->where('sme_user_profiles.photo <>', '');
        $this->db->order_by('sme_users.ranking', 'desc');
		$this->db->where('sme_users.status', 'enable');

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

        return $sme_details;
    }
 public function get_sme_services() {
            $this->db->select('sme_categories.*,sme_categories.name as service_name');
            $this->db->from('sme_categories');
            $this->db->where('sme_categories.level', '0');
            $sme_services = $this->db->get();
			
			$sme_services_result = $sme_services->result();
            return $sme_services_result;
    }
	
	/**
     * Create sme user id and send the email verification code. ID will be disbaled unitl email is confirmed
     * @param unknown $post_data
     */

    public function create_sme($post_data, $hashedpassword) {
    	
    	$digits = 6;
    	$email_verification_code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
    
    	
    	$sme_user_data = array(
    			'name' => $post_data['name'],
    			'username' => $post_data['email'],
    			'password' =>$hashedpassword,
    			'status' => '1',
    			'email_verification_code' => $email_verification_code,
    			'email_verification_status' => '0',
    			'title' => $post_data['title'],
    			'gender' => $post_data['gender']
    			
    	);
    
    
    
    	$this->db->insert('sme_users', $sme_user_data);
    	$smeid = $this->db->insert_id();
    
    	$sme_profile_data = array(
    			'sme_userid' => $smeid,
    			'offerings_id' => $post_data['service'],
    			'added_on' => date("Y-m-d H:i:s")
    			
    			
    	);
    
    	$this->db->insert('sme_user_offerings', $sme_profile_data);
		
		$sme_profile_data2 = array(
				'sme_userid' => $smeid,
    			'first_name' => $post_data['name'],
    			'gender' => $post_data['gender'] 
    	);
		
		$this->db->insert('sme_user_profiles', $sme_profile_data2);
		
    	return $email_verification_code;
    }
    /**
     * 
     * @param unknown $code
     */
    
    public function verify_email($code) {
    	$this->db->select('*');
    	$this->db->from('sme_users');
    	$this->db->where('email_verification_code', $code);
    	$query = $this->db->get();
    	$query_result = $query->result();
    	if (!empty($query_result) && sizeof($query_result)==1) {
    		
    		$order_status_update = array(
    				'email_verification_status' => '1'
    		);
    
    		$this->db->where('email_verification_code', $code);
    		$this->db->update('sme_users', $order_status_update);
    
    		
    		$sme_details = array();
    		if (count($query_result) == 0) {
    			$sme_details = $query_result;
    		} else {
    			$sme_details = $query_result[0];
    		}
    		return $sme_details;
    	} else {
    		return "not matched";
    	}
    }

    
	/**
	 * Function to get list of all the expertise from expertise master table
	 */
    public function get_all_expertise(){
    	
    	$this->db->select('*');
    	$this->db->from('expertise_master');
    	$query = $this->db->get();
    	$query_result = $query->result();
    	
    	return $query_result;
    	
    }
    
    /**
     * Function to insert new expertise as entered by SME.
     */
    public function add_new_expertise($other_expertise_desc,$service_id,$smeuser_id ){
    	
    	$date = date('Y-m-d H:i:s');
    	$new_expertise_data = array(
    			
    			'service_id' =>   $service_id,
    			'expertise_desc'=>$other_expertise_desc,
    			'comments'=>      'Added while SME registration',
    			'created_on' =>   $date,
    			'created_by' =>   $smeuser_id,
    			'modified_on' =>  $date,
    			'modified_by' =>  $smeuser_id
    	);
    	$this->db->insert('expertise_master', $new_expertise_data);
    	 return true;
    	 
    }
    
    /**
     * Function to insert SME's list of expertise in the sme expertise relationship table.
     */
    public function add_sme_expertise_all($smeuser_id, $selectedOption){
    	
    	$date = date('Y-m-d H:i:s');
    	$sme_expertise_data = array(
    			'sme_user_id' => $smeuser_id,
    			'expertise_id' => $selectedOption,
    			'created_on' => $date,
    			'created_by' => $smeuser_id,
    			'modified_on' => $date,
    			'modified_by' => $smeuser_id
    	);
    	
    	
    	
    	return $this->db->insert('sme_expertise_rel', $sme_expertise_data);
    	
    	
    
    }
    
    /**
     * Function to get list of all the expertise for a specific SME
     */
    public function get_sme_expertise_list(){
    	 
    	$this->db->select('*');
    	$this->db->from(sme_expertise_rel);
    	$query = $this->db->get();
    	$query_result = $query->result();
    	 
    	return $query_result;
    }
    
    
    
    
    
}
