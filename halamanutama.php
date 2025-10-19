<?php
require_once('config/koneksi.php');
include('template/header.php');
?>

<div class="bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-4">Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p class="text-gray-700">Anda telah berhasil login ke sistem manajemen LensWork Studio. Silakan gunakan navigasi di atas untuk mengelola data paket, konsumen, dan transaksi.</p>
</div>

<?php
include('template/footer.php');
?>