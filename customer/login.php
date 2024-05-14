<?php
session_start();

// jika sudah login, alihkan ke halaman dasbor
if (isset($_SESSION['users'])) {
    header('Location:index.php');
    exit();
}
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<style>
    .main{
        height: 100vh;
    }
    .login-box{
        width: 500px;
        height: 300px;
        box-sizing: border-box;
        border-radius: 10px;
    }
</style>

</head>

<body>
<div class="main d-flex flex-column justify-content-center align-items-center">
<div class="login-box p-5 shadow">

<form action="ceklogin.php" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>

                <div>
                <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <div>
                    <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
                </div>
                <div>
                    Belum Memiliki Akun ? <a href="registrasi.php">Registrasi</a>
                </div>
            </form>
        </div>
</div>
</div>
        
</body>