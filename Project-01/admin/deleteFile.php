<?php
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']); // Decode URL-encoded string
    $uploadDir = 'uploads/';
    $filePath = $uploadDir . $file;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "<script>alert('File \"$file\" berhasil dihapus'); window.location.href = 'admin.php';</script>";
        } else {
            echo "<script>alert('Error deleting file \"$file\"'); window.location.href = 'admin.php';</script>";
        }
    } else {
        echo "<script>alert('File \"$file\" not found'); window.location.href = 'admin.php';</script>";
    }
} else {
    echo "<script>alert('No file specified'); window.location.href = 'admin.php';</script>";
}
