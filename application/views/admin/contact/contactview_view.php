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
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Thông tin liên hệ</a>
            </li>
            <li>
              <a>Chi tiết thông tin liên hệ</a>
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
        
        <div class="row">
  			<div class="col-md-4">
            	 
            </div>
            <div class="col-md-8">
            	<div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                    <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>"><span class="glyphicon glyphicon-list"></span> Quay về</a>                                        
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
       
            <table width="100%" class="table table-bordered table-hover">
              
              <tbody>
              <tr>
              	<td width="21%"><strong>Họ và tên:</strong></td>
              	<td width="79%"><?php echo $vcontact->contact_fullname;?></td>
              </tr>
              <tr>
                <td><strong>Số điện thoại:</strong></td>
                <td><?php echo $vcontact->contact_tel;?></td>
              </tr>
              <tr>
                <td><strong>Email:</strong></td>
                <td><?php echo $vcontact->contact_email;?></td>
              </tr>
              <tr>
                <td><strong>Tiêu đề thư:</strong></td>
                <td><?php echo $vcontact->contact_subject	;?></td>
              </tr>
              <tr>
                <td style="vertical-align:top"><strong>Nội dung:</strong></td>
                <td><?php echo $vcontact->contact_request;?></td>
              </tr>
              </tbody>
            </table>
            
                

       
        
        
      </div>
      <div id="push"></div>
    </div>
     	  

    

    <!-- End page Content-->
	
    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->
    