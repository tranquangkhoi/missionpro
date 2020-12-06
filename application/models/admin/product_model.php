<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{	
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
		$this->load->library('crawler/simple_html_dom');
	}
	
	public function record_count(){
        if($this->session->userdata('status')>0){
			if($this->session->userdata('status')=='1')
				$this->db->where('product_status =',1);
			if($this->session->userdata('status')=='2')
				$this->db->where('product_status =',2);
			if($this->session->userdata('status')=='3')
				$this->db->where('product_status =',0);
		}
		return $this->db->count_all_results("product");
    }
	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('product');
		if($this->session->userdata('status')>0){
			if($this->session->userdata('status')=='1')
				$this->db->where('product_status =',1);
			if($this->session->userdata('status')=='2')
				$this->db->where('product_status =',2);
			if($this->session->userdata('status')=='3')
				$this->db->where('product_status =',0);
		}
		
		$this->db->order_by('product_time_posted','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	
	public function record_count_filter($str_like, $category_id){		
		$this->db->from('product');			
		$this->db->like('product_title', $str_like);
		if($this->session->userdata('status')>0){
			if($this->session->userdata('status')=='1')
				$this->db->where('product_status =',1);
			if($this->session->userdata('status')=='2')
				$this->db->where('product_status =',2);
			if($this->session->userdata('status')=='3')
				$this->db->where('product_status =',0);
		}
		if($category_id>0){
			$this->db->where('category_id', $category_id);
		}		
        return $this->db->count_all_results();
    }
	
	public function filter($limit, $page, $str_like, $category_id){
		if($this->session->userdata('status')>0){
			if($this->session->userdata('status')=='1')
				$product_status = 1;
			if($this->session->userdata('status')=='2')
				$product_status = 2;
			if($this->session->userdata('status')=='3')
				$product_status = 0;
		}
		
		if($category_id>0){						
			$sql = 'SELECT * FROM category WHERE category_id ='.$category_id;
			$query = $this->db->query($sql);
			$row = $query->row();
			$category_in = $row->category_children;
			if($this->session->userdata('status')>0){
				$sql = "SELECT * FROM product WHERE product_title LIKE '%".$str_like."%' AND category_id IN(".$category_in.") AND product_status = ".$product_status." ORDER BY product_time_posted DESC LIMIT ".$page.",".$limit;			
			}else{
				$sql = "SELECT * FROM product WHERE product_title LIKE '%".$str_like."%' AND category_id IN(".$category_in.") ORDER BY product_time_posted DESC LIMIT ".$page.",".$limit;							
			}
		}else{
			if($this->session->userdata('status')>0){
				$sql = "SELECT * FROM product WHERE product_title LIKE '%".$str_like."%' AND product_status = ".$product_status." ORDER BY product_time_posted DESC LIMIT ".$page.",".$limit;
			}else{
				$sql = "SELECT * FROM product WHERE product_title LIKE '%".$str_like."%'  ORDER BY product_time_posted DESC LIMIT ".$page.",".$limit;				
			}
		}
		
		$query = $this->db->query($sql);				
		return $query->result_array();		
	}
	
	public function add(){
		$dir = '';
		$dir_r = 'public/upload/new_images/';		
		if(is_dir($dir_r)==false){
      		mkdir($dir_r,0755);
    	} 
	
		$dir_y  = $dir_r.date('Y',time());
		$dir_d  = $dir_y.'/'.date('m',time());				
		if(is_dir($dir_y)==false){
			mkdir($dir_y, 0755); // Create directory if it does not exist
		}
		if(is_dir($dir_d)==false){
			mkdir($dir_d, 0755); // Create directory if it does not exist
		}
		$dir = $dir_d."/";
		
		$code_msg = '';
		$category_id = $this->input->get_post('category_id');		
		if($this->input->server('REQUEST_METHOD')=='GET'){			
			$product_price 	  		= 0;				
			$product_price_d  		= 0;				
			$product_date 	   		= date('d/m/Y',time());
			$product_time 	   		= date('H:i:s',time());			
			$product_title 	  		= '';		
			$product_title_seo 		= '';
			$product_color 	  		= '';
			$product_size 	  		= '';
			$product_review 		= '';
			$product_content 		= '';
			$product_meta_desc  	= '';
			$product_meta_key   	= '';
			$gcategory_id = array();
		}else{		
			$gcategory_id 			= $this->input->post('gcategory_id');
			$product_title 	  		= $this->input->post('product_title');
			$product_title_seo 	  	= $this->input->post('product_title_seo');
			$product_color 	  		= $this->input->post('product_color');
			$product_size 	  		= $this->input->post('product_size');
			$product_review 		= trim($this->input->post('product_review'));
			$product_content 		= trim($this->input->post('product_content'));
			$product_meta_desc  	= trim($this->input->post('product_meta_desc'));
			$product_meta_key   	= trim($this->input->post('product_meta_key'));			
			$product_slug 			= linkvn_to_linken($product_title);
						
			$product_price 	  	= is_numeric(str_replace(',','',$this->input->post('product_price'))) ? str_replace(',','',$this->input->post('product_price')) : 0;
			$product_price_d  	= is_numeric(str_replace(',','',$this->input->post('product_price_d'))) ? str_replace(',','',$this->input->post('product_price_d')) : 0;			
			$product_date_mysql = $this->back->datevn_to_datemysql($this->input->post('product_date'));
			$product_time       = $this->input->post('product_time');
			
			if(!$this->back->checkDateTime($product_date_mysql.' '.$product_time)){
				$product_date 	= date('d/m/Y',time());
			    $product_time 	= date('H:i:s',time());
			}else{
				$product_time   = $this->input->post('product_time');
				$product_date   = $this->input->post('product_date');
			}
			$product_time_posted = strtotime($this->back->datevn_to_datemysql($product_date).' '.$product_time);
		
			if($product_title == ''){				
				$code_msg = '0';
			}

			if($product_review == ''){				
				$code_msg .= ',1';
			}
			
			if($product_content == ''){				
				$code_msg .= ',2';
			}			
			
			//upload image file				
			$product_image = '';
			if ($_FILES['product_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/product/','product_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],90,90,'small_')){
						$this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],270,270,'medium_');
						$product_image = $data_upload['file_name'];
					}								
				}
			}
			

			
			if($code_msg==""){		
				
						/* Begin copy image */
			
						$txt_img = '';
						$imgs_arr = array();
						$imgd_arr = array();
						
						$html = str_get_html($product_content);						
						$dm = 0;
						foreach(@$html->find('img') as $e){
							if(strpos($e->src,'http')>=0){								
								$dm = $dm + 1;								
								$str_img = str_replace('\"','',$e->src);								
								$img_name = explode('/',$str_img);
								$pos_img = count($img_name)-1;					  
								$ext = substr($img_name[$pos_img], strrpos($img_name[$pos_img], '.')+1);
								$link_img = $str_img;			
								$link_img = str_replace(' ','%20',$link_img);
								$link_img  = str_replace('"','',$link_img);																
								$file_name  = substr($product_slug,0).$dm.'.'.$ext;								
								if(copy($link_img,$dir.$file_name)){									
									$e->src = base_url().$dir.$file_name;										
								}
							}							
						}
						
						$html->load($html->save());
						
						
						foreach($imgd_arr as $key=>$val){				
							$txt_img .= $val."<br>";
						}
						$product_content = $html->outertext;
						/* End copy image */
				
				$data_product = array(								   
				   'product_price'	 		=> $product_price,
				   'product_price_d' 		=> $product_price_d,
				   'category_id'	 	    => $category_id,
				   'gcategory_id'	 	   	=> @implode(",",$gcategory_id),
				   'product_title'	 		=> $product_title,
				   'product_title_seo'	 	=> $product_title_seo,
				   'product_color'	 		=> $product_color,
				   'product_size'	 		=> $product_size,
				   'product_review' 	    => $product_review,
				   'product_content' 	    => $product_content,
				   'product_meta_desc' 	    => $product_meta_desc,
				   'product_meta_key' 	    => $product_meta_key,
				   'product_image' 	        => $product_image,
				   'product_time_posted' 	=> $product_time_posted,
				   'product_slug' 			=> $product_slug
				);
				 			
				if($this->db->insert('product', $data_product)){
					$last_insert_id = $this->db->insert_id();
					$this->db->where('product_id', $last_insert_id);
					$path = $this->get_path_category($category_id);
					$data_product = array(	
						'product_path' 			=> $path.'/'.$product_slug,
						'product_slug' 			=> $product_slug
				   	);
					$this->db->update('product', $data_product);
					
					$album_arr = $this->back->upload_multi_file('./public/upload/product/','album_image');
					$num_image = count($album_arr);										
					for($i=0; $i<$num_image; $i++){
						//create thumb						
						if($this->back->create_thumb($album_arr[$i]['full_path'],$album_arr[$i]['file_name'],$album_arr[$i]['is_image'],90,90,'small_')){
							$this->back->create_thumb($album_arr[$i]['full_path'],$album_arr[$i]['file_name'],$album_arr[$i]['is_image'],270,270,'medium_');
							$image_name = $album_arr[$i]['file_name'];
							$data_image = array(				
							   'image_name' 		 => $image_name,
							   'image_order' 		 => $album_arr[$i]['order'],
							   'product_id' 	     => $last_insert_id							  							  
							);
							$this->db->insert('product_image',$data_image);
						}
					}					
					
					$product_price 	  	= 0;								
					$product_price_d  	= 0;								
					$product_title 	  	= '';							
					$product_title_seo 	= '';		
					$product_size 	  	= '';	
					$product_color 	  	= '';	
					$product_review	 	= '';
					$product_content    = '';
					$product_meta_desc  = '';
					$product_meta_key   = '';
					$code_msg       	= '3';
				}
			}
		}
				
				
		$str_category_choose = $this->get_select_category($category_id);	
		$str_gcategory_choose = $this->get_select_gcategory($gcategory_id);	
		
		/* get data return */
		$f_product = array(
			'product_price'	  	=> $product_price,
			'product_price_d'  	=> $product_price_d,
			'product_title'	  	=> $product_title,
			'product_title_seo'	=> $product_title_seo,			
			'product_color'	  	=> $product_color,			
			'product_size'	  	=> $product_size,			
			'product_review'  	=> $product_review,
			'product_content'   => $product_content,
			'product_meta_desc' => $product_meta_desc,
		 	'product_meta_key'  => $product_meta_key,
			'product_date'	   	=> $product_date,
			'product_time'	   	=> $product_time,
			'category_choose'   => $str_category_choose,						
			'gcategory_choose'  => $str_gcategory_choose,						
			'code_msg'	       	=> $code_msg

		
		);		
		return $f_product;		
	}
	
	
	public function edit(){
		$dir = '';
		$dir_r = 'public/upload/new_images/';	
		if(is_dir($dir_r)==false){
      		mkdir($dir_r,0755);
    	} 
	
		$dir_y  = $dir_r.date('Y',time());
		$dir_d  = $dir_y.'/'.date('m',time());				
		if(is_dir($dir_y)==false){
			mkdir($dir_y, 0755); // Create directory if it does not exist
		}
		if(is_dir($dir_d)==false){
			mkdir($dir_d, 0755); // Create directory if it does not exist
		}
		$dir = $dir_d."/";
		
		$code_msg = '';	
			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$product_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('product');
			$this->db->where('product_id',$product_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$product_id		 	= $row->product_id;
			$category_id	 	= $row->category_id;
			$gcategory_id	 	= explode(",",$row->gcategory_id);
			$product_price 	   	= number_format($row->product_price,0,'.',',');
			$product_price_d   	= number_format($row->product_price_d,0,'.',',');
			
			$product_title 	   	= $row->product_title;	
			$product_title_seo 	= $row->product_title_seo;	
			$product_color 	   	= $row->product_color;			
			$product_size 	   	= $row->product_size;			
			$product_review		= $row->product_review;
			$product_content	= $row->product_content;
			$product_meta_desc	= $row->product_meta_desc;
			$product_meta_key  	= $row->product_meta_key;
			
			$image_old	  		= $row->product_image<>'' ? $row->product_image : '';
			$product_date		= date('d/m/Y',$row->product_time_posted);
			$product_time		= date('H:i:s',$row->product_time_posted);
		}else{		
			$product_id		 	= $this->input->post('id');			
			$product_price 	  	= is_numeric(str_replace(',','',$this->input->post('product_price'))) ? str_replace(',','',$this->input->post('product_price')) : 0;			
			$product_price_d  	= is_numeric(str_replace(',','',$this->input->post('product_price_d'))) ? str_replace(',','',$this->input->post('product_price_d')) : 0;			
			$category_id 	 	= $this->input->post('category_id');			
			$gcategory_id 	 	= $this->input->post('gcategory_id');			

			$product_title 	  	= $this->input->post('product_title');
			$product_title_seo 	= $this->input->post('product_title_seo');
			$product_color 	  	= $this->input->post('product_color');
			$product_size 	  	= $this->input->post('product_size');
			$product_review 	= trim($this->input->post('product_review'));
			$product_content 	= trim($this->input->post('product_content'));
			$product_meta_desc  = trim($this->input->post('product_meta_desc'));
			$product_meta_key   = trim($this->input->post('product_meta_key'));						
			$product_slug 		= linkvn_to_linken($product_title);
			$path = $this->get_path_category($category_id);
			$product_path		= $path.'/'.$product_slug;
			
			$image_old  = $this->input->post('image_old');
			
			$product_date_mysql = $this->back->datevn_to_datemysql($this->input->post('product_date'));
			$product_time       = $this->input->post('product_time');
			
			if(!$this->back->checkDateTime($product_date_mysql.' '.$product_time)){
				$product_date 	   = date('d/m/Y',time());
			    $product_time 	   = date('H:i:s',time());
			}else{
				$product_time       = $this->input->post('product_time');
				$product_date       = $this->input->post('product_date');
			}
			$product_time_posted = strtotime($this->back->datevn_to_datemysql($product_date).' '.$product_time);
		
			if($product_title == ''){				
				$code_msg = '0';
			}
			if($product_review == ''){				
				$code_msg .= ',1';
			}
			
			if($product_content == ''){				
				$code_msg .= ',2';
			}			
			
			//upload image file	
			$product_image = $image_old;
			if ($_FILES['product_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/product/','product_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],90,90,'small_')){
						$this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],270,270,'medium_');
						$this->back->delete_file('./public/upload/product/', $image_old);
						$this->back->delete_file('./public/upload/product/', 'small_'.$image_old);
						$this->back->delete_file('./public/upload/product/', 'medium_'.$image_old);
						$product_image = $data_upload['file_name'];
					}								
				}
			}
						
			if($code_msg==""){								
				
				/* Begin copy image */
			
						$txt_img = '';
						$imgs_arr = array();
						$imgd_arr = array();
						
						$html = str_get_html($product_content);						
						$dm = 0;
						foreach(@$html->find('img') as $e){							
							$cimg = strpos($e->src,"http");
							if($cimg === false){
								$g = 0;
							}else{		
								$dm = $dm + 1;								
								$str_img = str_replace('\"','',$e->src);								
								$img_name = explode('/',$str_img);
								$pos_img = count($img_name)-1;					  
								$ext = substr($img_name[$pos_img], strrpos($img_name[$pos_img], '.')+1);
								$link_img = $str_img;			
								$link_img = str_replace(' ','%20',$link_img);
								$link_img  = str_replace('"','',$link_img);																
								$file_name  = substr($product_slug,0).$dm.'.'.$ext;																
								if(copy($link_img,$dir.$file_name)){									
									$e->src = base_url().$dir.$file_name;										
								}
							}							
						}								
						$html->load($html->save());
						$product_content = $html->outertext;
						/* End copy image */
						
				
				$data_product = array(								   
				   'category_id'	 	   	=> $category_id,
				   'gcategory_id'	 	   	=> @implode(",",$gcategory_id),
				   'product_price' 	   	  	=> $product_price,
				   'product_price_d'   	  	=> $product_price_d,
				   'product_title'	 		=> $product_title,
				   'product_title_seo'	 	=> $product_title_seo,
				   'product_color'	 		=> $product_color,
				   'product_size'	 		=> $product_size,
				   'product_review' 	    => $product_review,
				   'product_content' 	    => $product_content,
				   'product_meta_desc' 	    => $product_meta_desc,
				   'product_meta_key' 	    => $product_meta_key,				   
				   'product_image' 	        => $product_image,
				   'product_time_posted' 	=> $product_time_posted,
				   'product_slug' 			=> $product_slug,
				   'product_path' 			=> $product_path
				);
				$this->db->where('product_id', $product_id);											
				if($this->db->update('product', $data_product)){					
					//upload image
					$album_arr = $this->back->upload_multi_file('./public/upload/product/','album_image');
					$num_image = count($album_arr);	
					for($i=0; $i<$num_image; $i++){
						//create thumb
						if($this->back->create_thumb($album_arr[$i]['full_path'],$album_arr[$i]['file_name'],$album_arr[$i]['is_image'],90,90,'small_')){
							$this->back->create_thumb($album_arr[$i]['full_path'],$album_arr[$i]['file_name'],$album_arr[$i]['is_image'],270,270,'medium_');
						
							$image_name  = $album_arr[$i]['file_name'];
							$image_order = $album_arr[$i]['order'];
							$data_image = array(				
							   'image_name' 		=> $image_name,
							   'image_order' 		=> $image_order,
							   'product_id' 	    => $product_id							  							  
							);
							$this->db->insert('product_image',$data_image);
						}
						
					}					
					//update image order
					if($this->input->post('old_image_id')){
						$old_image_order = $this->input->post('old_image_order');
						$old_image_id = $this->input->post('old_image_id');							
						for($i=0; $i<count($old_image_id); $i++){
							$data_image = array(				
							   'image_order'	=> $old_image_order[$i]					  
							);	
							$this->db->where('image_id', $old_image_id[$i]);
							$this->db->update('product_image', $data_image);					
						}
					}
					$code_msg       = '3';					
				}
			}
		}
		
		$str_category_choose = $this->get_select_category($category_id);
		$str_gcategory_choose = $this->get_select_gcategory($gcategory_id);
		
		/* get data return */
		$f_product = array(
			'product_id'	  		=> $product_id,			
			'product_price' 		=> $product_price,
			'product_price_d' 		=> $product_price_d,
			'product_title'	  		=> $product_title,
			'product_title_seo'	  	=> $product_title_seo,
			'product_color'	  		=> $product_color,
			'product_size'	  		=> $product_size,
			'product_review'  		=> $product_review,
			'product_content'   	=> $product_content,
			'product_meta_desc' 	=> $product_meta_desc,
			'product_meta_key'  	=> $product_meta_key,
			'product_date'	   		=> $product_date,
			'product_time'	   		=> $product_time,
			'category_choose' 		=> $str_category_choose,
			'gcategory_choose' 		=> $str_gcategory_choose,
			'image_old'  			=> $image_old,						
			'code_msg'	       		=> $code_msg
		);		
		return $f_product;	
	}
	
	
	public function get_album_image($product_id){
		$select = "SELECT image_id, image_name, image_order FROM product_image WHERE product_id = ".$product_id." ORDER BY image_order";
		$query = $this->db->query($select);		
		return $query->result();
	}
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));	
						
			$dir_product = './public/upload/product/';
			$select_query = "SELECT product_image FROM product WHERE product_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$product_image = $row->product_image;
				$this->back->delete_file($dir_product, $product_image);
				$this->back->delete_file($dir_product, 'small_'.$product_image);
				$this->back->delete_file($dir_product, 'xsmall_'.$product_image);
				$this->back->delete_file($dir_product, 'medium_'.$product_image);				
			}
			
			$select_query = "SELECT image_name FROM product_image WHERE product_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$image_name = $row->image_name;
				$this->back->delete_file($dir_product, $image_name);
				$this->back->delete_file($dir_product, 'small_'.$image_name);	
				$this->back->delete_file($dir_product, 'xsmall_'.$image_name);
				$this->back->delete_file($dir_product, 'medium_'.$image_name);			
			}
			$delete_query = "DELETE FROM product_image WHERE product_id IN(".$array_id.")";
			$this->db->query($delete_query);
			$delete_query = "DELETE FROM product WHERE product_id IN(".$array_id.")";						
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
		$sql = "SELECT * FROM product WHERE product_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$product_image = $row->product_image;
		$this->back->delete_file('./public/upload/product/', $product_image);
		$this->back->delete_file('./public/upload/product/', 'small_'.$product_image);
		$this->back->delete_file('./public/upload/product/', 'xsmall_'.$product_image);
		$this->back->delete_file('./public/upload/product/', 'medium_'.$product_image);
		$sql = "UPDATE product SET product_image = '' WHERE product_id=".$id;
		if($this->db->query($sql)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function delalbum($id){
		$sql = "SELECT * FROM product_image WHERE image_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$image_name = $row->image_name;
		$this->back->delete_file('./public/upload/product/', $image_name);
		$this->back->delete_file('./public/upload/product/', 'small_'.$image_name);
		$this->back->delete_file('./public/upload/product/', 'xsmall_'.$image_name);
		$this->back->delete_file('./public/upload/product/', 'medium_'.$image_name);
		$sql = "DELETE FROM product_image WHERE image_id=".$id;
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
	
	private function get_select_gcategory($gcategory_id){
		$sql = 'SELECT category_id, IF(category_level>1, CONCAT( IF(category_level>2,REPEAT("&nbsp;&nbsp;&nbsp;", category_level),REPEAT("&nbsp;&nbsp;", category_level)), "|", REPEAT("-", 2),  " " ,category_name), CONCAT("<b>",category_name,"</b>")) as category_name  FROM category ORDER BY category_select';
		$query = $this->db->query($sql);	
		if(@in_array('0',$gcategory_id)){
			$gcategory_choose = "<option value=0 selected>Không chọn danh mục nào</option>";
		}else{
			$gcategory_choose = "<option value=0>Không chọn danh mục nào</option>";
		}
		foreach($query->result() as $row){			
			if(@in_array($row->category_id,$gcategory_id)){
				$gcategory_choose .= "<option value=".$row->category_id." selected>".$row->category_name."</option>";
			}else{
				$gcategory_choose .= "<option value=".$row->category_id.">".$row->category_name."</option>";
			}
		}
		return $gcategory_choose;		
	}
	
	
	private function get_path_category($category_id){
		$select = "SELECT category_path FROM category WHERE category_id=".$category_id;
		$query = $this->db->query($select);
		$row = $query->row();
		$category_children = str_replace("/",",",$row->category_path);
		$category_children = substr($category_children,0,-1);
		$select = "SELECT group_concat(category_slug separator '/') as path  FROM category WHERE category_id IN(".$category_children.") ORDER BY category_select";
		$query = $this->db->query($select);
		$row = $query->row();
		return $row->path;
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
	
	public function get_attricate($category_id){
		$select = "SELECT attricate_id, attricate_title FROM attricate WHERE category_id = ".$category_id;	
		$query = $this->db->query($select);
		return $query->result();		
	}
	
	public function get_attri($attricate_id){
		$select = "SELECT attri_id, attri_title FROM attri WHERE attricate_id = ".$attricate_id;	
		$query = $this->db->query($select);
		return $query->result();		
	}
	public function create_html_attr($attricate_id, $attri_id, $i){
		$select = "SELECT attricate_id, attricate_title FROM attricate WHERE attricate_id = ".$attricate_id;	
		$query = $this->db->query($select);
		$row = $query->row();
		$attricate_title = $row->attricate_title;
		$attr_arr = $this->get_attri($row->attricate_id);						
		$item_begin = '<div class="control-group">                                
                               	  <label class="control-label"  for="'.$row->attricate_id.'">'.$row->attricate_title.':</label>
                                  		<div class="controls">
                                  			<select id="attr'.$i.'" name="attr'.$i.'" class="input-xlarge" size=5>';
				
		$item_end = '				</select>
                                  		</div>
                             </div>';
		$slf = $attri_id == 0 ? 'selected' : '';
		$item_mid = '<option value="'.$row->attricate_id.':0" '.$slf.'>Chọn '.$row->attricate_title.'</option>';
		$item_html = '';
		foreach($attr_arr as $items){
			$selected = $items->attri_id == $attri_id ? 'selected' : '';
			$item_mid .= '<option value="'.$row->attricate_id.':'.$items->attri_id.'" '.$selected.'>'.$items->attri_title.'</option>';
		}				
		if($item_mid<>''){
			$item_html = $item_begin.$item_mid.$item_end;
		}
		return $item_html;
	}		
}