<?php
session_start();
require "config.php";
if (!isset($_SESSION['login_pelanggan'])) {
  header("location:login.php");
}
$conn = koneksi();
$id = $_SESSION['id_pelanggan'];
$sql = $conn->query("SELECT * FROM cart INNER JOIN produk ON cart.id_produk=produk.id_produk WHERE id_user='$id'");
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
                <a class="dropdown-item" href="pesanan_saya.php">Pesanan Saya</a>
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
            <h1 class="mb-3 mt-5 bread">Cart</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="#">Home</a></span> <span>Cart</span></p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-cart">
    <div class="container">
      <div class="row">
        <div class="col-md-12 ftco-animate">
          <div class="cart-list">
            <table class="table">
              <thead class="thead-primary">
                <tr class="text-center">
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($sql->num_rows > 0) {
                  $jumlah_bayar = 0;
                  foreach ($sql as $cart) { ?>
                    <tr class="text-center">
                      <td class="product-remove"><a href="delete_cart.php?id=<?= $cart['id_cart']; ?>"><span class="icon-close"></span></a></td>

                      <td class="image-prod">
                        <div class="img" style="background-image:url(images/produk/<?= $cart['gambar_produk']; ?>);"></div>
                      </td>

                      <td class="product-name">
                        <h3><?= $cart['nama_produk']; ?></h3>
                      </td>

                      <td class="price"><?= 'Rp. ' . number_format($cart['harga_produk']); ?></td>

                      <td class="quantity">
                        <div class="input-group mb-3">
                          <input type="text" name="quantity" class="quantity form-control input-number" value="<?= $cart['qty_cart']; ?>" min="1" max="100" disabled>
                        </div>
                      </td>
                      <?php
                      $total = $cart['harga_produk'] * $cart['qty_cart'];
                      ?>
                      <td class="total"><?= 'Rp. ' . number_format($total); ?></td>
                    </tr><!-- END TR-->
                  <?php
                    $jumlah_bayar += $total;
                  }
                } else { ?>
                  <tr>
                    <td colspan="6">
                      <div class=" alert alert-info text-center" role="alert">
                        Keranjang belanja kosong. Silahkan pilih barang terlebih dahulu. <a href="index.php#produk">Pilih Produk</a>
                      </div>
                    </td>
                  <?php } ?>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
          <div class="cart-total mb-3">
            <h3>Masih mau pilih menu?</h3>
            <p class="d-flex">
            </p>
          </div>
          <p class="text-center"><a href="index.php#menu" class="btn btn-outline-primary py-3 px-4">Kembali ke daftar menu</a></p>
        </div>
        <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
          <div class="cart-total mb-3">
            <h3>Cart Totals</h3>
            <p class="d-flex">
              <span>Subtotal</span>
              <span><?= 'Rp. ' . number_format($jumlah_bayar); ?></span>
            </p>
          </div>
          <p class="text-center"><a href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
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