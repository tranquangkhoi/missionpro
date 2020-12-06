<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Province_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function record_count(){
        return $this->db->count_all("province");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('province');	
		$this->db->like('province_name', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('province');
		$this->db->order_by('province_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');
		$this->db->like('province_name', $str_like);
		$this->db->from('province');		
		$this->db->order_by('province_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('province');
		$this->db->where('province_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->province_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('province');
		$this->db->where('province_order < ',$crr_ord);
		$this->db->order_by('province_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->province_id;
			$up_ord = $row->province_order;
			
			$data_sort = array(				
				'province_order' => $crr_ord			
			);
			$this->db->where('province_id', $up_id);					
			$this->db->update('province', $data_sort);
			
			$data_sort = array(				
				'province_order' => $up_ord			
			);
			$this->db->where('province_id', $crr_id);					
			$this->db->update('province', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('province');
		$this->db->where('province_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->province_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('province');
		$this->db->where('province_order > ',$crr_ord);
		$this->db->order_by('province_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->province_id;
			$up_ord = $row->province_order;
			
			$data_sort = array(				
				'province_order' => $crr_ord			
			);
			$this->db->where('province_id', $up_id);					
			$this->db->update('province', $data_sort);
			
			$data_sort = array(				
				'province_order' => $up_ord			
			);
			$this->db->where('province_id', $crr_id);					
			$this->db->update('province', $data_sort);			
		}				
		
	}
	
	
	
	public function add(){
		$code_msg = '';
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$province_name 	 	= '';					
		}else{		
			$province_name 	   	= $this->input->post('province_name');
						
			if($province_name == ""){				
				$code_msg = '0';
			}
						
			if($code_msg==""){				
				$this->db->select_max('province_order', 'max_order');
				$query = $this->db->get('province');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
				$data_province = array(				
				   'province_name'	 		=> $province_name,
				   'province_order' 		=> $max_order				   
				);			
				if($this->db->insert('province', $data_province)){
					$province_name 	 	= '';												
					$code_msg 			  	= '1';
				}
			}
		}
				
		
		/* get data return */
		$f_province = array(
			'province_name'	 		=> $province_name,			
			'code_msg'	  	   		=> $code_msg
		);		
		return $f_province;		
	}
	
	
	public function edit(){
		$code_msg = '';			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$province_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
					
			$this->db->select('*');
			$this->db->from('province');
			$this->db->where('province_id',$province_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$province_id		 	= $row->province_id;
			$province_name 	   	= $row->province_name;				
		}else{		
			$id			   	   		= $this->input->post('id');
			$province_id		 	= $id;
			$province_name 	   		= $this->input->post('province_name');
			
			if($province_name == ""){				
				$code_msg = '0';
			}		
								
			if($code_msg==""){
				
				$data_province = array(				
				   'province_name'			=> $province_name	   
				);	
				$this->db->where('province_id', $province_id);					
				if($this->db->update('province', $data_province)){					
					$code_msg = '1';																
				}
			}
		}
		
		/* get data return */
		$f_province = array(
			'province_id'		  	=> $province_id,
			'province_name'			=> $province_name,					
			'code_msg'		  	  	=> $code_msg
		);		
		return $f_province;		
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));	
						
			$dir_intro = './public/upload/intro/';
			$select_query = "SELECT intro_image FROM intro WHERE province_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$intro_image = $row->intro_image;
				$this->back->delete_file($dir_intro, $intro_image);
				$this->back->delete_file($dir_intro, 'small_'.$intro_image);				
			}
			$delete_query = "DELETE FROM intro WHERE province_id IN(".$array_id.")";
			$this->db->query($delete_query);
			$delete_query = "DELETE FROM province WHERE province_id IN(".$array_id.")";			
			if($this->db->query($delete_query)){
				$code_msg = 0;
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}
	}
	
	private function get_select_group($province_code_crr=''){
		$province_arr = array();
		
		$this->db->select('province_code');
		$this->db->from('province');	
		$this->db->order_by('province_order','asc');
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$province_arr[$row->province_code] = $row->province_code;
		}			
				
		$province_choose = '';		
		$province_code = array_values($this->config->item('modules_admin'));
		
		for($i=0; $i<count($province_code); $i++){	
			if(!isset($province_arr[$province_code[$i]])){
				if($province_code[$i] == $province_code_crr){					
					$province_choose .= '<option value="'.$province_code[$i].'" selected="selected">'.$province_code[$i].'</option>';
				}else{					
					$province_choose .= '<option value="'.$province_code[$i].'" >'.$province_code[$i].'</option>';
				}
			}
		}			
		return $province_choose;		
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
