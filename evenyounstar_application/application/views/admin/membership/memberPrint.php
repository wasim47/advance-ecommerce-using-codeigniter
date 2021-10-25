<script>
window.onload=window.print();
</script>
<link href="<?php echo base_url('asset/admin') ?>/css/bootstrap.v.3.3.1.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('asset/admin') ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <div class="content">
       <div class="box box-primary">
				<div class="box-body">
									
									
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered allpagelist" id="example">
                                <thead>
                                    <tr>
										<th>SL.</th>
                                        <th>Name</th>
                                        <th>Hospital Name</th>
                                        <th>Specialty</th>
                                        <th>Contact No.</th>
                                        <th>Service</th>
                                  </tr>
                                </thead>
                                <tbody>
								
					<?php foreach($getDoctors->result() as $doctor): $pageSl++; 	?>			
								
                                    <tr class="odd gradeX">
									     <td><?php echo $pageSl; ?></td>
                                        <td><?php echo '<strong>'.$doctor->fullname.'</strong>'; 
										?> 
																				
										</td>
                                        <td><?php echo $doctor->hospitalName; ?></td>
                                         <td><?php echo $doctor->Speciality; ?></td>
                                        <td><?php echo $doctor->contactNo; ?></td>
                                        <td><?php echo $doctor->doctorType; ?></td>
	
										</tr>
                                      
					<?php endforeach; ?>				  
                                </tbody>
                            </table>									
                                    </div>
       </div>
	</div>