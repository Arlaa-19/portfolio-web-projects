<?php
session_start();
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

$id_alternatif   = $_GET['id_alternatif'];
// hapus data kriteria
$query_alternatif = "DELETE FROM tabel_alternatif WHERE id_alternatif = '$id_alternatif' ";
if ($conn->query($query_alternatif) === TRUE) {
    $sql       = "DELETE FROM tabel_nilai WHERE id_alternatif = '$id_alternatif' ";
    $query     = mysqli_query($conn, $sql);
}

if ($query) {
    echo "<script>alert('Data Berhasil Di Hapus') </script>";
    echo "<script>window.location.href = \"alternatif.php\" </script>";
} else {
    echo "<script>alert ('Data Gagal Terhapus')</script>";
    echo "<script>window.location.href = \"alternatif.php\" </script>";
}
