<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: /FastBite/auth/login.php');
    exit();
}

$id = (int) $_GET['id'];

// hapus gambar
$res = $conn->query("SELECT image FROM products WHERE id=$id");
if ($res && $row = $res->fetch_assoc()) {
    if (!empty($row['image']) && file_exists("../uploads/" . $row['image'])) {
        unlink("../uploads/" . $row['image']);
    }
}

$conn->query("DELETE FROM products WHERE id=$id");
header("Location: manage-product.php");
exit;


?>
