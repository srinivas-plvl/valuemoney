

<style>
#n_combobox .w-box-content.cnt_a {
    padding-bottom: 10px;
    padding-left: 10px;
    padding-right: 20px;
    padding-top: 10px;
    width:150px;
}

.checkbox input[type="checkbox"] {
    float: left;
    margin-left: 0;
}

input[type="radio"], input[type="checkbox"] {
    cursor: pointer;
    float: right;
    line-height: normal;
    margin-bottom: 0;    
    margin-right: 20px;   
}
.labels{
margin-left:30px;
}

.update{
margin-left:-40px;
}
</style>
	<?php  
		$attributes = array('method'=>'post');
		echo form_open("welcome/updatenumbers",$attributes); 
	?>          
<div id="" class="" style="margin-top:-100.5px; top:17%; position:absolute;">
       <div class="w-box" id="n_combobox">
                            <div class="w-box-header">
                                <h4><?php echo $this->session->flashdata('success');?></h4>
                                <h4>Number Category</h4>
                            </div>
                            <div class="w-box-content cnt_a">
                                <div class="row-fluid">
                                    <div class="span12">
							 <div class="main-col">	
                                 <?php 
								 $i=0;
								 foreach($description as $row) {?>
					           <label class="labels" ><a href=""><?php echo $row->cat_id?></a><input class="cat"  <?php if( $i==0) echo "checked"?> type="radio" name="cat" value="<?php echo $row->cat_id?>"></label>
							   <?php $i++;} ?>
								 
							 </div>
						</div>
					</div>
				</div>
		</div>		
</div>



<div id="main" style="left:30%; margin-left:-50px; margin-top: -25px; position: absolute;top:5%;height:100%;width:700px">
 <div class="w-box" id="" >
					<div class="w-box-header">
						<h4>Select</h4>
					</div>
					<div class="w-box-content cnt_a">
						<div class="row-fluid">
						   <div class="row-fluid">
							<div class="span6">
								<label>Sub Cetegory</label>
								<select id="sub_cat" name="sub_cat" class="span12">								
										<optgroup label="1/9">
											<option >select</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>									
										</optgroup>
								     
								</select>
							</div>						   
						</div>
						</div>
					</div>
		</div>
	  <div id="n_word_character_limiter" class="w-box">
			<div class="w-box-header">
			<h4>Textarea counter</h4>
			</div>
			<div class="w-box-content cnt_a">
				
			    <div class="row-fluid">
						<div class="span14">
							<label>Description</label>
							<textarea id="desc" class="span12" rows="6" name="desc" cols="70">sample description </textarea>
							<div class="charleft originalTextareaInfo" style="width: 448px;">0 characters | 0 words</div>
						</div>					
				</div>
	       		
			  <div class="row-fluid">
						   <div class="span6">
								   <div class="w-box-header">
									  <h4>Positives</h4>
									</div>
									<textarea id="pos" class="span12" name="pos" rows="6" cols="70">sample description </textarea>
									<div class="charleft originalTextareaInfo" style="width: 448px;">0 characters | 0 words</div>
							</div>	
						<div class="span6">
							    <div class="w-box-header">
								   <h4>Negatives</h4>
								</div>
								<textarea id="nes" class="span12" rows="6" name="neg" cols="70">sample description </textarea>
							   <div class="charleft originalTextareaInfo" style="width: 448px;">0/200 | 0 words</div>
							   <div class="update">
							   <button type="submit" class="btn btn-beoro-3">Update</button>
							 </div>
					  </div>
				</div>
			</div>			
		</div>
	  </div>	
</form>	  
	</div>			
  

	<script type="text/javascript">
				$(document).ready(function() { 
				
				$("#sub_cat").change(function() {
					var cat =$('input[name=cat]:checked').val();
					var sub_cat = $(this).val();	
					//alert(sub_cat)
				if(cat!="")	
				{
				$.ajax({
						type: "POST",
						url: "<?php echo base_url()?>welcome/getnuemerology",
						data:{"cat":cat,"sub_cat":sub_cat},
						success: function(html){
						//alert(html);
						var elem=html.split('*');  
						var desc = elem[0];  
						var pos = elem[1];  
						var nes = elem[2];  
						$("#desc").val(desc);				
						$("#pos").val(pos);				
						$("#nes").val(nes);				
						}
					  }); 
				}
				})
					   
		});
	</script>

		