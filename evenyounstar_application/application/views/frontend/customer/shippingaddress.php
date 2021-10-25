<?php include('header.php');?>
    <div style="width:75%; float:left;margin-right:20px;">
    	<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; text-align:justify">
        	<h3 class="headline">Top Read product</h3>
         		<div style="width:100%;">
                <div style="width:46%; float:left; margin:10px;">
                     	<?php 
						foreach($productList->result() as $pro){
							$author=$pro->author;
							$query = $this->db->query("select * from author where user_id='".$author."'");
							$rowCount = $query->result();
							foreach($rowCount as $rowR);
							$authorName=$rowR->username;
						?>
                        <div style="width:100%; float:left; margin:3px; padding:2px;">
                            <h5 class="proNameGallery"><a href="<?php echo base_url('product/'.$pro->product_id);?>"><?php echo $pro->product_name;?></a></h5>
                            <h5 class="proWriter"><?php echo $authorName;?></h5>
                        </div>
                        <?php 
						}
						?>
                </div>
                <div style="width:46%; float:right; margin:10px;">
                	<?php 
						foreach($productList->result() as $pro){
							$author=$pro->author;
							$query = $this->db->query("select * from author where user_id='".$author."'");
							$rowCount = $query->result();
							foreach($rowCount as $rowR);
							$authorName=$rowR->username;
						?>
                        <div style="width:100%; float:left; margin:3px; padding:2px;">
                            <h5 class="proNameGallery"><a href="<?php echo base_url('product/'.$pro->product_id);?>"><?php echo $pro->product_name;?></a></h5>
                            <h5 class="proWriter"><?php echo $authorName;?></h5>
                        </div>
                        <?php 
						}
						?>
                </div>
                    
                </div>
        </div>
    </div>
<?php include('footer.php');?>