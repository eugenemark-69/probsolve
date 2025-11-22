<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /frontend/pages/auth/login.php');
    exit;
}
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Notifications</h1>
            <hr>
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Notifications will appear here.
            </div>
            
            <div id="notifications-list">
                <!-- Notifications will be loaded here via AJAX -->
                <p class="text-muted">No new notifications</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load notifications from API
    fetch('/backend/api/messages/list.php', { credentials: 'same-origin' })
        .then(r => r.json())
        .then(data => {
            if (data && data.messages && data.messages.length > 0) {
                const list = document.getElementById('notifications-list');
                list.innerHTML = '';
                data.messages.forEach(msg => {
                    const div = document.createElement('div');
                    div.className = 'alert alert-primary';
                    div.innerHTML = `
                        <strong>${msg.from_user}</strong>: ${msg.content}
                        <br><small class="text-muted">${msg.sent_at}</small>
                    `;
                    list.appendChild(div);
                });
            }
        })
        .catch(err => console.error('Error loading notifications:', err));
});
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
