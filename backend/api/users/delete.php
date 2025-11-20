<?php
require_once '../../middleware/auth-check.php';
require_once '../../classes/User.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
$user = getAuthenticatedUser();
$userObj = new User();
$result = $userObj->delete($user['id']);
if ($result) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to delete user']);
}
