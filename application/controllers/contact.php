<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('home/common_model');
		$this->load->model('home/menu_model');
		$this->load->model('home/contact_model');
		$this->load->helper('captcha');
	}
	
	public function _remap($method, $params = array()){		
		if (method_exists($this, str_replace('-','_',$method))){
			return call_user_func_array(array($this, str_replace('-','_',$method)), $params);
		}else{
			$this->index('');
		}	
	}
	
	public function index(){		
		//get html_tag
		$html['title'] = 'Liên hệ / góp ý';
		$html['desc'] = 'Liên hệ / góp ý';
		$html['key'] = 'Liên hệ / góp ý';
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;	
		$html['company'] 	= $this->common_model->get_info_company();		
		$data_menu['menu_active'] = 'six';
		$data_menu['cate_one'] = $html['cate_one'];
		$data_menu['cate_two'] = $html['cate_two'];
		$data_menu['pcate'] = $html['pcate'];
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
		$html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
        $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view_float',$html,true);
		$data['header'] 	= $this->load->view('home/header_view',$html,true);
		/* End Header */
		
		/*Begin Footer */
		$footer['info_one']= $this->menu_model->get_menu_intro(0);
		$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
		$footer['info_two']= $this->menu_model->get_menu_intro(1);
		$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
		$footer['company'] 	  = $this->common_model->get_info_company();
		
		$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */	

		
		$data['f_contact'] = $this->contact_model->send_contact();		
		//return alert
		$alert_arr = array(
			'0' => '- Hãy nhập chính xác mã kiểm tra trong ảnh<br>',			
			'1' => '- Cảm ơn bạn đã gửi thông tin liên hệ/góp ý.<br>- Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất<br>'			
		);
		$code_msg = explode(',',$data['f_contact']['code_msg']);		
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
		
		/* End hien thi menu san pham moi */
		$data['company'] = $this->contact_model->get_info_company();	
				
		$this->load->view('home/contact/contact_view',$data);		
	}	
}