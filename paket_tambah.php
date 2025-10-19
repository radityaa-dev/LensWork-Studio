<?php
require_once('config/koneksi.php');
include('template/header.php');
?>

<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Paket Baru</h2>
        <a href="paket_data.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    <?php
    if (isset($_POST['nama_paket'])) {
        $nama_paket = $_POST['nama_paket'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];

        $query = "INSERT INTO paket (nama_paket, harga, deskripsi) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sis", $nama_paket, $harga, $deskripsi);

        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='mb-4 p-3 rounded-md bg-green-100 text-green-700'>Data paket berhasil disimpan!</div>";
        } else {
            echo "<div class='mb-4 p-3 rounded-md bg-red-100 text-red-700'>Gagal menyimpan data: " . mysqli_error($koneksi) . "</div>";
        }
    }
    ?>

    <form action="" method="post">
        <div class="mb-4">
            <label for="nama_paket" class="block text-gray-700 text-sm font-bold mb-2">Nama Paket</label>
            <input type="text" name="nama_paket" id="nama_paket" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="harga" class="block text-gray-700 text-sm font-bold mb-2">Harga</label>
            <input type="number" name="harga" id="harga" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-6">
            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
        </div>
        <div class="flex items-center justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan
            </button>
        </div>
    </form>
</div>

<?php
include('template/footer.php');
?>