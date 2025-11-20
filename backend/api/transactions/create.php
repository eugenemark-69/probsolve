<?php
require_once '../../classes/Transaction.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
$data = json_decode(file_get_contents('php://input'), true);
$transaction = new Transaction();
$result = $transaction->create($data);
if ($result) {
    http_response_code(201);
    echo json_encode(['success' => true, 'transaction_id' => $result]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create transaction']);
}
