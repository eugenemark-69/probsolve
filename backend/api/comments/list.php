<?php
// Get comments for a problem
require_once '../../config/database.php';
header('Content-Type: application/json');

$problemId = $_GET['problem_id'] ?? null;

if (!$problemId) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing problem_id']);
    exit;
}

try {
    $db = Database::getConnection();
    if (!$db) {
        throw new Exception('Database connection failed');
    }
    
    $stmt = $db->prepare("
        SELECT c.id, c.problem_id, c.user_id, c.content, c.likes_count, c.created_at, c.updated_at, u.username, u.profile_picture
        FROM comments c
        JOIN users u ON c.user_id = u.id
        WHERE c.problem_id = ?
        ORDER BY c.created_at DESC
    ");
    $stmt->execute([$problemId]);
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("Found " . count($comments) . " comments for problem " . $problemId);
    
    echo json_encode(['success' => true, 'comments' => $comments ?: []]);
} catch (Exception $e) {
    error_log('Comments list error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
