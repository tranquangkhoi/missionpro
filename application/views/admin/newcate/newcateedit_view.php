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
              <a href="#">Tin tức</a>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Danh mục tin tức</a>
            </li>            
            <li class="active">
              <a href="#">Cập nhật danh mục tin tức</a>
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
		<div id="main" class="container">
			<div class="row">  			
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('newcateedit');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Cập nhật danh mục tin tức</strong></div>
			<div class="panel-body">            	
                <form name="newcateedit" id="newcateedit" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_newcate['newcate_id'];?>' method="POST" role="form">
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
							<label for="newcate_name" class="control-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="newcate_name" name="newcate_name" maxlength="128" value="<?php echo $f_newcate['newcate_name'];?>">
						</div>
					</div>					
				</div>
                
                <div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="form-group">
							<label for="newcate_meta_desc" class="control-label">Thẻ Description</label>
                            <textarea id="newcate_meta_desc" name="newcate_meta_desc"  class="form-control" rows="5"><?php echo $f_newcate['newcate_meta_desc'];?></textarea>
						</div>
					</div>					
				</div>
                
                <div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="form-group">
							<label for="newcate_meta_key" class="control-label">Thẻ Keyword</label>
                            <textarea id="newcate_meta_key" name="newcate_meta_key" class="form-control" rows="5"><?php echo $f_newcate['newcate_meta_key'];?></textarea>
						</div>
					</div>					
				</div>
                <input name="id" type="hidden" id="id" value="<?php echo $f_newcate['newcate_id'];?>" />
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