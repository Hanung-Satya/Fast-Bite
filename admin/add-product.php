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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastBite - Add Product</title>
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
                            <form method="POST" action="add-product.php" enctype="multipart/form-data">
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
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        priceDisplay = document.getElementById('price_display');
        priceHidden = document.getElementById('price');

        priceDisplay.addEventListener('input', (e) => {
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