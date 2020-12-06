<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('home/intro_model');
		$this->load->model('home/home_model');
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
		$intro_block = 1;
		$slug = $this->uri->segment(2);
		$intro = $this->intro_model->get_intro_id($slug,$intro_block);				
		
		//get html_tag
		$html['title'] = $intro->intro_title;
		$html['desc'] = $intro->intro_meta_desc;
		$html['key'] = $intro->intro_meta_key;
		
		
				
		$data['header'] 		= $this->load->view('home/header_view',$html,true);
		$footer['info_one']= $this->menu_model->get_menu_intro(0);
		$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
		$footer['info_two']= $this->menu_model->get_menu_intro(1);
		$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
		$footer['info_three']= $this->menu_model->get_menu_intro(2);
		$footer['name_three']= $this->menu_model->get_menu_intro_name(2);
		$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
		$data['last_news'] 		= $this->home_model->get_lastest_new();
		$data['intro_home'] 	= $this->home_model->get_intro($intro_block,4);
		
		$help_data['chat'] = $this->intro_model->get_chat();		
		$data['support_online'] = $this->load->view('home/help_view',$help_data,true);

		//get help data
		//$help_data['chat'] = $this->intro_model->get_chat();
		//$help_data['hotline'] = $this->intro_model->get_hotline();		
		//$data['support_online'] = $this->load->view('home/help_view',$help_data,true);
		
		//get menu left intro
		//$data['menu_intro']   =  $this->menu_model->get_menu_intro($intro_block);
		
		//get home banner
		//$data['banner_intro'] = $this->intro_model->get_banner(1);	
		
		//get intro_crr
		$data['introdetail'] = $intro;
		$data['intro_block'] = $intro_block;
				
		
		$this->load->view('home/intro/intro_view',$data);
		
	}
}