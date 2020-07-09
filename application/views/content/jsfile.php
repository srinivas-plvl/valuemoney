<script type="text/javascript">
				$(document).ready(function() { 
				
				$("#sub_cat").change(function() {					
					var sub_cat = $(this).val();
                    var	test=$("#catid").val();				
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
						}
					  });
				})	   
		});
	</script>
	