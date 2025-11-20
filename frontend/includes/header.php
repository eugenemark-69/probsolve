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
</head>
<body>
<header class="sticky-top bg-white shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/probsolve/index.php">
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
                        <!-- User is logged in -->
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-2"></i>
                                <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
                            </button>
                            <ul class="dropdown-menu">
                                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'asker'): ?>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/asker/dashboard.php">Asker Dashboard</a></li>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/asker/my-problems.php">My Problems</a></li>
                                <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] === 'solver'): ?>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/solver/dashboard.php">Solver Dashboard</a></li>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/solver/my-solutions.php">My Solutions</a></li>
                                <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/admin/dashboard.php">Admin Dashboard</a></li>
                                    <li><a class="dropdown-item" href="/probsolve/frontend/pages/admin/moderation.php">Moderation</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/probsolve/frontend/pages/auth/logout.php">Logout</a></li>
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

<?php
// Include authentication modals for non-logged-in users
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    include __DIR__ . '/modals/auth.php';
}
?>

<!-- Bootstrap JS (for navbar toggling, dropdowns, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>