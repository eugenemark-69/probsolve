<?php
require_once '../../classes/User.php';
header('Content-Type: application/json');
$user = new User();
echo json_encode($user->listAll());
