<?php include_once '../../includes/header.php'; ?>
<div class="flex flex-col items-center justify-center min-h-[60vh]">
    <h2 class="text-3xl font-semibold mb-2 text-blue-700">Create Your Account</h2>
    <form class="w-full max-w-sm bg-white rounded shadow p-6 mt-4" method="POST" action="/backend/api/auth/register.php">
        <div class="mb-4">
            <label class="block mb-1 font-medium">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-full">Sign Up</button>
        <div class="text-center mt-3">
            <a href="/pages/auth/login.php" class="text-blue-600 hover:underline">Already have an account? Login</a>
        </div>
    </form>
</div>
<?php include_once '../../includes/footer.php'; ?>
