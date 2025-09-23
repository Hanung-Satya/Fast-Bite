<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="col-md-2 d-none d-md-block sidebar">
    <div class="sidebar-container position-sticky">
        <ul class="nav-links nav flex-column">
            <li><a class="sidebar-nav" href="../admin/dashboard.php">Dashboard</a></li>
            <li><a class="sidebar-nav" href="../admin/dashboard.php">Stok Burger</a></li>
            <li><a class="sidebar-nav" href="../admin/manage-product.php">Kelola Menu</a></li>
        </ul>
    </div>
</nav>