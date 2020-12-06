<?php echo $header; ?>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
			<i class="fa fa-angle-right" aria-hidden="true"></i>
			<li><a href="<?php echo base_url().'news.html';?>">Tin tức</a></li>
			<i class="fa fa-angle-right" aria-hidden="true"></i>
			<li><span><?php echo $newcate_crr->newcate_name;?></span></li>
      </ul>
      </div>
    </div>
  </div>
</div>
<section class="main-blog">
  <div class="container">
    <div class="row _collection">
      <aside class="col-lg-3 col-md-4 sider_bar_col">
        <div class="col-lg-12 col-md-12 hidden-sm-12 col-xs-12 sidebar-blog hot-blog block">
          <!-- Categories Links Starts -->
            <?php echo $new_menu; ?>
          <!-- Categories Links Ends -->
        </div>
      </aside>
      <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 news_posts">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog-posts">
          <article class="news_post_loop">
            <div class="blog_content cl_old">
              <h2><?php echo $newdetail->new_title;?></h2>
			  <h6 style="color:#999; font-size:12px;">Cập nhật: <?php echo $newdetail->new_time_posted;?></h6>
              <?php echo $newdetail->new_content;?>
            </div>
          </article>
          <div class="social-media  text-right-article">
            <h3>Chia sẻ: </h3>
            <ul class="share-button">
              <li> <a class="color-tooltip facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo base_url(uri_string());?>" title="Chia sẻ lên Facebook"> <i class="fa fa-facebook"></i> </a> </li>
              <li> <a class="color-tooltip twitter" target="_blank" href="//twitter.com/home?status=<?php echo base_url(uri_string());?>" title="Chia sẻ lên Twitter"> <i class="fa fa-twitter"></i> </a> </li>
              <li> <a class="color-tooltip google-plus" target="_blank" onClick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="//plus.google.com/share?url=<?php echo base_url(uri_string());?>" title="Chia sẻ lên Google Plus"> <i class="fa fa-google-plus"></i> </a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php echo $footer; ?>