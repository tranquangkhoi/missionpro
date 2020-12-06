<?php				
foreach($banner_left as $item){					
?>
	<a href="<?php echo $item['banner_link'];?>" target="_blank">
		<img src="<?php echo base_url();?>public/upload/banner/<?php echo $item['banner_image'];?>" alt="Side Banner" class="img-responsive" />
	</a>
	<br>
<?php
}
?>
                 