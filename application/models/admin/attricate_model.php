<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attricate_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function record_count(){
        return $this->db->count_all("attricate");
    }
	
	public function record_count_filter($str_like, $category_id){		
		$this->db->from('attricate');	
		$this->db->like('attricate_title', $str_like);
		if($category_id>0){
			$this->db->where('category_id', $category_id);
		}
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('attricate');
		$this->db->order_by('category_id','asc');
		$this->db->order_by('attricate_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like, $category_id){
		if($category_id>0){						
			$sql = 'SELECT * FROM category WHERE category_id ='.$category_id;
			$query = $this->db->query($sql);
			$row = $query->row();
			$category_in = $row->category_children;
			$sql = "SELECT * FROM attricate WHERE attricate_title LIKE '%".$str_like."%' AND category_id IN(".$category_in.") ORDER BY attricate_order DESC LIMIT ".$page.",".$limit;			
		}else{
			$sql = "SELECT * FROM attricate WHERE attricate_title LIKE '%".$str_like."%' ORDER BY attricate_order DESC LIMIT ".$page.",".$limit;
		}
		
		$query = $this->db->query($sql);				
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('attricate');
		$this->db->where('attricate_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->attricate_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('attricate');
		$this->db->where('attricate_order < ',$crr_ord);
		$this->db->order_by('attricate_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->attricate_id;
			$up_ord = $row->attricate_order;
			
			$data_sort = array(				
				'attricate_order' => $crr_ord			
			);
			$this->db->where('attricate_id', $up_id);					
			$this->db->update('attricate', $data_sort);
			
			$data_sort = array(				
				'attricate_order' => $up_ord			
			);
			$this->db->where('attricate_id', $crr_id);					
			$this->db->update('attricate', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('attricate');
		$this->db->where('attricate_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->attricate_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('attricate');
		$this->db->where('attricate_order > ',$crr_ord);
		$this->db->order_by('attricate_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->attricate_id;
			$up_ord = $row->attricate_order;
			
			$data_sort = array(				
				'attricate_order' => $crr_ord			
			);
			$this->db->where('attricate_id', $up_id);					
			$this->db->update('attricate', $data_sort);
			
			$data_sort = array(				
				'attricate_order' => $up_ord			
			);
			$this->db->where('attricate_id', $crr_id);					
			$this->db->update('attricate', $data_sort);			
		}				
		
	}
	
	public function add(){
		$code_msg = '';
		$category_id = $this->input->get_post('category_id');
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$attricate_title 	  = '';								
		}else{		
			$attricate_title 	  = $this->input->post('attricate_title');						
			if($attricate_title == ''){				
				$code_msg = '0';
			}			
			//upload image file				
			$attricate_image = '';
			if ($_FILES['attricate_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/attricate/','attricate_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],160,120)){
						$attricate_image = $data_upload['file_name'];
					}								
				}
			}
			
			
			if($code_msg==""){								
				$this->db->select_max('attricate_order', 'max_order');
				$query = $this->db->get('attricate');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
				
				$data_attricate = array(				
				   'attricate_title'	 		=> $attricate_title,				   
				   'category_id'	 	        => $category_id,				   
				   'attricate_image' 	        => $attricate_image,				   
				   'attricate_order' 			=> $max_order
				);
				 			
				if($this->db->insert('attricate', $data_attricate)){					
					$attricate_title 	 = '';						
					$code_msg       		= '3';
				}
			}
		}
				
				
		$str_category_choose = $this->get_select_category($category_id);	
		
		/* get data return */
		$f_attricate = array(
			'attricate_title'	  => $attricate_title,			
			'category_choose' 	  => $str_category_choose,						
			'code_msg'	         => $code_msg
		
		);		
		return $f_attricate;		
	}
	
	
	public function edit(){
		$code_msg = '';	
			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$attricate_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('attricate');
			$this->db->where('attricate_id',$attricate_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$attricate_id		 	 = $row->attricate_id;
			$category_id	 	 	  = $row->category_id;
			$attricate_title 	   	  = $row->attricate_title;
			$image_old	  		  = $row->attricate_image<>'' ? $row->attricate_image : '';
			
		}else{		
			$attricate_id		 = $this->input->post('id');
			$attricate_title 	  = $this->input->post('attricate_title');			
			$category_id 	 	= $this->input->post('category_id');	
			$image_old  = $this->input->post('image_old');
			
			if($attricate_title == ''){				
				$code_msg = '0';
			}
			
			//upload image file	
			$attricate_image = $image_old;
			if ($_FILES['attricate_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/attricate/','attricate_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],160,120)){
						$this->back->delete_file('./public/upload/attricate/', $image_old);
						$this->back->delete_file('./public/upload/attricate/', 'small_'.$image_old);
						$attricate_image = $data_upload['file_name'];
					}								
				}
			}
						
			if($code_msg==""){								
				$data_attricate = array(				
				   'attricate_title'	 	  => $attricate_title,
				   'category_id'	 	   	  => $category_id,				   
				   'attricate_image' 	      => $attricate_image				  
				);
				$this->db->where('attricate_id', $attricate_id);											
				if($this->db->update('attricate', $data_attricate)){
					$code_msg       = '3';
				}
			}
		}
		
		$str_category_choose = $this->get_select_category($category_id);
		
		/* get data return */
		$f_attricate = array(
			'attricate_id'	  	 => $attricate_id,
			'attricate_title'	  => $attricate_title,			
			'category_choose' 	=> $str_category_choose,
			'image_old'  		  => $image_old,						
			'code_msg'	       => $code_msg
		
		);		
		return $f_attricate;	
	}

	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));	
						
			$dir_attricate = './public/upload/attricate/';
			$select_query = "SELECT attricate_image FROM attricate WHERE attricate_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$attricate_image = $row->attricate_image;
				$this->back->delete_file($dir_attricate, $attricate_image);
				$this->back->delete_file($dir_attricate, 'small_'.$attricate_image);				
			}
			$delete_query = "DELETE FROM attri WHERE attricate_id IN(".$array_id.")";
			$this->db->query($delete_query);						
			$delete_query = "DELETE FROM attricate WHERE attricate_id IN(".$array_id.")";						
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
		$sql = "SELECT * FROM attricate WHERE attricate_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$attricate_image = $row->attricate_image;
		$this->back->delete_file('./public/upload/attricate/', $attricate_image);
		$this->back->delete_file('./public/upload/attricate/', 'small_'.$attricate_image);
		$sql = "UPDATE attricate SET attricate_image = '' WHERE attricate_id=".$id;
		if($this->db->query($sql)){
			return TRUE;
		}else{
			return FALSE;
		}
	}	
	
	private function get_select_category($category_id=''){
		$sql = 'SELECT category_id, IF(category_level>1, CONCAT( IF(category_level>2,REPEAT("&nbsp;&nbsp;&nbsp;", category_level),REPEAT("&nbsp;&nbsp;", category_level)), "|", REPEAT("-", 2),  " " ,category_name), CONCAT("<b>",category_name,"</b>")) as category_name  FROM category ORDER BY category_select';
		$query = $this->db->query($sql);	
		$category_choose = '';
		foreach($query->result() as $row){			
			if($row->category_id == $category_id){
				$category_choose .= "<option value=".$row->category_id." selected>".$row->category_name."</option>";
			}else{
				$category_choose .= "<option value=".$row->category_id.">".$row->category_name."</option>";
			}
		}
		return $category_choose;		
	}
	
	public function get_select_category_full($category_id=''){
		$sql = 'SELECT category_id, IF(category_level>1, CONCAT( IF(category_level>2,REPEAT("&nbsp;&nbsp;&nbsp;", category_level),REPEAT("&nbsp;&nbsp;", category_level)), "|", REPEAT("-", 2),  " " ,category_name), CONCAT("<b>",category_name,"</b>")) as category_name  FROM category ORDER BY category_select';
		$query = $this->db->query($sql);		
		$category_choose = '<option value="0">Tất cả danh mục</option>';
		foreach($query->result() as $row){			
			if($row->category_id == $category_id){
				$category_choose .= "<option value=".$row->category_id." selected>".$row->category_name."</option>";
			}else{
				$category_choose .= "<option value=".$row->category_id.">".$row->category_name."</option>";
			}
		}
		return $category_choose;		
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
