<?php
require_once('config/koneksi.php');
include('template/header.php');
?>

<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Konsumen Baru</h2>
        <a href="konsumen_data.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    <?php
    if (isset($_POST['nama_konsumen'])) {
        $nama_konsumen = $_POST['nama_konsumen'];
        $no_telp = $_POST['no_telp'];
        $alamat = $_POST['alamat'];

        $query = "INSERT INTO konsumen (nama_konsumen, no_telp, alamat) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sss", $nama_konsumen, $no_telp, $alamat);

        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='mb-4 p-3 rounded-md bg-green-100 text-green-700'>Data konsumen berhasil ditambahkan!</div>";
        } else {
            echo "<div class='mb-4 p-3 rounded-md bg-red-100 text-red-700'>Gagal menambahkan data: " . mysqli_error($koneksi) . "</div>";
        }
    }
    ?>

    <form action="" method="post">
        <div class="mb-4">
            <label for="nama_konsumen" class="block text-gray-700 text-sm font-bold mb-2">Nama Konsumen</label>
            <input type="text" name="nama_konsumen" id="nama_konsumen" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>
        <div class="mb-4">
            <label for="no_telp" class="block text-gray-700 text-sm font-bold mb-2">No. Telepon</label>
            <input type="text" name="no_telp" id="no_telp" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>
        <div class="mb-6">
            <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
            <textarea name="alamat" id="alamat" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required></textarea>
        </div>
        <div class="flex items-center justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>

<?php
include('template/footer.php');
?>