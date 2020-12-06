<?php echo $header; ?>
<script type="text/javascript">
 	function check_email(order_email) {
	  var strReturn = "";	
	  jQuery.ajax({
		type:"POST",
		url: UrlDomain + "/order/checkmail",
		data: {member_email  : order_email},
		success: function(html) {
		  strReturn = html;
		},
		async:false
	  });
	
	  return strReturn;
	}
</script>
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
  <div class="row">
    <!-- Primary Content Starts -->
    <div class="col-md-12">
      <div class="panel panel-smart">
        <form action="<?php echo base_url().$this->config->item('index_page_add');?>order/send.html" method="post" enctype="multipart/form-data"  name="frmOrder" onsubmit="return submit_init();">
          <div class="row">
            <div class="col-md-12" style="margin-bottom:10px;"> Nếu bạn đã có tài khoản. Hãy <a style="color:#F00; font-weight:bold;" href="<?php echo base_url().$this->config->item('index_page_add');?>member/login.html">ĐĂNG NHẬP</a> để mua hàng thuận tiện hơn. </div>
            <div class="col-md-5">
              <h3 class="panel-heading innere">A. Thông tin đặt hàng</h3>
              <div style="padding-bottom:10px;"> <span class="badge">1</span> <strong>Thông tin liên hệ</strong> </div>
              <!-- begin thong tin thanh vien dat hang -->
              <div class="form-group" style="margin-bottom:5px;">
                <label for="order_fullname" style="font-weight:normal;">Họ và tên: </label>
                <input type="text" class="form-control" id="order_fullname" required name="order_fullname" value="<?php echo $buyer['order_fullname'];?>">
              </div>
              <div class="form-group" style="margin-bottom:5px;">
                <label for="order_address" style="font-weight:normal;">Địa chỉ:</label>
                <input type="text" class="form-control" id="order_address" required name="order_address" value="<?php echo $buyer['order_address'];?>">
              </div>
              <div class="form-group" style="margin-bottom:5px;">
                <label for="order_email" style="font-weight:normal;">Email:</label>
                <input type="text" class="form-control" id="order_email" required name="order_email" value="<?php echo $buyer['order_email'];?>">
              </div>
              <div class="form-group" style="margin-bottom:5px;">
                <label for="order_tel" style="font-weight:normal;">Điện thoại:</label>
                <input type="text" class="form-control" id="order_tel" required name="order_tel" value="<?php echo $buyer['order_tel'];?>">
              </div>
              <?php
				  $view_create_pass = '';
				  if($this->session->userdata('member_validated')){
					  $view_create_pass = 'style="display:none;"';
				  }
			  ?>
              <div class="checkbox" <?php echo $view_create_pass;?>>
                <label>
                <input id="checkcreatepass" name="checkcreatepass" type="checkbox">
                Tạo tài khoản cho lần sử dụng sau </label>
              </div>
              <div id="contentcreatepass" style="display:none;" class="form-inline">
                <div class="form-group" style="margin-bottom:5px;">
                  <input type="password" class="form-control" id="order_pass" name="order_pass" placeholder="Mật khẩu" value="" style="width:170px;">
                  <input type="password" class="form-control" id="order_repass" name="order_repass" placeholder="Xác nhận mật khẩu" value=""  style="width:170px;">
                </div>
              </div>
              <div class="checkbox">
                <label>
                <input id="checkcreateadd" name="checkcreateadd" type="checkbox">
                Giao hàng tới địa chỉ khác </label>
              </div>
              <div id="contentcreateadd" style="display:none;">
                <div class="form-group" style="margin-bottom:5px;">
                  <label for="other_fullname" style="font-weight:normal;">Họ và tên: </label>
                  <input type="text" class="form-control" id="other_fullname" name="other_fullname">
                </div>
                <div class="form-group" style="margin-bottom:5px;">
                  <label for="other_address" style="font-weight:normal;">Địa chỉ:</label>
                  <input type="text" class="form-control" id="other_address" name="other_address">
                </div>
                <div class="form-group" style="margin-bottom:5px;">
                  <label for="other_tel" style="font-weight:normal;">Điện thoại:</label>
                  <input type="text" class="form-control" id="other_tel" name="other_tel">
                </div>
              </div>
              <div style="padding-bottom:10px;"> <span class="badge">2</span> <strong>Phương thức thanh toán</strong> </div>
              <div class="radio">
                <label>
                <input name="order_method" type="radio" checked="checked" value="0">
                Tại địa chỉ nhận hàng </label>
                <label>
                <input name="order_method" type="radio" value="1">
                Chuyển khoản qua ngân hàng </label>
              </div>
              <div style="padding-bottom:10px;"> <span class="badge">3</span> <strong>Gửi lời nhắn</strong> </div>
              <div class="textarea">
                <textarea name="order_note" class="form-control" rows="3" placeholder="VD: Gọi điện trước khi giao hàng nhé..."></textarea>
              </div>
              <!-- end thong tin thanh vien dat hang -->
            </div>
            <div class="col-md-7">
              <h3 class="panel-heading innere">B. Thông tin giỏ hàng</h3>
              <div id="cartorder">
                <?php
							$cart = $this->cart->contents();
							?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td width="45%" align="center"  style="font-size:12px; text-transform:none;">Tên sản phẩm</td>
                      <td width="18%" align="center"  style="font-size:12px; text-transform:none;">Giá</td>
                      <td width="15%" align="center"  style="font-size:12px; text-transform:none;">Số lượng</td>
                      <td width="22%" align="center"  style="font-size:12px; text-transform:none;">Thành tiền</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
						foreach($cart as $item){
							$thanhtien = $item['qty'] * $item['price'];
					?>
                    <tr>
                      <td class="name"  style="font-size:12px;"><?php echo $item['name'];?> </td>
                      <td style="font-size:12px; text-align:right;"><?php echo number_format($item['price'],0);?> đ</td>
                      <td align="center"  style="font-size:12px;"><?php echo $item['qty'];?> </td>
                      <td style="font-size:12px; text-align:right;"><?php echo number_format($thanhtien,0);?> đ</td>
                    </tr>
                    <?php
									}
									?>
                    <tr>
                      <td align="right" colspan="2"><strong>Tổng cộng: </strong></td>
                      <td align="center"  class="tong"  style="font-size:12px;"><?php echo number_format($this->cart->total_items(),0);?></td>
                      <td align="center"  class="tong"  style="font-size:12px; text-align:right"><?php echo number_format($this->cart->total(),0);?> đ</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-md-12"> <a href="<?php echo base_url();?>giohang.html">
                  <button type="button" class="btn-proceed-checkout btn btn-black" style="margin-bottom:5px;"><span class="glyphicon glyphicon-shopping-cart"></span> Sửa giỏ hàng</button>
                  </a>
                  <button type="submit" class="btn btn-black btn-proceed-checkout" style="margin-bottom:5px;"><span class="glyphicon glyphicon-send"></span> Gửi đơn hàng</button>
                </div>
              </div>
              <div style="padding-top:30px;">
                <p><strong style="color:#F00;">Chú ý:</strong></p>
                <p style="padding-left:10px; line-height:30px;"> - Nhập đầy đủ thông tin của người đặt hàng.<br />
                  - Xem lại danh sách sản phẩm đã chọn.<br />
                  - Lựa chọn phương thức thanh toán phù hợp nhất.<br />
                  - Duyệt kỹ lại thông tin trước khi "<strong>Gửi đơn hàng</strong>".<br />
                </p>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php echo $footer; ?>