<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function index($limit, $page, $collection_children){		
		$sql = 'SELECT pcollection_id, pcollection_title, pcollection_review, pcollection_image, pcollection_slug FROM pcollection WHERE collection_id IN('.$collection_children.') ORDER BY pcollection_time_posted DESC LIMIT '.$page.', '.$limit;		
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function record_count($collection_children){        
		$sql = 'SELECT * FROM pcollection WHERE collection_id IN('.$collection_children.')';		
		$query = $this->db->query($sql);
		return $query->num_rows();
    }
	
	public function get_collection_id($slug){
		if($this->check_slug('collection','collection_slug',$slug)){
			$sql = 'SELECT * FROM collection WHERE collection_slug ="'.$slug.'"';
		}else{
			$sql = 'SELECT * FROM collection ORDER BY collection_select LIMIT 0, 1';
		}		
		$query = $this->db->query($sql);
		$row   = $query->row();				
		return $row;		
	}
	
	public function get_collection_by_id($id){		
		$sql = 'SELECT * FROM collection WHERE collection_id ="'.$id.'"';			
		$query = $this->db->query($sql);						
		return $query->row();		
	}
	
	public function get_menu_left($collection_parent, $collection_id, $collection_path){
		$sql = 'SELECT collection_id, collection_path FROM collection WHERE collection_path LIKE "'.$collection_path.'%"';
		$query = $this->db->query($sql);
		if($query->num_rows()==1){
			$sql = 'SELECT * FROM collection WHERE collection_parent = '.$collection_parent.' ORDER BY collection_select';
		}else{
			$sql = 'SELECT * FROM collection WHERE collection_parent = '.$collection_id.' ORDER BY collection_select';
		}
		$query = $this->db->query($sql);				
		return  $query->result_array();		
	}
	
	public function get_parent_name($collection_parent, $collection_id, $collection_path){
		$sql = 'SELECT collection_id FROM collection WHERE collection_path LIKE "'.$collection_path.'%"';
		$query = $this->db->query($sql);
		if($query->num_rows()==1){
			if($collection_parent<>0){
				$sql = 'SELECT * FROM collection WHERE collection_id = '.$collection_parent;
			}else{
				$sql = 'SELECT * FROM collection WHERE collection_id = '.$collection_id;	
			}			
		}else{
			$sql = 'SELECT * FROM collection WHERE collection_id = '.$collection_id;
		}
				
		$query = $this->db->query($sql);
		$row =  $query->row();				
		return $row->collection_name;
	}
	
	public function get_path($collection_path){
		$path_arr = explode('/',substr($collection_path,0,-1));
		$i = 0;
		$path_r = array();
		foreach($path_arr as $key => $val){
			$i = $i + 1;
			$sql = 'SELECT collection_id, collection_name, collection_slug FROM collection WHERE collection_id = '.$val;
			$query = $this->db->query($sql);
			$row =  $query->row();	
			$path_r[$i]['collection_id'] = $row->collection_id;
			$path_r[$i]['collection_name'] = $row->collection_name;
			$path_r[$i]['collection_slug'] = $row->collection_slug;		
		}						
		return $path_r;
	}
	
	public function get_collection_name($collection_id){		
		$sql = 'SELECT * FROM collection WHERE collection_id ='.$collection_id;				
		$query = $this->db->query($sql);					
		return $query->row();		
	}
	
	
	
	public function get_pcollection_id($slug){
		if($this->check_slug('pcollection','pcollection_slug',$slug)){
			$sql = 'SELECT pcollection_id, collection_id, pcollection_title, pcollection_color, pcollection_size, pcollection_review, pcollection_content, pcollection_slug, pcollection_image, pcollection_meta_desc, pcollection_meta_key, FROM_UNIXTIME(pcollection_time_posted,"%d/%m/%Y %r") as pcollection_time_posted, FROM_UNIXTIME(pcollection_time_posted,"%w") as pcollection_day, pcollection_price FROM pcollection WHERE pcollection_slug ="'.$slug.'"';
		}else{
			redirect('pcollection','refresh');
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
		$sql = 'SELECT pcollection_id, pcollection_title, pcollection_image, pcollection_time_posted FROM pcollection ORDER BY pcollection_time_posted DESC LIMIT 0, 4';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_other_new($collection_id, $newcrr_id){
		$sql = 'SELECT pcollection_id, pcollection_title, pcollection_image, FROM_UNIXTIME(pcollection_time_posted, "%d/%m/%Y") as pcollection_time_posted, pcollection_slug FROM pcollection WHERE collection_id = '.$collection_id.' AND pcollection_id<> '.$newcrr_id.' ORDER BY pcollection_time_posted DESC LIMIT 0, 4';
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
	
	public function get_part($pcollection_id){
		$sql = 'SELECT * FROM pcollection WHERE pcollection_id ='.$pcollection_id;
		$query = $this->db->query($sql);		
		return $query->row();				
	}
	
	public function get_tree(){
		//$sql = 'SELECT collection_id, IF(collection_level>1, CONCAT( IF(collection_level>2,REPEAT("&nbsp;&nbsp;&nbsp;", collection_level),REPEAT("&nbsp;&nbsp;", collection_level)), "|", REPEAT("-", 2),  " " ,collection_name), CONCAT("<b>",collection_name,"</b>")) as collection_name  FROM collection ORDER BY collection_select ';
		$sql = 'SELECT collection_id, collection_level,collection_name, collection_slug FROM collection ORDER BY collection_select ';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_lib_img($pcollection_id){
		$sql = 'SELECT image_name FROM pcollection_image WHERE pcollection_id='.$pcollection_id.' ORDER BY image_order ';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	public function get_other_pcollection($collection_children, $pcollection_crr_id){
		$sql = 'SELECT pcollection_id, pcollection_title, pcollection_review, pcollection_image, pcollection_slug FROM pcollection WHERE collection_id IN('.$collection_children.') AND pcollection_id<>'.$pcollection_crr_id.' ORDER BY pcollection_time_posted DESC LIMIT 0, 9';		
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
}