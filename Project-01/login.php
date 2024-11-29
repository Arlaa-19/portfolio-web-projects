<?php
session_start();
include('./connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor"); // Pastikan Anda sudah menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Mencegah SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Variabel untuk menyimpan data pengguna yang ditemukan
    $user_found = false;
    $user_data = null;

    // Query untuk memeriksa apakah pengguna ada di tabel_admin
    $query_admin = "SELECT * FROM tabel_admin WHERE username = '$username' AND level = '$level'";
    $result_admin = mysqli_query($conn, $query_admin);
    if ($row_admin = mysqli_fetch_assoc($result_admin)) {
        $user_found = true;
        $user_data = $row_admin;
    }

    // Jika pengguna tidak ditemukan di tabel_admin, periksa tabel_user
    if (!$user_found) {
        $query_user = "SELECT * FROM tabel_user WHERE username = '$username' AND level = '$level'";
        $result_user = mysqli_query($conn, $query_user);
        if ($row_user = mysqli_fetch_assoc($result_user)) {
            $user_found = true;
            $user_data = $row_user;
        }
    }

    // Jika pengguna ditemukan
    if ($user_found) {
        // Verifikasi password
        if (password_verify($password, $user_data['password'])) {
            // Set session
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $level;
            $myadmin = $_SESSION['username'] ?? null;

            // Redirect berdasarkan level
            if ($level == "admin") {
                echo "<script>alert('Welcome $myadmin');</script>";
                echo "<script>window.location=(href='index.php')</script>";
            } else {
                echo "<script>alert('Welcome $myadmin');</script>";
                echo "<script>window.location=(href='user/user.php')</script>";
            }
        } else {
            echo "<script>alert('Password Salah');</script>";
            echo "<script>window.location=(href='landingPage.php')</script>";
        }
    } else {
        echo "<script>alert('Username atau level tidak ditemukan.');</script>";
        echo "<script>window.location=(href='landingPage.php')</script>";
    }
}
