<?php include_once '../../includes/header.php'; ?>
<div class="flex flex-col items-center justify-center min-h-[60vh]">
    <h2 class="text-3xl font-semibold mb-2 text-blue-700">Create Your Account</h2>
    <form id="registerForm" class="w-full max-w-sm bg-white rounded shadow p-6 mt-4">
        <div class="mb-4">
            <label class="block mb-1 font-medium">Username</label>
            <input type="text" name="username" id="regUsername" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" id="regEmail" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Password</label>
            <input type="password" name="password" id="regPassword" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-full">Sign Up</button>
        <div id="regError" class="alert alert-danger mt-3 d-none"></div>
        <div id="regSuccess" class="alert alert-success mt-3 d-none"></div>
        <div class="text-center mt-3">
            <a href="/probsolve/frontend/pages/auth/login.php" class="text-blue-600 hover:underline">Already have an account? Login</a>
        </div>
    </form>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('regUsername').value;
    const email = document.getElementById('regEmail').value;
    const password = document.getElementById('regPassword').value;
    const errorEl = document.getElementById('regError');
    const successEl = document.getElementById('regSuccess');
    
    errorEl.classList.add('d-none');
    successEl.classList.add('d-none');
    
    fetch('/probsolve/backend/api/auth/register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, email, password, role: 'asker' })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            successEl.textContent = data.message || 'Account created! Redirecting to login...';
            successEl.classList.remove('d-none');
            setTimeout(() => window.location.href = '/probsolve/frontend/pages/auth/login.php', 2000);
        } else {
            errorEl.textContent = data.error || 'Registration failed';
            errorEl.classList.remove('d-none');
        }
    })
    .catch(err => {
        errorEl.textContent = 'Error: ' + err.message;
        errorEl.classList.remove('d-none');
    });
});
</script>
<?php include_once '../../includes/footer.php'; ?>
