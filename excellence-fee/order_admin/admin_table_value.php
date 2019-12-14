<?php


	global $post;
    global $wpdb;

    if ( 'excellence_fee' === $column ) {

        // $order    = wc_get_order( $post->ID );
        
        $existing_order = $wpdb->get_results('select order_item_id from ' . $wpdb->prefix . 'woocommerce_order_items where order_id="'.$post->ID.'" and order_item_name="Excellence Fee"');
			if($existing_order){
				foreach ($existing_order as $key => $value) {
			            $existing_value_id=$value -> order_item_id;
			            
			        }

			        $order1    = wc_get_order_item_meta( $existing_value_id, $key, $single );
		      
		        	foreach ($order1['_fee_amount'] as $order1key => $order1value) {
			            $existingorder1_value_id=$order1value;
			            
			        }
			      
			}else{
				$existingorder1_value_id=0;
			}
        echo wc_price( $existingorder1_value_id, array( 'currency' => $currency ) );
    }