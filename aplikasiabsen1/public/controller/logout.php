<?php
session_start();

session_destroy();

echo '<script>
        alert("Logout berhasil.");
        window.location.href = "../index.html"; // Mengarahkan ke halaman login
      </script>';
exit();
?>
