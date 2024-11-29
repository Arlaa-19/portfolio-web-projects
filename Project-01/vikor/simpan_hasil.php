<?php
session_start();
include("../connection/connect.php");
// $conn = connectDB("localhost", "root", "", "spk_vikor");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan variabel $Q dan $alternatif tersedia dari sesi
    $Q = $_SESSION['Q'] ?? null;
    $alternatif = $_SESSION['alternatif'] ?? null;

    if ($Q && $alternatif) {
        // Hapus data sebelumnya (opsional, tergantung kebutuhan)
        $conn->query("DELETE FROM tabel_hasil");

        foreach ($Q as $key => $value) {
            $nama_kelompok = $conn->real_escape_string($alternatif[$key]['nama_kelompok']);
            $alternatif_name = $conn->real_escape_string($alternatif[$key]['alternatif']);
            $nilai_Q = round($value, 4);

            // Insert data ke tabel_hasil
            $query = "INSERT INTO tabel_hasil (nama_kelompok, alternatif, nilai_Q) VALUES ('$nama_kelompok', '$alternatif_name', '$nilai_Q')";
            $conn->query($query);
        }

        // Redirect ke halaman hasil dengan pesan sukses
        echo "<script>alert('Data Berhasil di Simpan') </script>";
        echo "<script>window.location.href = \"hasilPerhitungan.php\" </script>";
    } else {
        // Redirect ke halaman hasil dengan pesan error
        echo "<script>alert('Gagal menyimpan data. Pastikan proses perhitungan telah dilakukan.') </script>";
        echo "<script>window.location.href = \"hasilPerhitungan.php\" </script>";
        exit;
    }
} else {
    // Redirect ke halaman hasil jika bukan metode POST
    echo "<script>window.location.href = \"hasilPerhitungan.php\" </script>";
    exit;
}
