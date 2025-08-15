<?php
namespace HarisStarter;

defined('ABSPATH') || exit;

class CPT_Example {
    public function register() : void {
        add_action('init', [$this, 'cpt']);
        add_action('add_meta_boxes', [$this, 'meta_boxes']);
        add_action('save_post_portfolio', [$this, 'save_meta']);
        add_filter('manage_portfolio_posts_columns', [$this, 'cols']);
        add_action('manage_portfolio_posts_custom_column', [$this, 'col_content'], 10, 2);
    }

    public function cpt() : void {
        register_post_type('portfolio', [
            'label' => __('Portfolio', 'haris-starter'),
            'public' => true,
            'show_in_rest' => true,
            'supports' => ['title','editor','thumbnail','excerpt'],
            'menu_icon' => 'dashicons-portfolio',
        ]);
        register_taxonomy('skill', 'portfolio', [
            'label' => __('Skills', 'haris-starter'),
            'public' => true,
            'show_in_rest' => true,
            'hierarchical' => false,
        ]);
    }

    public function meta_boxes() : void {
        add_meta_box('haris_portfolio_meta', __('Portfolio Details', 'haris-starter'), [$this, 'meta_html'], 'portfolio', 'side');
    }

    public function meta_html($post) : void {
        wp_nonce_field('haris_portfolio_meta', 'haris_portfolio_nonce');
        $client = get_post_meta($post->ID, '_haris_client', true);
        $url = get_post_meta($post->ID, '_haris_url', true);
        echo '<p><label>Client<br><input type="text" name="haris_client" value="'.esc_attr($client).'"></label></p>';
        echo '<p><label>Project URL<br><input type="url" name="haris_url" value="'.esc_attr($url).'"></label></p>';
    }

    public function save_meta($post_id) : void {
        if (!isset($_POST['haris_portfolio_nonce']) || !wp_verify_nonce($_POST['haris_portfolio_nonce'], 'haris_portfolio_meta')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;
        update_post_meta($post_id, '_haris_client', sanitize_text_field($_POST['haris_client'] ?? ''));
        update_post_meta($post_id, '_haris_url', esc_url_raw($_POST['haris_url'] ?? ''));
    }

    public function cols($cols) {
        $cols['haris_client'] = __('Client','haris-starter');
        return $cols;
    }

    public function col_content($col, $post_id) {
        if ($col === 'haris_client') {
            echo esc_html( get_post_meta($post_id, '_haris_client', true) );
        }
    }
}
