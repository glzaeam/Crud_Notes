<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "note";

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn = new mysqli($host, $username, $password, $database); // Keep this for mysqli usage

if ($conn->connect_error) {  
    die("Database connection unsuccessful: " . $conn->connect_error);  
}  

function registerUser($username, $email, $password) { 
    global $pdo; // Add this line to use the PDO connection
    global $conn;
    
    // Check if the username already exists
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkStmt->store_result();
    if ($checkStmt->num_rows > 0) {
        return false; // Username already exists
    }
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);
    return $stmt->execute(); // Proceed with the insertion if username is unique
}

function loginUser($email, $password) { 
    global $pdo; // Add this line to use the PDO connection
    global $conn;
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        return password_verify($password, $hashedPassword);
    }
    return false;
}
