<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Giohang_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	function validate_add_cart_item(){     		
		$dcart = $this->cart->contents();
		$id = $this->input->post('id');
		$rowid = md5($id);
		$qty = $this->input->post('quantity');		 
		$this->db->where('product_id', $id);
		$query = $this->db->get('product');		 
		if($query->num_rows()>0){	
			if(isset($dcart[$rowid])){				
				$rowid		=  $dcart[$rowid]['rowid'];
				$qty_old 	=  $dcart[$rowid]['qty'];
				$data = array(
					'rowid'   => $rowid,
					'qty'     => ($qty+$qty_old)
				);
				$this->cart->update($data);
				return TRUE;
			}else{
				$row = $query->row();
				$data = array(
					'id'      => $id,
					'qty'     => $qty,
					'price'   => $row->product_price,
					'name'    => $row->product_title
				);
				$this->cart->insert($data);
				return TRUE;						
			}
		}else{
			return FALSE;
		}
	}
	
	public function get_product_info($product_id){
		$select = "SELECT * FROM product WHERE product_id=".$product_id;
		$query = $this->db->query($select);
		$row = $query->row();		
		return $row;
	}
}