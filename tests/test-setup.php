<?php
// Quick test file to verify database and signup flow
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'backend/config/database.php';
require_once 'backend/classes/User.php';

echo "<h1>Probsolve Setup Test</h1>";

// Test 1: Database connection
echo "<h2>1. Database Connection Test</h2>";
$db = Database::getConnection();
if ($db) {
    echo "✓ Database connected successfully<br>";
    
    // Check users table
    $result = $db->query('SELECT COUNT(*) as count FROM users');
    $row = $result->fetch();
    echo "✓ Users table exists with " . $row['count'] . " user(s)<br>";
} else {
    echo "✗ Database connection failed<br>";
    exit;
}

// Test 2: Create test user
echo "<h2>2. User Creation Test</h2>";
$testData = [
    'username' => 'testuser_' . time(),
    'email' => 'test_' . time() . '@example.com',
    'password' => 'test1234',
    'role' => 'asker'
];

$user = new User();
$userId = $user->create($testData);

if ($userId) {
    echo "✓ User created successfully! ID: " . $userId . "<br>";
    echo "  Username: " . $testData['username'] . "<br>";
    echo "  Email: " . $testData['email'] . "<br>";
} else {
    echo "✗ User creation failed<br>";
}

// Test 3: Verify password
echo "<h2>3. Password Verification Test</h2>";
if ($userId) {
    if ($user->verifyPassword($testData['username'], $testData['password'])) {
        echo "✓ Password verification successful<br>";
    } else {
        echo "✗ Password verification failed<br>";
    }
}

// Test 4: Duplicate check
echo "<h2>4. Duplicate Email Check Test</h2>";
$duplicateData = [
    'username' => 'anotheruser_' . time(),
    'email' => $testData['email'], // Same email as above
    'password' => 'test1234'
];

$duplicateUserId = $user->create($duplicateData);
if (!$duplicateUserId) {
    echo "✓ Duplicate email correctly rejected<br>";
} else {
    echo "✗ Duplicate email was NOT rejected (security issue!)<br>";
}

echo "<h2>Summary</h2>";
echo "<p>If all tests passed, signup/login should work in the UI.</p>";
echo "<p><a href='frontend/pages/public/index.php'>Go to home page</a></p>";
?>
