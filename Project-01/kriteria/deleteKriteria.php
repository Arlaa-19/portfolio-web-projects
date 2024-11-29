<?php
session_start();
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

$id_kriteria   = $_GET['id_kriteria'];

// untuk menghapus colom di tabel alternatif
$queryKeterangan = "SELECT keterangan FROM tabel_kriteria WHERE id_kriteria = '$id_kriteria'";
$resultKeterangan = mysqli_query($conn, $queryKeterangan);

$row = mysqli_fetch_assoc($resultKeterangan);
$keterangan = $row['keterangan'];

// hapus data kriteria
$sql       = "DELETE FROM tabel_kriteria WHERE id_kriteria = '$id_kriteria' ";
$query     = mysqli_query($conn, $sql);

// hapus data subkriteria
$sql       = "DELETE FROM tabel_subkriteria WHERE id_kriteria = '$id_kriteria' ";
$query     = mysqli_query($conn, $sql);

// Validasi dan modifikasi nama kolom
$keterangan = preg_replace('/[^a-zA-Z0-9_]/', '_', $keterangan);

// Hapus kolom dari tabel_alternatif
$queryDelKet = "ALTER TABLE tabel_alternatif DROP COLUMN $keterangan";
$queryket     = mysqli_query($conn, $queryDelKet);

if ($query) {
    echo "<script>alert('Data Berhasil Di Hapus') </script>";
    echo "<script>window.location.href = \"kriteria.php\" </script>";
} else {
    echo "<script>alert ('Data Gagal Terhapus')</script>";
    echo "<script>window.location.href = \"kriteria.php\" </script>";
}
