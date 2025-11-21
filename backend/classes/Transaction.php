<?php
class Transaction {
    public function listAll() { return []; }
    public function create($data) { return 1; }
    public function update($transactionId, $data) { return true; }
    public function get($transactionId) { return null; }

    public function getWalletBalance($userId) {
        // Try to compute wallet balance from completed transactions
        try {
            require_once __DIR__ . '/../config/database.php';
            $db = Database::getConnection();
            if (!$db) return 0.00;

            $stmt = $db->prepare("SELECT COALESCE(SUM(amount - platform_fee),0) as balance FROM transactions WHERE solver_id = :uid AND status = 'completed'");
            $stmt->execute([':uid' => $userId]);
            $row = $stmt->fetch();
            return isset($row['balance']) ? (float)$row['balance'] : 0.00;
        } catch (Exception $e) {
            error_log('getWalletBalance error: ' . $e->getMessage());
            return 0.00;
        }
    }
}
