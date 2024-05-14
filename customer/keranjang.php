<?php
require_once "connector.php";
$queryproduk = mysqli_query($conn, "SELECT id_produk, nama, harga, foto, detail FROM produk LIMIT 6");

// Periksa apakah sesi keranjang kosong
if (empty($_SESSION['keranjang'])) {
    $emptyCartText = "Tidak ada data";
} else {
    $emptyCartText = "";
}
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
   <?php include 'navbar.php'; ?>
 
   <form action="checkout-process.php" method="get">
   <div class="container mt-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">Produk</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($_SESSION['keranjang'])): ?>
                <tr>
                    <td colspan="4" class="text-center"><?php echo $emptyCartText; ?></td>
                </tr>
            <?php else: ?>
                <?php
                    $totalAmount = 0;
                    $sql = 'SELECT * FROM produk WHERE id_produk IN (' . implode(',', array_fill(0, count($_SESSION['keranjang']), '?')) . ')';
                    $stmt = $conn->prepare($sql);
                    $types = str_repeat('i', count($_SESSION['keranjang']));
                    $stmt->bind_param($types, ...array_keys($_SESSION['keranjang']));
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($produk = $result->fetch_assoc()) {
                        $subtotal = $produk['harga'] * $_SESSION['keranjang'][$produk['id_produk']];
                        $totalAmount += $subtotal;
                ?>
                <tr>
                    <td class="text-center">
                        <img src="../image/<?php echo $produk['foto']; ?>" style="max-width: 100px;" class="img-fluid img-thumbnail produk-terkait-image" alt=""><br>
                        <?php echo htmlentities($produk['nama']); ?>
                    </td>
                    <td class="text-center">
                        <center>
                            <input type="number" name="qty" onkeyup="myFunction('<?php echo $produk['harga']; ?>', '<?php echo $produk['id_produk']; ?>')" value="<?php echo $_SESSION['keranjang'][$produk['id_produk']]; ?>" id="qty_<?php echo $produk['id_produk']; ?>" style="margin-top: 10%;" class="form-control w-auto"/>
                        </center>
                        <input type="hidden" name="id_produk" value="<?php echo $produk['id_produk']; ?>">
                        <input type="hidden" name="total_input" id="total_input_<?php echo $produk['id_produk']; ?>" value="<?php echo $subtotal; ?>">
                    </td>
                    <td class="text-center">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
                    <td class="text-center">Rp <span id="totalText_<?php echo $produk['id_produk']; ?>"><?php echo number_format($subtotal, 0, ',', '.'); ?></span></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                    <td class="text-center">Rp <span id="grandTotal"><?php echo number_format($totalAmount, 0, ',', '.'); ?></span></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <input type="hidden" name="grand_total" id="grandTotalInput" value="<?php echo $totalAmount; ?>">
   </div>
   <div class="container">
    <center>
        <label for="" class="mt-3 mb-3 text-center text-bold"><b>Tambahkan Informasi:</b></label>
    </center>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="number" name="no_tlp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4" style="float: right;">Checkout</button>
                </div>
            </div>
        </div>
    </div>
   </form>
   </div>

   <script>
    function myFunction(price, id_produk) {
        let qty = document.getElementById("qty_" + id_produk).value;
        let total = qty == '' ? 0 : qty * price;
        let totalText = document.getElementById("totalText_" + id_produk);
        let total_input = document.getElementById("total_input_" + id_produk);

        totalText.textContent = total.toLocaleString('id-ID');
        total_input.value = total;

        // Update grand total
        let grandTotal = 0;
        document.querySelectorAll('[id^="total_input_"]').forEach(function(input) {
            grandTotal += parseInt(input.value);
        });

        document.getElementById("grandTotal").textContent = grandTotal.toLocaleString('id-ID');
        document.getElementById("grandTotalInput").value = grandTotal;
    }
    
   </script>
</body>
</html>
