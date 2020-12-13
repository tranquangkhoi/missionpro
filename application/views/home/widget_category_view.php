<div class="side-content tab-item" data-tab="1">
   <div class="side-inr">
      <div class="side-nav tab-inr">
         <ul class="fs-sp side-tab">
            <?php
               $ci = count($cate_one);
               for($i=1; $i<=$ci; $i++){
               ?>
            <li class="has-child" data-cate="cat_<?php echo $cate_one[$i]['category_id'] ?>">
               <a href="<?php echo base_url().''.$cate_one[$i]['category_slug'].'.html';?>" title="<?php echo $cate_one[$i]['category_name']; ?>">
               <?php echo $cate_one[$i]['category_name']; ?>
               <span class="icon">
               <img width="16" height="22" class="cmPic" src="<?php echo base_url();?>public/upload/category/<?php echo $cate_one[$i]['category_icon']?>" data-src="<?php echo base_url();?>public/upload/category/<?php echo $cate_one[$i]['category_icon']?>" title="<?php echo $cate_one[$i]['category_name']; ?>" alt="<?php echo $cate_one[$i]['category_name']; ?>">
               <img width="16" height="22" class="cmPic img-active" src="<?php echo base_url();?>public/upload/category/<?php echo $cate_one[$i]['category_icon']?>" data-src="<?php echo base_url();?>public/upload/category/<?php echo $cate_one[$i]['category_icon']?>" title="<?php echo $cate_one[$i]['category_name']; ?>" alt="<?php echo $cate_one[$i]['category_name']; ?>">
               </span>
               </a>
            </li>
            <?php
               }
               ?>
            <li class="fs-sp line-sp">
               <a href="https://misionpro.com.vn/promotion" title="Ưu đãi">
               Ưu đãi
               <span class="icon fs-sp">
               <img width="20" height="20" class="cmPic" src="<?php echo base_url();?>public/home/images/side-icon-gift.png" data-src="/<?php echo base_url();?>public/home/images/side-icon-gift.png" title="Ưu đãi" alt="Ưu đãi">
               <img width="20" height="20" class="img-active cmPic" src="<?php echo base_url();?>public/home/images/side-icon-gift-active.png" data-src="/<?php echo base_url();?>public/home/images/side-icon-gift-active.png" title="Ưu đãi" alt="Ưu đãi">
               </span>
               </a>
            </li>
            <li class="fs-sp line-sp">
               <a href="https://misionpro.com.vn/cua-hang" title="Cửa hàng">
               Cửa hàng
               <span class="icon fs-sp">
               <img width="23" height="20" class="cmPic" src="<?php echo base_url();?>public/home/images/side-icon-store.png" data-src="/<?php echo base_url();?>public/home/images/side-icon-store.png" title="Cửa hàng" alt="Cửa hàng">
               <img width="23" height="20" class="img-active cmPic" src="<?php echo base_url();?>public/home/images/side-icon-store-active.png" data-src="/<?php echo base_url();?>public/home/images/side-icon-store-active.png" title="Cửa hàng" alt="Cửa hàng">
               </span>
               </a>
            </li>
         </ul>
         <ul class="side-tab-target">
            <?php
               $ci = count($cate_one);
               for($i=1; $i<=$ci; $i++){
               ?>
            <li class="has-child" data-cate="cat_<?php echo $cate_one[$i]['category_id'] ?>">
               <a class="fs-pc" href="<?php echo base_url().''.$cate_one[$i]['category_slug'].'.html';?>" title="<?php echo $cate_one[$i]['category_name']; ?>">
               <?php echo $cate_one[$i]['category_name']; ?>
               <span class="icon">
               <?php if (!empty($cate_one[$i]['category_icon'])) { ?>
               <img width="16" height="22" class="cmPic" src="<?php echo base_url();?>public/upload/category/<?php echo $cate_one[$i]['category_icon']?>" data-src="<?php echo base_url();?>public/upload/category/<?php echo $cate_one[$i]['category_icon']?>" title="<?php echo $cate_one[$i]['category_name']; ?>" alt="<?php echo $cate_one[$i]['category_name']; ?>">
               <img width="16" height="22" class="cmPic img-active" src="<?php echo base_url();?>public/upload/category/<?php echo $cate_one[$i]['category_icon']?>" data-src="<?php echo base_url();?>public/upload/category/<?php echo $cate_one[$i]['category_icon']?>" title="<?php echo $cate_one[$i]['category_name']; ?>" alt="<?php echo $cate_one[$i]['category_name']; ?>">
               </span>
               <?php } ?>
               </a>
               <div class="child-items">
                  <div class="fs-sp name-category-box">
                     <div class="name-cate"><?php echo $cate_one[$i]['category_name']; ?></div>
                     <a href="<?php echo base_url().''.$cate_one[$i]['category_slug'].'.html';?>" title="XEM TẤT CẢ">XEM TẤT CẢ</a>
                  </div>
                  <ul>
                     <?php
                        $cj = count($cate_two);
                        $index = 0;
                         for($j=1; $j<=$cj; $j++){
                             if($cate_two[$j]['category_parent'] == $cate_one[$i]['category_id']){
                              $index ++;
                        ?>
                     <li>
                        <a href="<?php echo base_url().$cate_one[$i]['category_slug'].'/'.$cate_two[$j]['category_slug'].'.html'; ?>" title="<?php echo $cate_two[$j]['category_name']; ?>">
                        <?php if (!empty($cate_two[$j]['category_icon'])) { ?>
                        <span class="side-pic">
                        <img width="21" height="46" class="cmPic" src="<?php echo base_url();?>public/upload/category/<?php echo $cate_two[$j]['category_icon']?>" data-src="<?php echo base_url();?>public/upload/category/<?php echo $cate_two[$j]['category_icon']?>" title="<?php echo $cate_two[$j]['category_name']; ?>" alt="<?php echo $cate_two[$j]['category_name']; ?>">
                        </span>
                        <?php } ?>
                        <span class="side-txt"><?php echo $cate_two[$j]['category_name']; ?></span>
                        </a>
                     </li>
                     <?php 
                        } 
                     }
                     ?>
                  </ul>
               </div>
            </li>
            <?php
               }
               ?>
         </ul>
      </div>
      <div class="side-voucher fs-pc">
         <div class="voucher-inr">
            <div class="small-title">TẶNG NGAY 100<small>K</small></div>
            <p>Khi đăng ký thành viên</p>
            <div class="fs-but voucher-register-but">
               <a style="color: white;" href="#">
               đăng ký ngay
               </a>
            </div>
         </div>
      </div>
   </div>
</div>