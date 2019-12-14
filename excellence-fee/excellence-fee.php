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
   
	// if (!class_exists('Woocommerce')) {
	//     // your code here
	//     pluginprefix_deactivation();
	// }

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


/**
 * Admin Notice on Activation.
 * @since 0.1.0
 */
function fx_admin_notice_example_notice(){

    /* Check transient, if available display notice */
    if( get_transient( 'fx-admin-notice-example' ) ){
        ?>
        <div id="message" class="notice notice-error notice is-dismissible">
    	<!-- <div class="notice notice-error notice is-dismissible"> -->
            <p>For Excellence Fee plugin to work please install and activate woocommerce plugin</p>
        </div>
        <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'fx-admin-notice-example' );
    }
}
 
function pluginprefix_install() {
     	plugin_activation();
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pluginprefix_install' );

function pluginprefix_deactivation() {
    // unregister the post type, so the rules are no longer in memory
    // unregister_post_type( 'book' );
    // clear the permalinks to remove our post type's rules from the database
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );

function excellence_submenu() {
    add_submenu_page( 'woocommerce', 'Excellence Fee', 'Excellence Fee', 'manage_options', 'excellence-fee', 'excellence_submenu_callback' ); 
}
function excellence_submenu_callback() {
    echo '<h3>Excellence Fee Addition</h3>';
     include "admin/admin_input.php";
}
add_action('admin_menu', 'excellence_submenu',99);


