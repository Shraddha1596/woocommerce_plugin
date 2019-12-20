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

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function plugin_activation() {
    
    /*  Check if WooCommerce is active*/
	if (!is_plugin_active('woocommerce/woocommerce.php') )
    {
        deactivate_plugins(plugin_basename(__FILE__));
        set_transient( 'fx-admin-notice-example', true, 5 );
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

    }
    include('excellence-functions.php');

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
