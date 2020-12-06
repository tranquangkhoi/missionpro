<?php echo $header; ?>

<div class="banner">
	 <?php
	  $i = 0;		  
	  foreach($banner_intro as $item){
		  $i = $i + 1;
		  if($i==1){
	  ?>
      	<a href="<?php echo $item['banner_link'];?>"><img src="<?php echo base_url();?>public/upload/banner/<?php echo $item['banner_image'];?>" /></a>
      <?php
		  }
	  }
	  ?>
   
</div>
<div id="ctnerBdy">
<div class="shareFullCol">
<div class="padT15">
<div id="colLeft">
<h2 class="tileColLeft">
	<?php 
	$block_arr = array('Giới thiệu','Chính sách bảo hành','Trung tâm trợ giúp','Điều khoản sử dụng','Chính sách bảo mật');
	echo $block_arr[$intro_block];
	?>
    </h2>
    <div class="mnuColLeft">
    	<ul>
            
			<?php			 	  			 
			  foreach($menu_intro as $item){				 
			  ?>
        		<li><a href="<?php echo base_url().$this->config->item('index_page_add');?>warranty/<?php echo $item['intro_slug'].'.html';?>"><?php echo $item['intro_title'];?></a></li>
            <?php
			}
			?>
        </ul>
    </div>
    <div class="boxSupportInsize">
    	<?php echo $support_online; ?>
    </div>
</div>
<div id="colRight">
<div class="path">
	<?php
	$day_arr = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bẩy');
	?>
	<a class="clor3" href="<?php echo base_url().$this->config->item('index_page_add');?>">Trang chủ</a> &gt; <a class="clor3" href="<?php echo base_url().$this->config->item('index_page_add');?>warranty.html">
    <strong>Chính sách bảo hành</strong></a>
     </div>
	<div class="padT15">
    	<div class="padB15"><?php echo $day_arr[$introdetail->intro_day].', '.$introdetail->intro_time_posted;?></div>
    	<div class="padB30 bderBtomDash">
        <?php
			  if($introdetail->intro_image<>''){
              ?>
            <img width="470" class="imgDtailLk" src="<?php echo base_url()?>public/upload/intro/<?php echo $introdetail->intro_image;?>" />          
            <?php
			  }
			?>
        <div class="padB15 f-28 lineH40"><strong><?php echo $introdetail->intro_title;?></strong></div>
        <div>
         	<?php echo $introdetail->intro_content;?></a>
        </div>
        <div class="clearfix"></div>
        </div>        
    </div>
        
   
      
</div>
<div class="clearfix"></div>
</div>
</div>
</div>


<!-- Begin Footer -->
<?php echo $footer; ?>
<!-- End Footer -->