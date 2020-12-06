<?php echo $header;?>
<!-- Main Container Starts -->
<section class="section section-cate slideshow_full_width slide1_bgcolor">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 hidden-md-down"></div>
      <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 col_slideshow">
        <section id="slide_banner" class="banner-slider owl-carousel owl-source">
        <?php
            $i = 0;
            foreach($banner_slide as $item){
                $i = $i + 1;
                $slide_active = $i=='1' ? 'active' : '';
        ?>
          <div class="item" id="slide1">
            <a href="#" alt="Đồ chơi trẻ em">
                <img src="<?php echo base_url();?>public/upload/banner/<?php echo $item['banner_image'];?>">
            </a>
          </div>
         <?php 
            }
         ?>
        </section>
      </div>
      <div class="col-lg-2 hidden-md-down item-right service_index padding_medium">
        <div class="service">
          <div class="image"> <img class="image-sv" src="<?php echo base_url();?>public/home/images/cart-sv.png?1488253630693" alt="Sản phẩm đa dạng,</br> mẫu mã phong phú" /> </div>
          <div class="info">
            <h5><span>Sản phẩm đa dạng,</br>
              mẫu mã phong phú</span></h5>
          </div>
        </div>
        <div class="service">
          <div class="image"> <img class="image-sv" src="<?php echo base_url();?>public/home/images/pig_sv.png?1488253630693" alt="Giá cả hợp lý,</br>nhiều chính sách ưu đãi" /> </div>
          <div class="info">
            <h5><span>Giá cả hợp lý,</br>
              nhiều chính sách ưu đãi</span></h5>
          </div>
        </div>
        <div class="service">
          <div class="image"> <img class="image-sv" src="<?php echo base_url();?>public/home/images/drop.png?1488253630693" alt="Hệ thống rộng lớn </br>có mặt tại 54 tỉnh thành" /> </div>
          <div class="info">
            <h5><span>Giao hàng tận nhà </br>
              đổi trả miễn phí</span></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<h1 style="display:none;">Kho gia dụng </h1>
<!-- TAB Product Index -->

<script src='<?php echo base_url();?>public/home/js/tab_index.js' type='text/javascript'></script>
<!-- End Tab -->
<div class="content-page">
  <?php
    for($i=1; $i<=count($cate_top); $i++){
        if($dem[$cate_top[$i]['category_id']]>0){
  ?>  
  <div class="section section_top section-collection">
    <div class="container collection_pd">
      <div class="row">
        <div class="col-lg-12  header-title">
          <div class="title-left">
            <h2><a href='<?php echo base_url().''.$cate_top[$i]['category_slug'].'.html';?>'><?php echo $cate_top[$i]['category_name'];?></a></h2>
          </div>
          <div class="right-menu-more hidden-sm-up"> <a href="<?php echo base_url().''.$cate_top[$i]['category_slug'].'.html';?>" title="Xem tất cả">Xem tất cả </a><i class="fa fa-chevron-right" aria-hidden="true"></i> </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content_left_pd">
          <div class="container">
            <div class="row">
              <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wrap-product wrp_xs_pd">
                <ul>
                <?php
                    $group = 'group'.$cate_top[$i]['category_id'];                              
                    foreach($$group as $item){
                        $dlink = base_url().$this->config->item('index_page_add').$item['product_path'].'.html';
                        $giaban = $item['product_price'];
                        $giagoc = $item['product_price_d'];
                        $percent = $giagoc=='0' ? '50' : (100 - ceil($giaban*100/$giagoc));
                        $img_thumb = !empty($item['product_image']) ? 'medium_'.$item['product_image'] : 'no-image.gif';
                ?>
                  <li class="col-lg-2 col-md-2 col-sm-4 col-xs-6 item item_pr_pd">
                    <div class=" box-product">
                      <div class="product-box">
					  <div class="discount_percent"><?php echo $percent;?><span>% </span></div>  
                        
                        <div class="product-thumbnail">
                          <div class="product-image-thumb" id="p<?php echo $item['product_id'];?>"> <a href="<?php echo $dlink; ?>" title="<?php echo $item['product_title'];?>"> <img src="<?php echo base_url();?>public/upload/product/<?php echo $img_thumb;?>" alt="<?php echo $item['product_title'];?>" > </a> </div>
                        </div>
                        <h3 class="product-name"><a href="<?php echo $dlink; ?>" title="<?php echo $item['product_title'];?>"><?php echo $item['product_title'];?></a></h3>
                        <div class="item-content">
                          <div class="item-price">
                            <div class="price-box">
                              <p class="no_margin special-price"> <span class="price"><?php echo $giaban>0 ? number_format($giaban, 0).' VNĐ' : 'Liên hệ' ; ?></span></p>
                            </div>
                          </div>
                        </div>
                        <div class="box_shop_place">
                        	<?php
                                if($item['product_status']=='1'){
                            ?>
                              <span onclick="tocart(<?php echo $item['product_id'];?>,'1')" title="Mua hàng">Mua hàng</span>
                              <?php
                                }else{
                              ?>
                              <span title="Cháy hàng">Cháy hàng</span>
                              <?php }?>
                        </div>
                      </div>
                    </div>
                  </li>
                 <?php
                     }
                 ?>
                </ul>
                <!-- End product -->
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- banner quảng cáo theo từng danh mục sản phẩm
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 hidden-md-down">
          <div class="banner-body"> <a href="#"><img src="<?php echo base_url();?>public/home/images/iphone.jpg?1488253630693" alt="#"/></a> </div>
        </div>
      </div>
    </div>
  </div>
   -->
  <?php }
    }
  ?>
  <!-- banner khach hang
  <section class="banner-brand-wrap hidden-sm-down">
    <div class="container banner-brand-wrap">
      <div class="banner-brand">
        <div id="owl-brand" class="owl-carousel owl-theme">
          <div class="item"><img src="<?php echo base_url();?>public/home/images/brand1.png?1488253630693" alt="Golden mart"/></div>
          <div class="item"><img src="<?php echo base_url();?>public/home/images/brand2.png?1488253630693" alt="Golden mart"/></div>
          <div class="item"><img src="<?php echo base_url();?>public/home/images/brand3.png?1488253630693" alt="Golden mart"/></div>
          <div class="item"><img src="<?php echo base_url();?>public/home/images/brand4.png?1488253630693" alt="Golden mart"/></div>
          <div class="item"><img src="<?php echo base_url();?>public/home/images/brand5.png?1488253630693" alt="Golden mart"/></div>
          <div class="item"><img src="<?php echo base_url();?>public/home/images/brand6.png?1488253630693" alt="Golden mart"/></div>
        </div>
      </div>
    </div>
  </section>
   -->
</div>
<!-- Main Container Ends -->
<?php echo $footer; ?>