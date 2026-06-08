<?php
session_start();

if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1')) {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aplikasi Lembur Pegawai - Input </title>
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
  <h2>Input Data Lembur Pegawai</h2>
  <form METHOD="GET" ACTION="tambah2.php">

     <div class="card-body">
      <form method="POST" action="add2_transaksi.php">

        <div class="mb-3">
          <label for="tb1" class="form-label">No Lembur:</label>
          <input type="text" 
                 class="form-control" 
                 id="tb1" 
                 placeholder="Isikan Nomor Lembur" 
                 name="nomor" 
                 required>
        </div>

        <div class="mb-3">
          <label for="tb2" class="form-label">Tanggal Lembur</label>
          <input type="date" 
                 class="form-control" 
                 id="tanggal" 
                 placeholder="Isikan Tanggal Lembur" 
                 name="tanggal" 
                 required>
        </div>

        <div class="mb-3">
          <label for="tb3" class="form-label">Nama Pegawai</label>
          <input type="text" 
                 class="form-control" 
                 id="tb3" 
                 placeholder="Isikan Nama Pegawai" 
                 name="nama_peg" 
                 required>
        </div>

        <div class="mb-3">
          <label for="tb4" class="form-label">Kode Pekerjaan</label>
          <select class="form-control" id="tb4" name="kode_pek" required>
            <option value="">Pilih Status</option>
            <option value="A">Auditor</option>
            <option value="P">Programmer</option>
            <option value="S">Sales</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="tb5" class="form-label">Durasi</label>
          <input type="number" 
                 class="form-control" 
                 id="tb5" 
                 placeholder="Isikan Berat" 
                 name="durasi" 
                 required>
        </div>
	
	<br><button type="submit" class="btn btn-outline-success btn-sm">Rekam</button>
	<button type="reset" class="btn btn-outline-success btn-sm">Hapus Form</button>
    <a href="lembur.php" class="btn btn-outline-danger btn-sm">Batal</a>
  </form>
</div>
</body></html>