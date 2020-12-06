					<div class="box featured">
							<div class="box-heading">Sản phẩm mới</div>
								<div class="box-content">
									<div class="box-product">
										<ul class="row">											
                                            <!-- Begin row -->
                                            <?php
											foreach($pnew as $item){
												$dlink = base_url().$this->config->item('index_page_add').$item['product_path'].'.html';
												$giaban = $item['product_price'];
												$giagoc = $item['product_price_d'];
												$percent = $giagoc=='0' ? '50' : (100 - ceil($giaban*100/$giagoc));
											?>
                                            <li class="first-in-line col-sm-12">				 
												<div class="padding">
													<div class="discount_percent"><?php echo $percent;?><span>% </span></div>
                                                    <div id="p<?php echo $item['product_id'];?>" class="image2">
														<a href="<?php echo $dlink; ?>"><img src="<?php echo base_url();?>public/upload/product/<?php echo 'medium_'.$item['product_image'];?>" alt="<?php echo $item['product_title'];?>" width="220" height="220"></a>					
													</div>
                                                    <div class="inner">
														<div class="f-left">						
															<div class="name maxheight-feat"><a href="<?php echo $dlink; ?>"><?php echo $item['product_title'];?></a></div>
															<!-- <div class="description"><?php echo $item['product_review'];?></div>-->
														</div>
														<div class="price">
															<?php echo number_format($item['product_price'],0); ?>
														</div>
                                                    	<div class="cart-button" onclick="tocart(<?php echo $item['product_id'];?>,'1')">
															<div class="cart">
																<a title="Add to cart" data-id="32;" class="button  add-to-cart">
																	<span>Đặt hàng</span>
																</a>
															</div>
															<span class="clear"></span>
														</div>
														<div class="clear"></div>
													</div>
													<div class="clear"></div>
												</div>
											</li>
                                            <?php
											}
											?>
                                            <!-- End row -->                                            		  		  							
										</ul>
									</div>
								<div class="clear"></div>
						  </div>
					</div>