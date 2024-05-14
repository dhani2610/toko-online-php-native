<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Navbar</title>
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
include "connector.php";
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark warna1">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php 
                    if (isset($_SESSION['users'])) { 
                ?>
                <li class="nav-item me-4">
                    <a class="nav-link" href="list-pesanan.php">Pesanan</a>
                </li>
                <?php 
                    }
                ?>
            </ul> 
            <span class="navbar-text">
                <?php 
                    if (!isset($_SESSION['users'])) { 
                ?>
                    <a class="nav-link "  href="login.php">login</a>
                <?php 
                    }else{
                ?>
                    <!-- <a class="nav-link"  href="#"><i class="fa fa-user"></i> <?php echo $_SESSION['users']['username']; ?></a> -->
                    <a class="nav-link"  href="Logout.php"> <i class="fa fa-sign-out" style="margin-right: 10px;"></i><?php echo $_SESSION['users']['username']; ?></a>
                <?php 
                    }
                ?>
            </span>
        </div>
    </div>
</nav>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
