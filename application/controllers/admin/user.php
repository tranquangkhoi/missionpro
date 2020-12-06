<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	var $method_arr = array('edit','add','del');
	public function __construct(){
		parent::__construct();				
		$this->back->check_permission($this->uri->segment(2).$this->uri->segment(3),$this->session->userdata);
		$this->load->model('admin/user_model');
	}
	
	public function _remap($method){	
		if(in_array($method,$this->method_arr)){
			 $this->$method();
		}else{
			$this->index();
		}
	}

	public function index(){		
		$menu['menu_active'] = 'five';		
		$html['title'] = 'Thông tin người sử dụng';
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);
		
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);
		
		$data['user_items'] = $this->user_model->index();	
		 
        $data['msg'] = $this->session->flashdata('flash_msg');
		$this->load->view('admin/user_view',$data);
	}
	
	
	
	public function add(){		
		$menu['menu_active'] = 'five';				
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);		
		
		$html['title'] = 'Thêm mới thông tin nhân viên quản trị';
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);		
		
		$data['f_user'] = $this->user_model->add();		
		
		//return alert
		$alert_arr = array(
			'0' => '- Hãy nhập họ và tên nhân viên quản trị<br>',
			'1' => '- Hãy nhập tên đăng nhập<br>',
			'2' => '- Hãy nhập mật khẩu<br>',
			'3' => '- Hãy nhập lại mật khẩu<br>',
			'4' => '- Mật khẩu phải ít nhất là 8 ký tự<br>',
			'5' => '- Mật khẩu nhập không chính xác. Bạn hãy nhập lại<br>',
			'6' => '- Nhân viên quản trị này đã có. Yêu cầu bạn nhập tên đăng nhập khác<br>',
			'7' => '- Thêm mới thành công.<br>'			
		);
		$code_msg = explode(',',$data['f_user']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';			
		}
				
		$this->load->view('admin/useradd_view',$data);		
		
	}
	
	public function edit(){				
		/* check data */
		$userid = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
		if(!$this->user_model->check_id('system_user','userid',$userid)){
			$msg = '<li>Dữ liệu bạn muốn sửa không tồn tại</li>';
			$this->session->set_flashdata('flash_msg', $msg);
			redirect('admin/user','refresh');
		}		
				
		$menu['menu_active'] = 'five';				
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);		
		
		$html['title'] = 'Thêm mới thông tin nhân viên quản trị';
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);		
		
		$data['f_user'] = $this->user_model->edit();		
		
		//return alert
		$alert_arr = array(
			'0' => '- Hãy nhập họ và tên nhân viên quản trị<br>',
			'1' => '- Hãy nhập tên đăng nhập<br>',
			'2' => '- Hãy nhập mật khẩu cũ để xác nhận việc cập nhật thông tin.<br>',
			'3' => '- Mật khẩu cũ nhập không chính xác. Bạn hãy nhập lại<br>',
			'4' => '- Mật khẩu phải ít nhất là 8 ký tự<br>',
			'5' => '- Mật khẩu mới nhập không chính xác. Bạn hãy nhập lại<br>',
			'6' => '- Nhân viên quản trị này đã có. Nhập tên đăng nhập mới hoặc giữ tên đăng nhập cũ<br>',
			'7' => '- Cập nhật thành công.<br>'			
		);
		$code_msg = explode(',',$data['f_user']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			if($val==7){
				$msg = $alert_arr[$val];			
				$this->session->set_flashdata('flash_msg', $msg);
				redirect('admin/user','refresh');
			}
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';			
		}
				
		$this->load->view('admin/useredit_view',$data);
	}
	
	public function del(){		
		//return alert
		$alert_arr = array(
			'0' => '- Bạn không thể xóa tài khoản đang đăng nhập<br>',
			'1' => '- Bạn không có quyền xóa tài khoản quản trị<br>',
			'2' => '- Không thể xóa tài khoản có quyền cao nhất.<br>',
			'3' => '- Xóa thành công.<br>'
		);
		//delete
		$alert_code = $this->user_model->del();
		
		$msg = $alert_arr[$alert_code];			
		$this->session->set_flashdata('flash_msg', $msg);
        redirect('admin/user','refresh');
	}		
}