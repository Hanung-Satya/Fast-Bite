<?php
//Index PHP
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastBite - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        const isLoggedIn = <?= isset($_SESSION['user']) ? 'true' : 'false' ?>;
    </script>
    <script defer src="assets/js/script.js"></script>
    <script defer src="https://kit.fontawesome.com/5fd6ecb4fe.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/output.css">

</head>

<body id="home">
    <?php include 'partials/header.php'; ?>
    <main>
        <section class="hero-section flex items-center justify-center px-4 py-12 md:py-20">
            <div class="hero-container flex flex-col-reverse md:flex-row items-center justify-between max-w-[1200px] mx-auto w-full gap-8">

                <!-- Text -->
                <div class="hero-text text-center md:text-left">
                    <p class="subtitle text-3xl md:text-4xl text-black pb-3 roboto">Taste the Flavor</p>
                    <h1 class="headline text-4xl md:text-5xl text-black font-bold pb-2">BITE INTO HAPPINESS!</h1>
                    <p class="desc text-lg md:text-2xl text-black mb-8">Good vibes, great food, and no waiting. Get your favorite meals fast and fresh!</p>

                    <div class="hero-btn flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="./index.php#bestDeals" class="fill-btn">Explore Now!</a>
                        <a href="./index.php#menu" class="outline-btn">See Menu</a>
                    </div>
                </div>

                <!-- Image -->
                <div class="hero-image flex justify-center">
                    <img src="./assets/img/hero-img.webp" alt="Hero Image" class="max-w-[80%] md:max-w-full h-auto">
                </div>
            </div>
        </section>


        <section class=" flex justify-center p-8" id="bestDeals">
            <div class="w-full max-w-[1200px] mx-auto my-auto">
                <h1 class="font-semibold text-4xl text-center">
                    Best <span class="gradient-txt">Deals</span>
                </h1>
                <div class="bestDeal-item mt-8 menu-scroll flex md:grid md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 overflow-x-auto md:overflow-visible justify-start md:justify-center select-none">
                    <?php
                    include './config/db.php';
                    $result = $conn->query("
                        SELECT * FROM products 
                        WHERE name IN (
                            'Spicy Chicken Burger',
                            'Double Patty Beast',
                            'Cheesy Hamburger',
                            'Bacon & Cheese Classic'
                        )
                    ");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imgPath = !empty($row['image']) ? "./uploads/{$row['image']}" : "./assets/img/no-image.png";
                            echo "
                            <div class='deal-card group rounded-2xl p-4 shadow-md flex flex-col min-w-[250px] max-w-[290px] bg-white flex-shrink-0'>
                            <img src='{$imgPath}' alt='{$row['name']}' class='deal-img transition-transform duration-400 group-hover:scale-110 h-40 object-contain mx-auto rounded-md' />
                            <h2 class='text-center font-semibold text-xl md:text-2xl fredoka mt-4'>{$row['name']}</h2>
                            <p class='text-center fredoka text-sm mt-2 flex-grow'>
                                {$row['description']}
                            </p>
                            <div class='card-btn gap-2 mt-auto flex items-center justify-between'>
                                <p class='price text-lg font-semibold p-2 rounded-lg bg-orange-50'>$ " . number_format($row['price'], 0, ',', '.') . "</p>
                                <a href='./cart.php?add={$row['id']}' class='add-to-cart-btn outline-btn flex justify-center items-center h-12 w-12'>
                                    <i class='fa-solid fa-cart-plus'></i>
                                </a>
                            </div>
                        </div>";
                        }
                    } else {
                        echo "<p class='text-center text-gray-500'>Belum ada produk tersedia</p>";
                    }
                    ?>
                </div>
            </div>
        </section>

        <section id="whyUs" class="flex justify-center p-8 bg-white">
            <div class="whyUs-container w-full max-w-[1200px] flex flex-col md:flex-row items-center md:items-start gap-10">
                <div class="whyUs-img w-full md:w-1/2 flex justify-center">
                    <img src="./assets/img/why-pic1.webp" alt="burger" class="w-[75%] md:w-[70%] h-auto object-contain">
                </div>

                <div class="w-full md:w-1/2 flex flex-col justify-center text-center md:text-left">
                    <h1 class="roboto font-semibold text-3xl md:text-4xl max-w-[500px] mx-auto md:mx-0 leading-tight">
                        FastBite's Promise of 100% Real Goodness!
                    </h1>

                    <div class="mt-6 flex flex-col gap-3 text-lg">
                        <div class="flex items-start gap-2 w-full"><span class="arrow"></span>
                            <p>Made with Premium Angus Beef</p>
                        </div>
                        <div class="flex items-start gap-2 w-full"><span class="arrow"></span>
                            <p>Freshly Baked Soft Buns</p>
                        </div>
                        <div class="flex items-start gap-2 w-full"><span class="arrow"></span>
                            <p>Crisp Lettuce & Ripe Tomatoes</p>
                        </div>
                        <div class="flex items-start gap-2 w-full"><span class="arrow"></span>
                            <p>Rich Cheddar & Melty Swiss Cheese</p>
                        </div>
                        <div class="flex items-start gap-2 w-full"><span class="arrow"></span>
                            <p>Grilled Onions & Crunchy Pickles</p>
                        </div>
                        <div class="flex items-start gap-2 w-full"><span class="arrow"></span>
                            <p>Farm-Fresh Free-Range Eggs</p>
                        </div>
                        <div class="flex items-start gap-2 w-full"><span class="arrow"></span>
                            <p>Smoky Crispy Beef Strips</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include 'menu.php' ?>

        <section id="review">
            <section id="review" class="flex justify-center p-8">
                <div class="review-container justify-center w-full max-w-[1200px] my-auto mx-auto ">
                    <h1 class="text-4xl roboto text-center md:text-start mb-8 max-w-[600px] mx-auto md:mx-0">
                        What They’re Saying About FastBite
                    </h1>

                    <div class="menu-scroll flex md:grid md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 lg:gap-16 overflow-x-auto md:overflow-visible justify-start md:justify-center select-none">
                        <div class="review-card flex flex-col gap-4 justify-between min-w-[300px] max-w-[350px]">
                            <p class="review-text">FastBite completely changed how I see fast food. The burger was incredibly juicy, the bun was perfectly toasted, and the vegetables tasted fresh and crisp. Every bite felt well-balanced, and the flavors blended together beautifully. I was also impressed by how quickly it was served without compromising on quality</p>
                            <div class="review-userInf flex items-start gap-4">
                                <img src="./assets/img/user-icon.png" alt="User 1" class="user-img rounded-full w-12 h-12">
                                <div class="user-details flex flex-col">
                                    <span class="user-name font-semibold">Prabowo</span>
                                    <span class="user-rating text-yellow-500"><i class="fa-solid fa-star"></i> 5.0</span>
                                </div>
                            </div>
                        </div>

                        <div class="review-card flex flex-col gap-4 justify-between min-w-[300px] max-w-[350px]">
                            <p class="review-text">I tried the Spicy Chicken Deluxe and it instantly became one of my top choices. The chicken had a crispy golden coating with tender, juicy meat inside. The spice level was perfect — enough to give a kick without overpowering the taste. The sauce tied everything together, making it a memorable meal.</p>
                            <div class="review-userInf flex items-start gap-4">
                                <img src="./assets/img/user-icon.png" alt="User 2" class="user-img rounded-full w-12 h-12">
                                <div class="user-details flex flex-col">
                                    <span class="user-name font-semibold">Pracanda</span>
                                    <span class="user-rating text-yellow-500"><i class="fa-solid fa-star"></i> 4.8</span>
                                </div>
                            </div>
                        </div>

                        <div class="review-card flex flex-col gap-4 justify-between min-w-[300px] max-w-[350px]">
                            <p class="review-text">The BBQ Smokehouse Burger was an absolute treat. It had a rich, smoky flavor that paired perfectly with the sweet and tangy sauce. The fries were golden, crispy, and seasoned just right. On top of that, the staff were friendly and welcoming, making the entire dining experience feel warm and inviting.</p>
                            <div class="review-userInf flex items-start gap-4">
                                <img src="./assets/img/user-icon.png" alt="User 3" class="user-img rounded-full w-12 h-12">
                                <div class="user-details flex flex-col">
                                    <span class="user-name font-semibold">Chef Juna</span>
                                    <span class="user-rating text-yellow-500"><i class="fa-solid fa-star"></i> 4.7</span>
                                </div>
                            </div>
                        </div>

                        <div class="review-card flex flex-col gap-4 justify-between min-w-[300px] max-w-[350px]">
                            <p class="review-text">The Double Stack Melt was packed with flavor from the very first bite. The juicy patties and melted cheese combined with caramelized onions created a rich, savory taste. It was filling but never felt too heavy, and the portion size felt generous for the price. I’ll definitely be ordering it again.</p>
                            <div class="review-userInf flex items-start gap-4">
                                <img src="./assets/img/user-icon.png" alt="User 4" class="user-img rounded-full w-12 h-12">
                                <div class="user-details flex flex-col">
                                    <span class="user-name font-semibold">Gibran</span>
                                    <span class="user-rating text-yellow-500"><i class="fa-solid fa-star"></i> 4.9</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <div id="loginPopup"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm flex justify-center items-center hidden transition-opacity duration-300">

        <div class="popup-content bg-white rounded-2xl p-6 max-w-md w-full text-center shadow-xl transform scale-95 transition-all duration-300">
            <h2 class="text-xl font-semibold mb-3 text-gray-800">Let's Log In First</h2>
            <p class="text-gray-600 mb-5">Go ahead and log in first to add items to your cart.</p>

            <div class="popup-buttons flex justify-center gap-2">
                <button id="loginBtn" class="fill-btn">Login</button>
                <button id="registerBtn" class="outline-btn">Register</button>
                <button id="closePopup" class="fill-btn">Cancel</button>
            </div>
        </div>
    </div>

    <?php include 'partials/footer.php'; ?>
</body>

</html>