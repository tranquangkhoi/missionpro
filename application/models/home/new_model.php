<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class New_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function index($limit, $page, $newcate_id = null){
		$this->db->select('new_id, new_title, new_review, new_image, new_slug, new_time_posted');
		$this->db->from('news');
		if ($newcate_id) {
		  $this->db->where('newcate_id',$newcate_id);
		}
		$this->db->order_by('new_time_posted','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function record_count($newcate_id = null){        
		$sql = 'SELECT * FROM news';
		$sql .= isset($newcate_id) ? ' WHERE newcate_id ="'.$newcate_id.'"' : '';
		$query = $this->db->query($sql);
		return $query->num_rows();
    }
	
	public function get_newcate(){
		$sql = "SELECT * FROM newcate ORDER BY newcate_order";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	public function get_new_cate($newcate_id){
		$sql = "SELECT * FROM news WHERE newcate_id = $newcate_id ORDER BY new_time_posted LIMIT 0,4";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	public function get_newcate_id($slug){
		if($this->check_slug('newcate','newcate_slug',$slug)){
			$sql = 'SELECT * FROM newcate WHERE newcate_slug ="'.$slug.'"';
		}else{
			redirect('news','refresh');
		}		
		$query = $this->db->query($sql);
		$row   = $query->row();				
		return $row;		
	}
	
	public function get_newcate_name($newcate_id){		
		$sql = 'SELECT * FROM newcate WHERE newcate_id ='.$newcate_id;				
		$query = $this->db->query($sql);					
		return $query->row();		
	}
	
	
	
	public function get_new_id($slug){
		if($this->check_slug('news','new_slug',$slug)){
			$sql = 'SELECT new_id, newcate_id, new_title, new_content, new_slug, new_image, new_meta_desc, new_meta_key, FROM_UNIXTIME(new_time_posted,"%d/%m/%Y %r") as new_time_posted, FROM_UNIXTIME(new_time_posted,"%w") as new_day FROM news WHERE new_slug ="'.$slug.'"';
		}else{
			redirect('news','refresh');
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
		$sql = 'SELECT new_id, new_title, new_image, new_time_posted FROM news ORDER BY new_time_posted DESC LIMIT 0, 4';
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	
	public function get_other_new($newcate_id, $newcrr_id){
		$sql = 'SELECT new_id, new_title, new_image, FROM_UNIXTIME(new_time_posted, "%d/%m/%Y %r") as new_time_posted, new_slug FROM news WHERE newcate_id = '.$newcate_id.' AND new_id<> '.$newcrr_id.' ORDER BY new_time_posted DESC LIMIT 0, 4';
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
	
}