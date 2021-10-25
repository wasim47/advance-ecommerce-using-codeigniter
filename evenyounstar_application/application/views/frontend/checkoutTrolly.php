<div class="col-sm-12" style="padding:5px; float:left; box-shadow:#eaeaea 0 0 3px 3px;  background-color:#f5f5f5; height:auto; opacity:0.9; font-size:11px; z-index:6">
<?php if ($cart = $this->cart->contents()){ ?>
    
   	<table width="100%" border="0" bordercolor="#FFFFFF" cellpadding="0" cellspacing="0" 
    style="border-collapse:collapse; color:#333; font-size:14px; font-family:Arial, Helvetica, sans-serif; font-style:italic;background-color:#fff; opacity:0.9;">
			<thead>
            <tr><td height="45" colspan="78" style=" font-weight:bold; font-size:18px; text-align:left; padding-left:10px">Trolly Items</td>
            </tr>
				<tr>
				  <td width="20%" height="21" style="width:20%;  border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">Product </td>
                  <td width="2%">&nbsp;</td>
				  <td width="31%" style=" border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">Price</td>
                  <td width="2%">&nbsp;</td>
				  <td width="14%" style="border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">
				  Qty</td>
                  <td width="1%"></td>
                  <td width="22%"  style="border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">Total Price</td>
				  <td width="8%">&nbsp;</td>
			  </tr>
              <tr>
				  <td width="20%" height="2" style="width:20%;  border-bottom:1px solid #CCCCCC;"></td>
                <td width="2%"></td>
				  <td width="31%" style="width:10%;  border-bottom:1px solid #CCCCCC;"></td>
                <td width="2%"></td>
			    <td width="14%" style="width:10%;  border-bottom:1px solid #CCCCCC;"></td>
                <td width="1%"></td>
                <td width="22%" style="width:10%; border-bottom:1px solid #CCCCCC;"></td>
			    <td width="8%" style="width:8%;"></td>
			  </tr>
			</thead>
            <tbody>
			<?php
			$grand_total = 0; $i = 1;
			foreach ($cart as $item):
				echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
				echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
				echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
				echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
				echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
				
					$grand_total = $grand_total + $item['subtotal'];
                    $productAllId[] = $item['id'];
                    $qty[] = $item['qty'];
                    $unitPrice[] = $item['price'];
                    $subtotal[] = $item['subtotal'];
                    $shippment_val = $item['options']['shipment'];
                    $shippment_total_val[] = $shippment_val;
					
				$pro_id=$item['id'];
				  $result=$this->db->query("select * from product where product_id='$pro_id'");
				  $resPro=$result->result();
				  foreach($resPro as $pro);
				  $product_id=$pro->product_id;
				  $main_image=$pro->main_image;
				  $pro_price=$pro->price;
				  $pro_code=$pro->pro_code;
				  $main_image=$pro->main_image;
				  $boutiqueshop=$pro->boutiqueshop;
			?>
				<tr>
					<td height="23" align="right" style="border-bottom:1px solid #CCCCCC; padding:2px;">
					<?php //echo $product['name']; 
					//$string=$product['images'];
				   //$photoTrolly=substr($string, 49, 36);
					?>
<img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" title="<?php echo $item['name'];?>" width="40" height="40" />
                    </td>
                    <td>&nbsp;</td>
					<td align="right" style="border-bottom:1px solid #CCCCCC;">
                    <span class="cart_title">BDT <?php 
					if(is_numeric($pro_price)){
						echo number_format($pro_price,2);
					}
					else{
						echo $pro_price;
					}
					 ?></span></td>
                  <td>&nbsp;</td>
					<td align="right"  style="border-bottom:1px solid #CCCCCC;"><span class="left_nav_text"><?php echo $item['qty']; ?></span></td>
                  <td align="right">&nbsp;</td>
				  <td align="right" style="border-bottom:1px solid #CCCCCC;"><span class="cart_title"><?php echo number_format($item['subtotal'],2) ?></span></td>
                  <td>&nbsp;</td>
		  </tr>
           				<input type="hidden" value="<?php echo $boutiqueshop;?>" name="boutiqueshop<?php echo $i;?>" />
                        <input type="hidden" value="<?php echo $main_image;?>" name="mainimg<?php echo $i;?>" />
                        <input type="hidden" value="<?php echo $pro_code;?>" name="pro_code<?php echo $i;?>" />
                        <input type="hidden" value="<?php echo $item['name'];?>" name="pro_name<?php echo $i;?>" />
                        <input type="hidden" value="<?php echo $item['id'];?>" name="product_id<?php echo $i;?>" />
                        <input type="hidden" value="<?php echo $item['qty'];?>" name="qty<?php echo $i;?>" />
                        <input type="hidden" value="<?php echo $item['price'];?>" name="unit_price<?php echo $i;?>" />
                        <input type="hidden" value="<?php echo $item['subtotal'];?>" name="sub_total<?php echo $i;?>" />
                        <input type="hidden" value="<?php echo $shippment_val;?>" name="shipment<?php echo $i;?>" />
			<?php   
			$i++;
			endforeach; 
				$pro_array = join(',', $productAllId);
				if($shippment_val!=""){
					$total_shipment = array_sum($shippment_total_val).' TK';
					}
					else{
						$total_shipment = "60.00";
					}
					$grandTotalPrice = $grand_total+$total_shipment;
				?>
				<input type="hidden" value="<?php echo $pro_array;?>" name="productId" />
		</tbody>
	
		<tfoot>
        <tr><td colspan="8">&nbsp;</td></tr>
			<tr>
				<td colspan="3"><strong>Sub Total</strong></td>
			<td colspan="4" align="right" id="gc_subtotal_price"><?php echo number_format($grand_total,2); ?></td>
            <td>&nbsp;</td>
		  </tr>
			<tr>
				<td colspan="3"><strong>Shipping Charge</strong></td>
				<td colspan="4" align="right"><?php echo $total_shipment;?></td>
                <td>&nbsp;</td>
		  </tr>	
					
            <tr>
				<td colspan="3"><strong>Grand Total</strong></td>
				<td colspan="4" align="right" >
                 TK. <?php 
							$grandTotalPrice=$grand_total+$total_shipment;
							echo number_format($grandTotalPrice,2); ?>
                </td>
                <td>&nbsp;</td>
		  </tr>                                                                                                                                                
		</tfoot>
		
	</table>
    
<?php
}
else{
  ?>
 <div style="color:#F00; font-size:16px; text-align:center"><?php echo $message?></div>
	
  <?php
  }
  ?>
</div>