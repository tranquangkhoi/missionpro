<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	public function record_count(){
        return $this->db->count_all("web");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('web');	
		$this->db->like('web_bg', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('web');		
		$this->db->order_by('web_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');
		$this->db->like('web_bg', $str_like);
		$this->db->from('web');				
		$this->db->order_by('web_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('web');
		$this->db->where('web_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->web_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('web');
		$this->db->where('web_order < ',$crr_ord);
		$this->db->order_by('web_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->web_id;
			$up_ord = $row->web_order;
			
			$data_sort = array(				
				'web_order' => $crr_ord			
			);
			$this->db->where('web_id', $up_id);					
			$this->db->update('web', $data_sort);
			
			$data_sort = array(				
				'web_order' => $up_ord			
			);
			$this->db->where('web_id', $crr_id);					
			$this->db->update('web', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('web');
		$this->db->where('web_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->web_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('web');
		$this->db->where('web_order > ',$crr_ord);
		$this->db->order_by('web_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->web_id;
			$up_ord = $row->web_order;
			
			$data_sort = array(				
				'web_order' => $crr_ord			
			);
			$this->db->where('web_id', $up_id);					
			$this->db->update('web', $data_sort);
			
			$data_sort = array(				
				'web_order' => $up_ord			
			);
			$this->db->where('web_id', $crr_id);					
			$this->db->update('web', $data_sort);			
		}				
		
	}
	
	
	
	public function add(){
		$code_msg = '';		
		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$web_bg   = '';
			$web_hotline   = '';
			$web_contact   = '';
			$web_type   = '';					
		}else{		
			$web_bg 	= $this->input->post('web_bg');			
			$web_hotline    = $this->input->post('web_hotline');
			$web_contact    = $this->input->post('web_contact');
			$web_type    = is_numeric($this->input->post('web_type')) ? $this->input->post('web_type') : '0';			
			
			if($web_hotline == ""){				
				$code_msg = '0';
			}
			
			if($web_contact == ""){				
				$code_msg = '1';
			}
			
			//upload image file	
			$web_bg = '';
			if ($_FILES['web_bg']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/web/','web_bg')){
					$data_upload = $this->upload->data();					
					$web_bg = $data_upload['file_name'];													
				}
			}
						
			if($code_msg==""){				
				$this->db->select_max('web_order', 'max_order');
				$query = $this->db->get('web');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
				$data_web = array(				
				   'web_bg'	   => $web_bg,				   
				   'web_hotline'  => $web_hotline,
				   'web_contact'  => $web_contact,				  
				   'web_order' 	=> $max_order,
				   'web_bg' 	   => $web_bg
				);			
				if($this->db->insert('web', $data_web)){
					$web_bg 	= '';
					$web_hotline   = '';
					$web_type 	= '';								
					$code_msg = '2';
				}
			}
		}
				
		
		/* get data return */
		$f_web = array(
			'web_bg'	=> $web_bg,
			'web_hotline'	=> $web_hotline,
			'web_contact'	=> $web_contact,
			'web_type' 	=> $web_type,					
			'code_msg'	 => $code_msg
		);		
		return $f_web;		
	}
	
	
	public function edit(){
		$code_msg = '';			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$web_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
					
			$this->db->select('*');
			$this->db->from('web');
			$this->db->where('web_id',$web_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$web_id		 = $row->web_id;
			$web_bg 	   = $row->web_bg;
			$web_contact   = $row->web_contact;
			$web_hotline  	   = $row->web_hotline;
			$image_old	  	  = $row->web_bg<>'' ? $row->web_bg : '';									
		}else{		
			$id			  = $this->input->post('id');
			$web_id		 = $id;
			$web_bg 	   = $this->input->post('web_bg');			
			$web_hotline  	   = $this->input->post('web_hotline');
			$web_contact  	   = $this->input->post('web_contact');
			
			$image_old  = $this->input->post('image_old');							
			
			if($web_hotline == ""){				
				$code_msg = '0';
			}		
			
			if($web_contact == ""){				
				$code_msg = '1';
			}
			//upload image file	
			$web_bg = $image_old;
			if ($_FILES['web_bg']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/web/','web_bg')){
					$data_upload = $this->upload->data();						
					$web_bg = $data_upload['file_name'];													
				}
			}
								
			if($code_msg==""){
				
				$data_web = array(				
				   'web_bg'		=> $web_bg,
				   'web_contact'   => $web_contact,				  
				   'web_hotline'   => $web_hotline				   				   
				);	
				$this->db->where('web_id', $web_id);					
				if($this->db->update('web', $data_web)){					
					$code_msg = '2';																
				}
			}
		}
		
		/* get data return */
		$f_web = array(
			'web_id'		  	=> $web_id,
			'web_bg'	 		=> $web_bg,
			'web_hotline'   	   => $web_hotline,
			'web_contact'	=> $web_contact,
			'image_old'  	     => $image_old,					
			'code_msg'		  => $code_msg
		);		
		return $f_web;		
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));			
			
			$dir_web = './public/upload/web/';
			$select_query = "SELECT web_bg FROM web WHERE web_id IN(".$array_id.")";
			$query = $this->db->query($select_query);
			foreach($query->result() as $row){
				$web_bg = $row->web_bg;
				$this->back->delete_file($dir_web, $web_bg);
								
			}
			
			$delete_query = "DELETE FROM web WHERE web_id IN(".$array_id.")";			
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
		$sql = "SELECT * FROM web WHERE web_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$web_bg = $row->web_bg;
		
		$this->back->delete_file('./public/upload/web/', $web_bg);		
		$sql = "UPDATE web SET web_bg = '' WHERE web_id=".$id;
		if($this->db->query($sql)){
			return TRUE;
		}else{
			return FALSE;
		}
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
