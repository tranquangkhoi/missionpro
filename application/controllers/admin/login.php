<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

	public function __construct(){        
		parent::__construct();
	}

	public function index(){
        $data['msg'] = $this->session->flashdata('flash_msg');
		$html['title'] = 'Đăng nhập hệ thống quản trị QUẢ TÁO';
		$data['header'] = $this->load->view('admin/header_view',$html,true);		
		$data['footer'] = $this->load->view('admin/footer_view','',true);		
        $this->load->view('admin/login_view', $data);
		$this->session->sess_destroy();
    }

	public function verify(){
        $this->load->model('admin/login_model');
        $result = $this->login_model->validate();		
        if(!$result){
            $msg = '<font color=red>Tài khoản chưa đúng.</font>';			
			$this->session->set_flashdata('flash_msg', $msg);
            redirect('admin','refresh');
        }else{						
			redirect('admin/welcome','refresh');			
        }
    }
}