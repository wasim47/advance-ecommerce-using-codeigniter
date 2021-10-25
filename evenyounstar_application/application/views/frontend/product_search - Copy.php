
		<div class="container">
        <div class="col-sm-12"> <?php echo $this->session->flashdata('cartMsg');?></div>
			<div class="row middlecontainer">
				<div class="col-sm-3">
					<?php include("product_category.php");?>
				</div>
				
				<div class="col-sm-9 padding-right" style="padding:0; margin:0">
					<div class="col-sm-12"><!--features_items-->
						<h2  style="margin:10px; font-family:SolaimanLipi">
						<?php echo $slug;?></h2>
                         <?php 
						if($productgallery->num_rows() > 0){
							foreach($productgallery->result() as $gallery):
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
									</div>
								</div>
								<?php echo form_close();
                                    endforeach;
                                }
                                else{
							echo '<h2 style="color:#f00; text-align:center; margin-top:10%; margin:auto float:left; font-family: BNG,SutonnyBanglaOMJ,SolaimanLipi;">দুঃখিত ! '.$slug.' এর জন্য কোন পণ্য খুঁজে পাওয়া যাচ্ছে না</h2>';
							}
							?>		
                        
                    <!--<div class="col-sm-12" style="margin:0; padding:0;">    
       				<ul class="pagination"><?php echo "<li>". $pagination."</li>"; ?></ul>
    </div>-->
						
						
					</div>
				</div>
			</div>
		</div>
