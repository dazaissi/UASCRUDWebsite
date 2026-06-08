<?php
session_start();
require(__DIR__ . '/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: login.php");
    exit;
}

$id_user = $_POST['id_user'];
$password = $_POST['password'];

$sql = "SELECT id_user, nama_user, password
        FROM `user`
        WHERE id_user = ?";

$stmt = mysqli_prepare($koneksi, $sql);

if (!$stmt) {
    die("Prepare error: " . mysqli_error($koneksi));
}

mysqli_stmt_bind_param($stmt, "i", $id_user);
mysqli_stmt_execute($stmt);

$query = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($query);

if ($data) {

    if ($data['password'] == $password) {

        if ($data['id_user'] == 101) {
            $_SESSION['StatusUser'] = 'valid1';
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['nama_user'] = $data['nama_user'];

            header("Location: home.php");
            exit;
        } 
        
        else if ($data['id_user'] == 102) {
            $_SESSION['StatusUser'] = 'valid2';
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['nama_user'] = $data['nama_user'];

            header("Location: home.php");
            exit;
        } 
        
        else {
            $_SESSION['StatusUser'] = 'invalid';
            header("Location: login.php?pesan=id_user_salah");
            exit;
        }

    } else {
        $_SESSION['StatusUser'] = 'invalid';
        header("Location: login.php?pesan=password_salah");
        exit;
    }

} else {
    $_SESSION['StatusUser'] = 'invalid';
    header("Location: login.php?pesan=user_tidak_ditemukan");
    exit;
}
?>