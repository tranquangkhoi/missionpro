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
              <a href="#">Thêm mới Nhóm thuộc tính</a>
            </li>
          </ul>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
        <div class="well_tbl">
            <div class="btn-toolbar pull-right">        	
                <a class="btn btn-primary" href="javascript:frm_submit('frm_attricateadd');">Ghi lại <i class="icon-plus icon-white"></i></a>
                <a class="btn btn-danger" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <i class="icon-remove icon-white"></i></a>                                             
        	</div>
            <div style="clear:both;"></div>          
                <table class="mytable" width="100%">                 
                  <tbody>
                  <tr>
                      <td style="background-color:#BFB; line-height:26px; font-size:16px; padding:5px;">
                      <strong>Thêm mới</strong>
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
                         <form enctype="multipart/form-data" name="frm_attricateadd" id="frm_attricateadd" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/add' method="POST">
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
                            </div>
                             
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