<?php
session_start();
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $idUser = $_POST['idUser'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $level = $_POST['level'];

    // Menggunakan password hashing jika password diisi, jika tidak, biarkan password yang lama
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE tabel_user SET username='$username', password='$hashed_password', nama='$nama', email='$email', telp='$telp', level='$level' WHERE id_user='$idUser'";
    } else {
        $sql = "UPDATE tabel_admin SET username='$username', nama='$nama', email='$email', level='$level' WHERE id_admin='$idAdmin'";
    }

    if ($conn->query($sql) === TRUE) {
        // Jika berhasil, redirect ke halaman yang diinginkan atau tampilkan pesan sukses
        $_SESSION['username'] = $username;
        echo "<script>alert('Data User Berhasil Diperbarui'); window.location.href = 'user.php';</script>";
    } else {
        echo "Error: " . $conn->error;
        echo "<script>alert('Data User gagal Diperbarui'); window.location.href = 'user.php';</script>";
    }
}
