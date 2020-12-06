<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thanhtoan extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->model('home/product_model');
		$this->load->model('home/menu_model');
		$this->load->model('home/intro_model');		
	}
	
	public function _remap($method, $params = array()){		
		if (method_exists($this, str_replace('-','_',$method))){
			return call_user_func_array(array($this, str_replace('-','_',$method)), $params);
		}else{
			$this->index('');
		}	
	}
	
	public function index(){		
		//get slug
		$intro_block = 2;
		$slug = $this->uri->segment(2);
		$intro = $this->intro_model->get_intro_id($slug,$intro_block);

		
		/* Begin Header */
		$html['title'] 		= $intro->intro_title;
		$html['desc'] 		= $intro->intro_meta_desc;
		$html['key'] 		= $intro->intro_meta_key;
		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;	
		$html['company'] 	= $this->common_model->get_info_company();		
		$data_menu['menu_active'] = 'two';
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
		$footer['info_three']= $this->menu_model->get_menu_intro(2);
		$footer['name_three']= $this->menu_model->get_menu_intro_name(2);
		
		$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */
		
		// hien thi cac bai viet gioi thieu o cot phai
		$mn_intro['intro_menu'] = $this->menu_model->get_menu_intro($intro_block);
		$mn_intro['intro_block'] = $intro_block;
		if($intro_block=='0'){
			$block_two = 1;
			$block_three = 2;
		}elseif($intro_block=='1'){
			$block_two = 0;
			$block_three = 2;
		}elseif($intro_block=='2'){
			$block_two = 0;
			$block_three = 1;
		}
		$mn_intro['intro_menu_two'] 	= $this->menu_model->get_menu_intro($block_two);
		$mn_intro['intro_block_two'] 	= $block_two;
		$mn_intro['intro_menu_three'] 	= $this->menu_model->get_menu_intro($block_three);
		$mn_intro['intro_block_three'] 	= $block_three;
		$data['intro_menu'] = $this->load->view('home/menuintro_view',$mn_intro,true);		
		/* end menu intro */
				
		//get intro_crr
		$data['introdetail'] = $intro;
		$data['intro_block'] = $intro_block;
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */		
		
		$this->load->view('home/intro/intro_view',$data);
		
	}
}