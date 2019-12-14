<?php
require_once('../../../../wp-load.php');

global $wpdb;


if(isset($_REQUEST['fee_value'])){
	$fee=$_POST['fee_value'];
	
	$fee_title="Excellence Fee";
	
	$my_post = array(
	  // 'post_title'    => wp_strip_all_tags( $_POST['post_title'] ),
		'post_title'    => $fee_title,
	  	'post_content'  => $fee,
	  	'post_status'   => 'publish',
	  	'post_name' => 'excellence_fee',
	);

	 $existing_data = $wpdb->get_results('select * from ' . $wpdb->prefix . 'posts where  post_name="excellence_fee"');
	
	if ( ! empty( $existing_data ) ) {
		// print_r($existing_data);
	    foreach ($existing_data as $key => $value) {
	    	$existing_value=$value -> post_content;
	    	$existing_value_id=$value -> ID;
	    	// echo $existing_value." ".$existing_value_id;
	    }
	    $my_post_update = array(
		      'ID'           => $existing_value_id,
		      'post_content' => $fee,
		);
		 
		// Update the post into the database
		$update_status=wp_update_post( $my_post_update );
	    // $update_status= update_post_meta( $existing_value_id, $existing_value, $fee );
	    if ( is_wp_error( $update_status ) ) {
		     echo $update_status->get_error_message();
		}
		else {
		     echo 'Excellence Fee updated successfully to: '.$fee;
		}


	    // update_post_meta( $existing_value_id, 'key_1', 'Excited', $value );
	}else{
		echo "@@@@@@";
		// Insert the post into the database
		$insert_status= wp_insert_post( $my_post );
		if ( is_wp_error( $insert_status ) ) {
		     echo $insert_status->get_error_message();
		}
		else {
		     echo 'Excellence Fee inserted successfully';
		}
	}
	 
	// // Insert the post into the database
	// $insert_status= wp_insert_post( $my_post );
	// if ( is_wp_error( $insert_status ) ) {
	//      echo $insert_status->get_error_message();
	// }
	// else {
	//      echo 'Excellence Fee updated successfully';
	// }
		
}else{
		echo "value saving unsuccessful";
		
}

?>