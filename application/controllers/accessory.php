<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accessory extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('home/accessory_model');
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
		$slug = $this->uri->segment(2);
		$accesscategory = $this->accessory_model->get_accesscategory_id($slug);				
		
		//get html_tag
		$html['title'] = $accesscategory->accesscategory_name;
		$html['desc'] = $accesscategory->accesscategory_meta_desc;
		$html['key'] = $accesscategory->accesscategory_meta_key;
		$html['company'] 	= $this->common_model->get_info_company();	
		
		// get menu bar
		$data_menu['menu_active'] = 'four';
		$data_menu['menu_warranty'] = $this->menu_model->get_cate_warranty();
		$data_menu['menu_accessory'] = $this->menu_model->get_cate_accessory();
		$data_menu['menu_new'] = $this->menu_model->get_cate_new();		
		$data_menu['cate_one'] = $html['cate_one'];
		$data_menu['cate_two'] = $html['cate_two'];
		$data_menu['pcate'] = $html['pcate'];
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
		$html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
				
		$data['header'] = $this->load->view('home/header_view',$html,true);
		$data_footer['address'] = $this->menu_model->get_address(5);
		$data['footer'] = $this->load->view('home/footer_view',$data_footer,true);

		//get help data
		$help_data['chat'] = $this->accessory_model->get_chat();
		$help_data['hotline'] = $this->accessory_model->get_hotline();		
		$data['support_online'] = $this->load->view('home/help_view',$help_data,true);
		
		
		
		//get home banner
		$data['banner_accessproduct'] = $this->accessory_model->get_banner(3);		
		
		//get submenu accessproduct accesscategory
		$data['sub_menu'] = $data_menu['menu_accessory'];
		
		//get left menu
		$data['menu_left']   = $this->accessory_model->get_menu_left($accesscategory->accesscategory_parent, $accesscategory->accesscategory_id, $accesscategory->accesscategory_path);
		//get parent name
		$data['parent_name'] = $this->accessory_model->get_parent_name($accesscategory->accesscategory_parent, $accesscategory->accesscategory_id, $accesscategory->accesscategory_path);
		$data['parent_name'] = $data['parent_name']<>'' ?  $data['parent_name'] : 'Sản phẩm';
		//get path cetargory
		$data['path'] =  $this->accessory_model->get_path($accesscategory->accesscategory_path);
		
		// gen pagination
		$this->load->library('pagination');
		
		// setup pagination
		//common
		$config1['use_page_numbers'] = TRUE;
		$config1['full_tag_open'] = '<div class="grNextPage">';
        $config1['full_tag_close'] = '</div>';
		
		$config1['first_link'] = '&laquo; Đầu';
		$config1['first_tag_open'] = '';
		$config1['first_tag_close'] = '';
		
		$config1['last_link'] = 'Cuối &raquo;';
		$config1['last_tag_open'] = '';
		$config1['last_tag_close'] = '';
		
		$config1['next_link'] = '>'; // Next
		$config1['next_tag_open'] = '';
		$config1['next_tag_close'] = '';
		
		$config1['prev_link'] = '<'; // Preview
		$config1['prev_tag_open'] = '';
		$config1['prev_tag_close'] = '';
		
		$config1['cur_tag_open'] = '<a class="actedPage" href="#">';
		$config1['cur_tag_close'] = '</a>';
		
		$config1['num_tag_open'] = '';
		$config1['num_tag_close'] = '';
		
		//setup page
        $config1["base_url"] = base_url().$this->config->item('index_page_add')."accessory/".$accesscategory->accesscategory_slug.'/page';                
		$config1["total_rows"] = $this->accessory_model->record_count($accesscategory->accesscategory_children);						
		$config1['per_page'] = 9;
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
		
		$data['accessproduct_items'] = $this->accessory_model->index($config1["per_page"], $offset, $accesscategory->accesscategory_children);
		
		$this->load->view('home/'.$this->uri->segment(1).'/accessorycate_view',$data);
		
	}	
	
	public function detail(){		
		//get slug
		$slug = $this->uri->segment(3);
		$accessproductdetail = $this->accessory_model->get_accessproduct_id($slug);
		
		//get html_tag
		$html['title'] = $accessproductdetail->accessproduct_title;
		$html['desc'] = $accessproductdetail->accessproduct_meta_desc;
		$html['key'] = $accessproductdetail->accessproduct_meta_key;
		
		// get menu bar
		$data_menu['menu_active'] = 'four';
		$data_menu['menu_warranty'] = $this->menu_model->get_cate_warranty();
		$data_menu['menu_accessory'] = $this->menu_model->get_cate_accessory();
		$data_menu['menu_new'] = $this->menu_model->get_cate_new();		
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
				
		$data['header'] = $this->load->view('home/header_view',$html,true);
		$data_footer['address'] = $this->menu_model->get_address(5);
		$data['footer'] = $this->load->view('home/footer_view',$data_footer,true);

		//get help data
		$help_data['chat'] = $this->accessory_model->get_chat();
		$help_data['hotline'] = $this->accessory_model->get_hotline();		
		$data['support_online'] = $this->load->view('home/help_view',$help_data,true);
		
		
		
		//get home banner
		$data['banner_accessproduct'] = $this->accessory_model->get_banner(2);		
		
		//get submenu accessproduct accesscategory
		$data['sub_menu'] = $data_menu['menu_accessory'];
		
		$accesscategory = $this->accessory_model->get_accesscategory_by_id($accessproductdetail->accesscategory_id);
		//get left menu
		$data['menu_left']   = $this->accessory_model->get_menu_left($accesscategory->accesscategory_parent, $accesscategory->accesscategory_id, $accesscategory->accesscategory_path);
		//get parent name
		$data['parent_name'] = $this->accessory_model->get_parent_name($accesscategory->accesscategory_parent, $accesscategory->accesscategory_id, $accesscategory->accesscategory_path);
		$data['parent_name'] = $data['parent_name']<>'' ?  $data['parent_name'] : 'Sản phẩm';
		//get path cetargory
		$data['path'] =  $this->accessory_model->get_path($accesscategory->accesscategory_path);
		
		
		
		$data['accessproductdetail']  = $accessproductdetail;	
		
		
		
		$this->load->view('home/'.$this->uri->segment(1).'/accessorydetail_view',$data);		
	}
	
	public function part_one(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$accessproduct_id = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;					
		$part_one = $this->accessory_model->get_part($accessproduct_id);
		echo $part_one->accessproduct_content;
        
	}
	
	public function part_two(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$accessproduct_id = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;					
		$part_one = $this->accessory_model->get_part($accessproduct_id);
		echo $part_one->accessproduct_param;
	}
	
}