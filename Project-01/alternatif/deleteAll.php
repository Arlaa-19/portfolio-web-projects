<?php
session_start();
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

// hapus data
$query_alternatif = "DELETE FROM tabel_alternatif";
if ($conn->query($query_alternatif) === TRUE) {
    $sql       = "DELETE FROM tabel_nilai";
    $query     = mysqli_query($conn, $sql);
}

if ($query) {
    echo "<script>alert('Seluruh Data Berhasil Di Hapus') </script>";
    echo "<script>window.location.href = \"alternatif.php\" </script>";
} else {
    echo "<script>alert ('Data Gagal Terhapus')</script>";
    echo "<script>window.location.href = \"alternatif.php\" </script>";
}
