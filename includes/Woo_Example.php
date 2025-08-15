<?php
namespace HarisStarter;

defined('ABSPATH') || exit;

class Woo_Example {
    public function register() : void {
        add_action('woocommerce_single_product_summary', [$this, 'under_price'], 11);
        add_filter('woocommerce_checkout_fields', [$this, 'checkout_fields']);
        add_action('woocommerce_checkout_update_order_meta', [$this, 'save_checkout'], 10, 2);
        add_action('woocommerce_admin_order_data_after_billing_address', [$this, 'show_admin_order'], 10, 1);
    }

    public function under_price() : void {
        echo '<p class="haris-note" style="opacity:.7;">' . esc_html__('Ships in 24–48h', 'haris-starter') . '</p>';
    }

    public function checkout_fields($fields) {
        $fields['billing']['billing_project_ref'] = [
            'type' => 'text',
            'label' => __('Project Ref', 'haris-starter'),
            'required' => false,
            'class' => ['form-row-wide'],
            'priority' => 120,
        ];
        return $fields;
    }

    public function save_checkout($order_id, $posted) {
        if (!empty($_POST['billing_project_ref'])) {
            update_post_meta($order_id, '_billing_project_ref', sanitize_text_field($_POST['billing_project_ref']));
        }
    }

    public function show_admin_order($order) {
        $ref = get_post_meta($order->get_id(), '_billing_project_ref', true);
        if ($ref) {
            echo '<p><strong>'.esc_html__('Project Ref:', 'haris-starter').'</strong> '.esc_html($ref).'</p>';
        }
    }
}
