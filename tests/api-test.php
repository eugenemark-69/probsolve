<?php
/**
 * API Test Page - Test signup/login directly
 * Visit: http://localhost/probsolve/api-test.php
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probsolve API Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; background: #f5f5f5; }
        .card { margin: 20px 0; }
        pre { background: #f8f9fa; padding: 15px; border-radius: 5px; max-height: 400px; overflow-y: auto; }
        .success { color: #28a745; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>Probsolve API Test</h1>
    
    <div class="card">
        <div class="card-header">
            <h5>Test Signup (Register)</h5>
        </div>
        <div class="card-body">
            <form id="testSignupForm">
                <div class="mb-3">
                    <label>Username:</label>
                    <input type="text" id="signupUsername" class="form-control" value="testuser<?php echo time(); ?>">
                </div>
                <div class="mb-3">
                    <label>Email:</label>
                    <input type="email" id="signupEmail" class="form-control" value="test<?php echo time(); ?>@example.com">
                </div>
                <div class="mb-3">
                    <label>Password (min 4 chars):</label>
                    <input type="password" id="signupPassword" class="form-control" value="test123">
                </div>
                <button type="button" class="btn btn-primary" onclick="testSignup()">Test Signup</button>
            </form>
            <hr>
            <div id="signupResult"></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Test Login</h5>
        </div>
        <div class="card-body">
            <form id="testLoginForm">
                <div class="mb-3">
                    <label>Username:</label>
                    <input type="text" id="loginUsername" class="form-control" placeholder="Enter username from signup above">
                </div>
                <div class="mb-3">
                    <label>Password:</label>
                    <input type="password" id="loginPassword" class="form-control" placeholder="Enter password from signup above">
                </div>
                <button type="button" class="btn btn-primary" onclick="testLogin()">Test Login</button>
            </form>
            <hr>
            <div id="loginResult"></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Database Status</h5>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-info" onclick="checkDatabase()">Check Database</button>
            <hr>
            <div id="dbResult"></div>
        </div>
    </div>
</div>

<script>
async function testSignup() {
    const username = document.getElementById('signupUsername').value;
    const email = document.getElementById('signupEmail').value;
    const password = document.getElementById('signupPassword').value;
    const resultDiv = document.getElementById('signupResult');
    
    resultDiv.innerHTML = '<p>Loading...</p>';
    
    try {
        const response = await fetch('/probsolve/backend/api/auth/register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'include',
            body: JSON.stringify({ username, email, password })
        });
        
        const data = await response.json();
        
        if (data.success) {
            resultDiv.innerHTML = `
                <div class="alert alert-success">
                    <span class="success">✓ Signup Successful!</span>
                    <pre>${JSON.stringify(data, null, 2)}</pre>
                </div>
            `;
        } else {
            resultDiv.innerHTML = `
                <div class="alert alert-danger">
                    <span class="error">✗ Signup Failed</span>
                    <pre>${JSON.stringify(data, null, 2)}</pre>
                </div>
            `;
        }
    } catch (error) {
        resultDiv.innerHTML = `
            <div class="alert alert-danger">
                <span class="error">✗ Error:</span>
                <pre>${error.message}</pre>
            </div>
        `;
    }
}

async function testLogin() {
    const username = document.getElementById('loginUsername').value;
    const password = document.getElementById('loginPassword').value;
    const resultDiv = document.getElementById('loginResult');
    
    if (!username || !password) {
        resultDiv.innerHTML = '<div class="alert alert-warning">Please enter username and password</div>';
        return;
    }
    
    resultDiv.innerHTML = '<p>Loading...</p>';
    
    try {
        const response = await fetch('/probsolve/backend/api/auth/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'include',
            body: JSON.stringify({ username, password })
        });
        
        const data = await response.json();
        
        if (data.success) {
            resultDiv.innerHTML = `
                <div class="alert alert-success">
                    <span class="success">✓ Login Successful!</span>
                    <pre>${JSON.stringify(data, null, 2)}</pre>
                </div>
            `;
        } else {
            resultDiv.innerHTML = `
                <div class="alert alert-danger">
                    <span class="error">✗ Login Failed</span>
                    <pre>${JSON.stringify(data, null, 2)}</pre>
                </div>
            `;
        }
    } catch (error) {
        resultDiv.innerHTML = `
            <div class="alert alert-danger">
                <span class="error">✗ Error:</span>
                <pre>${error.message}</pre>
            </div>
        `;
    }
}

async function checkDatabase() {
    const resultDiv = document.getElementById('dbResult');
    resultDiv.innerHTML = '<p>Loading...</p>';
    
    try {
        const response = await fetch('/probsolve/test-setup.php');
        const html = await response.text();
        resultDiv.innerHTML = html;
    } catch (error) {
        resultDiv.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
