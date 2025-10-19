<?php
require_once('config/koneksi.php');
include('template/header.php');


$id = $_GET['id'];


$query_lama = "SELECT * FROM paket WHERE id_paket = ?";
$stmt_lama = mysqli_prepare($koneksi, $query_lama);
mysqli_stmt_bind_param($stmt_lama, "i", $id);
mysqli_stmt_execute($stmt_lama);
$hasil_lama = mysqli_stmt_get_result($stmt_lama);
$data_lama = mysqli_fetch_assoc($hasil_lama);

?>

<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Ubah Data Paket</h2>
        <a href="paket_data.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    <?php

    if (isset($_POST['nama_paket'])) {
        $nama_paket = $_POST['nama_paket'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];

        $query_update = "UPDATE paket SET nama_paket = ?, harga = ?, deskripsi = ? WHERE id_paket = ?";
        $stmt_update = mysqli_prepare($koneksi, $query_update);
        mysqli_stmt_bind_param($stmt_update, "sisi", $nama_paket, $harga, $deskripsi, $id);

        if (mysqli_stmt_execute($stmt_update)) {
            echo "<script>alert('Data berhasil diubah!');window.location='paket_data.php';</script>";
        } else {
            echo "<div class='mb-4 p-3 rounded-md bg-red-100 text-red-700'>Gagal mengubah data: " . mysqli_error($koneksi) . "</div>";
        }
    }
    ?>

    <form action="" method="post">
        <div class="mb-4">
            <label for="nama_paket" class="block text-gray-700 text-sm font-bold mb-2">Nama Paket</label>
            <input type="text" name="nama_paket" id="nama_paket" value="<?php echo htmlspecialchars($data_lama['nama_paket']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>
        <div class="mb-4">
            <label for="harga" class="block text-gray-700 text-sm font-bold mb-2">Harga</label>
            <input type="number" name="harga" id="harga" value="<?php echo htmlspecialchars($data_lama['harga']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>
        <div class="mb-6">
            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required><?php echo htmlspecialchars($data_lama['deskripsi']); ?></textarea>
        </div>
        <div class="flex items-center justify-end">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Ubah Data
            </button>
        </div>
    </form>
</div>

<?php
include('template/footer.php');
?>