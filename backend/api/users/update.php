<?php
require_once '../../middleware/auth-check.php';
require_once '../../classes/User.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
$user = getAuthenticatedUser();
$data = json_decode(file_get_contents('php://input'), true);
$userObj = new User();
$result = $userObj->update($user['id'], $data);
if ($result) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to update user']);
}
