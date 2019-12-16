<?php


	global $post;
    global $wpdb;

    if ( 'excellence_fee' === $column ) {
  
        $existing_order = $wpdb->get_results('select order_item_id from ' . $wpdb->prefix . 'woocommerce_order_items where order_id="'.$post->ID.'" and order_item_name="Excellence Fee"');
			if($existing_order){
				foreach ($existing_order as $key => $value) {
			            $existing_value_id=$value -> order_item_id;
			            
			        }

			        $order    = wc_get_order_item_meta( $existing_value_id, $key, $single );
		      
		        	foreach ($order['_fee_amount'] as $orderkey => $ordervalue) {
			            $existingorder_value_id=$ordervalue;
			            
			        }
			      
			}else{
				$existingorder_value_id=0;
			}
        echo wc_price( $existingorder_value_id, array( 'currency' => $currency ) );
    }