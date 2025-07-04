<?php
add_action('wp_ajax_wpfp_send_notification', function () {
    check_ajax_referer('wpfp_nonce');

    $title = sanitize_text_field($_POST['title']);
    $desc = sanitize_text_field($_POST['description']);
    $image = esc_url_raw($_POST['image']);

    $tokens = get_option('wpfp_subscribers', []);
    require_once plugin_dir_path(__FILE__) . '/firebase-helper.php';
    $messaging = wpfp_get_firebase_messaging();

    foreach ($tokens as $token) {
        $message = [
            'token' => $token,
            'notification' => [
                'title' => $title,
                'body' => $desc,
                'image' => $image
            ]
        ];
        try {
            $messaging->send($message);
        } catch (Exception $e) {
            // Log or handle errors
        }
    }
    echo "Notification Sent!";
    wp_die();
});
