<style type="text/css">
@media all {
	.lightbox { display: none; }
.table
{
   display:table;
   text-align:center;
   width:100%;
}

.table-row
{
   width:100%;
   display:table-row;
   text-align:left;
   border-bottom:1px solid #ccc;
   float:left;
   margin-bottom:1px;
}
.table-row h4
{
   padding:0; 
   margin:2px;
}
.table-cell
{
   display:table-cell;
   width:auto;
   text-align:left;
   padding:5px;
   width:18%;
   float:left;
}

.table-cell h5
{
   font-size:12px;
   font-weight:normal;
   padding:2px 0;
   margin:0;
}
</style>		<div class="container">
			<div class="row middlecontainer">
				<div class="col-sm-3">
					<?php include("leftSidebar.php");?>
				</div>
				
				<div class="col-sm-9">
    					<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333; text-align:justify">
        	<h3 class="headline">Order product List</h3>
         		<div style="width:100%;">
                <div style="width:100%; float:left; margin:10px;">
                		 <div class="table">
                            <div class="table-row" style="background:#eaeaea">
                                  <div class="table-cell" style="width:12%;"><h4><strong>Order No.</strong></h4></div>
                                  <div class="table-cell" style="width:25%;"><h4><strong>Time</strong></h4></div>
                                  <div class="table-cell" style="width:15%;"><h4><strong>Status</strong></h4></div>
                                  <div class="table-cell" style="width:20%;"><h4><strong>Total Price</strong></h4></div>
                                  <div class="table-cell" style="width:20%;"><h4><strong>Total Product</strong></h4></div>
                                  <!--<div class="table-cell" style="width:10%;"><h4><strong>Details</strong></h4></div>-->
                               </div>
                               <?php 
								$i=0;
								foreach($userOrder->result() as $order){
									$order_id=$order->order_id;
									$order_number=$order->order_number;
									$order_time=$order->order_time;
									$total_price=$order->total_price;
									$status=$order->status;
									
									  $queryTotal = $this->db->query("select * from orders_products where order_id='".$order_id."'");
									  $rowTotalCount = $queryTotal->result();
									  $totalProdut = $queryTotal->num_rows();
									  foreach($rowTotalCount as $totalPro);
									  
								$i++;
								 ?>
                            <div class="table-row">
                                  <div class="table-cell" style="width:12%;"><h5><strong><?php echo $order_number;?></strong></h5></div>
                                  <div class="table-cell" style="width:25%;"><h5><strong><?php echo $order_time;?></strong></h5></div>
                                  <div class="table-cell" style="width:15%;"><h5><strong><?php echo $status;?></strong></h5></div>
                                  <div class="table-cell" style="width:20%;"><h5><strong><?php echo $total_price;?></strong></h5></div>
                                  <div class="table-cell" style="width:20%;"><h5><strong><?php echo $totalProdut;?></strong></h5></div>
                             </div>
                                
                               <?php
                               }
							   ?>
                         </div>
                </div>
             </div>
        </div>
				</div>
			</div>
		</div>
