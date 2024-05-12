<?php
include "connector.php";

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.id_kategori = b.id_kategori");
$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />

    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<style>
    .no-decoration {
        text-decoration: none;
    }
    form div {
        margin-bottom: 10px;
    }
</style>
<body>
    <?php require "navbar.php";?>
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <!-- Breadcrumb -->
        </nav>
        <!-- Tambah Produk -->
        <div class="my-3 col-12 col-md-6">
            <h3>Tambah Produk</h3>

            <?php
            if(isset($_POST['simpan'])){
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);
                $stok = htmlspecialchars($_POST['stok']);

                // Validasi Kategori
                $queryCheckKategori = mysqli_query($conn, "SELECT id_kategori FROM kategori WHERE id_kategori = '$kategori'");
                if(mysqli_num_rows($queryCheckKategori) == 0) {
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Kategori tidak valid. Pilih kategori yang benar.
                    </div>
                    <?php
                } else {
                    // Penanganan file upload
                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if($nama_file != ''){
                        if($image_size > 500000){
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                File Tidak Boleh Lebih Dari 500kb
                            </div>
                            <?php
                        } else {
                            if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif'){
                                ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File wajib bertipe jpg, png dan gif
                                </div>
                                <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                            }
                        }
                    }

                    // Query untuk menambahkan produk
                    $queryTambah = mysqli_query($conn, "INSERT INTO produk (id_kategori, nama, harga, foto, detail, ketersediaan_stok, stok) 
                        VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok', '$stok')");
                    
                    if($queryTambah){
                        ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Produk Berhasil Disimpan!
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            Gagal menyimpan produk. <?php echo mysqli_error($conn); ?>
                        </div>
                        <?php
                    }
                }
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                    value="<?php echo $_POST['nama'] ?? '';?>"
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">Pilih Salah Satu</option>
                        <?php
                        while($data=mysqli_fetch_array($queryKategori)){
                            ?>
                            <option value="<?php echo $data['id_kategori']?>"><?php echo $data['nama'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" required>
                    value="<?php echo $_POST['harga'] ?? '';?>"
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="tersedia">tersedia</option>
                        <option value="habis">habis</option>
                    </select>
                </div>
                <div>
                    <label for="stok">Stok</label>
                    <input type="number" class="form-control" name="stok" required>
                    value="<?php echo $_POST['stok'] ?? '0';?>"
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>
        </div>

        <div class="table-responsive mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Foto</th>
                        <th>Harga</th>
                        <th>Detail</th>
                        <th>Keterangan Stok</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($jumlahProduk == 0){
                        ?>
                        <tr>
                            <td colspan=7 class="text-center">Data Produk Tidak Tersedia</td>
                        </tr>
                        <?php
                    } else {
                        $jumlah = 1;
                        while($data = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td><?php echo $jumlah;?></td>
                                <td><?php echo $data['nama'];?></td>
                                <td><?php echo $data['nama_kategori'];?></td>
                                <td><img src="../image/<?php echo $data['foto']?>" alt="" style="width: 100px;"></td>
                                <td><?php echo $data['harga'];?></td>
                                <td><?php echo $data['detail'];?></td>
                                <td><?php echo $data['ketersediaan_stok'];?></td>
                                <td><?php echo $data['stok'];?></td>
                                <td>
                                    <a href="produk-detail.php?y=<?php echo $data['id_produk']; ?>" class="btn btn-info">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            $jumlah++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
