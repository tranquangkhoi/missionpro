    <div class="container">
      <div class="row row-offcanvas row-offcanvas-right">               	
		<div class="col-xs-12" id="content">	                                  
             <h1 style="margin-bottom:30px; text-transform:uppercase; font-size:20px; font-weight:bold; text-align:center;" class="n-color">Chi tiết đơn hàng</h1>              
 			 <p><strong>Mã hóa đơn</strong>:		<?php echo $order_info->order_id;?> -  <strong>Ngày đặt hàng</strong>: 	<?php echo $this->back->fix_date('m/d/Y H:i A',$order_info->order_date);?></p>
             <p><strong>Người đặt hàng</strong>:	<?php echo $order_info->order_fullname;?> - <strong>Địa chỉ</strong>: <?php echo $order_info->order_address;?></p>
             <p><strong>Điện thoại:</strong> <?php echo $order_info->order_tel;?></p>             
             <table class="table table-bordered">
                    <thead>
                      <tr style="background-color:#FFF; font-weight:bolder; text-align:center;">
                        <td width="10%" align="center">STT</td>
                        <td width="10%" align="center">Ảnh</td>
                        <td width="30%" align="center">Tên sản phẩm</td>
                        <td width="15%" align="center">Giá bán</td>
                        <td width="15%" align="center">Số lượng</td>
                        <td width="20%" align="center">Thành tiền</td>
                      </tr>
                    </thead>              
                    <tbody>
                    	<?php
						$i = 0;
						$tongtien = 0;
						$tongso = 0;
						foreach($order_items as $item){
							$i = $i + 1;
							$img = $cart_image[$item['product_id']]<>'' ? base_url().'public/upload/product/small_'.$cart_image[$item['product_id']] : base_url().'public/upload/product/small_noimg.jpg';							
							$thanhtien = $item['product_quantity'] * $item['product_price'];
							$dlink = base_url().$this->config->item('index_page_add').'san-pham/chi-tiet/'.$cart_slug[$item['product_id']].'.html';							
							$tongtien = $tongtien + $thanhtien;
							$tongso += $item['product_quantity'];
						?>
						<tr>
                        	<td style="text-align:center;">
                               <?php echo $i;?> 
                            </td>
                            <td class="image" align="center">
                        		<a href="<?php echo $dlink;?>" target="_blank"><img width="60" src="<?php echo $img;?>" alt="<?php echo $item['product_name'];?>" title="<?php echo $item['product_name'];?>"></a>
                          	</td>
                        	<td class="name">
                            	<a href="<?php echo $dlink;?>" target="_blank"><?php echo $item['product_name'];?></a>                                      
                          	</td>
                        	<td class="price" align="center"><?php echo number_format($item['product_price'],0);?> đ</td>
                            <td class="quantity" style="text-align:center;">
                                <?php echo $item['product_quantity'];?> 
                            </td>                        
                        	<td class="total" align="center"><?php echo number_format($thanhtien,0);?> đ</td>                            
                      	</tr>
                        <?php
						}
						?>
                        <tr>
                        <td align="right" colspan="4"><strong>Tổng cộng: </strong></td>                        
                        <td align="center"  class="tong"><strong><?php echo number_format($tongso,0);?></strong></td>
                        <td align="center"  class="tong"><strong><?php echo number_format($tongtien,0);?> đ</strong></td>                        
                      </tr>
					</tbody>
                  </table>
		</div>
      </div><!--/row-->     
    </div><!--/.container-->
