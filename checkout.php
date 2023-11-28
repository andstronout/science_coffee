<?php
session_start();
require "config.php";
$conn = koneksi();
if (!isset($_SESSION['login_pelanggan'])) {
  header("location:login.php");
}

$sql_cart = $conn->query("SELECT * FROM cart INNER JOIN produk ON cart.id_produk=produk.id_produk WHERE id_user='$_SESSION[id_pelanggan]'");
$total_harga = 0;
while ($cart = $sql_cart->fetch_assoc()) {
  $total_harga += $cart['harga_produk'] * $cart['qty_cart'];
}

if (isset($_POST["submit"])) {
  $id_user = $_SESSION['id_pelanggan'];
  $tanggal_transaksi = date("y-m-d");
  $total_transaksi = $total_harga;
  $status = 'Belum Diproses';
  $no_meja = $_POST["no_meja"];

  $sumber = @$_FILES['bukti_bayar']['tmp_name'];
  $target = 'images/bukti_bayar/';
  $nama_bukti_bayar = @$_FILES['bukti_bayar']['name'];

  if (@$_FILES['bukti_bayar']['error'] > 0) {
    echo "
    <script>
    alert('Bukti Bayar Tidak Boleh Kosong!');
    </script>
    ";
  } else if (@$_FILES['bukti_bayar']['type'] != 'image/jpg' && @$_FILES['bukti_bayar']['type'] != 'image/png' && @$_FILES['bukti_bayar']['type'] != 'image/jpeg') {
    echo "
    <script>
    alert('Silahkan Upload Bukti Bayar Dengan Benar!');
    </script>
    ";
  } else {
    $pindah = move_uploaded_file($sumber, $target . $nama_bukti_bayar);
    $tambah_transaksi = $conn->query("INSERT INTO transaksi (id_user,tanggal_transaksi,total_transaksi,bukti_bayar,`status`,no_meja) VALUES ('$id_user','$tanggal_transaksi','$total_transaksi','$nama_bukti_bayar','$status','$no_meja') ");
    $id_transaksi = $conn->insert_id;
    // var_dump($id_transaksi);

    $t = time();
    $id_pesanan = "NRJ" . $t;
    $update = $conn->query("UPDATE transaksi SET id_pesanan='$id_pesanan' WHERE id_transaksi='$id_transaksi'");

    foreach ($sql_cart as $cart) {
      $tambah_detail = $conn->query("INSERT INTO detail_transaksi (id_transaksi,id_produk,qty_transaksi) VALUES ('$id_transaksi','$cart[id_produk]','$cart[qty_cart]')");
      $total = $cart['qty_produk'] - $cart['qty_cart'];
      $update_stok = $conn->query("UPDATE produk SET qty_produk='$total' WHERE id_produk='$cart[id_produk]'");
    }

    $hapus_cart = $conn->query("DELETE FROM cart WHERE id_user='$id_user'");
    $url = "sukses.php?id=" . $id_transaksi;
    header("location:" . $url);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title> Science Coffee</title>
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
            <h1 class="mb-3 mt-5 bread">Checkout</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checout</span></p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 ftco-animate">
          <form action="#" method="post" enctype="multipart/form-data" class="billing-form ftco-bg-dark p-3 p-md-5">
            <h3 class="mb-4 billing-heading">Billing Details</h3>
            <div class="row align-items-end">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstname">Nama Lengkap</label>
                  <input type="text" class="form-control" value="<?= $user['nama_user']; ?>" disabled>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Nomor Meja</label>
                  <div class="select-wrap">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select name="no_meja" id="" class="form-control">
                      <option value="A1">A1</option>
                      <option value="A2">A2</option>
                      <option value="A3">A3</option>
                      <option value="A4">A4</option>
                      <option value="B1">B1</option>
                      <option value="B2">B2</option>
                      <option value="B3">B3</option>
                      <option value="B4">B4</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <small><label for="lastname">Silahkan masukan nomor meja yang tertera di meja anda.</label></small>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="formFileSm" class="form-label"><b>Upload bukti pembayaran disini</b></label>
                  <input class="form-control form-control-sm" id="formFileSm" type="file" name="bukti_bayar">
                </div>
              </div>

            </div>
        </div> <!-- .col-md-8 -->




        <div class="col-xl-4 sidebar ftco-animate">
          <div class="sidebar-box ftco-animate">
            <div class="categories mb-5">
              <h1>Bank Transfer</h1>
              <h6>Silahkan melakukan transfer pada rekening dibawah ini.</h6>
              <li class="text-white">BCA : 123123 <br> DANA : 123123</li>
            </div>
            <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
              <h3 class="billing-heading mb-4">Cart Total</h3>
              <p class="d-flex">
                <span>Subtotal</span>
                <span>Rp. <?= number_format($total_harga); ?>,-</span>
              </p>
              <p><button type="submit" name="submit" class="btn btn-primary py-3 px-4">Finish Payment</button></p>
            </div>
          </div>
          </form><!-- END -->

        </div>
      </div>
  </section> <!-- .section -->




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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

  <script>
    $(document).ready(function() {

      var quantitiy = 0;
      $('.quantity-right-plus').click(function(e) {

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

        $('#quantity').val(quantity + 1);


        // Increment

      });

      $('.quantity-left-minus').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

        // Increment
        if (quantity > 0) {
          $('#quantity').val(quantity - 1);
        }
      });

    });
  </script>


</body>

</html>