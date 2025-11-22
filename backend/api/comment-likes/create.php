<?php
// Like a comment
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['comment_id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing comment_id']);
    exit;
}

try {
    $db = Database::getConnection();
    
    // Check if already liked
    $checkStmt = $db->prepare("SELECT id FROM comment_likes WHERE comment_id = ? AND user_id = ?");
    $checkStmt->execute([$data['comment_id'], $_SESSION['user_id']]);
    
    if ($checkStmt->fetch()) {
        // Unlike
        $stmt = $db->prepare("DELETE FROM comment_likes WHERE comment_id = ? AND user_id = ?");
        $stmt->execute([$data['comment_id'], $_SESSION['user_id']]);
        
        $updateStmt = $db->prepare("UPDATE comments SET likes_count = likes_count - 1 WHERE id = ?");
        $updateStmt->execute([$data['comment_id']]);
    } else {
        // Like
        $stmt = $db->prepare("INSERT INTO comment_likes (comment_id, user_id) VALUES (?, ?)");
        $stmt->execute([$data['comment_id'], $_SESSION['user_id']]);
        
        $updateStmt = $db->prepare("UPDATE comments SET likes_count = likes_count + 1 WHERE id = ?");
        $updateStmt->execute([$data['comment_id']]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Comment like toggled']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
