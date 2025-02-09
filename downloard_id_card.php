<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $student_id = $_GET['student_id'] ?? '';

    if (empty($student_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Student ID is required.']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM id_requests WHERE student_id = ? AND status = 'approved'");
    $stmt->bind_param('i', $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $id_card = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'data' => $id_card]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No approved ID card found.']);
    }

    $stmt->close();
    $conn->close();
}
?>
