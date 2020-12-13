<?php echo $header; ?>
 <link href="<?php echo base_url();?>public/home/css/category.min.css" rel="stylesheet" as="style">
 <div class="main-content">
   <div class="fs-section fs-banner sub-page">
      <div class="fs-inr">
         <div class="banner-slider swiper-container swiper-container-horizontal">
            <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
               <div class="swiper-slide swiper-slide-active" style="width: 1583px;">
                  <div class="item-slide">
                     <div class="fs-outer">
                        <div class="banner-box">
                           <h1></h1>
                        </div>
                     </div>
                     <div class="fs-pic">
                        <img class="fs-pc pcPic" src="<?php echo base_url();?>public/home/images/banner_category.jpg" data-src="<?php echo base_url();?>public/home/images/banner_category.jpg" title="." alt=".">
                        <img class="fs-sp spPic fs-lazy" src="<?php echo base_url();?>public/home/images/banner_category.jpg" data-src="<?php echo base_url();?>public/home/images/banner_category.jpg" title="." alt=".">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-lock"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span></div>
         <div class="swiper-button-prev swiper-button-disabled swiper-button-lock"></div>
         <div class="swiper-button-next swiper-button-disabled swiper-button-lock"></div>
      </div>
   </div>
   <div class="fs-section breadcrum">
      <div class="fs-inr breadcrum-inr">
         <ul>
            <li><a href="<?php echo base_url().$this->config->item('index_page_add');?>" title="TRANG CHỦ">TRANG CHỦ</a></li>
            <?php
            $total = count($path);
            $p_str = '';
            for($i=1; $i<=$total; $i++){
                $p_str .= $i=='1' ? $path[$i]['category_slug'] :  '/'.$path[$i]['category_slug'];
                if($i>=$total)  {?>
            <li><span><?php echo $path[$i]['category_name'];?></span></li>
            <?php }
                }?>
            
         </ul>
      </div>
   </div>
   <div class="fs-section filters">
      <div class="fs-inr filter-inr">
         <div class="filter-nav">
            <ul>
               <li class="active">
                  <a href="javascript:void(0);" data-tab="1" class="white-arrow" title="loại Tai Nghe">loại Tai Nghe <span class="quantity-filter">(3)</span></a>
               </li>
               <li>
                  <a href="javascript:void(0);" data-tab="2" class="is-dropdow" title="nhu cầu">
                  nhu cầu<span class="quantity-filter">(3)</span>
                  </a>
               </li>
               <li>
                  <a href="javascript:void(0);" data-tab="3" class="is-dropdow" title="thương hiệu">thương hiệu <span class="quantity-filter">(3)</span></a>
               </li>
               <li>
                  <a href="javascript:void(0);" data-tab="4" class="is-dropdow" title="tính năng">
                  tính năng <span class="quantity-filter">(6)</span>
                  </a>
               </li>
               <li>
                  <a href="javascript:void(0);" data-tab="5" class="is-dropdow" title="giá tiền">
                  giá tiền
                  </a>
               </li>
               <li>
                  <a href="javascript:void(0);" data-tab="6" class="is-dropdow" title="hiển thị">
                  hiển thị
                  </a>
               </li>
               <li><span class="is-delete">XÓA BỘ LỌC</span></li>
            </ul>
            <div class="number-filter">
               <p><span class="quantity-product">86</span><span> SẢN PHẨM</span> PHÙ HỢP</p>
            </div>
         </div>
         <div class="filter-result">
            <div class="filter-item active js-filter" data-type="FilterSubCategoryId" data-tab="1">
               <ul>
                  <li class="all-filter active" data-id="0">Tất cả</li>
                  <li data-id="14">
                     Tai Nghe Nhét Tai
                  </li>
                  <li data-id="15">
                     Tai Nghe Chụp Tai
                  </li>
                  <li data-id="16">
                     Tai Nghe True Wireless
                  </li>
               </ul>
            </div>
            <div class="filter-sp">
               <div class="title-filter fs-sp">
                  <span class="btn-sort">LỌC SẢN PHẨM</span>
                  <span class="is-delete">XÓA BỘ LỌC</span>
                  <div class="close-filter-sp"></div>
               </div>
               <div class="items-sp">
                  <div class="filter-item js-filter" data-type="FilterDemandUsers" data-tab="2">
                     <div class="title-filter-sp">nhu cầu (3)</div>
                     <ul>
                        <li class="all-filter active" data-id="0">
                           Tất cả
                        </li>
                        <li data-id="18">
                           Tai nghe gaming
                        </li>
                        <li data-id="16">
                           Tai nghe thể thao
                        </li>
                        <li data-id="15">
                           Tai nghe kiểm âm
                        </li>
                     </ul>
                  </div>
                  <div class="filter-item js-filter" data-type="FilterBrands" data-tab="3">
                     <div class="title-filter-sp">thương hiệu (3)</div>
                     <ul>
                        <li class="all-filter active" data-id="0">Tất cả</li>
                        <li data-id="2">
                           JBL
                        </li>
                        <li data-id="1">
                           HARMAN/KARDON
                        </li>
                        <li data-id="6">
                           AKG
                        </li>
                     </ul>
                  </div>
                  <div class="filter-item js-filter" data-type="FilterFeatures" data-tab="4">
                     <div class="title-filter-sp">tính năng (6)</div>
                     <ul>
                        <li class="all-filter active" data-id="0">Tất cả</li>
                        <li data-id="1008">
                           Bluetooth
                        </li>
                        <li data-id="1011">
                           Kháng nước
                        </li>
                        <li data-id="1012">
                           Trợ lý Google
                        </li>
                        <li data-id="1016">
                           có Pin sạc
                        </li>
                        <li data-id="1020">
                           In-line mic
                        </li>
                        <li data-id="1020">
                           In-line mic
                        </li>
                     </ul>
                  </div>
                  <div class="filter-item by-tab-price js-price" data-tab="5">
                     <div class="title-filter-sp">  giá tiền</div>
                     <div class="fs-box-range">
                        <div class="price-from">
                           <span class="price-caption">TỪ</span>
                           <input id="min-price" type="text" class="price-value" value="">
                           <span class="pice-unit"><small>đ</small></span>
                        </div>
                        <div class="price-to">
                           <span class="price-caption">ĐẾN</span>
                           <input id="max-price" type="text" class="price-value" value="">
                           <span class="pice-unit"><small>đ</small></span>
                        </div>
                        <div class="fs-buts">
                           <button type="button" class="fs-but submit-price"><span>Áp dụng</span></button>
                        </div>
                     </div>
                     <ul class="js-price-list">
                        <li data-min="0" data-max="0" class="active">Tất cả các giá</li>
                        <li data-min="0" data-max="1000000" class="">
                           Dưới 1 triệu
                        </li>
                        <li data-min="1000000" data-max="3000000" class="">
                           Từ 1 đến 3 triệu
                        </li>
                        <li data-min="5000000" data-max="10000000" class="">
                           Từ 5 đến 10 triệu
                        </li>
                        <li data-min="10000000" data-max="20000000" class="">
                           Từ 10 đến 20 triệu
                        </li>
                        <li data-min="20000000" data-max="0" class="">
                           Trên 20 triệu
                        </li>
                        <li data-min="0" data-max="0" data-contact-price="true">Giá liên hệ</li>
                     </ul>
                  </div>
                  <div class="filter-item js-sort" data-tab="6">
                     <div class="title-filter-sp">hiển thị</div>
                     <ul>
                        <li data-sort="1" class="">
                           Mới ra mắt
                        </li>
                        <li data-sort="2" class="">
                           Giá cao đến thấp
                        </li>
                        <li data-sort="3" class="">
                           Giá thấp đến cao
                        </li>
                     </ul>
                  </div>
                  <div class="product-fit fs-sp">
                     <div class="fs-buts">
                        <button type="button" class="fs-but prd-fit"><span>86 SẢN PHẨM</span>PHÙ HỢP</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php echo $widget_product;?>
   <?php echo $widget_support;?>
</div>
<script>
    var filterModel = {
        CategoryId: 15,
        Page: 1,
        IsNext: true,
        FilterFeatures: null,
        FilterSubCategoryId: null,
        FilterDemandUsers: null,
        FilterBrands: null,
        MaxPrice: 0,
        MinPrice: 0,
        SortType: 0
    };
</script>

<?php echo $footer; ?>
<script src="<?php echo base_url();?>public/home/js/category.min.js"></script>
