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
	$product_summery='Product Code: '.$pro_code.'<br> Price: '.$pro_price.'Size: '.$prosize.' Details: '.$prosummery;
?>	
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Bangladesh butikshop,Butikbd,Boutiquebd,Butikshop,butik somahar,online boutique market,online boutique product,anjans product,arong products,sadakalo,lubnan,lereave,keykraft,mens product,women porduct, panjabi,Online Salwar,Kameez Designs,Kameez Design,Churidar dress,Sarees Online,Online Readymade dress,Long Kameez,short Kameez,Boutique Sarees,Boutique Salwar,Stylish,Deshi Collection,Salwarkameez,Salwar Shopping,bangladeshi salwer,indian salwer,jamdani sharee,katan sharee,wedding saree, wedding dress,women dress,three pieces,men shirts,polo shirts,full sleav,half sleave,formal shirts,genji,online shopping,online market,Designer Salwar,Designer collection,Men Collection,Women Collection,Anarkali,Kameez Pakistani,Online Anarkali,Pakhi Dress,Latest Kameez,Suite,Coat Pants,Kids Dress,Old men Dress,lather Bags,Money Bag, Butik Products,deshi salwer kameez,men blazer,Women Blazer,women sirts,Women Lagees,Wedding Products,Men Cloths,Women Cloths,eCommerce,Online Shopping Mall,Online kapor Bazar,cheleder kapor,meyeder Kapor,Cheleder Coat Pants,Tie and shirts,Colorfull Products," />
<meta name="description" content="Bangladesh First and Biggest Boutique Market with all Boutique shop in bangladesh.All Kind of Boutique Products, Men Shirts, T-sirts, Pants Blazer, Women Salwer Kameez, Churidar, Sharee,Bags,Hand Bags and all kind of Bangladeshi Boutique Produts.Online Biggest eCommerce Portal and Inventory Manaement System in Bangladesh.">
<meta property="og:title" content="<?php echo $title;?>"/>
<meta property="og:site_name" content="Butikbd"/>
<meta property="og:description" content="Bangladesh First and Biggest Boutique Market with all Boutique shop in bangladesh.All Kind of Boutique Products, Men Shirts, T-sirts, Pants Blazer, Women Salwer Kameez, Churidar, Sharee,Bags,Hand Bags and all kind of Bangladeshi Boutique Produts.Online Biggest eCommerce Portal and Inventory Manaement System in Bangladesh."/>
<meta property="og:image" content="http://butikbd.com/assets/images/front/butikbdlogo.png"/>
<meta property="og:image:secure_url" content="http://butikbd.com/assets/images/front/butikbdlogo.png" />
<meta property="og:type" content="eCommerce"/>
<meta property="og:url" content="http://butikbd.com/"/>
<meta property="og:street_address"	   content="EHL Kamalapur,Suite: 410, Motijheel,PO Box-134, GPO, Dhaka-1000"/>
<meta property="og:postal_code"		   content=1000 />
<meta property="og:country_name"	   content=Bangladesh />
<meta name="author" content="Mohammad Wasim, wasim.html@gmail.com, 01922002381">
<meta property="fb:app_id" content="208751499468092" /> 
<meta property="fb:admins" content="208751499468092" />



    <title><?php echo $title;?></title>
    <link href="<?php echo base_url()?>assets/css/front/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/front/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/front/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/front/price-range.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/front/animate.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/css/front/main.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/css/front/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/css/social-buttons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/popup/reveal.css">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/front/fabicon.png">
    <link href="<?php echo base_url()?>assets/main_slider/slider.css" rel="stylesheet" />

<link href="<?php echo base_url()?>assets/megamenu/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/megamenu/css/menu3d.min.css" rel="stylesheet" media="screen, projection"/>
<link href="<?php echo base_url()?>assets/megamenu/css/animate.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/megamenu/css/skin.css" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url()?>assets/megamenu/js/jquery-1.10.1.min.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?php echo base_url()?>assets/main_slider/slider.js"></script>
<script src="<?php echo base_url()?>assets/megamenu/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/megamenu/js/menu3d.min.js" type="text/javascript"></script>
 
<script src="<?php echo base_url()?>assets/megamenu/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/megamenu/js/jquery.ddslick.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/megamenu/js/demo.js" type="text/javascript"></script>
<link href="<?php echo base_url()?>assets/megamenu/css/demo.css" rel="stylesheet" type="text/css"/>
<!----------------------------- mega menu -------------------------->
    <script type="text/javascript" src="<?php echo base_url()?>assets/popup/jquery.reveal.js"></script>
    <script type="text/javascript" language="php">
		$(window).scroll(function(){
			if (screen.width >= 768) {
				if ($(window).scrollTop() >= 300) {
				   $('.header_top').addClass('fixed-header');
				   $('.logo').hide();
				   $('.searchTrollyArea').css('margin-top','0');
				   $('.logoSmall').slideDown();	
				}
				else {
				   $('.header_top').removeClass('fixed-header');
				   $('.logoSmall').slideUp();
					$('.logoSmall').css('display','none');
					$('.searchTrollyArea').css('margin-top','2%');
				   $('.logo').show();	
				}
			}
		});
		
	$(document).ready(function(){
		$("#view_trolly").hover(function(){
			$("#view_trolly_frame").slideDown("slow");
		});
		
		$("#view_trolly_frame").mouseout(function(){
			$("#view_trolly_frame").slideUp();
		});
	});
	</script>
    <?php
if($this->session->flashdata('invalidmsg')){
?>
<script>
$(document).ready(function(){
	$('.loginModel').trigger('click');
});
</script>
<?php
}
?>
    <style>
.deshboard{
		width:100%; float:left;
	}
.deshboard ul{
	width:100%; 
	float:left;
	padding:0;
	margin:0;
}
.deshboard ul li{
	display:inline;
}
.deshboard ul li a{
	width:40%;
	float:left;
	padding:40px 10px;
	background:#fff;
	margin:10px 5px;
	text-decoration:none;
	color:#333;
	text-shadow:#fff 1px 1px;
	border-radius:5px;
	border:1px solid #999;
	text-align:center;
	overflow:hidden;
	font-size:18px;
}
.deshboard ul li a:hover{
	display:inline;
	color:#000;
	background:#ccc;
	transition: all 1s ease-in-out;
}
#view_trolly_frame{
		display:none;	
		z-index:1000000;
		float:right;
		position:absolute;
		margin-top:-10px;
		z-index:100000;
	}
</style>

<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?3b40Hejajzv3KO2jbQOtGCq9oLiXdpV1";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>


</head>

<body style="background:#F7F5EE">
	<header id="header">
    	 <div class="top_header">
       	 <div class="container">
            <div class="col-sm-12">
            <div class="col-sm-5 conArea1">
                <div style="float:left; width:auto"> Free Shipping above Tk.3000 Cash on Delivery* | Easy Returns</div>
           
            </div>
           
            <div class="col-sm-12 col-lg-7 conArea3">
                <ul>
                    <?php 
                    if($this->session->userdata('userAccessMail')){
                    ?>
                    <li><a href="<?php echo base_url('Profile/'.$this->session->userdata('userAccessType'));?>">My Account &nbsp;</a></li>
                    <li><a href="<?php echo base_url();?>index/logout">Logout &nbsp;| &nbsp;</a></li>
                    <li><a href="javascript:void();" style="margin-right:5px;">Track Order &nbsp;| &nbsp;</a></li>
                     <?php
                    }
                    else{
                    ?>
                   <li><a href="javascript:void();"  class="big-link" data-reveal-id="registrationModel">Register</a></li>
                   <li><a href="javascript:void();" class="big-link loginModel" data-reveal-id="myModal"> Login &nbsp;| &nbsp;</a></li>
                   <li><a href="javascript:void();" class="big-link loginModel" data-reveal-id="trackorderModel">Track Order &nbsp;| &nbsp;</a></li>
                    <?php
                    }
                    ?>
                   
                   <li><a href="javascript:void();">24x7 Customer Service &nbsp;| &nbsp;</a></li>
                   <li><a href="#" style="margin-right:5px;"><i class="fa fa-phone"></i> +8801673215210 | </a></li>
				   <li><a href="mailto:info@butikbd.com" style="margin-right:5px;"><i class="fa fa-envelope"></i> info@butikbd.com</a></li>
                </ul>
            </div>
          </div>
          </div>
        </div>
        
		 <div class="header_top">
			
            <div class="row">
            	<div class="container">
				<div class="col-sm-12">
					<div class="col-sm-12 col-lg-2 logo">
						<a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/front/butikbdlogo.png" alt="Butikbd.com" /></a>
					</div>
                    <div class="col-sm-12 col-lg-2 logoSmall">
						<a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/front/butikbdlogo.png" alt="Butikbd.com" /></a>
					</div>
                    
					<div class="searchTrollyArea">
						<?php echo form_open('index/search_data');?>
                         <div class="col-sm-12 col-lg-8">
                        <div class="input-group stylish-input-group">
                        <div class="col-sm-12" style="margin:0; padding:0">
                        <input type="text" class="input_form" placeholder="Search what you want.." name="keyword" >
                        <select name="boutiqueshop" class="select_form">
                            <option value="">Boutique Shop</option>
                            <?php
                              foreach($allbutikshop->result() as $allbutik){
                                  $butikname=$allbutik->username;
                                  $butikimg=$allbutik->photo;
                                  $butikId=$allbutik->user_id;
                              ?>
                            <option value="<?php echo $butikId;?>"><?php echo $butikname;?></option>
                            <?php } ?>
                        </select>
                        <select name="pro_category" class="select_form">

                            <option value="">Product Category</option>
                            <?php
                               $query_cat=$this->db->query("select * from category where status=1 and boutiqueshop='Butikbd' order by sequence asc limit 8");
                                    foreach($query_cat->result() as $row_cat){
                                    $cat_id=$row_cat->caegory_title;
                                    $cat_name=$row_cat->cat_name;
                              ?>
                            <option value="<?php echo $cat_id;?>"><?php echo $cat_name;?></option>
                            <?php } ?>
                        </select>
                        </div>
                        <span class="input-group-addon">
                            <button type="submit" style="color:#fff">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>  
                        </span>
                    </div>
                 <div class="col-sm-12 search_keyword">
                <span class="search-tag">Popular: </span>
                <?php
					  if(isset($search_kewwords)){
						  foreach($search_kewwords as $val){
						  $proName = $val->keywords;
							?>
                <span><?php echo $proName.','; ?></span>
                <?php
							}
						}
              		?>
                </div>
                        </div>
                         <?php echo form_close();?>
                         <?php
                          if($cart = $this->cart->contents()){ 
                            $totalPro=count($cart);
                         }
                         else{
                            $totalPro=0; 
                            }
                         ?>
                         
                         <div class="col-sm-12 col-lg-2" >
                         
                            <div class="trollybtn" id="view_trolly" style="cursor:pointer">
                                <a href="<?php echo base_url("cart/shopping_cart")?>" style="text-decoration:none; color:#fff"><span style="padding:5px;"><i class="fa fa-shopping-cart fa-lg"></i></span>
                                  Cart <span class="bullet"><?php echo $totalPro;?></span>
                                  </a>
                              </div>
                              
                        </div>
                    </div>
				</div>
			</div>
            </div>
		</div>
        
        <div id="view_trolly_frame"  class="container col-sm-4 col-lg-offset-8" style="float:left">
              	  <iframe frameborder="0" scrolling="no"  align="top" style="height:1100px; float:right; padding:0px; margin:0px; width:300px;" src="<?php echo base_url();?>cart/view_trolly"></iframe>
                </div>
		 <div class="col-sm-12" style="padding:0; margin:0; z-index:100">
         	<?php include('menu.php');?>
         </div>
         
	</header>
    
    
    
<div id="trackorderModel" class="reveal-modal" style="width:40%; z-index:100000">
<?php echo form_open_multipart('index/userLogin', array('class'=>'form-horizontal','role'=>'form')); ?>
<?php echo $this->session->flashdata('invalidmsg'); ?> 
      
    
    <input type="hidden" name="usertype" value="customer" />
  <div class="form-group col-sm-12 col-md-12 col-lg-12">  
  <div class="col-sm-3 col-md-3 col-lg-3"> <label class="control-label">Email</label></div> 
	 <div class="col-sm-8 col-md-8 col-lg-8">  <input name="email" id="email" class="form-control" type="email"  required="required" value="<?php echo set_value('email'); ?>" placeholder="Email Address"/></div>
		<?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
	</div>
   <div class="form-group col-sm-12 col-md-12 col-lg-12">  
  <div class="col-sm-3 col-md-3 col-lg-3"> <label class="control-label">Password</label></div> 
	 <div class="col-sm-8 col-md-8 col-lg-8">  <input name="password" id="password" class="form-control" type="password"  required="required" value="<?php echo set_value('password'); ?>" placeholder="Password"/></div>
		<?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
	</div>
  
  <div class="form-group col-sm-11 col-md-11 col-lg-11">       
	  <input name="login" id="login" type="submit" value="Login" class="btn btn-primary" style="float:right" />
	</div>
<?php echo form_close(); ?>
<a class="close-reveal-modal">&#215;</a>
</div>    
<div id="myModal" class="reveal-modal" style="width:40%; z-index:100000">
<?php echo form_open_multipart('index/userLogin', array('class'=>'form-horizontal','role'=>'form')); ?>
<?php echo $this->session->flashdata('invalidmsg'); ?> 
      <div class="form-group col-sm-12 col-md-12 col-lg-12">        
	   <div class="col-sm-3 col-md-3 col-lg-3"><label class="control-label">User Type</label></div>
	  <div class="col-sm-8 col-md-8 col-lg-8">
      	<select style="cursor:pointer" class="form-control" required name="usertype">
                <option value="customer">Customer</option>
                <option value="boutiqueshop">Boutiqueshop</option>
            </select></div>
		<?php echo form_error('usertype', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
	</div>
    
    
  <div class="form-group col-sm-12 col-md-12 col-lg-12">  
  <div class="col-sm-3 col-md-3 col-lg-3"> <label class="control-label">Email</label></div> 
	 <div class="col-sm-8 col-md-8 col-lg-8">  <input name="email" id="email" class="form-control" type="email"  required="required" value="<?php echo set_value('email'); ?>" placeholder="Email Address"/></div>
		<?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
	</div>
   <div class="form-group col-sm-12 col-md-12 col-lg-12">  
  <div class="col-sm-3 col-md-3 col-lg-3"> <label class="control-label">Password</label></div> 
	 <div class="col-sm-8 col-md-8 col-lg-8">  <input name="password" id="password" class="form-control" type="password"  required="required" value="<?php echo set_value('password'); ?>" placeholder="Password"/></div>
		<?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
	</div>
  
  <div class="form-group col-sm-11 col-md-11 col-lg-11">       
	  <input name="login" id="login" type="submit" value="Login" class="btn btn-primary" style="float:right" />
	</div>
<?php echo form_close(); ?>
<a class="close-reveal-modal">&#215;</a>
</div>   
<div id="registrationModel" class="reveal-modal" style="z-index:100000">
	<div class="deshboard">
       <ul>
           <li><a href="<?php echo base_url();?>registration/customer">Customer</a></li>
           <li><a href="<?php echo base_url();?>registration/boutiqueshop">Boutique Shop</a></li>
       </ul>
</div>
<a class="close-reveal-modal">&#215;</a>
</div> 
