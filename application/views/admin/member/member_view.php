	<?php echo $header; ?>	
    <script>
		function Active(id,fld_id,fld_active,tbl_name){
			document.getElementById('active_status_'+id).innerHTML = "<img src=<?php echo base_url().$this->config->item('index_page_add');?>public/admin/img/awaiting.gif>...";
			$.post("<?php echo base_url().$this->config->item('index_page_add');?>admin/action/active",{
						id : id,
						fld_id : fld_id,
						fld_active : fld_active,
						tbl_name : tbl_name												
				   },function(data){
					   document.getElementById('active_status_'+id).innerHTML = data;
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
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý thành viên</a>
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
                    <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>
                    <a href="#" class="group_del btn btn-primary" role="button" data-toggle="modal"><span class="glyphicon glyphicon-minus"></span> Xóa</a>            
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
       
            <table class="table table-bordered table-hover">
              <thead>
                <tr style="background-color:#BFB;">
                  <th width="7%" style="text-align:center;"><input type="checkbox" class="check_all"></th>                  
                  <th width="15%"><strong>Ngày đăng ký</strong></th>
                  <th width="15%"><strong>Họ và tên thành viên</strong></th>
                  <th width="37%"><strong>Địa chỉ</strong></th>
                  <th width="10%"><strong>Điện thoại</strong></th>
                  <td width="7%"  style="text-align:center;"><strong>Active</strong></td>                    
                  <th width="10%" style="text-align:center;"><strong>Chức năng</strong></th>                
                </tr>
              </thead>
              <tbody>              
              <?php			  
			  foreach($member_items as $item){
				  $stt = $stt + 1;
				  $icon_active = $item['member_active']=='0' ? '<span class="glyphicon glyphicon-remove"></span>' : '<span class="glyphicon glyphicon-ok"></span>';				
			  ?>  
                <tr>
                    <td style="text-align:center;"><input type="checkbox"  class="check_one" name="check_del[]" value="<?php echo $item['member_id'];?>"></td>                   
                    <td><?php echo $this->back->fix_date('H:i A, d/m/Y',$item['member_create_time']);?></td>
                    <td><?php echo $item['member_fullname'];?></td>                                       
                    <td><?php echo $item['member_address'];?></td>
                    <td><?php echo $item['member_tel'];?></td>                                       
                     <td width="7%"  style="text-align:center;">
                    	<div id="active_status_<?php echo $item['member_id'];?>">
                        	<a onclick="Active('<?php echo $item['member_id'];?>','member_id','member_active','member')" href="#"><?php echo $icon_active;?></a>
                        </div>
                    </td>
                    <td style="text-align:center;">
                     	<a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $item['member_id'];?>"><span class="glyphicon glyphicon-pencil"></span></a>                                          
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
    