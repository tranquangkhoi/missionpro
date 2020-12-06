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
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý người sử dụng</a>
            </li>            
            <li class="active">
              	Cập nhật hồ sơ
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
       	<div class="row">  			
			<div class="col-md-12">
				<div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
					<a class="btn btn-primary" href="javascript:frm_submit('frmEditUser');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                    <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
				</div>
			</div>
		</div>
		<div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Cập nhật thông tin</strong></div>
				<div class="panel-body">
                	<form name="frmEditUser" id="frmEditUser" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_user['userid'];?>' method="POST" role="form">
					<?php if(!empty($msg)){?>
                        <div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <font color="#FF0000"><?php echo $msg;?></font>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label for="user_fullname" class="col-sm-4 control-label">Họ và tên:</label>
                        <div class="col-sm-5">                            	
                            <input type="text" class="form-control" id="user_fullname" name="user_fullname" placeholder="Nhập họ tên nhân viên quản trị" maxlength="128" value="<?php echo $f_user['user_fullname'];?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="user_name" class="col-sm-4 control-label">Tên đăng nhập:</label>
                        <div class="col-sm-5">                            	
                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Nhập họ tên nhân viên quản trị" maxlength="128" value="<?php echo $f_user['user_name'];?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="oldpass" class="col-sm-4 control-label">Mật khẩu cũ:</label>
                        <div class="col-sm-5">                            	
                            <input type="password" class="form-control" id="oldpass" name="oldpass" placeholder="Gõ lại mật khẩu cũ" maxlength="128" value="<?php echo $f_user['oldpass'];?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="user_password" class="col-sm-4 control-label">Mật khẩu:</label>
                        <div class="col-sm-5">                            	
                            <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Đặt mật khẩu đăng nhập" maxlength="128" value="<?php echo $f_user['user_password'];?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="repass" class="col-sm-4 control-label">Xác nhận mật khẩu:</label>
                        <div class="col-sm-5">                            	
                            <input type="password" class="form-control" id="repass" name="repass" placeholder="Gõ lại mật khẩu để xác nhận" maxlength="128" value="<?php echo $f_user['repass'];?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="repass" class="col-sm-4 control-label">Nhóm quản trị:</label>
                        <div class="col-sm-5">                            	
                            <select class="form-control" id="group_id" name="group_id">
								<?php echo $f_user['group_choose'];?>
                            </select>
                        </div>
                    </div>                  
                    
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-5">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" id="user_active" name="user_active" <?php echo $f_user['check_user_active'];?>> <strong>Kích hoạt tài khoản</strong>
                            </label>
                          </div>
                        </div>
                    </div>
                    <input name="id" type="hidden" id="id" value="<?php echo $f_user['userid'];?>" />
					<input name="user_super" type="hidden" id="user_super" value="<?php echo $f_user['user_super'];?>" />
                    <input name="passtemp" type="hidden" id="passtemp" value="<?php echo $f_user['passtemp'];?>" />
                    <input name="user_temp" type="hidden" id="user_temp" value="<?php echo $f_user['user_temp'];?>" />
                   </form> 
            	</div>
                 
            </div>
                            
       
      </div>
      <div id="push"></div>
    </div>
    <!-- End page Content-->

    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->