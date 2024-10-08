<?php
include 'connection.php';  // Make sure the database connection is correctly set up
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rideId'])) {
    $rideIdToDelete = $_POST['rideId'];

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Delete from admin_ride table
        $sql = "DELETE FROM admin_ride WHERE ride_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $rideIdToDelete);
        $stmt->execute();
        $stmt->close();

        // Delete from accessibility_information table
        $sql = "DELETE FROM accessibility_information WHERE ride_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $rideIdToDelete);
        $stmt->execute();
        $stmt->close();

        // Delete from ride table
        $sql = "DELETE FROM ride WHERE ride_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $rideIdToDelete);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        $conn->commit();

        $_SESSION['delete'] = "Ride $rideIdToDelete deleted.";
    } catch (Exception $e) {
        $conn->rollback();  // Rollback transaction on error
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
} else {
    echo "Invalid request method or missing parameters.";
}
?>
