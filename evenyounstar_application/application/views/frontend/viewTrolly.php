
<div style="padding:6px; width:350px; float:left; box-shadow:#000 4px 4px 4px 4px;  background-color:#000; height:auto; opacity:0.9;font-family:BNG,SutonnyBanglaOMJ,SolaimanLipi; font-size:13px; z-index:6">
<?php if ($cart = $this->cart->contents()){ ?>
    <!--<form method="post" action="<?php echo base_url();?>cart/shopping_cart" target="_parent">-->
    <?php 
	include('bangladate.php');
	$attributes = array('target' => '_parent');
	echo form_open(base_url('cart/shopping_cart'), $attributes);?>
    
   	<table width="340" border="0" bordercolor="#FFFFFF" cellpadding="0" cellspacing="0" 
    style="border-collapse:collapse; color:#FFFFFF; font-size:12px; font-family:BNG,SutonnyBanglaOMJ,SolaimanLipi; background-color:#000; opacity:0.9;">
			<thead>
            <tr><td height="45" colspan="78"><div style="margin-bottom:20px; font-size:18px;font-family:BNG,SutonnyBanglaOMJ,SolaimanLipi; text-align:left; font-weight:bold;">আপনার বাছাইকৃত পন্যসমুহ</div></td>
            </tr>
				<tr>
				  <td width="20%" height="21" style="width:25%;  border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">পন্যের বিবরণ </td>
                  <td width="2%">&nbsp;</td>
				  <td width="25%" style=" border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">মুল্য</td>
                  <td width="2%">&nbsp;</td>
				  <td width="14%" style="border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">
				  পরিমাণ</td>
                  <td width="1%"></td>
                  <td width="22%"  style="border-bottom:1px solid #CCCCCC; font-weight:bold; text-align:right">মোট</td>
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
	<?php
		if ($cart = $this->cart->contents()){
		$grand_total = 0; $i = 1;
		foreach ($cart as $item):
			echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
			echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
			echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
			echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
			echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
			$grand_total = $grand_total + $item['subtotal'];
			$shippment = $item['options']['shipment'];
			$shippment_total[] = $shippment;
		endforeach;
		if($shippment!=""){
		$total_shipment = array_sum($shippment_total);
		}
		else{
			$total_shipment = "50.00";
		}
		?>
		<tfoot>
        <tr><td colspan="8">&nbsp;</td></tr>
			<tr>
				<td height="23" colspan="3">মোট মুল্য</td>
			<td colspan="4" align="right" id="gc_subtotal_price"><?php echo number_format($grand_total,2); ?></td>
            <td>&nbsp;</td>
		  </tr>
			<tr>
				<td height="22" colspan="3">শিপিং চার্জ</td>
				<td colspan="4" align="right"><?php echo $total_shipment;?></td>
                <td>&nbsp;</td>
		  </tr>	
					
            <tr>
				<td height="22" colspan="3">সর্বমোট</td>
				<td colspan="4" align="right" >
                 &#2547; <?php 
							$grandTotalPrice=$grand_total+$total_shipment;
							echo number_format($grandTotalPrice,2); ?>
                </td>
                <td>&nbsp;</td>
		  </tr>                                                                                                                                                
		</tfoot>
		<?php
        }
		?>
		<tbody>
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
                    <span class="cart_title">&#2547; <?php 
					if(is_numeric($pro_price)){
						$convertTPrice =  number_format($pro_price,2);
					}
					else{
						$convertTPrice =  $pro_price;
					}
					echo str_replace($englishdata, $bangladata, $convertTPrice);
					$quantityBang = str_replace($englishdata, $bangladata, $item['qty']);
					$quantityBangPrice = str_replace($englishdata, $bangladata, $item['subtotal']);
					 ?></span></td>
                  <td>&nbsp;</td>
					<td align="right"  style="border-bottom:1px solid #CCCCCC;"><span class="left_nav_text"><?php echo $quantityBang; ?></span></td>
                  <td align="right">&nbsp;</td>
				  <td align="right" style="border-bottom:1px solid #CCCCCC;"><span class="cart_title"><?php echo number_format($quantityBangPrice,2) ?></span></td>
                  <td>&nbsp;</td>
		  </tr>
			<?php endforeach;?>
		</tbody>
	</table>
    <input style="font-size:12px; font-weight:bold; cursor:pointer; float:right; margin:10px 40px 0 0px; border:1px solid #999999; padding:3px;" type="submit" value="Checkout"/>
<!--</form>-->
<?php echo form_close();?>
<?php
}
else{
  ?>
 <div style="color:#F00; font-size:16px; text-align:center"><?php echo $message?></div>
	
  <?php
  }
  ?>
</div>