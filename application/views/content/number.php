<style>
    input, textarea, .uneditable-input {width: 32px;}
	label {
    display: block;
    margin-bottom: 5px;
    margin-left: 70px;
	}


</style>
<div class="container"  style="left:-9%; margin-left:-50px; margin-top: -25px; position: absolute;top:8%;height:100%;width:900px;">
  <div class="container"> 
	  <div class="w-box-content cnt_a" style="min-height:450px; border-top-color: #CCCCCC; border-top-style: solid; border-top-width: 1px;background:#EAEAEA">	
         <div  style="margin:auto;width:600px; padding-top: 24px;">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box">
						<?php  
		                $attributes = array('method'=>'post');
		                echo form_open("welcome/order",$attributes); ?>	
                            <div class="w-box-header">                                
                                   <h4>Category Management</a></h4>								  
								 <div class="floatright" style="display:none;">
                                    <input type='submit' class="btn btn-inverse"  value='update'>                                   
                                </div>                            
                            </div>
                            <div class="w-box-content">
                                <table class="table table-striped" id="smpl_tbl">
                                    <thead>
                                        <tr>
                                            <th class="table_checkbox"></th>
                                            <th  style="padding-left:80px;">Category</th>
										
                                            <th>Activate</th>  
                                            	<th></th>	
                                            <th style="display:none;">Ordering</th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
									 <?php 	$i=0;							 
									   foreach($description as $row) {?>
                                        <tr>
                                            <td></td>											
                                            <td > <div class="main-col">													  
												   <label class="labels click" rel="<?php echo $row->cat_id?>" name="cat"><?php echo $row->cat_name ?></label>
												 </div> 
											 </td>		 
											 <td>
												<a href='<?php echo base_url();?>welcome/catg_activate/<?php echo $row->id."/".$row->status;?>' class='hasTooltip'><i class='<?php if($row->status==0) echo "updateicon_inact"; else echo "updateicon_act"; ?> click'>&nbsp;&nbsp;</i></a>
											 </td>											 
                                            <td ><input type='text' style="display:none;" name="sub_cat[<?php echo $row->cat_id ?>]" value="<?php echo $row->rate?>" style="margin:0px;padding-left:15px;"></td>
											
										</tr> 
									   <?php $i++;} ?>                                        
                                       </tbody>
                                </table>
                            </div>
						 </form>							
                        </div>
                        
				
				 </div>
			  </div>
		   </div> 
      </div> 
    </div> 
</div> 
 
		
		<script type="text/javascript">	
		$(document).ready(function() { 		 
					 $(".click").live("click",function(){  					
					var cat_id = $(this).attr('rel');
					//var val = $(this).text();
					// alert('<?php echo base_url()?>welcome/number_inner/'+val+'/'+cat_id)
					  //alert(cat_id);
					   window.open('<?php echo base_url()?>welcome/number_inner/'+cat_id, '_self')   
					  });  
					});
	   </script>