
<style>
.update{
margin-left:-46px;
}
textarea{
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
</style>
<div class="container"  style="left:-9%; margin-left:-50px; margin-top: -25px; position: absolute;top:8%;height:100%;width:900px">
  <div class="container"> 
	  <div class="w-box-content cnt_a" style="min-height:450px; border-top-color: #CCCCCC; border-top-style: solid; border-top-width: 1px;background:#EAEAEA">

 	                <div class="w-box-header">
						<h4 style="font-size:14px;font-weight:bold;color:#fff"><?php echo $tabval;?></h4>
					</div>	
	<div class="w-box-content cnt_a">		
	<?php  
		$attributes = array('method'=>'post');
		echo form_open("welcome/updatenumbers/$id",$attributes); 
	?>   
			   <div class="w-box" id="" >
								<div class="row-fluid" >	
									   
								   <div class="row-fluid"  style="width:30%;">
									<div class="span6">
									
										<label>Sub Category</label>
											<?php $custom ='id="sub_cat" class="span12" onChange="showSelected();"';
												echo form_dropdown("sub_cat",$subcat,'',$custom);
											?>	
											
									</div>						   
								  </div>
								</div>					
										
				
				</div> 
								   
			            <center> <img id="loadimage" src="<?php echo base_url()?>assets/img/loader.gif" alt="" class="logo_img" style="display:none"  /></center>
			
	
	  <div id="n_word_character_limiter" class="w-box" style="display:none" >	
			    <div class="row-fluid">					          
						<div class="span4">
							<div class="w-box-header" style="background-color:#208BBD;">
								  <h4>Description</h4>
							</div>							
							<textarea id="desc" class="span12" rows="10" name="desc" cols="70"></textarea>
							<div class="charleft originalTextareaInfo" style="width: 448px;"></div>
						</div>				
				
					   <div class="span4">
							   <div class="w-box-header" style="background-color:#208BBD;">
								  <h4>POS</h4>
								</div>
								<textarea id="pos" class="span12" name="pos" rows="10" cols="70"></textarea>
								<div class="charleft originalTextareaInfo" style="width: 448px;"></div>
						</div>	
						<div class="span4">
							    <div class="w-box-header" style="background-color:#208BBD;">
								   <h4>NEG</h4>
								</div>
								<textarea id="nes" class="span12" rows="10" name="neg" cols="70"></textarea>
							   <div class="charleft originalTextareaInfo" style="width: 448px;"></div>							   
					   </div>
					    <center> 
						   <div class="update">
							   <input type="submit" class="btn btn-beoro-3" id="uploadloader" value="Update"/>
							   <a href="<?php echo base_url()?>welcome/number"><span class="btn btn-beoro-3">Cancel</span></a>
						  </div>
						 </center>  
				</div>
				
		</div>
	  </div>
      <input type="hidden" name="ctid" id="catid" value="<?php echo $id?>"/>	  
</form>	  
</div>			
</div>		
</div>			
</div>		
	<script type="text/javascript">
	$(document).ready(function() { 				
				$("#sub_cat").change(function() {					
					var sub_cat = $(this).val();
                    var	test=$("#catid").val();		
						$("#loadimage").show();
						$("#n_word_character_limiter").hide();		
					//alert(test)		
				$.ajax({
						type: "POST",
						url: "<?php echo base_url()?>welcome/getnuemerology",
						data:{"cat":$("#catid").val(),"sub_cat":sub_cat},							
						success: function(html){
						//alert(data);
						var elem=html.split('*');  
						var desc = elem[0];  
						var pos = elem[1];  
						var nes = elem[2];  
						$("#desc").val(desc);				
						$("#pos").val(pos);				
						$("#nes").val(nes);	
						$("#n_word_character_limiter").show();		
						$("#loadimage").hide();
						}
					  });
				});
			$("#uploadloader").click(function() {				
					$("#loadimage").show();
					$("#n_word_character_limiter").hide();	
				});
		});
		
	</script>
	<style>
			#loadimage{display:none;}
	</style>
	