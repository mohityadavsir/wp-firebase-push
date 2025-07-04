<?php
function wpfp_dashboard_page() {
    ?>
    <div class="wrap">
        <h2>🔥 Firebase Push Dashboard</h2>
        <form method="post" id="firebase-credentials-form">
            <h3>Firebase Credentials</h3>
            <input type="text" name="apiKey" placeholder="API Key" required />
            <input type="text" name="authDomain" placeholder="Auth Domain" required />
            <input type="text" name="projectId" placeholder="Project ID" required />
            <input type="text" name="messagingSenderId" placeholder="Messaging Sender ID" required />
            <input type="text" name="appId" placeholder="App ID" required />
            <input type="submit" value="Save Credentials" />
        </form>

        <hr>

        <h3>Send Notification</h3>
        <input type="url" id="meta-url" placeholder="Enter URL to fetch metadata" />
        <button id="fetch-meta">Fetch Meta</button>

        <div id="meta-preview" style="display:none;">
            <input type="text" id="meta-title" />
            <input type="text" id="meta-description" />
            <input type="text" id="meta-image" />
            <button id="send-notification">Send Notification</button>
        </div>

        <h3>Subscribers</h3>
        <div id="subscribers-list"></div>
    </div>
    <?php
}
function wpfp_register_menu() {
    add_menu_page('Firebase Push', 'Firebase Push', 'manage_options', 'wp-firebase-push', 'wpfp_dashboard_page');
}
add_action('admin_menu', 'wpfp_register_menu');
