<?php
/*Register PHP*/
session_start();
require_once '../config/db.php'; // pastikan file db.php berisi koneksi $conn

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['user_name']);
    $email = trim($_POST['user_email']);
    $password = trim($_POST['user_password']); // pastikan nama input benar
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah email sudah terdaftar
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $error = "Email sudah terdaftar. Silakan login.";
    } else {
        // Simpan user baru ke database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        if ($stmt->execute()) {
            // $_SESSION['user'] = [
            //     'id' => $conn->insert_id,
            //     'username' => $username,
            //     'email' => $email
            // ];
            // header("Location: login.php");
            header("Location: /FastBite/auth/login.php?registered=success");
            exit;
        } else {
            $error = "Terjadi kesalahan. Coba lagi nanti.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastBite - Register</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/burger-logo.webp">
    <meta name="theme-color" content="#FF8000">
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
                <h1 class="font-bold text-4xl">Let’s Get Started</h1>
            </div>
            <div class="auth-form w-full">
                <form action="register.php" method="post" autocomplete="off">
                    <div class="form-group">
                        <input type="text" name="user_name" placeholder=" " required>
                        <label for="user_name">Your Username</label>
                    </div>
                    <div class="form-group">
                        <input type="email" name="user_email" placeholder=" " required>
                        <label for="user_email">Your Email</label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="user_password" placeholder=" " required>
                        <label for="user_password">Your Password</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" class="fill-btn">Continue</button>
                    </div>
                    <div class="form-group">
                        <p class="text-center text-sm">OR</p>
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