<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();				
		$this->back->check_permission('',$this->session->userdata);
	}	

	public function index(){		
		$menu['menu_active'] = '';		
		$html['title'] = 'Welcome to Admin Area';
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);
		
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);
		$this->load->view('admin/login_welcome_view',$data);
		
	}		
}