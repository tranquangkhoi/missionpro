<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->db->select('*');
		$this->db->from('system_user');
		$this->db->order_by('user_super','desc');
		if($this->session->userdata('user_super')==0){		
			$this->db->where('user_name',$this->session->userdata('user_name'));
			$this->db->or_where('group_level > ',$this->session->userdata('group_level'));			
		}
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	
	
	public function add(){
		$code_msg = '';
		$group_id = $this->input->get_post('group_id');
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$user_fullname 	= '';
			$user_name 		= '';
			$user_password 	= '';
			$repass 		   = '';
			$user_active 	  = 1;			
		}else{		
			$user_fullname 	= $this->input->post('user_fullname');
			$user_name 		= $this->input->post('user_name');
			$user_password 	= $this->input->post('user_password');			
			$repass 		   = $this->input->post('repass');		
			$user_active 	  = $this->input->post('user_active') ? 1 : 0;			
			
			if($user_fullname == ""){
				//$message = $message."<li>Hãy nhập tên nhân viên quản trị</li>";
				$code_msg = '0';
			}
			if($user_name == ""){
				//$message = $message."<li>Hãy nhập tên đăng nhập</li>";
				$code_msg .= ',1';
			}
			if($user_password == ""){
				//$message = $message."<li>Hãy nhập mật khẩu</li>";
				$code_msg .= ',2';
			}
			if($repass	== ""){
				//$message = $message."<li>Hãy nhập lại mật khẩu</li>";
				$code_msg .= ',3';
			}
			if(strlen($user_password) < 8){
				//$message = $message."<li>Mật khẩu phải ít nhất là 4 ký tự</li>";
				$code_msg .= ',4';
			}
			if($user_password != $repass){
				//$message = $message."<li>Mật khẩu nhập không chính xác. Bạn hãy nhập lại</li>";	
				$code_msg .= ',5';
			}
			
			if($code_msg==""){			
				$this->db->select('userid');
				$this->db->from('system_user');
				$this->db->where('user_name',$user_name);
				$query = $this->db->get();
				if($query->num_rows()>0){
					//$message = "<li>Nhân viên quản trị này đã có. Yêu cầu bạn nhập tên đăng nhập khác</li>";
					$code_msg = '6';
				}
			}
						
			if($code_msg==""){
				$this->db->select('group_level');
				$this->db->from('system_user_group');
				$this->db->where('group_id', $group_id);
				$query = $this->db->get();
				$row = $query->row();
				$group_level = $row->group_level;				
				
				$data_user = array(				
				   'user_fullname'	=> $user_fullname,
				   'user_name' 		=> $user_name,
				   'user_password' 	=> crypt($user_password),
				   'user_active' 	  => $user_active,
				   'group_id' 		 => $group_id,
				   'group_level' 	  => $group_level,
				   'user_logon' 	   => time(),
				);			
				if($this->db->insert('system_user', $data_user)){
					$user_fullname 	= '';
					$user_name 		= '';
					$user_password 	= '';
					$repass 		   = '';
					//$message = "<li>Thêm mới thành công.</li>";
					$code_msg = '7';
				}
			}
		}
		
				
		$str_group_choose = $this->get_select_group($this->session->userdata('group_level'),$group_id);
		
		/* get data return */
		$f_user = array(
			'user_fullname'	 => $user_fullname,
			'user_name' 		 => $user_name,
			'user_password' 	 => $user_password,
			'repass' 			=> $repass,
			'group_choose' 	  => $str_group_choose,
			'check_user_active' => $user_active==1 ? 'checked' : '',
			'code_msg'		  => $code_msg
		);		
		return $f_user;		
	}
	
	
	public function edit(){
		$code_msg = '';		
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$userid = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			
			$this->db->select('*');
			$this->db->from('system_user');
			$this->db->where('userid',$userid);
			$query = $this->db->get();
			$row = $query->row();
			
			$userid		   = $row->userid;
			$user_fullname 	= $row->user_fullname;
			$user_name 		= $row->user_name;
			$user_temp		= $row->user_name;
			$user_password 	= '';
			$repass 		   = '';
			$oldpass		  = '';
			$passtemp 	 	 = $row->user_password;
			$user_active 	  = $row->user_active;
			$group_id		 = $row->group_id;
			$user_super  	   = $row->user_super;			
		}else{		
			$id			   = $this->input->post('id');
			$userid		   = $id;
			$group_id		 = $this->input->post('group_id');
			$user_fullname 	= $this->input->post('user_fullname');
			$user_name 		= $this->input->post('user_name');
			$user_temp 		= $this->input->post('user_temp');
			
			$user_password 	= $this->input->post('user_password');			
			$repass 		   = $this->input->post('repass');
			
			$oldpass 		  = $this->input->post('oldpass');
			$passtemp     	 = $this->input->post('passtemp');
			$user_super       = $this->input->post('user_super');
					
			$user_active 	  = $this->input->post('user_active') ? 1 : 0;
			$user_active	  = $user_super==1 ? 1 : $user_active;
					
			
			if($user_fullname == ""){
				//$message = $message."<li>Hãy nhập tên nhân viên quản trị</li>";
				$code_msg = '0';
			}
			if($user_name == ""){
				//$message = $message."<li>Hãy nhập tên đăng nhập</li>";
				$code_msg .= ',1';
			}
			
			if(($this->session->userdata('user_super')==0  || $user_super==1) && $this->session->userdata('userid') == $id){
				//$message = $message."<li>Hãy nhập mật khẩu cũ để xác nhận việc cập nhật thông tin"
				if($oldpass == ""){
					$code_msg .= ',2';
				}elseif(crypt($oldpass,$passtemp) <> $passtemp){
						//$message = $message."<li>Mật khẩu cũ nhập không chính xác. Bạn hãy nhập lại";
					$code_msg .= ',3';	
				}
			}
			if(strlen($user_password) < 8 && strlen($user_password) >=1){
				//$message = $message."<li>Mật khẩu phải ít nhất là 8 ký tự";
				$code_msg .= ',4';
			}	
			if($user_password != $repass){
				//$message = $message."<li>Mật khẩu mới nhập không chính xác. Bạn hãy nhập lại";	
				$code_msg .= ',5';
			}			
			if($code_msg == "" && $user_password == $repass && strlen($user_password)>=8){
				$user_password = crypt($user_password);	
			}
			else{
				if($code_msg == ""){
					$user_password = $passtemp;
				}
			}
			
			if($code_msg=="" && $user_name<>$user_temp){			
				$this->db->select('userid');
				$this->db->from('system_user');
				$this->db->where('user_name',$user_name);
				$query = $this->db->get();
				if($query->num_rows()>0){
					//$message = "<li>Nhân viên quản trị này đã có. Nhập tên đăng nhập mới hoặc giữ tên đăng nhập cũ</li>";
					$user_password = '';
					$code_msg = '6';
				}
			}			
			
			
						
			if($code_msg==""){
				$this->db->select('group_level');
				$this->db->from('system_user_group');
				$this->db->where('group_id', $group_id);
				$query = $this->db->get();
				$row = $query->row();
				$group_level = $row->group_level;				
				
				$data_user = array(				
				   'user_fullname'	=> $user_fullname,
				   'user_name' 		=> $user_name,
				   'user_password' 	=> $user_password,
				   'user_active' 	  => $user_active,
				   'group_id' 		 => $group_id,
				   'group_level' 	  => $group_level
				  
				);	
				$this->db->where('userid', $userid);					
				if($this->db->update('system_user', $data_user)){					
					$code_msg = '7';						
					if($this->session->userdata('userid')==$id){
						$this->session->set_userdata('user_fullname', $user_fullname);
						$this->session->set_userdata('user_name', $user_name);						
					}					
				}
			}
		}
		
				
		$str_group_choose = $this->get_select_group($this->session->userdata('group_level'),$group_id);
		
		
		
		/* get data return */
		$f_user = array(
			'userid'			=> $userid,
			'user_fullname'	 => $user_fullname,
			'user_name' 		 => $user_name,
			'user_temp' 		 => $user_temp,
			'user_password' 	 => $user_password,
			'repass' 			=> $repass,
			'oldpass' 		   => $oldpass,
			'passtemp' 		  => $passtemp,
			'user_super' 		=> $user_super,
			'group_choose' 	  => $str_group_choose,
			'check_user_active' => $user_active==1 ? 'checked' : '',
			'code_msg'		  => $code_msg
		);		
		return $f_user;		
	}
	
	
	public function del(){
		$code_msg = '';
		$userid = $this->input->post('del_userid');
		if($userid==$this->session->userdata('userid')){
			$code_msg = 0;
			return $code_msg;
		}
		
		if($this->session->userdata('user_super')==0){
			$code_msg = 1;
			return $code_msg;
		}		
		
		$this->db->select('userid, user_super, group_level');
		$this->db->from('system_user');
		$this->db->where('userid',$userid);
		$query = $this->db->get();
		$row = $query->row();
		if($row->user_super == 1){
			$code_msg = 2;
			return $code_msg;
		}
		
		$this->db->where('userid',$userid);
		if($this->db->delete('system_user')){
			$code_msg = 3;
			return $code_msg;		
		}
	}
	
	private function get_select_group($group_level,$group_id=''){
		$this->db->select('group_id, group_name');
		$this->db->from('system_user_group');
		$this->db->where('group_level >=',$group_level);
		$this->db->order_by('group_order','asc');
		$query = $this->db->get();
		$group_choose = '';
		foreach($query->result() as $row){			
			if($row->group_id == $group_id){
				$group_choose .= "<option value=".$row->group_id." selected>".$row->group_name."</option>";
			}else{
				$group_choose .= "<option value=".$row->group_id.">".$row->group_name."</option>";
			}
		}
		return $group_choose;		
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
	
}
