<?php
require_once '../../middleware/auth-check.php';
require_once '../../classes/Transaction.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}
$user = getAuthenticatedUser();
$data = json_decode(file_get_contents('php://input'), true);
// TODO: Simulate payment and create escrow transaction
$transaction = new Transaction();
$result = $transaction->create($data);
if ($result) {
    echo json_encode(['success' => true, 'transaction_id' => $result]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Payment simulation failed']);
}
