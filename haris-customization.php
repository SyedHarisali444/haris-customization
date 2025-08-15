<?php
/**
 * Plugin Name: Haris Customization
 * Description: Custom PHP features and shortcodes for WordPress.
 * Version: 1.0
 * Author: Syed Haris Ali
 * Author URI: https://github.com/SyedHarisali444
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Define plugin path
define( 'HARIS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// Include files
require_once HARIS_PLUGIN_PATH . 'includes/helpers.php';
require_once HARIS_PLUGIN_PATH . 'includes/functions.php';
