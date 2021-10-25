<div class="left-sidebar">
						<h2 style="height:40px;"><span style="float:left; text-align:left">Category </span> <span style="float:right; text-align:right">&raquo;</span></h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php
							$i=0;
							$query_cat=$this->db->query("select * from category where status=1 and boutiqueshop='Butikbd' order by sequence asc");
								foreach($query_cat->result() as $row_cat){
								$cat_id=$row_cat->caegory_title;
								$cat_name=$row_cat->cat_name;
							    $catPro=$this->db->query("select * from product where cat_id='".$cat_id."'");
						 		if($catPro->num_rows() > 0){
									$totalPro=$catPro->num_rows();
								}
								else{
									$totalPro=0;
								}
							   $query_scat=$this->db->query("select * from sub_category where cat_id='".$cat_id."' order by sequence asc");
							   if($query_scat->num_rows() > 0){
								?>
									<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordian" href="#mens<?php echo $i;?>">
												<span class="badge pull-right"><i class="fa fa-plus"></i></span>
												<?php echo $cat_name;?> (<?php echo $totalPro;?>)
											</a>
										</h4>
									</div>
									<div id="mens<?php echo $i;?>" class="panel-collapse collapse">
										<div class="panel-body">
											<ul>
												<?php
												foreach($query_scat->result() as $row_scat){
													$scid_id=$row_scat->sub_cat_title;
													$scid_name=$row_scat->sub_cat_name;
												?>
												<li><a href="<?php echo base_url('products/gallery/'.$cat_id.'/'.$scid_id);?>"><?php echo $scid_name;?></a></li>
												<?php
												}
												?>
											</ul>
										</div>
									</div>
								</div>
								<?php
							   }
								else{
								?>
                                <div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="<?php echo base_url('products/gallery/'.$scid_id);?>">
									<?php echo $cat_name;?>  (<?php echo $totalPro;?>)</a></h4>
								</div>
							</div>
                                <?php
								}
								$i++;
							}
							?>
						</div><!--/category-products-->
						<div class="brands_products"><!--brands_products-->
							<h2>All Boutique Shop</h2>
							<div class="brands-name" style="max-height:350px; overflow:scroll; overflow-x:hidden">
								<ul class="nav nav-pills nav-stacked">
									<?php
										  foreach($allbutikshop->result() as $allbutik){
											  $urlname=$allbutik->urlname;
											  $butikname=$allbutik->username;
											  $butikimg=$allbutik->photo;
											  $butikId=$allbutik->user_id;
											  $query=$this->Index_model->getAllItemTable('membership','member_id',$butikId,'','','id','desc');
											  if($query->num_rows() > 0){
												 	$url= base_url($urlname);
													$target='_blank';
											   }
											   else{
												 $url= "javascript:void();";  
												 $target='_self"';
											   }
										  ?>
                                    	<li> <a href="<?php echo $url;?>" target="<?php echo $target;?>"><?php echo $butikname;?> <span class="fa fa-angle-double-right pull-right"></span></a></li>
                                        <?php
										  }
										?>
								</ul>
							</div>
						</div>
						<!--<div class="price-range">
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div>-->
						<div class="shipping text-center">
							<img src="<?php echo base_url('assets/images/front/home/shipping.jpg');?>" alt="" />
						</div><!--/shipping-->
					</div>