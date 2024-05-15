<?php
session_start();
include "../../admin/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT id, password FROM users WHERE email = ? LIMIT 1";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    session_regenerate_id();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $id;
                    
                    $_SESSION['success_message'] = "Login berhasil!";
                    
                    header('Location: ../absensi.php');
                    exit();
                } else {
                    $error_message = "Password salah.";
                    echo '<script>alert("' . $error_message . '"); window.location.href = "../index.html";</script>';
                }
            } else {
                $error_message = "Email tidak ditemukan.";
                echo '<script>alert("' . $error_message . '"); window.location.href = "../index.html";</script>';
            }

            $stmt->close();
        } else {
            $error_message = "Error dalam menyiapkan pernyataan SQL.";
            echo '<script>alert("' . $error_message . '"); window.location.href = "../index.html";</script>';
        }
    } else {
        $error_message = "Email dan password harus diisi.";
        echo '<script>alert("' . $error_message . '"); window.location.href = "../index.html";</script>';
    }
}
?>
