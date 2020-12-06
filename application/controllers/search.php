<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->model('home/common_model');
		$this->load->model('home/menu_model');
		$this->load->model('home/search_model');
		$this->load->model('home/product_model');	
		$this->load->helper('text');	
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
		if($this->input->server('REQUEST_METHOD')=='POST' || $this->input->server('REQUEST_METHOD')=='GET'){
			$keyword = $this->input->get_post('qsearch');
			$this->session->set_userdata('str_like', $keyword);
		}else{
			$keyword = $this->session->userdata('str_like');			
		}
		if($keyword==""){
			redirect(base_url(),'refresh');
		}		
		
		/* Begin Header */
		$html['title'] 		= 'Tìm kiếm sản phẩm có từ khóa : '.$keyword;
		$html['desc'] 		= 'Tìm kiếm sản phẩm có từ khóa : '.$keyword;
		$html['key'] 		= $keyword;
		
		$html['cate']		= $this->menu_model->get_category();
		$html['cate_one']	= $this->menu_model->get_category_level(1);
		$html['cate_two']	= $this->menu_model->get_category_level(2);
		$html['cate_three']	= $this->menu_model->get_category_level(3);		
		$html['pcate']		= $this->menu_model->pcheck;		
		$html['company'] 	= $this->common_model->get_info_company();	
		$data_menu['menu_active'] = 'one';
		$data_menu['cate_one'] = $html['cate_one'];
		$data_menu['cate_two'] = $html['cate_two'];
		$data_menu['pcate'] = $html['pcate'];
		$html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
		$html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
        $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view_float',$html,true);
		$data['header'] 	= $this->load->view('home/header_view',$html,true);
		/* End Header */
		
		/*Begin Footer */
		$footer['info_one']= $this->menu_model->get_menu_intro(0);
		$footer['name_one']= $this->menu_model->get_menu_intro_name(0);
		$footer['info_two']= $this->menu_model->get_menu_intro(1);
		$footer['name_two']= $this->menu_model->get_menu_intro_name(1);
		$footer['company'] 	  = $this->common_model->get_info_company();
		
		$data['footer'] = $this->load->view('home/footer_view',$footer,true);		
		/* End Footer */
		
		//get param
		$type_arr = array('grid','list');
		$data['type'] = in_array($this->input->get('type'),$type_arr) ? $this->input->get('type') : 'grid';
		$sort_arr = array('0','1','2');
		$sort_text = array('0'=>'Chọn','1'=>'Giá thấp đến cao','2'=>'Giá cao đến thấp');
		$data['sort'] = in_array($this->input->get('sort'),$sort_arr) ? $this->input->get('sort') : '0';
		$data['sort'] = $data['sort']=='' ? 0 : $data['sort'];

		$data['select_sort'] = '';
		foreach($sort_text as $key=>$val){
			if($key==$data['sort']){
				$data['select_sort'] .= '<option value="'.current_url().'?qsearch='.$keyword.'&type='.$data['type'].'&sort='.$key.'" selected="selected">'.$val.'</option>\n';
			}else{
				$data['select_sort'] .= '<option value="'.current_url().'?qsearch='.$keyword.'&type='.$data['type'].'&sort='.$key.'">'.$val.'</option>\n';
			}			
		}
				
		// gen pagination
		$this->load->library('pagination');		
		//setup page
		$config1['suffix']    = '.html?qsearch='.$keyword.'&type='.$data['type'].'&sort='.$data['sort'];
        $config1["base_url"] = base_url().$this->config->item('index_page_add')."search/page";                
		$config1["total_rows"] = $this->search_model->record_count($keyword);						
		$config1['per_page'] = 9;
		$config1['uri_segment'] = 3;
		$config1['num_links'] = 10;	
		$config1["total_pages"] = ceil($config1["total_rows"]/$config1['per_page']); 
			
		/* fix offset of pagination */ 
		if($this->uri->segment(3) > 0 && $this->uri->segment(3)<=$config1["total_pages"]){
			$offset = $this->uri->segment(3)*$config1['per_page'] - $config1['per_page'];		
			//$data['current_page'] = $this->uri->segment(4);
		}else{
			$offset = 0;
			//$data['current_page'] = 1;
		}
		$this->pagination->initialize($config1);
		$data['pagination'] = $this->pagination->create_links();				
		$data['product_items'] = $this->search_model->index($config1["per_page"], $offset, $keyword, $data['sort']);		
		
		/* Begin hien thi menu san pham moi */
		$pnew['pnew']= $this->menu_model->get_lastest_product(2);
		$data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
		/* End hien thi menu san pham moi */
		
		$data['total_search'] = $config1["total_rows"];
		$data['key_search'] = $keyword;
		if($data['type']=='grid'){
			$this->load->view('home/search/grid_view',$data);		
		}elseif($data['type']=='list'){
			$this->load->view('home/search/list_view',$data);		
		}else{
			$this->load->view('home/search/grid_view',$data);		
		}	
	}
}