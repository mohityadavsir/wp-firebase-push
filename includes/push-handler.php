add_action('wp_ajax_wpfp_send_notification', function () {
    check_ajax_referer('wpfp_nonce');

    $title = sanitize_text_field($_POST['title']);
    $desc = sanitize_text_field($_POST['description']);
    $image = esc_url_raw($_POST['image']);

    // Normally, you will fetch tokens from Firebase or saved store
    $messaging = wpfp_get_firebase_instance();
    if (!$messaging) wp_send_json_error("Firebase not configured");

    $message = [
        'notification' => [
            'title' => $title,
            'body' => $desc,
            'image' => $image
        ],
        'topic' => 'all' // or send to token list
    ];

    $messaging->send($message);
    echo "Notification Sent!";
    wp_die();
});
