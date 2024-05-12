<?php
require "connector.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
if (isset($_GET['keyword'])) {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
}
else if (isset($_GET['kategori'])) {
    $queryGetKategoriId = mysqli_query($conn, "SELECT id_kategori FROM kategori WHERE nama='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id_kategori='$kategoriId[id_kategori]'");
}

else{
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk"); 
}
$countdata = mysqli_num_rows($queryProduk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
    </div>
    
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($queryKategori)){?>
                        <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama'];?>">
                        <li class="list-group-item"><?php echo $kategori['nama'];?></li>
                        </a>
                        <?php }?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                    <?php
                    if($countdata<1){
                    ?>
                    <h4 class="text-center my-5">Produk yang anda cari tidak tersedia</h4>
                    <?php
                    }
                    ?>
                    <?php while($produk = mysqli_fetch_array($queryProduk)){?>
                    <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                        <img src="../image/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $produk['nama'];?></h4>
                            <p class="card-text text-truncate"><?php echo $produk['detail'];?></p>
                            <p class="card-text text-harga"><?php echo $produk['harga'];?></p>
                            <a href="produk-detail.php?nama=<?php echo $produk['nama']?>" class="btn warna2 text-white">Lihat Detail</a>
                        </div>
                    </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <?php require "footer.php";?>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>