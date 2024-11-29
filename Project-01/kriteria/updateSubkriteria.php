<?php
include('../connection/connect.php');
// $conn = connectDB("localhost", "root", "", "spk_vikor");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $kriteriaData = explode('|', $_POST['kriteria']);
    $id_subkriteria = $_POST['id_subkriteria'];
    $id_kriteria = $kriteriaData[0];
    $keterangan_kriteria = $kriteriaData[1];
    $keterangan_subkriteria = $_POST['keteranganSubK'];
    $nilai_subkriteria = $_POST['nilaiSubkriteria'];

    // Periksa apakah keterangan sudah ada di tabel_kriteria
    $sql_subkriteria   = "SELECT * FROM tabel_subkriteria WHERE ket_subkriteria = '$keterangan_subkriteria' AND nilai_subkriteria = '$nilai_subkriteria'";
    $query_subkriteria = $conn->query($sql_subkriteria);
    $cek_subkriteria   = $query_subkriteria->num_rows;

    if ($cek_subkriteria > 0) {
        echo "<script>alert('Data Sudah Ada!') </script>";
        echo "<script>window.location.href = \"kriteria.php\" </script>";
    } else {
        // Query untuk menyimpan data ke tabel_subkriteria
        $query = "UPDATE tabel_subkriteria SET id_subkriteria = '$id_subkriteria', id_kriteria = '$id_kriteria', ket_kriteria ='$keterangan_kriteria', ket_subkriteria = '$keterangan_subkriteria', nilai_subkriteria = '$nilai_subkriteria' WHERE id_subkriteria = '$id_subkriteria'";
        $UpdateSub = $conn->query($query);

        // Eksekusi query
        if ($UpdateSub == TRUE) {
            // Jika berhasil, redirect ke halaman yang diinginkan atau tampilkan pesan sukses
            echo "<script>alert('Data Sub Kriteria Berhasil Di Update'); window.location.href = 'kriteria.php';</script>";
        } else {
            // Jika gagal, tampilkan pesan error
            echo "<script>alert('Data Sub Kriteria Gagal Di Update'); window.location.href = 'kriteria.php';</script>";
        }
    }
}
