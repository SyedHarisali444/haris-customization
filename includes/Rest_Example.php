<?php
namespace HarisStarter;

defined('ABSPATH') || exit;

class Rest_Example {
    public function register() : void {
        add_action('rest_api_init', [$this, 'routes']);
    }
    public function routes() : void {
        register_rest_route('haris/v1', '/ping', [
            'methods' => 'GET',
            'callback' => function(){ return ['ok' => true, 'time' => time()]; },
            'permission_callback' => '__return_true',
        ]);
    }
}
