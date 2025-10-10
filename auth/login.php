<?php
/*Login PHP*/
session_start();
include '../config/db.php';

$error = '';

if (isset($_POST['login'])) {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    // Ambil user berdasarkan email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Simpan semua data di session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['role'] = $row['role'];

            // Cek role dan arahkan ke halaman sesuai
            if ($row['role'] === 'admin') {
                header('Location: /FastBite/admin/dashboard.php');
                exit();
            } else {
                header('Location: /FastBite/index.php');
                exit();
            }
        } else {
            $error = 'Password salah. Silakan coba lagi.';
        }
    } else {
        $error = 'Email tidak ditemukan. Silakan daftar terlebih dahulu.';
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
                <!-- Pesan Login Sukses -->
                <?php if (isset($_GET['registered']) && $_GET['registered'] === 'success'): ?>
                    <div class="text-green-600 text-sm mb-4 text-center">
                        ✅ Registrasi berhasil! Silakan login.
                    </div>
                <?php endif; ?>

                <!-- Pesan Kasalahan Login -->
                <?php if (!empty($error)): ?>
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                <form action="login.php" method="post" autocomplete="off">
                    <div class="form-group">
                        <input type="email" name="user_email" placeholder=" " autocomplete="on" required>
                        <label for="user_email">Your Email</label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="user_password" placeholder=" " autocomplete="on" required>
                        <label for="user_password">Your Password</label>
                    </div>
                    <div class="form-group flex flex-row gap-4">
                        <a href="../index.php" class="fill-btn flex-6">Back</a>
                        <button type="submit" name="login" class="outline-btn text-center flex-4">Continue</button>
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