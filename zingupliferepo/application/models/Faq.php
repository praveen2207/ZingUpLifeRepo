<?php

/**
 * This class used for admin users login and users actions/activities
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:01-09-2015
 * 
 * */
class Faq extends CI_Model {

    function __construct() {
// Call the Model constructor
        parent::__construct();
    }

    /*
     *  Function to get user details by given username  
     */

    public function get_all_faqs() {
        $this->db->select('faqs.*');
        $this->db->from('faqs');
        $query = $this->db->get();
        $query_result = $query->result();

        return $query_result;
    }

    /* Above function ends here */
    
    
     /*
     *  Function to get faq filter  
     */

    public function get_faq($text) {
        $this->db->select('faqs.*');
        $this->db->from('faqs');
        $this->db->like('faqs.question',$text);
        $query = $this->db->get();
        $query_result = $query->result();

        return $query_result;
    }

    /* Above function ends here */
}
