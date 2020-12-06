<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attri_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function record_count(){
        return $this->db->count_all("attri");
    }
	
	public function record_count_filter($str_like, $attricate_id){		
		$this->db->from('attri');	
		$this->db->like('attri_title', $str_like);
		if($attricate_id>0){
			$this->db->where('attricate_id', $attricate_id);
		}
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('attri');
		$this->db->order_by('attricate_id','asc');
		$this->db->order_by('attri_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like, $attricate_id){
		$this->db->select('*');		
		$this->db->from('attri');		
		$this->db->like('attri_title', $str_like);
		if($attricate_id>0){
			$this->db->where('attricate_id', $attricate_id);
		}
		$this->db->order_by('attri_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('attri');
		$this->db->where('attri_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->attri_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('attri');
		$this->db->where('attri_order < ',$crr_ord);
		$this->db->order_by('attri_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->attri_id;
			$up_ord = $row->attri_order;
			
			$data_sort = array(				
				'attri_order' => $crr_ord			
			);
			$this->db->where('attri_id', $up_id);					
			$this->db->update('attri', $data_sort);
			
			$data_sort = array(				
				'attri_order' => $up_ord			
			);
			$this->db->where('attri_id', $crr_id);					
			$this->db->update('attri', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('attri');
		$this->db->where('attri_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->attri_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('attri');
		$this->db->where('attri_order > ',$crr_ord);
		$this->db->order_by('attri_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->attri_id;
			$up_ord = $row->attri_order;
			
			$data_sort = array(				
				'attri_order' => $crr_ord			
			);
			$this->db->where('attri_id', $up_id);					
			$this->db->update('attri', $data_sort);
			
			$data_sort = array(				
				'attri_order' => $up_ord			
			);
			$this->db->where('attri_id', $crr_id);					
			$this->db->update('attri', $data_sort);			
		}				
		
	}
	
	public function add(){
		$code_msg = '';
		$attricate_id = $this->input->get_post('attricate_id');
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$attri_title 	  = '';								
		}else{		
			$attri_title 	  = $this->input->post('attri_title');				
			
			if($attri_title == ''){				
				$code_msg = '0';
			}
			
						
			if($code_msg==""){	
				$this->db->select_max('attri_order', 'max_order');
				$query = $this->db->get('attri');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
											
				$data_attri = array(				
				   'attri_title'	 		=> $attri_title,
				   'attricate_id'	 	   => $attricate_id,				   
				   'attri_order' 	 		=> $max_order
				);			
				if($this->db->insert('attri', $data_attri)){
					$attri_title 	  = '';
					$code_msg       = '3';
				}
			}
		}
				
				
		$str_attricate_choose = $this->get_select_attricate($attricate_id);	
		
		/* get data return */
		$f_attri = array(
			'attri_title'	  => $attri_title,			
			'attricate_choose' => $str_attricate_choose,						
			'code_msg'	   => $code_msg
		
		);		
		return $f_attri;		
	}
	
	
	public function edit(){
		$code_msg = '';	
			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$attri_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('attri');
			$this->db->where('attri_id',$attri_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$attri_id		 	 = $row->attri_id;
			$attricate_id	 	 = $row->attricate_id;
			$attri_title 	   	  = $row->attri_title;			
		}else{		
			$attri_id		 = $this->input->post('id');
			$attri_title 	  = $this->input->post('attri_title');
			$attricate_id 	 = $this->input->post('attricate_id');			
			
			
			if($attri_title == ''){				
				$code_msg = '0';
			}			
						
			if($code_msg==""){								
				$data_attri = array(				
				   'attri_title'	 		=> $attri_title,
				   'attricate_id'	 	   => $attricate_id				  
				);
				$this->db->where('attri_id', $attri_id);											
				if($this->db->update('attri', $data_attri)){					
					$code_msg       = '3';
				}
			}
		}
		
		$str_attricate_choose = $this->get_select_attricate($attricate_id);
		
		/* get data return */
		$f_attri = array(
			'attri_id'	  	 => $attri_id,
			'attri_title'	  => $attri_title,			
			'attricate_choose' => $str_attricate_choose,									
			'code_msg'	   => $code_msg
		
		);		
		return $f_attri;	
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));		
			$delete_query = "DELETE FROM attri WHERE attri_id IN(".$array_id.")";						
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
		$sql = "SELECT * FROM attri WHERE attri_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$attri_image = $row->attri_image;
		$this->back->delete_file('./public/upload/attri/', $attri_image);
		$this->back->delete_file('./public/upload/attri/', 'small_'.$attri_image);
		$sql = "UPDATE attri SET attri_image = '' WHERE attri_id=".$id;
		if($this->db->query($sql)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	private function get_select_attricate($attricate_id=''){
		$category_name = $this->get_category_name();
		$this->db->select('attricate_id, attricate_title,category_id');
		$this->db->from('attricate');		
		$this->db->order_by('attricate_order','asc');
		$query = $this->db->get();
		$attricate_choose = '';
		foreach($query->result() as $row){			
			if($row->attricate_id == $attricate_id){
				$attricate_choose .= "<option value=".$row->attricate_id." selected>".$row->attricate_title." (".$category_name[$row->category_id].")</option>";
			}else{
				$attricate_choose .= "<option value=".$row->attricate_id.">".$row->attricate_title." (".$category_name[$row->category_id].")</option>";
			}
		}
		return $attricate_choose;		
	}
	
	public function get_select_attricate_full($attricate_id=''){
		$category_name = $this->get_category_name();
		$this->db->select('attricate_id, attricate_title, category_id');
		$this->db->from('attricate');		
		$this->db->order_by('category_id','asc');
		$this->db->order_by('attricate_order','asc');
		$query = $this->db->get();
		$attricate_choose = '<option value="0">Tất cả nhóm thuộc tính</option>';
		
		foreach($query->result() as $row){			
			if($row->attricate_id == $attricate_id){
				$attricate_choose .= "<option value=".$row->attricate_id." selected>".$row->attricate_title." (".$category_name[$row->category_id].")</option>";
			}else{
				$attricate_choose .= "<option value=".$row->attricate_id.">".$row->attricate_title." (".$category_name[$row->category_id].")</option>";
			}
		}
		return $attricate_choose;		
	}
	
	private function get_frames(){
		$f_arr = array();
		$this->db->select('frame_code, frame_name');
		$this->db->from('system_frame');	
		$this->db->order_by('frame_order','asc');
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
	
	public function get_category_name(){
		$sql = 'SELECT category_id, category_name  FROM category ORDER BY category_select';
		$query = $this->db->query($sql);		
		$category_name = array();
		foreach($query->result() as $row){			
			$category_name[$row->category_id] = $row->category_name;		
		}
		return $category_name;		
	}
	
	public function get_attricate_name(){
		$category_name = $this->get_category_name();
		$sql = 'SELECT attricate_id, category_id, attricate_title  FROM attricate';
		$query = $this->db->query($sql);		
		$attricate_name = array();
		foreach($query->result() as $row){			
			$attricate_name[$row->attricate_id] = $row->attricate_title." (".$category_name[$row->category_id].")";		
		}
		return $attricate_name;		
	}
	
}
