<?php echo $header; ?>
<script type="text/javascript">
 	function submit_init(){
		var frm = document.frmChangepass; 
		//kiem tra thong tin dang nhap
		var member_pass		= frm.member_pass.value;
		var member_repass  	= frm.member_repass.value;												
		
		if (member_pass==""){						
			alertify.alert("Bạn hãy nhập mật khẩu mới.", function (e) {
				if(e) {
					frm.member_pass.focus();
				} 
			});	
			return false;
			
		}
		if (member_pass.length < 6){
			alertify.alert("Mật khẩu ít nhất từ 6 ký tự trở lên.", function (e) {
				if(e) {
					frm.member_pass.focus();
				} 
			});	
			return false;					
		}
		if (member_repass==""){
			alertify.alert("Bạn hãy gõ lại mật khẩu mới.", function (e) {
				if(e) {
					frm.member_repass.focus();
				} 
			});	
			return false;						
		}
		if (member_pass !=  member_repass){
			alertify.alert("Mật khẩu gõ lại chưa đúng.", function (e) {
				if(e) {
					frm.member_repass.focus();
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
          <li><span>Thay đổi mật khẩu</span></li>
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
         <h5 class="main-heading text-left"> Đổi mật khẩu đăng nhập </h5></h5>
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
            <form role="form" class="form-horizontal" method="post" encType="multipart/form-data" action="<?php echo base_url().'member/changepass.html';?>" name="frmChangepass" onsubmit="return submit_init();">
              <div class="form-group">
                <label for="Pass" class="col-sm-5 control-label"><span class="required">*</span> Mật khẩu:</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" id="member_pass" name="member_pass" value="">
                </div>
              </div>
              <div class="form-group">
                <label for="Repass" class="col-sm-5 control-label"><span class="required">*</span> Nhập lại mật khẩu:</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" id="member_repass" name="member_repass" value="">
                </div>
              </div>
              <div class="form-group">
                <label for="submit" class="col-sm-5 control-label sr-only">Bấm nút cập nhật nào</label>
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