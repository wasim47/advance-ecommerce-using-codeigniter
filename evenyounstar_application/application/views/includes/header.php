<?php include("tophead.php");?>
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="<?php echo base_url();?>assets/images/loader.gif"  alt="#"/></div>
<header>
  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="top-left pull-left">
            <div class="language">
              <form action="#" method="post" enctype="multipart/form-data" id="language">
                <div class="btn-group">
                  <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="<?php echo base_url();?>assets/images/flags/gb.png" alt="English" title="English">English <i class="fa fa-caret-down"></i></button>
                  <ul class="dropdown-menu">
                    <li><a href="#"><img src="<?php echo base_url();?>assets/images/flags/lb.png" alt="Arabic" title="Arabic"> Arabic</a></li>
                    <li><a href="#"><img src="<?php echo base_url();?>assets/images/flags/gb.png" alt="English" title="English"> English</a></li>
                  </ul>
                </div>
              </form>
            </div>
            <div class="currency">
              <form action="#" method="post" enctype="multipart/form-data" id="currency">
                <div class="btn-group">
                  <button class="btn btn-link dropdown-toggle" data-toggle="dropdown"> <strong>$</strong> <i class="fa fa-caret-down"></i> </button>
                  <ul class="dropdown-menu">
                    <li>
                      <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro</button>
                    </li>
                    <li>
                      <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound Sterling</button>
                    </li>
                    <li>
                      <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US Dollar</button>
                    </li>
                  </ul>
                </div>
              </form>
            </div>
          </div>
          <div class="top-right pull-right">
            <div id="top-links" class="nav pull-right">
              <ul class="list-inline">
                <li class="dropdown account"><a href="#" title="My Account" class="  dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user"></i><span>My Account</span> <span class="caret"></span></a>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="register.html">Register</a></li>
                    <li><a href="login.html">Login</a></li>
                  </ul>
                </li>
                <li><a href="#" id="wishlist-total" title="Wish List (0)"><i class="fa fa-heart"></i><span>Wish List</span><span> (0)</span></a></li>
              </ul>
              <div class="search-box">
                <input class="input-text" placeholder="Search By Products.." type="text">
                <button class="search-btn"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 <div class="cs-headertop clearfix cs-sticky-fixed animated fadeInDown">
  <div class="container">
      <div class="col-sm-1 col-xs-6 header-left">
        <!--<div class="shipping">
          <div class="shipping-img"></div>
          <div class="shipping-text">(+91) 000-1233<br>
            <span class="shipping-detail">24/7 Online Support</span></div>
        </div>-->
          <div id="logo"> <a href="index-2.html">
          <img src="<?php echo base_url();?>assets/images/logo.png" title="E-Commerce" alt="E-Commerce" style="width:100%; height:auto" /></a> </div>
      </div>
      <div class="col-sm-9">
      	<nav id="menu" class="navbar">
      <div class="nav-inner">
        <div class="navbar-header"><!--<span id="category" class="visible-xs">Categories</span>-->
          <button type="button" class="btn btn-navbar navbar-toggle" ><i class="fa fa-bars"></i></button>
        </div>
        <div class="navbar-collapse">
          <ul class="main-navigation">
          	<li><a href="#" class="active parent">Home</a></li>
            <li><a href="#" class="active parent">Category</a>
              <ul>
              	<?php 
				$query_cat=$this->db->query("select * from category where status=1 order by sequence asc");
				foreach($query_cat->result() as $row_cat){
					$cat_id=$row_cat->caegory_title;
					$cat_name=$row_cat->cat_name;
				?>
                <li><a href="<?php echo base_url('products/gallery/'.$cat_id);?>"><?php echo $cat_name;?></a></li>
                <?php
				}
		   		?>
              </ul>
            </li>
           <?php foreach($menu->result() as $fmenu){
            $menu_name=$fmenu->menu_name;
            $slug=$fmenu->slug;
            $strMenu=$fmenu->page_structure;
            $m_id=$fmenu->m_id;
            $url=base_url('index/'.$strMenu.'/'.$slug);
			$query_scat=$this->db->query("select * from menu where root_id='".$m_id."' and sroot_id=0 order by m_id asc");
        ?>
        <li><a href="<?php echo $url;?>" class="active parent" title="<?php echo $menu_name;?>"><?php echo $menu_name;?></a>
        	<?php
            if($query_scat->num_rows() > 0){
				?>
                <ul>
              	<?php
					$row_scatRes=$query_scat->result();
					foreach($row_scatRes as $row_scat){
					$scid_id=$row_scat->m_id;
					$sslug=$row_scat->slug;
					$sub_cat_name=$row_scat->menu_name;
					$strSmenu=$row_scat->page_structure;
					$urls=base_url('index/'.$strSmenu.'/'.$slug.'/'.$sslug);
					$query_lcat=$this->db->query("select * from menu where sroot_id='".$scid_id."' order by m_id asc");
					if($query_lcat->num_rows() > 0){
						$class='dropdown-menu sub';
					}
					else{
						$class='dropdown-menu';	
					}
				?>
                <li><a href="<?php echo $urls;?>" title="<?php echo $sub_cat_name;?>"><?php echo $sub_cat_name;?></a></li>
                <?php }?>
              </ul>
                <?php
			}
			
			?>
        	
        </li>        
        <?php
        }
		?>
          </ul>
        </div>
      </div>
    </nav>
      </div>
      <div class="col-sm-2 col-xs-12 header-right">
        <div id="cart" class="btn-group btn-block">
        
        <?php if ($cart = $this->cart->contents()){
				 $grand_total1 = 0;
				 foreach ($cart as $item):
			 			
			 			$totalItem=count($cart);
						$grand_total1 = $grand_total1 + $item['subtotal'];
						endforeach;
						$grandTotalPrice1=$grand_total1+60;
					}
					else{
						$totalItem=0;
						$grandTotalPrice1=0;
				  }
			 ?>
             
          <button type="button" class="btn btn-inverse btn-block btn-lg dropdown-toggle cart-dropdown-button"> <span id="cart-total"><span class="cart-title">Shopping Cart</span><br>
          <?php echo $totalItem;?> item(s) - $<?php echo $grandTotalPrice1;?></span> </button>
          <ul class="dropdown-menu pull-right cart-dropdown-menu" style="margin:0; padding:0;">
          	<?php
			$grand_total = 0; $i = 1;
			foreach ($cart as $item):
				echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
				echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
				echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
				echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
				echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
				
				  $pro_id=$item['id'];
				  $result=$this->db->query("select * from product where product_id='$pro_id'");
				  $resPro=$result->result();
				  foreach($resPro as $pro);
				  $product_id=$pro->product_id;
				  $main_image=$pro->main_image;
				  $pro_price=$pro->price;
				  
				 $grand_total = $grand_total + $item['subtotal'];
				
			?>
            <li>
              <table class="table" style="margin:0; padding:0;">
                <tbody>
                  <tr>
                    <td class="text-center"><a href="<?php echo base_url();?>products/<?php echo $pro->slug;?>">
                    <img style="width:80px; height:auto" alt="<?php echo $item['name'];?>" title="<?php echo $item['name'];?>" 
                    src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>"></a></td>
                    <td class="text-left"><a href="<?php echo base_url();?>products/<?php echo $pro->slug;?>"><?php echo $item['name'];?></a></td>
                    <td class="text-right">x <?php echo $quantityBang; ?></td>
                    <td class="text-right">
                    	<?php
                        	if(is_numeric($pro_price)){
								$convertTPrice =  number_format($pro_price,2);
							}
							else{
								$convertTPrice =  $pro_price;
							}
						?>
                    </td>
                    <td class="text-center"><button class="btn btn-danger btn-xs" title="Remove" type="button" style="padding:3px"><i class="fa fa-times"></i></button></td>
                  </tr>
                </tbody>
              </table>
            </li>
             <?php endforeach;?>  
             <li>
             	<table width="100%" style="margin:0; padding:0;">
                        	<tr>
                            	<td>Subtotal</td>
                            	<td><?php echo $grand_total;?></td>
                            </tr>
                            <tr>
                            	<td>Shipping</td>
                            	<td>60</td>
                            </tr>
                            <tr>
                            	<td>Total</td>
                            	<td>
									<?php 
                                    $grandTotalPrice=$grand_total+60;						
                                    echo $grandTotalPrice;?>
                                </td>
                            </tr>
                            <tr><td colspan="2">&nbsp;</td></tr>
                            <tr>
                            	<td><a href="<?php echo base_url('cart/shopping_cart');?>" class="btn btn-info" style="font-size:16px; text-align:left">View Cart</a></td>
                            	<td><a href="<?php echo base_url('checkout');?>" class="btn btn-warning" style="font-size:16px; text-align:right">Checkout</a></td>
                            </tr>
                        </table>
             </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>