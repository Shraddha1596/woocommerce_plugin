<?php

global $wpdb;

$current_value = get_page_by_title('Excellence Fee', OBJECT, 'post');
$checkbox_status=$current_value -> post_status;

if($checkbox_status == "true"){
	add_action( 'woocommerce_cart_calculate_fees', 'woo_add_cart_fee' );
}

function excellence_submenu() {
    add_submenu_page( 'woocommerce', 'Excellence Fee', 'Excellence Fee', 'manage_options', 'excellence-fee', 'excellence_submenu_callback' ); 
}

//admin options
function excellence_submenu_callback() {

    include "admin/admin_input.php";

}
add_action('admin_menu', 'excellence_submenu',99);

//show and add fee on cart page
function woo_add_cart_fee() {
    include "fee_cart/cart.php"; 
}

//add excellence fee option in admin woocommerce > order table
function sv_wc_cogs_add_order_profit_column_header( $columns ) {
    include "order_admin/admin_table.php";
    return $new_columns;
}
add_filter( 'manage_edit-shop_order_columns', 'sv_wc_cogs_add_order_profit_column_header', 20 );

function sv_wc_cogs_add_order_profit_column_content( $column ) {

    include "order_admin/admin_table_value.php";

}
add_action( 'manage_shop_order_posts_custom_column', 'sv_wc_cogs_add_order_profit_column_content' );