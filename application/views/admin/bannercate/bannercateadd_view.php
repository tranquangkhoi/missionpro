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
              <a href="#">Tiện ích</a>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Danh mục Banner</a>
            </li>            
            <li class="active">
              <a href="#">Thêm danh mục Banner</a>
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
			<div class="row">  			
				<div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('bannercateadd');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>
			
            <div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Thêm mới danh mục Banner</strong></div>
			<div class="panel-body">            	
                <form name="bannercateadd" id="bannercateadd" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/<?php echo $this->uri->segment(3);?>' method="POST" role="form">				
				<?php if(!empty($msg)){?>
					<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>
				<?php
				}
				?>
                <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="bannercate_name" class="control-label">Tên danh mục banner</label>
                            <input type="text" class="form-control" id="bannercate_name" name="bannercate_name" maxlength="128" value="<?php echo $f_bannercate['bannercate_name'];?>">
						</div>
					</div>
				</div>
                
                <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="bannercate_name" class="control-label">Banner thuộc trang <span style="font-weight:normal;">[ 0(Trang chủ) - 1(Giới thiệu) - 2(Bảo hành) - 3(Linh kiện) - 4(Tin tức) - 5(Liên hệ) ]</span></label>
                            <input type="text" id="bannercate_block" name="bannercate_block" class="form-control" maxlength="10" value="<?php echo $f_bannercate['bannercate_block'];?>" style="width:120px;">
                            
						</div>
					</div>
				</div>
                
                <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="bannercate_meta_desc" class="control-label">Thẻ Description</label>
                            <textarea id="bannercate_meta_desc" name="bannercate_meta_desc"  class="form-control" rows="5"><?php echo $f_bannercate['bannercate_meta_desc'];?></textarea>
						</div>
					</div>
				</div>
                
                <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="bannercate_meta_key" class="control-label">Thẻ Keyword</label>
                            <textarea id="bannercate_meta_key" name="bannercate_meta_key" class="form-control" rows="5"><?php echo $f_bannercate['bannercate_meta_key'];?></textarea>
						</div>
					</div>
				</div>
                
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