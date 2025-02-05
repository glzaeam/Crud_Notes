<?php
include '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $created_at = date('Y-m-d H:i:s'); 

    if (empty($title)) {
        die("Error: Title is required.");
    }
    if (strlen($title) > 100) {
        die("Error: Title should not exceed 100 characters.");
    }
    if (empty($content)) {
        die("Error: Content is required.");
    }
    if (strlen($content) > 500) {
        die("Error: Content should not exceed 500 characters.");
    }

    try {
        if ($conn->connect_error) {
            throw new Exception("Database connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO note (title, content, created_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $created_at);

        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit();
        } else {
            throw new Exception("Error: Failed to insert note.");
        }
    } catch (Exception $e) {
        die($e->getMessage());
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    die("Invalid request method.");
}
