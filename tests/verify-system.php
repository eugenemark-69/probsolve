<?php
/**
 * Comprehensive System Verification
 * Shows exactly what's working and what needs fixing
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Probsolve System Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 30px; background: #f5f5f5; }
        .check-item { padding: 15px; margin: 10px 0; border-radius: 5px; }
        .check-pass { background: #d4edda; border: 1px solid #c3e6cb; }
        .check-fail { background: #f8d7da; border: 1px solid #f5c6cb; }
        .check-warn { background: #fff3cd; border: 1px solid #ffeaa7; }
        h1 { margin-bottom: 30px; color: #333; }
        h3 { margin-top: 30px; margin-bottom: 15px; }
        code { background: #f8f9fa; padding: 2px 6px; border-radius: 3px; }
    </style>
</head>
<body>
<div class="container">
    <h1>🔍 Probsolve System Verification Report</h1>
    <p class="text-muted">Generated: <?php echo date('Y-m-d H:i:s'); ?></p>

    <?php
    $passes = 0;
    $fails = 0;
    $warnings = 0;

    function check($condition, $title, $pass_msg, $fail_msg = null) {
        global $passes, $fails;
        echo '<div class="check-item ';
        if ($condition) {
            echo 'check-pass';
            $passes++;
            echo '"><strong>✓ PASS:</strong> ' . $title . '<br>' . $pass_msg;
        } else {
            echo 'check-fail';
            $fails++;
            echo '"><strong>✗ FAIL:</strong> ' . $title . '<br>' . ($fail_msg ?? 'Something is wrong');
        }
        echo '</div>';
    }

    echo '<h3>1. Database Connection</h3>';
    require_once 'backend/config/database.php';
    $db = Database::getConnection();
    check($db !== null, 'Database Connection', 'Successfully connected to MySQL probsolve database', 'Could not connect - check DB_HOST, DB_USER, DB_PASS in backend/config/database.php');

    if ($db) {
        echo '<h3>2. Database Tables</h3>';
        
        $tables = ['users', 'problems', 'solutions', 'transactions', 'messages', 'reviews'];
        foreach ($tables as $table) {
            try {
                $result = $db->query("SELECT 1 FROM $table LIMIT 1");
                check(true, "Table: $table", "Table exists and is accessible");
            } catch (Exception $e) {
                check(false, "Table: $table", "", "Table does not exist - run: mysql -u root < database/schema/probsolve_schema.sql");
            }
        }

        echo '<h3>3. Users Data</h3>';
        try {
            $result = $db->query("SELECT COUNT(*) as count FROM users");
            $row = $result->fetch();
            $userCount = $row['count'];
            check($userCount >= 1, 'Admin User Exists', "Found $userCount user(s) in database", "No users found - database might not be initialized");

            if ($userCount > 0) {
                $users = $db->query("SELECT id, username, email, role FROM users LIMIT 10")->fetchAll();
                echo '<div class="alert alert-info"><strong>Users in Database:</strong><br>';
                echo '<table class="table table-sm"><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th></tr>';
                foreach ($users as $user) {
                    echo '<tr><td>' . $user['id'] . '</td><td>' . $user['username'] . '</td><td>' . $user['email'] . '</td><td><span class="badge bg-secondary">' . $user['role'] . '</span></td></tr>';
                }
                echo '</table></div>';
            }
        } catch (Exception $e) {
            check(false, 'Users Query', '', 'Could not query users table: ' . $e->getMessage());
        }
    }

    echo '<h3>4. File Structure</h3>';
    $files = [
        'backend/api/auth/register.php' => 'Register endpoint',
        'backend/api/auth/login.php' => 'Login endpoint',
        'backend/classes/User.php' => 'User class',
        'backend/config/database.php' => 'Database config',
        'frontend/includes/modals/auth.php' => 'Auth modals',
        'frontend/includes/header.php' => 'Header with modals',
        'frontend/assets/js/custom/main.js' => 'Form handlers',
    ];

    foreach ($files as $file => $desc) {
        $exists = file_exists($file);
        check($exists, "$desc", "File exists: <code>$file</code>", "Missing file: $file");
    }

    echo '<h3>5. Backend API Validation</h3>';
    
    // Check register endpoint
    $registerFile = 'backend/api/auth/register.php';
    if (file_exists($registerFile)) {
        $content = file_get_contents($registerFile);
        check(
            strpos($content, 'PASSWORD_BCRYPT') !== false,
            'Password Hashing',
            'Using bcrypt password hashing ✓',
            'Missing bcrypt password hashing'
        );
        check(
            strpos($content, 'password_hash') !== false && strlen($content) > 500,
            'Register Logic',
            'Register endpoint has full implementation ✓',
            'Register endpoint appears incomplete'
        );
        check(
            strpos($content, 'is_verified') !== false,
            'User Verification Field',
            'Checking user verification field ✓',
            'Missing verification handling'
        );
    }

    // Check login endpoint
    $loginFile = 'backend/api/auth/login.php';
    if (file_exists($loginFile)) {
        $content = file_get_contents($loginFile);
        check(
            strpos($content, 'password_verify') !== false,
            'Password Verification',
            'Using password_verify for authentication ✓',
            'Missing password verification'
        );
        check(
            strpos($content, 'SESSION') !== false && strlen($content) > 500,
            'Login Logic',
            'Login endpoint has full implementation ✓',
            'Login endpoint appears incomplete'
        );
    }

    echo '<h3>6. Frontend Handlers</h3>';
    $jsFile = 'frontend/assets/js/custom/main.js';
    if (file_exists($jsFile)) {
        $content = file_get_contents($jsFile);
        check(
            strpos($content, 'loginForm') !== false && strpos($content, 'registerForm') !== false,
            'Form Event Handlers',
            'Both login and register form handlers present ✓',
            'Missing form event handlers'
        );
        check(
            strpos($content, 'showNotification') !== false,
            'Notification System',
            'Notification system being used ✓',
            'Missing notification calls'
        );
        check(
            strpos($content, 'password.length < 4') !== false,
            'Password Validation (4 chars)',
            'Frontend validates minimum 4 character password ✓',
            'Missing frontend password validation'
        );
    }

    echo '<h3>7. Test Credentials</h3>';
    if ($db) {
        try {
            $stmt = $db->prepare("SELECT username FROM users WHERE username = ? LIMIT 1");
            $stmt->execute(['admin']);
            $user = $stmt->fetch();
            if ($user) {
                echo '<div class="alert alert-info">';
                echo '<strong>Test Login:</strong><br>';
                echo 'Username: <code>admin</code><br>';
                echo 'Password: <code>admin123</code> (or your custom password)<br>';
                echo 'Note: Password hash needs to be verified manually or set via app';
                echo '</div>';
            }
        } catch (Exception $e) {}
    }

    echo '<h3>8. Quick Test</h3>';
    echo '<div class="alert alert-info">';
    echo '<strong>Test the system:</strong><br>';
    echo '1. Visit <a href="/probsolve/api-test.php" target="_blank">API Test Page</a><br>';
    echo '2. Use "Test Signup" to create a user<br>';
    echo '3. Copy username and use "Test Login" to verify<br>';
    echo '4. Visit home page and use header buttons to test UI';
    echo '</div>';

    echo '<h3>Summary</h3>';
    $total = $passes + $fails;
    $passRate = $total > 0 ? round(($passes / $total) * 100) : 0;
    echo '<div class="alert alert-';
    if ($fails === 0) echo 'success';
    elseif ($passRate >= 75) echo 'warning';
    else echo 'danger';
    echo '">';
    echo "<strong>Results: $passes passed, $fails failed</strong> ($passRate% pass rate)<br>";
    if ($fails === 0) {
        echo "🎉 All checks passed! System is ready to use.";
    } else {
        echo "⚠️ Some issues detected. Please fix the failed checks above.";
    }
    echo '</div>';
    ?>

</div>
</body>
</html>
