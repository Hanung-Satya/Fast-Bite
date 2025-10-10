<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['id']) && isset($_POST['qty'])) {
    $id = intval($_POST['id']);
    $qty = intval($_POST['qty']);

    if ($qty <= 0) {
        unset($_SESSION['cart'][$id]);
    } else {
        $_SESSION['cart'][$id]['qty'] = $qty;
    }

    // Hitung ulang total dan subtotal
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['qty'];
    }

    $subtotal = $_SESSION['cart'][$id]['price'] * $_SESSION['cart'][$id]['qty'];

    echo json_encode([
        'status' => 'success',
        'subtotal' => number_format($subtotal, 0, ',', '.'),
        'total' => number_format($total, 0, ',', '.')
    ]);
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
exit;
?>
