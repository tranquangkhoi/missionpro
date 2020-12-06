<?php echo $header; ?>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
           <?php
                $total = count($path);  
                $p_str = '';
                for($i=1; $i<=$total; $i++){
                    $p_str .= $i=='1' ? $path[$i]['category_slug'] :  '/'.$path[$i]['category_slug'];
                    if($i<$total){
            ?>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <li><a href="<?php echo base_url().$this->config->item('index_page_add');?><?php echo $p_str;?>.html"><?php echo $path[$i]['category_name'];?></a></li>
            <?php
                }else{
            ?>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <li> <span><?php echo $path[$i]['category_name'];?></span></li>
            <?php
                }
            }
            ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="main-collection main-mr">
  <div class="container">
    <div class="col-main">
      <div class="row product_info">
       <!-- Left Starts -->
        <div class="col-sm-5 images-block">
          <p id="p<?php echo $productdetail->product_id;?>"> <a href="<?php echo base_url()?>public/upload/product/<?php echo $productdetail->product_image;?>"> <img src="<?php echo base_url()?>public/upload/product/<?php echo $productdetail->product_image;?>" alt="Image" class="img-responsive thumbnail" /> </a> </p>
          <?php 
            if(count($libimg)>0){
          ?>
          <ul class="list-unstyled list-inline">
            <?php
                $i = 0;
                foreach($libimg as $img){
                    $i = $i + 1;
                    if($i>4){ break; }
            ?>
            <li> <a href="<?php echo base_url()?>public/upload/product/<?php echo $img['image_name'];?>"> <img src="<?php echo base_url()?>public/upload/product/<?php echo 'small_'.$img['image_name'];?>" alt="Image" width="77" height="77" class="img-responsive thumbnail" /> </a> </li>
            <?php
                }
            ?>
          </ul>
          <?php
            }
          ?>
        </div>
        <!-- Left Ends -->
        <!-- Right Starts -->
        <div class="col-sm-7 product-details">
          <!-- Product Name Starts -->
          <h1><?php echo $productdetail->product_title;?></h1>
          <!-- Product Name Ends -->
          <hr />
          <!-- Manufacturer Starts -->
          <ul class="list-unstyled manufacturer">
            <li>
              <?php 
                $label_color = $productdetail->product_status==1 ? 'label-success' : 'label-default';
                $label_name = $productdetail->product_status==1 ? 'Có hàng' : 'Hết hàng';
                $giaban = $productdetail->product_price;
                $giagoc = $productdetail->product_price_d;
                $percent = $giagoc=='0' ? '50' : (100 - ceil($giaban*100/$giagoc));
              ?>
              <span>Trạng thái:</span> <strong class="label <?php echo $label_color;?>" style="padding:5px;"><?php echo $label_name;?></strong> </li>
          </ul>
          <!-- Manufacturer Ends -->
          <hr />
          <!-- Price Starts -->
          <div class="price-old"> <span class="price-head"><b>Giá gốc :</b></span> <span class="price-new" style="text-decoration: line-through;color:#999999"><?php echo $giaban>0 ? number_format($giagoc,0).' VNĐ' : '' ;?></span> </div>
          <div class="price"> <span class="price-head">Giá bán :</span> <span class="price-new"><?php echo $giaban>0 ? number_format($giaban,0).' VNĐ' : 'liên hệ' ;?></span> </div>
          <div class="price-old"> <span class="price-head"><b>Tiết kiệm :</b></span> <span class="price-new" style="color:#999999"><?php echo number_format($giagoc - $giaban) . '(' . $percent .'%)';?> </span> </div>
          <!-- Price Ends -->
          <hr />
          <div class="promotion-title">
            <h4>
              <!--<i class="ty-icon-gift"></i>-->
              Thông tin &amp; Khuyến mãi</h4>
          </div>
          <div class="ty-product-block__note">
            <p><span>✪</span> Giao hàng toàn quốc<br>
            </p>
            <p><span>✪</span> Thanh toán khi nhận hàng<br>
            </p>
            <p><span>✪</span> Đơn hàng trên 500.000đ miễn phí vận chuyển<br>
            </p>
            <p><span>✪</span> Thường xuyên có khuyến mãi cho thành viên<br>
            </p>
          </div>
          <?php
                if($productdetail->product_status==1){
            ?>
          <!-- Available Options Starts -->
          <div class="options">
            <div class="form-group">
              <label class="control-label text-uppercase" for="input-quantity">Số lượng:</label>
              <input type="text" name="qty<?php echo $productdetail->product_id;?>" value="1" size="2" id="qty<?php echo $productdetail->product_id;?>" class="form-control" />
            </div>
            <div class="cart-button button-group">
              <button type="button" class="btn btn-cart" onclick="tocart(<?php echo $productdetail->product_id;?>,document.getElementById('qty<?php echo $productdetail->product_id;?>').value)"> Đặt hàng <i class="fa fa-shopping-cart"></i> </button>
            </div>
          </div>
          <!-- Available Options Ends -->
          <hr />
          <?php } ?>
        </div>
        <!-- Right Ends -->
      </div>
	  <div class="row product_description">
        <div class="col-lg-12 col-xs-12 tab-product-des">
        <h4 class="heading">Chi tiết sản phẩm</h4>
        <div class="content panel-smart">
          <?php
            $pcontent = $productdetail->product_content; 
            
            foreach($autocode as $key=>$val){
                $code = trim($key);
                $code_content = $val;
                $pcontent = str_replace($code,$code_content,$pcontent);
            }
            
            echo $pcontent;
            $tag_arr = explode(",",$tags);
            if(count($tag_arr)>0){
          ?>
          <p style="border-top:dotted 1px #333333; margin-top:20px; padding-top:10px;"><strong>Tags : </strong>
            <?php 
               foreach($tag_arr as $key=>$val){
                   $val = trim($val);
                   $qtxt = str_replace(' ','+',$val);
             ?>
            <span><a style="color: #056bac;" href="<?php echo base_url()?>search.html?qsearch=<?php echo $qtxt; ?>" target="_blank"><?php echo $val.",&nbsp;&nbsp;"; ?></a></span>
            <?php
                 }
             ?>
          </p>
          <?php
            }
          ?>
         </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</section>
<?php echo $footer; ?>