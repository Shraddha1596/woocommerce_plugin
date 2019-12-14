<?php
	// $insert_path=plugin_dir_path( __FILE__ ) . "insert_fee.php";
	$insert_path=plugins_url( 'insert_fee.php', __FILE__ )
?>

<form method="post" action="<?php echo $insert_path; ?>" name="fee_form" class="fee_form">
	<div class="input-form">
		<div class="">Enter the Fee Amount: </div>
		<div class="input_fee">
			<input type="text" name="excel_fee" class="excel_fee" placeholder="enter excellence fee">
		</div>
		<input type="submit" name="excel_fee_submit" class="excel_fee_submit" value="SAVE">
	</div>
</form>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>
	
	$(document).ready(function(){
		var frm = $('.fee_form');


		frm.submit(function(event){
			var fee_input;
			fee_input=$('.excel_fee').val();
			// console.log(frm.attr('action'));

			if(!(fee_input) || fee_input==0){

				alert("Fee cannot be Blank or Zero");

			}else{
				// alert('else fee_input '+fee_input);
				$.ajax({
				 	type: frm.attr('method'),
					url: frm.attr('action'), 
					data:{fee_value:fee_input},
					// dataType:"json",
					success: function(response){
						alert(response);
				    	// alert("fee_input: "+data);
					}
				});
			}
			
			event.preventDefault();
		})
	})

</script>
