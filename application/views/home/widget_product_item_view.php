<?php foreach ($product_items as $item) {
	$dlink = base_url().$this->config->item('index_page_add').$item['product_path'].'.html';
    $giaban = $item['product_price'];
    $giagoc = $item['product_price_d'];
    $percent = $giagoc=='0' ? '50' : (100 - ceil($giaban*100/$giagoc));
?>
<div class="product-item">
	 <a href="<?php echo $dlink; ?>" data-sectionname="Sản Phẩm Nổi Bật" data-name="<?php echo $item['product_title'];?>">
	    <div class="product-pics">
	       <div class="fs-pic">
	          <img class="pic-lazy active" src="<?php echo base_url();?>public/upload/product/<?php echo 'medium_'.$item['product_image'];?>" data-src="<?php echo base_url();?>public/upload/product/<?php echo 'medium_'.$item['product_image'];?>" alt="<?php echo $item['product_title'];?>" title="<?php echo $item['product_title'];?>">
	       </div>
	    </div>
	    <div class="product-txt">
	       <h3><?php echo $item['product_title'];?></h3>
	    </div>
	    <div class="product_item_color_all">
	       <div class="active">
	          <div class="product-off-price active">
	             <div class="off-percent active">
	                <span class="line-throught"> <?php echo number_format($giaban, 0).' đ'?></span>  (-<?php echo $percent ?>% OFF)
	             </div>
	             <div class="price">
	                <?php echo $giaban>0 ? number_format($giaban, 0).' đ' : 'Liên hệ' ; ?>
	             </div>
	          </div>
	          <div class="fs-buts">
	             <div class="fs-but add-to-cart js-add-cart active" data-product-id="810" data-color-id="30" data-color="30">Thêm vào giỏ</div>
	          </div>
	       </div>
	    </div>
	 </a>
</div>
<?php
}
?>