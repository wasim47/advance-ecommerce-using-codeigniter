<script type="text/javascript">
function update_status(id){
var status = document.getElementById("status"+id).value;
window.location.href='<?php echo base_url();?>ouradminmanage/update_status?status='+status+"&&id="+id+"&&table="+'orders';
}
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Customer Details</h3>
                        </div>
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="float:left">Total menu (<?php //echo $customer_list->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('ouradminmanage/customer_registration');?>" class="btn btn-primary">New customer</a></h2>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table width="100%" cellpadding="2" cellspacing="1" class="table_round">
          
          <tr>
            <td width="37" height="36" align="center" bgcolor="#e5e5e5"class="table_header"><span class="style2">SI</span></td>
            <td width="119" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Order </span></td>
            <td width="184" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Bill To</span></td>
            <td width="169" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Ship To</span></td>
            <td width="234" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Order On</span></td>
            <td width="278" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Status</span></td>
            <td width="137" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Total Price</span></td>
            <td width="99" align="center" bgcolor="#e5e5e5" class="table_header">&nbsp;</td>
            </tr>
          <?php
		  $i=0;
  $order_q=$this->db->query("select * from orders");
  $rowQCount=$order_q->result();
  foreach($rowQCount as $rowq){
  $order_id=$rowq->order_id;
  $order_number=$rowq->order_number;
  $order_time=$rowq->order_time;
  $customer_id=$rowq->customer_id;
  $status=$rowq->status;
  $total_price=$rowq->total_price;
  
  $customerQ=$this->db->query("select * from checkout where check_id='$customer_id'");
  if($customerQ->num_rows()>0){
	  $rowCCount=$customerQ->result();
	  foreach($rowCCount as $rowc);
	  $check_id=$rowc->check_id;
	  $name=$rowc->name;
  }
  else{
      $check_id='';
	  $name='';
  }
  $shipping=$this->db->query("select * from shipping_address where customer_id='$customer_id'");
  $rowSCount=$shipping->result();
  foreach($rowSCount as $rows);
  $shipping_id=$rows->shipping_id;
  $names=$rows->name;
  
  
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
            <td align="left" class="section"><h6><?php echo $order_number;?></h6></td>
            <td align="left" class="section"><h6><?php echo $name;?></h6></td>
            <td align="center" class="section"><h6><?php echo $names;?></h6></td>
            <td align="left" class="section"><h6><?php echo $order_time;?></h6></td>
            <td align="center" valign="middle" class="section">
		  <select name="status" id="status<?php echo $order_id;?>" class="form-control" style="width:60%; float:left; margin:3px;">
                	<option value="<?php echo $status;?>"><?php echo $status;?></option>
                    <option value="Processing">Processing</option>
                    <option value="Shipped">Shipped</option>
                    <option value="On Hold">On Hold</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Delivered">Delivered</option>
                </select>
 		<button type="button" onclick="update_status(<?php echo $order_id;?>);" class="btn btn-primary" style="padding:5px; font-size:12px;">Save</button>            </td>
            <td align="center" class="section"><h6>TK&nbsp;<?php echo $total_price;?></h6></td>
            <td align="left" class="section">
            	<a href="<?php echo base_url();?>ouradminmanage/view_order/<?php echo $order_id;?>" class="btn btn-primary" style="padding:5px; font-size:12px;">View Order</a>
            </td>
		    </tr>
          <?php
  }
  ?>
        </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
               