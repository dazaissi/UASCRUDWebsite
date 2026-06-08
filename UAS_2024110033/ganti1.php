<?php
session_start();

if (!isset($_SESSION['StatusUser']) || $_SESSION['StatusUser'] != 'valid1') {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi Lembur Pegawai</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php
  require('navigasi.php');
?>   
<div class="container" style="margin-top:80px">
<h2>Edit Data Lembur</h2>
<?php

   $nomor = $_GET['nomor'];

   // Buka koneksi database
   require('koneksi.php');

   $sql = "select nomor, tanggal, nama_peg, kode_pek, durasi from lembur where nomor='$nomor'";
   $query = mysqli_query($koneksi,$sql) 
            or die('SQL error: '. mysqli_error($koneksi));
   $row = mysqli_fetch_array($query);
  echo "<FORM METHOD='get' ACTION='ganti2.php'>

    <label for='tb1'>No lembur :</label>
    <input type='text' class='form-control' id='tb2' value='$row[NOMOR]' name='nomor' readonly>
	
    <br><label for='tb2'>Tanggal :</label>
    <input type='text' class='form-control' id='tb2' value='$row[tanggal]' name='tanggal'>

    <br><label for='tb3'>Nama Pegawai :</label>
    <input type='text' class='form-control' id='tb3' value='$row[nama_peg]' name='nama_peg'>

    <label for='tb4'>Kode Pekerjaan</label>
    <select class='form-control' id='tb4' name='kode_pek' required>
    <option value=''>Pilih Status</option>
    <option value='A'>Auditor</option>
    <option value='P'>Programmer</option>
    <option value='S'>Sales</option>
          </select>
        </div>
	
    <br><label for='tb5'>Durasi</label>
    <input type='text' class='form-control' id='tb5' value='$row[durasi]' name='durasi'>
	
	<br><button type='submit' class='btn btn-outline-success btn-sm'>Rekam</button>
	<button type='reset' class='btn btn-outline-success btn-sm'>Hapus Form</button>
    </FORM>";
   
   // Tutup koneksi database
   mysqli_close($koneksi);
?>
</div>
</body></html>