<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	
	public function record_count(){
        return $this->db->count_all("contact");
    }
	
	public function record_count_filter($str_like, $contactcate_id){		
		$this->db->from('contact');	
		$this->db->like('contact_subject', $str_like);
		if($contactcate_id>0){
			$this->db->where('contactcate_id', $contactcate_id);
		}
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('contact');		
		$this->db->order_by('contact_date','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like, $contactcate_id){
		$this->db->select('*');		
		$this->db->from('contact');		
		$this->db->like('contact_subject', $str_like);		
		$this->db->order_by('contact_date','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	public function view($contact_id){
		$this->db->select('*');
		$this->db->from('contact');
		$this->db->where('contact_id',$contact_id);
		$query = $this->db->get();
		$row = $query->row();
		return $row;
	}
	
	public function edit(){
		$code_msg = '';	
			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$contact_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('contact');
			$this->db->where('contact_id',$contact_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$contact_id		 	 = $row->contact_id;		
			$contact_subject 	   	= $row->contact_subject;
			$contact_tel		 	= $row->contact_tel;
			$contact_email		= $row->contact_email;
			$contact_meta_desc	  = $row->contact_meta_desc;
			$contact_meta_key  	   = $row->contact_meta_key;
			$image_old	  		= $row->contact_image<>'' ? $row->contact_image : '';
			$contact_date		   = date('d/m/Y',$row->contact_date);
			$contact_time		   = date('H:i:s',$row->contact_date);						
			
		}else{		
			$contact_id		 = $this->input->post('id');
			$contact_subject 	  = $this->input->post('contact_subject');
			$contactcate_id 	 = $this->input->post('contactcate_id');			
			$contact_tel 	 = trim($this->input->post('contact_tel'));
			$contact_email 	= trim($this->input->post('contact_email'));
			$contact_meta_desc  = trim($this->input->post('contact_meta_desc'));
			$contact_meta_key   = trim($this->input->post('contact_meta_key'));
			$image_old  = $this->input->post('image_old');
			$contact_slug 	   = linkvn_to_linken($contact_subject);
			
			$contact_date_mysql = $this->back->datevn_to_datemysql($this->input->post('contact_date'));
			$contact_time       = $this->input->post('contact_time');
			
			if(!$this->back->checkDateTime($contact_date_mysql.' '.$contact_time)){
				$contact_date 	   = date('d/m/Y',time());
			    $contact_time 	   = date('H:i:s',time());
			}else{
				$contact_time       = $this->input->post('contact_time');
				$contact_date       = $this->input->post('contact_date');
			}
			$contact_date = strtotime($this->back->datevn_to_datemysql($contact_date).' '.$contact_time);
		
			if($contact_subject == ''){				
				$code_msg = '0';
			}
			if($contact_tel == ''){				
				$code_msg .= ',1';
			}
			
			if($contact_email == ''){				
				$code_msg .= ',2';
			}			
			
			//upload image file	
			$contact_image = $image_old;
			if ($_FILES['contact_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/contact/','contact_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],160,120)){
						$this->back->delete_file('./public/upload/contact/', $image_old);
						$this->back->delete_file('./public/upload/contact/', 'small_'.$image_old);
						$contact_image = $data_upload['file_name'];
					}								
				}
			}
						
			if($code_msg==""){								
				$data_contact = array(				
				   'contact_subject'	 		=> $contact_subject,
				   'contact_slug'	 		 => $contact_slug,
				   'contactcate_id'	 	   => $contactcate_id,
				   'contact_tel' 	       => $contact_tel,
				   'contact_email' 	      => $contact_email,
				   'contact_meta_desc' 	    => $contact_meta_desc,
				   'contact_meta_key' 	     => $contact_meta_key,
				   'contact_image' 	        => $contact_image,
				   'contact_date' 	  => $contact_date
				);
				$this->db->where('contact_id', $contact_id);											
				if($this->db->update('contact', $data_contact)){					
					$code_msg       = '3';
				}
			}
		}
		
		$str_contactcate_choose = $this->get_select_contactcate($contactcate_id);
		
		/* get data return */
		$f_contact = array(
			'contact_id'	  	 => $contact_id,
			'contact_subject'	  => $contact_subject,
			'contact_tel'  	 => $contact_tel,
			'contact_email'    => $contact_email,
			'contact_meta_desc'  => $contact_meta_desc,
			'contact_meta_key'   => $contact_meta_key,
			'contact_date'	   => $contact_date,
			'contact_time'	   => $contact_time,			
			'image_old'  => $image_old,						
			'code_msg'	   => $code_msg
		
		);		
		return $f_contact;	
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));				
			$delete_query = "DELETE FROM contact WHERE contact_id IN(".$array_id.")";						
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
		$sql = "SELECT * FROM contact WHERE contact_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$contact_image = $row->contact_image;
		$this->back->delete_file('./public/upload/contact/', $contact_image);
		$this->back->delete_file('./public/upload/contact/', 'small_'.$contact_image);
		$sql = "UPDATE contact SET contact_image = '' WHERE contact_id=".$id;
		if($this->db->query($sql)){
			return TRUE;
		}else{
			return FALSE;
		}
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
