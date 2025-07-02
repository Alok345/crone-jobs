<?php
header('Content-Type: application/json');

// Database configuration
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'user_management_db';

// Connect to MySQL
try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get all users
    $stmt = $conn->query("SELECT id, phone FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $updatedCount = 0;
    
    foreach ($users as $user) {
        // Generate a new random phone number (10 digits)
        $newPhone = '';
        for ($i = 0; $i < 10; $i++) {
            $newPhone .= rand(0, 9);
        }
        
        // Update the phone number
        $updateStmt = $conn->prepare("UPDATE users SET phone = :phone WHERE id = :id");
        $updateStmt->execute([
            ':phone' => $newPhone,
            ':id' => $user['id']
        ]);
        
        $updatedCount++;
    }
    
    echo json_encode([
        'status' => 'success',
        'message' => "Updated $updatedCount phone numbers",
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error: ' . $e->getMessage()
    ]);
    exit(1);
}
?>