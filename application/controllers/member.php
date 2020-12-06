<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('home/common_model');
		$this->load->model('home/menu_model');
		$this->load->model('home/member_model');		
	}
	
	public function _remap($method, $params = array()){		
		if (method_exists($this, str_replace('-','_',$method))){
			return call_user_func_array(array($this, str_replace('-','_',$method)), $params);
		}else{
			$this->index('');
		}	
	}	
	
	public function index(){				
		if($this->session->userdata('member_validated')){
			redirect('member/welcome','refresh');
		}
		/* Begin Header */
		$html['title'] 		= 'Đăng nhập thành viên';
		$html['desc'] 		= 'Đăng nhập thành viên giúp bạn mua hàng nhanh chóng, thuận lợi hơn';
		$html['key'] 		= 'Đăng nhập trực tuyến, Login';		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;	
		$html['company'] 	= $this->common_model->get_info_company();		
		$data_menu['menu_active'] = 'four';
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
		
		$data['msg'] = $this->session->flashdata('flash_msg');
		//hien thi danh muc o cot phai

		
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */
		
		$this->load->view('home/member/login_view',$data);			
	}
	public function vorder(){
		$order_id = $this->uri->segment(3);
		$data['order_items'] = $this->member_model->get_order_items($order_id);
		$data['order_info'] = $this->member_model->get_order_info($order_id);
		foreach($data['order_items'] as $item){			
			$pitem = $this->member_model->get_product_info($item['product_id']);
			$cart_image[$item['product_id']] 	= @$pitem->product_image;
			$cart_slug[$item['product_id']] 	= @$pitem->product_slug;			
		}		
		$data['cart_image'] = $cart_image;
		$data['cart_slug']  = $cart_slug;		
				
		$this->load->view('home/member/vorder_view',$data);
	}
	public function orders(){
      if(!$this->session->userdata('member_validated')){
			redirect('member','refresh');
		}
		/* Begin Header */
		$html['title'] 		= 'Xem danh sách đơn hàng đã đặt';
		$html['desc'] 		= 'Quản lý, theo dõi các đơn hàng đã đặt mua';
		$html['key'] 		= 'Đơn hàng, đơn hàng trực tuyến, trạng thái đơn hàng';		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;		
		$data_menu['menu_active'] = 'four';
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
		$html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
        $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view_float',$html,true);
		$data['header'] = $this->load->view('home/header_view',$html,true);
		/* End Header */
		
		/* Begin Menu Right */
		$data['right_quantri'] = $this->load->view('home/menu_right_quantri_view',$html,true);
		/* End Menu Right */
		
		/*Begin Footer */
		$footer['info_one']= $this->menu_model->get_menu_intro(0);
		$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
		$footer['info_two']= $this->menu_model->get_menu_intro(1);
		$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
		$footer['company'] 	  = $this->common_model->get_info_company();		
		$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */
		
		//hien thi danh muc o cot phai
		$data['cate_one']   = $html['cate_one'];
		$data['cate_two']   = $html['cate_two'];
		$data['pcate']		= $html['pcate'];
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */
		$data['orders']  = $this->member_model->get_orders();
				
		$this->load->view('home/member/orders_view',$data);	
		
	}
	public function welcome(){
        if(!$this->session->userdata('member_validated')){
			redirect('member','refresh');
		}
		/* Begin Header */
		$html['title'] 		= 'Đăng nhập thành viên';
		$html['desc'] 		= 'Đăng nhập thành viên giúp bạn mua hàng nhanh chóng, thuận lợi hơn';
		$html['key'] 		= 'Đăng nhập trực tuyến, Login';		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;		
		$data_menu['menu_active'] = 'four';
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
		$html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
        $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view_float',$html,true);
		$data['header'] = $this->load->view('home/header_view',$html,true);
		/* End Header */
		
		/* Begin Menu Right */
		$data['right_quantri'] = $this->load->view('home/menu_right_quantri_view',$html,true);
		/* End Menu Right */
		
		/*Begin Footer */
		$footer['info_one']= $this->menu_model->get_menu_intro(0);
		$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
		$footer['info_two']= $this->menu_model->get_menu_intro(1);
		$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
		$footer['company'] = $this->common_model->get_info_company();		
		$data['footer'] 	= $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */	

		
		//hien thi danh muc o cot phai
		//hien thi danh muc o cot phai
		$data['cate_one']   = $html['cate_one'];
		$data['cate_two']   = $html['cate_two'];
		$data['pcate']		= $html['pcate'];
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */		
		$this->load->view('home/member/welcome_view',$data);	
    }
	
	public function logout(){		
		//$this->session->sess_destroy();
		$data = array(
			'member_id' 			=> '',
			'member_fullname' 		=> '',
			'member_email'	 		=> '',
			'member_address'   		=> '',
			'member_tel'   			=> '',
			'member_validated'		=> false
		);				
		$this->session->set_userdata($data);		
		redirect(base_url(),'refresh');
    }
	
	public function verify(){
        $result = $this->member_model->member_validate();		
        if(!$result){
            $msg = '<font color=red>Tài khoản chưa đúng.</font>';			
			$this->session->set_flashdata('flash_msg', $msg);
            redirect('member','refresh');
        }else{						
			redirect('member/welcome','refresh');			
        }
    }
	
	
	public function register(){		
		/* Begin Header */
		$html['title'] 	   = 'Đăng ký thành viên';
		$html['desc'] 		= 'Đăng ký thành viên giúp bạn mua hàng nhanh chóng thuận lợi hơn, hướng các ưu đãi của cửa hàng';
		$html['key'] 		 = 'Đăng ký thành viên, đăng ký trực tuyến';		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;		
		$data_menu['menu_active'] = 'three';
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
		$footer['company'] = $this->common_model->get_info_company();		
		$data['footer'] 	= $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */
		
		$data['f_register'] = $this->member_model->register();	
		//return alert
		$alert_arr = array(
			'0' => '- Email này đã được đăng ký rồi. Bạn chọn email khác.<br>',
			'1' => '- Đăng ký thành viên thành công. <a class="alert-link" href="'.base_url().'member/login.html">Đăng nhập</a><br>'			
		);
		$code_msg = explode(',',$data['f_register']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';
			if($val=='1'){
				$alert_style = '1';
			}else{
				$alert_style = '0';
			}
		}
		
		$data['alert_style'] = $alert_style;			
		$this->load->view('home/member/register_view',$data);			
	}
	
	public function profile(){		
		if(!$this->session->userdata('member_validated')){
			redirect('member','refresh');
		}
		/* Begin Header */
		$html['title'] 		= 'Cập nhật hồ sơ thành viên';
		$html['desc'] 		= 'Trang cập nhật thay đổi thông tin về thành viên';
		$html['key'] 		= 'Thay đổi hồ sơ, cập nhật hồ sơ';		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;		
		$data_menu['menu_active'] = 'four';
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
        $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view_float',$html,true);
		$data['header'] = $this->load->view('home/header_view',$html,true);
		/* End Header */
		
		/* Begin Menu Right */
		$data['right_quantri'] = $this->load->view('home/menu_right_quantri_view',$html,true);
		/* End Menu Right */
		
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
		
		$data['f_profile'] = $this->member_model->profile();	
		//return alert
		$alert_arr = array(		
			'1' => '- Cập nhật hồ sơ thành công.'
		);		

		$code_msg = explode(',',$data['f_profile']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';
			if($val=='1'){
				$alert_style = '1';
			}else{
				$alert_style = '0';
			}
		}		
		$data['alert_style'] = $alert_style;

		//hien thi danh muc o cot phai
		//hien thi danh muc o cot phai
		$data['cate_one']   = $html['cate_one'];
		$data['cate_two']   = $html['cate_two'];
		$data['pcate']		= $html['pcate'];
		
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */
		
		$this->load->view('home/member/profile_view',$data);			
	}
	
	public function changepass(){		
		if(!$this->session->userdata('member_validated')){
			redirect('member','refresh');
		}
		/* Begin Header */
		$html['title'] 		= 'Đổi mật khẩu';
		$html['desc'] 		= 'Thay đổi mật khẩu của tài khoản thành viên';
		$html['key'] 		= 'Đổi mật khẩu, mật khẩu,';		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;		
		$data_menu['menu_active'] = 'four';
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
		$html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
        $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view_float',$html,true);
		$data['header'] = $this->load->view('home/header_view',$html,true);
		/* End Header */
		
		/* Begin Menu Right */
		$data['right_quantri'] = $this->load->view('home/menu_right_quantri_view',$html,true);
		/* End Menu Right */
		
		/*Begin Footer */
		$footer['info_one']= $this->menu_model->get_menu_intro(0);
		$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
		$footer['info_two']= $this->menu_model->get_menu_intro(1);
		$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
		$footer['company'] 	  = $this->common_model->get_info_company();
		
		$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */
		
		$data['f_changepass'] = $this->member_model->changepass();	
		//return alert
		$alert_arr = array(		
			'0' => '- Có lỗi xảy ra trong quá trình cập nhật.',
			'1' => '- Đổi mật khẩu thành công.'
		);		

		$code_msg = explode(',',$data['f_changepass']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';
			if($val=='1'){
				$alert_style = '1';
			}else{
				$alert_style = '0';
			}
		}		
		$data['alert_style'] = $alert_style;	
		//hien thi danh muc o cot phai
		//hien thi danh muc o cot phai
		$data['cate_one']   = $html['cate_one'];
		$data['cate_two']   = $html['cate_two'];
		$data['pcate']		= $html['pcate'];
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */
		$this->load->view('home/member/changepass_view',$data);			
	}
	
	public function forget(){				
		if($this->session->userdata('member_validated')){
			redirect('member/welcome','refresh');
		}
		/* Begin Header */
		$html['title'] 		= 'Lấy lại mật khẩu đăng nhập';
		$html['desc'] 		= 'Tiện ích giúp bạn lấy lại mật khẩu đăng nhập';
		$html['key'] 		= 'Mật khẩu, lấy lại mật khẩu';		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;		
		$data_menu['menu_active'] = 'four';
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
		$data['msg'] = $this->session->flashdata('flash_msg');
		//hien thi danh muc o cot phai
		//hien thi danh muc o cot phai
		$data['cate_one']   = $html['cate_one'];
		$data['cate_two']   = $html['cate_two'];
		$data['pcate']		= $html['pcate'];
		
		
		$data['f_forget'] = $this->member_model->forget();	
		//return alert
		$alert_arr = array(		
			'0' => '- Lỗi xảy ra trong quá trình lấy lại mật khẩu. Bạn hãy thử lại nhé.',
			'1' => '- Mật khẩu đã được gửi tới email bạn vừa nhập. Hãy truy cập hòm thư để nhận lại mật khẩu (nếu trong Inbox không có thư bạn xem kỹ trong các hộp thư Bulk mail hoặc Spam nhé.)',
			'2' => '- Email nhập chưa chính xác hoặc không có email này trong hệ thống',
		);		

		$code_msg = explode(',',$data['f_forget']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';
			if($val=='1'){
				$alert_style = '1';
			}else{
				$alert_style = '0';
			}
		}		
		$data['alert_style'] = $alert_style;
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */		
		$this->load->view('home/member/forget_view',$data);			
	}
}