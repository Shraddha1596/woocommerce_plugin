<?php
	global $wpdb;
	$insert_path=plugins_url( 'insert_fee.php', __FILE__ );

    $post = get_page_by_title('Excellence Fee', OBJECT, 'post');
    $postval= $post -> post_content;
    $checkbox_status=$post -> post_status;
    if($checkbox_status == "true"){
    	$checkbox_status_val= _("checked");
    }else{
    	$checkbox_status_val= _("unchecked");
    }

?>
<div>
	<h3>
		<?php
			_e( 'Excellence Fee Addition' , 'excellence-fee');
		?>
	</h3>
	<form method="post" action="<?php _e(  $insert_path, 'excellence-fee' ); ?>" name="fee_form" class="fee_form">
		<div class="input-form">
			<div class="form_label">
				<label><?php _e( 'Enter the Fee Amount: ', 'excellence-fee' ); ?>
				</label>
			</div>
			<div class="input_fee">
				
				<input type="text" name="excel_fee" class="excel_fee 123" placeholder="<?php _e( 'enter excellence fee', 'excellence-fee' );	?>" value="<?php _e( $postval ); ?>">

			</div>
			<div class="input_check">

				<input type="checkbox" name="check_fee" class="check_fee"  <?php _e( $checkbox_status_val, 'excellence-fee' ); ?>>  <?php _e( 'Check this to enable fee addition feature'); ?><br>
			</div>
			<div class="submit_fee_div">
				<input type="submit" name="excel_fee_submit" class="excel_fee_submit" value="<?php _e( 'SAVE', 'excellence-fee') ?>">
			</div>
		</div>
		<div class="save_status" ></div>
	</form>
</div>