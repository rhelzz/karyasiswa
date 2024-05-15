<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit();
}

include "koneksi.php";

// Konfigurasi pagination
$jumlahDataPerHalaman = 15;
$conn = new mysqli('localhost', 'root', '', 'absensi');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hitung total data
$sql = "SELECT COUNT(*) AS total FROM absensi";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$totalData = $data['total'];

// Tentukan halaman saat ini
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$mulai = ($halaman > 1) ? ($halaman * $jumlahDataPerHalaman) - $jumlahDataPerHalaman : 0;

// Query data dengan batasan limit
$sql = "SELECT id, username, class, status_kehadiran, hari, foto, created_at FROM absensi LIMIT $mulai, $jumlahDataPerHalaman";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../public/css/style.css">

    <style>
        .page-link {
            color: black;
            background-color: white;
            border-color: lightgray;
        }
        .page-link:hover {
            color: white;
            background-color: #0e2238;
            border-color: #0a1726;
        }
        .page-item.active .page-link {
            color: white;
            background-color: #0e2238;
            border-color: #0a1726;
        }

        @media (max-width: 576px) {
            .form-group {
                width: 100% !important;
            }

            .form-group button {
                width: 50% !important;
            }

            .form-control {
                margin-bottom: 10px;
            }
        }
    </style>

</head>
<body>

    <!-- Sidebar -->
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">StudentForm</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="tabeldata.php" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Tabel Data</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="tabeluser.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Tabel User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="tambahuser.php" class="sidebar-link">
                        <i class="lni lni-users"></i>
                        <span>Tambah User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="request.php" class="sidebar-link">
                        <i class="lni lni-inbox"></i>
                        <span>Request</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="controller/logoutadmin.php" class="sidebar-link">
                        <i class="lni lni-exit"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </aside>

    <!-- Main Content -->
    <div class="main p-3">
        <div class="absen">

            <form class="d-flex mx-auto mt-5 w-25 form-group" action="controller/search.php" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Search...">
                <button class="btn ml-3 text-white form-control" type="submit" style="background-color: #0e2238;">Search</button>
            </form>

            <h1 class="text-center mb-4 mt-5">Data Absensi</h1>

            <?php
            $jumlahHalaman = ceil($totalData / $jumlahDataPerHalaman);
            echo "<nav aria-label='Page navigation example'>";
            echo "<ul class='pagination justify-content-center'>";
            if ($halaman > 1) {
                echo "<li class='page-item'><a class='page-link' href='?halaman=" . ($halaman - 1) . "'>Previous</a></li>";
            }
            for ($i = 1; $i <= $jumlahHalaman; $i++) {
                if ($i == $halaman) {
                    echo "<li class='page-item active'><a class='page-link' href='#'>" . $i . "</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='?halaman=" . $i . "'>" . $i . "</a></li>";
                }
            }
            if ($halaman < $jumlahHalaman) {
                echo "<li class='page-item'><a class='page-link' href='?halaman=" . ($halaman + 1) . "'>Next</a></li>";
            }
            echo "</ul>";
            echo "</nav>";
            ?>

            <table class="table table-striped">
                <thead class="text-white" style="background-color: #0e2238;">
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Kelas</th>
                        <th>Status Kehadiran</th>
                        <th>Hari</th>
                        <th>Foto</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $no = $mulai + 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['class'] . "</td>";
                            echo "<td>" . $row['status_kehadiran'] . "</td>";
                            echo "<td>" . $row['hari'] . "</td>";
                            echo "<td><img src='" . $row['foto'] . "' class='img-fluid' style='max-width: 100px;'></td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="text-center">
                <a href="#" id="scroll-to-top" class="btn btn-primary">
                    <i class="lni lni-arrow-up"></i>
                </a>
            </div>

        </div>
    </div>

    <script src="../public/js/script.js"></script>
    <script src="../public/js/scroll-top.js"></script>
    <script src="../public/js/smooth-scroll.js"></script>

</body>
</html>

<?php
$conn->close();
?>