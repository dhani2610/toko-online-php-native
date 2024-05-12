<?php
include "connector.php";
$id = $_GET['y'];
$query = mysqli_query($conn, "SELECT * FROM kategori where id_kategori='$id'");
$data = mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

</head>
<style>
    .no-decoration{
        text-decoration: none;
    }
    
</style>
<body>
    <?php require "navbar.php";?>
    <div class="container mt-3">
    <h2>Detail Kategori</h2>

    <div class="col-12 col-md-6">
    <form action="" method="post">
        <div>
        <label for="kategori">Kategori</label>
        <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama']?>">
        </div>
    <div class="mt-3 d-flex justify-content-between">
        <button type="submit" class="btn btn-primary" name="editbtn">Edit</button>
        <button type="submit" class="btn btn-danger" name="deletebtn">Delete</button>
    </div>

    </form>
    <?php
    if(isset($_POST['editbtn'])){
        $kategori = htmlspecialchars($_POST['kategori']);

        if($data['nama']==$kategori){
            ?>
            <meta http-equiv="refresh" content="0; url=kategori.php">
            <?php
        }
        else{
            $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama='$kategori'");
            $jumlahData = mysqli_num_rows($query);

            if($jumlahData>0){
                ?>
                <div class="alert alert-warning mt-3" role="alert">
                        Kategori Sudah Ada!
                    </div>
                <?php
            }
            else {
                $querySimpan = mysqli_query($conn, "UPDATE kategori SET nama='$kategori' WHERE
                id_kategori='$id'");
                 if($querySimpan){
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Kategori Berhasil Di-Update
                    </div>
                    <meta http-equiv="refresh" content="0; url=kategori.php">
                    <?php
            }
            else{
                echo mysqli_error($conn);
            }
        }
        }
    }
            if(isset($_POST['deletebtn'])){
                $queryCheck = mysqli_query($conn, "SELECT * FROM produk WHERE id_kategori='$id'");
                $dataCek = mysqli_num_rows($queryCheck);
                if($dataCek > 0){
                    ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Kategori Tidak Bisa Dihapus Karena Sudah Digunakan Di Produk!
                    </div>
                    <?php
                    die();
                }
                $queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori='$id'");

                if($queryDelete){
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Kategori Berhasil Di-Hapus
                    </div>
                    <meta http-equiv="refresh" content="0; url=kategori.php">
                    <?php
                }
                else{
                    echo mysqli_error($conn);
                }
            }
    ?>
    </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>