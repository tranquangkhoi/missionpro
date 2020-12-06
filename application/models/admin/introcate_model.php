<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Introcate_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function record_count(){
        return $this->db->count_all("introcate");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('introcate');	
		$this->db->like('introcate_name', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('introcate');
		$this->db->order_by('introcate_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');
		$this->db->like('introcate_name', $str_like);
		$this->db->from('introcate');		
		$this->db->order_by('introcate_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('introcate');
		$this->db->where('introcate_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->introcate_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('introcate');
		$this->db->where('introcate_order < ',$crr_ord);
		$this->db->order_by('introcate_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->introcate_id;
			$up_ord = $row->introcate_order;
			
			$data_sort = array(				
				'introcate_order' => $crr_ord			
			);
			$this->db->where('introcate_id', $up_id);					
			$this->db->update('introcate', $data_sort);
			
			$data_sort = array(				
				'introcate_order' => $up_ord			
			);
			$this->db->where('introcate_id', $crr_id);					
			$this->db->update('introcate', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('introcate');
		$this->db->where('introcate_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->introcate_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('introcate');
		$this->db->where('introcate_order > ',$crr_ord);
		$this->db->order_by('introcate_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->introcate_id;
			$up_ord = $row->introcate_order;
			
			$data_sort = array(				
				'introcate_order' => $crr_ord			
			);
			$this->db->where('introcate_id', $up_id);					
			$this->db->update('introcate', $data_sort);
			
			$data_sort = array(				
				'introcate_order' => $up_ord			
			);
			$this->db->where('introcate_id', $crr_id);					
			$this->db->update('introcate', $data_sort);			
		}				
		
	}
	
	
	
	public function add(){
		$code_msg = '';
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$introcate_name 	 	= '';
			$introcate_meta_desc   	= '';
			$introcate_meta_key		= '';
			$introcate_block 	   	= 0;					
		}else{		
			$introcate_name 	   	= $this->input->post('introcate_name');
			$introcate_meta_desc  	= $this->input->post('introcate_meta_desc');
			$introcate_meta_key   	= $this->input->post('introcate_meta_key');			
			$introcate_block 	  = is_numeric($this->input->post('introcate_block')) ? $this->input->post('introcate_block') : 0;			
			
			if($introcate_name == ""){				
				$code_msg = '0';
			}
						
			if($code_msg==""){				
				$this->db->select_max('introcate_order', 'max_order');
				$query = $this->db->get('introcate');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
				$data_introcate = array(				
				   'introcate_name'	 		=> $introcate_name,
				   'introcate_meta_desc'	=> $introcate_meta_desc,
				   'introcate_meta_key' 	=> $introcate_meta_key,				   				   
				   'introcate_block'		=> $introcate_block,
				   'introcate_order' 		=> $max_order				   
				);			
				if($this->db->insert('introcate', $data_introcate)){
					$introcate_name 	 	= '';
					$introcate_meta_desc   	= '';
					$introcate_meta_key		= '';												
					$code_msg 			  	= '1';
				}
			}
		}
				
		
		/* get data return */
		$f_introcate = array(
			'introcate_name'	 	=> $introcate_name,
		   	'introcate_meta_desc'	=> $introcate_meta_desc,
			'introcate_meta_key' 	=> $introcate_meta_key,
			'introcate_block'		=> $introcate_block,					
			'code_msg'	  	   		=> $code_msg
		);		
		return $f_introcate;		
	}
	
	
	public function edit(){
		$code_msg = '';			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$introcate_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
					
			$this->db->select('*');
			$this->db->from('introcate');
			$this->db->where('introcate_id',$introcate_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$introcate_id		 	= $row->introcate_id;
			$introcate_name 	   	= $row->introcate_name;
			$introcate_meta_desc  	= $row->introcate_meta_desc;
			$introcate_meta_key   	= $row->introcate_meta_key;
			$introcate_block 	  	= $row->introcate_block;						
		}else{		
			$id			   	   		= $this->input->post('id');
			$introcate_id		 	= $id;
			$introcate_name 	   	= $this->input->post('introcate_name');
			$introcate_meta_desc  	= $this->input->post('introcate_meta_desc');
			$introcate_meta_key   	= $this->input->post('introcate_meta_key');
			$introcate_block 	  	= is_numeric($this->input->post('introcate_block')) ? $this->input->post('introcate_block') : 0;							
			
			if($introcate_name == ""){				
				$code_msg = '0';
			}		
								
			if($code_msg==""){
				
				$data_introcate = array(				
				   'introcate_name'			=> $introcate_name,
				   'introcate_meta_desc'   	=> $introcate_meta_desc,
				   'introcate_meta_key'    	=> $introcate_meta_key,
				   'introcate_block'	   	=> $introcate_block				   
				);	
				$this->db->where('introcate_id', $introcate_id);					
				if($this->db->update('introcate', $data_introcate)){					
					$code_msg = '1';																
				}
			}
		}
		
		/* get data return */
		$f_introcate = array(
			'introcate_id'		  		=> $introcate_id,
			'introcate_name'			=> $introcate_name,
			'introcate_meta_desc'   	=> $introcate_meta_desc,
			'introcate_meta_key' 		=> $introcate_meta_key,
			'introcate_block'	   		=> $introcate_block,					
			'code_msg'		  	  		=> $code_msg
		);		
		return $f_introcate;		
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));	
						
			$dir_intro = './public/upload/intro/';
			$select_query = "SELECT intro_image FROM intro WHERE introcate_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$intro_image = $row->intro_image;
				$this->back->delete_file($dir_intro, $intro_image);
				$this->back->delete_file($dir_intro, 'small_'.$intro_image);				
			}
			$delete_query = "DELETE FROM intro WHERE introcate_id IN(".$array_id.")";
			$this->db->query($delete_query);
			$delete_query = "DELETE FROM introcate WHERE introcate_id IN(".$array_id.")";			
			if($this->db->query($delete_query)){
				$code_msg = 0;
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}
	}
	
	private function get_select_group($introcate_code_crr=''){
		$introcate_arr = array();
		
		$this->db->select('introcate_code');
		$this->db->from('introcate');	
		$this->db->order_by('introcate_order','asc');
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$introcate_arr[$row->introcate_code] = $row->introcate_code;
		}			
				
		$introcate_choose = '';		
		$introcate_code = array_values($this->config->item('modules_admin'));
		
		for($i=0; $i<count($introcate_code); $i++){	
			if(!isset($introcate_arr[$introcate_code[$i]])){
				if($introcate_code[$i] == $introcate_code_crr){					
					$introcate_choose .= '<option value="'.$introcate_code[$i].'" selected="selected">'.$introcate_code[$i].'</option>';
				}else{					
					$introcate_choose .= '<option value="'.$introcate_code[$i].'" >'.$introcate_code[$i].'</option>';
				}
			}
		}			
		return $introcate_choose;		
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
