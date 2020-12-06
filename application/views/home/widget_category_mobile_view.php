<ul id="Mobile_menu" class="block topnavmobile">
   <!-- link collection -->
   <?php
      $ci = count($cate_one);
      for($i=1; $i<=$ci; $i++){
      ?>
   <li class="level0 level-top parent">
      <a href="<?php echo base_url().''.$cate_one[$i]['category_slug'].'.html';?>"><?php echo $cate_one[$i]['category_name']; ?></a>
      <ul class="level0" style="display:none;">
         <?php
            $cj = count($cate_two);
                for($j=1; $j<=$cj; $j++){
                    if($cate_two[$j]['category_parent'] == $cate_one[$i]['category_id']){
            ?>
         <li class="level1">
            <a href="<?php echo base_url().$cate_one[$i]['category_slug'].'/'.$cate_two[$j]['category_slug'].'.html'; ?>">
            <span><?php echo $cate_two[$j]['category_name']; ?></span>
            </a>
            <ul class="level1" style="display:none;">
               <?php
                  $ck = count($cate_three);
                      for($k=1; $k<=$ck; $k++){
                          if($cate_three[$k]['category_parent'] == $cate_two[$j]['category_id']){
                  ?>
               <li class="level2">
                  <a href="<?php echo base_url().$cate_one[$i]['category_slug'].'/'.$cate_two[$j]['category_slug'].'/'.$cate_three[$k]['category_slug'].'.html'; ?>">
                  <span><?php echo $cate_three[$k]['category_name']; ?></span>
                  </a>
               </li>
               <?php }
                  }
                  ?>
            </ul>
         </li>
         <?php 
            }
            }
            ?>
      </ul>
   </li>
   <?php
      }
      ?>
</ul>
<div class="bl_danhmucsanpham hidden-xs">
   <div class="block-content">
      <ul>
         <?php
            $ci = count($cate_one);
            for($i=1; $i<=$ci; $i++){
            	if(!isset($pcate[$cate_one[$i]['category_id']])){
            ?>
         <li class="level0 parent">
            <a href="<?php echo base_url().''.$cate_one[$i]['category_slug'].'.html'; ?>">
            <i class="fa fa-caret-right" aria-hidden="true"></i>
            <span><?php echo $cate_one[$i]['category_name']; ?></span>
            </a>
         </li>
         <?php
            } else {
            ?>
         <li class="level0 parent">
            <a href="<?php echo base_url().''.$cate_one[$i]['category_slug'].'.html';?>">
            <i class="fa fa-caret-right" aria-hidden="true"></i>
            <span><?php echo $cate_one[$i]['category_name']; ?></span>
            </a>
            <ul class="level1">
               <?php
                  $cj = count($cate_two);
                  	for($j=1; $j<=$cj; $j++){
                  		if($cate_two[$j]['category_parent'] == $cate_one[$i]['category_id']){
                  ?>
               <li class="level1">
                  <a href="<?php echo base_url().$cate_one[$i]['category_slug'].'/'.$cate_two[$j]['category_slug'].'.html'; ?>">
                  <span><?php echo $cate_two[$j]['category_name']; ?></span>
                  </a>
               </li>
               <?php 
                  }
                  }
                  ?>
            </ul>
         </li>
         <?php 		
            }
            }
            ?>
      </ul>
   </div>
</div>