<?php
require_once '../../classes/Message.php';
header('Content-Type: application/json');
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing message id']);
    exit;
}
$message = new Message();
echo json_encode($message->get($_GET['id']));
