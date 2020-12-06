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
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý Modules chương trình</a>
            </li>            
            <li class="active">
              <a href="#">Cập nhật thông tin Module</a>
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
      		<div class="row">  			
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('frm_frameedit');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div> 
            <div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Cập nhật thông tin</strong></div>
			<div class="panel-body">
            	<form name="frm_frameedit" id="frm_frameedit" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_frame['frame_id'];?>' method="POST" role="form">
				<?php if(!empty($msg)){?>
					<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>
				<?php
				}
				?>
                <div class="form-group">
					<label for="frame_name" class="col-sm-4 control-label">Tên Modules:</label>
					<div class="col-sm-5">                            	
						<input type="text" class="form-control" id="frame_name" name="frame_name" placeholder="Nhập tên module" maxlength="128" value="<?php echo $f_frame['frame_name'];?>">
					</div>
				</div>
                
                <div class="form-group">
					<label for="frame_code" class="col-sm-4 control-label">Mã Modules:</label>
					<div class="col-sm-5">                            	
						<input type="text" id="frame_code" name="frame_code" class="form-control" maxlength="32" value="<?php echo $f_frame['frame_code'];?>" disabled="disabled">
                        <input type="hidden" id="frame_hide_code" name="frame_hide_code" class="form-control" maxlength="32" value="<?php echo $f_frame['frame_code'];?>">
					</div>
				</div>
                <input name="id" type="hidden" id="id" value="<?php echo $f_frame['frame_id'];?>" />
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