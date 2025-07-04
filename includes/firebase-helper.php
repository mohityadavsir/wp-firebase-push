// Assuming Firebase PHP SDK installed via composer (via /vendor)
// You can include and configure it here for server-side send
// You might use kreait/firebase-php package

require_once __DIR__ . '/../vendor/autoload.php';

use Kreait\Firebase\Factory;

function wpfp_get_firebase_instance() {
    $config = get_option('wpfp_firebase_credentials');
    if (!$config) return null;

    return (new Factory)->withServiceAccount($config)->createMessaging();
}
