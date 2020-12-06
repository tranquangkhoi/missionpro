<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model{
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
	
	public function product_of_cate($category_children, $item){
		$w_cate = $this->get_in_category($category_children);		
		$sql = 'SELECT product_status, product_id, product_title, product_review, product_price, product_price_d, product_image, category_id, product_slug, product_path FROM  product WHERE  '.$w_cate.' AND product_status<>0 ORDER BY product_time_posted DESC LIMIT 0,'.$item;
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_banner($banner_block, $item){
		$sql = 'SELECT * FROM banner LEFT JOIN (bannercate) ON (banner.bannercate_id= bannercate.bannercate_id) WHERE bannercate.bannercate_block='.$banner_block.' ORDER BY banner.banner_time_posted DESC LIMIT 0, '.$item;
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_lastest_new(){
		$sql = 'SELECT new_id, new_title, new_image, FROM_UNIXTIME(new_time_posted ,"%d/%m") as new_time_posted, new_slug FROM news ORDER BY new_time_posted DESC LIMIT 0, 10';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_help(){
		$sql = 'SELECT * FROM chat ORDER BY chat_type, chat_order DESC LIMIT 0, 4';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_hotline(){
		$sql = 'SELECT * FROM web ORDER BY web_order LIMIT 0, 1';
		$query = $this->db->query($sql);		
		return $query->row();		
	}
	
	public function get_intro($intro_block, $limit){
		$sql = 'SELECT intro.intro_id, intro.intro_title, intro.intro_slug FROM intro LEFT JOIN (introcate) ON (intro.introcate_id= introcate.introcate_id) WHERE introcate.introcate_block='.$intro_block." ORDER BY intro.intro_time_posted DESC LIMIT 0,".$limit;
		$query = $this->db->query($sql);		
		return $query->result_array();
	}
		
}