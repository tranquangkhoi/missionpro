<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocode_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	
	public function record_count(){
        return $this->db->count_all("autocode");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('autocode');	
		$this->db->like('autocode_code', $str_like);
		if($autocodecate_id>0){
			$this->db->where('autocodecate_id', $autocodecate_id);
		}
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('autocode');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');		
		$this->db->from('autocode');		
		$this->db->like('autocode_code', $str_like);
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function add(){
		$code_msg = '';
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$autocode_code 	  	= '';	
			$autocode_review 	 	= '';
			$autocode_content 		= '';
		}else{		
			$autocode_code 	  		= $this->input->post('autocode_code');			
			$autocode_review 	 	= trim($this->input->post('autocode_review'));
			$autocode_content 		= trim($this->input->post('autocode_content'));
			
			if($autocode_code == ''){				
				$code_msg = '0';
			}
			if($autocode_review == ''){				
				$code_msg .= ',1';
			}			
			if($autocode_content == ''){				
				$code_msg .= ',2';
			}			
						
			if($code_msg==""){								
				$data_autocode = array(								   
				   'autocode_code'	 		=> $autocode_code,
				   'autocode_review' 	    => $autocode_review,
				   'autocode_content' 	    => $autocode_content
				);			
				if($this->db->insert('autocode', $data_autocode)){
					$autocode_code 	  		= '';	
					$autocode_review 	 	= '';
					$autocode_content 		= '';			
					$code_msg       		= '3';
				}
			}
		}
		/* get data return */
		$f_autocode = array(
			'autocode_code'	  		=> $autocode_code,
			'autocode_review'  	 	=> $autocode_review,
			'autocode_content'    	=> $autocode_content,			
			'code_msg'	   			=> $code_msg		
		);		
		return $f_autocode;		
	}
	
	
	public function edit(){
		$code_msg = '';	
			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$autocode_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->where('autocode_id',$autocode_id);
			$this->db->from('autocode');
			$query = $this->db->get();
			$row = $query->row();			
			$autocode_id		 	= $row->autocode_id;
			$autocode_code 	   	  	= $row->autocode_code;
			$autocode_review		= $row->autocode_review;
			$autocode_content		= $row->autocode_content;
		}else{		
			$autocode_id		 	= $this->input->post('id');
			$autocode_code 	  		= $this->input->post('autocode_code');			
			$autocode_review 	 	= trim($this->input->post('autocode_review'));
			$autocode_content 		= trim($this->input->post('autocode_content'));
			
			if($autocode_code == ''){				
				$code_msg = '0';
			}
			if($autocode_review == ''){				
				$code_msg .= ',1';
			}
			
			if($autocode_content == ''){				
				$code_msg .= ',2';
			}			
						
			if($code_msg==""){								
				$data_autocode = array(				
				   	'autocode_code'	  		=> $autocode_code,
					'autocode_review'  	 	=> $autocode_review,
					'autocode_content'    	=> $autocode_content
				);
				$this->db->where('autocode_id', $autocode_id);											
				if($this->db->update('autocode', $data_autocode)){					
					$code_msg       = '3';
				}
			}
		}
				
		/* get data return */
		$f_autocode = array(			
			'autocode_id'	  	 	=> $autocode_id,
			'autocode_code'	  		=> $autocode_code,
			'autocode_review'  	 	=> $autocode_review,
			'autocode_content'    	=> $autocode_content,				
			'code_msg'	   			=> $code_msg
		
		);		
		return $f_autocode;	
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));	
			$delete_query = "DELETE FROM autocode WHERE autocode_id IN(".$array_id.")";						
			if($this->db->query($delete_query)){
				$code_msg = 0;
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}
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
