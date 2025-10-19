<?php
require_once('config/koneksi.php');
include('template/header.php');

$id = $_GET['id'];
$query_lama = "SELECT * FROM konsumen WHERE id_konsumen = ?";
$stmt_lama = mysqli_prepare($koneksi, $query_lama);
mysqli_stmt_bind_param($stmt_lama, "i", $id);
mysqli_stmt_execute($stmt_lama);
$hasil_lama = mysqli_stmt_get_result($stmt_lama);
$data_lama = mysqli_fetch_assoc($hasil_lama);
?>

<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Ubah Data Konsumen</h2>
        <a href="konsumen_data.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    <?php
    if (isset($_POST['nama_konsumen'])) {
        $nama_konsumen = $_POST['nama_konsumen'];
        $no_telp = $_POST['no_telp'];
        $alamat = $_POST['alamat'];

        $query_update = "UPDATE konsumen SET nama_konsumen = ?, no_telp = ?, alamat = ? WHERE id_konsumen = ?";
        $stmt_update = mysqli_prepare($koneksi, $query_update);
        mysqli_stmt_bind_param($stmt_update, "sssi", $nama_konsumen, $no_telp, $alamat, $id);

        if (mysqli_stmt_execute($stmt_update)) {
            echo "<script>alert('Data berhasil diubah!');window.location='konsumen_data.php';</script>";
        } else {
            echo "<div class='mb-4 p-3 rounded-md bg-red-100 text-red-700'>Gagal mengubah data.</div>";
        }
    }
    ?>

    <form action="" method="post">
        <div class="mb-4">
            <label for="nama_konsumen" class="block text-gray-700 text-sm font-bold mb-2">Nama Konsumen</label>
            <input type="text" name="nama_konsumen" id="nama_konsumen" value="<?php echo htmlspecialchars($data_lama['nama_konsumen']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>
        <div class="mb-4">
            <label for="no_telp" class="block text-gray-700 text-sm font-bold mb-2">No. Telepon</label>
            <input type="text" name="no_telp" id="no_telp" value="<?php echo htmlspecialchars($data_lama['no_telp']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>
        <div class="mb-6">
            <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
            <textarea name="alamat" id="alamat" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required><?php echo htmlspecialchars($data_lama['alamat']); ?></textarea>
        </div>
        <div class="flex items-center justify-end">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                Ubah Data
            </button>
        </div>
    </form>
</div>

<?php
include('template/footer.php');
?>