<!-- frontend/includes/header.php -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probsolve</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/frontend/assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/assets/css/custom/main.css" rel="stylesheet">
    <!-- Socket.io Client -->
    <script src="/frontend/assets/js/socket.io/client.js" defer></script>
    <style>
        .menu-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 0.65rem;
            padding: 0.25em 0.5em;
        }
    </style>
</head>
<body>
<!-- Include Auth Modals -->
<?php include __DIR__ . '/modals/auth.php'; ?>
<header class="sticky-top bg-white shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/probsolve/frontend/pages/public/index.php">
                <i class="fas fa-lightbulb me-2"></i>Probsolve
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/probsolve/frontend/pages/public/explore.php">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/probsolve/frontend/pages/public/problem-gallery.php">Problem Gallery</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
                        <!-- User Dropdown with All Options -->
                        <div class="dropdown">
                            <button id="header-user-btn" class="btn btn-outline-primary dropdown-toggle position-relative" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-2"></i>
                                <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
                                <span id="notification-badge" class="badge bg-danger menu-badge d-none">0</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" id="header-user-menu">
                                <!-- Home & About -->
                                <li><a class="dropdown-item" href="/probsolve/frontend/pages/public/index.php"><i class="fas fa-home me-2"></i>Home</a></li>
                                <li><a class="dropdown-item" href="/probsolve/frontend/pages/user/about.php"><i class="fas fa-info-circle me-2"></i>About Us</a></li>
                                <li><hr class="dropdown-divider"></li>
                                
                                <!-- Role-Specific Dashboard -->
                                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'asker'): ?>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/asker/dashboard.php"><i class="fas fa-chart-line me-2"></i>Asker Dashboard</a></li>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/asker/my-problems.php"><i class="fas fa-question-circle me-2"></i>My Problems</a></li>
                                <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] === 'solver'): ?>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/solver/dashboard.php"><i class="fas fa-chart-line me-2"></i>Solver Dashboard</a></li>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/solver/my-solutions.php"><i class="fas fa-lightbulb me-2"></i>My Solutions</a></li>
                                <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/admin/dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</a></li>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/admin/moderation.php"><i class="fas fa-gavel me-2"></i>Moderation</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                
                                <!-- User Options -->
                                <li>
                                    <a class="dropdown-item position-relative" href="/probsolve/frontend/pages/user/notifications.php">
                                        <i class="fas fa-bell me-2"></i>Notifications
                                        <span id="notification-menu-badge" class="badge bg-danger ms-2 d-none">0</span>
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="/probsolve/frontend/pages/user/profile.php"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="/probsolve/frontend/pages/user/settings.php"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                
                                <!-- Logout -->
                                <li><a class="dropdown-item text-danger" href="/probsolve/frontend/pages/auth/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- User is not logged in -->
                        <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Bootstrap JS (for navbar toggling, dropdowns, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom Main JS with form handlers -->
<script src="/probsolve/frontend/assets/js/custom/main.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fetch header info to enable dynamic badges and menu updates
    fetch('/probsolve/backend/api/user/header-info.php', { credentials: 'same-origin' })
        .then(r => r.json())
        .then(data => {
            if (!data || !data.logged_in) return;

            const btn = document.getElementById('header-user-btn');
            const menu = document.getElementById('header-user-menu');

            if (btn && data.username) {
                btn.innerHTML = '<i class="fas fa-user me-2"></i>' + (data.username);
            }

            if (menu) {
                // Don't replace the entire menu - just keep the static items
                // The menu already has all items from the HTML
                // We only update the button text if needed
            }

            // Handle notification badges
            if (data.unread_notifications && data.unread_notifications > 0) {
                // Badge on menu button
                const menuBadge = document.getElementById('notification-badge');
                if (menuBadge) {
                    menuBadge.textContent = data.unread_notifications;
                    menuBadge.classList.remove('d-none');
                }

                // Badge inside menu on Notifications item
                const notifMenuBadge = document.getElementById('notification-menu-badge');
                if (notifMenuBadge) {
                    notifMenuBadge.textContent = data.unread_notifications;
                    notifMenuBadge.classList.remove('d-none');
                }

                // Badge on user button (if you want to keep this)
                const badge = document.createElement('span');
                badge.className = 'badge bg-danger ms-2';
                badge.textContent = data.unread_notifications;
                if (btn && !btn.querySelector('.badge')) btn.appendChild(badge);
            }

            // Display wallet balance
            if (typeof data.wallet_balance !== 'undefined') {
                const bal = document.createElement('span');
                bal.className = 'ms-3 text-muted small';
                bal.textContent = '₱' + Number(data.wallet_balance).toFixed(2);
                if (btn && !btn.parentElement.querySelector('.wallet-balance')) {
                    bal.classList.add('wallet-balance');
                    btn.parentElement.appendChild(bal);
                }
            }
        })
        .catch(err => {
            console.error('Header info fetch error:', err);
        });
});
</script>
</body>
</html>