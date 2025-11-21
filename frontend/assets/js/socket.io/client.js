// frontend/assets/js/socket.io/client.js
// Socket.io client for live chat and notifications

// Load Socket.io from CDN if not bundled
if (typeof io === 'undefined') {
    const script = document.createElement('script');
    script.src = 'https://cdn.socket.io/4.7.4/socket.io.min.js';
    script.onload = initializeSocketConnection;
    document.head.appendChild(script);
} else {
    initializeSocketConnection();
}

function initializeSocketConnection() {
    if (typeof io === 'undefined') return;
    const socket = io('http://localhost:3000'); // Adjust port if needed

    // Listen for chat messages
    socket.on('chat_message', function(data) {
        window.showNotification(`New message from ${data.sender}: ${data.message}`, 'info');
        // Optionally update chat modal
        // Update header unread badge if present
        try {
            const btn = document.getElementById('header-user-btn');
            if (btn) {
                let badge = btn.querySelector('.badge');
                if (!badge) {
                    badge = document.createElement('span');
                    badge.className = 'badge bg-danger ms-2';
                    badge.textContent = '1';
                    btn.appendChild(badge);
                } else {
                    badge.textContent = String(parseInt(badge.textContent || '0') + 1);
                }
            }
        } catch (e) {
            // ignore
        }
    });

    // Listen for notifications
    socket.on('notification', function(data) {
        window.showNotification(data.message, data.type || 'info');
        // Increment header badge
        try {
            const btn = document.getElementById('header-user-btn');
            if (btn) {
                let badge = btn.querySelector('.badge');
                if (!badge) {
                    badge = document.createElement('span');
                    badge.className = 'badge bg-danger ms-2';
                    badge.textContent = '1';
                    btn.appendChild(badge);
                } else {
                    badge.textContent = String(parseInt(badge.textContent || '0') + 1);
                }
            }
        } catch (e) {
            // ignore
        }
    });

    // Listen for real-time problem/solution updates
    socket.on('problem_update', function(data) {
        window.showNotification(`Problem updated: ${data.title}`, 'primary');
        // Optionally refresh problem feed
    });
    socket.on('solution_submitted', function(data) {
        window.showNotification(`New solution submitted for: ${data.problemTitle}`, 'success');
        // Optionally refresh solution list
    });
}
