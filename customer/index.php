<?php
require "connector.php";
$queryproduk = mysqli_query($conn, "SELECT id_produk, nama, harga, foto, detail FROM produk LIMIT 6")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php require "navbar.php";?>
    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Fashion and Styles</h1>
            <h3>Mau cari apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Barang"
                            aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna2 text-white">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- highlight kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-sepatu-pria d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Sepatu Pria">Sepatu Pria</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-sepatu-wanita d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Sepatu Wanita">Sepatu Wanita</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori sepatu-anak-anak d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Sepatu Anak-anak">Sepatu Anak-anak</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tentang kami -->
    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mt-3">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est laboriosam, fuga nihil id ea qui autem sint consequuntur cupiditate debitis eveniet quaerat vitae laudantium, architecto mollitia vero placeat doloribus fugiat?Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus magni natus rem sed, neque ipsa! Magni, adipisci! Quas labore, repellendus, unde accusamus, iste autem temporibus laboriosam ullam suscipit molestiae repellat?
            </p>
        </div>
    </div>
    <!-- Footer -->
    <?php require "footer.php";?>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
