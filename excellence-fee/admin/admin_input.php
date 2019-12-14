<?php
	global $wpdb;
	// $insert_path=plugin_dir_path( __FILE__ ) . "insert_fee.php";
	$insert_path=plugins_url( 'insert_fee.php', __FILE__ );

	$current_value = $wpdb->get_results('select * from ' . $wpdb->prefix . 'posts where  post_name="excellence_fee"');

	 foreach ($current_value as $key => $value) {
    	$current_value=$value -> post_content;
    	
    }
?>

<form method="post" action="<?php echo $insert_path; ?>" name="fee_form" class="fee_form">
	<div class="input-form">
		<div class="form_label"><label>Enter the Fee Amount: </label></div>
		<div class="input_fee">
			<input type="text" name="excel_fee" class="excel_fee" placeholder="enter excellence fee" value="<?php echo $current_value; ?>">
		</div>
		<input type="submit" name="excel_fee_submit" class="excel_fee_submit" value="SAVE">
	</div>
</form>