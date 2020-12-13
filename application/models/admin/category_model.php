<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	
	public function record_count(){
        return $this->db->count_all("category");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('category');	
		$this->db->like('category_name', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$sql = 'SELECT category_id, IF(category_level>1, CONCAT( IF(category_level>2,REPEAT("&nbsp;&nbsp;&nbsp;", category_level),REPEAT("&nbsp;&nbsp;", category_level)), "|", REPEAT("-", 2),  " " ,category_name), CONCAT("<b>",category_name,"</b>")) as category_name  FROM category  ORDER BY category_select LIMIT '.$page.','.$limit;		
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');
		$this->db->like('category_name', $str_like);
		$this->db->from('category');		
		$this->db->order_by('category_select','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function add(){
		$code_msg = '';
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$category_name 			= '';
			$category_review		= '';
			$category_meta_desc 	= '';
			$category_meta_key 		= '';
			$category_order 		= 1;
			$category_parent   		= 0;					
		}else{			
			$category_name 	 		= $this->input->post('category_name');
			$category_review 	 	= $this->input->post('category_review');
			$category_meta_desc		= $this->input->post('category_meta_desc');
			$category_meta_key 		= $this->input->post('category_meta_key');
			$category_order 		= $this->input->post('category_order') ? $this->input->post('category_order') : 1;			
			$category_parent   		= $this->input->post('category_parent') ? $this->input->post('category_parent') : 0;						
			$category_slug   		= linkvn_to_linken($category_name);			
			if($category_name == ''){				
				$code_msg = '0';
			}
			
			//upload image file	
			$category_icon = '';
			if ($_FILES['category_icon']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/category/','category_icon')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],90,90,'small_')){
						$this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],270,270,'medium_');
						$category_icon = $data_upload['file_name'];
					}								
				}
			}
			
						
			if($code_msg==""){								
				$data_category = array(				
				   'category_name'	 	  	=> $category_name,
				   'category_review'	 	=> $category_review,				   
   				   'category_meta_desc' 	=> $category_meta_desc,
				   'category_meta_key'	  	=> $category_meta_key,				   				 
				   'category_parent'	 	=> $category_parent,
				   'category_order' 	 	=> $category_order,
				   'category_icon' 	        => $category_icon,
				   'category_slug' 	 	  	=> $category_slug
				   
				);			
				if($this->db->insert('category', $data_category)){
					
					//path + path_select
					$category_select_path = '';
					$category_path = '';
					$category_level = 0;
					$last_insert_id = $this->db->insert_id();
					if($category_parent == '0'){
						$category_select_path = $this->back->zerofill($category_order).$this->back->zerofill($last_insert_id);
						$category_level = 1;
						$category_path = $last_insert_id.'/';				
					}else{						
						$category_select_path = $this->back->zerofill($category_order).$this->back->zerofill($last_insert_id);
						$category_path = $last_insert_id.'/';
						$this->db->select('*');
						$this->db->from('category');
						$this->db->where('category_id',$category_parent);
						$query = $this->db->get();
						$row = $query->row();
						$category_level = $row->category_level + 1;
						$category_select_path = $row->category_select.$category_select_path;
						$category_path = $row->category_path.$category_path;
					}
					$data_category = array(				
					   'category_select'    	=> $category_select_path,
					   'category_path'    		=> $category_path,
					   'category_level'    		=> $category_level,
					   'category_meta_desc'    	=> $category_meta_desc,
					   'category_meta_key'      => $category_meta_key
					   
					);	
					$this->db->where('category_id', $last_insert_id);					
					$this->db->update('category', $data_category);					
					//$this->update_children_id();
					$this->update_children_id_branch($category_path);
					$category_name 			= '';
					$category_review		= '';					
					$category_meta_key		= '';
					$category_meta_desc   	= '';
					$category_order 	   = $category_order + 1;								
					$code_msg = '2';
				}
			}
		}
				
		$category_select = $this->tree_view('category',$category_parent);		
			
		
		/* get data return */
		$f_category = array(			
			'category_name'	 	 	=> $category_name,
			'category_review'	 	=> $category_review,
			'category_meta_key'  	=> $category_meta_key,
			'category_meta_desc'  	=> $category_meta_desc,
			'category_select'	   	=> $category_select,
			'category_order'  	 	=> $category_order,			
			'code_msg'	   		  	=> $code_msg			
		);		
		return $f_category;		
	}
	
	
	public function edit(){				
		$code_msg = '';
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$category_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('category');
			$this->db->where('category_id',$category_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$category_id		 	= $row->category_id;
			
			$category_name 	   	   	= $row->category_name;
			$category_review   	   	= $row->category_review;
			$category_meta_key	   	= $row->category_meta_key;
			$category_meta_desc     = $row->category_meta_desc;			
			$category_order		  	= $row->category_order;			
			$category_level		  	= $row->category_level;
			$category_parent_old	= $row->category_parent;
			$category_parent		= $row->category_parent;
			$category_children 	   	= $row->category_children;
			$image_old	  			= $row->category_icon<>'' ? $row->category_icon : '';
			
			
		}else{		
			$category_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('category');
			$this->db->where('category_id',$category_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$category_id		 	= $row->category_id;
			$old_category_path	   	= $row->category_path;
			$category_name 	   	   	= $row->category_name;
			$category_review   	   	= $row->category_review;
			$category_meta_key	   	= $row->category_meta_key;
			$category_meta_desc     = $row->category_meta_desc;							
			$category_order		  	= $row->category_order;			
			$category_level		  	= $row->category_level;
			$category_children 	   	= $row->category_children;	
					
			$category_name 	   	  	= $this->input->post('category_name');
			$category_review   	  	= $this->input->post('category_review');
			$category_meta_key 	  	= $this->input->post('category_meta_key');
			$category_meta_desc 	= $this->input->post('category_meta_desc');						
			$category_order 		= $this->input->post('category_order') ? $this->input->post('category_order') : 1;
			$category_parent    	= $this->input->post('category_parent');
			$category_parent_old    = $this->input->post('category_parent_old');	
			$image_old  = $this->input->post('image_old');
			
			if($category_name == ''){				
				$code_msg = '0';
			}
			
			$category_logo_name = '';
			/*
			if ($_FILES['category_logo']['name']<>''){				
				if($this->back->upload_file('./public/upload/category/','category_logo')){
					$data_upload = $this->upload->data();				
					$category_logo_name = $data_upload['file_name'];													
				}
			}
			*/
			//upload image file	
			$category_icon = $image_old;
			if ($_FILES['category_icon']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/category/','category_icon')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],90,90,'small_')){
						$this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],270,270,'medium_');
						$this->back->delete_file('./public/upload/category/', $image_old);
						$this->back->delete_file('./public/upload/category/', 'small_'.$image_old);
						$this->back->delete_file('./public/upload/category/', 'medium_'.$image_old);
						$category_icon = $data_upload['file_name'];
					}								
				}
			}
						
			if($code_msg==""){
					if($category_icon<>''){
						$data_category = array(				
						   'category_icon'   		=> $category_icon						   			  
						);	
						$this->db->where('category_id', $category_id);					
						$this->db->update('category', $data_category);
					}
					
					$category_slug   	= linkvn_to_linken($category_name);
					$data_category = array(										   
						  'category_meta_key'    	=> $category_meta_key,
						  'category_meta_desc'   	=> $category_meta_desc,						  
						  'category_slug'   		=> $category_slug,
						  'category_review'   		=> $category_review

					);	
					$this->db->where('category_id', $category_id);					
					$this->db->update('category', $data_category);
				
									
					//get new parent
					$this->db->select('*');
					$this->db->from('category');
					$this->db->where('category_id',$category_parent);
					$query = $this->db->get();
					$row = $query->row();
					$new_category_path = isset($row->category_path) ? $row->category_path : '';
					$new_category_select = isset($row->category_select) ? $row->category_select : '';
					
					
					$cate_arr = array();
					$sql = "SELECT category_id, category_name, category_path, category_select, (category_level-1) as category_level, category_parent FROM category WHERE category_path LIKE '".$old_category_path."%' ORDER BY category_path";			
					$query = $this->db->query($sql);
					$i=0;	
					$sub_pos_select  = '';
					$sub_pos_path	= '';	
									
					//lay toan nhanh qua mang + cap nhat gia tri khi chuyen den nhanh moi
					
					foreach($query->result() as $row){						
						$i = $i + 1;
						if($i==1 && $row->category_level>0){							
							$sub_pos_select = $row->category_level*10+5;
							
							$find_num = $row->category_level;
							$start = 0;
							$d_find = 0;							
							while(($newLine = strpos($row->category_path, '/', $start)) !== false){
								$start = $newLine + 1;
								$d_find = $d_find + 1;
								if($d_find == $find_num){
									$sub_pos_path = $newLine;
									break;
								}
							}
							//echo $sub_pos_path."<br>";							
							$cate_arr[$i]['category_parent'] 	= $category_parent;
							$cate_arr[$i]['category_name'] 		= $category_name;
						}elseif($i==1 && $row->category_level==0){
							$sub_pos_select = 5;
							$sub_pos_path   = -1;
							$cate_arr[$i]['category_parent'] 	= $category_parent;
							$cate_arr[$i]['category_name'] 		= $category_name;
						}else{
							$cate_arr[$i]['category_parent'] 	= $row->category_parent;
							$cate_arr[$i]['category_name'] 		= $row->category_name;
						}
						$sub_path = substr($row->category_path,$sub_pos_path+1);
						$sub_select = substr($row->category_select,$sub_pos_select);
						
						$cate_arr[$i]['category_id']     	= $row->category_id;
						$cate_arr[$i]['category_select']   	= $new_category_select.$this->back->zerofill($category_order).$sub_select;
						$cate_arr[$i]['category_path'] 	  = $new_category_path.$sub_path;
						$cate_arr[$i]['category_level']	 = substr_count($cate_arr[$i]['category_path'],'/');
					}
					//tren mang xu ly du lieu cap nhat khi vao nhanh moi					
					for($i=1; $i<=count($cate_arr); $i++){						
						$data_update = array(				
							'category_name'      	=> $cate_arr[$i]['category_name'],
							'category_select'      	=> $cate_arr[$i]['category_select'],
							'category_path'    		=> $cate_arr[$i]['category_path'],
							'category_level'       	=> $cate_arr[$i]['category_level'],
							'category_parent'      	=> $cate_arr[$i]['category_parent'],
							'category_order' 	   	=> $category_order			   				   				   
						);
						
						$this->db->where('category_id', $cate_arr[$i]['category_id']);
						$this->db->update('category', $data_update);												
					}
					//cap nhat id thuoc nhanh.
					
					$this->update_children_id_branch($new_category_path);
					if($category_parent_old>0){
						$this->update_children_id_branch($old_category_path);
					}								
				
				$code_msg = '2';
			}
		}
		$category_select = $this->tree_view('category',$category_parent,$category_children);
		/* get data return */
		$f_category = array(
			'category_id'		  	  	=> $category_id,
			'category_name'	 			=> $category_name,
			'category_review' 			=> $category_review,
			'category_meta_desc'	   	=> $category_meta_desc,
			'category_meta_key'	 		=> $category_meta_key,						
			'category_select'	      	=> $category_select,
			'category_order'  	 	   	=> $category_order,
			'category_parent_old'  	  	=> $category_parent_old,	
			'image_old'  				=> $image_old,									
			'code_msg'	   		     	=> $code_msg			
		);		
		return $f_category;	
	}
	
	
	public function del(){
		$code_msg = '';		
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));
			$select_query = "SELECT * FROM category WHERE category_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			
			//get array category_id(parent+children)
			$category_in = '';
			foreach($query->result() as $row){
				$category_in .= $row->category_children.',';				
			}
			$category_in = substr($category_in,0,-1);
			//get delete logo
			$dir_category = './public/upload/category/';
			$select_query = "SELECT category_logo FROM category WHERE category_id IN(".$category_in.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$category_logo = $row->category_logo;
				$this->back->delete_file($dir_category, $category_logo);
				$this->back->delete_file($dir_category, 'small_'.$category_logo);				
			}
			
			//get delete product image
			$dir_product = './public/upload/product/';
			$select_query = "SELECT product_image FROM product WHERE category_id IN(".$category_in.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$product_image = $row->product_image;
				$this->back->delete_file($dir_product, $product_image);
				$this->back->delete_file($dir_product, 'small_'.$product_image);				
			}
			
			$delete_query = "DELETE FROM product WHERE category_id IN(".$category_in.")";
			$this->db->query($delete_query);
			$delete_query = "DELETE FROM category WHERE category_id IN(".$category_in.")";
			if($this->db->query($delete_query)){
				$code_msg = 0;
				$this->update_children_id();
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}		
	}
	
	private function tree_view($tbl, $field_parent, $category_children=NULL){
		$str_select = "";				
		if($category_children<>NULL){
			$sql = "SELECT * FROM category WHERE category_id NOT IN(".$category_children.") ORDER BY category_select";		
		}else{
			$sql = "SELECT * FROM category ORDER BY category_select";	
		}		
		$query = $this->db->query($sql);		
		foreach($query->result() as $row){
			if($row->category_id == $field_parent){
				$str_select .= "<option value=".$row->category_id." selected>".$this->back->txt_level($row->category_level).$row->category_name."</option>";
			}else{
				$str_select .= "<option value=".$row->category_id.">".$this->back->txt_level($row->category_level).$row->category_name."</option>";
			}
		}		
		return $str_select;
	}
	
	
	
	private function update_children_id(){
		$this->db->select('*');
		$this->db->from('category');	
		$this->db->order_by('category_select','asc');
		$query = $this->db->get();
		$cate_arr = array();
		foreach($query->result() as $row){
			$cate_arr[$row->category_id] = $row->category_path;
		}
		foreach($cate_arr as $key => $val){
			$sql = "SELECT GROUP_CONCAT(category_id) as category_children FROM category WHERE category_path LIKE '".$val."%' ORDER BY category_path";			
			$query = $this->db->query($sql);
			$row = $query->row();
			$data_category = array(				
				'category_children'  => $row->category_children
			);	
			$this->db->where('category_id', $key);					
			$this->db->update('category', $data_category);			
		}		
	}
	
	private function update_children_id_branch($branch_id){
		$brand_arr = explode('/',$branch_id);
		$root_branch = $brand_arr[0]."/";
		$sql = "SELECT category_id, category_path FROM category WHERE category_path LIKE '".$root_branch."%' ORDER BY category_path";			
		$query = $this->db->query($sql);		
		$cate_arr = array();
		foreach($query->result() as $row){
			$cate_arr[$row->category_id] = $row->category_path;
		}
		foreach($cate_arr as $key => $val){
			$sql = "SELECT GROUP_CONCAT(category_id) as category_children FROM category WHERE category_path LIKE '".$val."%' ORDER BY category_path";			
			$query = $this->db->query($sql);
			$row = $query->row();
			$data_category = array(				
				'category_children'  => $row->category_children
			);	
			$this->db->where('category_id', $key);					
			$this->db->update('category', $data_category);			
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

	public function delimg($id){
		$sql = "SELECT * FROM category WHERE category_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$category_icon = $row->category_icon;
		$this->back->delete_file('./public/upload/category/', $category_icon);
		$this->back->delete_file('./public/upload/category/', 'small_'.$category_icon);
		$this->back->delete_file('./public/upload/category/', 'medium_'.$category_icon);
		$sql = "UPDATE category SET category_icon = '' WHERE category_id=".$id;
		if($this->db->query($sql)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}