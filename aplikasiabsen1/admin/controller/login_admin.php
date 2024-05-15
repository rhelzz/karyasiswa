<?php
session_start();

include "../koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['referral_code'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $referral_code = $_POST['referral_code'];

        $query = "SELECT id, password, referral_code FROM admin WHERE email = ? LIMIT 1";

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $hashed_password, $db_referral_code);
                $stmt->fetch();

                if (password_verify($password, $hashed_password) && $referral_code === $db_referral_code) {
                    session_regenerate_id();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $id;
                    header('Location: ../tabeldata.php');
                    exit();
                } else {
                    echo '<script>';
                    echo 'if("' . password_verify($password, $hashed_password) . '" === "1") {';
                    echo 'alert("Referral code salah.");';
                    echo '} else {';
                    echo 'alert("Password yang Anda masukkan salah.");';
                    echo '}';
                    echo '</script>';
                    echo '<script>setTimeout(function(){ window.location.href = "../index.html"; }, 100);</script>';
                    exit();
                }
            } else {
                $error_message = "Email tidak ditemukan.";
            }

            $stmt->close();
        } else {
            $error_message = "Error dalam menyiapkan pernyataan SQL.";
        }
    } else {
        $error_message = "Email, password, dan referral code harus diisi.";
    }
}
?>