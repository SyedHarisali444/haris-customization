<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Extra functions will go here for later days

// Day 2 - First Custom Shortcode
add_shortcode( 'haris_welcome', 'haris_welcome_shortcode' );

function haris_welcome_shortcode() {
    // Get current date
    $today = date_i18n( 'l, F j, Y' );

    // Return HTML for the shortcode
    return "<div style='padding:10px; background:#f5f5f5; border-left:4px solid #0073aa;'>
                <strong>Welcome to Haris Customization 🚀</strong><br>
                Today is {$today}.
            </div>";
}
