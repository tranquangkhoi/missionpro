 <?php echo $header; ?>
 <div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <li><span>Tìm kiếm</span></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="main-collection main-collection-v">
  <div class="container">
  <?php 
	if(count($product_items )>0){
	?>
    <div class="row _collection">
      <div class="category-products _collection_grid_item">
	  <div class="title_search">
			<h3 class="name_title">Tìm thấy <?php echo $total_search ?> kết quả của từ khoá " <font color="#ff0000"><?php echo $key_search; ?></font> "</h3>
		</div>
        <section class="col-lg-12 col-md-12 col-sm-12 article content-grid col_collection_grid_item">
          <div class="col-lg-12 col-md-12 hidden-sm-down  collection_header"> <!-- Main Heading Starts -->
            <div class="toolbar">
              <div class="sorter">
                <div class="view-mode">
                <?php
                    $grid_active = $type == 'grid' ? 'active' : '';
                    $list_active = $type == 'list' ? 'active' : '';
                ?>
                   <a href="<?php echo current_url().'?qsearch='.$key_search.'&type=grid&sort='.$sort;?>" title="Lưới" class="collection_btn <?php echo $grid_active?>">
                        <i class="fa fa-th" aria-hidden="true"></i>
                    </a>
                    <a href="<?php echo current_url().'?qsearch='.$key_search.'&type=list&sort='.$sort;?>" title="Danh sách" class="switch-view collection_btn <?php echo $list_active?>">
                        <i class="fa fa-th-list" aria-hidden="true"></i>
                    </a>
                </div>
              </div>
              <div id="sort-by">
                <label class="left">Sắp xếp theo : </label>
                <select name="sort" onchange="if (this.value) window.location.href=this.value" style="border:solid 1px #CCCCCC; height:30px;">
                    <?php echo $select_sort; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 collection_container list-items">
            <div>
               <?php
                if(count($product_items )>0){
                    $i=0;
                    foreach($product_items as $item){
                        $i = $i  +1;
                        $dlink = base_url().$this->config->item('index_page_add').$item['product_path'].'.html';
                        $giaban = $item['product_price'];
                        $giagoc = $item['product_price_d'];
                        $percent = $giagoc=='0' ? '50' : (100 - ceil($giaban*100/$giagoc));
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 item_loop_list">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 item_loop_list_img" id="p<?php echo $item['product_id'];?>">
                      <a href="<?php echo $dlink; ?>" title="<?php echo $item['product_title'];?>">
                        <img src="<?php echo base_url();?>public/upload/product/<?php echo 'medium_'.$item['product_image'];?>" alt="<?php echo $item['product_title'];?>">
                      </a>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 item_loop_list_info">
                    <div class="item_loop_list_title fs15">
                      <h3 class="fw_600"><a href="<?php echo $dlink; ?>" title="<?php echo $item['product_title'];?>"><?php echo $item['product_title'];?></a></h3>
                    </div>
                    <div class="item_loop_list_price cl_red fw_600 fs15">
                      <div class="item-price">
                        <div class="price-box">
                          <p class="special-price"> <span class="price"><?php echo number_format($item['product_price'],0); ?></span></p>
                        </div>
                      </div>
                    </div>
                    <div class="item_loop_list_content hidden-sm-down">
                      <p><?php echo word_limiter(strip_tags($item['product_review']),100);?></p>
                    </div>
                    <div class="btns-list">
                      <div class="actions">
                      <?php
                            if($item['product_status']=='1'){
                        ?>
                         <button class="btn_muangay_list add_to_cart btn_item_loop_list" onclick="tocart(<?php echo $item['product_id'];?>,'1')" title="Mua ngay"><span><i class="fa fa-shopping-cart" aria-hidden="true"></i> Mua ngay</span></button>
                       <?php }
                       else{
                      ?>
                        <button class="btn-buy btn-cus" title="Cháy hàng"><span>Cháy hàng</span></button>
                      <?php }?>
                      </div>
                      <button class="btn_item_loop_list btn_xemchitiet" title="Xem chi tiết" onclick="location.href='<?php echo $dlink; ?>'"><span>Xem chi tiết</span></button>
                    </div>
                  </div>
                </div>
                <?php }
                }
                ?>
              </div>
          </div>
          <div class="paginate-pages">
            <div class="pager">
              <div class="pages">
              <?php echo $pagination; ?>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
	<?php }else{
					echo '<div class="col-sm-12" style="text-align:center; color:red; margin:10px;">Không tìm thấy kết quả nào. Mời bạn tìm lại</div>';
				}?>
  </div>
</section>

<?php echo $footer; ?>