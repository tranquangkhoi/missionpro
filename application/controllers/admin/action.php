<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	var $method_arr = array('active','update_status','order_status','update_ship', 'update_product_promotion');
	
	public function __construct(){
		parent::__construct();
	}
	
	public function _remap($method){	
		if(in_array($method,$this->method_arr)){
			 $this->$method();
		}else{
			$this->index();
		}
	}

	public function index(){		
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		echo 'No Action';		
	}
	
	public function active(){		
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}		
		$id  = $this->input->post('id');
		$fld_id  = $this->input->post('fld_id');
		$fld_active  = $this->input->post('fld_active');
		$tbl_name  = $this->input->post('tbl_name');	

		$select = "SELECT ".$fld_active." FROM ".$tbl_name." WHERE ".$fld_id." = ".$id;
		$query = $this->db->query($select);
		$row = $query->row_array();
		$status_active = $row[$fld_active]=='1' ? 0 : 1;

			
		$update = "UPDATE ".$tbl_name." SET ".$fld_active." = ".$status_active." WHERE ".$fld_id." = ".$id;
		$this->db->query($update);
		$str_one = '<a onclick="Active(\''.$id.'\',\''.$fld_id.'\',\''.$fld_active.'\',\''.$tbl_name.'\')" href="#"><span class="glyphicon glyphicon-ok"></span></a>';
		$str_two = '<a onclick="Active(\''.$id.'\',\''.$fld_id.'\',\''.$fld_active.'\',\''.$tbl_name.'\')" href="#"><span class="glyphicon glyphicon-remove"></span></a>';
		if($this->db->query($select)){
			echo 	$status_active == '1' ? $str_one : $str_two;
		}		
	}
	
	public function update_status(){		
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}		
		$status_arr = array(
			'#cccccc' => 0,
			'#c4f2e9' => 1,
			'#f78181' => 2
		);
		$product_id 	= $this->input->post('product_id');				
		$product_status= $status_arr[$this->input->post('product_status')];
		
		$data_status = array(			
			'product_status'	=> $product_status
		);
		$this->db->where('product_id', $product_id);
		if($this->db->update('product', $data_status)){
			echo 'Xong';
		}else{
			echo 'Error';
		}
	}
	
	public function order_status(){		
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}		
		$status_arr = array(
			'#f2eaaf' => 0,
			'#c4f2e9' => 1,
			'#0084cc' => 2,
			'#333333' => 3,
			
		);
		$order_id 	= $this->input->post('order_id');				
		$order_status= $status_arr[$this->input->post('order_status')];
		
		$data_status = array(			
			'order_status'	=> $order_status
		);
		$this->db->where('order_id', $order_id);
		if($this->db->update('orders', $data_status)){
			echo 'Xong';
		}else{
			echo 'Error';
		}
	}
	
	public function update_ship(){		
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}				
		$order_id 	= $this->input->post('order_id');				
		$order_ship 	= $this->input->post('order_ship')>0 ? $this->input->post('order_ship') : 0;				
		
		$data_ship = array(			
			'order_ship'	=> $order_ship
		);
		$this->db->where('order_id', $order_id);
		if($this->db->update('orders', $data_ship)){
			echo 'Ok';
		}else{
			echo 'Error';
		}
	}
	
	public function update_product_promotion(){
        if (!$this->input->is_ajax_request()) {
           exit('No direct script access allowed');
        }
        $product_id     = $this->input->post('product_id');
        $product_promotion = $this->input->post('product_promotion');
        
        $data_set = array(           
            'product_promotion'    => $product_promotion
        );
        $this->db->where('product_id', $product_id);
        if($this->db->update('product', $data_set)){
            echo 'Xong';
        }else{
            echo 'Error';
        }
    }
	
		
}