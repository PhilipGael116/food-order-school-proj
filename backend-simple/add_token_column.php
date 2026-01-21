<?php
$host = 'localhost';
$dbname = 'restaurant';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Add api_token column
    try {
        $sql = "ALTER TABLE users ADD COLUMN api_token VARCHAR(64) NULL AFTER password";
        $pdo->exec($sql);
        echo "Successfully added api_token column.\n";
    } catch (PDOException $e) {
        // Column might already exist
        if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
            echo "Column api_token already exists.\n";
        } else {
            echo "Error adding column: " . $e->getMessage() . "\n";
        }
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
