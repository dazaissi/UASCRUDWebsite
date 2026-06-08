<?php
session_start();

if (!isset($_SESSION['StatusUser']) || $_SESSION['StatusUser'] != 'valid1') {
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
   require('koneksi.php');

   // Query edit data
   $sql = "update lembur 
            set nomor='$nomor',tanggal='$tanggal',
            nama_peg='$nama_peg',kode_pek='$kode_pek', 
            durasi = '$durasi' 
           where nomor='$nomor'";
   mysqli_query($koneksi,$sql)
   or die('SQL error: '. mysqli_error($koneksi));

   header("location:lembur.php"); 
?>
