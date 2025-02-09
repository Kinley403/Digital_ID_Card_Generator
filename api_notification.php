<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_id = $_POST['recipient_id'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($recipient_id) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Recipient and message are required.']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO notifications (recipient_id, message) VALUES (?, ?)");
    $stmt->bind_param('is', $recipient_id, $message);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Notification sent successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send notification.']);
    }

    $stmt->close();
    $conn->close();
}
?>