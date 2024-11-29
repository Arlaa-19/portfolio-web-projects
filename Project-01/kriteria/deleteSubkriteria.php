<?php
session_start();
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

$id_subkriteria   = $_GET['id_subkriteria'];
// hapus data kriteria
$sql       = "DELETE FROM tabel_subkriteria WHERE id_subkriteria = '$id_subkriteria' ";
$query     = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>alert('Data Berhasil Di Hapus') </script>";
    echo "<script>window.location.href = \"kriteria.php\" </script>";
} else {
    echo "<script>alert ('Data Gagal Terhapus')</script>";
    echo "<script>window.location.href = \"kriteria.php\" </script>";
}
