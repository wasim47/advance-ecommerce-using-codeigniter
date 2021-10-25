	<section>
		<div class="container">
			<div class="row middlecontainer">
            <div class="col-sm-12">
            <div class="col-sm-9 padding-left" style="padding:10px 40px; margin:0; text-align:justify; font-family:SolaimanLipi; font-size:17px;">
                  <?php if($articledetails['headline']){?>
                        <h2 style="font-family:SolaimanLipi; "><?php echo stripslashes($articledetails['headline']);?></h2>
                        <p><?php echo stripslashes($articledetails['details']);?></p>
                    <?php } ?>
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