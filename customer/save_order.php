<?php
session_start();
require_once "connector.php";

// Fungsi untuk mengurangi stok produk berdasarkan ID produk
function updateStock($conn, $id_product, $qty) {
    // Query untuk mengurangi stok produk
    $sql = "UPDATE produk SET stok = stok - ? WHERE id_produk = ?";
    
    // Persiapan pernyataan SQL
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("ii", $qty, $id_product);

    // Jalankan pernyataan SQL
    $stmt->execute();

    // Tutup pernyataan
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_pelanggan = $_SESSION['users']['id_user']; // Assuming you store the user ID in session
    $id_order = $_GET['order_id']; // New field for id_order
    $id_product = $_GET['id_produk'];
    $qty = $_GET['qty'];
    $tanggal_pesanan = date('Y-m-d H:i:s');
    $status_pemesanan = 'dalam perjalanan';
    $total_harga = $_GET['grand_total'];

    // var_dump($id_pelanggan);

    $stmt = $conn->prepare("INSERT INTO pesanan (id_order, id_pelanggan, id_product, qty, tanggal_pesanan, status_pemesanan, total_harga) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiissi", $id_order, $id_pelanggan, $id_product, $qty, $tanggal_pesanan, $status_pemesanan, $total_harga);

    if ($stmt->execute()) {
        updateStock($conn, $id_product, $qty);

        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $stmt->error]);
    }

    $stmt->close();
}
?>
