	$(document).ready(function(){
		var frm = $('.fee_form');
		frm.submit(function(event){
			var fee_input;
			var fee_status;
			fee_input=$('.excel_fee').val();
			fee_label=$('.excel_label').val();
			
			fee_status=$(this).find('.check_fee').is(':checked');

			if(!(fee_input) || fee_input==0){

				alert("Fee cannot be Blank or Zero");

			}else{
				
				$.ajax({
				 	type: frm.attr('method'),
					url: frm.attr('action'), 
					data:{fee_value:fee_input,fee_status:fee_status,fee_label:fee_label},
					
					success: function(response){
						$('.save_status').text(response);
						$('.save_status').addClass('save_status_after');
						
					}
				});
			}
			
			event.preventDefault();
		})
	})