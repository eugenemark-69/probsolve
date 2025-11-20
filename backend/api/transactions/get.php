<?php
require_once '../../classes/Transaction.php';
header('Content-Type: application/json');
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing transaction id']);
    exit;
}
$transaction = new Transaction();
echo json_encode($transaction->get($_GET['id']));
