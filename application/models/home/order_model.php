<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function get_product($product_id){
		$sql = 'SELECT * FROM product WHERE product_id ='.$product_id;
		$query = $this->db->query($sql);
		$row   = $query->row();				
		return $row;
	}
	
	public function checkmail(){
		$member_email = $this->input->post('member_email');
		$select = "SELECT * FROM member WHERE member_email = '".$member_email."'";		
		$query = $this->db->query($select);
		if ($query->num_rows() > 0){
			return 'OK';
		}else{
			return 'NO';
		}		
	}
	
	public function send_order(){
		//lay thong tin dat hang
		$member_id 			= $this->session->userdata('member_validated') ? $this->session->userdata('member_id') : 0;		
		$order_fullname    	= $this->input->post('order_fullname');
		$order_address    	= $this->input->post('order_address');
		$order_email    	= $this->input->post('order_email');
		$order_tel    		= $this->input->post('order_tel');
		
		$order_fullname_to  = $this->input->post('other_fullname');
		$order_address_to   = $this->input->post('other_address');
		$order_tel_to    	= $this->input->post('other_tel');
		// lay thong tin phuong thuc thanh toan
		$order_method    	= $this->input->post('order_method');
		//lay thong tin them
		$order_note    		= $this->input->post('order_note');
		
		//tao tai khoan thanh vien neu khach hang chon tao
		if($this->input->post('checkcreatepass')){
			$member_pass 	= $this->input->post('order_pass');
			$data_member = array(								   
			   'member_email'		=> $order_email,
			   'member_password' 	=> crypt($member_pass),
			   'member_fullname' 	=> $order_fullname,			
			   'member_tel' 	    => $order_tel,
			   'member_address' 	=> $order_address,
			   'member_create_time' => time()
			);
			if($this->db->insert('member', $data_member)){
				$member_id = $this->db->insert_id();
				$data = array(
					'member_id' 			=> $member_id,
					'member_fullname' 		=> $order_fullname,
					'member_email'	 		=> $order_email,
					'member_address'   		=> $order_address,
					'member_tel'   			=> $order_tel,
					'member_validated'		=> true
				);					
				$this->session->set_userdata($data);		
			}
		}
				
		$data_order = array(				
		    'member_id'			=> $member_id,
			'order_fullname'	=> $order_fullname,
			'order_address'		=> $order_address,
			'order_email'		=> $order_email,
			'order_tel'			=> $order_tel,
			'order_fullname_to'	=> $order_fullname_to,
			'order_address_to'	=> $order_address_to,
			'order_tel_to'		=> $order_tel_to,
			'order_method'		=> $order_method,
			'order_note'		=> $order_note,
			'order_date'		=> time(),			  			   				   
		);
		if($this->db->insert('orders', $data_order)){
			$order_id = $this->db->insert_id();
			//xu ly gui don hang
			$cart = $this->cart->contents();
			$msg_body = '
			<div>Bạn đã đặt hàng thành công.</br>
Nhân viên của chúng tôi sẽ liên hệ với bạn sớm nhất để thực hiện giao hàng cho bạn!</div>
<h3>THÔNG TIN ĐƠN HÀNG</h3>
			<table align="center" style="border: 1px solid #ddd;border-collapse: collapse; width:100%; border-spacing: 2px;">
							<thead>
							  <tr>									
								<td width="45%" align="center"  style="border: 1px solid #ddd;font-size:12px; text-transform:none;padding: 8px;">Tên sản phẩm</td>
								<td width="18%" align="center"  style="border: 1px solid #ddd;font-size:12px; text-transform:none;padding: 8px;">Giá</td>
								<td width="15%" align="center"  style="border: 1px solid #ddd;font-size:12px; text-transform:none;padding: 8px;">Số lượng</td>
								<td width="22%" align="center"  style="border: 1px solid #ddd;font-size:12px; text-transform:none;padding: 8px;">Thành tiền</td>
							  </tr>
							</thead> 
							<tbody>';
			foreach($cart as $item){
				$data_item = array(
					'order_id' 			=> $order_id,
					'product_id' 		=> $item['id'],
					'product_name' 		=> $item['name'],
					'product_price' 	=> $item['price'],
					'product_quantity' 	=> $item['qty']					
				);
				$this->db->insert('order_items', $data_item);
				$thanhtien = $item['qty'] * $item['price'];
				$msg_body .= '<tr>
									<td style="font-size:12px; border: 1px solid #ddd;padding: 8px;">
										'.$item['name'].'
									</td>
									<td style="font-size:12px; text-align:right;border: 1px solid #ddd;padding: 8px;">'.number_format($item['price'],0).' đ</td>
									<td align="center"  style="font-size:12px;border: 1px solid #ddd;padding: 8px;">
										'.$item['qty'].'
									</td>                        
									<td style="font-size:12px; text-align:right;border: 1px solid #ddd;padding: 8px;">'. number_format($thanhtien,0).' đ</td>										
								</tr>';
			}
			$msg_body .= '<tr>
							<td align="right" style="border: 1px solid #ddd;padding: 8px;" colspan="2"><strong>Tổng cộng: </strong></td>                        
							<td align="center" style="font-size:12px;border: 1px solid #ddd;padding: 8px;">'.number_format($this->cart->total_items(),0).'</td>
							<td align="center" style="font-size:12px; text-align:right;border: 1px solid #ddd;padding: 8px;">'.number_format($this->cart->total(),0).' đ</td>
						  </tr>
						</tbody>
					</table>';
			//send mail
			//khoi tao thu vien gui mail + lay tham so gui mail tu he thong			
			$this->load->library('email');
			$select = "SELECT * FROM config ORDER BY config_order LIMIT 0, 1";
			$query = $this->db->query($select);
			$row = $query->row();
			if($row->config_mail_protocol=='smtp'){
				$econfig['protocol'] 		= 'smtp';
				$econfig['smtp_host'] 		= $row->config_smtp_host;
				$econfig['smtp_user'] 		= $row->config_smtp_user;
				$econfig['smtp_pass'] 		= $row->config_smtp_pass;
				$econfig['smtp_port'] 		= $row->config_smtp_port;
				$econfig['smtp_timeout']	= $row->config_smtp_timeout;							
			}else{
				$econfig['protocol'] 		= 'mail';
			}
			$econfig['mailtype']	= $row->config_mail_type;
			$this->email->initialize($econfig);
			$this->email->set_newline("\r\n");
			$this->email->from($row->config_smtp_user, 'thongocshop.com');
			$this->email->to($order_email); 
			$this->email->subject('Đặt hàng thành công');
			$this->email->message($msg_body);
			$this->email->send();												
			return 'ok';
		}else{
			return 'no';
		}
	}
	
}