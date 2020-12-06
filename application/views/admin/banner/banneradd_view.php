	<?php echo $header; ?>	
	<script src="/editor/scripts/innovaeditor.js"></script>

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
              <a href="#">Hệ thống & tiện ích</a>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý Banner</a>
            </li>            
            <li class="active">
              <a href="#">Thêm Banner</a>
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
      
      		<div class="row">  			
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('frm_banneradd');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>           
            <div style="clear:both;"></div>
            <div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Thêm mới Banner</strong></div>
			<div class="panel-body">
                <form enctype="multipart/form-data" name="frm_banneradd" id="frm_banneradd" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/add' method="POST">
				<?php if(!empty($msg)){?>
					<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>
				<?php
				}
				?>
                <div id="myTabContent" class="tab-content">
					
                    <!-- begin body tab common -->
                    <div class="tab-pane fade in active" id="common" style="padding-top:20px;">
						<div class="row">
                        	<div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                    <label for="bannercate_id" class="control-label">Thuộc danh mục:</label>
									<select id="bannercate_id" name="bannercate_id" class="form-control">
                                            <?php echo $f_banner['bannercate_choose'];?>
                                    </select>
                                </div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="form-group">
                                    <label for="banner_link" class="control-label">Link:</label>
									<input type="text" id="banner_link" name="banner_link" class="form-control" maxlength="220" value="<?php echo $f_banner['banner_link'];?>">
                                </div>
							</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                    <label for="banner_image" class="control-label">Ảnh Banner:</label>
                                    <input type="file" id="banner_image" name="banner_image">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">                                                    	
                            <div class="col-md-7 col-md-offset-2">
	                            <div class="form-group">
    		                    	<label for="product_review" class="control-label">Thời gian đăng: <span style="font-weight:normal;">(dd/mm/yyyy) - (Giờ:phút:giây)</span></label>                            
            		                <div class="form-inline">
                    		        	<input type="text" id="banner_date" name="banner_date" class="form-control" maxlength="50" value="<?php echo $f_banner['banner_date'];?>" > (dd/mm/yyyy)
                                    	<input type="text" id="banner_time" name="banner_time" class="form-control" maxlength="50" value="<?php echo $f_banner['banner_time'];?>" > (Giờ:phút:giây)
		                            </div>
        	                	</div>
                            </div>
                        </div>                                                                           
						<!-- -->                                
					</div>
                    <!-- end body tab common -->
                       
				</div>
                                              	
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