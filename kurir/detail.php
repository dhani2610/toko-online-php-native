

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
        INNER JOIN produk ON pesanan.id_product = produk.id_produk 
        WHERE pesanan.id_pesanan = ?";

// Persiapan pernyataan SQL
$stmt = $conn->prepare($sql);

// Bind parameter
$stmt->bind_param("i", $_GET['order_id']);

// Jalankan pernyataan SQL
$stmt->execute();

// Ambil hasil dari pernyataan
$result = $stmt->get_result();

// Query untuk mendapatkan informasi pengiriman berdasarkan ID pesanan
$sql_pengiriman = "SELECT * FROM pengiriman WHERE id_pemesanan = ?";

// Persiapan pernyataan SQL untuk informasi pengiriman
$stmt_pengiriman = $conn->prepare($sql_pengiriman);

// Bind parameter untuk informasi pengiriman
$stmt_pengiriman->bind_param("i", $_GET['order_id']);

// Jalankan pernyataan SQL untuk informasi pengiriman
$stmt_pengiriman->execute();

// Ambil hasil dari pernyataan untuk informasi pengiriman
$result_pengiriman = $stmt_pengiriman->get_result();
// var_dump($id_pesanan);
?>

    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Fashion and Styles</h1>
            <h3>Complete Your Payment</h3>
        </div>
    </div>
    <div class="container-fluid py-5">
    <div class="container mt-5">
        <h2>Detail Pesanan</h2>
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
                        <?php if ($row['status_pemesanan'] != 'selesai') {  ?>
                            <center>
                                <a href="setSelesai.php?order_id=<?php echo $_GET['order_id'] ?>" style="float: right;" type="submit" class="btn btn-success mt-3 mb-3">Set Finish</a>
                            </center>
                        <?php } else{ ?>
                            No Action 
                        <?php } ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <h2>Informasi Pengiriman</h2>


        <!-- FORM INPUT INFORMASI PENGIRIMAN -->
        <form action="simpan_informasi_pengiriman.php" method="post">
            <div class="form-group">
                <label for="info_lokasi">Info Lokasi:</label>
                <input type="text" class="form-control" id="info_lokasi" name="info_lokasi" required>
            </div>
            <div class="form-group">
                <label for="tanggal_waktu">Tanggal dan Waktu:</label>
                <input type="datetime-local" class="form-control" id="tanggal_waktu" name="tanggal_waktu" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan Informasi Pengiriman</button>
        </form>

        <!-- LOOPING CARD Bootstrap INFORMASI PENGIRIMAN -->
        <div class="row mt-4">
            <?php while ($row_pengiriman = $result_pengiriman->fetch_assoc()): ?>
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Info Lokasi: <?php echo $row_pengiriman['info_lokasi']; ?></h5>
                        <p class="card-text"><?php echo $row_pengiriman['tanggal_waktu']; ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>


    </div>
    <?php require "footer.php"; ?>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
   
</body>
</html>
