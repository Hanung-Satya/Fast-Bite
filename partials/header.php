<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <div class="header-container">
        <a href="/FastBite/index.php" class="logo">Fast<span class="gradient-txt">Bite</span></a>
        <nav class="navbar">
            <ul class="ul-links">
                <li><a href="/FastBite/index.php">Home</a></li>
                <li><a href="/FastBite/index.php#whyUs">Why Us</a></li>
                <li><a href="/FastBite/index.php#menu">Menu</a></li>

                <?php if (isset($_SESSION['user'])) : ?>
                    <li><a href="/FastBite/cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a></li>
                    <li class="user-dropdown">
                        <a id="user-icon" href="#"><i class="fa-solid fa-circle-user"></i></a>
                        <ul class="dropdown-menu" hidden>
                            <li><a href="/auth/logout.php">Logout <i class="fa-solid fa-right-from-bracket"></i></a></li>
                        </ul>
                    </li>

                <?php else : ?>
                    <li><a href="/FastBite/auth/login.php" class="fill-btn">Sign In</a></li>
                    <li><a href="/FastBite/auth/register.php" class="outline-btn">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>