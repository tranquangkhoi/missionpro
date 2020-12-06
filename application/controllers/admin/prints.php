<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prints extends CI_Controller {
	var $method_arr 	= array('edit','add','del','porder','sview','inphieu','innhan');
	var $check_rules 	= array('edit','add','del');
	
	public function __construct(){
		parent::__construct();		
		$str_rule = in_array($this->uri->segment(3),$this->check_rules) ?  $this->uri->segment(2).$this->uri->segment(3) : $this->uri->segment(2);
		$this->back->check_permission($str_rule, $this->session->userdata);
		$this->load->model('admin/prints_model');
	}
	
	public function _remap($method){	
		if(in_array($method,$this->method_arr)){
			 $this->$method();
		}else{
			$this->index();
		}
	}

	public function index(){				
		echo 'INDEX PRINTS';
	}
	
	public function inphieu(){						
		$data['phieu'] = $this->prints_model->inphieu();
		$this->load->view('admin/'.$this->uri->segment(2).'/inphieu_view',$data);
	}
	
	public function innhan(){				
		$data['nhan'] = $this->prints_model->innhan();
		$this->load->view('admin/'.$this->uri->segment(2).'/innhan_view',$data);
	}
	
	public function porder(){						
		$data['f_split'] = $this->prints_model->view();
		$this->load->view('admin/'.$this->uri->segment(2).'/'.$this->uri->segment(2).'_order_view',$data);
	}
		
}