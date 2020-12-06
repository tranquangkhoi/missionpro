<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	public function record_count(){
        return $this->db->count_all("config");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('config');	
		$this->db->like('config_name', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('config');
		$this->db->order_by('config_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');
		$this->db->like('config_name', $str_like);
		$this->db->from('config');		
		$this->db->order_by('config_type','asc');
		$this->db->order_by('config_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('config');
		$this->db->where('config_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->config_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('config');
		$this->db->where('config_order < ',$crr_ord);
		$this->db->order_by('config_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->config_id;
			$up_ord = $row->config_order;
			
			$data_sort = array(				
				'config_order' => $crr_ord			
			);
			$this->db->where('config_id', $up_id);					
			$this->db->update('config', $data_sort);
			
			$data_sort = array(				
				'config_order' => $up_ord			
			);
			$this->db->where('config_id', $crr_id);					
			$this->db->update('config', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('config');
		$this->db->where('config_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->config_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('config');
		$this->db->where('config_order > ',$crr_ord);
		$this->db->order_by('config_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->config_id;
			$up_ord = $row->config_order;
			
			$data_sort = array(				
				'config_order' => $crr_ord			
			);
			$this->db->where('config_id', $up_id);					
			$this->db->update('config', $data_sort);
			
			$data_sort = array(				
				'config_order' => $up_ord			
			);
			$this->db->where('config_id', $crr_id);					
			$this->db->update('config', $data_sort);			
		}				
		
	}
	
	
	
	public function add(){
		$code_msg = '';		
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			//thong tin chung
			$company_name  			= '';
			$company_address  		= '';
			$company_tel  			= '';
			$company_hotline  		= '';
			$company_fax  			= '';
			$company_email 			= '';
			$config_address_footer  = '';
			
			//thong tin cau hinh mail
			$config_mail_protocol 	= 'mail';
			$config_mail_type	 	= '';
			$config_smtp_host	 	= '';
			$config_smtp_user	 	= '';
			$config_smtp_pass	 	= '';
			$config_smtp_port	 	= '25';
			$config_smtp_timeout 	= '5';

		}else{		
			$company_name 			  	= $this->input->post('company_name');			
			$company_address 		  	= $this->input->post('company_address');			
			$company_tel 			  	= $this->input->post('company_tel');			
			$company_hotline 		  	= $this->input->post('company_hotline');			
			$company_fax 			  	= $this->input->post('company_fax');						
			$company_email 			  	= $this->input->post('company_email');						
			$config_address_footer	  	= $this->input->post('config_address_footer');			
			
			$config_mail_protocol	 	= $this->input->post('config_mail_protocol');						
			$config_mail_type	  		= $this->input->post('config_mail_type');			
			$config_smtp_host	  		= $this->input->post('config_smtp_host');			
			$config_smtp_user	  		= $this->input->post('config_smtp_user');			
			$config_smtp_pass	  		= $this->input->post('config_smtp_pass');			
			$config_smtp_port	  		= $this->input->post('config_smtp_port');			
			$config_smtp_timeout  		= $this->input->post('config_smtp_timeout');			

			
			
			if($company_name == "" || $company_address == "" || $company_tel == "" || $config_address_footer == ""){				
				$code_msg = '0';
			}
						
			if($code_msg==""){				
				$this->db->select_max('config_order', 'max_order');
				$query = $this->db->get('config');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
				$data_config = array(				
					'company_name' 			  	=> $company_name,			
					'company_address' 		  	=> $company_address,			
					'company_tel' 			  	=> $company_tel,			
					'company_hotline' 		  	=> $company_hotline,			
					'company_fax' 			  	=> $company_fax,						
					'company_email' 			=> $company_email,											
					'config_address_footer'	  	=> $config_address_footer,			
					
					'config_mail_protocol'	 	=> $config_mail_protocol,						
					'config_mail_type'	  		=> $config_mail_type,			
					'config_smtp_host'	  		=> $config_smtp_host,			
					'config_smtp_user'	  		=> $config_smtp_user,			
					'config_smtp_pass'	  		=> $config_smtp_pass,			
					'config_smtp_port'	  		=> $config_smtp_port,			
					'config_smtp_timeout'  		=> $config_smtp_timeout,
					'config_order' 				=> $max_order				   
				);			
				if($this->db->insert('config', $data_config)){
					//thong tin chung
					$company_name  			= '';
					$company_address  		= '';
					$company_tel  			= '';
					$company_hotline  		= '';
					$company_fax  			= '';
					$company_email 			= '';
					$config_address_footer  = '';
					
					//thong tin cau hinh mail
					$config_mail_protocol 	= 'mail';
					$config_mail_type	 	= '';
					$config_smtp_host	 	= '';
					$config_smtp_user	 	= '';
					$config_smtp_pass	 	= '';
					$config_smtp_port	 	= '25';
					$config_smtp_timeout 	= '5';								
					$code_msg = '1';
				}
			}
		}
				
		
		/* get data return */
		$f_config = array(			
			'company_name' 			  	=> $company_name,			
			'company_address' 		  	=> $company_address,			
			'company_tel' 			  	=> $company_tel,			
			'company_hotline' 		  	=> $company_hotline,			
			'company_fax' 			  	=> $company_fax,						
			'company_email'			  	=> $company_email,						
			'config_address_footer'	  	=> $config_address_footer,			
			
			'config_mail_protocol'	 	=> $config_mail_protocol,						
			'config_mail_type'	  		=> $config_mail_type,			
			'config_smtp_host'	  		=> $config_smtp_host,			
			'config_smtp_user'	  		=> $config_smtp_user,			
			'config_smtp_pass'	  		=> $config_smtp_pass,			
			'config_smtp_port'	  		=> $config_smtp_port,			
			'config_smtp_timeout'  		=> $config_smtp_timeout,										
			'code_msg'	 				=> $code_msg
		);		
		return $f_config;		
	}
	
	
	public function edit(){
		$code_msg = '';			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$config_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
					
			$this->db->select('*');
			$this->db->from('config');
			$this->db->where('config_id',$config_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$config_id				= $row->config_id;			
			$company_name		   	= $row->company_name;
			$company_address		= $row->company_address;
			$company_tel		   	= $row->company_tel;
			$company_hotline		= $row->company_hotline;
			$company_fax		   	= $row->company_fax;
			$company_email		   	= $row->company_email;
			$config_address_footer	= $row->config_address_footer;
			$config_mail_protocol	= $row->config_mail_protocol;
			$config_mail_type		= $row->config_mail_type;
			$config_smtp_host		= $row->config_smtp_host;
			$config_smtp_user		= $row->config_smtp_user;
			$config_smtp_pass		= $row->config_smtp_pass;
			$config_smtp_port		= $row->config_smtp_port;
			$config_smtp_timeout	= $row->config_smtp_timeout;
												
		}else{		
			$id			  				= $this->input->post('id');
			$config_id		 			= $id;
			$company_name 			  	= $this->input->post('company_name');			
			$company_address 		  	= $this->input->post('company_address');			
			$company_tel 			  	= $this->input->post('company_tel');			
			$company_hotline 		  	= $this->input->post('company_hotline');			
			$company_fax 			  	= $this->input->post('company_fax');						
			$company_email 			  	= $this->input->post('company_email');						
			$config_address_footer	  	= $this->input->post('config_address_footer');			
			
			$config_mail_protocol	 	= $this->input->post('config_mail_protocol');						
			$config_mail_type	  		= $this->input->post('config_mail_type');			
			$config_smtp_host	  		= $this->input->post('config_smtp_host');			
			$config_smtp_user	  		= $this->input->post('config_smtp_user');			
			$config_smtp_pass	  		= $this->input->post('config_smtp_pass');			
			$config_smtp_port	  		= $this->input->post('config_smtp_port');			
			$config_smtp_timeout  		= $this->input->post('config_smtp_timeout');			

			if($company_name == "" || $company_address == "" || $company_tel == "" || $config_address_footer == ""){				
				$code_msg = '0';
			}				
								
			if($code_msg==""){				
				$data_config = array(				
				   	'company_name' 			  	=> $company_name,			
					'company_address' 		  	=> $company_address,			
					'company_tel' 			  	=> $company_tel,			
					'company_hotline' 		  	=> $company_hotline,			
					'company_fax' 			  	=> $company_fax,						
					'company_email' 			=> $company_email,						
					'config_address_footer'	  	=> $config_address_footer,			
					
					'config_mail_protocol'	 	=> $config_mail_protocol,						
					'config_mail_type'	  		=> $config_mail_type,			
					'config_smtp_host'	  		=> $config_smtp_host,			
					'config_smtp_user'	  		=> $config_smtp_user,			
					'config_smtp_pass'	  		=> $config_smtp_pass,			
					'config_smtp_port'	  		=> $config_smtp_port,			
					'config_smtp_timeout'  		=> $config_smtp_timeout,			   
				);	
				$this->db->where('config_id', $config_id);					
				if($this->db->update('config', $data_config)){					
					$code_msg = '1';																
				}
			}
		}
		
		/* get data return */
		$f_config = array(
			'company_name' 			  	=> $company_name,			
			'company_address' 		  	=> $company_address,			
			'company_tel' 			  	=> $company_tel,			
			'company_hotline' 		  	=> $company_hotline,			
			'company_fax' 			  	=> $company_fax,						
			'company_email'			  	=> $company_email,						
			'config_address_footer'	  	=> $config_address_footer,			
			
			'config_mail_protocol'	 	=> $config_mail_protocol,						
			'config_mail_type'	  		=> $config_mail_type,			
			'config_smtp_host'	  		=> $config_smtp_host,			
			'config_smtp_user'	  		=> $config_smtp_user,			
			'config_smtp_pass'	  		=> $config_smtp_pass,			
			'config_smtp_port'	  		=> $config_smtp_port,			
			'config_smtp_timeout'  		=> $config_smtp_timeout,
			'config_id'		  			=> $config_id,								
			'code_msg'		 			=> $code_msg
		);		
		return $f_config;		
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));			
			$delete_query = "DELETE FROM config WHERE config_id IN(".$array_id.")";			
			if($this->db->query($delete_query)){
				$code_msg = 0;
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}
	}
	
	private function get_select_group($config_code_crr=''){
		$config_arr = array();
		
		$this->db->select('config_code');
		$this->db->from('config');	
		$this->db->order_by('config_order','asc');
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$config_arr[$row->config_code] = $row->config_code;
		}			
				
		$config_choose = '';		
		$config_code = array_values($this->config->item('modules_admin'));
		
		for($i=0; $i<count($config_code); $i++){	
			if(!isset($config_arr[$config_code[$i]])){
				if($config_code[$i] == $config_code_crr){					
					$config_choose .= '<option value="'.$config_code[$i].'" selected="selected">'.$config_code[$i].'</option>';
				}else{					
					$config_choose .= '<option value="'.$config_code[$i].'" >'.$config_code[$i].'</option>';
				}
			}
		}			
		return $config_choose;		
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
