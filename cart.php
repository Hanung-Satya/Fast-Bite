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


// Tambah produk ke cart
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

// Hapus produk dari cart
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}


//  Update qty produk
if (isset($_POST['update_cart'])) {
    foreach ($_POST['qty'] as $id => $qty) {
        $id = intval($id);
        $qty = intval($qty);

        if (isset($_SESSION['cart'][$id])) {
            if ($qty <= 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id]['qty'] = $qty;
            }
        }
    }
    header("Location: cart.php");
    exit;
}


// Checkout → redirect ke WhatsApp
if (isset($_GET['checkout'])) {
    if (empty($_SESSION['cart'])) {
        $_SESSION['error'] = "Keranjang masih kosong.";
        header("Location: cart.php");
        exit;
    }

    $waNumber = "6285124587676";
    $message = "Hello, I would like to order this items from FastBite:\n";

    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['price'] * $item['qty'];
        $message .= "- {$item['name']} ({$item['qty']}x) = $ " . number_format($subtotal, 0, ',', '.') . "\n";
        $total += $subtotal;
    }
    $message .= "\nTotal: $ " . number_format($total, 0, ',', '.');

    $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($message);

    // kosongkan keranjang
    unset($_SESSION['cart']);

    header("Location: $waUrl");
    exit;
}

// Tampilan cart
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://kit.fontawesome.com/5fd6ecb4fe.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'partials/header.php'; ?>

    <section id="cart" class="p-8 bg-white max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Your Cart</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="text-red-600 text-center mb-4"><?= $_SESSION['error'];
                                                        unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <?php if (empty($_SESSION['cart'])): ?>
            <p class="text-center text-gray-600 mb-4">Your Cart is Empty!</p>
            <div class="text-center">
                <a href="index.php#menu" class="bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition">Kembali ke Menu</a>
            </div>
        <?php else: ?>
            <form action="cart.php" method="post">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-orange-500 text-white">
                                <th class="p-4 text-left">Product</th>
                                <th class="p-4 text-center">Qty</th>
                                <th class="p-4 text-center">Price</th>
                                <th class="p-4 text-center">Subtotal</th>
                                <th class="p-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php
                            $total = 0;
                            foreach ($_SESSION['cart'] as $item):
                                $subtotal = $item['price'] * $item['qty'];
                                $total += $subtotal;
                            ?>
                                <tr class="hover:bg-orange-50 transition">
                                    <td class="p-4">
                                        <img src="/FastBite/uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="60" class="inline-block mr-4 rounded-md shadow-sm">
                                        <span class="font-medium text-gray-800"><?= htmlspecialchars($item['name']) ?></span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <input name="qty[<?= $item['id'] ?>]" value="<?= $item['qty'] ?>" min="1" class="quantity-input w-12 text-center border border-gray-300 rounded-md focus:border-orange-500 focus:ring-orange-500" data-id="<?= $item['id'] ?>">
                                    </td>
                                    <td class="p-4 text-center text-gray-700">$ <?= number_format($item['price'], 0, ',', '.') ?></td>
                                    <td class="p-4 text-center text-gray-700 font-semibold">$ <?= number_format($subtotal, 0, ',', '.') ?></td>
                                    <td class="p-4 text-center">
                                        <a href="cart.php?remove=<?= $item['id'] ?>" class="text-red-600 hover:text-red-800">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="bg-orange-100 font-bold">
                                <td colspan="3" class="p-4 text-right text-gray-800">Total</td>
                                <td class="p-4 text-center text-gray-800" id="cart-total">$ <?= number_format($total, 0, ',', '.') ?></td>
                                <td class="p-4"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <a href="index.php#menu" class="fill-btn px-6 py-3 rounded-2xl font-semibold">Back to Menu</a>
                    <a href="cart.php?checkout" class="outline-btn px-6 py-3 rounded-lg font-semibold ">Checkout</a>
                </div>
            </form>
        <?php endif; ?>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const qtyInputs = document.querySelectorAll('.quantity-input');

            qtyInputs.forEach(input => {
                input.addEventListener('change', async () => {
                    const id = input.name.match(/\d+/)[0];
                    const qty = input.value;

                    const formData = new FormData();
                    formData.append('id', id);
                    formData.append('qty', qty);

                    const response = await fetch('/FastBite/price-update-cart.php', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        // ✅ Update subtotal item
                        const row = input.closest('tr');
                        const subtotalCell = row.querySelector('td:nth-child(4)');
                        subtotalCell.textContent = `$ ${data.subtotal}`;

                        // ✅ Update total keseluruhan
                        const totalCell = document.querySelector('#cart-total');
                        totalCell.textContent = `$ ${data.total}`;
                    }
                });
            });
        });
    </script>
</body>

</html>