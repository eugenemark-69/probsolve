<?php
/**
 * Database Setup Script
 * Run this once to initialize the probsolve database
 * Usage: php scripts/setup-db.php
 */

// Database credentials (from environment or defaults)
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$dbname = getenv('DB_NAME') ?: 'probsolve';

try {
    // Connect without specifying database first
    $conn = new PDO("mysql:host=$host", $user, $pass);
    
    // Read the schema file
    $schemaFile = __DIR__ . '/../database/schema/probsolve_schema.sql';
    if (!file_exists($schemaFile)) {
        die("Error: Schema file not found at $schemaFile\n");
    }
    
    $schema = file_get_contents($schemaFile);
    
    // Execute schema
    $statements = array_filter(array_map('trim', explode(';', $schema)));
    
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $conn->exec($statement);
            echo "✓ Executed: " . substr($statement, 0, 60) . "...\n";
        }
    }
    
    echo "\n✓ Database setup completed successfully!\n";
    echo "Database: $dbname\n";
    echo "Host: $host\n";
    echo "\nYou can now use the application.\n";
    
} catch (PDOException $e) {
    echo "✗ Database Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
