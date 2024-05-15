<?php
// Include koneksi.php
include '../../admin/koneksi.php';

// Tangani form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $request = $_POST['request'];

    // Query untuk menyimpan data ke tabel request
    $sql = "INSERT INTO request (request) VALUES ('$request')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil disimpan.'); window.location.href = '../index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>