<?php
	global $post;
	// Note the 'id' attribute needs to match the 'target' parameter set above
	?>
	<div id='excellence-fee' class='panel woocommerce_options_panel'>
		<div class='options_group'>

			<?php

			$value = get_post_meta( $post->ID, 'excellence_fee_plug', true );
    		if( empty( $value ) ) $value = 'no';
			woocommerce_wp_select( 
				array( 
					'id'      => 'excel_option_form', 
					'label'   => __( 'Add fee: ', 'woocommerce' ), 
					'options' => array(
						'yes'   => __( 'Yes', 'woocommerce' ),
						'no'   => __( 'No', 'woocommerce' )
						),
					'value'   => $value,
					)
				);
			?>
		</div>

	</div>