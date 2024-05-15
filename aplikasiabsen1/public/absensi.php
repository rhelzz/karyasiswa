<?php
session_start();

include "../admin/koneksi.php";

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT username, class, created_at FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$nama = $user['username'];
$class = $user['class'];

$query = "SELECT COUNT(*) AS total_hadir FROM absensi WHERE username = ? AND status_kehadiran = 'Hadir'";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $nama);
$stmt->execute();
$result = $stmt->get_result();
$total_hadir = $result->fetch_assoc()['total_hadir'];
$stmt->close();

$query = "SELECT COUNT(*) AS total_sakit FROM absensi WHERE username = ? AND status_kehadiran = 'Sakit'";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $nama);
$stmt->execute();
$result = $stmt->get_result();
$total_sakit = $result->fetch_assoc()['total_sakit'];
$stmt->close();

$query = "SELECT COUNT(*) AS total_izin FROM absensi WHERE username = ? AND status_kehadiran = 'Izin'";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $nama);
$stmt->execute();
$result = $stmt->get_result();
$total_izin = $result->fetch_assoc()['total_izin'];
$stmt->close();


if (isset($_SESSION['success_message'])) {
    echo '<script>alert("' . $_SESSION['success_message'] . '");</script>';

    unset($_SESSION['success_message']);
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
    <link rel="stylesheet" href="css/style.css">

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
                    <a href="#history" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>History</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="controller/logout.php" class="sidebar-link">
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
                <h2 class="mb-5">Welcome, <?php echo $user['username']; ?></h2>
                <h2>Dashboard</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead style="background-color: #0e2238;">
                            <tr>
                                <th class="text-white" style="font-weight: normal;">Username</th>
                                <th class="text-white" style="font-weight: normal;">Email</th>
                                <th class="text-white" style="font-weight: normal;">Class</th>
                                <th class="text-white" style="font-weight: normal;">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $user['username']; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $user['class']; ?></td>
                                <td><?php echo $user['created_at']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="container mt-5 pb-5">
                <h2 class="text-center mb-4">Attendance Dashboard</h2>
                <form action="controller/absen.php" method="post" enctype="multipart/form-data" class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username" class="form-label">Nama:</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $nama; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="class" class="form-label">Kelas:</label>
                            <select class="form-control" id="class" name="class" readonly>
                                <option selected><?php echo $class; ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status Kehadiran:</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Hadir">Hadir</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Hari:</label>
                            <input class="form-control "type="date" name="hari" id="hari" required>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="form-label">Upload Surat (Jika izin atau Tidak hadir):</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn text-white" style="background-color: #0e2238;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container my-5" id="history">
                <h2>Riwayat Absensi</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead style="background-color: #0e2238;">
                            <tr>
                                <th class="text-white" style="font-weight: normal;">Total Hadir</th>
                                <th class="text-white" style="font-weight: normal;">Total Sakit</th>
                                <th class="text-white" style="font-weight: normal;">Total Izin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $total_hadir; ?></td>
                                <td><?php echo $total_sakit; ?></td>
                                <td><?php echo $total_izin; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="text-center">
                <a href="#" id="scroll-to-top" class="btn btn-primary">
                    <i class="lni lni-arrow-up"></i>
                </a>
            </div>

            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/scroll-top.js"></script>
    <script src="js/smooth-scroll.js"></script>

</body>
</html>