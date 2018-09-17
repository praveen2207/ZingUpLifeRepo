<?php
/* 
 * Developer : Vadivel N
 * Date : 26 JAN, 2016
 * Description : User Management 
 */

class User_model extends CI_Model 
{
    private $db;
    private $table = null;
    public $user_id = 0;
    public $username = null;
    public $password = null;
    public $first_name = null;
    public $last_name = null;
    public $email = null;
    public $activation_code = null;
    public $created_on = null;
    public $last_login = null;
    public $active = 1; // default is active(1)
    
    public function __construct() 
    {
        parent::__construct();
        $this->db = & get_instance()->db_mgr;
        $this->table = TBL_USERS;
        $this->primary_key='user_id';

    }
    public function login() {
        $query = $this->db->reader()
                    ->select('user_id,username,password,first_name,last_name,email,last_login,user_type')
                    ->from($this->table . ' U ')
                    ->where('username',$this->username)
                    //->where('password', $this->password)
                    ->where('active', 1)
                    ->limit(1)->get();
        $this->db->reader()->last_query();
    
        if($query->num_rows())
        {
           return $query->result();
        }
        return false;
    }
    public function save() 
    {
        $insert_data = array (
            'username'      => $this->username,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->user_email,
            'contact_no'    => $this->user_contact_no,
            'user_type'     => $this->user_type,
            'password'      => $this->password,
            'created_on'    => date('Y-m-d H:i:s')
        );
        $this->db->writer()->insert($this->table,$insert_data);
        return $this->db->writer()->insert_id();
    }
    
    public function update() 
    {
        $update_data = array (
            'username'      => $this->username,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->user_email,
            'contact_no'    => $this->user_contact_no,
            'user_type'     => $this->user_type,
            'active'        => $this->active
        );
        $where = array(
            'user_id' => $this->user_id
        );
        
        $this->db->writer()
                ->where($where)
                ->update($this->table,$update_data);
        
        return $this->db->writer()->affected_rows();
    }

    public function delete() 
    {
        $where = array(
            'user_id' => $this->user_id
        );
        
        $this->db->writer()
                ->where($where)
                ->delete($this->table);
        return $this->db->writer()->affected_rows();
    }
    
    public function get_users($request_data) 
    {
        $boards = array();
        
        $columns = array( 
            // datatable column index  => database column name
            0 =>    'user_id', 
            1 =>    'first_name', 
            2 =>    'last_name', 
            3 =>    'username', 
            4 =>    'email', 
            5 =>    'user_type', 
            6 =>    'active'
        );
        
        
        // get and set the total records count without filter
        $count_query = $this->db->reader()
                        ->select('COUNT(user_id) AS tot_records')
                        ->from($this->table)
                        ->get();
        
        $result_set = $count_query->row();
        $boards['total_data'] = $result_set->tot_records;
        $boards['total_filtered'] = $boards['total_data'];
        
        // get and set the total filtered record counts after applied filter
        if( !empty($request_data['search']['value']) ) 
        {   
            $query = $this->db->reader()
                ->select('COUNT(user_id) AS tot_records')
                ->from($this->table)
                ->where(" username LIKE '". $request_data['search']['value'] ."%'")    
                ->get();
            
            $result_set = $count_query->row();
            $boards['total_filtered'] = $result_set->tot_records;
            
            $data_query = $this->db->reader()
                ->select('*')
                ->from($this->table)
                ->where(" username LIKE '". $request_data['search']['value'] ."%'")        
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
        } 
        else {
            $data_query = $this->db->reader()
                ->select('*')
                ->from($this->table)
                ->order_by($columns[$request_data['order'][0]['column']], $request_data['order'][0]['dir'])
                ->limit($request_data['length'],$request_data['start'])
                ->get();
        }
        
        $boards['result'] = $data_query->result();
        return $boards;
    }    
    public function get_record($id)
    {
        $query = $this->db->reader()
                    ->select('*')
                    ->from($this->table)
                    -> where($this->primary_key,$id)
                    ->get();
        return $query->result_array();
    }
    function get_edit_record(){
        $where = array(
            'user_id' => $this->user_id
        );
        $query = $this->db->reader()
                ->select('*')
                ->from($this->table)
                ->where($where)
                ->get();
        
        return $query->result();
    }
    public function unique_check() 
    {
        $num_rows = $this->db->reader()
                    ->select('user_id')
                    ->from($this->table)
                    ->where('username',$this->username)
                    ->where('user_id !=', $this->user_id)
                    ->limit(1)->get()->num_rows();
        if($num_rows)
        {
            return false;
        }
        return true;
    }
    
    
    
}