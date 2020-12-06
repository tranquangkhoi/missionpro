	<?php echo $header; ?>
	
    <!-- Part 1: Wrap all page content here -->
    <div id="wrap" class="fullscreen_bg" style="background-image:url(public/admin/img/bg<?php echo rand(1,4);?>.jpg);">

      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-inner">
          <div class="container">
            <a class="navbar-brand" href="#">THỎ NGỌC SHOP :: CMS</a>
            <p class="navbar-text navbar-right">
					Administrator
			</p>
          </div>
        </div>        
      </div>

      <!-- Begin page content -->
     
      <div class="row" style="margin:0px; min-height:100%; padding-top:13%;">
        <div class="container">    
            
            <div class="row">
            	<div class="col-md-4 col-md-offset-4">			
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Đăng nhập hệ thống</strong> <span class="glyphicon glyphicon-log-in"></span></h3>
                        </div>
                        <div class="panel-body" style="padding-bottom:0px;">				
                            <?php 
                            if(!empty($msg)){
                            ?>                                                                                                    
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <?php echo $msg;?>
                                </div>                                       
                            <?php
                            }
                            ?>    
                            <form action='<?php echo base_url().$this->config->item('index_page_add');?>admin/login/verify' method='post' name='frm_login' class="form-horizontal" role="form">
                                <div style="margin-bottom: 10px" class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Nhập tên đăng nhập">                                        
                                </div>
                                            
                                <div style="margin-bottom: 10px" class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
                                </div>
                                <div style="margin-top:10px" class="form-group">                                     
                                    <div class="col-sm-12 controls">
                                        <button class="btn btn-primary" type="submit">Đăng nhập</button>                                      
                                    </div>
                                </div>    
                            </form>                                
                        </div>
                    </div>
				</div>
			</div>
                        
        </div>
    </div>
      
            
    </div>
    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->
    