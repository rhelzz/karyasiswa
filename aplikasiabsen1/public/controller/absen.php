<?php
include "../../admin/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $status = $_POST['status'];
    $class = $_POST['class'];
    $hari = $_POST['hari'];

    if ($_FILES["foto"]["size"] > 0) {
        $target_dir = "../../admin/uploads/";
        $file_name = $_FILES["foto"]["name"];
        $file_temp = $_FILES["foto"]["tmp_name"];
        $target_file = $target_dir . basename($file_name);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($file_temp);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }

        if ($_FILES["foto"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png") {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($file_temp, $target_file)) {
                $sql = "INSERT INTO absensi (username, class, status_kehadiran, foto, hari) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sssss", $username, $class, $status, $target_file, $hari);
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    echo '<script> alert("Form berhasil di isi"); window.location.href = "../absensi.php"; </script>';
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $sql = "INSERT INTO absensi (username, class, status_kehadiran, hari) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $username, $class, $status, $hari);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            echo '<script> alert("Form berhasil di isi"); window.location.href = "../absensi.php"; </script>';
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>