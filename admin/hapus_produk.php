<?php
$id = $_GET["id"];
require "../config.php";
$hapus = sql("DELETE FROM produk WHERE id_produk='$id'");
echo "
            <script>
            alert('Produk berhasil dihapus');
            document.location.href='daftar_produk.php';
            </script>
            ";
