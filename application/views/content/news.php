<style>
.submit_sect{
margin-top:12px;
margin-bottom:5px;
}	
html { overflow-y: hidden; }
label {
    display: block;
    margin-bottom: 10px;
}
</style>
<script type="text/javascript">
function ajaxrequest() 
 { 
	 //alert("dfghj"); 	
	  var subs=document.getElementById('subject').value;
	  var des=document.getElementById('message').value;  
	 // alert(subs); 
	  if (subs=="") 
		  {  
		  $("#subject").focus();
		  document.getElementById('error').innerHTML="Please fill  fields";
		  return false;
		  } 
	  else if(des=="")
		  {
		  document.getElementById('error').innerHTML="Please fill  fields";
		  $("#message").focus();
		  return false;
		  }
	  
  }
</script>   
 <div class="container"  style="left:-9%; margin-left:-50px; margin-top: -25px; position: absolute;top:8%;height:100%;width:900px">
  <div class="container"> 
	  <div class="w-box-content cnt_a" style="min-height:450px; border-top-color: #CCCCCC; border-top-style: solid; border-top-width: 1px;background:#EAEAEA">
		  <span id="error" style="color:red;font-size:14px ;margin-left:20%;"></span>			  
		  <div class="container"  style="height:100%;width:700px">  
			<div class="w-box" id="n_ench_select">				
			<h4 style="color:red"><?php echo $this->session->set_flashdata('success');?></h4>     
				 <div class="w-box" id="n_word_character_limiter">
                             <div class="w-box-header">
                                <h4>News Letter</h4>
                            </div>
							<?php  
									$attributes = array('method'=>'post','onsubmit' => 'return ajaxrequest();');
									echo form_open("welcome/newsmail",$attributes);
									?>						
                            <div class="w-box-content cnt_a">
										<div class="row-fluid">										    
											<div class="span6">
											<label>Subject</label>
                                            <input class="span8" name="subject" id="subject" type="text" placeholder="subject">
												<label>Enter Text To Send</label>
												<textarea class="span12"   name="message" id="message" placeholder="message" cols="70" rows="6"></textarea>
											</div>
										  
										</div>
								
								      
										<div class="row-fluid" style="width: 67%;margin:0px;">
											<div class="span6">
												<label  style="margin-bottom:0px; id="s2_single" class="span12" >Send To</label>												
												 <?php 	
													$options = 'id="cattype" class="customselect2 span12" style="height:23px !important;font-size:12px;padding:2px;margin-top:-2px"';											
													echo form_dropdown('cattype',$user_type,'',$options);				
										         ?>												
											</div>                                    
										</div>					              
																
										 <div class="submit_sect">                                        									    
												<button type="submit" class="btn btn-beoro-3">Send</button>	
                                               
											     <input type="reset"  class="btn btn-beoro-3" style="margin-left:10px"/>
										</div>	
                                										
						        </div>
								</form>
					
					     </div>
			</div>
	    </div> 
	   </div>
   </div>
</div>
				
 
	