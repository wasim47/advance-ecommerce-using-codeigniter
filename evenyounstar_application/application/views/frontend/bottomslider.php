 <div class="recommended_items col-sm-12"><!--recommended_items-->
						<h2 class="titleBar">Recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
                            <?php 
								$count1=1;
								$i=0;
								$LatestPro=$this->db->query("select * from product order by product_id desc limit 12");
								foreach($LatestPro->result() as $ltp):
								  $tpro_id=$ltp->product_id;
								  $tproduct_name=$ltp->product_name;
								  $tprice=$ltp->price;
								  $tmarket_price=$ltp->market_price;
								  $tslug=$ltp->slug;
								  $tmain_image=$ltp->main_image;
								  
								  if($count1==1){
									$class1='item active';
								}
								else{
									$class1='item';	
								}
								$count1++;
								if($i==6){
									print '</div>';
									$i=0;
								}
								if($i==0){
									print '<div class="'.$class1.'"  style="padding:0; margin:0">';
								}
								
							 echo form_open(base_url('cart/add'), 'style="padding:0; margin:0"');?>
                                <input type="hidden" value="<?php echo $tpro_id;?>" name="id" />
                                <input type="hidden" value="<?php echo $tproduct_name;?>" name="name" />
                                <input type="hidden" value="<?php echo $tmarket_price;?>" name="price" />
									<div class="col-sm-2">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
                                                <div style="height:300px">
													<a href="<?php echo base_url();?>products/<?php echo $tslug;?>"><img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $tmain_image;?>" class="img-responsive" alt="" /></a>
                                                    <h2><?php echo $tprice;?></h2>
                                                    <p><?php echo $tproduct_name;?></p>
                                                 </div>   
                                                 <div style="height:auto; margin-bottom:10px">
													<button type="submit" class="btn add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                  </div>
												</div>
												
											</div>
										</div>
									</div>
								<?php
								$i++;
								echo form_close();
								endforeach;
								if($i>0){
									print '</div>';
								}
								?>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div>