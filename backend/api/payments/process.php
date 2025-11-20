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
// TODO: Process payment (release/refund)
$transaction = new Transaction();
// $data['action'] = 'release' or 'refund'
if ($data['action'] === 'release') {
    // TODO: Release funds to solver
    echo json_encode(['success' => true, 'message' => 'Funds released']);
} elseif ($data['action'] === 'refund') {
    // TODO: Refund funds to asker
    echo json_encode(['success' => true, 'message' => 'Funds refunded']);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid action']);
}
