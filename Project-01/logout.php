<?php
session_start(); // Memulai sesi
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Menghancurkan sesi

// Mengarahkan pengguna kembali ke halaman login atau halaman beranda
echo "<script>alert('Anda Berhasil Log-Out');</script>";
echo "<script>window.location=(href='landingPage.php')</script>";
exit();
