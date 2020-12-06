<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
		
	}

	public function validate()	{
		$username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
		if($username<>'' && strlen($password)>=4){
			$this->db->select('userid, user_fullname, user_name, user_password, user_active, user_super, group_id');
			$this->db->from('system_user');
			$this->db->where('user_name',$username);
			$this->db->where('user_active',1);
			$this->db->limit(1);
	
			$query = $this->db->get();
			if($query->num_rows()==1)
			{
				$row = $query->row();
				if(crypt($password,$row->user_password) == $row->user_password){						
					$data = array(
							'userid' 		   => $row->userid,
							'user_name' 		=> $row->user_name,
							'user_fullname' 	=> $row->user_fullname,
							'user_super' 	   => $row->user_super,
							'validated'		=> true
							);
					$this->db->select('group_permission, group_level');
					$this->db->from('system_user_group');
					$this->db->where('group_id',$row->group_id);
					
					$query = $this->db->get();
					$row = $query->row();			
					$data['group_permission']   = $row->group_permission;
					$data['group_level'] 		= $row->group_level;
					$this->session->set_userdata($data);
					
					$udata = array(
						'user_logon'=>time(),
						'user_ip'=>$this->input->ip_address()
					);
					$this->db->where('user_name',$username);
					$this->db->update('system_user', $udata); 
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


}
