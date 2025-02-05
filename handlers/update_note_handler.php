<?php
include '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? null;
    $content = $_POST['content'] ?? null;

    if (!$id || !$title || !$content) {
        die("Error: Missing required fields. ID: $id, Title: $title, Content: $content");
    }

    $stmt = $conn->prepare("UPDATE note SET title = ?, content = ? WHERE id = ?");
    
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssi", $title, $content, $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        header("Location: ../index.php"); 
        exit();
    } else {
        die("Error executing query: " . $stmt->error);
    }
} else {
    die("Invalid request method.");
}
?>