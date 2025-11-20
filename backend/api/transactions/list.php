<?php
require_once '../../classes/Transaction.php';
header('Content-Type: application/json');
$transaction = new Transaction();
echo json_encode($transaction->listAll());
