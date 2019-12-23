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


/**
 * Add a custom product tab.
 */
function excel_product_tab( $tabs) {

	include "product_settings/product_option.php";
	return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'excel_product_tab' );

function excel_product_tab_content() {

	include "product_settings/setting_content.php";
	
}
add_action( 'woocommerce_product_data_panels', 'excel_product_tab_content' );

function excel_product_tab_save( $post_id ) {
	include "product_settings/setting_content_save.php";
   
}
add_action( 'woocommerce_process_product_meta_simple', 'excel_product_tab_save' );
add_action( 'woocommerce_process_product_meta_variable', 'excel_product_tab_save' );



function excellence_shipping_method() {
        if ( ! class_exists( 'Excellence_Shipping_Method' ) ) {
            class Excellence_Shipping_Method extends WC_Shipping_Method {
                /**
                 * Constructor for your shipping class
                 *
                 * @access public
                 * @return void
                 */
                public function __construct() {
                    $this->id                 = 'excellence'; 
                    $this->method_title       = __( 'Excellence Shipping', 'excellence' );  
                    $this->method_description = __( 'Custom Shipping Method for Excellence', 'excellence' ); 
 
                    // Availability & Countries
                    $this->availability = 'including';
                    $this->countries = array(
                        'US', // Unites States of America
                        'CA', // Canada
                        'DE', // Germany
                        'GB', // United Kingdom
                        'IT',   // Italy
                        'ES', // Spain
                        'HR',  // Croatia
                        'IN'	// India
                        );
 
                    $this->init();
 
                    $this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
                    $this->title = isset( $this->settings['title'] ) ? $this->settings['title'] : __( 'Excellence Shipping', 'excellence' );
                }
 
                /**
                 * Init your settings
                 *
                 * @access public
                 * @return void
                 */
                function init() {
                    // Load the settings API
                    $this->init_form_fields(); 
                    $this->init_settings(); 
 
                    // Save settings in admin if you have any defined
                    add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
                }
 
                /**
                 * Define settings field for this shipping
                 * @return void 
                 */
                function init_form_fields() { 
 
                    $this->form_fields = array(
 
                     'enabled' => array(
                          'title' => __( 'Enable', 'excellence' ),
                          'type' => 'checkbox',
                          'description' => __( 'Enable this shipping.', 'excellence' ),
                          'default' => 'yes'
                          ),
 
                     'title' => array(
                        'title' => __( 'Title', 'excellence' ),
                          'type' => 'text',
                          'description' => __( 'Title to be display on site', 'excellence' ),
                          'default' => __( 'Excellence Shipping', 'excellence' )
                          ),
 
                     'weight' => array(
                        'title' => __( 'Weight (kg)', 'excellence' ),
                          'type' => 'number',
                          'description' => __( 'Maximum allowed weight', 'excellence' ),
                          'default' => 100
                          ),
 
                     );
 
                }
 
                /**
                 * This function is used to calculate the shipping cost. Within this function we can check for weights, dimensions and other parameters.
                 *
                 * @access public
                 * @param mixed $package
                 * @return void
                 */
                public function calculate_shipping( $package  = array()) {
                    
                    $weight = 0;
                    $cost = 0;
                    $country = $package["destination"]["country"];
 
                    foreach ( $package['contents'] as $item_id => $values ) 
                    { 
                        $_product = $values['data']; 
                        $weight = $weight + $_product->get_weight() * $values['quantity']; 
                    }
 
                    $weight = wc_get_weight( $weight, 'kg' );
 
                    if( $weight <= 10 ) {
 
                        $cost = 2;
 
                    } elseif( $weight <= 30 ) {
 
                        $cost = 5;
 
                    } elseif( $weight <= 50 ) {
 
                        $cost = 10;
 
                    } else {
 
                        $cost = 20;
 
                    }
 
                    $countryZones = array(
                        'HR' => 1,
                        'US' => 3,
                        'GB' => 2,
                        'CA' => 3,
                        'ES' => 2,
                        'DE' => 1,
                        'IT' => 1,
                        'IN' => 0
                        );
 
                    $zonePrices = array(
                        0 => 10,
                        1 => 30,
                        2 => 50,
                        3 => 70
                        );
 
                    $zoneFromCountry = $countryZones[ $country ];
                    $priceFromZone = $zonePrices[ $zoneFromCountry ];
 
                    $cost += $priceFromZone;
 
                    $rate = array(
                        'id' => $this->id,
                        'label' => $this->title,
                        'cost' => $cost
                    );
 
                    $this->add_rate( $rate );
                    
                }
            }
        }
    }
 
    add_action( 'woocommerce_shipping_init', 'excellence_shipping_method' );
 
    function add_excellence_shipping_method( $methods ) {
        $methods[] = 'Excellence_Shipping_Method';
        return $methods;
    }
 
    add_filter( 'woocommerce_shipping_methods', 'add_excellence_shipping_method' );
 
    function excellence_validate_order( $posted )   {
 
        $packages = WC()->shipping->get_packages();
 
        $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
         
        if( is_array( $chosen_methods ) && in_array( 'excellence', $chosen_methods ) ) {
             
            foreach ( $packages as $i => $package ) {
 
                if ( $chosen_methods[ $i ] != "excellence" ) {
                             
                    continue;
                             
                }
 
                $Excellence_Shipping_Method = new Excellence_Shipping_Method();
                $weightLimit = (int) $Excellence_Shipping_Method->settings['weight'];
                $weight = 0;
 
                foreach ( $package['contents'] as $item_id => $values ) 
                { 
                    $_product = $values['data']; 
                    $weight = $weight + $_product->get_weight() * $values['quantity']; 
                }
 
                $weight = wc_get_weight( $weight, 'kg' );
                
                if( $weight > $weightLimit ) {
 
                        $message = sprintf( __( 'Sorry, %d kg exceeds the maximum weight of %d kg for %s', 'excellence' ), $weight, $weightLimit, $Excellence_Shipping_Method->title );
                             
                        $messageType = "error";
 
                        if( ! wc_has_notice( $message, $messageType ) ) {
                         
                            wc_add_notice( $message, $messageType );
                      
                        }
                }
            }       
        } 
    }
 
    add_action( 'woocommerce_review_order_before_cart_contents', 'excellence_validate_order' , 10 );
    add_action( 'woocommerce_after_checkout_validation', 'excellence_validate_order' , 10 );

