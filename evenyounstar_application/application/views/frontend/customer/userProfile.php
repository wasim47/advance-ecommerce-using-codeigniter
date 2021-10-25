		<div class="container">
			<div class="row middlecontainer">
				<div class="col-sm-3">
					<?php include("leftSidebar.php");?>
				</div>
				
				<div class="col-sm-9">
    				<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; text-align:justify">
                        <h3 class="headline">My Products</h3>
                            <div style="width:98%; float:left; padding:0; margin:0 1%; position:relative;">
                <?php 
					if($userOrder->num_rows() > 0){
                    foreach($orderproductList->result() as $gallery):
                      $product_id=$gallery->product_id;
                      $slug=$gallery->slug;
                      $product_name=$gallery->product_name;
                      $main_image=$gallery->main_image;
                      $pro_price=$gallery->price;
                      $market_price=$gallery->market_price;
                      $shipment=$gallery->shipment;
            
                      echo form_open(base_url('cart/add'), 'style="padding:0; margin:0"');?>
                            <input type="hidden" value="<?php echo $product_id;?>" name="id" />
                            <input type="hidden" value="<?php echo $product_name;?>" name="name" />
                            <input type="hidden" value="<?php echo $pro_price;?>" name="price" />
                            <input type="hidden" value="<?php echo $shipment;?>" name="shipment" />
                            
                            <div class="col-sm-3" style="margin:0; padding:0;">
									<div class="galleryBox" style="width:95%;">
										<div class="single-products">
											<div class="productinfo text-center">
												<a href="<?php echo base_url();?>products/<?php echo $slug;?>">
												  <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>"  style="height:200px; width:100%;" />
												</a>
												<h2><?php echo 'BDT '.$pro_price;?></h2>
												<p><?php echo $product_name;?></p>
												<button type="submit" class="btn add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
											
										</div>
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												<li><a href="#"><i class="fa fa-plus-square"></i>Wishlist</a></li>
												<li><a href="#"><i class="fa fa-plus-square"></i>Compare</a></li>
											</ul>
										</div>
									</div>
								</div>
                    
                <?php echo form_close();
                    endforeach;
					?>
                    <!--<div id="pagination" class="tsc_pagination">
                    <ul><?php echo "<li>". $pagination."</li>"; ?></ul>
                </div>-->
                    <?php
					}
                ?>
                
                </div>
                    </div>
				</div>
			</div>
		</div>
