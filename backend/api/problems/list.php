<?php
// List all problems
require_once '../../classes/Problem.php';
header('Content-Type: application/json');
$problem = new Problem();
echo json_encode($problem->listAll());
