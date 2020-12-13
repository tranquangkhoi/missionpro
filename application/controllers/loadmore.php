<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * Controller home
 * @author DLC
 *
 */
class Loadmore extends CI_Controller {        
    public function __construct(){
        parent::__construct();
        $this->load->model('home/common_model');
    }

    public function getmoreproducthot(){
        $page   = $this->input->get('page');
        $per_page = 8;
        $offset = $page * $per_page + 1;

        $data['product_items']       = $this->common_model->get_hot_products($per_page, $offset);
        echo $this->load->view('home/widget_product_item_view',$data,true);
              
    }

    public function getmoreproduct(){
        $page   = $this->input->get('page');
        $per_page = 8;
        $offset = $page * $per_page + 1;

        $data['product_items']       = $this->common_model->get_hot_products($per_page, $offset);
        echo $this->load->view('home/widget_product_item_view',$data,true);
              
    }
}
