<?php
session_start();
require "../config.php";
if (!isset($_SESSION["login_admin"])) {
  header("location:../login.php");
}
if (isset($_POST["submit"])) {
  $nama_produk = $_POST["nama_produk"];
  $jenis = $_POST["jenis"];
  $harga_produk = $_POST["harga_produk"];
  $qty_produk = $_POST["qty_produk"];

  $sumber = @$_FILES['produk']['tmp_name'];
  $target = '../images/produk/';
  $nama = @$_FILES['produk']['name'];
  $pecah = explode('.', $nama);
  $time = time();
  $nama_gambar = $time . '.' . $pecah[1];

  if (@$_FILES['produk']['error'] > 0) {
    echo "
      <script>
      alert('Gambar Produk Tidak Boleh Kosong!');
      </script>
      ";
  } else if (@$_FILES['produk']['type'] != 'image/jpg' && @$_FILES['produk']['type'] != 'image/png' && @$_FILES['produk']['type'] != 'image/jpeg') {
    echo "
      <script>
      alert('Silahkan Upload Gambar Produk Dengan Benar!');
      </script>
      ";
  } else {
    $pindah = move_uploaded_file($sumber, $target . $nama_gambar);
    $tambah = sql("INSERT INTO produk (nama_produk,jenis,harga_produk,qty_produk,gambar_produk) VALUES ('$nama_produk','$jenis','$harga_produk','$qty_produk','$nama_gambar')");
    echo "
      <script>
      alert('Produk berhasil ditambahkan');
      document.location.href='daftar_produk.php';
      </script>
      ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="shortcut icon" href="../images/favicon.png" type="">
  <title>Science Coffee</title>

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- dataTable URL -->
  <link href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.css" rel="stylesheet" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">Science <sup>Coffee</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Kelola Pelanggan -->
      <li class="nav-item">
        <a class="nav-link" href="daftar_pelanggan.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Kelola Pelanggan</span></a>
      </li>
      <!-- Nav Item - Kelola Produk -->
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-table"></i>
          <span>Kelola Produk</span></a>
      </li>
      <!-- Nav Item - Kelola Transaksi -->
      <li class="nav-item">
        <a class="nav-link" href="daftar_transaksi.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Kelola Transaksi</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo Admin</span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
          </div>

          <!-- Content Row -->
          <!-- Data Table -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_produk" class="form-label">Nama Produk</label>
                  <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" required>
                </div>
                <div class="mb-3">
                  <label for="jenis" class="form-label">Jenis Makanan atau Minuman</label>
                  <select class="form-select" name="jenis" required>
                    <option selected disabled>Pilih jenis makanan atau minuman</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="harga_produk" class="form-label">Harga Produk</label>
                  <input type="text" class="form-control" id="harga_produk" name="harga_produk" placeholder="Harga Produk" required>
                </div>
                <div class="mb-3">
                  <label for="qty_produk" class="form-label">Qty Produk</label>
                  <input type="text" class="form-control" id="qty_produk" name="qty_produk" placeholder="Qty Produk" required>
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label">Gambar Produk</label>
                  <input class="form-control" type="file" id="formFile" name="produk" required>
                </div>
                <a href="daftar_produk.php" class="btn btn-outline-secondary">Kembali ke daftar</a>
                <button type="submit" name="submit" class="btn btn-primary" style="width: 150px;">Submit</button>
              </form>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Science Coffee 2023</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../sbadmin/vendor/jquery/jquery.min.js"></script>
  <script src="../sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../sbadmin/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../sbadmin/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../sbadmin/js/demo/chart-area-demo.js"></script>
  <script src="../sbadmin/js/demo/chart-pie-demo.js"></script>

</body>

</html>