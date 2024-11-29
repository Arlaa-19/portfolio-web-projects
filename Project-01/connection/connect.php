<?php
// Koneksi ke database
$conn = connectDB("localhost", "root", "", "spk_vikor");

function connectDB($host, $username, $password, $dbname)
{
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    return $conn;
}
