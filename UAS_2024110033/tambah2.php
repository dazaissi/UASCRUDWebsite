<?php
session_start();

// Admin dan kasir boleh tambah transaksi
if (!isset($_SESSION['StatusUser']) || 
   ($_SESSION['StatusUser'] != 'valid1' )) {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}
   // Mengambil data dari form 
   $nomor = $_GET['nomor'];
   $tanggal = $_GET['tanggal'];
   $nama_peg = $_GET['nama_peg'];
   $kode_pek = $_GET['kode_pek'];
   $durasi = $_GET['durasi'];
   
   // Buka koneksi database
   $koneksi = mysqli_connect("localhost","root","","uas_2026")
              or die("Koneksi database gagal : ". mysqli_connect_error());

   // Query tambah data baru
   $sql = "insert into lembur 
           values ('$nomor', '$tanggal', '$nama_peg','$kode_pek','$durasi')";
   mysqli_query($koneksi,$sql) 
   or die('SQL error: '. mysqli_error($koneksi));

   header("location:lembur.php"); 
?>
