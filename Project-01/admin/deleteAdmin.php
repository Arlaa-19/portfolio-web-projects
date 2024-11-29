<?php
session_start();
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

$id_admin   = $_GET['id_admin'];
// hapus data kriteria
$sql       = "DELETE FROM tabel_admin WHERE id_admin = '$id_admin' ";
$query     = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>alert('Data Admin Berhasil Di Hapus') </script>";
    echo "<script>window.location.href = \"admin.php\" </script>";
} else {
    echo "<script>alert ('Data Admin Gagal Terhapus')</script>";
    echo "<script>window.location.href = \"admin.php\" </script>";
}
