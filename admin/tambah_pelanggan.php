<?php
session_start();
require '../config.php';
if (!isset($_SESSION['login_admin'])) {
  header("location:login.php");
}

if (isset($_POST["submit"])) {
  $password = md5($_POST["password"]);
  $sql_user = sql("SELECT email FROM user WHERE email='$_POST[email]'");
  $user = $sql_user->fetch_assoc();
  if (!empty($user)) {
    echo "
        <script>
        alert('Email sudah digunakan');
        document.location.href = 'registrasi.php';
        </script>
        ";
  } else {
    $tambah = sql("INSERT INTO user (nama_user, email, `password`, nomor_hp, `level`) VALUES ('$_POST[nama_user]','$_POST[email]','$password','$_POST[nomor_hp]','1')");
    echo "
        <script>
        alert('Data berhasil Ditambahkan');
        document.location.href = 'daftar_pelanggan.php';
        </script>
        ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../images/favicon.png" type="">
  <title>Science Coffee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-color: #eaeaea;">
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-4">Registrasi </h2>
        <div class="card my-3">
          <form class="card-body cardbody-color p-lg-5" method="post">
            <div class="mb-3">
              <input type="text" class="form-control" id="nama" aria-describedby="namaHelp" placeholder="Masukan Nama Lengkap" name="nama_user" required>
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Masukan Email" name="email" required>
            </div>
            <div class="mb-3">
              <input type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" id="nomor_hp" aria-describedby="nomor_hpHelp" placeholder="Masukan Nomor Handphone" name="nomor_hp" required>
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="password" placeholder="Masukan Password" name="password" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-outline-info px-5 mb-3 w-100" name="submit">Tambah Pelanggan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script src="<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>