<?php
$host = "localhost";
$mahesaUsername = "root";
$mahesaPassword = "";
$db = "toko_online";

$conn = new mysqli($host, $mahesaUsername, $mahesaPassword, $db);

if ($conn -> connect_error) {
    echo"Gagal";
}else{
    //echo"Mantap";
}
?>