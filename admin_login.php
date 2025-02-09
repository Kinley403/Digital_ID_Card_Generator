<?php
session_start(); // Start session for admin authentication

// Database configuration
$host = "localhost";    
$username = "root";     
$password = "";         
$database = "college_id_system"; 

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the username and password from the frontend
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->username) && isset($data->password)) {
        $username = $data->username;
        $password = $data->password;

        // Check if admin exists in database
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($admin && hash("sha256", $password) === $admin['password']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            echo json_encode(["status" => "success", "message" => "Login successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid username or password."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Please fill in all fields."]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database connection failed: " . $e->getMessage()]);
}
?>
