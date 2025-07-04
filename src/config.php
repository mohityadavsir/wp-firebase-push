if ($_SERVER['REQUEST_METHOD'] === 'POST' && current_user_can('manage_options')) {
    $creds = [
        'apiKey' => sanitize_text_field($_POST['apiKey']),
        'authDomain' => sanitize_text_field($_POST['authDomain']),
        'projectId' => sanitize_text_field($_POST['projectId']),
        'messagingSenderId' => sanitize_text_field($_POST['messagingSenderId']),
        'appId' => sanitize_text_field($_POST['appId'])
    ];
    update_option('wpfp_firebase_credentials', $creds);
    echo "<div class='updated'><p>Saved!</p></div>";
}
