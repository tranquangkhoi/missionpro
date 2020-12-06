<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {
	var $method_arr = array('edit','add','del','sortup','sortdown','filter','delimg','view');
	var $check_rules = array('edit','add','del');
	
	public function __construct(){
		parent::__construct();		
		$str_rule = in_array($this->uri->segment(3),$this->check_rules) ?  $this->uri->segment(2).$this->uri->segment(3) : $this->uri->segment(2);
		$this->back->check_permission($str_rule, $this->session->userdata);
		$this->load->model('admin/member_model');
	}
	
	public function _remap($method){	
		if(in_array($method,$this->method_arr)){
			 $this->$method();
		}else{
			$this->index();
		}
	}

	public function index(){		
		
		$menu['menu_active'] = 'one';		
		$html['title'] = 'Quản lý thành viên';
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);
		
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);
		
		// gen pagination
		$this->load->library('pagination');		
        $config["base_url"] = base_url().$this->config->item('index_page_add')."admin/".$this->uri->segment(2).'/page';                
		$config["total_rows"] = $this->member_model->record_count();				
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['num_links'] = 10;	
		$config["total_pages"] = round($config["total_rows"]/$config['per_page']);	
        $this->pagination->initialize($config);		
		
		/* fix offset of pagination */
		if($this->uri->segment(4) > 0 && $this->uri->segment(4)<=$config["total_pages"]){
			$offset = $this->uri->segment(4)*$config['per_page'] - $config['per_page'];
			$data['current_page'] = $this->uri->segment(4);
		}else{
			$offset = 0;
			$data['current_page'] = 1;
		}
		
		$data['stt'] = $offset;		
		$data['member_items'] = $this->member_model->index($config["per_page"], $offset);			 
        $data['msg'] = $this->session->flashdata('flash_msg');
		$data['pagination'] = $this->pagination->create_links();		
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'_view',$data);
	}
	
	public function filter(){
		$menu['menu_active'] = 'one';		
		$html['title'] = 'Lọc thông tin';
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);
		
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);
		//get str_like
		
		if($this->input->server('REQUEST_METHOD')=='POST'){
			$str_like = $this->input->post('q');
			$this->session->set_userdata('str_like', $str_like);
		}else{
			$str_like = $this->session->userdata('str_like');						
		}
		// gen pagination
		$this->load->library('pagination');		
        $config["base_url"] = base_url().$this->config->item('index_page_add')."admin/".$this->uri->segment(2)."/filter/page";                
		$config["total_rows"] = $this->member_model->record_count_filter($str_like);
		$config['per_page'] = 20;
		$config['uri_segment'] = 5;
		$config['num_links'] = 10;	
		$config["total_pages"] = round($config["total_rows"]/$config['per_page']);			
        $this->pagination->initialize($config);		
		
		/* fix offset of pagination */
		if($this->uri->segment(5) > 0 && $this->uri->segment(5)<=$config["total_pages"]){
			$offset = $this->uri->segment(5)*$config['per_page'] - $config['per_page'];
			$data['current_page'] = $this->uri->segment(5);
		}else{
			$offset = 0;
			$data['current_page'] = 1;
		}
		
		$data['stt'] = $offset;		
		$data['member_items'] = $this->member_model->filter($config["per_page"], $offset, $str_like);			 
        $data['msg'] = $this->session->flashdata('flash_msg');
		$data['pagination'] = $this->pagination->create_links();		
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'_view',$data);
	}	
	
	
	public function view(){
		$member_id = $this->uri->segment(4);
		$data['member_items'] = $this->member_model->get_member_items($member_id);
		$data['member_info'] = $this->member_model->get_member_info($member_id);
		foreach($data['member_items'] as $item){			
			$pitem = $this->member_model->get_product_info($item['product_id']);
			$cart_image[$item['product_id']] 	= @$pitem->product_image;
			$cart_slug[$item['product_id']] 	= @$pitem->product_slug;			
		}		
		$data['cart_image'] = $cart_image;
		$data['cart_slug']  = $cart_slug;		
				
		$this->load->view('admin/'.$this->uri->segment(2).'/memberview_view',$data);
	}
	
	
	public function add(){		
		$menu['menu_active'] = 'one';				
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);		
		
		$html['title'] = 'Thêm mới thành viên';
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);	
		
		$data['f_member'] = $this->member_model->add();	
		
		//return alert
		$alert_arr = array(
			'0' => '- Hãy nhập Email<br>',			
			'1' => '- Email này đã tồn tại. Hãy nhập Email khác<br>',			
			'2' => '- Thêm mới thành công.<br>'			
		);
		$code_msg = explode(',',$data['f_member']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';			
		}
				
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'add_view',$data);		
	}
	
	
	public function edit(){		
		$member_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
		if(!$this->member_model->check_id('member','member_id',$member_id)){
			$msg = '<li>Dữ liệu bạn muốn sửa không tồn tại</li>';
			$this->session->set_flashdata('flash_msg', $msg);
			redirect('admin/'.$this->uri->segment(2),'refresh');
		}
		
		$menu['menu_active'] = 'one';				
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);		
		
		$html['title'] = 'Cập nhật thông tin';
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);		
		
		$data['f_member'] = $this->member_model->edit();
				
		
		//return alert
		$alert_arr = array(
			'0' => '- Hãy nhập Email<br>',			
			'1' => '- Email này đã tồn tại. Hãy nhập Email khác<br>',			
			'2' => '- Cập nhât thành công.<br>'			
		);
		$code_msg = explode(',',$data['f_member']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			if($val==2){
				$msg = $alert_arr[$val];			
				$this->session->set_flashdata('flash_msg', $msg);
				redirect('admin/'.$this->uri->segment(2),'refresh');
			}
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';			
		}		
				
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'edit_view',$data);
	}
	
	public function delimg(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$member_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
		if(!$this->member_model->check_id('member','member_id',$member_id)){
			echo 'Error delete file';
		}
		if($this->member_model->delimg($member_id)){
			echo 'OK';
		}else{
			echo 'Error';
		}
	}
	public function del(){				
		//return alert
		$alert_arr = array(			
			'0' => '- Xóa thành công.'
		);
		//delete
		$alert_code = $this->member_model->del();		
		$msg = $alert_arr[$alert_code];			
		$this->session->set_flashdata('flash_msg', $msg);
        redirect('admin/'.$this->uri->segment(2),'refresh');
	}		
}