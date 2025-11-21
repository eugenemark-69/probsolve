<?php
require_once '../../classes/User.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

// Log incoming request for debugging
error_log('Register request: ' . json_encode($data));

// Validate required fields
if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
    http_response_code(400);
    $response = ['error' => 'Missing required fields: username, email, password'];
    error_log('Register validation failed: ' . json_encode($response));
    echo json_encode($response);
    exit;
}

// Validate email format
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    $response = ['error' => 'Invalid email format'];
    error_log('Email validation failed: ' . $data['email']);
    echo json_encode($response);
    exit;
}

// Password must be at least 4 characters (as requested)
if (strlen($data['password']) < 4) {
    http_response_code(400);
    $response = ['error' => 'Password must be at least 4 characters'];
    error_log('Password length validation failed');
    echo json_encode($response);
    exit;
}

// Try to create user
$user = new User();
$result = $user->create($data);

if ($result) {
    error_log('User created successfully: ' . $data['username'] . ' (ID: ' . $result . ')');
    echo json_encode([
        'success' => true,
        'user_id' => $result,
        'message' => 'Signup successful! Please log in with your credentials.'
    ]);
} else {
    http_response_code(400);
    $response = ['error' => 'Username or email already exists. Please use different credentials.'];
    error_log('User creation failed - duplicate or other error: ' . $data['username']);
    echo json_encode($response);
}
?>
