<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alert extends CI_Controller {

	public function __construct(){
		parent::__construct();			
	}

	public function index(){		
		$html['title'] = 'Alert';
		$menu['menu_active'] = '';
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);
		$this->load->view('admin/alert_view',$data);		
	}	
}