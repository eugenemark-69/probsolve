<?php
require_once '../../middleware/auth-check.php';
require_once '../../middleware/admin-check.php';
require_once '../../classes/User.php';
header('Content-Type: application/json');
requireAdmin();

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'] ?? '';
    $userId = $data['user_id'] ?? null;

    if ($action && $userId) {
        switch ($action) {
            case 'ban':
                $result = $user->banUser($userId);
                break;
            case 'unban':
                $result = $user->unbanUser($userId);
                break;
            case 'delete':
                $result = $user->deleteUser($userId);
                break;
            default:
                $result = ['success' => false, 'message' => 'Invalid action'];
        }
        echo json_encode($result);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($user->listAll());
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
