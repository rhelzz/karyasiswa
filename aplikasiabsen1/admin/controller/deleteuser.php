<?php
include '../koneksi.php';
$userId = $_GET['id'];
$sql = "DELETE FROM users WHERE id = $userId";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('User deleted successfully'); window.location.href = '../tabeluser.php';</script>";
    exit();
} else {
    echo "Error deleting user: " . $conn->error;
}
$conn->close();
?>