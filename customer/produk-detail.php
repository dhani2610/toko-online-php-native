<?php
require "connector.php";

// Pastikan parameter nama aman untuk digunakan dalam query
$nama = isset($_GET['nama']) ? $_GET['nama'] : '';

// Lakukan query untuk mendapatkan detail produk berdasarkan nama
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");

// Periksa apakah query berhasil dieksekusi dan hasilnya tidak kosong
if ($queryProduk && mysqli_num_rows($queryProduk) > 0) {
    // Ambil hasil query
    $produk = mysqli_fetch_array($queryProduk);

    // Lakukan query untuk mendapatkan produk terkait
    $queryProdukTerkait = mysqli_query($conn, "SELECT * FROM produk WHERE id_kategori='$produk[id_kategori]' AND id_produk != '$produk[id_produk]' LIMIT 4");
} else {
    // Produk tidak ditemukan, mungkin berikan pesan kesalahan atau arahkan ke halaman lain
    echo "Produk tidak ditemukan.";
    exit; // Keluar dari skrip
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php require "navbar.php";?>
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-5"><img src="../image/<?php echo $produk['foto'];?>" class="w-100" alt=""></div>
            <div class="col-lg-6 offset-lg-1">
                <h1><?php echo $produk['nama']; ?></h1>
                <p class="fs-5">
                    <?php echo $produk['detail'];?>  
                <p class="text-harga">
                    Rp <?php echo $produk['harga'];?>
                </p>
                <p class="fs-5">
                    status ketersediaan : <strong><?php echo $produk['ketersediaan_stok']?></strong>
                </p>
                <p class="fs-5">
                    Stok : <?php echo $produk['stok'];?>
                </p>
                <form action="tambahkeranjang.php?id=<?php echo $produk['id_produk'];?>" method="POST">
                <div class="row g-2">
                    <div class="col-3">
                        <input type="number" value="1" name="qty" class="form-control">
                    </div>
                    <div class="col-9">
                        <button class="btn btn-primary w-100" type="submit">Tambah Keranjang</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5 warna2">
    <div class="container">
        <h2 class="text-center text-white mb-5">Produk Terkait</h2>

        <div class="row">
            <?php while($data=mysqli_fetch_array($queryProdukTerkait)){?>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="produk-detail.php?nama=<?php echo $data['nama'];?>">
                <img src="../image/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail produk-terkait-image" alt="">
            </a>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<?php require "footer.php";?>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
