<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="dashboard-header">
            <h3>Dashboard Admin - Burger Management</h3>
        </div>
    </nav>
</header>