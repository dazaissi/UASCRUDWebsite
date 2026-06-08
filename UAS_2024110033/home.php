<?php
session_start();

if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2')) {
    header("Location: login.php");
    exit;
}

require('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home Aplikasi Lembur Pegawai</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

<?php require('navigasi.php'); ?>

<?php
  $qTotalData = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM lembur");
  $totalData = mysqli_fetch_assoc($qTotalData)['total'];

  $qTotalPegawai = mysqli_query($koneksi, "SELECT COUNT(DISTINCT nama_peg) AS total FROM lembur");
  $totalPegawai = mysqli_fetch_assoc($qTotalPegawai)['total'];

  $qTotalJam = mysqli_query($koneksi, "SELECT COALESCE(SUM(durasi), 0) AS total FROM lembur");
  $totalJam = mysqli_fetch_assoc($qTotalJam)['total'];
?>

<div class="container" style="margin-top:80px">

  <div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
    <div class="container-fluid py-3">
      <h1 class="display-6 fw-bold text-success">Aplikasi Lembur Pegawai</h1>

      <p class="col-md-8 fs-5">
        Sistem sederhana untuk mencatat data lembur pegawai, menghitung durasi lembur, 
        dan menampilkan laporan lembur berdasarkan kode pekerjaan.
      </p>

      <?php
        if ($_SESSION['StatusUser'] == 'valid1') {
            echo "<div class='alert alert-success mt-3'>Anda login sebagai Admin</div>";
        } else {
            echo "<div class='alert alert-info mt-3'>Anda login sebagai Manajer</div>";
        }
      ?>
<div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
      <a href="lembur.php" class="btn btn-success mt-3">Input Data Lembur</a>
      <a href="laporan.php" class="btn btn-outline-success mt-3">Lihat Laporan</a>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4 mb-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Total Data Lembur</h6>
          <h2 class="fw-bold text-success"><?php echo $totalData; ?></h2>
          <p class="mb-0">Data lembur tersimpan</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Total Pegawai</h6>
          <h2 class="fw-bold text-success"><?php echo $totalPegawai; ?></h2>
          <p class="mb-0">Pegawai yang tercatat</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h6 class="text-muted">Total Jam Lembur</h6>
          <h2 class="fw-bold text-success"><?php echo $totalJam; ?></h2>
          <p class="mb-0">Akumulasi jam lembur</p>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-0 shadow-sm mb-5">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0">Data Lembur Terbaru</h5>
    </div>

    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead class="table-success">
          <tr>
            <th>Nomor</th>
            <th>Tanggal</th>
            <th>Nama Pegawai</th>
            <th>Kode Pekerjaan</th>
            <th>Durasi</th>
          </tr>
        </thead>

        <tbody>
          <?php
            $sql = "SELECT nomor, tanggal, nama_peg, kode_pek, durasi 
                    FROM lembur 
                    ORDER BY nomor DESC 
                    LIMIT 5";

            $query = mysqli_query($koneksi, $sql) 
                     or die("SQL Error: " . mysqli_error($koneksi));

            if (mysqli_num_rows($query) > 0) {
              while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>".$row['nomor']."</td>";
                echo "<td>".$row['tanggal']."</td>";
                echo "<td>".$row['nama_peg']."</td>";
                echo "<td>".$row['kode_pek']."</td>";
                echo "<td>".$row['durasi']." jam</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr>";
              echo "<td colspan='5' class='text-center'>Belum ada data lembur</td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php mysqli_close($koneksi); ?>

</body>
</html>