<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	private function get_in_category($category_children){
		$gcate = explode(",",$category_children);
		$str_cate = '';
		foreach($gcate as $key=>$val){
			$str_cate  .= " FIND_IN_SET(".$val.",gcategory_id) OR ";
		}
		return substr($str_cate,0,-3);
	}
	public function index($limit, $page, $category_children, $sort){	
		$w_cate = $this->get_in_category($category_children);
		if($sort=='0'){
			$sql = 'SELECT product_status, product_id, product_title, product_title_seo,product_review, product_image, product_slug, product_path, product_price, product_price_d FROM product WHERE '.$w_cate.' AND product_status<>0 ORDER BY product_time_posted DESC LIMIT '.$page.', '.$limit;		
		}else{
			$order = $sort=='1' ? 'ASC' : 'DESC';
			$sql = 'SELECT product_status, product_id, product_title, product_title_seo, product_review, product_image, product_slug, product_path, product_price, product_price_d FROM product WHERE '.$w_cate.' AND product_status<>0 ORDER BY product_price '.$order.' LIMIT '.$page.', '.$limit;		
		}
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function record_count($category_children){        
		$w_cate = $this->get_in_category($category_children);
		$sql = 'SELECT * FROM product WHERE '.$w_cate.' AND product_status<>0';		
		$query = $this->db->query($sql);
		return $query->num_rows();
    }
	
	public function get_category_by_slug($slug){
		if($this->check_slug('category','category_slug',$slug)){
			$sql = 'SELECT * FROM category WHERE category_slug ="'.$slug.'"';
		}else{
			$sql = 'SELECT * FROM category ORDER BY category_select LIMIT 0, 1';
		}		
		$query = $this->db->query($sql);
		$row   = $query->row();				
		return $row;		
	}
	
	public function get_category_by_id($id){		
		$sql = 'SELECT * FROM category WHERE category_id ="'.$id.'"';			
		$query = $this->db->query($sql);						
		return $query->row();		
	}
	
	public function get_menu_left($category_parent, $category_id, $category_path){
		$sql = 'SELECT category_id, category_path FROM category WHERE category_path LIKE "'.$category_path.'%"';
		$query = $this->db->query($sql);
		if($query->num_rows()==1){
			$sql = 'SELECT * FROM category WHERE category_parent = '.$category_parent.' ORDER BY category_select';
		}else{
			$sql = 'SELECT * FROM category WHERE category_parent = '.$category_id.' ORDER BY category_select';
		}
		$query = $this->db->query($sql);				
		return  $query->result_array();		
	}
	
	public function get_parent_name($category_parent, $category_id, $category_path){
		$sql = 'SELECT category_id FROM category WHERE category_path LIKE "'.$category_path.'%"';
		$query = $this->db->query($sql);					
		if($query->num_rows()==1 && $category_parent<>'0'){
			$sql = 'SELECT * FROM category WHERE category_id = '.$category_parent;
			
		}else{
			$sql = 'SELECT * FROM category WHERE category_id = '.$category_id;
		}
		
		
		$query = $this->db->query($sql);
		$row =  $query->row();				
		return $row->category_name;
	}
	
	public function get_path($category_path){
		$path_arr = explode('/',substr($category_path,0,-1));
		$i = 0;
		$path_r = array();
		foreach($path_arr as $key => $val){
			$i = $i + 1;
			$sql = 'SELECT category_id, category_name, category_slug FROM category WHERE category_id = '.$val;
			$query = $this->db->query($sql);
			$row =  $query->row();	
			$path_r[$i]['category_id'] = $row->category_id;
			$path_r[$i]['category_name'] = $row->category_name;
			$path_r[$i]['category_slug'] = $row->category_slug;		
		}						
		return $path_r;
	}
	
	public function get_category_name($category_id){		
		$sql = 'SELECT * FROM category WHERE category_id ='.$category_id;				
		$query = $this->db->query($sql);					
		return $query->row();		
	}
	
	public function get_autocode(){		
		$sql = 'SELECT * FROM autocode';				
		$query = $this->db->query($sql);					
		$autocode = array();
		foreach ($query->result() as $row){
		   $autocode[$row->autocode_code] = $row->autocode_content;
		}
		return $autocode;
	}
	
	
	
	
	public function get_product_id($slug){
		if($this->check_slug('product','product_slug',$slug)){
			$sql = 'SELECT product_status, product_id, category_id, product_title, product_title_seo, product_color, product_size, product_review, product_content, product_slug, product_image, product_meta_desc, product_meta_key, FROM_UNIXTIME(product_time_posted,"%d/%m/%Y %r") as product_time_posted, FROM_UNIXTIME(product_time_posted,"%w") as product_day, product_price, product_price_d FROM product WHERE product_slug ="'.$slug.'"';
		}else{
			redirect('product','refresh');
		}		
		$query = $this->db->query($sql);
		$row   = $query->row();				
		return $row;		
	}
	
	
	
	public function check_slug($tbl,$col_slug,$slug){
		$sql = 'SELECT * FROM '.$tbl.' WHERE '.$col_slug.' ="'.$slug.'"';		
		$query = $this->db->query($sql);		
		if($query->num_rows()==0){
			return false;
		}else{
			return true;
		}
	}
	
	public function get_banner($banner_block){
		$sql = 'SELECT * FROM banner LEFT JOIN (bannercate) ON (banner.bannercate_id= bannercate.bannercate_id) WHERE bannercate.bannercate_block='.$banner_block;
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_lastest_new(){
		$sql = 'SELECT product_id, product_title, product_title_seo product_image, product_time_posted FROM product ORDER BY product_time_posted DESC LIMIT 0, 4';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_other_new($category_id, $newcrr_id){
		$sql = 'SELECT product_id, product_title, product_title_seo, product_image, FROM_UNIXTIME(product_time_posted, "%d/%m/%Y") as product_time_posted, product_slug FROM product WHERE category_id = '.$category_id.' AND product_id<> '.$newcrr_id.' ORDER BY product_time_posted DESC LIMIT 0, 4';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_chat(){
		$sql = 'SELECT * FROM chat ORDER BY chat_type, chat_order';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	public function get_hotline(){
		$sql = 'SELECT * FROM web ORDER BY web_order LIMIT 0, 1';
		$query = $this->db->query($sql);		
		return $query->row();		
	}
	
	public function get_part($product_id){
		$sql = 'SELECT * FROM product WHERE product_id ='.$product_id;
		$query = $this->db->query($sql);		
		return $query->row();				
	}
	
	public function get_tree(){
		//$sql = 'SELECT category_id, IF(category_level>1, CONCAT( IF(category_level>2,REPEAT("&nbsp;&nbsp;&nbsp;", category_level),REPEAT("&nbsp;&nbsp;", category_level)), "|", REPEAT("-", 2),  " " ,category_name), CONCAT("<b>",category_name,"</b>")) as category_name  FROM category ORDER BY category_select ';
		$sql = 'SELECT category_id, category_level,category_name, category_slug FROM category ORDER BY category_select ';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_lib_img($product_id){
		$sql = 'SELECT image_name FROM product_image WHERE product_id='.$product_id.' ORDER BY image_order ';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	public function get_other_product($category_children, $product_crr_id){
		$sql = 'SELECT product_id, product_title, product_title_seo, product_price, product_review, product_price_d, product_image, product_slug, product_path FROM product WHERE category_id IN('.$category_children.') AND product_id<>'.$product_crr_id.' ORDER BY product_time_posted DESC LIMIT 0, 9';		
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
}