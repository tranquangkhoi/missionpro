<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bannercate_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function record_count(){
        return $this->db->count_all("bannercate");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('bannercate');	
		$this->db->like('bannercate_name', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('bannercate');
		$this->db->order_by('bannercate_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');
		$this->db->like('bannercate_name', $str_like);
		$this->db->from('bannercate');		
		$this->db->order_by('bannercate_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('bannercate');
		$this->db->where('bannercate_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->bannercate_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('bannercate');
		$this->db->where('bannercate_order < ',$crr_ord);
		$this->db->order_by('bannercate_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->bannercate_id;
			$up_ord = $row->bannercate_order;
			
			$data_sort = array(				
				'bannercate_order' => $crr_ord			
			);
			$this->db->where('bannercate_id', $up_id);					
			$this->db->update('bannercate', $data_sort);
			
			$data_sort = array(				
				'bannercate_order' => $up_ord			
			);
			$this->db->where('bannercate_id', $crr_id);					
			$this->db->update('bannercate', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('bannercate');
		$this->db->where('bannercate_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->bannercate_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('bannercate');
		$this->db->where('bannercate_order > ',$crr_ord);
		$this->db->order_by('bannercate_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->bannercate_id;
			$up_ord = $row->bannercate_order;
			
			$data_sort = array(				
				'bannercate_order' => $crr_ord			
			);
			$this->db->where('bannercate_id', $up_id);					
			$this->db->update('bannercate', $data_sort);
			
			$data_sort = array(				
				'bannercate_order' => $up_ord			
			);
			$this->db->where('bannercate_id', $crr_id);					
			$this->db->update('bannercate', $data_sort);			
		}				
		
	}
	
	
	
	public function add(){
		$code_msg = '';
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$bannercate_name 	 	= '';
			$bannercate_meta_desc   = '';
			$bannercate_meta_key	= '';
			$bannercate_block 	   = 0;					
		}else{		
			$bannercate_name 	   = $this->input->post('bannercate_name');
			$bannercate_meta_desc  = $this->input->post('bannercate_meta_desc');
			$bannercate_meta_key   = $this->input->post('bannercate_meta_key');
			$bannercate_block 	  = is_numeric($this->input->post('bannercate_block')) ? $this->input->post('bannercate_block') : 0;			
			
			if($bannercate_name == ""){				
				$code_msg = '0';
			}
						
			if($code_msg==""){				
				$this->db->select_max('bannercate_order', 'max_order');
				$query = $this->db->get('bannercate');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
				$data_bannercate = array(				
				   'bannercate_name'	 => $bannercate_name,
				   'bannercate_meta_desc'=> $bannercate_meta_desc,
				   'bannercate_meta_key' => $bannercate_meta_key,				   
				   'bannercate_block'	=> $bannercate_block,
				   'bannercate_order' 	=> $max_order				   
				);			
				if($this->db->insert('bannercate', $data_bannercate)){
					$bannercate_name 		= '';	
					$bannercate_meta_desc   = '';
					$bannercate_meta_key	= '';												
					$code_msg 			  = '1';
				}
			}
		}
				
		
		/* get data return */
		$f_bannercate = array(
			'bannercate_name'	 => $bannercate_name,
			'bannercate_meta_desc'=> $bannercate_meta_desc,
		    'bannercate_meta_key' => $bannercate_meta_key,
			'bannercate_block'	=> $bannercate_block,					
			'code_msg'	  	   => $code_msg
		);		
		return $f_bannercate;		
	}
	
	
	public function edit(){
		$code_msg = '';			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$bannercate_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
					
			$this->db->select('*');
			$this->db->from('bannercate');
			$this->db->where('bannercate_id',$bannercate_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$bannercate_id		 = $row->bannercate_id;
			$bannercate_name 	   = $row->bannercate_name;
			$bannercate_meta_desc  = $row->bannercate_meta_desc;
			$bannercate_meta_key   = $row->bannercate_meta_key;
			$bannercate_block 	  = $row->bannercate_block;						
		}else{		
			$id			   	   = $this->input->post('id');
			$bannercate_id		 = $id;
			$bannercate_name 	   = $this->input->post('bannercate_name');
			$bannercate_meta_desc  = $this->input->post('bannercate_meta_desc');
			$bannercate_meta_key   = $this->input->post('bannercate_meta_key');
			$bannercate_block 	  = is_numeric($this->input->post('bannercate_block')) ? $this->input->post('bannercate_block') : 0;							
			
			if($bannercate_name == ""){				
				$code_msg = '0';
			}		
								
			if($code_msg==""){
				
				$data_bannercate = array(				
				   'bannercate_name'		=> $bannercate_name,
				   'bannercate_meta_desc'   => $bannercate_meta_desc,
				   'bannercate_meta_key'    => $bannercate_meta_key,
				   'bannercate_block'	   => $bannercate_block				   
				);	
				$this->db->where('bannercate_id', $bannercate_id);					
				if($this->db->update('bannercate', $data_bannercate)){					
					$code_msg = '1';																
				}
			}
		}
		
		/* get data return */
		$f_bannercate = array(
			'bannercate_id'		  => $bannercate_id,
			'bannercate_name'		=> $bannercate_name,
			'bannercate_meta_desc'   => $bannercate_meta_desc,
			'bannercate_meta_key' 	=> $bannercate_meta_key,
			'bannercate_block'	   => $bannercate_block,					
			'code_msg'		  	  => $code_msg
		);		
		return $f_bannercate;		
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));	
						
			$dir_banner = './public/upload/banner/';
			$select_query = "SELECT banner_image FROM banner WHERE bannercate_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$banner_image = $row->banner_image;
				$this->back->delete_file($dir_banner, $banner_image);
				$this->back->delete_file($dir_banner, 'small_'.$banner_image);				
			}
			$delete_query = "DELETE FROM banner WHERE bannercate_id IN(".$array_id.")";
			$this->db->query($delete_query);
			$delete_query = "DELETE FROM bannercate WHERE bannercate_id IN(".$array_id.")";			
			if($this->db->query($delete_query)){
				$code_msg = 0;
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}
	}
	
	private function get_select_group($bannercate_code_crr=''){
		$bannercate_arr = array();
		
		$this->db->select('bannercate_code');
		$this->db->from('bannercate');	
		$this->db->order_by('bannercate_order','asc');
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$bannercate_arr[$row->bannercate_code] = $row->bannercate_code;
		}			
				
		$bannercate_choose = '';		
		$bannercate_code = array_values($this->config->item('modules_admin'));
		
		for($i=0; $i<count($bannercate_code); $i++){	
			if(!isset($bannercate_arr[$bannercate_code[$i]])){
				if($bannercate_code[$i] == $bannercate_code_crr){					
					$bannercate_choose .= '<option value="'.$bannercate_code[$i].'" selected="selected">'.$bannercate_code[$i].'</option>';
				}else{					
					$bannercate_choose .= '<option value="'.$bannercate_code[$i].'" >'.$bannercate_code[$i].'</option>';
				}
			}
		}			
		return $bannercate_choose;		
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
