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
              <a href="#">Hệ thống & Tiện ích</a> <span class="divider">></span>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Cấu hình cho Web</a> <span class="divider">></span>
            </li>            
            <li class="active">
              <a href="#">Cập nhật thông tin cấu hình</a>
            </li>
          </ul>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
        <div class="well_tbl">
             <div class="btn-toolbar pull-right">        	
                <a class="btn btn-primary" href="javascript:frm_submit('frm_webedit');">Cập nhật <i class="icon-plus icon-white"></i></a>
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
                      <td>
                         <div style="padding-top:10px;">
							 <?php if(!empty($msg)){?>
                            <div class="alert alert-error" style="color:#F00;">
                                    <a class="close" data-dismiss="alert" href="#">x</a><?php echo $msg;?>
                            </div>
                            <?php
                            }
                            ?>
                         <form enctype="multipart/form-data" name="frm_webedit" id="frm_webedit" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_web['web_id'];?>' method="POST">
                                <div class="control-group">                                 
                                  <label class="control-label"  for="username">Hotline:</label>
                                  <div class="controls">
                                    <input type="text" id="web_hotline" name="web_hotline" class="input-xlarge" maxlength="128" value="<?php echo $f_web['web_hotline'];?>">
                                  </div>
                                </div>
                                
                                 <div class="control-group">
										<label class="control-label" for="input01">Ảnh nền trang chủ</label>
										<div class="controls">
											<input type="file" class="input-small file_upload" id="web_bg" name="web_bg">
										</div>
									</div>
                                    <?php
									if($f_web['image_old']<>''){
									 ?>
                                    <div id="deleteimg" class="control-group">
										<label class="control-label" for="input01">Ảnh cũ</label>
										<div class="controls">
											<img width="284" height="90" src="<?php echo base_url();?>/public/upload/web/<?php echo $f_web['image_old'];?>" />
                                            <a class="btn btn-danger delete" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/delimg/<?php echo $f_web['web_id'];?>">
                                                <i class="icon-trash icon-white"></i>
                                                <span>Delete</span>
                                            </a>
										</div>
									</div>
                                    <?php
									}
									?>
                                    <div class="control-group">                                 
                                  	  <label class="control-label"  for="web_contact">Thông tin liên hệ:</label>
                                      <div class="controls">                                        
                                        <textarea class="span6" id="web_contact" name="web_contact" rows="3"><?php echo $f_web['web_contact'];?></textarea>
                                        <?php
										echo $f_web['text_area_review'];
										?>
                                      </div>
                                  </div>                                
                              <input name="id" type="hidden" id="id" value="<?php echo $f_web['web_id'];?>" /> 
                              <input name="image_old" type="hidden" id="image_old" value="<?php echo $f_web['image_old'];?>" />                              
                            </form>
                            </div>   
                      </td>                 
                    </tr>
                  
                  </tbody>
                </table>            
        </div>   
        
      </div>
      <div id="push"></div>
    </div>
    <!-- End page Content-->

    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->