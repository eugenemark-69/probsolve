<?php
require_once '../../classes/User.php';
require_once '../../functions/validation.php';
session_start();
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
$data = json_decode(file_get_contents('php://input'), true);
// TODO: Validate credentials and fetch user
// For now, mock user
if ($data['username'] === 'demo' && $data['password'] === 'demo') {
    $_SESSION['user'] = [
        'id' => 1,
        'role' => 'asker',
        'username' => 'demo_user'
    ];
    echo json_encode(['success' => true, 'user' => $_SESSION['user']]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid credentials']);
}
