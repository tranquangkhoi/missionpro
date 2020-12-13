	<?php echo $header; ?>
	<script>
		function ChangeColor(id,color){			
			document.getElementById('status_color_'+id).style.backgroundColor=color;						
			document.getElementById('update_status_color_'+id).innerHTML = "<img src=<?php echo base_url().$this->config->item('index_page_add');?>public/admin/img/awaiting.gif>...";
			
			$.post("<?php echo base_url().$this->config->item('index_page_add');?>admin/action/update_status",{
				product_id : id,						
				product_status : color                   
			},function(data){
			   document.getElementById('update_status_color_'+id).innerHTML = "<strong>"+data+"</strong>";
			});	
			
		}
		
		function UpdateProductPromotion(id, product_promotion){
			var product_promotion_value = 0;
			if (product_promotion) {
				product_promotion_value = 1;
			}
			
			$.post("<?php echo base_url().$this->config->item('index_page_add');?>admin/action/update_product_promotion",{
				product_id : id,						
				product_promotion : product_promotion_value                
			},function(data){
			   document.getElementById('update_product_promotion_'+id).innerHTML = "<strong>"+data+"</strong>";
			});	
			
		}
    
    function UpdateProductHot(id, product_hot){
      var product_hot_value = 0;
      if (product_hot) {
        product_hot_value = 1;
      }
      
      $.post("<?php echo base_url().$this->config->item('index_page_add');?>admin/action/update_product_hot",{
        product_id : id,            
        product_hot : product_hot_value                
      },function(data){
         document.getElementById('update_product_hot_'+id).innerHTML = "<strong>"+data+"</strong>";
      }); 
      
    }
	</script>
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
              <a href="#">Sản phẩm</a>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý sản phẩm</a>
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
        <?php echo $pagination;?> 
       <form id="frm_products" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/del' method="POST" style="display:inline;"> 
        <div class="row">
        	<div class="col-md-2">            	
            	 <select id="category_id" name="category_id" class="form-control" style="margin-bottom:10px; margin-top:-10px; width:190px;" onchange="frm_submit_action('frm_products','<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/filter')">
                 	<?php echo $category_choose;?>
                 </select>
            </div>
  			<div class="col-md-3">            	 
                 <div class="input-group" style="margin-bottom:10px; margin-top:-10px;">
					      
                          <input  class="form-control noEnterSubmit" name="q" type="text"  placeholder="Nhập thông tin cần tìm..." >                          
                          <span style="cursor:pointer;" class="input-group-addon" onclick="frm_submit_action('frm_products','<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/filter')" >
                          	<span class="glyphicon glyphicon-search"></span>
                          </span>
                 </div>
            </div>
            <div class="col-md-7">
            	<div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                    <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>"><span class="glyphicon glyphicon-list"></span> Xem</a>
                    <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a> 
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
			?>
            <ul class="nav nav-tabs" role="tablist">
              <li <?php echo $tab_one;?>><a href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2).'/status/0';?>">Tất cả sản phẩm</a></li>
              <li <?php echo $tab_two;?>><a href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2).'/status/1';?>">Sẵn hàng</a></li>
              <li <?php echo $tab_three;?>><a href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2).'/status/2';?>">Cháy hàng</a></li>
              <li <?php echo $tab_four;?>><a href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2).'/status/3';?>">Hạ xuống</a></li>
            </ul>
            
       		<?php
			$st_arr = array();
			$status_color = array();
			
			$st_arr[0]['status_code'] = '0'; // ha xuong
			$st_arr[1]['status_code'] = '1'; // san hang
			$st_arr[2]['status_code'] = '2'; // chay hang
			$st_arr[0]['status_name'] = 'Hạ xuống'; // ha xuong
			$st_arr[1]['status_name'] = 'Sẵn hàng'; // san hang
			$st_arr[2]['status_name'] = 'Cháy hàng'; // chay hang			
			$st_arr[0]['status_color'] = '#cccccc'; // ha xuong
			$st_arr[1]['status_color'] = '#c4f2e9'; // san hang
			$st_arr[2]['status_color'] = '#f78181'; // chay hang
			
			$status_color[0] = '#cccccc'; // ha xuong
			$status_color[1] = '#c4f2e9'; // san hang
			$status_color[2] = '#f78181'; // chay hang
		
			  
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
                  <th width="5%" style="text-align:center;"><strong>STT</strong></th>                  
                  <th width="10%" style="text-align:center;"><strong>Ảnh</strong></th>                  
                  <th width="30%"><strong>Tên sản phẩm</strong></th>              
                  <th width="10%" style="text-align:center;"><strong>SP nổi bật</strong></th>
                  <th width="12%"><strong>Trạng thái</strong></th>                   
                  <th width="18%"><strong>Ngày đăng</strong></th>                   
                  <th width="10%" style="text-align:center;"><strong>Chức năng</strong></th>                
                </tr>
              </thead>
              <tbody>              
              <?php			  
			  foreach($product_items as $item){
				  $stt = $stt + 1;
				  $checked = '';
				  if ($item['product_hot'] == 1) $checked = 'checked';		
			  ?>  
                <tr>
                    <td style="text-align:center;"><input type="checkbox" class="check_one" name="check_del[]" value="<?php echo $item['product_id'];?>"></td>
                    <td style="text-align:center;"><?php echo $stt;?></td>
                    <td><img class="img-thumbnail" src="<?php echo base_url();?>/public/upload/product/<?php echo 'medium_'.$item['product_image'];?>" /></td>
                    <td><?php echo $item['product_title'];?></td>
                    <td align="center"><input type="checkbox"  class="check_one" <?php echo $checked?> name="product_hot" value="1" id="product_hot" onchange="UpdateProductHot(<?php echo $item['product_id'];?>, this.checked)">
					<div id="update_product_hot_<?php echo $item['product_id'];?>"></div>
					</td>
                    <td style="text-align:center; background-color:<?php echo @$status_color[$item['product_status']];?>" id="status_color_<?php echo $item['product_id'];?>">
						<select style="font-size:12px; margin:0px; padding:0px;" id="status_<?php echo $item['product_status'];?>" class="form-control" onchange="ChangeColor(<?php echo $item['product_id'];?>,this.value)">
  	                    	<?php echo get_select_status($item['product_status'], $st_arr);?>
	  				    </select>
                        <div id="update_status_color_<?php echo $item['product_id'];?>"></div>
                    </td>                    
                    <td><?php echo $this->back->fix_date('H:i:s A, d/m/Y',$item['product_time_posted']);?></td>                                       
                    <td style="text-align:center;">
                     <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $item['product_id'];?>"><span class="glyphicon glyphicon-pencil"></span></a>                                          
                    </td>
                </tr>
              <?php
			  }
			  ?>          
                
              </tbody>
            </table>
            </form>
            <?php echo $pagination;?>       
                            

       
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
                    <button class="btn btn-danger" data-dismiss="modal" onclick="frm_submit('frm_products')">Xóa</button> 
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
    