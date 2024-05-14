<?php
// Pastikan sudah ada koneksi ke database
require_once "connector.php";

// Periksa apakah ada parameter order_id yang diterima dari URL
if (isset($_GET['order_id'])) {
    // Ambil order_id dari parameter URL
    $order_id = $_GET['order_id'];

    // Query untuk update status pesanan menjadi "selesai"
    $sql = "UPDATE pesanan SET status_pemesanan = 'selesai' WHERE id_pesanan = ?";

    // Persiapan pernyataan SQL
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("i", $order_id);

    // Jalankan pernyataan SQL
    if ($stmt->execute()) {
        // Jika pembaruan berhasil, redirect kembali ke halaman sebelumnya atau halaman sukses
        header("Location: detail.php?order_id=".$order_id);
    } else {
        // Jika ada kesalahan, tampilkan pesan kesalahan
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup pernyataan
    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>
