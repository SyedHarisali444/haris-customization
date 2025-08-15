<?php
// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) exit;
delete_option('haris_enable_badge');
delete_option('haris_starter_installed_at');
