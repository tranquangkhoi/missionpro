<?php echo $header; ?>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <li><span>Đăng nhập tài khoản</span></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="col-lg-12 col-md-12 col-sm-12 col-xs-12 login_area form_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 login_site">
                <div id="demo" class="content">
                    <form accept-charset="UTF-8" action="<?php echo base_url().'member/verify.html';?>" onsubmit="return submit_init();" id="customer_login" method="post">
                    <h4 class="fw_600 txt_u hidden-sm-down">Thông tin cá nhân</h4>
                    <div class="page-title hidden-sm-up ">
                        <h5 class="fw_600 txt_u text-xs-center">Đăng nhập</h5>
                        <p class="text-xs-center no_account">Bạn chưa có tài khoản ? <a href="<?php echo base_url().'member/register.html';?>">Đăng ký</a> ngay</p>
                    </div>
                    <?php               
                        if($msg<>''){
                    ?>
                    <p id="errorFill" style="margin-bottom: 20px; color: rgb(220, 51, 51);"><?php echo $msg;?></p>
                    <?php 
                        }
                    ?>
                    <ul class="form-list">
                        <li>
                            <label for="email">Email của bạn<span class="required">*</span></label>
                            <input type="email" class="input-text" value="" title="email" name="member_email" id="email" required="">
                        </li>
                        <li>
                            <label for="pass">Mật khẩu <span class="required">*</span></label>
                            <input type="password" value="" class="input-text" title="Mật khẩu" name="member_password" id="pass" required="">
                        </li>
                    </ul>
                    <div class="buttons-set">
                        <p class="hidden-sm-up text-xs-center text-recover">Quên mật khẩu ? Nhấn vào <a href="<?php echo base_url().'member/forget.html';?>"id="RecoverPassword">đây</a></p>
                        <button id="send2" type="submit" class="button login login_sign"><span>Đăng nhập</span></button>              
                        <a class="hidden-xs-down tex-xs-center" href="<?php echo base_url().'member/forget.html';?>"id="RecoverPassword">Quên mật khẩu?</a>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 div_reg_area">
                <h4>Bạn chưa có tài khoản</h4>
                <p>Đăng ký tài khoản ngay để có thể mua hàng nhanh chóng và dễ dàng hơn ! Ngoài ra còn có rất nhiều chính sách và ưu đãi cho các thành viên</p>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 button_sign">
                    <button class="btn_black" onclick="location.href='<?php echo base_url().'member/register.html';?>'"><span>Đăng ký</span></button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $footer; ?>