<?php
session_start();
?>
<!-- Link to main stylesheet -->
<link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">

<nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">
        <img src="images/logo.png" width="40" height="40" alt="logo">
    </a>
    <?php
    if (isset ($_SESSION['user_name'])) {
        echo '<div class="dropdown">
        <button class="btn dropdown-toggle text-white" type="button" id="menu1" data-toggle="dropdown"><i class = "fas fa-user-circle mr-2" style = "font-size: 20px;transform: translateY(2px)";></i>
            ' . $_SESSION['user_name'] . '
        </button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="menu1">
            <li><a class="dropdown-item" href="admin_update.php"><i class = "fas fa-cog"></i> Manage Profile</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class = "fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>';
    }
    ?>
</nav>