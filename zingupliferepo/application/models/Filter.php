<?php

/**
 * This class used for admin users login and users actions/activities
 * 
 * @author Vikrant <vikrant@nuvodev.com>
 * 
 * Date:01-09-2015
 * 
 * */
class Filter extends CI_Model {

    function __construct() {
// Call the Model constructor
        parent::__construct();
    }

    /*
     *  Function to get search results for customer support transactions
     */
	 public function get_transactions_search($data)
	 {
		if($data['ord_id'] !='' && $data['cus_id'] == '' && $data['cus_name'] =='' && $data['ph_no'] =='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  td.booking_id,u.id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '".$data['ord_id']."'");
		} 
		
		if($data['ord_id'] =='' && $data['cus_id'] != '' && $data['cus_name'] =='' && $data['ph_no'] =='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '".$data['cus_id']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] == '' && $data['cus_name'] !='' && $data['ph_no'] =='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name LIKE '%".$data['cus_name']."%'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] == '' && $data['cus_name'] =='' && $data['ph_no'] !='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where ud.phone = '".$data['ph_no']."'");
		}
		if($data['ord_id'] =='' && $data['cus_id'] == '' && $data['cus_name'] =='' && $data['ph_no'] =='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.username = '".$data['email_id']."'");
		}
		
		if($data['ord_id'] !='' && $data['cus_id'] != '' && $data['cus_name'] =='' && $data['ph_no'] =='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '".$data['ord_id']."' and u.id = '".$data['cus_id']."'");
		}
		
		if($data['ord_id'] !='' && $data['cus_id'] == '' && $data['cus_name'] !='' && $data['ph_no'] =='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '".$data['ord_id']."' and u.name = '".$data['cus_name']."'");
		}
		
		if($data['ord_id'] !='' && $data['cus_id'] == '' && $data['cus_name'] =='' && $data['ph_no'] !='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '".$data['ord_id']."' and ud.phone = '".$data['ph_no']."'");
		}
		
		if($data['ord_id'] !='' && $data['cus_id'] == '' && $data['cus_name'] =='' && $data['ph_no'] =='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '".$data['ord_id']."' and u.username = '".$data['email_id']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] != '' && $data['cus_name'] !='' && $data['ph_no'] =='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '".$data['cus_id']."' and u.name = '".$data['cus_name']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] != '' && $data['cus_name'] =='' && $data['ph_no'] !='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '".$data['cus_id']."' and ud.phone = '".$data['ph_no']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] != '' && $data['cus_name'] =='' && $data['ph_no'] =='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '".$data['cus_id']."' and u.username = '".$data['email_id']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] == '' && $data['cus_name'] !='' && $data['ph_no'] !='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name = '".$data['cus_name']."' and ud.phone = '".$data['ph_no']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] == '' && $data['cus_name'] !='' && $data['ph_no'] =='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name = '".$data['cus_name']."' and u.username = '".$data['email_id']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] == '' && $data['cus_name'] =='' && $data['ph_no'] !='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where ud.phone = '".$data['ph_no']."' and u.username = '".$data['email_id']."'");
		}
		
		if($data['ord_id'] !='' && $data['cus_id'] != '' && $data['cus_name'] !='' && $data['ph_no'] =='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '".$data['ord_id']."' and u.id = '".$data['cus_id']."' and u.name = '".$data['cus_name']."'");
		}
		
		if($data['ord_id'] !='' && $data['cus_id'] == '' && $data['cus_name'] !='' && $data['ph_no'] !='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '".$data['ord_id']."' and ud.phone = '".$data['ph_no']."' and u.name = '".$data['cus_name']."'");
		}
		
		if($data['ord_id'] !='' && $data['cus_id'] == '' && $data['cus_name'] =='' && $data['ph_no'] !='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where td.booking_id = '".$data['ord_id']."' and ud.phone = '".$data['ph_no']."' and  u.username = '".$data['email_id']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] == '' && $data['cus_name'] =='' && $data['ph_no'] =='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] != '' && $data['cus_name'] !='' && $data['ph_no'] !='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '".$data['cus_id']."' and u.name = '".$data['cus_name']."' and ud.phone = '".$data['ph_no']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] != '' && $data['cus_name'] =='' && $data['ph_no'] !='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.id = '".$data['cus_id']."' and u.username = '".$data['email_id']."' and ud.phone = '".$data['ph_no']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] == '' && $data['cus_name'] !='' && $data['ph_no'] !='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name = '".$data['cus_name']."' and u.username = '".$data['email_id']."' and ud.phone = '".$data['ph_no']."'");
		}
		
		if($data['ord_id'] !='' && $data['cus_id'] != '' && $data['cus_name'] !='' && $data['ph_no'] !='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name = '".$data['cus_name']."' and u.username = '".$data['email_id']."' and ud.phone = '".$data['ph_no']."' and td.booking_id = '".$data['ord_id']."' and  u.id = '".$data['cus_id']."'");
		}
		
		if($data['ord_id'] =='' && $data['cus_id'] != '' && $data['cus_name'] !='' && $data['ph_no'] !='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name = '".$data['cus_name']."' and u.username = '".$data['email_id']."' and ud.phone = '".$data['ph_no']."' and  u.id = '".$data['cus_id']."'");
		}
		
		if($data['ord_id'] !='' && $data['cus_id'] != '' && $data['cus_name'] !='' && $data['ph_no'] !='' && $data['email_id'] =='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name = '".$data['cus_name']."'  and ud.phone = '".$data['ph_no']."' and td.booking_id = '".$data['ord_id']."' and  u.id = '".$data['cus_id']."'");
		}
		
		if($data['ord_id'] !='' && $data['cus_id'] != '' && $data['cus_name'] !='' && $data['ph_no'] =='' && $data['email_id'] !='')
		{
			$query = $this->db->query("select  u.id,td.booking_id,bi.booking_date,td.paid_by,td.amount,u.name as username,bs.services,ss.date,ss.start_time,bsd.duration,bd.name,l.suburb 
			from transaction_details td left join users u on td.paid_by = u.id left join booking_info bi on bi.id = td.booking_id
			left join business_services_details bsd on bsd.service_id = bi.service_id left join business_services bs on bs.id = bsd.service_id
			left join services_slots ss on ss.id = bi.slot_id left join business_details bd on bd.id = bi.provider_id left join locations l on l.id = bd.suburb
			left join user_details ud on ud.user_id = u.id
			where u.name = '".$data['cus_name']."' and u.username = '".$data['email_id']."'  and td.booking_id = '".$data['ord_id']."' and  u.id = '".$data['cus_id']."'");
		}
		return $query->result();
	 }
  

    /* Above function ends here */
}
