<?php
	
 	global $woocommerce;
	global $wpdb;

	$existing_data = get_page_by_title('Excellence Fee', OBJECT, 'post');
	$existing_value=$existing_data -> post_content;
	$existing_value_label=$existing_data -> post_content_filtered;

  	$woocommerce->cart->add_fee( __($existing_value_label, 'woocommerce'), $existing_value );