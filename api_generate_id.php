<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'] ?? '';

    if (empty($student_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Student ID is required.']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE id_requests SET status = 'approved', approved_at = NOW() WHERE student_id = ? AND status = 'pending'");
    $stmt->bind_param('i', $student_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'ID card approved.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No pending request found for this student.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to approve ID card.']);
    }

    $stmt->close();
    $conn->close();
}
?>