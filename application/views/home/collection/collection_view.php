<?php echo $header; ?>
<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		  <tr>
		  <!-- Menu trai -->
			<td width="230px" valign="top">
				<table width="98%" border="0" cellspacing="0" cellpadding="0">				  				 
				  <tr>
					<td class="sp1 p7">
                    <div  style="color:#333; border-bottom: 1px dotted #999; padding-bottom:5px; font-weight:bold; text-transform:uppercase;">Bộ sưu tập</div>
                    </td>
				  </tr>
				  <tr>
				  <td class="pl1 l1">
                    	<?php
						foreach($menu_left as $item){
							
						?>
						<div class="lv<?php echo $item['collection_level'];?>"><a href="<?php echo base_url().$this->config->item('index_page_add');?>collection/<?php echo $item['collection_slug'].'.html';?>"><?php echo $item['collection_name'];?></a></div>
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
                
	<div id="content"> 
		<?php 
		$img_one 	= '';
		$img_two 	= '';
		$img_three 	= '';	
		if(count($pcollection_items)>0){
			
		?>
		<?php
		$i = 0;
		foreach($pcollection_items as $item){			
			
			$img_one 		= base_url().'public/upload/pcollection/'.'small_'.$item['pcollection_image'];
			$link_one 		= base_url().$this->config->item('index_page_add').'collection/detail/'.$item['pcollection_slug'].'.html';
			$title_one		= $item['pcollection_title'];
		?>	
		<div class="product">
			<div align="center"  style="padding-top:6px;"><a href="<?php echo $link_one;?>"> <img src="<?php echo $img_one;?>" width="207" height="291" /> </a></div>
			<div class="pl20 pt10"  style="height:30px;"><?php echo $title_one;?></div>							
		</div>
         <?php			
			} // end for
		}else{
			echo '<div style="text-align:center; color:red;">Đang cập nhật dữ liệu...</div>';
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