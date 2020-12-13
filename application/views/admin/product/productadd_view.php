	<?php echo $header; ?>	
	<script src="<?php echo base_url()?>tinyeditor/tinymce/tinymce.min.js"></script>

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
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý sản phẩm</a>
            </li>            
            <li class="active">
              <a href="#">Thêm mới sản phẩm</a>
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
		<div class="row">  			
			<div class="col-md-12">
				<div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
					<a class="btn btn-primary" href="javascript:frm_submit('frm_productadd');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
					<a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
				</div>
			</div>
		</div>  
            
		<div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Thêm mới</strong></div>
			<div class="panel-body">
            	<form enctype="multipart/form-data" name="frm_productadd" id="frm_productadd" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/add' method="POST">
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
                    <li><a href="#product_vn" data-toggle="tab">Mô tả chi tiết</a> </li>
					<li><a href="#album" data-toggle="tab">Thư viện ảnh</a></li>
				</ul>
                <div id="myTabContent" class="tab-content">
					<!-- begin body tab common -->
                    <div class="tab-pane fade in active" id="common" style="padding-top:20px;">
						<div class="row">
                        	<div class="col-md-3">
                                <div class="form-group">
                                    <label for="gcategory_id" class="control-label">Thuộc danh mục:</label>
									<select id="gcategory_id" name="gcategory_id[]" class="form-control" multiple="multiple">
										<?php echo $f_product['gcategory_choose'];?>
									</select>
                                </div>
							</div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="category_id" class="control-label">Link theo danh mục:</label>
									<select id="category_id" name="category_id" class="form-control">
										<?php echo $f_product['category_choose'];?>
									</select>
                                </div>
							</div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="product_price" class="control-label">Giá bán:</label>
                                    <input type="text" class="form-control" id="product_price" name="product_price"  maxlength="128" value="<?php echo $f_product['product_price'];?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="product_price_d" class="control-label">Giá gốc:</label>
                                    <input type="text" class="form-control" id="product_price_d" name="product_price_d"  maxlength="128" value="<?php echo $f_product['product_price_d'];?>">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_color" class="control-label">Màu sắc:</label>
                                    <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Màu sắc sản phẩm" maxlength="128" value="<?php echo $f_product['product_color'];?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_size" class="control-label">Kích cỡ:</label>
                                    <input type="text" class="form-control" id="product_size" name="product_size" placeholder="Kích cỡ sản phẩm" maxlength="128" value="<?php echo $f_product['product_size'];?>">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">                            
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id" class="control-label">Ảnh sản phẩm:</label>
									<input type="file" class="form-control" id="product_image" name="product_image">
                                </div>
							</div>
                            <div class="col-md-6">
	                            <div class="form-group">
    		                    	<label for="product_review" class="control-label">Thời gian đăng: <span style="font-weight:normal;">(dd/mm/yyyy) - (Giờ:phút:giây)</span></label>                            
            		                <div class="form-inline">
                    		        <input type="text" id="product_date" name="product_date" class="form-control" maxlength="50" value="<?php echo $f_product['product_date'];?>" placeholder="Ngày">
                            		<input type="text" id="product_time" name="product_time" class="form-control" maxlength="50" value="<?php echo $f_product['product_time'];?>" placeholder="Thời gian">
		                            </div>
        	                	</div>
                            </div>
                        </div>                                                      
					</div>
                    <!-- end body tab common -->
                    
                    <!-- begin body tab product_vn -->
                    <div class="tab-pane fade" id="product_vn" style="padding-top:20px;">
						<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_title" class="control-label">Tên sản phẩm:</label>
                                    <input type="text" class="form-control" id="product_title" name="product_title" placeholder="Tên sản phẩm" maxlength="128" value="<?php echo $f_product['product_title'];?>">
                                </div>
                            </div>
                        </div>
                        
                        <?php
						echo $f_product['text_area_review'];
						?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_review" class="control-label">Đặc điểm nổi bật:</label>
                                    <textarea class="editme" id="product_review" name="product_review" rows="3"><?php echo $f_product['product_review'];?></textarea>
                                </div>
                            </div>
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_content" class="control-label">Mô tả chi tiết:</label>
									<textarea class="editme" id="product_content" name="product_content" rows="3"><?php echo $f_product['product_content'];?></textarea>
                                </div>
							</div>
                        </div> 
                        
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="product_title_seo" class="control-label">Title SEO:</label>
                                            <input type="text" class="form-control" id="product_title_seo" name="product_title_seo" placeholder="Tiêu đề sản phẩm" maxlength="128" value="<?php echo $f_product['product_title_seo'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_meta_desc" class="control-label">Description Meta SEO:</label>
                                            <textarea class="form-control" id="product_meta_desc" name="product_meta_desc" rows="3"><?php echo $f_product['product_meta_desc'];?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_meta_key" class="control-label">Keyword Meta SEO:</label>
                                            <textarea  class="form-control" id="product_meta_key" name="product_meta_key" rows="3"><?php echo $f_product['product_meta_key'];?></textarea>
                                        </div>
                                    </div>
                                </div>
                                                      
					</div>
                    <!-- end body tab product_vn -->
                    
                    
                    
                    
                    
                            <!-- begin body tab album -->   
                              <div class="tab-pane fade" id="album" style="padding-top:20px;">
                                <!--- Begin Album -->
                                    <div id="group_album" class="controls" style="line-height:36px;"></div>                                        
                                    <div class="controls" style="padding-top:3px;">
                                        <div id="addButton" class="btn btn-success">Add</div>
                                    </div>
                                   									
                                <!--- End Album -->                                
                              </div>                                
                            </div>
                            <!-- end body tab album -->
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