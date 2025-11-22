<!-- frontend/pages/auth/login.php -->
<?php 
$page_title = "Login - Probsolve";
include '../../includes/header.php'; 
?>

<div class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <!-- Logo and Header -->
                        <div class="text-center mb-4">
                            <a href="/probsolve/index.php" class="text-decoration-none">
                                <i class="fas fa-lightbulb fa-2x text-primary mb-3"></i>
                                <h3 class="fw-bold text-primary">Probsolve</h3>
                            </a>
                            <p class="text-muted">Sign in to your account</p>
                        </div>

                        <!-- Login Form -->
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username *</label>
                                <input type="text" class="form-control" id="username" name="username" 
                                       placeholder="your username" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password *</label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Enter your password" required>
                                <div class="form-text text-end">
                                    <a href="#" class="text-decoration-none">Forgot password?</a>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>

                            <div id="loginError" class="alert alert-danger d-none mb-3"></div>
                            <div id="loginSuccess" class="alert alert-success d-none mb-3"></div>

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                            </div>
                        </form>

                        <!-- Social Login -->
                        <div class="text-center mb-4">
                            <div class="position-relative">
                                <hr>
                                <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted">
                                    Or continue with
                                </span>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button type="button" class="btn btn-outline-danger">
                                <i class="fab fa-google me-2"></i>Continue with Google
                            </button>
                            <button type="button" class="btn btn-outline-dark">
                                <i class="fab fa-apple me-2"></i>Continue with Apple
                            </button>
                        </div>

                        <!-- Registration Link -->
                        <div class="text-center">
                            <p class="mb-0">Don't have an account? 
                                <a href="/probsolve/frontend/pages/auth/register.php" class="text-primary text-decoration-none fw-bold">Sign up now</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Demo Accounts -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h6 class="card-title">Demo Accounts</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <button class="btn btn-outline-primary btn-sm w-100 demo-login" data-role="asker">
                                    Asker Demo
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-outline-success btn-sm w-100 demo-login" data-role="solver">
                                    Solver Demo
                                </button>
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
    const loginForm = document.getElementById('loginForm');

    // Form submission
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const errorEl = document.getElementById('loginError');
        const successEl = document.getElementById('loginSuccess');
        
        errorEl.classList.add('d-none');
        successEl.classList.add('d-none');
        
        fetch('/probsolve/backend/api/auth/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password }),
            credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                successEl.textContent = 'Login successful! Redirecting...';
                successEl.classList.remove('d-none');
                
                // Redirect based on role
                setTimeout(() => {
                    const role = data.user?.role;
                    if (role === 'admin') {
                        window.location.href = '/probsolve/frontend/pages/admin/dashboard.php';
                    } else {
                        window.location.href = '/probsolve/frontend/pages/dashboard.php';
                    }
                }, 1000);
            } else {
                errorEl.textContent = data.error || 'Login failed';
                errorEl.classList.remove('d-none');
            }
        })
        .catch(err => {
            errorEl.textContent = 'Error: ' + err.message;
            errorEl.classList.remove('d-none');
        });
    });
});
</script>

<style>
.bg-light {
    background-color: #f8f9fa !important;
}

.card {
    border: none;
    border-radius: 1rem;
}

.btn {
    border-radius: 0.75rem;
}

.form-control {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
}
</style>

<?php include '../../includes/footer.php'; ?>