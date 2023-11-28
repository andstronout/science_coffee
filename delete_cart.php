<?php
require 'config.php';
$conn = koneksi();
$id = $_GET['id'];
$hapus = $conn->query("DELETE FROM cart WHERE id_cart ='$id'");

echo "
      <script>
      alert('Produk dihapus dari Keranjang!');
      document.location.href = 'cart.php';
      </script>
      ";
