<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Getcaptcha extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->helper('captcha');
	}
	
	public function _remap($method, $params = array()){		
		if (method_exists($this, str_replace('-','_',$method))){
			return call_user_func_array(array($this, str_replace('-','_',$method)), $params);
		}else{
			$this->index();
		}	
	}
	
	public function index(){		
		//get captcha		
		$vals = array(
			'img_path'   => './captcha/',
			'img_url'	=> base_url().'captcha/',
			'font_path' => './system/fonts/texb.ttf',
			'img_width'  => 128,
			'img_height' => 34,
			'expiration' => 7200
		);		
		$cap = create_captcha($vals);	
		
		$data = array(
			'captcha_time'  => $cap['time'],
			'ip_address'	=> $this->input->ip_address(),
			'word'	 	  => $cap['word'],
			'captcha_img'   => $cap['image_name']
			);		
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);		
		echo $cap['image'];				
	}
}