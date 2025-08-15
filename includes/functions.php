<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Test: run code on site load
add_action( 'wp_footer', function() {
    echo "<!-- Haris Customization Loaded -->";
});
