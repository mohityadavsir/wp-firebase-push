<?php
/**
 * Plugin Name: WP Firebase Push
 * Description: Store push subscribers in Firebase, fetch metadata from URLs, and send editable notifications.
 * Version: 1.0
 */

defined('ABSPATH') or die('No script kiddies please!');

// Include core files
require_once plugin_dir_path(__FILE__) . 'includes/firebase-helper.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-fetcher.php';
require_once plugin_dir_path(__FILE__) . 'includes/push-handler.php';

// Admin Page
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . 'admin/dashboard-page.php';
}

// Enqueue scripts
function wpfp_enqueue_assets($hook) {
    if (strpos($hook, 'wp-firebase-push') === false) return;

    wp_enqueue_style('wpfp-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('wpfp-admin', plugin_dir_url(__FILE__) . 'assets/admin.js', [], null, true);

    // Pass PHP variables to JS
    wp_localize_script('wpfp-admin', 'WPFirebase', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('wpfp_nonce')
    ]);
}
add_action('admin_enqueue_scripts', 'wpfp_enqueue_assets');
