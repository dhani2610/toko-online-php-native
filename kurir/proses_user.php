<?php
    include "connector.php";

if (isset($_POST['registrasi'])) {
        $role = $_POST['role'];
        $username = $_POST['username'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
    $query = mysqli_query($conn, "SELECT * 
                                    FROM `users` 
                                    WHERE username='$username'");

    $count = mysqli_num_rows($query);
    if ($count > 0) {
        echo "
        <script>
            alert('Username Sudah Di Gunakan!');
            window.location.href='registrasi.php';
        </script>";
        die;
    }
    if ($password1 == $password2) {
        $password = md5($password1);
    }else {
        echo "
        <script>
            alert('Password Tidak Sama!');
            window.location.href='registrasi.php';
        </script>";
        die;
    }

    $sql = "INSERT INTO `users` VALUES (NULL, '$role', '$username', 
			  '$password');";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "
		<script>
				alert('Registrasi Berhasil!');
				window.location.href='login.php';
		</script>";
    } else {
        echo "
		<script>
		alert('Registrasi Gagal,Coba Lagi!');
		window.location.href='registrasi.php';
		</script>";
    }
}
?>