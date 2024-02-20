<?php
require "config.php";
require_once __DIR__ . '/vendor/autoload.php'; // Sesuaikan dengan lokasi library MPDF


$id = $_GET["id"];
// $id = 20;
$sql_produk = sql("SELECT * FROM detail_transaksi INNER JOIN produk ON detail_transaksi.id_produk=produk.id_produk WHERE id_transaksi='$id'");
$no = 1;

$sql_transaksi = sql(("SELECT * FROM transaksi INNER JOIN user ON user.id_user=transaksi.id_user WHERE id_transaksi='$id'"));
$total = $sql_transaksi->fetch_assoc();

// Setup MPDF
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [80, 200]]);

// HTML content
$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Struk Pembayaran</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
    }
    .container {
      width: 200px;
      margin: 0 auto;
    }
    .header {
      text-align: center;
      font-size: 16px;
      margin-bottom: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
    }
    th, td {
      border: 1px solid #000;
      padding: 5px;
    }
    .total {
      text-align: right;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Science Coffee</h2>
      <p>Jl. Palma Raya, Kuta Baru, Pasar Kemis</p>
      <p>Kabupaten Tangerang, Banten 15560</p>
    </div>
    <div style="text-align: center;">
      <p>Nama Costumer : ' . $total['nama_user'] . '</p>
      <p>Id Pesanan : ' . $total['id_pesanan'] . '</p>
    </div>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>';
foreach ($sql_produk as $produk) {
  $html .= '<tr>
            <td>' . $no . '</td>
            <td>' . $produk['nama_produk'] . '</td>
            <td>' . number_format($produk['harga_produk']) . '</td>
            <td>' . $produk['qty_transaksi'] . '</td>
            <td>' . number_format($produk['harga_produk'] * $produk['qty_transaksi']) . '</td>
          </tr>';
  $no++;
}
$html .= '</tbody>
    </table>
    <div class="total">
      Total Harga : Rp ' . number_format($total['total_transaksi']) . '
    </div>
  </div>
</body>
</html>';

// Write HTML content to PDF
$mpdf->WriteHTML($html);

// Output PDF
$mpdf->Output('transaksi' . time(), \Mpdf\Output\Destination::INLINE);
