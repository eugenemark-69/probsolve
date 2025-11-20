<?php
class User {
    public function listAll() { return []; }
    public function create($data) { return 1; }
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
}
