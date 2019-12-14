<?php
	
 	global $woocommerce;
	global $wpdb;

	$existing_data = $wpdb->get_results('select * from ' . $wpdb->prefix . 'posts where  post_name="excellence_fee"');

	 foreach ($existing_data as $key => $value) {
    	$existing_value=$value -> post_content;
    	
    }

  	$woocommerce->cart->add_fee( __('Excellence Fee', 'woocommerce'), $existing_value );