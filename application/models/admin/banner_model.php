<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function record_count(){
        return $this->db->count_all("banner");
    }
	
	public function record_count_filter($str_like, $bannercate_id){		
		$this->db->from('banner');	
		$this->db->like('banner_link', $str_like);
		if($bannercate_id>0){
			$this->db->where('bannercate_id', $bannercate_id);
		}
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('banner');
		$this->db->order_by('bannercate_id','asc');
		$this->db->order_by('banner_time_posted','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like, $bannercate_id){
		$this->db->select('*');		
		$this->db->from('banner');		
		$this->db->like('banner_link', $str_like);
		if($bannercate_id>0){
			$this->db->where('bannercate_id', $bannercate_id);
		}
		$this->db->order_by('banner_time_posted','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function add(){
		$code_msg = '';
		$bannercate_id = $this->input->get_post('bannercate_id');
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$banner_link 	  = '';							
			$banner_date 	   = date('d/m/Y',time());
			$banner_time 	   = date('H:i:s',time());				
		}else{		
			$banner_link 	  = $this->input->post('banner_link');				
			
			$banner_date_mysql = $this->back->datevn_to_datemysql($this->input->post('banner_date'));
			$banner_time       = $this->input->post('banner_time');
			
			if(!$this->back->checkDateTime($banner_date_mysql.' '.$banner_time)){
				$banner_date 	   = date('d/m/Y',time());
			    $banner_time 	   = date('H:i:s',time());
			}else{
				$banner_time       = $this->input->post('banner_time');
				$banner_date       = $this->input->post('banner_date');
			}
			$banner_time_posted = strtotime($this->back->datevn_to_datemysql($banner_date).' '.$banner_time);
		
			if($banner_link == ''){				
				$code_msg = '0';
			}
			if(empty($_FILES['banner_image']['name'])){				
				$code_msg .= ',1';
			}
			
			//upload image file	
			$banner_image = '';
			if ($_FILES['banner_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/banner/','banner_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],170,80,'small_')){					
						$banner_image = $data_upload['file_name'];
					}
				}
			}
						
			if($code_msg==""){								
				$size =  getimagesize(base_url().'public/upload/banner/'.$banner_image);				
				$data_banner = array(				
					'banner_height'	 		 	=> $size[1],
					'banner_width'	 		 	=> $size[0],
				   	'banner_link'	 		 	=> $banner_link,
				   	'bannercate_id'	 	   		=> $bannercate_id,				  
				   	'banner_image' 	        	=> $banner_image,
				  	'banner_time_posted' 	  	=> $banner_time_posted
				);			
				if($this->db->insert('banner', $data_banner)){
					$banner_link 	  = '';														
					$code_msg       = '3';
				}
			}
		}
				
				
		$str_bannercate_choose = $this->get_select_bannercate($bannercate_id);	
		
		/* get data return */
		$f_banner = array(
			'banner_link'	  => $banner_link,			
			'banner_date'	   => $banner_date,
			'banner_time'	   => $banner_time,
			'bannercate_choose' => $str_bannercate_choose,						
			'code_msg'	   => $code_msg
		
		);		
		return $f_banner;		
	}
	
	
	public function edit(){
		$code_msg = '';	
			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$banner_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('banner');
			$this->db->where('banner_id',$banner_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$banner_id		 	= $row->banner_id;
			$bannercate_id	 	= $row->bannercate_id;
			$banner_link 	   	  = $row->banner_link;			
			$image_old	  		= $row->banner_image<>'' ? $row->banner_image : '';
			$banner_date		  = date('d/m/Y',$row->banner_time_posted);
			$banner_time		  = date('H:i:s',$row->banner_time_posted);						
			
		}else{		
			$banner_id		 = $this->input->post('id');
			$banner_link 	   = $this->input->post('banner_link');
			$bannercate_id 	 = $this->input->post('bannercate_id');						
			$image_old  = $this->input->post('image_old');
			
			$banner_date_mysql = $this->back->datevn_to_datemysql($this->input->post('banner_date'));
			$banner_time       = $this->input->post('banner_time');
			
			if(!$this->back->checkDateTime($banner_date_mysql.' '.$banner_time)){
				$banner_date 	   = date('d/m/Y',time());
			    $banner_time 	   = date('H:i:s',time());
			}else{
				$banner_time       = $this->input->post('banner_time');
				$banner_date       = $this->input->post('banner_date');
			}
			$banner_time_posted = strtotime($this->back->datevn_to_datemysql($banner_date).' '.$banner_time);
		
			if($banner_link == ''){				
				$code_msg = '0';
			}				
			
			//upload image file	
			$banner_image = $image_old;
			if ($_FILES['banner_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/banner/','banner_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],170,80,'small_')){
						$this->back->delete_file('./public/upload/banner/', $image_old);
						$this->back->delete_file('./public/upload/banner/', 'small_'.$image_old);
						$banner_image = $data_upload['file_name'];						
					}								
				}
			}
						
			if($code_msg==""){
				$size =  getimagesize(base_url().'public/upload/banner/'.$banner_image);								
				$data_banner = array(				
				   'banner_height'	 		=> $size[1],
					'banner_width'	 		=> $size[0],
				   'banner_link'	 		=> $banner_link,
				   'bannercate_id'	 	   	=> $bannercate_id,				   
				   'banner_image' 	        => $banner_image,
				   'banner_time_posted' 	=> $banner_time_posted
				);
				$this->db->where('banner_id', $banner_id);											
				if($this->db->update('banner', $data_banner)){					
					$code_msg       = '3';
				}
			}
		}
		
		$str_bannercate_choose = $this->get_select_bannercate($bannercate_id);
		
		/* get data return */
		$f_banner = array(
			'banner_id'	  	 => $banner_id,
			'banner_link'	   => $banner_link,			
			'banner_date'	   => $banner_date,
			'banner_time'	   => $banner_time,
			'bannercate_choose' => $str_bannercate_choose,
			'image_old'  		 => $image_old,						
			'code_msg'	   	  => $code_msg
		
		);		
		return $f_banner;	
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));	
						
			$dir_banner = './public/upload/banner/';
			$select_query = "SELECT banner_image FROM banner WHERE banner_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$banner_image = $row->banner_image;
				$this->back->delete_file($dir_banner, $banner_image);
				$this->back->delete_file($dir_banner, 'small_'.$banner_image);				
			}
			$delete_query = "DELETE FROM banner WHERE banner_id IN(".$array_id.")";						
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
		$sql = "SELECT * FROM banner WHERE banner_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$banner_image = $row->banner_image;
		$this->back->delete_file('./public/upload/banner/', $banner_image);		
		$sql = "UPDATE banner SET banner_image = '' WHERE banner_id=".$id;
		if($this->db->query($sql)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	private function get_select_bannercate($bannercate_id=''){
		$this->db->select('bannercate_id, bannercate_name');
		$this->db->from('bannercate');		
		$this->db->order_by('bannercate_order','asc');
		$query = $this->db->get();
		$bannercate_choose = '';
		foreach($query->result() as $row){			
			if($row->bannercate_id == $bannercate_id){
				$bannercate_choose .= "<option value=".$row->bannercate_id." selected>".$row->bannercate_name."</option>";
			}else{
				$bannercate_choose .= "<option value=".$row->bannercate_id.">".$row->bannercate_name."</option>";
			}
		}
		return $bannercate_choose;		
	}
	
	public function get_bannercate(){
		$this->db->select('bannercate_id, bannercate_name');
		$this->db->from('bannercate');		
		$this->db->order_by('bannercate_order','asc');
		$query = $this->db->get();
		$bannercate_arr = array();
		foreach($query->result() as $row){			
			$bannercate_arr[$row->bannercate_id] = $row->bannercate_name;
		}
		return $bannercate_arr;		
	}
	
	public function get_select_bannercate_full($bannercate_id=''){
		$this->db->select('bannercate_id, bannercate_name');
		$this->db->from('bannercate');		
		$this->db->order_by('bannercate_order','asc');
		$query = $this->db->get();
		$bannercate_choose = '<option value="0">Tất cả danh mục</option>';
		foreach($query->result() as $row){			
			if($row->bannercate_id == $bannercate_id){
				$bannercate_choose .= "<option value=".$row->bannercate_id." selected>".$row->bannercate_name."</option>";
			}else{
				$bannercate_choose .= "<option value=".$row->bannercate_id.">".$row->bannercate_name."</option>";
			}
		}
		return $bannercate_choose;		
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
