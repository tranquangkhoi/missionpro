<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	public function record_count(){
        return $this->db->count_all("chat");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('chat');	
		$this->db->like('chat_name', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('chat');
		$this->db->order_by('chat_type','asc');
		$this->db->order_by('chat_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');
		$this->db->like('chat_name', $str_like);
		$this->db->from('chat');		
		$this->db->order_by('chat_type','asc');
		$this->db->order_by('chat_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('chat');
		$this->db->where('chat_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->chat_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('chat');
		$this->db->where('chat_order < ',$crr_ord);
		$this->db->order_by('chat_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->chat_id;
			$up_ord = $row->chat_order;
			
			$data_sort = array(				
				'chat_order' => $crr_ord			
			);
			$this->db->where('chat_id', $up_id);					
			$this->db->update('chat', $data_sort);
			
			$data_sort = array(				
				'chat_order' => $up_ord			
			);
			$this->db->where('chat_id', $crr_id);					
			$this->db->update('chat', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('chat');
		$this->db->where('chat_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->chat_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('chat');
		$this->db->where('chat_order > ',$crr_ord);
		$this->db->order_by('chat_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->chat_id;
			$up_ord = $row->chat_order;
			
			$data_sort = array(				
				'chat_order' => $crr_ord			
			);
			$this->db->where('chat_id', $up_id);					
			$this->db->update('chat', $data_sort);
			
			$data_sort = array(				
				'chat_order' => $up_ord			
			);
			$this->db->where('chat_id', $crr_id);					
			$this->db->update('chat', $data_sort);			
		}				
		
	}
	
	
	
	public function add(){
		$code_msg = '';		
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$chat_name   = '';
			$chat_nick   = '';
			$chat_type   = '';					
		}else{		
			$chat_name 	= $this->input->post('chat_name');			
			$chat_nick    = $this->input->post('chat_nick');
			$chat_type    = is_numeric($this->input->post('chat_type')) ? $this->input->post('chat_type') : '0';			
			
			if($chat_nick == ""){				
				$code_msg = '0';
			}
						
			if($code_msg==""){				
				$this->db->select_max('chat_order', 'max_order');
				$query = $this->db->get('chat');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
				$data_chat = array(				
				   'chat_name'	 => $chat_name,				   
				   'chat_nick'	 => $chat_nick,
				   'chat_type'     => $chat_type,
				   'chat_order' 	=> $max_order				   
				);			
				if($this->db->insert('chat', $data_chat)){
					$chat_name 	= '';
					$chat_nick   = '';
					$chat_type 	= '';								
					$code_msg = '1';
				}
			}
		}
				
		
		/* get data return */
		$f_chat = array(
			'chat_name'	=> $chat_name,
			'chat_nick'	=> $chat_nick,
			'chat_type' 	=> $chat_type,					
			'code_msg'	 => $code_msg
		);		
		return $f_chat;		
	}
	
	
	public function edit(){
		$code_msg = '';			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$chat_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
					
			$this->db->select('*');
			$this->db->from('chat');
			$this->db->where('chat_id',$chat_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$chat_id		 = $row->chat_id;
			$chat_name 	   = $row->chat_name;
			$chat_nick  	   = $row->chat_nick;
			$chat_type       = $row->chat_type;									
		}else{		
			$id			  = $this->input->post('id');
			$chat_id		 = $id;
			$chat_name 	   = $this->input->post('chat_name');			
			$chat_nick  	   = $this->input->post('chat_nick');
			$chat_type       = is_numeric($this->input->post('chat_type')) ? $this->input->post('chat_type') : '0';							
			
			if($chat_nick == ""){				
				$code_msg = '0';
			}		
								
			if($code_msg==""){
				
				$data_chat = array(				
				   'chat_name'		=> $chat_name,				  
				   'chat_nick'   => $chat_nick,
				   'chat_type'	=> $chat_type				   
				);	
				$this->db->where('chat_id', $chat_id);					
				if($this->db->update('chat', $data_chat)){					
					$code_msg = '1';																
				}
			}
		}
		
		/* get data return */
		$f_chat = array(
			'chat_id'		  => $chat_id,
			'chat_name'	 	=> $chat_name,
			'chat_nick'   		=> $chat_nick,
			'chat_type' 		=> $chat_type,					
			'code_msg'		 => $code_msg
		);		
		return $f_chat;		
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));			
			$delete_query = "DELETE FROM chat WHERE chat_id IN(".$array_id.")";			
			if($this->db->query($delete_query)){
				$code_msg = 0;
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}
	}
	
	private function get_select_group($chat_code_crr=''){
		$chat_arr = array();
		
		$this->db->select('chat_code');
		$this->db->from('chat');	
		$this->db->order_by('chat_order','asc');
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$chat_arr[$row->chat_code] = $row->chat_code;
		}			
				
		$chat_choose = '';		
		$chat_code = array_values($this->config->item('modules_admin'));
		
		for($i=0; $i<count($chat_code); $i++){	
			if(!isset($chat_arr[$chat_code[$i]])){
				if($chat_code[$i] == $chat_code_crr){					
					$chat_choose .= '<option value="'.$chat_code[$i].'" selected="selected">'.$chat_code[$i].'</option>';
				}else{					
					$chat_choose .= '<option value="'.$chat_code[$i].'" >'.$chat_code[$i].'</option>';
				}
			}
		}			
		return $chat_choose;		
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
