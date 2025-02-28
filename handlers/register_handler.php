<?php
include '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? ''; // New line to get email
    $password = $_POST['password'] ?? '';


    if (registerUser($username, $email, $password)) { // Updated function call

        header("Location: ../views/login.php");
    } else {
    header("Location: ../views/register.php");

    }
}