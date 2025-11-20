<?php
require_once '../../classes/Solution.php';
header('Content-Type: application/json');
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing solution id']);
    exit;
}
$solution = new Solution();
echo json_encode($solution->get($_GET['id']));
