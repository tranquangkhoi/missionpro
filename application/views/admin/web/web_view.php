	<?php echo $header; ?>

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
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Cấu hình cho Web</a>
            </li>
          </ul>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
         
        <div class="well_tbl">
        <?php if(!empty($msg)){?>
                <div class="alert alert-error pull-left" style="width:330px; color:#F00;">
                        <a class="close" data-dismiss="alert" href="#">x</a><?php echo $msg;?>
                </div>
                <?php
				}
				?>
         
        <div class="btn-toolbar pull-right">        	
            <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Xem <i class="icon-list icon-white"></i></a>
            <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add">Thêm <i class="icon-plus icon-white"></i></a> 
            <a href="#" class="group_del btn btn-danger" role="button" data-toggle="modal">Xóa <i class="icon-remove icon-white"></i></a>            
        </div>
        <div style="clear:both; height:1px;"></div>      
              
       <form id="frm_web" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/del' method="POST" style="display:inline;">
            <table class="table table-bordered table-hover">
              <thead>
                <tr style="background-color:#BFB;">
                  <th width="7%" style="text-align:center;"><input type="checkbox" class="check_all"></th>
                  <th width="8%" style="text-align:center;"><strong>STT</strong></th>                  
                  <th width="40%"><strong>Ảnh nền trang chủ</strong></th>
                  <th width="20%"><strong>Hotline</strong></th>                 
                  <th width="15%" style="text-align:center;"><strong>Sắp xếp</strong></th> 
                  <th width="10%" style="text-align:center;"><strong>Chức năng</strong></th>                
                </tr>
              </thead>
              <tbody>
              <tr>
              	<td colspan="6">
	                <button style="width:48px;" type="button" class="btn" onclick="frm_submit_action('frm_web','<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/filter')"><i class="icon-search icon-black"></i></button>
                	&nbsp;<input class="noEnterSubmit" name="q" type="text"  placeholder="Nhập tên tài khoản hỗ trợ cần tìm..." style="width:300px;">                                                            
                </td>
              </tr>
              <?php
			  $type_arr = array('Yahoo', 'Skype');			  
			  foreach($web_items as $item){
				  $stt = $stt + 1;				
			  ?>  
                <tr>
                    <td style="text-align:center;"><input type="checkbox"  class="check_one" name="check_del[]" value="<?php echo $item['web_id'];?>"></td>
                    <td style="text-align:center;"><?php echo $stt;?></td>
                    <td><img width="284" height="90" src="<?php echo base_url();?>/public/upload/web/<?php echo $item['web_bg'];?>" /></td>
                    <td><?php echo $item['web_hotline'];?></td>                   
                  	<td style="text-align:center;">
                    	<a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/sortup/<?php echo $item['web_id'];?>/<?php echo $current_page;?>"><i class="icon-circle-arrow-up"></i></a>
                        <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/sortdown/<?php echo $item['web_id'];?>/<?php echo $current_page;?>"><i class="icon-circle-arrow-down"></i></a>
                    </td>                   
                    <td style="text-align:center;">
                     <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $item['web_id'];?>"><i class="icon-pencil"></i></a>                                          
                    </td>
                </tr>
              <?php
			  }
			  ?>          
                
              </tbody>
            </table>
            <?php echo $pagination;?>       
             </form>
       
       </div>
       
        <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Cảnh báo</h3>
                </div>
                <div class="modal-body">
                    <p class="error-text">Bạn có chắc chắn muốn xóa không?</p>
                    <p class="error-text">Dữ liệu đã xóa sẽ không khôi phục lại được !!!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" onclick="frm_submit('frm_web')">Xóa</button> 
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Thoát</button>  
                </div>
           
        </div>
      </div>
      <div id="push"></div>
    </div>
    <!-- End page Content-->
	
    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->
    