	<section>
		<div class="container">
			<div class="row middlecontainer">
            	<div class="col-sm-12">
                	<div class="col-sm-9 padding-left" style="padding:10px 40px; margin:0; text-align:justify; font-family:SolaimanLipi; font-size:17px;">
                      <?php if($features_details['headline']){?>
                            <h2 style="font-family:SolaimanLipi; "><?php echo stripslashes($features_details['headline']);?></h2>
                            <p><?php echo stripslashes($features_details['details']);?></p>
                        <?php }
                            else{
                                echo "এই মেনুর কাজ এখন প্রক্রিয়াধীন রয়েছে...";
                                }
                        ?>
                    </div>
               	    <div class="col-sm-12 col-lg-3" style="margin-top:10px;">
                        <?php
						 $this->load->view('frontend/leftside_bar');
						?>
                    </div>
                </div>
			</div>
            
		</div>
        
	</section>