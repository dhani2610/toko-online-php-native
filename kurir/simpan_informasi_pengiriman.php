<?php
// Pastikan sudah ada koneksi ke database
require_once "connector.php";
session_start();


// Periksa apakah ada data yang dikirim dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data informasi pengiriman dari form
    $order_id = $_POST["order_id"];
    $info_lokasi = $_POST["info_lokasi"];
    $tanggal_waktu = $_POST["tanggal_waktu"];
    $id_kurir = $_SESSION['users']['id_user']; // Assuming you store the user ID in session

    // Query untuk menyimpan informasi pengiriman ke database
    $sql = "INSERT INTO pengiriman (id_pemesanan,info_lokasi, tanggal_waktu, id_kurir) VALUES (?, ?, ?, ?)";

    // Persiapan pernyataan SQL
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("ssss", $order_id ,$info_lokasi, $tanggal_waktu, $id_kurir);

    // Jalankan pernyataan SQL
    if ($stmt->execute()) {
        // Jika penyimpanan berhasil, redirect kembali ke halaman sebelumnya atau halaman sukses
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
