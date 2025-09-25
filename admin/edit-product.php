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

    $updateQuery = "UPDATE products SET name='$name', price=$price, stock=$stock";

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
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../partials/dashboard-header.php'; ?>
<div class="container py-4">
    <h2>Edit Produk</h2>
    <form method="POST" enctype="multipart/form-data" class="card p-3 shadow-sm col-lg-6">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">
        <div class="mb-2">
            <label class="form-label">Nama Burger</label>
            <input type="text" name="name" value="<?= $product['name']; ?>" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Harga</label>
            <input type="number" name="price" value="<?= $product['price']; ?>" class="form-control" required>
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
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" name="edit" class="btn btn-primary">Update</button>
        <a href="manage-product.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
