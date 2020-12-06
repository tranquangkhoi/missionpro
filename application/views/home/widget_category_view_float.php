<div class="col-lg-3 col-md-4 hidden-sm-down nav-inner">
<div class="col-lg-12 col-md-12 nav-drop">
  <div class="title-menu-bar">
    <div class="" > <span class="title-bar"></span><a id="showmenu">Danh mục sản phẩm</a> </div>
  </div>
  <div id="menucontentother" class="col-lg-12 col-md-12 cate-sidebar sider_bar_page" role="menu" style="display: none;">
    <ul class="site-nav vertical-nav ">
    <?php
        $ci = count($cate_one);
        for($i=1; $i<=$ci; $i++){
    ?>
      <li class="nav-item icon" data-submenu-id="sub-<?php echo $i?>">
        <a href="<?php echo base_url().''.$cate_one[$i]['category_slug'].'.html';?>" alt="">
            <i class="fa fa-caret-right" aria-hidden="true"></i>
            <span><?php echo $cate_one[$i]['category_name']; ?></span>
        </a>
        <?php if(isset($pcate[$cate_one[$i]['category_id']])){?>
        <div class="submenu hidden-md-down" id="sub-<?php echo $i?>">
          <ul class="menu-list-cate2">
            <div class="row row-noGutter">
            <?php
                $cj = count($cate_two);
                    for($j=1; $j<=$cj; $j++){
                        if($cate_two[$j]['category_parent'] == $cate_one[$i]['category_id']){
            ?>
              <div class="col-md-4 text-xs-left">
                <ul class="text-left">
                  <span>
                    <a href="<?php echo base_url().$cate_one[$i]['category_slug'].'/'.$cate_two[$j]['category_slug'].'.html'; ?>"><?php echo $cate_two[$j]['category_name']; ?></a>
                  </span>
                  <?php
                    $ck = count($cate_three);
                        for($k=1; $k<=$ck; $k++){
                            if($cate_three[$k]['category_parent'] == $cate_two[$j]['category_id']){
                  ?>
                  <li><a href="<?php echo base_url().$cate_one[$i]['category_slug'].'/'.$cate_two[$j]['category_slug'].'/'.$cate_three[$k]['category_slug'].'.html'; ?>"><?php echo $cate_three[$k]['category_name']; ?></a></li>
                  <?php     }
                        }
                  ?>
                </ul>
              </div>
              
            <?php }
                }
            ?>
            </div>
          </ul>
        </div>
        <?php }?>
      </li>
    <?php 
        }
    ?>
      <li class="nav-item more-view" style="display:none;">
        <div class="icon"><img src="<?php echo base_url();?>public/home/images/xemthem.png?1488253630693" alt="Xem thêm"></div>
        <a href="/collections/all" alt=""><span>Xem thêm</span></a> </li>
    </ul>
  </div>
  <script>
    $(document).ready(function() {
        $('#showmenu').click(function() {
            $('#menucontentother').slideToggle('300');
            return false;
        });
    });
    $(".nav-drop").mouseenter(function() {
          $("#menucontentother").show();
    }).mouseleave(function() {
          $("#menucontentother").hide();
    });
  </script>
</div>
</div>