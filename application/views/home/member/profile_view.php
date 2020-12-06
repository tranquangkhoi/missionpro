<?php echo $header; ?>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
          <i class="fa fa-angle-right" aria-hidden="true"></i>
          <li><span>Cập nhật hồ sơ thành viên</span></li>
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
      <h5 class="main-heading text-left"> <b>Sửa thông tin tài khoản </b></h5>
      <div class="panel panel-smart" style="overflow:hidden; line-height:25px;">
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
        <div class="panel-body">
          <form role="form" class="form-horizontal" method="post" encType="multipart/form-data" action="<?php echo base_url().'member/profile.html';?>" name="frmRegister" onsubmit="return submit_init();">
            <div class="form-group">
              <label for="member fullname" class="col-sm-5 control-label"><span class="required">*</span> Họ tên:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="member_fullname" name="member_fullname" value="<?php echo $f_profile['member_fullname'];?>">
              </div>
            </div>
            <div class="form-group">
              <label for="member birth" class="col-sm-5 control-label"><span class="required">*</span> Ngày sinh:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="member_birth" name="member_birth" value="<?php echo $f_profile['member_birth'];?>">
              </div>
            </div>
            <div class="form-group">
              <label for="member tel" class="col-sm-5 control-label"><span class="required">*</span> Điện thoại:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="member_tel" name="member_tel" value="<?php echo $f_profile['member_tel'];?>">
              </div>
            </div>
            <div class="form-group">
              <label for="member province" class="col-sm-5 control-label"><span class="required">*</span> Tỉnh/thành:</label>
              <div class="col-sm-5">
                <select name="province_id" class="form-control">
                  <option value="0">Chọn tỉnh/thành...</option>
                  <?php echo $f_profile['province_choose'];?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="member address" class="col-sm-5 control-label"><span class="required">*</span> Địa chỉ:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="member_address" name="member_address" value="<?php echo $f_profile['member_address'];?>">
              </div>
            </div>
            <div class="form-group">
              <label for="submit" class="col-sm-5 control-label sr-only">Bấm nút đăng ký nào</label>
              <div class="col-sm-5">
                <button type="submit" class="btn btn-black button_send" style="padding:10px 20px">Cập nhật </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<?php echo $footer; ?>