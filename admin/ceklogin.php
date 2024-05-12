<?php
session_start();
include "connector.php";

$username = htmlspecialchars($_POST['username']);
$password = md5(htmlspecialchars($_POST['password']));

$query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($hasil);

if ($data != null) {
    $_SESSION['users'] = $data;
    echo "<script>window.location.href='index.php'</script>";
} else {
    echo "<script>window.alert('Username atau password salah'); window.location.href='login.php'</script>";
}
