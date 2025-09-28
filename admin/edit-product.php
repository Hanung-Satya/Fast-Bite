<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /FastBite/auth/login.php');
    exit();
}

$id = (int) $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();
if (!$product) die("Produk tidak ditemukan!");

// Proses update
if (isset($_POST['edit'])) {
    $name  = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $desc  = $_POST['description'];

    $updateQuery = "UPDATE products SET name='$name', price=$price, stock=$stock, description='$desc'";

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        $fileName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            if (!empty($product['image']) && file_exists("../uploads/" . $product['image'])) {
                unlink("../uploads/" . $product['image']);
            }
            $updateQuery .= ", image='$fileName'";
        }
    }

    $updateQuery .= " WHERE id=$id";
    $conn->query($updateQuery);
    header("Location: manage-product.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FastBite - Edit Product</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../partials/dashboard-header.php'; ?>

    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar-wrapper position-fixed">
            <?php include '../partials/sidebar.php' ?>
        </nav>

        <main class="dashboard col-md-10 ms-sm-auto py-4">
            <div class="row justify-content-center">
                <div class="col-lg-11 mx-auto">
                    <h2 class="mb-3">Manajemen Produk</h2>
                    <div class="card p-3 mb-4 shadow-sm">
                        <h5 class="mb-3">Edit Produk</h5>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $product['id']; ?>">

                            <div class="mb-2">
                                <label class="form-label">Nama Burger</label>
                                <input type="text" name="name" value="<?= $product['name']; ?>" class="form-control" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Deskripsi Singkat (max 50 karakter)</label>
                                <textarea name="description" id="description" class="form-control" rows="2" required><?= $product['description']; ?></textarea>
                                <small id="descHelp" class="text-muted">Maksimal 50 Karakter</small>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Harga</label>
                                <input type="text" id="price_display" value="<?= number_format($product['price'], 0, ',', '.'); ?>" class="form-control" required>
                                <input type="hidden" id="price" name="price" value="<?= $product['price']; ?>">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stock" value="<?= $product['stock']; ?>" class="form-control" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Gambar Produk</label><br>
                                <?php if (!empty($product['image'])): ?>
                                    <img src="../uploads/<?= $product['image']; ?>" width="100" class="mb-2">
                                <?php endif; ?>
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>

                            <div class="mt-4">
                                <button type="submit" name="edit" class="btn btn-primary">Update</button>
                                <a href="manage-product.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        priceDisplay = document.getElementById('price_display');
        priceHidden = document.getElementById('price');
        const descInput = document.getElementById('description');
        const descHelp = document.getElementById('descHelp');

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

        descInput.addEventListener('input', () => {
            let count = descInput.value.length;

            if (count > 80) {
                descInput.value = descInput.value.substring(0, 80);
                count = 80;
            }

            descHelp.textContent = count + " / 80 karakter";
        });
    </script>
</body>

</html>