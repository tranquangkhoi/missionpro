<?php echo $header; ?>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
          <i class="fa fa-angle-right" aria-hidden="true"></i>
          <li><span>Thanh toán</span></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="main-cart-page main-container col1-layout" style="line-height:normal; padding-top:20px;">
  <div class="main container">
	  <div class="col-main cart_desktop_page cart-page min768">
	  	<?php
                        if($msg_order == "ok"){
                        ?>
                        <h1 style="font-size:30px; color:#ff4e00;">Bạn đã đặt hàng thành công.</h1>
                        <p style="font-size:12px;">Nhân viên của chúng tôi sẽ liên hệ với bạn sớm nhất để thực hiện giao hàng cho bạn</p>
                        <p><a href="<?php echo base_url();?>"><span href="#" class="btn btn-success btn-large">Chọn mua hàng tiếp</span></a></p>
                        <?php
                        }else{
                        ?>
                        <h1 style="font-size:30px; color:#ff4e00;">Có lỗi khi đặt hàng.</h1>
                        <p>Bạn hãy thực hiện lại quá trình gửi đơn hàng xem.</p>
                        <p><a href="<?php echo base_url();?>"><span href="#" class="btn btn-black btn-large">Gửl lại đơn hàng</span></a></p>                    
                        <?php
                        }
                        ?>
	  </div>
  </div>
</section>
<?php echo $footer; ?>