<?php

if (!isset($_SESSION['StatusUser']) || $_SESSION['StatusUser'] != 'valid1' && $_SESSION['StatusUser'] != 'valid2') {
    echo "Anda tidak berhak mengakses halaman ini!";
    exit;
}

   // Mengambil data nomor bon
   $nomor = $_GET['nomor'];

   // Buka koneksi database
   require('koneksi.php');

   // Query untuk menghapus data
   mysqli_query($koneksi,"delete from lembur where nomor='$nomor'")
   or die('SQL error: '. mysqli_error($koneksi));
  
   // Kembali ke lembur.php
   header("location:lembur.php");
?>	