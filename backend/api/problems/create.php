<?php
// Create a new problem
require_once '../../middleware/auth-check.php';
require_once '../../classes/Problem.php';
require_once '../../functions/validation.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
$user = getAuthenticatedUser();
$data = json_decode(file_get_contents('php://input'), true);
$validated = validateProblemData($data);
if (!$validated['valid']) {
    http_response_code(400);
    echo json_encode(['error' => $validated['error']]);
    exit;
}
$problem = new Problem();
$result = $problem->create($user['id'], $data);
if ($result) {
    http_response_code(201);
    echo json_encode(['success' => true, 'problem_id' => $result]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create problem']);
}
