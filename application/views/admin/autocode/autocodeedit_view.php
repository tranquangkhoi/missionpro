	<?php echo $header; ?>	
	<script src="/tinyeditor/tinymce/tinymce.min.js"></script>

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
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý Autocode</a>
            </li>            
            <li class="active">
              <a href="#">Cập nhật</a>
            </li>
          </ol>
      </div> 
           
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
        
            <div class="row">  			
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('frm_autocodeedit');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>          
            <div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Cập nhật</strong></div>
			<div class="panel-body">
                <form enctype="multipart/form-data" name="frm_autocodeedit" id="frm_autocodeedit" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_autocode['autocode_id'];?>' method="POST">
				<?php if(!empty($msg)){?>
					<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>
				<?php
				}
				?>
               <div class="tab-pane fade in active" id="autocode_vn" style="padding-top:20px;">
						<div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="autocode_code" class="control-label">Mã thay thế:</label>
                                    <input type="text" id="autocode_code" name="autocode_code" class="form-control" maxlength="10" value="<?php echo $f_autocode['autocode_code'];?>">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="autocode_review" class="control-label">Mô tả mã thay thế:</label>
                                    <input type="text" id="autocode_review" name="autocode_review" class="form-control" maxlength="220" value="<?php echo $f_autocode['autocode_review'];?>">
                                </div>
                            </div>
                        </div>
                        
                        <?php
						echo $f_autocode['text_area_review'];
						?>
                        <div class="row">
                        	<div class="col-md-12">
                                <div class="form-group">
                                    <label for="autocode_content" class="control-label">Nội dung thay thế:</label>
									<textarea class="editme form-control" id="autocode_content" name="autocode_content" rows="3"><?php echo $f_autocode['autocode_content'];?></textarea>
                                </div>
							</div>
                        </div>                                                       
					</div>
					<input name="id" type="hidden" id="id" value="<?php echo $f_autocode['autocode_id'];?>" />
 				</form>               	
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