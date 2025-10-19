<?php
require_once('config/koneksi.php');
include('template/header.php');
?>

<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Transaksi Baru</h2>
        <a href="transaksi_data.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    <?php
    if (isset($_POST['id_konsumen'])) {
        $id_konsumen = $_POST['id_konsumen'];
        $id_paket = $_POST['id_paket'];
        $tanggal_transaksi = $_POST['tanggal_transaksi'];
        $tanggal_foto = $_POST['tanggal_foto'];

        // Ambil harga paket dari database untuk disimpan
        $q_harga = mysqli_query($koneksi, "SELECT harga FROM paket WHERE id_paket = '$id_paket'");
        $data_harga = mysqli_fetch_assoc($q_harga);
        $harga_paket = $data_harga['harga'];

        $query = "INSERT INTO transaksi (id_konsumen, id_paket, tanggal_transaksi, tanggal_foto, harga_paket_saat_transaksi) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "iissi", $id_konsumen, $id_paket, $tanggal_transaksi, $tanggal_foto, $harga_paket);

        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='mb-4 p-3 rounded-md bg-green-100 text-green-700'>Transaksi berhasil disimpan!</div>";
        } else {
            echo "<div class='mb-4 p-3 rounded-md bg-red-100 text-red-700'>Gagal menyimpan transaksi.</div>";
        }
    }
    ?>

    <form action="" method="post">
        <div class="mb-4">
            <label for="tanggal_transaksi" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Transaksi</label>
            <input type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="mb-4">
            <label for="id_konsumen" class="block text-gray-700 text-sm font-bold mb-2">Pilih Konsumen</label>
            <select name="id_konsumen" id="id_konsumen" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                <option value="">-- Pilih Konsumen --</option>
                <?php
                $konsumen = mysqli_query($koneksi, "SELECT * FROM konsumen ORDER BY nama_konsumen ASC");
                while ($k = mysqli_fetch_assoc($konsumen)) {
                    echo "<option value='{$k['id_konsumen']}'>" . htmlspecialchars($k['nama_konsumen']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="id_paket" class="block text-gray-700 text-sm font-bold mb-2">Pilih Paket</label>
            <select name="id_paket" id="id_paket" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                <option value="">-- Pilih Paket --</option>
                <?php
                $paket = mysqli_query($koneksi, "SELECT * FROM paket ORDER BY nama_paket ASC");
                while ($p = mysqli_fetch_assoc($paket)) {
                    echo "<option value='{$p['id_paket']}'>" . htmlspecialchars($p['nama_paket']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-6">
            <label for="tanggal_foto" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Foto</label>
            <input type="date" name="tanggal_foto" id="tanggal_foto" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan Transaksi
            </button>
        </div>
    </form>
</div>

<?php
include('template/footer.php');
?>