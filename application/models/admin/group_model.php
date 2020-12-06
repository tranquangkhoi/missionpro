<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function record_count(){
        return $this->db->count_all("system_user_group");
    }
	
	public function record_count_filter($str_like){		
		$this->db->from('system_user_group');	
		$this->db->like('group_name', $str_like);
        return $this->db->count_all_results();
    }
	

	public function index($limit, $page){
		$this->db->select('*');
		$this->db->from('system_user_group');
		$this->db->order_by('group_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function filter($limit, $page, $str_like){
		$this->db->select('*');
		$this->db->like('group_name', $str_like);
		$this->db->from('system_user_group');		
		$this->db->order_by('group_order','asc');
		$this->db->limit($limit, $page);		
		$query = $this->db->get();		
		return $query->result_array();		
	}
	
	public function sortup($id){
		$this->db->select('*');
		$this->db->from('system_user_group');
		$this->db->where('group_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->group_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('system_user_group');
		$this->db->where('group_order < ',$crr_ord);
		$this->db->order_by('group_order','desc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->group_id;
			$up_ord = $row->group_order;
			
			$data_sort = array(				
				'group_order' => $crr_ord			
			);
			$this->db->where('group_id', $up_id);					
			$this->db->update('system_user_group', $data_sort);
			
			$data_sort = array(				
				'group_order' => $up_ord			
			);
			$this->db->where('group_id', $crr_id);					
			$this->db->update('system_user_group', $data_sort);			
		}				
		
	}
	
	public function sortdown($id){
		$this->db->select('*');
		$this->db->from('system_user_group');
		$this->db->where('group_id',$id);
		$query = $this->db->get();		
		$row = $query->row();
		
		$crr_ord = $row->group_order;
		$crr_id = $id;
		
		$this->db->select('*');
		$this->db->from('system_user_group');
		$this->db->where('group_order > ',$crr_ord);
		$this->db->order_by('group_order','asc');
		$this->db->limit(1);				
		$query = $this->db->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$up_id = $row->group_id;
			$up_ord = $row->group_order;
			
			$data_sort = array(				
				'group_order' => $crr_ord			
			);
			$this->db->where('group_id', $up_id);					
			$this->db->update('system_user_group', $data_sort);
			
			$data_sort = array(				
				'group_order' => $up_ord			
			);
			$this->db->where('group_id', $crr_id);					
			$this->db->update('system_user_group', $data_sort);			
		}				
		
	}
	
	
	
	public function add(){
		$code_msg = '';
		$group_level = '';
		$grant_arr = array();		
		$group_description = $this->input->get_post('group_description');
		
		$frame_arr = $this->get_frames();
		$grant_to_frame = "";
		$check_group_active = "";
				
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$group_name 	= '';					
		}else{		
			for($i=1; $i<=count($frame_arr); $i++){			
				$frame_code = $frame_arr[$i]["frame_code"]."11";			
				$grant_to_frame .= isset($_POST[$frame_code]) ?  $frame_arr[$i]["frame_code"]."add," : "";
				
				$frame_code = $frame_arr[$i]["frame_code"]."12";			
				$grant_to_frame .= isset($_POST[$frame_code]) ?  $frame_arr[$i]["frame_code"]."edit," : "";
				
				$frame_code = $frame_arr[$i]["frame_code"]."13";			
				$grant_to_frame .= isset($_POST[$frame_code]) ?  $frame_arr[$i]["frame_code"]."del," : "";
				
				$frame_code = $frame_arr[$i]["frame_code"]."14";			
				$grant_to_frame .= isset($_POST[$frame_code]) ?  $frame_arr[$i]["frame_code"]."," : "";
				
				$frame_code = $frame_arr[$i]["frame_code"]."15";			
				$grant_to_frame .= isset($_POST[$frame_code]) ?  $frame_arr[$i]["frame_code"]."app," : "";
			}
			$grant_arr = explode(",",$grant_to_frame);
			
			$group_name 	   = $this->input->post('group_name');
			$group_level 	  = $this->input->post('group_level') ? $this->input->post('group_level') : 0;			
			$group_active     = $this->input->post('group_active') ? 1: 0;			
			$check_group_active = $group_active ==1  ? 'checked' : '';	
		
			
			if($group_name == ''){				
				$code_msg = '0';
			}
			if($group_level==0){				
				$code_msg .= ',1';
			}
			
			if($grant_to_frame == ''){				
				$code_msg .= ',2';
			}
						
			if($code_msg==""){				
				$this->db->select_max('group_order', 'max_order');
				$query = $this->db->get('system_user_group');
				$row   = $query->row();
				$max_order = $row->max_order + 1;
				$data_group = array(				
				   'group_name'	 		 => $group_name,
				   'group_description' 	  => $group_description,
				   'group_order' 			=> $max_order,
				   'group_level' 			=> $group_level,
				   'group_active'	 	   => $group_active,
				   'group_permission'	   => $grant_to_frame,
				   				   				   
				);			
				if($this->db->insert('system_user_group', $data_group)){
					$group_name 			= '';
					$grant_to_frame 		= '';					
					$group_description	 = '';	
					$group_level 		   = '';				
					$code_msg = '3';
				}
			}
		}
				
				
			
		
		/* get data return */
		$f_group = array(
			'group_name'	 		=> $group_name,
			'group_description'  	 => $group_description,
			'group_level' 		   => $group_level,
			'check_group_active' 	=> $check_group_active,			
			'code_msg'	   		  => $code_msg,
			'grant_arr'	 		 => $grant_arr,
			'frame_arr'	  		 => $frame_arr
		);		
		return $f_group;		
	}
	
	
	public function edit(){
		$code_msg = '';	
		$grant_to_frame = '';
		$frame_arr = $this->get_frames();		
		if($this->input->server('REQUEST_METHOD')=='GET'){
			$group_id = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;					
			$this->db->select('*');
			$this->db->from('system_user_group');
			$this->db->where('group_id',$group_id);
			$query = $this->db->get();
			$row = $query->row();
			
			$group_id		 	 = $row->group_id;
			$group_name 	   	   = $row->group_name;
			$group_description	= $row->group_description;			
			$group_level		  = $row->group_level;			
			$check_group_active   = $row->group_active==1 ? 'checked' : '';
			/* Begin get permissions of member */
			$grant_arr = explode(",",$row->group_permission);
			/* End get permissions of member */						
		}else{		
			$id			   	  = $this->input->post('id');
			$group_id		 	= $id;
			$group_name 	   	  = $this->input->post('group_name');
			$group_description   = $this->input->post('group_description');				
			
			for($i=1; $i<=count($frame_arr); $i++){			
				$frame_code = $frame_arr[$i]["frame_code"]."11";			
				$grant_to_frame .= isset($_POST[$frame_code]) ?  $frame_arr[$i]["frame_code"]."add," : "";
				
				$frame_code = $frame_arr[$i]["frame_code"]."12";			
				$grant_to_frame .= isset($_POST[$frame_code]) ?  $frame_arr[$i]["frame_code"]."edit," : "";
				
				$frame_code = $frame_arr[$i]["frame_code"]."13";			
				$grant_to_frame .= isset($_POST[$frame_code]) ?  $frame_arr[$i]["frame_code"]."del," : "";
				
				$frame_code = $frame_arr[$i]["frame_code"]."14";			
				$grant_to_frame .= isset($_POST[$frame_code]) ?  $frame_arr[$i]["frame_code"]."," : "";
				
				$frame_code = $frame_arr[$i]["frame_code"]."15";			
				$grant_to_frame .= isset($_POST[$frame_code]) ?  $frame_arr[$i]["frame_code"]."app," : "";
			}
			$grant_arr = explode(",",$grant_to_frame);
			
			$group_name 	   = $this->input->post('group_name');
			$group_level 	  = $this->input->post('group_level') ? $this->input->post('group_level') : 0;			
			$group_active     = $this->input->post('group_active') ? 1: 0;
			$check_group_active = $group_active ==1  ? 'checked' : '';	
		
			
			if($group_name == ''){				
				$code_msg = '0';
			}
			if($group_level==0){				
				$code_msg .= ',1';
			}
			
			if($grant_to_frame == ''){				
				$code_msg .= ',2';
			}		
								
			if($code_msg==""){
				$data_group = array(				
				   'group_name'	 		 => $group_name,
				   'group_description' 	  => $group_description,				   
				   'group_level' 			=> $group_level,
				   'group_active'	 	   => $group_active,
				   'group_permission'	   => $grant_to_frame,
				   				   				   
				);	
				$this->db->where('group_id', $group_id);					
				if($this->db->update('system_user_group', $data_group)){					
					$code_msg = '3';																
				}
			}
		}
		
		/* get data return */
		$f_group = array(
			'group_id'		  	  => $group_id,
			'group_name'	 		=> $group_name,
			'group_description'  	 => $group_description,
			'group_level' 		   => $group_level,
			'check_group_active' 	=> $check_group_active,			
			'code_msg'	   		  => $code_msg,
			'grant_arr'	 		 => $grant_arr,
			'frame_arr'	  		 => $frame_arr
		);		
		return $f_group;	
	}
	
	
	public function del(){
		$code_msg = '';		
		if($this->input->post('check_del')){		
			$array_id = implode(',',$this->input->post('check_del'));
			$delete_query = "DELETE FROM system_user_group WHERE group_id IN(".$array_id.")";
			if($this->db->query($delete_query)){
				$code_msg = 0;
				return $code_msg;		
			}
		}else{
			$code_msg = 0;
			return $code_msg;
		}		
	}
	
	private function get_select_group($group_description_crr=''){
		$group_arr = array();
		
		$this->db->select('group_description');
		$this->db->from('system_user_group');	
		$this->db->order_by('group_order','asc');
		$query = $this->db->get();
		
		foreach($query->result() as $row){
			$group_arr[$row->group_description] = $row->group_description;
		}			
				
		$group_choose = '';		
		$group_description = array_values($this->config->item('modules_admin'));
		
		for($i=0; $i<count($group_description); $i++){	
			if(!isset($group_arr[$group_description[$i]])){
				if($group_description[$i] == $group_description_crr){					
					$group_choose .= '<option value="'.$group_description[$i].'" selected="selected">'.$group_description[$i].'</option>';
				}else{					
					$group_choose .= '<option value="'.$group_description[$i].'" >'.$group_description[$i].'</option>';
				}
			}
		}			
		return $group_choose;		
	}
	
	private function get_frames(){
		$f_arr = array();
		$this->db->select('frame_code, frame_name');
		$this->db->from('system_frame');	
		$this->db->order_by('frame_order','asc');
		$query = $this->db->get();
		$i = 0;
		foreach($query->result() as $row){
			$i = $i + 1;
			$f_arr[$i]['frame_code'] = $row->frame_code;
			$f_arr[$i]['frame_name'] = $row->frame_name;
		}
		return $f_arr;		
	}
	
	public function check_id($tbl,$colid,$id){
		$this->db->select($colid);
		$this->db->from($tbl);
		$this->db->where($colid,$id);
		$query = $this->db->get();
		if($query->num_rows()==0){
			return false;
		}else{
			return true;
		}
	}
	
}
