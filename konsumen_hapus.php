<?php
require_once('config/koneksi.php');
session_start();

if (!isset($_SESSION['statuslogin']) || $_SESSION['statuslogin'] != 'aktif') {
    header('location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM konsumen WHERE id_konsumen = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        header('location: konsumen_data.php');
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header('location: konsumen_data.php');
}
?>