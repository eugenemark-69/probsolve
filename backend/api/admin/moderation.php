<?php
require_once '../../middleware/auth-check.php';
require_once '../../middleware/admin-check.php';
require_once '../../classes/Moderation.php';
header('Content-Type: application/json');
requireAdmin();

$moderation = new Moderation();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'] ?? '';
    $contentId = $data['content_id'] ?? null;

    if ($action && $contentId) {
        switch ($action) {
            case 'approve':
                $result = $moderation->approveContent($contentId);
                break;
            case 'reject':
                $result = $moderation->rejectContent($contentId);
                break;
            case 'flag':
                $result = $moderation->flagContent($contentId);
                break;
            default:
                $result = ['success' => false, 'message' => 'Invalid action'];
        }
        echo json_encode($result);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $queue = $moderation->getModerationQueue();
    echo json_encode($queue);
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
