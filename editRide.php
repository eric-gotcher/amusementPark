<?php
include 'connection.php';
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $rideId = $_POST['ride_id'] ?? '';
    $rideName = $_POST['rideName'] ?? '';
    $rideCategory = $_POST['rideCategory'] ?? '';
    $rideDescription = $_POST['ride_info'] ?? '';
    $physicalRequirement = $_POST['physical_requirement'] ?? '';

    // Prepare an SQL statement with placeholders
    $sql = "UPDATE ride SET ride_name = ?, ride_category = ?, ride_info = ?, physical_requirement = ? WHERE ride_id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ssssi", $rideName, $rideCategory, $rideDescription, $physicalRequirement, $rideId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Ride updated successfully";
            $_SESSION['complete'] = "Ride $rideId updated.".
            header("location: admin_ride_list.php");

        } else {
            echo "Error updating ride: " . $stmt->error;
            header("location: admin_ride_list.php");
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>