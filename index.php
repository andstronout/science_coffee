<?php
session_start();
require "config.php";
$conn = koneksi();

if (isset($_POST["submit"])) {
  $cart = cart();
}

$sql_produk = $conn->query("SELECT * FROM produk");
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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
          <li class="nav-item"><a href="#menu" class="nav-link">Menu</a></li>
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
          <li class="nav-item cart"><a href="cart.php" class="nav-link"><span class="icon icon-shopping_cart"></span><span class="bag d-flex justify-content-center align-items-center">
                <?php
                $cart = 0;
                if (isset($_SESSION['login_pelanggan'])) {
                  $result = $conn->query("SELECT * FROM cart WHERE id_user='$_SESSION[id_pelanggan]'");
                  if ($result) {
                    $cart = mysqli_num_rows($result);
                  }
                }
                ?>
                <small><?= $cart; ?></small></span></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(images/bg_1.jpg);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-md-8 col-sm-12 text-center ftco-animate">
            <span class="subheading">Welcome</span>
            <h1 class="mb-4">The Best Coffee Testing Experience</h1>
            <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            <p>
              <a href="#product" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a>
            </p>
          </div>

        </div>
      </div>
    </div>

    <div class="slider-item" style="background-image: url(images/bg_2.jpg);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-md-8 col-sm-12 text-center ftco-animate">
            <span class="subheading">Welcome</span>
            <h1 class="mb-4">Amazing Taste &amp; Beautiful Place</h1>
            <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            <p>
              <a href="#product" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a>
            </p>
          </div>

        </div>
      </div>
    </div>

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-md-8 col-sm-12 text-center ftco-animate">
            <span class="subheading">Welcome</span>
            <h1 class="mb-4">Creamy Hot and Ready to Serve</h1>
            <p class="mb-4 mb-md-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
            <p>
              <a href="#product" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a>
            </p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="ftco-menu" id="product">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <span class="subheading">Discover</span>
          <h2>Our Products</h2>
        </div>
      </div>
      <div class="row d-md-flex" id="menu">
        <div class="col-lg-12 ftco-animate p-md-5">
          <div class="row">
            <div class="col-md-12 d-flex align-items-center">

              <div class="tab-content ftco-animate" id="v-pills-tabContent" style="width: 100%;">

                <div class="tab-pane fade show active" id="<?= $cek; ?>" role="tabpanel" aria-labelledby="<?= $cek; ?>-tab">
                  <div class="row">
                    <?php foreach ($sql_produk as $produk) : ?>
                      <div class="col-md-4 text-center">
                        <div class="menu-wrap">
                          <a href="#" class="menu-img img mb-4" style="background-image: url(images/produk/<?= $produk['gambar_produk']; ?>);"></a>
                          <div class="text">
                            <h3>
                              <a href="#"><?= $produk['nama_produk']; ?></a>
                            </h3>
                            <p class="price">
                              <span><?= number_format($produk['harga_produk']); ?></span>
                            </p>
                            <p>Qty Product :</p>
                            <div class="row">
                              <div class="col d-flex justify-content-center">
                                <form action="#" method="post" class="appointment-form">
                                  <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                                  <div class="d-md-flex">
                                    <div class="form-group" style="background-color:#37393b">
                                      <input type="number" value="1" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" name="qty_cart" class="form-control text-center" style="width: 40px;">
                                    </div>
                                    <div class="form-group ml-md-4">
                                      <?php if ($produk['qty_produk'] == 0) { ?>
                                        <p><i>Stock Habis</i></p>
                                      <?php } else { ?>
                                        <button type="submit" name="submit" class="btn btn-white py-3 px-4">Add to cart</button>
                                      <?php } ?>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach ?>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="ftco-footer ftco-section img">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">

          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved | Your Experience is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Science Coffee</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
      </div>
    </div>
  </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

</body>

</html>