<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sanpham extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->model('home/menu_model');
		$this->load->model('home/product_model');
		
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
		$slug = $this->uri->segment(2);
		$category = $this->product_model->get_category_by_slug($slug);						
		
		/* Begin Header */
		$html['title'] 		= $category->category_name;
		$html['desc'] 		= $category->category_meta_desc;
		$html['key'] 		= $category->category_meta_key;
		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;		
		$data_menu['menu_active'] = 'one';
		$data_menu['cate_one'] = $html['cate_one'];
		$data_menu['cate_two'] = $html['cate_two'];
		$data_menu['pcate'] = $html['pcate'];
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
		$html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
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
		
		//hien thi danh muc o cot phai
		$data['menu_left']   = $this->product_model->get_tree();
		
		//get parent name	
		$data['parent_name'] 		= $this->product_model->get_parent_name($category->category_parent, $category->category_id, $category->category_path);
		$data['parent_name'] 		= $data['parent_name']<>'' ?  $data['parent_name'] : 'Sản phẩm';
		$data['category_name_crr'] 	= $category->category_name;
		$data['category_review_crr'] = $category->category_review;
		//get path cetargory
		$data['path'] =  $this->product_model->get_path($category->category_path);
		
		// gen pagination
		$this->load->library('pagination');		
		//setup page
        $config1["base_url"] = base_url().$this->config->item('index_page_add')."san-pham/".$category->category_slug.'/page';                
		$config1["total_rows"] = $this->product_model->record_count($category->category_children);						
		$config1['per_page'] = 15;
		$config1['uri_segment'] = 4;
		$config1['num_links'] = 10;	
		$config1["total_pages"] = ceil($config1["total_rows"]/$config1['per_page']); 
			
		/* fix offset of pagination */ 
		if($this->uri->segment(4) > 0 && $this->uri->segment(4)<=$config1["total_pages"]){
			$offset = $this->uri->segment(4)*$config1['per_page'] - $config1['per_page'];		
			//$data['current_page'] = $this->uri->segment(4);
		}else{
			$offset = 0;
			//$data['current_page'] = 1;
		}
		$this->pagination->initialize($config1);
		$data['pagination'] = $this->pagination->create_links();				
		$data['product_items'] = $this->product_model->index($config1["per_page"], $offset, $category->category_children);		
		
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */
		
			
		$this->load->view('home/sanpham/danhmuc_view',$data);		
	}
	
	public function chitiet(){		
		//get slug
		
		$slug = $this->uri->segment(3);
		$productdetail = $this->product_model->get_product_id($slug);
		
		//get html_tag
		if (!empty($productdetail->product_title_seo)) {
			$html['title'] = $productdetail->product_title_seo;
		} else {
			$html['title'] = $productdetail->product_title;
		}
		$html['desc'] = $productdetail->product_meta_desc;
		$html['key'] = $productdetail->product_meta_key;
		$html['product_image'] = $productdetail->product_image;
		
		// gen footer + header
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;		
		$html['company'] 	= $this->common_model->get_info_company();	
		$data_menu['menu_active'] = 'one';
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
		$data['header'] 	= $this->load->view('home/header_view',$html,true);
		
		/*Begin Footer */
		$footer['info_one']= $this->menu_model->get_menu_intro(0);
		$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
		$footer['info_two']= $this->menu_model->get_menu_intro(1);
		$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
		$footer['info_three']= $this->menu_model->get_menu_intro(2);
		$footer['name_three']= $this->menu_model->get_menu_intro_name(2);
		
		$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */
		
		
		$category = $this->product_model->get_category_by_id($productdetail->category_id);
		
		//get left menu
		$data['menu_left']   = $this->product_model->get_tree();

		
		//get parent name
		$data['parent_name'] = $this->product_model->get_parent_name($category->category_parent, $category->category_id, $category->category_path);
		$data['parent_name'] = $data['parent_name']<>'' ?  $data['parent_name'] : 'Sản phẩm';
		//get path cetargory
		$data['path'] =  $this->product_model->get_path($category->category_path);
		
		$data['productdetail']  = $productdetail;	
		$data['libimg']			= $this->product_model->get_lib_img($productdetail->product_id);
		
		$data['other_items'] = $this->product_model->get_other_product($category->category_children, $productdetail->product_id);				

		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */
		
		$this->load->view('home/sanpham/chitiet_view',$data);	
	}	
}