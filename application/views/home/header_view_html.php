<!doctype html>
<html lang="en">
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
	
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url();?>public/home/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Google Web Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Oswald:400,700,300" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400" rel="stylesheet" type="text/css">
	
	<!-- CSS Files -->
	<link href="<?php echo base_url();?>public/home/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>public/home/css/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo base_url();?>public/home/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>public/home/css/responsive.css" rel="stylesheet">
	
	<!--[if lt IE 9]>
		<script src="<?php echo base_url();?>public/home/js/ie8-responsive-file-warning.js"></script>
	<![endif]-->
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- icons -->	
    <link rel="icon" type="image/png" href="<?php echo base_url();?>public/home/favicon.png">
	<script type="text/javascript">
	     var UrlDomain = '<?php echo base_url();?>';
	</script>
</head>
<body>
	<div id="notification">        	
		<div id="success"  class="success" style="display:none;"></div>
	</div>
<!-- Header Section Starts -->
	<header id="header-area">
	<!-- Header Top Starts -->
		<div class="header-top">
			<div class="container">
				<div class="row">
				<!-- Header Links Starts -->
					<div class="col-sm-8 col-xs-12">
						<div class="header-links">
							<ul class="nav navbar-nav pull-left">
								<li>
									<a href="index.html">
										<i class="fa fa-home hidden-lg hidden-md" title="Home"></i>
										<span class="hidden-sm hidden-xs">
											Trang chủ
										</span>
									</a>
								</li>
								<li>
									<a href="#">	
										<i class="fa fa-heart hidden-lg hidden-md" title="Wish List"></i>
										<span class="hidden-sm hidden-xs">
											Yêu thích(0)
										</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-user hidden-lg hidden-md" title="My Account"></i>
										<span class="hidden-sm hidden-xs">
											Tài khoản
										</span>
									</a>
								</li>
								<li>
									<a href="cart.html">
										<i class="fa fa-shopping-cart hidden-lg hidden-md" title="Shopping Cart"></i>
										<span class="hidden-sm hidden-xs">
											Giỏ hàng
										</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-crosshairs hidden-lg hidden-md" title="Checkout"></i>
										<span class="hidden-sm hidden-xs">
											Thanh toán
										</span>
									</a>
								</li>
								<li>
									<a href="register.html">
										<i class="fa fa-unlock hidden-lg hidden-md" title="Register"></i>
										<span class="hidden-sm hidden-xs">
											Đăng ký
										</span>
									</a>
								</li>
								<li>
									<a href="login.html">
										<i class="fa fa-lock hidden-lg hidden-md" title="Login"></i>
										<span class="hidden-sm hidden-xs">
											Đăng nhập
										</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				<!-- Header Links Ends -->
				<!-- Currency & Languages Starts -->
					<div class="col-sm-4 col-xs-12">
						<div class="pull-right">
						<!-- Currency Starts -->
							<div class="btn-group">
								<button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
									Currency
									<i class="fa fa-caret-down"></i>
								</button>
								<ul class="pull-right dropdown-menu">
									<li><a tabindex="-1" href="#">Pound </a></li>
									<li><a tabindex="-1" href="#">US Dollar</a></li>
									<li><a tabindex="-1" href="#">Euro</a></li>
								</ul>
							</div>
						<!-- Currency Ends -->
						<!-- Languages Starts -->
							<div class="btn-group">
								<button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
									Language
									<i class="fa fa-caret-down"></i>
								</button>
								<ul class="pull-right dropdown-menu">
									<li>
										<a tabindex="-1" href="#">English</a>
									</li>
									<li>
										<a tabindex="-1" href="#">French</a>
									</li>
								</ul>
							</div>
						<!-- Languages Ends -->
						</div>
					</div>
				<!-- Currency & Languages Ends -->
				</div>
			</div>
		</div>
	<!-- Header Top Ends -->
	<!-- Main Header Starts -->
		<div class="main-header">
			<div class="container">
				<div class="row">
				<!-- Logo Starts -->
					<div class="col-md-4">
						<div id="logo">
							<a href="index.html"><img src="<?php echo base_url();?>public/home/images/logo.png" title="Spice Shoppe" alt="Spice Shoppe" class="img-responsive" /></a>
						</div>
					</div>
				<!-- Logo Starts -->
                <!-- Search Starts -->
					<form action="<?php echo base_url().'search.html';?>"  method="get" onSubmit="return sim_search(this.qsearch.value);" id="frmsearch" name="frmsearch">
                        <div class="col-md-4">                    
                            <div id="search">
                                <div class="input-group">							  
                                      <input type="text" class="form-control input-lg" placeholder="Gõ từ khóa cần tìm" name="qsearch"  id="qsearch">
                                      <span class="input-group-btn">
                                        <button class="btn btn-lg" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>                                
                                     </span>
                                </div>
                            </div>	
                        </div>
				   </form>                              
				<!-- Search Ends -->
								
				<!-- Shopping Cart Starts -->
					<div class="col-md-4">
						<div id="cart" class="btn-group btn-block shopping-cart">
							<button type="button" data-toggle="dropdown" class="btn btn-block btn-lg dropdown-toggle top-cart">
								<i class="fa fa-shopping-cart shopping-cart"></i>
								<span class="hidden-md">Giỏ:</span> 								
                                <span class="text-cart" id="total_items">rtỷty</span>
                            	<span class="price-cart" id="total_money">rtỷtỷty</span>
								<i class="fa fa-caret-down"></i>
							</button>
							<ul class="dropdown-menu pull-right">
								<li>
									<table class="table hcart">
										<tr>
											<td class="text-center">
												<a href="product.html">
													<img src="<?php echo base_url();?>public/home/images/product-images/hcart-thumb1.jpg" alt="image" title="image" class="img-thumbnail img-responsive" />
												</a>
											</td>
											<td class="text-left">
												<a href="product-full.html">
													Seeds
												</a>
											</td>
											<td class="text-right">x 1</td>
											<td class="text-right">$120.68</td>
											<td class="text-center">
												<a href="#">
													<i class="fa fa-times"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td class="text-center">
												<a href="product.html">
													<img src="<?php echo base_url();?>public/home/images/product-images/hcart-thumb2.jpg" alt="image" title="image" class="img-thumbnail img-responsive" />
												</a>
											</td>
											<td class="text-left">
												<a href="product-full.html">
													Organic
												</a>
											</td>
											<td class="text-right">x 2</td>
											<td class="text-right">$240.00</td>
											<td class="text-center">
												<a href="#">
													<i class="fa fa-times"></i>
												</a>
											</td>
										</tr>
									</table>
								</li>
								<li>
									<table class="table table-bordered total">
										<tbody>
											<tr>
												<td class="text-right"><strong>Sub-Total</strong></td>
												<td class="text-left">$1,101.00</td>
											</tr>
											<tr>
												<td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
												<td class="text-left">$4.00</td>
											</tr>
											<tr>
												<td class="text-right"><strong>VAT (17.5%)</strong></td>
												<td class="text-left">$192.68</td>
											</tr>
											<tr>
												<td class="text-right"><strong>Total</strong></td>
												<td class="text-left">$1,297.68</td>
											</tr>
										</tbody>
									</table>
									<p class="text-right btn-block1">
										<a href="cart.html">
											Xem giỏ
										</a>
										<a href="#">
											Thanh toán
										</a>
									</p>
								</li>									
							</ul>
						</div>
					</div>
				<!-- Shopping Cart Ends -->
				</div>
			</div>
		</div>
	<!-- Main Header Ends -->
	<!-- Main Menu Starts -->
		<nav id="main-menu" class="navbar" role="navigation">
			<div class="container">
			<!-- Nav Header Starts -->
				<div class="navbar-header">
					<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-cat-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<i class="fa fa-bars"></i>
					</button>
				</div>
			<!-- Nav Header Ends -->
			<!-- Navbar Cat collapse Starts -->
				<div class="collapse navbar-collapse navbar-cat-collapse">					
                    <ul class="nav navbar-nav">
						<?php
						$ci = count($cate_one);
						for($i=1; $i<=$ci; $i++){
							if(!isset($pcate[$cate_one[$i]['category_id']])){
						?>
                        	<li>
								<a href="<?php echo base_url().''.$cate_one[$i]['category_slug'].'.html'; ?>"><?php echo $cate_one[$i]['category_name']; ?></a>
							</li>
                        <?php
							}else{
						?>
                                                
						<li class="dropdown">
							<a href="<?php echo base_url().''.$cate_one[$i]['category_slug'].'.html';?>" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="10">
								<?php echo $cate_one[$i]['category_name']; ?>
							</a>
							<ul class="dropdown-menu" role="menu">
								 <?php
								$cj = count($cate_two);
								for($j=1; $j<=$cj; $j++){
									if($cate_two[$j]['category_parent'] == $cate_one[$i]['category_id']){
							     ?>
                                		<li>
                                        	<a tabindex="-1"  href="<?php echo base_url().$cate_one[$i]['category_slug'].'/'.$cate_two[$j]['category_slug'].'.html'; ?>"><?php echo $cate_two[$j]['category_name']; ?></a>
                                        </li>
                                        
								<?php
									}
								}
								?>
							</ul>
						</li>
						<?php
							}
						}
						?>
					</ul>
				</div>
			<!-- Navbar Cat collapse Ends -->
			</div>
		</nav>
	<!-- Main Menu Ends -->
	</header>
<!-- Header Section Ends -->