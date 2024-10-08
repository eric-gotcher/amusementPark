<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include 'admin_navbar.php'; ?>
    <div class="register-container mt-4 p-4">
        <h2 class="text-center py-3">Register</h2>
        <form action="admin_register_verification.php" method="POST">
            <label for="first_name" class="form-label">First Name: </label>
            <input type="text" class="form-control mb-4" id="first_name" name="first_name" autocomplete="off" required>
            <label for="last_name" class="form-label">Last Name: </label>
            <input type="text" class="form-control mb-4" id="last_name" name="last_name" autocomplete="off" required>
            <label for="password" class="form-label">Password: </label>
            <input type="password" class="form-control mb-4" id="password" name="password" required>
            <label for="park_id" class="form-label">Park Id: </label>
            <input type="text" class="form-control mb-4" id="park_id" name="park_id" autocomplete="off" required>
            <?php
            if (isset ($_SESSION['error'])) {
                echo '<strong><p class="text-danger text-center">' . $_SESSION['error'] . '</p></strong>';
            }
            ?>
            <button type="submit" class="btn btn-primary mb-4" id="register" name="register">REGISTER</button>
        </form>
    </div>
    <?php
    include 'footer.php';
    session_destroy();
    ?>
</body>

</html>