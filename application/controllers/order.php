<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('home/common_model');
		$this->load->model('home/menu_model');
		$this->load->model('home/order_model');
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
		$cart = $this->cart->contents();		
		$cart_image = array();
		if(count($cart)==0){
			redirect('giohang','refresh');
		}
		
		/* Begin Header */
		$html['title'] 		= 'Đặt hàng';
		$html['desc'] 		= 'Kê khai thông tin đặt hàng để gửi đến công ty bán hàng';
		$html['key'] 		= 'Đặt hàng, mua hàng, thanh toán';		
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
		
		/* Begin Widget */
		$data['widget_category'] 		= $this->load->view('home/widget_category_view',$html['cate_one'],true);		
		$widget['latest_product']	   = $this->common_model->get_latest_product(5);
		$data['widget_latest_product']  = $this->load->view('home/widget_latest_product_view',$widget,true);		
		$widget['banner_left']  		  = $this->common_model->get_banner(2,3);
		$data['widget_left_banner']     = $this->load->view('home/widget_left_banner_view',$widget,true);		
		/* End Widget */
		
		$order_data = array();
		if($this->session->userdata('member_validated')){
			$order_data['order_fullname'] 	= $this->session->userdata('member_fullname');			
			$order_data['order_email'] 		= $this->session->userdata('member_email');			
			$order_data['order_address'] 	= $this->session->userdata('member_address');			
			$order_data['order_tel'] 		= $this->session->userdata('member_tel');
			$order_data['member_id'] 		= $this->session->userdata('member_id');
		}else{
			$order_data['order_fullname'] 	= '';
			$order_data['order_email'] 	= '';
			$order_data['order_address'] 	= '';
			$order_data['order_tel'] 		= '';			
			$order_data['member_id'] 		= 0;			
		}
		$data['buyer'] = $order_data;
		
		//hien thi danh muc o cot phai
		$data['menu_left']   = $this->menu_model->get_category();
		
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */
		$this->load->view('home/order/order_view',$data);			
	}
	
	public function checkmail(){
		$rs = $this->order_model->checkmail();		
		echo $rs;
	}
	
	public function send(){		
		$cart = $this->cart->contents();		
		if(count($cart)==0){
			redirect('giohang','refresh');
		}
		
		/* Begin Header */
		$html['title'] 	   = 'Đặt hàng';
		$html['desc'] 		= 'Kê khai thông tin đặt hàng để gửi đến công ty bán hàng';
		$html['key'] 		= 'Đặt hàng, mua hàng, thanh toán';		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;		
		$data_menu['menu_active'] = 'five';
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
		$data['header'] = $this->load->view('home/header_view',$html,true);
		/* End Header */
		
		/*Begin Footer */
		$footer['info_one']= $this->menu_model->get_menu_intro(0);
		$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
		$footer['info_two']= $this->menu_model->get_menu_intro(1);
		$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
		$footer['info_three']= $this->menu_model->get_menu_intro(2);
		$footer['name_three']= $this->menu_model->get_menu_intro_name(2);
		
		$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */
		
		$status_order = $this->order_model->send_order();
		if($status_order == 'ok'){			
			$this->cart->destroy();
			$this->session->set_flashdata('msg_order', $status_order);						
			redirect('order/finish','refresh');
		}else{
			$this->session->set_flashdata('msg_order', $status_order);						
			redirect('order/finish','refresh');							
		}				
	}
	
	public function finish(){		
		if($msg_order = $this->session->flashdata('msg_order')){	
			/* Begin Header */
			$html['title'] 		= 'Đặt hàng';
			$html['desc'] 		= 'Kết thúc đặt hàng';
			$html['key'] 		= 'Đặt hàng trực tuyến, đặt hàng thành công';		
			$html['cate']		= $this->menu_model->get_category();
			$html['cate_one']	= $this->menu_model->get_category_level(1);
			$html['cate_two']	= $this->menu_model->get_category_level(2);
			$html['cate_three']	= $this->menu_model->get_category_level(3);		
			$html['pcate']		= $this->menu_model->pcheck;		
			$data_menu['menu_active'] = 'five';
			$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
            $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
            $html['widget_category']       = $this->load->view('home/widget_category_view_float',$html,true);
			$data['header'] = $this->load->view('home/header_view',$html,true);
			/* End Header */	
			
			/*Begin Footer */
			$footer['info_one']= $this->menu_model->get_menu_intro(0);
			$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
			$footer['info_two']= $this->menu_model->get_menu_intro(1);
			$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
			$footer['company'] = $this->common_model->get_info_company();
		
			$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
			/* End Footer */		
			$data['msg_order'] = $msg_order;
			/* Begin hien thi menu san pham moi */
			$pnew['pnew']= $this->menu_model->get_lastest_product(2);
			$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
			/* End hien thi menu san pham moi */
		
			$this->load->view('home/order/finish_view',$data);	
		}else{
			redirect(base_url(),'refresh');
		}
	}
}