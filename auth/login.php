<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastBite - Login</title>
    <link rel="stylesheet" href="../assets//css/login.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="/FastBite/assets/js/script.js"></script>
    <script defer src="https://kit.fontawesome.com/5fd6ecb4fe.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <div class="login-box">
            <div class="login-head">
                <img src="/FastBite/assets/img/burger-logo2.png" alt="logo" class="login-pic">
                <h1 class="font-bold text-4xl">Welcome Back</h1>
                <p class="login-text">Please enter your details.</p>
            </div>
            <div class="login-form w-full">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <input type="email" name="user_email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="user_passsword" placeholder="Your Password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" class="fill-btn">Continue</button>
                    </div>
                    <!-- <div class="form-group">
                        <p class="text-center text-xl">OR</p>
                    </div>
                    <div class="form-group">
                        <a href="#" class="outline-btn"><i class="fa-brands fa-google"></i> Continue with Google</a>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</body>

</html>