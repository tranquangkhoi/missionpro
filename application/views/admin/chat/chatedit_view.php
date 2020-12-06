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
                        <a class="btn btn-primary" href="javascript:frm_submit('frm_chatedit');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>
            <div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Cập nhập nick hỗ trợ trực tuyến (Yahoo / Skype)</strong></div>
			<div class="panel-body">            	
                <form enctype="multipart/form-data" name="frm_chatedit" id="frm_chatedit" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_chat['chat_id'];?>' method="POST">
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
						<div class="form-group">
							<label for="chat_nick" class="control-label">Nick chat : </label>
                            <input type="text" class="form-control" id="chat_nick" name="chat_nick" maxlength="128" value="<?php echo $f_chat['chat_nick'];?>">
						</div>
					</div>					
				</div>
                
                <div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="form-group">
							<label for="chat_name" class="control-label">Tên gọi của Nick : </label>
                            <input type="text" class="form-control" id="chat_name" name="chat_name" maxlength="128" value="<?php echo $f_chat['chat_name'];?>">
						</div>
					</div>					
				</div>
                
                
                
                <div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="form-group">
							<label for="chat_type" class="control-label">Kiểu tài khoản : </label> (Yahoo: điền 0 - Skype: điền 1)
                            <input type="text" id="chat_type" name="chat_type" class="form-control" maxlength="10" value="<?php echo $f_chat['chat_type'];?>">
                                    
						</div>
					</div>
				</div>
                <input name="id" type="hidden" id="id" value="<?php echo $f_chat['chat_id'];?>" />
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