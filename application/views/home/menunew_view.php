<div id="danhmuc_tintuc" class="block-title-dm-blog">
    <h5> DANH MỤC TIN TỨC</h5>
  </div>
  <div id="menu_danhmuc_tintuc" class="list_dm_tin_tuc">
    <ul>
    <?php
        foreach($new_menu as $item){
    ?>
      <li><a href="<?php echo base_url().$this->config->item('index_page_add').'news/'.$item['newcate_slug'].'.html'; ?>"><?php echo $item['newcate_name'];?></a></li>
    <?php
        }
    ?>
    </ul>
</div>