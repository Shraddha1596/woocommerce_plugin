<?php
	
 	global $woocommerce;
	global $wpdb;

	$existing_data = get_page_by_title('Excellence Fee', OBJECT, 'post');
	$existing_value=$existing_data -> post_content;

  	$woocommerce->cart->add_fee( __('Excellence Fee', 'woocommerce'), $existing_value );