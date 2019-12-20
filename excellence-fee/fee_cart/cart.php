<?php
	
 	global $woocommerce;
	global $wpdb;

	$existing_data = get_page_by_title('Excellence Fee', OBJECT, 'post');
	$existing_value=$existing_data -> post_content;
	$existing_value_label=$existing_data -> post_content_filtered;

	$fee_status=false;

	foreach( WC()->cart->get_cart() as $cart_item ) {
		
		$active_product = get_post_meta( $cart_item['product_id'], 'excellence_fee_plug', true );
		if($active_product == 'yes'){
			$fee_status=true;
		}
		
       
    }

	if($fee_status == true){
	  	$woocommerce->cart->add_fee( __($existing_value_label, 'woocommerce'), $existing_value );
  	}
