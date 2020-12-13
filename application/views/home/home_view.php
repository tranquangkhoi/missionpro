<?php echo $header;?>
<!--Brief-->
<div class="fs-container fs-has-layout">
  <div class="main-content">
     <div class="fs-section fs-banner">
        <div class="fs-inr banners">
           <div class="left-banner">
              <div class="hero-banner fs-pc show-controls">
                 <div class="hero-slider swiper-container swiper-container-horizontal">
                    <div class="swiper-wrapper">
                       <?php if (count($banner_main) > 0) { ?>
                       <div class="swiper-slide swiper-slide-active" style="width: 1027px;">
                          <a href="<?php echo $banner_main[0]['banner_link'];?>">
                             <div class="fs-bg">
                                <div class="cmBg" data-src="<?php echo base_url();?>public/upload/banner/<?php echo $banner_main[0]['banner_image'];?>" style="background-image: url(&quot;<?php echo base_url();?>public/upload/banner/<?php echo $banner_main[0]['banner_image'];?>&quot;);">
                                </div>
                             </div>
                             <div class="banner-box" style="left: 74.5px;"><br></div>
                          </a>
                       </div>
                       <?php } ?>
                       <?php if (count($banner_main) > 1 ) { ?>
                       <div class="swiper-slide swiper-slide-next" style="width: 1027px;">
                          <a href="<?php echo $banner_main[1]['banner_link'];?>">
                             <div class="fs-bg">
                                <div class="cmBg" data-src="<?php echo base_url();?>public/upload/banner/<?php echo $banner_main[1]['banner_image'];?>" style="background-image: url(&quot;<?php echo base_url();?>public/upload/banner/<?php echo $banner_main[1]['banner_image'];?>&quot;);">
                                </div>
                             </div>
                             <div class="banner-box" style="left: 74.5px;"><br></div>
                          </a>
                       </div>
                     <?php } ?>
                    </div>
                 </div>
                 <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span></div>
              </div>
              <div class="hero-banner fs-sp show-controls">
                 <div class="all-slider-sp swiper-container swiper-container-horizontal">
                    <div class="swiper-wrapper" style="transition-duration: 0ms;">
                       <?php if (count($banner_main) > 0) { ?>
                       <div class="swiper-slide ">
                          <a href="<?php echo $banner_main[0]['banner_link'];?>">
                             <div class="fs-bg">
                                <div class="cmBg" data-src="<?php echo base_url();?>public/upload/banner/<?php echo $banner_main[0]['banner_image'];?>" style="background-image: url(&quot;<?php echo base_url();?>public/upload/banner/<?php echo $banner_main[0]['banner_image'];?>&quot;);">
                                </div>
                             </div>
                             <div class="banner-box" style="left: 74.5px;"><br></div>
                          </a>
                       </div>
                        <?php } ?>
                        <?php if (count($banner_main) > 1) { ?>
                       <div class="swiper-slide ">
                          <a href="<?php echo $banner_main[1]['banner_link'];?>">
                             <div class="fs-bg">
                                <div class="cmBg" data-src="<?php echo base_url();?>public/upload/banner/<?php echo $banner_main[1]['banner_image'];?>" style="background-image: url(&quot;<?php echo base_url();?>public/upload/banner/<?php echo $banner_main[1]['banner_image'];?>&quot;);">
                                </div>
                             </div>
                             <div class="banner-box" style="left: 74.5px;"><br></div>
                          </a>
                       </div>
                       <?php } ?>
                       <?php if (count($banner_right_top) > 0) { ?>
                       <div class="swiper-slide color-organ ta-right">
                          <a href="<?php echo $banner_right_top[0]['banner_link'];?>">
                             <div class="fs-bg">
                                <div class="cmBg" data-src="<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_top[0]['banner_image'];?>" style="background-image: url(&quot;<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_top[0]['banner_image'];?>&quot;);">
                                </div>
                             </div>
                             &nbsp;                                            
                          </a>
                       </div>
                       <?php } ?>
                       <?php if (count($banner_right_top) > 1) { ?>
                       <div class="swiper-slide color-organ ">
                          <a href="<?php echo $banner_right_top[1]['banner_link'];?>">
                             <div class="fs-bg">
                                <div class="cmBg" data-src="<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_top[1]['banner_image'];?>" style="background-image: url(&quot;<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_top[1]['banner_image'];?>&quot;);">
                                </div>
                             </div>
                             <div class="banner-box" style="left: 74.5px;">
                                <div class="banner-title"></div>
                             </div>
                             <div id="gtx-trans" style="position:absolute;left:169px;top:115.896px;">
                                <div class="gtx-trans-icon"></div>
                             </div>
                          </a>
                       </div>
                       <?php } ?>
                       <?php if (count($banner_right_bottom) > 0) { ?>
                       <div class="swiper-slide text-hightlight ta-center">
                         <a href="<?php echo $banner_right_bottom[0]['banner_link'];?>">
                             <div class="fs-bg">
                                <div class="cmBg" data-src="<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_bottom[0]['banner_image'];?>" style="background-image: url(&quot;<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_bottom[0]['banner_image'];?>&quot;);">
                                </div>
                             </div>
                             &nbsp;                                            
                          </a>
                       </div>
                       <?php } ?>
                    </div>
                 </div>
                 <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
              </div>
           </div>
           <div class="right-banner fs-pc">
              <div class="reten-banner">
                 <div class="reten-slider swiper-container swiper-container-horizontal">
                    <div class="swiper-wrapper">
                       <?php if (count($banner_right_top) > 0) { ?>
                       <div class="swiper-slide ta-right swiper-slide-active" style="width: 554px;">
                         <a href="<?php echo $banner_right_top[0]['banner_link'];?>">
                             <div class="fs-bg">
                                <div class="pcBg" data-src="<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_top[0]['banner_image'];?>" style="background-image: url(&quot;<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_top[0]['banner_image'];?>&quot;);">
                                </div>
                             </div>
                             &nbsp;
                          </a>
                       </div>
                       <?php } ?>
                       <?php if (count($banner_right_top) > 1) { ?>
                       <div class="swiper-slide swiper-slide-next" style="width: 554px;">
                          <a href="<?php echo $banner_right_top[1]['banner_link'];?>">
                             <div class="fs-bg">
                                <div class="pcBg" data-src="<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_top[1]['banner_image'];?>" style="background-image: url(&quot;<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_top[1]['banner_image'];?>&quot;);">
                                </div>
                             </div>
                             <div class="banner-box">
                                <div class="banner-title"></div>
                             </div>
                             <div id="gtx-trans" style="position:absolute;left:169px;top:115.896px;">
                                <div class="gtx-trans-icon"></div>
                             </div>
                          </a>
                       </div>
                       <?php } ?>
                    </div>
                 </div>
              </div>
              <?php if (count($banner_right_bottom) > 0) { ?>
              <div class="aov-banner">
                 <div class="aov-slider swiper-container swiper-container-horizontal">
                    <div class="swiper-wrapper">
                       <div class="swiper-slide ta-center swiper-slide-active" style="width: 554px;">
                          <a href="<?php echo $banner_right_bottom[0]['banner_link'];?>">
                             <div class="fs-bg">
                                <div class="pcBg" data-src="<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_bottom[0]['banner_image'];?>" style="background-image: url(&quot;<?php echo base_url();?>public/upload/banner/<?php echo $banner_right_bottom[0]['banner_image'];?>&quot;);">
                                </div>
                             </div>
                             &nbsp;
                          </a>
                       </div>
                    </div>
                 </div>
              </div>
              <?php } ?>
           </div>
        </div>
     </div>
     <?php echo $widget_product_hot;?>
     <?php echo $widget_home_news;?>
     <?php echo $widget_support;?>
     
</div>
<!--/Brief-->
<?php echo $footer; ?>