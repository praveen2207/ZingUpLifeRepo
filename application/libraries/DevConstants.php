<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DevConstants
{
    private $CI;
    public function __construct()
    {
        $this->CI = & get_instance();
        $this->setConstants();
    }
    private function setConstants()
    {
        $query = $this->CI->db->get('config_param');
        foreach($query->result() as $row)
        {
            define((string)$row->key_name, $row->key_value);
        }
        return ;
    }
}

?>