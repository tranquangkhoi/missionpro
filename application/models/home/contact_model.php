<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function send_contact(){
		$code_msg = '';
		if($this->input->server('REQUEST_METHOD')=='GET'){
				$contact_fullname       = '';
				$contact_tel  			= '';
				$contact_email   		  = '';
				$contact_subject   		= '';
				$contact_request   		= '';
				$contact_captcha   		= '';				
		}else{
			$contact_fullname       = $this->input->post('fullname');
			$contact_tel  			= $this->input->post('tel');
			$contact_email   		  = $this->input->post('email');
			$contact_subject   		= $this->input->post('subject');
			$contact_request   		= $this->input->post('request');
			$contact_captcha   		= $this->input->post('captcha');
						
				
			if(!$this->check_captcha($contact_captcha)){				
				$code_msg = '0';
			}
							
			if($code_msg==""){							
				$data_contact = array(				
				   'contact_fullname'	 => $contact_fullname,
				   'contact_tel'		  => $contact_tel,
				   'contact_email' 		=> $contact_email,				   
				   'contact_subject'	  => $contact_subject,
				   'contact_request' 	  => $contact_request,
				   'contact_date'		 => time()			  			   				   
				);			
				if($this->db->insert('contact', $data_contact)){																
					$this->db->query("DELETE FROM captcha WHERE word ='$contact_captcha'");
					$contact_fullname       = '';
					$contact_tel  			= '';
					$contact_email   		  = '';
					$contact_subject   		= '';
					$contact_request   		= '';
					$contact_captcha   		= '';
					$code_msg 			  = '1';
				}
			}
		 }
		$f_contact = array(
			'fullname' 	=> $contact_fullname,
			'tel' 		 => $contact_tel,
			'email' 	   => $contact_email,
			'subject'     => $contact_subject,
			'request'     => $contact_request,
			'code_msg'    => $code_msg			
		);
		return $f_contact;
	}
	
	public function get_info_company(){
		$select = "SELECT * FROM config ORDER BY config_order LIMIt 0,1";
		$query = $this->db->query($select);
		$row = $query->row();
		return $row;		
	}
	
	public function check_captcha($captcha){
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);	
		
		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();		
		if ($row->count == 0){
			return FALSE;
		}else{
			return TRUE;
		}		
	}
	
}