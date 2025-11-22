<?php
// Get a single problem
require_once '../../classes/Problem.php';
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing problem id']);
    exit;
}

$problem = new Problem();
$result = $problem->get($_GET['id']);

if ($result) {
    echo json_encode(['success' => true, 'problem' => $result]);
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'Problem not found']);
}
