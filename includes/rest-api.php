<?php
add_action('rest_api_init', function () {
    register_rest_route('wpfp/v1', '/subscribe', [
        'methods' => 'POST',
        'callback' => function ($req) {
            $body = json_decode($req->get_body(), true);
            if (!isset($body['token'])) return new WP_Error('no_token', 'Token required', ['status' => 400]);

            $tokens = get_option('wpfp_subscribers', []);
            if (!in_array($body['token'], $tokens)) {
                $tokens[] = sanitize_text_field($body['token']);
                update_option('wpfp_subscribers', $tokens);
            }
            return ['status' => 'ok'];
        },
        'permission_callback' => '__return_true'
    ]);
});
