<?php

class Sme_portal extends CI_Model {

    public function getallofferings() {
        $query = $this->db->query('select * from business_services where services !="" order by services asc');
        foreach ($query->result() as $res) {
            $sme = $this->db->query('select p.first_name,p.last_name,p.sme_userid from sme_users u left join sme_user_offerings o on u.id = o.sme_userid left join sme_user_profiles p on p.sme_userid = u.id where o.offerings_id ="' . $res->id . '" order by u.created_on desc limit 5');

            foreach ($sme->result() as $key) {
                $followers = $this->db->query('select count(id) as fo_cnt from sme_followers where sme_userid = "' . $key->sme_userid . '"');
                $fo = $followers->result();
                $key->fo_cnt = $fo[0]->fo_cnt;
            }
            foreach ($sme->result() as $key) {
                $fb = $this->db->query('select round(avg(fb_score)) as fb_score from sme_fb where  sme_userid= "' . $key->sme_userid . '"');
                $fb = $fb->result();
                $key->fb = $fb[0]->fb_score;
            }
            $res->users = $sme->result();
        }

        return $query->result();
    }

    public function getoffering($id) {
        $query = $this->db->query('select * from business_services where id="' . $id . '"');
        foreach ($query->result() as $res) {
            $sme = $this->db->query('select p.first_name,p.last_name,p.sme_userid from sme_users u left join sme_user_offerings o on u.id = o.sme_userid left join sme_user_profiles p on p.sme_userid = u.id where o.offerings_id ="' . $res->id . '" order by u.created_on desc ');

            foreach ($sme->result() as $key) {
                $followers = $this->db->query('select count(id) as fo_cnt from sme_followers where sme_userid = "' . $key->sme_userid . '"');
                $fo = $followers->result();
                $key->fo_cnt = $fo[0]->fo_cnt;
            }
            foreach ($sme->result() as $key) {
                $fb = $this->db->query('select round(avg(fb_score)) as fb_score from sme_fb where  sme_userid= "' . $key->sme_userid . '"');
                $fb = $fb->result();
                $key->fb = $fb[0]->fb_score;
            }
            $res->users = $sme->result();
        }
        $row = $query->result();
        return $row[0];
    }

    public function getprofile($id) {
        $query = $this->db->query('select * from sme_user_profiles p left join sme_users u on u.id = p.sme_userid where p.sme_userid = "' . $id . '"');
        $res = $query->result();
        return $res[0];
    }

    public function getfollowcnt($id) {
        $followers = $this->db->query('select count(id) as fo_cnt from sme_followers where sme_userid = "' . $id . '"');
        $fo = $followers->result();
        return $fo[0]->fo_cnt;
    }

}
