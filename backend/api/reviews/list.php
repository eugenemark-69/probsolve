<?php
require_once '../../classes/Review.php';
header('Content-Type: application/json');
$transactionId = isset($_GET['transaction_id']) ? $_GET['transaction_id'] : null;
$review = new Review();
echo json_encode($review->listAll($transactionId));
