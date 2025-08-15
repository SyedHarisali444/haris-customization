<?php
namespace HarisStarter;

defined('ABSPATH') || exit;

class Shortcode_Example {
    public function register() : void {
        add_shortcode('haris_badge', [$this, 'badge']);
    }
    public function badge($atts = []) : string {
        $a = shortcode_atts(['text' => 'Pro'], $atts);
        $text = esc_html($a['text']);
        return '<span class="haris-badge" aria-label="badge">'.$text.'</span>';
    }
}
