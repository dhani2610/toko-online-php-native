<?php
include "connector.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

session_start();
if (!isset($_SESSION['users'])) {
    header('Location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<style>
    .kotak{
        border: solid;
    }
    .summary-kategori{
        background-color: #1687A7;
        border-radius:15px;
    }
    .summary-produk{
        background-color: #3E978B;
        border-radius:15px;
    }
    .no-decoration{
        text-decoration: none;
    }
    
</style>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-camera"></i><span>  Home</span>
                </li>
            </ol>
        </nav>

        <h3>Halo <?php echo $_SESSION['users']['username']; ?></h3>
        
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-3">
                    <div class="row">
                        <div class="col-6">
                            <i class="fas fa-align-justify fa-7x text-black-50"></i>
                        </div>
                        <div class="col-6 text-white">
                            <h3 class="fs-2">Kategori</h3>
                            <p class="fs-4"><?=$jumlahKategori?> Kategori</p>
                            <p><a href="kategori.php" class="text-white no-decoration">Lihat detail</a></p>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-produk p-3">
                    <div class="row">
                        <div class="col-6">
                            <i class="fas fa-box fa-7x text-black-50"></i>
                        </div>
                        <div class="col-6 text-white">
                            <h3 class="fs-2">Produk</h3>
                            <p class="fs-4"><?=$jumlahProduk?> Produk</p>
                            <p><a href="produk.php" class="text-white no-decoration">Lihat detail</a></p>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>