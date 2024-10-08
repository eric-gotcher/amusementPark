<?php
// Include your database connection file
include 'connection.php';

// Check if rideId is set in POST data
if(isset($_POST['rideId'])) {
    // Get the rideId from POST data
    $rideId = $_POST['rideId'];

    // Prepare and execute SQL query to fetch ride data based on rideId
    $sql = "SELECT * FROM ride WHERE ride_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $rideId);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the data as an associative array
    $row = $result->fetch_assoc();

    // Close the statement
    $stmt->close();

    // Return the fetched data as JSON
    echo json_encode($row);
} else {
    // If rideId is not set, return an error message
    echo json_encode(array('error' => 'Ride ID is not set.'));
}
?>
