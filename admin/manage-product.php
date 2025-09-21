<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /FastBite/auth/login.php');
    exit();
}

// --- Tambah Produk ---
if (isset($_POST['add'])) {
    $name  = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Upload gambar
    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // bikin folder kalau belum ada
        }
        $fileName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $fileName;
        }
    }

    $conn->query("INSERT INTO products (name, price, stock, image) 
                  VALUES ('$name', $price, $stock, '$image')");
    header("Location: manage-product.php");
    exit;
}

// --- Hapus Produk ---
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    // hapus gambar juga
    $res = $conn->query("SELECT image FROM products WHERE id = $id");
    if ($res && $row = $res->fetch_assoc()) {
        if (!empty($row['image']) && file_exists("../uploads/" . $row['image'])) {
            unlink("../uploads/" . $row['image']);
        }
    }

    $conn->query("DELETE FROM products WHERE id = $id");
    header("Location: manage-product.php");
    exit;
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

                        <!-- Form Tambah Produk -->
                        <div class="card p-3 mb-4 shadow-sm">
                            <h5 class="mb-3">Tambah Produk</h5>
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="mb-2">
                                    <label class="form-label">Nama Burger</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Harga</label>
                                    <input type="text" id="price_display" class="form-control" required>
                                    <input type="hidden" id="price" name="price">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Stok</label>
                                    <input type="number" name="stock" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Gambar Produk</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                                <button type="submit" name="add" class="btn btn-success">Tambah</button>
                            </form>
                        </div>

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
                                                <a href='?delete={$row['id']}' 
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

    <script>
        priceDisplay = document.getElementById('price_display');
        priceHidden = document.getElementById('price');

        priceDisplay.addEventlistener('input', (e) => {
            let value = e.target.value.replace(/\D/g, "");

            if (value) {
                //Tampil ke user format dolar
                e.target.value = "$ " + new Intl.NumberFormat('en-US').format(value);
                priceHidden.value = value;
            } else {
                e.target.value = "";
                priceHidden.value = "";
            }
        });
    </script>
</body>
</html>