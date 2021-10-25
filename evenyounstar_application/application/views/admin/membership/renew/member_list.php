<script type="text/JavaScript">
function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url()?>ouradminmanage/deleteData/'+tablename+'/'+colid,
			   data: "deleteId="+pid,
			   success: function() {
				  alert("Successfully saved");
				  window.location.reload(true);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
	}
	else{
	 return;
	}
	 
}
</script>
<style>
.todayregistered {
	background-color:#44c767;
	-moz-border-radius:25px;
	-webkit-border-radius:25px;
	border-radius:25px;
	border:1px solid #18ab29;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:17px;
	padding:5px 13px;
	text-decoration:none;
	text-shadow:0px 1px 0px #2f6627;
}
.todayregistered:hover {
	background-color:#5cbf2a;
}
.todayregistered:active {
	position:relative;
	top:1px;
}


</style>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Membership Renew Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="float:left">Total Member (<?php echo $memberList->num_rows();?>)</h2>
                                    <h2 style="float:right"><a href="<?php echo base_url('ouradminmanage/membershipRenew/new');?>" class="btn btn-primary">New Renew Entry</a></h2>
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    	<div  class="col-sm-12 col-md-6 col-lg-3" style="margin:0; padding:0;">
                                    	<?php echo form_open('ouradminmanage/membership'); ?>
                                        	<input type="text" name="keyword" id="keyword" autocomplete="off" class="form-control" placeholder="Search by Member Name" onFocus="this.placeholder=''"  onBlur="this.placeholder='Search by Member Name'" style="width:68%; float:left;">
                                		<input type="submit" name="paymentSubmit" value="Search" class="btn btn-success" style="float:left;"/>
                                        <?php echo form_close(); ?>
             <ul class="dropdown-menu keywordMenu" style=" max-height:250px; margin-left:150px; font-weight:bold; font-size:12px; width:330px; background:#eaeaea;  overflow:scroll;
             overflow-x:hidden" role="menu" aria-labelledby="dropdownMenu"  id="DropdownKey">
             </ul>
                                        </div>
                                        
                                        
                                        <div  class="col-sm-12 col-md-6 col-lg-3" style="margin:0; padding:0;">
                                    	<?php echo form_open('ouradminmanage/membership'); ?>
                                        	<select name="keyword" class="form-control" style="width:68%; float:left">
                                            	<option value="">Member type</option>
                                                  <option value="1 Year">1 Year</option>
                                                  <option value="2 Year">2 year</option>
                                                  <option value="5 Year">5 year</option>
                                                  <option value="Life Time">Life Time</option>
                                            </select>
                                        <input type="submit" name="paymentSubmit" value="Search" class="btn btn-success" style="float:left;"/>
                                        <?php echo form_close(); ?>
                                        </div>
                                        
                                        <div  class="col-sm-12 col-md-6 col-lg-3" style="margin:0; padding:0;">
                                    	<?php echo form_open('ouradminmanage/membership', array('class'=>'form-horizontal')); ?>
                   <input type="text" name="fromDate" class="form-control date-picker" style="float:left; width:34%; margin-right:5px; padding:5px" placeholder="From">
                   <input type="text" name="toDate" class="form-control date-picker" style="float:left; width:34%; padding:5px" placeholder="to" required>
                                           <input type="submit" name="paymentSubmit" value="Search" class="btn btn-success" style="float:left;"/>
                                        <?php echo form_close(); ?>
                                        </div>
                                        <div   class="col-sm-12 col-md-6 col-lg-3" style="margin:0; padding:0">
                                    	<a href="<?php echo base_url('ouradminmanage/membership/?keyword=today');?>" class="todayregistered" style="color:#fff">Today Registered Member</a>
                                        </div>
                                        
                                    </div>
                                <div class="col-sm-12 col-md-12 col-lg-12"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped">
                                    <thead>
                                      <tr>
                                        <th>SI</th>
                                        <th>Member Name</th>
                                        <th>Member Type</th>
                                        <th>Joining date</th>
                                        <th>Expiration date</th>
                                        <th>Due Days</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                   <?php
				
                function dob($edate)
						{
						  $currentDate=date('Y-m-d');	
						  $startDate = new DateTime($currentDate);
						  $endDate = new DateTime($edate);
						  $diff = $startDate->diff($endDate)->format("%R%a");
						  return  $diff;
						}
					foreach($memberList->result() as $member): $pageSl++; 
							$joiningDate=$member->from_date;
							$expdate=$member->to_date;	
							$interval = dob($expdate);
							
							if($interval < 0){
								$currentDate=date('Y-m-d');	
								$mod_date = date('Y-m-d', strtotime($currentDate."+ 30 days"));
								$sdate = new DateTime($mod_date);
								$edate = new DateTime($edate);
								$diffD = $sdate->diff($edate)->format("%a");
								$interval=$diffD;
								$c="red";	
								$class="blink_me";
							}
							elseif($interval > 0){
								$c="green";
								$class="";
							}
					?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $member->memberName; ?></td>
                                        <td><?php echo $member->member_type; ?></td>
                                        <td><?php echo $joiningDate; ?></td>
                                        <td><?php echo $expdate; ?></td>
                                        <td><strong style="color:<?php echo $c;?>"><?php echo $interval.' Days'; ?></strong></td>
                                        <td><?php echo $member->price; ?></td>
                                         <td> 
                                         	<a href="<?php echo base_url('ouradminmanage/membership/editmember/'.$member->id);?>" class="btn btn-default btn-sm">
          										<span class="glyphicon glyphicon-edit"></span> Edit
                                            </a> 
                                            <a href="javascript:void();" onclick="openPage1('<?php echo $member->id;?>','membership','id');" class="btn btn-default btn-sm">
          										<span class="glyphicon glyphicon-remove-circle"></span> Remove
                                            </a>
                                            </td>
                                      </tr>
                                    <?php
                                    endforeach;
									?>  
                                      
                                    </tbody>
                                  </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.date-picker').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>

                </div>
               