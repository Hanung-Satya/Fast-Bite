<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastBite - Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php include '../partials/dashboard-header.php' ?>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar-wrapper position-fixed">
                <?php include '../partials/sidebar.php' ?>
            </nav>

            <main class="dashboard col-md-10 ms-sm-auto py-4">
                <div class="row">
                    <h2 class="ms-4">Dashboard Overview</h2>
                    <div class="row">
                        <div class="preview-container d-flex flex-row flex-wrap ">
                            <div class="preview-card p-4 mt-4 mb-4">
                                <h5 class="card-title">Total Stok Burger</h5>
                                <p class="card-text fs-2">
                                    <?php
                                    $result = $conn->query("SELECT COALESCE(SUM(stock), 0) AS total FROM products");
                                    if ($result) {
                                        $data = $result->fetch_assoc();
                                        echo $data['total'];
                                    } else {
                                        echo "<span class='text-warning'>0</span>";
                                    }
                                    ?>
                                </p>
                            </div>

                            <div class="preview-card p-4 mt-4 mb-4">
                                <h5 class="card-title">Menu Tersedia</h5>
                                <p class="card-text fs-2">
                                    <?php
                                    $result = $conn->query("SELECT COUNT(*) AS total FROM products");
                                    if ($result) {
                                        $data = $result->fetch_assoc();
                                        echo $data['total'];
                                    } else {
                                        echo "<span class='text-warning'>0</span>";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card p-3 shadow-sm col-11 mx-auto py-4">
                        <h5 class="mb-3">Daftar Produk</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            // Cek status stok
                                            if ($row['stock'] == 0) {
                                                $status = "<span class='badge bg-danger'>Habis</span>";
                                            } elseif ($row['stock'] < 20) {
                                                $status = "<span class='badge bg-warning text-dark'>Stok Rendah</span>";
                                            } else {
                                                $status = "<span class='badge bg-success'>Tersedia</span>";
                                            }

                                            echo "
                                                <tr>
                                                    <td>{$row['name']}</td>
                                                    <td>$ " . number_format($row['price'], 0, ',', '.') . "</td>
                                                    <td>{$row['stock']}</td>
                                                    <td>{$status}</td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='text-center'>Belum ada produk</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>