<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $rideId = $_POST['ride_id'] ?? '';
    $rideName = $_POST['rideName'] ?? '';
    $rideCategory = $_POST['rideCategory'] ?? '';
    $rideDescription = $_POST['ride_info'] ?? '';
    $physicalRequirement = $_POST['physical_requirement'] ?? '';

    // Prepare and execute the SQL statement to insert a new ride
    $sql = "INSERT INTO ride (ride_id, ride_name, ride_category, ride_info, physical_requirement) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $rideId, $rideName, $rideCategory, $rideDescription, $physicalRequirement);

    if ($stmt->execute()) {
        echo "Ride added successfully";
        header("location: admin_ride_list.php");

        // Redirect to a success page or another page as needed
        // header("Location: success.php");
        // exit();
    } else {
        echo "Error adding ride: " . $stmt->error;
        header("location: admin_ride_list.php");

        // Redirect to an error page or another page as needed
        // header("Location: error.php");
        // exit();
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Form submission method not allowed";
}
?>
