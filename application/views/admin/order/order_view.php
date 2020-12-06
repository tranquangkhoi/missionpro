	<?php echo $header; ?>	
    <script>
		function ChangeColor(id,color){			
			document.getElementById('status_color_'+id).style.backgroundColor=color;						
			document.getElementById('update_status_color_'+id).innerHTML = "<img src=<?php echo base_url().$this->config->item('index_page_add');?>public/admin/img/awaiting.gif>...";
			
			$.post("<?php echo base_url().$this->config->item('index_page_add');?>admin/action/order_status",{
				order_id : id,						
				order_status : color                   
			},function(data){
			   document.getElementById('update_status_color_'+id).innerHTML = "<strong>"+data+"</strong>";
			});	
			
		}
		
		function UpdateShip(id){
			document.getElementById('update_status_'+id).innerHTML = "<img src=<?php echo base_url().$this->config->item('index_page_add');?>public/admin/img/awaiting.gif>...";
			$.post("<?php echo base_url().$this->config->item('index_page_add');?>admin/action/update_ship",{
						order_id : id
						, order_ship : document.getElementById('ship_'+id).value						
				   },function(data){
					   document.getElementById('update_status_'+id).innerHTML = "<input class=\"btn btn-primary\" type=\"button\" value=\"Update\" onclick=\"UpdateShip('"+id+"')\"> <br/><strong>"+data+"</strong>";
			});
		}
	</script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/admin/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />        
    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin Menubar-->
      <?php echo $menubar; ?>
      <!-- End Menubar-->
      
      <!-- Begin Path -->
     <div id="breadcrumb" class="container" style="padding-top:70px;">
          <ol class="breadcrumb">
            <li>
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/welcome">Home</a>
            </li>
            <li>
              <a href="#">Đơn hàng</a>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Danh sách đơn hàng</a>
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
         

       <?php 
			if(!empty($msg)){
			?>
            <div class="row">
                <div class="col-md-4">
                	<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
                       	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>                    
                </div>
            </div>
		<?php
			}
		?>
       <form id="frm_orders" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/del' method="POST" style="display:inline;">
        <div class="row">
  			<div class="col-md-4">
            	 <div class="input-group" style="margin-bottom:10px; margin-top:-10px;">
					<input  class="form-control noEnterSubmit" name="q" type="text"  placeholder="Nhập thông tin cần tìm..." >                          
                          <span style="cursor:pointer;" class="input-group-addon" onclick="frm_submit_action('frm_orders','<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/filter')" >
                          	<span class="glyphicon glyphicon-search"></span>
                          </span>
                 </div>
            </div>
            <div class="col-md-8">
            	<div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                    <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>"><span class="glyphicon glyphicon-list"></span> Xem</a>                    
                    <a href="#" class="group_del btn btn-primary" role="button" data-toggle="modal"><span class="glyphicon glyphicon-minus"></span> Xóa</a>            
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
       	
        <?php
			$tab_one 	= $this->session->userdata('status')==0 ? 'class="active"' : '';
			$tab_two 	= $this->session->userdata('status')==1 ? 'class="active"' : '';
			$tab_three	= $this->session->userdata('status')==2 ? 'class="active"' : '';
			$tab_four 	= $this->session->userdata('status')==3 ? 'class="active"' : '';
			$tab_five 	= $this->session->userdata('status')==4 ? 'class="active"' : '';
			?>
            <ul class="nav nav-tabs" role="tablist">
              <li <?php echo $tab_one;?>><a href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2).'/status/0';?>">Tất cả trạng thái</a></li>
              <li <?php echo $tab_two;?>><a href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2).'/status/1';?>">Chưa xem</a></li>
              <li <?php echo $tab_three;?>><a href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2).'/status/2';?>">Đang xử lý</a></li>
              <li <?php echo $tab_four;?>><a href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2).'/status/3';?>">Đã hoàn thành</a></li>
              <li <?php echo $tab_five;?>><a href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2).'/status/4';?>">Đơn đã hủy</a></li>
            </ul>
            	
            <?php
			$st_arr = array();
			$status_color = array();
			
			$st_arr[0]['status_code'] = '0'; // chưa xem
			$st_arr[1]['status_code'] = '1'; // Đang xử lý
			$st_arr[2]['status_code'] = '2'; // Đã hoàn thành
			$st_arr[3]['status_code'] = '3'; // Hủy đơn
			
			$st_arr[0]['status_name'] = 'Chưa xem'; // chưa xem
			$st_arr[1]['status_name'] = 'Đang xử lý'; // san hang
			$st_arr[2]['status_name'] = 'Đã hoàn thành'; // Đã hoàn thành		
			$st_arr[3]['status_name'] = 'Hủy đơn'; // chay hang			
			
			$st_arr[0]['status_color'] = '#f2eaaf'; // chưa xem
			$st_arr[1]['status_color'] = '#c4f2e9'; // Đang xử lý
			$st_arr[2]['status_color'] = '#0084cc'; // Đã hoàn thành
			$st_arr[3]['status_color'] = '#333333'; // chay hang
			
			$status_color[0] = '#f2eaaf'; // chưa xem
			$status_color[1] = '#c4f2e9'; // Đang xử lý
			$status_color[2] = '#0084cc'; // Đã hoàn thành
			$status_color[3] = '#333333'; // Hủy đơn
		
			  
			function get_select_status($status_id, $st_arr){
				  $str = '';
				  foreach($st_arr as $item){					  
					  if($item['status_code']==$status_id){							
							$str .= "<option value=".$item['status_color']." selected=\"selected\">".$item['status_name']."</option>";  
					  }else{
						  $str .= "<option value=".$item['status_color']." >".$item['status_name']."</option>";  						  
					  }
				  }
				  return $str;  				  
			  }
			?>
            
            <table class="table table-bordered table-hover" style="margin-top:2px;">
              <thead>
                <tr style="background-color:#BFB;">
                  <th width="5%" style="text-align:center;"><input type="checkbox" class="check_all"></th>
                  <th width="7%"><strong>Mã HĐ</strong></th>
                  <th width="28%"><strong>Người đặt hàng</strong></th>
                  <th width="28%"><strong>Người nhận hàng</strong></th>
                  <th width="8%"><strong>Phí Ship</strong></th>
                  <th width="12%"><strong>Trạng thái</strong></th>
                  <th width="12%" style="text-align:center;"><strong>Chức năng</strong></th>                
                </tr>
              </thead>
              <tbody>              
              <?php			  
			  foreach($order_items as $item){
			  ?>  
                <tr>
                    <td style="text-align:center;"><input type="checkbox"  class="check_one" name="check_del[]" value="<?php echo $item['order_id'];?>"></td>
                    <td  style="text-align:center;"><?php echo $item['order_id'];?></td>                    
                    <td>
						<p><strong>Họ và tên:</strong> <?php echo $item['order_fullname'];?></p>
                        <p><strong>Điện thoại:</strong> <?php echo $item['order_tel'];?></p>
                        <p><strong>Địa chỉ:</strong> <?php echo $item['order_address'];?></p>
                        <p><strong>Ngày mua:</strong> <?php echo $this->back->fix_date('H:i A, d/m/Y',$item['order_date']);?></p>
                        
                    </td>
                    <td>
						<p><strong>Họ và tên:</strong> <?php echo $item['order_fullname_to']<>"" ? $item['order_fullname_to'] : $item['order_fullname'];?></p>
                        <p><strong>Điện thoại:</strong> <?php echo $item['order_tel_to']<>"" ? $item['order_tel_to'] : $item['order_tel'];?></p>
                        <p><strong>Địa chỉ:</strong> <?php echo $item['order_address_to']<>"" ? $item['order_address_to'] : $item['order_address'];?></p>
                        <p><strong>Ngày mua:</strong> <?php echo $this->back->fix_date('H:i A, d/m/Y',$item['order_date']);?></p>
                    </td>
                    <td style="text-align:center;">                    	
						<div style="margin-bottom:10px;"><input class="form-control fnumber" type="text" id="ship_<?php echo $item['order_id'];?>" value="<?php echo number_format($item['order_ship'],0);?>" /></div>						
                        <div id="update_status_<?php echo $item['order_id'];?>">
                        	<input class="btn btn-primary" type="button" value="Update" onclick="UpdateShip('<?php echo $item['order_id'];?>')" role="button">
 						</div>
                    </td>                                                          
                   <td style="text-align:center; background-color:<?php echo @$status_color[$item['order_status']];?>" id="status_color_<?php echo $item['order_id'];?>">
						<select style="font-size:12px; margin:0px; padding:0px;" id="status_<?php echo $item['order_status'];?>" class="form-control" onchange="ChangeColor(<?php echo $item['order_id'];?>,this.value)">
  	                    	<?php echo get_select_status($item['order_status'], $st_arr);?>
	  				    </select>
                        <div id="update_status_color_<?php echo $item['order_id'];?>"></div>
                    </td> 
                    <td style="text-align:center;">
                     	<a class="fancybox fancybox.ajax" href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/view/<?php echo $item['order_id'];?>"><span class="glyphicon glyphicon-eye-open"></span></a>   
                        <br /><a href="<?php echo base_url();?>admin/prints/inphieu/<?php echo $item['order_id'];?>" class="btn btn-primary" role="button" style="margin:0px; padding:3px;" target="_blank"><span class="glyphicon glyphicon-print"></span> In Phiếu</a>                                       
                    </td>
                </tr>
              <?php
			  }
			  ?>          
                
              </tbody>
            </table>
            
            <?php echo $pagination;?>  
            </form>     
                

       
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Cảnh báo</h4>
              </div>
              <div class="modal-body">
                    <p class="error-text">Bạn có chắc chắn muốn xóa không?</p>
                    <p class="error-text">Dữ liệu đã xóa sẽ không khôi phục lại được !!!</p>
              </div>             
              <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" onclick="frm_submit('frm_orders')">Xóa</button> 
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Thoát</button>  
              </div>
            </div>
          </div>
        </div>
        
        
      </div>
      <div id="push"></div>
    </div>
     	  

    

    <!-- End page Content-->
	
    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->
    