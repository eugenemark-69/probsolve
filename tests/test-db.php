<?php
include 'backend/config/database.php';
$db = Database::getConnection();
if (!$db) {
    echo "Database connection failed!";
    exit;
}

// Check users table
$result = $db->query('SELECT COUNT(*) as count FROM users');
$row = $result->fetch();
echo "✓ Users table exists\n";
echo "Current users: " . $row['count'] . "\n";
?>
