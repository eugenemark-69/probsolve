<?php
require_once __DIR__ . '/../config/database.php';

class Problem {
    private $db;
    
    public function __construct() {
        $this->db = Database::getConnection();
    }
    
    public function listAll($filters = []) {
        try {
            $query = "SELECT p.*, u.username, u.profile_picture, c.name as category_name 
                      FROM problems p 
                      JOIN users u ON p.user_id = u.id 
                      JOIN categories c ON p.category_id = c.id 
                      WHERE 1=1";
            
            if (!empty($filters['status'])) {
                $query .= " AND p.status = ?";
            }
            if (!empty($filters['category'])) {
                $query .= " AND c.slug = ?";
            }
            
            $query .= " ORDER BY p.created_at DESC";
            
            $stmt = $this->db->prepare($query);
            
            $params = [];
            if (!empty($filters['status'])) {
                $params[] = $filters['status'];
            }
            if (!empty($filters['category'])) {
                $params[] = $filters['category'];
            }
            
            if (!empty($params)) {
                $stmt->execute($params);
            } else {
                $stmt->execute();
            }
            
            return [
                'success' => true,
                'problems' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ];
        } catch (Exception $e) {
            error_log('Problem listAll error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'problems' => []
            ];
        }
    }
    
    public function create($userId, $data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO problems (user_id, category_id, title, description, bounty, status)
                VALUES (?, ?, ?, ?, ?, 'open')
            ");
            
            $stmt->execute([
                $userId,
                $data['category_id'] ?? 1,
                $data['title'] ?? '',
                $data['description'] ?? '',
                $data['bounty'] ?? null
            ]);
            
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            error_log('Problem create error: ' . $e->getMessage());
            return false;
        }
    }
    
    public function update($userId, $problemId, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE problems 
                SET title = ?, description = ?, category_id = ?, bounty = ?
                WHERE id = ? AND user_id = ?
            ");
            
            $stmt->execute([
                $data['title'] ?? '',
                $data['description'] ?? '',
                $data['category_id'] ?? 1,
                $data['bounty'] ?? null,
                $problemId,
                $userId
            ]);
            
            return true;
        } catch (Exception $e) {
            error_log('Problem update error: ' . $e->getMessage());
            return false;
        }
    }
    
    public function delete($userId, $problemId) {
        try {
            $stmt = $this->db->prepare("DELETE FROM problems WHERE id = ? AND user_id = ?");
            $stmt->execute([$problemId, $userId]);
            return true;
        } catch (Exception $e) {
            error_log('Problem delete error: ' . $e->getMessage());
            return false;
        }
    }
    
    public function get($problemId) {
        try {
            $stmt = $this->db->prepare("
                SELECT p.*, u.username, u.profile_picture, c.name as category_name 
                FROM problems p 
                JOIN users u ON p.user_id = u.id 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.id = ?
            ");
            $stmt->execute([$problemId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Problem get error: ' . $e->getMessage());
            return null;
        }
    }
}
