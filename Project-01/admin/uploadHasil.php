<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'C:/xampp/htdocs/Project-01/admin/uploads/';
        $uploadFile = $uploadDir . basename($_FILES['pdfFile']['name']);

        // Memeriksa apakah file sudah ada
        if (file_exists($uploadFile)) {
            echo "File already exists.";
        } else {
            // Memindahkan file ke direktori tujuan
            if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $uploadFile)) {
                echo "<script>alert('Data Berhasil di Upload'); window.location.href = 'admin.php';</script>";
            } else {
                echo "<script>alert('Error uploading file'); window.location.href = 'admin.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Tidak ada File - Silahkan isi!'); window.location.href = 'admin.php';</script>";
    }
}
