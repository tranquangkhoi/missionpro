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
              <a href="#">Hệ thống & tiện ích</a> <span class="divider">></span>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Cấu hình cho Web</a> <span class="divider">></span>
            </li>            
            <li class="active">
              <a href="#">Thêm thông cấu hình</a>
            </li>
          </ul>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
        <div class="well_tbl">
             <div class="btn-toolbar pull-right">        	
                <a class="btn btn-primary" href="javascript:frm_submit('frm_webadd');">Ghi lại <i class="icon-plus icon-white"></i></a>
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
                      <td  style="padding-top:10px;">
                         
							 <?php if(!empty($msg)){?>
                            <div class="alert alert-error" style="color:#F00;">
                                    <a class="close" data-dismiss="alert" href="#">x</a><?php echo $msg;?>
                            </div>
                            <?php
                            }
                            ?>
                         <form enctype="multipart/form-data" name="frm_webadd" id="frm_webadd" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/<?php echo $this->uri->segment(3);?>' method="POST">
                              <div id="myTabContent" class="tab-content">
                                <div class="control-group">                                 
                                  <label class="control-label"  for="username">Hotline:</label>
                                  <div class="controls">
                                    <input type="text" id="web_hotline" name="web_hotline" class="input-xlarge" maxlength="128" value="<?php echo $f_web['web_hotline'];?>">
                                  </div>
                                </div>
                                
                                <div class="control-group">                                 
                                  <label class="control-label"  for="web_bg">Ảnh nền trên trang chủ: (W:1366px - H:768px)</label>
                                  <div class="controls">
                                    <input type="file" id="web_bg" name="web_bg" class="input-xlarge" maxlength="128" value="<?php echo $f_web['web_bg'];?>">
                                  </div>
                                </div>
                                <div class="control-group">                                 
                                  	  <label class="control-label"  for="web_contact">Thông tin liên hệ:</label>
                                      <div class="controls">                                        
                                        <textarea class="span6" id="web_contact" name="web_contact" rows="3"><?php echo $f_web['web_contact'];?></textarea>
                                        <?php
										echo $f_web['text_area_review'];
										?>
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
      <div id="push"></div>
    </div>
    <!-- End page Content-->

    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->