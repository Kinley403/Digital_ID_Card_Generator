<?php
// Database configuration
$host = "localhost";    
$port = "3306";         
$username = "root";     
$password = "";         
$database = "college_id_system"; 

try {
    // Create a connection using PDO
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully";  // For debugging, remove in production

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
