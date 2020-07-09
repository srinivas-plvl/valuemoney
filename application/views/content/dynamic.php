

   <div class="container usercatgs">
				<div class="row-fluid">
                    <div class="span12" style="margin-top:20px">
					<div class="w-box w-box-blue">
                              	<div class="w-box-header">      
								<h4>Payments</h4>								
								<div class="floatright">									
									     	<span style="margin:0 6px;font-size:11px;font-weight:bold">User Type</span>										
                                            <?php 	
												$options = 'id="cattype" class="customselect2" style="height:23px !important;font-size:12px;padding:2px;margin-top:-2px"';
												echo form_dropdown('cattype',$user_type,'all',$options);											
										    ?>											  
										<input type="submit" name="submit" id="getusers" value=""  class="go usergenerate"/>
									</div>																
								</div>								

                        <div class="w-box-content paymentsdetails">
                           <table id="accounts" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>userid</th>
                                    <th>Name</th>
									<th>Email</th>                                  
                                    <th>User Type</th>							
									<th>Receipt Date</th>
		                            <th>Receipt</th>									
                                </tr>
                            </thead>
                                           <tbody>	
							<?php foreach($users as $row)
							{?>
								<tr>
                                    <td id="<?php echo $row->userid;?>" ><?php echo $row->userid; ?></td>

                                    <td id="<?php echo $row->userid;?>" ><?php echo $row->name;?></td>
                                    
									<td id="<?php echo $row->userid;?>" ><?php echo $row->email;?></td>		
																	
									<td><i class='<?php if($row->user_type==0) echo "webicon"; else if($row->user_type==1) echo "androidicon"; else echo "iphoneicon"; ?>'>&nbsp;&nbsp;</i></td>
									
									
                                    <td id="<?php echo $row->userid;?>" ><?php echo $row->rigister_date;?>
									
									</td> <td id="<?php echo $row->userid;?>" ><?php echo $row->receipt_date;?></td>									
                                   					
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