<?php
session_start();
require_once('config/koneksi.php');


if (isset($_SESSION['statuslogin']) && $_SESSION['statuslogin'] == 'aktif') {
    header('location: halamanutama.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <title>Daftar Akun - LensWork Studio</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-8">

    <div class="w-full max-w-sm bg-white rounded-lg shadow-xl p-8">
        <div class="flex justify-center mb-6">
            <img src="img/logo.png" alt="Logo" class="w-24 h-24 object-cover rounded-full">
        </div>

        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h1>
            <p class="text-gray-500 text-sm">Bergabunglah bersama kami!</p>
        </div>

        <?php
        if (isset($_POST['username'])) {
            $nama_lengkap = $_POST['nama_lengkap'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (nama_lengkap, username, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $query);
            mysqli_stmt_bind_param($stmt, "sss", $nama_lengkap, $username, $hashed_password);
            
            if(mysqli_stmt_execute($stmt)){
                echo "<div class='mb-4 p-3 rounded-md bg-green-100 text-green-700 text-sm'>Registrasi berhasil! Silakan <a href='login.php' class='font-bold underline'>login</a>.</div>";
            } else {
                echo "<div class='mb-4 p-3 rounded-md bg-red-100 text-red-700 text-sm'>Registrasi gagal: Username mungkin sudah ada.</div>";
            }
        }
        ?>

        <form action="" method="post">
            <div class="mb-4">
                <label for="nama_lengkap" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" id="username" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                    Daftar
                </button>
            </div>
             <p class="text-center text-gray-600 text-xs mt-6">
                Sudah punya akun? <a href="login.php" class="text-blue-500 hover:underline">Login di sini</a>
            </p>
        </form>
    </div>

</body>
</html>