<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Giohang extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('home/common_model');
		$this->load->model('home/menu_model');
		$this->load->model('home/giohang_model');		
	}
	
	public function _remap($method, $params = array()){		
		if (method_exists($this, str_replace('-','_',$method))){
			return call_user_func_array(array($this, str_replace('-','_',$method)), $params);
		}else{
			$this->index('');
		}	
	}	
	
	public function index(){		
		/* Begin Header */
		$html['title'] 		= 'Giỏ hàng của bạn';
		$html['desc'] 		= 'Giỏ hàng giúp bạn đựng hàng khi chọn mua sản phẩm';
		$html['key'] 		= 'Giỏ hàng, tiện ích thương mại điện tử, mua bán online';		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;	
		$html['company'] 	= $this->common_model->get_info_company();		
		$data_menu['menu_active'] = 'five';
		$data_menu['cate_one'] = $html['cate_one'];
		$data_menu['cate_two'] = $html['cate_two'];
		$data_menu['pcate'] = $html['pcate'];
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
		$html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
        $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view_float',$html,true);
		$data['header'] = $this->load->view('home/header_view',$html,true);
		/* End Header */
		/*Begin Footer */
		$footer['info_one']= $this->menu_model->get_menu_intro(0);
		$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
		$footer['info_two']= $this->menu_model->get_menu_intro(1);
		$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
		$footer['company'] 	  = $this->common_model->get_info_company();
		
		$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */
		
		$cart = $this->cart->contents();
		//print_r($cart);		
		$cart_image = array();
		$cart_slug = array();
		foreach($cart as $item){
			$pitem = $this->giohang_model->get_product_info($item['id']);
			$cart_image[$item['rowid']] = $pitem->product_image;
			$cart_slug[$item['rowid']] = $pitem->product_slug;
		}		
		$data['cart_image'] = $cart_image;
		$data['cart_slug']  = $cart_slug;
		
		$this->load->view('home/giohang/giohang_view',$data);			
	}
	
	public function update(){								
		$cart = $this->cart->contents();
		foreach($cart as $item){
			$id = 'quantity'.$item['id'];
			$rowid = $item['rowid'];
			$qty = $this->input->post($id) ? $this->input->post($id) : 0;
			$data = array(
				'rowid'	=>	$rowid,
				'qty'	=>	$qty
			);
			$this->cart->update($data);
		}
		redirect('giohang','refresh');
	}
	
	public function short_cart(){		
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$data = $this->cart->contents();
		if(count($data)>0){
			$str_begin ='
						<div class="list-items">
						<table align="center">
							<tbody>';
			$str_body = '';
			foreach($data as $item){
				$pitem = $this->giohang_model->get_product_info($item['id']);
				$img = base_url().'public/upload/product/small_'.$pitem->product_image;
				$dlink = base_url().$this->config->item('index_page_add').'san-pham/chi-tiet/'.$pitem->product_slug.'.html';
				$str_body .= '<tr  id="'.$item['id'].'" >
								<td class="listcart-img">
									<a href="'.$dlink.'"><img src="'.$img.'" alt="'.$item['name'].'"></a>
								</td>
								<td class="listcart-content">
									<p><a style="display:block; text-align:left" href="'.$dlink.'">'.$item['name'].'</a></p>
									<p><span class="item-money" style="font-weight:bold; text-align:left; display:block; color:#d27200">'.$item['qty'].' = '.number_format($item['price']*$item['qty'],0).' đ</span></p>
								</td>
								<td class="listcart-del">
								<a onclick="delete_item_cart(this)" class="fa fa-trash"  title="Xóa khỏi giỏ hàng" myhref="'.base_url().'giohang/delcart/'.$item['id'].'" role="button">&nbsp;</a>
								</td>
							<tr>';					
			$str_end = '</tbody>
					</table>					
					</div>
					<div style="text-align:center; margin:20px;"><a href="'.base_url().'order.html"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-gift"></span> Thanh toán</button></a></div>
					';
			}
			echo $str_begin.$str_body.$str_end;
		}else{
			echo 'Giỏ hàng chưa có sản phẩm'; 
		}
	}
	
	public function addcart(){				
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		if($this->giohang_model->validate_add_cart_item() == TRUE){        
            echo 'TRUE';
        }else{
			echo 'FALSE';			
		}    	
	}
	
	public function delcart(){						
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$id = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$rowid = md5($id);
		$dcart = $this->cart->contents();
		if(isset($dcart[$rowid])){
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
			$this->cart->update($data);
			echo 'OK';
		}else{
			echo 'ERROR';
		}
	}
	public function del(){						
		$id = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$rowid = md5($id);
		$dcart = $this->cart->contents();
		if(isset($dcart[$rowid])){
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
			$this->cart->update($data);
			redirect('giohang','refresh');
		}else{
			redirect('giohang','refresh');
		}
	}
	
	
	
	public function get_total(){				
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$type = $this->input->post('type');
		if($type=='1'){
			echo number_format($this->cart->total_items(),0);
		}
		if($type=='2'){
			echo number_format($this->cart->total(),0);
		}
				   	
	}
	public function test(){	
		$data = $this->cart->contents();
		$rowid = md5('78');
		//echo $data[$rowid]['name'];
		print_r($data);
		if(isset($data[$rowid])){
			echo $data[$rowid]['rowid']."<br>"; 
			echo $data[$rowid]['name']."<br>"; 
			echo $data[$rowid]['qty']."<br>"; 
			echo 'ADD OK';
		}else{
			echo 'NO OK';
		}
	}
	
}