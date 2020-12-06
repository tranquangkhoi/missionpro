<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Useteam_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_intro_id($slug, $intro_block){
		if($this->check_slug($slug,$intro_block)){
			$sql = 'SELECT intro_id, intro_id, intro_title, intro_content, intro_slug, intro_image, intro_meta_desc, intro_meta_key, FROM_UNIXTIME(intro_time_posted,"%d/%m/%Y %r") as intro_time_posted, FROM_UNIXTIME(intro_time_posted,"%w") as intro_day 
			FROM intro LEFT JOIN (introcate) ON (intro.introcate_id= introcate.introcate_id)
			WHERE intro.intro_slug ="'.$slug.'" AND introcate.introcate_block = '.$intro_block;
		}else{
			$sql = 'SELECT intro_id, intro_id, intro_title, intro_content, intro_slug, intro_image, intro_meta_desc, intro_meta_key, FROM_UNIXTIME(intro_time_posted,"%d/%m/%Y %r") as intro_time_posted, FROM_UNIXTIME(intro_time_posted,"%w") as intro_day 
			FROM intro LEFT JOIN (introcate) ON (intro.introcate_id= introcate.introcate_id)
			WHERE introcate.introcate_block = '.$intro_block.' ORDER BY intro.intro_time_posted DESC LIMIT 0, 1';
			//$sql = 'SELECT intro_id, intro_id, intro_title, intro_content, intro_slug, intro_image, intro_meta_desc, intro_meta_key, FROM_UNIXTIME(intro_time_posted,"%d/%m/%Y %r") as intro_time_posted, FROM_UNIXTIME(intro_time_posted,"%w") as intro_day FROM intro ORDER BY intro_time_posted DESC LIMIT 0, 1';
		}		
		$query = $this->db->query($sql);
		$row   = $query->row();				
		return $row;		
	}
	
	public function check_slug($slug, $intro_block){
		$sql = 'SELECT intro_id FROM intro LEFT JOIN (introcate) ON (intro.introcate_id= introcate.introcate_id) WHERE intro.intro_slug ="'.$slug.'" AND introcate.introcate_block ='.$intro_block;		
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