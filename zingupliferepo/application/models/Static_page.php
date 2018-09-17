<?php

/**
 * This class gives listing of static pages
 * 
 * @author Anitha <anitha@nuvodev.com>
 * 
 * Date:20-08-2015
 * 
 * */
class Static_page extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Function to get static pages content 
     */

    public function get_static_pages_content($static_page_name) {
        $query = $this->db->get_where('static_pages', array('url' => $static_page_name));
        $query_result = $query->result();
        $staticpage_content = array();
        if (!empty($query_result)) {
            $staticpage_content['content'] = $query_result[0];
        } else {
            $staticpage_content['content'] = $query_result;
        }

        $gallery_query = $this->db->get_where('static_pages_gallery', array('page_id' => $staticpage_content['content']->id));
        $gallery_query_result = $gallery_query->result();
        if (!empty($gallery_query_result)) {
            $staticpage_content['gallery'] = $gallery_query_result[0];
        } else {
            $staticpage_content['gallery'] = $gallery_query_result;
        }
        return $staticpage_content;
    }

    /* Above function ends here */
	
	
	/*
     * Function to get terms and privacy  pages content 
     */

    public function get_terms_privacy_content($static_page_name) {
        $query = $this->db->get_where('static_pages', array('url' => $static_page_name));
        $query_result = $query->result();
        $staticpage_content = array();
        if (!empty($query_result)) {
            $staticpage_content['content'] = $query_result[0];
        } else {
            $staticpage_content['content'] = $query_result;
        }
        return $staticpage_content;
    }

    /* Above function ends here */
}
