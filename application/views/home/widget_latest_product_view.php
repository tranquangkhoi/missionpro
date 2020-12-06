<div class="sanphambanchay block">
	<div class="block-title">
		<h2 class="fw600"><a href="#"><span>Sản phẩm mới nhất</span></a></h2>
	</div>
	<div class="block-content bd_old">
		<div class="item">
		<?php
			foreach($latest_product as $item){
				$dlink = base_url().$this->config->item('index_page_add').$item['product_path'].'.html';
				$giaban = number_format($item['product_price'],0);
				$giagoc = number_format($item['product_price_d'],0);						
		?>
			<div class="product-loop-list">
				<div class="prd-loop-list">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 loop-img pd0">
						<a href="<?php echo $dlink;?>">
							<img src="<?php echo base_url();?>public/upload/product/<?php echo $item['product_image'];?>" title="<?php echo $item['product_title'];?>" alt="<?php echo $item['product_title'];?>" width="100" height="100">
						</a>
					</div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 loop-content">
                      	<h3 class="item-name">
                      		<a href='<?php echo $dlink;?>'><?php echo $item['product_title'];?></a>
                      	</h3>
                      	<div class="price-box text_to_left">
                        	<span class="special-price">
                        		<span class="price"><?php echo $giaban; ?></span>
                        	</span>
                        	<span class="old-price">
                        		<span class="price"><?php echo $giagoc; ?></span>
                        	</span>
                      	</div>
                    </div>
                  </div>
                </div>
            <?php
			}
            ?>    
		</div>
	</div>
</div>