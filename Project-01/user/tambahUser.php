<?php
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $idUser = $_POST['idAdmin'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $level = $_POST['level'];

    // Periksa apakah keterangan sudah ada di tabel_kriteria
    $sql_user   = "SELECT * FROM tabel_user WHERE username = '$username' AND nama = '$nama'";
    $query_user = $conn->query($sql_user);
    $cek_user   = $query_user->num_rows;

    if ($cek_user > 0) {
        echo "<script>alert('Data User Sudah Ada!') </script>";
        echo "<script>window.location=(href='../landingPage.php')</script>";
    } else {
        // Menggunakan password hashing untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Menyusun SQL query untuk memasukkan data
        $sql = "INSERT INTO tabel_user (id_user, username, password, nama, email, telp, level) VALUES ('$idUser', '$username', '$hashed_password', '$nama', '$email', '$telp', '$level')";

        if ($conn->query($sql) === TRUE) {
            // Jika berhasil, redirect ke halaman yang diinginkan atau tampilkan pesan sukses
            echo "<script>alert('Register User Berhasil.');</script>";
            echo "<script>alert('Silahkan Klik GetStart');</script>";
            echo "<script>window.location=(href='../landingPage.php')</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
// Menutup koneksi
$conn->close();
