<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accessory_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function index($limit, $page, $accesscategory_children){		
		$sql = 'SELECT accessproduct_id, accessproduct_title, accessproduct_review, accessproduct_image, accessproduct_slug FROM accessproduct WHERE accesscategory_id IN('.$accesscategory_children.') ORDER BY accessproduct_time_posted DESC LIMIT '.$page.', '.$limit;		
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function record_count($accesscategory_children){        
		$sql = 'SELECT * FROM accessproduct WHERE accesscategory_id IN('.$accesscategory_children.')';		
		$query = $this->db->query($sql);
		return $query->num_rows();
    }
	
	public function get_accesscategory_id($slug){
		if($this->check_slug('accesscategory','accesscategory_slug',$slug)){
			$sql = 'SELECT * FROM accesscategory WHERE accesscategory_slug ="'.$slug.'"';
		}else{
			$sql = 'SELECT * FROM accesscategory ORDER BY accesscategory_select LIMIT 0, 1';
		}		
		$query = $this->db->query($sql);
		$row   = $query->row();				
		return $row;		
	}
	
	public function get_accesscategory_by_id($id){		
		$sql = 'SELECT * FROM accesscategory WHERE accesscategory_id ="'.$id.'"';			
		$query = $this->db->query($sql);						
		return $query->row();		
	}
	
	public function get_menu_left($accesscategory_parent, $accesscategory_id, $accesscategory_path){
		$sql = 'SELECT accesscategory_id, accesscategory_path FROM accesscategory WHERE accesscategory_path LIKE "'.$accesscategory_path.'%"';
		$query = $this->db->query($sql);
		if($query->num_rows()==1){
			$sql = 'SELECT * FROM accesscategory WHERE accesscategory_parent = '.$accesscategory_parent.' ORDER BY accesscategory_select';
		}else{
			$sql = 'SELECT * FROM accesscategory WHERE accesscategory_parent = '.$accesscategory_id.' ORDER BY accesscategory_select';
		}
		$query = $this->db->query($sql);				
		return  $query->result_array();		
	}
	
	public function get_parent_name($accesscategory_parent, $accesscategory_id, $accesscategory_path){
		$sql = 'SELECT accesscategory_id FROM accesscategory WHERE accesscategory_path LIKE "'.$accesscategory_path.'%"';
		$query = $this->db->query($sql);
		if($query->num_rows()==1){
			$sql = 'SELECT * FROM accesscategory WHERE accesscategory_id = '.$accesscategory_parent;
		}else{
			$sql = 'SELECT * FROM accesscategory WHERE accesscategory_id = '.$accesscategory_id;
		}
		$query = $this->db->query($sql);
		$row =  $query->row();				
		return $row->accesscategory_name;
	}
	
	public function get_path($accesscategory_path){
		$path_arr = explode('/',substr($accesscategory_path,0,-1));
		$i = 0;
		$path_r = array();
		foreach($path_arr as $key => $val){
			$i = $i + 1;
			$sql = 'SELECT accesscategory_id, accesscategory_name, accesscategory_slug FROM accesscategory WHERE accesscategory_id = '.$val;
			$query = $this->db->query($sql);
			$row =  $query->row();	
			$path_r[$i]['accesscategory_id'] = $row->accesscategory_id;
			$path_r[$i]['accesscategory_name'] = $row->accesscategory_name;
			$path_r[$i]['accesscategory_slug'] = $row->accesscategory_slug;		
		}						
		return $path_r;
	}
	
	public function get_accesscategory_name($accesscategory_id){		
		$sql = 'SELECT * FROM accesscategory WHERE accesscategory_id ='.$accesscategory_id;				
		$query = $this->db->query($sql);					
		return $query->row();		
	}
	
	
	
	public function get_accessproduct_id($slug){
		if($this->check_slug('accessproduct','accessproduct_slug',$slug)){
			$sql = 'SELECT accessproduct_id, accesscategory_id, accessproduct_title, accessproduct_review, accessproduct_content, accessproduct_slug, accessproduct_image, accessproduct_meta_desc, accessproduct_meta_key, FROM_UNIXTIME(accessproduct_time_posted,"%d/%m/%Y %r") as accessproduct_time_posted, FROM_UNIXTIME(accessproduct_time_posted,"%w") as accessproduct_day FROM accessproduct WHERE accessproduct_slug ="'.$slug.'"';
		}else{
			redirect('accessproduct','refresh');
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
		$sql = 'SELECT accessproduct_id, accessproduct_title, accessproduct_image, accessproduct_time_posted FROM accessproduct ORDER BY accessproduct_time_posted DESC LIMIT 0, 4';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_other_new($accesscategory_id, $newcrr_id){
		$sql = 'SELECT accessproduct_id, accessproduct_title, accessproduct_image, FROM_UNIXTIME(accessproduct_time_posted, "%d/%m/%Y") as accessproduct_time_posted, accessproduct_slug FROM accessproduct WHERE accesscategory_id = '.$accesscategory_id.' AND accessproduct_id<> '.$newcrr_id.' ORDER BY accessproduct_time_posted DESC LIMIT 0, 4';
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
	
	public function get_part($accessproduct_id){
		$sql = 'SELECT * FROM accessproduct WHERE accessproduct_id ='.$accessproduct_id;
		$query = $this->db->query($sql);		
		return $query->row();				
	}
	
}