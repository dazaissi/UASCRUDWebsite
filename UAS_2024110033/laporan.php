<?php
session_start();
if (!isset($_SESSION['StatusUser']) || $_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2') {
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
  require('koneksi.php');
?>

<div class="container" style="margin-top:80px">
  <div class="card">
    <div class="card-header bg-success text-white">
      <h3 class="mb-0">Laporan Lembur Pegawai</h3>
    </div>

    <div class="card-body">
        <button onclick="window.print()" class="btn btn-outline-success btn-sm mb-3">
          Cetak Laporan
        </button>
    </div>

    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead class="table-success">
          <tr>
            <th>Kode Pekerjaan</th>
            <th>Jenis Pekerjaan</th>
            <th>Honor Lembur Perjam</th>
            <th>Frekuensi Lembur</th>
            <th>Jumlah Jam Lembur</th>
            <th>Jumlah Honor</th>
          </tr>
        </thead>

        <tbody>
        <?php
          $total = 0;

          $sql = "SELECT 
                    kode_pek,

                    CASE 
                      WHEN kode_pek = 'A' THEN 'Auditor'
                      WHEN kode_pek = 'P' THEN 'Programmer'
                      WHEN kode_pek = 'S' THEN 'Sales'
                      ELSE 'Tidak diketahui'
                    END AS jenis_pekerjaan,

                    CASE 
                      WHEN kode_pek = 'A' THEN 50000
                      WHEN kode_pek = 'P' THEN 75000
                      WHEN kode_pek = 'S' THEN 40000
                      ELSE 0
                    END AS honor,

                    COUNT(kode_pek) AS frekuensilembur,
                    SUM(durasi) AS jumlahlembur,

                    SUM(
                      durasi *
                      CASE 
                        WHEN kode_pek = 'A' THEN 50000
                        WHEN kode_pek = 'P' THEN 75000
                        WHEN kode_pek = 'S' THEN 40000
                        ELSE 0
                      END
                    ) AS jumlahhonor

                  FROM lembur
                  GROUP BY kode_pek
                  ORDER BY kode_pek";

          $query = mysqli_query($koneksi, $sql) 
                   or die('SQL error: ' . mysqli_error($koneksi));

          while ($row = mysqli_fetch_assoc($query)) {
            $total += $row['jumlahhonor'];

            echo "<tr>";
            echo "<td>".$row['kode_pek']."</td>";
            echo "<td>".$row['jenis_pekerjaan']."</td>";
            echo "<td>Rp ".number_format($row['honor'], 0, ',', '.')."</td>";
            echo "<td>".$row['frekuensilembur']."</td>";
            echo "<td>".$row['jumlahlembur']."</td>";
            echo "<td>Rp ".number_format($row['jumlahhonor'], 0, ',', '.')."</td>";
            echo "</tr>";
          }
        ?>

          <tr>
            <td colspan="5" class="text-end"><b>Total Penerimaan:</b></td>
            <td>
              <b>Rp <?php echo number_format($total, 0, ',', '.'); ?></b>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php mysqli_close($koneksi); ?>

</body>
</html>