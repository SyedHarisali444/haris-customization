<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Day 1 - Basic Action Hook
add_action( 'wp_head', 'haris_add_custom_message' );
function haris_add_custom_message() {
    echo '<!-- Haris Customization Plugin Active -->';
}

// Day 1 - Basic Filter Hook
add_filter( 'bloginfo', 'haris_change_bloginfo', 10, 2 );
function haris_change_bloginfo( $output, $show ) {
    if ( $show === 'name' ) {
        return $output . ' 🚀 Custom!';
    }
    return $output;
}
