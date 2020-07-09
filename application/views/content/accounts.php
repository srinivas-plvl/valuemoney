<style>
div.dataTables_filter
 {
    position: absolute;
    right: 310px !important;
    top: -28px;
}
div.dataTables_length
 {   
    position: absolute;
    right: 230px !important;
    top: -28px;
}
</style>

<link rel="stylesheet" href="<?php echo base_url();?>assets/js/lib/datatables/css/datatables_beoro.css">   

<div class="container"  style="left:-9%; margin-left:-50px; margin-top: -25px; position: absolute;top:8%;height:100%;width:900px">

 <center> <img id="loadimage" src="<?php echo base_url()?>assets/img/loader.gif" alt="" class="logo_img" style="display:none"  /></center>
     
	 	 <div class="container" id="userpayments">  
				<div class="row-fluid usercatgs">
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

                        <div class="w-box-content">
                           <table id="accounts" class="table table-striped" >
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
                                    <td id="<?php echo $row->userid;?>"  ><?php echo $row->userid; ?></td>

                                    <td id="<?php echo $row->userid;?>"  ><?php echo $row->name;?></td>
                                    
									<td id="<?php echo $row->userid;?>"  ><?php echo $row->email;?></td>		
																	
									<td ><i class='<?php if($row->user_type==0) echo "webicon"; else if($row->user_type==1) echo "androidicon"; else echo "iphoneicon"; ?>'>&nbsp;&nbsp;</i></td>
									
									
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
</div>

	
	
<script>
		$(document).ready (function(){
		$(".usergenerate").live("click", function(){

		var cattype = $("#cattype").val();
		
		$("#loadimage").show();
		$("#userpayments").hide();
		
		$(".usercatgs").html("");
	   //alert(catmode+" "+cattype);
	  // alert(users);
		$.ajax({
		type : "post",
		url: "<?php echo base_url()?>welcome/catg_users/",
		data:{"cattype":cattype},
		success: function(html){
		        $("#userpayments").show();
				$(".usercatgs").html(html);
				$("#loadimage").hide();
				}
			  }); 
		//alert(catmode,cattype);
		});
		});
				
</script>






