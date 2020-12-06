<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	
	public function register(){
		$code_msg = '';
		$province_id = $this->input->get_post('province_id');
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$province_id		= 0;
			$member_email 	  	= '';	
			$member_pass 	 	= '';
			$member_repass 		= '';
			$member_fullname  	= '';
			$member_sex   		= '0';
			$member_birth		= '';
			$member_tel			= '';
			$member_address		= '';							
		}else{				
			$member_email 	  		= $this->input->post('member_email');			
			$member_pass 	  		= $this->input->post('member_pass');			
			$member_repass 	  		= $this->input->post('member_repass');						
			$member_fullname 	  	= $this->input->post('member_fullname');			
			$member_sex 	  		= $this->input->post('member_sex');			
			$member_birth 	  		= $this->input->post('member_birth');			
			$member_tel 	  		= $this->input->post('member_tel');			
			$member_address	  		= $this->input->post('member_address');	
			$province_id 	  		= $this->input->post('province_id');		
			
			if($this->check_member($member_email)){				
				$code_msg = '0';
			}
						
			if($code_msg==""){								
				$data_member = array(								   
				   'member_email'		=> $member_email,
				   'member_province'	=> $province_id,
				   'member_password' 	=> crypt($member_pass),
				   'member_fullname' 	=> $member_fullname,
				   'member_sex' 	    => $member_sex,
				   'member_birth' 	    => $member_birth,				   				   
				   'member_tel' 	    => $member_tel,
				   'member_address' 	=> $member_address,
				   'member_create_time' => time()
				);			
				if($this->db->insert('member', $data_member)){
					$member_email 	  	= '';	
					$member_pass 	 	= '';
					$member_repass 		= '';
					$member_fullname  	= '';
					$member_sex   		= '0';
					$member_birth		= '';
					$member_tel			= '';
					$member_address		= '';
					$code_msg       	= '1';
				}
			}
		}		
				
		$str_province_choose = $this->get_select_province($province_id);	
		
		/* get data return */
		$f_register = array(		    
			'member_pass'	 	=> $member_pass,
			'member_email'	 	=> $member_email,
			'member_repass' 	=> $member_repass,
			'member_fullname' 	=> $member_fullname,
			'member_sex' 	    => $member_sex,
			'member_birth' 	    => $member_birth,				   				   
			'member_tel' 	    => $member_tel,
			'member_address' 	=> $member_address,
			'province_choose' 	=> $str_province_choose,						
			'code_msg'	   		=> $code_msg		
		);		
		return $f_register;		
	}
	
	
	public function profile(){
		$code_msg = '';
		$member_email = $this->session->userdata('member_email');		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$select = "SELECT * FROM member WHERE member_email = '".$member_email."'";
			$query = $this->db->query($select);
			$row = $query->row();			
			$member_fullname 	  	= $row->member_fullname;
			$member_sex 	  		= $row->member_sex;
			$member_birth 	  		= $row->member_birth;
			$member_tel 	  		= $row->member_tel;
			$member_address 	  	= $row->member_address;
			$province_id 	  		= $row->member_province;
		}else{				
			$member_fullname 	  	= $this->input->post('member_fullname');			
			$member_sex 	  		= $this->input->post('member_sex');			
			$member_birth 	  		= $this->input->post('member_birth');			
			$member_tel 	  		= $this->input->post('member_tel');			
			$member_address	  		= $this->input->post('member_address');	
			$province_id 	  		= $this->input->post('province_id');					

			if($code_msg==""){								
				$data_member = array(								   				   
				   'member_province'	=> $province_id,
				   'member_fullname' 	=> $member_fullname,
				   'member_sex' 	    => $member_sex,
				   'member_birth' 	    => $member_birth,				   				   
				   'member_tel' 	    => $member_tel,
				   'member_address' 	=> $member_address
				);
				$this->db->where('member_email', $member_email);			
				if($this->db->update('member', $data_member)){
					$data = array(
						'member_fullname' 		=> $member_fullname,
						'member_address'   		=> $member_address,
						'member_tel'   			=> $member_tel					
					);					
					$this->session->set_userdata($data);
					$code_msg = '1';
				}
			}
		}		
				
		$str_province_choose = $this->get_select_province($province_id);	
		
		/* get data return */
		$f_profile = array(		    
			'member_fullname' 	=> $member_fullname,
			'member_sex' 	    => $member_sex,
			'member_birth' 	    => $member_birth,				   				   
			'member_tel' 	    => $member_tel,
			'member_address' 	=> $member_address,
			'province_choose' 	=> $str_province_choose,						
			'code_msg'	   		=> $code_msg		
		);		
		return $f_profile;		
	}
	
	public function changepass(){
		$code_msg = '';
		$member_email = $this->session->userdata('member_email');		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$member_pass = '';
			$member_repass = '';
		}else{				
			$member_pass 	  	= $this->input->post('member_pass');			
			$member_repass 		= $this->input->post('member_repass');					

			if($code_msg==""){								
				$data_member = array(								   				   
				   'member_password' 	=> crypt($member_pass)
				);
				$this->db->where('member_email', $member_email);			
				if($this->db->update('member', $data_member)){
					$code_msg = '1';
				}else{
					$code_msg = '0';
				}
			}
		}		
		/* get data return */
		$f_changepass = array(		    		
			'code_msg'	=> $code_msg		
		);		
		return $f_changepass;		
	}
	
	
	public function forget(){
		$code_msg = '';
		$member_email = $this->session->userdata('member_email');		
		if($this->input->server('REQUEST_METHOD')=='POST'){			
			$member_email 	= $this->input->post('member_email');				
			if($this->check_member($member_email)){
				//khoi tao thu vien gui mail + lay tham so gui mail tu he thong			
				$this->load->library('email');
				$select = "SELECT * FROM config ORDER BY config_order LIMIT 0, 1";
				$query = $this->db->query($select);
				$row = $query->row();
				if($row->config_mail_protocol=='smtp'){
					$econfig['protocol'] 		= 'smtp';
					$econfig['smtp_host'] 		= $row->config_smtp_host;
					$econfig['smtp_user'] 		= $row->config_smtp_user;
					$econfig['smtp_pass'] 		= $row->config_smtp_pass;
					$econfig['smtp_port'] 		= $row->config_smtp_port;
					$econfig['smtp_timeout']	= $row->config_smtp_timeout;							
				}else{
					$econfig['protocol'] 		= 'mail';
				}
				$econfig['mailtype']	= $row->config_mail_type;
				
				//cap nhat lai mat khau moi + check email co ton tai trong DB
				$member_pass = $this->back->get_random_password(6,6);
				$data_member = array(								   				   
				   'member_password' 	=> crypt($member_pass)
				);
				$this->db->where('member_email', $member_email);
				$this->db->update('member', $data_member);				
				
				$msg_body = 'Mật khẩu mới của bạn là: <b>'.$member_pass.'</b><br>Hãy dùng mật khẩu mới để truy cập <b>'.base_url().'</b> bạn nhé.';			
				$this->email->initialize($econfig);
				$this->email->set_newline("\r\n");
				$this->email->from($row->config_smtp_user, 'For get password');
				$this->email->to($member_email); 
				$this->email->subject('Lấy lại mật khẩu để truy cập '.base_url());			
				$this->email->message($msg_body);										
				
				
				if($this->email->send()){
					$code_msg = '1';
				}else{
					echo $this->email->print_debugger();
					$code_msg = '0';
				}
			}else{
				$code_msg = '2';
			}
		}		
		/* get data return */
		$f_forget = array(		    		
			'code_msg'	=> $code_msg		
		);		
		return $f_forget;		
	}
	public function get_orders(){
		$member_id = $this->session->userdata('member_id');
		$sql = 'SELECT * FROM orders WHERE member_id = '.$member_id.' ORDER BY order_date DESC';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	public function get_order_info($order_id){
		$member_id = $this->session->userdata('member_id');
		$sql = 'SELECT * FROM orders WHERE member_id = '.$member_id.' AND order_id='.$order_id;
		$query = $this->db->query($sql);		
		return $query->row();		
	}
	
	public function get_order_items($order_id){
		$sql = 'SELECT * FROM order_items WHERE order_id = '.$order_id;
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function member_validate()	{
		$member_email = $this->security->xss_clean($this->input->post('member_email'));
        $member_password = $this->security->xss_clean($this->input->post('member_password'));
		if($member_email<>''){
			$this->db->select('*');
			$this->db->from('member');
			$this->db->where('member_email',$member_email);
			$this->db->where('member_active',1);
			$this->db->limit(1);	
			$query = $this->db->get();
			if($query->num_rows()==1)
			{
				$row = $query->row();
				if(crypt($member_password,$row->member_password) == $row->member_password){						
					$data = array(
							'member_id' 			=> $row->member_id,
							'member_fullname' 		=> $row->member_fullname,
							'member_email'	 		=> $row->member_email,
							'member_address'   		=> $row->member_address,
							'member_tel'   			=> $row->member_tel,
							'member_validated'		=> true
							);					
					$this->session->set_userdata($data);
					return true;
				}else{
					return false;
				}
			}
			else
			{
				return false;
			}
		}else{
			return false;
		}
	}
	
	
	private function get_select_province($province_id=''){
		$this->db->select('province_id, province_name');
		$this->db->from('province');		
		$this->db->order_by('province_order','asc');
		$query = $this->db->get();
		$province_choose = '';
		foreach($query->result() as $row){			
			if($row->province_id == $province_id){
				$province_choose .= "<option value=".$row->province_id." selected>".$row->province_name."</option>";
			}else{
				$province_choose .= "<option value=".$row->province_id.">".$row->province_name."</option>";
			}
		}
		return $province_choose;		
	}
	
	
	
	private function check_member($email){
		$select = "SELECT * FROM member WHERE member_email = '".$email."'";
		$query = $this->db->query($select); 
		if($query->num_rows()==0){
			return false;
		}else{
			return true;
		}
	}
	public function get_product_info($product_id){
		$select = "SELECT * FROM product WHERE product_id=".$product_id;
		$query = $this->db->query($select);
		$row = $query->row();		
		return $row;
	}
}