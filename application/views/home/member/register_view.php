<?php echo $header; ?>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
          <i class="fa fa-angle-right" aria-hidden="true"></i>
          <li><span>Đăng ký tài khoản</span></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="main-container">
  <div class=" container sign_main">
    <div class="account-login">
      <div class="page-title hidden-sm-down">
        <h2 class="fw_600 txt_u">Thông tin cá nhân</h2>
      </div>
      <div class="page-title hidden-sm-up "> <span class="text-xs-left back"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;<a href="/">Quay lại</a></span>
        <h5 class="fw_600 txt_u text-xs-center">Đăng ký</h5>
        <p class="text-xs-center">Mật khẩu phải có độ dài ngắn nhất 6 ký tự và ngắn hơn 30 ký tự</p>
      </div>
      <fieldset class="col2-set">
      <div class="registered-users">
        <div class="content">
          <p id="errorFillres" style="margin-bottom: 10px; color: rgb(220, 51, 51); display: none;"></p>
          <?php             
            if($msg<>''){
          ?>
          <div class="note form-error">
            <ul class="disc">
              <li style="color:red; margin-bottom:10px;"> <?php echo $msg;?> </li>
            </ul>
          </div>
          <?php }?>
          <form accept-charset="UTF-8" action="<?php echo base_url().'member/register.html';?>" onsubmit="return submit_init();" id="customer_register" method="post">
            <ul class="form-list">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 input-box mobile name-firstname">
                <label for="firstname"> Họ và Tên <span class="required">*</span></label>
                <input type="text" name="member_fullname" title="Họ và Tên" class="input-text" id="firstname" required="" requiredmsg="Nhập Họ và Tên">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile">
                <label for="email">Địa chỉ Email<span class="required">*</span></label>
                <input type="email" value="<?php echo $f_register['member_email'];?>" class="input-text" title="Email" name="member_email" id="email" required="" requiredmsg="Nhập địa chỉ email">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile">
                <label for="pass">Mật khẩu<span class="required hidden-sm-down">*</span></label>
                <input type="password" value="<?php echo $f_register['member_pass'];?>" id="password2" class="input-text" title="Mật khẩu" name="member_pass" minlength="6" required="" requiredmsg="Nhập mật khẩu">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile">
                <label for="pass_re">Nhập lại mật khẩu<span class="required hidden-sm-down">*</span></label>
                <input type="password" value="<?php echo $f_register['member_repass'];?>" minlength="6" id="password_confirmation2" class="input-text" title="Nhập lại mật khẩu" name="member_repass" required="" requiredmsg="Nhập lại mật khẩu">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile">
                <label for="born">Ngày sinh<span class="required hidden-sm-down">*</span></label>
                <input type="text" value="<?php echo $f_register['member_birth'];?>" minlength="6" id="password_confirmation2" class="input-text" title="Nhập ngày sinh" name="member_birth" required="" requiredmsg="Nhập lại mật khẩu">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile">
                <label for="tel">Điện thoại<span class="required hidden-sm-down">*</span></label>
                <input type="text" value="<?php echo $f_register['member_tel'];?>" minlength="6" id="password_confirmation2" class="input-text" title="Nhập số điện thoại" name="member_tel" required="" requiredmsg="Nhập lại mật khẩu">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile">
                <label for="local">Chọn tỉnh<span class="required hidden-sm-down">*</span></label>
                <select name="province_id" class="input-text" >
                    <option value="0">Chọn tỉnh/thành...</option>
                    <?php echo $f_register['province_choose'];?>
                </select> 
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mobile">
                <label for="address">Địa chỉ<span class="required hidden-sm-down">*</span></label>
                <input type="text" value="<?php echo $f_register['member_address'];?>" minlength="6" id="password_confirmation2" class="input-text" title="Nhập lại mật khẩu" name="member_address" required="" requiredmsg="Nhập lại mật khẩu">
              </div>
            </ul>
            <div class="buttons-set">
              <button id="send2" value="Đăng ký" type="submit" class="button login login_sign"><span>Đăng ký</span></button>
            </div>
          </form>
        </div>
      </div>
      </fieldset>
    </div>
  </div>
</section>
<?php echo $footer; ?>