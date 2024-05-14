<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php

    ?>
    <div class="container mt-3">
        <form method="post" action="proses_user.php">
            <h1>Regitstrasi</h1>
      
            Username  
            <input type="text" name="username" class="form-control w-50 enter mb-4" placeholder=" Masukan Username" required>
            
            Password
            <input type="password" name="password1" class="form-control w-50 enter mb-4" placeholder=" Masukan Password" required>
            
            Konfirmasi Password
            <input type="password" name="password2" class="form-control w-50 enter mb-4" placeholder=" Konfirmasi Password" required>
            
            <input type="hidden" value="3" name="role">
            
            <button type="submit" name="registrasi" class="btn btn-primary w-50 enter mb-4">Registrasi</button>
        </form>
    </div>

</body>

</html>