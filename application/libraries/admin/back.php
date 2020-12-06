<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Back{
    
	public function check_permission($action_permission,$ss_data){
		if(isset($ss_data['group_permission'])){
			$permission_arr = explode(",",$ss_data['group_permission']);
			if(!$ss_data['validated']){				
				redirect('admin','refresh');
			}else{
				if(in_array($action_permission, $permission_arr) || $ss_data['user_super']==1){
					return TRUE;
				}else{
					redirect('admin/alert','refresh');
				}
			}
		}else{						
			redirect('admin','refresh');
		}
    }
	
	public function fix_date($format, $fld_date){
		return gmdate($format,$fld_date + 7*3600);	
	}
	
	public function txt_level($level){
		$txt = "";		
		for($i=2; $i<=$level; $i++){			
			$txt .= "&nbsp;&nbsp;&nbsp;&nbsp;";			
		}
		
		if($level == 1){
			$txt .= "<b>";							
		}else{
			$txt .= "|-- ";
		}
		return $txt;
	}
	
	public function zerofill ($num, $zerofill = 5)
	{
		return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
	}
	
	public function upload_file($path,$field,$max_size=0,$max_width=0,$max_height=0){
		// tham chieu den thu vien cua CI
		$CI =& get_instance();		
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png|pdf|doc|xls|txt';
		$config['max_size']	= $max_size;
		$config['max_width']  = $max_width;
		$config['max_height']  = $max_height;
	
		$CI->load->library('upload', $config);
		
		if (!$CI->upload->do_upload($field)){			
			echo $CI->upload->display_errors();			
			exit();
			return FALSE;
		}else{			
			return TRUE;
		}
	}
	
	public function upload_multi_file($path,$field,$max_size=0,$max_width=0,$max_height=0){
		// tham chieu den thu vien cua CI
		$CI = &get_instance();		
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png|pdf|doc|xls|txt|sql';
		$config['max_size']	= $max_size;
		$config['max_width']  = $max_width;
		$config['max_height']  = $max_height;	
		$CI->load->library('upload',$config);
		
		$files = $_FILES;
		$cpt = count(@$_FILES[$field]['name']);	
		$fld_up = '';
		$img_name = array();
		$d = 0;
		$image_order = $CI->input->post('image_order');	
		
		for($i=0; $i<$cpt; $i++){	
			$fld_up = $field.$i;			
			if($files[$field]['name'][$i]<>''){
				$_FILES[$fld_up]['name']= $files[$field]['name'][$i];
				$_FILES[$fld_up]['type']= $files[$field]['type'][$i];
				$_FILES[$fld_up]['tmp_name']= $files[$field]['tmp_name'][$i];
				$_FILES[$fld_up]['error']= $files[$field]['error'][$i];
				$_FILES[$fld_up]['size']= $files[$field]['size'][$i];  	
				
				
				if (!$CI->upload->do_upload($fld_up)){			
					echo $CI->upload->display_errors();			
					exit();				
				}else{				
					$data_upload = $CI->upload->data();
					$img_name[$d]['full_path'] = $data_upload['full_path'];
					$img_name[$d]['file_name'] = $data_upload['file_name'];
					$img_name[$d]['is_image']  = $data_upload['is_image'];
					$img_name[$d]['order']     = $image_order[$i];
					$d = $d + 1;
				}
			}
		}
		return $img_name;		
	}
	
	
	
	public function create_thumb($path_image,$image_name, $is_img,$w,$h,$resize_name){
		// tham chieu den thu vien cua CI
		$CI =& get_instance();		
		$configThumb = array();
		$configThumb['image_library'] 	= 'gd2';
		$configThumb['source_image']  	 = $path_image;
		$configThumb['create_thumb'] 	 = FALSE;
		$configThumb['new_image'] 		= $resize_name.$image_name;
		$configThumb['maintain_ratio']   = FALSE;
		$configThumb['width'] 			= $w;
        $configThumb['height'] 		   = $h;
		$CI->load->library('image_lib');
		if ($is_img == 1){			
			$CI->image_lib->initialize($configThumb);
			if (!$CI->image_lib->resize()){
				 echo $CI->image_lib->display_errors();
				 exit();
				return FALSE;
			}else{
				return TRUE;
			}
		}else{
			return FALSE;
		}
	}
	
	public function delete_file($dir, $file_name){		
		if(!empty($file_name)){			
			$file_path = $dir.$file_name;
			if(file_exists($file_path)) unlink($file_path) or die("Error Occured While delete file !");				
			return;
		}	
	}
	
	public function datevn_to_datemysql($date_field){
	$str_date = "";
		if($date_field != null){
			$str_date = substr($date_field,6,4)."-".substr($date_field,3,2)."-".substr($date_field,0,2);
			return $str_date;
		}else{
			return NULL;
		}
	}
	
	public function datemysql_to_datevn($date_field){
		$str_date = "";
		if($date_field != null){
			$str_date = substr($date_field,8,2)."/".substr($date_field,5,2)."/".substr($date_field,0,4);
			return $str_date;
		}else{
			return NULL;
		}
	}
	function checkDateTime($data) {
		if (date('Y-m-d H:i:s', strtotime($data)) == $data) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=true, $include_special_chars=false){
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                

        return $password;
    }
		
}

