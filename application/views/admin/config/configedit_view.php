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
              <a href="#">Hệ thống & Tiện ích</a>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý Online Support</a>
            </li>            
            <li class="active">
              <a href="#">Cập nhật thông tin hỗ trợ trực tuyến</a>
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
			<div class="row">  			
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('frm_configedit');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>
            <div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Cập nhập nick hỗ trợ trực tuyến (Yahoo / Skype)</strong></div>
			<div class="panel-body">            	
                <form enctype="multipart/form-data" name="frm_configedit" id="frm_configedit" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_config['config_id'];?>' method="POST">
				<?php if(!empty($msg)){?>
					<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>
				<?php
				}
				?>
                <legend>1. Cấu hình cho Web</legend>				
                <div class="form-group">
					<label for="company_name" class="col-md-3 control-label">Tên công ty: </label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $f_config['company_name'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="company_address" class="col-md-3 control-label">Địa chỉ: </label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="company_address" name="company_address" value="<?php echo $f_config['company_address'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="company_tel" class="col-md-3 control-label">Điện thoại: </label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="company_tel" name="company_tel" value="<?php echo $f_config['company_tel'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="company_hotline" class="col-md-3 control-label">Hotline: </label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="company_hotline" name="company_hotline" value="<?php echo $f_config['company_hotline'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="company_fax" class="col-md-3 control-label">Fax: </label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="company_fax" name="company_fax" value="<?php echo $f_config['company_fax'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="company_email" class="col-md-3 control-label">Email: </label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="company_email" name="company_email" value="<?php echo $f_config['company_email'];?>">
					</div>
				</div>
                
				
                <div class="form-group">
					<label for="config_address_footer" class="col-md-3 control-label">Địa chỉ cuối trang Web: </label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="config_address_footer" name="config_address_footer" value="<?php echo $f_config['config_address_footer'];?>">
					</div>
				</div>
                <legend>2. Cấu hình gửi mail</legend>
                <div class="form-group">
					<label for="config_mail_protocol" class="col-md-3 control-label">Giao thức gửi (điền là mail or smtp):</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="config_mail_protocol" name="config_mail_protocol" value="<?php echo $f_config['config_mail_protocol'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="config_mail_type" class="col-md-3 control-label">Định dạng(điền text or html):</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="config_mail_type" name="config_mail_type" value="<?php echo $f_config['config_mail_type'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="config_smtp_host" class="col-md-3 control-label">SMTP Host:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="config_smtp_host" name="config_smtp_host" value="<?php echo $f_config['config_smtp_host'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="config_smtp_user" class="col-md-3 control-label">SMTP User:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="config_smtp_user" name="config_smtp_user" value="<?php echo $f_config['config_smtp_user'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="config_smtp_pass" class="col-md-3 control-label">SMTP Pass:</label>
					<div class="col-md-6">
						<input type="password" class="form-control" id="config_smtp_pass" name="config_smtp_pass" value="<?php echo $f_config['config_smtp_pass'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="config_smtp_port" class="col-md-3 control-label">SMTP Port:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="config_smtp_port" name="config_smtp_port" value="<?php echo $f_config['config_smtp_port'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="config_smtp_timeout" class="col-md-3 control-label">SMTP Timeout:</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="config_smtp_timeout" name="config_smtp_timeout" value="<?php echo $f_config['config_smtp_timeout'];?>">
					</div>
				</div>
                <input name="id" type="hidden" id="id" value="<?php echo $f_config['config_id'];?>" />
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