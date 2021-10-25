<?php
	foreach($productdetails->result() as $details);
		  $prid=$details->product_id;
		  $slug=$details->slug;
		  $product_name=$details->product_name;
		  $pro_code=$details->pro_code;
		  $cat_id=$details->scat_id;
		  $main_image=$details->main_image;
		  $photo1=$details->photo1;
		  $photo2=$details->photo2;
		  $photo3=$details->photo3;
		  $pro_price=$details->price;
		  $qty=$details->qty;
		  $prosummery=$details->details;
		  $market_price=$details->market_price;
		  $shipment=$details->shipment;
		  $procolor=$details->color;
		  $prosize=$details->size;
		  $boutiqueshop=$details->boutiqueshop;
?>	
<script src="<?php echo base_url()?>assets/lib/jquery/jquery-1.11.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ratings_stars').click(function(){
			  $(this).prevAll().andSelf().addClass('ratings_over');
			  var thisval = $(this).attr('title');
			   $('#ratval').val(thisval);
			   $(this).nextAll().removeClass('ratings_over');
		});
		
		$('#reviewWrite').click(function(){
			  $("#reviewDisplay").hide();
			   $("#writeReview").show();
		});
		$('#showReview').click(function(){
			  $("#writeReview").hide();
			  $("#reviewDisplay").show();
		});
		
    });
	
	
function productINcDec(pid)
{
	var proQuantity = document.getElementById('proQuantity').value;
	if(pid=="Plus"){
		document.getElementById('proQuantity').value = parseInt(proQuantity) + 1;
	}
	else if(pid=="Minus"){
		if(document.getElementById('proQuantity').value!=1){
			document.getElementById('proQuantity').value = parseInt(proQuantity) - 1;
		}
		else{
			alert('Minimum Quantity is Selected');
		}
	}
}

</script>
<div class="container">
  <ul class="breadcrumb" style="margin-bottom:20px;">
    <li><a href="index-2.html"><i class="fa fa-home"></i></a></li>
    <li><a href="category.html">Desktops</a></li>
    <li><a href="#">lorem ippsum dolor dummy</a></li>
  </ul>
  <div class="row">
    <div id="column-left" class="col-sm-3 hidden-xs column-left">
      <div class="column-block">
        <div class="column-block">
          <div class="columnblock-title">Categories</div>
          <div class="category_block">
            <ul class="box-category treeview-list treeview">
              <li><a href="#" class="activSub">Desktops</a>
                <ul>
                  <li><a href="#">PC</a></li>
                  <li><a href="#">MAC</a></li>
                </ul>
              </li>
              <li><a href="#" class="activSub">Laptops &amp; Notebooks</a>
                <ul>
                  <li><a href="#">Macs</a></li>
                  <li><a href="#">Windows</a></li>
                </ul>
              </li>
              <li><a href="#" class="activSub">Components</a>
                <ul>
                  <li><a href="#">Mice and Trackballs</a></li>
                  <li><a href="#" class="activSub" >Monitors</a>
                    <ul>
                      <li><a href="#"  >test 1</a></li>
                      <li><a href="#"  >test 2</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Windows</a></li>
                </ul>
              </li>
              <li><a href="#">Tablets</a></li>
              <li><a href="#">Software</a></li>
              <li><a href="#">Phones & PDAs</a></li>
              <li><a href="#">Cameras</a></li>
              <li><a href="#">MP3 Players</a></li>
            </ul>
          </div>
        </div>
        <h3 class="productblock-title">Bestsellers</h3>
        <div class="row bestseller-grid product-grid">
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 product-grid-item">
            <div class="product-thumb transition">
              <div class="image product-imageblock"> <a href="#"> <img id="product-zoom" src='<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>' data-zoom-image="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" class="img-responsive"/> </a>
                <div class="button-group">
                  <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                  <button type="button" class="addtocart-btn">Add to Cart</button>
                  <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                </div>
              </div>
              <div class="caption product-detail">
                <h4 class="product-name"> <a href="product.html" title="women's New Wine is an alcoholic">New Wine is an alcoholic</a> </h4>
                <p class="price product-price"> <span class="price-new">$254.00</span><span class="price-tax">Ex Tax: $210.00</span> </p>
              </div>
              <div class="button-group">
                <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                <button type="button" class="addtocart-btn">Add to Cart</button>
                <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 product-grid-item">
            <div class="product-thumb transition">
              <div class="image product-imageblock"> <a href="#"> <img src="<?php echo base_url();?>assets/images/product/3product50x59.jpg" alt="women's New Wine is an alcoholic" title="women's New Wine is an alcoholic" class="img-responsive" /> </a>
                <div class="button-group">
                  <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                  <button type="button" class="addtocart-btn">Add to Cart</button>
                  <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                </div>
              </div>
              <div class="caption product-detail">
                <h4 class="product-name"> <a href="product.html" title="women's New Wine is an alcoholic">New Wine is an alcoholic</a> </h4>
                <p class="price product-price"> <span class="price-new">$254.00</span><span class="price-tax">Ex Tax: $210.00</span> </p>
              </div>
              <div class="button-group">
                <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                <button type="button" class="addtocart-btn">Add to Cart</button>
                <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 product-grid-item">
            <div class="product-thumb transition">
              <div class="image product-imageblock"> <a href="#"> <img src="<?php echo base_url();?>assets/images/product/4product50x59.jpg" alt="women's New Wine is an alcoholic" title="women's New Wine is an alcoholic" class="img-responsive" /> </a>
                <div class="button-group">
                  <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                  <button type="button" class="addtocart-btn">Add to Cart</button>
                  <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                </div>
              </div>
              <div class="caption product-detail">
                <h4 class="product-name"> <a href="product.html" title="women's New Wine is an alcoholic">New Wine is an alcoholic</a> </h4>
                <p class="price product-price"> <span class="price-new">$254.00</span><span class="price-tax">Ex Tax: $210.00</span> </p>
              </div>
              <div class="button-group">
                <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                <button type="button" class="addtocart-btn">Add to Cart</button>
                <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
        </div>
        <h3 class="productblock-title">Latest</h3>
        <div class="row latest-grid product-grid">
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 product-grid-item">
            <div class="product-thumb transition">
              <div class="image product-imageblock">
              <a href="#">
              <img src="<?php echo base_url();?>assets/images/product/1product50x59.jpg" alt="lorem ippsum dolor dummy" title="lorem ippsum dolor dummy" class="img-responsive" />
              </a>
              </div>
              <div class="caption product-detail">
                <h4 class="product-name">
                <a href="#" title="lorem ippsum dolor dummy">New Wine is an alcoholic</a>
                </h4>
                <p class="price product-price">$122.00<span class="price-tax">Ex Tax: $100.00</span></p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 product-grid-item">
            <div class="product-thumb transition">
              <div class="image product-imageblock"><a href="#"><img src="<?php echo base_url();?>assets/images/product/2product50x59.jpg" alt="lorem ippsum dolor dummy" title="lorem ippsum dolor dummy" class="img-responsive" /></a>
                <div class="button-group">
                  <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                  <button type="button" class="addtocart-btn" >Add to Cart</button>
                  <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
                </div>
              </div>
              <div class="caption product-detail">
                <h4 class="product-name">
                <a href="#" title="lorem ippsum dolor dummy">New Wine is an alcoholic</a>
                </h4>
                <p class="price product-price">$122.00<span class="price-tax">Ex Tax: $100.00</span></p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 product-grid-item">
            <div class="product-thumb transition">
              <div class="image product-imageblock"><a href="#"><img src="<?php echo base_url();?>assets/images/product/3product50x59.jpg" alt="lorem ippsum dolor dummy" title="lorem ippsum dolor dummy" class="img-responsive" /></a>
                <div class="button-group">
                  <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                  <button type="button" class="addtocart-btn" >Add to Cart</button>
                  <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
                </div>
              </div>
              <div class="caption product-detail">
                <h4 class="product-name">
                <a href="#" title="lorem ippsum dolor dummy">New Wine is an alcoholic</a>
                </h4>
                <p class="price product-price">$122.00<span class="price-tax">Ex Tax: $100.00</span></p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 product-grid-item">
            <div class="product-thumb transition">
              <div class="image product-imageblock"><a href="#"><img src="<?php echo base_url();?>assets/images/product/2product50x59.jpg" alt="lorem ippsum dolor dummy" title="lorem ippsum dolor dummy" class="img-responsive" /></a>
                <div class="button-group">
                  <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                  <button type="button" class="addtocart-btn" >Add to Cart</button>
                  <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
                </div>
              </div>
              <div class="caption product-detail">
                <h4 class="product-name">
                <a href="#" title="lorem ippsum dolor dummy">New Wine is an alcoholic</a>
                </h4>
                <p class="price product-price">$122.00<span class="price-tax">Ex Tax: $100.00</span></p>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="content" class="col-sm-9">
      <div class="row">
        <div class="col-sm-6">
          <div class="thumbnails">
            <div><a class="thumbnail" href="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" title="<?php echo $product_name;?>">
            <img id="product-zoom" src='<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>' alt="<?php echo $product_name;?>"/> </a></div>
            <div id="product-thumbnail" class="owl-carousel">
             <?php if($photo1!=""){?>
              <div class="item">
                <div class="image-additional"><a class="thumbnail" href="<?php echo base_url()?>uploads/images/product/photo1/<?php echo $photo1;?>" 
                title="<?php echo $product_name;?>">
            <img id="product-zoom" src='<?php echo base_url()?>uploads/images/product/photo1/<?php echo $photo1;?>' alt="<?php echo $product_name;?>"/> </a></div>
              </div>
              <?php 
			  }
			  if($photo2!=""){
			  ?>
              <div class="item">
                <div class="image-additional"><a class="thumbnail" href="<?php echo base_url()?>uploads/images/product/photo2/<?php echo $photo2;?>" title="<?php echo $product_name;?>">
            <img id="product-zoom" src='<?php echo base_url()?>uploads/images/product/photo2/<?php echo $photo2;?>' alt="<?php echo $product_name;?>"/> </a></div>
              </div>
              <?php 
			  }
			  if($photo3!=""){
			  ?>
              <div class="item">
                <div class="image-additional"><a class="thumbnail" href="<?php echo base_url()?>uploads/images/product/photo3/<?php echo $main_image;?>" title="<?php echo $product_name;?>">
            <img id="product-zoom" src='<?php echo base_url()?>uploads/images/product/photo3/<?php echo $photo3;?>' alt="<?php echo $product_name;?>"/> </a></div>
              </div>
              <?php 
			  }
			  if($photo4!=""){
			  ?>
              <div class="item">
                <div class="image-additional"><a class="thumbnail" href="<?php echo base_url()?>uploads/images/product/photo4/<?php echo $main_image;?>" title="<?php echo $product_name;?>">
            <img id="product-zoom" src='<?php echo base_url()?>uploads/images/product/photo4/<?php echo $photo4;?>' alt="<?php echo $product_name;?>"/> </a></div>
              </div>
              <?php 
			  }
			  ?>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <?php echo form_open(base_url('cart/add'));?>
            <input type="hidden" value="<?php echo $prid;?>" name="id" />
            <input type="hidden" value="<?php echo $product_name;?>" name="name" />
            <input type="hidden" value="<?php echo $pro_price;?>" name="price" />
            <input type="hidden" value="<?php echo $shipment;?>" name="shipment" />
          <h1 class="productpage-title"><?php echo $product_name;?></h1>
          <div class="rating product"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="review-count"> <a href="#" onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;">1 reviews</a> / <a href="#" onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a></span>
            <hr>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style"><a class="addthis_button_facebook_like" ></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
            <!-- AddThis Button END -->
          </div>
          <ul class="list-unstyled productinfo-details-top">
            <li>
              <h2 class="productpage-price"><?php echo '$'.$pro_price;?></h2>
            </li>
            
            <?php if($market_price!="" || $market_price>0){?>
            <li><span class="productinfo-tax"><?php echo $market_price;?></span></li>
            <?php } ?>
          </ul>
          <hr>
          <ul class="list-unstyled product_info">
            <li>
              <label>Brand:</label>
              <span> <a href="#">Apple</a></span></li>
            <li>
              <label>Product Code:</label>
              <span> <?php echo $pro_code;?></span></li>
            <li>
              <label>Availability:</label>
              <span> In Stock</span></li>
          </ul>
          <hr>
          <div class="form-option">
                                    <p class="form-option-title">Available Options:</p>
                                    <?php if($procolor!=""){?>
                                        <div class="attributes">
                                            <div class="attribute-label">Color:</div>
                                            <div class="attribute-list">
                                            
                                                <ul class="list-color">
                                                    <?php 
                                                    $clorexpval=explode(',',$procolor);
                                                    foreach($clorexpval as $cval){
                                                    ?>
                                                    <li style="background:<?php echo $cval;?>;"><a href="#"></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="attributes" style="padding:10px;">
                                        <div class="attribute-label">Qty:</div>
                                        <div class="attribute-list product-qty">
                                            <div class="qty" style="width:20%; float:left">
                                                <input id="proQuantity" name="productQuantity" type="text" value="1" style="padding:5px; font-weight:bold; width:100%">
                                            </div>
                                            <div class="btn-plus" style="width:10%; float:left; margin-left:-30px; margin-top:5px;">
                                                <a href="javascript:void()" class="btn-plus-up" onclick="productINcDec('Plus')" style="cursor:pointer">
                                                    <i class="fa fa-caret-up"></i>
                                                </a>
                                                <a href="javascript:void()" class="btn-plus-down" onclick="productINcDec('Minus')" style="cursor:pointer">
                                                    <i class="fa fa-caret-down"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($procolor!=""){?>
                                    <div class="attributes">
                                        <div class="attribute-label">Size:</div>
                                        <div class="attribute-list">
                                            <select name="size" class="col-sm-3">
                                                <?php 
													$expval=explode(',',$prosize);
													foreach($expval as $val){
													?>
													<option value="<?php echo $val;?>"><?php echo $val;?></option>
													<?php
													}
													?>
                                            </select>
                                            <a id="size_chart" class="fancybox" href="<?php echo base_url();?>assets/hotsellslider/data/size-chart.jpg">Size Chart</a>
                                        </div>
                                        
                                    </div>
                                     <?php } ?>
                                </div>
          <div id="product">
            <div class="form-group" style="margin-top:10px;">
              <div class="btn-group">
                <button type="button" data-toggle="tooltip" class="btn btn-default wishlist" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                <button type="submit" id="button-cart" data-loading-text="Loading..." class="btn btn-primary btn-lg btn-block addtocart">Add to Cart</button>
                <button type="button" data-toggle="tooltip" class="btn btn-default compare" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
              </div>
             
            </div>
            
            <div class="form-group" style="margin-top:30px;">
              
              <?php include("productshare.php")?>
            </div>
          </div>
          
        <?php echo form_close();?>  
        </div>
        
        
        
      </div>
      <div class="productinfo-tab">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
          <li><a href="#tab-review" data-toggle="tab">Reviews (<?php echo $prodctreview->num_rows;?>)</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab-description">
            <div class="cpt_product_description ">
              <div>
                <p><?php echo stripslashes($prosummery);?></p>
              </div>
            </div>
            <!-- cpt_container_end --></div>
          <div class="tab-pane" id="tab-review">
            <div id="reviews" class="tab-panel">
                                    <div class="product-comments-block-tab">
                                    	<div id="reviewDisplay">
											<?php
											if($prodctreview->num_rows()>0){
                                                foreach($prodctreview->result() as $prorating):
                                            ?>
                                            <div class="comment row">
                                                <div class="col-sm-3 author">
                                                    <div class="grade">
                                                        <span>Rating</span>
                                                        <span class="reviewRating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </span>
                                                    </div>
                                                    <div class="info-author">
                                                        <span><strong><?php echo $prorating->username;?></strong></span>
                                                        <em><?php echo $prorating->date;?></em>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 commnet-dettail"><?php echo $prorating->review;?></div>
                                            </div>
                                            <?php endforeach;
											}
											else{
												echo '<p>There are no review yet. Would you like to submit your reviews ?</p>';	
											}
											?>
                                            <p>
                                                <a class="btn-comment" id="reviewWrite" href="javascript:void();">Write your review !</a>
                                            </p>
                                        </div>
                                        <div id="writeReview" style="display:none">
                             <h3 style="font-weight:normal; float:left; margin-bottom:15px;">Be The First Review "<?php echo $product_name;?>"</h3>
                             <span style="float:right;"><a class="btn-comment" id="showReview" href="javascript:void();">See all Reviews</a></span>
                             <?php echo form_open_multipart('products/access/review', array('class'=>'form-horizontal','role'=>'form')); ?>
                             <h4><?php echo $this->session->flashdata('globalMsg'); ?></h4>
                          	   <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="col-sm-3"><label class="control-label">Name *</label></div>
                                        <div class="col-sm-9"><input type="text" name="username" class="form-control" required/></div>
                                    </div>
                               </div>
                               <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="col-sm-3"><label class="control-label">Email *</label></div>
                                        <div class="col-sm-9"><input type="text" name="email" class="form-control" required /></div>
                                    </div>
                               </div>
                               <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="col-sm-3"><label class="control-label">Your Rating</label></div>
                                        <div class="col-sm-9">
                                        	<div class='movie_choice'>
                                        <div id="r1" class="rate_widget">
                                            <div class="ratings_stars" title="1"></div>
                                            <div class="ratings_stars" title="2"></div>
                                            <div class="ratings_stars" title="3"></div>
                                            <div class="ratings_stars" title="4"></div>
                                            <div class="ratings_stars" title="5"></div>
                                            <input type="hidden" id="ratval" name="ratingVal" />
                                            <input type="hidden" name="pro_id" value="<?php echo $prid;?>" />
                                            <input type="hidden" name="slug" value="<?php echo $slug;?>" />
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                               </div>
                               <div class="form-group">
                                    <div class="col-sm-8">
                                        <div class="col-sm-3"><label class="control-label">Your Review  *</label></div>
                                        <div class="col-sm-9"><textarea name="review" class="form-control" required style="background:none; border:1px solid #ccc"></textarea></div>
                                    </div>
                               </div> 
                               <div class="form-group">
                                    <div class="col-sm-8">
                                <input type="submit" name="submit" class="btn btn-success" value="Submit Review" />
                                </div>
                             </div>
                             <?php echo form_close();?>
                                        </div>
                                    </div>
                                    
                                </div>
          </div>
        </div>
      </div>
      <h3 class="productblock-title">Related Products</h3>
      <div class="box">
        <div id="related-slidertab" class="row owl-carousel product-slider">
          
          <?php 
			$i=0;
			foreach($relatedproducts->result() as $bsl):
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
              <div class="image product-imageblock"> <a href="<?php echo base_url();?>products/<?php echo $tslug;?>">	<img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $tmain_image;?>" class="img-responsive" alt="<?php echo $tproduct_name;?>"/></a>
                <div class="button-group">
                  <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                  <button type="button" class="addtocart-btn">Add to Cart</button>
                  <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                </div>
              </div>
              <div class="caption product-detail">
                <h4 class="product-name"><a href="<?php echo base_url();?>products/<?php echo $tslug;?>"><?php echo $tproduct_name;?></a></h4>
                <p class="price product-price"> <span class="price-new">$<?php echo $tprice;?></span> <span class="price-old">$<?php echo $tmarket_price;?></span> 
                </p>
              </div>
              <div class="button-group">
                <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                <button type="submit" class="addtocart-btn">Add to Cart</button>
                <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
         <?php
			echo form_close();
			endforeach;
			?>
        </div>
      </div>
    </div>
  </div>
</div>


