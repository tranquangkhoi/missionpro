	<?php echo $header; ?>	
	<script src="/editor/scripts/innovaeditor.js"></script>

    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin Menubar-->
      <?php echo $menubar; ?>
      <!-- End Menubar-->
      
      <!-- Begin Path -->
      <div id="breadcrumb">
          <ul class="breadcrumb">
            <li>
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/welcome">Home</a> <span class="divider">></span>
            </li>
            <li>
              <a href="#">Sản phẩm</a> <span class="divider">></span>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý Nhóm thuộc tính sản phẩm</a> <span class="divider">></span>
            </li>            
            <li class="active">
              <a href="#">Cập nhật Nhóm thuộc tính</a>
            </li>
          </ul>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
        <div class="well_tbl">
            <div class="btn-toolbar pull-right">        	
                <a class="btn btn-primary" href="javascript:frm_submit('frm_attricateedit');">Cập nhật <i class="icon-plus icon-white"></i></a>
                <a class="btn btn-danger" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <i class="icon-remove icon-white"></i></a>                                             
        	</div>
            <div style="clear:both;"></div>          
                <table class="mytable" width="100%">                 
                  <tbody>
                  <tr>
                      <td style="background-color:#BFB; line-height:26px; font-size:16px; padding:5px;">
                      <strong>Cập nhật thông tin</strong>
                      </td>
                   </tr>
                    <tr>
                      <td style="padding-top:10px;">
                         
							 <?php if(!empty($msg)){?>
                            <div class="alert alert-error" style="color:#F00;">
                                    <a class="close" data-dismiss="alert" href="#">x</a><?php echo $msg;?>
                            </div>
                            <?php
                            }
                            ?>
                         
                         <form enctype="multipart/form-data" name="frm_attricateedit" id="frm_attricateedit" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_attricate['attricate_id'];?>' method="POST">
                        
                            <div id="myTabContent" class="tab-content">
                                  <div class="control-group">                                 
                                  	  <label class="control-label"  for="attricate_title">Tên Nhóm thuộc tính:</label>
                                      <div class="controls">
                                        <input type="text" id="attricate_title" name="attricate_title" class="input-block-level" maxlength="220" value="<?php echo $f_attricate['attricate_title'];?>">
                                      </div>
                                  </div>
                                  <div class="control-group">
                                  <!-- Password -->
                                  <label class="control-label"  for="category">Thuộc danh mục:</label>
                                  <div class="controls">
                                    <select id="category_id" name="category_id" class="input-xlarge">
                                            <?php echo $f_attricate['category_choose'];?>
                                    </select>
                                  </div>
                                </div>
                            
                               <div class="control-group">
										<label class="control-label" for="input01">Ảnh minh họa</label>
										<div class="controls">
											<input type="file" class="input-small file_upload" id="attricate_image" name="attricate_image">
										</div>
									</div>
                                    <?php
									if($f_attricate['image_old']<>''){
									 ?>
                                    <div id="deleteimg" class="control-group">
										<label class="control-label" for="input01">Ảnh cũ</label>
										<div class="controls">
											<img src="<?php echo base_url();?>/public/upload/attricate/<?php echo 'small_'.$f_attricate['image_old'];?>" />
                                            <a class="btn btn-danger delete" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/delimg/<?php echo $f_attricate['attricate_id'];?>">
                                                <i class="icon-trash icon-white"></i>
                                                <span>Delete</span>
                                            </a>
										</div>
									</div>
                                    <?php
									}
									?>
                                                                  
                            </div>
                                                                                           
                             	  <input name="id" type="hidden" id="id" value="<?php echo $f_attricate['attricate_id'];?>" />
                                  <input name="image_old" type="hidden" id="image_old" value="<?php echo $f_attricate['image_old'];?>" />                        
                            </form>                            
                          
                      </td>                 
                    </tr>
                  
                  </tbody>
                </table> 
                </div>         
        </div>   
        
      </div>
      <div id="push"></div>
    </div>
    <!-- End page Content-->

    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->