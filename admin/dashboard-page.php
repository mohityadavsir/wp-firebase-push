<?php
function wpfp_dashboard_page() {
    ?>
    <div class="wrap">
        <h2>Firebase Push Notifications</h2>
        <form method="post" enctype="multipart/form-data">
            <h3>Upload Firebase Credentials</h3>
            <input type="file" name="firebase_json" accept=".json" required />
            <input type="submit" name="upload_json" value="Upload" />
        </form>
        <h3>Send Notification</h3>
        <input type="url" id="meta-url" placeholder="Enter URL" />
        <button id="fetch-meta">Fetch Meta</button>
        <div id="meta-preview" style="display:none;">
            <input type="text" id="meta-title" />
            <input type="text" id="meta-description" />
            <input type="text" id="meta-image" />
            <button id="send-notification">Send Notification</button>
        </div>
    </div>
    <?php
}
function wpfp_register_menu() {
    add_menu_page('Firebase Push', 'Firebase Push', 'manage_options', 'wp-firebase-push', 'wpfp_dashboard_page');
}
add_action('admin_menu', 'wpfp_register_menu');
