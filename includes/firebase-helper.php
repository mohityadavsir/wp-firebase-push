<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Kreait\Firebase\Factory;

function wpfp_get_firebase_messaging() {
    $path = plugin_dir_path(__FILE__) . '/../src/service-account.json';
    if (!file_exists($path)) return null;

    $factory = (new Factory)->withServiceAccount($path);
    return $factory->createMessaging();
}
