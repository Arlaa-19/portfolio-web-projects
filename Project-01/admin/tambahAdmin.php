<?php
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $idAdmin = $_POST['idAdmin'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    // Menggunakan password hashing untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Menyusun SQL query untuk memasukkan data
    $sql = "INSERT INTO tabel_admin (id_admin, username, password, nama, email, level) VALUES ('$idAdmin', '$username', '$hashed_password', '$nama', '$email', '$level')";

    if ($conn->query($sql) === TRUE) {
        // Jika berhasil, redirect ke halaman yang diinginkan atau tampilkan pesan sukses
        echo "<script>alert('Data Admin Berhasil Disimpan'); window.location.href = 'admin.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
// Menutup koneksi
$conn->close();
