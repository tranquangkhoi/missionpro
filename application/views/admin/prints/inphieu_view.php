<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>In phiếu giao hàng</title>  	
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW"/>	
<style>

html {
	color:#000;
	background:#FFF;
}
body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, button, textarea, p, blockquote, th, td {
	margin:0;
	padding:0;
}
table {
	border-collapse:collapse;
	border-spacing:0;
}
fieldset, img {
	border:0;
}
address, caption, cite, code, dfn, th, var, optgroup {
	font-style:inherit;
	font-weight:inherit;
}
del, ins {
	text-decoration:none;
}
li {
	list-style:none;
}
caption, th {
	text-align:left;
}
h1, h2, h3, h4, h5, h6 {
	font-size:100%;
}
q:before, q:after {
	content:'';
}
abbr, acronym {
	border:0;
	font-variant:normal;
}
sup {
	vertical-align:baseline;
}
sub {
	vertical-align:baseline;
}
legend {
	color:#000;
}
input, button, textarea, select, optgroup, option {
	font-family:inherit;
	font-size:inherit;
	font-style:inherit;
	font-weight:inherit;
}
input, button, textarea, select {
*font-size:100%;
}
body {
	font:12px/1.231 arial, helvetica, clean, sans-serif;
	*font-size:small;
	*font:x-small;
}
select, input, button, textarea, button {
	font:99% arial, helvetica, clean, sans-serif;
}
table {
	font-size:inherit;
	font:100%;
}

    @page{margin:0px auto;}
	body{font-family: Verdana;}
    caption, th {
    text-align: center;
    }
    .tieu_de{
        color: black;
        font-size: 16px;
        line-height: 40px;
    }
    table.cart{
        border-top: 1px solid #333;        
    }
    table.info{
        border:none;
    }
    table tr{
        width: 670px;        
    }
    table tr td{
        width: 160px;
        padding: 5px;
        line-height: 16px;
    }
    table tr td.t1{
        width: 115px;
        padding: 5px;
        font-weight: bold;
        font-size: 9pt;
    }
    table tr td.t2{
        width: 190px;
        padding: 5px;
    }
    table tr td.t31{
        width: 100px;
        padding: 5px;
        font-weight: bold;
    }
    table tr td.t4{
        width: 220px;
        padding: 5px;
    }
    table tr td.t2 input,table tr td.t2 textarea{width: 195px; border-bottom: 1px dotted gray;}
    table tr td.t2 p{border-bottom: 1px dotted gray;}
    
    table tr td.t4 input,table tr td.t4 textarea{width: 220px; border-bottom: 1px dotted gray;}
    table tr td.t3 p,table tr td.t4 p{border-bottom: 1px dotted gray;}
    
    table tr td.t3{
        width: 543px;
        padding: 5px;
    }
    table tr th{
        padding: 5px;
        font-weight: bold;
    }
    #tac_gia{
        margin: 15PX 0PX;
    }
    #tac_gia ul li{
        float: left;
        width: 150px;
        height: 100px;
        text-align: center;
        font-weight: bold;
    }
    .news-left-content{
        width: 670px; 
        margin-bottom: 10px;
        /*border: 1px solid #333; */
        margin: 0 auto;
        overflow: hidden;
    }
    .htext{border: none;}
    .etext{border: none; width: 540px; overflow: hidden; line-height: 18px;}
</style>
</head>
<body>
<?php 
      if(count($phieu['order_items'])>0){        	  		
			$shop_domain 	  = 'www.thongocshop.com';
			$shop_tel 		 = '0988 888 888';
			$shop_address 	 = 'Hà Nội, Việt Nam';
			$shop_logo 		= 'logo.jpg';
			$nguoi_lap_phieu  = $_SESSION['thongocshop.com']['user_fullname'];
?>
             
             <input id="bprint" style="margin-right: 10px;" type="button" value="In phiếu giao hàng"/><br />             
             <?php
			 ob_start();
			 ?>
             <div id="print" class="news-left-content" style="border:0px;">
                        <div style="padding-left: 5px; padding-top: 0px; padding-bottom: 0px; float: left;width: 670px;">                            	
                            <img style="float: left; margin-right: 20px;" src="<?php echo base_url();?>public/admin/img/<?php echo $shop_logo;?>" height="30"/>
                            <div style="line-height: 14px; font-size:11px; text-align:right; padding-right:10px;">
                                <strong><?php echo $shop_domain;?></strong><br />                                
                                Tel: <?php echo $shop_tel;?><br />                                
                                Add: <?php echo $shop_address;?>                                
                            </div>
                        </div>
                        <div class="clear"></div>
                       <h1 style="font-size:18px; line-height: 26px;" align="center">PHIẾU GIAO HÀNG</h1>
                       <h6 style="font-size:11px;" align="center">
                       	(Kiêm phiếu bảo hành)
                       </h6>
                       <div class="clear"></div><br />
                       <div class="noi_dung noi_dung_in">
                            <div style="line-height:16px; font-size:11px; padding-left: 5px;"><strong>Tên khách : </strong> 
                            <input type="text" class="htext" value="<?PHP echo $phieu['order_fullname'];?>" style="font-size:12px;" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Tel:</strong> <input type="text" class="htext" value="<?PHP echo number_format($phieu['order_tel'],0);?>" style="font-size:14px; font-weight:bold;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Ngày:</strong> <?PHP echo date("d/m/Y");?></div>                            
                            <div  style="line-height:16px; font-size:11px; padding-left: 5px;"><strong>Địa chỉ : </strong> 
							<input type="text" class="htext" value="<?PHP echo $phieu['order_address'];?>" style="font-size:12px; width:400px;" />
                            </div>                                                        
                            <div  style="line-height:16px; font-size:11px; padding-left: 5px;"><strong>Ghi chú : </strong> 
                            <input type="text" class="htext" value="<?PHP echo $phieu['order_note'];?>" style="font-size:12px; width:400px;" />
                            </div>
						</div>
                       <div class="clear"></div><br />
                       <!--h1 class="tieu_de">&nbsp;&nbsp;Chi tiết hóa đơn</h1-->
                       <?php
                    	   //Thong tin danh sach don hang
                           $list_pro = '';
						   $i = 0;
						   $totalValue = 0;
						   foreach($phieu['order_items'] as $item){                           
                            	$product_id 	  	   = $item['product_id'];
                            	$product_name 		 = $item['product_name'];
                            	$product_price 	    = $item['product_price'];
                            	$product_quantity     = $item['product_quantity'];                            	
                            	$totalValue += ($product_price*$product_quantity);
								                              
                            	$list_pro .= "
                            		<tr style=\"border-bottom: 1px solid #333;\" height=\"30\">
                            			<td align=\"center\" class=\"c0\">".$product_id."</td>
										<td class=\"c1\" style=\"padding-top:0px; padding-bottom:0px;\">                                            
                            				<div>".$product_name."</div>
                            			</td>
                            			<td align=\"center\" class=\"c3\">".$product_quantity."</td>
										<td align=\"center\" class=\"c2\">".number_format($product_price,0)."</td>										
                            			<td align=\"right\" class=\"c5\">".number_format(($product_price * $product_quantity),0)." </td>
                            		</tr>
                            	";
                        	$i++;
                            }
							$total_r = $i;
							
							if($total_r<3){
								$nr = 3-$total_r;
								if($nr>0){
									for($j=1; $j<=$nr; $j++){
										$list_pro .= "
											<tr style=\"border-bottom: 1px solid #333;\" height=\"30\">
												<td align=\"center\" class=\"c0\">&nbsp;</td>
												<td class=\"c1\">&nbsp;</td>
												<td align=\"center\" class=\"c3\">&nbsp;</td>
												<td align=\"center\" class=\"c2\">&nbsp;</td>												
												<td align=\"right\" class=\"c5\">&nbsp;</td>
											</tr>
										";	
									}
								}
							}
                      ?>
                       <table class="cart" style="font-size:11px;">
                                                    <tbody>
                                                    <tr style="background-color: #f0f0f0;border-bottom: 1px solid #333;">
                                                        <th width="10%" style="text-align:center;">Mã phiếu</th>                                                        
                                                        <th  width="60%" style="text-align:center;">Tên sản phẩm</th>
                                                        <th width="5%" align="center">SL</th>
                                                        <th width="10%" align="center">Đơn giá</th>
                                                        <th width="15%" align="center">Thành tiền</th>
                                                    </tr>
                                                    <?php 
														echo $list_pro;
													?>														
                                                    <tr style="border-bottom: 1px solid #333;">
                                                        <td colspan="4" align="right" valign="top"><strong style="font-size: 11px;">Tổng cộng (VNĐ)</strong></td>
                                                        <td align="right" valign="top"><strong style="font-size: 11px;">
														<?PHP
														 echo number_format($totalValue,0); 
                                                        ?>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #333;">
                                                        <td colspan="4" align="right" valign="top"><strong style="font-size: 11px;">Phí vận chuyển (VNĐ)</strong></td>
                                                        <td align="right" valign="top"><strong style="font-size: 11px;">
														<?PHP
														 echo number_format($phieu['order_ship'],0); 
                                                        ?>
                                                        </td>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #333;">
                                                        <td colspan="4" align="right" valign="top"><strong style="font-size: 11px;">TỔNG TIỀN KHÁCH HÀNG PHẢI THANH TOÁN (VNĐ)</strong></td>
                                                        <td align="right" valign="top"><strong style="font-size: 11px;">
														<?PHP
														 echo number_format($phieu['order_ship']+$totalValue,0); 
                                                        ?>
                                                        </td>
                                                    </tr>                                                                                                                                                
                                                </tbody>
                                               </table>
                       <div class="clear"></div>
                       <div style="font-weight:bold; font-style:italic; font-size:10px; padding-top:5px;">
                       		<span style="width:60px;">Lưu ý:</span> Quý khách vui lòng kiểm tra sản phẩm trước khi nhận. <br />
							<span style="width:60px;"></span><span style="text-transform:uppercase;"><?php echo substr($shop_domain,4);?></span> sẽ không chịu trách nhiệm với những sai lệch hình thức của Sản Phẩm sau khi Quý khách đã nhận hàng.
                       </div>
                       <div id="tac_gia" style="padding-top:5px;">
                            <ul>
                                <li style="height:80px; width:220px; font-size:11px;">Người lập phiếu<br /><br /><br /><?php echo $nguoi_lap_phieu;?></li>
                                <li style="height:80px; width:220px; font-size:11px;">Người giao hàng</li>
                                <li style="height:80px; width:220px; font-size:11px;">Người mua hàng</li>
                            </ul>
                       </div>
                       <div class="clear"></div>
             </div>             
             
             <?PHP
			 	$value = ob_get_contents();				
				ob_end_clean();
				echo $value;
				if($total_r>3){
				?>
					<DIV style="page-break-after:always"></DIV>
				<?php	
				}
            	echo $value;				
            }else{                    
			?>
				<p align="center">Hóa đơn không tồn tại!</p>
			<?PHP
			}
            ?>
			
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js" type="text/javascript"></script>
			<script>
				$(function() {
					$("#bprint").click(function() {
					$("#print").css({"border":"1px solid #fff"});
					$("#bprint").hide().delay(1000);
					window.print();
					$("#bprint").fadeIn();
					$("#print").css({"border":"1px solid #333"});
					return (false);
					});
				});
			</script>
    </body>
</html>