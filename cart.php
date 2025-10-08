<?php
session_start();
include './config/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: /FastBite/auth/login.php");
    exit;
}

// Inisialisasi keranjang (cart) jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// ============================
// 1️⃣ Tambah produk ke cart
// ============================
if (isset($_GET['add'])) {
    $id = intval($_GET['add']);

    // Ambil data produk dari database
    $stmt = $conn->prepare("SELECT id, name, price, stock, image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        // Jika produk sudah ada di cart → tambahkan quantity
        if (isset($_SESSION['cart'][$id])) {
            if ($_SESSION['cart'][$id]['qty'] < $product['stock']) {
                $_SESSION['cart'][$id]['qty']++;
            } else {
                $_SESSION['error'] = "Stok produk tidak cukup.";
            }
        } else {
            // Jika belum ada → tambahkan produk ke cart
            $_SESSION['cart'][$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'qty' => 1
            ];
        }
    } else {
        $_SESSION['error'] = "Produk tidak ditemukan.";
    }

    header("Location: cart.php");
    exit;
}

// ============================
// 2️⃣ Hapus produk dari cart
// ============================
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

// ============================
// 3️⃣ Update qty produk
// ============================
if (isset($_POST['update_cart'])) {
    foreach ($_POST['qty'] as $id => $qty) {
        $id = intval($id);
        $qty = intval($qty);
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['qty'] = $qty;
        }
    }
    header("Location: cart.php");
    exit;
}

// ============================
// 4️⃣ Checkout → redirect ke WhatsApp
// ============================
if (isset($_GET['checkout'])) {
    if (empty($_SESSION['cart'])) {
        $_SESSION['error'] = "Keranjang masih kosong.";
        header("Location: cart.php");
        exit;
    }

    $waNumber = "6281234567890"; // ganti dengan nomormu (tanpa +)
    $message = "Halo, saya ingin memesan burger berikut:\n";

    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['qty'];
        $message .= "- {$item['name']} ({$item['qty']}x) = Rp " . number_format($subtotal, 0, ',', '.') . "\n";
        $total += $subtotal;
    }
    $message .= "\nTotal: Rp " . number_format($total, 0, ',', '.');

    $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($message);

    // kosongkan keranjang
    unset($_SESSION['cart']);

    header("Location: $waUrl");
    exit;
}

// ============================
// Tampilan cart
// ============================
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php include 'partials/header.php'; ?>

    <section id="cart" class="p-8">
        <h1 class="text-3xl font-bold text-center mb-6">Keranjang Belanja</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <p style="color:red;text-align:center"><?= $_SESSION['error'];
                                                    unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <?php if (empty($_SESSION['cart'])): ?>
            <p class="text-center text-gray-600">Keranjang masih kosong.</p>
            <div class="text-center mt-4">
                <a href="index.php" class="btn bg-yellow-400 px-4 py-2 rounded">Kembali ke Menu</a>
            </div>
        <?php else: ?>
            <form action="cart.php" method="post">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $item):
                            $subtotal = $item['price'] * $item['qty'];
                            $total += $subtotal;
                        ?>
                            <tr class="text-center border-b">
                                <td>
                                    <img src="/FastBite/uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="60" class="inline-block mr-2 align-middle">
                                    <?= htmlspecialchars($item['name']) ?>
                                </td>
                                <td>
                                    <input type="number" name="qty[<?= $item['id'] ?>]" value="<?= $item['qty'] ?>" min="1" class="w-16 text-center border rounded">
                                </td>
                                <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                                <td>
                                    <a href="cart.php?remove=<?= $item['id'] ?>" class="text-red-600">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="font-bold text-right">
                            <td colspan="3">Total</td>
                            <td>Rp <?= number_format($total, 0, ',', '.') ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-6 flex justify-between">
                    <button type="submit" name="update_cart" class="bg-blue-500 text-white px-4 py-2 rounded">Update Keranjang</button>
                    <a href="cart.php?checkout" class="bg-green-500 text-white px-4 py-2 rounded">Checkout via WhatsApp</a>
                </div>
            </form>
        <?php endif; ?>
    </section>
</body>

</html>