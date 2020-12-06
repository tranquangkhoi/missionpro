<?php echo $header; ?>
<div class="brd">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul class="breadcrumbs">
          <li class="home"> <a title="Quay lại trang chủ" href="<?php echo base_url();?>">Trang chủ</a></li>
          <i class="fa fa-angle-right" aria-hidden="true"></i>
          <li><span>Thông tin đặt hàng</span></li>
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
        <h5 class="main-heading text-center"> Danh sách đơn hàng </h5>
        <table class="table table-bordered table-hover">
          <thead>
            <tr style="background-color:#dc3333; color:#FFFFFF">
              <th width="10%" style="text-align:center;"><strong>STT</strong></th>
              <th width="15%" style="text-align:center;"><strong>Mã Hóa Đơn</strong></th>
              <th width="20%" style="text-align:center;"><strong>Người đặt hàng</strong></th>
              <th width="20%"  style="text-align:center;"><strong>Ngày đặt hàng</strong></th>
              <th width="25%" style="text-align:center;"><strong>Trạng thái đơn</strong></th>
              <th width="10%" style="text-align:center;"><strong>Chi tiết</strong></th>
            </tr>
          </thead>
          <tbody>
            <?php
		   	  $stt = 0;
			  $status_name = array(
			  	'0' => 'Chưa xem',
				'1' => 'Đang giao',
				'2' => 'Hoàn thành',
			  );			  
			  foreach($orders as $item){
				  $stt = $stt + 1;				
			  ?>
            <tr>
              <td style="text-align:center;"><?php echo $stt;?></td>
              <td style="text-align:center;"><?php echo $item['order_id'];?></td>
              <td><?php echo $item['order_fullname'];?></td>
              <td style="text-align:center;"><?php echo $this->back->fix_date('m/d/Y H:i A',$item['order_date']);?></td>
              <td style="text-align:center;"><?php echo $status_name[$item['order_status']];?></td>
              <td style="text-align:center;"><a class="fancybox fancybox.ajax" href="<?php echo base_url();?>member/vorder/<?php echo $item['order_id'];?>"></a> </td>
            </tr>
            <?php
			  }
			  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?php echo $footer; ?>