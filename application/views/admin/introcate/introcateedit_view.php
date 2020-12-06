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
              <a href="#">Thông tin chung</a>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Danh mục bài viết</a>
            </li>            
            <li class="active">
              <a href="#">Cập nhật danh mục bài viết</a>
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
      		<div class="row">  			
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('introcateedit');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>
			<div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Cập nhật danh mục bài viết chung</strong></div>
			<div class="panel-body">            	
                <form name="introcateedit" id="introcateedit" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_introcate['introcate_id'];?>' method="POST">
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
							<label for="introcate_name" class="control-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="introcate_name" name="introcate_name" maxlength="128" value="<?php echo $f_introcate['introcate_name'];?>">
						</div>
					</div>
				</div>
                
                <div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="form-group">
							<label for="introcate_meta_desc" class="control-label">Thẻ Description</label>
                            <textarea id="introcate_meta_desc" name="introcate_meta_desc"  class="form-control" rows="5"><?php echo $f_introcate['introcate_meta_desc'];?></textarea>
						</div>
					</div>					
				</div>
                
                <div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="form-group">
							<label for="introcate_meta_key" class="control-label">Thẻ Keyword</label>
                            <textarea id="introcate_meta_key" name="introcate_meta_key" class="form-control" rows="5"><?php echo $f_introcate['introcate_meta_key'];?></textarea>
						</div>
					</div>					
				</div>
                
                <div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="form-group">
							<label for="introcate_meta_key" class="control-label">Thuộc nhóm bài </label>
                            <input type="text" id="introcate_block" name="introcate_block" class="input-small" maxlength="10" value="<?php echo $f_introcate['introcate_block'];?>">
                                    <br />0(Giới thiệu) - 1(Chính sách bán hàng) - 2(Hướng dẫn mua hàng) - 3(Quy định Web)
						</div>
					</div>
				</div>
                <input name="id" type="hidden" id="id" value="<?php echo $f_introcate['introcate_id'];?>" />                              
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