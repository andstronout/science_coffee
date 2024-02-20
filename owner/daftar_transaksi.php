<?php
session_start();
require "../config.php";
if (!isset($_SESSION["login_owner"])) {
  header("location:../login.php");
}

$sql_produk = sql("SELECT * FROM transaksi INNER JOIN user ON transaksi.id_user=user.id_user ORDER BY `transaksi`.`tanggal_transaksi` DESC");
$no = 1;
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
      <li class="nav-item">
        <a class="nav-link" href="daftar_produk.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Kelola Produk</span></a>
      </li>
      <!-- Nav Item - Kelola Transaksi -->
      <li class="nav-item active">
        <a class="nav-link" href="#.php">
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo Owner</span>
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
            <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
          </div>

          <!-- Content Row -->
          <!-- Data Table -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <form class="row g-3" action="" method="post">
                <div class="col-auto">
                  <label for="">Dari Tanggal</label>
                  <input type="date" class="form-control" name="t_awal" required>
                </div>
                <div class="col-auto">
                  <label for="">Ke Tanggal</label>
                  <input type="date" class="form-control" name="t_akhir" required>
                </div>
                <div class="col-auto mt-4">
                  <button type="submit" class="btn btn-secondary btn-sm" name="simpan">Simpan</button>
                  <a href="daftar_transaksi.php" class="btn btn-outline-secondary btn-sm">Reset</a>
                </div>
              </form>
              <?php
              if (isset($_POST['simpan'])) {
                // var_dump($_POST["t_awal"], $_POST["t_akhir"]);
                $_SESSION["awal"] = $_POST["t_awal"];
                $_SESSION["akhir"] = $_POST["t_akhir"];
                $sql_produk = sql("SELECT * FROM transaksi 
                INNER JOIN user ON transaksi.id_user=user.id_user 
                WHERE transaksi.tanggal_transaksi BETWEEN '$_SESSION[awal]' AND '$_SESSION[akhir]'
                ORDER BY transaksi.tanggal_transaksi
                ");
              } else {
                $sql_produk = sql("SELECT * FROM transaksi INNER JOIN user ON transaksi.id_user=user.id_user ORDER BY `transaksi`.`tanggal_transaksi` DESC");
              }
              ?>
              <br>
              <div class="table-responsive">
                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width=5%>No</th>
                      <th>Nomor Transaksi</th>
                      <th>Nama Pelanggan</th>
                      <th>Tanggal Transaksi</th>
                      <th>Total Bayar</th>
                      <th>Bukti Bayar</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($sql_produk as $transaksi) : ?>
                      <tr>
                        <th class="text-center"><?= $no; ?></th>
                        <th><?= $transaksi['id_pesanan']; ?></th>
                        <th><?= $transaksi['nama_user']; ?></th>
                        <th><?= $transaksi['tanggal_transaksi']; ?></th>
                        <th><?= 'Rp. ' . number_format($transaksi['total_transaksi']); ?></th>
                        <th>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lihatbuktiModal<?= $transaksi['id_transaksi'] ?>">
                            Lihat Bukti
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="lihatbuktiModal<?= $transaksi['id_transaksi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="card bg-dark text-white">
                                    <img src="../images/bukti_bayar/<?= $transaksi['bukti_bayar']; ?>" class="card-img" alt="...">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </th>
                        <th><?= $transaksi['status']; ?></th>
                      </tr>
                    <?php
                      $no++;
                    endforeach ?>
                  </tbody>
                </table>
              </div>
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

  <!-- Datatables -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            title: 'Data Transaksi',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 6]
            }
          },
          {
            extend: 'pdfHtml5',
            title: 'Data Transaksi',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 6]
            }
          }
        ]
      });
    });
  </script>

</body>

</html>