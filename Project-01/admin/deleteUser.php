<?php
session_start();
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

$id_user  = $_GET['id_user'];
// hapus data kriteria
$sql       = "DELETE FROM tabel_user WHERE id_user = '$id_user' ";
$query     = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>alert('Data User Berhasil Di Hapus') </script>";
    echo "<script>window.location.href = \"admin.php\" </script>";
} else {
    echo "<script>alert ('Data User Gagal Terhapus')</script>";
    echo "<script>window.location.href = \"admin.php\" </script>";
}
