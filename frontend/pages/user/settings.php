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
            <h1>Settings</h1>
            <hr>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Account Settings</h5>
                </div>
                <div class="card-body">
                    <form id="settings-form">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>" disabled>
                            <small class="text-muted">Username cannot be changed</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Change Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter new password">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Privacy & Security</h5>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="privateProfile">
                        <label class="form-check-label" for="privateProfile">
                            Make profile private
                        </label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                        <label class="form-check-label" for="emailNotifications">
                            Receive email notifications
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="card text-danger">
                <div class="card-header bg-danger text-white">
                    <h5>Danger Zone</h5>
                </div>
                <div class="card-body">
                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete Account</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Delete Account</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger"><strong>Warning:</strong> This action cannot be undone. All your data will be permanently deleted.</p>
                <p>Are you sure you want to delete your account?</p>
                <input type="password" class="form-control" id="delete-password" placeholder="Enter your password to confirm">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="deleteAccount()">Delete Account</button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('settings-form').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Settings saved (placeholder - implement API call)');
});

function deleteAccount() {
    const password = document.getElementById('delete-password').value;
    if (!password) {
        alert('Please enter your password');
        return;
    }
    if (confirm('Are you absolutely sure? This cannot be undone.')) {
        // API call to delete account
        alert('Account deletion not yet implemented');
    }
}
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
