<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	
	public function record_count(){
        return $this->db->count_all("member");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('member');	
		$this->db->like('member_fullname', $str_like);
		$this->db->or_like('member_tel', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('member');		
		$this->db->order_by('member_create_time','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');		
		$this->db->from('member');		
		$this->db->like('member_fullname', $str_like);		
		$this->db->or_like('member_tel', $str_like);		
		$this->db->order_by('member_create_time','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	public function view($member_id){
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where('member_id',$member_id);
		$query = $this->db->get();
		$row = $query->row();
		return $row;
	}
	
	public function get_product_image($product_id){
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_id',$product_id);
		$query = $this->db->get();
		$row = $query->row();
		return $row;
	}
	
	
	
	public function add(){
		$code_msg = '';
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$province_id		 = 0;
			$member_email 	  	= '';	
			$member_password 	 = '';
			$member_fullname  	 = '';
			$member_sex   		  = '0';
			$member_birth		= '';
			$member_tel		  = '';
			$member_address	  = '';					
		}else{		
			$member_email 	  	= $this->input->post('member_email');			
			$member_password 	 = $this->input->post('member_password');			
			$member_fullname 	 = $this->input->post('member_fullname');			
			$member_sex 	  	  = $this->input->post('member_sex');			
			$member_birth 	  	= $this->input->post('member_birth');			
			$member_tel 	  	  = $this->input->post('member_tel');			
			$member_address	  = $this->input->post('member_address');	
			$province_id 	  	 = $this->input->post('province_id');		
			
			if($member_email==''){				
				$code_msg = '0';
			}
			if($this->check_member($member_email)){				
				$code_msg = ',1';
			}
						
			if($code_msg==""){								
				$data_member = array(								   
				   'member_email'		=> $member_email,
				   'member_province'	=> $province_id,
				   'member_password' 	=> crypt($member_password),
				   'member_fullname' 	=> $member_fullname,
				   'member_sex' 	    => $member_sex,
				   'member_birth' 	    => $member_birth,				   				   
				   'member_tel' 	    => $member_tel,
				   'member_address' 	=> $member_address,
				   'member_create_time' => time()
				);			
				if($this->db->insert('member', $data_member)){
					$member_email 	  	= '';	
					$member_pass 	 	 = '';
					$member_password 	 = '';
					$member_fullname  	 = '';
					$member_sex   		  = '0';
					$member_birth		= '';
					$member_tel		  = '';
					$member_address	  = '';
					$code_msg       	    = '2';
				}
			}
		}
				
		
		$str_province_choose = $this->get_select_province($province_id);	
		
		/* get data return */
		$f_member = array(		    
			'member_password'	 	=> $member_password,
			'member_email'	 	=> $member_email,
			'member_fullname' 	=> $member_fullname,
			'member_sex' 	    => $member_sex,
			'member_birth' 	    => $member_birth,				   				   
			'member_tel' 	    => $member_tel,
			'member_address' 	=> $member_address,
			'province_choose' 	=> $str_province_choose,						
			'code_msg'	   		=> $code_msg		
		);		
		return $f_member;		
	}
	
	
	public function edit(){
		$code_msg = '';	
			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$member_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('member');
			$this->db->where('member_id',$member_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$member_email 	   	  = $row->member_email;
			$member_email_old 	  = $row->member_email;
			$member_fullname 	   = $row->member_fullname;
			$member_sex 	  		= $row->member_sex;
			$member_birth 	  	  = $row->member_birth;
			$member_tel 	  		= $row->member_tel;
			$member_address 	  	= $row->member_address;
			$province_id 	  	   = $row->member_province;
			$member_password 	   = $row->member_password;
			$member_password_old   = $row->member_password;
			


			
		}else{		
			$member_id		   = $this->input->post('id');
			$member_email 	  	= $this->input->post('member_email');
			$member_email_old 	= $this->input->post('member_email_old');			
			$member_password 	 = $this->input->post('member_password');
			$member_password_old = $this->input->post('member_password_old');			
			$member_fullname 	 = $this->input->post('member_fullname');			
			$member_sex 	  	  = $this->input->post('member_sex');			
			$member_birth 	  	= $this->input->post('member_birth');			
			$member_tel 	  	  = $this->input->post('member_tel');			
			$member_address	  = $this->input->post('member_address');	
			$province_id 	  	 = $this->input->post('province_id');		
			
			if($member_email==''){				
				$code_msg = '0';
			}
			if($this->check_member($member_email) && $member_email<>$member_email_old){				
				$code_msg = ',1';
			}
					
			if($code_msg==""){								
				$data_member = array(								   				   
				   'member_email'	   => $member_email,
				   'member_province'	=> $province_id,
				   'member_fullname' 	=> $member_fullname,				   
				   'member_sex' 	     => $member_sex,
				   'member_birth' 	   => $member_birth,				   				   
				   'member_tel' 	     => $member_tel,
				   'member_address' 	 => $member_address,
				   'member_password'    => $member_password<>$member_password_old ?  crypt($member_password) : $member_password_old,
				);
				$this->db->where('member_id', $member_id);											
				if($this->db->update('member', $data_member)){					
					$code_msg       = '2';
				}
			}
		}
		
		$str_province_choose = $this->get_select_province($province_id);
		
		/* get data return */
		$f_member = array(		    
			'member_id'	  	 	=> $member_id,
			'member_password'	  => $member_password,
			'member_password_old'  => $member_password_old,
			'member_email'	 	 => $member_email,
			'member_email_old'	 => $member_email_old,
			'member_fullname' 	  => $member_fullname,
			'member_sex' 	       => $member_sex,
			'member_birth' 	     => $member_birth,				   				   
			'member_tel' 	       => $member_tel,
			'member_address' 	   => $member_address,
			'province_choose' 	  => $str_province_choose,						
			'code_msg'	   		 => $code_msg		
		);		
		return $f_member;	
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));				
			$delete_query = "DELETE FROM member WHERE member_id IN(".$array_id.")";						
			if($this->db->query($delete_query)){
				$code_msg = 0;
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}
	}
	
	public function delimg($id){
		$sql = "SELECT * FROM member WHERE member_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$member_image = $row->member_image;
		$this->back->delete_file('./public/upload/member/', $member_image);
		$this->back->delete_file('./public/upload/member/', 'small_'.$member_image);
		$sql = "UPDATE member SET member_image = '' WHERE member_id=".$id;
		if($this->db->query($sql)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
	
	
	private function get_frames(){
		$f_arr = array();
		$this->db->select('frame_code, frame_name');
		$this->db->from('system_frame');	
		$this->db->order_by('frame_member','asc');
		$query = $this->db->get();
		$i = 0;
		foreach($query->result() as $row){
			$i = $i + 1;
			$f_arr[$i]['frame_code'] = $row->frame_code;
			$f_arr[$i]['frame_name'] = $row->frame_name;
		}
		return $f_arr;		
	}
	
	public function check_id($tbl,$colid,$id){
		$this->db->select($colid);
		$this->db->from($tbl);
		$this->db->where($colid,$id);
		$query = $this->db->get();
		if($query->num_rows()==0){
			return false;
		}else{
			return true;
		}
	}
	public function get_member_info($member_id){
		$member_id = $this->session->userdata('member_id');
		$sql = 'SELECT * FROM member WHERE member_id='.$member_id;
		$query = $this->db->query($sql);		
		return $query->row();		
	}
	
	public function get_member_items($member_id){
		$sql = 'SELECT * FROM member_items WHERE member_id = '.$member_id;
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	public function get_product_info($product_id){
		$select = "SELECT * FROM product WHERE product_id=".$product_id;
		$query = $this->db->query($select);
		$row = $query->row();		
		return $row;
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
	
}