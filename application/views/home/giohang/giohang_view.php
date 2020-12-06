<?php echo $header; ?>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
          <i class="fa fa-angle-right" aria-hidden="true"></i>
          <li><span>Giỏ hàng</span></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="main-cart-page main-container col1-layout">
<?php
	$cart = $this->cart->contents();
	if(count($cart)>0){					
?>
  <div class="main container">
    <div class="col-main cart_desktop_page cart-page min768">
      <div class="cart page_cart min768">
        <form action="<?php echo base_url().$this->config->item('index_page_add');?>giohang/update" method="post" id="frmOrder"enctype="multipart/form-data">
          <div class="bg-scroll">
            <div class="cart-thead">
              <div style="width: 17%">Ảnh sản phẩm</div>
              <div style="width: 33%"><span class="nobr">Tên sản phẩm</span></div>
              <div style="width: 15%" class="a-center"><span class="nobr">Đơn giá</span></div>
              <div style="width: 14%" class="a-center">Số lượng</div>
              <div style="width: 15%" class="a-center">Thành tiền</div>
              <div style="width: 6%">Xoá</div>
            </div>
            <div class="cart-tbody">
			  <?php
				foreach($cart as $item){
					$img = base_url().'public/upload/product/medium_'.$cart_image[$item['rowid']];							
					$thanhtien = $item['qty'] * $item['price'];
					$dlink = base_url().$this->config->item('index_page_add').'san-pham/chi-tiet/'.$cart_slug[$item['rowid']].'.html';
			  ?>	  
              <div class="item-cart">
                <div style="width: 17%" class="image"><a class="product-image" title="<?php echo $item['name'];?>" href="<?php echo $dlink;?>"><img width="100" height="auto" alt="<?php echo $item['name'];?>" src="<?php echo $img;?>"></a></div>
                <div style="width: 33%" class="a-center">
                  <h2 class="product-name"> <a href="<?php echo $dlink;?>"><?php echo $item['name'];?></a> </h2>
                  <span class="variant-title" style="display: none;">Default Title</span></div>
                <div style="width: 15%" class="a-center"><span class="item-price"> <span class="price"><?php echo number_format($item['price'],0);?> ₫</span></span></div>
                <div style="width: 14%" class="a-center">
                  <div class="input_qty_pr">
                    <button onclick="var result = document.getElementById('qtyItem<?php echo $item['id'];?>'); var qtyItem<?php echo $item['id'];?> = result.value; if( !isNaN( qtyItem<?php echo $item['id'];?> ) && qtyItem<?php echo $item['id'];?> > 1 ) result.value--;return false;" class="reduced_pop items-count btn-minus" type="button">–</button>
                    <input type="text" maxlength="12" min="0" class="input-text number-sidebar input_pop input_pop qtyItem6636197" id="qtyItem<?php echo $item['id'];?>" name="quantity<?php echo $item['id'];?>" size="4" value="<?php echo $item['qty'];?>">
                    <button onclick="var result = document.getElementById('qtyItem<?php echo $item['id'];?>'); var qtyItem<?php echo $item['id'];?> = result.value; if( !isNaN( qtyItem<?php echo $item['id'];?> )) result.value++;return false;" class="increase_pop items-count btn-plus" type="button">+</button>
                  </div>
                </div>
                <div style="width: 15%" class="a-center"><span class="cart-price"> <span class="price"><?php echo number_format($thanhtien,0);?>₫</span> </span></div>
                <div style="width: 6%"><a class="button remove-item remove-item-cart" title="Xóa" href="<?php echo base_url().'giohang/del/'.$item['id'];?>" role="button"><span><span>Xóa</span></span></a></div>
              </div>
			  <?php
				}
			  ?>
            </div>
          </div>
        </form>
        <div class="cart-collaterals cart_submit row">
          <div class="totals col-sm-6 col-md-5 col-xs-12 col-md-offset-7">
            <div class="totals">
              <div class="inner">
                <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                  <colgroup>
                  <col>
                  <col>
                  </colgroup>
                  <tfoot>
                    <tr>
                      <td colspan="1" class="a-left"><strong>Tổng tiền</strong></td>
                      <td class="a-right"><strong><span class="totals_price price"><?php echo number_format($this->cart->total(),0);?>₫</span></strong></td>
                    </tr>
                  </tfoot>
                </table>
                <ul class="checkout">
                  <li>
                    <button class="button btn-proceed-checkout" title="cập nhật giỏ hàng" type="button" onclick="document.getElementById('frmOrder').submit()"><span>Cập nhật giỏ hàng</span></button>
                  </li>
                  <li>
                    <button class="button btn-proceed-checkout" title="Tiến hành đặt hàng" type="button" onclick="window.location.href='<?php echo base_url();?>order.html'"><span>Thanh toán</span></button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cart-mobile max767">
    <form action="<?php echo base_url().$this->config->item('index_page_add');?>giohang/update" method="post" enctype="multipart/form-data" id='frmMobileOrder'>
      <div class="header-cart" style="background:#fff;">
        <div class="title-cart">
          <h3>Giỏ hàng của bạn</h3>
          <p>( <?php echo number_format($this->cart->total_items(),0);?> sản phẩm)</p>
        </div>
      </div>
      <div class="header-cart-content" style="background:#fff;">
        <div class="cart_page_mobile max767 content-product-list">
		<?php
			foreach($cart as $item){
				$img = base_url().'public/upload/product/small_'.$cart_image[$item['rowid']];							
				$thanhtien = $item['qty'] * $item['price'];
				$dlink = base_url().$this->config->item('index_page_add').'san-pham/chi-tiet/'.$cart_slug[$item['rowid']].'.html';
		?>
          <div class="item-product item productid-6636197 ">
            <div class="item-product-cart-mobile"><a href="<?php echo $dlink;?>"> </a><a class="product-images" href="" title="LG V10 H960"><img width="80" height="150" alt="" src="<?php echo $img;?>"></a></div>
            <div class="title-product-cart-mobile">
              <h3><a href="<?php echo $dlink;?>" title="<?php echo $item['name'];?>"><?php echo $item['name'];?></a></h3>
              <p>Giá: <span><?php echo number_format($item['price'],0);?>₫</span></p>
            </div>
            <div class="select-item-qty-mobile">
              <div class="txt_center">
                <button onclick="var result = document.getElementById('qtyMobile<?php echo $item['id'];?>'); var qtyMobile<?php echo $item['id'];?> = result.value; if( !isNaN( qtyMobile<?php echo $item['id'];?> ) && qtyMobile<?php echo $item['id'];?> > 0 ) result.value--;return false;" class="reduced items-count btn-minus" type="button">–</button>
                <input type="text" maxlength="12" min="0" class="input-text number-sidebar qtyMobile<?php echo $item['id'];?>" id="qtyMobile<?php echo $item['id'];?>" name="quantity<?php echo $item['id'];?>" value="<?php echo $item['qty'];?>" size="4">
                <button onclick="var result = document.getElementById('qtyMobile<?php echo $item['id'];?>'); var qtyMobile<?php echo $item['id'];?> = result.value; if( !isNaN( qtyMobile<?php echo $item['id'];?> )) result.value++;return false;" class="increase items-count btn-plus" type="button">+</button>
              </div>
              <a class="button remove-item remove-item-cart" href="<?php echo base_url().'giohang/del/'.$item['id'];?>" data-id="<?php echo $item['id'];?>">Xoá</a></div>
          </div>
		  <?php
			}
		  ?>
        </div>
        <div class="header-cart-price" style="">
          <div class="title-cart ">
            <h3 class="text-xs-left">Tổng tiền</h3>
            <a class="text-xs-right totals_price_mobile"><?php echo number_format($this->cart->total(),0);?>₫</a></div>
          <div class="checkout">
            <button class="btn-proceed-checkout-mobile" title="Tiến hành thanh toán" type="button" onclick="document.getElementById('frmMobileOrder').submit()"><span>Cập nhật giỏ hàng</span></button>
            <button class="btn-proceed-checkout-mobile" title="Tiến hành thanh toán" type="button" style="margin-top:10px" onclick="window.location.href='<?php echo base_url();?>order.html'"><span>Tiến hành thanh toán</span></button>
          </div>
        </div>
      </div>
    </form>
  </div>
<?php
  }else{
  ?>
  <div class="container">
    <div class="row">
      <div class="inner">
		<p style="color:#FF0000; line-height:30px; padding-left:15px;"> Giỏ hàng của bạn chưa có sản phẩm nào. Mời bạn xem và chọn hàng nhé.</p>
	  </div>
	 </div>
   </div>
  <?php
  }
  ?>
</section>
<?php echo $footer; ?>