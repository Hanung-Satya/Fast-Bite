<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /FastBite/auth/login.php');
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
            <nav class="position-fixed">
                <?php include '../partials/sidebar.php' ?>
            </nav>

            <main class="dashboard col-md-10 ms-sm-auto py-4">
                <div class="row">
                    <h2>Dashboard Overview</h2>
                    <div class="row">
                        <div class="d-flex flex-row flex-wrap">
                            <div class="preview-card p-4 m-4">
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

                            <div class="preview-card p-4 m-4">
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

                    
                </div>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>