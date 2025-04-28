<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['userId']) && isset($data['postId']) && isset($data['comment'])) {
    
    $userId = $data['userId'];
    $postId = $data['postId'];
    $comment = $data['comment'];

    include_once '../config/db_connection.php';

    $stmt = $conn->prepare("INSERT INTO comments (user_id, post_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $userId, $postId, $comment);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add comment.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
}
?>