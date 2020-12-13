<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * Controller home
 * @author DLC
 *
 */
class Home extends CI_Controller {        
    public function __construct(){
        parent::__construct();
        $this->load->model('home/common_model');
        $this->load->model('home/product_model');
        $this->load->model('home/menu_model');
        $this->load->model('home/home_model');
        $this->load->helper('text');
    }

    /**
     * remap function
     * @param string $method
     */
    public function _remap($method){    
        $last = $this->uri->total_segments();
        if(array_search('page', $this->uri->segment_array())){
            $slug = $this->uri->segment(array_search('page', $this->uri->segment_array()) - 1);    
        }else{
            $slug = $this->uri->segment($last);    
        }
                
        if($this->check_slug('category','category_slug',$slug)){
            $this->danhmucsanpham();
        }elseif($this->check_slug('product','product_slug',$slug)){
            $this->chitietsanpham();
        }else{                    
            $this->index();            
        }
    }
    
    /**
     * Index action 
     */
    public function index(){        
        /* Begin Header */        
        $html['title']        = 'MISSIONPRO | Mua sắm âm thanh 100% chính hãng';
        $html['desc']         = 'Thảnh thơi mua sắm tại MISSIONPRO ✅Chính Hãng, Uy Tín, Giá Tốt ✅ Thương Hiệu | Hotline: 0888 888 888';
        $html['key']          = 'MISSIONPRO, loa, thiết bị âm thanh, tai nghe chính hãng';        
        
        $html['cate']        = $this->menu_model->get_category();
        $html['cate_one']    = $this->menu_model->get_category_level(1);
        $html['cate_two']    = $this->menu_model->get_category_level(2);
        $html['cate_three'] = $this->menu_model->get_category_level(3);
        $html['pcate']        = $this->menu_model->pcheck;
        $html['company']     = $this->common_model->get_info_company();        
        
        $data_menu['menu_active'] = 'one';
        $data_menu['cate_one'] = $html['cate_one'];
        $data_menu['cate_two'] = $html['cate_two'];
        $data_menu['pcate'] = $html['pcate'];
        $html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
        $html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view',$html,true);
        $data['header'] = $this->load->view('home/header_view',$html,true);
        /* End Header */
        
        /*Begin Footer */
        $footer['info_one']     = $this->menu_model->get_menu_intro(0);
        $footer['name_one']     = $this->menu_model->get_menu_intro_name(0);
        $footer['info_two']     = $this->menu_model->get_menu_intro(1);
        $footer['name_two']     = $this->menu_model->get_menu_intro_name(1);        
        $footer['company']      = $html['company'];
        
        $data['footer'] = $this->load->view('home/footer_view',$footer,true);        
        /* End Footer */
        
        /* Begin Widget */
        $data['product_items']       = $this->common_model->get_hot_products(8);
        $hot_products_count       = $this->common_model->get_count_hot_products();
        $per_page = 8;
        $data["total_pages"] = ceil($hot_products_count/$per_page); 

        $data['widget_product_item_view']       = $this->load->view('home/widget_product_item_view',$data,true);
        $data['widget_product_hot']       = $this->load->view('home/widget_product_hot_view',$data,true);
        $data['widget_home_news']       = $this->load->view('home/widget_home_news',$data,true);
        $data['widget_support']       = $this->load->view('home/widget_support_view',$data,true);
        /* End Widget */
        
        /* begin banner */
        $data['banner_main'] = $this->home_model->get_banner(0,2);
        $data['banner_right_top'] = $this->home_model->get_banner(1,2);
        $data['banner_right_bottom']  = $this->home_model->get_banner(2,2);        
        
        
        $cate_top = $html['cate_one'];        
        for($i=1; $i<=count($cate_top); $i++){
            $group = 'group'.$cate_top[$i]['category_id'];    
            $data[$group] = $this->home_model->product_of_cate($cate_top[$i]['category_children'],18);
            $dem[$cate_top[$i]['category_id']]  = count($data[$group]);
        }
        $data['cate_top']     = $cate_top;
        $data['dem']         = $dem;        
        
                
        $this->load->view('home/home_view',$data);        
    }
    
    
    public function danhmucsanpham(){        
        //get slug            
        $ppage = 0;
        $last = $this->uri->total_segments();
        if(array_search('page', $this->uri->segment_array())){
            $psg = array_search('page', $this->uri->segment_array())-1;
            $slug = $this->uri->segment($psg);
            $ppage = $psg + 2;
        }else{
            $slug = $this->uri->segment($last);    
        }
        $category = $this->product_model->get_category_by_slug($slug);                        
        
        /* Begin Header */
        $html['title']         = $category->category_name;
        $html['desc']          = $category->category_meta_desc;
        $html['key']           = $category->category_meta_key;
        
        $html['cate']        = $this->menu_model->get_category();
        $html['cate_one']    = $this->menu_model->get_category_level(1);
        $html['cate_two']    = $this->menu_model->get_category_level(2);
        $html['cate_three']    = $this->menu_model->get_category_level(3);        
        $html['pcate']        = $this->menu_model->pcheck;            
        $html['company']     = $this->common_model->get_info_company();    
        $data_menu['menu_active'] = 'one';
        $html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
        $html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
        $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view',$html,true);
        $data['header']     = $this->load->view('home/header_view',$html,true);
        /* End Header */
        
        /*Begin Footer */
        $footer['info_one']= $this->menu_model->get_menu_intro(0);
        $footer['name_one']= $this->menu_model->get_menu_intro_name(0);
        $footer['info_two']= $this->menu_model->get_menu_intro(1);
        $footer['name_two']= $this->menu_model->get_menu_intro_name(1);
        $footer['company']       = $html['company'];
        
        $data['footer'] = $this->load->view('home/footer_view',$footer,true);        
        /* End Footer */
        
        //hien thi danh muc o cot trai
        $data['cate_one']   = $html['cate_one'];
        $data['cate_two']   = $html['cate_two'];
        $data['pcate']      = $html['pcate'];
        
        //get parent name    
        $data['parent_name']          = $this->product_model->get_parent_name($category->category_parent, $category->category_id, $category->category_path);
        $data['parent_name']          = $data['parent_name']<>'' ?  $data['parent_name'] : 'Sản phẩm';
        $data['category_id_crr']     = $category->category_id;
        $data['category_slug_crr']   = $category->category_slug;
        $data['category_name_crr']   = $category->category_name;
        $data['category_review_crr'] = $category->category_review;
        $data['widget_support']       = $this->load->view('home/widget_support_view',$data,true);
        //get path cetargory
        $data['path'] =  $this->product_model->get_path($category->category_path);
        $path = $data['path'];
        $total = count($path);    
        $page_url = '';
        for($i=1; $i<=$total; $i++){
            $page_url .= $i=='1' ? $path[$i]['category_slug'] :  '/'.$path[$i]['category_slug'];
        }
        
        //get param
        $type_arr = array('grid','list');
        $data['type'] = in_array($this->input->get('type'),$type_arr) ? $this->input->get('type') : 'grid';
        $sort_arr = array('0','1','2');
        $sort_text = array('0'=>'Sản phẩm mới','1'=>'Giá thấp đến cao','2'=>'Giá cao đến thấp');
        $data['sort'] = in_array($this->input->get('sort'),$sort_arr) ? $this->input->get('sort') : '0';
        $data['sort'] = $data['sort']=='' ? 0 : $data['sort'];

        $data['select_sort'] = '';
        foreach($sort_text as $key=>$val){
            if($key==$data['sort']){
                $data['select_sort'] .= '<option value="'.current_url().'?type='.$data['type'].'&sort='.$key.'" selected="selected">'.$val.'</option>\n';
            }else{
                $data['select_sort'] .= '<option value="'.current_url().'?type='.$data['type'].'&sort='.$key.'">'.$val.'</option>\n';
            }            
        }    
        
        // gen pagination
        $this->load->library('pagination');
        //setup page
        $config1['suffix']    = '.html?type='.$data['type'].'&sort='.$data['sort'];
        $config1["base_url"]  = base_url().$page_url.'/page';                
        $config1['first_url'] = '1.html?type='.$data['type'].'&sort='.$data['sort'];
        $config1["total_rows"] = $this->product_model->record_count($category->category_children);                        
        $config1['per_page'] = 20;
        $config1['uri_segment'] = $ppage;
        $config1['num_links'] = 4;    
        $config1["total_pages"] = ceil($config1["total_rows"]/$config1['per_page']); 
            
        /* fix offset of pagination */ 
        if($this->uri->segment($ppage) > 0 && $this->uri->segment($ppage)<=$config1["total_pages"]){
            $offset = $this->uri->segment($ppage)*$config1['per_page'] - $config1['per_page'];        
        }else{
            $offset = 0;
            //$data['current_page'] = 1;
        }
        $this->pagination->initialize($config1);
        $data['pagination'] = $this->pagination->create_links();
        $data['product_items'] = $this->product_model->index($config1["per_page"], $offset, $category->category_children,$data['sort']);



        $data['widget_product_item_view']       = $this->load->view('home/widget_product_item_view',$data,true);
        $data['widget_product']       = $this->load->view('home/widget_product_view',$data,true);   
        
        $this->load->view('home/sanpham/grid_view',$data);          
    }
    
    public function chitietsanpham(){
        //get slug        
        $last = $this->uri->total_segments();
        $slug = $this->uri->segment($last);
        $productdetail = $this->product_model->get_product_id($slug);
        
        //get html_tag
        if (!empty($productdetail->product_title_seo)) {
            $html['title'] = $productdetail->product_title_seo;
        } else {
            $html['title'] = $productdetail->product_title;
        }
        $html['desc'] = $productdetail->product_meta_desc;
        $html['key'] = $productdetail->product_meta_key;
        $html['product_image'] = $productdetail->product_image;
        $html['tags'] = $productdetail->product_meta_key;
        
        
        // gen footer + header
        $html['cate']        = $this->menu_model->get_category();
        $html['cate_one']    = $this->menu_model->get_category_level(1);
        $html['cate_two']    = $this->menu_model->get_category_level(2);
        $html['cate_three']    = $this->menu_model->get_category_level(3);
        $html['pcate']        = $this->menu_model->pcheck;    
        $html['company']     = $this->common_model->get_info_company();    
        $data_menu['menu_active'] = 'one';
        $html['menubar'] = $this->load->view('home/menubar_view',$data_menu,true);
        $html['menubar_mobile'] = $this->load->view('home/menubar_mobile_view',$data_menu,true);
        $html['widget_category_mobile']     = $this->load->view('home/widget_category_mobile_view',$html,true);
        $html['widget_category']       = $this->load->view('home/widget_category_view_float',$html,true);
        $data['header']     = $this->load->view('home/header_view',$html,true);
        
        /*Begin Footer */
        $footer['info_one']= $this->menu_model->get_menu_intro(0);
        $footer['name_one']= $this->menu_model->get_menu_intro_name(0);
        $footer['info_two']= $this->menu_model->get_menu_intro(1);
        $footer['name_two']= $this->menu_model->get_menu_intro_name(1);
        $footer['company']       = $html['company'];
        $data['footer'] = $this->load->view('home/footer_view',$footer,true);
        /* End Footer */
        
        $category = $this->product_model->get_category_by_id($productdetail->category_id);
        
        //get left menu
        $data['cate_one']   = $html['cate_one'];
        $data['cate_two']   = $html['cate_two'];
        $data['pcate']        = $html['pcate'];

        
        //get parent name
        $data['parent_name'] = $this->product_model->get_parent_name($category->category_parent, $category->category_id, $category->category_path);
        $data['parent_name'] = $data['parent_name']<>'' ?  $data['parent_name'] : 'Sản phẩm';
        //get path cetargory
        $data['path'] =  $this->product_model->get_path($category->category_path);
        
        $data['productdetail']  = $productdetail;    
        $data['libimg']            = $this->product_model->get_lib_img($productdetail->product_id);
        
        $data['other_items'] = $this->product_model->get_other_product($category->category_children, $productdetail->product_id);        

        /* Begin hien thi menu san pham moi */
        $pnew['pnew']= $this->menu_model->get_lastest_product(2);
        $data['menu_pnew'] = $this->load->view('home/menu_pnew_view',$pnew,true);
        /* End hien thi menu san pham moi */
        
        /* get autocode */
        
        $data['autocode'] = $this->product_model->get_autocode();
                
        $this->load->view('home/sanpham/detail_view',$data);    
    }
        
    public function check_slug($tbl,$col_slug,$slug){
        $sql = 'SELECT * FROM '.$tbl.' WHERE '.$col_slug.' ="'.$slug.'"';        
        $query = $this->db->query($sql);        
        if($query->num_rows()==0){
            return false;
        }else{
            return true;
        }
    }
}