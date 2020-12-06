<?php
$block_name = array(
	'0' => 'Giới thiệu',
	'1' => 'Chính sách bán hàng',
	'2' => 'Đặt hàng & thanh toán'
);
$block = array(
	'0' => 'gioi-thieu',
	'1' => 'chinh-sach',
	'2' => 'thanh-toan'
);
?>
<div class="block-title-dm-blog">
    <h5> <?php echo $block_name[$intro_block];?></h5>
  </div>
  <div id="menu_danhmuc_tintuc" class="list_dm_tin_tuc">
    <ul>
    <?php
		foreach($intro_menu as $intro_item){
	?>
      <li><a href="<?php echo base_url().$this->config->item('index_page_add');?><?php echo $block[$intro_block];?>/<?php echo $intro_item['intro_slug'].'.html'; ?>"><?php echo $intro_item['intro_title'];?></a></li>
    <?php
        }
    ?>
    </ul>
</div>

<div class="block-title-dm-blog">
    <h5> <?php echo $block_name[$intro_block_two];?></h5>
  </div>
  <div id="menu_danhmuc_tintuc" class="list_dm_tin_tuc">
    <ul>
     <?php
		foreach($intro_menu_two as $intro_item){
	?>
      <li><a href="<?php echo base_url().$this->config->item('index_page_add');?><?php echo $block[$intro_block_two];?>/<?php echo $intro_item['intro_slug'].'.html'; ?>"><?php echo $intro_item['intro_title'];?></a></li>
    <?php
        }
    ?>
    </ul>
</div>