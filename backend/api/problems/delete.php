<?php
// Delete a problem
require_once '../../middleware/auth-check.php';
require_once '../../classes/Problem.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
$user = getAuthenticatedUser();
$data = json_decode(file_get_contents('php://input'), true);
$problem = new Problem();
$result = $problem->delete($user['id'], $data['problem_id']);
if ($result) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to delete problem']);
}
