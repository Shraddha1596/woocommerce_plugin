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