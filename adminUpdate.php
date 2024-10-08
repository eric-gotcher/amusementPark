<?php
session_start();
include 'connection.php';

if (isset($_POST["update"])) {
    $first_name = $_POST['username'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['newpassword'];
    $confirmPassword = $_POST['confirmpassword'];


    $sql = "SELECT password FROM admin WHERE first_name = '$first_name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];
        if ($oldPassword != $storedPassword) {
            $_SESSION['password_fail'] = "Old password is incorrect";
            header('location: admin_update.php');
            exit; // Stop script execution
        }
    } else {
        $_SESSION['error'] = "User not found";
        header('location: admin_update.php');
        exit; // Stop script execution
    }

    if ($newPassword != $confirmPassword) {
        $_SESSION["password_fail"] =  "New password and confirm password do not match";
        header('location: admin_update.php');
        exit; // Stop script execution
    }

    // Perform database update
    $sql = "UPDATE admin SET first_name='$firstName', last_name='$lastName', password='$newPassword' WHERE first_name='$first_name'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
    } else {
         echo "Error updating record: " . $conn->error;
    }

    $_SESSION['password_success'] = "Password changed successfully.";
    $_SESSION['user_name'] = $first_name;
    header("location: admin_update.php");
}
?>
