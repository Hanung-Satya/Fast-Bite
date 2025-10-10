<?php
    /*Menu PHP*/
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<section id="menu" class="mt-16 flex justify-center p-8">
    <div class="w-full max-w-[1200px] mx-auto">
                <h1 class="font-semibold text-4xl text-center">
                    Menu
                </h1>
                <div class="menu-scroll flex gap-6 overflow-x-auto mt-8 pb-4 select-none">
                    <?php
                    include './config/db.php';
                    $result = $conn->query("
                        SELECT * FROM products
                    ");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imgPath = !empty($row['image']) ? "/FastBite/uploads/{$row['image']}" : "/FastBite/assets/img/no-image.png";
                            echo "
                        <div class='deal-card group rounded-lg p-4 shadow flex flex-col h-full'>
                            <img src='{$imgPath}' alt='{$row['name']}' class='deal-img transition-transform duration-300 group-hover:scale-110 h-40 object-contain mx-auto rounded' />
                            <h2 class='text-center font-semibold text-2xl fredoka mt-4'>{$row['name']}</h2>
                            <p class='text-center fredoka text-sm mt-2 flex-grow'>
                                {$row['description']}
                            </p>
                            <div class='card-btn gap-2 mt-auto flex items-center justify-between'>
                                <p class='price flex-6 text-lg font-semibold p-2 rounded-lg'>$ " . number_format($row['price'], 0, ',', '.') . "</p>
                                <a href='/FastBite/cart.php?add={$row['id']}' class='outline-btn flex-4 bg-white'>
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