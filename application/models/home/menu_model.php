<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->pcheck = array();
	}
	
	//get menu get_menu_intro
	public function get_cate_warranty(){
		$sql = 'SELECT * FROM category WHERE category_level=1 ORDER BY category_order';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	//get category of top menu
	public function get_category(){
		$sql = 'SELECT * FROM category ORDER BY category_select';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	public function get_category_level($level){		
		$sql = 'SELECT * FROM category WHERE category_level = '.$level.' ORDER BY category_select';
		$query = $this->db->query($sql);		
		$lcate = array();
		$i = 0;
		foreach($query->result() as $row){
			$i = $i + 1;
			$lcate[$i]['category_id'] 			= $row->category_id;
			$lcate[$i]['category_name'] 		  = $row->category_name;
			$lcate[$i]['category_level'] 		 = $row->category_level;
			$lcate[$i]['category_slug'] 		  = $row->category_slug;
			$lcate[$i]['category_parent'] 		= $row->category_parent;
			$lcate[$i]['category_children']	  = $row->category_children;			
			$this->pcheck[$row->category_parent] = $row->category_parent;
		}
		return $lcate;
	}
	
	//get menu get_menu_intro
	public function get_cate_accessory(){
		$sql = 'SELECT * FROM accesscategory WHERE accesscategory_level=1 ORDER BY accesscategory_order';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
		
	//get menu new
	public function get_cate_new(){
		$sql = 'SELECT * FROM newcate ORDER BY newcate_order';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	//get menu address on footer
	public function get_address($intro_block){
		$sql = 'SELECT * FROM intro LEFT JOIN (introcate) ON (intro.introcate_id= introcate.introcate_id) WHERE introcate.introcate_block='.$intro_block.' ORDER BY intro.intro_time_posted DESC';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	//get_menu_intro
	public function get_menu_intro($intro_block){
		$sql = 'SELECT intro_id, intro_title, intro_slug FROM intro LEFT JOIN (introcate) ON (intro.introcate_id= introcate.introcate_id) WHERE introcate.introcate_block='.$intro_block.' ORDER BY intro.intro_time_posted DESC';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_menu_intro_name($intro_block){
		$sql = 'SELECT introcate_name FROM introcate WHERE introcate_block='.$intro_block.' LIMIT 0, 1';
		$query = $this->db->query($sql);
		$row   = $query->row();		
		return $row->introcate_name;		
	}
	public function get_lastest_product($items){
		$sql = 'SELECT product_id, product_title, product_review, product_price, product_price_d, product_image, product_slug, product_path FROM product ORDER BY product_time_posted DESC LIMIT 0, '.$items;
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}	
}