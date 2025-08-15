<?php
/**
 * Plugin Name: Haris Customization Starter
 * Description: A clean starter to practice WordPress PHP customizations (hooks, CPT, REST, AJAX, Woo examples).
 * Version: 0.1.0
 * Author: Haris + ChatGPT
 * Text Domain: haris-starter
 */

defined('ABSPATH') || exit;

define('HARIS_STARTER_VERSION', '0.1.0');
define('HARIS_STARTER_FILE', __FILE__);
define('HARIS_STARTER_DIR', plugin_dir_path(__FILE__));
define('HARIS_STARTER_URL', plugin_dir_url(__FILE__));

// Simple PSR-4-like autoloader for this plugin.
spl_autoload_register(function($class){
    if (strpos($class, 'HarisStarter\\') !== 0) return;
    $path = HARIS_STARTER_DIR . 'includes/' . str_replace('HarisStarter\\', '', $class) . '.php';
    $path = str_replace('\\', '/', $path);
    if (file_exists($path)) require_once $path;
});

// Activation: maybe create custom DB table.
register_activation_hook(__FILE__, function(){
    // Set an installed timestamp option.
    add_option('haris_starter_installed_at', time());
});

// Deactivation: cleanup scheduled events etc. (none yet)
register_deactivation_hook(__FILE__, function(){
    // Placeholder for cleanup.
});

// Uninstall handled by uninstall.php.

// Bootstrap services.
add_action('plugins_loaded', function(){
    // Core services
    (new HarisStarter\Loader())->init();
    // Feature: CPT example
    (new HarisStarter\CPT_Example())->register();
    // Feature: Shortcode example
    (new HarisStarter\Shortcode_Example())->register();
    // Feature: REST example
    (new HarisStarter\Rest_Example())->register();
    // Feature: Woo example (soft load)
    if (class_exists('WooCommerce')) {
        (new HarisStarter\Woo_Example())->register();
    }
});
