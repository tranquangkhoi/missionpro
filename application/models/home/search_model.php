<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function index($limit, $page, $keyword, $sort){		
		if($sort=='0'){
			$sql = "SELECT product_id, product_status, product_title, product_review, product_image, product_slug, product_path, product_price, product_price_d FROM product WHERE product_meta_key LIKE '%".$keyword."%' OR product_title LIKE '%".$keyword."%' OR product_review LIKE '%".$keyword."%' ORDER BY product_time_posted DESC LIMIT ".$page.", ".$limit;		
		}else{
			$order = $sort=='1' ? 'ASC' : 'DESC';
			$sql = "SELECT product_id, product_status, product_title, product_review, product_image, product_slug, product_path, product_price, product_price_d FROM product WHERE product_meta_key LIKE '%".$keyword."%' OR product_title LIKE '%".$keyword."%' OR product_review LIKE '%".$keyword."%' ORDER BY product_price ".$order." LIMIT ".$page.", ".$limit;		
		}
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function record_count($keyword){        
		$sql = "SELECT * FROM product WHERE product_meta_key LIKE '%".$keyword."%' OR product_title LIKE '%".$keyword."%' OR product_review LIKE '%".$keyword."%' ";		
		$query = $this->db->query($sql);
		return $query->num_rows();
    }
}