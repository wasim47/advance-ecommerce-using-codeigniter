<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div class="columns-container middlecontainer">
    <div class="container" id="columns">
        <!-- breadcrumb -->
        <div class="breadcrumb clearfix">
            <a class="home" href="<?php echo base_url();?>" title="Return to Home">হোম  &laquo;</a>
            <span class="navigation_page">
			<?php $expval = explode('|',$title);
			echo implode('&laquo;',$expval);
			?>
            </span>
        </div>
        <?php echo $this->session->flashdata('cartMsg');?>
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">

                <div class="block left-module">
                    <p class="title_block">ফিল্টারিং অপশন</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-filter-price">
                            <!-- filter categgory -->
                            <div class="layered_subtitle">জনপ্রিয় কীওয়ার্ড</div>
                            <div class="layered-content">
                                <ul class="check-box-list">
                                <?php foreach($topsearch->result() as $searchkey){
										$keywords=$searchkey->keywords;
								?>
                                    <li>
                                    <?php  echo form_open('', 'style="padding:0; margin:0"');?>
                                    	<input type="hidden" value="<?php echo $keywords;?>" name="keyword"  />
                                        <input type="submit"name="colorsubmit" value="<?php echo $keywords;?>" style="border:none; text-align:left; width:90%; height:auto; padding:2px 5px; margin:2px; border:1px solid #F7CD2D" />
                                        
                                    <?php  echo form_close();?>
                                    </li>
                                  <?php } ?>  
                                </ul>
                            </div> 
                            <!-- ./filter categgory -->
                            <!-- filter price -->
                            <div class="layered_subtitle">price</div>
                            <div class="layered-content slider-range">
                                
                                <div data-label-reasult="Range:" data-min="0" data-max="5000" data-unit="&#2547;" class="slider-range-price" data-value-min="200" data-value-max="1000"></div>
                                <!--<div class="amount-range-price">Range: &#2547; 50 - &#2547; 350</div>-->
                                <div class="amount-range-price">
                                	<?php  echo form_open('', 'style="padding:0; margin:0"');?>
                                        <div style="width:100%; float:left; margin-bottom:20px;">
                                        <input type="text" name="fromprice" id="fromprice" placeholder="From" value="&#2547; 200" readonly="readonly" 
                                        style="border:1px solid #ccc; color:#f6931f; font-weight:bold; padding:5px; height:28px; width:40%; float:left">
                                        <input type="text" name="toprice" id="toprice" placeholder="To" value="&#2547; 1000" readonly="readonly"
                                        style="border:1px solid #ccc; color:#f6931f; font-weight:bold; padding:5px; height:28px; width:40%;margin:0 4px; float:left">
                                        <input type="submit" name="submit" value="Go" 
                                        style="border:none; color:#fff; float:left; width:15%; background:#333; padding:5px; height:28px;" />
                                        </div>
                                        <?php  echo form_close();?>
                                </div>
                              
                            </div>
                            <!-- ./filter price -->
                            <!-- filter color -->
                            <div class="layered_subtitle">Color</div>
                            <div class="layered-content filter-color">
                                <ul class="check-box-list">
                                <?php foreach($allcolor->result() as $rowcolor):?>
                                    <li>
                                     <?php  echo form_open('', 'style="padding:0; margin:0"');?>
                                        <input type="submit"name="colorsubmit" value=" " style="background:<?php echo $rowcolor->color;?>; border:none; width:25px; height:25px; border:1px solid #ccc" />
                                        <input type="hidden" value="<?php echo $rowcolor->color;?>" name="procolor"  />
                                         <?php  echo form_close();?>
                                    </li>
                                   <?php endforeach;?> 
 	
                                </ul>
                            </div>
                            <!-- ./filter color -->
                            <!-- ./filter brand -->
                            <div class="layered_subtitle">brand</div>
                            <div class="layered-content filter-brand" style="max-height:200px; overflow:scroll; overflow-x:hidden">
                                <ul class="check-box-list">
                                    
                                    <?php foreach($allbutikshop->result() as $rowbutik):?>
                                    <li>
                                        <input type="checkbox" id="brand1" name="cc" />
                                        <label for="brand1">
                                        <span class="button"></span>
                                        <?php echo $rowbutik->username;?>
                                        </label>   
                                    </li>
                                   <?php endforeach;?>  
                                </ul>
                            </div>
                            <!-- ./filter brand -->
                            <!-- ./filter size -->
                            <div class="layered_subtitle">Size</div>
                            <div class="layered-content filter-size">
                                <ul class="check-box-list">
                                <?php foreach($allsize->result() as $rowsize):
								echo form_open('', 'style="padding:0; margin:0"');
								?>
                                
                                <li>
                                <div style="width:40px; height:40px; text-align:center; float:left; padding:5px; margin:2px; border:1px solid #ccc; border-radius:5px">
                                        <input type="submit" name="prosize" value="<?php echo $rowsize->size;?>"  style="background:none; border:none" />
                                    </div>    
                                    </li>
                                    
                                    <!--<div style="width:auto; float:left; padding:5px; margin:5px; border:1px solid #ccc; border-radius:5px">
                                    <?php  ?>
									<input type="submit" name="prosize" value="<?php echo $rowsize->size;?>" style="background:none; border:none" />
									<?php  ?>
                                    </div>-->
                                    <?php 
									echo form_close();
									endforeach;?>
                                    
                                    
                                </ul>
                            </div>
                            <!-- ./filter size -->
                        </div>
                        <!-- ./layered -->

                    </div>
                </div>
                <!-- ./block filter  -->
                
                <!-- left silide -->
                <div class="col-left-slide left-module">
                    <ul class="owl-carousel owl-style2" data-loop="true" data-nav = "false" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true">
                        <li><a href="#"><img src="<?php echo base_url()?>assets/data/slide-left.jpg" alt="slide-left"></a></li>
                        <li><a href="#"><img src="<?php echo base_url()?>assets/data/slide-left2.jpg" alt="slide-left"></a></li>
                        <li><a href="#"><img src="<?php echo base_url()?>assets/data/slide-left3.png" alt="slide-left"></a></li>
                    </ul>

                </div>
                <!--./left silde-->
                <!-- SPECIAL -->
                <div class="block left-module">
                    <p class="title_block">SPECIAL PRODUCTS</p>
                    <div class="block_content">
                        <ul class="products-block">
                            <li>
                                <div class="products-block-left">
                                    <a href="#">
                                        <img src="<?php echo base_url()?>assets/data/product-100x122.jpg" alt="SPECIAL PRODUCTS">
                                    </a>
                                </div>
                                <div class="products-block-right">
                                    <p class="product-name">
                                        <a href="#">Woman Within Plus Size Flared</a>
                                    </p>
                                    <p class="product-price">$38,95</p>
                                    <p class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </p>
                                </div>
                            </li>
                        </ul>
                        <div class="products-block">
                            <div class="products-block-bottom">
                                <a class="link-all" href="#">All Products</a>
                            </div>
                        </div>
                    </div>
                </div>



                


            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">

                <div id="view-product-list" class="view-product-list">
                <div class="col-sm-12 page-heading">
                    <div class="col-sm-5">
                        <h2>
                            <span class="page-heading-title" style=" font-family:SolaimanLipi"><?php echo $slug;?></span>
                        </h2>
                    </div>
                    
                     
                     <div class="col-sm-2 pull-right">
                        <ul class="display-product-option">
                            <li class="view-as-grid selected">
                                <span>grid</span>
                            </li>
                            <li class="view-as-list">
                                <span>list</span>
                            </li>
                        </ul>
                     </div>
                 </div>
               		 <div class="col-sm-12">
                   		 <ul class="row product-list grid">
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
							  $prosummery=$gallery->details;
					
							  echo form_open(base_url('cart/add'), 'style="padding:0; margin:0"');?>
                                <input type="hidden" value="<?php echo $product_id;?>" name="id" />
                                <input type="hidden" value="<?php echo $product_name;?>" name="name" />
                                <input type="hidden" value="<?php echo $pro_price;?>" name="price" />
                                <input type="hidden" value="<?php echo $shipment;?>" name="shipment" />
                       	 <li class="col-sx-12 col-sm-4">
                            <div class="product-container">
                                <div class="left-block">
                                        <a href="<?php echo base_url();?>products/<?php echo $slug;?>">
												  <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" class="img-responsive" alt="<?php echo $product_name;?>" title="<?php echo $product_name;?>" style="height:250px;"/>
												</a>
                                    <div class="quick-view">
                                            <a title="Add to my wishlist" class="heart" href="#"></a>
                                            <a title="Add to compare" class="compare" href="#"></a>
                                            <a title="Quick view" class="search" href="#"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        
                                        <button type="submit"><a title="Add to Cart">&nbsp;</a>Buy Now</button>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="<?php echo base_url();?>products/<?php echo $slug;?>"><?php echo $product_name;?></a></h5>
                                    <div class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <div class="content_price">
                                        <span class="price product-price"><?php echo 'BDT '.$pro_price.' &#2547;';?></span>
                                    </div>
                                    <div class="info-orther">
                                        <p>Item Code: #453217907</p>
                                        <p class="availability">Availability: <span>In stock</span></p>
                                        <div class="product-desc">
                                            <?php echo stripslashes($prosummery);?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php echo form_close();
                                    endforeach;
                                }
                                else{
							echo '<h2 style="color:#f00; text-align:center; margin-top:10%; margin:auto float:left; font-family: BNG,SutonnyBanglaOMJ,SolaimanLipi;">
							Sorry !...</h2>';
							}
							?>		
                    </ul>
              	 	</div>
                </div>
                <!-- ./view-product-list-->
                <div class="sortPagiBar">
                    <div class="bottom-pagination">
                          <ul class="pagination">
                            <li><a href="#"><?php echo "<li>". $pagination."</li>"; ?></a></li>
                          </ul>
                    </div>
                   
                </div>
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>