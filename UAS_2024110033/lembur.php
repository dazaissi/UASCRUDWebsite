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
  <h3>Data Master Lembur</h3>
  <p><a href="tambah1.php" class='btn btn-outline-success btn-sm'>Insert Data</a></p>
  <table class="table table-bordered table-striped" width="400px">
    <thead class="table-success">
      <tr>
        <th>No Lembur</th>
		<th>Tanggal Lembur</th>
    <th>Nama Pegawai</th>
        <th>Kode Pekerjaan</th>
		<th>Durasi Lembur</th>
		<th>Edit & Delete</th>
      </tr>
    </thead>
<tbody>
<?php  
   // Buka koneksi database
   require('koneksi.php');
		  
   // Query mengambil data penyewa
   $sql = "SELECT nomor, tanggal, nama_peg, kode_pek, durasi FROM lembur";    
   $query = mysqli_query($koneksi,$sql)
            or die('SQL error: '. mysqli_error($koneksi));

   // Menampilkan data penyewa
   while ($row = mysqli_fetch_array($query))
   {
	 echo "<tr>
	       <td>$row[nomor]</td>
		   <td>$row[tanggal]</td>
	       <td>$row[nama_peg]</td>
		   <td>$row[kode_pek]</td>
           <td>$row[durasi]</td>
           <td><a href='ganti1.php?nomor=$row[nomor]' class='btn btn-outline-success btn-sm'>Edit</a>
		       <a href='hapus.php?nomor=$row[nomor]' class='btn btn-outline-success btn-sm'
			      onClick='return confirm(\"Hapus data penyewa $row[nama_peg]?\")'>Delete</a></td>
		   </tr>";
   }
   // Tutup koneksi database
   mysqli_close($koneksi);
?>	
</tbody>
</table>       
</div>
</body>
</html>