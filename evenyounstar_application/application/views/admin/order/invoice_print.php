 <link href="<?php echo base_url();?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/animate.min.css" rel="stylesheet">
    
 <?php
  foreach($order_q->result() as $rowq);
  $order_id=$rowq->order_id;
  $order_number=$rowq->order_number;
  $order_time=$rowq->order_time;
  $customer_id=$rowq->customer_id;
  $status=$rowq->status;
  $total_price=$rowq->total_price;
  
  foreach($customerQ->result() as $rowc);
  $customer_id=$rowc->user_id;
  $acc_email=$rowc->email;
  $acc_contact=$rowc->mobile;
  $acc_name=$rowc->username;
  $acc_address=$rowc->address;
  
  foreach($shipping->result() as $rows);
  $shipping_id=$rows->shipping_id;
  $ship_name=$rows->name;
  $ship_address=$rows->address;
  $ship_contact=$rows->contact;
  $ship_email=$rows->email;
  $ship_locality=$rows->locality;
  $ship_city=$rows->city;
  
  if($payment->num_rows() > 0){
	  foreach($payment->result() as $rowp);  
	  $pay_method=$rowp->pay_method;
  }
  else{
	  $pay_method="";
	 }
?>
<script type="text/javascript">
function update_status(id){
var status = document.getElementById("status").value;
window.location.href='<?php echo base_url();?>ouradminmanage/update_status?status='+status+"&&id="+id+"&&table="+'orders';
}
window.onload=print();
</script>

<div class="right_col" role="main">
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                              <div class="col-sm-12">
                                    <div class="col-sm-3" style="padding:20px;">
                                        <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/front/butikbdlogo.png" alt="" style="width:100%; height:50px;" /></a>
                                    </div>
                                    <div class="col-sm-4 col-sm-offset-5">
                                        <address>
                                            <h4>PROJECT OFFICE</h4>
                                            
                                            EHL Kamalapur,Suite: 410, Motijheel,<br />
                                            PO Box-134, GPO, Dhaka-1 000.<br />
                                            Contact : +8801913249316<br />
                                            Email : info@butikbd.com<br />
    
                                        </address>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                <h2>Invoice Number # 01</h2>
                               <h2>Order Number # 3471</h2>
                                    <div class="col-sm-3">
                                    	<h2>Sold To</h2>
                                        <table width="98%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td><?php echo $acc_name;?></td>
          </tr>
          <tr>
            <td><?php echo $acc_address;?></td>
          </tr>
          <tr>
            <td><?php echo $acc_email;?></td>
          </tr>
          <tr>
            <td><?php echo $acc_contact;?></td>
          </tr>
        </table>
                                    </div>
                                    <div class="col-sm-4 col-sm-offset-5">
                                    	<h2>Billing Address</h2>
                                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td><?php echo $ship_name;?></td>
          </tr>
          <tr>
            <td><?php echo $ship_address;?></td>
          </tr>
          <tr>
            <td><?php echo $ship_locality.' , '.$ship_city;?></td>
          </tr>
          <tr>
            <td><?php echo $ship_email;?></td>
          </tr>
          <tr>
            <td><?php echo $ship_contact;?></td>
          </tr>
        </table>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12" style="margin-top:30px;">
                               	 <table width="100%" cellpadding="2" cellspacing="1" class="table_round">
          
                                  <tr>
                                    <td width="34" height="29" align="center" bgcolor="#e5e5e5"class="table_header"><strong><span class="style2">SI</span></strong></td>
                                    <td width="183" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Name</strong></td>
                                    <td width="103" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Product</strong></td>
                                    <td width="109" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Product Code</strong></td>
                                    <td width="180" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Quantity</strong></td>
                                    <td width="159" align="center" bgcolor="#e5e5e5" class="table_header"><strong>Price</strong></td>
                                    <td width="126" align="center" bgcolor="#e5e5e5" class="table_header"><strong><span class="style2">Total Price</span></strong></td>
                                   </tr>
                                  <?php
                           $i=0;
                           $grand_total=0;
                         
                          
                          $order_q=$this->db->query("select * from orders_products where order_id ='".$order_id."'");
                          foreach($order_q->result() as $rowq){
                          $order_id=$rowq->order_id;
                          $product_id=$rowq->product_id;
                          $qty=$rowq->qty;
                          $unit_price=$rowq->unit_price;
                          $sub_total=$rowq->total_price;
                          
                              $order_pro=$this->db->query("select * from product where product_id ='".$product_id."'");
                              foreach($order_pro->result() as $rowpro);
                              $main_image=$rowpro->main_image;
                              $product_name=$rowpro->product_name;
                              $pro_code=$rowpro->pro_code;
                              $grand_total=$grand_total+$sub_total;
                            if($i%2!=0)
                            {
                            $c="#f5f5f5";
                            }
                            else
                            {
                            $c="#FFFFFF";
                            }
                            $i++;
                            ?>
                                 <tr class="table_hover" bgcolor="<?php echo $c; ?>" >
                                    <td height="44" align="center"><h6><?php echo $i;?></h6></td>
                                    <td align="center" class="section"><h6><?php echo $product_name;?></h6></td>
                                    <td align="center" class="section" style="width:4%; padding:5px">
                                   <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" width="100%" height="auto" style="margin:2px;" />
                                 </td>
                                  <td align="center" class="section"><h6><?php echo $pro_code;?></h6></td>
                                  <td align="center" class="section"><h6><?php echo $qty;?></h6></td>
                                    <td align="center" class="section"><h6><?php echo $unit_price;?></h6></td>
                                   <td align="center" class="section"><h6>TK&nbsp;<?php echo $sub_total;?></h6></td>
                                   </tr>
                                  <?php
                          }
                          ?>
                          <tr><td colspan="7" align="center"><div style="border-bottom:1px solid #CCCCCC"></div></td></tr>
                                <tr>
                                    <td height="44" colspan="2" align="center"><h2><strong>Grand Total</strong></h2></td>
                                   <td align="center" class="section">&nbsp;</td>
                                  <td align="center" class="section">&nbsp;</td>
                                    <td align="center" class="section">&nbsp;</td>
                                   <td align="center" class="section">&nbsp;</td>
                                <td align="center"><h2><strong>TK&nbsp;&nbsp;<?php echo number_format($grand_total);?></strong></h2></td>
                                   </tr>
                                </table>
                                </div>
                                
                                
                                
                                
                                
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
               