<?php
session_start();
require "config.php";
$conn = koneksi();
$id = $_SESSION['id_pelanggan'];
$sql = $conn->query("SELECT * FROM transaksi WHERE id_user='$id' AND `status`='Sedang Diproses'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Science Coffee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">


  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="#">Science<small>Coffee</small></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="index.php#menu" class="nav-link">Menu</a></li>
          <?php
          if (!isset($_SESSION['login_pelanggan'])) { ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
          <?php } else { ?>
            <?php
            $sql_user = $conn->query("SELECT * FROM user WHERE id_user='$_SESSION[id_pelanggan]'");
            $user = $sql_user->fetch_assoc();
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="room.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Halo <?= $user['nama_user']; ?></a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="#">Pesanan Saya</a>
                <a class="dropdown-item" href="ubah_profil.php">Ubah Profil</a>
                <a class="dropdown-item" href="ubah_password.php">Ubah Password</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center">

          <div class="col-md-7 col-sm-12 text-center ftco-animate">
            <h1 class="mb-3 mt-5 bread">Pesanan Saya</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Pesanan Saya</span></p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-cart">
    <div class="container">
      <h2 class="mb-4 text-center">Pesanan Saya</h2>
      <div class="row d-flex justify-content-center mb-4">
        <div class="col-md-3">
          <a href="pesanan_saya.php" class="btn btn-primary btn-outline-primary" style="height: 45px;">
            <h4>Belum Diproses </h4>
          </a>
        </div>
        <div class="col-md-3">
          <a href="#" class="btn btn-primary btn-outline-primary active" style="height: 45px;">
            <h4>Sedang Diproses</h4>
          </a>
        </div>
        <div class="col-md-3">
          <a href="pesanan_selesai.php" class="btn btn-primary btn-outline-primary" style="height: 45px;">
            <h4>Selesai Diproses</h4>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 ftco-animate">
          <div class="cart-list">
            <table class="table">
              <thead class="thead-primary">
                <tr class="text-center">
                  <th>&nbsp;</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($sql->num_rows > 0) {
                  foreach ($sql as $transaksi) { ?>
                    <div class="row" style="width: 100%;">
                      <div class="col-10">
                        <tr>
                          <td>Pesanan : <?= $transaksi['id_pesanan']; ?></td>
                        </tr>
                      </div>
                    </div>
                    <?php
                    $sql_detail = $conn->query("SELECT * FROM detail_transaksi INNER JOIN transaksi ON detail_transaksi.id_transaksi=transaksi.id_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk WHERE id_user='$_SESSION[id_pelanggan]' AND `status`='Sedang Diproses' AND transaksi.id_transaksi='$transaksi[id_transaksi]'");
                    foreach ($sql_detail as $detail) { ?>
                      <tr class="text-center">
                        <td class="image-prod">
                          <div class="img" style="background-image:url(images/produk/<?= $detail['gambar_produk']; ?>);"></div>
                        </td>

                        <td class="product-name">
                          <h3><?= $detail['nama_produk']; ?></h3>
                        </td>

                        <td class="price"><?= 'Rp. ' . number_format($detail['harga_produk']); ?></td>

                        <td class="quantity">
                          <div class="input-group mb-3">
                            <input type="text" name="quantity" class="quantity form-control input-number" value="<?= $detail['qty_transaksi']; ?>" min="1" max="100" disabled>
                          </div>
                        </td>
                      </tr><!-- END TR-->
                  <?php
                    }
                  }
                } else { ?>
                  <tr>
                    <td colspan="6">
                      <div class=" alert alert-info text-center" role="alert">
                        Anda belum memesan pesanan.</a>
                      </div>
                    </td>
                  <?php } ?>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>


</body>

</html>