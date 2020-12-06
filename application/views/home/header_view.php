<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="vi">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="vi">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="vi">
 <![endif]-->
 <!--[if IE 9 ]>
<html class="ie9 no-js">
<![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="vi">
   <!--<![endif]-->
   <head>
      <meta charset="utf-8">
      <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
      <![endif]-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="<?php echo $desc;?>" />
      <meta name="keywords" content="<?php echo $key;?>" />
      <meta name="author" content="">
      <title><?php echo $title;?></title>
      <!-- Scripts -->
      <script src="<?php echo base_url();?>public/home/js/jquery-1.11.1.min.js"></script>
      <script src='<?php echo base_url();?>public/home/js/jquery-theme.min.js' type='text/javascript'></script>
      <!-- Styles -->
      <!-- Header hook for plugins ================================================== -->
      <!-- End Google Tag Manager -->
      <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
      <![endif]-->
      <!--[if IE 7]>
      <link href='<?php echo base_url();?>public/home/css/font-awesome-ie7.css' rel='stylesheet' type='text/css' />
      <![endif]-->
      <!--[if lt IE 9]>
      <script src='//html5shiv.googlecode.com/svn/trunk/html5.js' type='text/javascript'></script>
      <![endif]-->
      <link href='<?php echo base_url();?>public/home/css/popup_cart_desktop.css' rel='stylesheet' type='text/css' />
      <link href='<?php echo base_url();?>public/home/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
      <link href='<?php echo base_url();?>public/home/css/owl.carousel.css' rel='stylesheet' type='text/css' />
      <link href='<?php echo base_url();?>public/home/css/owl.theme.default.css' rel='stylesheet' type='text/css' />
      <link href='<?php echo base_url();?>public/home/css/jquery.fancybox.css' rel='stylesheet' type='text/css' />
      <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Open+Sans:400,700|Roboto" rel="stylesheet">
      <link href='<?php echo base_url();?>public/home/css/font-awesome.min.css' rel='stylesheet' type='text/css' />
      <link href='<?php echo base_url();?>public/home/css/jgrowl.css' rel='stylesheet' type='text/css' />
      <link href='<?php echo base_url();?>public/home/css/style.css' rel='stylesheet' type='text/css' />
      <link href="<?php echo base_url();?>public/home/css/magnific-popup.css" rel="stylesheet">
      <script src='<?php echo base_url();?>public/home/js/jquery.fancybox.js' type='text/javascript'></script>
      <script src='<?php echo base_url();?>public/home/js/quickviews.js' type='text/javascript'></script>
      <script src='<?php echo base_url();?>public/home/js/slider.js' type='text/javascript'></script>
      <!-- icons -->    
      <link rel="icon" type="image/png" href="<?php echo base_url();?>public/home/images/favicon.png">
      <script type="text/javascript">
         var UrlDomain = '<?php echo base_url();?>';
         $(window).scroll(function(){
			if($(this).scrollTop()>40){
			$(".hot-line-mobile").addClass('fix');
         $(".navbar-mobile").addClass('fix');
			}else{
				$(".hot-line-mobile").removeClass('fix');
            $(".navbar-mobile").removeClass('fix');
			}
			
		  });
      </script>
   </head>
   <body>
      <div id="OpacityPage"></div>
      <div id="notification">
         <div id="success" class="success" style="display: none;">
            <span style="color:#3c763d; font-size:30px; font-weight:bold;" ><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span> 
            Bạn đã thêm sản phẩm vào giỏ hàng
         </div>
      </div>
      <div id="menu-mobile-display"  class="menu-mobile hidden-lg-up">
         <div class="content-menu" style="max-height:100%">
            <div class="title-menu-mobile">
               <a href="/">Kho gia dụng</a>
            </div>
            <div class="navigation">
               <?php echo $widget_category_mobile;?>
            </div>
            <div class="ft-menu-mobile">
               <?php echo $menubar_mobile;?>
            </div>
            <div class="ft-menu-mobile">
            	<div class="sign-mobile">
                  <?php
                     if(!$this->session->userdata('member_validated')){
                     ?>
                  <span>
                  <i class="fa fa-sign-in" aria-hidden="true"></i>
                  <a href='<?php echo base_url().'member/login.html';?>' id='customer_login_link'>Đăng nhập</a>
                  </span>
                  <br>
                  <span>
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <a href='<?php echo base_url().'member/register.html';?>' id='customer_register_link'>Tạo tài khoản</a>
                  </span>
                  <?php } else {?>
                  <span style="color:#FFFFFF"><i class="fa fa-user"></i> &nbsp;<?php echo $this->session->userdata('member_fullname'); ?></span>
                  <ul class="member-info">
                     <li><a onClick="location.href='<?php echo base_url().'member/profile.html';?>'">- Cập nhật hồ sơ</a></li>
                     <li><a href="<?php echo base_url().'member/changepass.html';?>">- Đổi mật khẩu</a></li>
                     <li><a href="<?php echo base_url().'member/orders.html';?>">- Đơn hàng đã đặt</a></li>
                     <li><a href="<?php echo base_url().'member/logout.html';?>"><i class="fa fa-sign-in"></i> Thoát</a></li>
                  </ul>
                  <?php } ?>
               </div>
               <ul>
                  <li>
                     <span>
                        Hotline
                        <h6><?php echo $company->company_hotline;?></h6>
                     </span>
                     <img src="<?php echo base_url();?>public/home/images/phone-menu-mobile.png" alt="Gọi ngay"/>
                  </li>
               </ul>
            </div>
         </div>
         <div class="button-close">
            <div id="close-menu" class="btn-close"> <i class="fa fa-bars" aria-hidden="true"></i> </div>
         </div>
      </div>
      <header>
         <!--
            <section class=" header-banner hidden-sm-down"> <a href="#" title="#">
              <div class="banner_top" style="background-image: url('<?php echo base_url();?>public/home/images/banner-top.png');"></div>
              </a> </section>-->
         <div class="header-container">
            <div class="container container_main">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 hot-line-mobile hidden-lg-up" >
                     <span> Hotline :<?php echo $company->company_hotline;?></span>
                  </div>
                  <div class="col-sm-2 col-xs-3 navbar-mobile nav_mx991 hidden-lg-up"> <a id="showmenu-mobile" class="button-menu"> <i class="fa fa-bars" aria-hidden="true"></i> </a> </div>
                  <div class="col-lg-3 col-md-8 col-sm-6 col-xs-6 logo_mx991">
                     <div class="logo"> <a href="<?php echo base_url();?>" title="Kho gia dụng"> <img src="<?php echo base_url();?>public/home/images/logo.png" alt="Kho gia dụng"> </a> </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 hidden-md-down search-item">
                     <div class="support_search">
                        <div class="search_form">
                           <form action="<?php echo base_url().'search.html';?>" method="get" class="search-form" role="search">
                              <input placeholder="Nhập từ khóa cần tìm..." class="search_input" required maxlength="70" id="search" type="text" name="qsearch" value="">
                              <input type="submit" value="Tìm kiếm" class="btnsearch">
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 hidden-md-down search-item">
                     <div class="support_search">
                        <h5>Hotline : </h5>
                        <span class="hot-line"> <?php echo $company->company_hotline;?></span>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-3 hidden-xs account-cart">
                     <div class="col-lg-8 col-md-7 col-sm-8 hidden-md-down account">
                        <div> <img class="mg_bt_10" src="<?php echo base_url();?>public/home/images/account.png" alt="Đăng ký hoặc đăng nhập" height="30" width="30"> </div>
                        <div>
                           <?php
                              if(!$this->session->userdata('member_validated')){
                              ?>
                           <a class="cl_old"><a href='<?php echo base_url().'member/login.html';?>' id='customer_login_link'>Đăng nhập</a></a> / <a class="cl_old"><a href='<?php echo base_url().'member/register.html';?>' id='customer_register_link'>Đăng ký</a></a>
                           <?php } else {?>
                           <div class="cl_old dropdown-toggle-member" data-toggle="dropdown" style="cursor:pointer" data-hover="dropdown">
                              <span><?php echo $this->session->userdata('member_fullname'); ?></span>
                              <ul class="dropdown-menu member-info">
                                 <li><a onClick="location.href='<?php echo base_url().'member/profile.html';?>'">- Cập nhật hồ sơ</a></li>
                                 <li><a onClick="location.href='<?php echo base_url().'member/changepass.html';?>'">- Đổi mật khẩu</a></li>
                                 <li><a onClick="location.href='<?php echo base_url().'member/orders.html';?>'">- Đơn hàng đã đặt</a></li>
                                 <li class="divider"></li>
                                 <li class="pull-right"><a onClick="location.href='<?php echo base_url().'member/logout.html';?>'"><i class="fa fa-sign-in" aria-hidden="true"></i> Thoát</a></li>
                              </ul>
                           </div>
                           <?php }?>
                           </span>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 cart cart_mx991">
                        <div class="top-cart-contain">
                           <div class="mini-cart shopping-cart" onclick="location.href='<?php echo base_url().'giohang.html'?>'">
                              <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle">
                                 <a href="<?php echo base_url().'giohang.html'?>"><img class="mg_bt_10" src="<?php echo base_url();?>public/home/images/cart.png" alt="Giỏ hàng" width="30" height="30" /></a>
                                 <div class="cart-box">
                                    <span class="title cl_old hidden-sm-down">Giỏ hàng</span>
                                    <span id="cart-total" class="cartCount"></span> 
                                 </div>
                                 </a>
                              </div>
                              <div class="top-cart-content arrow_box hidden-md-down">
                                 <div id="detail-cart" class="listcart">
                                    <div id="short-cart">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 search_form_mobile hidden-lg-up">
                     <form action="<?php echo base_url().'search.html';?>" method="get"  class="search-form" role="search">
                        <input placeholder="Nhập từ khóa cần tìm..." class="search_input_mobile" maxlength="70" id="search" type="text" name="qsearch" value="">
                        <button class="submit_button"><i class="btnsearch_mobile fa fa-search" aria-hidden="true"></i></button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <nav class="hidden-md-down">
         <div class="container">
            <div class="row nav_menu">
               <?php echo $widget_category;?>
               <div class="col-lg-5 hidden-md-down main-nav">
                  <?php echo $menubar;?>
               </div>
               <div class="col-lg-4 col-md-8 hidden-sm-down social pull-right hidden-xs ">
                  <div class="social-icon"><a href="#" title ="Theo dõi Kho gia dụng trên Printerest"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></div>
                  <div class="social-icon"><a href="#" title ="Theo dõi Kho gia dụng trên Youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></div>
                  <div class="social-icon"><a href="#" title ="Theo dõi Kho gia dụng trên Google Plus"><i class="fa fa-google-plus" aria-hidden="true"></i></a></div>
                  <div class="social-icon"><a href="#" title ="Theo dõi Kho gia dụng trên Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></div>
                  <div class="social-icon"><a href="#" title ="Theo dõi Kho gia dụng trên Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></div>
               </div>
            </div>
         </div>
      </nav>