<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prints_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}		
	
	public function inphieu(){		
		$order_id = $this->uri->segment(4);
		if($this->check_id('orders','order_id',$order_id)){
			$select = "SELECT * FROM orders WHERE order_id = ".$order_id;
			$query = $this->db->query($select);
			$row = $query->row();
			
			$order_id 		 = $row->order_id;
			$order_fullname   = $row->order_fullname_to<> "" ? $row->order_fullname_to : $row->order_fullname;
			$order_address 	= $row->order_address_to<> "" ? $row->order_address_to : $row->order_address;
			$order_tel 		= $row->order_tel_to<> "" ? $row->order_tel_to : $row->order_tel;
			$order_note   	   = $row->order_note;
			$order_ship   	   = $row->order_ship;
			
			$sql = 'SELECT * FROM order_items WHERE order_id = '.$order_id;
			$query = $this->db->query($sql);		
			$order_items = $query->result_array();			
			
			/* get data return */
			$data_phieu = array(			
				'order_id' 	  	  => $order_id,
				'order_fullname' 	=> $order_fullname,
				'order_address' 	 => $order_address,
				'order_tel' 	     => $order_tel,
				'order_note' 	    => $order_note,			
				'order_ship' 	    => $order_ship,			
				'order_items'	   => $order_items
			);
			return $data_phieu;
		}else{
			header('Content-Type: text/html; charset=utf-8');
			die('Không có dữ liệu để in phiếu!');
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
