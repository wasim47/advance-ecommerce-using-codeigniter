<?php include('header.php');?>   
<link rel="stylesheet" href="<?php echo base_url()?>assets/slider/css/flexslider.css" type="text/css" media="screen" />
<script src="<?php echo base_url()?>assets/slider/js/modernizr.js"></script>
<script defer src="<?php echo base_url()?>assets/slider/js/jquery.flexslider.js"></script>
 <div style="width:75%; float:left;margin-right:20px;">
    	<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; text-align:justify">
        	<h3 class="headline">Order product List</h3>
         		<div style="width:100%;">
                <div style="width:100%; float:left; margin:10px;">
                	<div class="flexslider carousel">
             				<ul class="slides">
                     	<?php 
						foreach($productList->result() as $pro){
							$author=$pro->author;
							$product_id=$pro->product_id;
							$slug=$pro->slug;
							$product_name=$pro->product_name;
							$main_image=$pro->main_image;
							$pro_price=$pro->price;
							
							
							$query = $this->db->query("select * from author where user_id='".$author."'");
							$rowCount = $query->result();
							foreach($rowCount as $rowR);
							$authorName=$rowR->username;
						?>
                        
                            <li>
                               <div class="productGallery" style="height:auto">
                                <a href="<?php echo base_url();?>products/<?php echo $slug;?>">
                                  <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" class="galleryImg"/>
                                </a>
                                <div class="productInfoArea">
                                    <div class="productInfo" style="height:auto">
                                        <h5 class="proNameGallery"><?php echo $product_name;?></h5>
                                        <h5 class="proWriter"><?php echo $authorName;?></h5>
                                        <h5 class="proPrice"><?php echo 'BDT '.$pro_price;?></h5>
                                   </div>
                                </div>
                       		 </div>
                          </li>
                        <?php 
						}
						?>
                        </ul>
                        </div>
                	</div>
                
                    
                </div>
        </div>
    </div>  
<script type="text/javascript">

    (function() {

      var $window = $(window),
          flexslider;

      // tiny helper function to add breakpoints
      function getGridSize() {
        return (window.innerWidth < 600) ? 2 :
               (window.innerWidth < 900) ? 3 : 4;
      }

      $(function() {
        SyntaxHighlighter.all();
      });

      $window.load(function() {
        $('.flexslider').flexslider({
          animation: "slide",
          animationSpeed: 2500,
          animationLoop: true,
          itemWidth: 240,
          itemMargin: 3,
          minItems: getGridSize(), 
          maxItems: getGridSize(), 
          start: function(slider){
            $('body').removeClass('loading');
            flexslider = slider;
          }
        });
      });

      // check grid size on resize event
      $window.resize(function() {
        var gridSize = getGridSize();

        flexslider.vars.minItems = gridSize;
        flexslider.vars.maxItems = gridSize;
      });
    }());

  </script>    
<?php include('footer.php');?>