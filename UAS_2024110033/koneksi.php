<?php  
   $host = "localhost";
   $user_name = "root";
   $password = "";
   $database = "uas_2026"; 
   $koneksi = mysqli_connect($host,$user_name,$password,$database)
              or die("Koneksi database gagal : ". mysqli_connect_error());
?>
