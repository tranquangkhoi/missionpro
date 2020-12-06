<?php echo $header; 
$block_name = array(
    '0' => 'Giới thiệu',
    '1' => 'Chính sách bán hàng',
    '2' => 'Đặt hàng & thanh toán'
);
$block = array(
    '0' => 'gioi-thieu',
    '1' => 'chinh-sach',
    '2' => 'thanh-toan'
);
$day_arr = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bẩy');
?>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
          <i class="fa fa-angle-right" aria-hidden="true"></i>
          <li class="home">
            <a href="<?php echo base_url().$this->config->item('index_page_add').$block[$intro_block].'.html';?>"><?php echo $block_name[$intro_block];?></a>
           </li>
           <i class="fa fa-angle-right" aria-hidden="true"></i>
          <li><span><?php echo $introdetail->intro_title;?></span></li>
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
            <?php echo $intro_menu; ?>
          <!-- Categories Links Ends -->
        </div>
      </aside>
      <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 news_posts">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog-posts">
          <article class="news_post_loop">
            <div class="blog_content cl_old">
              <h2><?php echo $introdetail->intro_title;?></h2>
			  <h6 style="color:#999; font-size:12px;">Cập nhật: <?php echo $day_arr[$introdetail->intro_day].', '.$introdetail->intro_time_posted;?></h6>
              <p><?php echo $introdetail->intro_content;?></p>
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