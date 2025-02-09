<?php
// Database configuration
$host = "localhost";    
$username = "root";     
$password = "";         
$database = "college_id_system"; 

try {
    // Create a connection using PDO
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Connection successful!";
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
?>
