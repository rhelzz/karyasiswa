<?php
include '../koneksi.php';

$query = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    
    $sql = "SELECT * FROM users WHERE username LIKE '%$query%' OR email LIKE '%$query%' OR class LIKE '%$query%' OR created_at LIKE '%$query%'";
    $result = $conn->query($sql);
}
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../../public/css/style.css">

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
                    <a href="../tabeldata.php" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Tabel Data</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../tabeluser.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Tabel User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="../tambahuser.php" class="sidebar-link">
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
                    <a href="logoutadmin.php" class="sidebar-link">
                        <i class="lni lni-exit"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="main p-3">
            <div class="absen">

                <div class="container mt-5">
                    <h2 class="mb-4">Hasil Pencarian</h2>
                    <div class="d-flex">
                        <a href="../tabeluser.php" class="btn text-white mb-4" style="background-color: #0e2238;">Kembali</a>
                    </div>
                    <table class="table table-striped">
                        <thead class="text-white" style="background-color: #0e2238;">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">class</th>
                                <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<th scope='row'>" . $row["id"] . "</th>";
                                    echo "<td>" . $row["username"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td>" . $row["class"] . "</td>";
                                    echo "<td>" . $row["created_at"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>Tidak ada hasil yang ditemukan.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                <a href="#" id="scroll-to-top" class="btn btn-primary">
                    <i class="lni lni-arrow-up"></i>
                </a>
                </div>

            </div>
        </div>
    </div>

    <script src="../../public/js/script.js"></script>
    <script src="../../public/js/scroll-top.js"></script>
    <script src="../../public/js/smooth-scroll.js"></script>

</body>
</html>