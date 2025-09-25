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
    <title>FastBite - Manage Product</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../partials/dashboard-header.php' ?>
    <div class="container-fluid">
        <div class="row">
            <nav class="position-fixed">
                <?php include '../partials/sidebar.php' ?>
            </nav>

            <main class="dashboard col-md-10 ms-sm-auto py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-12 mx-auto">
                        <h2>Manajemen Produk</h2>
                        <a href="add-product.php" class="btn btn-success btn-sm"></a>
                        <!-- Daftar Produk -->
                        <div class="card p-3 shadow-sm">
                            <h5 class="mb-3">Daftar Produk</h5>
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $imgTag = !empty($row['image'])
                                                ? "<img src='../uploads/{$row['image']}' width='60' class='rounded'>"
                                                : "<span class='text-muted'>No Image</span>";
                                            echo "
                                            <tr>
                                                <td>$imgTag</td>
                                                <td>{$row['name']}</td>
                                                <td>Rp " . number_format($row['price'], 0, ',', '.') . "</td>
                                                <td>{$row['stock']}</td>
                                                <td>
                                                    <a href='edit-product.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                                    <a href='delete-product.php?id={$row['id']}' 
                                                    class='btn btn-danger btn-sm'
                                                    onclick=\"return confirm('Yakin hapus produk ini?');\">
                                                    Hapus
                                                    </a>
                                                </td>
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
</body>

</html>