<?php
add_action('wp_ajax_wpfp_fetch_meta', function () {
    $url = esc_url_raw($_GET['url']);
    $html = file_get_contents($url);

    preg_match('/<meta property="og:title" content="(.*?)"/', $html, $title);
    preg_match('/<meta property="og:description" content="(.*?)"/', $html, $desc);
    preg_match('/<meta property="og:image" content="(.*?)"/', $html, $img);

    echo json_encode([
        'title' => $title[1] ?? '',
        'description' => $desc[1] ?? '',
        'image' => $img[1] ?? ''
    ]);
    wp_die();
});
