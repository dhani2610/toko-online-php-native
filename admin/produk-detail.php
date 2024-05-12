<?php
include "connector.php";

// Start output buffering
ob_start();

if (isset($_GET['y'])) {
    $id_produk = $_GET['y'];

    // Query untuk mendapatkan data produk
    $query_produk = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.id_kategori = b.id_kategori WHERE a.id_produk='$id_produk'");

    if ($query_produk) {
        $data_produk = mysqli_fetch_assoc($query_produk);

        if ($data_produk) {
?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Produk Detail</title>
                <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
                <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
            </head>

            <style>
                form div {
                    margin-bottom: 10px;
                }
            </style>

            <body>
                <?php require "navbar.php"; ?>

                <div class="container mt-3">
                    <h2>Detail Produk</h2>

                    <div class="col-12 col-md-5">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div>
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" value="<?php echo $data_produk['nama']; ?>" class="form-control" autocomplete="off" required>
                            </div>
                            <div>
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control" required>
                                    <option value="<?php echo $data_produk['id_kategori']; ?>"><?php echo $data_produk['nama_kategori'] ?></option>
                                    <?php
                                    $queryAllKategori = mysqli_query($conn, "SELECT * FROM kategori");
                                    while ($dataKategori = mysqli_fetch_array($queryAllKategori)) {
                                    ?>
                                        <option value="<?php echo $dataKategori['id_kategori'] ?>"><?php echo $dataKategori['nama'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div>
                                <label for="currentFoto">Foto produk sekarang</label><br>
                                <img src="../image/<?php echo $data_produk['foto']; ?>" alt="" width="300px">
                            </div>

                            <div>
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                            </div>

                            <div>
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" value='<?php echo $data_produk['harga']; ?>' name="harga" required>
                            </div>
                            <div>
                                <label for="detail">Detail</label>
                                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo $data_produk['detail']; ?></textarea>
                            </div>
                            <div>
                                <label for="ketersediaan_stok">Ketersediaan Stok</label>
                                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                                    <option value="<?php echo $data_produk['ketersediaan_stok'] ?>"><?php echo $data_produk['ketersediaan_stok']; ?></option>
                                    <?php
                                    if ($data_produk['ketersediaan_stok'] == 'tersedia') {
                                    ?>
                                        <option value="habis">habis</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="tersedia">tersedia</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" value='<?php echo $data_produk['stok']; ?>' name="stok" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                                <button type="submit" class="btn btn-danger" name="delete">Hapus</button>
                            </div>
                        </form>

                        <?php
                        if (isset($_POST['simpan'])) {
                            // Example of getting form data
                            $nama = htmlspecialchars($_POST['nama']);
                            $kategori = htmlspecialchars($_POST['kategori']);
                            $harga = htmlspecialchars($_POST['harga']);
                            $detail = htmlspecialchars($_POST['detail']);
                            $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);
                            $stok = htmlspecialchars($_POST['stok']);

                            // Proses update data ke dalam database
                            $queryUpdate = mysqli_query($conn, "UPDATE produk SET
                                id_kategori='$kategori',
                                nama='$nama',
                                harga='$harga',
                                detail='$detail',
                                ketersediaan_stok='$ketersediaan_stok',
                                stok='$stok'
                                WHERE id_produk='$id_produk'");

                            // Check if the update query was successful
                            if ($queryUpdate) {
                                // Upload and update the photo if a new one is selected
                                if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
                                    $target_dir = "../image/";
                                    $nama_file = basename($_FILES["foto"]["name"]);
                                    $target_file = $target_dir . $nama_file;
                                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                                    // Check if the file is an image
                                    $check = getimagesize($_FILES["foto"]["tmp_name"]);
                                    if ($check !== false) {
                                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $nama_file);
                                        $queryUpdateFoto = mysqli_query($conn, "UPDATE produk SET foto='$nama_file' WHERE id_produk='$id_produk'");
                                        if (!$queryUpdateFoto) {
                                            echo "Error updating photo: " . mysqli_error($conn);
                                        }
                                    } else {
                                        echo "File is not an image.";
                                    }
                                }

                                // Redirect to produk.php
                                header('Location: produk.php');
                                exit(); // Ensure that no more output is sent
                            } else {
                                echo "Error updating data: " . mysqli_error($conn);
                            }
                        }

                        if (isset($_POST['delete'])) {
                            // Handle delete operation here
                            $queryDelete = mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id_produk'");

                            if ($queryDelete) {
                                ?>
                                <div class="alert alert-primary mt-3" role="alert">
                                    Produk Berhasil Di-Hapus
                                </div>
                                <meta http-equiv="refresh" content="0; url=produk.php">
                            <?php
                            // Redirect or display a success message as needed
                            } else {
                                echo "Error deleting data: " . mysqli_error($conn);
                            }
                        }
                        ?>

                    </div>
                </div>

                <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="../fontawesome/js/all.min.js"></script>
            </body>

            </html>

<?php
        } else {
            echo "Data tidak ditemukan";
        }
    } else {
        echo "Query error: " . mysqli_error($conn);
    }
} else {
    echo "Parameter 'y' tidak terdefinisi atau NULL";
}

ob_end_flush();
?>
