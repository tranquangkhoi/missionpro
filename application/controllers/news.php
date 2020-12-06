<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('home/common_model');
		$this->load->model('home/new_model');
		$this->load->model('home/menu_model');
	}
	
	public function _remap($method, $params = array()){
		//$method = 'process_'.$method;
		if (method_exists($this, str_replace('-','_',$method))){
			return call_user_func_array(array($this, str_replace('-','_',$method)), $params);
		}else{
			$this->index('');
		}
		//show_404();
	}
	public function index(){
		//get slug
		/* Begin Header */
		$html['title'] 	   = 'Tin tức';
		$html['desc'] 		= 'Trang tin tức, tổng hợp các tin mới nhất của các danh mục tin tức';
		$html['key'] 		 = 'Tin tức thị trường, tin tức sản phẩm';
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
        $html['cate_three']   = $this->menu_model->get_category_level(3);
		$html['pcate']	   = $this->menu_model->pcheck;	
		$html['company'] 	= $this->common_model->get_info_company();		
		$data_menu['menu_active'] = 'seven';
		$data_menu['cate_one'] = $html['cate_one'];
		$data_menu['cate_two'] = $html['cate_two'];
		$data_menu['pcate'] = $html['pcate'];
		$html['menubar']     = $this->load->view('home/menubar_view',$data_menu,true);		
		$html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
        $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view_float',$html,true);
		$data['header'] 	  = $this->load->view('home/header_view',$html,true);
		/* End Header */
		
		/*Begin Footer */
		$footer['info_one']= $this->menu_model->get_menu_intro(0);
		$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
		$footer['info_two']= $this->menu_model->get_menu_intro(1);
		$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
		$footer['company'] 	  = $this->common_model->get_info_company();		
		$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */					
		
		/* End hien thi menu san pham moi */				
		$mn_new['new_menu'] = $this->menu_model->get_cate_new();
		$data['new_menu'] = $this->load->view('home/menunew_view',$mn_new,true);
		

		/* End hien thi menu san pham moi */
		$slug = $this->uri->segment(2);
		// gen pagination
		$this->load->library('pagination');
		//setup page
		$config1['first_url'] = '1.html';
		$config1['suffix'] = '.html';                						
		$config1['per_page'] = 5;
		$config1['num_links'] = 10;	
		if($this->new_model->check_slug('newcate','newcate_slug',$slug)){
			$newcate = $this->new_model->get_newcate_id($slug);
			$data['newcate_crr']['newcate_id'] 		= $newcate->newcate_id;
			$data['newcate_crr']['newcate_name'] 	= $newcate->newcate_name;
			$data['newcate_crr']['newcate_slug'] 	= $newcate->newcate_slug;
			$config1["base_url"] = base_url().$this->config->item('index_page_add')."news/".$newcate->newcate_slug.'/page';
			$config1["total_rows"] = $this->new_model->record_count($newcate->newcate_id);
			$newcate_id = $newcate->newcate_id;
			$segment = 4;
		} else {
			$config1["base_url"] = base_url().$this->config->item('index_page_add')."news/page";
			$config1["total_rows"] = $this->new_model->record_count();
			$newcate_id = null;	
			$segment = 3;
		}
		$config1["total_pages"] = ceil($config1["total_rows"]/$config1['per_page']);
		$config1['uri_segment'] = $segment;
		
		/* fix offset of pagination */
		if($this->uri->segment($segment) > 0 && $this->uri->segment($segment)<=$config1["total_pages"]){
			$offset = $this->uri->segment($segment)*$config1['per_page'] - $config1['per_page'];
			$data['current_page'] = $this->uri->segment($segment);
		}else{
			$offset = 0;
			$data['current_page'] = 1;
		}
		
		$data['new_items'] = $this->new_model->index($config1["per_page"], $offset, $newcate_id);
		$this->pagination->initialize($config1);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('home/news/newcate_view',$data);
		
	}	
	
	public function detail(){		
		//get slug
		$slug = $this->uri->segment(3);
		$newdetail = $this->new_model->get_new_id($slug);
		
		//get html_tag
		$html['title'] = $newdetail->new_title;
		$html['desc'] = $newdetail->new_meta_desc;
		$html['key'] = $newdetail->new_meta_key;
		
		$data['newcate_crr'] = $this->new_model->get_newcate_name($newdetail->newcate_id);
			
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;	
		$html['company'] 	= $this->common_model->get_info_company();			
		$data_menu['menu_active'] = 'seven';
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
		
		/* Begin Widget */
		$data['widget_category'] 		= $this->load->view('home/widget_category_view',$html['cate_one'],true);		
		$widget['latest_product']	   = $this->common_model->get_latest_product(5);
		$data['widget_latest_product']  = $this->load->view('home/widget_latest_product_view',$widget,true);		
		$widget['banner_left']  		  = $this->common_model->get_banner(2,3);
		$data['widget_left_banner']     = $this->load->view('home/widget_left_banner_view',$widget,true);		
		/* End Widget */
		
		
		/* End hien thi menu san pham moi */				
		
		$mn_new['new_menu'] = $this->menu_model->get_cate_new();
		$data['new_menu'] = $this->load->view('home/menunew_view',$mn_new,true);		
		
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		
		$data['newdetail']  = $newdetail;	
		
		//get other new			
		$data['other_new'] = $this->new_model->get_other_new($newdetail->newcate_id, $newdetail->new_id);
		
		$this->load->view('home/news/newdetail_view',$data);		
	}
	
}