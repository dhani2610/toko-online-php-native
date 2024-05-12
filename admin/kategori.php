<?php
include "connector.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>

    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<style>
    .no-decoration{
        text-decoration: none;
    }
    
</style>
<body>
<?php require "navbar.php"; ?>
<div class="container mt-3">
<nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted"><i class="fas fa-camera"></i><span> Home</span></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i></i><span>  Kategori</span>
                </li>
            </ol>
        </nav>
        <div class="my-3 col-12 col-md-5">
            <h3>Tambah Kategori</h3>
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="Input Nama Kategori" class="form-control">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                </div>
            </form>
            <?php
            if(isset($_POST['simpan'])){
                $kategori = htmlspecialchars($_POST['kategori']);

                $cekNama = mysqli_query($conn, "SELECT nama FROM kategori where nama='$kategori'");
                $jumlahDataKategori = mysqli_num_rows($cekNama);
                
                if($jumlahDataKategori > 0){
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Kategori Sudah Ada!
                    </div>
                    <?php 
                }
                else {
                 $querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");
                 if($querySimpan){
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Kategori Berhasil Disimpan
                    </div>
                    <meta http-equiv="refresh" content="0; url=kategori.php">
                    <?php
                 }
                 else{
                    echo mysqli_error($conn);
                 }   
                }
            }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>
        </div>
        <div class="table-responsive mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($jumlahKategori==0){
                        ?>
                        <tr>
                            <td colspan=3 class="text-center">Data Kategori tidak tersedia</td>
                        </tr>
                        <?php
                    }
                    else {
                        $number = 1;
                        while($data=mysqli_fetch_array($queryKategori)){
                            ?>
                            <tr>
                                <td><?php echo $number;?></td>
                                <td><?php echo $data['nama'];?></td>
                                <td>
                                    <a href="kategori-detail.php?y=<?php echo $data['id_kategori']; ?>"
                                    class="btn btn-info"><i class="fas fa-search"></i></a>
                                </td>
                            </tr>
                            <?php
                            $number++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
</div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>