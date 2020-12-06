<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Useteam extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('home/useteam_model');
		$this->load->model('home/menu_model');
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
		$intro_block = 3;
		$slug = $this->uri->segment(2);
		$intro = $this->useteam_model->get_intro_id($slug, $intro_block);				
		
		//get html_tag
		$html['title'] = $intro->intro_title;
		$html['desc'] = $intro->intro_meta_desc;
		$html['key'] = $intro->intro_meta_key;
		$html['company'] 	= $this->common_model->get_info_company();	
		
		// get menu bar
		$data_menu['menu_active'] = 'two';
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
		$help_data['chat'] = $this->useteam_model->get_chat();
		$help_data['hotline'] = $this->useteam_model->get_hotline();		
		$data['support_online'] = $this->load->view('home/help_view',$help_data,true);
		
		//get menu left intro
		$data['menu_intro']   =  $this->menu_model->get_menu_intro($intro_block);
		
		//get home banner
		$data['banner_intro'] = $this->useteam_model->get_banner(1);	
		
		//get intro_crr
		$data['introdetail'] = $intro;
		$data['intro_block'] = $intro_block;
				
		
		$this->load->view('home/'.$this->uri->segment(1).'/'.$this->uri->segment(1).'_view',$data);
		
	}
}