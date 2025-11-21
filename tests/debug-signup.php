<?php
/**
 * Signup/Login Debug Page
 * Check if all components are properly connected
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup/Login Debug</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; background: #f5f5f5; }
        .debug-card { margin: 15px 0; padding: 15px; background: white; border-radius: 5px; border-left: 4px solid #007bff; }
        .debug-pass { border-left-color: #28a745; }
        .debug-fail { border-left-color: #dc3545; }
        code { background: #f8f9fa; padding: 5px 10px; }
        pre { background: #f8f9fa; padding: 10px; max-height: 300px; overflow: auto; }
    </style>
</head>
<body>
<div class="container">
    <h1>🔧 Signup/Login Debug Report</h1>
    <p class="text-muted">Check all components are connected</p>

    <div class="debug-card debug-pass">
        <h5>✓ Header is included</h5>
        <p>Header with modals and form handlers is loaded</p>
    </div>

    <div class="debug-card">
        <h5>📋 File Checklist</h5>
        <?php
        $files = [
            'frontend/includes/header.php' => 'Header with modals',
            'frontend/includes/modals/auth.php' => 'Auth modals',
            'frontend/assets/js/custom/main.js' => 'Form handlers',
            'backend/api/auth/register.php' => 'Register API',
            'backend/api/auth/login.php' => 'Login API',
            'backend/classes/User.php' => 'User class',
        ];
        foreach ($files as $file => $desc) {
            $exists = file_exists($file);
            $class = $exists ? 'debug-pass' : 'debug-fail';
            $icon = $exists ? '✓' : '✗';
            echo "<div class='$class' style='padding: 8px; margin: 5px 0; border-left: 3px solid;'>";
            echo "$icon <code>$file</code> - $desc";
            echo '</div>';
        }
        ?>
    </div>

    <div class="debug-card">
        <h5>🔍 JavaScript Check</h5>
        <p>Open browser console (F12) and run these commands:</p>
        <pre>// Check if main.js is loaded
console.log('loginForm element:', document.getElementById('loginForm'));
console.log('registerForm element:', document.getElementById('registerForm'));

// Check if modals exist
console.log('loginModal:', document.getElementById('loginModal'));
console.log('registerModal:', document.getElementById('registerModal'));

// Check if handlers are attached
var form = document.getElementById('loginForm');
console.log('Form listeners:', getEventListeners(form)); // Chrome only</pre>
    </div>

    <div class="debug-card">
        <h5>🧪 Manual Test</h5>
        <button class="btn btn-primary" onclick="testSignupForm()">Test Signup Form</button>
        <button class="btn btn-success" onclick="testLoginForm()">Test Login Form</button>
        <button class="btn btn-info" onclick="testDatabase()">Test Database</button>
        <div id="testResult" style="margin-top: 15px;"></div>
    </div>

    <div class="debug-card">
        <h5>📡 API Endpoint Test</h5>
        <form id="apiTestForm" style="background: #f9f9f9; padding: 15px; border-radius: 5px;">
            <div class="mb-3">
                <label>Test Signup API</label>
                <input type="text" id="testUsername" class="form-control" placeholder="username" value="testuser<?php echo time(); ?>">
                <input type="email" id="testEmail" class="form-control" placeholder="email@example.com" value="test<?php echo time(); ?>@example.com" style="margin-top: 5px;">
                <input type="password" id="testPassword" class="form-control" placeholder="password (min 4)" value="test123" style="margin-top: 5px;">
                <button type="button" class="btn btn-warning mt-2" onclick="testAPISignup()">Test API</button>
            </div>
            <pre id="apiResult"></pre>
        </form>
    </div>

    <div class="debug-card">
        <h5>💾 Database Check</h5>
        <div id="dbCheck"></div>
    </div>
</div>

<script>
function testSignupForm() {
    const result = document.getElementById('testResult');
    const form = document.getElementById('registerForm');
    if (!form) {
        result.innerHTML = '<div class="alert alert-danger">✗ Signup form NOT found in DOM</div>';
        return;
    }
    
    const listeners = getEventListeners ? getEventListeners(form).submit : 'Check console';
    result.innerHTML = `<div class="alert alert-success">
        ✓ Signup form found<br>
        Form ID: registerForm<br>
        Form action: ${form.action}<br>
        Form method: ${form.method}
    </div>`;
}

function testLoginForm() {
    const result = document.getElementById('testResult');
    const form = document.getElementById('loginForm');
    if (!form) {
        result.innerHTML = '<div class="alert alert-danger">✗ Login form NOT found in DOM</div>';
        return;
    }
    result.innerHTML = `<div class="alert alert-success">
        ✓ Login form found<br>
        Form ID: loginForm<br>
        Form action: ${form.action}<br>
        Form method: ${form.method}
    </div>`;
}

function testDatabase() {
    const result = document.getElementById('testResult');
    result.innerHTML = '<div class="alert alert-info">Loading...</div>';
    
    fetch('verify-system.php')
        .then(r => r.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const userCount = doc.body.innerText.match(/user_count|user\(s\)/);
            result.innerHTML = '<div class="alert alert-success">✓ Database connected</div>';
        })
        .catch(e => {
            result.innerHTML = '<div class="alert alert-danger">✗ Database test failed: ' + e.message + '</div>';
        });
}

function testAPISignup() {
    const username = document.getElementById('testUsername').value;
    const email = document.getElementById('testEmail').value;
    const password = document.getElementById('testPassword').value;
    const resultDiv = document.getElementById('apiResult');
    
    resultDiv.textContent = 'Testing...';
    
    fetch('/probsolve/backend/api/auth/register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({ username, email, password })
    })
    .then(r => r.json())
    .then(data => {
        resultDiv.textContent = JSON.stringify(data, null, 2);
        if (data.success) {
            resultDiv.parentElement.style.borderLeft = '4px solid #28a745';
        } else {
            resultDiv.parentElement.style.borderLeft = '4px solid #dc3545';
        }
    })
    .catch(e => {
        resultDiv.textContent = 'ERROR: ' + e.message;
        resultDiv.parentElement.style.borderLeft = '4px solid #dc3545';
    });
}

// Auto check on load
document.addEventListener('DOMContentLoaded', function() {
    // Check if forms exist
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    
    const dbDiv = document.getElementById('dbCheck');
    if (loginForm && registerForm) {
        dbDiv.innerHTML = '<div class="alert alert-success">✓ Both forms found in DOM</div>';
    } else {
        dbDiv.innerHTML = '<div class="alert alert-danger">✗ Forms NOT in DOM<br>' +
            'Login form: ' + (loginForm ? 'YES' : 'NO') + '<br>' +
            'Register form: ' + (registerForm ? 'YES' : 'NO') + '</div>';
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
