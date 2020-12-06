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
            
            <li>
            	<a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Danh mục sản phẩm</a>
			</li>
            <li class="active">
              Cập nhật danh mục
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
        
            <div class="row">  			
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('frm_categoryadd');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>
           
           
           <div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Cập nhật thông tin</strong></div>
			<div class="panel-body">
            	<form name="frm_categoryadd" id="frm_categoryadd" enctype="multipart/form-data" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/<?php echo $this->uri->segment(3);?>/<?php echo $f_category['category_id'];?>' method="POST" role="form" style="display:inline">        
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
                                <label for="category_name" class="control-label">Tên danh mục</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" maxlength="128" value="<?php echo $f_category['category_name'];?>">
                            </div>
                        </div>                       
                    </div>
                     <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <label for="category_parent" class="control-label">Danh mục cha</label>
                                <select name="category_parent" id="category_parent" class="form-control">
									<option selected="selected" value="0">Là danh mục gốc</option>
									<?php echo $f_category['category_select'];?>
								</select>
                            </div>
                        </div>                        
                    </div>
                                        
              		<?php
						echo $f_category['text_area_review'];
					?>
                 	<div class="row">                       
                        <div class="col-md-6  col-md-offset-3">
	                        <div class="form-group">
    	                        <label for="category_review">Thông tin mô tả:</label>
                                <textarea class="editme form-control" id="category_review" name="category_review" rows="3"><?php echo $f_category['category_review'];?></textarea>
        	                  </div>
            	     	</div>
                     </div>
                
                  
					<div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <label for="category_meta_desc" class="control-label">Tag Description</label>
                                <textarea id="category_meta_desc" name="category_meta_desc" class="form-control" rows="5"><?php echo $f_category['category_meta_desc'];?></textarea>                                               
                            </div>
                        </div>
                	</div>
                
                	<div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <label for="category_meta_key" class="control-label">Tag Keyword</label>
                                <textarea id="category_meta_key" name="category_meta_key" class="form-control" rows="5"><?php echo $f_category['category_meta_key'];?></textarea>                                               
                            </div>
                        </div>                        
                	</div>
                    
	                <div class="row">
                       <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <label for="category_order" class="control-label">Thứ tự hiển thị</label>
                                <input type="text" class="form-control" id="category_order" name="category_order" maxlength="128" value="<?php echo $f_category['category_order'];?>">
                            </div>
                        </div>                        
                	</div>
                
                
                <input name="id" type="hidden" id="id" value="<?php echo $f_category['category_id'];?>" />
                <input name="category_parent_old" type="hidden" id="id" value="<?php echo $f_category['category_parent_old'];?>" />
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