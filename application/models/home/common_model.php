<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_latest_product($items){
		$sql = 'SELECT product_id, product_title, product_review, product_price, product_price_d, product_image, product_slug, product_path, product_status FROM product WHERE product_status<>0 ORDER BY product_time_posted DESC LIMIT 0, '.$items;
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_promotion_product($items){
		$sql = 'SELECT product_id, product_title, product_review, product_price, product_price_d, product_image, product_slug, product_path, product_status FROM product WHERE product_status<>0 and product_promotion = 1 ORDER BY product_time_posted DESC LIMIT 0, '.$items;
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_hot_products($limit, $offset = 0){
		$sql = 'SELECT product_id, product_title, product_review, product_price, product_price_d, product_image, product_slug, product_path, product_status FROM product WHERE product_status<>0 and product_hot = 1 ORDER BY product_time_posted DESC LIMIT '.$offset.',  '.$limit;
		$query = $this->db->query($sql);	
		return $query->result_array();		
	}
	
	public function get_count_hot_products(){
		$this->db->from('product');	
		$this->db->where('product_status <> ', 0);
		$this->db->where('product_hot', 1);
        return $this->db->count_all_results();
	}

	public function get_info_company(){
		$select = "SELECT * FROM config ORDER BY config_order LIMIt 0,1";
		$query = $this->db->query($select);
		$row = $query->row();
		return $row;		
	}
	
	public function get_banner($banner_block, $item){
		$sql = 'SELECT * FROM banner LEFT JOIN (bannercate) ON (banner.bannercate_id= bannercate.bannercate_id) WHERE bannercate.bannercate_block='.$banner_block.' ORDER BY banner.banner_time_posted DESC LIMIT 0, '.$item;
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
}