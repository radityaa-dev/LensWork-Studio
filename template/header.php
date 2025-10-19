<?php
session_start();

if (!isset($_SESSION['statuslogin']) || $_SESSION['statuslogin'] != 'aktif') {
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage != 'login.php' && $currentPage != 'daftar.php' && $currentPage != 'index.php') {
        header('location: login.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <title>LensWork Studio</title>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">

    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="halamanutama.php">
                <img src="img/logo.png" alt="Logo LensWork Studio" class="h-12 w-auto">
            </a>
            <div>
                <?php if (isset($_SESSION['statuslogin']) && $_SESSION['statuslogin'] == 'aktif'): ?>
                    <a href="paket_data.php" class="px-3 py-2 text-gray-700 font-medium hover:text-blue-500">Paket</a>
                    <a href="konsumen_data.php" class="px-3 py-2 text-gray-700 font-medium hover:text-blue-500">Konsumen</a>
                    <a href="transaksi_data.php" class="px-3 py-2 text-gray-700 font-medium hover:text-blue-500">Transaksi</a>
                    <a href="logout.php" class="ml-4 px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto p-6">