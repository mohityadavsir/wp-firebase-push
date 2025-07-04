document.addEventListener('DOMContentLoaded', () => {
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
