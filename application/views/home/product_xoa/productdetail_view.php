<?php echo $header; ?>

<link href="<?php echo base_url();?>public/home/css/thumbelina.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>public/home/js/thumbelina.js"></script>	

<script type="text/javascript" src="<?php echo base_url();?>public/home/js/jquery.elevateZoom-3.0.8.min.js"></script>	
<script type="text/javascript">
	function swap(image,img_large) {				
		document.getElementById("img_main").src = image.href;	
				
	}
</script>
<script type="text/javascript" src="<?php echo base_url();?>public/home/js/jquery.elevateZoom-3.0.8.min.js"></script>	
<script type="text/javascript" src="<?php echo base_url();?>public/home/fancybox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/home/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />    
<script type="text/javascript">
	$(document).ready(function() {
			$('.fancybox').fancybox();
	});
</script>

<style type="text/css">
.order {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
	background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
	background-color:#ededed;
	-webkit-border-top-left-radius:4px;
	-moz-border-radius-topleft:4px;
	border-top-left-radius:4px;
	-webkit-border-top-right-radius:4px;
	-moz-border-radius-topright:4px;
	border-top-right-radius:4px;
	-webkit-border-bottom-right-radius:4px;
	-moz-border-radius-bottomright:4px;
	border-bottom-right-radius:4px;
	-webkit-border-bottom-left-radius:4px;
	-moz-border-radius-bottomleft:4px;
	border-bottom-left-radius:4px;
	text-indent:0;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#777777;
	font-family:Tahoma;
	font-size:16px;	
	font-style:normal;
	height:36px;
	line-height:36px;
	width:116px;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #ffffff;
}
.order:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
	background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
	background-color:#dfdfdf;
}.order:active {
	position:relative;
	top:1px;
}
#slider3 {
	position:relative;
	margin-top:22px;
	width:93px;
	height:400px;
	border-left:1px solid #aaa;
	border-right:1px solid #aaa;
	margin-bottom:0px;
}
</style>
<script type="text/javascript">
    $(function(){
		$('#slider3').Thumbelina({
        	orientation:'vertical',         // Use vertical mode (default horizontal).
			$bwdBut:$('#slider3 .top'),     // Selector to top button.
			$fwdBut:$('#slider3 .bottom')   // Selector to bottom button.
		});              
	})
</script>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		 <tr>		 
			<td align="center">
				<div style="padding:0px 10px 10px 0px; margin-left:10px; margin-right:10px; margin-bottom:5px; text-align:left;">	
                    <a class="clor3" href="<?php echo base_url().$this->config->item('index_page_add');?>">Trang chủ</a> &gt; 
                    <a class="clor3" href="<?php echo base_url().$this->config->item('index_page_add');?>product.html">Shop online</a> &gt;
                    <?php
                    $total = count($path);	
                    for($i=1; $i<=$total; $i++){
                        if($i<$total){
                    ?>
                            <a class="clor3" href="<?php echo base_url().$this->config->item('index_page_add');?>product/<?php echo $path[$i]['category_slug'].'.html';?>"><?php echo $path[$i]['category_name'];?></a> &gt;	
                    
                    <?php
                        }else{
                    ?>
                            <strong><a class="clor3" href="<?php echo base_url().$this->config->item('index_page_add');?>product/<?php echo $path[$i]['category_slug'].'.html';?>"><?php echo $path[$i]['category_name'];?></a></strong>
                    <?php
                        }
                    }
                    ?>     
                </div>
                
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0"   class="bo_bt bo_tp">
		  <tr >
			<td width="48%">
				<table width="98%" border="0" cellspacing="0" cellpadding="0" class="p0">
				  <tr>
					<td width="80%" align="center">
					<?php
					if($productdetail->product_image<>''){
					?>
						<img class="zoom" id="img_main" width="316" height="446" src="<?php echo base_url()?>public/upload/product/<?php echo 'medium_'.	$productdetail->product_image;?>" data-zoom-image="<?php echo base_url()?>public/upload/product/<?php echo $productdetail->product_image;?> "/>
					<?php
						}
					?>
                    </td>
					<td width="20%" align="center" valign="top">                    	
                        <div id="slider3">
                        	<div class="thumbelina-but vert top">&#708;</div>       
                        	<?php 
							if(count($libimg)>0){
							?>                     
                            <ul id="product-thumbs" class="large items">
								<?php								
								foreach($libimg as $img){									
								?>
                                <li class="">
                                    <a data-image="<?php echo base_url()?>public/upload/product/<?php echo 'medium_'.$img['image_name'];?>" data-zoom-image="<?php echo base_url()?>public/upload/product/<?php echo $img['image_name'];?>" ><img class="img-thumbnail" src="<?php echo base_url()?>public/upload/product/<?php echo 'xsmall_'.$img['image_name'];?>"></a>
								</li>
                                <?php
								}
								?>
							</ul>
                            <?php
							}
							?>
                            <div class="thumbelina-but vert bottom">&#709;</div>
						</div>                       
                    </td>
				  </tr>
		    </table></td>
			<td class="bo_ri">&nbsp;</td>
			
			<td width="52%" valign="top" class="pl1">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td colspan="2">
                    <h1 style="font-weight:normal;"><?php echo $productdetail->product_title;?></h1>
				    <h1 style="font-weight:normal;">Giá: <?php echo $productdetail->product_price>0 ? number_format($productdetail->product_price,0).' VNĐ' : 'liên hệ' ;?></p>
				    <p>&nbsp;</p></td>
				  </tr>
				  <tr>
					<td width="50%" valign="top">						
						<h2 class="s10 text" style="text-transform:uppercase;">Thông tin chi tiết</h2>
						<p>
                        <span id="text-information">
                        	<?php echo $productdetail->product_content;?>
                        </span>
                        </p>
                        <p  class="s10 text">&nbsp;</p>
                        <a class="fancybox fancybox.ajax" href="<?php echo base_url();?>order/<?php echo $productdetail->product_id;?>"><input type="button" value="Đặt hàng" class="order" /></a>
                    </td>					
				  </tr>
				</table></td>
		  </tr>
		</table>
        <table width="98%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td width="50%">&nbsp;</td>
		    <td>&nbsp;</td>
		    <td  width="49%"  valign="top" class="pl1">&nbsp;</td>
	      </tr>
		</table>
       <?php
	   if(count($other_items)>0){
	   ?> 
        <table width="98%" border="0" cellspacing="0" cellpadding="0">
		  <tr>		    
		    <td  valign="top" class="pl1 s10 text b">Sản phẩm khác</td>
	      </tr>
		  <tr>
		    <td  valign="top" class="pl1 s10 text pt10">
            	<?php
				$i = 0;
				foreach($other_items as $item){
					$img_one 		= base_url().'public/upload/product/'.'xsmall_'.$item['product_image'];
					$link_one 		= base_url().$this->config->item('index_page_add').'product/detail/'.$item['product_slug'].'.html';
					$title_one		= $item['product_title'];
				?>	
				<div class="product_other">
					<div align="center"  style="padding-top:6px;"><a href="<?php echo $link_one;?>"> <img src="<?php echo $img_one;?>" /> </a></div>
					<div style="height:30px; font-size:10px; padding:3px;"><?php echo $title_one;?></div>							
				</div>
				 <?php
				} //
				?>
            </td>
	      </tr>
		</table>	
		<?php
	   }
		?>
     
    		</td>
		  </tr>
		</table>
<script>   
	$("#img_main").elevateZoom({ 
		gallery : "product-thumbs", 
		galleryActiveClass: "active", 
		zoomType: "inner",
		cursor: "move",
		zoomWindowFadeIn: 500,
		zoomWindowFadeOut: 750 
	});
</script>
<!-- Begin Footer -->
<?php echo $footer; ?>
<!-- End Footer -->