<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'admin_navbar.php';
    if (isset ($_SESSION['user_name'])) {
        header('location: admin_ride_list.php');
    }
    ?>
    <div class="login-background d-flex justify-content-center align-items-center">
        <div class="login-container pb-5">
            <h2 class="text-center py-3">Login</h2>
            <form action="admin_login_verification.php" method="POST">
                <label for="user_name" class="form-label mt-5">Username:</label>
                <input type="text" class="form-control mb-4" id="user_name" name="user_name" autocomplete="off"
                    required>
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control mb-4" id="password" name="password" required>
                <?php
                if (isset ($_SESSION['error'])) {
                    echo '<strong><p class="text-danger text-center">' . $_SESSION['error'] . '</p></strong>';
                } else if (isset ($_SESSION['success'])) {
                    echo '<strong><p class="text-success text-center">' . $_SESSION['success'] . '</p></strong>';
                }
                ?>
                <button type="submit" class="btn btn-primary mb-5" id="login" name="login">LOGIN</button>
            </form>
        </div>
    </div>
    <?php
    include 'footer.php';
    session_destroy();
    ?>
</body>

</html>