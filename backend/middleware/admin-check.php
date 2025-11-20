<?php
function requireAdmin() {
    $user = getAuthenticatedUser();
    if ($user['role'] !== 'admin') {
        http_response_code(403);
        echo json_encode(['error' => 'Admin access required']);
        exit;
    }
}
