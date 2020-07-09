 <link rel="stylesheet" href="<?php echo base_url();?>assets/js/lib/datatables/css/datatables_beoro.css">                     
		 <div class="w-box-header">
				<h4>Accounts</h4>
		</div>
	<div class="w-box-content cnt_b">
		<div class="row-fluid">
			<div class="span12">
				<div class="tabbable tabbable-bordered">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tb1_a">Payments</a></li>
						<li><a data-toggle="tab" href="#tb1_b">Users</a></li>
					</ul>
	<div class="tab-content">
					<div id="tb1_a" class="tab-pane active">                                                  
			
		<div class="container paymentsreplace">
				<div class="row-fluid">
                    <div class="span12" style="margin-top:20px">
					<div class="w-box w-box-blue">
                              	<div class="w-box-header">      
								<h4>Payments</h4>								
									<div class="floatright">									
										<span style="margin:0 6px;font-size:11px;font-weight:bold">User Mode</span>
										  <?php 	
												$options = 'id="catmode" class="customselect2" style="height:23px !important;font-size:12px;padding:2px;margin-top:-2px"';											
												echo form_dropdown('catmode',$user_catgs,'',$options);											
										  ?>	

                                        <span style="margin:0 6px;font-size:11px;font-weight:bold">User Type</span>
										  <?php 	
												$options = 'id="cattype" class="customselect2" style="height:23px !important;font-size:12px;padding:2px;margin-top:-2px"';											
												echo form_dropdown('cattype',$user_type,'',$options);											
										  ?>										  
										<input type="submit" name="submit" id="getpayments" value=""  class="go usergenerate"/>
									</div>								
								</div>
								

                        <div class="w-box-content paymentsdetails">
                           <table id="accounts" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
									<th>Email</th>
                                  
									<th>UserMode</th>
                                    <th>User Type</th>
									<th>Joininig Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>	
							<?php foreach($users as $row)
							{?>
								<tr>
                                    <td id="<?php echo $row->id;?>" class="click"><?php echo $row->id; ?></td>

                                    <td id="<?php echo $row->id;?>" class="click"><?php echo $row->name;?></td>
                                    
									<td id="<?php echo $row->id;?>" class="click"><?php echo $row->email;?></td>
									
                                  
									
                                   <td id="<?php echo $row->id;?>" class="click"><?php if($row->user_mode==1) echo "Paid User"; else echo "Free User";?></td>									
									<td id="<?php echo $row->id;?>" class="click"><?php if($row->user_type==0) echo "Web Site"; else if($row->user_type==1) echo "Android"; else echo"Iphone";?>
									</td>
									
                                    <td id="<?php echo $row->id;?>" class="click"><?php echo $row->date;?></td>
									
                                    <td id="<?php echo $row->id;?>" class="click"><?php echo $row->status;?></td>									
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
		<div id="tb1_b" class="tab-pane"> 
	<div id="" class="" style="height:100%;width:600px">
		<div class="container usercatgs" >
		<div class="row-fluid">
		<div class="span12" style="margin-top:20px">
		<div class="w-box w-box-blue">
							<div class="w-box-header">      
							<h4>Users</h4>	
												
								<div class="floatright">									
									<span style="margin:0 6px;font-size:11px;font-weight:bold">User Type</span>
									  <?php 	
											$options = 'id="catmode" class="customselect2" style="height:23px !important;font-size:12px;padding:2px;margin-top:-2px"';											
											echo form_dropdown('catmode',$user_catgs,'',$options);											
									  ?>										  
									<input type="submit" name="submit" id="getusers" value=""  class="go usergenerate"/>
								</div>								
							</div>
					<div class="w-box-content customleads">
						   <table id="dt_hScroll" class="table table-striped">
							<thead>
								<tr>
									<th>id</th>
									<th>Name</th>
									<th>Email</th>
									<th>Password</th>
									<th>UserMode</th>
									<th>User Type</th>
									<th>Joininig Date</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>	
							<?php foreach($users as $row)
						{?>
							<tr>
								<td id="<?php echo $row->id;?>" class="click"><?php echo $row->id; ?></td>

								<td id="<?php echo $row->id;?>" class="click"><?php echo $row->name;?></td>
								
								<td id="<?php echo $row->id;?>" class="click"><?php echo $row->email;?></td>
								
							  
								
							   <td id="<?php echo $row->id;?>" class="click"><?php if($row->user_mode==1) echo "Paid User"; else echo "Free User";?></td>									
									<td id="<?php echo $row->id;?>" class="click"><?php if($row->user_type==0) echo "Web Site"; else if($row->user_type==1) echo "Android"; else echo"Iphone";?>
									</td>
								
								<td id="<?php echo $row->id;?>" class="click"><?php echo $row->date;?></td>
								
								<td id="<?php echo $row->id;?>" class="click"><?php echo $row->status;?></td>									
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
		
	</div>                                            
	</div>
	</div>
	</div>
	</div>
</div>
<script>
       $(".usergenerate").live("click",function(){
				var users = $("#catmode").val();
				$(".usercatgs").html("");
				$.ajax({
						type: "POST",
						url: "<?php echo base_url()?>welcome/catg_users/",
						data:{"users":users},
						dataType:'html',
						success: function(html){
							$(".usercatgs").html(html);
						}
					  }); 
			    })
			
				$(document).ready (function(){
				$("#getpayments").live("click", function(){

				var catmode = $("#catmode").val();
				var cattype = $("#cattype").val();
			   //alert(catmode+" "+cattype);
				$.ajax({
				type : "post",
				url:"<?php echo base_url() ?>welcome/payments",
				data:{"catmode":catmode,"cattype":cattype},
				success: function(html)
					{
						//alert(html)
					 $(".paymentsreplace").html(html);
					}
				});
				//alert(catmode,cattype);
				});
				});
			
</script>
									
			
<!-- bootstrap Framework plugins -->
			<script src="<?php echo base_url();?>assets/js/lib/datatables/js/jquery.dataTables.min.js"></script>
			
			<script src="<?php echo base_url();?>assets/js/pages/beoro_datatables.js"></script>
			  
            <script src="<?php echo base_url(); ?>assets/css/bootstrap/js/bootstrap.min.js"></script>
		
  			<script src="<?php echo base_url();?>assets/js/pages/beoro_form_elements.js"></script>
		 <!-- datatables -->

          

        
         
									
									
									
									
									