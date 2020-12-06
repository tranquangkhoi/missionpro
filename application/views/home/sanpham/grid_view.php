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
            <li>
                <a title="Quay lại trang chủ" href="<?php echo base_url().$this->config->item('index_page_add');?><?php echo $p_str;?>.html"><?php echo $path[$i]['category_name'];?></a>
            </li>
            <?php
                } else {?>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <li><span><?php echo $path[$i]['category_name'];?></span></li>
            <?php }
                }?>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="main-collection main-collection-v">
  <div class="container">
    <div class="row _collection">
      <div class="category-products _collection_grid_item">
        <section class="col-lg-12 col-md-12 col-sm-12 article content-grid col_collection_grid_item">
          <div class="col-lg-12 col-md-12 hidden-sm-down  collection_header"> <!-- Main Heading Starts -->
                <h1 class="main-heading2">
                    <?php echo $category_name_crr;?>
                </h1>
                <?php
                if(isset($pcate[$category_id_crr])){
                ?>
                <div style="margin-bottom:10px;">
                     <?php
                    $cj = count($cate_two);
                    for($j=1; $j<=$cj; $j++){
                        if($cate_two[$j]['category_parent'] == $category_id_crr){
                    ?>
                            <a href="<?php echo base_url().$category_slug_crr.'/'.$cate_two[$j]['category_slug'].'.html'; ?>"><button type="button" class="btn btn-default btn-cate"><?php echo $cate_two[$j]['category_name']; ?></button></a>
                    <?php
                        }
                    }
                    ?>
                </div>
                <?php
                }
                ?>
            <div class="toolbar">
              <div class="sorter">
                <div class="view-mode">
                <?php
                    $grid_active = $type == 'grid' ? 'active' : '';
                    $list_active = $type == 'list' ? 'active' : '';
                ?>
                    <a href="<?php echo current_url().'?type=grid&sort='.$sort;?>" title="Lưới" class="collection_btn <?php echo $grid_active?>">
                        <i class="fa fa-th" aria-hidden="true"></i>
                    </a>
                    <a href="<?php echo current_url().'?type=list&sort='.$sort;?>" title="Danh sách" class="switch-view collection_btn <?php echo $list_active?>">
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
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collection_container grid_item collection_gird_item_number">
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
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 loop-grid collection_product_item_loop">
              <div class="col-item product-loop-grid product_loop_gird_number">
                <div class="item-inner">
                  <div class="product-box product-mini product_collection_grid">
				  <div class="discount_percent"><?php echo $percent;?><span>% </span></div> 
                    <h3 class="product-name"><a href="<?php echo $dlink; ?>" title="<?php echo $item['product_title'];?>"><?php echo $item['product_title'];?></a></h3>
                    <div class="product-thumbnail" id="p<?php echo $item['product_id'];?>">
                        <a href="<?php echo $dlink; ?>" title="<?php echo $item['product_title'];?>"> <img src="<?php echo base_url();?>public/upload/product/<?php echo 'medium_'.$item['product_image'];?>" alt="<?php echo $item['product_title'];?>" style="padding-top: 5px;"> </a>
                    </div>
                    <div class="item-content">
                      <div class="item-price">
                        <div class="price-box">
                          <p class="special-price"> <span class="price"><?php echo $giaban>0 ? number_format($giaban, 0).' VNĐ' : 'Liên hệ' ; ?></span></p>
                        </div>
                      </div>
                    </div>
                     <div class="view_buy">
                        <div class="actions">
                            <?php
                                if($item['product_status']=='1'){
                            ?>
                            <button onclick="tocart(<?php echo $item['product_id'];?>,'1')" class="btn-buy btn-cus add_to_cart novariant" title="Mua ngay">
                              <span><i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng</span>
                            </button>
                            <?php }else{
                              ?>
                            <button class="btn-buy btn-cus" title="Cháy hàng"><span>Cháy hàng</span></button>
                            <?php }?>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
           <?php }
                }?>
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
  </div>
</section>

<?php echo $footer; ?>