<?php
// backend/api/user/header-info.php
// Returns header-related user info as JSON (used by frontend header)
if (session_status() === PHP_SESSION_NONE) session_start();

header('Content-Type: application/json');

 $response = [
    'logged_in' => false,
    'username' => null,
    'role' => null,
    'unread_notifications' => 0,
    'wallet_balance' => 0.00
];

if (!empty($_SESSION['user_id'])) {
    $response['logged_in'] = true;
    $response['username'] = $_SESSION['username'] ?? 'User';
    $response['role'] = $_SESSION['role'] ?? 'asker';

    // Try to use Notification and Transaction helpers if available
    try {
        if (file_exists(__DIR__ . '/../../classes/Notification.php')) {
            require_once __DIR__ . '/../../classes/Notification.php';
            $n = new Notification();
            $response['unread_notifications'] = $n->countUnreadForUser((int)$_SESSION['user_id']);
        }
    } catch (Exception $e) {
        error_log('Header-info notification error: ' . $e->getMessage());
    }

    try {
        if (file_exists(__DIR__ . '/../../classes/Transaction.php')) {
            require_once __DIR__ . '/../../classes/Transaction.php';
            $t = new Transaction();
            $response['wallet_balance'] = $t->getWalletBalance((int)$_SESSION['user_id']);
        }
    } catch (Exception $e) {
        error_log('Header-info transaction error: ' . $e->getMessage());
    }
}

echo json_encode($response);
