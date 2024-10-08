<?php
include 'connection.php';

session_start();

if (isset ($_POST['login'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM Admin WHERE first_name = ?");
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = array();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $dbPassword = $row['password'];

        if ($password === $dbPassword) {
            $_SESSION['user_name'] = $user_name;
            header("location: admin_ride_list.php");
            exit();
        } else {
            $_SESSION['error'] = 'Incorrect Password';
        }
    } else {
        $_SESSION['error'] = 'User not found';
    }
}
header('location: admin_login.php');

