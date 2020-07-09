<div class="container paymentsreplace">
				<div class="row-fluid">
                    <div class="span12" style="margin-top:20px">
					<div class="w-box w-box-blue">
                            <div class="w-box-header">
                                <h4>Users</h4>
								
						        		<div class="floatright">									
									       <span style="margin:0 6px;font-size:11px;font-weight:bold">User Mode</span>
										  <?php 	
												$options = 'id="catmode" class="customselect2" style="height:23px !important;font-size:12px;padding:2px;margin-top:-2px"';											
												echo form_dropdown('catmode',$user_catgs,$catmode,$options);											
										  ?>	

                                        <span style="margin:0 6px;font-size:11px;font-weight:bold">User Type</span>
										  <?php 	
												$options = 'id="cattype" class="customselect2" style="height:23px !important;font-size:12px;padding:2px;margin-top:-2px"';											
												echo form_dropdown('cattype',$user_type,$cattype,$options);											
										  ?>										  
										<input type="submit" name="submit" id="getpayments" value=""  class="go usergenerate"/>
									</div>
							
                            </div>

                        <div class="w-box-content">
                           <table id="dt_hScroll" class="table table-striped">
                            <thead>
                               <tr>
                                    <th>userid</th>
                                    <th>Name</th>
									<th>Email</th>                               
									<th>UserMode</th>
                                    <th>User Type</th>
									<th>Register Date</th>
                                    <th>Activate</th>
                                    <th>Login_status</th>
                                    <th>Last-login</th>
                                </tr>
                            </thead>
                                 <tbody>	
							<?php foreach($users as $row)
							{?>
								<tr>
                                    <td id="<?php echo $row->userid;?>" ><?php echo $row->userid; ?></td>

                                    <td id="<?php echo $row->userid;?>" ><?php echo $row->name;?></td>
                                    
									<td id="<?php echo $row->userid;?>" ><?php echo $row->email;?></td>
									
                                  
									
                                    <td id="<?php echo $row->userid;?>" ><?php if($row->user_mode==1) echo "Paid User"; else echo "Free User";?></td>									
									<td><i class='<?php if($row->user_type==0) echo "webicon"; else if($row->user_type==1) echo "androidicon"; else echo "iphoneicon"; ?>'>&nbsp;&nbsp;</i></td>
									
                                    <td id="<?php echo $row->userid;?>" ><?php echo $row->rigister_date;?></td>
									
                                    <td><a href='<?php echo base_url();?>welcome/user_activate/<?php echo $row->id."/".$row->status;?>' class='hasTooltip'><i class='<?php if($row->status==0) echo "updateicon_inact"; else echo "updateicon_act"; ?> click'>&nbsp;&nbsp;</i></a></td>									
                                
								    <td><i class='<?php if($row->login_status==0) echo "updatelogin_inact"; else echo "updatelogin_act"; ?> '>&nbsp;&nbsp;</i></td>									
								  
								  <td id="<?php echo $row->userid;?>" ><?php echo $row->login_time;?></td>
								</tr>

							<?php } ?>

							</tbody>

                           </table>

						</div>

					</div>

				</div>


			</div> 

</div>

   
	<script>
		$(document).ready(function() {
			beoro_datatables.basic();
			beoro_datatables.hScroll();
			beoro_datatables.colReorder_visibility();
		});
	</script>			