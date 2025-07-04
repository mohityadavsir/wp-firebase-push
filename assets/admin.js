document.addEventListener('DOMContentLoaded', () => {
    // ---------------------- //
    // ?? Firebase Init Start //
    // ---------------------- //
    import('https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js')
    .then(() => import('https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging.js'))
    .then(firebase => {
        const firebaseConfig = {
            apiKey: "YOUR_API_KEY",
            authDomain: "YOUR_PROJECT_ID.firebaseapp.com",
            projectId: "YOUR_PROJECT_ID",
            messagingSenderId: "YOUR_SENDER_ID",
            appId: "YOUR_APP_ID"
        };

        const app = firebase.initializeApp(firebaseConfig);
        const messaging = firebase.getMessaging(app);

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/firebase-messaging-sw.js')
                .then(registration => {
                    messaging.useServiceWorker(registration);

                    firebase.getToken(messaging, {
                        vapidKey: 'YOUR_PUBLIC_VAPID_KEY',
                        serviceWorkerRegistration: registration
                    }).then((currentToken) => {
                        if (currentToken) {
                            // Send token to server
                            fetch('/wp-json/wpfp/v1/subscribe', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ token: currentToken })
                            });
                        } else {
                            console.warn('No registration token available. Request permission to generate one.');
                        }
                    }).catch((err) => {
                        console.error('An error occurred while retrieving token. ', err);
                    });
                }).catch(err => {
                    console.error('Service Worker registration failed:', err);
                });
        }
    });

    // ------------------------ //
    // ?? Meta Fetch & Display //
    // ------------------------ //
    document.getElementById('fetch-meta').addEventListener('click', () => {
        const url = document.getElementById('meta-url').value;
        fetch(WPFirebase.ajax_url + '?action=wpfp_fetch_meta&url=' + encodeURIComponent(url))
            .then(res => res.json())
            .then(data => {
                document.getElementById('meta-title').value = data.title;
                document.getElementById('meta-description').value = data.description;
                document.getElementById('meta-image').value = data.image;
                document.getElementById('meta-preview').style.display = 'block';
            });
    });

    // -------------------- //
    // ?? Send Notification //
    // -------------------- //
    document.getElementById('send-notification').addEventListener('click', () => {
        const payload = {
            action: 'wpfp_send_notification',
            title: document.getElementById('meta-title').value,
            description: document.getElementById('meta-description').value,
            image: document.getElementById('meta-image').value,
            _ajax_nonce: WPFirebase.nonce
        };
        fetch(WPFirebase.ajax_url, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: new URLSearchParams(payload)
        }).then(res => res.text()).then(alert);
    });
});
