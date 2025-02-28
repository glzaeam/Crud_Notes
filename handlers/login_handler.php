<?php
session_start();
require_once '../database/database.php'; // Make sure this file exists and has correct DB credentials

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']); // Keep email for login

    $password = trim($_POST['password']);

    // Input validation
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format or empty!";

        header("Location: ../login.php");
        exit();
    }

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?"); // Use email for login

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc(); // Fetch user data

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['id']; // Set user ID in session
            $_SESSION['username'] = $user['email']; // Set email in session

            header("Location: ../index.php"); // Redirect to dashboard
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password!"; // Update error message

            header("Location: ../login.php"); // Redirect back to login page
            exit();
        }
    } else {
        $_SESSION['error'] = "All fields are required!";
        header("Location: ../login.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
