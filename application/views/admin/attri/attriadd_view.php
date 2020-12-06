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
              <a href="#">Thuộc tính sản phẩm</a> <span class="divider">></span>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý thuộc tính sản phẩm</a> <span class="divider">></span>
            </li>            
            <li class="active">
              <a href="#">Thêm thuộc tính sản phẩm</a>
            </li>
          </ul>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
        <div class="well_tbl">
            <div class="btn-toolbar pull-right">        	
                <a class="btn btn-primary" href="javascript:frm_submit('frm_attriadd');">Ghi lại <i class="icon-plus icon-white"></i></a>
                <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <i class="icon-remove icon-white"></i></a>                                             
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
                         
                         <form enctype="multipart/form-data" name="frm_attriadd" id="frm_attriadd" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/add' method="POST">
                              
                                  <div class="control-group">                                 
                                  	  <label class="control-label"  for="attri_title">Tên thuộc tính:</label>
                                      <div class="controls">
                                        <input type="text" id="attri_title" name="attri_title" class="input-block-level" maxlength="220" value="<?php echo $f_attri['attri_title'];?>">
                                      </div>
                                  </div>
                                  <div class="control-group">
                                  <!-- Password -->
                                  <label class="control-label"  for="attricate">Thuộc nhóm thuộc tính:</label>
                                  <div class="controls">
                                    <select id="attricate_id" name="attricate_id" class="input-xlarge">
                                            <?php echo $f_attri['attricate_choose'];?>
                                    </select>
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