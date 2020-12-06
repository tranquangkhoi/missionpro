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
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Quản lý tin tức</a>
            </li>
          </ol>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
         
       <?php 
		if(!empty($msg)){
		?>
            <div class="row">
                <div class="col-md-4">
                	<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
                       	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>                    
                </div>
            </div>
		<?php
		}
		?>
        <form id="frm_news" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/del' method="POST" style="display:inline;">
         <div class="row">
        	<div class="col-md-2">            	
            	 <select id="newcate_id" name="newcate_id" class="form-control" style="margin-bottom:10px; margin-top:-10px; width:190px;" onchange="frm_submit_action('frm_news','<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/filter')">
                      	<?php echo $newcate_choose;?>
                 </select> 
            </div>
  			<div class="col-md-3">            	 
                 <div class="input-group" style="margin-bottom:10px; margin-top:-10px;">
					      
                          <input  class="form-control noEnterSubmit" name="q" type="text"  placeholder="Nhập thông tin cần tìm..." >                          
                          <span style="cursor:pointer;" class="input-group-addon" onclick="frm_submit_action('frm_news','<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/filter')" >
                          	<span class="glyphicon glyphicon-search"></span>
                          </span>
                 </div>
            </div>
            <div class="col-md-7">
            	<div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                    <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>"><span class="glyphicon glyphicon-list"></span> Xem</a>
                    <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a> 
                    <a href="#" class="group_del btn btn-primary" role="button" data-toggle="modal"><span class="glyphicon glyphicon-minus"></span> Xóa</a>            
                </div>
            </div>
        </div>               
       <div style="clear:both;"></div>        
       
            <table class="table table-bordered table-hover">
              <thead>
                <tr style="background-color:#BFB;">
                  <th width="7%" style="text-align:center;"><input type="checkbox" class="check_all"></th>
                  <th width="8%" style="text-align:center;"><strong>STT</strong></th>                  
                  <th width="44%"><strong>Tiêu đề tin</strong></th>
                  <th width="30%"><strong>Ngày đăng</strong></th>                   
                  <th width="11%" style="text-align:center;"><strong>Chức năng</strong></th>                
                </tr>
              </thead>
              <tbody>
             
              <?php			  
			  foreach($new_items as $item){
				  $stt = $stt + 1;				
			  ?>  
                <tr>
                    <td style="text-align:center;"><input type="checkbox"  class="check_one" name="check_del[]" value="<?php echo $item['new_id'];?>"></td>
                    <td style="text-align:center;"><?php echo $stt;?></td>
                    <td><?php echo $item['new_title'];?></td>
                    <td><?php echo $this->back->fix_date('H:i:s A, d/m/Y',$item['new_time_posted']);?></td>                                       
                    <td style="text-align:center;">
                     <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $item['new_id'];?>"><span class="glyphicon glyphicon-pencil"></span></a>                                          
                    </td>
                </tr>
              <?php
			  }
			  ?>          
                
              </tbody>
            </table>
            </form>
            <?php echo $pagination;?>       
                
       
       
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Cảnh báo</h4>
              </div>
              <div class="modal-body">
                    <p class="error-text">Bạn có chắc chắn muốn xóa không?</p>
                    <p class="error-text">Dữ liệu đã xóa sẽ không khôi phục lại được !!!</p>
              </div>             
              <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" onclick="frm_submit('frm_news')">Xóa</button> 
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Thoát</button>  
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div id="push"></div>
    </div>
    <!-- End page Content-->
	
    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->
    