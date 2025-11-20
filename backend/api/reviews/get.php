<?php
require_once '../../classes/Review.php';
header('Content-Type: application/json');
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing review id']);
    exit;
}
$review = new Review();
echo json_encode($review->get($_GET['id']));
