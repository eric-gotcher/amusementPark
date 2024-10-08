<?php
session_start();
include 'connection.php';

if (isset ($_POST["register"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $park_id = $_POST['park_id'];

    $passwordPattern = '/^[a-zA-Z0-9!@#$%^&*()_]{6,20}$/';

    $passwordValid = preg_match($passwordPattern, $password);

    if (!$passwordValid) {
        $_SESSION['error'] = "Password must be between 6 and 20 characters long.";
        header('location: admin_register.php');
        exit;
    }

    $sql = "SELECT park_name FROM Park where park_id = $park_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) < 1) {
        $_SESSION['error'] = "Park does not exist.";
        header('location: admin_register.php');
    } else {
        $data = mysqli_fetch_assoc($result);

        $stmt = $conn->prepare("INSERT INTO Admin (first_name, last_name, password, park_name, park_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $first_name, $last_name, $password, $data['park_name'], $park_id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['success'] = "Admin registration successful";
        header("location: admin_login.php");
    }
}