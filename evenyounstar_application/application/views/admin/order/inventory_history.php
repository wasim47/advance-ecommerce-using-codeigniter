<script type="text/javascript">
function update_status(id){
var status = document.getElementById("status"+id).value;
window.location.href='<?php echo base_url();?>ouradminmanage/update_status?status='+status+"&&id="+id+"&&table="+'orders';
}
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="float:left">Inventory History</h2>
                                    
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table width="100%" border="0" cellspacing="2" cellpadding="3" align="center">
                                      
                                    <tr>
                                        <td colspan="6"  height="5">
                                        <table width="100%"  border="1"  bordercolor="#CCCCCC" style="border-collapse:collapse; padding:15px;">
                                       	  <tr>
                                        <td height="39" colspan="6" align="left" valign="bottom"><h3 style="padding:5px 0 0 20px;">Decrement  History</h3></td>
                                      </tr>
                                      <tr>
                                        <td width="37%" height="42" align="center"><strong>Product Name</strong></td>
                                        <td width="16%" align="center"><strong>Product Code</strong></td>
                                        <td width="10%" align="center"><strong>Quantity</strong></td>
                                        <td width="14%" align="center"><strong>Date</strong> </td>
                                        <td width="23%" align="center">&nbsp; &nbsp;<strong>Note</strong></td>
                                          </tr>
                                          
                                          <?php
											$producId=$pid;
                                            $queryinventory=$this->db->query("select * from inventory where product_id ='".$producId."'");
											foreach($queryinventory->result() as $rowinventory);
											$decrease=$rowinventory->decrease;
											$decrease_note =$rowinventory->decrease_note;
											$decrease_date=$rowinventory->decrease_date;
											
											 $queryProdec=$this->db->query("select * from product where product_id ='".$producId."'");
											 foreach($queryProdec->result() as $rowProdec);
											$productNamedec=$rowProdec->product_name;
											$pro_codedec=$rowProdec->pro_code;
										  ?>
                                       <tr>
                                        <td height="39" align="center" valign="top"><?php echo $productNamedec;?></td>
                                        <td height="39" align="center" valign="top"><?php echo $pro_codedec;?></td>
                                        <td height="39" align="center" valign="top"><?php echo $decrease;?></td>
                                        <td align="center"><?php echo $decrease_date;?></td>
                                        <td width="23%" align="center"><?php echo $decrease_note;?></td>
  </tr>
                                        </table>
                                        </td>
                                      </tr>  
                                     
                                      <tr>
                                        <td colspan="6"  height="143">
                                        <table width="100%"  border="1"  bordercolor="#CCCCCC" style="border-collapse:collapse; padding:15px;">
                                        	 <tr>
                                        <td height="39" colspan="6" align="left" valign="bottom"><h3 style="padding:5px 0 0 20px;">Increment  History</h3></td>
                                      </tr>
                                      <tr>
                                        <td width="37%" height="42" align="center"><strong>Product Name</strong></td>
                                        <td width="16%" align="center"><strong>Product Code</strong></td>
                                        <td width="13%" align="center"><strong>Quantity</strong></td>
                                        <td width="10%" align="center"><strong>Date</strong> </td>
                                        <td width="24%" align="center">&nbsp; &nbsp;<strong>Note</strong></td>
                                       </tr>
                                        <?php
                                            $queryinventoryDec=$this->db->query("select * from inventory where product_id ='$producId'");
											foreach($queryinventoryDec->result() as $rowinventoryDec);
											$increase=$rowinventoryDec->increase;
											$increase_note =$rowinventoryDec->increase_note;
											$increase_date=$rowinventoryDec->increase_date;
											
											$queryPro=$this->db->query("select * from product where product_id ='$producId'");
											foreach($queryPro->result() as $rowPro);
											$productName=$rowPro->product_name;
											$pro_code=$rowPro->pro_code;
										  ?>
                                       <tr>
                                         <td height="27" align="center" valign="top"><?php echo $productName;?></td>
                                         <td height="27" align="center" valign="top"><?php echo $pro_code;?></td>
                                         <td height="27" align="center" valign="top"><?php echo $increase;?></td>
                                         <td align="center"><?php echo $increase_date;?></td>
                                         <td align="center"><?php echo $increase_note;?></td>
                                        </tr>
                                        </table>
                                        </td>
                                      </tr>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
               