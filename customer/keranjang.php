<?php
session_start();
require_once "connector.php";
$queryproduk = mysqli_query($conn, "SELECT id_produk, nama, harga, foto, detail FROM produk LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Keranjang</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <?php
   include 'navbar.php';
   ?>
   <div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th class="text-end">Harga</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = 'SELECT * FROM produk WHERE id_produk IN (';
            $idProduk = array_keys($_SESSION['keranjang']);
            $sql .= trim(str_repeat('?,', count($idProduk)), ',');
            $sql .= ')';
            $stmt = $conn->prepare($sql);
            $types = str_repeat('s', count($idProduk));
            $stmt->bind_param($types, ...$idProduk);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($produk = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo htmlentities($produk['nama']);?></td>
                <td><input type="number" value="<?php echo $_SESSION['keranjang'][$produk['id_produk']];?>" class="form-control w-auto"/></td>
                <td>Rp <?php echo number_format($produk['harga'], 0, ',', '.');?></td>
                <td>Rp <?php echo number_format($produk['harga'] * $_SESSION['keranjang'][$produk['id_produk']], 0, ',', '.');?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
   </div>
</body>
</html>
