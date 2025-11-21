<?php
class User {
    public function listAll() {
        try {
            require_once __DIR__ . '/../config/database.php';
            $db = Database::getConnection();
            if (!$db) return [];
            $stmt = $db->query("SELECT id, username, email, role, rating, is_verified, created_at FROM users");
            return $stmt->fetchAll() ?: [];
        } catch (Exception $e) {
            error_log('User::listAll error: ' . $e->getMessage());
            return [];
        }
    }

    public function create($data) {
        try {
            require_once __DIR__ . '/../config/database.php';
            $db = Database::getConnection();
            if (!$db) return false;

            // Validate required fields
            if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
                error_log('User::create missing required fields');
                return false;
            }

            // Check if user already exists
            $check = $db->prepare("SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1");
            $check->execute([':username' => $data['username'], ':email' => $data['email']]);
            if ($check->fetch()) {
                error_log('User::create user already exists');
                return false;
            }

            // Hash password and insert
            $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);
            $role = $data['role'] ?? 'asker';
            
            $stmt = $db->prepare("INSERT INTO users (username, email, password_hash, role, is_verified) VALUES (:username, :email, :password_hash, :role, 0)");
            $stmt->execute([
                ':username' => $data['username'],
                ':email' => $data['email'],
                ':password_hash' => $passwordHash,
                ':role' => $role
            ]);
            
            return (int)$db->lastInsertId();
        } catch (Exception $e) {
            error_log('User::create error: ' . $e->getMessage());
            return false;
        }
    }

    public function getByUsername($username) {
        try {
            require_once __DIR__ . '/../config/database.php';
            $db = Database::getConnection();
            if (!$db) return null;
            
            $stmt = $db->prepare("SELECT id, username, email, password_hash, role, rating, is_verified FROM users WHERE username = :username LIMIT 1");
            $stmt->execute([':username' => $username]);
            return $stmt->fetch() ?: null;
        } catch (Exception $e) {
            error_log('User::getByUsername error: ' . $e->getMessage());
            return null;
        }
    }

    public function update($userId, $data) { return true; }
    public function delete($userId) { return true; }
    public function get($userId) { return null; }

    public function banUser($userId) {
        // Simulate banning a user
        return ['success' => true, 'message' => "User $userId banned."];
    }

    public function unbanUser($userId) {
        // Simulate unbanning a user
        return ['success' => true, 'message' => "User $userId unbanned."];
    }

    public function deleteUser($userId) {
        // Simulate deleting a user
        return ['success' => true, 'message' => "User $userId deleted."];
    }

    public function verifyPassword($username, $password) {
        $user = $this->getByUsername($username);
        if (!$user) return false;
        return password_verify($password, $user['password_hash']);
    }
}
