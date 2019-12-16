<?php
require_once('../../../../wp-load.php');

global $wpdb;


if(isset($_REQUEST['fee_value'])){
	$fee=$_POST['fee_value'];
	$fee_stat=$_POST['fee_status'];
	
	$fee_title=_( 'Excellence Fee');
	
	$my_post = array(
		'post_title'    => $fee_title,
	  	'post_content'  => $fee,
	  	'post_status'   => $fee_stat,
	  	'post_name' => _( 'excellence_fee'),
	);

	 $existing_data = $wpdb->get_results('select * from ' . $wpdb->prefix . 'posts where  post_name="excellence_fee"');
	
	if ( ! empty( $existing_data ) ) {
	
	    foreach ($existing_data as $key => $value) {
	    	$existing_value=$value -> post_content;
	    	$existing_value_id=$value -> ID;
	    
	    }
	    $my_post_update = array(
		      'ID'           => $existing_value_id,
		      'post_content' => $fee,
		      'post_status'   => $fee_stat,
		);
		 
		// Update the post into the database
		$update_status=wp_update_post( $my_post_update );
	    
	    if ( is_wp_error( $update_status ) ) {

	    	$message= $update_status->get_error_message();
	    	_e(  $message );
		    // return  $message ;
		}
		else {
			$message='Excellence Fee updated successfully to: '.$fee;

		    _e(  $message );
		    // return  $message ;
		}

	}else{

		// Insert the post into the database
		$insert_status= wp_insert_post( $my_post );
		if ( is_wp_error( $insert_status ) ) {
			$message= $insert_status->get_error_message();
		    _e(  $message );
		}
		else{
			$message= 'Excellence Fee inserted successfully';
		    _e(  $message );
		}
	}
	
}else{
		$message= "Some error occured";
		_e(  $message );		
}

?>