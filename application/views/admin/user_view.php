	<?php echo $header; ?>

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
              <a href="#">Hệ thống</a>
            </li>
            <li class="active">
              	Quản lý người sử dụng
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
                <div class="col-md-12">
                	<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
                       	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>                    
                </div>
            </div>
			<?php
			}
			?>
                   
        <div class="row">  			
            <div class="col-md-12">
            	<div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                    <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>"><span class="glyphicon glyphicon-list"></span> Xem</a>
                    <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>                     
                </div>
            </div>
        </div>    
		
        <div style="clear:both;"></div>
       
            <table class="table table-bordered table-hover">
              <thead>
                <tr style="background-color:#BFB;">
                  <th width="6%" style="text-align:center;">STT</th>                  
                  <th width="30%"><strong>Họ và tên</strong></th>
                  <th width="20%"><strong>Tên đăng nhập</strong></th>
                  <th width="20%"><strong>Thời gian đăng nhập</strong></th>
                  <th width="14%"><strong>Địa chỉ IP</strong></th>
                  <th width="10%"><strong>Chức năng</strong></th>
                </tr>
              </thead>
              <tbody>
              <?php
			  $i = 0;
			  foreach($user_items as $item){
				  $i = $i + 1;
				  $str_super = $item['user_super']==1 ? ' <span style="color:red;">(Super User)</span>' : '';
			  ?>  
                <tr>
                  <td style="text-align:center;"><?php echo $i;?></td>
                    <td><?php echo $item['user_fullname'].$str_super;?></td>
                    <td><?php echo $item['user_name'];?></td>
                  	<td><?php echo $this->back->fix_date('H:i:s A, d/m/Y',$item['user_logon']);?></td>
                    <td><?php echo $item['user_ip'];?></td>
                    <td style="text-align:center;">
                     	<a title="Sửa dữ liệu" href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $item['userid'];?>"><span class="glyphicon glyphicon-pencil"></span></a>
                     	<a title="Xóa dữ liệu" href="#" class="btn_del" data-id="<?php echo $item['userid'];?>" role="button" data-toggle="modal"><span class="glyphicon glyphicon-remove"></span></a>                      
                    </td>
                </tr>
              <?php
			  }
			  ?>          
                
              </tbody>
            </table>            
       
        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <form id="frm_del_one" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/del' method="POST">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Cảnh báo</h4>
              </div>
              <div class="modal-body">
                    <p class="error-text">Bạn có chắc chắn muốn xóa tài khoản quản trị này không ?</p>                  
              </div>             
              <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" onclick="frm_submit('frm_del_one')">Xóa</button> 
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Thoát</button>
                    <input type="hidden" name="del_userid" id="del_userid" value=""/>  
              </div>
            </div>
          </div>
          </form>
        </div>        
       
      </div>
      <div id="push"></div>
    </div>
    <!-- End page Content-->
	
    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->
    