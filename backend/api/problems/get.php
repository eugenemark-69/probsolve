<?php
// Get a single problem
require_once '../../classes/Problem.php';
header('Content-Type: application/json');
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing problem id']);
    exit;
}
$problem = new Problem();
echo json_encode($problem->get($_GET['id']));
