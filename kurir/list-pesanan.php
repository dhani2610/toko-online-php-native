

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Payment</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>
    <?php
// session_start();
require_once "connector.php";
// session_start();

// Periksa apakah pengguna telah login
if (!isset($_SESSION['users']['id_user'])) {
    // Redirect atau tindakan lain jika pengguna belum login
    header("Location: login.php");
    exit; // Penting untuk menghentikan eksekusi skrip
}

// Ambil ID pengguna dari sesi
$id_pelanggan = $_SESSION['users']['id_user'];

// Query untuk mendapatkan daftar pesanan berdasarkan ID pengguna
$sql = "SELECT pesanan.*, produk.nama AS nama_produk, produk.foto AS foto_produk 
        FROM pesanan 
        INNER JOIN produk ON pesanan.id_product = produk.id_produk ";

// Persiapan pernyataan SQL
$stmt = $conn->prepare($sql);

// Bind parameter
// $stmt->bind_param("i", $id_pelanggan);

// Jalankan pernyataan SQL
$stmt->execute();

// Ambil hasil dari pernyataan
$result = $stmt->get_result();
?>

    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Fashion and Styles</h1>
            <h3>Complete Your Payment</h3>
        </div>
    </div>
    <div class="container-fluid py-5">
    <div class="container mt-5">
        <h2>List Pesanan</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Foto Produk</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pesanan</th>
                        <th>Status Pesanan</th>
                        <th>Total Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_order']; ?></td>
                        <td><img src="../image/<?php echo $row['foto_produk']; ?>" style="max-width: 100px;" class="img-fluid img-thumbnail" alt=""></td>
                        <td><?php echo htmlentities($row['nama_produk']); ?></td>
                        <td><?php echo $row['qty']; ?></td>
                        <td><?php echo $row['tanggal_pesanan']; ?></td>
                        <td><?php echo $row['status_pemesanan']; ?></td>
                        <td><?php echo $row['total_harga']; ?></td>
                        <td>
                            <a href="detail.php?order_id=<?php echo $row['id_pesanan']; ?>" class="btn btn-primary">Input Report</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require "footer.php"; ?>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
   
</body>
</html>
