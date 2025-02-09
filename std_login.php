<?php
include 'db_connection.php'; // Make sure this connects to your database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "register") {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $contact = $_POST['contact'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash password

    // Check if username or email already exists
    $checkQuery = "SELECT * FROM students WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Username or Email already exists."]);
        exit;
    }

    // Insert new user into the students table
    $query = "INSERT INTO students (student_id, name, username, email, department, contact, password) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $student_id, $name, $username, $email, $department, $contact, $password);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Registration successful!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Registration failed!"]);
    }
}
?>