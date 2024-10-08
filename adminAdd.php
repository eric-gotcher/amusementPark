<?php
// Check if the form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form data
    // Assuming you have form fields named ride_name, ride_description, and any other fields you want to handle

    // Example code to handle form data
    $rideName = $_POST['ride_name'];
    $rideDescription = $_POST['ride_description'];
    // Add more fields as needed


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO ride (ride_name, ride_description) VALUES (?, ?)");
    $stmt->bind_param("ss", $rideName, $rideDescription);

    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        // Retrieve the ID of the newly inserted ride
        $rideId = $conn->insert_id;

        // Return the ride ID as the response
        echo $rideId;
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, return an error message
    echo "Invalid request method.";
}
?>
