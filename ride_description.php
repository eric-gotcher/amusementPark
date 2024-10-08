<?php
include 'connection.php';

if (isset ($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Ride r, Accessibility_Information a WHERE r.ride_id = a.ride_id AND r.ride_id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $data['ride_name']; ?>
    </title>
    <link rel="icon" href="images/logo.png">
    <!-- Link to main stylesheet -->
    <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">
    <!-- Link to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- Link to Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/ff6fa24fcc.js" crossorigin="anonymous"></script>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'navbar.php';
    ?>
    <div class="description-container">
        <h2 class="my-4 text-center">
            <?php echo $data['ride_name']; ?>
        </h2>

        <div class="top">
            <h3 class="mb-3">Ride Number:
                <?php echo $data['ride_id']; ?>
            </h3>
            <h4>Description</h4>
            <p>
                <?php echo $data['ride_info']; ?>
            </p>
        </div>

        <div class="bottom d-flex">
            <div class="sensory-container col-6">
                <div class="image-container">
                    <img src="images/sensory.png" alt="sensory guide">
                    <div class="numbers-container">
                        <div class="numbers">
                            <?php echo $data['touch']; ?>
                        </div>
                        <div class="numbers">
                            <?php echo $data['taste']; ?>
                        </div>
                        <div class="numbers">
                            <?php echo $data['sound']; ?>
                        </div>
                        <div class="numbers">
                            <?php echo $data['smell']; ?>
                        </div>
                        <div class="numbers">
                            <?php echo $data['sight']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="restriction-container col-6">
                <h5 class="mb-2">Height Restrictions:</h5>
                <p class="mb-5">Riders must be at least
                    <?php echo $data['min_height']; ?> inches tall to ride.
                </p>
                <h5 class="mb-2">Physical Restrictions:</h5>
                <p class="mb-5">
                    <?php echo $data['physical_requirement']; ?>
                </p>

                <h5 class="mb-2">Extremity Restrictions:</h5>
                <p class="mb-5">Riders must have at least
                    <?php echo $data['hands']; ?> functioning arms and
                    <?php echo $data['legs']; ?> functioning legs.
                </p>
            </div>
        </div>

        <?php
        include 'footer.php';
        ?>
    </div>

</body>

</html>