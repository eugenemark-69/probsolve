<?php
require_once '../../classes/User.php';
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

// Log request
error_log('Login attempt for username: ' . ($data['username'] ?? 'unknown'));

// Validate input
if (empty($data['username']) || empty($data['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and password required']);
    exit;
}

$user = new User();
$userRecord = $user->getByUsername($data['username']);

if (!$userRecord) {
    http_response_code(401);
    error_log('Login failed: user not found - ' . $data['username']);
    echo json_encode(['error' => 'Invalid username or password']);
    exit;
}

// Verify password
if (!password_verify($data['password'], $userRecord['password_hash'])) {
    http_response_code(401);
    error_log('Login failed: password mismatch for - ' . $data['username']);
    echo json_encode(['error' => 'Invalid username or password']);
    exit;
}

// Set session
$_SESSION['user_id'] = $userRecord['id'];
$_SESSION['username'] = $userRecord['username'];
$_SESSION['role'] = $userRecord['role'];
$_SESSION['email'] = $userRecord['email'];

error_log('Login successful for user: ' . $data['username']);

echo json_encode([
    'success' => true,
    'message' => 'Login successful!',
    'user' => [
        'id' => $userRecord['id'],
        'username' => $userRecord['username'],
        'role' => $userRecord['role'],
        'email' => $userRecord['email']
    ]
]);

?>
