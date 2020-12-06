<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller {
	var $method_arr = array('edit','add','del','sortup','sortdown','filter','delimg');
	var $check_rules = array('edit','add','del');
	
	public function __construct(){
		parent::__construct();		
		$str_rule = in_array($this->uri->segment(3),$this->check_rules) ?  $this->uri->segment(2).$this->uri->segment(3) : $this->uri->segment(2);
		$this->back->check_permission($str_rule, $this->session->userdata);
		$this->load->model('admin/banner_model');
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
		$html['title'] = 'Quản lý bài viết';
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);
		$html['company'] 	= $this->common_model->get_info_company();	
		
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);
		
		// gen pagination
		$this->load->library('pagination');		
        $config["base_url"] = base_url().$this->config->item('index_page_add')."admin/".$this->uri->segment(2).'/page';                
		$config["total_rows"] = $this->banner_model->record_count();				
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
		$data['banner_items'] = $this->banner_model->index($config["per_page"], $offset);			 
        $data['msg'] = $this->session->flashdata('flash_msg');
		$data['pagination'] = $this->pagination->create_links();
		$data['bannercate_choose'] = $this->banner_model->get_select_bannercate_full();
		$data['bannercate_name'] = $this->banner_model->get_bannercate();
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'_view',$data);
	}
	
	public function filter(){
		$menu['menu_active'] = 'five';		
		$html['title'] = 'Lọc bài viết';
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);
		$html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
		$html['company'] 	= $this->common_model->get_info_company();	
		
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);
		//get str_like
		
		if($this->input->server('REQUEST_METHOD')=='POST'){
			$str_like = $this->input->post('q');
			$bannercate_id = $this->input->post('bannercate_id');
			$this->session->set_userdata('str_like', $str_like);
			$this->session->set_userdata('bannercate_id', $bannercate_id);
		}else{
			$str_like = $this->session->userdata('str_like');
			$bannercate_id = $this->session->userdata('bannercate_id');			
		}
		// gen pagination
		$this->load->library('pagination');		
        $config["base_url"] = base_url().$this->config->item('index_page_add')."admin/".$this->uri->segment(2)."/filter/page";                
		$config["total_rows"] = $this->banner_model->record_count_filter($str_like, $bannercate_id);
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
		$data['banner_items'] = $this->banner_model->filter($config["per_page"], $offset, $str_like, $bannercate_id);			 
        $data['msg'] = $this->session->flashdata('flash_msg');
		$data['pagination'] = $this->pagination->create_links();
		$data['bannercate_choose'] = $this->banner_model->get_select_bannercate_full($bannercate_id);
		$data['bannercate_name'] = $this->banner_model->get_bannercate();
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'_view',$data);
	}
	
	public function sortup(){
		$banner_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
		if(!$this->banner_model->check_id('banner','banner_id',$banner_id)){
			$msg = '<li>Dữ liệu bạn muốn sửa không tồn tại</li>';
			$this->session->set_flashdata('flash_msg', $msg);
			redirect('admin/'.$this->uri->segment(2),'refresh');
		}		
		$this->banner_model->sortup($banner_id);
		redirect('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(5),'refresh');			
	}
	
	public function sortdown(){
		$banner_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
		if(!$this->banner_model->check_id('banner','banner_id',$banner_id)){
			$msg = '<li>Dữ liệu bạn muốn sửa không tồn tại</li>';
			$this->session->set_flashdata('flash_msg', $msg);
			redirect('admin/'.$this->uri->segment(2),'refresh');
		}		
		$this->banner_model->sortdown($banner_id);
		redirect('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(5),'refresh');				
	}
	
	
	public function add(){		
		$menu['menu_active'] = 'five';				
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);		
		
		$html['title'] = 'Thêm mới bài viết';
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);		
		
		$data['f_banner'] = $this->banner_model->add();		
			
		//return alert
		$alert_arr = array(
			'0' => '-Hãy nhập link của Banner<br>',
			'1' => '-Hãy nhập nội dung trích dẫn của bản tin<br>',
			'2' => '-Hãy nhập nội dung bản tin<br>',			
			'3' => '-Thêm mới thành công.<br>'			
		);
		$code_msg = explode(',',$data['f_banner']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';			
		}
		//gen editor				
		$text_area_review = $this->editor->short("edit","banner_review","100%","200px");
		$data['f_banner']['text_area_review'] = $text_area_review;
		
		$text_area_content = $this->editor->short("edit2","banner_content","100%","200px");
		$data['f_banner']['text_area_content'] = $text_area_content;
		
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'add_view',$data);		
		
	}
	
	public function edit(){		
		$banner_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
		if(!$this->banner_model->check_id('banner','banner_id',$banner_id)){
			$msg = '<li>Dữ liệu bạn muốn sửa không tồn tại</li>';
			$this->session->set_flashdata('flash_msg', $msg);
			redirect('admin/'.$this->uri->segment(2),'refresh');
		}
		
		$menu['menu_active'] = 'five';				
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);		
		
		$html['title'] = 'Cập nhật bài viết';
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);		
		
		$data['f_banner'] = $this->banner_model->edit();
				
		
		//return alert
		$alert_arr = array(
			'0' => '-Hãy nhập link của Banner<br>',					
			'3' => '-Cập nhật thành công.<br>'			
		);
		$code_msg = explode(',',$data['f_banner']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			if($val==3){
				$msg = $alert_arr[$val];			
				$this->session->set_flashdata('flash_msg', $msg);
				redirect('admin/'.$this->uri->segment(2),'refresh');
			}
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';			
		}
		//gen editor				
		$text_area_review = $this->editor->short("edit","banner_review","100%","200px");
		$data['f_banner']['text_area_review'] = $text_area_review;
		
		$text_area_content = $this->editor->short("edit2","banner_content","100%","200px");
		$data['f_banner']['text_area_content'] = $text_area_content;
				
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'edit_view',$data);
	}
	
	public function delimg(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$banner_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
		if(!$this->banner_model->check_id('banner','banner_id',$banner_id)){
			echo 'Error delete file';
		}
		if($this->banner_model->delimg($banner_id)){
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
		$alert_code = $this->banner_model->del();		
		$msg = $alert_arr[$alert_code];			
		$this->session->set_flashdata('flash_msg', $msg);
        redirect('admin/'.$this->uri->segment(2),'refresh');
	}		
}