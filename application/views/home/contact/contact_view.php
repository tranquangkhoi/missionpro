<?php echo $header; ?>
<script language="javascript">
function divLoad(div,url){		
	$(div).load(url);
}
</script>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
          <i class="fa fa-angle-right" aria-hidden="true"></i>
          <li><span>Liên hệ</span></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<section class="main-contact">
  <div class="container">
    <!-- Starts -->
    <div class="row content-page-contact">
      <!-- Contact Details Starts -->
      <div class="col-sm-4">
        <div class="panel panel-smart">
          <div class="panel-heading">
            <h3 class="panel-title">Văn phòng</h3>
          </div>
          <div class="panel-body">
            <ul class="list-unstyled contact-details">
              <li class="clearfix"> <i class="fa fa-home pull-left"></i> <span class="pull-left"> <?php echo $company->company_name;?> <br />
                <?php echo $company->company_address;?> </span> </li>
              <li class="clearfix"> <i class="fa fa-phone pull-left"></i> <span class="pull-left"> <?php echo $company->company_hotline;?> <br />
                <?php echo $company->company_tel;?> </span> </li>
              <li class="clearfix"> <i class="fa fa-envelope-o pull-left"></i> <span class="pull-left"> <?php echo $company->company_email;?> </span> </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Contact Details Ends -->
      <!-- Contact Form Starts -->
      <div class="col-sm-8">
        <div class="panel panel-smart"  style="overflow:hidden">
          <div class="panel-heading">
            <h3 class="panel-title">Gửi thư liên hệ</h3>
          </div>
          <div class="panel-body">
            <?php				
				if($msg<>''){
					$astyle =  $alert_style == 0 ? 'alert-danger' : 'alert-success';
			?>
            <div class="alert <?php echo $astyle;?> alert-dismissable" role="alert" style="line-height:25px;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <font color="#FF0000"><?php echo $msg;?></font> </div>
            <?php
				}										
			?>
            <form  role="form" class="form-horizontal" action="<?php echo base_url();?>contact" method="post" enctype="multipart/form-data" name="frm_contact" onsubmit="return csubmitit();" >
              <div class="form-group">
                <label for="name" class="col-sm-3 control-label"> <span class="required">*</span> Họ và tên: </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="fullname" required name="fullname" value="<?php echo $f_contact['fullname'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-sm-3 control-label"> <span class="required">*</span> Số điện thoại: </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" required id="tel" name="tel" value="<?php echo $f_contact['tel'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="subject" class="col-sm-3 control-label"> <span class="required">*</span> Địa chỉ Email: </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="email" name="email" required value="<?php echo $f_contact['email'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="subject" class="col-sm-3 control-label"> <span class="required">*</span> Tiêu đề: </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="subject" required name="subject" value="<?php echo $f_contact['subject'];?>">
                </div>
              </div>
              <div class="form-group">
                <label for="message" class="col-sm-3 control-label"> <span class="required">*</span> Nội dung: </label>
                <div class="col-sm-9">
                  <textarea id="request" name="request" required class="form-control" rows="5" placeholder="Message"><?php echo $f_contact['request'];?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="subject" class="col-sm-3 control-label"> <span class="required">*</span> Mã kiểm tra: </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="captcha" name="captcha">
                </div>
              </div>
              <div class="form-group">
                <label for="subject" class="col-sm-3 control-label sr-only"> <span class="required">*</span> Mã kiểm tra: </label>
                <div class="col-sm-9"> <span id="captcha_img" style="line-height:24px;"></span> <i title="Tạo mã bảo mật mới" style="font-size:16px; line-height:24px; font-weight:bold;cursor:pointer; color:#4bac52;" onclick="divLoad('#captcha_img','<?php echo base_url().'getcaptcha';?>')" class="fa fa-refresh"></i> </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="submit" class="btn btn-black text-uppercase button_send" style="padding:10px 20px">Gửi liên hệ</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Contact Form Ends -->
    </div>
    <!-- Ends -->
  </div>
</section>
</script>
<?php echo $footer; ?>