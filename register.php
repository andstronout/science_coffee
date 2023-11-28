<?php
session_start();
require "config.php";
$register = register();

if (isset($_SESSION['login_user'])) {
  header("location:index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Science Coffee</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="min-height: 100vh; background-size: cover; background-image: url(images/bg_4.jpg);">
    <div class="container-fluid">
      <div class="row  justify-content-center align-items-center d-flex-row text-center h-100">
        <div class="col-12 col-md-4 col-lg-5">
          <div class="card shadow">
            <div class="card-body col-10 mx-auto">
              <h4 class="card-title mt-3 mb-3 text-center">Register Account</h4>
              <form action="" method="post">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control form-control-sm" id="floatingInput" placeholder="Nama Lengkap" name="nama_user" required>
                  <label for="floatingInput">Nama Lengkap</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="email" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com" name="email" required>
                  <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control form-control-sm" id="floatingInput" placeholder="Nomor Handphone" name="nomor_hp" required>
                  <label for="floatingInput">Nomor Handphone</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control form-control-sm" id="floatingPassword" placeholder="Password" name="password" required>
                  <label for="floatingPassword">Password</label>
                </div>
                <div class="form-group mb-2">
                  <button type="submit" name="submit" class="btn btn-info btn-block" style="width: 200px;"> Register </button>
                </div>
                <p class="text-center">Have an account?
                  <a href="login.php" class="text-secondary">Login Now</a>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>