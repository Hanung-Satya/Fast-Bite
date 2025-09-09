<?php
/*Login PHP*/
session_start();
include '../config/db.php';
$error = '';

if (isset($_POST['login'])) {
    $email = $_POST['user_email'];
    $password = $_POST['user_passsword'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['user_email'] = $row['user_email'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'admin') {
                header('location: /FastBite/admin/dashboard.php');
                exit();
            } else {
                header('location: /FastBite/index.php');
                exit();
            }
        } else {
            $error = 'Password Salah, Silahkan coba lagi!';
        }
    } else {
        $error = 'Email tidak ditemukan. Silahkan register terlebih dahulu';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastBite - Login</title>
    <link rel="stylesheet" href="../assets//css/auth.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="/FastBite/assets/js/script.js"></script>
    <script defer src="https://kit.fontawesome.com/5fd6ecb4fe.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <div class="auth-container">
            <div class="auth-head">
                <img src="/FastBite/assets/img/burger-logo2.png" alt="logo" class="auth-pic">
                <h1 class="font-bold text-4xl">Welcome Back</h1>
                <p class="login-text">Please enter your details.</p>
            </div>
            <div class="auth-form w-full">
                <?php if (!empty($error)): ?>
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                <form action="login.php" method="post" autocomplete="off">
                    <div class="form-group">
                        <input type="email" name="user_email" placeholder=" " autocomplete="off" required>
                        <label for="user_email">Your Email</label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="user_password" placeholder=" " autocomplete="off" required>
                        <label for="user_password">Your Password</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" class="fill-btn">Continue</button>
                    </div>
                    <div class="form-group">
                        <p class="text-center text-xl">OR</p>
                    </div>
                    <div class="form-group">
                        <a href="#" class="outline-btn"><i class="fa-brands fa-google"></i> Continue with Google</a>
                    </div>
                    <div class="form-group">
                        <a href="#" class="outline-btn"><i class="fa-brands fa-facebook"></i> Continue with Facebook</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>