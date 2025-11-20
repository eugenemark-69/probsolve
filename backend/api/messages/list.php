<?php
require_once '../../classes/Message.php';
header('Content-Type: application/json');
$problemId = isset($_GET['problem_id']) ? $_GET['problem_id'] : null;
$message = new Message();
echo json_encode($message->listAll($problemId));
