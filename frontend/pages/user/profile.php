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
            <h1>My Profile</h1>
            <hr>
            
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 text-center">
                            <img src="https://via.placeholder.com/150" alt="Profile" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-md-9">
                            <h3><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></h3>
                            <p class="text-muted">Role: <span class="badge bg-primary"><?php echo htmlspecialchars($_SESSION['role'] ?? 'User'); ?></span></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email'] ?? 'Not set'); ?></p>
                            <p><strong>Member Since:</strong> <span id="member-since">Loading...</span></p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h4>Statistics</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 id="problems-count">0</h5>
                                    <p class="text-muted">Problems Posted</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 id="solutions-count">0</h5>
                                    <p class="text-muted">Solutions Submitted</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 id="rating-count">0.0</h5>
                                    <p class="text-muted">Average Rating</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 id="earnings">₱0.00</h5>
                                    <p class="text-muted">Total Earnings</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load user profile data
    fetch('/backend/api/user/header-info.php', { credentials: 'same-origin' })
        .then(r => r.json())
        .then(data => {
            if (data.wallet_balance) {
                document.getElementById('earnings').textContent = '₱' + Number(data.wallet_balance).toFixed(2);
            }
        })
        .catch(err => console.error('Error loading profile:', err));
});
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
