<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	var $method_arr = array('edit','add','del','filter','delimg','delalbum','getattri','status');
	var $check_rules = array('edit','add','del');
	
	public function __construct(){
		parent::__construct();		
		$str_rule = in_array($this->uri->segment(3),$this->check_rules) ?  $this->uri->segment(2).$this->uri->segment(3) : $this->uri->segment(2);
		$this->back->check_permission($str_rule, $this->session->userdata);
		$this->load->model('admin/product_model');
	}
	
	public function _remap($method){	
		if(in_array($method,$this->method_arr)){
			 $this->$method();
		}else{
			$this->index();
		}
	}

	public function index(){		
		$menu['menu_active'] = 'two';		
		$html['title'] = 'Quản lý sản phẩm';
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);
		
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);
		
		// gen pagination
		$this->load->library('pagination');		
        $config["base_url"] = base_url().$this->config->item('index_page_add')."admin/".$this->uri->segment(2).'/page';                
		$config["total_rows"] = $this->product_model->record_count();				
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['num_links'] = 10;	
		$config["total_pages"] = ceil($config["total_rows"]/$config['per_page']);	
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
		$data['product_items'] = $this->product_model->index($config["per_page"], $offset);			 
        $data['msg'] = $this->session->flashdata('flash_msg');
		$data['pagination'] = $this->pagination->create_links();
		$data['category_choose'] = $this->product_model->get_select_category_full();
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'_view',$data);
	}
	
	public function filter(){
		$menu['menu_active'] = 'two';		
		$html['title'] = 'Lọc bài viết';
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);
		
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);
		//get str_like
		
		if($this->input->server('REQUEST_METHOD')=='POST'){
			$str_like = $this->input->post('q');
			$category_id = $this->input->post('category_id');
			$this->session->set_userdata('str_like', $str_like);
			$this->session->set_userdata('category_id', $category_id);
		}else{
			$str_like = $this->session->userdata('str_like');
			$category_id = $this->session->userdata('category_id');			
		}
		// gen pagination
		$this->load->library('pagination');		
        $config["base_url"] = base_url().$this->config->item('index_page_add')."admin/".$this->uri->segment(2)."/filter/page";                
		$config["total_rows"] = $this->product_model->record_count_filter($str_like, $category_id);
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
		$data['product_items'] = $this->product_model->filter($config["per_page"], $offset, $str_like, $category_id);			 
        $data['msg'] = $this->session->flashdata('flash_msg');
		$data['pagination'] = $this->pagination->create_links();
		$data['category_choose'] = $this->product_model->get_select_category_full($category_id);
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'_view',$data);
	}
	
	public function status(){
		$status = $this->uri->segment(4);
		$this->session->set_userdata('status',$status);
		redirect('admin/product','refresh');
	}
		
	public function add(){		
		$menu['menu_active'] = 'two';				
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);		
		
		$html['title'] = 'Thêm mới sản phẩm';
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);		
		
		$data['f_product'] = $this->product_model->add();		
			
		//return alert
		$alert_arr = array(
			'0' => '-Hãy nhập tên sản phẩm<br>',
			'1' => '-Hãy nhập nội dung trích dẫn của sản phẩm<br>',
			'2' => '-Hãy nhập nội dung mô tả chi tiết sản phẩm<br>',			
			'3' => '-Thêm mới thành công.<br>'			
		);
		$code_msg = explode(',',$data['f_product']['code_msg']);		
		$data['msg'] = '';
		foreach($code_msg as $key => $val){
			$data['msg'] .= $val<>'' ? $alert_arr[$val] : '';			
		}
		//gen editor				
		$text_area_review = $this->editor->view_file(".editme","550","200","546","200");		
		$data['f_product']['text_area_review'] = $text_area_review;		
		
		
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'add_view',$data);		
		
	}
	
	public function edit(){		
		$product_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
		if(!$this->product_model->check_id('product','product_id',$product_id)){
			$msg = '<li>Dữ liệu bạn muốn sửa không tồn tại</li>';
			$this->session->set_flashdata('flash_msg', $msg);
			redirect('admin/'.$this->uri->segment(2),'refresh');
		}
		
		$menu['menu_active'] = 'two';				
		$html['menubar'] = $this->load->view('admin/menubar_view',$menu,true);		
		
		$html['title'] = 'Cập nhật bài viết';
		$data['header'] = $this->load->view('admin/header_view',$html,true);
		$data['footer'] = $this->load->view('admin/footer_view','',true);		
		
		$data['f_product'] = $this->product_model->edit();
				
		
		//return alert
		$alert_arr = array(
			'0' => '-Hãy nhập tên sản phẩm<br>',
			'1' => '-Hãy nhập nội dung trích dẫn của sản phẩm<br>',
			'2' => '-Hãy nhập nội dung mô tả chi tiết sản phẩm<br>',			
			'3' => '-Cập nhật thành công.<br>'			
		);
		$code_msg = explode(',',$data['f_product']['code_msg']);		
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
		$text_area_review = $this->editor->view_file(".editme","550","200","546","200");		
		$data['f_product']['text_area_review'] = $text_area_review;	
	
		$data['album'] = $this->product_model->get_album_image($data['f_product']['product_id']);
						
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'edit_view',$data);
	}
	
	public function delimg(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$product_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
		if(!$this->product_model->check_id('product','product_id',$product_id)){
			echo 'Error delete file';
		}
		if($this->product_model->delimg($product_id)){
			echo 'OK';
		}else{
			echo 'Error';
		}
	}
	
	public function delalbum(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		$image_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;			
		if(!$this->product_model->check_id('product_image','image_id',$image_id)){
			echo 'Error delete file';
		}
		if($this->product_model->delalbum($image_id)){
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
		$alert_code = $this->product_model->del();		
		$msg = $alert_arr[$alert_code];			
		$this->session->set_flashdata('flash_msg', $msg);
        redirect('admin/'.$this->uri->segment(2),'refresh');
	}
	
	public function getattri(){		
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}		
		$category_id = $this->uri->segment(4);
		$attricate_arr = $this->product_model->get_attricate($category_id);
		$attr_html = '';
		if(count($attricate_arr)>0){
			$d = 0;			
			foreach($attricate_arr as $row){				
				$attr_arr = $this->product_model->get_attri($row->attricate_id);
				$d = $d + 1;				
				$item_begin = '<div class="control-group">                                
                               	  <label class="control-label"  for="'.$row->attricate_id.'">'.$row->attricate_title.':</label>
                                  		<div class="controls">
                                  			<select id="attr'.$d.'" name="attr'.$d.'" class="input-xlarge" size=5>';
				
				$item_end = '				</select>
                                  		</div>
                             </div>';
				$item_mid = '<option value="'.$row->attricate_id.':0" selected>Chọn '.$row->attricate_title.'</option>';
				foreach($attr_arr as $items){
					$item_mid .= '<option value="'.$row->attricate_id.':'.$items->attri_id.'">'.$items->attri_title.'</option>';
				}
				
				if($item_mid<>''){
					$attr_html .= $item_begin.$item_mid.$item_end;
				}			
			}
		}
		$n_sl = '<input name="n_attri" type="hidden" value="'.count($attricate_arr).'" />';
		echo $n_sl.$attr_html;
	}		
	
}