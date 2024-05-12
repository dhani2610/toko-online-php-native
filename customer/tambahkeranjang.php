<?php
session_start();

// Periksa apakah ada id_produk yang diterima
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Handle case when id_produk is missing or empty
    // You can show an error message or redirect to another page
    echo "ID produk tidak valid.";
    exit;
}

// Inisialisasi nilai qty dengan 1 secara default
$qty = 1;

// Periksa apakah qty diset melalui POST, dan pastikan nilainya minimal 1
if(isset($_POST['qty'])){
    $qty = max($_POST['qty'], 1);
}

// Inisialisasi session keranjang jika belum ada
if(!isset($_SESSION['keranjang'])){
    $_SESSION['keranjang'] = [];
}

// Ambil id_produk dari $_GET
$id = $_GET['id_produk'];

// Periksa apakah produk dengan id_produk tersebut sudah ada dalam keranjang
if (!isset($_SESSION['keranjang'][$id])){
    // Jika belum ada, tambahkan produk dengan qty yang ditentukan
    $_SESSION['keranjang'][$id] = $qty;
} else {
    // Jika sudah ada, tambahkan qty baru ke qty yang sudah ada
    $_SESSION['keranjang'][$id] += $qty;
}

// Redirect ke halaman keranjang.php setelah menambahkan produk
header("Location: keranjang.php");
exit;
?>
