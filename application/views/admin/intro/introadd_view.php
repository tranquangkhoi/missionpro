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
              <a href="#">Thông tin chung</a>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý bài viết</a>
            </li>            
            <li class="active">
              <a href="#">Thêm bài viết</a>
            </li>
          </ol>
      </div>    
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
      		<div class="row">  			
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('frm_introadd');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>           
            <div style="clear:both;"></div>          
            
            
            
		<div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Thêm mới bản tin</strong></div>
			<div class="panel-body">
                <form enctype="multipart/form-data" name="frm_introadd" id="frm_introadd" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/add' method="POST">
				<?php if(!empty($msg)){?>
					<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>
				<?php
				}
				?>
                <ul id="myTab" class="nav nav-tabs">
					<li class="active"><a href="#common" data-toggle="tab">Thông tin chung</a></li>
                    <li><a href="#intro_vn" data-toggle="tab">Chi tiết bài viết</a> </li>                  
				</ul>
                <div id="myTabContent" class="tab-content">
					<!-- begin body tab common -->
                    <div class="tab-pane fade in active" id="common" style="padding-top:20px;">
						<div class="row">
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="introcate_id" class="control-label">Thuộc danh mục:</label>
									<select id="introcate_id" name="introcate_id" class="form-control">
                                            <?php echo $f_intro['introcate_choose'];?>
                                    </select>
                                </div>
							</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="intro_image" class="control-label">Ảnh minh họa:</label>
                                    <input type="file" class="form-control" id="intro_image" name="intro_image">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">                                                    	
                            <div class="col-md-12">
	                            <div class="form-group">
    		                    	<label for="product_review" class="control-label">Thời gian đăng: <span style="font-weight:normal;">(dd/mm/yyyy) - (Giờ:phút:giây)</span></label>                            
            		                <div class="form-inline">
                    		        	<input type="text" id="intro_date" name="intro_date" class="form-control" maxlength="50" value="<?php echo $f_intro['intro_date'];?>" > (dd/mm/yyyy)
                                    	<input type="text" id="intro_time" name="intro_time" class="form-control" maxlength="50" value="<?php echo $f_intro['intro_time'];?>" > (Giờ:phút:giây)
		                            </div>
        	                	</div>
                            </div>
                        </div>                                                                           
						<!-- -->                                
					</div>
                    <!-- end body tab common -->
                    
                    <!-- begin body tab product_vn -->
                    <div class="tab-pane fade" id="intro_vn" style="padding-top:20px;">
						<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="intro_title" class="control-label">Tên bản tin:</label>
                                    <input type="text" id="intro_title" name="intro_title" class="form-control" maxlength="220" value="<?php echo $f_intro['intro_title'];?>">
                                </div>
                            </div>
                        </div>
                        
                        <?php
						echo $f_intro['text_area_review'];
						?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="intro_review">Trích dẫn:</label>
                                    <textarea class="editme form-control" id="intro_review" name="intro_review" rows="3"><?php echo $f_intro['intro_review'];?></textarea>
                                </div>
                            </div>
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="intro_content" class="control-label">Nội dung chi tiết:</label>
									<textarea class="editme form-control" id="intro_content" name="intro_content" rows="3"><?php echo $f_intro['intro_content'];?></textarea>
                                </div>
							</div>
                        </div> 
                        
                        <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="intro_meta_desc" class="control-label">Description Meta SEO:</label>
                                            <textarea class="form-control" id="intro_meta_desc" name="intro_meta_desc" rows="3"><?php echo $f_intro['intro_meta_desc'];?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="intro_meta_key" class="control-label">Keyword Meta SEO:</label>
                                            <textarea  class="form-control" id="intro_meta_key" name="intro_meta_key" rows="3"><?php echo $f_intro['intro_meta_key'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                                      
					</div>
                
                    
                    <!-- end body tab product_en -->
                   
                            <script>
								$('#myTab a').click(function (e) {
									 e.preventDefault();
									 $(this).tab('show');
								})
                            </script>
                                              	
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