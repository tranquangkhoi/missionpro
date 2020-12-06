<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frame_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function record_count(){
        return $this->db->count_all("system_frame");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('system_frame');	
		$this->db->like('frame_name', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('system_frame');
		$this->db->order_by('frame_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');
		$this->db->like('frame_name', $str_like);
		$this->db->from('system_frame');		
		$this->db->order_by('frame_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('system_frame');
		$this->db->where('frame_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->frame_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('system_frame');
		$this->db->where('frame_order < ',$crr_ord);
		$this->db->order_by('frame_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->frame_id;
			$up_ord = $row->frame_order;
			
			$data_sort = array(				
				'frame_order' => $crr_ord			
			);
			$this->db->where('frame_id', $up_id);					
			$this->db->update('system_frame', $data_sort);
			
			$data_sort = array(				
				'frame_order' => $up_ord			
			);
			$this->db->where('frame_id', $crr_id);					
			$this->db->update('system_frame', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('system_frame');
		$this->db->where('frame_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->frame_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('system_frame');
		$this->db->where('frame_order > ',$crr_ord);
		$this->db->order_by('frame_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->frame_id;
			$up_ord = $row->frame_order;
			
			$data_sort = array(				
				'frame_order' => $crr_ord			
			);
			$this->db->where('frame_id', $up_id);					
			$this->db->update('system_frame', $data_sort);
			
			$data_sort = array(				
				'frame_order' => $up_ord			
			);
			$this->db->where('frame_id', $crr_id);					
			$this->db->update('system_frame', $data_sort);			
		}				
		
	}
	
	
	
	public function add(){
		$code_msg = '';
		$frame_code = $this->input->get_post('frame_code');
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$frame_name 	= '';					
		}else{		
			$frame_name 	   = $this->input->post('frame_name');			
			
			if($frame_name == ""){				
				$code_msg = '0';
			}
						
			if($code_msg==""){				
				$this->db->select_max('frame_order', 'max_order');
				$query = $this->db->get('system_frame');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
				$data_frame = array(				
				   'frame_name'	 => $frame_name,
				   'frame_code' 	 => $frame_code,
				   'frame_order' 	=> $max_order				   
				);			
				if($this->db->insert('system_frame', $data_frame)){
					$frame_name 	= '';
					$frame_code	= '';					
					$code_msg = '1';
				}
			}
		}
				
				
		$str_frame_choose = $this->get_select_group($frame_code);		
		
		/* get data return */
		$f_frame = array(
			'frame_name'	 => $frame_name,
			'frame_choose'   => $str_frame_choose,			
			'code_msg'	   => $code_msg
		);		
		return $f_frame;		
	}
	
	
	public function edit(){
		$code_msg = '';			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$frame_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
					
			$this->db->select('*');
			$this->db->from('system_frame');
			$this->db->where('frame_id',$frame_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$frame_id		 = $row->frame_id;
			$frame_name 	   = $row->frame_name;
			$frame_code 	   = $row->frame_code;			
		}else{		
			$id			   = $this->input->post('id');
			$frame_id		 = $id;
			$frame_name 	   = $this->input->post('frame_name');
			$frame_code 	   = $this->input->post('frame_hide_code');				
			
			if($frame_name == ""){				
				$code_msg = '0';
			}		
								
			if($code_msg==""){
				
				$data_frame = array(				
				   'frame_name'		=> $frame_name,
				   'frame_code' 		=> $frame_code
				);	
				$this->db->where('frame_id', $frame_id);					
				if($this->db->update('system_frame', $data_frame)){					
					$code_msg = '1';																
				}
			}
		}
		
		/* get data return */
		$f_frame = array(
			'frame_id'		  => $frame_id,
			'frame_name'		=> $frame_name,
			'frame_code' 		=> $frame_code,			
			'code_msg'		  => $code_msg
		);		
		return $f_frame;		
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));
			$delete_query = "DELETE FROM system_frame WHERE frame_id IN(".$array_id.")";
			if($this->db->query($delete_query)){
				$code_msg = 0;
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}
	}
	
	private function get_select_group($frame_code_crr=''){
		$frame_arr = array();
		
		$this->db->select('frame_code');
		$this->db->from('system_frame');	
		$this->db->order_by('frame_order','asc');
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$frame_arr[$row->frame_code] = $row->frame_code;
		}			
				
		$frame_choose = '';		
		$frame_code = array_values($this->config->item('modules_admin'));
		
		for($i=0; $i<count($frame_code); $i++){	
			if(!isset($frame_arr[$frame_code[$i]])){
				if($frame_code[$i] == $frame_code_crr){					
					$frame_choose .= '<option value="'.$frame_code[$i].'" selected="selected">'.$frame_code[$i].'</option>';
				}else{					
					$frame_choose .= '<option value="'.$frame_code[$i].'" >'.$frame_code[$i].'</option>';
				}
			}
		}			
		return $frame_choose;		
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
