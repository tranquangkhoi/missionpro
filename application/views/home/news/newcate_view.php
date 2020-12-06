<?php echo $header; ?>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
            <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
		    <?php if (isset($newcate_crr)) {
				$catename = $newcate_crr['newcate_name'];
			?>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
		    <li> <a title="Tin tức" href="<?php echo base_url().'news.html';?>">Tin tức</a></li>            
			<li><?php echo $newcate_crr['newcate_name'];?></li>
			<?php }
			else { 
				$catename = 'Tin tức';
			?>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <li><a href="">Tin tức</a></li>
			<?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<section class="main-blog">
  <div class="container">
    <div class="row _collection">
      <aside class="left col-lg-3 col-md-4 sider_bar_col">
        <div class="col-lg-12 col-md-12 hidden-sm-12 col-xs-12 sidebar-blog hot-blog block">
        <!-- Categories Links Starts -->
            <?php echo $new_menu; ?>
        <!-- Categories Links Ends -->
        </div>
      </aside>
      <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 news_posts">
        <h2 class="fw_600"><?php echo $catename?></h2>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog-posts">
		<?php
			if(count($new_items) > 0){

			foreach($new_items as $tin){								
				$link_pro = base_url().$this->config->item('index_page_add').'news/detail/'.$tin['new_slug'].'.html';
				$new_image = $tin['new_image']<>'' ? base_url().'public/upload/new/'.$tin['new_image'] : '';
				$new_title = $tin['new_title'];									
		?>
          <div class="news_post_loop">
            <div class="news_post_loop_img"> <a href="<?php echo $link_pro;?>"> <img src="<?php echo $new_image;?>" alt="<?php echo $new_title;?>"> </a> </div>
            <div class="news_post_loop_title">
              <h3><a href="<?php echo $link_pro;?>" title="<?php echo $new_title;?>"><?php echo $new_title;?></a></h3>
            </div>
            <div class="news_post_loop_info">
              <p class="cl_old"><strong>Ngày đăng</strong>: <?php echo $this->back->fix_date('H:i:s A, d/m/Y',$tin['new_time_posted']);?></p>
            </div>
            <div class="news_post_loop_content cl_old"> <?php echo $tin['new_review'];?></div>
            <div class="news_post_loop_more">
              <button class="btn_viewmore" onClick="location.href='<?php echo $link_pro;?>'">Đọc thêm <i class="fa fa-long-arrow-right" aria-hidden="true"></i> </button>
            </div>
          </div>
		  <?php
			}
		  ?>
           <div style="clear:both;"></div>
		   <div class="pager">
		   	<div class="pages" style="float:right;"><?php echo $pagination;?></div>
		   </div>
		   <div style="clear:both;"></div>
		   <?php
			 }else{
			?>
				<div style="text-align:center; color:#F00; margin-bottom:30px;">Chưa có dữ liệu</div>	
			<?php
			 }
			?>	
        </div>
      </div>
    </div>
  </div>
</section>

<?php echo $footer; ?>