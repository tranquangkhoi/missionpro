<?php echo $header; ?>

<link href="<?php echo base_url();?>public/home/css/thumbelina.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>public/home/js/thumbelina.js"></script>	

<script type="text/javascript" src="<?php echo base_url();?>public/home/js/jquery.elevateZoom-3.0.8.min.js"></script>	
<script type="text/javascript">
	function swap(image,img_large) {				
		document.getElementById("img_main").src = image.href;	
				
	}
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
                    <a class="clor3" href="<?php echo base_url().$this->config->item('index_page_add');?>collection.html">Bộ sưu tập</a> &gt;
                    <?php
                    $total = count($path);	
                    for($i=1; $i<=$total; $i++){
                        if($i<$total){
                    ?>
                            <a class="clor3" href="<?php echo base_url().$this->config->item('index_page_add');?>collection/<?php echo $path[$i]['collection_slug'].'.html';?>"><?php echo $path[$i]['collection_name'];?></a> &gt;	
                    
                    <?php
                        }else{
                    ?>
                            <strong><a class="clor3" href="<?php echo base_url().$this->config->item('index_page_add');?>collection/<?php echo $path[$i]['collection_slug'].'.html';?>"><?php echo $path[$i]['collection_name'];?></a></strong>
                    <?php
                        }
                    }
                    ?>     
                </div>
                
	
		<table width="100%" border="0" cellspacing="0" cellpadding="0"   class="bo_bt bo_tp">
		  <tr >
			
			
            <td>
            	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="p0">
				  <tr>
					<td width="80%" align="center">
					<?php
					if($pcollectiondetail->pcollection_image<>''){
					?>
						<img class="zoom" id="img_main" width="440" src="<?php echo base_url()?>public/upload/pcollection/<?php echo 'medium_'.	$pcollectiondetail->pcollection_image;?>" data-zoom-image="<?php echo base_url()?>public/upload/pcollection/<?php echo $pcollectiondetail->pcollection_image;?> "/>
					<?php
						}
					?>
                    </td>
					<td width="20%" align="center" valign="top">                    	
                        <div id="slider3" style="height:500px;">
                        	<div class="thumbelina-but vert top">&#708;</div>       
                        	<?php 
							if(count($libimg)>0){
							?>                     
                            <ul id="pcollection-thumbs" class="large items">
								<?php								
								foreach($libimg as $img){									
								?>
                                <li class="">
                                    <a data-image="<?php echo base_url()?>public/upload/pcollection/<?php echo $img['image_name'];?>" data-zoom-image="<?php echo base_url()?>public/upload/pcollection/<?php echo $img['image_name'];?>" ><img class="img-thumbnail" src="<?php echo base_url()?>public/upload/pcollection/<?php echo 'xsmall_'.$img['image_name'];?>"></a>
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
                        <div style="height:30px;">&nbsp;</div>                       
                    </td>
				  </tr>
		    </table>
            </td>
			
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
		    <td  valign="top" class="pl1 s10 text b">Bộ sưu tập khác</td>
	      </tr>
		  <tr>
		    <td  valign="top" class="pl1 s10 text pt10">
            	<?php
				$i = 0;
				foreach($other_items as $item){
					$img_one 		= base_url().'public/upload/pcollection/'.'xsmall_'.$item['pcollection_image'];
					$link_one 		= base_url().$this->config->item('index_page_add').'collection/detail/'.$item['pcollection_slug'].'.html';
					$title_one		= $item['pcollection_title'];
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
		gallery : "pcollection-thumbs", 
		galleryActiveClass: "active", 
		zoomType: "",
		cursor: "move"		 
	});
</script>
<!-- Begin Footer -->
<?php echo $footer; ?>
<!-- End Footer -->