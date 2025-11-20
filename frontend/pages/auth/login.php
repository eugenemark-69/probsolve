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
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="your@email.com" required>
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
    const demoButtons = document.querySelectorAll('.demo-login');

    // Demo login functionality
    demoButtons.forEach(button => {
        button.addEventListener('click', function() {
            const role = this.getAttribute('data-role');
            const credentials = {
                'asker': { email: 'demo_asker@probsolve.com', password: 'demo123' },
                'solver': { email: 'demo_solver@probsolve.com', password: 'demo123' }
            };

            document.getElementById('email').value = credentials[role].email;
            document.getElementById('password').value = credentials[role].password;
            
            // Simulate form submission
            setTimeout(() => {
                alert(`Logging in as ${role} demo user...`);
                window.location.href = role === 'asker' ? 
                    '/probsolve/frontend/pages/asker/dashboard.php' : 
                    '/probsolve/frontend/pages/solver/dashboard.php';
            }, 1000);
        });
    });

    // Form submission
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Add your login logic here
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        
        // Simulate login process
        console.log('Login attempt:', { email, password });
        
        // For demo purposes, redirect to appropriate dashboard
        if (email.includes('asker')) {
            window.location.href = '/probsolve/frontend/pages/asker/dashboard.php';
        } else if (email.includes('solver')) {
            window.location.href = '/probsolve/frontend/pages/solver/dashboard.php';
        } else {
            // Default redirect
            window.location.href = '/probsolve/frontend/pages/asker/dashboard.php';
        }
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