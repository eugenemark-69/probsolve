<?php
// backend/classes/Notification.php
class Notification {
    // Count unread notifications for a user. This function is defensive: if a notifications
    // table doesn't exist or the schema is different, it falls back to 0.
    public function countUnreadForUser($userId) {
        try {
            require_once __DIR__ . '/../config/database.php';
            $db = Database::getConnection();
            if (!$db) return 0;

            // Prefer a dedicated notifications table if it exists
            $stmt = $db->prepare("SELECT COUNT(*) as cnt FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'notifications'");
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row && isset($row['cnt']) && $row['cnt'] > 0) {
                $q = $db->prepare("SELECT COUNT(*) as unread FROM notifications WHERE user_id = :uid AND is_read = 0");
                $q->execute([':uid' => $userId]);
                $r = $q->fetch();
                return isset($r['unread']) ? (int)$r['unread'] : 0;
            }

            // Fall back to messages table: try to count unread messages if is_read column exists
            $stmt = $db->prepare("SELECT COUNT(*) as cnt FROM information_schema.columns WHERE table_schema = DATABASE() AND table_name = 'messages' AND column_name = 'is_read'");
            $stmt->execute();
            $col = $stmt->fetch();
            if ($col && isset($col['cnt']) && $col['cnt'] > 0) {
                $q = $db->prepare("SELECT COUNT(*) as unread FROM messages WHERE to_user = :uid AND is_read = 0");
                $q->execute([':uid' => $userId]);
                $r = $q->fetch();
                return isset($r['unread']) ? (int)$r['unread'] : 0;
            }

            return 0;
        } catch (Exception $e) {
            error_log('countUnreadForUser error: ' . $e->getMessage());
            return 0;
        }
    }
}
