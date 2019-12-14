<?php 



$new_columns = array();

foreach ( $columns as $column_name => $column_info ) {

    $new_columns[ $column_name ] = $column_info;

    if ( 'order_status' === $column_name ) {
        $new_columns['excellence_fee'] = __( 'Excellence Fee', 'my-textdomain' );
    }
}


?>