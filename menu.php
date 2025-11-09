<?php
/*Menu PHP*/
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<section id="menu" class="flex justify-center p-8 bg-orange-100">
    <div class="w-full max-w-[1200px] my-auto mx-auto">
        <h1 class="font-semibold text-4xl text-center ">
            Menu
        </h1>
        <div class="menu-scroll mt-8 flex md:grid md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 lg:gap-10 overflow-x-auto md:overflow-visible justify-start md:justify-center select-none">
            <?php
            include './config/db.php';
            $result = $conn->query("
                        SELECT * FROM products
                    ");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imgPath = !empty($row['image']) ? "./uploads/{$row['image']}" : "./assets/img/no-image.png";
                    echo "
                        <div class='deal-card group rounded-2xl p-4 shadow-md flex flex-col min-w-[280px] max-w-[300px] bg-white flex-shrink-0'>
                        <img src='{$imgPath}' alt='{$row['name']}'
                            class='deal-img transition-transform duration-300 group-hover:scale-110 h-40 object-contain mx-auto rounded-md' />
                        
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