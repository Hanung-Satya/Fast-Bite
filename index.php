<?php
session_start();
require_once 'database/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastBite</title>
    <link rel="stylesheet" href="/FastBite/assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="/FastBite/assets/js/script.js"></script>
    <script defer src="https://kit.fontawesome.com/5fd6ecb4fe.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'partials/header.php'; ?>
    <main>
        <section class="hero-section flex items-center justify-center">
            <div class="hero-container flex items-center justify-between max-w-[1200px] mx-auto w-full gap-8">
                <div class="hero-text">
                    <p class="subtitle text-4xl text-black pb-4 roboto">Taste the Flavor</p>
                    <h1 class="headline text-5xl text-black font-bold pb-2">BITE INTO HAPPINESS!</h1>
                    <p class="desc text-2xl text-black mb-8">Good vibes, great food, and no waiting. Get your favorite meals fast and fresh!</p>

                    <div class="hero-btn flex gap-6">
                        <a href="/FastBite/index.php#bestDeals" class="fill-btn">Explore Now!</a>
                        <a href="/FastBite/index.php#menu" class="outline-btn">See Menu</a>
                    </div>
                </div>
                <div class="hero-image flex justify-center">
                    <img src="/FastBite/assets/img/hero-img.webp" alt="Hero Image" class="max-w-full h-auto ">
                </div>
            </div>
        </section>

        <section class="mt-12 flex justify-center p-8" id="bestDeals">
            <div class="bestDeal-container flex flex-col items-center max-w-[1200px] w-full">
                <h1 class="font-semibold text-4xl">Best <span class="gradient-txt">Deals</span></h1>
                <div class="bestDeal-item flex gap-8 w-full mt-8">
                    <div class="deal-card group w-2xs rounded-lg p-4 shadow">
                        <img src="/FastBite/assets/img/bacon.webp" alt="bacon" class="deal-img transition-transform duration-300 group-hover:scale-110" />
                        <h2 class=" text-center font-semibold text-2xl fredoka ">Bacon & Cheese Classic</h2>
                        <p class="text-center fredoka">Smoky beef bacon, sharp cheddar, beef patty, and tangy BBQ sauce.</p>
                        <div class="card-btn gap-2 mt-auto">
                            <p class="price flex-6 text-lg font-semibold p-2 rounded-lg">5$</p>
                            <a href="/FastBite/cart.php" class="outline-btn flex-4 bg-white"><i class="fa-solid fa-cart-plus "></i></a>
                        </div>
                    </div>
                    <div class="deal-card group w-2xs rounded-lg p-4 shadow">
                        <img src="/FastBite/assets/img/cheesy.webp" alt="bacon" class="deal-img transition-transform duration-300 group-hover:scale-110" />
                        <h2 class=" font-semibold text-2xl fredoka text-center">Cheesy Hamburger</h2>
                        <p class="text-center fredoka">Classic beef burger with melted cheese, lettuce, tomato, and ketchup.</p>
                        <div class="card-btn gap-2 mt-auto">
                            <p class="price flex-6 text-lg font-semibold p-2 rounded-lg">5$</p>
                            <a href="/FastBite/cart.php" class="outline-btn flex-4 bg-white"><i class="fa-solid fa-cart-plus "></i></a>
                        </div>
                    </div>
                    <div class="deal-card group w-2xs rounded-lg p-4 shadow">
                        <img src="/FastBite/assets/img/doublepatty.webp" alt="bacon" class="deal-img transition-transform duration-300 group-hover:scale-110" />
                        <h2 class=" font-semibold text-2xl fredoka text-center">Double Patty Beast</h2>
                        <p class="text-center fredoka">Two juicy beef patties, cheddar cheese, grilled onions, and signature sauce.</p>
                        <div class="card-btn gap-2 mt-auto">
                            <p class="price flex-6 text-lg font-semibold p-2 rounded-lg">5$</p>
                            <a href="/FastBite/cart.php" class="outline-btn flex-4 bg-white"><i class="fa-solid fa-cart-plus "></i></a>
                        </div>
                    </div>
                    <div class="deal-card group w-2xs rounded-lg p-4 shadow">
                        <img src="/FastBite/assets/img/spicy.webp" alt="bacon" class="deal-img transition-transform duration-300 group-hover:scale-110" />
                        <h2 class=" font-semibold text-2xl fredoka text-center">Spicy Chicken Burger</h2>
                        <p class="text-center fredoka">Crispy spicy chicken patty, melty cheese, fresh lettuce, and bold chili mayo.</p>
                        <div class="card-btn gap-2 mt-auto">
                            <p class="price flex-6 text-lg font-semibold p-2 rounded-lg">5$</p>
                            <a href="/FastBite/cart.php" class="outline-btn flex-4 bg-white"><i class="fa-solid fa-cart-plus "></i></a>
                        </div>
                    </div>
                </div>
        </section>

        <section id="whyUs" class="mt-12 flex justify-center p-8">
            <div class="whyUs-container w-full ">
                <div class="whyUs-content gap-8">
                    <div class="whyUs-img flex-4">
                        <img src="/FastBite/assets/img/why-pic1.webp" alt="burger" class="whyUs-img h-auto w-full object-contain m-8">
                    </div>
                    <div class="flex-6 flex flex-col justify-center ml-8">
                        <h1 class="roboto font-semibold text-4xl max-w-[500px]">FastBite’s Promise of 100% Real Goodness!</span></h1>
                        <div class="mt-4 flex flex-wrap gap-x-6 gap-y-4 text-lg">
                            <div class="flex items-start gap-2 w-full">
                                <span class="arrow"></span>
                                <p>Made with Premium Angus Beef</p>
                            </div>
                            <div class="flex items-start gap-2 w-full">
                                <span class="arrow"></span>
                                <p>Freshly Baked Soft Buns</p>
                            </div>
                            <div class="flex items-start gap-2 w-full">
                                <span class="arrow"></span>
                                <p>Crisp Lettuce & Ripe Tomatoes</p>
                            </div>
                            <div class="flex items-start gap-2 w-full">
                                <span class="arrow"></span>
                                <p>Rich Cheddar & Melty Swiss Cheese</p>
                            </div>
                            <div class="flex items-start gap-2 w-full">
                                <span class="arrow"></span>
                                <p>Grilled Onions & Crunchy Pickles</p>
                            </div>
                            <div class="flex items-start gap-2 w-full">
                                <span class="arrow"></span>
                                <p>Farm-Fresh Free-Range Eggs</p>
                            </div>
                            <div class="flex items-start gap-2 w-full">
                                <span class="arrow"></span>
                                <p>Smoky Crispy Beef Strips</p>
                            </div>
                        </div>
                    </div>
        </section>

        <section id="review">
            <div class="review-container flex flex-col p-8 m-16 justify-center">
                <h1 class="text-4xl roboto text-start mb-8 max-w-[600px]">What They’re Saying About FastBite</h1>
                <div class="review-content flex flex-rows">
                    <div class="review-card flex flex-col gap-4 justify-between">
                        <p class="review-text">FastBite completely changed how I see fast food. The burger was incredibly juicy, the bun was perfectly toasted, and the vegetables tasted fresh and crisp. Every bite felt well-balanced, and the flavors blended together beautifully. I was also impressed by how quickly it was served without compromising on quality.</p>
                        <div class="review-userInf flex items-start gap-4">
                            <img src="/FastBite/assets/img/user-icon.png" alt="User 1" class="user-img rounded-full w-12 h-12">
                            <div class="user-details flex flex-col">
                                <span class="user-name font-semibold">John Doe</span>
                                <span class="user-rating text-yellow-500"><i class="fa-solid fa-star"></i> 5.0</span>
                            </div>
                        </div>
                    </div>
                    <div class="review-card flex flex-col gap-4 justify-between">
                        <p class="review-text">I tried the Spicy Chicken Deluxe and it instantly became one of my top choices. The chicken had a crispy golden coating with tender, juicy meat inside. The spice level was perfect — enough to give a kick without overpowering the taste. The sauce tied everything together, making it a memorable meal.</p>
                        <div class="review-userInf flex items-start gap-4">
                            <img src="/FastBite/assets/img/user-icon.png" alt="User 1" class="user-img rounded-full w-12 h-12">
                            <div class="user-details flex flex-col">
                                <span class="user-name font-semibold">John Doe</span>
                                <span class="user-rating text-yellow-500"><i class="fa-solid fa-star"></i> 5.0</span>
                            </div>
                        </div>
                    </div>
                    <div class="review-card flex flex-col gap-4 justify-between">
                        <p class="review-text">The BBQ Smokehouse Burger was an absolute treat. It had a rich, smoky flavor that paired perfectly with the sweet and tangy sauce. The fries were golden, crispy, and seasoned just right. On top of that, the staff were friendly and welcoming, making the entire dining experience feel warm and inviting.</p>
                        <div class="review-userInf flex items-start gap-4">
                            <img src="/FastBite/assets/img/user-icon.png" alt="User 1" class="user-img rounded-full w-12 h-12">
                            <div class="user-details flex flex-col">
                                <span class="user-name font-semibold">John Doe</span>
                                <span class="user-rating text-yellow-500"><i class="fa-solid fa-star"></i> 5.0</span>
                            </div>
                        </div>
                    </div>
                    <div class="review-card flex flex-col gap-4 justify-between">
                        <p class="review-text">The Double Stack Melt was packed with flavor from the very first bite. The juicy patties and melted cheese combined with caramelized onions created a rich, savory taste. It was filling but never felt too heavy, and the portion size felt generous for the price. I’ll definitely be ordering it again.</p>
                        <div class="review-userInf flex items-start gap-4">
                            <img src="/FastBite/assets/img/user-icon.png" alt="User 1" class="user-img rounded-full w-12 h-12">
                            <div class="user-details flex flex-col">
                                <span class="user-name font-semibold">John Doe</span>
                                <span class="user-rating text-yellow-500"><i class="fa-solid fa-star"></i> 5.0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'partials/footer.php'; ?>
</body>

</html>