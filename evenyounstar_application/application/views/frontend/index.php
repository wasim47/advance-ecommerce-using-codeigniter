<div class="mainbanner">
  <div id="main-banner" class="owl-carousel home-slider">
  	<?php 
	$i=0;
	foreach($bannerslider->result() as $banner):
		$image=$banner->image;
		$banner_name1=$banner->banner_name;
	?>
    <div class="item"> <a href="#"><img src="<?php echo base_url('uploads/images/banner/'.$image)?>" alt="<?php echo $banner_name1;?>" 
    title="<?php echo $banner_name1;?>" class="img-responsive" /></a> </div>
    <?php endforeach; ?>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="cms_banner ">
    <?php foreach($topcategory->result() as $catTop){
	?>
    <div class="col-md-4 cms-banner-left" style="margin-bottom:5px;"> 
    <a href="<?php echo base_url('products/gallery/'.$catTop->caegory_title);?>">
    <img alt="<?php echo $catTop->cat_name;?>" src="<?php echo base_url('uploads/images/product_category/category/'.$catTop->image);?>"></a> </div>
    <?php
	}
	?>
      
    </div>
  </div>
  <div class="row">
    <div id="content" class="col-sm-12">
      <div class="customtab">
        <div id="tabs" class="customtab-wrapper">
          <ul class='customtab-inner'>
            <li class='tab'><a href="#tab-latest">New Arrival</a></li>
            <li class='tab'><a href="#tab-special">Special Product</a></li>
            <li class='tab'><a href="#tab-bestseller">Bestseller Items</a></li>
          </ul>
        </div>
        <div id="tab-latest" class="tab-content">
          <div class="box">
            <div id="latest-slidertab" class="row owl-carousel product-slider">
              
              
               <?php 
			$i=0;
			foreach($newproduct->result() as $bsl):
			  $tpro_id=$bsl->product_id;
			  $tproduct_name=$bsl->product_name;
			  $tprice=$bsl->price;
			  $tmarket_price=$bsl->market_price;
			  $tslug=$bsl->slug;
			  $discount=$bsl->discount;
			  $tmain_image=$bsl->main_image;
				echo form_open(base_url('cart/add'), 'style="padding:0; margin:0"');?>
				<input type="hidden" value="<?php echo $tpro_id;?>" name="id" />
				<input type="hidden" value="<?php echo $tproduct_name;?>" name="name" />
				<input type="hidden" value="<?php echo $tmarket_price;?>" name="price" />
              <div class="item">
                <div class="product-thumb transition">
                  <div class="image product-imageblock"> 
                  <a href="<?php echo base_url();?>products/<?php echo $tslug;?>">
                   <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $tmain_image;?>" class="img-responsive" alt="<?php echo $tproduct_name;?>" style="max-height:300px; width:100%;"/></a>
                    <div class="button-group">
                      <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                      <button type="submit" class="addtocart-btn" >Add To Cart</button>
                      <button type="button" class="compare" data-toggle="tooltip" title="<?php echo $tproduct_name;?>" ><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                  <div class="caption product-detail">
                    <h4 class="product-name"><a href="<?php echo base_url();?>products/<?php echo $tslug;?>"><?php echo $tproduct_name;?></a></h4>
                    <p class="price product-price"> <span class="price-new"><?php echo '$'.$tprice;?></span> <span class="price-old"><?php echo '$'.$tmarket_price;?></span> 
                    </p>
                  </div>
                  <div class="button-group">
                    <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                    <button type="submit" class="addtocart-btn" >Add To Cart</button>
                    <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
                  </div>
                </div>
              </div>
			 <?php 
		   echo form_close();
		   endforeach; ?>
              
              
              
            </div>
          </div>
        </div>
        <!-- tab-latest-->
        <div id="tab-special" class="tab-content">
          <div class="box">
            <div id="special-slidertab" class="row owl-carousel product-slider">
              
              
              
               <?php 
			$i=0;
			foreach($topproduct->result() as $bsl):
			  $tpro_id=$bsl->product_id;
			  $tproduct_name=$bsl->product_name;
			  $tprice=$bsl->price;
			  $tmarket_price=$bsl->market_price;
			  $tslug=$bsl->slug;
			  $discount=$bsl->discount;
			  $tmain_image=$bsl->main_image;
				echo form_open(base_url('cart/add'), 'style="padding:0; margin:0"');?>
				<input type="hidden" value="<?php echo $tpro_id;?>" name="id" />
				<input type="hidden" value="<?php echo $tproduct_name;?>" name="name" />
				<input type="hidden" value="<?php echo $tmarket_price;?>" name="price" />
              <div class="item">
                <div class="product-thumb transition">
                  <div class="image product-imageblock"> 
                  <a href="<?php echo base_url();?>products/<?php echo $tslug;?>">
                   <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $tmain_image;?>" class="img-responsive" alt="<?php echo $tproduct_name;?>" style="max-height:300px; width:100%;"/></a>
                    <div class="button-group">
                      <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                      <button type="submit" class="addtocart-btn" >Add To Cart</button>
                      <button type="button" class="compare" data-toggle="tooltip" title="<?php echo $tproduct_name;?>" ><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                  <div class="caption product-detail">
                    <h4 class="product-name"><a href="<?php echo base_url();?>products/<?php echo $tslug;?>"><?php echo $tproduct_name;?></a></h4>
                    <p class="price product-price"> <span class="price-new"><?php echo '$'.$tprice;?></span> <span class="price-old"><?php echo '$'.$tmarket_price;?></span> 
                    </p>
                  </div>
                  <div class="button-group">
                    <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                    <button type="submit" class="addtocart-btn" >Add To Cart</button>
                    <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
                  </div>
                </div>
              </div>
			 <?php 
		   echo form_close();
		   endforeach; ?>
            </div>
          </div>
        </div>
        <!-- tab-special-->
        <div id="tab-bestseller" class="tab-content">
          <div class="box">
            <div id="bestseller-slidertab" class="row owl-carousel product-slider">
              <?php 
			$i=0;
			foreach($bestsellproduct->result() as $bsl):
			  $tpro_id=$bsl->product_id;
			  $tproduct_name=$bsl->product_name;
			  $tprice=$bsl->price;
			  $tmarket_price=$bsl->market_price;
			  $tslug=$bsl->slug;
			  $discount=$bsl->discount;
			  $tmain_image=$bsl->main_image;
				echo form_open(base_url('cart/add'), 'style="padding:0; margin:0"');?>
				<input type="hidden" value="<?php echo $tpro_id;?>" name="id" />
				<input type="hidden" value="<?php echo $tproduct_name;?>" name="name" />
				<input type="hidden" value="<?php echo $tmarket_price;?>" name="price" />
              <div class="item">
                <div class="product-thumb transition">
                  <div class="image product-imageblock"> 
                  <a href="<?php echo base_url();?>products/<?php echo $tslug;?>">
                   <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $tmain_image;?>" class="img-responsive" alt="<?php echo $tproduct_name;?>" style="max-height:300px; width:100%;"/></a>
                    <div class="button-group">
                      <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                      <button type="submit" class="addtocart-btn" >Add To Cart</button>
                      <button type="button" class="compare" data-toggle="tooltip" title="<?php echo $tproduct_name;?>" ><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                  <div class="caption product-detail">
                    <h4 class="product-name"><a href="<?php echo base_url();?>products/<?php echo $tslug;?>"><?php echo $tproduct_name;?></a></h4>
                    <p class="price product-price"> <span class="price-new"><?php echo '$'.$tprice;?></span> <span class="price-old"><?php echo '$'.$tmarket_price;?></span> 
                    </p>
                  </div>
                  <div class="button-group">
                    <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                    <button type="submit" class="addtocart-btn" >Add To Cart</button>
                    <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
                  </div>
                </div>
              </div>
			 <?php 
		   echo form_close();
		   endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      
      <!--<div class="parallax">
        <ul id="testimonial" class="row owl-carousel product-slider">
          <li class="item">
            <div class="panel-default">
              <div class="testimonial-image"><img src="<?php echo base_url();?>assets/images/t1.jpg" alt="#"></div>
              <div class="testimonial-name"><h2>Janet Wilson</h2></div>
              <div class="testimonial-designation"><p>Web Designer</p></div>
              <div class="testimonial-desc">Rem ipsum doLoremRem ipsum doLorem ipsum ut labore et dolore ma ipsum ut labore et <br> dolore  Rem ipsum doLorem ipsum ut labore et dolore mamagna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur adipisicing.</div>
            </div>
          </li>
          <li class="item">
            <div class="panel-default">
              <div class="testimonial-image"><img src="<?php echo base_url();?>assets/images/t2.jpg" alt="#"></div>
              <div class="testimonial-name"><h2>Linda Howard</h2></div>
              <div class="testimonial-designation"><p>Web Deweloper</p></div>
              <div class="testimonial-desc">Rem ipsum doLoremRem ipsum doLorem ipsum ut labore et dolore ma ipsum ut labore et <br> dolore  Rem ipsum doLorem ipsum ut labore et dolore mamagna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur adipisicing.</div>
            </div>
          </li>
          <li class="item">
            <div class="panel-default">
              <div class="testimonial-image"><img src="<?php echo base_url();?>assets/images/t3.jpg" alt="#"></div>
              <div class="testimonial-name"><h2>Janet Wilson</h2></div>
              <div class="testimonial-designation"><p>Web Designer</p></div>
              <div class="testimonial-desc">Rem ipsum doLoremRem ipsum doLorem ipsum ut labore et dolore ma ipsum ut labore et <br> dolore  Rem ipsum doLorem ipsum ut labore et dolore mamagna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur adipisicing.</div>

            </div>
          </li>
          <li class="item">
            <div class="panel-default">
              <div class="testimonial-image"><img src="<?php echo base_url();?>assets/images/t4.jpg" alt="#"></div>
              <div class="testimonial-name"><h2>Linda Howard</h2></div>
              <div class="testimonial-designation"><p>Web Deweloper</p></div>
              <div class="testimonial-desc">Rem ipsum doLoremRem ipsum doLorem ipsum ut labore et dolore ma ipsum ut labore et <br> dolore  Rem ipsum doLorem ipsum ut labore et dolore mamagna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur adipisicing.</div>

            </div>
          </li>
        </ul>
      </div>-->
      <h3 class="productblock-title">Featured Products</h3>
      <div class="box">
        <div id="feature-slider" class="row owl-carousel product-slider">
          
          <?php 
			$i=0;
			foreach($featuredwproduct->result() as $bsl):
			  $tpro_id=$bsl->product_id;
			  $tproduct_name=$bsl->product_name;
			  $tprice=$bsl->price;
			  $tmarket_price=$bsl->market_price;
			  $tslug=$bsl->slug;
			  $discount=$bsl->discount;
			  $tmain_image=$bsl->main_image;
				echo form_open(base_url('cart/add'), 'style="padding:0; margin:0"');?>
				<input type="hidden" value="<?php echo $tpro_id;?>" name="id" />
				<input type="hidden" value="<?php echo $tproduct_name;?>" name="name" />
				<input type="hidden" value="<?php echo $tmarket_price;?>" name="price" />
              <div class="item">
                <div class="product-thumb transition">
                  <div class="image product-imageblock"> 
                  <a href="<?php echo base_url();?>products/<?php echo $tslug;?>">
                   <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $tmain_image;?>" class="img-responsive" alt="<?php echo $tproduct_name;?>" style="max-height:300px; width:100%;"/></a>
                    <div class="button-group">
                      <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                      <button type="submit" class="addtocart-btn" >Add To Cart</button>
                      <button type="button" class="compare" data-toggle="tooltip" title="<?php echo $tproduct_name;?>" ><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                  <div class="caption product-detail">
                    <h4 class="product-name"><a href="<?php echo base_url();?>products/<?php echo $tslug;?>"><?php echo $tproduct_name;?></a></h4>
                    <p class="price product-price"> <span class="price-new"><?php echo '$'.$tprice;?></span> <span class="price-old"><?php echo '$'.$tmarket_price;?></span> 
                    </p>
                  </div>
                  <div class="button-group">
                    <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                    <button type="submit" class="addtocart-btn" >Add To Cart</button>
                    <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
                  </div>
                </div>
              </div>
			 <?php 
		   echo form_close();
		   endforeach; ?>
          
        </div>
      </div>
      
      
      
      <div class="blog">
        <div class="blog-heading">
          <h3>Latest Blogs</h3>
        </div>
        <div class="blog-inner box">
          <ul class="list-unstyled blog-wrapper" id="latest-blog">
            <li class="item blog-slider-item">
              <div class="panel-default">
                <div class="blog-image"> <a href="#" class="blog-imagelink"><img src="<?php echo base_url();?>assets/images/blog/blog_1.jpg" alt="#"></a> <span class="blog-hover"></span> <span class="blog-date">06/07/2015</span> <span class="blog-readmore-outer"><a href="#" class="blog-readmore">Read More</a></span> </div>
                <div class="blog-content"> <a href="#" class="blog-name">
                  <h2>Artisan wines from Napa Valley</h2>
                  </a>
                  <div class="blog-desc">Rem ipsum doLorem ipsum ut labore et dolore magna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur Lorem ipsum doLorem ipsum dolor sit amet doLorem ipsum dolor sit amet adipisicing...</div>
                  <a href="#" class="blog-readmore">Read More</a> <span class="blog-date">06/07/2015</span> </div>
              </div>
            </li>
            <li class="item blog-slider-item">
              <div class="panel-default">
                <div class="blog-image"> <a href="#" class="blog-imagelink"><img src="<?php echo base_url();?>assets/images/blog/blog_2.jpg" alt="#"></a> <span class="blog-hover"></span> <span class="blog-date">06/07/2015</span> <span class="blog-readmore-outer"><a href="#" class="blog-readmore">Read More</a></span> </div>
                <div class="blog-content"> <a href="#" class="blog-name">
                  <h2>350000+ expert wine ratings</h2>
                  </a>
                  <div class="blog-desc">Rem ipsum doLorem ipsum ut labore et dolore magna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur Lorem ipsum doLorem ipsum dolor sit amet doLorem ipsum dolor sit amet adipisicing...</div>
                  <a href="singale-blog.html" class="blog-readmore">Read More</a> <span class="blog-date">06/07/2015</span> </div>
              </div>
            </li>
            <li class="item blog-slider-item">
              <div class="panel-default">
                <div class="blog-image"> <a href="#" class="blog-imagelink"><img src="<?php echo base_url();?>assets/images/blog/blog_3.jpg" alt="#"></a> <span class="blog-hover"></span> <span class="blog-date">06/07/2015</span> <span class="blog-readmore-outer"><a href="singale-blog.html" class="blog-readmore">Read More</a></span> </div>
                <div class="blog-content"> <a href="#" class="blog-name">
                  <h2>A large and rich guide to wine</h2>
                  </a>
                  <div class="blog-desc">Rem ipsum doLorem ipsum ut labore et dolore magna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur Lorem ipsum doLorem ipsum dolor sit amet doLorem ipsum dolor sit amet adipisicing...</div>
                  <a href="singale-blog.html" class="blog-readmore">Read More</a> <span class="blog-date">06/07/2015</span> </div>
              </div>
            </li>
            <li class="item blog-slider-item">
              <div class="panel-default">
                <div class="blog-image"> <a href="#" class="blog-imagelink"><img src="<?php echo base_url();?>assets/images/blog/blog_4.jpg" alt="#"></a> <span class="blog-hover"></span> <span class="blog-date">06/07/2015</span> <span class="blog-readmore-outer"><a href="#" class="blog-readmore">Read More</a></span> </div>
                <div class="blog-content"> <a href="#" class="blog-name">
                  <h2>Have your favorite Wine</h2>
                  </a>
                  <div class="blog-desc">Rem ipsum doLorem ipsum ut labore et dolore magna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur Lorem ipsum doLorem ipsum dolor sit amet doLorem ipsum dolor sit amet adipisicing...</div>
                  <a href="#" class="blog-readmore">Read More</a> <span class="blog-date">06/07/2015</span> </div>
              </div>
            </li>
            <li class="item blog-slider-item">
              <div class="panel-default">
                <div class="blog-image"> <a href="#" class="blog-imagelink"><img src="<?php echo base_url();?>assets/images/blog/blog_5.jpg" alt="#"></a> <span class="blog-hover"></span> <span class="blog-date">06/07/2015</span> <span class="blog-readmore-outer"><a href="#" class="blog-readmore">Read More</a></span> </div>
                <div class="blog-content"> <a href="#" class="blog-name">
                  <h2>Fast and easy Wine delivery</h2>
                  </a>
                  <div class="blog-desc">Rem ipsum doLorem ipsum ut labore et dolore magna.Lorem ipsum doLorem ipsum dolor sit amet, consectetur Lorem ipsum doLorem ipsum dolor sit amet doLorem ipsum dolor sit amet adipisicing...</div>
                  <a href="#" class="blog-readmore">Read More</a> <span class="blog-date">06/07/2015</span> </div>
              </div>
            </li>
          </ul>
        </div>
      </div>      
    </div>
  </div>
  <div id="brand_carouse" class="owl-carousel brand-logo">
        <div class="item text-center"> <a href="#"><img src="<?php echo base_url();?>assets/images/brand/brand1.png" alt="Disney" class="img-responsive" /></a> </div>
        <div class="item text-center"> <a href="#"><img src="<?php echo base_url();?>assets/images/brand/brand2.png" alt="Dell" class="img-responsive" /></a> </div>
        <div class="item text-center"> <a href="#"><img src="<?php echo base_url();?>assets/images/brand/brand3.png" alt="Harley" class="img-responsive" /></a> </div>
        <div class="item text-center"> <a href="#"><img src="<?php echo base_url();?>assets/images/brand/brand4.png" alt="Canon" class="img-responsive" /></a> </div>
        <div class="item text-center"> <a href="#"><img src="<?php echo base_url();?>assets/images/brand/brand5.png" alt="Canon" class="img-responsive" /></a> </div>
        <div class="item text-center"> <a href="#"><img src="<?php echo base_url();?>assets/images/brand/brand6.png" alt="Canon" class="img-responsive" /></a> </div>
        <div class="item text-center"> <a href="#"><img src="<?php echo base_url();?>assets/images/brand/brand7.png" alt="Canon" class="img-responsive" /></a> </div>
        <div class="item text-center"> <a href="#"><img src="<?php echo base_url();?>assets/images/brand/brand8.png" alt="Canon" class="img-responsive" /></a> </div>
        <div class="item text-center"> <a href="#"><img src="<?php echo base_url();?>assets/images/brand/brand9.png" alt="Canon" class="img-responsive" /></a> </div>
        <div class="item text-center"> <a href="#"><img src="<?php echo base_url();?>assets/images/brand/brand5.png" alt="Canon" class="img-responsive" /></a> </div>
  </div>
</div>