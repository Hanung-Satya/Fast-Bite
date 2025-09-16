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
    <?php include '../partials/sidebar.php' ?>

    <main class="col-md-10 ms-sm-auto px-4 py-4">
        <h2>Dashboard Overview</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Burgers</h5>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total FROM products");
                        if ($result) {
                            $data = $result->fetch_assoc();
                            echo "<p class='card-text fs-2'>" . $data['total'] . "</p>";
                        } else {
                            echo "<p class='card-text text-warning'>0</p>";
                        }
                        ?>
                    </div>
                </div>
            </div> <!-- end col-md-4 -->
        </div> <!-- end row -->
        <a href="/FastBite/auth/logout.php" class="btn btn-danger mt-3">Logout</a>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>