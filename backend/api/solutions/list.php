<?php
require_once '../../classes/Solution.php';
header('Content-Type: application/json');
$solution = new Solution();
echo json_encode($solution->listAll());
