<?php echo $header; ?>
<script type="text/javascript">
 	function submit_init(){
		var frm = document.frmLogin; 
		//kiem tra thong tin dang nhap
		var member_email		= frm.member_email.value;
		
		if (member_email==""){						
			alertify.alert("Bạn hãy nhập địa chỉ Email.", function (e) {
			if(e) {
				frm.member_email.focus();
				} 
			});	
			return false;
		}
		
		if (member_email.indexOf('@', 0) == -1 || member_email.indexOf('.', 0) == -1){ 						
			alertify.alert("Địa chỉ E-mail này không hợp lệ.<br>Bạn hãy nhập lại.", function (e) {
				if(e) {
					frm.member_email.focus();
				} 
			});	
			return false;
		}				
	}
 </script>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
          <i class="fa fa-angle-right" aria-hidden="true"></i>
          <li><span>Quên mật khẩu</span></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="main-contact">
  <div class="container">
    <!-- Starts -->
    <div class="row content-page-contact">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h5 class="main-heading text-center"> Quên mật khẩu đăng nhập </h5>
        <div class="panel panel-smart" style="line-height:25px;">
          <div class="row">
            <div class="col-md-5">
              <h6 class="panel-heading innere">Khách hàng mới</h6>
              <div> Bạn hãy đăng ký tài khoản thành viên. Có tài khoản bạn sẽ thuận tiện hơn trong thanh toán và quản lý đơn đặt hàng của mình. Khi là thành viên của chúng tôi bạn sẽ nhận được nhiều ưu đãi hơn từ các chiến dịch khuyến mãi của cửa hàng. </div>
              <div style="padding-top:20px;"> <a href="<?php echo base_url().'member/register.html';?>">
                <button type="submit" class="btn btn-black button_send" style="padding:10px 20px">Đăng ký thành viên</button>
                </a> </div>
            </div>
            <div class="col-md-7">
              <form class="form-horizontal" method="post" encType="multipart/form-data" action="<?php echo base_url().'member/forget.html';?>" name="frmLogin" onsubmit="return submit_init();" role="form">
                <h3 class="panel-heading innere">Lấy lại mật khẩu đăng nhập</h3>
                <?php				
                                if($msg<>''){
                                    $astyle =  $alert_style == 0 ? 'alert-danger' : 'alert-success';
                                ?>
                <div class="alert <?php echo $astyle;?> alert-dismissable" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <font color="#FF0000"><?php echo $msg;?></font> </div>
                <?php
                                }
                                            
                                ?>
                <p>Vui lòng nhập chính xác địa chỉ email đã đăng ký với chúng tôi để lấy lại mật khẩu</p>
                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label"> <span class="required">*</span> Email:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="member_email" name="member_email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-black button_send" style="padding:10px 20px">Lấy lại mật khẩu</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php echo $footer; ?>