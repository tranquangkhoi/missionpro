<?php
	$sl_menu_one 	= '';
	$sl_menu_two 	= '';
	$sl_menu_three  = '';
	$sl_menu_four   = '';
	$sl_menu_five   = '';
	
	switch ($menu_active){
		case 'one':
			$sl_menu_one = 'active';
		break;
		
		case 'two':
			$sl_menu_two = 'active';
		break;
		
		case 'three':
			$sl_menu_three = 'active';
		break;
		
		case 'four':
			$sl_menu_four = 'active';
		break;
		
		case 'five':
			$sl_menu_five = 'active';
		break;
		
	}
?>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="welcome">THỎ NGỌC SHOP :: CMS</a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">            
            	<li class="dropdown <?php echo $sl_menu_two;?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Sản phẩm<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  	<li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/autocode"><span class="glyphicon glyphicon-list"></span> Quản lý Autocode</a></li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/category"><span class="glyphicon glyphicon-list"></span> Danh mục sản phẩm</a></li>                    
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/product"><span class="glyphicon glyphicon-gift"></span> Quản lý sản phẩm</a></li>                    
                 </ul>
                </li>
                <li class="dropdown <?php echo $sl_menu_three;?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Tin tức<b class="caret"></b></a>
                  <ul class="dropdown-menu">                   
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/newcate"><span class="glyphicon glyphicon-list"></span> Danh mục tin tức</a></li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/news"><span class="glyphicon glyphicon-th"></span> Quản lý tin tức</a></li>                    
                  </ul>
                </li>
                <li class="dropdown <?php echo $sl_menu_four;?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Thông tin chung<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/introcate"><span class="glyphicon glyphicon-list"></span> Danh mục bài viết</a></li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/intro"><span class="glyphicon glyphicon-th"></span> Quản lý bài viết</a></li>                    
                  </ul>
                </li>
                
                <li class="dropdown <?php echo $sl_menu_one;?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Đơn hàng & Liên hệ<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-header">Quản lý thành viên</li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/province"><span class="glyphicon glyphicon-list"></span> Danh mục tỉnh thành</a></li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/member"><span class="glyphicon glyphicon-list"></span> Danh sách thành viên</a></li>
                    <li class="dropdown-header">Quản lý đơn hàng</li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/order"><span class="glyphicon glyphicon-list"></span> Đơn hàng</a></li>
                    <li class="dropdown-header">Quản lý liên hệ</li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/contact"><span class="glyphicon glyphicon-list"></span> Thông tin liên hệ</a></li>                    
                  </ul>
                </li>
                
                <li class="dropdown <?php echo $sl_menu_five;?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Hệ thống & Tiện ích<b class="caret"></b></a>
                  <ul class="dropdown-menu">                                      
                    <li class="dropdown-header">Quản lý cấu hình</li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/config"><span class="glyphicon glyphicon-wrench"></span> Thiết lập hệ thống</a></li>                    
                    <li class="divider"></li>
                    <li class="dropdown-header">Banner</li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/banner"><span class="glyphicon glyphicon-wrench"></span> Quản lý Banner</a></li>                    
                    <li class="divider"></li>
                    <li class="dropdown-header">Support</li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/chat"><span class="glyphicon glyphicon-wrench"></span> Quản lý Tài khoản Support</a></li>                    
                    <li class="divider"></li>
                    
                    <li class="dropdown-header">Quản lý tài khoản</li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/frame"><span class="glyphicon glyphicon-wrench"></span> Quản lý thông tin module</a></li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/group"><span class="glyphicon glyphicon-wrench"></span> Phân quyền quản trị</a></li>
                    <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/user"><span class="glyphicon glyphicon-wrench"></span> Quản lý người sử dụng</a></li>                                        
                    
                  </ul>
                </li>
          </ul>
                   
          <ul class="nav navbar-nav navbar-right">          
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" href="#">
					<i class="glyphicon glyphicon-user"></i> <?php echo $this->session->userdata('user_fullname');?> <span class="caret"></span>
			  </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/user"><span class="glyphicon glyphicon-wrench"></span> Quản lý người sử dụng</a></li>
				<li class="divider"></li>
                <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>