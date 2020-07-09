<style>
div.dataTables_filter
 {
    position: absolute;
    right: 394px !important;
    top: -28px;
}
div.dataTables_length
 {
    display:none !important;
    position: absolute;
    right: 210px;
    top: -28px;
}
.dataTables_scrollBody  thead{display:none;clear:both;}
.dataTables_scrollBody  table{width:100% !important;}
</style>



<link href="<?php echo base_url();?>assets/js/lib/datatables/css/safari.css" rel="stylesheet" type="text/safari" />

<link rel="stylesheet" href="<?php echo base_url();?>assets/js/lib/datatables/css/datatables_beoro.css">					



<div class="container"  style="left:-9%; margin-left:-50px; margin-top: -25px; position: absolute;top:8%;height:100%;width:1173px">  

 <center> <img id="loadimage" src="<?php echo base_url()?>assets/img/loader.gif" alt="" class="logo_img" style="display:none"  /></center>
 
	<div class="container" id="userdetails"  >
				<div class="row-fluid paymentsreplace">
                    <div class="span12" style="margin-top:20px"> 
					   <div class="w-box w-box-blue">
                            <div class="w-box-header">
                                <h4>Users</h4>								
									<div class="floatright">                                         										
									       <span style="margin:0 6px;font-size:11px;font-weight:bold">User Mode</span>
										  <?php 	
												$options = 'id="catmode" class="customselect2" style="height:23px !important;font-size:12px;padding:2px;margin-top:-2px"';											
												echo form_dropdown('catmode',$user_catgs,'all',$options);											
										  ?>											 
										
                                        <span style="margin:0 6px;font-size:11px;font-weight:bold">User Type</span>
										  <?php 	
												$options = 'id="cattype" class="customselect2" style="height:23px !important;font-size:12px;padding:2px;margin-top:-2px"';
												echo form_dropdown('cattype',$user_type,'all',$options);											
										  ?>
																		  
										<input type="submit" name="submit" id="getpayments" value=""  class="go usergenerate"/>
									</div>								
                            </div>

                        <div class="w-box-content">
                           <table id="dt_hScroll" class="table table-striped">
                            <thead> 
                                <tr>
                                    <td>userid</td>
                                    <td>Name</td>
									<td>Email</td>                               
									<td>UserMode</td>
                                    <td>User Type</td>
									<td>Register Date</td>
                                    <td>Activate</td>
                                    <td>Login_status</td>
                                    <td>Last-login</td>
                                </tr>
                            </thead>
                            <tbody style="clear:both;width:100%">	
							<?php foreach($users as $row)
							{?>
								<tr>
                                    <td id="<?php echo $row->userid;?>" ><?php echo $row->userid; ?></td>

                                    <td id="<?php echo $row->userid;?>" ><?php echo $row->name;?></td>
                                    
									<td id="<?php echo $row->userid;?>" ><?php echo $row->email;?></td>									
                                  
									
                                    <td id="<?php echo $row->userid;?>" ><?php if($row->user_mode==1) echo "Paid User"; else echo "Free User";?></td>									
									<td><i class='<?php if($row->user_type==0) echo "webicon"; else if($row->user_type==1) echo "androidicon"; else echo "iphoneicon"; ?>'>&nbsp;&nbsp;</i></td>
									
                                    <td id="<?php echo $row->userid;?>" ><?php echo $row->rigister_date;?></td>
									
                                    <td><a href='<?php echo base_url();?>welcome/user_activate/<?php echo $row->userid."/".$row->status;?>' class='hasTooltip'><i class='<?php if($row->status==0) echo "updateicon_inact"; else echo "updateicon_act"; ?> click'>&nbsp;&nbsp;</i></a></td>									
                                
								   <td><i class='<?php if($row->login_status==0) echo "updatelogin_inact"; else echo "updatelogin_act"; ?>'>&nbsp;&nbsp;</i></td>									
								  
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
      $(document).ready (function(){
				
				//$("#dt_hScroll_wrapper div").classRemove('dt-wrapper');
				$("#getpayments").live("click", function(){
				var catmode = $("#catmode").val();
				var cattype = $("#cattype").val();
				
				$("#loadimage").show();
				$("#userdetails").hide();	
			   //alert(catmode+" "+cattype);
				$.ajax({
				type : "post",
				url:"<?php echo base_url() ?>welcome/payments",
				data:{"catmode":catmode,"cattype":cattype},
				success: function(html)
					{
						//alert(html)
					  $("#userdetails").show()
					  $(".paymentsreplace").html(html);
					 $("#loadimage").hide();
				    ;
					}
				});
				//alert(catmode,cattype);
				});
				
		       
				});				
</script>


