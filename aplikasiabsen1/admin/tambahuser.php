<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit();
}

include "koneksi.php";

$alertMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, class, password) VALUES ('$username', '$email', '$class', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        $alertMessage = "<div class='alert alert-success' role='alert'>Registrasi berhasil!</div>";
    } else {
        $alertMessage = "<div class='alert alert-danger' role='alert'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
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
    <link rel="stylesheet" href="../public/css/style.css">
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
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="background-color: #0e2238;">
                                    <h5 class="card-title text-white text-center">Tambah User</h5>
                                </div>
                                <div class="card-body">
                                    <?php echo $alertMessage; ?>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-group">
                                            <label for="username">Username:</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                                        </div>
                                        <div class="form-group">
                                            <label for="class">Class:</label>
                                            <select class="form-control" name="class" id="class">
                                                <option value="X PPLG 1">X PPLG 1</option>
                                                <option value="X PPLG 2">X PPLG 2</option>
                                                <option value="X PPLG 3">X PPLG 3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn text-white mx-auto" style="background-color: #0e2238;">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../public/js/script.js"></script>
    <script src="../public/js/scroll-top.js"></script>
    <script src="../public/js/smooth-scroll.js"></script>
</body>
</html>
