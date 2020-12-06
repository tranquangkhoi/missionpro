<?php echo $header; ?>
<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		  <tr>
		  <!-- Menu trai -->
			<td width="230px" valign="top">
				<table width="98%" border="0" cellspacing="0" cellpadding="0">				  				 
				  <tr>
					<td class="sp1 p7">
                    <div  style="color:#333; border-bottom: 1px dotted #999; padding-bottom:5px; text-transform:uppercase; font-weight:bold;">Shop online</div>
                    </td>
				  </tr>
				  <tr>
				  <td class="pl1 l1">
                    	<?php
						foreach($menu_left as $item){
							
						?>
						<div class="lv<?php echo $item['category_level'];?>"><a href="<?php echo base_url().$this->config->item('index_page_add');?>product/<?php echo $item['category_slug'].'.html';?>"><?php echo $item['category_name'];?></a></div>
                        <?php
						}
						?>
			      </td>
				 
				  <tr>
				    <td>&nbsp;</td>
			      </tr>
			</table>			
         </td>
		  <!-- End Menu trai -->
		  
			<td width="10px">&nbsp;</td>
			<td>
				<div style="padding:10px 10px 9px 10px; border-bottom:#999 dotted 1px; margin-bottom:15px;">	
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
                
	<div id="content"> 
		<?php 
		$img_one 	= '';
		$img_two 	= '';
		$img_three 	= '';	
		if(count($product_items)>0){
			$i = 0;		
			foreach($product_items as $item){
				$i = $i + 1;
				if($i==1){
					$img_one 		= base_url().'public/upload/product/'.'small_'.$item['product_image'];
					$link_one 		= base_url().$this->config->item('index_page_add').'product/detail/'.$item['product_slug'].'.html';
					$title_one		= $item['product_title'];
				}
				if($i==2){
					$img_two 		= base_url().'public/upload/product/'.'small_'.$item['product_image'];
					$link_two 		= base_url().$this->config->item('index_page_add').'product/detail/'.$item['product_slug'].'.html';
					$title_two		= $item['product_title'];
				}
				if($i==3){
					$img_three 		= base_url().'public/upload/product/'.$item['product_image'];
					$link_three 	= base_url().$this->config->item('index_page_add').'product/detail/'.$item['product_slug'].'.html';
					$title_three	= $item['product_title'];
					break;
				}				
			}
		?>
        <div class="pro">
			<?php 
			if($img_one<>''){
			?>
            <div class="pro1">
				<div align="center" style="padding-top:6px;"><a href="<?php echo $link_one;?>"> <img src="<?php echo $img_one;?>" width="207" height="291" /> </a></div>
				<div class="pl20 pt10" style="height:30px;"><?php echo $title_one;?></div>								
			</div>
            <?php
			}
			?>
			<?php 
			if($img_two<>''){
			?>			
			<div class="pro2">
				<div align="center"  style="padding-top:6px;"><a href="<?php echo $link_two;?>"> <img src="<?php echo $img_two;?>" width="207" height="291" /> </a></div>
				<div class="pl20 pt10"  style="height:30px;"><?php echo $title_two;?></div>								
			</div>
            <?php
			}
			?>
		</div>
		<?php
		if($img_three<>''){
		?>	
		<div class="product1">
			<div align="center" style="padding-top:10px;"><a href="<?php echo $link_three;?>"><img src="<?php echo $img_three;?>" width="440" height="620"/></a></div>
			<div class="pl20 pt10" style="height:30px;"><?php echo $title_three;?></div>						
		</div>
        <?php
		}
		?>
		<?php
		$i = 0;
		foreach($product_items as $item){			
			$i = $i + 1;
		if($i>3){
			$img_one 		= base_url().'public/upload/product/'.'small_'.$item['product_image'];
			$link_one 		= base_url().$this->config->item('index_page_add').'product/detail/'.$item['product_slug'].'.html';
			$title_one		= $item['product_title'];
		?>	
		<div class="product">
			<div align="center"  style="padding-top:6px;"><a href="<?php echo $link_one;?>"> <img src="<?php echo $img_one;?>" width="207" height="291" /> </a></div>
			<div class="pl20 pt10"  style="height:30px;"><?php echo $title_one;?></div>							
		</div>
         <?php
				} // end if
			} // end for
		}else{
			echo '<div style="text-align:center; color:red; font-size:12px;">Đang cập nhật dữ liệu...</div>';
		}
		 ?>
	</div>
     <?php echo $pagination; ?>	
     <div style="padding-bottom:20px;">&nbsp;</div>		
    		</td>
		  </tr>
		</table>

<!-- Begin Footer -->
<?php echo $footer; ?>
<!-- End Footer -->