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
              <a href="#">Đơn hàng</a>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý thành viên</a>
            </li>            
            <li class="active">
              <a href="#">Cập nhật thông tin</a>
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
      		<div class="row">  			
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('memberedit');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>
			<div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Cập nhật</strong></div>
			<div class="panel-body">            	
                <form name="memberedit" id="memberedit" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_member['member_id'];?>' method="POST">
				<?php if(!empty($msg)){?>
					<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>
				<?php
				}
				?>
                
               <div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h3 style="border-bottom:#ddd solid 1px; margin-left:-100px; padding-bottom:10px;">1. Thông tin đăng nhập</h3>
                        <div class="form-group">
							<label for="member_email" class="control-label">Email</label>
                            <input type="text" class="form-control" id="member_email" name="member_email" maxlength="128" value="<?php echo $f_member['member_email'];?>">
						</div>
                        <div class="form-group">
							<label for="member_password" class="control-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="member_password" name="member_password" maxlength="128" value="<?php echo $f_member['member_password'];?>">
						</div>

                        <h3 style="border-bottom:#ddd solid 1px; margin-left:-100px; padding-bottom:10px;">2. Thông tin liên hệ</h3>
                        <div class="form-group">
							<label for="member_fullname" class="control-label">Họ và tên</label>
                            <input type="text" class="form-control" id="member_fullname" name="member_fullname" maxlength="128" value="<?php echo $f_member['member_fullname'];?>">
						</div>
                        <div class="form-group">
							<label for="member_fullname" class="control-label">Giới tính</label>
                            <input type="radio"  id="member_sex" name="member_sex" <?php echo $f_member['member_sex']=='0' ? 'checked' : '';?> value="0" > Nam &nbsp;&nbsp;&nbsp;
                            <input type="radio"  id="member_sex" name="member_sex"  <?php echo $f_member['member_sex']=='1' ? 'checked' : '';?> value="1" > Nữ                                                     
						</div>
                        <div class="form-group">
							<label for="member_birth" class="control-label">Ngày sinh</label>
                            <input type="text" class="form-control" id="member_birth" name="member_birth" maxlength="128" value="<?php echo $f_member['member_birth'];?>">
						</div>
                        <div class="form-group">
							<label for="member_tel" class="control-label">Điện thoại</label>
                            <input type="text" class="form-control" id="member_tel" name="member_tel" maxlength="128" value="<?php echo $f_member['member_tel'];?>">
						</div>
                        <div class="form-group">
							<label for="member_province" class="control-label">Tỉnh/thành</label>
                            <select name="province_id" class="form-control">
                                    <option value="0">Chọn tỉnh/thành...</option>                                                                    
                                    <?php echo $f_member['province_choose'];?>                                                                   
							</select>
						</div>
                          <div class="form-group">
							<label for="member_address" class="control-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="member_address" name="member_address" maxlength="128" value="<?php echo $f_member['member_address'];?>">
						</div>
                        
					</div>
				</div>
                	<input name="id" type="hidden" id="id" value="<?php echo $f_member['member_id'];?>" />                              
                    <input name="member_password_old" type="hidden" id="member_password_old" value="<?php echo $f_member['member_password_old'];?>" />
                    <input name="member_email_old" type="hidden" id="member_email_old" value="<?php echo $f_member['member_email_old'];?>" />                              
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