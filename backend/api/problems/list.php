<?php
// List all problems with optional filters
require_once '../../classes/Problem.php';
header('Content-Type: application/json');

$filters = [];
if (!empty($_GET['status'])) {
    $filters['status'] = $_GET['status'];
}
if (!empty($_GET['category'])) {
    $filters['category'] = $_GET['category'];
}

$problem = new Problem();
echo json_encode($problem->listAll($filters));
