<style>
.black_overlay{
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: #FFFFFF;
        z-index:10001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: fixed;
        top: 20%;
        left: 25%;
        width: 60%;
        height: 60%;
        padding: 10px;
        border: 3px solid #FFFFFF;
        background-color: white;
		box-shadow:0px 0px 15px #999999;
        z-index:10002;
        overflow: auto;
		-moz-border-radius:5px;
		border-radius:5px;
    }
	/*.returnContent {
        display: none;
        position: fixed;
        top: 20%;
        left: 20%;
        width: 66%;
        height: 33%;
        padding: 10px;
        border: 3px solid #FFFFFF;
        background-color: white;
		box-shadow:0px 0px 15px #999999;
        z-index:10002;
        overflow: auto;
		-moz-border-radius:5px;
		border-radius:5px;
    }*/
</style>
<script type="text/javascript">

function loadContent(pid)
{
	document.getElementById('prodcut_id').value=pid;
	$("#light1").show('slow');
	$("#fade").show('slow');
}

function closeButton()
{
	$("#light1").hide('medium');
	$("#fade").hide('medium');
}
function loadContentMinus(pid)
{
	document.getElementById('prodcutId').value=pid;
	$("#light2").show('slow');
	$("#fade").show('slow');
}

function closeButtonMinus()
{
	$("#light2").hide('medium');
	$("#fade").hide('medium');
}

function returnArea(pid)
{
	//alert(pid);
	document.getElementById('returnProduct').value=pid;
	$("#returnArea").show('slow');
	$("#fade").show('slow');
}

function closereturnArea()
{
	$("#returnArea").hide('medium');
	$("#fade").hide('medium');
}
function loadContentHistory(pid)
{
	$.ajax({
            type: "POST",
            url: "<?php echo base_url();?>ouradminmanage/inventory_history",
            data: ({'pro_id' : pid}),
            success: function(response){
               if(response=='success')
                {   
                    document.getElementById("light3").innerHTML=response;
					$("#light3").show('slow');
					$("#fade").show('slow');
                }
                else
                {
                    document.getElementById("light3").innerHTML=response;
					$("#light3").show('slow');
					$("#fade").show('slow');
                   
                }
            }          
        });
}

function closeButtonHistory()
{
	$("#light3").hide('medium');
	$("#fade").hide('medium');
}
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Inventory List</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table width="100%" cellpadding="2" cellspacing="1" class="table_round">
          
          <tr>
            <td width="37" height="36" align="center" bgcolor="#e5e5e5"class="table_header"><span class="style2">SI</span></td>
            <td width="119" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Product Name </span></td>
            <td width="184" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Product Code</span></td>
            <td width="169" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Category</span></td>
            <td width="234" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Quantity</span></td>
            <td width="278" align="center" bgcolor="#e5e5e5" class="table_header"><span class="style2">Action</span></td>
            </tr>
          <?php
		  $i=0;
				foreach($productlist as $product):
				$product_id=$product->product_id;
				$pro_code=$product->pro_code;
				$product_name=$product->product_name;
				$cat_id=$product->cat_id;
				
				$queryinv=$this->db->query("select * from inventory where product_id ='".$product_id."'");
				if($queryinv->num_rows() > 0){
					foreach($queryinv->result() as $rowinv);
					$qty=$rowinv->quantity; 
				}
				else{
					$qty=0;	
				}
  
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
            <td align="center" class="section"><h6><?php echo $pro_code;?></h6></td>
            <td align="center" class="section"><h6><?php echo $cat_id;?></h6></td>
            <td align="center" class="section"><h6><?php echo $qty;?></h6></td>
            <td align="center" class="section">
            	<a  href="javascript:void()" onclick ="loadContent(<?php echo $product_id;?>)" style="text-decoration:none;">
                        <i class="fa fa-plus"></i></a>&nbsp;&nbsp;
                            <a  href="javascript:void()" onclick ="loadContentMinus(<?php echo $product_id;?>)" style="text-decoration:none;">
                            <i class="fa fa-minus"></i></a>&nbsp;&nbsp;
							<a  href="<?php echo base_url('ouradminmanage/inventory_history/'.$product_id);?>" style="text-decoration:none;">
                            <i class="fa fa-history"></i></a>&nbsp;&nbsp;
                            <a  href="javascript:void()" onclick ="returnArea(<?php echo $product_id;?>)" style="text-decoration:none;">
                            Return</a>
            </td>
		    </tr>
        	  <?php
			  endforeach;
			  ?>
        </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
  
  
  
<div id="light1" class="white_content">
<?php echo form_open('ouradminmanage/update_inventory');?>
<div style="background:#f5f5f5; width:100%; height:100%;">
      <table width="100%" border="0" cellspacing="2" cellpadding="3"  style="font-family:SolaimanLipi, SumeshwariMJ;" align="center">
                                      <tr>
                                      	<td height="52" align="left" valign="top">
                                        	<a href ="javascript:void(0)" title="Close" onclick ="closeButton()"><i class="fa fa-close"></i></a> </td>
                                        <td colspan="2" valign="bottom"><h2>Add Quantity</h2></td>
  </tr>
                                      
                                      <tr>
                                        <td height="15" colspan="3"></td>
                                      </tr>
                                      <tr>
                                        <td width="29%" height="42" align="right"><strong>How Many to Add</strong></td>
                                        <td width="2%"> </td>
                                        <td width="69%">
                                        <input type="text" name="pluse_qty" required placeholder="QTY"  class="form-control" style="width:20%" onFocus="this.placeholder=''" onBlur="this.placeholder='QTY'"/>&nbsp; &nbsp;</td>
  </tr>
                                       <tr>
                                        <td height="99" align="right" valign="top"><strong>Note</strong></td>
                                        <td>&nbsp;</td>
                                        <td width="69%">
                                        <textarea rows="5" cols="40" name="pluse_note" style="width:50%" class="form-control"></textarea>
                                        
                                        </td>
  </tr>

                                      <tr>
                                        <td colspan="3"  height="5"></td>
                                      </tr>
                                      <tr>
                                        <td height="45" colspan="2">&nbsp;</td>
                                        <td valign="top">
                                        <input type="hidden" name="product_id" id="prodcut_id" />
                                        <input type="submit" value="Add" name="add" class="btn btn-primary"/>
                                        &nbsp; &nbsp; &nbsp; &nbsp;</td>
                                      </tr>
                                    </table>
</div>
<?php echo form_close();?>
</div>
<div id="light2" class="white_content">
<?php echo form_open('ouradminmanage/update_inventory');?>
<div style="background:#f5f5f5; width:100%; height:100%;">
      <table width="100%" border="0" cellspacing="2" cellpadding="3"  style="font-family:SolaimanLipi, SumeshwariMJ;" align="center">
                                      <tr>
                                      	<td height="52" align="left" valign="top">
                                        	<a href ="javascript:void(0)" title="Close" onclick ="closeButtonMinus()">
                                            <i class="fa fa-close"></i></a> </td>
                                        <td colspan="2" valign="bottom"><h2>Minus Quantity</h2></td>
  </tr>
                                      
                                      <tr>
                                        <td height="15" colspan="3"></td>
                                      </tr>
                                      <tr>
                                        <td width="29%" height="42" align="right"><strong>How Many to Minus</strong></td>
                                        <td width="2%"> </td>
                                        <td width="69%">
                                        <input type="text" name="minus_qty" required placeholder="QTY" class="form-control" style="width:20%" onFocus="this.placeholder=''" onBlur="this.placeholder='QTY'"/>&nbsp; &nbsp;</td>
  </tr>
                                       <tr>
                                        <td height="99" align="right" valign="top"><strong>Note</strong></td>
                                        <td>&nbsp;</td>
                                        <td width="69%">
                                        <textarea rows="5" cols="40" name="minus_note" style="width:50%" class="form-control"></textarea>
                                        
                                        </td>
  </tr>
                                      <tr>
                                        <td colspan="3"  height="5"></td>
                                      </tr>
                                      <tr>
                                        <td height="45" colspan="2">&nbsp;</td>
                                        <td valign="top">
                                        <input type="hidden" name="product_id" id="prodcutId" />
                                        <input type="submit" value="Minus" name="minus"  class="btn btn-primary"/>
                                        &nbsp; &nbsp; &nbsp; &nbsp;</td>
                                      </tr>
                                    </table>
</div>
<?php echo form_close();?>

</div>
<div id="returnArea" class="white_content">
<?php echo form_open('ouradminmanage/update_inventory');?>
<div style="background:#f5f5f5; width:100%; height:100%;">
      <table width="100%" border="0" cellspacing="2" cellpadding="3"  style="font-family:SolaimanLipi, SumeshwariMJ;" align="center">
                                      <tr>
                                      	<td height="52" align="left" valign="top">
                                        	<a href ="javascript:void(0)" title="Close" onclick ="closereturnArea()">
                                            <i class="fa fa-close"></i></a> </td>
                                        <td colspan="2" valign="bottom"><h2>Return Quantity</h2></td>
  </tr>
                                      
                                      <tr>
                                        <td height="15" colspan="3"></td>
                                      </tr>
                                      <tr>
                                        <td width="29%" height="42" align="right"><strong>How Many Return</strong></td>
                                        <td width="2%"> </td>
                                        <td width="69%">
                                        <input type="text" name="return_qty" required placeholder="QTY" class="form-control" style="width:20%" onFocus="this.placeholder=''" onBlur="this.placeholder='QTY'"/>&nbsp; &nbsp;</td>
  </tr>
                                       <tr>
                                        <td height="99" align="right" valign="top"><strong>Note</strong></td>
                                        <td>&nbsp;</td>
                                        <td width="69%">
                                        <textarea rows="5" cols="40" name="return_notes" style="width:50%" class="form-control"></textarea>
                                        
                                        </td>
  </tr>
                                      <tr>
                                        <td colspan="3"  height="5"></td>
                                      </tr>
                                      <tr>
                                        <td height="45" colspan="2">&nbsp;</td>
                                        <td valign="top">
                                        <input type="hidden" name="product_id" id="returnProduct" />
                                        <input type="submit" value="Return" name="return"  class="btn btn-primary"/>
                                        &nbsp; &nbsp; &nbsp; &nbsp;</td>
                                      </tr>
                                    </table>
</div>
<?php echo form_close();?>

</div>
<div id="light3" class="historyContent"></div>
<div id="fade" class="black_overlay"></div>