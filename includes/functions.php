<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Test: run code on site load
add_action( 'wp_footer', function() {
    echo "<!-- Haris Customization Loaded -->";
});

/**
 * Shortcode: [haris_welcome message="Hello!" color="#0073aa"]
 */
function haris_welcome_shortcode( $atts ) {
    // Default shortcode attributes
    $atts = shortcode_atts(
        array(
            'message' => 'Welcome to my site!',
            'color'   => '#0073aa', // WP blue
        ),
        $atts,
        'haris_welcome'
    );

    $date = date_i18n( get_option( 'date_format' ) );

    $html  = "<div class='haris-welcome' style='color: {$atts['color']}; font-weight: bold; font-size: 18px;'>";
    $html .= esc_html( $atts['message'] ) . " Today is {$date}.";
    $html .= "</div>";

    return $html;
}
add_shortcode( 'haris_welcome', 'haris_welcome_shortcode' );
