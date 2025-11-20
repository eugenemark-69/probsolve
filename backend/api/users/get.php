<?php
require_once '../../classes/User.php';
header('Content-Type: application/json');
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing user id']);
    exit;
}
$user = new User();
echo json_encode($user->get($_GET['id']));
