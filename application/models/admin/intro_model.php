<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intro_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	
	public function record_count(){
        return $this->db->count_all("intro");
    }
	
	public function record_count_filter($str_like, $introcate_id){		
		$this->db->from('intro');	
		$this->db->like('intro_title', $str_like);
		if($introcate_id>0){
			$this->db->where('introcate_id', $introcate_id);
		}
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('intro');
		$this->db->order_by('intro_time_posted','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like, $introcate_id){
		$this->db->select('*');		
		$this->db->from('intro');		
		$this->db->like('intro_title', $str_like);
		if($introcate_id>0){
			$this->db->where('introcate_id', $introcate_id);
		}
		$this->db->order_by('intro_time_posted','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function add(){
		$code_msg = '';
		$introcate_id = $this->input->get_post('introcate_id');
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$intro_title 	  	= '';	
			$intro_review 	 	= '';
			$intro_content 		= '';
			$intro_meta_desc  	= '';
			$intro_meta_key   	= '';								
			$intro_date 	   	= date('d/m/Y',time());
			$intro_time 	   	= date('H:i:s',time());				
		}else{		
			$intro_title 	  	= $this->input->post('intro_title');			
			$intro_review 	 	= trim($this->input->post('intro_review'));
			$intro_content 		= trim($this->input->post('intro_content'));
			$intro_meta_desc  	= trim($this->input->post('intro_meta_desc'));
			$intro_meta_key   	= trim($this->input->post('intro_meta_key'));			
			$intro_slug   		= linkvn_to_linken($intro_title);
			
			$intro_date_mysql = $this->back->datevn_to_datemysql($this->input->post('intro_date'));
			$intro_time       = $this->input->post('intro_time');
			
			if(!$this->back->checkDateTime($intro_date_mysql.' '.$intro_time)){
				$intro_date 	   = date('d/m/Y',time());
			    $intro_time 	   = date('H:i:s',time());
			}else{
				$intro_time       = $this->input->post('intro_time');
				$intro_date       = $this->input->post('intro_date');
			}
			$intro_time_posted = strtotime($this->back->datevn_to_datemysql($intro_date).' '.$intro_time);
		
			if($intro_title == ''){				
				$code_msg = '0';
			}
			if($intro_review == ''){				
				$code_msg .= ',1';
			}
			
			if($intro_content == ''){				
				$code_msg .= ',2';
			}			
			
			//upload image file	
			$intro_image = '';
			if ($_FILES['intro_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/intro/','intro_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],160,120,'small_')){
						$intro_image = $data_upload['file_name'];
					}								
				}
			}
						
			if($code_msg==""){								
				$data_intro = array(								   
				   'introcate_id'	 	   	=> $introcate_id,
				   'intro_title'	 		=> $intro_title,
				   'intro_review' 	       	=> $intro_review,
				   'intro_content' 	      	=> $intro_content,
				   'intro_meta_desc' 	    => $intro_meta_desc,
				   'intro_meta_key' 	    => $intro_meta_key,
				   'intro_slug'	    		=> $intro_slug,
				   'intro_image' 	        => $intro_image,
				   'intro_time_posted' 	  	=> $intro_time_posted
				);			
				if($this->db->insert('intro', $data_intro)){
					$intro_title 	  	= '';	
					$intro_review 	 	= '';
					$intro_content 		= '';
					$intro_meta_desc  	= '';
					$intro_meta_key   	= '';			
					$code_msg       	= '3';
				}
			}
		}
				
				
		$str_introcate_choose = $this->get_select_introcate($introcate_id);	
		
		/* get data return */
		$f_intro = array(
			'intro_title'	  		=> $intro_title,
			'intro_review'  	 	=> $intro_review,
			'intro_content'    		=> $intro_content,
			'intro_meta_desc'  		=> $intro_meta_desc,
		 	'intro_meta_key'   		=> $intro_meta_key,
			'intro_date'	   		=> $intro_date,
			'intro_time'	   		=> $intro_time,
			'introcate_choose' 		=> $str_introcate_choose,						
			'code_msg'	   			=> $code_msg		
		);		
		return $f_intro;		
	}
	
	
	public function edit(){
		$code_msg = '';	
			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$intro_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('intro');
			$this->db->where('intro_id',$intro_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$intro_id		 	 	= $row->intro_id;
			$introcate_id	 	 	= $row->introcate_id;			
			$intro_title 	   	  	= $row->intro_title;
			$intro_review		 	= $row->intro_review;
			$intro_content			= $row->intro_content;
			$intro_meta_desc	  	= $row->intro_meta_desc;
			$intro_meta_key  	   	= $row->intro_meta_key;			
			$image_old	  			= $row->intro_image<>'' ? $row->intro_image : '';
			$intro_date		   		= date('d/m/Y',$row->intro_time_posted);
			$intro_time		   		= date('H:i:s',$row->intro_time_posted);						
			
		}else{		
			$intro_id		 	= $this->input->post('id');
			$introcate_id 	 	= $this->input->post('introcate_id');			
			$intro_title 	  	= $this->input->post('intro_title');			
			$intro_review 	 	= trim($this->input->post('intro_review'));
			$intro_content 		= trim($this->input->post('intro_content'));
			$intro_meta_desc  	= trim($this->input->post('intro_meta_desc'));
			$intro_meta_key   	= trim($this->input->post('intro_meta_key'));			
			$intro_slug   		= linkvn_to_linken($intro_title);
						
			$image_old  		= $this->input->post('image_old');			
			$intro_date_mysql 	= $this->back->datevn_to_datemysql($this->input->post('intro_date'));
			$intro_time       	= $this->input->post('intro_time');
			
			if(!$this->back->checkDateTime($intro_date_mysql.' '.$intro_time)){
				$intro_date 	   = date('d/m/Y',time());
			    $intro_time 	   = date('H:i:s',time());
			}else{
				$intro_time       = $this->input->post('intro_time');
				$intro_date       = $this->input->post('intro_date');
			}
			$intro_time_posted = strtotime($this->back->datevn_to_datemysql($intro_date).' '.$intro_time);
		
			if($intro_title == ''){				
				$code_msg = '0';
			}
			if($intro_review == ''){				
				$code_msg .= ',1';
			}
			
			if($intro_content == ''){				
				$code_msg .= ',2';
			}			
			
			//upload image file	
			$intro_image = $image_old;
			if ($_FILES['intro_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/intro/','intro_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],160,120,'small_')){
						$this->back->delete_file('./public/upload/intro/', $image_old);
						$this->back->delete_file('./public/upload/intro/', 'small_'.$image_old);
						$intro_image = $data_upload['file_name'];
					}								
				}
			}
						
			if($code_msg==""){								
				$data_intro = array(				
					'introcate_id'	 	   => $introcate_id,
				   	'intro_title'	  		=> $intro_title,
					'intro_review'  	 	=> $intro_review,
					'intro_content'    		=> $intro_content,
					'intro_meta_desc'  		=> $intro_meta_desc,
					'intro_meta_key'   		=> $intro_meta_key,								
					'intro_slug'	    	=> $intro_slug,
				   	'intro_image' 	        => $intro_image,
				   	'intro_time_posted' 	=> $intro_time_posted
				);
				$this->db->where('intro_id', $intro_id);											
				if($this->db->update('intro', $data_intro)){					
					$code_msg       = '3';
				}
			}
		}
		
		$str_introcate_choose = $this->get_select_introcate($introcate_id);
		
		/* get data return */
		$f_intro = array(
			'intro_id'	  	 		=> $intro_id,
			'intro_title'	  		=> $intro_title,
			'intro_review'  	 	=> $intro_review,
			'intro_content'    		=> $intro_content,
			'intro_meta_desc'  		=> $intro_meta_desc,
			'intro_meta_key'   		=> $intro_meta_key,					
			'intro_date'   			=> $intro_date,
			'intro_time'   			=> $intro_time,			
			'introcate_choose' 		=> $str_introcate_choose,
			'image_old'  			=> $image_old,						
			'code_msg'	   			=> $code_msg
		
		);		
		return $f_intro;	
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));	
						
			$dir_intro = './public/upload/intro/';
			$select_query = "SELECT intro_image FROM intro WHERE intro_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$intro_image = $row->intro_image;
				$this->back->delete_file($dir_intro, $intro_image);
				$this->back->delete_file($dir_intro, 'small_'.$intro_image);				
			}
			$delete_query = "DELETE FROM intro WHERE intro_id IN(".$array_id.")";						
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
		$sql = "SELECT * FROM intro WHERE intro_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$intro_image = $row->intro_image;
		$this->back->delete_file('./public/upload/intro/', $intro_image);
		$this->back->delete_file('./public/upload/intro/', 'small_'.$intro_image);
		$sql = "UPDATE intro SET intro_image = '' WHERE intro_id=".$id;
		if($this->db->query($sql)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	private function get_select_introcate($introcate_id=''){
		$this->db->select('introcate_id, introcate_name');
		$this->db->from('introcate');		
		$this->db->order_by('introcate_order','asc');
		$query = $this->db->get();
		$introcate_choose = '';
		foreach($query->result() as $row){			
			if($row->introcate_id == $introcate_id){
				$introcate_choose .= "<option value=".$row->introcate_id." selected>".$row->introcate_name."</option>";
			}else{
				$introcate_choose .= "<option value=".$row->introcate_id.">".$row->introcate_name."</option>";
			}
		}
		return $introcate_choose;		
	}
	
	public function get_select_introcate_full($introcate_id=''){
		$this->db->select('introcate_id, introcate_name');
		$this->db->from('introcate');		
		$this->db->order_by('introcate_order','asc');
		$query = $this->db->get();
		$introcate_choose = '<option value="0">Tất cả danh mục</option>';
		foreach($query->result() as $row){			
			if($row->introcate_id == $introcate_id){
				$introcate_choose .= "<option value=".$row->introcate_id." selected>".$row->introcate_name."</option>";
			}else{
				$introcate_choose .= "<option value=".$row->introcate_id.">".$row->introcate_name."</option>";
			}
		}
		return $introcate_choose;		
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
