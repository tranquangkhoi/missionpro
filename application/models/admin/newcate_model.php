<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newcate_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	public function record_count(){
        return $this->db->count_all("newcate");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('newcate');	
		$this->db->like('newcate_name', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('newcate');
		$this->db->order_by('newcate_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');
		$this->db->like('newcate_name', $str_like);
		$this->db->from('newcate');		
		$this->db->order_by('newcate_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('newcate');
		$this->db->where('newcate_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->newcate_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('newcate');
		$this->db->where('newcate_order < ',$crr_ord);
		$this->db->order_by('newcate_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->newcate_id;
			$up_ord = $row->newcate_order;
			
			$data_sort = array(				
				'newcate_order' => $crr_ord			
			);
			$this->db->where('newcate_id', $up_id);					
			$this->db->update('newcate', $data_sort);
			
			$data_sort = array(				
				'newcate_order' => $up_ord			
			);
			$this->db->where('newcate_id', $crr_id);					
			$this->db->update('newcate', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('newcate');
		$this->db->where('newcate_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->newcate_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('newcate');
		$this->db->where('newcate_order > ',$crr_ord);
		$this->db->order_by('newcate_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->newcate_id;
			$up_ord = $row->newcate_order;
			
			$data_sort = array(				
				'newcate_order' => $crr_ord			
			);
			$this->db->where('newcate_id', $up_id);					
			$this->db->update('newcate', $data_sort);
			
			$data_sort = array(				
				'newcate_order' => $up_ord			
			);
			$this->db->where('newcate_id', $crr_id);					
			$this->db->update('newcate', $data_sort);			
		}				
		
	}
	
	
	
	public function add(){
		$code_msg = '';
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$newcate_name 			= '';
			$newcate_meta_desc   	= '';
			$newcate_meta_key 		= '';					
		}else{		
			$newcate_name 	   		= $this->input->post('newcate_name');
			$newcate_meta_desc  	= $this->input->post('newcate_meta_desc');
			$newcate_meta_key   	= $this->input->post('newcate_meta_key');						
			$newcate_slug   		= linkvn_to_linken($newcate_name);
			
			if($newcate_name == ""){				
				$code_msg = '0';
			}
						
			if($code_msg==""){				
				$this->db->select_max('newcate_order', 'max_order');
				$query = $this->db->get('newcate');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
				$data_newcate = array(				
				   'newcate_name'	 		=> $newcate_name,
				   'newcate_meta_desc'		=> $newcate_meta_desc,
				   'newcate_meta_key' 		=> $newcate_meta_key,
				   'newcate_slug'			=> $newcate_slug,
				   'newcate_order' 			=> $max_order				   
				);			
				if($this->db->insert('newcate', $data_newcate)){
					$newcate_name 			= '';
					$newcate_meta_desc   	= '';
					$newcate_meta_key 		= '';
					$code_msg = '1';
				}
			}
		}
				
		
		/* get data return */
		$f_newcate = array(
			'newcate_name'	 		=> $newcate_name,
		   	'newcate_meta_desc'		=> $newcate_meta_desc,
			'newcate_meta_key' 		=> $newcate_meta_key,
			'code_msg'	     		=> $code_msg
		);		
		return $f_newcate;		
	}
	
	
	public function edit(){
		$code_msg = '';			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$newcate_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
					
			$this->db->select('*');
			$this->db->from('newcate');
			$this->db->where('newcate_id',$newcate_id);
			$query = $this->db->get();
			$row = $query->row();			
			$newcate_id		 		= $row->newcate_id;
			$newcate_name 	   		= $row->newcate_name;
			$newcate_meta_desc  	= $row->newcate_meta_desc;
			$newcate_meta_key   	= $row->newcate_meta_key;									
		}else{		
			$id			   			= $this->input->post('id');
			$newcate_id		 		= $id;
			$newcate_name 	   		= $this->input->post('newcate_name');
			$newcate_meta_desc  	= $this->input->post('newcate_meta_desc');
			$newcate_meta_key   	= $this->input->post('newcate_meta_key');						
			$newcate_slug   		= linkvn_to_linken($newcate_name);			
			if($newcate_name == ""){				
				$code_msg = '0';
			}		
								
			if($code_msg==""){
				
				$data_newcate = array(				
				   'newcate_name'	 		=> $newcate_name,
				   'newcate_meta_desc'		=> $newcate_meta_desc,
				   'newcate_meta_key' 		=> $newcate_meta_key,
				   'newcate_slug'			=> $newcate_slug				   	   
				);	
				$this->db->where('newcate_id', $newcate_id);					
				if($this->db->update('newcate', $data_newcate)){					
					$code_msg = '1';																
				}
			}
		}
		
		/* get data return */
		$f_newcate = array(
			'newcate_id'		  	=> $newcate_id,								
			'code_msg'		  		=> $code_msg,
			'newcate_name'	 		=> $newcate_name,
		   	'newcate_meta_desc'		=> $newcate_meta_desc,
		   	'newcate_meta_key' 		=> $newcate_meta_key,
		);		
		return $f_newcate;		
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));	
						
			$dir_new = './public/upload/new/';
			$select_query = "SELECT new_image FROM news WHERE newcate_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$new_image = $row->new_image;
				$this->back->delete_file($dir_new, $new_image);
				$this->back->delete_file($dir_new, 'small_'.$new_image);				
			}
			$delete_query = "DELETE FROM news WHERE newcate_id IN(".$array_id.")";
			$this->db->query($delete_query);
			$delete_query = "DELETE FROM newcate WHERE newcate_id IN(".$array_id.")";			
			if($this->db->query($delete_query)){
				$code_msg = 0;
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}
	}
	
	private function get_select_group($newcate_code_crr=''){
		$newcate_arr = array();
		
		$this->db->select('newcate_code');
		$this->db->from('newcate');	
		$this->db->order_by('newcate_order','asc');
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$newcate_arr[$row->newcate_code] = $row->newcate_code;
		}			
				
		$newcate_choose = '';		
		$newcate_code = array_values($this->config->item('modules_admin'));
		
		for($i=0; $i<count($newcate_code); $i++){	
			if(!isset($newcate_arr[$newcate_code[$i]])){
				if($newcate_code[$i] == $newcate_code_crr){					
					$newcate_choose .= '<option value="'.$newcate_code[$i].'" selected="selected">'.$newcate_code[$i].'</option>';
				}else{					
					$newcate_choose .= '<option value="'.$newcate_code[$i].'" >'.$newcate_code[$i].'</option>';
				}
			}
		}			
		return $newcate_choose;		
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
