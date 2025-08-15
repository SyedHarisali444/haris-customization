<?php
// General helper functions here

if ( ! defined( 'ABSPATH' ) ) exit;

function haris_log( $data ) {
    if ( WP_DEBUG === true ) {
        error_log( print_r( $data, true ) );
    }
}
