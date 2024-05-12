<?php if(isset($_POST['deletebtn'])){
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
                $queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");

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