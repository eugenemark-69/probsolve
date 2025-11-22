<?php
// Like a solution
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

if (empty($data['solution_id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing solution_id']);
    exit;
}

try {
    $db = Database::getConnection();
    
    // Check if already liked
    $checkStmt = $db->prepare("SELECT id FROM solution_likes WHERE solution_id = ? AND user_id = ?");
    $checkStmt->execute([$data['solution_id'], $_SESSION['user_id']]);
    
    if ($checkStmt->fetch()) {
        // Unlike
        $stmt = $db->prepare("DELETE FROM solution_likes WHERE solution_id = ? AND user_id = ?");
        $stmt->execute([$data['solution_id'], $_SESSION['user_id']]);
        
        $updateStmt = $db->prepare("UPDATE solutions SET likes_count = likes_count - 1 WHERE id = ?");
        $updateStmt->execute([$data['solution_id']]);
    } else {
        // Like
        $stmt = $db->prepare("INSERT INTO solution_likes (solution_id, user_id) VALUES (?, ?)");
        $stmt->execute([$data['solution_id'], $_SESSION['user_id']]);
        
        $updateStmt = $db->prepare("UPDATE solutions SET likes_count = likes_count + 1 WHERE id = ?");
        $updateStmt->execute([$data['solution_id']]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Solution like toggled']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
