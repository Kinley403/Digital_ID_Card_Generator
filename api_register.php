<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'student'; // Default to 'student'

    if (empty($username) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Username and password are required.']);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $username, $hashed_password, $role);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User registered successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to register user.']);
    }

    $stmt->close();
    $conn->close();
}
?>