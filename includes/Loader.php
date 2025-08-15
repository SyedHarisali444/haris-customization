<?php
namespace HarisStarter;

defined('ABSPATH') || exit;

class Loader {
    public function init() : void {
        add_action('init', [$this, 'on_init']);
        add_action('admin_menu', [$this, 'admin_menu']);
        add_filter('the_content', [$this, 'badge_on_content'], 20);
        add_action('wp_enqueue_scripts', [$this, 'assets']);
    }

    public function on_init() : void {
        // Place to register things that must exist early.
        // error_log('HarisStarter init fired at ' . time());
    }

    public function admin_menu() : void {
        add_menu_page(
            __('Haris Toolkit', 'haris-starter'),
            __('Haris Toolkit', 'haris-starter'),
            'manage_options',
            'haris-toolkit',
            [$this, 'render_settings'],
            'dashicons-admin-generic',
            59
        );
    }

    public function render_settings() : void {
        if (!current_user_can('manage_options')) return;
        if (!empty($_POST['haris_enable_badge']) && check_admin_referer('haris_options')) {
            update_option('haris_enable_badge', $_POST['haris_enable_badge'] === '1' ? '1' : '0');
            echo '<div class="updated"><p>' . esc_html__('Saved.', 'haris-starter') . '</p></div>';
        }
        $enabled = get_option('haris_enable_badge', '1');
        echo '<div class="wrap"><h1>Haris Toolkit</h1><form method="post">';
        wp_nonce_field('haris_options');
        echo '<label><input type="checkbox" name="haris_enable_badge" value="1" ' . checked('1', $enabled, false) . '> ' . esc_html__('Enable badge on content', 'haris-starter') . '</label>';
        submit_button();
        echo '</form></div>';
    }

    public function assets() : void {
        wp_register_style('haris-starter', plugins_url('style.css', HARIS_STARTER_FILE), [], HARIS_STARTER_VERSION);
        wp_enqueue_style('haris-starter');
        wp_register_script('haris-starter', plugins_url('starter.js', HARIS_STARTER_FILE), ['jquery'], HARIS_STARTER_VERSION, true);
        wp_localize_script('haris-starter', 'HarisStarter', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('haris_nonce'),
            'rest'    => esc_url_raw( rest_url('haris/v1') ),
        ]);
        wp_enqueue_script('haris-starter');
    }

    public function badge_on_content($content) {
        if (is_admin()) return $content;
        if (get_option('haris_enable_badge', '1') !== '1') return $content;
        $badge = '<span class="haris-badge" style="display:inline-block;padding:.2rem .5rem;border:1px solid #ddd;border-radius:6px;font-size:.75rem;">Pro</span>';
        return $badge . ' ' . $content;
    }
}
