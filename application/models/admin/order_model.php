<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
	}
	
	public function record_count(){
        if($this->session->userdata('status')>0){
			if($this->session->userdata('status')=='1')
				$this->db->where('order_status =',0);
			if($this->session->userdata('status')=='2')
				$this->db->where('order_status =',1);
			if($this->session->userdata('status')=='3')
				$this->db->where('order_status =',2);
			if($this->session->userdata('status')=='4')
				$this->db->where('order_status =',3);
		}
		return $this->db->count_all_results("orders");
    }
	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('orders');		
		if($this->session->userdata('status')>0){
			if($this->session->userdata('status')=='1')
				$this->db->where('order_status =',0);
			if($this->session->userdata('status')=='2')
				$this->db->where('order_status =',1);
			if($this->session->userdata('status')=='3')
				$this->db->where('order_status =',2);
			if($this->session->userdata('status')=='4')
				$this->db->where('order_status =',3);
		}
		$this->db->order_by('order_date','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	
	public function record_count_filter($str_like){		
		$this->db->from('orders');	
		$this->db->like('order_fullname', $str_like);
		$this->db->or_like('order_tel', $str_like);
        return $this->db->count_all_results();
    }
	

	
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');		
		$this->db->from('orders');		
		$this->db->like('order_fullname', $str_like);		
		$this->db->or_like('order_tel', $str_like);		
		$this->db->order_by('order_date','desc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	public function view($order_id){
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('order_id',$order_id);
		$query = $this->db->get();
		$row = $query->row();
		return $row;
	}
	
	public function get_product_image($product_id){
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_id',$product_id);
		$query = $this->db->get();
		$row = $query->row();
		return $row;
	}
	
	public function edit(){
		$code_msg = '';	
			
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$order_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('orders');
			$this->db->where('order_id',$order_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$order_id		 	 = $row->order_id;		
			$order_fullname 	   	= $row->order_fullname;
			$order_tel		 	= $row->order_tel;
			$order_email		= $row->order_email;
			$order_meta_desc	  = $row->order_meta_desc;
			$order_meta_key  	   = $row->order_meta_key;
			$image_old	  		= $row->order_image<>'' ? $row->order_image : '';
			$order_date		   = date('d/m/Y',$row->order_date);
			$order_time		   = date('H:i:s',$row->order_date);						
			
		}else{		
			$order_id		 = $this->input->post('id');
			$order_fullname 	  = $this->input->post('order_fullname');
			$ordercate_id 	 = $this->input->post('ordercate_id');			
			$order_tel 	 = trim($this->input->post('order_tel'));
			$order_email 	= trim($this->input->post('order_email'));
			$order_meta_desc  = trim($this->input->post('order_meta_desc'));
			$order_meta_key   = trim($this->input->post('order_meta_key'));
			$image_old  = $this->input->post('image_old');
			$order_slug 	   = linkvn_to_linken($order_fullname);
			
			$order_date_mysql = $this->back->datevn_to_datemysql($this->input->post('order_date'));
			$order_time       = $this->input->post('order_time');
			
			if(!$this->back->checkDateTime($order_date_mysql.' '.$order_time)){
				$order_date 	   = date('d/m/Y',time());
			    $order_time 	   = date('H:i:s',time());
			}else{
				$order_time       = $this->input->post('order_time');
				$order_date       = $this->input->post('order_date');
			}
			$order_date = strtotime($this->back->datevn_to_datemysql($order_date).' '.$order_time);
		
			if($order_fullname == ''){				
				$code_msg = '0';
			}
			if($order_tel == ''){				
				$code_msg .= ',1';
			}
			
			if($order_email == ''){				
				$code_msg .= ',2';
			}			
			
			//upload image file	
			$order_image = $image_old;
			if ($_FILES['order_image']['name']<>'' && $code_msg==""){				
				if($this->back->upload_file('./public/upload/order/','order_image')){
					$data_upload = $this->upload->data();				
					//create thumb
					if($this->back->create_thumb($data_upload['full_path'],$data_upload['file_name'],$data_upload['is_image'],160,120)){
						$this->back->delete_file('./public/upload/order/', $image_old);
						$this->back->delete_file('./public/upload/order/', 'small_'.$image_old);
						$order_image = $data_upload['file_name'];
					}								
				}
			}
						
			if($code_msg==""){								
				$data_order = array(				
				   'order_fullname'	 		=> $order_fullname,
				   'order_slug'	 		 => $order_slug,
				   'ordercate_id'	 	   => $ordercate_id,
				   'order_tel' 	       => $order_tel,
				   'order_email' 	      => $order_email,
				   'order_meta_desc' 	    => $order_meta_desc,
				   'order_meta_key' 	     => $order_meta_key,
				   'order_image' 	        => $order_image,
				   'order_date' 	  => $order_date
				);
				$this->db->where('order_id', $order_id);											
				if($this->db->update('order', $data_order)){					
					$code_msg       = '3';
				}
			}
		}
		
		$str_ordercate_choose = $this->get_select_ordercate($ordercate_id);
		
		/* get data return */
		$f_order = array(
			'order_id'	  	 => $order_id,
			'order_fullname'	  => $order_fullname,
			'order_tel'  	 => $order_tel,
			'order_email'    => $order_email,
			'order_meta_desc'  => $order_meta_desc,
			'order_meta_key'   => $order_meta_key,
			'order_date'	   => $order_date,
			'order_time'	   => $order_time,			
			'image_old'  => $image_old,						
			'code_msg'	   => $code_msg
		
		);		
		return $f_order;	
	}
	
	
	public function del(){
		$code_msg = '';
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));				
			$delete_query = "DELETE FROM order_items WHERE order_id IN(".$array_id.")";						
			$this->db->query($delete_query);
			$delete_query = "DELETE FROM orders WHERE order_id IN(".$array_id.")";						
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
		$sql = "SELECT * FROM orders WHERE order_id=".$id;		
		$query = $this->db->query($sql);
		$row = $query->row();
		$order_image = $row->order_image;
		$this->back->delete_file('./public/upload/order/', $order_image);
		$this->back->delete_file('./public/upload/order/', 'small_'.$order_image);
		$sql = "UPDATE order SET order_image = '' WHERE order_id=".$id;
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
	public function get_order_info($order_id){
		$member_id = $this->session->userdata('member_id');
		$sql = 'SELECT * FROM orders WHERE order_id='.$order_id;
		$query = $this->db->query($sql);		
		return $query->row();		
	}
	
	public function get_order_items($order_id){
		$sql = 'SELECT * FROM order_items WHERE order_id = '.$order_id;
		$query = $this->db->query($sql);		
		return $query->result_array();		
	}
	public function get_product_info($product_id){
		$select = "SELECT * FROM product WHERE product_id=".$product_id;
		$query = $this->db->query($select);
		$row = $query->row();		
		return $row;
	}
	
}
