<?php
/**
 *
 * 
 */
/*
Plugin Name: Excellence Fee
Plugin URI: http://wordpress.org/plugins/
Description: Plugin to add a fixed amount fee to the cart total amount.
Author: Excellence
Version: 1
Author URI: http://wordpress.org/plugins/
*/

/**
 * Check if WooCommerce is active
 **/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


function plugin_activation() {
  
	if (!is_plugin_active('woocommerce/woocommerce.php') )
    {
        deactivate_plugins(plugin_basename(__FILE__));
        set_transient( 'fx-admin-notice-example', true, 5 );
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

    }

}
add_action( 'init', 'plugin_activation' );

/* Add admin notice */
add_action( 'admin_notices', 'fx_admin_notice_example_notice' );


function fx_admin_notice_example_notice(){

    /* Check transient, if available display notice */
    if( get_transient( 'fx-admin-notice-example' ) ){
        ?>
        <div id="message" class="notice notice-error notice is-dismissible">
            <p>For Excellence Fee plugin to work please install and activate woocommerce plugin</p>
        </div>
        <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'fx-admin-notice-example' );
    }
}
 
function pluginprefix_install() {
 	plugin_activation();
 
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pluginprefix_install' );

function pluginprefix_deactivation() {
  
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );


function excellence_fee_admininc() {

    wp_enqueue_style( 'excellence_css', plugins_url( 'inc/style.css', __FILE__ ));
    wp_enqueue_script( 'excellence_js', plugins_url( 'excellence-fee/inc/jquery-3.4.1.min.js', dirname(__FILE__)));
    wp_enqueue_script( 'excellence_custom_js', plugins_url( 'excellence-fee/inc/script.js', dirname(__FILE__)));
}
add_action( 'admin_enqueue_scripts', 'excellence_fee_admininc' );

function excellence_submenu() {
    add_submenu_page( 'woocommerce', 'Excellence Fee', 'Excellence Fee', 'manage_options', 'excellence-fee', 'excellence_submenu_callback' ); 
}

//admin options
function excellence_submenu_callback() {
    echo '<h3>Excellence Fee Addition</h3>';
    include "admin/admin_input.php";
}
add_action('admin_menu', 'excellence_submenu',99);



//show and add fee on cart page
function woo_add_cart_fee() {
 
    include "fee_cart/cart.php";
    
}
add_action( 'woocommerce_cart_calculate_fees', 'woo_add_cart_fee' );


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
