<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="styles/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- jQuery UI CSS for draggable modals -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
</head>

<body>
    <?php
    include 'connection.php';
    include 'admin_navbar.php';


    if (!isset($_SESSION['user_name'])) {
        header('location: admin_login.php');
    }
    // Fetch user data
    $username = $_SESSION['user_name']; // Assuming 'user_name' holds the username of the logged-in user
    $sql = "SELECT first_name, last_name, first_name AS username FROM admin WHERE first_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Extract user data if available
    if ($user) {
        $firstname = $user['first_name'];
        $lastname = $user['last_name'];
        $username = $user['username'];
    } else {
        // Handle the case where no data is found
        $firstname = '';
        $lastname = '';
        $username = '';
    }
    ?>

    <div class="admin-update">
        <div class="login-container mt-4">
            <?php
                if (isset($_SESSION['password_success'])) {
                    echo '<strong><p class="text-success text-center mt-4">' . $_SESSION['password_success'] . '</p></strong>';
                }
                if (isset($_SESSION['password_fail'])) {
                    echo '<strong><p class="text-danger text-center mt-4">' . $_SESSION['password_fail'] . '</p></strong>';
                }
            ?>
            <form action="adminUpdate.php" class="d-flex" method="post">
                <div>
                    <img src="images\admin.png" alt="Icon" class="input-icon">
                </div>
                <div class="w-100">
                    <div class="name-group d-flex">
                        <div class="form-group w-50 pr-2">
                            <label class="form-label" for="firstname">First Name:</label>
                            <input class="form-control" type="text" id="firstname" name="firstname"
                                value="<?php echo htmlspecialchars($firstname); ?>" readonly style = "background-color: white;cursor:default;">
                        </div>
                        <div class="form-group w-50 ml-2">
                            <label class="form-label" for="lastname">Last Name:</label>
                            <input class="form-control" type="text" id="lastname" name="lastname"
                                value="<?php echo htmlspecialchars($lastname); ?>" readonly style = "background-color: white;cursor:default;">
                        </div>
                    </div>
                    <label class="form-label" for="username" >User Name:</label>
                    <input class="form-control" type="text" id="username" name="username"
                        value="<?php echo htmlspecialchars($username); ?>" readonly style = "background-color: white;cursor:default;">
                    <label class="form-label mt-3" for="oldpassword">Old Password:</label>
                    <input class="form-control" type="password" id="oldpassword" name="oldpassword" required>
                    <label class="form-label mt-3" for="newpassword">New Password:</label>
                    <input class="form-control" type="password" id="newpassword" name="newpassword" required>
                    <label class="form-label mt-3" for="confirmpassword">Confirm Password:</label>
                    <input class="form-control" type="password" id="confirmpassword" name="confirmpassword" required>

                    <div class="button-container border text-right mt-3">
                        <button class="btn btn-danger px-5" type="button"
                            onclick="window.location.href='admin_ride_list.php'">Cancel</button>
                        <button class="btn btn-success px-4 ml-3" type="submit" id="update" name="update">Save
                            Changes</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</html>

<?php
    unset($_SESSION['password_success']);
    unset($_SESSION['password_fail']);
?>