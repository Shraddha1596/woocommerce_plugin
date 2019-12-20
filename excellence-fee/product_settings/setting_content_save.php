<?php
 // check nonce

	print_r($_REQUEST);
    if( ! ( isset( $_POST['woocommerce_meta_nonce'], $_POST['excel_option_form'] ) || wp_verify_nonce( sanitize_key( $_POST['woocommerce_meta_nonce'] ), 'woocommerce_save_data' ) ) ) {
        return false;
    }

    update_post_meta( $post_id, 'excellence_fee_plug', sanitize_text_field( $_POST['excel_option_form'] ) );
