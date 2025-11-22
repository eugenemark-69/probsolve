<?php
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
    $stmt = $db->prepare("
        SELECT s.*, u.username, u.profile_picture
        FROM solutions s
        JOIN users u ON s.solver_id = u.id
        WHERE s.problem_id = ?
        ORDER BY s.is_accepted DESC, s.submitted_at DESC
    ");
    $stmt->execute([$problemId]);
    $solutions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['success' => true, 'solutions' => $solutions]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
