<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	
	public function record_count(){
        return $this->db->count_all("news");
    }
	
	public function record_count_filter($str_like, $newcate_id){		
		$this->db->from('news');	
		$this->db->like('new_title', $str_like);
		if($newcate_id>0){
			$this->db->where('newcate_id', $newcate_id);
		}
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('news');
		$this->db->order_by('new_time_posted','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like, $newcate_id){
		$this->db->select('*');		
		$this->db->from('news');		
		$this->db->like('new_title', $str_like);
		if($newcate_id>0){
			$this->db->where('newcate_id', $newcate_id);
		}
		$this->db->order_by('new_time_posted','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function add(){
		$code_msg = '';
		$newcate_id = $this->input->get_post('newcate_id');
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$new_title 	  		= '';	
			$new_review 	 	= '';
			$new_content 		= '';
			$new_meta_desc  	= '';
			$new_meta_key   	= '';
			$new_date 	   		= date('d/m/Y',time());
			$new_time 	   		= date('H:i:s',time());				
		}else{		
			$new_title 	  		= $this->input->post('new_title');			
			$new_review 	 	= trim($this->input->post('new_review'));
			$new_content 		= trim($this->input->post('new_content'));
			$new_meta_desc  	= trim($this->input->post('new_meta_desc'));
			$new_meta_key   	= trim($this->input->post('new_meta_key'));
			$new_slug   		= linkvn_to_linken($new_title);		
			
			$new_date_mysql = $this->back->datevn_to_datemysql($this->input->post('new_date'));
			$new_time       = $this->input->post('new_time');
			
			if(!$this->back->checkDateTime($new_date_mysql.' '.$new_time)){
				$new_date 	   = date('d/m/Y',time());
			    $new_time 	   = date('H:i:s',time());
			}else{
				$new_time       = $this->input->post('new_time');
				$new_date       = $this->input->post('new_date');
			}
			$new_time_posted = strtotime($this->back->datevn_to_datemysql($new_date).' '.$new_time);
		
			if($new_title == ''){				
				$code_msg = '0';
			}
			if($new_review == ''){				
				$code_msg .= ',1';
			}
			
			if($new_content == ''){				
				$code_msg .= ',2';
			}			
			
			//upload image file	
			$new_image = '';
			if ($_FILES['new_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/new/','new_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],160,120,'small_')){
						$new_image = $data_upload['file_name'];
					}								
				}
			}
						
			if($code_msg==""){								
				$data_new = array(								   
				   'newcate_id'	 	   	=> $newcate_id,
				   'new_title'	 		=> $new_title,
				   'new_review' 	    => $new_review,
				   'new_content' 	    => $new_content,
				   'new_meta_desc' 	    => $new_meta_desc,
				   'new_meta_key' 	    => $new_meta_key,				   				   
				   'new_image' 	        => $new_image,
				   'new_time_posted' 	=> $new_time_posted,
				   'new_slug' 			=> $new_slug
				);			
				if($this->db->insert('news', $data_new)){
					$new_title 	  		= '';	
					$new_review 	 	= '';
					$new_content 		= '';
					$new_meta_desc  	= '';
					$new_meta_key   	= '';
					$code_msg       = '3';
				}
			}
		}
				
				
		$str_newcate_choose = $this->get_select_newcate($newcate_id);	
		
		/* get data return */
		$f_new = array(
			'new_title'	  		=> $new_title,
			'new_review'  	 	=> $new_review,
			'new_content'    	=> $new_content,
			'new_meta_desc'  	=> $new_meta_desc,
			'new_meta_key'   	=> $new_meta_key,
			'new_meta_key_en'  	=> $new_meta_key,
			'new_date'	   		=> $new_date,
			'new_time'	   		=> $new_time,
			'newcate_choose' 	=> $str_newcate_choose,						
			'code_msg'	   		=> $code_msg		
		);		
		return $f_new;		
	}
	
	
	public function edit(){
		$code_msg = '';	
			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$new_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('news');
			$this->db->where('new_id',$new_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$new_id		 	 	= $row->new_id;
			$newcate_id	 	 	= $row->newcate_id;
			$new_title 	   	  	= $row->new_title;
			$new_review		 	= $row->new_review;
			$new_content		= $row->new_content;
			$new_meta_desc	  	= $row->new_meta_desc;
			$new_meta_key	   	= $row->new_meta_key;
			$image_old	  = $row->new_image<>'' ? $row->new_image : '';
			$new_date		   = date('d/m/Y',$row->new_time_posted);
			$new_time		   = date('H:i:s',$row->new_time_posted);						
			
		}else{		
			$new_id		 		= $this->input->post('id');			
			$newcate_id 		= $this->input->post('newcate_id');			
			
			$new_title 	  		= $this->input->post('new_title');
			$new_review 	 	= trim($this->input->post('new_review'));
			$new_content 		= trim($this->input->post('new_content'));
			$new_meta_desc  	= trim($this->input->post('new_meta_desc'));
			$new_meta_key   	= trim($this->input->post('new_meta_key'));
			$image_old  		= $this->input->post('image_old');			
			$new_slug   		= linkvn_to_linken($new_title);			
			$new_date_mysql = $this->back->datevn_to_datemysql($this->input->post('new_date'));
			$new_time       = $this->input->post('new_time');
			
			if(!$this->back->checkDateTime($new_date_mysql.' '.$new_time)){
				$new_date 	   = date('d/m/Y',time());
			    $new_time 	   = date('H:i:s',time());
			}else{
				$new_time       = $this->input->post('new_time');
				$new_date       = $this->input->post('new_date');
			}
			$new_time_posted = strtotime($this->back->datevn_to_datemysql($new_date).' '.$new_time);
		
			if($new_title == ''){				
				$code_msg = '0';
			}
			if($new_review == ''){				
				$code_msg .= ',1';
			}
			
			if($new_content == ''){				
				$code_msg .= ',2';
			}			
			
			//upload image file	
			$new_image = $image_old;
			if ($_FILES['new_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/new/','new_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],160,120,'small_')){
						$this->back->delete_file('./public/upload/new/', $image_old);
						$this->back->delete_file('./public/upload/new/', 'small_'.$image_old);
						$new_image = $data_upload['file_name'];
					}								
				}
			}
						
			if($code_msg==""){								
				$data_new = array(								   
				   'newcate_id'	 	   	=> $newcate_id,
				   'new_title'	 		=> $new_title,
				   'new_review' 	    => $new_review,
				   'new_content' 	    => $new_content,
				   'new_meta_desc' 	    => $new_meta_desc,
				   'new_meta_key' 	    => $new_meta_key,				   
				   'new_image' 	        => $new_image,
				   'new_time_posted' 	=> $new_time_posted,
				   'new_slug' 			=> $new_slug
				);
				$this->db->where('new_id', $new_id);											
				if($this->db->update('news', $data_new)){					
					$code_msg       = '3';
				}
			}
		}
		
		$str_newcate_choose = $this->get_select_newcate($newcate_id);
		
		/* get data return */
		$f_new = array(
			'new_id'	  	 	=> $new_id,
			'new_title'	  		=> $new_title,
			'new_review'  	 	=> $new_review,
			'new_content'    	=> $new_content,
			'new_meta_desc'  	=> $new_meta_desc,
		    'new_meta_key'   	=> $new_meta_key,		
			'new_date'	   		=> $new_date,
			'new_time'	   		=> $new_time,
			'newcate_choose' 	=> $str_newcate_choose,
			'image_old'  	  	=> $image_old,						
			'code_msg'	   		=> $code_msg
		
		);		
		return $f_new;	
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));	
						
			$dir_new = './public/upload/new/';
			$select_query = "SELECT new_image FROM news WHERE new_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$new_image = $row->new_image;
				$this->back->delete_file($dir_new, $new_image);
				$this->back->delete_file($dir_new, 'small_'.$new_image);				
			}
			$delete_query = "DELETE FROM news WHERE new_id IN(".$array_id.")";						
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
		$sql = "SELECT * FROM news WHERE new_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$new_image = $row->new_image;
		$this->back->delete_file('./public/upload/new/', $new_image);
		$this->back->delete_file('./public/upload/new/', 'small_'.$new_image);
		$sql = "UPDATE news SET new_image = '' WHERE new_id=".$id;
		if($this->db->query($sql)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	private function get_select_newcate($newcate_id=''){
		$this->db->select('newcate_id, newcate_name');
		$this->db->from('newcate');		
		$this->db->order_by('newcate_order','asc');
		$query = $this->db->get();
		$newcate_choose = '';
		foreach($query->result() as $row){			
			if($row->newcate_id == $newcate_id){
				$newcate_choose .= "<option value=".$row->newcate_id." selected>".$row->newcate_name."</option>";
			}else{
				$newcate_choose .= "<option value=".$row->newcate_id.">".$row->newcate_name."</option>";
			}
		}
		return $newcate_choose;		
	}
	
	public function get_select_newcate_full($newcate_id=''){
		$this->db->select('newcate_id, newcate_name');
		$this->db->from('newcate');		
		$this->db->order_by('newcate_order','asc');
		$query = $this->db->get();
		$newcate_choose = '<option value="0">Tất cả danh mục</option>';
		foreach($query->result() as $row){			
			if($row->newcate_id == $newcate_id){
				$newcate_choose .= "<option value=".$row->newcate_id." selected>".$row->newcate_name."</option>";
			}else{
				$newcate_choose .= "<option value=".$row->newcate_id.">".$row->newcate_name."</option>";
			}
		}
		return $newcate_choose;		
	}
	
	private function get_frames(){
		$f_arr = array();
		$this->db->select('frame_code, frame_name');
		$this->db->from('system_frame');	
		$this->db->order_by('frame_order','asc');
		$query = $this->db->get();
		$i = 0;
		foreach($query->result() as $row){
			$i = $i + 1;
			$f_arr[$i]['frame_code'] = $row->frame_code;
			$f_arr[$i]['frame_name'] = $row->frame_name;
		}
		return $f_arr;		
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
	
}
